@extends('layouts.app')

@section('title', 'Phụ Kiện Solar & Cáp Điện DC - BÁCH ANH GROUP')
@section('meta_description', 'Tủ điện bảo vệ AC/DC, Cáp điện DC Solar 4mm2/6mm2, Đầu nối MC4, Thanh ray nhôm & Kẹp pin.')

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
        <span class="text-white font-bold">5. Phụ Kiện Solar</span>
      </div>
      <h1 class="text-3xl sm:text-4xl font-extrabold font-heading">Danh Mục Phụ Kiện & Vật Tư Điện Mặt Trời</h1>
      <p class="text-xs sm:text-sm text-slate-300 max-w-3xl">
        Cung cấp trọn gói cáp điện DC chống tia UV, bộ đầu nối MC4 Staubli chống nước IP68, kẹp biên/kẹp giữa và khung rail nhôm định hình AL6005-T5.
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
                <i class="fas fa-tools text-blue-600"></i> Phụ Kiện Solar
              </h3>
              <div class="mt-3 space-y-1 text-xs font-semibold">
                <a href="#brand-xinpz" class="flex items-center justify-between px-3 py-2 text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors">
                  <span>1. Xinpz Hardware (Cáp DC)</span>
                  <span class="px-2 py-0.5 bg-cyan-100 text-cyan-700 text-[10px] rounded-full">3 Sản Phẩm</span>
                </a>
                <a href="#brand-staubli" class="flex items-center justify-between px-3 py-2 text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors">
                  <span>2. Staubli (Đầu Nối MC4)</span>
                  <span class="px-2 py-0.5 bg-red-100 text-red-700 text-[10px] rounded-full">3 Sản Phẩm</span>
                </a>
                <a href="#brand-rail" class="flex items-center justify-between px-3 py-2 text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors">
                  <span>3. Khung Rail & Kẹp Pin</span>
                  <span class="px-2 py-0.5 bg-teal-100 text-teal-700 text-[10px] rounded-full">3 Sản Phẩm</span>
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
                <a href="{{ route('products.pump') }}" class="block px-3 py-2 text-slate-600 hover:text-blue-600 hover:bg-slate-50 rounded-lg">💧 Biến Tần Bơm Solar</a>
              </div>
            </div>

            <!-- SUPPORT BOX -->
            <div class="bg-gradient-to-br from-blue-600 to-blue-800 text-white rounded-xl p-4 space-y-3">
              <div class="flex items-center gap-2 text-xs font-bold">
                <i class="fas fa-headset text-lg"></i> Tư Vấn Phụ Kiện
              </div>
              <p class="text-[11px] text-blue-100">Cần mua sỉ phụ kiện, cáp DC & khung rail số lượng lớn cho công trình?</p>
              <a href="tel:0963982186" class="w-full py-2 bg-white text-blue-700 font-extrabold text-xs rounded-lg text-center block shadow hover:bg-blue-50 transition-colors">
                <i class="fas fa-phone-alt mr-1"></i> 0963 982 186
              </a>
            </div>
          </div>
        </aside>

        <!-- RIGHT MAIN CATALOG GRID -->
        <main class="lg:col-span-9 space-y-12">

          <!-- BRAND 1: XINPZ SOLAR HARDWARE -->
          <div id="brand-xinpz" class="space-y-5 scroll-mt-28">
            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
              <div class="flex items-center gap-3">
                <img src="{{ asset('assets/images/') }}/logos/xinpz_logo.jpg" alt="Xinpz Solar" class="h-8 max-h-8 w-auto object-contain">
                <h2 class="text-xl font-extrabold text-slate-900 font-heading">Thương Hiệu Xinpz Hardware</h2>
              </div>
              <span class="px-3 py-1 bg-cyan-100 text-cyan-800 text-xs font-bold rounded-full">Dây Cáp Điện DC</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/dc_solar_cable_mc4.png" alt="Cáp DC Solar Xinpz" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Hàng Chính Hãng</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">UV-Resistant DC Cable</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      DÂY CÁP ĐIỆN DC SOLAR XINPZ (4MM2 / 6MM2)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Lõi đồng mạ thiếc chống oxy hóa, vỏ bọc XLPO chịu nhiệt ngoài trời 120°C, điện áp 1500VDC.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="DÂY CÁP ĐIỆN DC SOLAR XINPZ (4MM2 / 6MM2)"
                    data-category="Cáp DC Xinpz 4mm2 / 6mm2"
                    data-img="assets/images/dc_solar_cable_mc4.png"
                    data-desc="Cáp điện DC Solar Xinpz lõi đồng mạ thiếc 1500VDC chịu nhiệt 120°C.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/dc_solar_cable_mc4.png" alt="Cáp DC Solar Xinpz 10mm2" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-emerald-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Bán Chạy</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">High Current DC Cable</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      DÂY CÁP ĐIỆN DC SOLAR XINPZ 10MM2 CHUYÊN DỤNG
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Cáp DC tiết diện lớn 10mm2 chịu tải 95A, giảm tổn hao điện năng đường dây dài.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="DÂY CÁP ĐIỆN DC SOLAR XINPZ 10MM2 CHUYÊN DỤNG"
                    data-category="Cáp DC Xinpz 10mm2"
                    data-img="assets/images/dc_solar_cable_mc4.png"
                    data-desc="Cáp DC Solar Xinpz 10mm2 chịu tải 95A chống suy hao công suất.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/dc_solar_cable_mc4.png" alt="Cáp Tiếp Địa Đồng Mạ Niken" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Hàng Chính Hãng</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Earthing Solar Cable</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      CÁP TIẾP ĐỊA ĐỒNG MẠ NIKEN 6MM2 / 10MM2
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Chuyên dùng nối đất an toàn hệ thống khung tấm pin solar & tủ điện hòa lưới.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="CÁP TIẾP ĐỊA ĐỒNG MẠ NIKEN 6MM2 / 10MM2"
                    data-category="Cáp Tiếp Địa Solar"
                    data-img="assets/images/dc_solar_cable_mc4.png"
                    data-desc="Cáp tiếp địa đồng mạ Niken 6mm2 / 10mm2 an toàn tuyệt đối cho hệ thống.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- BRAND 2: STAUBLI SWITZERLAND -->
          <div id="brand-staubli" class="space-y-5 scroll-mt-28">
            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
              <div class="flex items-center gap-3">
                <div class="px-3 py-1 bg-red-600 text-white font-extrabold text-xs rounded-md">STAUBLI</div>
                <h2 class="text-xl font-extrabold text-slate-900 font-heading">Thương Hiệu Staubli (Thụy Sĩ)</h2>
              </div>
              <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-bold rounded-full">Kháng Nước IP68</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/dc_solar_cable_mc4.png" alt="Đầu Nối MC4 Staubli" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-red-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Top Tier-1</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Original MC4 Connector</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BỘ ĐẦU NỐI MC4 STAUBLI CHÍNH HÃNG IP68
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Đầu nối MC4 Thụy Sĩ tiêu chuẩn chống cháy UL94-V0, tiếp xúc mạ bạc dẫn điện tối ưu.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BỘ ĐẦU NỐI MC4 STAUBLI CHÍNH HÃNG IP68"
                    data-category="Đầu Nối MC4 Staubli IP68"
                    data-img="assets/images/dc_solar_cable_mc4.png"
                    data-desc="Đầu nối MC4 Staubli Thụy Sĩ chính hãng IP68 mạ bạc cực tốt.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/dc_solar_cable_mc4.png" alt="Jack Nối Y MC4 Staubli" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Hàng Chính Hãng</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Branch Connector Y-MC4</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BỘ JACK NỐI Y MC4 STAUBLI CHIA 2 CHUỖI
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Đầu nối chia nhánh Y song song 2 chuỗi pin solar nhanh chóng, gọn gàng và chống nước.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BỘ JACK NỐI Y MC4 STAUBLI CHIA 2 CHUỖI"
                    data-category="Jack Nối Y MC4 Staubli"
                    data-img="assets/images/dc_solar_cable_mc4.png"
                    data-desc="Bộ jack nối Y MC4 Staubli chia 2 chuỗi pin song song chống nước.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/dc_solar_cable_mc4.png" alt="Kìm Bóp Cốt MC4 Staubli" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-amber-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Công Nghệ Mới</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Professional Crimping Tool</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      KÌM BÓP CỐT CHUYÊN DỤNG MC4 STAUBLI
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Dụng cụ bấm cốt chuẩn kỹ thuật chống nổ arc flash trên thi công công trình mặt trời.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="KÌM BÓP CỐT CHUYÊN DỤNG MC4 STAUBLI"
                    data-category="Kìm Bóp Cốt MC4 Staubli"
                    data-img="assets/images/dc_solar_cable_mc4.png"
                    data-desc="Kìm bóp cốt MC4 Staubli chuyên dụng thi công công trình chuyên nghiệp.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- BRAND 3: ANODIZED SOLAR RAIL -->
          <div id="brand-rail" class="space-y-5 scroll-mt-28">
            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
              <div class="flex items-center gap-3">
                <div class="px-3 py-1 bg-teal-600 text-white font-extrabold text-xs rounded-md">SOLAR RAIL</div>
                <h2 class="text-xl font-extrabold text-slate-900 font-heading">Khung Rail Nhôm & Kẹp Pin</h2>
              </div>
              <span class="px-3 py-1 bg-teal-100 text-teal-800 text-xs font-bold rounded-full">Nhôm Anodized AL6005-T5</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/solar_mounting_rail.png" alt="Rail Nhôm Solar" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Hàng Chính Hãng</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">High Tensile Aluminium</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      THANH RAIL NHÔM ĐỊNH HÌNH AL6005-T5 (4.2M)
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Hệ thống khung rail nhôm mạ Anodized chịu lực gió bão cực đoan, chống gỉ ăn mòn muối biển.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="THANH RAIL NHÔM ĐỊNH HÌNH AL6005-T5 (4.2M)"
                    data-category="Thanh Rail Nhôm AL6005-T5"
                    data-img="assets/images/solar_mounting_rail.png"
                    data-desc="Thanh rail nhôm mạ Anodized AL6005-T5 dài 4.2m chịu lực bão tốt.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/solar_mounting_rail.png" alt="Bộ Kẹp Biên Kẹp Giữa Pin" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-emerald-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Bán Chạy</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">End Clamp & Mid Clamp</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      BỘ KẸP BIÊN & KẸP GIỮA TẤM PIN SOLAR INOX 304
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Kẹp nhôm Anodized dày 3mm trang bị bu lông Inox 304 siết giữ khung pin solar chắc chắn.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="BỘ KẸP BIÊN & KẸP GIỮA TẤM PIN SOLAR INOX 304"
                    data-category="Bộ Kẹp Pin Solar Inox 304"
                    data-img="assets/images/solar_mounting_rail.png"
                    data-desc="Kẹp biên & kẹp giữa nhôm Anodized 3mm bu lông Inox 304.">
                    <i class="fas fa-eye"></i> Xem Chi Tiết
                  </button>
                </div>
              </div>

              <div class="product-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
                <div class="relative bg-slate-50 p-4 flex items-center justify-center overflow-hidden h-52 border-b border-slate-100">
                  <img src="{{ asset('assets/images/') }}/solar_mounting_rail.png" alt="Chân Z Gắn Mái Tôn Seamlock" class="h-40 object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-purple-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow">Chống Dột</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider">Roof Mounting Kit</span>
                    <h3 class="font-extrabold text-slate-900 text-sm mt-1 line-clamp-2 hover:text-blue-600 transition-colors">
                      KẸP SÓNG TÔN SEAMLOCK & MÓC TREO MÁI NGÓI INOX
                    </h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                      Chuyên dùng gá lắp khung rail mặt trời lên mái tôn không đục lỗ chống rò rỉ nước mưa.
                    </p>
                  </div>
                  <button class="open-modal-trigger w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs transition-all flex items-center justify-center gap-2 shadow-md shadow-blue-600/20 cursor-pointer"
                    data-title="KẸP SÓNG TÔN SEAMLOCK & MÓC TREO MÁI NGÓI INOX"
                    data-category="Kẹp Mái Tôn Seamlock Inox"
                    data-img="assets/images/solar_mounting_rail.png"
                    data-desc="Kẹp sóng tôn Seamlock & móc treo mái ngói Inox không đục lỗ.">
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
                <i class="fas fa-boxes text-blue-600"></i> Xem Thêm Phụ Kiện Solar & Cáp DC Khác
              </h4>
              <p class="text-xs text-slate-500 mt-1">Truy cập cửa hàng tổng hợp để xem đầy đủ thông số & bộ lọc tất cả sản phẩm Phụ Kiện & Cáp DC.</p>
            </div>
            <a href="san-pham.html?filter=accessory" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-extrabold text-xs rounded-xl shadow-md shadow-blue-600/20 hover:shadow-lg transition-all flex items-center gap-2 whitespace-nowrap cursor-pointer">
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
