<!-- Role Form Card -->
<div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-6">
    <div>
        <label class="block mb-2 text-sm font-semibold text-gray-900" for="name">{{ __('admin.roles.fields.name') }} <span class="text-red-500">*</span></label>
        <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="name" name="name" value="{{ old('name', $role->name) }}" placeholder="{{ __('admin.roles.fields.name_placeholder') }}" required>
    </div>
    
    <div>
        <label class="block text-sm font-bold text-gray-900 mb-4 border-b border-gray-150 pb-2">{{ __('admin.roles.fields.select_permissions') }}</label>
        <div class="space-y-4">
            @foreach($permissionsByGroup as $group => $permissions)
                <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-2xs">
                    <h6 class="font-bold text-gray-950 mb-3 text-sm flex items-center gap-1.5">
                        <iconify-icon icon="solar:shield-check-linear" class="text-primary text-base"></iconify-icon>
                        <span>{{ ucfirst(str_replace('_', ' ', $group)) }}</span>
                    </h6>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                        @foreach($permissions as $permission)
                            @php($translationKey = 'admin.roles.permissions.'.$permission->code)
                            <div class="p-3 border border-gray-150 rounded-lg bg-gray-50/50 hover:bg-gray-50 transition-colors flex items-center">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input class="sr-only peer" type="checkbox" name="permissions[]" value="{{ $permission->code }}" id="perm_{{ $permission->code }}"
                                        @checked(in_array($permission->code, old('permissions', $role->permissions ?? [])) || in_array('*', $role->permissions ?? []))>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                    <span class="ml-2 text-xs font-semibold text-gray-700 cursor-pointer select-none">
                                        {{ \Illuminate\Support\Facades\Lang::has($translationKey) ? __($translationKey) : $permission->name }}
                                    </span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@include('admin.shared.form-actions', ['cancelUrl' => route('admin.roles.index')])
