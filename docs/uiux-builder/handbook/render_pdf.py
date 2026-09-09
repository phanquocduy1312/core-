"""In lại PDF từ index.html: python3 docs/uiux-builder/handbook/render_pdf.py. Cần Playwright và Chromium."""
import asyncio,json
from pathlib import Path
from playwright.async_api import async_playwright
ROOT=Path(__file__).resolve().parent
async def main():
 async with async_playwright() as p:
  b=await p.chromium.launch(args=['--no-sandbox']);page=await b.new_page()
  await page.goto((ROOT/'index.html').as_uri());await page.evaluate('document.fonts.ready');await page.emulate_media(media='print')
  result=await page.evaluate('''()=>({images:[...document.images].map(x=>({src:x.getAttribute('src'),ok:x.complete&&x.naturalWidth>0})),pages:[...document.querySelectorAll('.page')].map(s=>{let m=s.querySelector('main'),f=s.querySelector('footer');return {id:s.id,title:s.querySelector('h1').innerText,bottom:m.getBoundingClientRect().bottom,limit:f.getBoundingClientRect().top,overflow:m.getBoundingClientRect().bottom>f.getBoundingClientRect().top-8}})})''')
  (ROOT/'verification.json').write_text(json.dumps(result,ensure_ascii=False,indent=2))
  print('Missing images',[x for x in result['images'] if not x['ok']]);print('Overflow',[(x['id'],x['title'],round(x['bottom']-x['limit'])) for x in result['pages'] if x['overflow']])
  assert all(x['ok'] for x in result['images']), 'Có ảnh chưa tải được'
  assert not any(x['overflow'] for x in result['pages']), 'Có trang tràn nội dung'
  await page.pdf(path=str(ROOT/'HUONG-DAN-UIUX-BUILDER.pdf'),print_background=True,prefer_css_page_size=True,tagged=True,outline=True)
  await b.close()
asyncio.run(main())
