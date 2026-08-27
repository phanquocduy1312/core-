@extends('admin.layouts.app')

@section('title', 'Nhật ký hệ thống')

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold mb-1 text-white">Nhật ký hệ thống</h4>
                <div class="text-slate-350 text-sm">Xem và tải về các tệp tin nhật ký API &amp; ứng dụng.</div>
            </div>
        </div>
    </div>

    <!-- Table List Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col justify-between mb-8">
        <div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-bold">Tệp</th>
                            <th class="px-6 py-3 font-bold">Kích thước</th>
                            <th class="px-6 py-3 font-bold">Cập nhật lúc</th>
                            <th class="px-6 py-3 text-right"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-150">
                        @forelse($files as $file)
                            <tr class="hover:bg-gray-55/50 transition-colors">
                                <td class="px-6 py-4 font-mono text-xs text-gray-700 font-bold">
                                    {{ $file['name'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-650">
                                    {{ number_format($file['size'] / 1024, 1) }} KB
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-650">
                                    {{ \Illuminate\Support\Carbon::createFromTimestamp($file['modified_at'])->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex justify-end gap-2">
                                        <x-admin.button variant="primary" size="xs" href="{{ route('admin.logs.show', ['locale' => app()->getLocale(), 'file' => $file['name']]) }}">
                                            Xem
                                        </x-admin.button>
                                        @can('superadmin')
                                            <x-admin.button variant="outline" size="xs" href="{{ route('admin.logs.download', ['locale' => app()->getLocale(), 'file' => $file['name']]) }}">
                                                Tải về
                                            </x-admin.button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-10 text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <iconify-icon icon="solar:document-text-broken" class="text-4xl text-gray-300 mb-2"></iconify-icon>
                                        <p class="text-sm font-semibold">Chưa có tệp log nào.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
