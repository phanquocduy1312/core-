@extends('layouts.app')

@section('title', 'Giới Thiệu Về BÁCH ANH GROUP - Nhà Phân Phối Năng Lượng Mặt Trời')
@section('meta_description', 'Giới thiệu về Bách Anh Group - Đơn vị uy tín hàng đầu trong lĩnh vực nhập khẩu và phân phối thiết bị năng lượng mặt trời.')

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

  <!-- BANNER HEADER -->
  <section class="bg-slate-900 text-white py-16 relative overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-20">
      <img src="https://industrial-techsolution.matbao.website/wp-content/uploads/2024/01/background_2.jpg" alt="Banner" class="w-full h-full object-cover">
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-8 relative z-10 text-center">
      <h1 class="text-4xl font-extrabold font-heading">Về Chúng Tôi</h1>
      <div class="flex justify-center items-center gap-2 text-xs text-slate-400 mt-3">
        <a href="{{ route('home') }}" class="hover:text-white" data-i18n="nav_home">Trang chủ</a>
        <i class="fas fa-chevron-right text-[10px]"></i>
        <span class="text-blue-400">Về Chúng Tôi</span>
      </div>
    </div>
  </section>

  <!-- SECTION 1: SỰ RA ĐỜI TỪ NỀN TẢNG KỸ THUẬT THUẦN TÚY -->
  <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
      <div class="lg:col-span-6 space-y-6">
        <span class="text-xs font-extrabold uppercase text-blue-600 bg-blue-50 px-3.5 py-1.5 rounded-full border border-blue-100">Khởi Nguồn Phát Triển</span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-heading leading-tight">
          Sự Ra Đời Từ Nền Tảng Kỹ Thuật Thuần Túy
        </h2>
        <p class="text-slate-600 leading-relaxed text-sm sm:text-base">
          CÔNG TY CỔ PHẦN BÁCH ANH GROUP được thành lập từ khát vọng đưa công nghệ tự động hóa & gia công cơ khí chính xác Châu Âu về thị trường Việt Nam.
        </p>
        <p class="text-slate-600 leading-relaxed text-sm sm:text-base">
          Chúng tôi nghiên cứu sâu rộng quy trình công nghệ rửa xe tự động, bảo vệ kim loại chống gỉ muối biển và cung ứng hóa chất công nghiệp chuẩn xanh sinh học. Với nền tảng nghiên cứu bài bản, Bách Anh Group tự hào là đối tác chiến lược của hàng loạt nhà máy và xưởng gara công nghiệp hàng đầu.
        </p>
        
        <div class="grid grid-cols-2 gap-4 pt-2">
          <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
            <div class="text-2xl font-extrabold text-blue-600 font-heading">100%</div>
            <div class="text-xs text-slate-500 font-medium mt-1">Chuẩn ISO 9001:2015</div>
          </div>
          <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
            <div class="text-2xl font-extrabold text-blue-600 font-heading">24/7</div>
            <div class="text-xs text-slate-500 font-medium mt-1">Hỗ Trợ Kỹ Thuật Tận Nơi</div>
          </div>
        </div>
      </div>
      <div class="lg:col-span-6 relative">
        <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-slate-100">
          <img src="https://industrial-techsolution.matbao.website/wp-content/uploads/2024/01/post_05-640x480-1.jpg" alt="About Bách Anh Group" class="w-full h-96 object-cover">
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION 2: 4 KHỐI DỊCH VỤ / LĨNH VỰC HOẠT ĐỘNG (4 CARDS GRID) -->
  <section class="py-20 bg-slate-50 border-y border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
      <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
        <span class="text-xs font-extrabold uppercase text-blue-600 bg-blue-100/60 px-3.5 py-1 rounded-full">Lĩnh Vực Nòng Cốt</span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-heading">Dịch Vụ & Sản Phẩm Nòng Cốt</h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Card 1 -->
        <div class="bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl border border-slate-100 transition-all hover-lift space-y-4">
          <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-3xl font-bold">
            <i class="fas fa-car"></i>
          </div>
          <h3 class="text-xl font-bold text-slate-900 font-heading">Phụ Tùng Và Hệ Thống Ô Tô</h3>
          <p class="text-slate-600 text-sm leading-relaxed">
            Cung cấp linh kiện cơ khí chính xác CNC, hệ thống truyền động và phụ tùng ô tô đạt chuẩn kiểm định Châu Âu.
          </p>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl border border-slate-100 transition-all hover-lift space-y-4">
          <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-3xl font-bold">
            <i class="fas fa-wrench"></i>
          </div>
          <h3 class="text-xl font-bold text-slate-900 font-heading">Dịch Vụ Bảo Trì & Sửa Chữa</h3>
          <p class="text-slate-600 text-sm leading-relaxed">
            Đội ngũ kỹ sư giàu kinh nghiệm thực hiện kiểm tra định kỳ, bảo dưỡng máy móc và thay thế phụ tùng tận xưởng.
          </p>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl border border-slate-100 transition-all hover-lift space-y-4">
          <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-3xl font-bold">
            <i class="fas fa-headset"></i>
          </div>
          <h3 class="text-xl font-bold text-slate-900 font-heading">Trung Tâm Hỗ Trợ 24/7</h3>
          <p class="text-slate-600 text-sm leading-relaxed">
            Kênh phản hồi nhanh, tư vấn vận hành trạm rửa xe tự động và khắc phục sự cố khẩn cấp 24/7.
          </p>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl border border-slate-100 transition-all hover-lift space-y-4">
          <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-3xl font-bold">
            <i class="fas fa-gears"></i>
          </div>
          <h3 class="text-xl font-bold text-slate-900 font-heading">Trạm Rửa Xe Tự Động</h3>
          <p class="text-slate-600 text-sm leading-relaxed">
            Thiết kế, nhập khẩu và lắp đặt trọn gói hệ thống rửa xe tự động công suất lớn tiết kiệm 40% điện nước.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION 3: BẠN ĐANG TÌM KIẾM MỘT ĐỐI TÁC ĐÁNG TIN CẬY VÀ ỔN ĐỊNH? -->
  <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
      <div class="lg:col-span-6 space-y-6">
        <span class="text-xs font-extrabold uppercase text-blue-600 bg-blue-50 px-3.5 py-1.5 rounded-full border border-blue-100">Cam Kết Đồng Hành</span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-heading leading-tight">
          Bạn Đang Tìm Kiếm Một Đối Tác Đáng Tin Cậy Và Ổn Định?
        </h2>
        <p class="text-slate-600 leading-relaxed text-sm sm:text-base">
          Bách Anh Group hiểu rằng trong ngành kỹ thuật công nghiệp, sự ổn định của thiết bị chính là chìa khóa kinh doanh của bạn. Chúng tôi đồng hành xuyên suốt từ khâu tư vấn thiết kế ban đầu đến bảo trì lâu dài.
        </p>

        <div class="space-y-4 pt-2">
          <!-- Step 1 -->
          <div class="flex items-start gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100">
            <div class="w-10 h-10 rounded-xl bg-blue-600 text-white font-bold flex items-center justify-center flex-shrink-0">
              1
            </div>
            <div>
              <h4 class="font-bold text-slate-900 text-base">Bắt Đầu Với Một Ý Tưởng</h4>
              <p class="text-xs text-slate-600 mt-1">Khảo sát mặt bằng, tư vấn cấu hình dây chuyền máy móc và lập dự toán tối ưu cho khách hàng.</p>
            </div>
          </div>

          <!-- Step 2 -->
          <div class="flex items-start gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100">
            <div class="w-10 h-10 rounded-xl bg-blue-600 text-white font-bold flex items-center justify-center flex-shrink-0">
              2
            </div>
            <div>
              <h4 class="font-bold text-slate-900 text-base">Thể Hiện Kỹ Năng & Thi Công Bàn Giao</h4>
              <p class="text-xs text-slate-600 mt-1">Lắp đặt chính xác chuẩn kỹ thuật, chạy thử tải và đào tạo vận hành bàn giao trọn gói.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="lg:col-span-6">
        <div class="grid grid-cols-2 gap-4">
          <img src="https://industrial-techsolution.matbao.website/wp-content/uploads/2024/01/inner_office_1-1.jpg" alt="Office 1" class="rounded-2xl shadow-md w-full h-56 object-cover">
          <img src="https://industrial-techsolution.matbao.website/wp-content/uploads/2024/01/inner_history_1.jpg" alt="Office 2" class="rounded-2xl shadow-md w-full h-56 object-cover mt-8">
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION 4: THÔNG ĐIỆP GIÁM ĐỐC -->
  <section id="thong-diep" class="py-20 bg-white border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
      <div class="bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900 text-white rounded-3xl p-8 sm:p-14 shadow-2xl relative overflow-hidden grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
        <div class="lg:col-span-4 flex flex-col items-center text-center">
          <div class="w-36 h-36 bg-blue-600 rounded-full flex items-center justify-center text-5xl font-extrabold text-white border-4 border-white/20 shadow-xl mb-4">
            D
          </div>
          <h3 class="text-2xl font-extrabold font-heading text-white">Lưu Thế Dũng</h3>
          <span class="text-xs text-blue-400 font-semibold uppercase tracking-wider mt-1">Chủ Tịch & Tổng Giám Đốc</span>
          <span class="text-xs text-slate-400 mt-0.5">BÁCH ANH GROUP JSC</span>
        </div>

        <div class="lg:col-span-8 space-y-6">
          <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-500/20 text-blue-300 rounded-lg text-xs font-bold uppercase">
            <i class="fas fa-quote-left"></i> Thông Điệp Lãnh Đạo
          </div>
          <h3 class="text-2xl sm:text-3xl font-bold font-heading leading-snug">
            "Chất Lượng Chuẩn Xác Là Nền Tảng Cho Sự Bền Vững"
          </h3>
          <p class="text-slate-300 text-sm sm:text-base leading-relaxed italic">
            "Tại Bách Anh Group, chúng tôi tin rằng uy tín thương hiệu không xây dựng từ những lời quảng cáo, mà đến từ sự hoạt động ổn định của từng cỗ máy, từng linh kiện chúng tôi cung ứng cho khách hàng. Chúng tôi cam kết tiếp tục đồng hành và đem lại các giải pháp công nghiệp đột phá nhất."
          </p>

          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 border-t border-slate-800 text-xs">
            <div>
              <span class="block text-slate-400 font-bold">Trình Độ:</span>
              <span class="text-white font-medium">Kỹ Sư Cơ Khí & Tự Động Hóa</span>
            </div>
            <div>
              <span class="block text-slate-400 font-bold">Kinh Nghiệm:</span>
              <span class="text-white font-medium">15+ Năm Quản Trị Công Nghiệp</span>
            </div>
            <div>
              <span class="block text-slate-400 font-bold">Triết Lý:</span>
              <span class="text-white font-medium">Suy Nghĩ Lớn - Thành Công Lớn</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



  <!-- SECTION 6: LỊCH SỬ HÌNH THÀNH -->
  <section id="lich-su" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
      <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
        <span class="text-xs font-extrabold uppercase text-blue-600 bg-blue-50 px-3.5 py-1 rounded-full">Hành Trình Đổi Mới</span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-heading">Lịch Sử Hình Thành & Cột Mốc</h2>
      </div>

      <div class="relative border-l-2 border-blue-500 ml-4 md:ml-32 space-y-12 pl-8">
        <div class="relative group">
          <div class="absolute -left-[41px] top-1 w-5 h-5 rounded-full bg-blue-600 border-4 border-white shadow"></div>
          <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200/80 max-w-2xl space-y-2">
            <span class="text-xs font-extrabold text-blue-600 bg-blue-100 px-2.5 py-1 rounded-md">Năm 2016</span>
            <h4 class="text-lg font-bold text-slate-900 font-heading">Thành Lập Doanh Nghiệp</h4>
            <p class="text-xs text-slate-600 leading-relaxed">Bắt đầu hoạt động với mô hình phân phối thiết bị cơ khí công nghiệp quy mô nhỏ tại Hà Nội.</p>
          </div>
        </div>

        <div class="relative group">
          <div class="absolute -left-[41px] top-1 w-5 h-5 rounded-full bg-blue-600 border-4 border-white shadow"></div>
          <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200/80 max-w-2xl space-y-2">
            <span class="text-xs font-extrabold text-blue-600 bg-blue-100 px-2.5 py-1 rounded-md">Năm 2019</span>
            <h4 class="text-lg font-bold text-slate-900 font-heading">Đột Phá Hệ Thống Rửa Tự Động</h4>
            <p class="text-xs text-slate-600 leading-relaxed">Triển khai trạm rửa xe tự động đầu tiên, hợp tác nhập khẩu dây chuyền Châu Âu.</p>
          </div>
        </div>

        <div class="relative group">
          <div class="absolute -left-[41px] top-1 w-5 h-5 rounded-full bg-blue-600 border-4 border-white shadow"></div>
          <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200/80 max-w-2xl space-y-2">
            <span class="text-xs font-extrabold text-blue-600 bg-blue-100 px-2.5 py-1 rounded-md">Năm 2022</span>
            <h4 class="text-lg font-bold text-slate-900 font-heading">Đạt Chứng Nhận Chuẩn ISO 9001:2015</h4>
            <p class="text-xs text-slate-600 leading-relaxed">Hoàn thiện toàn bộ quy trình kiểm định chất lượng sản phẩm & trung tâm hỗ trợ bảo hành tận nơi.</p>
          </div>
        </div>

        <div class="relative group">
          <div class="absolute -left-[41px] top-1 w-5 h-5 rounded-full bg-blue-600 border-4 border-white shadow"></div>
          <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200/80 max-w-2xl space-y-2">
            <span class="text-xs font-extrabold text-blue-600 bg-blue-100 px-2.5 py-1 rounded-md">Năm 2026</span>
            <h4 class="text-lg font-bold text-slate-900 font-heading">Chuyển Đổi Số & Dịch Vụ Web-Scale</h4>
            <p class="text-xs text-slate-600 leading-relaxed">Ra mắt cổng thông tin trực tuyến `bachanhgroupcom140.mbws.vn`, hỗ trợ kỹ thuật song ngữ 24/7.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION 7: CTA BANNER -->
  <section class="py-16 bg-gradient-to-r from-slate-900 via-blue-950 to-slate-900 text-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 relative z-10 text-center space-y-6">
      <h2 class="text-3xl sm:text-4xl font-extrabold font-heading">
        BẮT ĐẦU VỚI BÁCH ANH GROUP
      </h2>
      <p class="text-slate-300 text-sm max-w-2xl mx-auto">
        Hãy để Bách Anh Group đồng hành cùng bạn nâng tầm hiệu quả công nghệ cơ khí và hệ thống tự động hóa.
      </p>
      <div class="flex flex-wrap justify-center gap-4 pt-2">
        <a href="{{ route('contact') }}" class="px-7 py-3.5 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl shadow-lg transition-all text-sm">
          Yêu Cầu Báo Giá Ngay
        </a>
        <a href="tel:0963982186" class="px-7 py-3.5 bg-white/10 hover:bg-white/20 text-white font-bold rounded-xl border border-white/20 transition-all text-sm">
          <i class="fas fa-phone-alt mr-2 text-blue-400"></i> 0963 982 186
        </a>
      </div>
    </div>
  </section>

  <!-- RICH 4-COLUMN FOOTER -->
  <!-- UNIFIED FOOTER -->
@endsection
