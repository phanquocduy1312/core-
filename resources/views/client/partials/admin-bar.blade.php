@php
    $clientAdmin = auth()->user();
    $showClientAdminBar = $clientAdmin
        && $clientAdmin->is_active
        && $clientAdmin->role_id !== null
        && $clientAdmin->can('manage_pages');
@endphp

@if($showClientAdminBar)
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <style>
        #client-admin-bar {
            align-items: center !important;
            background: #1f2937 !important;
            bottom: 18px !important;
            border: 1px solid rgba(255, 255, 255, .16) !important;
            border-radius: 12px !important;
            box-shadow: 0 12px 35px rgba(0, 0, 0, .28) !important;
            color: #fff !important;
            display: flex !important;
            font: 600 14px/1.2 'Quicksand', sans-serif !important;
            gap: 6px !important;
            left: 50% !important;
            margin: 0 !important;
            max-width: calc(100vw - 24px) !important;
            padding: 7px !important;
            position: fixed !important;
            transform: translateX(-50%) !important;
            width: max-content !important;
            z-index: 2147483645 !important;
        }
        #client-admin-bar a,
        #client-admin-bar button {
            align-items: center !important;
            background: transparent !important;
            border: 0 !important;
            border-radius: 8px !important;
            color: #fff !important;
            cursor: pointer !important;
            display: inline-flex !important;
            font: inherit !important;
            gap: 6px !important;
            margin: 0 !important;
            padding: 9px 12px !important;
            text-decoration: none !important;
            white-space: nowrap !important;
        }
        #client-admin-bar a:hover,
        #client-admin-bar button:hover {
            background: rgba(255, 255, 255, .12) !important;
        }
        #client-admin-bar .client-admin-bar__edit {
            background: #e32326 !important;
        }
        #client-admin-bar .client-admin-bar__edit:hover {
            background: #b91c1c !important;
        }
        #client-admin-bar form {
            display: inline !important;
            margin: 0 !important;
        }
        @media (max-width: 520px) {
            #client-admin-bar .client-admin-bar__label {
                display: none !important;
            }
        }
    </style>

    <nav id="client-admin-bar" aria-label="Công cụ quản trị">
        <a href="{{ route('admin.dashboard', ['locale' => app()->getLocale()]) }}">
            <iconify-icon icon="solar:settings-linear" class="text-base"></iconify-icon>
            <span class="client-admin-bar__label">Quản trị</span>
        </a>

        @if(isset($page) && $page->exists)
            <a
                href="{{ route('admin.pages.builder', ['locale' => app()->getLocale(), 'page' => $page->id]) }}"
                class="client-admin-bar__edit"
            >
                <iconify-icon icon="solar:pen-new-square-linear" class="text-base"></iconify-icon>
                <span>Chỉnh sửa trang (Visual Builder)</span>
            </a>
        @endif

        <form method="POST" action="{{ route('admin.logout', ['locale' => app()->getLocale()]) }}">
            @csrf
            <button type="submit">
                <iconify-icon icon="solar:logout-2-linear" class="text-base"></iconify-icon>
                <span class="client-admin-bar__label">Đăng xuất</span>
            </button>
        </form>
    </nav>
@endif
