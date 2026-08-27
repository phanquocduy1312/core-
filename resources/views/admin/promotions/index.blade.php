@extends('admin.layouts.app')

@section('title', 'Chương trình khuyến mãi')

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold mb-1 text-white">Chương trình khuyến mãi & Flash Sale</h4>
                <div class="text-slate-350 text-sm">Giá tự động theo sản phẩm/SKU, không cần nhập mã.</div>
            </div>
            <div>
                <x-admin.button variant="primary" size="sm" href="{{ route('admin.promotions.create') }}">
                    <iconify-icon icon="solar:add-circle-linear" class="mr-1"></iconify-icon> Tạo chương trình
                </x-admin.button>
            </div>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 mb-6">
        <form class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <div class="col-span-12 md:col-span-6">
                <input name="q" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" value="{{ request('q') }}" placeholder="Tìm tên chương trình">
            </div>
            <div class="col-span-12 md:col-span-4">
                <select name="kind" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">Tất cả loại</option>
                    <option value="automatic" @selected(request('kind') === 'automatic')>Khuyến mãi tự động</option>
                    <option value="flash_sale" @selected(request('kind') === 'flash_sale')>Flash Sale</option>
                </select>
            </div>
            <div class="col-span-12 md:col-span-2">
                <x-admin.button type="submit" variant="primary" size="md" class="w-full text-center flex items-center justify-center gap-1">
                    <iconify-icon icon="solar:magnifer-linear" class="text-base"></iconify-icon>
                    <span>Lọc</span>
                </x-admin.button>
            </div>
        </form>
    </div>

    <!-- Table List Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col justify-between mb-8">
        <div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-bold">{{ __('admin.promotions.fields.name') ?? 'Chương trình' }}</th>
                            <th class="px-6 py-3 font-bold">Loại / mức giảm</th>
                            <th class="px-6 py-3 font-bold">Phạm vi</th>
                            <th class="px-6 py-3 font-bold">Thời gian</th>
                            <th class="px-6 py-3 font-bold">Lượt</th>
                            <th class="px-6 py-3 font-bold">Trạng thái</th>
                            <th class="px-6 py-3 text-right"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-150">
                        @forelse($promotions as $promotion)
                            @php 
                                $active = $promotion->is_active && (! $promotion->start_at || ! $promotion->start_at->isFuture()) && (! $promotion->end_at || ! $promotion->end_at->isPast()); 
                            @endphp
                            <tr class="hover:bg-gray-55/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">{{ $promotion->name }}</div>
                                    <div class="text-2xs text-gray-400 mt-1">Ưu tiên {{ $promotion->priority }} · Tối thiểu {{ $promotion->min_quantity }} SP</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <x-admin.badge :variant="$promotion->kind === 'flash_sale' ? 'danger' : 'info'">
                                        {{ $promotion->kind === 'flash_sale' ? 'Flash Sale' : 'Tự động' }}
                                    </x-admin.badge>
                                    <div class="mt-1 font-bold text-red-650 text-xs">
                                        @if($promotion->discount_type === 'percentage') 
                                            -{{ number_format($promotion->value, 0) }}%
                                        @elseif($promotion->discount_type === 'fixed_price') 
                                            Giá {{ number_format($promotion->value) }}đ 
                                        @else 
                                            -{{ number_format($promotion->value) }}đ 
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700 font-semibold">
                                    {{ $promotion->applies_to === 'all_products' ? 'Toàn bộ sản phẩm' : $promotion->targets_count.' mục tiêu' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-650">
                                    <div>Từ: <span class="font-semibold text-gray-905">{{ $promotion->start_at?->format('d/m H:i') ?? 'Ngay' }}</span></div>
                                    <div class="mt-0.5">Đến: <span class="font-semibold text-gray-905">{{ $promotion->end_at?->format('d/m H:i') ?? 'Không hạn' }}</span></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-900">
                                    {{ $promotion->used_count }} / {{ $promotion->quantity_limit ?? '∞' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($active)
                                        <x-admin.badge variant="success">Đang chạy</x-admin.badge>
                                    @else
                                        <x-admin.badge variant="secondary">Tạm dừng/Kết thúc</x-admin.badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex justify-end gap-2">
                                        <x-admin.button variant="outline" size="xs" href="{{ route('admin.promotions.edit', $promotion) }}">
                                            Sửa
                                        </x-admin.button>
                                        <form method="POST" action="{{ route('admin.promotions.destroy', $promotion) }}" onsubmit="return confirm('Xóa chương trình này?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-admin.button type="submit" variant="danger" size="xs">
                                                Xóa
                                            </x-admin.button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-10 text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <iconify-icon icon="solar:sale-broken" class="text-4xl text-gray-300 mb-2"></iconify-icon>
                                        <p class="text-sm font-semibold">Chưa có chương trình khuyến mãi.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($promotions->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $promotions->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
