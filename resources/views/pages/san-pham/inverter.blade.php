@extends('layouts.app')

@section('title', 'Bộ Biến Tần Inverter Hybrid & Hòa Lưới - BÁCH ANH GROUP')
@section('meta_description', 'Bộ biến tần Inverter Hybrid & Hòa lưới chính hãng: Luxpower, Deye, Solis, GoodWe, InfiniSolar.')

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
        <span class="text-white font-bold">2. Inverter Điện Mặt Trời</span>
      </div>
      <h1 class="text-3xl sm:text-4xl font-extrabold font-heading">Danh Mục Bộ Biến Tần Inverter (Phân Theo Hãng)</h1>
      <p class="text-xs sm:text-sm text-slate-300 max-w-3xl">
        Cung cấp trọn bộ các dòng biến tần Inverter Hybrid, hòa lưới và độc lập Off-grid chính hãng: LuxpowerTek, Deye, Ginlong Solis, GoodWe, Lumentree đạt chuẩn chống nước IP66.
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
                <i class="fas fa-layer-group text-blue-600"></i> Thương Hiệu Inverter
              </h3>
              <div class="mt-3 space-y-1 text-xs font-semibold">
                <a href="#brand-luxpower" class="flex items-center justify-between px-3 py-2 text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors">
                  <span>1. LuxpowerTek</span>
                  <span class="px-2 py-0.5 bg-blue-100 text-blue-700 text-[10px] rounded-full">3 Sản Phẩm</span>
                </a>
                <a href="#brand-deye" class="flex items-center justify-between px-3 py-2 text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors">
                  <span>2. Deye Solar</span>
                  <span class="px-2 py-0.5 bg-sky-100 text-sky-700 text-[10px] rounded-full">3 Sản Phẩm</span>
                </a>
                <a href="#brand-solis" class="flex items-center justify-between px-3 py-2 text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors">
                  <span>3. Ginlong Solis</span>
                  <span class="px-2 py-0.5 bg-indigo-100 text-indigo-700 text-[10px] rounded-full">3 Sản Phẩm</span>
                </a>
                <a href="#brand-goodwe" class="flex items-center justify-between px-3 py-2 text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors">
                  <span>4. GoodWe EU</span>
                  <span class="px-2 py-0.5 bg-red-100 text-red-700 text-[10px] rounded-full">3 Sản Phẩm</span>
                </a>
                <a href="#brand-lumentree" class="flex items-center justify-between px-3 py-2 text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors">
                  <span>5. Lumentree</span>
                  <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 text-[10px] rounded-full">3 Sản Phẩm</span>
                </a>
              </div>
            </div>

            <!-- OTHER CATEGORIES -->
            <div class="border-t border-slate-100 pt-4">
              <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Danh Mục Khác</h4>
              <div class="space-y-1 text-xs font-medium">
                <a href="{{ route('products.solar-panel') }}" class="block px-3 py-2 text-slate-600 hover:text-blue-600 hover:bg-slate-50 rounded-lg">☀️ Tấm Pin Mặt Trời</a>
                <a href="{{ route('products.battery') }}" class="block px-3 py-2 text-slate-600 hover:text-blue-600 hover:bg-slate-50 rounded-lg">🔋 Pin Lưu Trữ Lithium</a>
                <a href="{{ route('products.pump') }}" class="block px-3 py-2 text-slate-600 hover:text-blue-600 hover:bg-slate-50 rounded-lg">💧 Biến Tần Bơm Solar</a>
                <a href="{{ route('products.accessories') }}" class="block px-3 py-2 text-slate-600 hover:text-blue-600 hover:bg-slate-50 rounded-lg">🛠️ Phụ Kiện & Cáp DC</a>
              </div>
            </div>

            <!-- SUPPORT BOX -->
            <div class="bg-gradient-to-br from-blue-600 to-blue-800 text-white rounded-xl p-4 space-y-3">
              <div class="flex items-center gap-2 text-xs font-bold">
                <i class="fas fa-headset text-lg"></i> Tư Vấn Kỹ Thuật
              </div>
              <p class="text-[11px] text-blue-100">Cần tư vấn chọn Biến Tần Inverter phù hợp cho công trình của bạn?</p>
              <a href="tel:0963982186" class="w-full py-2 bg-white text-blue-700 font-extrabold text-xs rounded-lg text-center block shadow hover:bg-blue-50 transition-colors">
                <i class="fas fa-phone-alt mr-1"></i> 0963 982 186
              </a>
            </div>
          </div>
        </aside>

        <!-- RIGHT MAIN CATALOG GRID -->
        <main class="lg:col-span-9 space-y-12">

          <!-- BRAND 1: LUXPOWERTEK -->
          <div id="brand-luxpower" class="space-y-5 scroll-mt-28">
            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
              <div class="flex items-center gap-3">
                <img src="{{ asset('assets/images/') }}/logos/luxpower_logo.png" alt="LuxpowerTek" class="h-12 max-h-12 w-auto object-contain">
                <h2 class="text-xl font-extrabold text-slate-900 font-heading">Thương Hiệu LuxpowerTek</h2>
              </div>
              <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-bold rounded-full">Top 1 Biến Tần Hybrid</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
              <!-- PRODUCT ITEM -->
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Luxpower 10KW" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Hàng Chính Hãng</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Inverter Hybrid 10KW</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      INVERTER HYBRID LUXPOWER 10KW (LXP-10K IP66)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Biến tần Hybrid 10KW 2 MPPT, hỗ trợ ghép song song 6 máy, chuyển mạch &lt;10ms, bảo hành 5 năm.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="INVERTER HYBRID LUXPOWER 10KW (LXP-10K IP66)"
                    data-category="Inverter Hybrid 10KW"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Biến tần Hybrid 10KW 2 MPPT, hỗ trợ ghép song song 6 máy, chuyển mạch <10ms, bảo hành chính hãng 5 năm.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <!-- PRODUCT ITEM -->
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Luxpower 6KW" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-emerald-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Bán Chạy</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Off-Grid / Hybrid</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BIẾN TẦN HYBRID LUXPOWER 6KW (SNA 6000 WPV)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Công suất 6KW, 2 ngõ MPPT độc lập, tích hợp WiFi theo dõi qua ứng dụng di động iOS/Android.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BIẾN TẦN HYBRID LUXPOWER 6KW (SNA 6000 WPV)"
                    data-category="Inverter Hybrid 6KW"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Biến tần Hybrid Luxpower 6KW 2 ngõ MPPT độc lập, tích hợp WiFi theo dõi từ xa qua di động.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <!-- PRODUCT ITEM -->
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Luxpower 12KW 3 Pha" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-red-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Top Tier-1</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Hybrid 3 Pha</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      INVERTER HYBRID LUXPOWER 12KW 3 PHA (TRI-12K)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Dòng biến tần 3 pha công suất lớn cho biệt thự & xưởng sản xuất, dòng sạc pin lưu trữ 220A.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="INVERTER HYBRID LUXPOWER 12KW 3 PHA (TRI-12K)"
                    data-category="Inverter Hybrid 3 Pha"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Biến tần Hybrid 3 pha Luxpower 12KW dòng sạc pin lưu trữ 220A hỗ trợ nối lưới điện 3 pha công nghiệp.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- BRAND 2: DEYE SOLAR -->
          <div id="brand-deye" class="space-y-5 scroll-mt-28">
            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
              <div class="flex items-center gap-3">
                <img src="{{ asset('assets/images/') }}/logos/deye_logo.png" alt="Deye Solar" class="h-12 max-h-12 w-auto object-contain">
                <h2 class="text-xl font-extrabold text-slate-900 font-heading">Thương Hiệu Deye Solar</h2>
              </div>
              <span class="px-3 py-1 bg-sky-100 text-sky-800 text-xs font-bold rounded-full">Biến Tần Smart Hybrid</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
              <!-- PRODUCT ITEM -->
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Deye Hybrid 8KW" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Hàng Chính Hãng</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Smart Hybrid 8KW</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BIẾN TẦN DEYE HYBRID 8KW (SUN-8K-SG04LP1)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Tích hợp màn hình màu cảm ứng LCD, hỗ trợ máy phát điện & sạc pin thông minh qua CAN/RS485.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BIẾN TẦN DEYE HYBRID 8KW (SUN-8K-SG04LP1)"
                    data-category="Inverter Deye Hybrid 8KW"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Biến tần Deye Hybrid 8KW màn hình màu cảm ứng LCD, sạc pin thông minh giao tiếp CAN/RS485.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <!-- PRODUCT ITEM -->
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Deye Hybrid 12KW 3 Pha" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-red-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Top Tier-1</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Smart Hybrid 3 Pha</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BIẾN TẦN DEYE HYBRID 12KW 3 PHA (SUN-12K-SG04LP3)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Chuẩn chống nước IP65, 100% ngõ ra lệch pha 3 pha, hỗ trợ nối tầng tối đa 16 máy.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BIẾN TẦN DEYE HYBRID 12KW 3 PHA (SUN-12K-SG04LP3)"
                    data-category="Inverter Deye 12KW 3 Pha"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Biến tần 3 pha Deye Hybrid 12KW IP65 chuẩn ngõ ra lệch pha thông minh.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <!-- PRODUCT ITEM -->
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Deye Hybrid 5KW 1 Pha" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-emerald-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Bán Chạy</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Smart Hybrid 1 Pha</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BIẾN TẦN DEYE HYBRID 5KW (SUN-5K-SG03LP1)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Dòng Inverter bán chạy nhất cho gia đình, khả năng sạc/xả dòng tối đa 120A nhanh chóng.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BIẾN TẦN DEYE HYBRID 5KW (SUN-5K-SG03LP1)"
                    data-category="Inverter Deye Hybrid 5KW"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Biến tần Deye Hybrid 5KW 1 pha sạc xả 120A cho hệ thống điện dự phòng gia đình.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- BRAND 3: GINLONG SOLIS -->
          <div id="brand-solis" class="space-y-5 scroll-mt-28">
            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
              <div class="flex items-center gap-3">
                <img src="{{ asset('assets/images/') }}/logos/solis_logo.webp" alt="Ginlong Solis" class="h-12 max-h-12 w-auto object-contain">
                <h2 class="text-xl font-extrabold text-slate-900 font-heading">Thương Hiệu Ginlong Solis</h2>
              </div>
              <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-xs font-bold rounded-full">Biến Tần Hòa Lưới Công Nghiệp</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
              <!-- PRODUCT ITEM -->
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Solis 50KW" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Hàng Chính Hãng</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Grid-Tie 3 Pha</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BIẾN TẦN HÒA LƯỚI SOLIS 50KW (S5-GC50K)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Biến tần 3 pha 50KW hiệu suất 98.7%, 4 bộ MPPT độc lập cho trạm pin nhà xưởng lớn.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BIẾN TẦN HÒA LƯỚI SOLIS 50KW (S5-GC50K)"
                    data-category="Biến Tần Solis 50KW"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Biến tần hòa lưới 3 pha Solis 50KW 4 bộ MPPT độc lập hiệu suất 98.7%.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <!-- PRODUCT ITEM -->
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Solis Hybrid 10KW 3 Pha" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-amber-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Công Nghệ Mới</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Hybrid Energy Storage</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BIẾN TẦN HYBRID SOLIS 10KW 3 PHA (RHI-3P10K-HAE-5G)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Hỗ trợ kết nối pin lưu trữ cao áp High Voltage, chức năng tự làm sạch quạt tản nhiệt thông minh.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BIẾN TẦN HYBRID SOLIS 10KW 3 PHA (RHI-3P10K-HAE-5G)"
                    data-category="Biến Tần Hybrid Solis 10KW"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Biến tần Hybrid Solis 10KW 3 pha tương thích pin cao áp High Voltage.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <!-- PRODUCT ITEM -->
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Solis 110KW" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-red-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Top Tier-1</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Commercial Grid-Tie</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BIẾN TẦN HÒA LƯỚI SOLIS 110KW (S5-GC110K-NH)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Dòng biến tần dự án công nghiệp trang bị 10 MPPT 20 ngõ vào string, tích hợp chống sét SPD cấp 2.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BIẾN TẦN HÒA LƯỚI SOLIS 110KW (S5-GC110K-NH)"
                    data-category="Biến Tần Solis 110KW"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Biến tần dự án công nghiệp 110KW Solis 10 MPPT chống sét lan truyền SPD cấp 2.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- BRAND 4: GOODWE -->
          <div id="brand-goodwe" class="space-y-5 scroll-mt-28">
            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
              <div class="flex items-center gap-3">
                <img src="{{ asset('assets/images/') }}/logos/goodwe_logo.png" alt="GoodWe" class="h-12 max-h-12 w-auto object-contain">
                <h2 class="text-xl font-extrabold text-slate-900 font-heading">Thương Hiệu GoodWe</h2>
              </div>
              <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-bold rounded-full">Chuẩn Châu Âu EU</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
              <!-- PRODUCT ITEM -->
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="GoodWe 10KW" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Hàng Chính Hãng</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Hybrid Energy Storage</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BIẾN TẦN HYBRID GOODWE 10KW (GW10K-ET)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Dòng Inverter cao cấp chuẩn Châu Âu tích hợp chức năng chống phát ngược lưới Zero-Export.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BIẾN TẦN HYBRID GOODWE 10KW (GW10K-ET)"
                    data-category="Biến Tần GoodWe 10KW"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Biến tần Hybrid GoodWe 10KW chuẩn Châu Âu tích hợp bám tải Zero-Export.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <!-- PRODUCT ITEM -->
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="GoodWe 5KW 1 Pha" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-emerald-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Bán Chạy</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Single Phase Hybrid</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BIẾN TẦN HYBRID GOODWE 5KW (GW5000-EH)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Khả năng chịu quá tải ngõ ra UPS 110% trong thời gian dài, bảo vệ chống rò điện DC an toàn.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BIẾN TẦN HYBRID GOODWE 5KW (GW5000-EH)"
                    data-category="Biến Tần GoodWe 5KW"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Biến tần Hybrid 1 pha GoodWe 5KW ngõ ra UPS quá tải 110% bền bỉ.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <!-- PRODUCT ITEM -->
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="GoodWe 60KW" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-red-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Top Tier-1</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Commercial On-Grid</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BIẾN TẦN HÒA LƯỚI GOODWE 60KW (GW60KS-MT)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Hiệu suất cực đại 98.8%, trang bị 4 MPPT giúp giảm thiểu tổn hao ánh sáng che khuất.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BIẾN TẦN HÒA LƯỚI GOODWE 60KW (GW60KS-MT)"
                    data-category="Biến Tần GoodWe 60KW"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Biến tần hòa lưới GoodWe 60KW 4 bộ MPPT hiệu suất cực đại 98.8%.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- BRAND 5: LUMENTREE -->
          <div id="brand-lumentree" class="space-y-5 scroll-mt-28">
            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
              <div class="flex items-center gap-3">
                <div class="h-9 px-3 bg-emerald-600 text-white font-black text-sm flex items-center justify-center rounded-lg">LUMENTREE</div>
                <h2 class="text-xl font-extrabold text-slate-900 font-heading">Thương Hiệu Lumentree</h2>
              </div>
              <span class="px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-bold rounded-full">Biến Tần Bám Tải Thông Minh</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
              <!-- PRODUCT ITEM -->
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Lumentree 5KW" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Hàng Chính Hãng</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Grid-Tie Zero Export</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BIẾN TẦN BÁM TẢI LUMENTREE 5KW (SUN-5K)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Biến tần bám tải Lumentree 5KW hòa lưới không phát điện dư, giải pháp tiết kiệm tối ưu cho gia đình.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BIẾN TẦN BÁM TẢI LUMENTREE 5KW (SUN-5K)"
                    data-category="Biến Tần Lumentree 5KW"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Biến tần bám tải Lumentree 5KW hòa lưới không phát điện dư, tiết kiệm tối ưu.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <!-- PRODUCT ITEM -->
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Lumentree 3KW" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-emerald-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Bán Chạy</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Mini Grid-Tie Inverter</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BIẾN TẦN BÁM TẢI LUMENTREE 3KW (SUN-3K)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Kích thước nhỏ gọn, dải điện áp vào rộng từ 90V - 450V, cài đặt công suất phát thông qua màn hình.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BIẾN TẦN BÁM TẢI LUMENTREE 3KW (SUN-3K)"
                    data-category="Biến Tần Lumentree 3KW"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Biến tần bám tải Lumentree 3KW nhỏ gọn cài đặt công suất phát trực quan.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <!-- PRODUCT ITEM -->
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Lumentree 10KW 3 Pha" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-amber-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Công Nghệ Mới</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">3 Phase Zero Export</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BIẾN TẦN BÁM TẢI LUMENTREE 10KW 3 PHA
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Đấu nối 3 pha bám tải chính xác tới từng pha, chống phát ngược lên lưới điện lực EVN hiệu quả.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BIẾN TẦN BÁM TẢI LUMENTREE 10KW 3 PHA"
                    data-category="Biến Tần Lumentree 10KW 3 Pha"
                    data-img="assets/images/infinisolar_inverter.png"
                    data-desc="Biến tần bám tải 3 pha Lumentree 10KW bám tải từng pha chính xác.">
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
                <i class="fas fa-boxes text-blue-600"></i> Xem Thêm Sản Phẩm Inverter Khác
              </h4>
              <p class="text-xs text-slate-500 mt-1">Truy cập cửa hàng tổng hợp để xem đầy đủ thông số & bộ lọc tất cả sản phẩm Inverter Điện Mặt Trời.</p>
            </div>
            <a href="san-pham.html?filter=inverter" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-extrabold text-xs rounded-xl shadow-md shadow-blue-600/20 hover:shadow-lg transition-all flex items-center gap-2 whitespace-nowrap cursor-pointer">
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
