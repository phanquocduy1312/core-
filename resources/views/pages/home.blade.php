@extends('layouts.app')

@section('title', 'BÁCH ANH GROUP - Nhà Phân Phối Thiết Bị & Vật Tư Điện Năng Lượng Mặt Trời')
@section('meta_description', 'Bách Anh Group - Đơn vị chuyên cung cấp, phân phối sỉ & lẻ thiết bị và vật tư điện năng lượng mặt trời chính hãng.')

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
      <a href="{{ route('technical-support') }}" class="block px-4 py-3 font-medium text-slate-700 hover:bg-slate-50 rounded-xl" data-i18n="nav_support">Hỗ Trợ Kỹ Thuật</a>
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

      <!-- HIGH-CONTRAST MODERN HERO BANNER SLIDER (100% SOLAR ENERGY FOCUS) -->
  <section id="hero-slider-section" class="relative bg-slate-950 text-white overflow-hidden py-14 sm:py-18 lg:py-22 group">
    <!-- Ambient Background Glow Effects -->
    <div class="absolute inset-0 z-0 pointer-events-none">
      <img src="https://industrial-techsolution.matbao.website/wp-content/uploads/2024/01/background_2.jpg" alt="Solar Farm Background" class="w-full h-full object-cover opacity-15">
      <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/95 to-blue-950/90"></div>
    </div>

    <!-- Glowing Light Orbs -->
    <div class="absolute -top-24 -left-24 w-[32rem] h-[32rem] bg-blue-600/25 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-[32rem] h-[32rem] bg-cyan-500/20 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
      
      <!-- SLIDER CONTAINER -->
      <div id="hero-slides-wrapper" class="relative">
        
        <!-- SLIDE 1: INVERTER HYBRID -->
        <div class="hero-slide active transition-opacity duration-700 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-8 items-center">
          <div class="lg:col-span-7 space-y-6">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-500/15 border border-blue-400/30 text-blue-300 text-xs sm:text-sm font-extrabold tracking-wide backdrop-blur-md shadow-md">
              <i class="fas fa-bolt text-yellow-400 animate-pulse"></i>
              <span data-i18n="hero_badge">BÁCH ANH GROUP • NHÀ PHÂN PHỐI INVERTER HYBRID HÀNG ĐẦU</span>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-[1.15] font-heading" data-i18n="hero_title">
              THIẾT BỊ &amp; VẬT TƯ<br>
              <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-cyan-300 to-emerald-400">ĐIỆN NĂNG LƯỢNG MẶT TRỜI</span>
            </h1>
            <p class="text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl font-normal" data-i18n="hero_desc">
              Bách Anh Group chuyên kinh doanh, phân phối chính hãng các dòng Inverter Hybrid InfiniSolar 10KW (IP66), Luxpower, Deye, Solis, GoodWe chuẩn CO/CQ bảo hành 5-10 năm.
            </p>
            <div class="flex flex-wrap items-center gap-4 pt-2">
              <a href="{{ route('products.inverter') }}" class="px-8 py-4 bg-gradient-to-r from-blue-600 via-blue-500 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-extrabold rounded-2xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 hover:-translate-y-0.5 transition-all flex items-center gap-3 text-sm">
                <i class="fas fa-solar-panel text-base"></i>
                <span data-i18n="hero_cta_explore">Khám Phá Inverter Hybrid</span>
              </a>
              <a href="tel:0963982186" class="px-7 py-4 bg-slate-900/90 hover:bg-slate-800 text-white font-bold rounded-2xl border border-slate-700/80 hover:border-slate-600 transition-all flex items-center gap-3 text-sm shadow-md backdrop-blur-md hover:-translate-y-0.5">
                <i class="fas fa-phone-volume text-emerald-400 text-base"></i>
                <span data-i18n="hero_cta_hotline">Hotline: 0963 982 186</span>
              </a>
            </div>
            <div class="pt-5 border-t border-slate-800/80 grid grid-cols-3 gap-4">
              <div class="bg-slate-900/60 p-3.5 rounded-2xl border border-slate-800/80 backdrop-blur-md">
                <div class="text-2xl sm:text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300 font-heading counter-val" data-count="10">10+</div>
                <div class="text-xs font-semibold text-slate-400 mt-0.5" data-i18n="stat_years">Năm Phân Phối</div>
              </div>
              <div class="bg-slate-900/60 p-3.5 rounded-2xl border border-slate-800/80 backdrop-blur-md">
                <div class="text-2xl sm:text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300 font-heading counter-val" data-count="350">350+</div>
                <div class="text-xs font-semibold text-slate-400 mt-0.5" data-i18n="stat_projects">Dự Án Lắp Đặt</div>
              </div>
              <div class="bg-slate-900/60 p-3.5 rounded-2xl border border-slate-800/80 backdrop-blur-md">
                <div class="text-2xl sm:text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-300 font-heading counter-val" data-count="500">500+</div>
                <div class="text-xs font-semibold text-slate-400 mt-0.5" data-i18n="stat_clients">Đại Lý &amp; Đội Thợ</div>
              </div>
            </div>
          </div>
          <div class="lg:col-span-5 relative">
            <div class="relative mx-auto max-w-md lg:max-w-none group/card">
              <div class="absolute -inset-1 rounded-3xl bg-gradient-to-r from-blue-600 via-cyan-500 to-emerald-500 opacity-40 blur-xl group-hover/card:opacity-70 transition duration-500"></div>
              <div class="relative bg-slate-900/90 border border-slate-800/90 rounded-3xl p-6 shadow-2xl backdrop-blur-xl space-y-5">
                <div class="flex items-center justify-between">
                  <span class="px-3 py-1 bg-blue-500/20 border border-blue-400/30 text-blue-300 text-xs font-extrabold rounded-full uppercase tracking-wider flex items-center gap-1.5" data-i18n="hero_flagship_tag">
                    <i class="fas fa-bolt text-yellow-400"></i> Thiết Bị Solar Chủ Lực
                  </span>
                  <span class="px-3 py-1 bg-slate-800/90 border border-slate-700 text-slate-300 text-xs font-bold rounded-full flex items-center gap-1" data-i18n="hero_ip66_badge">
                    <i class="fas fa-shield-halved text-emerald-400"></i> Chuẩn IP66
                  </span>
                </div>
                <div class="relative bg-gradient-to-b from-slate-800/70 to-slate-900/90 rounded-2xl p-6 flex flex-col items-center justify-center border border-slate-800 overflow-hidden space-y-4">
                  <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-blue-500/15 via-transparent to-transparent opacity-80 pointer-events-none"></div>
                  <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Inverter Hybrid InfiniSolar 10KW" class="h-48 max-h-48 w-auto object-contain drop-shadow-2xl group-hover/card:scale-105 transition-transform duration-500 relative z-10">
                  <div class="text-center relative z-10 space-y-1">
                    <h4 class="text-base font-extrabold text-white leading-snug tracking-wide" data-i18n="hero_flagship_title">INVERTER HYBRID INFINISOLAR (10KW - IP66)</h4>
                    <p class="text-xs text-slate-300 leading-relaxed max-w-sm" data-i18n="hero_flagship_desc">Bộ biến tần Hybrid năng lượng mặt trời công suất 10KW, chuẩn chống nước chống bụi IP66, hiệu suất 97.5%, hỗ trợ Pin Lithium 48V.</p>
                  </div>
                </div>
                <div class="grid grid-cols-2 gap-2 text-[11px]">
                  <div class="bg-slate-800/80 p-2.5 rounded-xl border border-slate-700/70 text-slate-300 flex items-center gap-2"><i class="fas fa-bolt text-yellow-400"></i><span><span data-i18n="hero_spec_capacity">Công suất:</span> <strong class="text-white">10KW Hybrid</strong></span></div>
                  <div class="bg-slate-800/80 p-2.5 rounded-xl border border-slate-700/70 text-slate-300 flex items-center gap-2"><i class="fas fa-battery-full text-emerald-400"></i><span><span data-i18n="hero_spec_battery">Pin hỗ trợ:</span> <strong class="text-white">48V Lithium</strong></span></div>
                  <div class="bg-slate-800/80 p-2.5 rounded-xl border border-slate-700/70 text-slate-300 flex items-center gap-2"><i class="fas fa-shield-halved text-cyan-400"></i><span><span data-i18n="hero_spec_protection">Bảo vệ:</span> <strong class="text-white">Chuẩn IP66</strong></span></div>
                  <div class="bg-slate-800/80 p-2.5 rounded-xl border border-slate-700/70 text-slate-300 flex items-center gap-2"><i class="fas fa-certificate text-amber-400"></i><span>Bảo hành: <strong class="text-white">5 Năm chính hãng</strong></span></div>
                </div>
                <button class="open-modal-trigger w-full py-3.5 bg-gradient-to-r from-blue-600 via-blue-500 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-extrabold text-xs rounded-xl shadow-lg shadow-blue-600/30 transition-all flex items-center justify-center gap-2 cursor-pointer border border-blue-400/30"
                  data-title="INVERTER HYBRID INFINISOLAR (10KW - IP66)" data-category="Bộ Biến Tần Inverter" data-img="assets/images/infinisolar_inverter.png" data-desc="Bộ biến tần Hybrid 10KW 2 MPPT độc lập, hiệu suất 97.5%, hỗ trợ sạc/xả thông minh pin Lithium 48V, bảo hành 5 năm.">
                  <i class="fas fa-list-check"></i> <span data-i18n="hero_flagship_cta">Xem Chi Tiết Thông Số Kỹ Thuật</span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- SLIDE 2: TẤM PIN MẶT TRỜI 550W+ -->
        <div class="hero-slide hidden transition-opacity duration-700 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-8 items-center">
          <div class="lg:col-span-7 space-y-6">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/15 border border-amber-400/30 text-amber-300 text-xs sm:text-sm font-extrabold tracking-wide backdrop-blur-md shadow-md">
              <i class="fas fa-sun text-amber-400 animate-pulse"></i>
              <span>☀️ CÔNG NGHỆ QUANG ĐIỆN N-TYPE TOPCON MỚI NHẤT 2026</span>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-[1.15] font-heading">
              TẤM PIN MẶT TRỜI<br>
              <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-300 to-yellow-200">MONO PERC &amp; TOPCON 550W+</span>
            </h1>
            <p class="text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl font-normal">
              Nhà phân phối ủy quyền các thương hiệu tấm pin năng lượng mặt trời uy tín hàng đầu: LONGi Solar, Canadian Solar, VSUN, AE Solar, Bastions Energy hiệu suất cực đại 22.5%, bảo hành 30 năm.
            </p>
            <div class="flex flex-wrap items-center gap-4 pt-2">
              <a href="{{ route('products.solar-panel') }}" class="px-8 py-4 bg-gradient-to-r from-amber-500 via-orange-500 to-yellow-500 hover:from-amber-600 hover:to-orange-600 text-white font-extrabold rounded-2xl shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:-translate-y-0.5 transition-all flex items-center gap-3 text-sm">
                <i class="fas fa-sun text-base"></i>
                <span>Xem Danh Mục Tấm Pin</span>
              </a>
              <a href="tel:0963982186" class="px-7 py-4 bg-slate-900/90 hover:bg-slate-800 text-white font-bold rounded-2xl border border-slate-700/80 hover:border-slate-600 transition-all flex items-center gap-3 text-sm shadow-md backdrop-blur-md hover:-translate-y-0.5">
                <i class="fas fa-phone-volume text-amber-400 text-base"></i>
                <span>Báo Giá Sỉ Pin: 0963 982 186</span>
              </a>
            </div>
            <div class="pt-5 border-t border-slate-800/80 grid grid-cols-3 gap-4">
              <div class="bg-slate-900/60 p-3.5 rounded-2xl border border-slate-800/80 backdrop-blur-md">
                <div class="text-2xl sm:text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-yellow-300 font-heading">550W+</div>
                <div class="text-xs font-semibold text-slate-400 mt-0.5">Công Suất Tấm Pin</div>
              </div>
              <div class="bg-slate-900/60 p-3.5 rounded-2xl border border-slate-800/80 backdrop-blur-md">
                <div class="text-2xl sm:text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-amber-300 font-heading">22.5%</div>
                <div class="text-xs font-semibold text-slate-400 mt-0.5">Hiệu Suất Quang Điện</div>
              </div>
              <div class="bg-slate-900/60 p-3.5 rounded-2xl border border-slate-800/80 backdrop-blur-md">
                <div class="text-2xl sm:text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300 font-heading">30 Năm</div>
                <div class="text-xs font-semibold text-slate-400 mt-0.5">Bảo Hành Vật Lý</div>
              </div>
            </div>
          </div>
          <div class="lg:col-span-5 relative">
            <div class="relative mx-auto max-w-md lg:max-w-none group/card">
              <div class="absolute -inset-1 rounded-3xl bg-gradient-to-r from-amber-500 via-orange-500 to-yellow-400 opacity-40 blur-xl group-hover/card:opacity-70 transition duration-500"></div>
              <div class="relative bg-slate-900/90 border border-slate-800/90 rounded-3xl p-6 shadow-2xl backdrop-blur-xl space-y-5">
                <div class="flex items-center justify-between">
                  <span class="px-3 py-1 bg-amber-500/20 border border-amber-400/30 text-amber-300 text-xs font-extrabold rounded-full uppercase tracking-wider flex items-center gap-1.5">
                    <i class="fas fa-star text-amber-400"></i> Pin N-Type TOPCon
                  </span>
                  <span class="px-3 py-1 bg-slate-800/90 border border-slate-700 text-slate-300 text-xs font-bold rounded-full flex items-center gap-1">
                    <i class="fas fa-certificate text-amber-400"></i> Hàng Hóa CO/CQ
                  </span>
                </div>
                <div class="relative bg-gradient-to-b from-slate-800/70 to-slate-900/90 rounded-2xl p-6 flex flex-col items-center justify-center border border-slate-800 overflow-hidden space-y-4">
                  <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-amber-500/15 via-transparent to-transparent opacity-80 pointer-events-none"></div>
                  <img src="{{ asset('assets/images/') }}/solar_panel_550w.png" alt="Tấm Pin Mặt Trời Mono 550W+" class="h-48 max-h-48 w-auto object-contain drop-shadow-2xl group-hover/card:scale-105 transition-transform duration-500 relative z-10">
                  <div class="text-center relative z-10 space-y-1">
                    <h4 class="text-base font-extrabold text-white leading-snug tracking-wide">TẤM PIN LONGI MONO 550W+ (HI-MO 6)</h4>
                    <p class="text-xs text-slate-300 leading-relaxed max-w-sm">Tấm pin Mono Crystalline công suất cao 550W, công nghệ tế bào HPBC hiệu suất 22.5%, giảm suy hao quang năng vượt trội.</p>
                  </div>
                </div>
                <div class="grid grid-cols-2 gap-2 text-[11px]">
                  <div class="bg-slate-800/80 p-2.5 rounded-xl border border-slate-700/70 text-slate-300 flex items-center gap-2"><i class="fas fa-sun text-amber-400"></i><span>Công suất: <strong class="text-white">550W+ Mono</strong></span></div>
                  <div class="bg-slate-800/80 p-2.5 rounded-xl border border-slate-700/70 text-slate-300 flex items-center gap-2"><i class="fas fa-bolt text-yellow-400"></i><span>Hiệu suất: <strong class="text-white">22.5% HPBC</strong></span></div>
                  <div class="bg-slate-800/80 p-2.5 rounded-xl border border-slate-700/70 text-slate-300 flex items-center gap-2"><i class="fas fa-shield-halved text-emerald-400"></i><span>Kháng muối: <strong class="text-white">IP68 Box</strong></span></div>
                  <div class="bg-slate-800/80 p-2.5 rounded-xl border border-slate-700/70 text-slate-300 flex items-center gap-2"><i class="fas fa-award text-amber-400"></i><span>Bảo hành: <strong class="text-white">30 Năm Hiệu Suất</strong></span></div>
                </div>
                <button class="open-modal-trigger w-full py-3.5 bg-gradient-to-r from-amber-500 via-orange-500 to-yellow-500 hover:from-amber-600 hover:to-orange-600 text-white font-extrabold text-xs rounded-xl shadow-lg shadow-orange-500/30 transition-all flex items-center justify-center gap-2 cursor-pointer border border-amber-400/30"
                  data-title="TẤM PIN LONGI MONO 550W+ (HI-MO 6)" data-category="Tấm Pin Mặt Trời" data-img="assets/images/solar_panel_550w.png" data-desc="Tấm pin Mono Crystalline công suất cao 550W, công nghệ tế bào HPBC hiệu suất 22.5%, giảm suy hao quang năng vượt trội, bảo hành 30 năm.">
                  <i class="fas fa-list-check"></i> Xem Thông Số Tấm Pin 550W+
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- SLIDE 3: PIN LƯU TRỮ LITHIUM LIFEPO4 -->
        <div class="hero-slide hidden transition-opacity duration-700 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-8 items-center">
          <div class="lg:col-span-7 space-y-6">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-500/15 border border-emerald-400/30 text-emerald-300 text-xs sm:text-sm font-extrabold tracking-wide backdrop-blur-md shadow-md">
              <i class="fas fa-battery-full text-emerald-400 animate-pulse"></i>
              <span>🔋 PIN LƯU TRỮ LITHIUM LIFEPO4 51.2V CAO CẤP</span>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-[1.15] font-heading">
              PIN LƯU TRỮ LITHIUM<br>
              <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-200">LIFEPO4 48V / 51.2V AN TOÀN</span>
            </h1>
            <p class="text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl font-normal">
              Phân phối hệ thống Pin lưu trữ điện năng lượng mặt trời Lithium LiFePO4 thương hiệu XinPZ, HinaESS, ChisageESS với tuổi thọ 6000+ chu kỳ sạc/xả, tích hợp mạch BMS quản lý pin thông minh.
            </p>
            <div class="flex flex-wrap items-center gap-4 pt-2">
              <a href="{{ route('products.battery') }}" class="px-8 py-4 bg-gradient-to-r from-emerald-600 via-teal-500 to-cyan-500 hover:from-emerald-500 hover:to-teal-400 text-white font-extrabold rounded-2xl shadow-lg shadow-emerald-600/30 hover:shadow-emerald-600/50 hover:-translate-y-0.5 transition-all flex items-center gap-3 text-sm">
                <i class="fas fa-battery-three-quarters text-base"></i>
                <span>Xem Pin Lưu Trữ Lithium</span>
              </a>
              <a href="tel:0963982186" class="px-7 py-4 bg-slate-900/90 hover:bg-slate-800 text-white font-bold rounded-2xl border border-slate-700/80 hover:border-slate-600 transition-all flex items-center gap-3 text-sm shadow-md backdrop-blur-md hover:-translate-y-0.5">
                <i class="fas fa-phone-volume text-emerald-400 text-base"></i>
                <span>Tư Vấn Pin: 0963 982 186</span>
              </a>
            </div>
            <div class="pt-5 border-t border-slate-800/80 grid grid-cols-3 gap-4">
              <div class="bg-slate-900/60 p-3.5 rounded-2xl border border-slate-800/80 backdrop-blur-md">
                <div class="text-2xl sm:text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300 font-heading">6000+</div>
                <div class="text-xs font-semibold text-slate-400 mt-0.5">Chu Kỳ Sạc Xả</div>
              </div>
              <div class="bg-slate-900/60 p-3.5 rounded-2xl border border-slate-800/80 backdrop-blur-md">
                <div class="text-2xl sm:text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-cyan-300 font-heading">5.12KWh</div>
                <div class="text-xs font-semibold text-slate-400 mt-0.5">Dung Lượng Modun</div>
              </div>
              <div class="bg-slate-900/60 p-3.5 rounded-2xl border border-slate-800/80 backdrop-blur-md">
                <div class="text-2xl sm:text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-300 font-heading">10 Năm</div>
                <div class="text-xs font-semibold text-slate-400 mt-0.5">Bảo Hành Chính Hãng</div>
              </div>
            </div>
          </div>
          <div class="lg:col-span-5 relative">
            <div class="relative mx-auto max-w-md lg:max-w-none group/card">
              <div class="absolute -inset-1 rounded-3xl bg-gradient-to-r from-emerald-600 via-teal-500 to-cyan-400 opacity-40 blur-xl group-hover/card:opacity-70 transition duration-500"></div>
              <div class="relative bg-slate-900/90 border border-slate-800/90 rounded-3xl p-6 shadow-2xl backdrop-blur-xl space-y-5">
                <div class="flex items-center justify-between">
                  <span class="px-3 py-1 bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 text-xs font-extrabold rounded-full uppercase tracking-wider flex items-center gap-1.5">
                    <i class="fas fa-shield-cat text-emerald-400"></i> Pin Lithium LiFePO4
                  </span>
                  <span class="px-3 py-1 bg-slate-800/90 border border-slate-700 text-slate-300 text-xs font-bold rounded-full flex items-center gap-1">
                    <i class="fas fa-microchip text-emerald-400"></i> Mạch BMS Thông Minh
                  </span>
                </div>
                <div class="relative bg-gradient-to-b from-slate-800/70 to-slate-900/90 rounded-2xl p-6 flex flex-col items-center justify-center border border-slate-800 overflow-hidden space-y-4">
                  <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-emerald-500/15 via-transparent to-transparent opacity-80 pointer-events-none"></div>
                  <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Pin Lưu Trữ Lithium LiFePO4 48V" class="h-48 max-h-48 w-auto object-contain drop-shadow-2xl group-hover/card:scale-105 transition-transform duration-500 relative z-10">
                  <div class="text-center relative z-10 space-y-1">
                    <h4 class="text-base font-extrabold text-white leading-snug tracking-wide">PIN LƯU TRỮ XINPZ LIFEPO4 51.2V 100AH</h4>
                    <p class="text-xs text-slate-300 leading-relaxed max-w-sm">Khối pin lưu trữ Lithium 51.2V 100Ah (5.12KWh), tế bào pin Grade-A+, tương thích 99% các hãng Inverter Hybrid.</p>
                  </div>
                </div>
                <div class="grid grid-cols-2 gap-2 text-[11px]">
                  <div class="bg-slate-800/80 p-2.5 rounded-xl border border-slate-700/70 text-slate-300 flex items-center gap-2"><i class="fas fa-battery-full text-emerald-400"></i><span>Dung lượng: <strong class="text-white">5.12 KWh</strong></span></div>
                  <div class="bg-slate-800/80 p-2.5 rounded-xl border border-slate-700/70 text-slate-300 flex items-center gap-2"><i class="fas fa-sync text-teal-400"></i><span>Tuổi thọ: <strong class="text-white">6000+ Cycles</strong></span></div>
                  <div class="bg-slate-800/80 p-2.5 rounded-xl border border-slate-700/70 text-slate-300 flex items-center gap-2"><i class="fas fa-microchip text-cyan-400"></i><span>Giao tiếp: <strong class="text-white">CAN / RS485</strong></span></div>
                  <div class="bg-slate-800/80 p-2.5 rounded-xl border border-slate-700/70 text-slate-300 flex items-center gap-2"><i class="fas fa-award text-emerald-400"></i><span>Bảo hành: <strong class="text-white">10 Năm Chính Hãng</strong></span></div>
                </div>
                <button class="open-modal-trigger w-full py-3.5 bg-gradient-to-r from-emerald-600 via-teal-500 to-cyan-500 hover:from-emerald-500 hover:to-teal-400 text-white font-extrabold text-xs rounded-xl shadow-lg shadow-emerald-600/30 transition-all flex items-center justify-center gap-2 cursor-pointer border border-emerald-400/30"
                  data-title="PIN LƯU TRỮ XINPZ LIFEPO4 51.2V 100AH" data-category="Pin Lưu Trữ Lithium" data-img="assets/images/lithium_battery_48v.png" data-desc="Khối pin lưu trữ Lithium 51.2V 100Ah (5.12KWh), tế bào pin Grade-A+, tương thích 99% các hãng Inverter Hybrid, bảo hành 10 năm.">
                  <i class="fas fa-list-check"></i> Xem Chi Tiết Pin Lithium 51.2V
                </button>
              </div>
            </div>
          </div>
        </div>

      </div>

            <!-- CAROUSEL NAVIGATION CONTROLS -->
      <div class="flex items-center justify-center pt-6 border-t border-slate-800/60 mt-6">
        <!-- INDICATOR DOTS -->
        <div class="flex items-center gap-2.5">
          <button type="button" data-slide="0" aria-label="Slide 1" class="hero-dot active w-8 h-2.5 rounded-full bg-blue-500 transition-all cursor-pointer"></button>
          <button type="button" data-slide="1" aria-label="Slide 2" class="hero-dot w-2.5 h-2.5 rounded-full bg-slate-700 hover:bg-slate-500 transition-all cursor-pointer"></button>
          <button type="button" data-slide="2" aria-label="Slide 3" class="hero-dot w-2.5 h-2.5 rounded-full bg-slate-700 hover:bg-slate-500 transition-all cursor-pointer"></button>
        </div>
      </div>

    </div>
  </section>

  <!-- SECTION 1: TOP GLOBAL SOLAR BRAND PARTNERS -->
  <section class="py-16 bg-white border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
      <div class="text-center max-w-3xl mx-auto mb-10 space-y-3">
        <span class="text-xs font-extrabold uppercase text-blue-600 tracking-wider bg-blue-50 px-4 py-1.5 rounded-full border border-blue-100">Hãng Sản Xuất Solar Toàn Cầu</span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-heading">
          Thương Hiệu Thiết Bị Điện Mặt Trời Nổi Bật Phân Phối Chính Hãng
        </h2>
        <p class="text-xs sm:text-sm text-slate-600">
          Mọi thiết bị biến tần, tấm pin mặt trời và phụ kiện vật tư đều được Bách Anh Group nhập khẩu chính ngạch đầy đủ giấy tờ CO/CQ.
        </p>
      </div>

      <!-- 12 FEATURED PARTNER BRAND LOGOS GRID (EXACT MATCH TO USER IMAGE) -->
      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
        
        <!-- 1. LUXPOWER (INVERTER) -->
        <a href="{{ route('brands') }}?brand=luxpower" class="p-6 bg-slate-50 hover:bg-white rounded-3xl border border-slate-200/90 hover:border-teal-600 hover:shadow-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-3 relative overflow-hidden block">
          <div class="h-20 sm:h-24 flex items-center justify-center p-3 bg-white rounded-2xl border border-slate-100 shadow-sm w-full group-hover:scale-105 transition-transform">
            <img src="{{ asset('assets/images/') }}/logos/luxpower_logo.png" alt="LUXPOWER Logo" class="h-14 sm:h-16 max-h-16 max-w-[90%] object-contain">
          </div>
          <div>
            <h4 class="text-base font-extrabold text-slate-900 group-hover:text-teal-600 transition-colors font-heading">LUXPOWER</h4>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-0.5">Inverter Hybrid Sna & LXP</p>
          </div>
          <span class="inline-block px-3 py-0.5 text-[9px] font-extrabold bg-teal-100/80 text-teal-800 rounded-full border border-teal-200">Chuyên Hybrid 1P/3P</span>
        </a>

        <!-- 2. DEYE (INVERTER) -->
        <a href="{{ route('brands') }}?brand=deye" class="p-6 bg-slate-50 hover:bg-white rounded-3xl border border-slate-200/90 hover:border-blue-600 hover:shadow-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-3 relative overflow-hidden block">
          <div class="h-20 sm:h-24 flex items-center justify-center p-3 bg-white rounded-2xl border border-slate-100 shadow-sm w-full group-hover:scale-105 transition-transform">
            <img src="{{ asset('assets/images/') }}/logos/deye_logo.png" alt="Deye Solar Logo" class="h-14 sm:h-16 max-h-16 max-w-[90%] object-contain">
          </div>
          <div>
            <h4 class="text-base font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors font-heading">Deye Solar</h4>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-0.5">Biến Tần Hybrid & Micro Inverter</p>
          </div>
          <span class="inline-block px-3 py-0.5 text-[9px] font-extrabold bg-blue-100/80 text-blue-800 rounded-full border border-blue-200">Top 1 Mỹ & Châu Âu</span>
        </a>

        <!-- 3. SOLIS (INVERTER) -->
        <a href="{{ route('brands') }}?brand=solis" class="p-6 bg-slate-50 hover:bg-white rounded-3xl border border-slate-200/90 hover:border-amber-500 hover:shadow-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-3 relative overflow-hidden block">
          <div class="h-20 sm:h-24 flex items-center justify-center p-3 bg-white rounded-2xl border border-slate-100 shadow-sm w-full group-hover:scale-105 transition-transform">
            <img src="{{ asset('assets/images/') }}/logos/solis_logo.webp" alt="Ginlong Solis Logo" class="h-14 sm:h-16 max-h-16 max-w-[90%] object-contain">
          </div>
          <div>
            <h4 class="text-base font-extrabold text-slate-900 group-hover:text-amber-600 transition-colors font-heading">Solis (Ginlong)</h4>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-0.5">Biến Tần Chuẩn Dự Án IP66</p>
          </div>
          <span class="inline-block px-3 py-0.5 text-[9px] font-extrabold bg-amber-100/80 text-amber-800 rounded-full border border-amber-200">Bền Bỉ Dự Án</span>
        </a>

        <!-- 4. GOODWE (INVERTER) -->
        <a href="{{ route('brands') }}?brand=goodwe" class="p-6 bg-slate-50 hover:bg-white rounded-3xl border border-slate-200/90 hover:border-red-500 hover:shadow-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-3 relative overflow-hidden block">
          <div class="h-20 sm:h-24 flex items-center justify-center p-3 bg-white rounded-2xl border border-slate-100 shadow-sm w-full group-hover:scale-105 transition-transform">
            <img src="{{ asset('assets/images/') }}/logos/goodwe_logo.png" alt="GoodWe Logo" class="h-14 sm:h-16 max-h-16 max-w-[90%] object-contain">
          </div>
          <div>
            <h4 class="text-base font-extrabold text-slate-900 group-hover:text-red-600 transition-colors font-heading">GoodWe</h4>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-0.5">Inverter Hòa Lưới & Hybrid</p>
          </div>
          <span class="inline-block px-3 py-0.5 text-[9px] font-extrabold bg-red-100/80 text-red-800 rounded-full border border-red-200">Chuẩn Châu Âu</span>
        </a>

        <!-- 5. LUMENTREE (INVERTER) -->
        <a href="{{ route('brands') }}?brand=lumentree" class="p-6 bg-slate-50 hover:bg-white rounded-3xl border border-slate-200/90 hover:border-emerald-500 hover:shadow-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-3 relative overflow-hidden block">
          <div class="h-20 sm:h-24 flex items-center justify-center p-3 bg-white rounded-2xl border border-slate-100 shadow-sm w-full group-hover:scale-105 transition-transform">
            <img src="{{ asset('assets/images/') }}/logos/lumentree_logo.avif" alt="Lumentree Logo" class="h-14 sm:h-16 max-h-16 max-w-[90%] object-contain">
          </div>
          <div>
            <h4 class="text-base font-extrabold text-slate-900 group-hover:text-emerald-600 transition-colors font-heading">Lumentree</h4>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-0.5">Biến Tần Độc Lập Off-Grid & Bơm</p>
          </div>
          <span class="inline-block px-3 py-0.5 text-[9px] font-extrabold bg-emerald-100/80 text-emerald-800 rounded-full border border-emerald-200">Tự Động Thông Minh</span>
        </a>

        <!-- 6. BASTIONSENERGY (TẤM PIN) -->
        <a href="{{ route('brands') }}?brand=bastions" class="p-6 bg-slate-50 hover:bg-white rounded-3xl border border-slate-200/90 hover:border-blue-600 hover:shadow-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-3 relative overflow-hidden block">
          <div class="h-20 sm:h-24 flex items-center justify-center p-3 bg-white rounded-2xl border border-slate-100 shadow-sm w-full group-hover:scale-105 transition-transform">
            <img src="{{ asset('assets/images/') }}/logos/bastionsenergy_logo.png" alt="Bastions Energy Logo" class="h-14 sm:h-16 max-h-16 max-w-[90%] object-contain">
          </div>
          <div>
            <h4 class="text-base font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors font-heading">Bastions Energy</h4>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-0.5">Tấm Pin N-Type TOPCon</p>
          </div>
          <span class="inline-block px-3 py-0.5 text-[9px] font-extrabold bg-blue-100/80 text-blue-800 rounded-full border border-blue-200">Bảo Hành 30 Năm</span>
        </a>

        <!-- 7. LONGI (TẤM PIN) -->
        <a href="{{ route('brands') }}?brand=longi" class="p-6 bg-slate-50 hover:bg-white rounded-3xl border border-slate-200/90 hover:border-red-500 hover:shadow-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-3 relative overflow-hidden block">
          <div class="h-20 sm:h-24 flex items-center justify-center p-3 bg-white rounded-2xl border border-slate-100 shadow-sm w-full group-hover:scale-105 transition-transform">
            <img src="{{ asset('assets/images/') }}/logos/longi_logo.png" alt="LONGi Solar Logo" class="h-14 sm:h-16 max-h-16 max-w-[90%] object-contain">
          </div>
          <div>
            <h4 class="text-base font-extrabold text-slate-900 group-hover:text-red-600 transition-colors font-heading">LONGi Solar</h4>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-0.5">Tấm Pin Hiệu Suất Cao Hi-MO</p>
          </div>
          <span class="inline-block px-3 py-0.5 text-[9px] font-extrabold bg-red-100/80 text-red-800 rounded-full border border-red-200">Top 1 Thị Phần</span>
        </a>

        <!-- 8. VSUN (TẤM PIN) -->
        <a href="{{ route('brands') }}?brand=vsun" class="p-6 bg-slate-50 hover:bg-white rounded-3xl border border-slate-200/90 hover:border-purple-600 hover:shadow-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-3 relative overflow-hidden block">
          <div class="h-20 sm:h-24 flex items-center justify-center p-3 bg-white rounded-2xl border border-slate-100 shadow-sm w-full group-hover:scale-105 transition-transform">
            <img src="{{ asset('assets/images/') }}/logos/vsun_logo.png" alt="VSUN Solar Logo" class="h-14 sm:h-16 max-h-16 max-w-[90%] object-contain">
          </div>
          <div>
            <h4 class="text-base font-extrabold text-slate-900 group-hover:text-purple-600 transition-colors font-heading">VSUN Solar</h4>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-0.5">Tấm Pin Quang Điện Nhật Bản</p>
          </div>
          <span class="inline-block px-3 py-0.5 text-[9px] font-extrabold bg-purple-100/80 text-purple-800 rounded-full border border-purple-200">Tiêu Chuẩn Nhật Bản</span>
        </a>

        <!-- 9. AE SOLAR (TẤM PIN) -->
        <a href="{{ route('brands') }}?brand=aesolar" class="p-6 bg-slate-50 hover:bg-white rounded-3xl border border-slate-200/90 hover:border-amber-600 hover:shadow-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-3 relative overflow-hidden block">
          <div class="h-20 sm:h-24 flex items-center justify-center p-3 bg-white rounded-2xl border border-slate-100 shadow-sm w-full group-hover:scale-105 transition-transform">
            <img src="{{ asset('assets/images/') }}/logos/aesolar_logo.png" alt="AE Solar Logo" class="h-14 sm:h-16 max-h-16 max-w-[90%] object-contain">
          </div>
          <div>
            <h4 class="text-base font-extrabold text-slate-900 group-hover:text-amber-600 transition-colors font-heading">AE Solar</h4>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-0.5">Tấm Pin Chống Bụi Kháng Muối</p>
          </div>
          <span class="inline-block px-3 py-0.5 text-[9px] font-extrabold bg-amber-100/80 text-amber-800 rounded-full border border-amber-200">Đức - Tier-1</span>
        </a>

        <!-- 10. WORLD ENERGY (TẤM PIN) -->
        <a href="{{ route('brands') }}?brand=worldenergy" class="p-6 bg-slate-50 hover:bg-white rounded-3xl border border-slate-200/90 hover:border-indigo-600 hover:shadow-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-3 relative overflow-hidden block">
          <div class="h-20 sm:h-24 flex items-center justify-center p-3 bg-white rounded-2xl border border-slate-100 shadow-sm w-full group-hover:scale-105 transition-transform">
            <img src="{{ asset('assets/images/') }}/logos/worldenergy_logo.png" alt="World Energy Logo" class="h-14 sm:h-16 max-h-16 max-w-[90%] object-contain">
          </div>
          <div>
            <h4 class="text-base font-extrabold text-slate-900 group-hover:text-indigo-600 transition-colors font-heading">World Energy</h4>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-0.5">Tấm Pin Công Nghiệp Siêu Bền</p>
          </div>
          <span class="inline-block px-3 py-0.5 text-[9px] font-extrabold bg-indigo-100/80 text-indigo-800 rounded-full border border-indigo-200">Tiêu Chuẩn EU</span>
        </a>

        <!-- 11. JINKO SOLAR (TẤM PIN) -->
        <a href="{{ route('brands') }}?brand=jinko" class="p-6 bg-slate-50 hover:bg-white rounded-3xl border border-slate-200/90 hover:border-emerald-500 hover:shadow-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-3 relative overflow-hidden block">
          <div class="h-20 sm:h-24 flex items-center justify-center p-3 bg-white rounded-2xl border border-slate-100 shadow-sm w-full group-hover:scale-105 transition-transform">
            <img src="{{ asset('assets/images/') }}/logos/jinko_logo.webp" alt="JinKO Solar Logo" class="h-14 sm:h-16 max-h-16 max-w-[90%] object-contain">
          </div>
          <div>
            <h4 class="text-base font-extrabold text-slate-900 group-hover:text-emerald-600 transition-colors font-heading">JinKO Solar</h4>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-0.5">Tấm Pin Quang Điện N-Type</p>
          </div>
          <span class="inline-block px-3 py-0.5 text-[9px] font-extrabold bg-emerald-100/80 text-emerald-800 rounded-full border border-emerald-200">Top Tier-1 Solar</span>
        </a>

        <!-- 12. XINPZ (PIN LƯU TRỮ) -->
        <a href="{{ route('brands') }}?brand=xinpz" class="p-6 bg-slate-50 hover:bg-white rounded-3xl border border-slate-200/90 hover:border-cyan-600 hover:shadow-2xl transition-all text-center group cursor-pointer flex flex-col items-center justify-center space-y-3 relative overflow-hidden block">
          <div class="h-20 sm:h-24 flex items-center justify-center p-3 bg-white rounded-2xl border border-slate-100 shadow-sm w-full group-hover:scale-105 transition-transform">
            <img src="{{ asset('assets/images/') }}/logos/xinpz_logo.jpg" alt="Xinpz Energy Logo" class="h-14 sm:h-16 max-h-16 max-w-[90%] object-contain">
          </div>
          <div>
            <h4 class="text-base font-extrabold text-slate-900 group-hover:text-cyan-600 transition-colors font-heading">Xinpz Energy</h4>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-0.5">Pin Lưu Trữ Lithium LiFePO4</p>
          </div>
          <span class="inline-block px-3 py-0.5 text-[9px] font-extrabold bg-cyan-100/80 text-cyan-800 rounded-full border border-cyan-200">Bảo Hành 10 Năm</span>
        </a>

      </div>
    </div>
  </section>

  <!-- SECTION 2A: BỘ BIẾN TẦN INVERTER HYBRID & HÒA LƯỚI (4 SẢN PHẨM / 1 HÀNG) -->
  <section class="py-16 bg-slate-50/60 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
        <div>
          <span class="text-xs font-extrabold uppercase text-blue-600 tracking-wider bg-blue-100/80 px-3.5 py-1 rounded-full border border-blue-200">Biến Tần Inverter</span>
          <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-heading mt-2">
            Bộ Biến Tần Inverter Hybrid & Hòa Lưới Điện Mặt Trời
          </h2>
        </div>
        <a href="san-pham.html?filter=solar" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition-all whitespace-nowrap">
          <span>Xem Tất Cả Inverter</span>
          <i class="fas fa-arrow-right text-xs"></i>
        </a>
      </div>

      <!-- 4 PRODUCTS PER ROW GRID -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- PROD 1: INFINISOLAR 10KW -->
        <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/90 hover:border-blue-600 hover:shadow-xl transition-all duration-300 flex flex-col group">
          <div class="relative bg-slate-50/80 p-5 flex items-center justify-center h-48 border-b border-slate-100">
            <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Inverter Hybrid InfiniSolar" class="h-36 max-w-full object-contain group-hover:scale-105 transition-transform duration-300">
            <span class="absolute top-2.5 left-2.5 bg-blue-600 text-white text-[9px] uppercase font-extrabold px-2.5 py-0.5 rounded-full shadow">Chủ Lực</span>
            <span class="absolute top-2.5 right-2.5 bg-slate-900 text-blue-400 text-[9px] font-bold px-2 py-0.5 rounded-full">IP66</span>
          </div>
          <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
            <div class="space-y-1.5">
              <span class="text-[9px] text-blue-600 font-extrabold uppercase bg-blue-50 px-2 py-0.5 rounded">InfiniSolar</span>
              <h3 class="font-extrabold text-slate-900 text-sm line-clamp-2 group-hover:text-blue-600 transition-colors">
                INVERTER HYBRID INFINISOLAR (10KW - IP66)
              </h3>
              <p class="text-[11px] text-slate-500 line-clamp-2 leading-relaxed">
                Biến tần Hybrid 10KW chuẩn chống nước IP66, hiệu suất 97.5%, hỗ trợ Pin 48V.
              </p>
            </div>
            <a href="san-pham.html?filter=solar" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs text-center transition-all shadow-md shadow-blue-600/20 block">
              Xem Chi Tiết
            </a>
          </div>
        </div>

        <!-- PROD 2: SUNGROW 50KW -->
        <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/90 hover:border-blue-600 hover:shadow-xl transition-all duration-300 flex flex-col group">
          <div class="relative bg-slate-50/80 p-5 flex items-center justify-center h-48 border-b border-slate-100">
            <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Inverter Sungrow 50KW" class="h-36 max-w-full object-contain group-hover:scale-105 transition-transform duration-300">
            <span class="absolute top-2.5 left-2.5 bg-slate-900 text-amber-400 text-[9px] uppercase font-extrabold px-2.5 py-0.5 rounded-full shadow">50KW Commercial</span>
          </div>
          <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
            <div class="space-y-1.5">
              <span class="text-[9px] text-blue-600 font-extrabold uppercase bg-blue-50 px-2 py-0.5 rounded">SUNGROW</span>
              <h3 class="font-extrabold text-slate-900 text-sm line-clamp-2 group-hover:text-blue-600 transition-colors">
                BIẾN TẦN HÒA LƯỚI SUNGROW 50KW (ON-GRID)
              </h3>
              <p class="text-[11px] text-slate-500 line-clamp-2 leading-relaxed">
                Biến tần 3 pha 50KW cho trạm điện mặt trời mái nhà xưởng.
              </p>
            </div>
            <a href="san-pham.html?filter=solar" class="w-full py-2.5 bg-slate-900 hover:bg-blue-600 text-white font-bold rounded-xl text-xs text-center transition-all block">
              Xem Chi Tiết
            </a>
          </div>
        </div>

        <!-- PROD 3: HUAWEI FUSIONSOLAR 100KW -->
        <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/90 hover:border-blue-600 hover:shadow-xl transition-all duration-300 flex flex-col group">
          <div class="relative bg-slate-50/80 p-5 flex items-center justify-center h-48 border-b border-slate-100">
            <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Inverter Huawei 100KW" class="h-36 max-w-full object-contain group-hover:scale-105 transition-transform duration-300">
            <span class="absolute top-2.5 left-2.5 bg-sky-600 text-white text-[9px] uppercase font-extrabold px-2.5 py-0.5 rounded-full shadow">100KW Smart PV</span>
          </div>
          <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
            <div class="space-y-1.5">
              <span class="text-[9px] text-blue-600 font-extrabold uppercase bg-blue-50 px-2 py-0.5 rounded">HUAWEI</span>
              <h3 class="font-extrabold text-slate-900 text-sm line-clamp-2 group-hover:text-blue-600 transition-colors">
                BIẾN TẦN THÔNG MINH HUAWEI FUSIONSOLAR 100KW
              </h3>
              <p class="text-[11px] text-slate-500 line-clamp-2 leading-relaxed">
                Inverter 100KW tích hợp công nghệ AI chẩn đoán lỗi chuỗi PV.
              </p>
            </div>
            <a href="san-pham.html?filter=solar" class="w-full py-2.5 bg-slate-900 hover:bg-blue-600 text-white font-bold rounded-xl text-xs text-center transition-all block">
              Xem Chi Tiết
            </a>
          </div>
        </div>

        <!-- PROD 4: INFINISOLAR OFF-GRID 5KW -->
        <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/90 hover:border-blue-600 hover:shadow-xl transition-all duration-300 flex flex-col group">
          <div class="relative bg-slate-50/80 p-5 flex items-center justify-center h-48 border-b border-slate-100">
            <img src="{{ asset('assets/images/') }}/infinisolar_inverter.png" alt="Inverter Off-Grid 5KW" class="h-36 max-w-full object-contain group-hover:scale-105 transition-transform duration-300">
            <span class="absolute top-2.5 left-2.5 bg-blue-600 text-white text-[9px] uppercase font-bold px-2.5 py-0.5 rounded-full">5KW Off-Grid</span>
          </div>
          <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
            <div class="space-y-1.5">
              <span class="text-[9px] text-blue-600 font-extrabold uppercase bg-blue-50 px-2 py-0.5 rounded">InfiniSolar</span>
              <h3 class="font-extrabold text-slate-900 text-sm line-clamp-2 group-hover:text-blue-600 transition-colors">
                BIẾN TẦN ĐỘC LẬP INFINISOLAR (5KW - OFF-GRID)
              </h3>
              <p class="text-[11px] text-slate-500 line-clamp-2 leading-relaxed">
                Bộ biến tần độc lập không phụ thuộc lưới điện cho vùng xa.
              </p>
            </div>
            <a href="san-pham.html?filter=solar" class="w-full py-2.5 bg-slate-900 hover:bg-blue-600 text-white font-bold rounded-xl text-xs text-center transition-all block">
              Xem Chi Tiết
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- SECTION 2B: TẤM PIN MẶT TRỜI & PIN LƯU TRỮ LITHIUM (4 SẢN PHẨM / 1 HÀNG) -->
  <section class="py-16 bg-white border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
        <div>
          <span class="text-xs font-extrabold uppercase text-blue-600 tracking-wider bg-blue-50 px-3.5 py-1 rounded-full border border-blue-100">Pin Solar & Lưu Trữ</span>
          <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-heading mt-2">
            Tấm Pin Quang Điện 550W+ & Pin Lưu Trữ Lithium LiFePO4
          </h2>
        </div>
        <a href="san-pham.html?filter=panel" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-900 hover:bg-blue-600 text-white font-bold text-xs rounded-xl transition-all whitespace-nowrap">
          <span>Xem Tấm Pin & Pin Lưu Trữ</span>
          <i class="fas fa-arrow-right text-xs"></i>
        </a>
      </div>

      <!-- 4 PRODUCTS PER ROW GRID -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- PROD 1: SOLAR PANEL INFINISOLAR 550W -->
        <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/90 hover:border-blue-600 hover:shadow-xl transition-all duration-300 flex flex-col group">
          <div class="relative bg-slate-50/80 p-5 flex items-center justify-center h-48 border-b border-slate-100">
            <img src="{{ asset('assets/images/') }}/solar_panel_550w.png" alt="Tấm Pin Mặt Trời InfiniSolar 550W" class="h-36 max-w-full object-contain group-hover:scale-105 transition-transform duration-300">
            <span class="absolute top-2.5 left-2.5 bg-blue-600 text-white text-[9px] uppercase font-extrabold px-2.5 py-0.5 rounded-full shadow">Bán Chạy</span>
          </div>
          <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
            <div class="space-y-1.5">
              <span class="text-[9px] text-blue-600 font-extrabold uppercase bg-blue-50 px-2 py-0.5 rounded">InfiniSolar</span>
              <h3 class="font-extrabold text-slate-900 text-sm line-clamp-2 group-hover:text-blue-600 transition-colors">
                TẤM PIN NĂNG LƯỢNG MẶT TRỜI INFINISOLAR 550W
              </h3>
              <p class="text-[11px] text-slate-500 line-clamp-2 leading-relaxed">
                Pin Mono Crystalline Half-Cell hiệu suất >21.8%, độ bền 25 năm.
              </p>
            </div>
            <a href="san-pham.html?filter=panel" class="w-full py-2.5 bg-slate-900 hover:bg-blue-600 text-white font-bold rounded-xl text-xs text-center transition-all block">
              Xem Chi Tiết
            </a>
          </div>
        </div>

        <!-- PROD 2: LONGI SOLAR 550W -->
        <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/90 hover:border-blue-600 hover:shadow-xl transition-all duration-300 flex flex-col group">
          <div class="relative bg-slate-50/80 p-5 flex items-center justify-center h-48 border-b border-slate-100">
            <img src="{{ asset('assets/images/') }}/solar_panel_550w.png" alt="Tấm Pin LONGI Solar 550W" class="h-36 max-w-full object-contain group-hover:scale-105 transition-transform duration-300">
            <span class="absolute top-2.5 left-2.5 bg-blue-700 text-white text-[9px] uppercase font-extrabold px-2.5 py-0.5 rounded-full shadow">LONGi Hi-MO 5</span>
          </div>
          <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
            <div class="space-y-1.5">
              <span class="text-[9px] text-blue-600 font-extrabold uppercase bg-blue-50 px-2 py-0.5 rounded">LONGI Solar</span>
              <h3 class="font-extrabold text-slate-900 text-sm line-clamp-2 group-hover:text-blue-600 transition-colors">
                TẤM PIN QUANG ĐIỆN LONGI SOLAR 550W (HI-MO 5)
              </h3>
              <p class="text-[11px] text-slate-500 line-clamp-2 leading-relaxed">
                Pin mặt trời LONGi thương hiệu Top 1 thế giới bảo hành 25 năm.
              </p>
            </div>
            <a href="san-pham.html?filter=panel" class="w-full py-2.5 bg-slate-900 hover:bg-blue-600 text-white font-bold rounded-xl text-xs text-center transition-all block">
              Xem Chi Tiết
            </a>
          </div>
        </div>

        <!-- PROD 3: PIN LITHIUM INFINISOLAR 48V 200AH -->
        <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/90 hover:border-blue-600 hover:shadow-xl transition-all duration-300 flex flex-col group">
          <div class="relative bg-slate-50/80 p-5 flex items-center justify-center h-48 border-b border-slate-100">
            <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Pin Lithium InfiniSolar 48V" class="h-36 max-w-full object-contain group-hover:scale-105 transition-transform duration-300">
            <span class="absolute top-2.5 left-2.5 bg-blue-600 text-white text-[9px] uppercase font-extrabold px-2.5 py-0.5 rounded-full shadow">Mới 2026</span>
          </div>
          <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
            <div class="space-y-1.5">
              <span class="text-[9px] text-blue-600 font-extrabold uppercase bg-blue-50 px-2 py-0.5 rounded">LiFePO4 48V</span>
              <h3 class="font-extrabold text-slate-900 text-sm line-clamp-2 group-hover:text-blue-600 transition-colors">
                BỘ LƯU TRỮ PIN LITHIUM INFINISOLAR 48V 200AH
              </h3>
              <p class="text-[11px] text-slate-500 line-clamp-2 leading-relaxed">
                Pin Lithium LiFePO4 48V 200Ah độ bền 6,000 chu kỳ sạc xả.
              </p>
            </div>
            <a href="san-pham.html?filter=battery" class="w-full py-2.5 bg-slate-900 hover:bg-blue-600 text-white font-bold rounded-xl text-xs text-center transition-all block">
              Xem Chi Tiết
            </a>
          </div>
        </div>

        <!-- PROD 4: TỦ LƯU TRỮ HIGH-VOLTAGE LITHIUM -->
        <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/90 hover:border-blue-600 hover:shadow-xl transition-all duration-300 flex flex-col group">
          <div class="relative bg-slate-50/80 p-5 flex items-center justify-center h-48 border-b border-slate-100">
            <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Tủ Pin Lưu Trữ Cao Áp High Voltage" class="h-36 max-w-full object-contain group-hover:scale-105 transition-transform duration-300">
            <span class="absolute top-2.5 left-2.5 bg-slate-900 text-blue-400 text-[9px] uppercase font-extrabold px-2.5 py-0.5 rounded-full">High-Voltage</span>
          </div>
          <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
            <div class="space-y-1.5">
              <span class="text-[9px] text-blue-600 font-extrabold uppercase bg-blue-50 px-2 py-0.5 rounded">Dyness ESS</span>
              <h3 class="font-extrabold text-slate-900 text-sm line-clamp-2 group-hover:text-blue-600 transition-colors">
                TỦ PIN LƯU TRỮ LITHIUM CAO ÁP 51.2V RACK 500AH
              </h3>
              <p class="text-[11px] text-slate-500 line-clamp-2 leading-relaxed">
                Hệ thống pin lưu trữ cao áp tích hợp mạch BMS thông minh.
              </p>
            </div>
            <a href="san-pham.html?filter=battery" class="w-full py-2.5 bg-slate-900 hover:bg-blue-600 text-white font-bold rounded-xl text-xs text-center transition-all block">
              Xem Chi Tiết
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- SECTION 2C: VẬT TƯ & PHỤ KIỆN LẮP ĐẶT ĐIỆN MẶT TRỜI (4 SẢN PHẨM / 1 HÀNG) -->
  <section class="py-16 bg-slate-50/60 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
        <div>
          <span class="text-xs font-extrabold uppercase text-blue-600 tracking-wider bg-blue-100/80 px-3.5 py-1 rounded-full border border-blue-200">Vật Tư & Phụ Kiện</span>
          <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-heading mt-2">
            Vật Tư Lắp Đặt & Tủ Điện Bảo Vệ Chống Sét Solar
          </h2>
        </div>
        <a href="san-pham.html?filter=accessories" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition-all whitespace-nowrap">
          <span>Xem Tất Cả Vật Tư</span>
          <i class="fas fa-arrow-right text-xs"></i>
        </a>
      </div>

      <!-- 4 PRODUCTS PER ROW GRID -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- PROD 1: DÂY CÁP DC SOLAR -->
        <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/90 hover:border-blue-600 hover:shadow-xl transition-all duration-300 flex flex-col group">
          <div class="relative bg-slate-50/80 p-5 flex items-center justify-center h-48 border-b border-slate-100">
            <img src="{{ asset('assets/images/') }}/dc_solar_cable_mc4.png" alt="Dây Cáp Điện DC Solar" class="h-36 max-w-full object-contain group-hover:scale-105 transition-transform duration-300">
          </div>
          <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
            <div class="space-y-1.5">
              <span class="text-[9px] text-blue-600 font-extrabold uppercase bg-blue-50 px-2 py-0.5 rounded">Dây Cáp DC</span>
              <h3 class="font-extrabold text-slate-900 text-sm line-clamp-2 group-hover:text-blue-600 transition-colors">
                DÂY CÁP ĐIỆN DC SOLAR 4MM2 / 6MM2 CHỐNG TIA UV
              </h3>
              <p class="text-[11px] text-slate-500 line-clamp-2 leading-relaxed">
                Cáp điện DC chuyên dụng chịu nhiệt độ cao ngoài trời.
              </p>
            </div>
            <a href="san-pham.html?filter=accessories" class="w-full py-2.5 bg-slate-900 hover:bg-blue-600 text-white font-bold rounded-xl text-xs text-center transition-all block">
              Xem Chi Tiết
            </a>
          </div>
        </div>

        <!-- PROD 2: ĐẦU NỐI MC4 STAUBLI -->
        <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/90 hover:border-blue-600 hover:shadow-xl transition-all duration-300 flex flex-col group">
          <div class="relative bg-slate-50/80 p-5 flex items-center justify-center h-48 border-b border-slate-100">
            <img src="{{ asset('assets/images/') }}/dc_solar_cable_mc4.png" alt="Đầu Nối MC4 Staubli" class="h-36 max-w-full object-contain group-hover:scale-105 transition-transform duration-300">
          </div>
          <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
            <div class="space-y-1.5">
              <span class="text-[9px] text-blue-600 font-extrabold uppercase bg-blue-50 px-2 py-0.5 rounded">Staubli MC4</span>
              <h3 class="font-extrabold text-slate-900 text-sm line-clamp-2 group-hover:text-blue-600 transition-colors">
                BỘ ĐẦU NỐI CẶP MC4 STAUBLI CHỐNG NƯỚC IP68
              </h3>
              <p class="text-[11px] text-slate-500 line-clamp-2 leading-relaxed">
                Đầu nối MC4 Thụy Sĩ dẫn điện tối ưu chống rò rỉ điện.
              </p>
            </div>
            <a href="san-pham.html?filter=accessories" class="w-full py-2.5 bg-slate-900 hover:bg-blue-600 text-white font-bold rounded-xl text-xs text-center transition-all block">
              Xem Chi Tiết
            </a>
          </div>
        </div>

        <!-- PROD 3: TỦ ĐIỆN BẢO VỆ CHỐNG SÉT AC/DC -->
        <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/90 hover:border-blue-600 hover:shadow-xl transition-all duration-300 flex flex-col group">
          <div class="relative bg-slate-50/80 p-5 flex items-center justify-center h-48 border-b border-slate-100">
            <img src="{{ asset('assets/images/') }}/solar_combiner_box.png" alt="Tủ Điện Chống Sét Solar" class="h-36 max-w-full object-contain group-hover:scale-105 transition-transform duration-300">
          </div>
          <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
            <div class="space-y-1.5">
              <span class="text-[9px] text-blue-600 font-extrabold uppercase bg-blue-50 px-2 py-0.5 rounded">Tủ Điện Solar</span>
              <h3 class="font-extrabold text-slate-900 text-sm line-clamp-2 group-hover:text-blue-600 transition-colors">
                TỦ ĐIỆN BẢO VỆ AC/DC CHỐNG SÉT LAN TRUYỀN
              </h3>
              <p class="text-[11px] text-slate-500 line-clamp-2 leading-relaxed">
                Tủ điện lắp sẵn Aptomat DC/AC & chống sét lan truyền SPD.
              </p>
            </div>
            <a href="san-pham.html?filter=cabinet" class="w-full py-2.5 bg-slate-900 hover:bg-blue-600 text-white font-bold rounded-xl text-xs text-center transition-all block">
              Xem Chi Tiết
            </a>
          </div>
        </div>

        <!-- PROD 4: KHUNG RAIL NHÔM & KẸP PIN -->
        <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/90 hover:border-blue-600 hover:shadow-xl transition-all duration-300 flex flex-col group">
          <div class="relative bg-slate-50/80 p-5 flex items-center justify-center h-48 border-b border-slate-100">
            <img src="{{ asset('assets/images/') }}/solar_mounting_rail.png" alt="Thanh Rail Nhôm Kẹp Solar" class="h-36 max-w-full object-contain group-hover:scale-105 transition-transform duration-300">
          </div>
          <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
            <div class="space-y-1.5">
              <span class="text-[9px] text-blue-600 font-extrabold uppercase bg-blue-50 px-2 py-0.5 rounded">Phụ Kiện Khung</span>
              <h3 class="font-extrabold text-slate-900 text-sm line-clamp-2 group-hover:text-blue-600 transition-colors">
                THANH RAIL NHÔM ĐỊNH HÌNH & KẸP BIÊN / KẸP GIỮA
              </h3>
              <p class="text-[11px] text-slate-500 line-clamp-2 leading-relaxed">
                Hệ thống khung giá đỡ nhôm Anodized chịu gió bão.
              </p>
            </div>
            <a href="san-pham.html?filter=accessories" class="w-full py-2.5 bg-slate-900 hover:bg-blue-600 text-white font-bold rounded-xl text-xs text-center transition-all block">
              Xem Chi Tiết
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- SECTION 3: SOLAR SOLUTIONS BY APPLICATION SCALE -->
  <section class="py-20 bg-white border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
      <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
        <span class="text-xs font-extrabold uppercase text-blue-600 tracking-wider bg-blue-50 px-4 py-1.5 rounded-full border border-blue-100">Giải Pháp Theo Quy Mô</span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-heading">
          Giải Pháp Điện Mặt Trời Cho Mọi Nhu Cầu
        </h2>
        <p class="text-slate-600 text-sm">
          Từ biệt thự gia đình đến nhà xưởng sản xuất quy mô lớn, Bách Anh Group đều có giải pháp biến tần InfiniSolar phù hợp nhất.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-slate-50 p-8 rounded-3xl border border-slate-200 hover:border-blue-600 hover:shadow-xl transition-all space-y-4">
          <div class="w-14 h-14 bg-blue-600 text-white rounded-2xl flex items-center justify-center text-2xl font-bold">
            <i class="fas fa-house-laptop"></i>
          </div>
          <h3 class="text-xl font-extrabold text-slate-900 font-heading">Hộ Gia Đình & Biệt Thự</h3>
          <p class="text-xs text-slate-600 leading-relaxed">
            Hệ thống điện mặt trời Hybrid 5KW - 10KW dùng biến tần InfiniSolar IP66, lưu trữ pin Lithium giúp chủ động nguồn điện 24/7.
          </p>
          <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 text-xs font-extrabold text-blue-600 hover:text-blue-800">
            <span>Tư Vấn Gói Gia Đình</span> <i class="fas fa-arrow-right"></i>
          </a>
        </div>

        <div class="bg-blue-600 text-white p-8 rounded-3xl shadow-xl space-y-4 relative overflow-hidden">
          <div class="w-14 h-14 bg-white text-blue-600 rounded-2xl flex items-center justify-center text-2xl font-bold shadow">
            <i class="fas fa-industry"></i>
          </div>
          <h3 class="text-xl font-extrabold text-white font-heading">Nhà Xưởng & Thương Mại</h3>
          <p class="text-xs text-blue-100 leading-relaxed">
            Hệ thống trạm điện mặt trời mái nhà xưởng 50KW - 500KW giảm đến 40% chi phí tiền điện hàng tháng cho doanh nghiệp.
          </p>
          <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 text-xs font-extrabold text-white hover:text-blue-200">
            <span>Tư Vấn Báo Giá Nhà Xưởng</span> <i class="fas fa-arrow-right"></i>
          </a>
        </div>

        <div class="bg-slate-50 p-8 rounded-3xl border border-slate-200 hover:border-blue-600 hover:shadow-xl transition-all space-y-4">
          <div class="w-14 h-14 bg-slate-900 text-blue-400 rounded-2xl flex items-center justify-center text-2xl font-bold">
            <i class="fas fa-building-user"></i>
          </div>
          <h3 class="text-xl font-extrabold text-slate-900 font-heading">Khu Công Nghiệp & Trang Trại</h3>
          <p class="text-xs text-slate-600 leading-relaxed">
            Giải pháp hòa lưới & lưu trữ công suất lớn >1MW tích hợp hệ thống quản lý điện năng thông minh EMS.
          </p>
          <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 text-xs font-extrabold text-blue-600 hover:text-blue-800">
            <span>Tư Vấn Dự Án Lớn</span> <i class="fas fa-arrow-right"></i>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION 4: LATEST SOLAR NEWS & TECHNICAL GUIDES -->
  <section class="py-20 bg-slate-50/70 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12">
        <div>
          <span class="text-xs font-extrabold uppercase text-blue-600 tracking-wider bg-blue-100/80 px-4 py-1.5 rounded-full border border-blue-200">Tin Tức & Kỹ Thuật Solar</span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-heading mt-2">
            Kinh Nghiệm Kỹ Thuật Điện Năng Lượng Mặt Trời
          </h2>
        </div>
        <a href="{{ route('news') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition-all whitespace-nowrap">
          <span>Xem Tất Cả Bài Viết</span>
          <i class="fas fa-arrow-right text-xs"></i>
        </a>
      </div>

      <!-- 3 NEWS CARDS GRID -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <!-- ARTICLE 1 -->
        <article class="bg-white rounded-2xl overflow-hidden border border-slate-200/90 hover:border-blue-600 hover:shadow-xl transition-all duration-300 flex flex-col group">
          <div class="relative h-48 overflow-hidden bg-slate-900">
            <img src="https://industrial-techsolution.matbao.website/wp-content/uploads/2024/01/background_2.jpg" alt="Hướng dẫn chọn Inverter Hybrid" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 opacity-80">
            <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-3 py-1 rounded-full shadow">Kỹ Thuật Inverter</span>
          </div>
          <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
            <div class="space-y-2">
              <div class="flex items-center gap-3 text-[11px] text-slate-500">
                <span><i class="far fa-calendar-alt text-blue-600 mr-1"></i> 05/08/2026</span>
                <span><i class="far fa-clock text-blue-600 mr-1"></i> 5 phút đọc</span>
              </div>
              <h3 class="font-extrabold text-slate-900 text-base group-hover:text-blue-600 transition-colors line-clamp-2">
                Hướng Dẫn Chọn Biến Tần Inverter Hybrid 10KW Chuẩn IP66 Cho Gia Đình & Nhà Xưởng
              </h3>
              <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed">
                Tìm hiểu các tiêu chí chọn mua biến tần Hybrid InfiniSolar 10KW, chuẩn kháng nước IP66 giúp tối ưu hiệu suất 97.5% cho nguồn điện liên tục.
              </p>
            </div>
            <a href="{{ route('news') }}" class="inline-flex items-center gap-2 text-xs font-bold text-blue-600 group-hover:text-blue-700">
              <span>Đọc tiếp bài viết</span>
              <i class="fas fa-chevron-right text-[10px]"></i>
            </a>
          </div>
        </article>

        <!-- ARTICLE 2 -->
        <article class="bg-white rounded-2xl overflow-hidden border border-slate-200/90 hover:border-blue-600 hover:shadow-xl transition-all duration-300 flex flex-col group">
          <div class="relative h-48 overflow-hidden bg-slate-900">
            <img src="{{ asset('assets/images/') }}/lithium_battery_48v.png" alt="Xu hướng pin Lithium 2026" class="w-full h-full object-contain p-4 group-hover:scale-110 transition-transform duration-500 opacity-90 bg-white">
            <span class="absolute top-3 left-3 bg-sky-600 text-white text-[10px] uppercase font-extrabold px-3 py-1 rounded-full shadow">Lưu Trữ Điện</span>
          </div>
          <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
            <div class="space-y-2">
              <div class="flex items-center gap-3 text-[11px] text-slate-500">
                <span><i class="far fa-calendar-alt text-blue-600 mr-1"></i> 02/08/2026</span>
                <span><i class="far fa-clock text-blue-600 mr-1"></i> 4 phút đọc</span>
              </div>
              <h3 class="font-extrabold text-slate-900 text-base group-hover:text-blue-600 transition-colors line-clamp-2">
                Xu Hướng Tích Hợp Pin Lưu Trữ Lithium 48V 200Ah Trong Hệ Thống Điện Mặt Trời 2026
              </h3>
              <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed">
                Tại sao các doanh nghiệp & hộ gia đình tại Việt Nam ưu tiên giải pháp pin Lithium LiFePO4 độ bền 6,000 chu kỳ sạc xả?
              </p>
            </div>
            <a href="{{ route('news') }}" class="inline-flex items-center gap-2 text-xs font-bold text-blue-600 group-hover:text-blue-700">
              <span>Đọc tiếp bài viết</span>
              <i class="fas fa-chevron-right text-[10px]"></i>
            </a>
          </div>
        </article>

        <!-- ARTICLE 3 -->
        <article class="bg-white rounded-2xl overflow-hidden border border-slate-200/90 hover:border-blue-600 hover:shadow-xl transition-all duration-300 flex flex-col group">
          <div class="relative h-48 overflow-hidden bg-slate-900">
            <img src="{{ asset('assets/images/') }}/solar_panel_550w.png" alt="Bảo dưỡng tấm pin mặt trời" class="w-full h-full object-contain p-4 group-hover:scale-110 transition-transform duration-500 opacity-90 bg-white">
            <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] uppercase font-extrabold px-3 py-1 rounded-full shadow">Vật Tư & Bảo Trì</span>
          </div>
          <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
            <div class="space-y-2">
              <div class="flex items-center gap-3 text-[11px] text-slate-500">
                <span><i class="far fa-calendar-alt text-blue-600 mr-1"></i> 28/07/2026</span>
                <span><i class="far fa-clock text-blue-600 mr-1"></i> 6 phút đọc</span>
              </div>
              <h3 class="font-extrabold text-slate-900 text-base group-hover:text-blue-600 transition-colors line-clamp-2">
                Quy Trình Kiểm Tra Bảo Dưỡng Tấm Pin Quang Điện & Tủ Điện Bảo Vệ Chống Sét Định Kỳ
              </h3>
              <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed">
                Hướng dẫn chi tiết từ chuyên gia kỹ thuật Bách Anh Group giúp duy trì hiệu suất quang điện 25 năm liên tục.
              </p>
            </div>
            <a href="{{ route('news') }}" class="inline-flex items-center gap-2 text-xs font-bold text-blue-600 group-hover:text-blue-700">
              <span>Đọc tiếp bài viết</span>
              <i class="fas fa-chevron-right text-[10px]"></i>
            </a>
          </div>
        </article>

      </div>
    </div>
  </section>

  <!-- WHY CHOOSE US (BLUE & WHITE PALETTE) -->
  <section class="py-20 bg-slate-900 text-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 relative z-10">
      <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
        <span class="text-xs font-extrabold uppercase text-blue-400 tracking-wider bg-blue-500/10 px-4 py-1.5 rounded-full border border-blue-500/20">Cam Kết Từ Bách Anh Group</span>
        <h2 class="text-3xl sm:text-4xl font-extrabold font-heading text-white">
          Tại Sao Khách Hàng Chọn Bách Anh Group Làm Nhà Phân Phối Thiết Bị Solar?
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="bg-slate-800/80 rounded-2xl p-8 border border-slate-700/80 hover:border-blue-500/60 transition-all hover-lift group">
          <div class="w-14 h-14 bg-blue-500/20 text-blue-400 rounded-2xl flex items-center justify-center text-2xl font-extrabold mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
            <i class="fas fa-certificate"></i>
          </div>
          <h3 class="text-xl font-bold text-white mb-3 font-heading">100% CO/CQ Chính Hãng</h3>
          <p class="text-slate-400 text-xs leading-relaxed">
            Phân phối biến tần Inverter Hybrid InfiniSolar, tấm pin 550W & pin Lithium có đầy đủ giấy chứng nhận xuất xứ CO/CQ.
          </p>
        </div>

        <div class="bg-slate-800/80 rounded-2xl p-8 border border-slate-700/80 hover:border-blue-500/60 transition-all hover-lift group">
          <div class="w-14 h-14 bg-blue-500/20 text-blue-400 rounded-2xl flex items-center justify-center text-2xl font-bold mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
            <i class="fas fa-shield-halved"></i>
          </div>
          <h3 class="text-xl font-bold text-white mb-3 font-heading">Bảo Hành 5-25 Năm</h3>
          <p class="text-slate-400 text-xs leading-relaxed">
            Bảo hành 5 năm chính hãng cho Inverter Hybrid InfiniSolar IP66 và 25 năm hiệu suất quang điện cho tấm pin 550W.
          </p>
        </div>

        <div class="bg-slate-800/80 rounded-2xl p-8 border border-slate-700/80 hover:border-blue-500/60 transition-all hover-lift group">
          <div class="w-14 h-14 bg-blue-500/20 text-blue-400 rounded-2xl flex items-center justify-center text-2xl font-bold mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
            <i class="fas fa-headset"></i>
          </div>
          <h3 class="text-xl font-bold text-white mb-3 font-heading">Hỗ Trợ Kỹ Thuật 24/7</h3>
          <p class="text-slate-400 text-xs leading-relaxed">
            Đội ngũ kỹ sư giàu kinh nghiệm sẵn sàng khảo sát, tính toán công suất trạm pin và hỗ trợ kỹ thuật 24/7 toàn quốc.
          </p>
        </div>

        <div class="bg-slate-800/80 rounded-2xl p-8 border border-slate-700/80 hover:border-blue-500/60 transition-all hover-lift group">
          <div class="w-14 h-14 bg-blue-500/20 text-blue-400 rounded-2xl flex items-center justify-center text-2xl font-bold mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
            <i class="fas fa-truck-fast"></i>
          </div>
          <h3 class="text-xl font-bold text-white mb-3 font-heading">Sẵn Kho Giao Siêu Tốc</h3>
          <p class="text-slate-400 text-xs leading-relaxed">
            Hệ thống kho bãi sẵn có tại Hà Nội, sẵn sàng giao biến tần, tấm pin và vật tư cáp DC Solar tận nơi cho thợ & đối tác.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- QUICK QUOTE INTERACTIVE FORM SECTION -->
  <section class="py-20 bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900 text-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
      <div class="bg-slate-800/90 border border-slate-700 rounded-3xl p-8 sm:p-12 shadow-2xl grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        
        <div class="lg:col-span-6 space-y-6">
          <span class="text-xs font-extrabold uppercase text-blue-400 tracking-wider bg-blue-500/10 px-4 py-1.5 rounded-full border border-blue-500/20">Nhận Báo Giá Nhanh</span>
          <h2 class="text-3xl sm:text-4xl font-extrabold font-heading text-white leading-tight">
            Yêu Cầu Tư Vấn & Báo Giá Thiết Bị Solar Trực Tiếp
          </h2>
          <p class="text-slate-300 text-sm leading-relaxed">
            Điền thông tin bên dưới, chuyên viên Bách Anh Group sẽ liên hệ gửi catalog thông số kỹ thuật và bảng báo giá phân phối vật tư điện mặt trời tốt nhất trong vòng <strong class="text-blue-400">15 phút</strong>.
          </p>
          <div class="pt-2 space-y-3 text-xs text-slate-300">
            <div class="flex items-center gap-3">
              <i class="fas fa-user-tie text-blue-400 text-base"></i>
              <span>Đại diện kinh doanh: <strong class="text-white font-bold">Mr. Lưu Thế Dũng</strong></span>
            </div>
            <div class="flex items-center gap-3">
              <i class="fas fa-phone-alt text-blue-400 text-base"></i>
              <span>Hotline trực tiếp: <a href="tel:0963982186" class="text-blue-400 font-extrabold hover:underline">0963 982 186</a></span>
            </div>
            <div class="flex items-center gap-3">
              <i class="fas fa-envelope text-blue-400 text-base"></i>
              <span>Email báo giá: <strong class="text-white">bachanhgroup.jsc@gmail.com</strong></span>
            </div>
          </div>
        </div>

        <div class="lg:col-span-6 bg-slate-900 p-6 sm:p-8 rounded-2xl border border-slate-700 shadow-xl space-y-4">
          <h3 class="text-lg font-bold text-white font-heading">Đăng Ký Nhận Báo Giá Ưu Đãi Solar</h3>
          <form onsubmit="event.preventDefault(); alert('Cảm ơn quý khách! Bách Anh Group đã nhận yêu cầu báo giá Solar và sẽ liên hệ trong 15 phút.');" class="space-y-4">
            <div>
              <label class="block text-xs font-bold text-slate-300 mb-1">Họ và Tên (*)</label>
              <input type="text" required placeholder="Nhập họ tên của bạn..." class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-xs text-white placeholder-slate-500 focus:outline-none focus:border-blue-500 transition-colors">
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-300 mb-1">Số Điện Thoại / Zalo (*)</label>
              <input type="tel" required placeholder="Nhập số điện thoại..." class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-xs text-white placeholder-slate-500 focus:outline-none focus:border-blue-500 transition-colors">
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-300 mb-1">Sản Phẩm Solar Quan Tâm</label>
              <select class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-xs text-white focus:outline-none focus:border-blue-500 transition-colors">
                <option value="inverter">Biến Tần Inverter Hybrid InfiniSolar / Sungrow / Huawei</option>
                <option value="panel">Tấm Pin Mặt Trời Mono Crystalline 550W+</option>
                <option value="battery">Pin Lưu Trữ Lithium LiFePO4 48V / High-Voltage</option>
                <option value="accessories">Vật Tư Cáp DC Solar, Tủ Điện AC/DC & Khung Rail Nhôm</option>
              </select>
            </div>
            <button type="submit" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs rounded-xl transition-all shadow-lg shadow-blue-600/30">
              <i class="fas fa-paper-plane mr-2"></i> Gửi Yêu Cầu Báo Giá Solar Ngay
            </button>
          </form>
        </div>

      </div>
    </div>
  </section>

  <!-- UNIFIED FOOTER -->
@endsection
