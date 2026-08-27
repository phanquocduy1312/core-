@extends('layouts.app')

@section('title', 'Tin Tức & Kiến Thức Năng Lượng Mặt Trời - BÁCH ANH GROUP')
@section('meta_description', 'Cập nhật tin tức, kiến thức kỹ thuật, hướng dẫn lắp đặt và xu hướng công nghệ điện năng lượng mặt trời.')

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
        <span class="text-white font-bold">Tin Tức & Kỹ Thuật</span>
      </div>
      <h1 class="text-3xl sm:text-4xl font-extrabold font-heading">Tin Tức & Kiến Thức Điện Mặt Trời</h1>
      <p class="text-xs sm:text-sm text-slate-300 max-w-3xl">
        Cập nhật hướng dẫn kỹ thuật chọn bộ biến tần Inverter Hybrid, kinh nghiệm bảo trì pin lưu trữ Lithium và xu hướng công nghệ năng lượng tái tạo mới nhất năm 2026.
      </p>
    </div>
  </section>

  <!-- FEATURED NEWS & ARTICLES GRID -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 space-y-12">
      
      <!-- HIGHLIGHT FEATURED ARTICLE -->
      <div class="bg-slate-900 rounded-3xl overflow-hidden text-white border border-slate-800 shadow-2xl grid grid-cols-1 lg:grid-cols-12 group">
        <div class="lg:col-span-7 relative h-72 lg:h-auto overflow-hidden">
          <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Inverter Hybrid 2026" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90">
          <span class="absolute top-4 left-4 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-3 py-1 rounded-full">Kỹ Thuật Nổi Bật</span>
        </div>
        <div class="lg:col-span-5 p-8 sm:p-10 flex flex-col justify-between space-y-6">
          <div class="space-y-3">
            <span class="text-xs font-bold text-blue-400 uppercase tracking-wider">Hướng Dẫn Kỹ Thuật</span>
            <h2 class="text-2xl font-extrabold font-heading group-hover:text-blue-400 transition-colors">
              So Sánh Chi Tiết Biến Tần Inverter Hybrid LuxpowerTek & Deye 2026
            </h2>
            <p class="text-xs text-slate-300 leading-relaxed">
              Đánh giá chuyên sâu về hiệu suất chuyển đổi, khả năng chịu quá tải, mạch bảo vệ IP66 và giao tiếp CAN Bus với pin Lithium LiFePO4 của 2 dòng biến tần Hybrid hàng đầu hiện nay.
            </p>
          </div>
          <div class="pt-4 border-t border-slate-800 flex items-center justify-between text-xs text-slate-400">
            <span><i class="fas fa-calendar-alt mr-1 text-blue-400"></i> Tháng 8, 2026</span>
            <a href="{{ route('contact') }}" class="font-bold text-blue-400 hover:text-blue-300 flex items-center gap-1.5">
              Đọc Bài Viết <i class="fas fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- ARTICLES GRID (3 COLS) -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <!-- ARTICLE 1 -->
        <article class="bg-slate-50 rounded-3xl overflow-hidden border border-slate-200/90 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col group">
          <div class="relative h-56 overflow-hidden bg-slate-100">
            <img src="{{ asset('assets/images/') }}/solar_panel_550w.png" alt="Tấm Pin LONGI 550W N-Type" class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-300">
            <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md">Công Nghệ Pin</span>
          </div>
          <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
            <div class="space-y-2">
              <span class="text-[10px] text-slate-400 font-bold uppercase"><i class="fas fa-calendar-alt mr-1"></i> 04/08/2026</span>
              <h3 class="text-base font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors font-heading line-clamp-2">
                Tại Sao Công Nghệ Tấm Pin N-Type TOPCon 550W+ Đang Trở Thành Xu Hướng?
              </h3>
              <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                Phân tích lý do vì sao tấm pin N-Type có hệ số nhiệt độ tốt hơn, giảm suy hao công suất PID và mang lại sản lượng điện cao hơn 15% so với pin P-Type truyền thống.
              </p>
            </div>
            <a href="{{ route('contact') }}" class="text-xs font-extrabold text-blue-600 hover:text-blue-700 flex items-center gap-1.5 pt-3 border-t border-slate-200/80">
              Đọc Chi Tiết <i class="fas fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </article>

        <!-- ARTICLE 2 -->
        <article class="bg-slate-50 rounded-3xl overflow-hidden border border-slate-200/90 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col group">
          <div class="relative h-56 overflow-hidden bg-slate-100">
            <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Pin Lithium Bastions 48V" class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-300">
            <span class="absolute top-3 left-3 bg-purple-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md">Bảo Trì ESS</span>
          </div>
          <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
            <div class="space-y-2">
              <span class="text-[10px] text-slate-400 font-bold uppercase"><i class="fas fa-calendar-alt mr-1"></i> 02/08/2026</span>
              <h3 class="text-base font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors font-heading line-clamp-2">
                Bí Quyết Kéo Dài Tuổi Thọ Pin Lưu Trữ Lithium LiFePO4 Trên 10 Năm
              </h3>
              <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                Cài đặt thông số điện áp DoD (Depth of Discharge) hợp lý trên Inverter Hybrid và nguyên tắc thông gió giúp bảo vệ mạch BMS pin lưu trữ vận hành bền bỉ 6,000 chu kỳ.
              </p>
            </div>
            <a href="{{ route('contact') }}" class="text-xs font-extrabold text-blue-600 hover:text-blue-700 flex items-center gap-1.5 pt-3 border-t border-slate-200/80">
              Đọc Chi Tiết <i class="fas fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </article>

        <!-- ARTICLE 3 -->
        <article class="bg-slate-50 rounded-3xl overflow-hidden border border-slate-200/90 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col group">
          <div class="relative h-56 overflow-hidden bg-slate-100">
            <img src="{{ asset('assets/images/') }}/dc_solar_cable_mc4.png" alt="Cáp DC Solar Xinpz" class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-300">
            <span class="absolute top-3 left-3 bg-teal-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md">An Toàn Điện</span>
          </div>
          <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
            <div class="space-y-2">
              <span class="text-[10px] text-slate-400 font-bold uppercase"><i class="fas fa-calendar-alt mr-1"></i> 28/07/2026</span>
              <h3 class="text-base font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors font-heading line-clamp-2">
                Tiêu Chuẩn Đấu Nối Cáp DC Solar & Đầu Nối MC4 Staubli Chống Phát Hồ Quang
              </h3>
              <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                Hướng dẫn kỹ thuật bấm cos chuẩn xác cho dây cáp điện DC 4mm2 / 6mm2 và cách kiểm tra độ kín nước IP68 của khớp nối MC4 tránh sự cố phóng điện DC Arc Fault.
              </p>
            </div>
            <a href="{{ route('contact') }}" class="text-xs font-extrabold text-blue-600 hover:text-blue-700 flex items-center gap-1.5 pt-3 border-t border-slate-200/80">
              Đọc Chi Tiết <i class="fas fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </article>

      </div>
    </div>
  </section>

  <!-- UNIFIED FOOTER -->
@endsection
