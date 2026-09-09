<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Page;
use App\Services\PageBuilderService;

$slug = 'test-builder';

// Check if page already exists
$existing = Page::where('slug', $slug)->first();
if ($existing) {
    echo "Existing page found (ID: {$existing->id}), deleting to recreate fresh...\n";
    $existing->forceDelete();
}

$html = <<<'HTML'
<div class="test-builder-page">
    <!-- SECTION 1: HERO SECTION -->
    <section class="builder-section hero-banner" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%); color: #ffffff; padding: 100px 20px 90px; text-align: center; position: relative; overflow: hidden;">
        <div class="container" style="max-width: 1140px; margin: 0 auto; position: relative; z-index: 2;">
            <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(227, 35, 38, 0.15); border: 1px solid rgba(227, 35, 38, 0.4); padding: 6px 18px; border-radius: 50px; font-size: 13px; font-weight: 600; color: #ff6b6b; margin-bottom: 24px; text-transform: uppercase; letter-spacing: 1px;">
                <span>⚡ UI/UX BUILDER TEST PLAYGROUND</span>
            </div>
            <h1 style="font-size: 48px; font-weight: 800; line-height: 1.2; margin-bottom: 20px; color: #ffffff; font-family: inherit;">
                Trang Thử Nghiệm Tính Năng <span style="background: linear-gradient(90deg, #e32326, #f97316); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">UI/UX Builder</span>
            </h1>
            <p style="font-size: 18px; line-height: 1.6; color: #cbd5e1; max-width: 780px; margin: 0 auto 36px;">
                Trang mẫu toàn diện được thiết kế để kiểm thử 100% các thành phần của trình biên tập trực quan: Hệ thống cột, Khung lưới Flexbox, Typography, Ảnh & Media, Thẻ dịch vụ, Bảng giá, Form liên hệ, và Khối nhúng Custom HTML.
            </p>
            <div style="display: flex; justify-content: center; gap: 16px; flex-wrap: wrap;">
                <a href="#section-layout" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 8px; background: #e32326; color: #ffffff; padding: 14px 28px; border-radius: 6px; font-weight: 700; text-decoration: none; font-size: 15px; box-shadow: 0 4px 14px rgba(227, 35, 38, 0.4); transition: all 0.2s ease;">
                    <span>Khám phá tính năng</span>
                    <span>↓</span>
                </a>
                <a href="#section-form" class="btn btn-outline" style="display: inline-flex; align-items: center; gap: 8px; background: transparent; color: #ffffff; border: 2px solid rgba(255,255,255,0.3); padding: 12px 26px; border-radius: 6px; font-weight: 600; text-decoration: none; font-size: 15px; transition: all 0.2s ease;">
                    <span>Thử nghiệm Form</span>
                </a>
            </div>
        </div>
    </section>

    <!-- SECTION 2: BỐ CỤC ĐA CỘT & FLEXBOX -->
    <section id="section-layout" class="builder-section" style="padding: 80px 20px; background: #f8fafc;">
        <div class="container" style="max-width: 1140px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 50px;">
                <span style="color: #e32326; font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">01. HỆ THỐNG BỐ CỤC</span>
                <h2 style="font-size: 36px; font-weight: 800; color: #0f172a; margin-top: 8px;">Cột, Khung lưới & Flexbox Stack</h2>
                <p style="color: #64748b; font-size: 16px; max-width: 650px; margin: 10px auto 0;">Kiểm tra khả năng kéo thả, căn chỉnh độ rộng cột, lề trong lề ngoài và tự động co giãn trên mọi màn hình.</p>
            </div>

            <!-- 2-Column Row (50% / 50%) -->
            <div style="display: flex; flex-wrap: wrap; margin: -15px; margin-bottom: 30px;">
                <div style="flex: 1 1 50%; min-width: 300px; padding: 15px; box-sizing: border-box;">
                    <div style="background: #ffffff; padding: 36px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); height: 100%; box-sizing: border-box;">
                        <span style="display: inline-block; background: #e0f2fe; color: #0369a1; padding: 4px 12px; border-radius: 4px; font-size: 12px; font-weight: 700; margin-bottom: 12px;">CỘT 1 / 2 (50%)</span>
                        <h3 style="font-size: 22px; font-weight: 700; color: #1e293b; margin-bottom: 12px;">Bố cục 2 Cột Linh Hoạt</h3>
                        <p style="color: #64748b; line-height: 1.6; margin-bottom: 16px;">Khối nội dung bên trái lý tưởng cho phần tiêu đề, mô tả sản phẩm hoặc giới thiệu dự án. Có thể tuỳ biến padding, màu nền, viền và đổ bóng trong Style Manager.</p>
                        <a href="#" style="color: #e32326; font-weight: 700; text-decoration: none; font-size: 14px;">Tìm hiểu thêm →</a>
                    </div>
                </div>
                <div style="flex: 1 1 50%; min-width: 300px; padding: 15px; box-sizing: border-box;">
                    <div style="background: #ffffff; padding: 36px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); height: 100%; box-sizing: border-box;">
                        <span style="display: inline-block; background: #fef3c7; color: #b45309; padding: 4px 12px; border-radius: 4px; font-size: 12px; font-weight: 700; margin-bottom: 12px;">CỘT 2 / 2 (50%)</span>
                        <h3 style="font-size: 22px; font-weight: 700; color: #1e293b; margin-bottom: 12px;">Tuỳ Biến Nhanh Chóng</h3>
                        <p style="color: #64748b; line-height: 1.6; margin-bottom: 16px;">Khối nội dung bên phải có thể chứa biểu đồ, danh sách tính năng hoặc hình ảnh minh hoạ. Thử nghiệm kéo thả đổi chỗ 2 cột qua lại trong Builder.</p>
                        <a href="#" style="color: #e32326; font-weight: 700; text-decoration: none; font-size: 14px;">Tìm hiểu thêm →</a>
                    </div>
                </div>
            </div>

            <!-- 3-Column Row (33.33%) -->
            <div style="display: flex; flex-wrap: wrap; margin: -15px; margin-bottom: 40px;">
                <div style="flex: 1 1 33.333%; min-width: 280px; padding: 15px; box-sizing: border-box;">
                    <div style="background: #ffffff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; text-align: center; height: 100%; box-sizing: border-box;">
                        <div style="width: 56px; height: 56px; background: #fef2f2; color: #e32326; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 24px;">🎯</div>
                        <h4 style="font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 10px;">Thiết Kế Trực Quan</h4>
                        <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin: 0;">Xem ngay kết quả hiển thị thời gian thực theo chuẩn WYSIWYG trên Desktop, Tablet và Mobile.</p>
                    </div>
                </div>
                <div style="flex: 1 1 33.333%; min-width: 280px; padding: 15px; box-sizing: border-box;">
                    <div style="background: #ffffff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; text-align: center; height: 100%; box-sizing: border-box;">
                        <div style="width: 56px; height: 56px; background: #ecfdf5; color: #059669; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 24px;">⚡</div>
                        <h4 style="font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 10px;">Tốc Độ Vượt Trội</h4>
                        <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin: 0;">Kiến trúc nhẹ, tải tức thì không giật lag, tự động quản lý phiên bản và khôi phục revision an toàn.</p>
                    </div>
                </div>
                <div style="flex: 1 1 33.333%; min-width: 280px; padding: 15px; box-sizing: border-box;">
                    <div style="background: #ffffff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; text-align: center; height: 100%; box-sizing: border-box;">
                        <div style="width: 56px; height: 56px; background: #eff6ff; color: #2563eb; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 24px;">🛡️</div>
                        <h4 style="font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 10px;">Bảo Mật & Chuẩn Hóa</h4>
                        <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin: 0;">Lọc mã độc XSS tự động, bảo toàn cấu trúc layout gốc và tương thích 100% với hệ thống đa ngôn ngữ.</p>
                    </div>
                </div>
            </div>

            <!-- 4-Column Stat Counters -->
            <div style="display: flex; flex-wrap: wrap; margin: -10px; background: #0f172a; border-radius: 16px; padding: 30px; color: #ffffff;">
                <div style="flex: 1 1 25%; min-width: 200px; padding: 15px; text-align: center; box-sizing: border-box;">
                    <div style="font-size: 40px; font-weight: 800; color: #e32326; margin-bottom: 4px;">120+</div>
                    <div style="font-size: 14px; color: #94a3b8; font-weight: 500;">Dự Án Chiếu Sáng</div>
                </div>
                <div style="flex: 1 1 25%; min-width: 200px; padding: 15px; text-align: center; box-sizing: border-box;">
                    <div style="font-size: 40px; font-weight: 800; color: #f59e0b; margin-bottom: 4px;">45+</div>
                    <div style="font-size: 14px; color: #94a3b8; font-weight: 500;">Đối Tác Quốc Tế</div>
                </div>
                <div style="flex: 1 1 25%; min-width: 200px; padding: 15px; text-align: center; box-sizing: border-box;">
                    <div style="font-size: 40px; font-weight: 800; color: #10b981; margin-bottom: 4px;">18+</div>
                    <div style="font-size: 14px; color: #94a3b8; font-weight: 500;">Năm Kinh Nghiệm</div>
                </div>
                <div style="flex: 1 1 25%; min-width: 200px; padding: 15px; text-align: center; box-sizing: border-box;">
                    <div style="font-size: 40px; font-weight: 800; color: #3b82f6; margin-bottom: 4px;">24/7</div>
                    <div style="font-size: 14px; color: #94a3b8; font-weight: 500;">Hỗ Trợ Kỹ Thuật</div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: TYPOGRAPHY & ĐỊNH DẠNG NỘI DUNG -->
    <section class="builder-section" style="padding: 80px 20px; background: #ffffff;">
        <div class="container" style="max-width: 1140px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 50px;">
                <span style="color: #e32326; font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">02. TYPOGRAPHY</span>
                <h2 style="font-size: 36px; font-weight: 800; color: #0f172a; margin-top: 8px;">Tiêu đề, Đoạn văn & Trích dẫn</h2>
                <p style="color: #64748b; font-size: 16px; max-width: 650px; margin: 10px auto 0;">Kiểm tra thanh công cụ soạn thảo trực tiếp (RTE), thay đổi font size, căn lề, màu chữ và định dạng inline.</p>
            </div>

            <div style="display: flex; flex-wrap: wrap; margin: -20px;">
                <!-- Left: Headings H1-H6 -->
                <div style="flex: 1 1 50%; min-width: 320px; padding: 20px; box-sizing: border-box;">
                    <h3 style="font-size: 20px; font-weight: 700; color: #0f172a; border-bottom: 2px solid #e2e8f0; padding-bottom: 12px; margin-bottom: 20px;">Các Cấp Độ Tiêu Đề (H1 - H6)</h3>
                    <h1 style="font-size: 32px; font-weight: 800; color: #0f172a; margin: 12px 0;">Heading 1 - Tiêu đề chính trang web</h1>
                    <h2 style="font-size: 26px; font-weight: 700; color: #1e293b; margin: 12px 0;">Heading 2 - Tiêu đề phân đoạn lớn</h2>
                    <h3 style="font-size: 22px; font-weight: 700; color: #334155; margin: 12px 0;">Heading 3 - Tiêu đề khối chức năng</h3>
                    <h4 style="font-size: 18px; font-weight: 600; color: #475569; margin: 12px 0;">Heading 4 - Tiêu đề nhóm nội dung nhỏ</h4>
                    <h5 style="font-size: 16px; font-weight: 600; color: #64748b; margin: 12px 0;">Heading 5 - Tiêu đề phụ hoặc nhãn chuyên mục</h5>
                    <h6 style="font-size: 14px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin: 12px 0;">Heading 6 - Tiêu đề cấp nhỏ nhất</h6>
                </div>

                <!-- Right: Rich Text & Blockquote -->
                <div style="flex: 1 1 50%; min-width: 320px; padding: 20px; box-sizing: border-box;">
                    <h3 style="font-size: 20px; font-weight: 700; color: #0f172a; border-bottom: 2px solid #e2e8f0; padding-bottom: 12px; margin-bottom: 20px;">Đoạn Văn & Trích Dẫn Phong Cách</h3>
                    <p style="font-size: 16px; line-height: 1.8; color: #334155; margin-bottom: 16px;">
                        Đoạn văn thông thường hỗ trợ đầy đủ các định dạng như <strong>chữ in đậm</strong>, <em>chữ in nghiêng</em>, <u>gạch chân</u>, cùng với <a href="#" style="color: #e32326; text-decoration: underline;">liên kết văn bản có thể click</a> và các thẻ mã nội dòng <code style="background: #f1f5f9; color: #e11d48; padding: 2px 6px; border-radius: 4px; font-size: 14px;">inline code</code>.
                    </p>
                    
                    <!-- Blockquote -->
                    <blockquote style="margin: 20px 0; padding: 18px 24px; background: #fff5f5; border-left: 4px solid #e32326; border-radius: 0 8px 8px 0;">
                        <p style="font-size: 17px; font-style: italic; color: #1e293b; line-height: 1.6; margin: 0 0 8px;">
                            "Ánh sáng không chỉ đơn thuần là thắp sáng không gian, đó là nghệ thuật tôn vinh cảm xúc và kiến trúc trường tồn theo thời gian."
                        </p>
                        <cite style="font-size: 13px; font-weight: 700; color: #e32326; text-transform: uppercase; letter-spacing: 0.5px;">— Giám đốc thiết kế LuxLight</cite>
                    </blockquote>

                    <!-- Checklist -->
                    <ul style="list-style: none; padding: 0; margin: 20px 0;">
                        <li style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; font-size: 15px; color: #334155;">
                            <span style="color: #10b981; font-weight: bold;">✓</span> Hỗ trợ font chữ tiếng Việt không lỗi font
                        </li>
                        <li style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; font-size: 15px; color: #334155;">
                            <span style="color: #10b981; font-weight: bold;">✓</span> Tự động tương thích với bộ gõ Unikey/EVKey
                        </li>
                        <li style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; font-size: 15px; color: #334155;">
                            <span style="color: #10b981; font-weight: bold;">✓</span> Lưu trữ dữ liệu đa ngôn ngữ VI, EN, KO độc lập
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 4: MEDIA & HÌNH ẢNH (KIỂM TRA BẬC CAO) -->
    <section class="builder-section" style="padding: 80px 20px; background: #f8fafc;">
        <div class="container" style="max-width: 1140px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 50px;">
                <span style="color: #e32326; font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">03. MEDIA & HÌNH ẢNH</span>
                <h2 style="font-size: 36px; font-weight: 800; color: #0f172a; margin-top: 8px;">Kiểm Thử Khối Ảnh, Thư Viện Media & Video</h2>
                <p style="color: #64748b; font-size: 16px; max-width: 650px; margin: 10px auto 0;">Kiểm tra cơ chế tải ảnh thật, không bị gạch chéo placeholder, hỗ trợ double-click mở Media Picker và bo góc.</p>
            </div>

            <!-- Two Featured Images Side by Side -->
            <div style="display: flex; flex-wrap: wrap; margin: -15px; margin-bottom: 40px;">
                <div style="flex: 1 1 50%; min-width: 320px; padding: 15px; box-sizing: border-box;">
                    <div style="background: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0,0,0,0.06);">
                        <img src="/wp-content/uploads/2021/12/SG-Office-scaled.jpg" alt="Văn phòng LuxLight Singapore" style="width: 100%; height: 350px; object-fit: cover; display: block; transition: transform 0.3s ease;" />
                        <div style="padding: 24px;">
                            <span style="background: #eff6ff; color: #1d4ed8; font-size: 12px; font-weight: 700; padding: 4px 10px; border-radius: 4px;">ẢNH PROJECT 1</span>
                            <h3 style="font-size: 20px; font-weight: 700; color: #0f172a; margin: 10px 0 8px;">Văn Phòng Trụ Sở Singapore</h3>
                            <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin: 0;">Kiểm tra ảnh tỷ lệ lớn, chiều cao 350px, object-fit cover sắc nét không bị vỡ khung hình.</p>
                        </div>
                    </div>
                </div>

                <div style="flex: 1 1 50%; min-width: 320px; padding: 15px; box-sizing: border-box;">
                    <div style="background: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0,0,0,0.06);">
                        <img src="/wp-content/uploads/2021/12/All-Day-Dining-5.jpg" alt="Dự án Nhà hàng Đèn Chùm" style="width: 100%; height: 350px; object-fit: cover; display: block; transition: transform 0.3s ease;" />
                        <div style="padding: 24px;">
                            <span style="background: #fef2f2; color: #b91c1c; font-size: 12px; font-weight: 700; padding: 4px 10px; border-radius: 4px;">ẢNH PROJECT 2</span>
                            <h3 style="font-size: 20px; font-weight: 700; color: #0f172a; margin: 10px 0 8px;">Hệ Thống Chiếu Sáng All-Day Dining</h3>
                            <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin: 0;">Kiểm tra ảnh nghệ thuật ẩm thực sang trọng, đảm bảo không bị lỗi placeholder SVG gạch chéo.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Embed Card -->
            <div style="background: #ffffff; padding: 36px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 16px rgba(0,0,0,0.04);">
                <div style="text-align: center; margin-bottom: 24px;">
                    <h3 style="font-size: 22px; font-weight: 700; color: #0f172a;">Video Trình Diễn Dự Án (Responsive Video Embed)</h3>
                    <p style="color: #64748b; font-size: 15px; margin-top: 6px;">Hỗ trợ khung video chuẩn tỷ lệ 16:9, responsive trên mọi kích cỡ màn hình.</p>
                </div>
                <div style="position: relative; padding-bottom: 45%; height: 0; overflow: hidden; border-radius: 10px; background: #000000; box-shadow: 0 4px 20px rgba(0,0,0,0.15);">
                    <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="Project Video" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 5: BẢNG GIÁ & GÓI DỊCH VỤ -->
    <section class="builder-section" style="padding: 80px 20px; background: #ffffff;">
        <div class="container" style="max-width: 1140px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 50px;">
                <span style="color: #e32326; font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">04. BẢNG GIÁ & DỊCH VỤ</span>
                <h2 style="font-size: 36px; font-weight: 800; color: #0f172a; margin-top: 8px;">Các Gói Giải Pháp Chiếu Sáng</h2>
                <p style="color: #64748b; font-size: 16px; max-width: 650px; margin: 10px auto 0;">Kiểm tra thành phần thẻ nổi bật (featured card), định dạng giá tiền, huy hiệu và nút bấm mua hàng.</p>
            </div>

            <div style="display: flex; flex-wrap: wrap; margin: -15px; align-items: stretch;">
                <!-- Basic Card -->
                <div style="flex: 1 1 33.333%; min-width: 300px; padding: 15px; box-sizing: border-box;">
                    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 36px 30px; text-align: center; height: 100%; box-sizing: border-box; display: flex; flex-direction: column;">
                        <h3 style="font-size: 20px; font-weight: 700; color: #0f172a; margin-bottom: 8px;">Gói Tiêu Chuẩn</h3>
                        <p style="color: #64748b; font-size: 14px; margin-bottom: 24px;">Phù hợp cho căn hộ & nhà phố hiện đại</p>
                        <div style="font-size: 36px; font-weight: 800; color: #0f172a; margin-bottom: 24px;">
                            25.000.000 <span style="font-size: 14px; font-weight: 500; color: #64748b;">₫</span>
                        </div>
                        <ul style="list-style: none; padding: 0; margin: 0 0 30px; text-align: left; font-size: 14px; color: #334155; flex-grow: 1;">
                            <li style="padding: 8px 0; border-bottom: 1px solid #f1f5f9;">✓ Tư vấn thiết kế sơ bộ 2D</li>
                            <li style="padding: 8px 0; border-bottom: 1px solid #f1f5f9;">✓ Cung cấp thiết bị đèn cơ bản</li>
                            <li style="padding: 8px 0; border-bottom: 1px solid #f1f5f9;">✓ Bảo hành chính hãng 24 tháng</li>
                            <li style="padding: 8px 0; color: #94a3b8;">✕ Hỗ trợ lập trình kịch bản thông minh</li>
                        </ul>
                        <a href="#" style="display: block; width: 100%; padding: 12px 0; background: #f1f5f9; color: #0f172a; font-weight: 700; border-radius: 6px; text-decoration: none; font-size: 14px;">Chọn Gói Này</a>
                    </div>
                </div>

                <!-- Featured Card -->
                <div style="flex: 1 1 33.333%; min-width: 300px; padding: 15px; box-sizing: border-box;">
                    <div style="background: #ffffff; border: 2px solid #e32326; border-radius: 16px; padding: 36px 30px; text-align: center; height: 100%; box-sizing: border-box; display: flex; flex-direction: column; position: relative; box-shadow: 0 10px 25px -5px rgba(227, 35, 38, 0.15);">
                        <div style="position: absolute; top: -14px; left: 50%; transform: translateX(-50%); background: #e32326; color: #ffffff; font-size: 12px; font-weight: 700; padding: 4px 16px; border-radius: 50px; text-transform: uppercase; letter-spacing: 0.5px;">Phổ biến nhất</div>
                        <h3 style="font-size: 20px; font-weight: 700; color: #0f172a; margin-bottom: 8px;">Gói Chuyên Nghiệp</h3>
                        <p style="color: #64748b; font-size: 14px; margin-bottom: 24px;">Biệt thự, Nhà hàng & Khách sạn cao cấp</p>
                        <div style="font-size: 36px; font-weight: 800; color: #e32326; margin-bottom: 24px;">
                            68.000.000 <span style="font-size: 14px; font-weight: 500; color: #64748b;">₫</span>
                        </div>
                        <ul style="list-style: none; padding: 0; margin: 0 0 30px; text-align: left; font-size: 14px; color: #334155; flex-grow: 1;">
                            <li style="padding: 8px 0; border-bottom: 1px solid #f1f5f9;">✓ Thiết kế phối cảnh 3D chuyên sâu</li>
                            <li style="padding: 8px 0; border-bottom: 1px solid #f1f5f9;">✓ Cung cấp đèn kiến trúc thương hiệu cao cấp</li>
                            <li style="padding: 8px 0; border-bottom: 1px solid #f1f5f9;">✓ Lập trình điều khiển thông minh DALI/DMX</li>
                            <li style="padding: 8px 0; border-bottom: 1px solid #f1f5f9;">✓ Bảo hành bảo dưỡng định kỳ 36 tháng</li>
                        </ul>
                        <a href="#" style="display: block; width: 100%; padding: 12px 0; background: #e32326; color: #ffffff; font-weight: 700; border-radius: 6px; text-decoration: none; font-size: 14px; box-shadow: 0 4px 12px rgba(227, 35, 38, 0.35);">Đăng Ký Ngay</a>
                    </div>
                </div>

                <!-- Premium Card -->
                <div style="flex: 1 1 33.333%; min-width: 300px; padding: 15px; box-sizing: border-box;">
                    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 36px 30px; text-align: center; height: 100%; box-sizing: border-box; display: flex; flex-direction: column;">
                        <h3 style="font-size: 20px; font-weight: 700; color: #0f172a; margin-bottom: 8px;">Gói Doanh Nghiệp</h3>
                        <p style="color: #64748b; font-size: 14px; margin-bottom: 24px;">Toà nhà phức hợp & Công trình biểu tượng</p>
                        <div style="font-size: 36px; font-weight: 800; color: #0f172a; margin-bottom: 24px;">
                            Liên Hệ <span style="font-size: 14px; font-weight: 500; color: #64748b;">(Báo giá)</span>
                        </div>
                        <ul style="list-style: none; padding: 0; margin: 0 0 30px; text-align: left; font-size: 14px; color: #334155; flex-grow: 1;">
                            <li style="padding: 8px 0; border-bottom: 1px solid #f1f5f9;">✓ Tư vấn giải pháp chiếu sáng tổng thể</li>
                            <li style="padding: 8px 0; border-bottom: 1px solid #f1f5f9;">✓ Nhập khẩu trực tiếp đèn độc quyền châu Âu</li>
                            <li style="padding: 8px 0; border-bottom: 1px solid #f1f5f9;">✓ Giám sát lắp đặt kỹ thuật onsite toàn dự án</li>
                            <li style="padding: 8px 0; border-bottom: 1px solid #f1f5f9;">✓ Bảo hành trọn gói 5 năm chuẩn 5 sao</li>
                        </ul>
                        <a href="#" style="display: block; width: 100%; padding: 12px 0; background: #f1f5f9; color: #0f172a; font-weight: 700; border-radius: 6px; text-decoration: none; font-size: 14px;">Tư Vấn Riêng</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 6: FORM TƯƠNG TÁC & NÚT BẤM -->
    <section id="section-form" class="builder-section" style="padding: 80px 20px; background: #f8fafc;">
        <div class="container" style="max-width: 900px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 40px;">
                <span style="color: #e32326; font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">05. FORM & NÚT BẤM</span>
                <h2 style="font-size: 36px; font-weight: 800; color: #0f172a; margin-top: 8px;">Form Đăng Ký & Các Loại Nút Bấm</h2>
                <p style="color: #64748b; font-size: 16px; margin-top: 10px;">Kiểm tra trường nhập dữ liệu (input), hộp chọn (select), vùng văn bản (textarea) và các kiểu nút bấm.</p>
            </div>

            <!-- Form Container -->
            <div style="background: #ffffff; padding: 40px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 40px;">
                <form action="#" method="POST" onsubmit="return false;">
                    <div style="display: flex; flex-wrap: wrap; margin: -10px; margin-bottom: 15px;">
                        <div style="flex: 1 1 50%; min-width: 250px; padding: 10px; box-sizing: border-box;">
                            <label style="display: block; font-size: 14px; font-weight: 600; color: #334155; margin-bottom: 8px;">Họ và tên *</label>
                            <input type="text" placeholder="Ví dụ: Nguyễn Văn A" style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 15px; box-sizing: border-box; outline: none;" />
                        </div>
                        <div style="flex: 1 1 50%; min-width: 250px; padding: 10px; box-sizing: border-box;">
                            <label style="display: block; font-size: 14px; font-weight: 600; color: #334155; margin-bottom: 8px;">Địa chỉ Email *</label>
                            <input type="email" placeholder="name@example.com" style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 15px; box-sizing: border-box; outline: none;" />
                        </div>
                    </div>

                    <div style="display: flex; flex-wrap: wrap; margin: -10px; margin-bottom: 15px;">
                        <div style="flex: 1 1 50%; min-width: 250px; padding: 10px; box-sizing: border-box;">
                            <label style="display: block; font-size: 14px; font-weight: 600; color: #334155; margin-bottom: 8px;">Số điện thoại</label>
                            <input type="tel" placeholder="090 123 4567" style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 15px; box-sizing: border-box; outline: none;" />
                        </div>
                        <div style="flex: 1 1 50%; min-width: 250px; padding: 10px; box-sizing: border-box;">
                            <label style="display: block; font-size: 14px; font-weight: 600; color: #334155; margin-bottom: 8px;">Dịch vụ quan tâm</label>
                            <select style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 15px; box-sizing: border-box; outline: none; background: #ffffff;">
                                <option>Chiếu sáng căn hộ / biệt thự</option>
                                <option>Chiếu sáng khách sạn / resort</option>
                                <option>Chiếu sáng thương mại / văn phòng</option>
                                <option>Đèn trang trí nghệ thuật đặt làm riêng</option>
                            </select>
                        </div>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #334155; margin-bottom: 8px;">Yêu cầu chi tiết</label>
                        <textarea rows="4" placeholder="Nhập ghi chú yêu cầu cụ thể của dự án..." style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 15px; box-sizing: border-box; outline: none; resize: vertical;"></textarea>
                    </div>

                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 24px;">
                        <input type="checkbox" id="check-terms" checked style="width: 18px; height: 18px; accent-color: #e32326;" />
                        <label for="check-terms" style="font-size: 14px; color: #64748b;">Tôi đồng ý nhận thông tin tư vấn và báo giá chi tiết từ LuxLight</label>
                    </div>

                    <button type="submit" class="btn btn-primary" style="background: #e32326; color: #ffffff; padding: 14px 32px; border: 0; border-radius: 6px; font-size: 16px; font-weight: 700; cursor: pointer; box-shadow: 0 4px 12px rgba(227, 35, 38, 0.3);">
                        Gửi Yêu Cầu Tư Vấn Ngay
                    </button>
                </form>
            </div>

            <!-- Button Showcase Palette -->
            <div style="background: #ffffff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; text-align: center;">
                <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 16px;">Bộ Sưu Tập Nút Bấm (Button Styles)</h4>
                <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 12px; align-items: center;">
                    <button type="button" style="background: #e32326; color: #ffffff; padding: 10px 20px; border-radius: 6px; border: 0; font-weight: 600; font-size: 14px; cursor: pointer;">Primary Red</button>
                    <button type="button" style="background: #0f172a; color: #ffffff; padding: 10px 20px; border-radius: 6px; border: 0; font-weight: 600; font-size: 14px; cursor: pointer;">Dark Neutral</button>
                    <button type="button" style="background: #10b981; color: #ffffff; padding: 10px 20px; border-radius: 6px; border: 0; font-weight: 600; font-size: 14px; cursor: pointer;">Success Green</button>
                    <button type="button" style="background: #3b82f6; color: #ffffff; padding: 10px 20px; border-radius: 6px; border: 0; font-weight: 600; font-size: 14px; cursor: pointer;">Info Blue</button>
                    <button type="button" style="background: transparent; border: 2px solid #e32326; color: #e32326; padding: 8px 18px; border-radius: 6px; font-weight: 600; font-size: 14px; cursor: pointer;">Outline Red</button>
                    <button type="button" style="background: #f1f5f9; color: #475569; padding: 10px 20px; border-radius: 6px; border: 0; font-weight: 600; font-size: 14px; cursor: pointer;">Ghost Light</button>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 7: KHỐI CUSTOM HTML NHÚNG TRỰC TIẾP -->
    <section class="builder-section" style="padding: 80px 20px; background: #ffffff;">
        <div class="container" style="max-width: 1140px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 40px;">
                <span style="color: #e32326; font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">06. CUSTOM HTML</span>
                <h2 style="font-size: 36px; font-weight: 800; color: #0f172a; margin-top: 8px;">Khối Nhúng HTML / Widget Tự Do</h2>
                <p style="color: #64748b; font-size: 16px; max-width: 650px; margin: 10px auto 0;">Cho phép nhúng mã nhúng tuỳ ý, iframe bản đồ, banner động hoặc widget từ bên thứ ba.</p>
            </div>

            <div class="builder-custom-embed" style="background: linear-gradient(135deg, #f0fdf4 0%, #e0e7ff 100%); border: 2px dashed #6366f1; border-radius: 16px; padding: 40px; text-align: center;">
                <div style="font-size: 36px; margin-bottom: 12px;">💻 ⚙️ 🚀</div>
                <h3 style="font-size: 22px; font-weight: 700; color: #3730a3; margin-bottom: 8px;">Khối Nhúng HTML Tùy Biến (Custom HTML Block)</h3>
                <p style="color: #4f46e5; max-width: 600px; margin: 0 auto 16px; font-size: 15px; line-height: 1.6;">
                    Bạn có thể click trực tiếp vào khối này trong builder để chỉnh sửa mã nguồn HTML thô hoặc mở rộng bằng các thẻ nhúng của Google Maps, Facebook Pixel, Chat Widget...
                </p>
                <div style="display: inline-block; background: #ffffff; padding: 8px 16px; border-radius: 6px; font-family: monospace; font-size: 13px; color: #4338ca; border: 1px solid #c7d2fe;">
                    &lt;div class="custom-embed"&gt;...&lt;/div&gt;
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 8: CALL TO ACTION BANNER (CTA) -->
    <section class="builder-section" style="padding: 80px 20px; background: linear-gradient(135deg, #e32326 0%, #b91c1c 100%); color: #ffffff; text-align: center;">
        <div class="container" style="max-width: 800px; margin: 0 auto;">
            <h2 style="font-size: 38px; font-weight: 800; margin-bottom: 16px; color: #ffffff;">Sẵn Sàng Kiến Tạo Không Gian Ánh Sáng Hoàn Hảo?</h2>
            <p style="font-size: 18px; line-height: 1.6; color: #fee2e2; margin-bottom: 32px;">
                Hãy liên hệ ngay với đội ngũ chuyên gia tư vấn chiếu sáng của LuxLight để nhận tư vấn và khảo sát công trình miễn phí.
            </p>
            <div style="display: flex; justify-content: center; gap: 16px; flex-wrap: wrap;">
                <a href="/lien-he" style="background: #ffffff; color: #e32326; padding: 14px 32px; border-radius: 6px; font-weight: 700; text-decoration: none; font-size: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">
                    Liên Hệ Ngay
                </a>
                <a href="/du-an" style="background: rgba(255,255,255,0.2); color: #ffffff; border: 2px solid #ffffff; padding: 12px 28px; border-radius: 6px; font-weight: 600; text-decoration: none; font-size: 16px;">
                    Xem Các Dự Án
                </a>
            </div>
        </div>
    </section>
</div>
HTML;

$css = <<<'CSS'
.test-builder-page {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    color: #334155;
}
.test-builder-page .builder-section {
    position: relative;
}
.test-builder-page .btn:hover {
    opacity: 0.92;
    transform: translateY(-1px);
}
CSS;

$pageBuilder = $app->make(PageBuilderService::class);

$pageData = [
    'type' => 'page',
    'title' => [
        'vi' => 'Trang thử nghiệm UI/UX Builder - Đầy đủ tính năng',
        'en' => 'UI/UX Builder Test Playground - All Features',
        'ko' => 'UI/UX 빌더 테스트 페이지 - 전체 기능',
    ],
    'slug' => [
        'vi' => $slug,
        'en' => $slug . '-en',
        'ko' => $slug . '-ko',
    ],
    'is_active' => true,
    'header_mode' => 'inherit',
    'footer_mode' => 'inherit',
    'published_html' => [
        'vi' => $html,
        'en' => $html,
        'ko' => $html,
    ],
    'published_css' => [
        'vi' => $css,
        'en' => $css,
        'ko' => $css,
    ],
    'meta_title' => [
        'vi' => 'Trang thử nghiệm UI/UX Builder - Đầy đủ tính năng',
        'en' => 'UI/UX Builder Test Playground - All Features',
        'ko' => 'UI/UX 빌더 테스트 페이지 - 전체 기능',
    ],
    'meta_description' => [
        'vi' => 'Trang mẫu kiểm tra toàn diện tính năng UI/UX Builder: Grid, Typography, Media, Form, Cards, Custom HTML',
        'en' => 'Test playground for UI/UX Builder: Grid, Typography, Media, Form, Cards, Custom HTML',
        'ko' => 'UI/UX 빌더 테스트 페이지',
    ],
];

$newPage = $pageBuilder->create($pageData);

echo "SUCCESS! Created Page ID: {$newPage->id}\n";
echo "Title: " . json_encode($newPage->getTranslations('title')) . "\n";
echo "Slug: " . $newPage->slug . "\n";
echo "Admin Builder URL: https://revoluxasia796.mbws.vn/vi/admin/pages/{$newPage->id}/builder\n";
echo "Frontend URL: https://revoluxasia796.mbws.vn/{$newPage->slug}\n";
