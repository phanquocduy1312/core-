@extends('layouts.app')

@section('title', 'Dự Án Tiêu Biểu - BÁCH ANH GROUP')
@section('meta_description', 'Tổng hợp các dự án điện năng lượng mặt trời tiêu biểu do Bách Anh Group cung cấp vật tư thiết bị.')

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
  <section class="bg-gradient-to-r from-slate-900 via-blue-950 to-slate-900 text-white py-16 px-4 sm:px-8 relative overflow-hidden">
    <div class="max-w-7xl mx-auto space-y-4 relative z-10 text-center sm:text-left">
      <div class="flex items-center justify-center sm:justify-start gap-2 text-xs text-blue-300">
        <a href="{{ route('home') }}" class="hover:text-white">Trang chủ</a>
        <i class="fas fa-chevron-right text-[9px]"></i>
        <span class="text-white font-bold">Dự Án Năng Lượng Mặt Trời</span>
      </div>
      <h1 class="text-3xl sm:text-5xl font-extrabold font-heading">Dự Án Điện Mặt Trời Tiêu Biểu</h1>
      <p class="text-xs sm:text-base text-slate-300 max-w-3xl leading-relaxed">
        Hơn 500+ dự án điện mặt trời mái nhà xưởng công nghiệp, biệt thự gia đình Hybrid và hệ thống bơm tưới tiêu nông nghiệp Solar đã sử dụng vật tư thiết bị chính hãng cung cấp bởi Bách Anh Group.
      </p>

      <!-- FILTER TABS -->
      <div id="project-filter-tabs" class="flex flex-wrap items-center justify-center sm:justify-start gap-2 pt-4">
        <button class="proj-tab-btn active px-4 py-2 bg-blue-600 text-white text-xs font-bold rounded-xl shadow-md transition-all cursor-pointer" data-filter="all">Tất Cả Dự Án</button>
        <button class="proj-tab-btn px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold rounded-xl border border-slate-700 transition-all cursor-pointer" data-filter="industrial">🏭 ĐMN Nhà Xưởng</button>
        <button class="proj-tab-btn px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold rounded-xl border border-slate-700 transition-all cursor-pointer" data-filter="residential">🏠 ĐMN Hybrid Gia Đình</button>
        <button class="proj-tab-btn px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold rounded-xl border border-slate-700 transition-all cursor-pointer" data-filter="pump">🌾 Bơm Solar Tưới Tiêu</button>
        <button class="proj-tab-btn px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold rounded-xl border border-slate-700 transition-all cursor-pointer" data-filter="storage">🔋 Trạm Pin Lưu Trữ ESS</button>
      </div>
    </div>
  </section>

  <!-- PROJECTS SHOWCASE GRID -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
      
      <div id="projects-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        <!-- PROJECT 1: ĐMN NHÀ XƯỞNG 1.2MWP -->
        <div class="project-card bg-slate-50 rounded-3xl overflow-hidden border border-slate-200/90 shadow-md hover:shadow-2xl transition-all duration-300 flex flex-col group" data-category="industrial">
          <div class="relative h-64 overflow-hidden bg-slate-900">
            <img src="{{ asset('assets/images/') }}/solar_panel_550w.png" alt="Dự Án Điện Mặt Trời Mái Nhà Xưởng 1.2MWp" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 opacity-90">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
            <span class="absolute top-4 left-4 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-3 py-1 rounded-full shadow">
              <i class="fas fa-industry mr-1"></i> Nhà Xưởng Công Nghiệp
            </span>
            <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-xs text-white">
              <span class="font-bold"><i class="fas fa-map-marker-alt text-red-500 mr-1"></i> KCN VSIP Bắc Ninh</span>
              <span class="font-extrabold text-amber-400">1.2 MWp</span>
            </div>
          </div>
          <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
            <div class="space-y-2">
              <h3 class="text-lg font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors font-heading">
                Dự Án Điện Mặt Trời Mái Nhà Xưởng 1.2MWp - KCN VSIP Bắc Ninh
              </h3>
              <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                Cung cấp vật tư trọn gói gồm 2,180 tấm pin mặt trời LONGI 550W Hi-MO 5, 20 bộ Inverter hòa lưới Solis 50KW 3 Pha, tủ điện AC/DC chống sét và khung rail nhôm định hình AL6005-T5.
              </p>
            </div>
            
            <div class="space-y-3 pt-3 border-t border-slate-200/80">
              <div class="grid grid-cols-3 gap-2 text-center">
                <div class="p-2 bg-white rounded-xl border border-slate-100">
                  <span class="block text-[10px] text-slate-400 font-bold uppercase">Công Suất</span>
                  <span class="text-xs font-black text-blue-600">1.2 MWp</span>
                </div>
                <div class="p-2 bg-white rounded-xl border border-slate-100">
                  <span class="block text-[10px] text-slate-400 font-bold uppercase">Tấm Pin</span>
                  <span class="text-xs font-black text-slate-900">2,180 Tấm</span>
                </div>
                <div class="p-2 bg-white rounded-xl border border-slate-100">
                  <span class="block text-[10px] text-slate-400 font-bold uppercase">Tiết Kiệm</span>
                  <span class="text-xs font-black text-emerald-600">2.4 Tỷ/Năm</span>
                </div>
              </div>

              <a href="{{ route('contact') }}" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs rounded-xl text-center block shadow-md shadow-blue-600/20">
                <i class="fas fa-file-alt mr-1"></i> Tư Vấn Vật Tư Nhà Xưởng
              </a>
            </div>
          </div>
        </div>

        <!-- PROJECT 2: ĐIỆN MẶT TRỜI HYBRID 15KW BIỆT THỰ -->
        <div class="project-card bg-slate-50 rounded-3xl overflow-hidden border border-slate-200/90 shadow-md hover:shadow-2xl transition-all duration-300 flex flex-col group" data-category="residential">
          <div class="relative h-64 overflow-hidden bg-slate-900">
            <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Điện Mặt Trời Hybrid 15KW Vinhomes" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 opacity-90">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
            <span class="absolute top-4 left-4 bg-emerald-600 text-white text-[10px] uppercase font-extrabold px-3 py-1 rounded-full shadow">
              <i class="fas fa-home mr-1"></i> Biệt Thự Cao Cấp
            </span>
            <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-xs text-white">
              <span class="font-bold"><i class="fas fa-map-marker-alt text-red-500 mr-1"></i> Vinhomes Riverside Hà Nội</span>
              <span class="font-extrabold text-amber-400">15 KWp</span>
            </div>
          </div>
          <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
            <div class="space-y-2">
              <h3 class="text-lg font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors font-heading">
                Hệ Thống Điện Mặt Trời Hybrid 15KW - Vinhomes Riverside
              </h3>
              <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                Hệ thống Hybrid cao cấp tự chủ nguồn điện 100% khi cúp điện. Sử dụng 28 tấm pin VSUN 550W Japan, Inverter Hybrid Luxpower 10KW LXP-10K và bộ pin lưu trữ Lithium Bastions Energy 48V 200Ah.
              </p>
            </div>
            
            <div class="space-y-3 pt-3 border-t border-slate-200/80">
              <div class="grid grid-cols-3 gap-2 text-center">
                <div class="p-2 bg-white rounded-xl border border-slate-100">
                  <span class="block text-[10px] text-slate-400 font-bold uppercase">Công Suất</span>
                  <span class="text-xs font-black text-blue-600">15 KWp</span>
                </div>
                <div class="p-2 bg-white rounded-xl border border-slate-100">
                  <span class="block text-[10px] text-slate-400 font-bold uppercase">Lưu Trữ</span>
                  <span class="text-xs font-black text-purple-600">9.6 kWh</span>
                </div>
                <div class="p-2 bg-white rounded-xl border border-slate-100">
                  <span class="block text-[10px] text-slate-400 font-bold uppercase">Dự Phòng</span>
                  <span class="text-xs font-black text-emerald-600">100% Khẩn Cấp</span>
                </div>
              </div>

              <a href="{{ route('contact') }}" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs rounded-xl text-center block shadow-md shadow-blue-600/20">
                <i class="fas fa-file-alt mr-1"></i> Tư Vấn Hybrid Gia Đình
              </a>
            </div>
          </div>
        </div>

        <!-- PROJECT 3: BƠM SOLAR TƯỚI TIÊU LÂM ĐỒNG -->
        <div class="project-card bg-slate-50 rounded-3xl overflow-hidden border border-slate-200/90 shadow-md hover:shadow-2xl transition-all duration-300 flex flex-col group" data-category="pump">
          <div class="relative h-64 overflow-hidden bg-slate-900">
            <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Bơm Solar Tưới Tiêu Lâm Đồng" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 opacity-90">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
            <span class="absolute top-4 left-4 bg-teal-600 text-white text-[10px] uppercase font-extrabold px-3 py-1 rounded-full shadow">
              <i class="fas fa-water mr-1"></i> Bơm Solar Nông Nghiệp
            </span>
            <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-xs text-white">
              <span class="font-bold"><i class="fas fa-map-marker-alt text-red-500 mr-1"></i> Trang Trại Nông Nghiệp Lâm Đồng</span>
              <span class="font-extrabold text-amber-400">15 KW</span>
            </div>
          </div>
          <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
            <div class="space-y-2">
              <h3 class="text-lg font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors font-heading">
                Hệ Thống Bơm Tưới Tiêu Solar 15KW - Nông Nghiệp Lâm Đồng
              </h3>
              <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                Giải pháp bơm nước tưới tiêu tự động 0đ tiền điện vận hành trực tiếp từ mảng 30 tấm pin AE Solar 550W Germany kết hợp Biến Tần Bơm Solar World Energy 15KW 3 Pha 380V.
              </p>
            </div>
            
            <div class="space-y-3 pt-3 border-t border-slate-200/80">
              <div class="grid grid-cols-3 gap-2 text-center">
                <div class="p-2 bg-white rounded-xl border border-slate-100">
                  <span class="block text-[10px] text-slate-400 font-bold uppercase">Công Suất Bơm</span>
                  <span class="text-xs font-black text-blue-600">15 KW</span>
                </div>
                <div class="p-2 bg-white rounded-xl border border-slate-100">
                  <span class="block text-[10px] text-slate-400 font-bold uppercase">Lưu Lượng</span>
                  <span class="text-xs font-black text-slate-900">80 m³/h</span>
                </div>
                <div class="p-2 bg-white rounded-xl border border-slate-100">
                  <span class="block text-[10px] text-slate-400 font-bold uppercase">Tiền Điện</span>
                  <span class="text-xs font-black text-emerald-600">0 Đồng/Tháng</span>
                </div>
              </div>

              <a href="{{ route('contact') }}" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs rounded-xl text-center block shadow-md shadow-blue-600/20">
                <i class="fas fa-file-alt mr-1"></i> Tư Vấn Biến Tần Bơm
              </a>
            </div>
          </div>
        </div>

        <!-- PROJECT 4: ĐMN NHÀ MÁY MAY HƯNG YÊN 800KWp -->
        <div class="project-card bg-slate-50 rounded-3xl overflow-hidden border border-slate-200/90 shadow-md hover:shadow-2xl transition-all duration-300 flex flex-col group" data-category="industrial">
          <div class="relative h-64 overflow-hidden bg-slate-900">
            <img src="{{ asset('assets/images/') }}/solar_panel_550w.png" alt="Dự Án 800KWp Hưng Yên" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 opacity-90">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
            <span class="absolute top-4 left-4 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-3 py-1 rounded-full shadow">
              <i class="fas fa-industry mr-1"></i> Nhà Máy Dệt May
            </span>
            <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-xs text-white">
              <span class="font-bold"><i class="fas fa-map-marker-alt text-red-500 mr-1"></i> KCN Phố Nối Hưng Yên</span>
              <span class="font-extrabold text-amber-400">800 KWp</span>
            </div>
          </div>
          <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
            <div class="space-y-2">
              <h3 class="text-lg font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors font-heading">
                Dự Án Điện Mặt Trời Mái Nhà Máy May 800KWp - Hưng Yên
              </h3>
              <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                Cung cấp 1,450 tấm pin Jinko Solar 550W N-Type TOPCon, 16 bộ biến tần Sungrow 50KW và trọn bộ cáp DC Solar Xinpz 6mm2 chuẩn chống tia UV.
              </p>
            </div>
            
            <div class="space-y-3 pt-3 border-t border-slate-200/80">
              <div class="grid grid-cols-3 gap-2 text-center">
                <div class="p-2 bg-white rounded-xl border border-slate-100">
                  <span class="block text-[10px] text-slate-400 font-bold uppercase">Công Suất</span>
                  <span class="text-xs font-black text-blue-600">800 KWp</span>
                </div>
                <div class="p-2 bg-white rounded-xl border border-slate-100">
                  <span class="block text-[10px] text-slate-400 font-bold uppercase">Tấm Pin</span>
                  <span class="text-xs font-black text-slate-900">1,450 Tấm</span>
                </div>
                <div class="p-2 bg-white rounded-xl border border-slate-100">
                  <span class="block text-[10px] text-slate-400 font-bold uppercase">Giảm CO2</span>
                  <span class="text-xs font-black text-emerald-600">950 Tấn/Năm</span>
                </div>
              </div>

              <a href="{{ route('contact') }}" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs rounded-xl text-center block shadow-md shadow-blue-600/20">
                <i class="fas fa-file-alt mr-1"></i> Tư Vấn Dự Án Nhà Máy
              </a>
            </div>
          </div>
        </div>

        <!-- PROJECT 5: TRẠM PIN ESS 30KWH RESORT PHÚ QUỐC -->
        <div class="project-card bg-slate-50 rounded-3xl overflow-hidden border border-slate-200/90 shadow-md hover:shadow-2xl transition-all duration-300 flex flex-col group" data-category="storage">
          <div class="relative h-64 overflow-hidden bg-slate-900">
            <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Trạm Pin ESS 30kWh Phú Quốc" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 opacity-90">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
            <span class="absolute top-4 left-4 bg-purple-600 text-white text-[10px] uppercase font-extrabold px-3 py-1 rounded-full shadow">
              <i class="fas fa-microchip mr-1"></i> Trạm Lưu Trữ ESS
            </span>
            <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-xs text-white">
              <span class="font-bold"><i class="fas fa-map-marker-alt text-red-500 mr-1"></i> Resort Phú Quốc</span>
              <span class="font-extrabold text-amber-400">30 kWh Storage</span>
            </div>
          </div>
          <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
            <div class="space-y-2">
              <h3 class="text-lg font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors font-heading">
                Hệ Thống Pin Lưu Trữ ESS 30kWh & Inverter Deye 12KW - Phú Quốc
              </h3>
              <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                Giải pháp trạm pin lưu trữ năng lượng mặt trời ESS dung lượng 30kWh ghép nối 3 Module Pin Lithium Deye 48V 200Ah cùng Inverter Hybrid Deye 12KW 3 Pha chống muối biển.
              </p>
            </div>
            
            <div class="space-y-3 pt-3 border-t border-slate-200/80">
              <div class="grid grid-cols-3 gap-2 text-center">
                <div class="p-2 bg-white rounded-xl border border-slate-100">
                  <span class="block text-[10px] text-slate-400 font-bold uppercase">Dung Lượng</span>
                  <span class="text-xs font-black text-purple-600">30 kWh</span>
                </div>
                <div class="p-2 bg-white rounded-xl border border-slate-100">
                  <span class="block text-[10px] text-slate-400 font-bold uppercase">Biến Tần</span>
                  <span class="text-xs font-black text-blue-600">Deye 12KW</span>
                </div>
                <div class="p-2 bg-white rounded-xl border border-slate-100">
                  <span class="block text-[10px] text-slate-400 font-bold uppercase">Chuyển Mạch</span>
                  <span class="text-xs font-black text-emerald-600">&lt;10 ms</span>
                </div>
              </div>

              <a href="{{ route('contact') }}" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs rounded-xl text-center block shadow-md shadow-blue-600/20">
                <i class="fas fa-file-alt mr-1"></i> Tư Vấn Trạm Pin ESS
              </a>
            </div>
          </div>
        </div>

        <!-- PROJECT 6: ĐMN KHO LOGISTICS 500KWp HẢI PHÒNG -->
        <div class="project-card bg-slate-50 rounded-3xl overflow-hidden border border-slate-200/90 shadow-md hover:shadow-2xl transition-all duration-300 flex flex-col group" data-category="industrial">
          <div class="relative h-64 overflow-hidden bg-slate-900">
            <img src="{{ asset('assets/images/') }}/solar_panel_550w.png" alt="Dự Án 500KWp Hải Phòng" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 opacity-90">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
            <span class="absolute top-4 left-4 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-3 py-1 rounded-full shadow">
              <i class="fas fa-boxes mr-1"></i> Kho Logistics
            </span>
            <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-xs text-white">
              <span class="font-bold"><i class="fas fa-map-marker-alt text-red-500 mr-1"></i> Trung Tâm Logistics Hải Phòng</span>
              <span class="font-extrabold text-amber-400">500 KWp</span>
            </div>
          </div>
          <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
            <div class="space-y-2">
              <h3 class="text-lg font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors font-heading">
                Dự Án Điện Mặt Trời Mái Kho Logistics 500KWp - Hải Phòng
              </h3>
              <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                Cung cấp trọn bộ 910 tấm pin LONGI 550W, 10 bộ Inverter hòa lưới Solis 50KW, cáp DC Solar 6mm2 và kẹp pin nhôm anodized chống ăn mòn muối biển.
              </p>
            </div>
            
            <div class="space-y-3 pt-3 border-t border-slate-200/80">
              <div class="grid grid-cols-3 gap-2 text-center">
                <div class="p-2 bg-white rounded-xl border border-slate-100">
                  <span class="block text-[10px] text-slate-400 font-bold uppercase">Công Suất</span>
                  <span class="text-xs font-black text-blue-600">500 KWp</span>
                </div>
                <div class="p-2 bg-white rounded-xl border border-slate-100">
                  <span class="block text-[10px] text-slate-400 font-bold uppercase">Tấm Pin</span>
                  <span class="text-xs font-black text-slate-900">910 Tấm</span>
                </div>
                <div class="p-2 bg-white rounded-xl border border-slate-100">
                  <span class="block text-[10px] text-slate-400 font-bold uppercase">Hoàn Vốn</span>
                  <span class="text-xs font-black text-emerald-600">3.5 Năm</span>
                </div>
              </div>

              <a href="{{ route('contact') }}" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs rounded-xl text-center block shadow-md shadow-blue-600/20">
                <i class="fas fa-file-alt mr-1"></i> Tư Vấn Vật Tư Logistics
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- STATS & NĂNG LỰC CUNG ỨNG VẬT TƯ -->
  <section class="py-16 bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 space-y-12">
      <div class="text-center space-y-3">
        <span class="text-xs font-bold uppercase tracking-widest text-blue-400">Năng Lực Phân Phối Đã Được Kiểm Chứng</span>
        <h2 class="text-2xl sm:text-4xl font-extrabold font-heading">Con Số Ấn Tượng Qua Các Dự Án</h2>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <div class="bg-white/5 border border-white/10 p-6 rounded-2xl text-center space-y-2 backdrop-blur-sm">
          <span class="text-3xl sm:text-5xl font-black text-blue-400 font-heading">50+</span>
          <span class="block text-xs text-slate-300 font-bold uppercase">MWp Vật Tư Cung Cấp</span>
        </div>
        <div class="bg-white/5 border border-white/10 p-6 rounded-2xl text-center space-y-2 backdrop-blur-sm">
          <span class="text-3xl sm:text-5xl font-black text-emerald-400 font-heading">500+</span>
          <span class="block text-xs text-slate-300 font-bold uppercase">Dự Án Đã Hoàn Thành</span>
        </div>
        <div class="bg-white/5 border border-white/10 p-6 rounded-2xl text-center space-y-2 backdrop-blur-sm">
          <span class="text-3xl sm:text-5xl font-black text-amber-400 font-heading">100%</span>
          <span class="block text-xs text-slate-300 font-bold uppercase">Chính Hãng CO/CQ</span>
        </div>
        <div class="bg-white/5 border border-white/10 p-6 rounded-2xl text-center space-y-2 backdrop-blur-sm">
          <span class="text-3xl sm:text-5xl font-black text-sky-400 font-heading">24/7</span>
          <span class="block text-xs text-slate-300 font-bold uppercase">Hỗ Trợ Kỹ Thuật Đấu Nối</span>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA CONSULTATION -->
  <section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-8">
      <div class="bg-gradient-to-tr from-blue-700 to-blue-600 text-white rounded-3xl p-8 sm:p-12 shadow-2xl flex flex-col md:flex-row items-center justify-between gap-8 relative overflow-hidden">
        <div class="space-y-3 text-center md:text-left z-10">
          <span class="px-3 py-1 bg-white/20 text-white text-xs font-bold rounded-full">Tư Vấn Công Suất & Báo Giá Vật Tư</span>
          <h2 class="text-2xl sm:text-3xl font-extrabold font-heading">Bạn Cần Báo Giá Vật Tư Dự Án Điện Mặt Trời?</h2>
          <p class="text-xs sm:text-sm text-blue-100 max-w-xl">
            Liên hệ ngay đội ngũ kỹ sư Bách Anh Group để nhận bảng tính số lượng tấm pin, công suất Inverter và báo giá vật tư chiết khấu cao nhất.
          </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3 z-10 w-full md:w-auto">
          <a href="tel:0963982186" class="px-6 py-3.5 bg-slate-900 hover:bg-slate-800 text-white font-extrabold text-xs rounded-xl text-center whitespace-nowrap shadow-lg">
            <i class="fas fa-phone-alt mr-2 text-blue-400"></i> Hotline: 0963 982 186
          </a>
          <a href="{{ route('contact') }}" class="px-6 py-3.5 bg-white hover:bg-slate-100 text-blue-700 font-extrabold text-xs rounded-xl text-center whitespace-nowrap shadow-lg">
            Gửi Yêu Cầu Báo Giá
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- UNIFIED FOOTER -->
@endsection
