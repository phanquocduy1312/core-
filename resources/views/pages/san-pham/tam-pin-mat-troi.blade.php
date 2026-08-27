@extends('layouts.app')

@section('title', 'Tấm Pin Mặt Trời Mono Crystalline 550W+ - BÁCH ANH GROUP')
@section('meta_description', 'Tấm pin năng lượng mặt trời Mono PERC & N-Type TOPCon 550W+ chính hãng: LONGi, Canadian Solar, VSUN, AE Solar.')

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
        <span class="text-white font-bold">1. Tấm Pin Mặt Trời</span>
      </div>
      <h1 class="text-3xl sm:text-4xl font-extrabold font-heading">Danh Mục Tấm Pin Mặt Trời (Solar Panels)</h1>
      <p class="text-xs sm:text-sm text-slate-300 max-w-3xl">
        Tổng hợp các dòng tấm pin quang điện Mono Crystalline công suất cao 550W+ được phân loại theo các thương hiệu hàng đầu thế giới: LONGi Solar, VSUN Solar, AE Solar Germany, Jinko Solar.
      </p>
    </div>
  </section>

  <!-- MAIN CATALOG WITH SIDEBAR & EXPANDED CONTAINER -->
  <section class="py-12 bg-slate-50">
    <div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        <!-- MAIN CONTENT (RIGHT COLUMN - 12 COLS FULL WIDTH) -->
        <main class="lg:col-span-12 space-y-8">
          <!-- LOAD MORE / VIEW ALL PRODUCTS CALL-TO-ACTION -->
          <div class="pt-6 border-t border-slate-200/80 flex flex-col sm:flex-row items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow">
            <div>
              <h4 class="font-extrabold text-slate-900 text-sm font-heading flex items-center gap-2">
                <i class="fas fa-boxes text-blue-600"></i> Xem Thêm Tấm Pin Mặt Trời Khác
              </h4>
              <p class="text-xs text-slate-500 mt-1">Truy cập cửa hàng tổng hợp để xem đầy đủ công suất & bộ lọc tất cả sản phẩm Tấm Pin Mặt Trời.</p>
            </div>
            <a href="san-pham.html?filter=panel" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-extrabold text-xs rounded-xl shadow-md shadow-blue-600/20 hover:shadow-lg transition-all flex items-center gap-2 whitespace-nowrap cursor-pointer">
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
