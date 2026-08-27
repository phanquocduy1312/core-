@extends('layouts.app')

@section('title', 'Hỗ Trợ Kỹ Thuật 24/7 - BÁCH ANH GROUP')

@section('content')
<!-- HERO BANNER -->
  <section class="bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900 text-white py-16 px-4 sm:px-8 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#3b82f6_1px,transparent_1px)] [background-size:16px_16px]"></div>
    <div class="max-w-7xl mx-auto relative z-10 text-center space-y-4">
      <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/20 text-blue-300 text-xs font-bold border border-blue-400/30 uppercase tracking-wider">
        <i class="fas fa-headset text-amber-400"></i> Kỹ Thuật Viên Trực 24/7
      </span>
      <h1 class="text-3xl sm:text-5xl font-extrabold font-heading text-white">Trung Tâm Hỗ Trợ Kỹ Thuật Điện Mặt Trời</h1>
      <p class="text-xs sm:text-base text-slate-300 max-w-3xl mx-auto">
        Tư vấn cấu hình Inverter, hỗ trợ cài đặt giao tiếp BMS Pin Lithium, sơ đồ đấu nối trạm Solar & tra cứu thông tin bảo hành chính hãng từ Bách Anh Group.
      </p>
      <div class="flex justify-center items-center gap-2 text-xs text-slate-400 pt-2">
        <a href="{{ route('home') }}" class="hover:text-white" data-i18n="nav_home">Trang chủ</a>
        <i class="fas fa-chevron-right text-[9px]"></i>
        <span class="text-blue-400" data-i18n="nav_support">Hỗ Trợ Kỹ Thuật</span>
      </div>
    </div>
  </section>

  <!-- 4 QUICK TECHNICAL SERVICES -->
  <section class="py-12 bg-white border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- CARD 1: CÀI ĐẶT INVERTER & BMS -->
        <div class="p-6 bg-slate-50 hover:bg-white rounded-2xl border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all space-y-3 group">
          <div class="w-12 h-12 rounded-xl bg-blue-600 text-white flex items-center justify-center text-xl font-bold shadow-md group-hover:scale-110 transition-transform">
            <i class="fas fa-sliders-h"></i>
          </div>
          <h3 class="font-extrabold text-slate-900 text-base">Cài Đặt Inverter & BMS</h3>
          <p class="text-xs text-slate-600 leading-relaxed">
            Hướng dẫn thiết lập bám tải, ghép song song nhiều Inverter Luxpower/Deye & cài đặt giao tiếp CAN/RS485 với Pin Lithium.
          </p>
        </div>

        <!-- CARD 2: TÀI LIỆU & FIRMWARE -->
        <div class="p-6 bg-slate-50 hover:bg-white rounded-2xl border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all space-y-3 group">
          <div class="w-12 h-12 rounded-xl bg-emerald-600 text-white flex items-center justify-center text-xl font-bold shadow-md group-hover:scale-110 transition-transform">
            <i class="fas fa-file-pdf"></i>
          </div>
          <h3 class="font-extrabold text-slate-900 text-base">Datasheet & Bản Vẽ</h3>
          <p class="text-xs text-slate-600 leading-relaxed">
            Tải về catalog thông số kỹ thuật, bản vẽ CAD khung nhôm, sơ đồ tủ điện AC/DC & Firmware cập nhật mới nhất.
          </p>
        </div>

        <!-- CARD 3: BẢO HÀNH CHÍNH HÃNG -->
        <div class="p-6 bg-slate-50 hover:bg-white rounded-2xl border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all space-y-3 group">
          <div class="w-12 h-12 rounded-xl bg-amber-500 text-white flex items-center justify-center text-xl font-bold shadow-md group-hover:scale-110 transition-transform">
            <i class="fas fa-award"></i>
          </div>
          <h3 class="font-extrabold text-slate-900 text-base">Kích Hoạt Bảo Hành</h3>
          <p class="text-xs text-slate-600 leading-relaxed">
            Tra cứu thời hạn bảo hành 5-10 năm theo mã Serial Number / IMEI tệp biến tần & tấm pin bảo hành 25 năm.
          </p>
        </div>

        <!-- CARD 4: XỬ LÝ SỰ CỐ TẬN NƠI -->
        <div class="p-6 bg-slate-50 hover:bg-white rounded-2xl border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all space-y-3 group">
          <div class="w-12 h-12 rounded-xl bg-purple-600 text-white flex items-center justify-center text-xl font-bold shadow-md group-hover:scale-110 transition-transform">
            <i class="fas fa-truck-monster"></i>
          </div>
          <h3 class="font-extrabold text-slate-900 text-base">Hỗ Trợ Tận Công Trình</h3>
          <p class="text-xs text-slate-600 leading-relaxed">
            Đội ngũ kỹ sư solar có mặt tại công trình xử lý sự cố báo lỗi ngắt mạch, đo kiểm công suất chuỗi PV tận nơi.
          </p>
        </div>

      </div>
    </div>
  </section>

  <!-- SUPPORT FORM & SLA -->
  <section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12">
      
      <!-- SLA COMMITMENTS -->
      <div class="lg:col-span-5 space-y-6">
        <div>
          <span class="text-xs font-extrabold uppercase text-blue-600 tracking-wider bg-blue-100 px-3 py-1 rounded-md">Cam Kết Dịch Vụ</span>
          <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2 font-heading">Cam Kết Thời Gian Xử Lý Sự Cố (SLA 24/7)</h2>
          <p class="text-xs text-slate-600 mt-2">Bách Anh Group duy trì quy trình hỗ trợ kỹ thuật nghiêm ngặt nhằm đảm bảo trạm điện mặt trời hoạt động liên tục không gián đoạn.</p>
        </div>

        <div class="space-y-4">
          <div class="p-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center text-lg flex-shrink-0 shadow">
              <i class="fas fa-clock"></i>
            </div>
            <div>
              <h4 class="font-bold text-slate-900 text-sm">Phản Hồi Hotline Trong 15 Phút</h4>
              <p class="text-xs text-slate-600 mt-1">Kỹ thuật viên chuyên trách tiếp nhận cuộc gọi hotline <strong>0963 982 186</strong> tư vấn hướng xử lý ban đầu ngay lập tức.</p>
            </div>
          </div>

          <div class="p-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center text-lg flex-shrink-0 shadow">
              <i class="fas fa-headset"></i>
            </div>
            <div>
              <h4 class="font-bold text-slate-900 text-sm">Hỗ Trợ Từ Xa Qua UltraViewer / Zalo</h4>
              <p class="text-xs text-slate-600 mt-1">Kết nối cấu hình thông số Inverter & cập nhật firmware trực tuyến qua ứng dụng theo dõi Cloud của hãng.</p>
            </div>
          </div>

          <div class="p-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center text-lg flex-shrink-0 shadow">
              <i class="fas fa-shield-alt"></i>
            </div>
            <div>
              <h4 class="font-bold text-slate-900 text-sm">Đổi Mới 1:1 Linh Kiện Chính Hãng</h4>
              <p class="text-xs text-slate-600 mt-1">Sẵn kho linh kiện board mạch Inverter, bo BMS pin Lithium & thiết bị đo kiểm thay thế chính hãng Bách Anh Group.</p>
            </div>
          </div>
        </div>

        <div class="p-5 bg-blue-600 text-white rounded-2xl shadow-lg space-y-2">
          <h4 class="font-bold text-sm flex items-center gap-2"><i class="fas fa-phone-volume"></i> Hotline Kỹ Thuật Trực Tiếp:</h4>
          <p class="text-2xl font-black font-heading">0963 982 186</p>
          <p class="text-xs opacity-90">Kỹ sư phụ trách: Mr. Lưu Thế Dũng (Zalo 24/7)</p>
        </div>
      </div>

      <!-- TICKET FORM -->
      <div class="lg:col-span-7 bg-white p-6 sm:p-8 rounded-3xl border border-slate-200 shadow-xl space-y-6">
        <div>
          <span class="text-xs font-extrabold uppercase text-blue-600 tracking-wider bg-blue-50 px-3 py-1 rounded-md">Tạo Yêu Cầu Support</span>
          <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 font-heading mt-2">Gửi Yêu Cầu Kỹ Thuật Điện Mặt Trời</h3>
          <p class="text-xs text-slate-500 mt-1">Điền đầy đủ thông tin bên dưới, kỹ sư Bách Anh Group sẽ liên hệ lại trong vòng 15 phút.</p>
        </div>

        <form class="ajax-form space-y-4">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Họ và Tên Quý Khách *</label>
              <input type="text" required placeholder="Nguyễn Văn A" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-600 focus:outline-none text-sm">
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Số Điện Thoại / Zalo *</label>
              <input type="tel" required placeholder="0963 xxx xxx" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-600 focus:outline-none text-sm">
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Thương Hiệu Thiết Bị *</label>
              <select required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-600 focus:outline-none text-sm bg-white">
                <option value="">-- Chọn hãng thiết bị --</option>
                <option value="luxpower">Luxpower (Inverter Hybrid)</option>
                <option value="deye">Deye Solar (Inverter / Battery)</option>
                <option value="growatt">Growatt (Inverter / Battery)</option>
                <option value="solis">Solis (Ginlong)</option>
                <option value="huawei">Huawei FusionSolar</option>
                <option value="pylontech">Pylontech (Pin Lithium)</option>
                <option value="narada">Narada ESS</option>
                <option value="jinko">JinKO Solar (Tấm pin)</option>
                <option value="longi">LONGi Solar (Tấm pin)</option>
                <option value="canadian">Canadian Solar</option>
                <option value="other">Hãng thương hiệu khác</option>
              </select>
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Loại Yêu Cầu *</label>
              <select required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-600 focus:outline-none text-sm bg-white">
                <option value="setup">Hướng dẫn cài đặt bám tải / Wifi</option>
                <option value="bms">Sự cố lỗi giao tiếp BMS Pin Lithium</option>
                <option value="pv">Tư vấn thiết kế chuỗi PV & MPPT</option>
                <option value="warranty">Yêu cầu kích hoạt bảo hành chính hãng</option>
                <option value="repair">Yêu cầu sửa chữa & linh kiện thay thế</option>
              </select>
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Mã Serial / Model Thiết Bị (Nếu Có)</label>
            <input type="text" placeholder="Ví dụ: SNA-5000W-202608xxx" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-600 focus:outline-none text-sm">
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Mô Tả Triệu Chứng Sự Cố Hoặc Yêu Cầu *</label>
            <textarea rows="4" required placeholder="Vui lòng tả rõ hiện tượng máy báo mã lỗi (mã fault code trên màn hình), tiếng kêu hoặc mô tả nhu cầu tư vấn..." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-600 focus:outline-none text-sm"></textarea>
          </div>

          <button type="submit" class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl shadow-lg shadow-blue-600/20 transition-all text-sm uppercase tracking-wider flex items-center justify-center gap-2 cursor-pointer">
            <i class="fas fa-paper-plane"></i> Gửi Yêu Cầu Kỹ Thuật 24/7
          </button>
        </form>
      </div>

    </div>
  </section>

  <!-- FAQ TECHNICAL KNOWLEDGE BASE -->
  <section class="py-16 bg-white border-t border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 space-y-10">
      <div class="text-center space-y-2">
        <span class="text-xs font-extrabold uppercase text-blue-600 tracking-wider bg-blue-50 px-3 py-1 rounded-md">Hỏi Đáp Kỹ Thuật</span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-heading">Câu Hỏi Kỹ Thuật Điện Mặt Trời Thường Gặp</h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- FAQ 1 -->
        <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200/80 space-y-2">
          <h4 class="font-bold text-slate-900 text-sm flex items-center gap-2">
            <i class="fas fa-question-circle text-blue-600"></i> Cách xử lý khi Inverter Luxpower báo lỗi giao tiếp BMS pin Lithium?
          </h4>
          <p class="text-xs text-slate-600 leading-relaxed">
            Kiểm tra cáp mạng RJ45 cắm đúng cổng CAN/RS485 giữa Luxpower và pin (Pylontech/Narada/Hina ESS). Kiểm tra gạt mã DIP switch trên pin đúng chuẩn giao tiếp Luxpower (thường là CAN Bus protocol).
          </p>
        </div>

        <!-- FAQ 2 -->
        <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200/80 space-y-2">
          <h4 class="font-bold text-slate-900 text-sm flex items-center gap-2">
            <i class="fas fa-question-circle text-blue-600"></i> Cách cài đặt chức năng chống ngược lưới (Zero Export) cho Inverter Deye / Solis?
          </h4>
          <p class="text-xs text-slate-600 leading-relaxed">
            Vào menu <em>Grid Management / Advanced Settings</em> trên màn hình cảm ứng, bật chế độ <strong>Zero Export / Zero Feed-in</strong>, kết nối cảm biến dòng CT Clamp vào đường dây nguồn tổng AC trước Aptomat chính.
          </p>
        </div>

        <!-- FAQ 3 -->
        <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200/80 space-y-2">
          <h4 class="font-bold text-slate-900 text-sm flex items-center gap-2">
            <i class="fas fa-question-circle text-blue-600"></i> Tính toán số tấm pin 550W đấu nối vào 1 chuỗi (String) thế nào?
          </h4>
          <p class="text-xs text-slate-600 leading-relaxed">
            Tổng điện áp hở mạch Voc của chuỗi pin không vượt quá dải điện áp MPPT cực đại của Inverter (thường từ 120V - 500V DC cho 1 pha, và 200V - 1000V DC cho 3 pha). Thông thường đấu từ 8 đến 14 tấm pin 550W cho mỗi chuỗi.
          </p>
        </div>

        <!-- FAQ 4 -->
        <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200/80 space-y-2">
          <h4 class="font-bold text-slate-900 text-sm flex items-center gap-2">
            <i class="fas fa-question-circle text-blue-600"></i> Quy trình kích hoạt & điều kiện bảo hành sản phẩm tại Bách Anh Group?
          </h4>
          <p class="text-xs text-slate-600 leading-relaxed">
            Sản phẩm được bảo hành chính hãng theo tem & mã IMEI Serial Number. Khách hàng gửi ảnh chụp mã tem qua Zalo 0963 982 186 hoặc nhập vào form trên web. Tấm pin được bảo hành hiệu suất 25 năm, Inverter bảo hành 5-10 năm.
          </p>
        </div>

      </div>
    </div>
  </section>
@endsection
