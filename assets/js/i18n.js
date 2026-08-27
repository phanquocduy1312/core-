/**
 * BÁCH ANH GROUP - Internationalization (i18n) Module
 * Universal Full-Page Translation Engine for All 14 HTML Pages
 * Two-Way Bidirectional Switching (VI ⇄ EN) with Full Mobile Support
 */

const translations = {
  vi: {
    company_name: "CÔNG TY CỔ PHẦN BÁCH ANH GROUP",
    company_short: "BÁCH ANH GROUP",
    slogan: "",
    phone: "0963 982 186",
    email: "bachanhgroup.jsc@gmail.com",
    address_short: "Thành Phố Hà Nội, Việt Nam",
    
    nav_home: "Trang chủ",
    nav_about: "Giới Thiệu",
    nav_products: "Sản Phẩm",
    nav_brands: "Thương Hiệu",
    nav_projects: "Dự Án",
    nav_news: "Tin Tức",
    nav_contact: "Liên Hệ",
    nav_support: "Hỗ Trợ Kỹ Thuật",
    nav_quote: "Yêu Cầu Báo Giá Solar",

    hero_badge: "Nhà Phân Phối Chuyên Nghiệp Thiết Bị & Vật Tư Điện Năng Lượng Mặt Trời",
    hero_title: `THIẾT BỊ & VẬT TƯ<br><span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-300 via-sky-200 to-white">ĐIỆN NĂNG LƯỢNG MẶT TRỜI</span>`,
    hero_desc: "Bách Anh Group chuyên kinh doanh, phân phối chính hãng các dòng thiết bị và vật tư điện năng lượng mặt trời: Bộ biến tần Inverter Hybrid InfiniSolar 10KW (IP66), Tấm pin mặt trời Mono Crystalline 550W, Pin lưu trữ Lithium LiFePO4 48V, Tủ điện bảo vệ AC/DC và phụ kiện lắp đặt trạm pin toàn quốc.",
    hero_cta_explore: "Khám Phá Thiết Bị Solar",
    hero_cta_contact: "Tư Vấn Công Suất Trạm",
    stat_years: "Năm Phân Phối Solar",
    stat_projects: "Dự Án Lắp Đặt",
    stat_clients: "Khách Hàng & Đội Thợ",
    stat_partners: "Hãng Solar Toàn Cầu",

    hero_flagship_tag: "Thiết Bị Solar Chủ Lực",
    hero_ip66_badge: `<i class="fas fa-shield-halved mr-1"></i> Chuẩn IP66`,
    hero_flagship_title: "INVERTER HYBRID INFINISOLAR (10KW - IP66)",
    hero_flagship_desc: "Bộ biến tần Hybrid năng lượng mặt trời công suất 10KW, chuẩn chống nước chống bụi IP66, hiệu suất 97.5%, hỗ trợ Pin Lithium 48V.",
    hero_spec_capacity: "Công suất:",
    hero_spec_battery: "Pin hỗ trợ:",
    hero_spec_protection: "Bảo vệ:",
    hero_spec_warranty: "Bảo hành:",
    hero_spec_warranty_val: "5 Năm Chính Hãng",
    hero_flagship_cta: "Xem Chi Tiết Thông Số Kỹ Thuật",

    footer_desc: "CÔNG TY CỔ PHẦN BÁCH ANH GROUP - Nhà phân phối hàng đầu về thiết bị & vật tư điện năng lượng mặt trời, bộ biến tần Inverter Hybrid InfiniSolar IP66, tấm pin mặt trời 550W và pin lưu trữ Lithium.",
    footer_quicklinks: "Liên Kết Nhanh",
    footer_services: "Danh Mục Thiết Bị Solar",
    footer_rights: "© 2026 BÁCH ANH GROUP. Bảo lưu mọi quyền. Phát triển bởi MatBao WS."
  },

  en: {
    company_name: "BACH ANH GROUP JOINT STOCK COMPANY",
    company_short: "BACH ANH GROUP",
    slogan: "",
    phone: "0963 982 186",
    email: "bachanhgroup.jsc@gmail.com",
    address_short: "Hanoi City, Vietnam",

    nav_home: "Home",
    nav_about: "About Us",
    nav_products: "Products",
    nav_brands: "Brands",
    nav_projects: "Projects",
    nav_news: "News",
    nav_contact: "Contact",
    nav_support: "Technical Support",
    nav_quote: "Request Solar Quote",

    hero_badge: "Professional Distributor of Solar Energy Equipment & Supplies",
    hero_title: `SOLAR ENERGY<br><span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-300 via-sky-200 to-white">EQUIPMENT & SUPPLIES</span>`,
    hero_desc: "Bach Anh Group specializes in distributing authentic solar energy equipment: InfiniSolar 10KW Hybrid Inverters (IP66), Mono Crystalline 550W Solar Panels, 48V Lithium LiFePO4 Storage Batteries, AC/DC Protection Cabinets, and installation hardware nationwide.",
    hero_cta_explore: "Explore Solar Equipment",
    hero_cta_contact: "Get Station Advisory",
    stat_years: "Years Distributing Solar",
    stat_projects: "Solar Stations Installed",
    stat_clients: "Clients & Contractors",
    stat_partners: "Global Solar Brands",

    hero_flagship_tag: "Flagship Solar Equipment",
    hero_ip66_badge: `<i class="fas fa-shield-halved mr-1"></i> IP66 Standard`,
    hero_flagship_title: "INFINISOLAR HYBRID INVERTER (10KW - IP66)",
    hero_flagship_desc: "10KW Hybrid Solar Inverter with IP66 waterproof/dustproof rating, 97.5% efficiency, supports 48V Lithium battery.",
    hero_spec_capacity: "Capacity:",
    hero_spec_battery: "Battery:",
    hero_spec_protection: "Protection:",
    hero_spec_warranty: "Warranty:",
    hero_spec_warranty_val: "5-Year Official Warranty",
    hero_flagship_cta: "View Detailed Technical Specs",

    footer_desc: "BACH ANH GROUP JSC - Leading distributor of solar energy equipment, InfiniSolar Hybrid Inverters IP66, 550W solar panels, and Lithium energy storage systems.",
    footer_quicklinks: "Quick Links",
    footer_services: "Solar Equipment Catalog",
    footer_rights: "© 2026 BACH ANH GROUP. All rights reserved. Developed by MatBao WS."
  }
};

/**
 * Master Text Node Mapping for All Website Sections (VI -> EN)
 */
const textNodeMapEn = {
  "Trang chủ": "Home",
  "Giới Thiệu": "About Us",
  "Sản Phẩm": "Products",
  "Thương Hiệu": "Brands",
  "Danh Mục Thiết Bị": "Categories",
  "Dự Án": "Projects",
  "Tin Tức": "News",
  "Liên Hệ": "Contact",
  "Hỗ Trợ Kỹ Thuật": "Technical Support",
  "Yêu Cầu Báo Giá": "Request Quote",
  "Yêu Cầu Báo Giá Solar": "Request Solar Quote",
  "Khám Phá Thiết Bị Solar": "Explore Solar Equipment",
  "Tư Vấn Công Suất Trạm": "Get Station Advisory",
  "Xem Tất Cả 130 Sản Phẩm": "View All 130 Products",
  "Chọn Thương Hiệu Cần Lọc Sản Phẩm": "Select Brand to Filter Products",
  "Nhấp vào một thương hiệu bất kỳ để lọc ngay danh sách thiết bị bên dưới": "Click on any brand logo below to filter equipment",
  "Đang Hiển Thị Sản Phẩm Phân Loại": "Displaying Filtered Products",
  "Thương Hiệu:": "Brand:",
  "TẤT CẢ THƯƠNG HIỆU": "ALL BRANDS",
  "Mặc định": "Default",
  "Tên A-Z": "Name A-Z",
  "Tên Z-A": "Name Z-A",
  "Sắp xếp:": "Sort by:",
  "Trang Trước": "Previous Page",
  "Trang Sau": "Next Page",
  "Xem Chi Tiết": "View Details",
  "Xem Chi Tiết Trạm Pin": "View Station Details",
  "Xem Chi Tiết Thông Số Kỹ Thuật": "View Detailed Technical Specs",
  "Đọc Thêm Bài Viết": "Read Full Article",
  "Đọc tiếp bài viết": "Read Full Article",
  "Gửi Yêu Cầu Báo Giá": "Send Quote Request",
  "Gửi Yêu Cầu Kỹ Thuật Ngay": "Submit Technical Request Now",
  "Xem Tất Cả": "View All",

  "Hãng Sản Xuất Solar Toàn Cầu": "Global Solar Manufacturers",
  "Thương Hiệu Thiết Bị Điện Mặt Trời Nổi Bật Phân Phối Chính Hãng": "Featured Authentic Distributed Solar Brands",
  "Mọi thiết bị biến tần, tấm pin mặt trời và phụ kiện vật tư đều được Bách Anh Group nhập khẩu chính ngạch đầy đủ giấy tờ CO/CQ.": "All inverters, solar panels, and hardware accessories are officially imported by Bach Anh Group with verified CO/CQ certificates.",
  "Biến Tần Inverter": "Inverters",
  "Bộ Biến Tần Inverter Hybrid & Hòa Lưới Điện Mặt Trời": "Hybrid & Grid-Tied Solar Inverters",
  "Xem Tất Cả Inverter": "View All Inverters",
  "Pin Solar & Lưu Trữ": "Solar Panels & Energy Storage",
  "Tấm Pin Quang Điện 550W+ & Pin Lưu Trữ Lithium LiFePO4": "550W+ Solar Panels & Lithium LiFePO4 Battery Storage",
  "Xem Tấm Pin & Pin Lưu Trữ": "View Solar Panels & Energy Storage",
  "Vật Tư & Phụ Kiện": "Supplies & Accessories",
  "Vật Tư Lắp Đặt & Tủ Điện Bảo Vệ Chống Sét Solar": "Solar Installation Hardware & Surge Protection Cabinets",
  "Xem Tất Cả Vật Tư": "View All Supplies",
  "Giải Pháp Theo Quy Mô": "Solutions By Scale",
  "Giải Pháp Điện Mặt Trời Cho Mọi Nhu Cầu": "Solar Energy Solutions For All Needs",
  "Từ biệt thự gia đình đến nhà xưởng sản xuất quy mô lớn, Bách Anh Group đều có giải pháp biến tần InfiniSolar phù hợp nhất.": "From residential villas to large-scale industrial factories, Bach Anh Group provides the most suitable InfiniSolar inverter solution.",
  "Hộ Gia Đình & Biệt Thự": "Residential & Villas",
  "Hệ thống điện mặt trời Hybrid 5KW - 10KW dùng biến tần InfiniSolar IP66, lưu trữ pin Lithium giúp chủ động nguồn điện 24/7.": "5KW - 10KW Hybrid solar system using InfiniSolar IP66 inverter and Lithium storage for 24/7 power independence.",
  "Tư Vấn Gói Gia Đình": "Get Residential Advisory",
  "Nhà Xưởng & Thương Mại": "Industrial & Commercial",
  "Hệ thống trạm điện mặt trời mái nhà xưởng 50KW - 500KW giảm đến 40% chi phí tiền điện hàng tháng cho doanh nghiệp.": "50KW - 500KW rooftop solar station system saving up to 40% monthly electricity cost for enterprises.",
  "Tư Vấn Báo Giá Nhà Xưởng": "Get Commercial Quote",
  "Khu Công Nghiệp & Trang Trại": "Industrial Parks & Farms",
  "Giải pháp hòa lưới & lưu trữ công suất lớn >1MW tích hợp hệ thống quản lý điện năng thông minh EMS.": "Large-scale grid-tied & storage solution >1MW with integrated EMS smart energy management.",
  "Tư Vấn Dự Án Lớn": "Get Utility Advisory",
  "Tin Tức & Kỹ Thuật Solar": "Solar News & Technology",
  "Kinh Nghiệm Kỹ Thuật Điện Năng Lượng Mặt Trời": "Solar Energy Engineering Experience",
  "Xem Tất Cả Bài Viết": "View All Articles",
  "Cam Kết Từ Bách Anh Group": "Bach Anh Group Commitments",
  "Tại Sao Khách Hàng Chọn Bách Anh Group Làm Nhà Phân Phối Thiết Bị Solar?": "Why Clients Choose Bach Anh Group As Solar Equipment Distributor?",
  "100% CO/CQ Chính Hãng": "100% Authentic CO/CQ",
  "Phân phối biến tần Inverter Hybrid InfiniSolar, tấm pin 550W & pin Lithium có đầy đủ giấy chứng nhận xuất xứ CO/CQ.": "Distributing InfiniSolar Hybrid inverters, 550W panels & Lithium batteries with full CO/CQ certificates.",
  "Bảo Hành 5-25 Năm": "5-25 Years Warranty",
  "Bảo hành 5 năm chính hãng cho Inverter Hybrid InfiniSolar IP66 và 25 năm hiệu suất quang điện cho tấm pin 550W.": "5-year warranty for InfiniSolar IP66 Hybrid inverters and 25-year photovoltaic performance for 550W panels.",
  "Hỗ Trợ Kỹ Thuật 24/7": "24/7 Technical Support",
  "Đội ngũ kỹ sư giàu kinh nghiệm sẵn sàng khảo sát, tính toán công suất trạm pin và hỗ trợ kỹ thuật 24/7 toàn quốc.": "Experienced engineers ready to survey, size station capacity & provide 24/7 technical support nationwide.",
  "Sẵn Kho Giao Siêu Tốc": "Express Warehouse Delivery",
  "Hệ thống kho bãi sẵn có tại Hà Nội, sẵn sàng giao biến tần, tấm pin và vật tư cáp DC Solar tận nơi cho thợ & đối tác.": "Warehouse inventory in Hanoi ready for express delivery of inverters, panels & DC cable hardware.",
  "Nhận Báo Giá Nhanh": "Get Fast Quote",
  "Yêu Cầu Tư Vấn & Báo Giá Thiết Bị Solar Trực Tiếp": "Request Direct Solar Equipment Consultation & Quote",
  "Điền thông tin bên dưới, chuyên viên Bách Anh Group sẽ liên hệ gửi catalog thông số kỹ thuật và bảng báo giá phân phối vật tư điện mặt trời tốt nhất trong vòng": "Fill in your information below, Bach Anh Group specialists will send the catalog & best solar quote within",
  "Đăng Ký Nhận Báo Giá Ưu Đãi Solar": "Register for Discounted Solar Quote",
  "Họ và Tên (*)": "Full Name (*)",
  "Số Điện Thoại / Zalo (*)": "Phone / Zalo Number (*)",
  "Sản Phẩm Solar Quan Tâm": "Solar Equipment Of Interest",
  "Biến Tần Inverter Hybrid InfiniSolar / Sungrow / Huawei": "InfiniSolar / Sungrow / Huawei Hybrid Inverter",
  "Tấm Pin Mặt Trời Mono Crystalline 550W+": "Mono Crystalline 550W+ Solar Panels",
  "Pin Lưu Trữ Lithium LiFePO4 48V / High-Voltage": "48V Lithium LiFePO4 / High-Voltage Battery",
  "Vật Tư Cáp DC Solar, Tủ Điện AC/DC & Khung Rail Nhôm": "Solar DC Cables, AC/DC Cabinets & Aluminum Rail Mounting",
  "Gửi Yêu Cầu Báo Giá Solar Ngay": "Submit Solar Quote Request Now",

  "BÁN CHẠY": "BEST SELLER",
  "MỚI 2026": "NEW 2026",
  "DÂY CÁP DC": "SOLAR DC CABLES",
  "STAUBLI MC4": "STAUBLI MC4",
  "TỦ ĐIỆN SOLAR": "SOLAR COMBINER BOX",
  "PHỤ KIỆN KHUNG": "MOUNTING HARDWARE",

  "TẤM PIN NĂNG LƯỢNG MẶT TRỜI INFINISOLAR 550W": "INFINISOLAR 550W SOLAR PANEL",
  "Pin Mono Crystalline Half-Cell hiệu suất >21.8%, độ bền 25 năm.": "Mono Crystalline Half-Cell panel with >21.8% efficiency, 25-year warranty.",
  "BỘ LƯU TRỮ PIN LITHIUM INFINISOLAR 48V 200AH": "INFINISOLAR 48V 200AH LITHIUM BATTERY",
  "Pin Lithium LiFePO4 48V 200Ah độ bền 6,000 chu kỳ sạc xả.": "Lithium LiFePO4 48V 200Ah battery with 6,000 charge cycles.",
  "DÂY CÁP ĐIỆN DC SOLAR 4MM2 / 6MM2 CHỐNG TIA UV": "UV-RESISTANT 4MM2 / 6MM2 SOLAR DC CABLE",
  "Cáp điện DC chuyên dụng chịu nhiệt độ cao ngoài trời.": "Heavy-duty outdoor heat-resistant solar DC cable.",
  "BỘ ĐẦU NỐI CẶP MC4 STAUBLI CHỐNG NƯỚC IP68": "STAUBLI IP68 WATERPROOF MC4 CONNECTOR PAIR",
  "Đầu nối MC4 Thụy Sĩ dẫn điện tối ưu chống rò rỉ điện.": "Swiss MC4 connectors with optimal conductivity and anti-leakage protection.",
  "TỦ ĐIỆN BẢO VỆ AC/DC CHỐNG SÉT LAN TRUYỀN": "AC/DC SURGE PROTECTION COMBINER BOX",
  "Tủ điện lắp sẵn Aptomat DC/AC & chống sét lan truyền SPD.": "Pre-wired cabinet with DC/AC breakers & SPD surge protectors.",

  "BIẾN TẦN HÒA LƯỚI SUNGROW 50KW (ON-GRID)": "SUNGROW 50KW ON-GRID INVERTER",
  "Biến tần 3 pha 50KW cho trạm điện mặt trời mái nhà xưởng.": "3-Phase 50KW inverter for commercial rooftop solar power stations.",
  "BIẾN TẦN THÔNG MINH HUAWEI FUSIONSOLAR 100KW": "HUAWEI FUSIONSOLAR 100KW SMART INVERTER",
  "Inverter 100KW tích hợp công nghệ AI chẩn đoán lỗi chuỗi PV.": "100KW Inverter with AI smart PV string diagnostics.",
  "BIẾN TẦN ĐỘC LẬP INFINISOLAR (5KW - OFF-GRID)": "INFINISOLAR 5KW OFF-GRID INVERTER",
  "Bộ biến tần độc lập không phụ thuộc lưới điện cho vùng xa.": "Standalone off-grid inverter independent from grid power for remote areas.",
  "TẤM PIN QUANG ĐIỆN LONGI SOLAR 550W (HI-MO 5)": "LONGI SOLAR 550W PHOTOVOLTAIC PANEL (HI-MO 5)",
  "Pin mặt trời LONGi thương hiệu Top 1 thế giới bảo hành 25 năm.": "LONGi solar panel Top 1 global brand with 25-year warranty.",
  "TỦ PIN LƯU TRỮ LITHIUM CAO ÁP 51.2V RACK 500AH": "HIGH-VOLTAGE 51.2V 500AH LITHIUM BATTERY RACK",
  "Hệ thống pin lưu trữ cao áp tích hợp mạch BMS thông minh.": "High-voltage battery storage system with smart BMS circuit.",
  "THANH RAIL NHÔM ĐỊNH HÌNH & KẸP BIÊN / KẸP GIỮA": "ANODIZED ALUMINUM MOUNTING RAIL & CLAMPS",
  "Hệ thống khung giá đỡ nhôm Anodized chịu gió bão.": "Anodized aluminum mounting system designed for storm resistance.",

  "1. Tấm Pin Mặt Trời": "1. Solar Panels",
  "2. Inverter Điện Mặt Trời": "2. Solar Inverters",
  "3. Pin Lưu Trữ Lithium": "3. Lithium Battery Storage",
  "4. Biến Tần Bơm Solar": "4. Solar Pump Inverters",
  "5. Phụ Kiện Solar & Cáp DC": "5. Solar Accessories & DC Cables",
  "Danh Mục Sản Phẩm": "Product Categories",
  "Liên Kết Nhanh": "Quick Links",
  "Giới Thiệu Công Ty": "Company Overview",
  "Dự Án Tiêu Biểu": "Featured Projects",
  "Tin Tức & Kỹ Thuật": "News & Technology",
  "Liên Hệ & Báo Giá": "Contact & Pricing",
  "Đối Tác Ủy Quyền": "Authorized Partners",
  "Đại diện:": "Representative:",
  "Hotline/Zalo:": "Hotline/Zalo:",
  "Email:": "Email:",
  "Địa chỉ:": "Address:",
  "TP. Hà Nội & Kho Hàng Toàn Quốc": "Hanoi City & Nationwide Warehouses",
  "Nhà phân phối ủy quyền thiết bị & vật tư điện năng lượng mặt trời chính hãng tại Việt Nam. Chuyên cung cấp Inverter Hybrid, Tấm Pin Quang Điện 550W+, Pin Lưu Trữ Lithium LiFePO4, Biến Tần Bơm & Vật Tư Lắp Đặt.": "Authorized distributor of authentic solar energy equipment & supplies in Vietnam. Specializing in Hybrid Inverters, 550W+ Solar Panels, Lithium LiFePO4 Batteries, Pump Inverters & Installation Hardware.",
  "© 2026 BÁCH ANH GROUP. Phân phối chính hãng Thiết Bị & Vật Tư Điện Năng Lượng Mặt Trời toàn quốc.": "© 2026 BACH ANH GROUP. Authorized distributor of Solar Energy Equipment & Supplies nationwide."
};

// AUTOMATICALLY BUILD REVERSE MAPPING FOR VIETNAMESE (EN -> VI)
const textNodeMapVi = {};
Object.keys(textNodeMapEn).forEach(viKey => {
  const enVal = textNodeMapEn[viKey];
  if (enVal) {
    textNodeMapVi[enVal] = viKey;
  }
});

const textNodeMap = {
  en: textNodeMapEn,
  vi: textNodeMapVi
};

/**
 * Utility function to translate any text string
 */
function translateText(str, lang) {
  if (!str) return str;
  const trimmed = str.replace(/\s+/g, ' ').trim();
  const map = textNodeMap[lang];
  if (map && map[trimmed]) {
    return map[trimmed];
  }
  return str;
}

window.translateText = translateText;

/**
 * Switch Language Function (vi <-> en)
 */
function toggleLanguage() {
  const currentLang = localStorage.getItem('app_lang') || 'vi';
  const newLang = currentLang === 'vi' ? 'en' : 'vi';
  setLanguage(newLang);
}

/**
 * Set Specific Language
 */
function setLanguage(lang) {
  if (!translations[lang]) return;
  localStorage.setItem('app_lang', lang);
  
  // Update desktop language button text (NO GB TEXT / NO FLAG ICON)
  const flagEl = document.getElementById('current-lang-flag');
  const codeEl = document.getElementById('current-lang-code');
  if (flagEl) flagEl.textContent = '';
  if (codeEl) codeEl.textContent = lang === 'vi' ? 'VI' : 'EN';

  // Update mobile language indicators
  document.querySelectorAll('.mobile-lang-code').forEach(el => {
    el.textContent = lang === 'vi' ? 'VI' : 'EN';
  });

  // Update elements with data-i18n attribute
  document.querySelectorAll('[data-i18n]').forEach(el => {
    const key = el.getAttribute('data-i18n');
    if (translations[lang][key]) {
      if (translations[lang][key].includes('<')) {
        el.innerHTML = translations[lang][key];
      } else {
        el.textContent = translations[lang][key];
      }
    }
  });

  // Deep text replacement with normalized whitespace for ALL text nodes
  const map = textNodeMap[lang];
  if (map) {
    const normalizedMap = {};
    Object.keys(map).forEach(k => {
      normalizedMap[k.replace(/\s+/g, ' ').trim()] = map[k];
    });

    const replaceInNode = (element) => {
      element.childNodes.forEach(child => {
        if (child.nodeType === Node.TEXT_NODE) {
          const raw = child.nodeValue;
          const norm = raw.replace(/\s+/g, ' ').trim();
          if (normalizedMap[norm]) {
            child.nodeValue = raw.replace(raw.trim(), normalizedMap[norm]);
          }
        } else if (child.nodeType === Node.ELEMENT_NODE && !['SCRIPT', 'STYLE'].includes(child.tagName)) {
          replaceInNode(child);
        }
      });
    };
    replaceInNode(document.body);
  }

  // Dispatch custom DOM event
  window.dispatchEvent(new CustomEvent('languageChanged', { detail: { lang } }));
}

// Auto Initialize on DOM load
document.addEventListener('DOMContentLoaded', () => {
  const savedLang = localStorage.getItem('app_lang') || 'vi';
  setLanguage(savedLang);
});
