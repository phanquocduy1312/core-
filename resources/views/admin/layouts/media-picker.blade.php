<!-- Custom styling for Media Picker elements -->
<style>
    #adminMediaPickerGrid .media-picker-card {
        height: 150px;
        min-width: 0;
    }
    #adminMediaPickerGrid .media-picker-thumbnail {
        background: #f9fafb;
        height: 92px;
        object-fit: contain;
        padding: 4px;
        width: 100%;
    }
    #adminMediaPickerGrid .media-picker-name {
        font-size: 11px;
        line-height: 1.2;
    }
    #adminMediaPickerGrid .media-picker-dimensions {
        font-size: 10px;
        line-height: 1.2;
    }
</style>

<!-- Tailwind CSS Modal Container -->
<div class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/50" id="adminMediaPicker" aria-labelledby="adminMediaPickerLabel" aria-hidden="true">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-4xl max-h-[90vh] flex flex-col transform transition-all duration-300">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gray-50 rounded-t-xl">
            <div>
                <h5 class="font-bold text-gray-900 text-base" id="adminMediaPickerLabel">Chọn ảnh từ thư viện</h5>
                <p class="text-xs text-gray-500 mt-0.5">Chọn một ảnh đã tải lên hoặc thêm ảnh mới.</p>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-600 focus:outline-none" id="adminMediaPickerClose" aria-label="Đóng">
                <iconify-icon icon="solar:close-circle-linear" class="text-2xl"></iconify-icon>
            </button>
        </div>
        
        <!-- Body -->
        <div class="p-6 overflow-y-auto flex-grow space-y-4">
            <div class="flex flex-wrap gap-4 items-center justify-between">
                <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary p-2 w-auto" id="adminMediaPickerFolder" aria-label="Thư mục ảnh">
                    <option value="all">Tất cả thư mục</option>
                    @foreach(app(\App\Services\CloudinaryService::class)->listFolders() as $folder)
                        <option value="{{ $folder }}">{{ ucfirst($folder) }}</option>
                    @endforeach
                </select>
                <div>
                    <input class="hidden" id="adminMediaPickerUpload" type="file" accept="image/*">
                    <button class="text-white bg-primary hover:bg-primary-hover active:bg-primary-active font-bold rounded-lg text-sm px-4 py-2 flex items-center gap-2" type="button" id="adminMediaPickerUploadButton">
                        <iconify-icon icon="solar:upload-linear" class="text-lg"></iconify-icon>Thêm ảnh mới
                    </button>
                </div>
            </div>
            
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200 hidden" id="adminMediaPickerError" role="alert"></div>
            
            <!-- Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-3" id="adminMediaPickerGrid"></div>
            
            <!-- Empty state -->
            <div class="text-center text-gray-500 py-10 hidden" id="adminMediaPickerEmpty">Chưa có ảnh trong thư viện.</div>
            
            <!-- Loading -->
            <div class="text-center py-10" id="adminMediaPickerLoading">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary mx-auto"></div>
            </div>
            
            <!-- Pagination -->
            <div class="flex justify-between items-center mt-6 hidden" id="adminMediaPickerPagination">
                <button class="px-3 py-1.5 text-xs font-semibold text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" type="button" id="adminMediaPickerPrevious">← Trước</button>
                <span class="text-sm text-gray-500" id="adminMediaPickerPage">Trang 1</span>
                <button class="px-3 py-1.5 text-xs font-semibold text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" type="button" id="adminMediaPickerNext">Sau →</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalElement = document.getElementById('adminMediaPicker');
        if (!modalElement) return;

        // Custom Modal control methods (Bootstrap-free)
        const modal = {
            show: function () {
                modalElement.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            },
            hide: function () {
                modalElement.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        };

        const closeBtn = document.getElementById('adminMediaPickerClose');
        if (closeBtn) {
            closeBtn.addEventListener('click', modal.hide);
        }

        // Close on clicking overlay background
        modalElement.addEventListener('click', function (event) {
            if (event.target === modalElement) {
                modal.hide();
            }
        });

        const folder = document.getElementById('adminMediaPickerFolder');
        const upload = document.getElementById('adminMediaPickerUpload');
        const grid = document.getElementById('adminMediaPickerGrid');
        const loading = document.getElementById('adminMediaPickerLoading');
        const empty = document.getElementById('adminMediaPickerEmpty');
        const error = document.getElementById('adminMediaPickerError');
        const pagination = document.getElementById('adminMediaPickerPagination');
        const previous = document.getElementById('adminMediaPickerPrevious');
        const next = document.getElementById('adminMediaPickerNext');
        const pageLabel = document.getElementById('adminMediaPickerPage');
        let activeInput = null;
        let cursors = [null];
        let pageIndex = 0;
        let nextCursor = null;

        const inputFolder = (input) => input.dataset.mediaFolder || ({ image_file: 'general', avatar_file: 'avatars' }[input.name] || 'general');
        const selectedField = (input) => input.dataset.mediaSelectedField || (input.name === 'avatar_file' ? 'avatar_url' : 'image_url');

        function showError(message) {
            error.textContent = message;
            error.classList.remove('hidden');
        }

        function clearError() { error.classList.add('hidden'); }

        function render(resources, newNextCursor) {
            grid.innerHTML = '';
            empty.classList.toggle('hidden', resources.length !== 0);
            nextCursor = newNextCursor || null;
            pagination.classList.toggle('hidden', resources.length === 0);
            previous.disabled = pageIndex === 0;
            next.disabled = !nextCursor;
            pageLabel.textContent = 'Trang ' + (pageIndex + 1);

            resources.forEach(function (resource) {
                const column = document.createElement('div');
                column.className = 'w-full';
                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'media-picker-card group relative border border-gray-250 rounded-lg overflow-hidden w-full aspect-square text-left bg-white flex flex-col hover:border-primary transition-colors focus:outline-none';
                button.title = 'Chọn ' + resource.public_id;
                
                const image = document.createElement('img');
                image.src = resource.secure_url;
                image.alt = resource.public_id;
                image.className = 'media-picker-thumbnail d-block flex-shrink-0';
                
                const name = document.createElement('div');
                name.className = 'media-picker-name px-2 pt-2 text-gray-700 truncate w-full';
                name.textContent = resource.public_id.split('/').pop();
                
                const dimensions = document.createElement('div');
                dimensions.className = 'media-picker-dimensions px-2 pb-2 pt-0.5 text-gray-400 truncate w-full';
                dimensions.textContent = resource.width && resource.height
                    ? resource.width + ' × ' + resource.height + ' px'
                    : (resource.format || 'image').toUpperCase();
                    
                button.append(image, name, dimensions);
                button.addEventListener('click', function () { select(resource.secure_url); });
                column.appendChild(button);
                grid.appendChild(column);
            });
        }

        function loadResources() {
            clearError();
            loading.classList.remove('hidden');
            grid.innerHTML = '';
            empty.classList.add('hidden');
            const cursor = cursors[pageIndex];
            const query = new URLSearchParams({ folder: folder.value, _: Date.now().toString() });
            if (cursor) query.set('cursor', cursor);
            fetch('{{ route('admin.media.resources') }}?' + query.toString(), {
                cache: 'no-store',
                headers: { Accept: 'application/json' },
            })
                .then(function (response) { if (!response.ok) throw new Error('Không thể tải thư viện ảnh.'); return response.json(); })
                .then(function (data) { render(data.resources || [], data.next_cursor); })
                .catch(function (exception) { showError(exception.message); })
                .finally(function () { loading.classList.add('hidden'); });
        }

        function select(url) {
            if (!activeInput) return;
            const form = activeInput.closest('form');
            if (form) {
                let targets = Array.from(form.querySelectorAll('[name="' + selectedField(activeInput) + '"]'));
                if (targets.length === 0) {
                    const target = document.createElement('input');
                    target.type = 'hidden';
                    target.name = selectedField(activeInput);
                    form.appendChild(target);
                    targets = [target];
                }
                targets.forEach(function (target) {
                    target.value = url;
                    target.dispatchEvent(new Event('input', { bubbles: true }));
                    target.dispatchEvent(new Event('change', { bubbles: true }));
                });
            }
            activeInput.dispatchEvent(new CustomEvent('media:selected', { bubbles: true, detail: { url: url } }));
            if (modalElement.contains(document.activeElement)) {
                document.activeElement.blur();
            }
            modal.hide();
        }

        document.addEventListener('media:selected', function (event) {
            const input = event.target;
            const formPreview = input.closest('form')?.querySelector('[data-media-preview]');
            if (formPreview) {
                const image = formPreview.querySelector('[data-media-preview-image]');
                if (image) image.src = event.detail.url;
                formPreview.classList.remove('hidden');
            }
            const previews = {
                product_image_file: ['product_image_preview', 'product_image_placeholder'],
                post_image_file: ['post_image_preview', 'post_image_placeholder'],
                user_avatar_file: ['user_avatar_preview'],
                image_file: ['imagePreview'],
                quick_image_file: ['quickImagePreview'],
            };
            const ids = previews[input.id];
            if (!ids) return;
            const image = document.getElementById(ids[0]);
            if (image) {
                image.src = event.detail.url;
                image.classList.remove('hidden');
            }
            if (ids[1]) document.getElementById(ids[1])?.classList.add('hidden');
            if (input.id === 'image_file') document.getElementById('imagePreviewContainer')?.style.setProperty('display', 'block');
            if (input.id === 'quick_image_file') document.getElementById('quickImagePreviewWrap')?.classList.remove('hidden');
        });

        document.addEventListener('click', function (event) {
            let input = event.target.closest('input[type="file"][accept*="image"]');
            if (!input) {
                const label = event.target.closest('label[for]');
                input = label ? document.getElementById(label.htmlFor) : null;
            }
            if (!input || input.id === 'adminMediaPickerUpload' || input.closest('#adminMediaPicker')) return;
            if (input.type !== 'file' || !input.accept.includes('image')) return;
            event.preventDefault();
            event.stopImmediatePropagation();
            activeInput = input;
            folder.value = inputFolder(input);
            cursors = [null];
            pageIndex = 0;
            loadResources();
            modal.show();
        }, true);

        folder.addEventListener('change', function () {
            cursors = [null];
            pageIndex = 0;
            loadResources();
        });
        previous.addEventListener('click', function () {
            if (pageIndex === 0) return;
            pageIndex--;
            loadResources();
        });
        next.addEventListener('click', function () {
            if (!nextCursor) return;
            cursors = cursors.slice(0, pageIndex + 1);
            cursors.push(nextCursor);
            pageIndex++;
            loadResources();
        });
        document.getElementById('adminMediaPickerUploadButton').addEventListener('click', function () { upload.click(); });
        upload.addEventListener('change', function () {
            if (!upload.files[0]) return;
            clearError();
            const data = new FormData();
            data.append('file', upload.files[0]);
            data.append('folder', activeInput ? inputFolder(activeInput) : 'general');
            data.append('image_only', '1');
            fetch('{{ route('admin.media.upload') }}', {
                method: 'POST',
                headers: { Accept: 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: data,
            })
                .then(async function (response) {
                    const data = await response.json();
                    if (!response.ok) {
                        const validationError = data.errors ? Object.values(data.errors).flat()[0] : null;
                        throw new Error(validationError || data.message || 'Tải ảnh lên không thành công.');
                    }
                    return data;
                })
                .then(function (data) {
                    if (!data.success) throw new Error(data.message || 'Tải ảnh lên không thành công.');
                    loadResources();
                })
                .catch(function (exception) { showError(exception.message); })
                .finally(function () { upload.value = ''; });
        });
    });
</script>
