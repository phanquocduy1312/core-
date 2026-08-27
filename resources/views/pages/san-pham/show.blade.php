@extends('layouts.app')

@section('title', 'Chi Tiết Inverter Hybrid InfiniSolar 10KW - BÁCH ANH GROUP')

@section('content')
<!-- ACTION BUTTONS -->
          <div class="space-y-3 pt-2">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
              <a href="{{ route('lien-he') }}" class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs sm:text-sm rounded-xl text-center shadow-lg shadow-blue-600/30 transition-all flex items-center justify-center gap-2">
                <i class="fas fa-paper-plane text-base"></i> Yêu Cầu Báo Giá Sỉ / Lẻ
              </a>
              <a href="tel:0963982186" class="w-full py-4 bg-slate-900 hover:bg-blue-600 text-white font-extrabold text-xs sm:text-sm rounded-xl text-center transition-all flex items-center justify-center gap-2 shadow-md">
                <i class="fas fa-phone-volume text-blue-400 text-base"></i> Hotline: 0963 982 186
              </a>
            </div>
            
            <a href="https://zalo.me/0963982186" target="_blank" class="w-full py-3 bg-sky-50 hover:bg-sky-100 text-sky-700 border border-sky-200 font-bold text-xs rounded-xl text-center block transition-all">
              <i class="fab fa-whatsapp text-base mr-1"></i> Tư Vấn Kỹ Thuật Qua Zalo (24/7)
            </a>
          </div>

          <!-- COMMITMENT BADGES -->
          <div class="pt-4 border-t border-slate-200/80 grid grid-cols-3 gap-2 text-[11px] text-slate-600 text-center">
            <div class="space-y-1">
              <i class="fas fa-truck text-blue-600 text-base block"></i>
              <span>Giao Hàng Siêu Tốc 24h</span>
            </div>
            <div class="space-y-1">
              <i class="fas fa-certificate text-blue-600 text-base block"></i>
              <span>Đầy Đủ CO/CQ Chính Hãng</span>
            </div>
            <div class="space-y-1">
              <i class="fas fa-headset text-blue-600 text-base block"></i>
              <span>Kỹ Thuật Hỗ Trợ 24/7</span>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- PRODUCT SPECIFICATION & DETAILED TABS -->
  <section class="py-16 bg-slate-50 border-t border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 space-y-8">
      
      <!-- TABS HEADER -->
      <div class="flex flex-wrap items-center gap-2 border-b border-slate-200">
        <button onclick="switchTab('tab-spec')" id="btn-tab-spec" class="px-6 py-3 border-b-2 border-blue-600 font-extrabold text-xs sm:text-sm text-blue-600 bg-white rounded-t-xl transition-all">
          <i class="fas fa-list-check mr-2"></i> Bảng Thông Số Kỹ Thuật
        </button>
        <button onclick="switchTab('tab-features')" id="btn-tab-features" class="px-6 py-3 border-b-2 border-transparent font-bold text-xs sm:text-sm text-slate-600 hover:text-blue-600 transition-all">
          <i class="fas fa-star mr-2"></i> Tính Năng Nổi Bật InfiniSolar
        </button>
        <button onclick="switchTab('tab-warranty')" id="btn-tab-warranty" class="px-6 py-3 border-b-2 border-transparent font-bold text-xs sm:text-sm text-slate-600 hover:text-blue-600 transition-all">
          <i class="fas fa-shield-halved mr-2"></i> Quy Trình Bảo Hành 5 Năm
        </button>
      </div>

      <!-- TAB 1: TECHNICAL SPECIFICATION TABLE -->
      <div id="tab-spec" class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-6">
        <h3 class="text-xl font-extrabold text-slate-900 font-heading flex items-center gap-2">
          <i class="fas fa-table text-blue-600"></i> Bảng Thông Số Điện Kỹ Thuật InfiniSolar (PH11-10KL1-EU-G2)
        </h3>

        <div class="overflow-x-auto">
          <table class="w-full text-xs text-left border-collapse">
            <thead>
              <tr class="bg-slate-100 text-slate-800 font-bold uppercase">
                <th class="p-3.5 border border-slate-200 w-1/3">Hạng Mục Thông Số</th>
                <th class="p-3.5 border border-slate-200">Giá Trị Kỹ Thuật Đạt Chuẩn</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 text-slate-700">
              <tr class="hover:bg-blue-50/50 transition-colors">
                <td class="p-3.5 border border-slate-200 font-bold text-slate-900">Công suất định mức AC ngõ ra</td>
                <td class="p-3.5 border border-slate-200">10,000W (10KW 1 Pha / 3 Pha)</td>
              </tr>
              <tr class="hover:bg-blue-50/50 transition-colors">
                <td class="p-3.5 border border-slate-200 font-bold text-slate-900">Công suất mảng pin mặt trời PV Max</td>
                <td class="p-3.5 border border-slate-200">20,000W (20KW Dual PV String)</td>
              </tr>
              <tr class="hover:bg-blue-50/50 transition-colors">
                <td class="p-3.5 border border-slate-200 font-bold text-slate-900">Số lượng bộ theo dõi MPPT</td>
                <td class="p-3.5 border border-slate-200">2 Bộ MPPT độc lập (Dual Tracker 36A + 36A)</td>
              </tr>
              <tr class="hover:bg-blue-50/50 transition-colors">
                <td class="p-3.5 border border-slate-200 font-bold text-slate-900">Dải điện áp hoạt động MPPT</td>
                <td class="p-3.5 border border-slate-200">120VDC - 500VDC (Điện áp mở mạch Max 550VDC)</td>
              </tr>
              <tr class="hover:bg-blue-50/50 transition-colors">
                <td class="p-3.5 border border-slate-200 font-bold text-slate-900">Điện áp danh định Acquy / Pin Lithium</td>
                <td class="p-3.5 border border-slate-200">48VDC (Dải điện áp làm việc 40VDC - 60VDC)</td>
              </tr>
              <tr class="hover:bg-blue-50/50 transition-colors">
                <td class="p-3.5 border border-slate-200 font-bold text-slate-900">Dòng sạc / xả pin tối đa</td>
                <td class="p-3.5 border border-slate-200">210A (Hỗ trợ cài đặt dòng sạc thông minh qua BMS)</td>
              </tr>
              <tr class="hover:bg-blue-50/50 transition-colors">
                <td class="p-3.5 border border-slate-200 font-bold text-slate-900">Hiệu suất chuyển đổi tối đa (Max Efficiency)</td>
                <td class="p-3.5 border border-slate-200">97.5% (Hiệu suất MPPT >99.9%)</td>
              </tr>
              <tr class="hover:bg-blue-50/50 transition-colors">
                <td class="p-3.5 border border-slate-200 font-bold text-slate-900">Tiêu chuẩn bảo vệ kháng nước bụi</td>
                <td class="p-3.5 border border-slate-200">IP66 (Kháng nước mưa cực đoan, chịu nhiệt ngoài trời)</td>
              </tr>
              <tr class="hover:bg-blue-50/50 transition-colors">
                <td class="p-3.5 border border-slate-200 font-bold text-slate-900">Màn hình điều khiển & Cổng giao tiếp</td>
                <td class="p-3.5 border border-slate-200">Màn hình cảm ứng LCD 4.3" / WiFi / RS485 / CAN Bus / App mobile</td>
              </tr>
              <tr class="hover:bg-blue-50/50 transition-colors">
                <td class="p-3.5 border border-slate-200 font-bold text-slate-900">Kích thước & Trọng lượng</td>
                <td class="p-3.5 border border-slate-200">455 × 650 × 240 mm / Trọng lượng 38 kg</td>
              </tr>
              <tr class="hover:bg-blue-50/50 transition-colors">
                <td class="p-3.5 border border-slate-200 font-bold text-slate-900">Thời gian bảo hành chính hãng</td>
                <td class="p-3.5 border border-slate-200 font-extrabold text-blue-600">5 Năm (60 Tháng) Đổi Mới Khi Có Lỗi Kỹ Thuật</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- TAB 2: FEATURES -->
      <div id="tab-features" class="hidden bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-6">
        <h3 class="text-xl font-extrabold text-slate-900 font-heading flex items-center gap-2">
          <i class="fas fa-star text-blue-600"></i> Ưu Điểm Nổi Bật Bộ Biến Tần Inverter Hybrid InfiniSolar 10KW
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs text-slate-600">
          <div class="p-5 bg-slate-50 rounded-2xl border border-slate-200 space-y-2">
            <h4 class="font-extrabold text-slate-900 text-sm flex items-center gap-2">
              <i class="fas fa-shield-halved text-blue-600"></i> Kháng Nước Tuyệt Đối Chuẩn IP66
            </h4>
            <p class="leading-relaxed">Vỏ hợp kim đúc nguyên khối chống oxy hóa, kháng bụi và chống nước mưa áp lực cao chuẩn IP66 giúp lắp đặt trực tiếp ngoài trời không lo hư hỏng.</p>
          </div>
          <div class="p-5 bg-slate-50 rounded-2xl border border-slate-200 space-y-2">
            <h4 class="font-extrabold text-slate-900 text-sm flex items-center gap-2">
              <i class="fas fa-layer-group text-blue-600"></i> Khả Năng Ghép Song Song Mở Rộng 6 Bộ
            </h4>
            <p class="leading-relaxed">Hỗ trợ kết nối song song (Parallel) tối đa 6 máy InfiniSolar 10KW để nâng tổng công suất hệ thống lên tới 60KW cho nhà xưởng thương mại.</p>
          </div>
          <div class="p-5 bg-slate-50 rounded-2xl border border-slate-200 space-y-2">
            <h4 class="font-extrabold text-slate-900 text-sm flex items-center gap-2">
              <i class="fas fa-clock text-blue-600"></i> Chuyển Mạch Lưu Điện Siêu Tốc &lt;10ms (Zero Transfer Time)
            </h4>
            <p class="leading-relaxed">Khi mất điện lưới, biến tần tự động chuyển sang chế độ pin lưu trữ Lithium trong vòng dưới 10ms, giúp thiết bị điện, máy tính không bị tắt nguồn đột ngột.</p>
          </div>
          <div class="p-5 bg-slate-50 rounded-2xl border border-slate-200 space-y-2">
            <h4 class="font-extrabold text-slate-900 text-sm flex items-center gap-2">
              <i class="fas fa-mobile-screen-button text-blue-600"></i> Quản Lý Thông Minh Qua App Điện Thoại
            </h4>
            <p class="leading-relaxed">Tích hợp sẵn module WiFi theo dõi sản lượng điện tạo ra, dung lượng pin Lithium và cảnh báo sự cố từ xa qua ứng dụng iOS & Android 24/7.</p>
          </div>
        </div>
      </div>

      <!-- TAB 3: WARRANTY & INSTALLATION -->
      <div id="tab-warranty" class="hidden bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-6">
        <h3 class="text-xl font-extrabold text-slate-900 font-heading flex items-center gap-2">
          <i class="fas fa-award text-blue-600"></i> Cam Kết Chính Hãng & Chính Sách Bảo Hành Bách Anh Group
        </h3>
        <div class="space-y-4 text-xs text-slate-600 leading-relaxed">
          <p>
            Mọi sản phẩm biến tần Inverter Hybrid InfiniSolar do <strong>CÔNG TY CỔ PHẦN BÁCH ANH GROUP</strong> phân phối đều được cam kết 100% chính hãng, có chứng nhận xuất xứ CO và kiểm định chất lượng CQ đi kèm.
          </p>
          <ul class="list-disc pl-5 space-y-2">
            <li><strong>Thời hạn bảo hành:</strong> 5 năm (60 tháng) tính từ ngày bàn giao hoặc kích hoạt bảo hành điện tử.</li>
            <li><strong>Chính sách đổi mới:</strong> Đổi mới thiết bị 1:1 trong vòng 30 ngày nếu có lỗi kỹ thuật từ nhà sản xuất.</li>
            <li><strong>Hỗ trợ kỹ thuật:</strong> Đội ngũ kỹ sư Bách Anh Group hỗ trợ cài đặt thông số Inverter tận nơi hoặc từ xa qua UltraViewer/Zalo 24/7.</li>
          </ul>
        </div>
      </div>

    </div>
  </section>

  <!-- RELATED SOLAR PRODUCTS (4 COLUMNS GRID) -->
  <section class="py-16 bg-white border-t border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 space-y-10">
      <div class="flex items-center justify-between">
        <div>
          <span class="text-xs font-extrabold uppercase text-blue-600 bg-blue-50 px-3 py-1 rounded-full">Sản Phẩm Cùng Hệ Thống</span>
          <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-heading mt-2">
            Thiết Bị Solar Thường Đóng Kèm Với Inverter InfiniSolar 10KW
          </h2>
        </div>
        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition-all">
          <span>Xem Tất Cả</span> <i class="fas fa-arrow-right text-xs"></i>
        </a>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- PROD 1: TẤM PIN 550W -->
        <div class="bg-slate-50 rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
          <div class="relative bg-white p-4 flex items-center justify-center h-48 border-b border-slate-100">
            <img src="{{ asset('assets/') }}/images/solar_panel_550w.png" alt="Tấm Pin 550W" class="h-36 object-contain group-hover:scale-105 transition-transform duration-300">
          </div>
          <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
            <div>
              <span class="text-[10px] text-blue-600 font-bold uppercase">Tấm Pin Quang Điện</span>
              <h3 class="font-bold text-slate-900 text-sm mt-1 line-clamp-2">TẤM PIN NĂNG LƯỢNG MẶT TRỜI INFINISOLAR 550W</h3>
            </div>
            <a href="{{ route('products.show', 'infinisolar-10kw') }}" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs text-center transition-all shadow-md shadow-blue-600/20 block">
              <i class="fas fa-eye"></i> Xem Chi Tiết
            </a>
          </div>
        </div>

        <!-- PROD 2: PIN LITHIUM 48V -->
        <div class="bg-slate-50 rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
          <div class="relative bg-white p-4 flex items-center justify-center h-48 border-b border-slate-100">
            <img src="{{ asset('assets/') }}/images/lithium_battery_48v.png" alt="Pin Lithium 48V" class="h-36 object-contain group-hover:scale-105 transition-transform duration-300">
          </div>
          <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
            <div>
              <span class="text-[10px] text-blue-600 font-bold uppercase">Pin Lưu Trữ Lithium</span>
              <h3 class="font-bold text-slate-900 text-sm mt-1 line-clamp-2">BỘ LƯU TRỮ PIN LITHIUM INFINISOLAR 48V 200AH</h3>
            </div>
            <a href="{{ route('products.show', 'infinisolar-10kw') }}" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs text-center transition-all shadow-md shadow-blue-600/20 block">
              <i class="fas fa-eye"></i> Xem Chi Tiết
            </a>
          </div>
        </div>

        <!-- PROD 3: TỦ ĐIỆN CHỐNG SÉT -->
        <div class="bg-slate-50 rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
          <div class="relative bg-white p-4 flex items-center justify-center h-48 border-b border-slate-100">
            <img src="{{ asset('assets/') }}/images/solar_combiner_box.png" alt="Tủ Điện Solar" class="h-36 object-contain group-hover:scale-105 transition-transform duration-300">
          </div>
          <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
            <div>
              <span class="text-[10px] text-blue-600 font-bold uppercase">Tủ Điện & Chống Sét</span>
              <h3 class="font-bold text-slate-900 text-sm mt-1 line-clamp-2">TỦ ĐIỆN BẢO VỆ AC/DC CHỐNG SÉT LAN TRUYỀN</h3>
            </div>
            <a href="{{ route('products.show', 'infinisolar-10kw') }}" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs text-center transition-all shadow-md shadow-blue-600/20 block">
              <i class="fas fa-eye"></i> Xem Chi Tiết
            </a>
          </div>
        </div>

        <!-- PROD 4: CÁP DC SOLAR -->
        <div class="bg-slate-50 rounded-2xl overflow-hidden border border-slate-200/80 hover:border-blue-600 hover:shadow-xl transition-all hover-lift flex flex-col group">
          <div class="relative bg-white p-4 flex items-center justify-center h-48 border-b border-slate-100">
            <img src="{{ asset('assets/') }}/images/dc_solar_cable_mc4.png" alt="Cáp DC Solar" class="h-36 object-contain group-hover:scale-105 transition-transform duration-300">
          </div>
          <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
            <div>
              <span class="text-[10px] text-blue-600 font-bold uppercase">Vật Tư & Phụ Kiện</span>
              <h3 class="font-bold text-slate-900 text-sm mt-1 line-clamp-2">DÂY CÁP ĐIỆN DC SOLAR 4MM2 / 6MM2 CHỐNG UV</h3>
            </div>
            <a href="{{ route('products.show', 'infinisolar-10kw') }}" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl text-xs text-center transition-all shadow-md shadow-blue-600/20 block">
              <i class="fas fa-eye"></i> Xem Chi Tiết
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
