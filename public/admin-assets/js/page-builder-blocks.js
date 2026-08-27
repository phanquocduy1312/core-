/**
 * Shared GrapesJS block library for the page builder.
 * Used by both the full admin builder (_form.blade.php) and the on-site
 * inline editor (admin-bar.blade.php) so both surfaces offer the same blocks.
 */
(function (global) {
    function registerPageBuilderBlocks(editor) {
        var blocks = editor.BlockManager;

        function add(id, label, category, content) {
            blocks.add(id, { label: label, category: category, content: content });
        }

        // ---- Bố cục ------------------------------------------------------
        add('page-container', 'Khung chứa', 'Bố cục',
            '<div data-page-block="container" style="max-width:1100px;margin:0 auto;padding:24px"><p>Kéo các khối khác vào đây.</p></div>');

        add('page-columns-2', 'Cột 2', 'Bố cục',
            '<section data-page-block="columns-2" style="display:flex;flex-wrap:wrap;gap:24px;max-width:1100px;margin:auto;padding:48px 24px">' +
            '<div style="flex:1 1 280px"><h3>Cột 1</h3><p>Nội dung cột thứ nhất.</p></div>' +
            '<div style="flex:1 1 280px"><h3>Cột 2</h3><p>Nội dung cột thứ hai.</p></div>' +
            '</section>');

        add('page-columns-3', 'Cột 3', 'Bố cục',
            '<section data-page-block="columns-3" style="display:flex;flex-wrap:wrap;gap:24px;max-width:1100px;margin:auto;padding:48px 24px">' +
            '<div style="flex:1 1 220px"><h3>Cột 1</h3><p>Nội dung.</p></div>' +
            '<div style="flex:1 1 220px"><h3>Cột 2</h3><p>Nội dung.</p></div>' +
            '<div style="flex:1 1 220px"><h3>Cột 3</h3><p>Nội dung.</p></div>' +
            '</section>');

        add('page-columns-4', 'Cột 4', 'Bố cục',
            '<section data-page-block="columns-4" style="display:flex;flex-wrap:wrap;gap:20px;max-width:1100px;margin:auto;padding:48px 24px">' +
            '<div style="flex:1 1 180px"><h4>Mục 1</h4><p>Nội dung.</p></div>' +
            '<div style="flex:1 1 180px"><h4>Mục 2</h4><p>Nội dung.</p></div>' +
            '<div style="flex:1 1 180px"><h4>Mục 3</h4><p>Nội dung.</p></div>' +
            '<div style="flex:1 1 180px"><h4>Mục 4</h4><p>Nội dung.</p></div>' +
            '</section>');

        add('page-spacer', 'Khoảng trắng', 'Bố cục',
            '<div data-page-block="spacer" style="height:64px"></div>');

        add('page-divider', 'Đường phân cách', 'Bố cục',
            '<hr data-page-block="divider" style="margin:32px auto;max-width:1100px;border:0;border-top:1px solid #ddd">');

        // ---- Nội dung ------------------------------------------------------
        add('page-hero', 'Hero', 'Nội dung',
            '<section data-page-block="hero" style="padding:80px 24px;text-align:center;background:#eef3ff"><h1>Tiêu đề nổi bật</h1><p>Thêm thông điệp chính cho trang.</p><a href="#" style="display:inline-block;padding:12px 24px;background:#5d87ff;color:#fff;text-decoration:none;border-radius:6px">Khám phá</a></section>');

        add('page-heading', 'Tiêu đề', 'Nội dung',
            '<h2 data-page-block="heading" style="max-width:1100px;margin:32px auto;padding:0 24px">Tiêu đề mới</h2>');

        add('page-text', 'Văn bản', 'Nội dung',
            '<section data-page-block="rich-text" style="max-width:1100px;margin:auto;padding:48px 24px"><h2>Tiêu đề nội dung</h2><p>Nhấp đúp để chỉnh sửa nội dung.</p></section>');

        add('page-image-text', 'Ảnh + nội dung', 'Nội dung',
            '<section data-page-block="image-text" style="display:flex;gap:32px;align-items:center;max-width:1100px;margin:auto;padding:48px 24px"><img src="https://placehold.co/600x450?text=K%C3%ADch+th%C6%B0%E1%BB%9Bc+l%C3%BD+t%C6%B0%E1%BB%9Fng:+4:3+(600x450)" alt="" style="width:50%"><div><h2>Tiêu đề</h2><p>Nội dung giới thiệu.</p></div></section>');
 
         add('page-list', 'Danh sách', 'Nội dung',
             '<ul data-page-block="list" style="max-width:900px;margin:32px auto;padding:0 24px 0 48px"><li>Mục thứ nhất</li><li>Mục thứ hai</li><li>Mục thứ ba</li></ul>');
 
         add('page-quote', 'Trích dẫn', 'Nội dung',
             '<blockquote data-page-block="quote" style="max-width:800px;margin:32px auto;padding:24px 32px;border-left:4px solid #5d87ff;background:#f7f9fc;font-style:italic">“Nội dung trích dẫn nổi bật.”</blockquote>');
 
         add('page-faq', 'FAQ', 'Nội dung',
             '<section data-page-block="faq" style="max-width:900px;margin:auto;padding:48px 24px"><h2>Câu hỏi thường gặp</h2><details><summary>Câu hỏi thứ nhất</summary><p>Nội dung trả lời.</p></details></section>');
 
         add('page-pricing', 'Bảng giá', 'Nội dung',
             '<section data-page-block="pricing" style="max-width:400px;margin:32px auto;padding:32px;text-align:center;border:1px solid #e0e6ee;border-radius:12px">' +
             '<h3>Gói cơ bản</h3><p style="font-size:32px;font-weight:700">1.000.000đ</p>' +
             '<ul style="list-style:none;padding:0;margin:16px 0"><li>Tính năng 1</li><li>Tính năng 2</li></ul>' +
             '<a href="#" style="display:inline-block;padding:10px 20px;background:#5d87ff;color:#fff;text-decoration:none;border-radius:6px">Chọn gói</a></section>');
 
         add('page-timeline', 'Dòng thời gian', 'Nội dung',
             '<section data-page-block="timeline" style="max-width:900px;margin:32px auto;padding:0 24px">' +
             '<div style="border-left:2px solid #5d87ff;padding-left:20px;margin-bottom:20px"><strong>Bước 1</strong><p>Mô tả bước một.</p></div>' +
             '<div style="border-left:2px solid #5d87ff;padding-left:20px"><strong>Bước 2</strong><p>Mô tả bước hai.</p></div>' +
             '</section>');
 
         // ---- Media ------------------------------------------------------
         add('page-image', 'Ảnh', 'Media', {
             type: 'image',
             attributes: { 'data-page-block': 'image', alt: '', src: 'https://placehold.co/800x600?text=K%C3%ADch+th%C6%B0%E1%BB%9Bc+l%C3%BD+t%C6%B0%E1%BB%9Fng:+4:3+(800x600)+ho%E1%BB%B7c+16:9+(960x540)' },
             style: { display: 'block', 'max-width': '100%', margin: '0 auto' },
         });
 
         add('page-gallery', 'Thư viện ảnh', 'Media',
             '<div data-page-block="gallery" style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;max-width:1100px;margin:32px auto;padding:0 24px">' +
             '<img src="https://placehold.co/400x300?text=K%C3%ADch+th%C6%B0%E1%BB%9Bc+l%C3%BD+t%C6%B0%E1%BB%9Fng:+4:3" alt="" style="width:100%;border-radius:8px">' +
             '<img src="https://placehold.co/400x300?text=K%C3%ADch+th%C6%B0%E1%BB%9Bc+l%C3%BD+t%C6%B0%E1%BB%9Fng:+4:3" alt="" style="width:100%;border-radius:8px">' +
             '<img src="https://placehold.co/400x300?text=K%C3%ADch+th%C6%B0%E1%BB%9Bc+l%C3%BD+t%C6%B0%E1%BB%9Fng:+4:3" alt="" style="width:100%;border-radius:8px">' +
             '</div>');
 
         add('page-image-bg', 'Ảnh nền có chữ', 'Media',
             '<section data-page-block="image-bg" style="position:relative;padding:100px 24px;text-align:center;background:#243447 url(https://placehold.co/1920x600?text=K%C3%ADch+th%C6%B0%E1%BB%9Bc+l%C3%BD+t%C6%B0%E1%BB%9Fng:+1920x600+(16:5)) center/cover;color:#fff">' +
             '<h2 style="margin:0">Tiêu đề trên ảnh nền</h2><p>Mô tả ngắn gọn.</p></section>');

        add('page-video', 'Video (YouTube)', 'Media',
            '<div data-page-block="video" style="max-width:800px;margin:32px auto;padding:0 24px">' +
            '<iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" width="100%" height="450" style="border:0;border-radius:8px" allowfullscreen></iframe>' +
            '</div>');

        // ---- Marketing ------------------------------------------------------
        add('page-cta', 'CTA', 'Marketing',
            '<section data-page-block="cta" style="padding:48px 24px;text-align:center;background:#263445;color:#fff"><h2>Bắt đầu ngay hôm nay</h2><p>Thêm lời kêu gọi hành động.</p><a href="#" style="color:#fff">Liên hệ ngay</a></section>');

        add('page-features-3', 'Tính năng 3 cột', 'Marketing',
            '<section data-page-block="features-3" style="display:flex;flex-wrap:wrap;gap:24px;max-width:1100px;margin:auto;padding:48px 24px;text-align:center">' +
            '<div style="flex:1 1 220px"><h3>Tính năng 1</h3><p>Mô tả ngắn gọn.</p></div>' +
            '<div style="flex:1 1 220px"><h3>Tính năng 2</h3><p>Mô tả ngắn gọn.</p></div>' +
            '<div style="flex:1 1 220px"><h3>Tính năng 3</h3><p>Mô tả ngắn gọn.</p></div>' +
            '</section>');

        add('page-testimonial', 'Đánh giá khách hàng', 'Marketing',
            '<section data-page-block="testimonial" style="max-width:700px;margin:32px auto;padding:32px;text-align:center;background:#f7f9fc;border-radius:12px">' +
            '<p style="font-style:italic">“Sản phẩm và dịch vụ rất tốt.”</p><strong>Tên khách hàng</strong></section>');

        add('page-logos', 'Logo đối tác', 'Marketing',
            '<div data-page-block="logos" style="display:flex;flex-wrap:wrap;gap:32px;justify-content:center;align-items:center;max-width:1100px;margin:32px auto;padding:0 24px">' +
            '<img src="https://placehold.co/140x60?text=Logo" alt="" style="opacity:.7">' +
            '<img src="https://placehold.co/140x60?text=Logo" alt="" style="opacity:.7">' +
            '<img src="https://placehold.co/140x60?text=Logo" alt="" style="opacity:.7">' +
            '</div>');

        add('page-counter', 'Số liệu nổi bật', 'Marketing',
            '<section data-page-block="counter" style="display:flex;flex-wrap:wrap;gap:24px;justify-content:center;text-align:center;max-width:900px;margin:32px auto;padding:0 24px">' +
            '<div><div style="font-size:32px;font-weight:700;color:#5d87ff">500+</div><div>Khách hàng</div></div>' +
            '<div><div style="font-size:32px;font-weight:700;color:#5d87ff">1.200+</div><div>Đơn hàng</div></div>' +
            '<div><div style="font-size:32px;font-weight:700;color:#5d87ff">10</div><div>Năm kinh nghiệm</div></div>' +
            '</section>');

        // ---- Cửa hàng (section động — tự cập nhật theo dữ liệu thật) --------
        add('page-products-latest', 'Sản phẩm mới nhất', 'Cửa hàng',
            '<section data-page-block="product-grid" data-query="latest" data-category="" data-limit="8" style="padding:48px 24px"><h2 style="text-align:center">Sản phẩm mới nhất</h2>'
            + '<div class="product-grid-placeholder" style="display:grid; grid-template-columns:repeat(auto-fill, minmax(220px, 1fr)); gap:24px; padding:16px 0;">'
            + '<div style="background:#ffffff; border:1px dashed #cbd5e1; border-radius:16px; padding:16px; text-align:center; display:flex; flex-direction:column; justify-content:center; align-items:center;">'
            + '<div style="width:100%; padding-bottom:85%; background:#f1f5f9; border-radius:12px; margin-bottom:12px; position:relative;"><span style="position:absolute; top:8px; left:8px; background:#e2e8f0; width:50px; height:16px; border-radius:9999px; z-index:2;"></span><div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font-size:11px; color:#94a3b8; font-weight:700; font-family:sans-serif;">Tỷ lệ: 3:4 / 4:5</div></div>'
            + '<div style="width:80%; height:16px; background:#e2e8f0; border-radius:4px; margin-bottom:8px;"></div>'
            + '<div style="width:50%; height:14px; background:#eff6ff; border-radius:4px;"></div></div>'
            + '<div style="background:#ffffff; border:1px dashed #cbd5e1; border-radius:16px; padding:16px; text-align:center; display:flex; flex-direction:column; justify-content:center; align-items:center;">'
            + '<div style="width:100%; padding-bottom:85%; background:#f1f5f9; border-radius:12px; margin-bottom:12px; position:relative;"><span style="position:absolute; top:8px; left:8px; background:#e2e8f0; width:50px; height:16px; border-radius:9999px; z-index:2;"></span><div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font-size:11px; color:#94a3b8; font-weight:700; font-family:sans-serif;">Tỷ lệ: 3:4 / 4:5</div></div>'
            + '<div style="width:80%; height:16px; background:#e2e8f0; border-radius:4px; margin-bottom:8px;"></div>'
            + '<div style="width:50%; height:14px; background:#eff6ff; border-radius:4px;"></div></div>'
            + '<div style="background:#ffffff; border:1px dashed #cbd5e1; border-radius:16px; padding:16px; text-align:center; display:flex; flex-direction:column; justify-content:center; align-items:center;">'
            + '<div style="width:100%; padding-bottom:85%; background:#f1f5f9; border-radius:12px; margin-bottom:12px; position:relative;"><span style="position:absolute; top:8px; left:8px; background:#e2e8f0; width:50px; height:16px; border-radius:9999px; z-index:2;"></span><div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font-size:11px; color:#94a3b8; font-weight:700; font-family:sans-serif;">Tỷ lệ: 3:4 / 4:5</div></div>'
            + '<div style="width:80%; height:16px; background:#e2e8f0; border-radius:4px; margin-bottom:8px;"></div>'
            + '<div style="width:50%; height:14px; background:#eff6ff; border-radius:4px;"></div></div>'
            + '<div style="background:#ffffff; border:1px dashed #cbd5e1; border-radius:16px; padding:16px; text-align:center; display:flex; flex-direction:column; justify-content:center; align-items:center;">'
            + '<div style="width:50%; height:14px; background:#eff6ff; border-radius:4px;"></div></div></div>'
            + '</section>');

         add('page-products-tabs', 'Tab sản phẩm (Động)', 'Cửa hàng',
            '<section data-page-block="product-tabs" data-limit="12" style="padding:48px 24px"><h2 style="text-align:center">Sản phẩm Hot Trend</h2>'
            + '<div class="product-tabs-bar" style="display:flex; gap:12px; justify-content:center; margin-bottom:32px;">'
            + '<button class="tab-btn active" data-tab="all">Tất cả</button>'
            + '<button class="tab-btn" data-tab="vat-lieu-cach-nhiet">Vật liệu cách nhiệt</button>'
            + '<button class="tab-btn" data-tab="he-thong-ngoai-troi">Hệ thống ngoài trời</button>'
            + '</div>'
            + '<div class="product-grid-placeholder" style="display:grid; grid-template-columns:repeat(auto-fill, minmax(220px, 1fr)); gap:24px; padding:16px 0;">'
            + '<div style="background:#ffffff; border:1px dashed #cbd5e1; border-radius:16px; padding:16px; text-align:center; display:flex; flex-direction:column; justify-content:center; align-items:center;">'
            + '<div style="width:100%; padding-bottom:85%; background:#f1f5f9; border-radius:12px; margin-bottom:12px; position:relative;"><span style="position:absolute; top:8px; left:8px; background:#e2e8f0; width:50px; height:16px; border-radius:9999px; z-index:2;"></span><div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font-size:11px; color:#94a3b8; font-weight:700; font-family:sans-serif;">Tỷ lệ: 3:4 / 4:5</div></div>'
            + '<div style="width:80%; height:16px; background:#e2e8f0; border-radius:4px; margin-bottom:8px;"></div>'
            + '<div style="width:50%; height:14px; background:#eff6ff; border-radius:4px;"></div></div>'
            + '<div style="background:#ffffff; border:1px dashed #cbd5e1; border-radius:16px; padding:16px; text-align:center; display:flex; flex-direction:column; justify-content:center; align-items:center;">'
            + '<div style="width:100%; padding-bottom:85%; background:#f1f5f9; border-radius:12px; margin-bottom:12px; position:relative;"><span style="position:absolute; top:8px; left:8px; background:#e2e8f0; width:50px; height:16px; border-radius:9999px; z-index:2;"></span><div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font-size:11px; color:#94a3b8; font-weight:700; font-family:sans-serif;">Tỷ lệ: 3:4 / 4:5</div></div>'
            + '<div style="width:80%; height:16px; background:#e2e8f0; border-radius:4px; margin-bottom:8px;"></div>'
            + '<div style="width:50%; height:14px; background:#eff6ff; border-radius:4px;"></div></div>'
            + '<div style="background:#ffffff; border:1px dashed #cbd5e1; border-radius:16px; padding:16px; text-align:center; display:flex; flex-direction:column; justify-content:center; align-items:center;">'
            + '<div style="width:100%; padding-bottom:85%; background:#f1f5f9; border-radius:12px; margin-bottom:12px; position:relative;"><span style="position:absolute; top:8px; left:8px; background:#e2e8f0; width:50px; height:16px; border-radius:9999px; z-index:2;"></span><div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font-size:11px; color:#94a3b8; font-weight:700; font-family:sans-serif;">Tỷ lệ: 3:4 / 4:5</div></div>'
            + '<div style="width:80%; height:16px; background:#e2e8f0; border-radius:4px; margin-bottom:8px;"></div>'
            + '<div style="width:50%; height:14px; background:#eff6ff; border-radius:4px;"></div></div>'
            + '<div style="background:#ffffff; border:1px dashed #cbd5e1; border-radius:16px; padding:16px; text-align:center; display:flex; flex-direction:column; justify-content:center; align-items:center;">'
            + '<div style="width:100%; padding-bottom:85%; background:#f1f5f9; border-radius:12px; margin-bottom:12px; position:relative;"><span style="position:absolute; top:8px; left:8px; background:#e2e8f0; width:50px; height:16px; border-radius:9999px; z-index:2;"></span><div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font-size:11px; color:#94a3b8; font-weight:700; font-family:sans-serif;">Tỷ lệ: 3:4 / 4:5</div></div>'
            + '<div style="width:80%; height:16px; background:#e2e8f0; border-radius:4px; margin-bottom:8px;"></div>'
            + '<div style="width:50%; height:14px; background:#eff6ff; border-radius:4px;"></div></div></div>'
            + '</section>');

         add('page-products-featured', 'Sản phẩm nổi bật', 'Cửa hàng',
            '<section data-page-block="product-grid" data-query="featured" data-category="" data-limit="8" style="padding:48px 24px"><h2 style="text-align:center">Sản phẩm nổi bật</h2>'
            + '<div class="product-grid-placeholder" style="display:grid; grid-template-columns:repeat(auto-fill, minmax(220px, 1fr)); gap:24px; padding:16px 0;">'
            + '<div style="background:#ffffff; border:1px dashed #cbd5e1; border-radius:16px; padding:16px; text-align:center; display:flex; flex-direction:column; justify-content:center; align-items:center;">'
            + '<div style="width:100%; padding-bottom:85%; background:#f1f5f9; border-radius:12px; margin-bottom:12px; position:relative;"><span style="position:absolute; top:8px; left:8px; background:#e2e8f0; width:50px; height:16px; border-radius:9999px; z-index:2;"></span><div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font-size:11px; color:#94a3b8; font-weight:700; font-family:sans-serif;">Tỷ lệ: 3:4 / 4:5</div></div>'
            + '<div style="width:80%; height:16px; background:#e2e8f0; border-radius:4px; margin-bottom:8px;"></div>'
            + '<div style="width:50%; height:14px; background:#eff6ff; border-radius:4px;"></div></div>'
            + '<div style="background:#ffffff; border:1px dashed #cbd5e1; border-radius:16px; padding:16px; text-align:center; display:flex; flex-direction:column; justify-content:center; align-items:center;">'
            + '<div style="width:100%; padding-bottom:85%; background:#f1f5f9; border-radius:12px; margin-bottom:12px; position:relative;"><span style="position:absolute; top:8px; left:8px; background:#e2e8f0; width:50px; height:16px; border-radius:9999px; z-index:2;"></span><div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font-size:11px; color:#94a3b8; font-weight:700; font-family:sans-serif;">Tỷ lệ: 3:4 / 4:5</div></div>'
            + '<div style="width:80%; height:16px; background:#e2e8f0; border-radius:4px; margin-bottom:8px;"></div>'
            + '<div style="width:50%; height:14px; background:#eff6ff; border-radius:4px;"></div></div>'
            + '<div style="background:#ffffff; border:1px dashed #cbd5e1; border-radius:16px; padding:16px; text-align:center; display:flex; flex-direction:column; justify-content:center; align-items:center;">'
            + '<div style="width:100%; padding-bottom:85%; background:#f1f5f9; border-radius:12px; margin-bottom:12px; position:relative;"><span style="position:absolute; top:8px; left:8px; background:#e2e8f0; width:50px; height:16px; border-radius:9999px; z-index:2;"></span><div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font-size:11px; color:#94a3b8; font-weight:700; font-family:sans-serif;">Tỷ lệ: 3:4 / 4:5</div></div>'
            + '<div style="width:80%; height:16px; background:#e2e8f0; border-radius:4px; margin-bottom:8px;"></div>'
            + '<div style="width:50%; height:14px; background:#eff6ff; border-radius:4px;"></div></div>'
            + '<div style="background:#ffffff; border:1px dashed #cbd5e1; border-radius:16px; padding:16px; text-align:center; display:flex; flex-direction:column; justify-content:center; align-items:center;">'
            + '<div style="width:100%; padding-bottom:85%; background:#f1f5f9; border-radius:12px; margin-bottom:12px; position:relative;"><span style="position:absolute; top:8px; left:8px; background:#e2e8f0; width:50px; height:16px; border-radius:9999px; z-index:2;"></span><div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font-size:11px; color:#94a3b8; font-weight:700; font-family:sans-serif;">Tỷ lệ: 3:4 / 4:5</div></div>'
            + '<div style="width:80%; height:16px; background:#e2e8f0; border-radius:4px; margin-bottom:8px;"></div>'
            + '<div style="width:50%; height:14px; background:#eff6ff; border-radius:4px;"></div></div></div>'
            + '</section>');

         add('page-category-grid', 'Danh mục sản phẩm', 'Cửa hàng',
            '<section data-page-block="category-grid" data-limit="8" style="padding:48px 24px"><h2 style="text-align:center">Danh mục nổi bật</h2>'
            + '<div class="category-grid-placeholder" style="display:grid; grid-template-columns:repeat(auto-fill, minmax(160px, 1fr)); gap:24px; padding:16px 0;">'
            + '<div style="text-align:center;"><div style="width:100%; padding-bottom:80%; background:#f1f5f9; border:1px dashed #cbd5e1; border-radius:16px; margin-bottom:8px; position:relative;"><div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font-size:11px; color:#94a3b8; font-weight:700; font-family:sans-serif;">Tỷ lệ: 1:1 / 4:3</div></div><div style="width:60%; height:14px; background:#e2e8f0; border-radius:4px; margin:0 auto;"></div></div>'
            + '<div style="text-align:center;"><div style="width:100%; padding-bottom:80%; background:#f1f5f9; border:1px dashed #cbd5e1; border-radius:16px; margin-bottom:8px; position:relative;"><div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font-size:11px; color:#94a3b8; font-weight:700; font-family:sans-serif;">Tỷ lệ: 1:1 / 4:3</div></div><div style="width:60%; height:14px; background:#e2e8f0; border-radius:4px; margin:0 auto;"></div></div>'
            + '<div style="text-align:center;"><div style="width:100%; padding-bottom:80%; background:#f1f5f9; border:1px dashed #cbd5e1; border-radius:16px; margin-bottom:8px; position:relative;"><div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font-size:11px; color:#94a3b8; font-weight:700; font-family:sans-serif;">Tỷ lệ: 1:1 / 4:3</div></div><div style="width:60%; height:14px; background:#e2e8f0; border-radius:4px; margin:0 auto;"></div></div>'
            + '<div style="text-align:center;"><div style="width:100%; padding-bottom:80%; background:#f1f5f9; border:1px dashed #cbd5e1; border-radius:16px; margin-bottom:8px; position:relative;"><div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font-size:11px; color:#94a3b8; font-weight:700; font-family:sans-serif;">Tỷ lệ: 1:1 / 4:3</div></div><div style="width:60%; height:14px; background:#e2e8f0; border-radius:4px; margin:0 auto;"></div></div></div>'
            + '</section>');

         add('page-posts', 'Bài viết mới nhất', 'Cửa hàng',
            '<section data-page-block="post-list" data-category="" data-limit="3" style="padding:48px 24px"><h2 style="text-align:center">Bài viết mới nhất</h2>'
            + '<div class="post-list-placeholder" style="display:grid; grid-template-columns:repeat(auto-fill, minmax(280px, 1fr)); gap:24px; padding:16px 0;">'
            + '<div style="background:#ffffff; border:1px dashed #cbd5e1; border-radius:16px; overflow:hidden; min-height:240px;"><div style="width:100%; padding-bottom:60%; background:#f1f5f9; border-bottom:1px dashed #cbd5e1; position:relative;"><div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font-size:11px; color:#94a3b8; font-weight:700; font-family:sans-serif;">Tỷ lệ: 16:9 / 3:2</div></div><div style="padding:16px;"><div style="width:30%; height:12px; background:#e2e8f0; border-radius:4px; margin-bottom:8px;"></div><div style="width:90%; height:16px; background:#e2e8f0; border-radius:4px; margin-bottom:8px;"></div><div style="width:70%; height:14px; background:#f1f5f9; border-radius:4px;"></div></div></div>'
            + '<div style="background:#ffffff; border:1px dashed #cbd5e1; border-radius:16px; overflow:hidden; min-height:240px;"><div style="width:100%; padding-bottom:60%; background:#f1f5f9; border-bottom:1px dashed #cbd5e1; position:relative;"><div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font-size:11px; color:#94a3b8; font-weight:700; font-family:sans-serif;">Tỷ lệ: 16:9 / 3:2</div></div><div style="padding:16px;"><div style="width:30%; height:12px; background:#e2e8f0; border-radius:4px; margin-bottom:8px;"></div><div style="width:90%; height:16px; background:#e2e8f0; border-radius:4px; margin-bottom:8px;"></div><div style="width:70%; height:14px; background:#f1f5f9; border-radius:4px;"></div></div></div>'
            + '<div style="background:#ffffff; border:1px dashed #cbd5e1; border-radius:16px; overflow:hidden; min-height:240px;"><div style="width:100%; padding-bottom:60%; background:#f1f5f9; border-bottom:1px dashed #cbd5e1; position:relative;"><div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font-size:11px; color:#94a3b8; font-weight:700; font-family:sans-serif;">Tỷ lệ: 16:9 / 3:2</div></div><div style="padding:16px;"><div style="width:30%; height:12px; background:#e2e8f0; border-radius:4px; margin-bottom:8px;"></div><div style="width:90%; height:16px; background:#e2e8f0; border-radius:4px; margin-bottom:8px;"></div><div style="width:70%; height:14px; background:#f1f5f9; border-radius:4px;"></div></div></div></div>'
            + '</section>');
 
         add('page-latest-reviews', 'Đánh giá mới nhất', 'Cửa hàng',
            '<section data-page-block="latest-reviews" data-limit="4" style="padding:48px 24px"><h2 style="text-align:center">Khách hàng nói gì</h2>'
            + '<div class="reviews-placeholder" style="display:grid; grid-template-columns:repeat(auto-fill, minmax(260px, 1fr)); gap:24px; padding:16px 0;">'
            + '<div style="padding:20px; border:1px dashed #cbd5e1; border-radius:16px; background:#ffffff;"><div style="color:#cbd5e1; font-size:16px; margin-bottom:12px;">★★★★★</div><div style="width:90%; height:12px; background:#f1f5f9; border-radius:4px; margin-bottom:8px;"></div><div style="width:70%; height:12px; background:#f1f5f9; border-radius:4px; margin-bottom:16px;"></div><div style="width:40%; height:14px; background:#e2e8f0; border-radius:4px;"></div></div>'
            + '<div style="padding:20px; border:1px dashed #cbd5e1; border-radius:16px; background:#ffffff;"><div style="color:#cbd5e1; font-size:16px; margin-bottom:12px;">★★★★★</div><div style="width:90%; height:12px; background:#f1f5f9; border-radius:4px; margin-bottom:8px;"></div><div style="width:70%; height:12px; background:#f1f5f9; border-radius:4px; margin-bottom:16px;"></div><div style="width:40%; height:14px; background:#e2e8f0; border-radius:4px;"></div></div></div>'
            + '</section>');
 
         add('page-contact-form', 'Form liên hệ', 'Cửa hàng',
            '<section data-page-block="contact-form" style="padding:48px 24px;max-width:600px;margin:auto"><h2 style="text-align:center">Liên hệ với chúng tôi</h2>'
            + '<div class="contact-form-placeholder" style="display:flex; flex-direction:column; gap:16px; max-width:500px; margin:0 auto; padding:16px 0;">'
            + '<div style="width:100%; height:40px; background:#f8fafc; border:1px dashed #cbd5e1; border-radius:8px;"></div>'
            + '<div style="width:100%; height:40px; background:#f8fafc; border:1px dashed #cbd5e1; border-radius:8px;"></div>'
            + '<div style="width:100%; height:40px; background:#f8fafc; border:1px dashed #cbd5e1; border-radius:8px;"></div>'
            + '<div style="width:100%; height:100px; background:#f8fafc; border:1px dashed #cbd5e1; border-radius:8px;"></div>'
            + '<div style="width:100%; height:44px; background:#e2e8f0; border-radius:8px;"></div></div>'
            + '</section>');

        add('page-shared-block', 'Khối dùng chung', 'Bố cục',
            '<div data-page-block="partial" data-partial-id="" style="padding:24px;text-align:center;border:1px dashed #5d87ff;color:#5d87ff">'
            + 'Chọn khối dùng chung ở bảng Cài đặt (Settings) bên phải →</div>');
    }

    global.registerPageBuilderBlocks = registerPageBuilderBlocks;
})(window);
