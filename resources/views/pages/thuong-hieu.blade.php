@extends('layouts.app')

@section('title', 'Thương Hiệu Đối Tác Phân Phối - BÁCH ANH GROUP')
@section('meta_description', 'Thương hiệu đối tác phân phối thiết bị năng lượng mặt trời uy tín hàng đầu.')

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
      <a href="{{ route('brands') }}" class="block px-4 py-3 font-bold text-blue-600 bg-blue-50 rounded-xl">Thương Hiệu</a>
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

  <!-- HERO BANNER -->
  <section class="bg-gradient-to-r from-slate-900 via-blue-950 to-slate-900 text-white py-12 px-4 sm:px-8">
    <div class="max-w-7xl mx-auto space-y-3">
      <div class="flex items-center gap-2 text-xs text-blue-300">
        <a href="{{ route('home') }}" class="hover:text-white">Trang chủ</a>
        <i class="fas fa-chevron-right text-[9px]"></i>
        <span class="text-white font-bold">Lọc Sản Phẩm Theo Thương Hiệu</span>
      </div>
      <h1 class="text-3xl sm:text-4xl font-extrabold font-heading">Trang Lọc Sản Phẩm Theo Thương Hiệu Đối Tác</h1>
      <p class="text-xs sm:text-sm text-slate-300 max-w-3xl">
        Chọn thương hiệu bất kỳ dưới đây để xem toàn bộ danh mục Inverter, Tấm Pin, Pin Lưu Trữ & Phụ Kiện Solar nhập khẩu chính hãng đầy đủ giấy tờ CO/CQ.
      </p>
    </div>
  </section>

  <!-- BRAND DIRECTORY & FILTERING SECTION -->
  <section class="py-12 bg-slate-50">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
      
      <!-- BRAND SELECTION CARD GRID -->
      <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/90 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-slate-100 pb-5">
          <div>
            <h2 class="text-xl font-extrabold text-slate-900 font-heading flex items-center gap-2.5">
              <i class="fas fa-award text-blue-600"></i>
              <span>Chọn Thương Hiệu Cần Lọc Sản Phẩm</span>
            </h2>
            <p class="text-xs text-slate-500 mt-1">Nhấp vào một thương hiệu bất kỳ để lọc ngay danh sách thiết bị bên dưới</p>
          </div>
          <div class="flex items-center gap-2 w-full sm:w-auto">
            <a href="{{ route('products.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold transition-all">
              <i class="fas fa-store mr-1"></i> Xem Tất Cả 130 Sản Phẩm
            </a>
          </div>
        </div>

        <!-- 12 MAIN FEATURED BRAND TILES -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
          
          <!-- 1. LUXPOWER -->
          <a href="{{ route('brands') }}?brand=luxpower" class="brand-select-tile p-4 bg-slate-50 hover:bg-blue-50 border border-slate-200 hover:border-blue-500 rounded-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-2 shadow-sm" data-brand="luxpower">
            <img src="{{ asset('assets/images/') }}/logos/luxpower_logo.png" alt="LUXPOWER" class="h-12 sm:h-14 max-h-14 max-w-[90%] object-contain group-hover:scale-105 transition-transform">
            <span class="text-xs font-extrabold text-slate-800 group-hover:text-blue-600">LUXPOWER</span>
            <span class="text-[9px] font-bold text-slate-400 uppercase">Inverter Hybrid</span>
          </a>

          <!-- 2. DEYE -->
          <a href="{{ route('brands') }}?brand=deye" class="brand-select-tile p-4 bg-slate-50 hover:bg-blue-50 border border-slate-200 hover:border-blue-500 rounded-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-2 shadow-sm" data-brand="deye">
            <img src="{{ asset('assets/images/') }}/logos/deye_logo.png" alt="Deye" class="h-12 sm:h-14 max-h-14 max-w-[90%] object-contain group-hover:scale-105 transition-transform">
            <span class="text-xs font-extrabold text-slate-800 group-hover:text-blue-600">Deye Solar</span>
            <span class="text-[9px] font-bold text-slate-400 uppercase">Smart Hybrid</span>
          </a>

          <!-- 3. SOLIS -->
          <a href="{{ route('brands') }}?brand=solis" class="brand-select-tile p-4 bg-slate-50 hover:bg-blue-50 border border-slate-200 hover:border-blue-500 rounded-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-2 shadow-sm" data-brand="solis">
            <img src="{{ asset('assets/images/') }}/logos/solis_logo.webp" alt="Solis" class="h-12 sm:h-14 max-h-14 max-w-[90%] object-contain group-hover:scale-105 transition-transform">
            <span class="text-xs font-extrabold text-slate-800 group-hover:text-blue-600">Solis (Ginlong)</span>
            <span class="text-[9px] font-bold text-slate-400 uppercase">Biến Tần Dự Án</span>
          </a>

          <!-- 4. GOODWE -->
          <a href="{{ route('brands') }}?brand=goodwe" class="brand-select-tile p-4 bg-slate-50 hover:bg-blue-50 border border-slate-200 hover:border-blue-500 rounded-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-2 shadow-sm" data-brand="goodwe">
            <img src="{{ asset('assets/images/') }}/logos/goodwe_logo.png" alt="GoodWe" class="h-12 sm:h-14 max-h-14 max-w-[90%] object-contain group-hover:scale-105 transition-transform">
            <span class="text-xs font-extrabold text-slate-800 group-hover:text-blue-600">GoodWe</span>
            <span class="text-[9px] font-bold text-slate-400 uppercase">Hòa Lưới & Hybrid</span>
          </a>

          <!-- 5. LUMENTREE -->
          <a href="{{ route('brands') }}?brand=lumentree" class="brand-select-tile p-4 bg-slate-50 hover:bg-blue-50 border border-slate-200 hover:border-blue-500 rounded-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-2 shadow-sm" data-brand="lumentree">
            <img src="{{ asset('assets/images/') }}/logos/lumentree_logo.avif" alt="Lumentree" class="h-12 sm:h-14 max-h-14 max-w-[90%] object-contain group-hover:scale-105 transition-transform">
            <span class="text-xs font-extrabold text-slate-800 group-hover:text-blue-600">Lumentree</span>
            <span class="text-[9px] font-bold text-slate-400 uppercase">Biến Tần Bám Tải</span>
          </a>

          <!-- 6. BASTIONS -->
          <a href="{{ route('brands') }}?brand=bastions" class="brand-select-tile p-4 bg-slate-50 hover:bg-blue-50 border border-slate-200 hover:border-blue-500 rounded-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-2 shadow-sm" data-brand="bastions">
            <img src="{{ asset('assets/images/') }}/logos/bastionsenergy_logo.png" alt="Bastions Energy" class="h-12 sm:h-14 max-h-14 max-w-[90%] object-contain group-hover:scale-105 transition-transform">
            <span class="text-xs font-extrabold text-slate-800 group-hover:text-blue-600">Bastions Energy</span>
            <span class="text-[9px] font-bold text-slate-400 uppercase">Pin N-Type TOPCon</span>
          </a>

          <!-- 7. LONGI -->
          <a href="{{ route('brands') }}?brand=longi" class="brand-select-tile p-4 bg-slate-50 hover:bg-blue-50 border border-slate-200 hover:border-blue-500 rounded-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-2 shadow-sm" data-brand="longi">
            <img src="{{ asset('assets/images/') }}/logos/longi_logo.png" alt="LONGi" class="h-12 sm:h-14 max-h-14 max-w-[90%] object-contain group-hover:scale-105 transition-transform">
            <span class="text-xs font-extrabold text-slate-800 group-hover:text-blue-600">LONGi Solar</span>
            <span class="text-[9px] font-bold text-slate-400 uppercase">Tấm Pin Mono 550W+</span>
          </a>

          <!-- 8. VSUN -->
          <a href="{{ route('brands') }}?brand=vsun" class="brand-select-tile p-4 bg-slate-50 hover:bg-blue-50 border border-slate-200 hover:border-blue-500 rounded-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-2 shadow-sm" data-brand="vsun">
            <img src="{{ asset('assets/images/') }}/logos/vsun_logo.png" alt="VSUN" class="h-12 sm:h-14 max-h-14 max-w-[90%] object-contain group-hover:scale-105 transition-transform">
            <span class="text-xs font-extrabold text-slate-800 group-hover:text-blue-600">VSUN Solar</span>
            <span class="text-[9px] font-bold text-slate-400 uppercase">Công Nghệ Nhật Bản</span>
          </a>

          <!-- 9. AE SOLAR -->
          <a href="{{ route('brands') }}?brand=aesolar" class="brand-select-tile p-4 bg-slate-50 hover:bg-blue-50 border border-slate-200 hover:border-blue-500 rounded-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-2 shadow-sm" data-brand="aesolar">
            <img src="{{ asset('assets/images/') }}/logos/aesolar_logo.png" alt="AE Solar" class="h-12 sm:h-14 max-h-14 max-w-[90%] object-contain group-hover:scale-105 transition-transform">
            <span class="text-xs font-extrabold text-slate-800 group-hover:text-blue-600">AE Solar</span>
            <span class="text-[9px] font-bold text-slate-400 uppercase">Tiêu Chuẩn Đức</span>
          </a>

          <!-- 10. WORLD ENERGY -->
          <a href="{{ route('brands') }}?brand=worldenergy" class="brand-select-tile p-4 bg-slate-50 hover:bg-blue-50 border border-slate-200 hover:border-blue-500 rounded-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-2 shadow-sm" data-brand="worldenergy">
            <img src="{{ asset('assets/images/') }}/logos/worldenergy_logo.png" alt="World Energy" class="h-12 sm:h-14 max-h-14 max-w-[90%] object-contain group-hover:scale-105 transition-transform">
            <span class="text-xs font-extrabold text-slate-800 group-hover:text-blue-600">World Energy</span>
            <span class="text-[9px] font-bold text-slate-400 uppercase">Tấm Pin Công Nghiệp</span>
          </a>

          <!-- 11. JINKO -->
          <a href="{{ route('brands') }}?brand=jinko" class="brand-select-tile p-4 bg-slate-50 hover:bg-blue-50 border border-slate-200 hover:border-blue-500 rounded-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-2 shadow-sm" data-brand="jinko">
            <img src="{{ asset('assets/images/') }}/logos/jinko_logo.webp" alt="JinKO" class="h-12 sm:h-14 max-h-14 max-w-[90%] object-contain group-hover:scale-105 transition-transform">
            <span class="text-xs font-extrabold text-slate-800 group-hover:text-blue-600">JinKO Solar</span>
            <span class="text-[9px] font-bold text-slate-400 uppercase">Top 1 Thế Giới</span>
          </a>

          <!-- 12. XINPZ -->
          <a href="{{ route('brands') }}?brand=xinpz" class="brand-select-tile p-4 bg-slate-50 hover:bg-blue-50 border border-slate-200 hover:border-blue-500 rounded-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-2 shadow-sm" data-brand="xinpz">
            <img src="{{ asset('assets/images/') }}/logos/xinpz_logo.jpg" alt="Xinpz" class="h-12 sm:h-14 max-h-14 max-w-[90%] object-contain group-hover:scale-105 transition-transform">
            <span class="text-xs font-extrabold text-slate-800 group-hover:text-blue-600">Xinpz Energy</span>
            <span class="text-[9px] font-bold text-slate-400 uppercase">Pin Lithium LiFePO4</span>
          </a>

        </div>
      </div>

      <!-- ACTIVE FILTER BANNER & RESULTS GRID -->
      <div id="brand-results-section" class="space-y-6">
        
        <!-- ACTIVE FILTER BANNER -->
        <div id="active-filter-banner" class="flex items-center justify-between bg-blue-600 text-white p-6 rounded-2xl shadow-lg shadow-blue-600/20">
          <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center font-black text-xl">
              <i class="fas fa-filter"></i>
            </div>
            <div>
              <span class="text-[10px] text-blue-200 font-bold uppercase tracking-wider block">Đang Hiển Thị Sản Phẩm Phân Loại</span>
              <h3 class="text-lg sm:text-xl font-extrabold font-heading">
                Thương Hiệu: <span id="active-filter-label" class="text-yellow-300 uppercase">Tất Cả Thương Hiệu</span>
              </h3>
            </div>
          </div>
          <button id="clear-active-filter-btn" type="button" class="px-4 py-2.5 bg-white text-blue-700 hover:bg-blue-50 rounded-xl font-extrabold text-xs transition-all cursor-pointer shadow-md flex items-center gap-2">
            <i class="fas fa-redo"></i>
            <span>Xem Tất Cả 130 Sản Phẩm</span>
          </button>
        </div>

        <!-- PRODUCT GRID & CONTROLS -->
        <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/90 shadow-sm space-y-6">
          <div class="flex flex-col sm:flex-row items-center justify-between gap-4 border-b border-slate-100 pb-4">
            <div class="text-xs text-slate-500">
              Hiển thị <span id="visible-count" class="font-extrabold text-slate-900">0</span> thiết bị chính hãng
            </div>
            <div class="flex items-center gap-3 w-full sm:w-auto">
              <span class="text-xs text-slate-500 font-medium whitespace-nowrap">Sắp xếp:</span>
              <select id="product-sort-select" class="w-full sm:w-44 px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:outline-none focus:border-blue-600">
                <option value="default">Mặc định</option>
                <option value="az">Tên: A - Z</option>
                <option value="za">Tên: Z - A</option>
              </select>
            </div>
          </div>

          <!-- DYNAMIC PRODUCTS CONTAINER -->
          <div id="products-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            @include('partials.product-grid-items')
          </div>

          <!-- CLIENT-SIDE PAGINATION -->
          <div id="pagination-container"></div>
        </div>

      </div>

    </div>
  </section>

  <!-- UNIFIED FOOTER -->
@endsection
