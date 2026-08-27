/**
 * Laravel Media Library Adapter for GrapesJS Asset Manager
 * Integrates GET /{locale}/admin/media/resources and POST /{locale}/admin/media/upload
 */
(function (global) {
    'use strict';

    var currentCallback = null;
    var currentTargetComponent = null;
    var currentFolder = 'all';
    var nextCursor = null;
    var isLoading = false;
    var mediaItems = [];
    var config = {};
    var selectedMediaItem = null;

    function initMediaAdapter(editor, builderConfig) {
        config = builderConfig || {};

        // Custom GrapesJS Asset Manager opener
        editor.Commands.add('open-assets', {
            run: function (ed, sender, options) {
                var target = options && options.target ? options.target : ed.getSelected();
                openMediaModal(function (asset) {
                    if (target) {
                        target.set('src', asset.src);
                        target.addAttributes({
                            'src': asset.src,
                            'alt': target.getAttributes().alt || asset.alt || ''
                        });
                        target.set('mediaRef', asset.publicId || asset.id || '');
                    }
                }, target);
            }
        });

        // Double click on image component opens Media Library
        editor.on('component:dblclick', function (model) {
            if (model.get('type') === 'image' || model.is('image') || model.get('tagName') === 'img') {
                editor.runCommand('open-assets', { target: model });
            }
        });

        // Setup DOM Modal elements
        createMediaModalHtml();
    }

    function createMediaModalHtml() {
        if (document.getElementById('grapes-media-modal')) return;

        var modalHtml = [
            '<div id="grapes-media-modal" class="fixed inset-0 z-[9999] hidden flex items-center justify-center bg-black/60 backdrop-blur-xs p-4 animate-fade-in">',
            '  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl h-[85vh] flex flex-col overflow-hidden border border-slate-200">',
            '    <!-- Modal Header -->',
            '    <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between bg-slate-50/80">',
            '      <div class="flex items-center gap-2.5">',
            '        <div class="w-9 h-9 rounded-xl bg-red-50 text-primary flex items-center justify-center">',
            '          <iconify-icon icon="solar:gallery-bold-duotone" class="text-xl"></iconify-icon>',
            '        </div>',
            '        <div>',
            '          <h3 class="font-bold text-slate-900 text-sm">Thư viện Media & Tải ảnh lên</h3>',
            '          <p class="text-2xs text-slate-500">Chọn ảnh có sẵn hoặc tải trực tiếp vào Laravel Media Library</p>',
            '        </div>',
            '      </div>',
            '      <button type="button" id="btn-close-media-modal" class="text-slate-400 hover:text-slate-700 p-1.5 rounded-lg hover:bg-slate-100 transition-colors">',
            '        <iconify-icon icon="solar:close-square-linear" class="text-2xl"></iconify-icon>',
            '      </button>',
            '    </div>',
            '',
            '    <!-- Modal Toolbar -->',
            '    <div class="px-6 py-3 border-b border-slate-200 bg-white flex flex-wrap items-center justify-between gap-3">',
            '      <div class="flex items-center gap-2">',
            '        <!-- Folder Filter -->',
            '        <select id="media-folder-select" class="px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:outline-primary">',
            '          <option value="all">Tất cả thư mục</option>',
            '          <option value="general">Chung (General)</option>',
            '          <option value="banners">Banner & Quảng cáo</option>',
            '          <option value="products">Sản phẩm</option>',
            '          <option value="posts">Bài viết & Tin tức</option>',
            '        </select>',
            '        <!-- Search -->',
            '        <div class="relative">',
            '          <input type="text" id="media-search-input" placeholder="Tìm kiếm theo tên ảnh..." class="pl-8 pr-3 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 w-52 focus:w-64 focus:outline-primary transition-all">',
            '          <iconify-icon icon="solar:magnifer-linear" class="absolute left-2.5 top-2 text-slate-400 text-sm"></iconify-icon>',
            '        </div>',
            '      </div>',
            '',
            '      <!-- Upload Button -->',
            '      <div class="flex items-center gap-2">',
            '        <label for="media-file-input" class="px-4 py-2 bg-primary hover:bg-primary/90 text-white text-xs font-bold rounded-xl shadow-xs flex items-center gap-1.5 cursor-pointer transition-all">',
            '          <iconify-icon icon="solar:cloud-upload-bold" class="text-base"></iconify-icon>',
            '          <span>Tải ảnh mới</span>',
            '        </label>',
            '        <input type="file" id="media-file-input" accept="image/jpeg,image/png,image/webp,image/gif" class="hidden">',
            '      </div>',
            '    </div>',
            '',
            '    <!-- Modal Body: Gallery Grid -->',
            '    <div id="media-grid-container" class="flex-1 overflow-y-auto p-6 bg-slate-50/50">',
            '      <div id="media-items-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">',
            '        <!-- Media items rendered here -->',
            '      </div>',
            '      <div id="media-empty-state" class="hidden text-center py-16 text-slate-400">',
            '        <iconify-icon icon="solar:gallery-remove-line-duotone" class="text-5xl mb-2 text-slate-300"></iconify-icon>',
            '        <p class="font-bold text-sm text-slate-600">Không tìm thấy hình ảnh nào</p>',
            '        <p class="text-xs text-slate-400 mt-1">Hãy tải ảnh mới lên hoặc chọn thư mục khác.</p>',
            '      </div>',
            '      <div id="media-loading-state" class="hidden text-center py-16 text-slate-400">',
            '        <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-primary border-t-transparent mb-2"></div>',
            '        <p class="text-xs font-semibold text-slate-600">Đang tải thư viện Media...</p>',
            '      </div>',
            '    </div>',
            '',
            '    <!-- Modal Footer -->',
            '    <div class="px-6 py-3.5 border-t border-slate-200 bg-white flex items-center justify-between">',
            '      <div class="text-xs text-slate-500 font-medium" id="media-selected-info">Chưa chọn hình ảnh nào</div>',
            '      <div class="flex items-center gap-2">',
            '        <button type="button" id="btn-media-load-more" class="hidden px-3.5 py-1.5 border border-slate-200 rounded-xl text-xs font-bold text-slate-700 hover:bg-slate-50">Tải thêm ảnh</button>',
            '        <button type="button" id="btn-cancel-media" class="px-3.5 py-1.5 border border-slate-200 rounded-xl text-xs font-bold text-slate-700 hover:bg-slate-50">Hủy</button>',
            '        <button type="button" id="btn-confirm-media" class="px-5 py-1.5 bg-primary text-white text-xs font-bold rounded-xl shadow-xs hover:bg-primary/90 opacity-50 cursor-not-allowed" disabled>Chọn ảnh này</button>',
            '      </div>',
            '    </div>',
            '  </div>',
            '</div>'
        ].join('\n');

        document.body.insertAdjacentHTML('beforeend', modalHtml);
        bindModalEvents();
    }

    function bindModalEvents() {
        var modal = document.getElementById('grapes-media-modal');
        var btnClose = document.getElementById('btn-close-media-modal');
        var btnCancel = document.getElementById('btn-cancel-media');
        var btnConfirm = document.getElementById('btn-confirm-media');
        var folderSelect = document.getElementById('media-folder-select');
        var searchInput = document.getElementById('media-search-input');
        var fileInput = document.getElementById('media-file-input');
        var btnLoadMore = document.getElementById('btn-media-load-more');

        function closeModal() {
            modal.classList.add('hidden');
            selectedMediaItem = null;
            currentCallback = null;
            currentTargetComponent = null;
        }

        if (btnClose) btnClose.addEventListener('click', closeModal);
        if (btnCancel) btnCancel.addEventListener('click', closeModal);

        if (folderSelect) {
            folderSelect.addEventListener('change', function () {
                currentFolder = this.value;
                loadMediaResources(true);
            });
        }

        var searchDebounceTimer = null;
        if (searchInput) {
            searchInput.addEventListener('input', function () {
                var query = this.value.toLowerCase().trim();
                clearTimeout(searchDebounceTimer);
                searchDebounceTimer = setTimeout(function () {
                    filterMediaItems(query);
                }, 300);
            });
        }

        if (btnLoadMore) {
            btnLoadMore.addEventListener('click', function () {
                loadMediaResources(false);
            });
        }

        if (fileInput) {
            fileInput.addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    uploadMediaFile(this.files[0]);
                }
            });
        }

        if (btnConfirm) {
            btnConfirm.addEventListener('click', function () {
                if (selectedMediaItem && currentCallback) {
                    currentCallback(selectedMediaItem);
                    closeModal();
                    if (window.Swal) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Đã áp dụng hình ảnh!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                }
            });
        }
    }

    async function loadMediaResources(reset) {
        if (reset) {
            mediaItems = [];
            nextCursor = null;
            selectedMediaItem = null;
            updateConfirmButton();
        }

        var loadingEl = document.getElementById('media-loading-state');
        var emptyEl = document.getElementById('media-empty-state');
        var gridEl = document.getElementById('media-items-grid');
        var btnLoadMore = document.getElementById('btn-media-load-more');

        if (reset) gridEl.innerHTML = '';
        loadingEl.classList.remove('hidden');
        emptyEl.classList.add('hidden');

        try {
            var url = config.mediaResourcesUrl || '/vi/admin/media/resources';
            var params = new URLSearchParams();
            if (currentFolder && currentFolder !== 'all') params.append('folder', currentFolder);
            if (nextCursor) params.append('cursor', nextCursor);

            var separator = url.indexOf('?') !== -1 ? '&' : '?';
            var response = await fetch(url + separator + params.toString(), {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            var data = await response.json();
            var resources = data.resources || [];
            nextCursor = data.next_cursor || null;

            if (reset) mediaItems = resources;
            else mediaItems = mediaItems.concat(resources);

            renderMediaGrid(mediaItems);

            if (btnLoadMore) {
                btnLoadMore.classList.toggle('hidden', !nextCursor);
            }

            if (mediaItems.length === 0) {
                emptyEl.classList.remove('hidden');
            }
        } catch (err) {
            console.error('Error loading media resources:', err);
            if (window.Swal) {
                Swal.fire('Lỗi', 'Không thể nạp danh sách hình ảnh từ Media Library.', 'error');
            }
        } finally {
            loadingEl.classList.add('hidden');
        }
    }

    function renderMediaGrid(items) {
        var gridEl = document.getElementById('media-items-grid');
        gridEl.innerHTML = '';

        items.forEach(function (item) {
            var card = document.createElement('div');
            card.className = 'group relative bg-white border border-slate-200 rounded-xl overflow-hidden cursor-pointer hover:border-primary hover:shadow-md transition-all';
            card.dataset.src = item.secure_url;
            card.dataset.publicId = item.public_id || '';

            var filename = (item.public_id || item.secure_url).split('/').pop();
            var sizeKb = item.bytes ? Math.round(item.bytes / 1024) + ' KB' : '';

            card.innerHTML = [
                '<div class="aspect-square bg-slate-100 overflow-hidden flex items-center justify-center relative">',
                '  <img src="' + item.secure_url + '" alt="' + filename + '" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">',
                '  <div class="media-selected-badge hidden absolute top-2 right-2 w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center shadow-md">',
                '    <iconify-icon icon="solar:check-circle-bold" class="text-base"></iconify-icon>',
                '  </div>',
                '</div>',
                '<div class="p-2.5">',
                '  <div class="text-2xs font-bold text-slate-800 truncate" title="' + filename + '">' + filename + '</div>',
                '  <div class="text-3xs text-slate-400 mt-0.5">' + sizeKb + '</div>',
                '</div>'
            ].join('\n');

            card.addEventListener('click', function () {
                document.querySelectorAll('#media-items-grid > div').forEach(function (c) {
                    c.classList.remove('border-primary', 'ring-2', 'ring-primary/20');
                    c.querySelector('.media-selected-badge').classList.add('hidden');
                });
                card.classList.add('border-primary', 'ring-2', 'ring-primary/20');
                card.querySelector('.media-selected-badge').classList.remove('hidden');

                selectedMediaItem = {
                    src: item.secure_url,
                    publicId: item.public_id || '',
                    id: item.public_id || item.id || '',
                    alt: filename
                };

                updateConfirmButton();
            });

            gridEl.appendChild(card);
        });
    }

    function filterMediaItems(query) {
        var filtered = mediaItems.filter(function (item) {
            var name = (item.public_id || item.secure_url).toLowerCase();
            return name.indexOf(query) !== -1;
        });
        renderMediaGrid(filtered);
    }

    function updateConfirmButton() {
        var btnConfirm = document.getElementById('btn-confirm-media');
        var selectedInfo = document.getElementById('media-selected-info');
        if (selectedMediaItem) {
            btnConfirm.disabled = false;
            btnConfirm.classList.remove('opacity-50', 'cursor-not-allowed');
            var filename = selectedMediaItem.src.split('/').pop();
            selectedInfo.textContent = 'Đã chọn: ' + filename;
        } else {
            btnConfirm.disabled = true;
            btnConfirm.classList.add('opacity-50', 'cursor-not-allowed');
            selectedInfo.textContent = 'Chưa chọn hình ảnh nào';
        }
    }

    async function uploadMediaFile(file) {
        var folder = currentFolder === 'all' ? 'general' : currentFolder;
        var formData = new FormData();
        formData.append('file', file);
        formData.append('folder', folder);
        formData.append('image_only', '1');

        var uploadUrl = config.mediaUploadUrl || '/vi/admin/media/upload';

        if (window.Swal) {
            Swal.fire({
                title: 'Đang tải ảnh lên...',
                text: file.name,
                allowOutsideClick: false,
                didOpen: function () { Swal.showLoading(); }
            });
        }

        try {
            var response = await fetch(uploadUrl, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': config.csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            });

            var res = await response.json();
            if (!response.ok || !res.success) {
                throw new Error(res.message || 'Tải ảnh lên thất bại.');
            }

            if (window.Swal) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Tải ảnh lên thành công!',
                    showConfirmButton: false,
                    timer: 2000
                });
            }

            // Reload gallery
            await loadMediaResources(true);

            // Auto-select uploaded image
            selectedMediaItem = {
                src: res.url,
                publicId: folder + '/' + file.name.replace(/\.[^/.]+$/, ''),
                id: folder + '/' + file.name.replace(/\.[^/.]+$/, ''),
                alt: file.name
            };
            updateConfirmButton();

        } catch (err) {
            console.error('Upload error:', err);
            if (window.Swal) {
                Swal.fire('Lỗi tải ảnh', err.message || 'Không thể tải ảnh lên.', 'error');
            }
        }
    }

    function openMediaModal(callback, targetComponent) {
        currentCallback = callback;
        currentTargetComponent = targetComponent;
        var modal = document.getElementById('grapes-media-modal');
        if (!modal) createMediaModalHtml();
        modal = document.getElementById('grapes-media-modal');
        modal.classList.remove('hidden');

        loadMediaResources(true);
    }

    global.GrapesMediaAdapter = {
        init: initMediaAdapter,
        open: openMediaModal
    };
})(window);
