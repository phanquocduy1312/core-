<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ $siteBranding['favicon_url'] }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/sweetalert2/dist/sweetalert2.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>@yield('title', 'Admin') - {{ $siteBranding['name'] }}</title>
    @stack('styles')
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>

<body class="bg-gray-50 text-gray-900 font-sans antialiased">
    @if(session()->has('impersonated_by'))
        <div class="bg-amber-50 border-b border-amber-200 px-6 py-2 flex items-center justify-between sticky top-0 z-50">
            <div class="flex items-center gap-2 text-amber-800 font-semibold text-sm">
                <iconify-icon icon="solar:info-circle-line-duotone" class="text-lg"></iconify-icon>
                <span>Bạn đang đăng nhập với vai trò <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->email }}).</span>
            </div>
            <form method="POST" action="{{ route('admin.users.impersonate.leave', ['locale' => app()->getLocale()]) }}">
                @csrf
                <button type="submit" class="bg-amber-500 hover:bg-amber-600 active:bg-amber-700 text-white font-bold text-xs px-3 py-1.5 rounded-lg transition-colors">
                    Quay lại Admin
                </button>
            </form>
        </div>
    @endif

    <div class="preloader fixed inset-0 z-50 flex items-center justify-center bg-white transition-opacity duration-300">
        <img src="{{ $siteBranding['favicon_url'] }}" alt="{{ $siteBranding['name'] }}" class="w-16 h-16 animate-bounce">
    </div>

    <!-- New Tailwind Responsive Shell -->
    <div x-data="{ sidebarOpen: false, searchOpen: false }" class="min-h-screen flex flex-col">
        <!-- Header -->
        @include('admin.layouts.header')

        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <!-- Mobile sidebar backdrop -->
        <div
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-30 bg-gray-900/50 sm:hidden"
            style="display: none;"
        ></div>

        <!-- Content Area -->
        <div class="flex-grow sm:ml-64 pt-16 flex flex-col justify-between">
            <main class="p-4 md:p-6 flex-grow">
                @yield('content')
            </main>

            <!-- Footer -->
            @include('admin.layouts.footer')
        </div>
    </div>

    <script src="{{ asset('admin-assets/js/vendor.min.js') }}"></script>
    @can('manage_media')
        @include('admin.layouts.media-picker')
    @endcan
    <script src="{{ asset('admin-assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/theme/app.init.js') }}"></script>
    <script src="{{ asset('admin-assets/js/theme/theme.js') }}"></script>
    <script src="{{ asset('admin-assets/js/theme/app.min.js') }}"></script>
    {{-- <script src="{{ asset('admin-assets/js/theme/sidebarmenu.js') }}"></script> --}}
    <script src="{{ asset('admin-assets/libs/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    @include('admin.layouts.toast')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Global SweetAlert2 delete confirmation
            document.body.addEventListener('submit', function (e) {
                const form = e.target;
                if (form.classList.contains('js-delete-form')) {
                    e.preventDefault();
                    Swal.fire({
                        title: form.dataset.confirmTitle || "{{ __('catalog.actions.confirm_delete') }}",
                        text: form.dataset.confirmText || "",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e32326',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: form.dataset.confirmBtn || "{{ __('catalog.actions.delete') }}",
                        cancelButtonText: "{{ __('catalog.actions.cancel') }}",
                        focusCancel: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }
            });

            // Advanced Quill Image Resizer & Alignment Toolbar (Vanilla JS)
            let activeImage = null;
            let overlay = null;
            let toolbar = null;

            document.addEventListener('click', function (e) {
                if (e.target.tagName === 'IMG' && e.target.closest('.ql-editor')) {
                    const img = e.target;
                    e.preventDefault();
                    e.stopPropagation();
                    setupImageOverlay(img);
                } else if (overlay && !overlay.contains(e.target) && (!toolbar || !toolbar.contains(e.target))) {
                    removeOverlay();
                }
            }, true);

            function setupImageOverlay(img) {
                if (activeImage === img) return;
                removeOverlay();
                
                activeImage = img;
                
                // Create overlay wrapper that mirrors the image position
                overlay = document.createElement('div');
                overlay.style.position = 'absolute';
                overlay.style.border = '2px dashed var(--bs-primary)';
                overlay.style.pointerEvents = 'none';
                overlay.style.zIndex = '9999';
                document.body.appendChild(overlay);
                
                // Create alignment toolbar
                toolbar = document.createElement('div');
                toolbar.style.position = 'absolute';
                toolbar.style.backgroundColor = '#2a3547';
                toolbar.style.borderRadius = '6px';
                toolbar.style.padding = '6px 8px';
                toolbar.style.display = 'flex';
                toolbar.style.gap = '8px';
                toolbar.style.zIndex = '10000';
                toolbar.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
                
                const buttons = [
                    { icon: 'solar:align-left-linear', text: 'Trái', action: () => alignImage('left') },
                    { icon: 'solar:align-horizontaly-linear', text: 'Giữa', action: () => alignImage('center') },
                    { icon: 'solar:align-right-linear', text: 'Phải', action: () => alignImage('right') },
                    { icon: 'solar:trash-bin-trash-bold-duotone', text: 'Xóa', color: '#ef4444', action: () => deleteImage() }
                ];
                
                buttons.forEach(btn => {
                    const button = document.createElement('button');
                    button.type = 'button';
                    button.style.background = 'none';
                    button.style.border = 'none';
                    button.style.color = btn.color || '#fff';
                    button.style.cursor = 'pointer';
                    button.style.display = 'flex';
                    button.style.alignItems = 'center';
                    button.style.gap = '4px';
                    button.style.fontSize = '12px';
                    button.style.fontWeight = 'bold';
                    button.style.padding = '4px 8px';
                    button.style.borderRadius = '4px';
                    button.innerHTML = `<iconify-icon icon="${btn.icon}" style="font-size: 16px;"></iconify-icon> ${btn.text}`;
                    
                    button.addEventListener('mouseenter', () => {
                        button.style.backgroundColor = btn.color ? 'rgba(239, 68, 68, 0.2)' : 'rgba(255,255,255,0.1)';
                    });
                    button.addEventListener('mouseleave', () => {
                        button.style.backgroundColor = 'transparent';
                    });
                    
                    button.addEventListener('click', (clickEvent) => {
                        clickEvent.preventDefault();
                        clickEvent.stopPropagation();
                        btn.action();
                    });
                    
                    toolbar.appendChild(button);
                });
                
                document.body.appendChild(toolbar);
                
                // Add 4 corner handles
                const handles = ['top-left', 'top-right', 'bottom-left', 'bottom-right'];
                handles.forEach(pos => {
                    const handle = document.createElement('div');
                    handle.style.position = 'absolute';
                    handle.style.width = '10px';
                    handle.style.height = '10px';
                    handle.style.backgroundColor = 'var(--bs-primary)';
                    handle.style.border = '1px solid white';
                    handle.style.pointerEvents = 'auto';
                    handle.style.zIndex = '10001';
                    
                    if (pos === 'top-left') {
                        handle.style.cursor = 'nwse-resize';
                    } else if (pos === 'top-right') {
                        handle.style.cursor = 'nesw-resize';
                    } else if (pos === 'bottom-left') {
                        handle.style.cursor = 'nesw-resize';
                    } else if (pos === 'bottom-right') {
                        handle.style.cursor = 'nwse-resize';
                    }
                    
                    handle.addEventListener('mousedown', function (dragEvent) {
                        dragEvent.preventDefault();
                        dragEvent.stopPropagation();
                        
                        const startX = dragEvent.clientX;
                        const startWidth = activeImage.clientWidth;
                        
                        function onMouseMove(moveEvent) {
                            let deltaX = moveEvent.clientX - startX;
                            if (pos === 'top-left' || pos === 'bottom-left') {
                                deltaX = -deltaX;
                            }
                            
                            const newWidth = Math.max(30, startWidth + deltaX);
                            activeImage.style.width = newWidth + 'px';
                            activeImage.style.height = 'auto';
                            
                            updateOverlayPosition();
                            triggerEditorUpdate();
                        }
                        
                        function onMouseUp() {
                            document.removeEventListener('mousemove', onMouseMove);
                            document.removeEventListener('mouseup', onMouseUp);
                        }
                        
                        document.addEventListener('mousemove', onMouseMove);
                        document.addEventListener('mouseup', onMouseUp);
                    });
                    
                    overlay.appendChild(handle);
                });
                
                function updateOverlayPosition() {
                    if (!activeImage) return;
                    const rect = activeImage.getBoundingClientRect();
                    const scrollY = window.scrollY;
                    const scrollX = window.scrollX;
                    
                    overlay.style.top = (scrollY + rect.top) + 'px';
                    overlay.style.left = (scrollX + rect.left) + 'px';
                    overlay.style.width = rect.width + 'px';
                    overlay.style.height = rect.height + 'px';
                    
                    toolbar.style.top = (scrollY + rect.top - 45) + 'px';
                    toolbar.style.left = (scrollX + rect.left + (rect.width - toolbar.offsetWidth) / 2) + 'px';
                    
                    const children = overlay.children;
                    if (children.length === 4) {
                        children[0].style.top = '-5px';
                        children[0].style.left = '-5px';
                        children[1].style.top = '-5px';
                        children[1].style.right = '-5px';
                        children[2].style.bottom = '-5px';
                        children[2].style.left = '-5px';
                        children[3].style.bottom = '-5px';
                        children[3].style.right = '-5px';
                    }
                }
                
                updateOverlayPosition();
                
                window.addEventListener('scroll', updateOverlayPosition, { passive: true });
                window.addEventListener('resize', updateOverlayPosition, { passive: true });
                
                setTimeout(updateOverlayPosition, 10);
            }

            function alignImage(alignment) {
                if (!activeImage) return;
                
                if (alignment === 'left') {
                    activeImage.style.float = 'left';
                    activeImage.style.display = 'inline';
                    activeImage.style.margin = '5px 15px 15px 0';
                } else if (alignment === 'right') {
                    activeImage.style.float = 'right';
                    activeImage.style.display = 'inline';
                    activeImage.style.margin = '5px 0 15px 15px';
                } else if (alignment === 'center') {
                    activeImage.style.float = 'none';
                    activeImage.style.display = 'block';
                    activeImage.style.margin = '15px auto';
                }
                
                setTimeout(() => {
                    if (!activeImage) return;
                    const rect = activeImage.getBoundingClientRect();
                    overlay.style.top = (window.scrollY + rect.top) + 'px';
                    overlay.style.left = (window.scrollX + rect.left) + 'px';
                    overlay.style.width = rect.width + 'px';
                    overlay.style.height = rect.height + 'px';
                    toolbar.style.top = (window.scrollY + rect.top - 45) + 'px';
                    toolbar.style.left = (window.scrollX + rect.left + (rect.width - toolbar.offsetWidth) / 2) + 'px';
                }, 50);
                
                triggerEditorUpdate();
            }

            function deleteImage() {
                if (!activeImage) return;
                const editor = activeImage.closest('.ql-editor');
                activeImage.remove();
                removeOverlay();
                if (editor) {
                    const catalogQuill = editor.closest('.catalog-quill');
                    if (catalogQuill) {
                        const targetInput = document.getElementById(catalogQuill.dataset.target);
                        if (targetInput) {
                            targetInput.value = editor.innerHTML;
                        }
                    }
                    const postEditor = document.getElementById('content_editor');
                    if (postEditor && postEditor.contains(editor)) {
                        const contentInput = document.getElementById('content_input');
                        if (contentInput) {
                            contentInput.value = editor.innerHTML;
                        }
                    }
                }
            }

            function triggerEditorUpdate() {
                if (!activeImage) return;
                const editor = activeImage.closest('.ql-editor');
                if (editor) {
                    const catalogQuill = editor.closest('.catalog-quill');
                    if (catalogQuill) {
                        const targetInput = document.getElementById(catalogQuill.dataset.target);
                        if (targetInput) {
                            targetInput.value = editor.innerHTML;
                        }
                    }
                    const postEditor = document.getElementById('content_editor');
                    if (postEditor && postEditor.contains(editor)) {
                        const contentInput = document.getElementById('content_input');
                        if (contentInput) {
                            contentInput.value = editor.innerHTML;
                        }
                    }
                }
            }

            function removeOverlay() {
                activeImage = null;
                if (overlay) {
                    overlay.remove();
                    overlay = null;
                }
                if (toolbar) {
                    toolbar.remove();
                    toolbar = null;
                }
            }
        });
    </script>
    @stack('scripts')
    @if(config('app.env') === 'local')
        <script src="{{ asset('admin-assets/js/visual-validator.js') }}"></script>
    @endif
</body>

</html>
