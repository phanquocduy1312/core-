@php
    $cancelUrl = route('admin.users.index');
@endphp

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    <!-- Left form elements -->
    <div class="lg:col-span-8 space-y-6">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <h4 class="text-base font-bold text-gray-900 mb-4 border-b border-gray-150 pb-2">{{ __('admin.users.sections.general') }}</h4>

            <div class="space-y-4">
                <!-- Name Field -->
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-900" for="name">{{ __('admin.users.fields.name') }} <span class="text-red-500">*</span></label>
                    <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="name" name="name" 
                           value="{{ old('name', $user->name) }}" placeholder="{{ __('admin.users.placeholders.name_placeholder') }}" required>
                    @error('name')
                        <div class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-900" for="email">{{ __('admin.users.fields.email') }} <span class="text-red-500">*</span></label>
                    <input type="email" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="email" name="email" 
                           value="{{ old('email', $user->email) }}" placeholder="email@example.com" required>
                    @error('email')
                        <div class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-900" for="password">{{ __('admin.users.fields.password') }} @if(!$user->exists)<span class="text-red-500">*</span>@endif</label>
                    <input type="password" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="password" name="password" 
                           placeholder="{{ __('admin.users.placeholders.password_placeholder') }}" {{ !$user->exists ? 'required' : '' }}>
                    @if($user->exists)
                        <p class="text-2xs text-gray-400 mt-1 block">{{ __('admin.users.fields.password_help') }}</p>
                    @endif
                    @error('password')
                        <div class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        @include('admin.shared.form-actions', ['cancelUrl' => $cancelUrl])
    </div>

    <!-- Sidebar elements -->
    <div class="lg:col-span-4 space-y-6">
        <!-- Avatar card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 text-center">
            <h4 class="text-base font-bold text-gray-900 mb-4 border-b border-gray-150 pb-2 text-left">{{ __('admin.users.fields.avatar') }}</h4>
            
            <!-- Hidden file input -->
            <input type="file" name="avatar_file" id="user_avatar_file" class="hidden" accept="image/*" data-media-folder="avatars">
            
            <!-- Drag and drop preview container -->
            <div id="user_avatar_preview_container" class="relative mx-auto rounded-full border-2 border-dashed border-gray-300 hover:border-primary w-36 h-36 flex items-center justify-center bg-gray-50 cursor-pointer mb-3 overflow-hidden transition-colors" 
                 onclick="document.getElementById('user_avatar_file').click()">
                
                <img id="user_avatar_preview" src="{{ old('avatar_url', $user->avatar_url) ?: asset('admin-assets/images/profile/user-1.jpg') }}" 
                     class="w-full h-full object-cover">
                
                <div id="user_avatar_placeholder" class="absolute inset-0 bg-slate-900/60 text-white flex flex-col items-center justify-center opacity-0 hover:opacity-100 transition-all">
                    <iconify-icon icon="solar:camera-add-bold-duotone" class="text-3xl"></iconify-icon>
                    <span class="text-2xs mt-1 font-semibold">{{ __('admin.users.placeholders.change_avatar') }}</span>
                </div>
            </div>
            
            <p class="text-2xs text-gray-405">{{ __('admin.users.placeholders.avatar_help') }}</p>
            @error('avatar_file')
                <div class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</div>
            @enderror
        </div>

        <!-- Role & Status Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <h4 class="text-base font-bold text-gray-900 mb-4 border-b border-gray-150 pb-2">{{ __('admin.users.sections.role_status') }}</h4>
            
            <div class="space-y-4">
                <!-- Role Select -->
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-900" for="role_id">{{ __('admin.users.fields.role') }} <span class="text-red-500">*</span></label>
                    <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" id="role_id" name="role_id" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" @selected((string) old('role_id', $user->role_id) === (string) $role->id)>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <div class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status Checkbox -->
                <div class="pt-2">
                    <input type="hidden" name="is_active" value="0">
                    <div class="flex items-center">
                        <input class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" type="checkbox" name="is_active" value="1" id="is_active" @checked(old('is_active', $user->is_active))>
                        <label class="ml-2 text-sm font-semibold text-gray-900 cursor-pointer" for="is_active">
                            {{ __('admin.users.fields.status_active') }}
                        </label>
                    </div>
                    <p class="text-2xs text-gray-400 mt-1 block">{{ __('admin.users.fields.status_help') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Unsaved Changes Modal (Alpine.js Modal Replacement) -->
<div x-data="{ open: false }" 
      @keydown.escape.window="open = false" 
      class="relative z-50" 
      id="unsavedChangesModal"
      style="display: none;"
      x-show="open" 
      x-transition>
    <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-150">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between bg-amber-50/50">
                    <h5 class="text-base font-bold text-amber-800 flex items-center gap-1.5" id="unsavedChangesModalLabel">
                        <iconify-icon icon="solar:danger-triangle-linear" class="text-lg"></iconify-icon>
                        <span>{{ __('admin.users.unsaved.title') }}</span>
                    </h5>
                    <button type="button" @click="open = false" class="text-gray-450 hover:text-gray-650 focus:outline-none">
                        <iconify-icon icon="solar:close-circle-linear" class="text-2xl"></iconify-icon>
                    </button>
                </div>
                <div class="p-6 space-y-4">
                    <p class="text-sm text-gray-700">
                        {{ __('admin.users.unsaved.body') }}
                    </p>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between bg-gray-50/50">
                    <button type="button" @click="open = false" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors border border-gray-300 bg-white text-gray-700 hover:bg-gray-55 px-4 py-2 text-xs">
                        {{ __('catalog.actions.cancel') }}
                    </button>
                    <div class="flex gap-2">
                        <button type="button" id="btn-discard-changes" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors bg-red-600 hover:bg-red-700 text-white px-4 py-2 text-xs">
                            {{ __('admin.users.unsaved.discard') }}
                        </button>
                        <button type="button" id="btn-save-draft" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 text-xs">
                            {{ __('admin.users.unsaved.save_draft') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
