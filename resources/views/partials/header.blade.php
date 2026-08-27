<!-- STICKY HEADER -->
<header class="sticky top-0 z-50 w-full bg-white shadow-md transition-all duration-300">
  <!-- TOPBAR -->
  <div id="topbar" class="bg-slate-900 text-slate-300 text-xs py-2 px-4 sm:px-8 border-b border-slate-800 transition-all duration-300">
    <div class="max-w-[1400px] mx-auto flex flex-col md:flex-row justify-between items-center gap-2">
      <div class="flex flex-wrap items-center gap-4 sm:gap-6">
        <a href="tel:0963982186" class="flex items-center gap-2 hover:text-blue-400 transition-colors">
          <i class="fas fa-phone-alt text-blue-500"></i>
          <span class="font-semibold text-white">0963 982 186</span>
        </a>
        <a href="mailto:bachanhgroup.jsc@gmail.com" class="flex items-center gap-2 hover:text-blue-400 transition-colors">
          <i class="fas fa-envelope text-blue-500"></i>
          <span>bachanhgroup.jsc@gmail.com</span>
        </a>
        <span class="hidden lg:flex items-center gap-2 text-slate-400">
          <i class="fas fa-map-marker-alt text-blue-500"></i>
          <span data-i18n="address_short">Hà Nội, Việt Nam</span>
        </span>
      </div>

      <div class="flex items-center gap-4">
        <a href="{{ route('technical-support') }}" class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-xs font-semibold transition-colors whitespace-nowrap">
          <i class="fas fa-headset"></i>
          <span data-i18n="nav_support">Hỗ Trợ Kỹ Thuật 24/7</span>
        </a>
      </div>
    </div>
  </div>

  <!-- MAIN NAVBAR -->
  <nav id="main-navbar" class="bg-white/95 backdrop-blur-md py-3 transition-all duration-300 border-b border-slate-100">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-4">
      <!-- LOGO -->
      <a href="{{ route('home') }}" class="flex items-center gap-2.5 group flex-shrink-0">
        <img src="{{ asset('assets/images/logo.jpg') }}" alt="BÁCH ANH GROUP Logo" class="h-16 sm:h-20 lg:h-24 max-h-24 w-auto object-contain rounded-xl shadow-sm group-hover:scale-105 transition-transform duration-300">
      </a>

      <!-- DESKTOP NAV ITEMS -->
      <div class="hidden lg:flex items-center gap-0.5 xl:gap-2 flex-nowrap">
        <a href="{{ route('home') }}" class="px-2.5 xl:px-3.5 py-2 text-xs xl:text-sm font-semibold {{ request()->routeIs('home') ? 'text-blue-600 bg-blue-50' : 'text-slate-700 hover:text-blue-600 hover:bg-slate-50' }} rounded-xl transition-colors whitespace-nowrap" data-i18n="nav_home">Trang chủ</a>
        
        <div class="relative group">
          <a href="{{ route('about') }}" class="px-2.5 xl:px-3.5 py-2 text-xs xl:text-sm font-medium {{ request()->routeIs('about') ? 'text-blue-600 bg-blue-50' : 'text-slate-700 hover:text-blue-600 hover:bg-slate-50' }} rounded-xl transition-colors whitespace-nowrap inline-flex items-center gap-1">
            <span data-i18n="nav_about">Giới Thiệu</span>
            <i class="fas fa-chevron-down text-[9px] opacity-60 group-hover:rotate-180 transition-transform"></i>
          </a>
          <div class="absolute left-0 top-full pt-2 w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-2 space-y-1">
              <a href="{{ route('about') }}" class="block px-3.5 py-2 text-xs font-semibold text-slate-700 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-colors">Về Chúng Tôi</a>
              <a href="{{ route('about') }}#thong-diep" class="block px-3.5 py-2 text-xs font-semibold text-slate-700 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-colors">Thông Điệp Giám Đốc</a>
              <a href="{{ route('about') }}#lich-su" class="block px-3.5 py-2 text-xs font-semibold text-slate-700 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-colors">Năng Lực Phân Phối</a>
            </div>
          </div>
        </div>

        <div class="relative group">
          <a href="{{ route('products.index') }}" class="px-2.5 xl:px-3.5 py-2 text-xs xl:text-sm font-medium {{ request()->routeIs('products.*') ? 'text-blue-600 bg-blue-50' : 'text-slate-700 hover:text-blue-600 hover:bg-slate-50' }} rounded-xl transition-colors whitespace-nowrap inline-flex items-center gap-1">
            <span data-i18n="nav_products">Sản Phẩm</span>
            <i class="fas fa-chevron-down text-[9px] opacity-60 group-hover:rotate-180 transition-transform"></i>
          </a>
          <div class="absolute left-0 top-full pt-2 w-64 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-2 space-y-1">
              <a href="{{ route('products.solar-panel') }}" class="flex items-center gap-2 px-3.5 py-2 text-xs font-semibold text-slate-700 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-colors">
                <i class="fas fa-solar-panel text-blue-500"></i> 1. Tấm Pin Mặt Trời
              </a>
              <a href="{{ route('products.inverter') }}" class="flex items-center gap-2 px-3.5 py-2 text-xs font-semibold text-slate-700 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-colors">
                <i class="fas fa-bolt text-blue-500"></i> 2. Inverter Điện Mặt Trời
              </a>
              <a href="{{ route('products.battery') }}" class="flex items-center gap-2 px-3.5 py-2 text-xs font-semibold text-slate-700 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-colors">
                <i class="fas fa-battery-full text-blue-500"></i> 3. Pin Lưu Trữ Lithium
              </a>
              <a href="{{ route('products.pump') }}" class="flex items-center gap-2 px-3.5 py-2 text-xs font-semibold text-slate-700 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-colors">
                <i class="fas fa-water text-blue-500"></i> 4. Biến Tần Bơm Solar
              </a>
              <a href="{{ route('products.accessories') }}" class="flex items-center gap-2 px-3.5 py-2 text-xs font-semibold text-slate-700 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-colors">
                <i class="fas fa-plug text-blue-500"></i> 5. Phụ Kiện Solar & Cáp DC
              </a>
            </div>
          </div>
        </div>

        <a href="{{ route('projects') }}" class="px-2.5 xl:px-3.5 py-2 text-xs xl:text-sm font-medium {{ request()->routeIs('projects') ? 'text-blue-600 bg-blue-50' : 'text-slate-700 hover:text-blue-600 hover:bg-slate-50' }} rounded-xl transition-colors whitespace-nowrap" data-i18n="nav_projects">Dự Án</a>
        <a href="{{ route('news') }}" class="px-2.5 xl:px-3.5 py-2 text-xs xl:text-sm font-medium {{ request()->routeIs('news') ? 'text-blue-600 bg-blue-50' : 'text-slate-700 hover:text-blue-600 hover:bg-slate-50' }} rounded-xl transition-colors whitespace-nowrap" data-i18n="nav_news">Tin Tức</a>
        <a href="{{ route('lien-he') }}" class="px-2.5 xl:px-3.5 py-2 text-xs xl:text-sm font-medium {{ request()->routeIs('lien-he') ? 'text-blue-600 bg-blue-50' : 'text-slate-700 hover:text-blue-600 hover:bg-slate-50' }} rounded-xl transition-colors whitespace-nowrap" data-i18n="nav_contact">Liên Hệ</a>
        <a href="{{ route('technical-support') }}" class="px-2.5 xl:px-3.5 py-2 text-xs xl:text-sm font-medium {{ request()->routeIs('technical-support') ? 'text-blue-600 bg-blue-50' : 'text-slate-700 hover:text-blue-600 hover:bg-slate-50' }} rounded-xl transition-colors whitespace-nowrap" data-i18n="nav_support">Hỗ Trợ Kỹ Thuật</a>
      </div>

      <!-- ACTION BUTTON & LANGUAGE SWITCHER ON MAIN NAVBAR -->
      <div class="hidden lg:flex items-center gap-3 flex-shrink-0">
        <div class="relative group">
          <button id="lang-dropdown-btn" onclick="toggleLanguage()" title="Chuyển đổi ngôn ngữ / Switch Language" class="flex items-center gap-2 px-3.5 py-1.5 bg-slate-100/90 hover:bg-blue-50 hover:border-blue-300 border border-slate-200/90 rounded-full text-xs font-bold text-slate-800 shadow-sm transition-all">
            <span id="current-lang-flag">🇻🇳</span>
            <span id="current-lang-code">VI</span>
            <i class="fas fa-sync-alt text-[9px] text-slate-400 group-hover:rotate-180 transition-transform"></i>
          </button>
          
          <div class="absolute right-0 top-full pt-2 w-40 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-1.5 space-y-1">
              <button onclick="setLanguage('vi')" class="w-full flex items-center gap-2 px-3 py-2 text-xs font-semibold text-slate-700 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-colors text-left">
                <span>🇻🇳</span> Tiếng Việt (VI)
              </button>
              <button onclick="setLanguage('en')" class="w-full flex items-center gap-2 px-3 py-2 text-xs font-semibold text-slate-700 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-colors text-left">
                <span>🇬🇧</span> English (EN)
              </button>
            </div>
          </div>
        </div>

        <a href="{{ route('lien-he') }}" class="px-4 xl:px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold text-xs xl:text-sm shadow-md shadow-blue-600/20 whitespace-nowrap">
          <span data-i18n="nav_quote">Yêu Cầu Báo Giá Solar</span>
        </a>
      </div>
      <!-- MOBILE ACTIONS (LANG TOGGLE + HAMBURGER) -->
      <div class="flex lg:hidden items-center gap-2">
        <button onclick="toggleLanguage()" title="Chuyển đổi ngôn ngữ / Switch Language" class="flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 border border-blue-200 hover:bg-blue-100 rounded-full text-xs font-extrabold text-blue-700 shadow-sm transition-all">
          <i class="fas fa-globe text-xs"></i>
          <span class="mobile-lang-code">VI</span>
        </button>
        <button id="mobile-menu-btn" class="p-2 text-slate-700 hover:text-blue-600"><i class="fas fa-bars text-2xl"></i></button>
      </div>
    </div>
  </nav>
</header>

<!-- MOBILE DRAWER -->
<div id="mobile-backdrop" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden transition-opacity"></div>
<div id="mobile-drawer" class="fixed top-0 right-0 h-full w-80 bg-white z-50 transform translate-x-full transition-transform duration-300 ease-in-out shadow-2xl flex flex-col">
  <div class="p-5 border-b border-slate-100 flex justify-between items-center">
    <a href="{{ route('home') }}" class="flex items-center gap-2">
      <img src="{{ asset('assets/images/logo.jpg') }}" alt="BÁCH ANH GROUP Logo" class="h-12 sm:h-14 w-auto object-contain rounded-xl shadow-sm">
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
    <a href="{{ route('lien-he') }}" class="block px-4 py-3 font-medium text-slate-700 hover:bg-slate-50 rounded-xl" data-i18n="nav_contact">Liên Hệ</a>
    <a href="{{ route('technical-support') }}" class="block px-4 py-3 font-medium text-slate-700 hover:bg-slate-50 rounded-xl" data-i18n="nav_support">Hỗ Trợ Kỹ Thuật</a>
  </div>
  <div class="p-6 border-t border-slate-100 bg-slate-50 space-y-4">
    <a href="tel:0963982186" class="flex items-center gap-3 text-sm font-semibold text-slate-800">
      <i class="fas fa-phone-alt text-blue-600"></i> 0963 982 186
    </a>
    <a href="{{ route('lien-he') }}" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-xl text-center block shadow-md">
      <span data-i18n="nav_quote">Yêu Cầu Báo Giá Solar</span>
    </a>
  </div>
</div>
