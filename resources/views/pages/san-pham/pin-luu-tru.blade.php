@extends('layouts.app')

@section('title', 'Pin Lưu Trữ Lithium LiFePO4 48V / 51.2V - BÁCH ANH GROUP')
@section('meta_description', 'Pin lưu trữ điện năng lượng mặt trời Lithium LiFePO4 48V/51.2V cao cấp: XinPZ, HinaESS, ChisageESS.')

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
        <span class="text-white font-bold">3. Pin Lưu Trữ Lithium</span>
      </div>
      <h1 class="text-3xl sm:text-4xl font-extrabold font-heading">Danh Mục Pin Lưu Trữ Lithium LiFePO4</h1>
      <p class="text-xs sm:text-sm text-slate-300 max-w-3xl">
        Cung cấp hệ thống lưu trữ điện mặt trời cao cấp dung lượng 48V 100Ah - 200Ah tích hợp mạch quản lý BMS thông minh: Bastions Energy ESS, Deye Battery Module, InfiniSolar Storage.
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
                <i class="fas fa-battery-full text-blue-600"></i> Hãng Pin Lưu Trữ
              </h3>
              <div class="mt-3 space-y-1 text-xs font-semibold">
                <a href="#brand-bastions" class="flex items-center justify-between px-3 py-2 text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors">
                  <span>1. Bastions Energy</span>
                  <span class="px-2 py-0.5 bg-purple-100 text-purple-700 text-[10px] rounded-full">3 Sản Phẩm</span>
                </a>
                <a href="#brand-deye" class="flex items-center justify-between px-3 py-2 text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors">
                  <span>2. Deye ESS</span>
                  <span class="px-2 py-0.5 bg-sky-100 text-sky-700 text-[10px] rounded-full">3 Sản Phẩm</span>
                </a>
                <a href="#brand-pylontech" class="flex items-center justify-between px-3 py-2 text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors">
                  <span>3. Pylontech</span>
                  <span class="px-2 py-0.5 bg-teal-100 text-teal-700 text-[10px] rounded-full">3 Sản Phẩm</span>
                </a>
                <a href="#brand-narada" class="flex items-center justify-between px-3 py-2 text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors">
                  <span>4. Narada ESS</span>
                  <span class="px-2 py-0.5 bg-orange-100 text-orange-700 text-[10px] rounded-full">3 Sản Phẩm</span>
                </a>
                <a href="#brand-hina" class="flex items-center justify-between px-3 py-2 text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors">
                  <span>5. HINA ESS</span>
                  <span class="px-2 py-0.5 bg-blue-100 text-blue-700 text-[10px] rounded-full">3 Sản Phẩm</span>
                </a>
                <a href="#brand-xinpz" class="flex items-center justify-between px-3 py-2 text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors">
                  <span>6. Xinpz ESS</span>
                  <span class="px-2 py-0.5 bg-purple-100 text-purple-700 text-[10px] rounded-full">3 Sản Phẩm</span>
                </a>
              </div>
            </div>

            <!-- OTHER CATEGORIES -->
            <div class="border-t border-slate-100 pt-4">
              <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Danh Mục Khác</h4>
              <div class="space-y-1 text-xs font-medium">
                <a href="{{ route('products.inverter') }}" class="block px-3 py-2 text-slate-600 hover:text-blue-600 hover:bg-slate-50 rounded-lg">⚡ Inverter Điện Mặt Trời</a>
                <a href="{{ route('products.solar-panel') }}" class="block px-3 py-2 text-slate-600 hover:text-blue-600 hover:bg-slate-50 rounded-lg">☀️ Tấm Pin Mặt Trời</a>
                <a href="{{ route('products.pump') }}" class="block px-3 py-2 text-slate-600 hover:text-blue-600 hover:bg-slate-50 rounded-lg">💧 Biến Tần Bơm Solar</a>
                <a href="{{ route('products.accessories') }}" class="block px-3 py-2 text-slate-600 hover:text-blue-600 hover:bg-slate-50 rounded-lg">🛠️ Phụ Kiện & Cáp DC</a>
              </div>
            </div>

            <!-- SUPPORT BOX -->
            <div class="bg-gradient-to-br from-blue-600 to-blue-800 text-white rounded-xl p-4 space-y-3">
              <div class="flex items-center gap-2 text-xs font-bold">
                <i class="fas fa-headset text-lg"></i> Tư Vấn Lưu Trữ
              </div>
              <p class="text-[11px] text-blue-100">Cần tư vấn dung lượng pin Lithium LiFePO4 phù hợp cho gia đình hoặc doanh nghiệp?</p>
              <a href="tel:0963982186" class="w-full py-2 bg-white text-blue-700 font-extrabold text-xs rounded-lg text-center block shadow hover:bg-blue-50 transition-colors">
                <i class="fas fa-phone-alt mr-1"></i> 0963 982 186
              </a>
            </div>
          </div>
        </aside>

        <!-- RIGHT MAIN CATALOG GRID -->
        <main class="lg:col-span-9 space-y-12">

          <!-- BRAND 1: BASTIONS ENERGY -->
          <div id="brand-bastions" class="space-y-5 scroll-mt-28">
            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
              <div class="flex items-center gap-3">
                <img src="{{ asset('assets/images/') }}/logos/bastionsenergy_logo.png" alt="Bastions Energy" class="h-8 max-h-8 w-auto object-contain">
                <h2 class="text-xl font-extrabold text-slate-900 font-heading">Thương Hiệu Bastions Energy</h2>
              </div>
              <span class="px-3 py-1 bg-purple-100 text-purple-800 text-xs font-bold rounded-full">Pin Lithium Cao Cấp</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Bastions 48V 200Ah" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Hàng Chính Hãng</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">LiFePO4 ESS Battery</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BỘ PIN LƯU TRỮ LITHIUM BASTIONS ENERGY 48V 200AH
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Dung lượng 9.6kWh, độ bền &gt;6,000 chu kỳ sạc xả, màn hình hiển thị thông số điện áp trực quan.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BỘ PIN LƯU TRỮ LITHIUM BASTIONS ENERGY 48V 200AH"
                    data-category="Pin Bastions 48V 200Ah"
                    data-img="assets/images/lithium_battery_48v.png"
                    data-desc="Bộ pin lưu trữ Lithium 48V 200Ah 9.6kWh tuổi thọ 6,000 chu kỳ.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Bastions PowerWall 10kWh" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-purple-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">PowerWall</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Wall-Mount PowerWall</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BỘ PIN TREO TƯỜNG BASTIONS POWERWALL 10KWH
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Pin treo tường siêu mỏng phong cách hiện đại, màn hình cảm ứng theo dõi dòng sạc/xả real-time.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BỘ PIN TREO TƯỜNG BASTIONS POWERWALL 10KWH"
                    data-category="PowerWall Bastions 10kWh"
                    data-img="assets/images/lithium_battery_48v.png"
                    data-desc="Bộ pin treo tường siêu mỏng 10kWh màn hình cảm ứng theo dõi trực quan.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Bastions 48V 100Ah Rack" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-emerald-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Bán Chạy</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Standard 19-inch Rack</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      MODULE PIN LITHIUM BASTIONS ENERGY 48V 100AH
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Chuẩn gắn tủ rack server 19 inch, tương thích 100% với biến tần Inverter Hybrid Luxpower / Deye.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="MODULE PIN LITHIUM BASTIONS ENERGY 48V 100AH"
                    data-category="Pin Bastions 48V 100Ah"
                    data-img="assets/images/lithium_battery_48v.png"
                    data-desc="Module pin Lithium 48V 100Ah 4.8kWh gắn tủ rack server tương thích Luxpower & Deye.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- BRAND 2: DEYE ESS -->
          <div id="brand-deye" class="space-y-5 scroll-mt-28">
            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
              <div class="flex items-center gap-3">
                <img src="{{ asset('assets/images/') }}/logos/deye_logo.png" alt="Deye ESS" class="h-8 max-h-8 w-auto object-contain">
                <h2 class="text-xl font-extrabold text-slate-900 font-heading">Thương Hiệu Deye ESS</h2>
              </div>
              <span class="px-3 py-1 bg-sky-100 text-sky-800 text-xs font-bold rounded-full">Module Pin Gắn Tủ Rack</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Deye Lithium 48V" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Hàng Chính Hãng</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Smart BMS Lithium</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      MODULE PIN LITHIUM DEYE 48V 100AH (RW-M6.1)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Tự động kết nối giao tiếp CAN Bus với biến tần Inverter Deye / Luxpower, hỗ trợ mở rộng 32 module.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="MODULE PIN LITHIUM DEYE 48V 100AH (RW-M6.1)"
                    data-category="Pin Deye 48V 100Ah"
                    data-img="assets/images/lithium_battery_48v.png"
                    data-desc="Module pin Lithium Deye RW-M6.1 giao tiếp CAN Bus mở rộng đến 32 module.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Deye 51.2V 200Ah High Voltage" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-red-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Top Tier-1</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">High Voltage ESS</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      TỦ PIN LƯU TRỮ CAO ÁP DEYE HIGH VOLTAGE 20KWH
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Điện áp hoạt động 204V - 614V DC chuyên dùng cho dự án điện mặt trời tòa nhà văn phòng.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="TỦ PIN LƯU TRỮ CAO ÁP DEYE HIGH VOLTAGE 20KWH"
                    data-category="Tủ Pin Deye Cao Áp 20kWh"
                    data-img="assets/images/lithium_battery_48v.png"
                    data-desc="Tủ pin cao áp Deye High Voltage 20kWh chuyên dụng cho các trạm điện mặt trời lớn.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Deye Wall 5.12kWh" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-emerald-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Bán Chạy</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Wall-Mounted LiFePO4</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      PIN LITHIUM DEYE TREO TƯỜNG 5.12KWH (SE-G5.1 PRO)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Module pin Lithium sạc nhanh 1C, tuổi thọ 6,000 chu kỳ, chuẩn chống cháy nổ an toàn tuyệt đối.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="PIN LITHIUM DEYE TREO TƯỜNG 5.12KWH (SE-G5.1 PRO)"
                    data-category="Pin Deye Treo Tường 5.12kWh"
                    data-img="assets/images/lithium_battery_48v.png"
                    data-desc="Module pin Lithium Deye SE-G5.1 Pro sạc nhanh 1C tuổi thọ 6,000 chu kỳ.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- BRAND 3: PYLONTECH -->
          <div id="brand-pylontech" class="space-y-5 scroll-mt-28">
            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
              <div class="flex items-center gap-3">
                <img src="{{ asset('assets/images/') }}/logos/pylontech_logo.svg" alt="Pylontech Lithium" class="h-8 max-h-8 w-auto object-contain">
                <h2 class="text-xl font-extrabold text-slate-900 font-heading">Thương Hiệu PYLONTECH</h2>
              </div>
              <span class="px-3 py-1 bg-teal-100 text-teal-800 text-xs font-bold rounded-full">Top 1 Pin Lưu Trữ Thế Giới</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Pylontech US3000C" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Hàng Chính Hãng</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Rack Lithium LiFePO4</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      PIN LITHIUM PYLONTECH 48V 100AH (US3000C / US5000)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Dung lượng 3.55kWh - 4.8kWh, thiết kế mô-đun gắn tủ rack tiêu chuẩn quốc tế, bảo hành 10 năm.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="PIN LITHIUM PYLONTECH 48V 100AH (US3000C / US5000)"
                    data-category="Pin Pylontech US5000"
                    data-img="assets/images/lithium_battery_48v.png"
                    data-desc="Pin Lithium Pylontech US5000 4.8kWh bảo hành chính hãng 10 năm.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Pylontech Force L2" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-red-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Top Tier-1</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">High Voltage System</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      PIN LITHIUM PYLONTECH FORCE L2 (14.2KWH)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Hệ thống pin lưu trữ cao cấp thiết kế dạng tháp xếp chồng kết nối không dây cáp phức tạp.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="PIN LITHIUM PYLONTECH FORCE L2 (14.2KWH)"
                    data-category="Pin Pylontech Force L2"
                    data-img="assets/images/lithium_battery_48v.png"
                    data-desc="Hệ tháp pin lưu trữ Pylontech Force L2 14.2kWh dạng xếp chồng cao cấp.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Pylontech Pelio 10.4kWh" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-amber-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Công Nghệ Mới</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Ultra-Thin Home Battery</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      TỦ PIN LƯU TRỮ PYLONTECH PELIO 10.4KWH
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Thiết kế mỏng nhẹ 5.2kWh / module mở rộng đến 104kWh, khả năng xả tới 95% DoD.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="TỦ PIN LƯU TRỮ PYLONTECH PELIO 10.4KWH"
                    data-category="Tủ Pin Pylontech Pelio 10.4kWh"
                    data-img="assets/images/lithium_battery_48v.png"
                    data-desc="Tủ pin lưu trữ siêu mỏng Pylontech Pelio 10.4kWh độ sâu xả 95% DoD.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- BRAND 4: NARADA ESS -->
          <div id="brand-narada" class="space-y-5 scroll-mt-28">
            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
              <div class="flex items-center gap-3">
                <img src="{{ asset('assets/images/') }}/logos/narada_logo.svg" alt="Narada ESS" class="h-8 max-h-8 w-auto object-contain">
                <h2 class="text-xl font-extrabold text-slate-900 font-heading">Thương Hiệu Narada</h2>
              </div>
              <span class="px-3 py-1 bg-orange-100 text-orange-800 text-xs font-bold rounded-full">Pin Lưu Trữ Công Nghiệp</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Narada 48V 100Ah" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Hàng Chính Hãng</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Industrial ESS</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      PIN LƯU TRỮ LITHIUM NARADA 48V 100AH ESS
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Dòng pin chuyên dụng cho viễn thông & trạm điện mặt trời dung lượng lớn, tuổi thọ trên 15 năm.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="PIN LƯU TRỮ LITHIUM NARADA 48V 100AH ESS"
                    data-category="Pin Narada 48V 100Ah"
                    data-img="assets/images/lithium_battery_48v.png"
                    data-desc="Pin Lithium Narada 48V 100Ah cho trạm viễn thông & điện năng lượng mặt trời.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Narada Industrial 15kWh" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-red-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Top Tier-1</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Telecom Backup Power</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      TỦ PIN LƯU TRỮ NARADA INDUSTRIAL 15KWH
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Khả năng hoạt động ở nhiệt độ cao 55°C không cần điều hòa làm mát, tuổi thọ 5,000 chu kỳ.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="TỦ PIN LƯU TRỮ NARADA INDUSTRIAL 15KWH"
                    data-category="Tủ Pin Narada 15kWh"
                    data-img="assets/images/lithium_battery_48v.png"
                    data-desc="Tủ pin công nghiệp Narada Industrial 15kWh chịu nhiệt độ 55°C cực tốt.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Narada 51.2V 200Ah" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-emerald-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Bán Chạy</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">High Discharge ESS</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      MODULE PIN NARADA 51.2V 200AH HIGH RATE
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Mạch BMS bảo vệ quá dòng 200A liên tục, thời gian đáp ứng dòng điện sự cố cực nhanh &lt;2ms.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="MODULE PIN NARADA 51.2V 200AH HIGH RATE"
                    data-category="Pin Narada 51.2V 200Ah"
                    data-img="assets/images/lithium_battery_48v.png"
                    data-desc="Module pin Narada 51.2V 200Ah xả 200A liên tục cho tải nặng.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- BRAND 5: HINA ESS -->
          <div id="brand-hina" class="space-y-5 scroll-mt-28">
            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
              <div class="flex items-center gap-3">
                <img src="{{ asset('assets/images/') }}/logos/hinaess_logo.svg" alt="Hina ESS" class="h-8 max-h-8 w-auto object-contain">
                <h2 class="text-xl font-extrabold text-slate-900 font-heading">Thương Hiệu HINA ESS</h2>
              </div>
              <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-bold rounded-full">6,000+ Chu Kỳ Sạc Xả</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Hina ESS 5.12kWh" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Hàng Chính Hãng</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">High Cycle ESS</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      MODULE PIN LƯU TRỮ LITHIUM HINA ESS 5.12KWH
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Dung lượng 5.12kWh 100Ah, tuổi thọ 6,000 chu kỳ sạc xả ở độ sâu xả 90% DoD.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="MODULE PIN LƯU TRỮ LITHIUM HINA ESS 5.12KWH"
                    data-category="Pin Hina ESS 5.12kWh"
                    data-img="assets/images/lithium_battery_48v.png"
                    data-desc="Module pin Lithium Hina ESS 5.12kWh 100Ah tuổi thọ 6,000 chu kỳ sạc xả.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Hina ESS PowerWall 10kWh" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-purple-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">PowerWall</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Smart Home ESS</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      PIN LITHIUM HINA ESS POWERWALL 10KWH
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Kiểu dáng PowerWall sang trọng, hệ thống tự động cân bằng dung lượng các cell pin chủ động.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="PIN LITHIUM HINA ESS POWERWALL 10KWH"
                    data-category="PowerWall Hina ESS 10kWh"
                    data-img="assets/images/lithium_battery_48v.png"
                    data-desc="Pin treo tường Hina ESS PowerWall 10kWh cân bằng cell pin tự động.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Hina Commercial ESS 30kWh" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-red-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Top Tier-1</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Commercial ESS Tower</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      TỦ PIN LƯU TRỮ HINA COMMERCIAL ESS 30KWH
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Giải pháp lưu trữ điện cho tòa nhà, trạm sạc xe điện & nhà máy sản xuất công nghiệp.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="TỦ PIN LƯU TRỮ HINA COMMERCIAL ESS 30KWH"
                    data-category="Tủ Pin Hina Commercial 30kWh"
                    data-img="assets/images/lithium_battery_48v.png"
                    data-desc="Tủ pin thương mại Hina Commercial ESS 30kWh cho nhà máy sản xuất.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- BRAND 6: XINPZ -->
          <div id="brand-xinpz" class="space-y-5 scroll-mt-28">
            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
              <div class="flex items-center gap-3">
                <div class="h-9 px-3 bg-purple-600 text-white font-black text-sm flex items-center justify-center rounded-lg">XINPZ</div>
                <h2 class="text-xl font-extrabold text-slate-900 font-heading">Thương Hiệu Xinpz</h2>
              </div>
              <span class="px-3 py-1 bg-purple-100 text-purple-800 text-xs font-bold rounded-full">Pin Lưu Trữ Thông Minh</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Xinpz Lithium 48V" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Hàng Chính Hãng</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Lithium LiFePO4</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      PIN LƯU TRỮ LITHIUM XINPZ 48V 100AH WALL-MOUNT
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Dung lượng 4.8kWh, thiết kế treo tường nhỏ gọn, tích hợp mạch BMS thông minh cân bằng cell.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="PIN LƯU TRỮ LITHIUM XINPZ 48V 100AH WALL-MOUNT"
                    data-category="Pin Xinpz 48V 100Ah"
                    data-img="assets/images/lithium_battery_48v.png"
                    data-desc="Pin Lithium Xinpz 48V 100Ah treo tường tích hợp BMS cân bằng cell.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Xinpz 51.2V 200Ah" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-amber-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Công Nghệ Mới</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Rack-Mount 10kWh</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      PIN LƯU TRỮ LITHIUM XINPZ 51.2V 200AH RACK
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Bộ pin tủ rack 10.24kWh công nghệ cell Grade-A mới 100%, tích hợp giao tiếp RS485/CAN.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="PIN LƯU TRỮ LITHIUM XINPZ 51.2V 200AH RACK"
                    data-category="Pin Xinpz 51.2V 200Ah"
                    data-img="assets/images/lithium_battery_48v.png"
                    data-desc="Bộ pin tủ rack Xinpz 10.24kWh cell Grade-A mới 100%.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Xinpz High Voltage 20kWh" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-red-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Top Tier-1</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">High Voltage Module</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      MODULE PIN LITHIUM XINPZ HIGH VOLTAGE 20KWH
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Dòng pin cao áp kết nối trực tiếp biến tần Hybrid 3 pha công suất lớn, độ an toàn IP65.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="MODULE PIN LITHIUM XINPZ HIGH VOLTAGE 20KWH"
                    data-category="Pin Xinpz High Voltage 20kWh"
                    data-img="assets/images/lithium_battery_48v.png"
                    data-desc="Module pin cao áp Xinpz High Voltage 20kWh IP65 cho biến tần 3 pha.">
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
                <i class="fas fa-boxes text-blue-600"></i> Xem Thêm Pin Lưu Trữ Lithium Khác
              </h4>
              <p class="text-xs text-slate-500 mt-1">Truy cập cửa hàng tổng hợp để xem đầy đủ dung lượng & bộ lọc tất cả sản phẩm Pin Lưu Trữ Lithium.</p>
            </div>
            <a href="san-pham.html?filter=battery" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-extrabold text-xs rounded-xl shadow-md shadow-blue-600/20 hover:shadow-lg transition-all flex items-center gap-2 whitespace-nowrap cursor-pointer">
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
