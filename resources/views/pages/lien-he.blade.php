@extends('layouts.app')

@section('title', 'Liên Hệ Báo Giá & Tư Vấn Kỹ Thuật - BÁCH ANH GROUP')
@section('meta_description', 'Liên hệ Bách Anh Group để nhận báo giá sỉ & tư vấn giải pháp thiết bị vật tư điện năng lượng mặt trời.')

@section('content')
<!-- MOBILE DRAWER -->
  <div id="mobile-backdrop" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden transition-opacity"></div>
  <div id="mobile-drawer" class="fixed top-0 right-0 h-full w-80 bg-white z-50 transform translate-x-full transition-transform duration-300 ease-in-out shadow-2xl flex flex-col">
    <div class="p-5 border-b border-slate-100 flex justify-between items-center">
      <a href="{{ route('home') }}" class="flex items-center gap-2">
        <img src="{{ asset('assets/images/') }}/logo.jpg" alt="BÁCH ANH GROUP Logo" class="h-12 sm:h-14 w-auto object-contain rounded-xl shadow-sm">
      </a>
      <button id="mobile-menu-close" class="p-2 text-slate-400 hover:text-slate-700">
        <i class="fas fa-times text-xl"></i>
      </button>
    </div>
    <!-- MOBILE DRAWER LANGUAGE SWITCHER -->
    <div class="px-5 py-3 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
      <span class="text-xs font-extrabold text-slate-600 uppercase tracking-wider">Ngôn ngữ / Language:</span>
      <div class="flex items-center gap-1 bg-white p-1 rounded-xl border border-slate-200 shadow-sm">
        <button onclick="setLanguage('vi')" class="px-3 py-1 text-xs font-extrabold rounded-lg hover:bg-blue-50 text-blue-600">VI</button>
        <button onclick="setLanguage('en')" class="px-3 py-1 text-xs font-extrabold rounded-lg hover:bg-blue-50 text-slate-700">EN</button>
      </div>
    </div>
    <div class="p-6 flex-1 overflow-y-auto space-y-3 text-sm">
      <a href="{{ route('home') }}" class="block px-4 py-3 font-medium text-slate-700 hover:bg-slate-50 rounded-xl" data-i18n="nav_home">Trang chủ</a>
      <a href="{{ route('about') }}" class="block px-4 py-3 font-medium text-slate-700 hover:bg-slate-50 rounded-xl" data-i18n="nav_about">Giới Thiệu</a>
      <a href="{{ route('products.index') }}" class="block px-4 py-3 font-medium text-slate-700 hover:bg-slate-50 rounded-xl" data-i18n="nav_products">Sản Phẩm</a>
      <div class="pl-4 space-y-1">
        <a href="{{ route('products.solar-panel') }}" class="block px-3 py-1.5 text-xs text-slate-600">1. Tấm Pin Mặt Trời</a>
        <a href="{{ route('products.inverter') }}" class="block px-3 py-1.5 text-xs text-slate-600">2. Inverter Điện Mặt Trời</a>
        <a href="{{ route('products.battery') }}" class="block px-3 py-1.5 text-xs text-slate-600">3. Pin Lưu Trữ Lithium</a>
        <a href="{{ route('products.pump') }}" class="block px-3 py-1.5 text-xs text-slate-600">4. Biến Tần Bơm Solar</a>
        <a href="{{ route('products.accessories') }}" class="block px-3 py-1.5 text-xs text-slate-600">5. Phụ Kiện & Cáp DC</a>
      </div>
      <a href="{{ route('projects') }}" class="block px-4 py-3 font-medium text-slate-700 hover:bg-slate-50 rounded-xl" data-i18n="nav_projects">Dự Án</a>
      <a href="{{ route('news') }}" class="block px-4 py-3 font-medium text-slate-700 hover:bg-slate-50 rounded-xl" data-i18n="nav_news">Tin Tức</a>
      <a href="{{ route('contact') }}" class="block px-4 py-3 font-medium text-slate-700 hover:bg-slate-50 rounded-xl" data-i18n="nav_contact">Liên Hệ</a>
      <a href="ho-tro-ky-thuat.html" class="block px-4 py-3 font-medium text-slate-700 hover:bg-slate-50 rounded-xl" data-i18n="nav_support">Hỗ Trợ Kỹ Thuật</a>
    </div>
    <div class="p-6 border-t border-slate-100 bg-slate-50 space-y-4">
      <a href="tel:0963982186" class="flex items-center gap-3 text-sm font-semibold text-slate-800">
        <i class="fas fa-phone-alt text-blue-600"></i> 0963 982 186
      </a>
      <a href="{{ route('contact') }}" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-xl text-center block shadow-md">
        <span data-i18n="nav_quote">Yêu Cầu Báo Giá Solar</span>
      </a>
    </div>
  </div>

  <!-- BREADCRUMB HERO BANNER -->
  <section class="bg-gradient-to-r from-slate-900 via-blue-950 to-slate-900 text-white py-14 px-4 sm:px-8">
    <div class="max-w-7xl mx-auto space-y-3">
      <div class="flex items-center gap-2 text-xs text-blue-300">
        <a href="{{ route('home') }}" class="hover:text-white">Trang chủ</a>
        <i class="fas fa-chevron-right text-[9px]"></i>
        <span class="text-white font-bold">Liên Hệ & Báo Giá</span>
      </div>
      <h1 class="text-3xl sm:text-4xl font-extrabold font-heading">Liên Hệ & Nhận Báo Giá Thiết Bị Solar</h1>
      <p class="text-xs sm:text-sm text-slate-300 max-w-3xl">
        Kỹ sư Bách Anh Group hỗ trợ tư vấn chọn công suất Inverter, số lượng tấm pin mặt trời và gửi báo giá chiết khấu đại lý tốt nhất trong 15 phút.
      </p>
    </div>
  </section>

  <!-- MAIN CONTACT CONTENT GRID -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12">
      
      <!-- LEFT COLUMN: CONTACT CARDS & HQ DETAILS -->
      <div class="lg:col-span-5 space-y-8">
        <div class="space-y-3">
          <span class="text-xs font-extrabold uppercase text-blue-600 tracking-wider bg-blue-50 px-3 py-1 rounded-md">Trụ Sở & Kho Phân Phối</span>
          <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-heading">CÔNG TY CỔ PHẦN BÁCH ANH GROUP</h2>
          <p class="text-xs text-slate-600 leading-relaxed">
            Nhà phân phối ủy quyền thiết bị & vật tư điện năng lượng mặt trời hàng đầu tại Việt Nam.
          </p>
        </div>

        <div class="space-y-4">
          <!-- REP -->
          <div class="flex items-start gap-4 p-5 bg-slate-50 rounded-2xl border border-slate-200/80 hover:border-blue-500 transition-colors">
            <div class="w-12 h-12 rounded-xl bg-blue-600 text-white flex items-center justify-center text-xl flex-shrink-0 shadow-md">
              <i class="fas fa-user-tie"></i>
            </div>
            <div>
              <span class="text-[10px] text-slate-400 uppercase font-extrabold block">Người Đại Diện Công Ty</span>
              <h4 class="text-base font-extrabold text-slate-900 mt-0.5">Mr. Lưu Thế Dũng</h4>
              <p class="text-xs text-slate-500 mt-0.5">Giám Đốc Kinh Doanh & Kỹ Thuật Solar</p>
            </div>
          </div>

          <!-- HOTLINE -->
          <div class="flex items-start gap-4 p-5 bg-slate-50 rounded-2xl border border-slate-200/80 hover:border-blue-500 transition-colors">
            <div class="w-12 h-12 rounded-xl bg-emerald-600 text-white flex items-center justify-center text-xl flex-shrink-0 shadow-md">
              <i class="fas fa-phone-alt"></i>
            </div>
            <div>
              <span class="text-[10px] text-slate-400 uppercase font-extrabold block">Hotline Trực Tiếp (Call / Zalo 24/7)</span>
              <a href="tel:0963982186" class="text-xl font-black text-blue-600 hover:text-blue-700 block mt-0.5">0963 982 186</a>
              <span class="text-[11px] text-emerald-600 font-semibold mt-0.5 block">✓ Hỗ trợ báo giá đại lý & hỗ trợ kỹ thuật 24/7</span>
            </div>
          </div>

          <!-- EMAIL -->
          <div class="flex items-start gap-4 p-5 bg-slate-50 rounded-2xl border border-slate-200/80 hover:border-blue-500 transition-colors">
            <div class="w-12 h-12 rounded-xl bg-blue-600 text-white flex items-center justify-center text-xl flex-shrink-0 shadow-md">
              <i class="fas fa-envelope"></i>
            </div>
            <div>
              <span class="text-[10px] text-slate-400 uppercase font-extrabold block">Hòm Thư Điện Tử chính thức</span>
              <a href="mailto:bachanhgroup.jsc@gmail.com" class="text-sm font-bold text-slate-900 hover:text-blue-600 block mt-0.5">bachanhgroup.jsc@gmail.com</a>
              <span class="text-[11px] text-slate-500 mt-0.5 block">Tiếp nhận bản vẽ thiết kế & yêu cầu báo giá dự án</span>
            </div>
          </div>

          <!-- ADDRESS -->
          <div class="flex items-start gap-4 p-5 bg-slate-50 rounded-2xl border border-slate-200/80 hover:border-blue-500 transition-colors">
            <div class="w-12 h-12 rounded-xl bg-blue-600 text-white flex items-center justify-center text-xl flex-shrink-0 shadow-md">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div>
              <span class="text-[10px] text-slate-400 uppercase font-extrabold block">Địa Chỉ Trụ Sở & Kho Hàng</span>
              <span class="text-sm font-bold text-slate-900 block mt-0.5">TP. Hà Nội, Việt Nam</span>
              <span class="text-[11px] text-slate-500 mt-0.5 block">Kho hàng vật tư kho Sài Gòn & Hà Nội giao nhanh toàn quốc</span>
            </div>
          </div>
        </div>

        <!-- 12 LOGO đối tác chính -->
        <div class="p-6 bg-slate-50 rounded-3xl border border-slate-200/80 space-y-4">
          <h4 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-2">
            <i class="fas fa-award text-amber-500"></i> Đối Tác Phân Phối Chính Hãng 12 Thương Hiệu Solar
          </h4>
          <div class="grid grid-cols-4 gap-2">
            <a href="{{ route('products.index') }}?brand=jinko" class="p-2 bg-white hover:bg-blue-50 rounded-xl border border-slate-100 hover:border-blue-300 flex items-center justify-center h-10 transition-all group"><img src="{{ asset('assets/images/') }}/logos/jinko_logo.webp" alt="JinKO Solar" class="h-6 object-contain group-hover:scale-105 transition-transform"></a>
            <a href="{{ route('products.index') }}?brand=huawei" class="p-2 bg-white hover:bg-blue-50 rounded-xl border border-slate-100 hover:border-blue-300 flex items-center justify-center h-10 transition-all group"><img src="{{ asset('assets/images/') }}/logos/huawei_logo.svg" alt="Huawei" class="h-6 object-contain group-hover:scale-105 transition-transform"></a>
            <a href="{{ route('products.index') }}?brand=longi" class="p-2 bg-white hover:bg-blue-50 rounded-xl border border-slate-100 hover:border-blue-300 flex items-center justify-center h-10 transition-all group"><img src="{{ asset('assets/images/') }}/logos/longi_logo.png" alt="LONGi" class="h-6 object-contain group-hover:scale-105 transition-transform"></a>
            <a href="{{ route('products.index') }}?brand=jolywood" class="p-2 bg-white hover:bg-blue-50 rounded-xl border border-slate-100 hover:border-blue-300 flex items-center justify-center h-10 transition-all group"><img src="{{ asset('assets/images/') }}/logos/jolywood_logo.svg" alt="Jolywood" class="h-6 object-contain group-hover:scale-105 transition-transform"></a>
            <a href="{{ route('products.index') }}?brand=growatt" class="p-2 bg-white hover:bg-blue-50 rounded-xl border border-slate-100 hover:border-blue-300 flex items-center justify-center h-10 transition-all group"><img src="{{ asset('assets/images/') }}/logos/growatt_logo.svg" alt="Growatt" class="h-6 object-contain group-hover:scale-105 transition-transform"></a>
            <a href="{{ route('products.index') }}?brand=solis" class="p-2 bg-white hover:bg-blue-50 rounded-xl border border-slate-100 hover:border-blue-300 flex items-center justify-center h-10 transition-all group"><img src="{{ asset('assets/images/') }}/logos/solis_logo.webp" alt="Solis" class="h-6 object-contain group-hover:scale-105 transition-transform"></a>
            <a href="{{ route('products.index') }}?brand=narada" class="p-2 bg-white hover:bg-blue-50 rounded-xl border border-slate-100 hover:border-blue-300 flex items-center justify-center h-10 transition-all group"><img src="{{ asset('assets/images/') }}/logos/narada_logo.svg" alt="Narada" class="h-6 object-contain group-hover:scale-105 transition-transform"></a>
            <a href="{{ route('products.index') }}?brand=pylontech" class="p-2 bg-white hover:bg-blue-50 rounded-xl border border-slate-100 hover:border-blue-300 flex items-center justify-center h-10 transition-all group"><img src="{{ asset('assets/images/') }}/logos/pylontech_logo.svg" alt="Pylontech" class="h-6 object-contain group-hover:scale-105 transition-transform"></a>
            <a href="{{ route('products.index') }}?brand=luxpower" class="p-2 bg-white hover:bg-blue-50 rounded-xl border border-slate-100 hover:border-blue-300 flex items-center justify-center h-10 transition-all group"><img src="{{ asset('assets/images/') }}/logos/luxpower_logo.png" alt="Luxpower" class="h-6 object-contain group-hover:scale-105 transition-transform"></a>
            <a href="{{ route('products.index') }}?brand=hinaess" class="p-2 bg-white hover:bg-blue-50 rounded-xl border border-slate-100 hover:border-blue-300 flex items-center justify-center h-10 transition-all group"><img src="{{ asset('assets/images/') }}/logos/hinaess_logo.svg" alt="Hina ESS" class="h-6 object-contain group-hover:scale-105 transition-transform"></a>
            <a href="{{ route('products.index') }}?brand=chisageess" class="p-2 bg-white hover:bg-blue-50 rounded-xl border border-slate-100 hover:border-blue-300 flex items-center justify-center h-10 transition-all group"><img src="{{ asset('assets/images/') }}/logos/chisageess_logo.svg" alt="Chisage ESS" class="h-6 object-contain group-hover:scale-105 transition-transform"></a>
            <a href="{{ route('products.index') }}?brand=canadian" class="p-2 bg-white hover:bg-blue-50 rounded-xl border border-slate-100 hover:border-blue-300 flex items-center justify-center h-10 transition-all group"><img src="{{ asset('assets/images/') }}/logos/canadiansolar_logo.svg" alt="CanadianSolar" class="h-6 object-contain group-hover:scale-105 transition-transform"></a>
          </div>
        </div>
      </div>

      <!-- RIGHT COLUMN: INTERACTIVE FORM FOR QUOTATION -->
      <div class="lg:col-span-7 bg-white p-8 sm:p-10 rounded-3xl border border-slate-200/90 shadow-2xl space-y-6">
        <div class="border-b border-slate-100 pb-4 space-y-1">
          <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Tư Vấn Công Suất & Báo Giá Thiết Bị</span>
          <h3 class="text-2xl font-extrabold text-slate-900 font-heading">Gửi Yêu Cầu Báo Giá Vật Tư Solar</h3>
          <p class="text-xs text-slate-500">Vui lòng điền thông tin bên dưới, nhân viên hỗ trợ sẽ phản hồi bảng giá chi tiết trong vòng 15 phút.</p>
        </div>

        <form id="contact-quote-form" class="space-y-5">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Họ và Tên Khách Hàng *</label>
              <input type="text" id="quote-name" required placeholder="Ví dụ: Nguyễn Văn An" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-600 focus:outline-none text-xs font-semibold text-slate-800">
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Số Điện Thoại / Zalo *</label>
              <input type="tel" id="quote-phone" required placeholder="0963 xxx xxx" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-600 focus:outline-none text-xs font-semibold text-slate-800">
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Hòm Thư Email *</label>
              <input type="email" id="quote-email" required placeholder="email@domain.com" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-600 focus:outline-none text-xs font-semibold text-slate-800">
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Danh Mục Cần Báo Giá *</label>
              <select id="quote-category" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-600 focus:outline-none text-xs font-bold text-slate-800 bg-white">
                <option value="inverter">Inverter Điện Mặt Trời (Luxpower/Deye/Solis/GoodWe)</option>
                <option value="panel">Tấm Pin Mặt Trời (LONGI / VSUN / AE Solar / Jinko)</option>
                <option value="battery">Pin Lưu Trữ Lithium LiFePO4 (Bastions / Deye / Pylontech)</option>
                <option value="pump">Biến Tần Bơm Năng Lượng Mặt Trời (World Energy)</option>
                <option value="accessories">Cáp DC Solar, Đầu Nối MC4 & Khung Rail Nhôm</option>
                <option value="full">Trọn Gói Vật Tư Dự Án Điện Mặt Trời</option>
              </select>
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Địa Chỉ Lắp Đặt / Tỉnh Thành Dự Án</label>
            <input type="text" id="quote-location" placeholder="Ví dụ: Hà Nội, Bắc Ninh, Lâm Đồng..." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-600 focus:outline-none text-xs font-semibold text-slate-800">
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Chi Tiết Yêu Cầu Hoặc Mã Sản Phẩm Cụ Thể</label>
            <textarea id="quote-message" rows="4" placeholder="Nhập mã Inverter, số lượng tấm pin hoặc công suất KWp bạn muốn tư vấn..." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-600 focus:outline-none text-xs font-semibold text-slate-800"></textarea>
          </div>

          <button type="submit" class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl shadow-lg shadow-blue-600/25 transition-all text-xs uppercase tracking-wider cursor-pointer">
            <i class="fas fa-paper-plane mr-2"></i> Gửi Yêu Cầu Báo Giá Trực Tuyến
          </button>
        </form>

        <!-- SUCCESS ALERT MODAL HIDDEN BY DEFAULT -->
        <div id="quote-success-alert" class="hidden p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl text-xs space-y-2">
          <div class="flex items-center gap-2 font-bold text-sm">
            <i class="fas fa-check-circle text-emerald-600 text-lg"></i>
            <span>Gửi Yêu Cầu Báo Giá Thành Công!</span>
          </div>
          <p>Cảm ơn quý khách đã liên hệ Bách Anh Group. Nhân viên hỗ trợ sẽ gọi điện lại trực tiếp tư vấn trong thời gian sớm nhất.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- MAP & WAREHOUSE LOCATION -->
  <section class="py-12 bg-slate-50 border-t border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 space-y-6">
      <div class="flex items-center justify-between">
        <div>
          <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Hệ Thống Kho Hàng</span>
          <h3 class="text-xl font-extrabold text-slate-900 font-heading">Kho Vật Tư Điện Mặt Trời Bách Anh Group</h3>
        </div>
        <a href="tel:0963982186" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white font-bold text-xs rounded-xl shadow-md">
          <i class="fas fa-phone-alt"></i> Liên Hệ Nhận Hàng Trực Tiếp
        </a>
      </div>

      <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-200/90 bg-slate-900 h-80 relative flex items-center justify-center text-white text-center p-6">
        <div class="space-y-3 max-w-lg">
          <div class="w-16 h-16 bg-blue-600 rounded-2xl mx-auto flex items-center justify-center text-3xl shadow-lg">
            <i class="fas fa-map-marked-alt"></i>
          </div>
          <h4 class="text-xl font-extrabold">BÁCH ANH GROUP - HÀ NỘI HEADQUARTERS</h4>
          <p class="text-xs text-slate-300">Kho hàng điện năng lượng mặt trời chính hãng luôn sẵn kho hơn 1,000+ Inverter Hybrid, 5,000+ Tấm Pin & Cáp DC chuyên dụng.</p>
          <span class="inline-block px-4 py-1.5 bg-white/10 text-blue-300 rounded-full text-xs font-bold border border-white/10">Hotline Kỹ Thuật: 0963 982 186</span>
        </div>
      </div>
    </div>
  </section>

  <!-- UNIFIED FOOTER -->
@endsection
