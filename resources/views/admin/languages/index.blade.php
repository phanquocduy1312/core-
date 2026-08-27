@extends('admin.layouts.app')

@section('title', 'Ngôn ngữ nội dung')

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4">
            <h4 class="text-xl font-bold mb-1">Ngôn ngữ nội dung</h4>
            <p class="text-xs text-slate-350">Quản lý locale dùng cho URL, nội dung và dữ liệu trả về API.</p>
        </div>
    </div>

    <x-admin.alert variant="info" class="mb-6">
        Thêm ngôn ngữ tại đây không cần thêm cột database. Tên, mô tả và nội dung được lưu theo mã locale trong JSON; slug được lưu riêng theo locale.
    </x-admin.alert>

    <!-- Preferences Settings -->
    <x-admin.card class="mb-6">
        <h5 class="text-base font-bold text-gray-900 mb-1">Ưu tiên nội dung</h5>
        <p class="text-xs text-gray-500 mb-4">Ngôn ngữ mặc định dùng để nhập nội dung chính. Fallback chỉ được dùng khi bản dịch đang xem bị trống và không làm thay đổi URL quản trị.</p>
        <form method="POST" action="{{ route('admin.languages.preferences') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            @csrf
            @method('PUT')
            <div class="md:col-span-5">
                <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="default_locale">Ngôn ngữ mặc định</label>
                <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" id="default_locale" name="default_locale" required>
                    @foreach($languages->where('is_active', true) as $language)
                        <option value="{{ $language->code }}" @selected(old('default_locale', $languages->firstWhere('is_default', true)?->code) === $language->code)>
                            {{ $language->native_name }} ({{ strtoupper($language->code) }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-5">
                <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="fallback_locale">Fallback nội dung</label>
                <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" id="fallback_locale" name="fallback_locale" required>
                    @foreach($languages->where('is_active', true) as $language)
                        <option value="{{ $language->code }}" @selected(old('fallback_locale', $languages->firstWhere('is_content_fallback', true)?->code) === $language->code)>
                            {{ $language->native_name }} ({{ strtoupper($language->code) }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <button type="submit" class="w-full inline-flex items-center justify-center font-semibold rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 text-white bg-primary hover:bg-primary-hover active:bg-primary-active focus:ring-primary px-4 py-2.5 text-sm">
                    Lưu ưu tiên
                </button>
            </div>
        </form>
    </x-admin.card>

    <!-- Add Language Form -->
    <x-admin.card class="mb-6">
        <h5 class="text-base font-bold text-gray-900 mb-4">Thêm ngôn ngữ</h5>
        <form method="POST" action="{{ route('admin.languages.store') }}" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-12 gap-4 items-end">
            @csrf
            <div class="md:col-span-2">
                <label class="block mb-1.5 text-xs font-semibold text-gray-700">Mã locale</label>
                <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" name="code" placeholder="zh" maxlength="16" required>
            </div>
            <div class="md:col-span-2">
                <label class="block mb-1.5 text-xs font-semibold text-gray-700">Tên tiếng Anh</label>
                <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" name="name" placeholder="Chinese" required>
            </div>
            <div class="md:col-span-2">
                <label class="block mb-1.5 text-xs font-semibold text-gray-700">Tên bản địa</label>
                <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" name="native_name" placeholder="中文" required>
            </div>
            <div class="md:col-span-2">
                <label class="block mb-1.5 text-xs font-semibold text-gray-700">Regional</label>
                <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" name="regional" placeholder="zh_CN">
            </div>
            <div class="md:col-span-1">
                <label class="block mb-1.5 text-xs font-semibold text-gray-700">Thứ tự</label>
                <input type="number" min="0" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" name="sort_order" value="20">
            </div>
            <div class="md:col-span-1 flex items-center justify-center pb-3">
                <input type="checkbox" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" name="is_active" value="1" checked id="new_language_active">
                <label class="ml-2 text-xs font-semibold text-gray-800 cursor-pointer" for="new_language_active">Bật</label>
            </div>
            <div class="md:col-span-2">
                <button type="submit" class="w-full inline-flex items-center justify-center font-semibold rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 text-white bg-primary hover:bg-primary-hover active:bg-primary-active focus:ring-primary px-4 py-2.5 text-sm">
                    Thêm ngôn ngữ
                </button>
            </div>
        </form>
    </x-admin.card>

    <!-- Existing Languages List -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col justify-between mb-8">
        <div>
            <div class="px-6 py-4 border-b border-gray-200">
                <h5 class="text-base font-bold text-gray-900">Ngôn ngữ hiện có</h5>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-bold">Mã</th>
                            <th class="px-6 py-3 font-bold">Tên</th>
                            <th class="px-6 py-3 font-bold">Regional / Cờ</th>
                            <th class="px-6 py-3 font-bold text-center">Thứ tự</th>
                            <th class="px-6 py-3 font-bold text-center">Bật</th>
                            <th class="px-6 py-3 font-bold text-center">Mặc định</th>
                            <th class="px-6 py-3 font-bold text-center">Fallback nội dung</th>
                            <th class="px-6 py-3 text-right"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-150">
                        @foreach($languages as $language)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td colspan="8" class="p-0">
                                    <form method="POST" action="{{ route('admin.languages.update', $language) }}" class="grid grid-cols-1 md:grid-cols-12 gap-3 items-center py-3.5 px-6 mx-0">
                                        @csrf 
                                        @method('PUT')
                                        <div class="md:col-span-1">
                                            <input class="block w-full p-2 text-xs text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" name="code" value="{{ $language->code }}" required>
                                        </div>
                                        <div class="md:col-span-2 space-y-1.5">
                                            <input class="block w-full p-2 text-xs text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" name="name" value="{{ $language->name }}" placeholder="English Name" required>
                                            <input class="block w-full p-2 text-xs text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" name="native_name" value="{{ $language->native_name }}" placeholder="Native Name" required>
                                        </div>
                                        <div class="md:col-span-2 space-y-1.5">
                                            <input class="block w-full p-2 text-xs text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" name="regional" value="{{ $language->regional }}" placeholder="Regional (e.g. en_US)">
                                            <input class="block w-full p-2 text-xs text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" name="flag_path" value="{{ $language->flag_path }}" placeholder="Đường dẫn cờ">
                                        </div>
                                        <div class="md:col-span-1 text-center">
                                            <input type="number" min="0" class="block w-full p-2 text-xs text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none text-center" name="sort_order" value="{{ $language->sort_order }}">
                                        </div>
                                        <div class="md:col-span-1 text-center">
                                            <input type="checkbox" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer mx-auto" name="is_active" value="1" @checked($language->is_active)>
                                        </div>
                                        <div class="md:col-span-1 text-center">
                                            @if($language->is_default)
                                                <x-admin.badge variant="success">Mặc định</x-admin.badge>
                                            @else
                                                <span class="text-xs text-gray-400">—</span>
                                            @endif
                                        </div>
                                        <div class="md:col-span-2 text-center">
                                            @if($language->is_content_fallback)
                                                <x-admin.badge variant="info">Fallback</x-admin.badge>
                                            @else
                                                <span class="text-xs text-gray-400">—</span>
                                            @endif
                                        </div>
                                        <div class="md:col-span-2 text-right">
                                            <button type="submit" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 text-gray-700 bg-transparent border border-gray-300 hover:bg-gray-50 active:bg-gray-100 focus:ring-gray-500 px-3 py-1.5 text-xs">
                                                Lưu {{ strtoupper($language->code) }}
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
