<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'BÁCH ANH GROUP - Nhà Phân Phối Thiết Bị & Vật Tư Điện Năng Lượng Mặt Trời')</title>
  <meta name="description" content="@yield('meta_description', 'CÔNG TY CỔ PHẦN BÁCH ANH GROUP - Đơn vị chuyên cung cấp, phân phối sỉ & lẻ thiết bị và vật tư điện năng lượng mặt trời chính hãng: Inverter Hybrid InfiniSolar 10KW IP66, Tấm pin mặt trời 550W, Pin lưu trữ Lithium 48V, Cáp DC Solar và Phụ kiện lắp đặt.')">
  
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: {
              50: '#eff6ff',
              100: '#dbeafe',
              500: '#3b82f6',
              600: '#0052cc',
              700: '#1d4ed8',
              800: '#1e40af',
              900: '#0a2540',
            }
          }
        }
      }
    }
  </script>

  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  
  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  @stack('styles')
</head>
<body class="bg-slate-50 text-slate-800 flex flex-col min-h-screen">

  @include('partials.header')

  <main class="flex-grow">
    @yield('content')
  </main>

  @include('partials.footer')

  <script src="{{ asset('assets/js/i18n.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  @stack('scripts')
</body>
</html>
