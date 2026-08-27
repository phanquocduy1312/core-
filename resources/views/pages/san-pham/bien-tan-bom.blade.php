@extends('layouts.app')

@section('title', 'Biến Tần Bơm Năng Lượng Mặt Trời Solar Pump - BÁCH ANH GROUP')
@section('meta_description', 'Biến tần bơm nước năng lượng mặt trời chuyên dụng cho nông nghiệp, tưới tiêu & trạm bơm tưới tự động.')

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
  <section class="bg-gradient-to-r from-slate-900 via-blue-950 to-slate-900 text-white py-12 px-4 sm:px-8">
    <div class="max-w-7xl mx-auto space-y-3">
      <div class="flex items-center gap-2 text-xs text-blue-300">
        <a href="{{ route('home') }}" class="hover:text-white">Trang chủ</a>
        <i class="fas fa-chevron-right text-[9px]"></i>
        <a href="{{ route('products.index') }}" class="hover:text-white">Sản Phẩm</a>
        <i class="fas fa-chevron-right text-[9px]"></i>
        <span class="text-white font-bold">4. Biến Tần Bơm Năng Lượng Mặt Trời</span>
      </div>
      <h1 class="text-3xl sm:text-4xl font-extrabold font-heading">Danh Mục Biến Tần Bơm (Solar Pump Inverters)</h1>
      <p class="text-xs sm:text-sm text-slate-300 max-w-3xl">
        Giải pháp biến tần tưới tiêu nông nghiệp & bơm nước năng lượng mặt trời không cần pin lưu trữ, vận hành trực tiếp từ mảng pin quang điện.
      </p>
    </div>
  </section>

  <!-- MAIN CATALOG WITH SIDEBAR & EXPANDED CONTAINER -->
  <section class="py-12 bg-slate-50">
    <div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        <!-- LEFT SIDEBAR: BRAND & CATEGORY NAV -->
        <aside class="lg:col-span-3 space-y-6">
          <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm sticky top-28 space-y-5">
            <div>
              <h3 class="text-sm font-extrabold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                <i class="fas fa-tint text-blue-600"></i> Hãng Biến Tần Bơm
              </h3>
              <div class="mt-3 space-y-1 text-xs font-semibold">
                <a href="#brand-worldenergy" class="flex items-center justify-between px-3 py-2 text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors">
                  <span>1. World Energy</span>
                  <span class="px-2 py-0.5 bg-teal-100 text-teal-700 text-[10px] rounded-full">3 Sản Phẩm</span>
                </a>
                <a href="#brand-growatt" class="flex items-center justify-between px-3 py-2 text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors">
                  <span>2. Growatt SPI</span>
                  <span class="px-2 py-0.5 bg-amber-100 text-amber-700 text-[10px] rounded-full">3 Sản Phẩm</span>
                </a>
                <a href="#brand-veichi" class="flex items-center justify-between px-3 py-2 text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors">
                  <span>3. VEICHI Solar</span>
                  <span class="px-2 py-0.5 bg-blue-100 text-blue-700 text-[10px] rounded-full">3 Sản Phẩm</span>
                </a>
              </div>
            </div>

            <!-- OTHER CATEGORIES -->
            <div class="border-t border-slate-100 pt-4">
              <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Danh Mục Khác</h4>
              <div class="space-y-1 text-xs font-medium">
                <a href="{{ route('products.inverter') }}" class="block px-3 py-2 text-slate-600 hover:text-blue-600 hover:bg-slate-50 rounded-lg">⚡ Inverter Điện Mặt Trời</a>
                <a href="{{ route('products.solar-panel') }}" class="block px-3 py-2 text-slate-600 hover:text-blue-600 hover:bg-slate-50 rounded-lg">☀️ Tấm Pin Mặt Trời</a>
                <a href="{{ route('products.battery') }}" class="block px-3 py-2 text-slate-600 hover:text-blue-600 hover:bg-slate-50 rounded-lg">🔋 Pin Lưu Trữ Lithium</a>
                <a href="{{ route('products.accessories') }}" class="block px-3 py-2 text-slate-600 hover:text-blue-600 hover:bg-slate-50 rounded-lg">🛠️ Phụ Kiện & Cáp DC</a>
              </div>
            </div>

            <!-- SUPPORT BOX -->
            <div class="bg-gradient-to-br from-blue-600 to-blue-800 text-white rounded-xl p-4 space-y-3">
              <div class="flex items-center gap-2 text-xs font-bold">
                <i class="fas fa-headset text-lg"></i> Tư Vấn Máy Bơm
              </div>
              <p class="text-[11px] text-blue-100">Cần tư vấn lựa chọn biến tần bơm theo công suất củ bơm & lưu lượng tưới?</p>
              <a href="tel:0963982186" class="w-full py-2 bg-white text-blue-700 font-extrabold text-xs rounded-lg text-center block shadow hover:bg-blue-50 transition-colors">
                <i class="fas fa-phone-alt mr-1"></i> 0963 982 186
              </a>
            </div>
          </div>
        </aside>

        <!-- RIGHT MAIN CATALOG GRID -->
        <main class="lg:col-span-9 space-y-12">

          <!-- BRAND 1: WORLD ENERGY -->
          <div id="brand-worldenergy" class="space-y-5 scroll-mt-28">
            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
              <div class="flex items-center gap-3">
                <img src="{{ asset('assets/images/') }}/logos/worldenergy_logo.png" alt="World Energy" class="h-8 max-h-8 w-auto object-contain">
                <h2 class="text-xl font-extrabold text-slate-900 font-heading">Thương Hiệu World Energy</h2>
              </div>
              <span class="px-3 py-1 bg-teal-100 text-teal-800 text-xs font-bold rounded-full">Bơm Nông Nghiệp</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="World Energy Pump 7.5KW" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Hàng Chính Hãng</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Solar Pump Drive 380V</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BIẾN TẦN BƠM SOLAR WORLD ENERGY 7.5KW (3 PHA 380V)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Tích hợp thuật toán MPPT dò điểm công suất cực đại cho máy bơm hoả tiễn, tự động bật/tắt theo ánh sáng mặt trời.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BIẾN TẦN BƠM SOLAR WORLD ENERGY 7.5KW (3 PHA 380V)"
                    data-category="Biến Tần Bơm World Energy 7.5KW"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Biến tần bơm World Energy 7.5KW 380V MPPT tự động bật/tắt theo nắng.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="World Energy Pump 11KW" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-red-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Top Tier-1</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Heavy Duty Pump Inverter</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BIẾN TẦN BƠM SOLAR WORLD ENERGY 11KW 3 PHA
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Chuyên dùng cấp nước trang trại quy mô lớn, cảm biến chống cạn giếng khoan tự động ngắt bảo vệ bơm.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BIẾN TẦN BƠM SOLAR WORLD ENERGY 11KW 3 PHA"
                    data-category="Biến Tần Bơm World Energy 11KW"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Biến tần bơm World Energy 11KW 3 pha tích hợp cảm biến chống cạn giếng.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="World Energy Pump 5.5KW" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-emerald-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Bán Chạy</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Solar Pump Drive 220V/380V</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BIẾN TẦN BƠM SOLAR WORLD ENERGY 5.5KW
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Cấp điện mượt màng khởi động mềm cho động cơ bơm, nâng cao tuổi thọ máy bơm gấp 3 lần.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BIẾN TẦN BƠM SOLAR WORLD ENERGY 5.5KW"
                    data-category="Biến Tần Bơm World Energy 5.5KW"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Biến tần bơm World Energy 5.5KW khởi động mềm bảo vệ máy bơm.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- BRAND 2: GROWATT SOLAR PUMP -->
          <div id="brand-growatt" class="space-y-5 scroll-mt-28">
            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
              <div class="flex items-center gap-3">
                <img src="{{ asset('assets/images/') }}/logos/growatt_logo.svg" alt="Growatt Pump" class="h-8 max-h-8 w-auto object-contain">
                <h2 class="text-xl font-extrabold text-slate-900 font-heading">Thương Hiệu Growatt Solar Pump</h2>
              </div>
              <span class="px-3 py-1 bg-amber-100 text-amber-800 text-xs font-bold rounded-full">Biến Tần Bơm SPI</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Growatt SPI 7.5KW" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Hàng Chính Hãng</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Off-Grid Pump Inverter</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BIẾN TẦN BƠM GROWATT SPI 7.5KW (3 PHA 380V)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Dòng SPI thế hệ mới hiệu suất MPPT 99%, chuẩn chống nước IP65 lắp trực tiếp ngoài trời.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BIẾN TẦN BƠM GROWATT SPI 7.5KW (3 PHA 380V)"
                    data-category="Biến Tần Bơm Growatt SPI 7.5KW"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Biến tần bơm Growatt SPI 7.5KW IP65 lắp trực tiếp ngoài trời.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Growatt SPI 15KW" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-red-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Top Tier-1</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Commercial Pump Inverter</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BIẾN TẦN BƠM GROWATT SPI 15KW 3 PHA
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Tự động chuyển đổi giữa nguồn điện mặt trời & điện lưới quốc gia khi trời tối hoặc mưa dài ngày.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BIẾN TẦN BƠM GROWATT SPI 15KW 3 PHA"
                    data-category="Biến Tần Bơm Growatt SPI 15KW"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Biến tần bơm Growatt SPI 15KW 3 pha chuyển đổi nguồn thông minh.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Growatt Pump 2.2KW" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-emerald-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Bán Chạy</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Single Phase Pump Drive</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BIẾN TẦN BƠM GROWATT 2.2KW 1 PHA 220V
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Giải pháp tưới cây trồng tự động nhỏ gọn cho các nhà vườn cây ăn trái gia đình.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BIẾN TẦN BƠM GROWATT 2.2KW 1 PHA 220V"
                    data-category="Biến Tần Bơm Growatt 2.2KW"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Biến tần bơm Growatt 2.2KW 1 pha 220V cho nhà vườn trái cây.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- BRAND 3: VEICHI SOLAR PUMP -->
          <div id="brand-veichi" class="space-y-5 scroll-mt-28">
            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
              <div class="flex items-center gap-3">
                <div class="h-9 px-3 bg-blue-700 text-white font-black text-sm flex items-center justify-center rounded-lg">VEICHI</div>
                <h2 class="text-xl font-extrabold text-slate-900 font-heading">Thương Hiệu VEICHI Solar</h2>
              </div>
              <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-bold rounded-full">Top 1 Bơm Công Nghiệp</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Veichi SI23 5.5KW" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Hàng Chính Hãng</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Solar Pump Vector Control</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BIẾN TẦN BƠM VEICHI SI23 5.5KW (3 PHA)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Dòng biến tần điều khiển vectơ thông minh, tự điều chỉnh lưu lượng nước theo cường độ bức xạ mặt trời.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BIẾN TẦN BƠM VEICHI SI23 5.5KW (3 PHA)"
                    data-category="Biến Tần Bơm VEICHI 5.5KW"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Biến tần bơm VEICHI SI23 5.5KW 3 pha điều khiển vectơ lưu lượng thông minh.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Veichi SI30 11KW" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-red-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Top Tier-1</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">IP65 Outdoor Pump Drive</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BIẾN TẦN BƠM VEICHI SI30 11KW (IP65 N-SERIES)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Vỏ nhôm tản nhiệt nguyên khối kháng nước kháng bụi ngoài trời không lo nắng mưa.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BIẾN TẦN BƠM VEICHI SI30 11KW (IP65 N-SERIES)"
                    data-category="Biến Tần Bơm VEICHI 11KW"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Biến tần bơm VEICHI SI30 11KW vỏ nhôm tản nhiệt nguyên khối IP65.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Veichi 22KW Cabinet" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-amber-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Công Nghệ Mới</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Agricultural Irrigation System</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      TỦ ĐIỀU KHIỂN BƠM SOLAR VEICHI 22KW
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Tủ điện đồng bộ tích hợp Aptomat, chống sét lan truyền & màn hình giám sát lưu lượng tưới.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="TỦ ĐIỀU KHIỂN BƠM SOLAR VEICHI 22KW"
                    data-category="Tủ Bơm VEICHI 22KW"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Tủ điều khiển bơm Solar VEICHI 22KW tích hợp chống sét lan truyền & Aptomat đồng bộ.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- LOAD MORE / VIEW ALL PRODUCTS CALL-TO-ACTION -->
          <div class="pt-6 border-t border-slate-200/80 flex flex-col sm:flex-row items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow">
            <div>
              <h4 class="font-extrabold text-slate-900 text-sm font-heading flex items-center gap-2">
                <i class="fas fa-boxes text-blue-600"></i> Xem Thêm Biến Tần Bơm Solar Khác
              </h4>
              <p class="text-xs text-slate-500 mt-1">Truy cập cửa hàng tổng hợp để xem đầy đủ công suất & bộ lọc tất cả sản phẩm Biến Tần Bơm Solar.</p>
            </div>
            <a href="san-pham.html?filter=pump" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-extrabold text-xs rounded-xl shadow-md shadow-blue-600/20 hover:shadow-lg transition-all flex items-center gap-2 whitespace-nowrap cursor-pointer">
              <span>Xem Thêm Tất Cả Sản Phẩm</span>
              <i class="fas fa-arrow-right text-xs"></i>
            </a>
          </div>

        </main>
      </div>
    </div>
  </section>

  <!-- UNIFIED FOOTER -->
@endsection
