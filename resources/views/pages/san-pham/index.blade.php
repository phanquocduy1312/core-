@extends('layouts.app')

@section('title', 'Danh Mục Thiết Bị & Vật Tư Điện Năng Lượng Mặt Trời - BÁCH ANH GROUP')
@section('meta_description', 'Danh mục sản phẩm thiết bị & vật tư điện năng lượng mặt trời chính hãng.')

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

  
  </header>

  <!-- BANNER -->
  <section class="bg-slate-900 text-white py-16 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 relative z-10 text-center">
      <h1 class="text-3xl sm:text-4xl font-extrabold font-heading" data-i18n="prod_title">Danh Mục Thiết Bị & Vật Tư Điện Năng Lượng Mặt Trời</h1>
      <div class="flex justify-center items-center gap-2 text-xs text-slate-400 mt-3">
        <a href="{{ route('home') }}" class="hover:text-white" data-i18n="nav_home">Trang chủ</a>
        <i class="fas fa-chevron-right text-[10px]"></i>
        <span class="text-blue-400" data-i18n="nav_products">Sản Phẩm Solar</span>
      </div>
    </div>
  </section>

  <!-- PRODUCTS MAIN CONTAINER WITH SIDEBAR -->
  <section class="py-16 bg-white">
    <div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        
        <!-- SIDEBAR BỘ LỌC SOLAR (LEFT COLUMN - 4 COLS) -->
        <aside class="lg:col-span-4 space-y-8">
          <!-- WIDGET 1: TÌM KIẾM SẢN PHẨM SOLAR -->
          <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-4">
            <h3 class="text-base font-bold text-slate-900 font-heading flex items-center gap-2">
              <i class="fas fa-search text-blue-600"></i> Tìm Kiếm Thiết Bị Solar
            </h3>
            <div class="relative">
              <input type="text" id="product-search-input" placeholder="Nhập tên Inverter, Tấm pin, Pin Lithium, Cáp DC..." class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all">
              <i class="fas fa-search absolute left-3.5 top-3.5 text-slate-400 text-xs"></i>
            </div>
          </div>

          <!-- WIDGET 2: DANH MỤC SẢN PHẨM SOLAR -->
          <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-4">
            <h3 class="text-base font-bold text-slate-900 font-heading flex items-center gap-2">
              <i class="fas fa-list-ul text-blue-600"></i> Phân Loại Thiết Bị Solar
            </h3>
            <div class="space-y-1.5">
              <button type="button" class="filter-btn active w-full flex items-center justify-between px-4 py-3 rounded-xl text-xs font-semibold transition-all bg-blue-600 text-white shadow-md text-left cursor-pointer" data-filter="all">
                <span class="flex items-center gap-2.5">
                  <i class="fas fa-th-large text-xs"></i> Tất Cả Thiết Bị Solar
                </span>
                <span data-count-for="all" class="px-2 py-0.5 rounded-full text-[10px] bg-white/20 text-white font-bold">130</span>
              </button>

              <button type="button" class="filter-btn w-full flex items-center justify-between px-4 py-3 rounded-xl text-xs font-semibold transition-all bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-left cursor-pointer" data-filter="panel">
                <span class="flex items-center gap-2.5">
                  <i class="fas fa-solar-panel text-blue-500"></i> Tấm pin mặt trời
                </span>
                <span data-count-for="panel" class="px-2 py-0.5 rounded-full text-[10px] bg-blue-100 text-blue-700 font-bold">35</span>
              </button>

              <button type="button" class="filter-btn w-full flex items-center justify-between px-4 py-3 rounded-xl text-xs font-semibold transition-all bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-left cursor-pointer" data-filter="inverter">
                <span class="flex items-center gap-2.5">
                  <i class="fas fa-bolt text-blue-500"></i> Inverter
                </span>
                <span data-count-for="inverter" class="px-2 py-0.5 rounded-full text-[10px] bg-blue-100 text-blue-700 font-bold">45</span>
              </button>

              <button type="button" class="filter-btn w-full flex items-center justify-between px-4 py-3 rounded-xl text-xs font-semibold transition-all bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-left cursor-pointer" data-filter="battery">
                <span class="flex items-center gap-2.5">
                  <i class="fas fa-battery-full text-blue-500"></i> Pin lưu trữ
                </span>
                <span data-count-for="battery" class="px-2 py-0.5 rounded-full text-[10px] bg-blue-100 text-blue-700 font-bold">30</span>
              </button>

              <button type="button" class="filter-btn w-full flex items-center justify-between px-4 py-3 rounded-xl text-xs font-semibold transition-all bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-left cursor-pointer" data-filter="pump">
                <span class="flex items-center gap-2.5">
                  <i class="fas fa-water text-blue-500"></i> Biến tần bơm
                </span>
                <span data-count-for="pump" class="px-2 py-0.5 rounded-full text-[10px] bg-blue-100 text-blue-700 font-bold">5</span>
              </button>

              <button type="button" class="filter-btn w-full flex items-center justify-between px-4 py-3 rounded-xl text-xs font-semibold transition-all bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-left cursor-pointer" data-filter="accessories">
                <span class="flex items-center gap-2.5">
                  <i class="fas fa-plug text-blue-500"></i> Phụ kiện solar
                </span>
                <span data-count-for="accessories" class="px-2 py-0.5 rounded-full text-[10px] bg-slate-100 text-slate-600 font-bold">15</span>
              </button>
            </div>
          </div>

          <!-- WIDGET 2B: LỌC THEO THƯƠNG HIỆU HÃNG (FILTER BY BRAND) -->
          <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-3">
            <h3 class="text-base font-bold text-slate-900 font-heading flex items-center gap-2">
              <i class="fas fa-tags text-blue-600"></i> Lọc Theo Thương Hiệu
            </h3>
            
            <!-- TOP FEATURED BRANDS (VISIBLE BY DEFAULT) -->
            <div class="grid grid-cols-2 gap-2 text-[11px]">
              <button type="button" class="brand-filter-btn active px-2.5 py-2 rounded-xl font-semibold bg-blue-600 text-white shadow-md text-center cursor-pointer" data-brand="all">Tất Cả Hãng</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="jinko">JinKO Solar</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="huawei">HUAWEI</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="longi">LONGi Solar</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="growatt">Growatt</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="solis">Solis</button>
            </div>

            <!-- MORE BRANDS (COLLAPSIBLE) -->
            <div id="more-brands-wrapper" class="hidden grid grid-cols-2 gap-2 text-[11px] pt-1">
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="jolywood">JOLYWOOD</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="narada">Narada</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="pylontech">PYLONTECH</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="luxpower">LUXPOWER</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="hinaess">HINA ESS</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="chisageess">CHISAGE ESS</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="canadian">Canadian</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="deye">Deye Solar</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="vsun">VSUN Solar</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="aesolar">AE Solar</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="worldenergy">World Energy</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="xinpz">Xinpz</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="sma">SMA Solar</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="sungrow">Sungrow</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="trina">Trina Solar</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="jasolar">JA Solar</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="goodwe">GoodWe</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="lumentree">Lumentree</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="enphase">Enphase</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="fronius">Fronius</button>
              <button type="button" class="brand-filter-btn px-2.5 py-2 rounded-xl font-semibold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 text-center shadow-sm cursor-pointer" data-brand="bastions">Bastions</button>
            </div>

            <!-- TOGGLE BUTTON -->
            <button id="toggle-more-brands-btn" type="button" class="w-full mt-2 py-2 px-3 text-xs font-bold text-blue-600 hover:text-blue-700 bg-white hover:bg-blue-50/80 border border-blue-200/80 rounded-xl transition-all flex items-center justify-center gap-1.5 shadow-sm cursor-pointer">
              <span id="toggle-brands-text">Xem Thêm (21 Hãng Khác)</span>
              <i id="toggle-brands-icon" class="fas fa-chevron-down text-[10px] transition-transform duration-300"></i>
            </button>
          </div>

          <!-- WIDGET 3: HỖ TRỢ TƯ VẤN SOLAR TRỰC TIẾP -->
          <div class="bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900 text-white p-6 rounded-2xl shadow-xl space-y-4 relative overflow-hidden">
            <div class="flex items-center gap-3">
              <div class="w-12 h-12 rounded-xl bg-blue-600 text-white flex items-center justify-center font-extrabold text-xl shadow-lg">
                <i class="fas fa-solar-panel"></i>
              </div>
              <div>
                <span class="text-[10px] uppercase font-bold text-blue-300 tracking-wider">Tư Vấn Công Suất Solar</span>
                <h4 class="font-bold text-sm">Hỗ Trợ Kỹ Thuật 24/7</h4>
              </div>
            </div>
            <p class="text-xs text-slate-300 leading-relaxed">
              Bạn cần tư vấn chọn công suất Inverter InfiniSolar 10KW hoặc số lượng tấm pin mặt trời phù hợp? Liên hệ đại diện công ty:
            </p>
            <div class="pt-2 space-y-2 text-xs">
              <div class="flex items-center gap-2 text-slate-200">
                <i class="fas fa-user text-blue-400"></i> Đại diện: <span class="font-bold text-white">Mr. Lưu Thế Dũng</span>
              </div>
              <a href="tel:0963982186" class="flex items-center gap-2 text-blue-400 font-bold hover:text-blue-300">
                <i class="fas fa-phone-alt"></i> Hotline: 0963 982 186
              </a>
            </div>
            <a href="{{ route('contact') }}" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs rounded-xl text-center block transition-all shadow-md mt-2">
              Nhận Báo Giá Vật Tư Trực Tuyến
            </a>
          </div>
        </aside>

        <!-- MAIN PRODUCT GRID (RIGHT COLUMN - 8 COLS) -->
        <main class="lg:col-span-8 space-y-6">
          
          <!-- ACTIVE FILTER BANNER (DYNAMICALLY SHOWN WHEN BRAND OR CATEGORY IS FILTERED) -->
          <div id="active-filter-banner" class="hidden flex items-center justify-between bg-blue-50 border border-blue-200/80 px-4 py-3 rounded-2xl text-xs font-semibold text-blue-900 shadow-sm">
            <div class="flex items-center gap-2">
              <i class="fas fa-filter text-blue-600 text-sm"></i>
              <span>Đang lọc theo: <strong id="active-filter-label" class="text-blue-700 font-extrabold uppercase">...</strong></span>
            </div>
            <button id="clear-active-filter-btn" type="button" class="px-3 py-1 bg-white hover:bg-blue-600 hover:text-white border border-blue-200 text-blue-700 rounded-lg font-bold text-[11px] transition-all cursor-pointer shadow-sm">
              <i class="fas fa-times mr-1"></i> Xem Tất Cả Sản Phẩm
            </button>
          </div>

          <!-- TOPBAR CONTROLS: COUNT & SORT -->
          <div class="flex flex-wrap items-center justify-between gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-200/80">
            <div class="text-xs text-slate-600 font-medium">
              Hiển thị <span id="visible-count" class="font-bold text-slate-900">1-8 trên tổng số 130</span> thiết bị & vật tư điện mặt trời
            </div>

            <div class="flex items-center gap-3">
              <label for="product-sort-select" class="text-xs font-bold text-slate-700 whitespace-nowrap">Sắp xếp:</label>
              <select id="product-sort-select" class="px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs text-slate-800 font-semibold focus:outline-none focus:border-blue-600 transition-all">
                <option value="default">Mới Nhất</option>
                <option value="az">Tên A-Z</option>
                <option value="za">Tên Z-A</option>
              </select>
            </div>
          </div>

          <!-- PRODUCTS GRID - UNIFORM 3-COLUMN LAYOUT (100% SOLAR PRODUCTS) -->
          <div id="products-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            @include('partials.product-grid-items')

          <!-- CLIENT-SIDE PAGINATION CONTAINER -->
          <div id="pagination-container" class="pt-6">
            <div class="flex flex-wrap items-center justify-center gap-2 pt-8 mt-8 border-t border-slate-200/80">
              <button class="px-3.5 py-2 rounded-xl text-xs font-bold bg-slate-100 text-slate-400 cursor-not-allowed border border-slate-200 flex items-center gap-1.5" disabled>
                <i class="fas fa-chevron-left text-[10px]"></i> <span>Trang Trước</span>
              </button>
              <button class="w-9 h-9 rounded-xl text-xs font-extrabold bg-blue-600 text-white shadow-md shadow-blue-600/30 border border-blue-600 flex items-center justify-center">1</button>
              <button class="w-9 h-9 rounded-xl text-xs font-extrabold bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-200/90 flex items-center justify-center">2</button>
              <button class="px-3.5 py-2 rounded-xl text-xs font-bold bg-white text-slate-700 hover:bg-blue-600 hover:text-white border border-slate-200/90 shadow-sm flex items-center gap-1.5">
                <span>Trang Sau</span> <i class="fas fa-chevron-right text-[10px]"></i>
              </button>
            </div>
          </div>
        </main>

      </div>
    </div>
  </section>

  <!-- UNIFIED FOOTER -->
@endsection
