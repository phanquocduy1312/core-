@extends('admin.layouts.app')

@section('title', __('Chi tiết Yêu cầu Liên hệ #' . $contact_inquiry->id))

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold mb-1 text-white flex items-center gap-2">
                    <iconify-icon icon="solar:letter-unread-bold-duotone" class="text-2xl text-amber-400"></iconify-icon>
                    <span>Chi tiết Yêu cầu Liên hệ #{{ $contact_inquiry->id }}</span>
                </h4>
                <nav class="flex text-sm text-slate-350" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.home') }}</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                                <a href="{{ route('admin.contact-inquiries.index') }}" class="text-slate-300 hover:text-white transition-colors">Yêu cầu liên hệ</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                                <span class="text-slate-400">#{{ $contact_inquiry->id }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.contact-inquiries.index') }}" class="inline-flex items-center gap-2 px-3.5 py-2 text-xs font-semibold text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors shadow-xs">
                    <iconify-icon icon="solar:arrow-left-linear" class="text-base"></iconify-icon>
                    <span>Quay lại danh sách</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="p-4 mb-6 text-sm text-emerald-800 rounded-lg bg-emerald-50 border border-emerald-200 flex items-center justify-between" role="alert">
            <div class="flex items-center gap-2">
                <iconify-icon icon="solar:check-circle-bold" class="text-lg"></iconify-icon>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="text-emerald-500 hover:text-emerald-700" onclick="this.parentElement.remove()">
                <iconify-icon icon="solar:close-circle-linear" class="text-lg"></iconify-icon>
            </button>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Left: Customer Info & Message Content -->
        <div class="lg:col-span-8 space-y-6">
            <!-- Customer Card -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-xs">
                <div class="flex flex-wrap items-start justify-between gap-4 pb-5 border-b border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-xl uppercase">
                            {{ mb_substr($contact_inquiry->name, 0, 2) }}
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">{{ $contact_inquiry->name }}</h2>
                            @if($contact_inquiry->title)
                                <div class="text-sm font-semibold text-primary mt-0.5">{{ $contact_inquiry->title }}</div>
                            @endif
                            @if($contact_inquiry->company)
                                <div class="text-sm text-gray-600 mt-0.5 flex items-center gap-1.5">
                                    <iconify-icon icon="solar:buildings-2-line-duotone" class="text-base text-gray-400"></iconify-icon>
                                    <span>{{ $contact_inquiry->company }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold border {{ $contact_inquiry->status_badge_class }}">
                            {{ $contact_inquiry->status_label }}
                        </span>
                    </div>
                </div>

                <!-- Contact Details Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-5">
                    <div class="p-3.5 bg-gray-50 rounded-lg border border-gray-100">
                        <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Email liên hệ</div>
                        <div class="flex items-center justify-between gap-2">
                            <span class="font-mono text-sm font-bold text-gray-900 truncate">{{ $contact_inquiry->email }}</span>
                            <a href="mailto:{{ $contact_inquiry->email }}?subject={{ rawurlencode('LuxLight - Phản hồi yêu cầu: ' . $contact_inquiry->enquiry_type) }}" class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold text-blue-600 bg-blue-50 border border-blue-200 rounded-md hover:bg-blue-100 transition-colors shrink-0">
                                <iconify-icon icon="solar:letter-linear" class="text-xs"></iconify-icon>
                                <span>Gửi mail</span>
                            </a>
                        </div>
                    </div>

                    <div class="p-3.5 bg-gray-50 rounded-lg border border-gray-100">
                        <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Số điện thoại</div>
                        <div class="flex items-center justify-between gap-2">
                            <span class="font-mono text-sm font-bold text-gray-900 truncate">{{ $contact_inquiry->phone }}</span>
                            <a href="tel:{{ $contact_inquiry->phone }}" class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold text-emerald-600 bg-emerald-50 border border-emerald-200 rounded-md hover:bg-emerald-100 transition-colors shrink-0">
                                <iconify-icon icon="solar:phone-calling-linear" class="text-xs"></iconify-icon>
                                <span>Gọi điện</span>
                            </a>
                        </div>
                    </div>

                    <div class="p-3.5 bg-gray-50 rounded-lg border border-gray-100">
                        <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Loại yêu cầu</div>
                        <span class="inline-flex items-center px-2.5 py-1 rounded text-xs font-bold bg-white text-gray-800 border border-gray-200 shadow-2xs">
                            {{ $contact_inquiry->enquiry_type }}
                        </span>
                    </div>

                    <div class="p-3.5 bg-gray-50 rounded-lg border border-gray-100">
                        <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Thời điểm gửi</div>
                        <div class="text-sm font-semibold text-gray-900">
                            {{ $contact_inquiry->created_at?->format('d/m/Y H:i:s') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Message Card -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-xs">
                <h3 class="text-base font-bold text-gray-900 mb-3 flex items-center gap-2">
                    <iconify-icon icon="solar:chat-square-call-linear" class="text-xl text-primary"></iconify-icon>
                    <span>Nội dung yêu cầu / Lời nhắn từ khách hàng:</span>
                </h3>
                <div class="p-5 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-800 leading-relaxed whitespace-pre-wrap font-sans select-text">
                    {{ $contact_inquiry->message }}
                </div>
            </div>
        </div>

        <!-- Right: Status Update, Internal Admin Notes & Meta Info -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Action & Status Card -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-xs">
                <h3 class="text-base font-bold text-gray-900 mb-4 pb-3 border-b border-gray-100 flex items-center gap-2">
                    <iconify-icon icon="solar:shield-check-linear" class="text-xl text-emerald-600"></iconify-icon>
                    <span>Cập nhật Xử lý Yêu cầu</span>
                </h3>

                <form action="{{ route('admin.contact-inquiries.update', $contact_inquiry) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block mb-1.5 text-xs font-semibold text-gray-600 uppercase tracking-wider">Trạng thái xử lý</label>
                        <select name="status" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                            @foreach($statuses as $sKey => $sLabel)
                                <option value="{{ $sKey }}" @selected($contact_inquiry->status === $sKey)>
                                    {{ $sLabel }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block mb-1.5 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Ghi chú nội bộ (Admin Notes)
                        </label>
                        <textarea name="admin_notes" rows="6" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none placeholder-gray-400" placeholder="Lưu lại lịch sử trao đổi, báo giá hoặc thông tin quan trọng của dự án...">{{ old('admin_notes', $contact_inquiry->admin_notes) }}</textarea>
                        <p class="text-[11px] text-gray-400 mt-1">Ghi chú này chỉ lưu nội bộ cho ban quản trị, khách hàng không thấy.</p>
                    </div>

                    <button type="submit" class="w-full py-2.5 px-4 text-sm font-bold text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors shadow-xs flex items-center justify-center gap-2">
                        <iconify-icon icon="solar:diskette-bold" class="text-lg"></iconify-icon>
                        <span>Lưu thay đổi</span>
                    </button>
                </form>
            </div>

            <!-- Technical Metadata Card -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-xs text-xs text-gray-500 space-y-3">
                <h4 class="font-bold text-gray-700 uppercase tracking-wider pb-2 border-b border-gray-100">Thông tin kỹ thuật</h4>
                <div class="flex justify-between">
                    <span>Địa chỉ IP:</span>
                    <span class="font-mono text-gray-700 font-semibold">{{ $contact_inquiry->ip_address ?: 'Không xác định' }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Đã phản hồi lúc:</span>
                    <span class="text-gray-700 font-semibold">{{ $contact_inquiry->replied_at ? $contact_inquiry->replied_at->format('d/m/Y H:i') : 'Chưa' }}</span>
                </div>
                <div>
                    <span class="block mb-1">Trình duyệt / Thiết bị:</span>
                    <p class="text-[11px] text-gray-400 truncate" title="{{ $contact_inquiry->user_agent }}">{{ $contact_inquiry->user_agent ?: 'N/A' }}</p>
                </div>

                <div class="pt-3 border-t border-gray-100 flex justify-end">
                    <form action="{{ route('admin.contact-inquiries.destroy', $contact_inquiry) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn yêu cầu liên hệ này?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-semibold flex items-center gap-1 transition-colors">
                            <iconify-icon icon="solar:trash-bin-trash-linear" class="text-sm"></iconify-icon>
                            <span>Xóa yêu cầu này</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
