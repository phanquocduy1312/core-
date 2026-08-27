<!-- UNIFIED FOOTER -->
<footer class="bg-slate-950 text-slate-400 border-t border-slate-900 mt-auto pt-16 pb-8">
  <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-900">
    
    <!-- COL 1 & 2: COMPANY INFO & LOGOS -->
    <div class="lg:col-span-2 space-y-4">
      <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
        <img src="{{ asset('assets/images/logo.jpg') }}" alt="BÁCH ANH GROUP Logo" class="h-20 sm:h-24 w-auto object-contain rounded-2xl bg-white p-2.5 shadow-xl border border-slate-100">
      </a>
      <p class="text-xs text-slate-400 leading-relaxed pr-4">
        Nhà phân phối ủy quyền thiết bị & vật tư điện năng lượng mặt trời chính hãng tại Việt Nam. Chuyên cung cấp Inverter Hybrid, Tấm Pin Quang Điện 550W+, Pin Lưu Trữ Lithium LiFePO4, Biến Tần Bơm & Vật Tư Lắp Đặt.
      </p>
      <div class="pt-2 space-y-2 text-xs">
        <div class="flex items-center gap-2.5 text-slate-300">
          <i class="fas fa-user-tie text-blue-500 w-4 text-center"></i>
          <span>Đại diện: <strong class="text-white">Mr. Lưu Thế Dũng</strong></span>
        </div>
        <div class="flex items-center gap-2.5 text-slate-300">
          <i class="fas fa-phone-alt text-emerald-400 w-4 text-center"></i>
          <span>Hotline/Zalo: <a href="tel:0963982186" class="text-blue-400 font-bold hover:underline">0963 982 186</a> (24/7)</span>
        </div>
        <div class="flex items-center gap-2.5 text-slate-300">
          <i class="fas fa-envelope text-blue-500 w-4 text-center"></i>
          <span>Email: <a href="mailto:bachanhgroup.jsc@gmail.com" class="text-slate-300 hover:text-white">bachanhgroup.jsc@gmail.com</a></span>
        </div>
        <div class="flex items-center gap-2.5 text-slate-300">
          <i class="fas fa-map-marker-alt text-blue-500 w-4 text-center"></i>
          <span>Địa chỉ: TP. Hà Nội & Kho Hàng Toàn Quốc</span>
        </div>
      </div>
    </div>

    <!-- COL 3: 5 TRANG CON SẢN PHẨM -->
    <div class="space-y-3">
      <h4 class="text-sm font-extrabold text-white uppercase tracking-wider font-heading">Danh Mục Sản Phẩm</h4>
      <ul class="space-y-2 text-xs">
        <li><a href="{{ route('products.solar-panel') }}" class="hover:text-blue-400 transition-colors flex items-center gap-1.5"><i class="fas fa-chevron-right text-[8px] text-blue-500"></i> 1. Tấm Pin Mặt Trời</a></li>
        <li><a href="{{ route('products.inverter') }}" class="hover:text-blue-400 transition-colors flex items-center gap-1.5"><i class="fas fa-chevron-right text-[8px] text-blue-500"></i> 2. Inverter Điện Mặt Trời</a></li>
        <li><a href="{{ route('products.battery') }}" class="hover:text-blue-400 transition-colors flex items-center gap-1.5"><i class="fas fa-chevron-right text-[8px] text-blue-500"></i> 3. Pin Lưu Trữ Lithium</a></li>
        <li><a href="{{ route('products.pump') }}" class="hover:text-blue-400 transition-colors flex items-center gap-1.5"><i class="fas fa-chevron-right text-[8px] text-blue-500"></i> 4. Biến Tần Bơm Solar</a></li>
        <li><a href="{{ route('products.accessories') }}" class="hover:text-blue-400 transition-colors flex items-center gap-1.5"><i class="fas fa-chevron-right text-[8px] text-blue-500"></i> 5. Phụ Kiện Solar & Cáp DC</a></li>
      </ul>
    </div>

    <!-- COL 4: LIÊN KẾT NHANH -->
    <div class="space-y-3">
      <h4 class="text-sm font-extrabold text-white uppercase tracking-wider font-heading">Liên Kết Nhanh</h4>
      <ul class="space-y-2 text-xs">
        <li><a href="{{ route('home') }}" class="hover:text-blue-400 transition-colors flex items-center gap-1.5"><i class="fas fa-chevron-right text-[8px] text-blue-500"></i> Trang Chủ</a></li>
        <li><a href="{{ route('about') }}" class="hover:text-blue-400 transition-colors flex items-center gap-1.5"><i class="fas fa-chevron-right text-[8px] text-blue-500"></i> Giới Thiệu Công Ty</a></li>
        <li><a href="{{ route('projects') }}" class="hover:text-blue-400 transition-colors flex items-center gap-1.5"><i class="fas fa-chevron-right text-[8px] text-blue-500"></i> Dự Án Tiêu Biểu</a></li>
        <li><a href="{{ route('news') }}" class="hover:text-blue-400 transition-colors flex items-center gap-1.5"><i class="fas fa-chevron-right text-[8px] text-blue-500"></i> Tin Tức & Kỹ Thuật</a></li>
        <li><a href="{{ route('lien-he') }}" class="hover:text-blue-400 transition-colors flex items-center gap-1.5"><i class="fas fa-chevron-right text-[8px] text-blue-500"></i> Liên Hệ & Báo Giá</a></li>
        <li><a href="{{ route('technical-support') }}" class="hover:text-blue-400 transition-colors flex items-center gap-1.5"><i class="fas fa-chevron-right text-[8px] text-blue-500"></i> Hỗ Trợ Kỹ Thuật 24/7</a></li>
      </ul>
    </div>

    <!-- COL 5: THƯƠNG HIỆU HỢP TÁC -->
    <div class="space-y-3">
      <h4 class="text-sm font-extrabold text-white uppercase tracking-wider font-heading">Đối Tác Ủy Quyền</h4>
      <div class="grid grid-cols-3 gap-1.5">
        <div class="bg-white/10 p-1.5 rounded-lg border border-white/5 flex items-center justify-center h-8"><img src="{{ asset('assets/images/logos/luxpower_logo.png') }}" alt="Luxpower" class="h-4 object-contain"></div>
        <div class="bg-white/10 p-1.5 rounded-lg border border-white/5 flex items-center justify-center h-8"><img src="{{ asset('assets/images/logos/deye_logo.png') }}" alt="Deye" class="h-4 object-contain"></div>
        <div class="bg-white/10 p-1.5 rounded-lg border border-white/5 flex items-center justify-center h-8"><img src="{{ asset('assets/images/logos/solis_logo.webp') }}" alt="Solis" class="h-4 object-contain"></div>
        <div class="bg-white/10 p-1.5 rounded-lg border border-white/5 flex items-center justify-center h-8"><img src="{{ asset('assets/images/logos/goodwe_logo.png') }}" alt="GoodWe" class="h-4 object-contain"></div>
        <div class="bg-white/10 p-1.5 rounded-lg border border-white/5 flex items-center justify-center h-8"><img src="{{ asset('assets/images/logos/longi_logo.png') }}" alt="LONGi" class="h-4 object-contain"></div>
        <div class="bg-white/10 p-1.5 rounded-lg border border-white/5 flex items-center justify-center h-8"><img src="{{ asset('assets/images/logos/vsun_logo.png') }}" alt="VSUN" class="h-4 object-contain"></div>
        <div class="bg-white/10 p-1.5 rounded-lg border border-white/5 flex items-center justify-center h-8"><img src="{{ asset('assets/images/logos/aesolar_logo.png') }}" alt="AE Solar" class="h-4 object-contain"></div>
        <div class="bg-white/10 p-1.5 rounded-lg border border-white/5 flex items-center justify-center h-8"><img src="{{ asset('assets/images/logos/worldenergy_logo.png') }}" alt="World Energy" class="h-4 object-contain"></div>
        <div class="bg-white/10 p-1.5 rounded-lg border border-white/5 flex items-center justify-center h-8"><img src="{{ asset('assets/images/logos/jinko_logo.webp') }}" alt="Jinko" class="h-4 object-contain"></div>
      </div>
    </div>

  </div>

  <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
    <div>
      © 2026 BÁCH ANH GROUP. Phân phối chính hãng Thiết Bị & Vật Tư Điện Năng Lượng Mặt Trời toàn quốc.
    </div>
    <div class="flex items-center gap-4 text-slate-400">
      <span>Đại diện: Mr. Lưu Thế Dũng</span>
      <span>•</span>
      <a href="tel:0963982186" class="text-blue-400 hover:underline">Hotline: 0963 982 186</a>
    </div>
  </div>
</footer>
