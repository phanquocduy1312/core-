"""Real Chromium regression checks. Requires the disposable UI/UX audit server.
Run: UIUX_AUTH=/tmp/uiux-audit/auth.json python3 tests/Browser/uiux_builder.py
Never point this mutation suite at a production server.
"""
import asyncio, json, os, unittest
from pathlib import Path
from urllib.parse import urlparse
from playwright.async_api import async_playwright

BASE=os.environ.get('UIUX_BASE_URL','http://127.0.0.1:8765')
AUTH=os.environ.get('UIUX_AUTH','/tmp/uiux-audit/auth.json')
PAGE=os.environ.get('UIUX_PAGE_ID','2')

class BuilderBrowserTest(unittest.IsolatedAsyncioTestCase):
 async def asyncSetUp(self):
  self.assertIn(urlparse(BASE).hostname, ['127.0.0.1','localhost'], 'Only a disposable localhost server is allowed')
  self.p=await async_playwright().start()
  self.addAsyncCleanup(self.p.stop)
  self.browser=await self.p.chromium.launch(headless=True,args=['--no-sandbox'])
  self.addAsyncCleanup(self.browser.close)
  self.ctx=await self.browser.new_context(storage_state=AUTH,viewport={'width':1600,'height':1000})
  self.page=await self.ctx.new_page()
  self.errors=[]
  self.page.on('pageerror',lambda e:self.errors.append(str(e)))
  await self.page.goto(f'{BASE}/vi/admin/pages/{PAGE}/builder',wait_until='domcontentloaded')
  await self.page.wait_for_function('!!(window.editor && editor.Canvas.getBody())')
  await self.page.evaluate('() => new Promise(resolve => editor.onReady(() => setTimeout(resolve, 0)))')
 async def test_devices_match_toolbar_and_generate_mobile_css(self):
  await self.page.get_by_title('Điện thoại (375px)',exact=True).click()
  self.assertEqual(await self.page.evaluate('editor.getDevice()'),'Mobile')
  self.assertEqual(await self.page.evaluate('editor.Devices.getSelected().get("width")'),'375px')
  self.assertEqual(await self.page.evaluate('editor.Devices.getSelected().get("widthMedia")'),'767px')
  await self.page.get_by_title('Máy tính bảng (768px)',exact=True).click()
  self.assertEqual(await self.page.evaluate('editor.Devices.getSelected().get("width")'),'768px')
 async def test_empty_project_reopens_without_resurrecting_published_content(self):
  result=await self.page.evaluate('''() => {
   const old=editor;old.destroy();
   window.editor=GrapesEditor.init({...BUILDER_CONFIG,builderData:{pages:[{frames:[{component:{type:'wrapper',components:[]}}]}]},initialHtml:'<h1>Must not return</h1>'});
   return editor.getHtml();
  }''')
  self.assertNotIn('Must not return',result)
 async def test_legacy_project_preserves_editor_state(self):
  result=await self.page.evaluate('''() => {
   editor.destroy();window.editor=GrapesEditor.init({...BUILDER_CONFIG,builderData:{pages:[{component:{type:'wrapper',components:[{tagName:'h2',content:'Legacy project',auditMarker:'retained'}]}}]},initialHtml:'<h1>Wrong fallback</h1>'});
   return {html:editor.getHtml(),marker:editor.getWrapper().components().at(0).get('auditMarker')};
  }''')
  self.assertIn('Legacy project',result['html'])
  self.assertEqual(result.get('marker'),'retained')
 async def test_publish_clears_unsaved_warning(self):
  await self.page.evaluate("() => {editor.addComponents('<p id=browser-publish-check>Kiểm chứng xuất bản</p>');}")
  self.assertTrue(await self.page.evaluate('editor.isDirty()'))
  await self.page.get_by_title('Xuất bản trang lên website',exact=True).click()
  await self.page.get_by_role('button',name='Xuất bản ngay',exact=True).click()
  await self.page.get_by_text('Trang đã được xuất bản lên website!',exact=True).wait_for()
  self.assertFalse(await self.page.evaluate('editor.isDirty()'))
 async def test_basic_text_components_support_double_click_editing(self):
  for typ in ['builder-heading','builder-paragraph','builder-button','builder-link']:
   await self.page.evaluate("typ => {editor.setComponents([{type:typ,attributes:{id:'rte-audit'}}]);}",typ)
   el=self.page.frame_locator('.gjs-frame').locator('#rte-audit')
   await el.dblclick()
   self.assertEqual(await el.get_attribute('contenteditable'),'true',typ)
   await el.fill('Nội dung đã sửa')
   await self.page.locator('.builder-meta').click()
   await self.page.wait_for_function("editor.getHtml().includes('Nội dung đã sửa')")
   self.assertIn('Nội dung đã sửa',await self.page.evaluate('editor.getHtml()'))
 async def test_heading_tag_trait_changes_real_html(self):
  result=await self.page.evaluate("() => {const c=editor.addComponents({type:'builder-heading'})[0];c.getTrait('tagName').setValue('h1');return c.toHTML();}")
  self.assertTrue(result.startswith('<h1'),result)
 async def test_edit_save_reload_keeps_text_and_mobile_styles(self):
  await self.page.evaluate("() => {editor.setComponents([{type:'builder-heading',attributes:{id:'roundtrip-text'}}]);}")
  el=self.page.frame_locator('.gjs-frame').locator('#roundtrip-text')
  await el.dblclick()
  await el.fill('Nội dung kiểm chứng lưu lại')
  await self.page.get_by_title('Lưu bản nháp (Ctrl+S)',exact=True).click()
  await self.page.get_by_text('Đã lưu bản nháp!',exact=True).wait_for()
  await self.page.reload(wait_until='domcontentloaded')
  await self.page.wait_for_function('window.editor && editor.getModel().get(\"ready\")')
  self.assertIn('Nội dung kiểm chứng lưu lại',await self.page.evaluate('editor.getHtml()'))
 async def media_fixture(self):
  self.uploads=[]
  async def resources(route):
   second='cursor=' in route.request.url
   name='second' if second else 'first'
   await route.fulfill(json={'resources':[{'secure_url': BASE+'/wp-content/uploads/2022/02/Logo_300x73.png?'+name,'public_id':'general/'+name+'.png','width':300,'height':73,'format':'png'}], 'next_cursor': None if second else 'page2'})
  async def upload(route):
   self.uploads.append(route.request.url)
   await route.fulfill(status=422,json={'success':False,'message':'Controlled rejection'})
  await self.page.route('**/media/resources*',resources)
  await self.page.route('**/media/upload',upload)
  await self.page.evaluate("() => {window.mediaToasts=[]; Swal.fire=async opts=>{mediaToasts.push(opts);return {isConfirmed:false};};const c=editor.addComponents({type:'image',attributes:{src:'/old.png',srcset:'/old-2x.png 2x',sizes:'100vw','data-src':'/lazy-old.png'}})[0];editor.select(c);editor.runCommand('open-assets',{target:c});}")
  await self.page.locator('.media-modal-card').first.wait_for()
 async def test_media_drop_uploads_once_and_error_never_reports_success(self):
  await self.media_fixture()
  await self.page.locator('#tab-btn-upload').click()
  await self.page.evaluate("() => {const d=new DataTransfer();d.items.add(new File(['test'],'test.png',{type:'image/png'}));document.getElementById('media-main-dropzone').dispatchEvent(new DragEvent('drop',{bubbles:true,cancelable:true,dataTransfer:d}));}")
  await self.page.wait_for_timeout(900)
  self.assertEqual(len(self.uploads),1)
  self.assertEqual(await self.page.evaluate('mediaToasts.filter(t=>t.icon===\"success\").length'),0)
 async def test_media_load_more_appends_results(self):
  await self.media_fixture()
  self.assertTrue(await self.page.locator('#media-load-more').is_visible())
  await self.page.locator('#media-load-more').click()
  await self.page.wait_for_function('document.querySelectorAll(\".media-modal-card\").length===2')
  self.assertFalse(await self.page.locator('#media-load-more').is_visible())
 async def test_replacement_clears_old_responsive_image_sources(self):
  await self.media_fixture()
  await self.page.locator('.media-modal-card').first.click()
  await self.page.locator('#btn-confirm-media').click()
  attrs=await self.page.evaluate('editor.getSelected().getAttributes()')
  self.assertIn('first',attrs['src'])
  for name in ['srcset','sizes','data-src']: self.assertNotIn(name,attrs)
 async def test_columns_accept_child_and_gap_preserves_alignment(self):
  result=await self.page.evaluate("() => {const c=editor.addComponents(editor.BlockManager.get('layout-3-columns').get('content'))[0];const before=c.getStyle()['align-items'];c.getTrait('columns-gap').setValue('16px');return {move:editor.Components.canMove(c,c.components().at(0)).result,before,after:c.getStyle()['align-items']};}")
  self.assertTrue(result['move'])
  self.assertEqual(result['before'],result['after'])
 async def test_all_registered_blocks_can_be_inserted_and_serialized(self):
  problems=await self.page.evaluate('''() => {
   const failures=[];
   editor.BlockManager.getAll().forEach(block=>{
    try {const added=editor.addComponents(block.get('content')); if(!added.length)throw Error('empty'); JSON.stringify(editor.getProjectData()); added.forEach(c=>c.remove());}
    catch(e){failures.push(block.id+': '+e.message)}
   });return failures;
  }''')
  self.assertEqual(problems,[])
  self.assertEqual(self.errors,[])

if __name__=='__main__': unittest.main(verbosity=2)
