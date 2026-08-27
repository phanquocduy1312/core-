@extends('admin.layouts.app')

@section('title', __('admin.notification_settings.title'))

@push('styles')
    <style>
        .is-invalid {
            border-color: #ef4444 !important;
            background-color: #fef2f2 !important;
            --tw-ring-color: rgba(239, 68, 68, 0.2) !important;
        }
    </style>
@endpush

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4">
            <h4 class="text-xl font-bold mb-1">{{ __('admin.notification_settings.title') }}</h4>
            <nav class="flex text-sm text-slate-300" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">{{ __('admin.home') }}</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                            <a href="{{ route('admin.settings.index') }}" class="hover:text-white transition-colors">{{ __('admin.sidebar.settings') }}</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                            <span class="text-slate-400">{{ __('admin.notification_settings.title') }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Notification Settings Form -->
    <form action="{{ route('admin.notification-settings.update') }}" method="POST" id="notificationSettingsForm">
        @csrf

        <div class="grid grid-cols-12 gap-6 mb-8">
            <!-- Left Column: Zalo Settings -->
            <div class="col-span-12 lg:col-span-6 space-y-6">
                <!-- Zalo OA Configuration -->
                <x-admin.card>
                    <x-slot name="header">
                        <div class="flex flex-wrap items-center justify-between w-full gap-4">
                            <div class="flex items-center gap-3">
                                <div class="bg-blue-50 p-2 rounded-lg text-primary flex items-center justify-center">
                                    <iconify-icon icon="solar:chat-round-line-line-duotone" class="text-2xl"></iconify-icon>
                                </div>
                                <h5 class="text-base font-bold text-gray-950">{{ __('admin.notification_settings.zalo_oa.title') }}</h5>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input class="sr-only peer" type="checkbox" name="zalo_oa[enabled]" value="1" id="zalo_oa_enabled" 
                                    @checked(data_get($settings, 'zalo_oa.enabled', false))>
                                <div class="w-9 h-5 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-primary/30 peer-checked:bg-primary cursor-pointer after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-full"></div>
                            </label>
                        </div>
                    </x-slot>

                    <p class="text-xs text-gray-500 mb-4">{{ __('admin.notification_settings.zalo_oa.help') }}</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 zalo-oa-fields">
                        <div>
                            <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="zalo_oa_app_id">{{ __('admin.notification_settings.zalo_oa.app_id') }}</label>
                            <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="zalo_oa_app_id" name="zalo_oa[app_id]" 
                                value="{{ data_get($settings, 'zalo_oa.app_id') }}" placeholder="{{ __('admin.notification_settings.placeholder_enter', ['field' => __('admin.notification_settings.zalo_oa.app_id')]) }}">
                        </div>
                        <div>
                            <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="zalo_oa_template_id">{{ __('admin.notification_settings.zalo_oa.template_id') }}</label>
                            <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="zalo_oa_template_id" name="zalo_oa[template_id]" 
                                value="{{ data_get($settings, 'zalo_oa.template_id') }}" placeholder="{{ __('admin.notification_settings.placeholder_enter', ['field' => __('admin.notification_settings.zalo_oa.template_id')]) }}">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="zalo_oa_secret_key">{{ __('admin.notification_settings.zalo_oa.secret_key') }}</label>
                            <input type="password" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="zalo_oa_secret_key" name="zalo_oa[secret_key]" 
                                value="{{ data_get($settings, 'zalo_oa.secret_key') }}" placeholder="{{ __('admin.notification_settings.placeholder_enter', ['field' => __('admin.notification_settings.zalo_oa.secret_key')]) }}">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="zalo_oa_access_token">{{ __('admin.notification_settings.zalo_oa.access_token') }}</label>
                            <textarea class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="zalo_oa_access_token" name="zalo_oa[access_token]" rows="2" 
                                placeholder="{{ __('admin.notification_settings.placeholder_enter', ['field' => __('admin.notification_settings.zalo_oa.access_token')]) }}">{{ data_get($settings, 'zalo_oa.access_token') }}</textarea>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="zalo_oa_refresh_token">{{ __('admin.notification_settings.zalo_oa.refresh_token') }}</label>
                            <textarea class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="zalo_oa_refresh_token" name="zalo_oa[refresh_token]" rows="2" 
                                placeholder="{{ __('admin.notification_settings.placeholder_enter', ['field' => __('admin.notification_settings.zalo_oa.refresh_token')]) }}">{{ data_get($settings, 'zalo_oa.refresh_token') }}</textarea>
                        </div>
                    </div>
                </x-admin.card>

                <!-- Zalo Personal Configuration -->
                <x-admin.card>
                    <x-slot name="header">
                        <div class="flex flex-wrap items-center justify-between w-full gap-4">
                            <div class="flex items-center gap-3">
                                <div class="bg-emerald-50 p-2 rounded-lg text-emerald-600 flex items-center justify-center">
                                    <iconify-icon icon="solar:phone-calling-line-duotone" class="text-2xl"></iconify-icon>
                                </div>
                                <h5 class="text-base font-bold text-gray-950">{{ __('admin.notification_settings.zalo_personal.title') }}</h5>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input class="sr-only peer" type="checkbox" name="zalo_personal[enabled]" value="1" id="zalo_personal_enabled" 
                                    @checked(data_get($settings, 'zalo_personal.enabled', false))>
                                <div class="w-9 h-5 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-primary/30 peer-checked:bg-primary cursor-pointer after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-full"></div>
                            </label>
                        </div>
                    </x-slot>

                    <p class="text-xs text-gray-500 mb-4">{{ __('admin.notification_settings.zalo_personal.help') }}</p>

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 zalo-personal-fields">
                        <div class="md:col-span-8 space-y-4">
                            <div>
                                <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="zalo_personal_bot_token">{{ __('admin.notification_settings.zalo_personal.bot_token') }}</label>
                                <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="zalo_personal_bot_token" name="zalo_personal[bot_token]" 
                                    value="{{ data_get($settings, 'zalo_personal.bot_token') }}" placeholder="{{ __('admin.notification_settings.zalo_personal.bot_token_placeholder') }}">
                            </div>
                            <div>
                                <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="zalo_personal_chat_id">{{ __('admin.notification_settings.zalo_personal.chat_id') }}</label>
                                <div class="flex">
                                    <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-l-lg border border-r-0 border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="zalo_personal_chat_id" name="zalo_personal[chat_id]" 
                                        value="{{ data_get($settings, 'zalo_personal.chat_id') }}" placeholder="{{ __('admin.notification_settings.zalo_personal.chat_id_placeholder') }}">
                                    <button class="inline-flex items-center px-4 py-2.5 text-sm font-semibold text-white bg-primary hover:bg-primary-hover border border-primary rounded-r-lg focus:outline-none transition-colors" type="button" id="btn_get_zalo_chat_id">
                                        <div class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin mr-1.5 hidden" id="spinner_get_zalo_chat_id"></div>
                                        <iconify-icon icon="solar:refresh-linear" class="mr-1 text-base" id="icon_get_zalo_chat_id"></iconify-icon>
                                        <span id="text_get_zalo_chat_id">{{ __('admin.notification_settings.zalo_personal.get_chat_id') }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="md:col-span-4 flex flex-col items-center justify-center md:border-l md:border-gray-150 md:pl-6 text-center">
                            <p class="text-xs text-gray-500 mb-2 font-semibold">{{ __('admin.notification_settings.zalo_personal.qr_code_help') }}</p>
                            <div class="w-32 h-32 rounded-lg border border-gray-200 p-1 bg-white overflow-hidden flex items-center justify-center">
                                <img src="https://bot.zapps.me/images/zbot-creator_qrcode.jpg" alt="Zalo Bot QR Code" class="max-w-full max-h-full object-cover">
                            </div>
                        </div>
                    </div>
                </x-admin.card>
            </div>

            <!-- Right Column: SMTP & Dashboard Settings -->
            <div class="col-span-12 lg:col-span-6 space-y-6">
                <!-- SMTP Email Configuration -->
                <x-admin.card>
                    <x-slot name="header">
                        <div class="flex flex-wrap items-center justify-between w-full gap-4">
                            <div class="flex items-center gap-3">
                                <div class="bg-indigo-50 p-2 rounded-lg text-indigo-600 flex items-center justify-center">
                                    <iconify-icon icon="solar:letter-line-duotone" class="text-2xl"></iconify-icon>
                                </div>
                                <h5 class="text-base font-bold text-gray-950">{{ __('admin.notification_settings.smtp.title') }}</h5>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input class="sr-only peer" type="checkbox" name="smtp[enabled]" value="1" id="smtp_enabled" 
                                    @checked(data_get($settings, 'smtp.enabled', false))>
                                <div class="w-9 h-5 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-primary/30 peer-checked:bg-primary cursor-pointer after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-full"></div>
                            </label>
                        </div>
                    </x-slot>

                    <p class="text-xs text-gray-500 mb-4">{{ __('admin.notification_settings.smtp.help') }}</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 smtp-fields">
                        <div>
                            <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="smtp_username">{{ __('admin.notification_settings.smtp.username_gmail') }}</label>
                            <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="smtp_username" name="smtp[username]" 
                                value="{{ data_get($settings, 'smtp.username') }}" placeholder="username@gmail.com">
                        </div>
                        <div>
                            <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="smtp_password">{{ __('admin.notification_settings.smtp.password_app') }}</label>
                            <input type="password" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="smtp_password" name="smtp[password]" 
                                value="{{ data_get($settings, 'smtp.password') }}" placeholder="xxxx xxxx xxxx xxxx">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="smtp_owner_email">{{ __('admin.notification_settings.smtp.owner_email_system') }}</label>
                            <input type="email" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="smtp_owner_email" name="smtp[owner_email]" 
                                value="{{ data_get($settings, 'smtp.owner_email') }}" placeholder="{{ __('admin.notification_settings.smtp.owner_email_placeholder') }}">
                        </div>

                        <!-- Advanced Config Toggle -->
                        <div class="md:col-span-2 mt-2" x-data="{ open: false }">
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-500">{{ __('admin.notification_settings.smtp.gmail_hint') }}</span>
                                <button class="inline-flex items-center gap-1 text-xs font-semibold text-primary hover:text-primary-hover focus:outline-none transition-colors" 
                                    type="button" @click="open = !open">
                                    <iconify-icon icon="solar:settings-bold-duotone" class="text-base"></iconify-icon>
                                    {{ __('admin.notification_settings.smtp.advanced_config') }}
                                </button>
                            </div>

                            <!-- Collapsible Technical Fields -->
                            <div x-show="open" x-collapse class="p-4 bg-gray-50 border border-gray-150 rounded-xl mt-3 space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="md:col-span-2">
                                        <label class="block mb-1.5 text-xs font-semibold text-gray-705" for="smtp_host">{{ __('admin.notification_settings.smtp.host') }}</label>
                                        <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="smtp_host" name="smtp[host]" 
                                            value="{{ data_get($settings, 'smtp.host', 'smtp.gmail.com') }}" placeholder="smtp.gmail.com...">
                                    </div>
                                    <div>
                                        <label class="block mb-1.5 text-xs font-semibold text-gray-705" for="smtp_port">{{ __('admin.notification_settings.smtp.port') }}</label>
                                        <input type="number" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="smtp_port" name="smtp[port]" 
                                            value="{{ data_get($settings, 'smtp.port', '465') }}" placeholder="465 / 587">
                                    </div>
                                </div>
                                <div>
                                    <label class="block mb-1.5 text-xs font-semibold text-gray-705" for="smtp_encryption">{{ __('admin.notification_settings.smtp.encryption') }}</label>
                                    <select name="smtp[encryption]" id="smtp_encryption" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                                        <option value="ssl" @selected(data_get($settings, 'smtp.encryption', 'ssl') === 'ssl')>SSL (Port 465)</option>
                                        <option value="tls" @selected(data_get($settings, 'smtp.encryption', 'ssl') === 'tls')>TLS (Port 587)</option>
                                        <option value="none" @selected(data_get($settings, 'smtp.encryption', 'ssl') === 'none')>None (Port 25)</option>
                                    </select>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block mb-1.5 text-xs font-semibold text-gray-705" for="smtp_from_email">{{ __('admin.notification_settings.smtp.from_email') }}</label>
                                        <input type="email" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="smtp_from_email" name="smtp[from_email]" 
                                            value="{{ data_get($settings, 'smtp.from_email') }}" placeholder="noreply@domain.com">
                                    </div>
                                    <div>
                                        <label class="block mb-1.5 text-xs font-semibold text-gray-705" for="smtp_from_name">{{ __('admin.notification_settings.smtp.from_name') }}</label>
                                        <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="smtp_from_name" name="smtp[from_name]" 
                                            value="{{ data_get($settings, 'smtp.from_name', 'Cửa hàng') }}" placeholder="{{ __('admin.notification_settings.placeholder_enter', ['field' => __('admin.notification_settings.smtp.from_name')]) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-admin.card>

                <!-- Dashboard Configuration -->
                <x-admin.card>
                    <x-slot name="header">
                        <div class="flex flex-wrap items-center justify-between w-full gap-4">
                            <div class="flex items-center gap-3">
                                <div class="bg-amber-50 p-2 rounded-lg text-amber-600 flex items-center justify-center">
                                    <iconify-icon icon="solar:bell-bing-line-duotone" class="text-2xl"></iconify-icon>
                                </div>
                                <h5 class="text-base font-bold text-gray-950">{{ __('admin.notification_settings.dashboard.title') }}</h5>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input class="sr-only peer" type="checkbox" name="dashboard[enabled]" value="1" id="dashboard_enabled" 
                                    @checked(data_get($settings, 'dashboard.enabled', true))>
                                <div class="w-9 h-5 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-primary/30 peer-checked:bg-primary cursor-pointer after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-full"></div>
                            </label>
                        </div>
                    </x-slot>

                    <p class="text-xs text-gray-500 mb-4">{{ __('admin.notification_settings.dashboard.help') }}</p>

                    <div class="space-y-4 dashboard-fields">
                        <div class="flex items-center justify-between">
                            <label class="text-sm font-semibold text-gray-900" for="dashboard_play_sound">{{ __('admin.notification_settings.dashboard.play_sound') }}</label>
                            <div class="flex items-center gap-3">
                                <button class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-amber-300 text-amber-600 hover:bg-amber-50 focus:outline-none transition-colors" type="button" onclick="playTestSound()">
                                    <iconify-icon icon="solar:volume-loud-linear" class="text-base"></iconify-icon>
                                </button>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input class="sr-only peer" type="checkbox" name="dashboard[play_sound]" value="1" id="dashboard_play_sound" 
                                        @checked(data_get($settings, 'dashboard.play_sound', true))>
                                    <div class="w-9 h-5 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-primary/30 peer-checked:bg-primary cursor-pointer after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-full"></div>
                                </label>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <label class="text-sm font-semibold text-gray-900" for="dashboard_auto_refresh">{{ __('admin.notification_settings.dashboard.auto_refresh') }}</label>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input class="sr-only peer" type="checkbox" name="dashboard[auto_refresh]" value="1" id="dashboard_auto_refresh" 
                                    @checked(data_get($settings, 'dashboard.auto_refresh', true))>
                                <div class="w-9 h-5 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-primary/30 peer-checked:bg-primary cursor-pointer after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-full"></div>
                            </label>
                        </div>
                    </div>
                </x-admin.card>
            </div>
        </div>
    </form>

    <!-- Hidden Audio element for Sound Testing -->
    <audio id="alertSound" src="https://assets.mixkit.co/active_storage/sfx/2869/2869-84.wav" preload="auto"></audio>
@endsection

@push('scripts')
<script>
    // Auto-unlock audio element on first user interaction
    function unlockAudio() {
        const audio = document.getElementById('alertSound');
        if (audio) {
            audio.play().then(() => {
                audio.pause();
                audio.currentTime = 0;
            }).catch(e => {
                console.log('Audio auto-unlock deferred:', e);
            });
        }
        // Remove listeners after first trigger
        ['click', 'touchstart', 'keydown'].forEach(event => {
            document.removeEventListener(event, unlockAudio);
        });
    }

    ['click', 'touchstart', 'keydown'].forEach(event => {
        document.addEventListener(event, unlockAudio, { passive: true });
    });

    function playTestSound() {
        try {
            const AudioContext = window.AudioContext || window.webkitAudioContext;
            if (!AudioContext) {
                playFallbackAudio();
                return;
            }
            
            const ctx = new AudioContext();
            
            // Ding-Dong sound synthesis
            // Ding (High note)
            const osc1 = ctx.createOscillator();
            const gain1 = ctx.createGain();
            osc1.connect(gain1);
            gain1.connect(ctx.destination);
            osc1.type = 'sine';
            osc1.frequency.setValueAtTime(587.33, ctx.currentTime); // D5
            gain1.gain.setValueAtTime(0, ctx.currentTime);
            gain1.gain.linearRampToValueAtTime(0.15, ctx.currentTime + 0.05);
            gain1.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.6);
            osc1.start(ctx.currentTime);
            osc1.stop(ctx.currentTime + 0.65);
            
            // Dong (Lower note, delayed)
            const osc2 = ctx.createOscillator();
            const gain2 = ctx.createGain();
            osc2.connect(gain2);
            gain2.connect(ctx.destination);
            osc2.type = 'sine';
            osc2.frequency.setValueAtTime(440.00, ctx.currentTime + 0.15); // A4
            gain2.gain.setValueAtTime(0, ctx.currentTime + 0.15);
            gain2.gain.linearRampToValueAtTime(0.12, ctx.currentTime + 0.2);
            gain2.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.85);
            osc2.start(ctx.currentTime + 0.15);
            osc2.stop(ctx.currentTime + 0.9);
            
        } catch (error) {
            console.error('Web Audio play failed, trying fallback:', error);
            playFallbackAudio();
        }
    }

    function playFallbackAudio() {
        const audio = document.getElementById('alertSound');
        if (audio) {
            audio.currentTime = 0;
            audio.play().catch(error => {
                console.error('Fallback audio play failed:', error);
                Swal.fire({
                    icon: 'info',
                    title: "{{ __('admin.notification_settings.sound_test_fail_title') }}",
                    text: "{{ __('admin.notification_settings.sound_test_fail_msg') }}"
                });
            });
        }
    }

    // Client-side channel fields validation config
    const channelFields = {
        'zalo_oa_enabled': [
            { id: 'zalo_oa_app_id', name: "{{ __('admin.notification_settings.zalo_oa.app_id') }}" },
            { id: 'zalo_oa_template_id', name: "{{ __('admin.notification_settings.zalo_oa.template_id') }}" },
            { id: 'zalo_oa_secret_key', name: "{{ __('admin.notification_settings.zalo_oa.secret_key') }}" },
            { id: 'zalo_oa_access_token', name: "{{ __('admin.notification_settings.zalo_oa.access_token') }}" },
            { id: 'zalo_oa_refresh_token', name: "{{ __('admin.notification_settings.zalo_oa.refresh_token') }}" }
        ],
        'zalo_personal_enabled': [
            { id: 'zalo_personal_bot_token', name: "{{ __('admin.notification_settings.zalo_personal.bot_token') }}" },
            { id: 'zalo_personal_chat_id', name: "{{ __('admin.notification_settings.zalo_personal.chat_id') }}" }
        ],
        'smtp_enabled': [
            { id: 'smtp_username', name: "{{ __('admin.notification_settings.smtp.username_gmail') }}" },
            { id: 'smtp_password', name: "{{ __('admin.notification_settings.smtp.password_app') }}" },
            { id: 'smtp_owner_email', name: "{{ __('admin.notification_settings.smtp.owner_email_system') }}" }
        ]
    };

    // Enforce sufficient details when toggling switches ON
    Object.keys(channelFields).forEach(switchId => {
        const toggle = document.getElementById(switchId);
        if (!toggle) return;

        toggle.addEventListener('change', function () {
            if (this.checked) {
                // Zalo channels can only be enabled after support activates the feature.
                const zaloFeatureEnabled = @json($zaloFeatureEnabled ?? true);
                if ((switchId === 'zalo_oa_enabled' || switchId === 'zalo_personal_enabled') && !zaloFeatureEnabled) {
                    this.checked = false;
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi / Error',
                        text: "{{ __('admin.notification_settings.no_package') }}",
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                const emptyFields = [];
                let firstEmptyInput = null;

                channelFields[switchId].forEach(field => {
                    const input = document.getElementById(field.id);
                    if (input && !input.value.trim()) {
                        emptyFields.push(field.name);
                        if (!firstEmptyInput) {
                            firstEmptyInput = input;
                        }
                    }
                });

                if (emptyFields.length > 0) {
                    this.checked = false;
                    
                    Swal.fire({
                        icon: 'warning',
                        title: "{{ __('admin.notification_settings.validation_title') }}",
                        text: "{{ __('admin.notification_settings.validation_msg', ['fields' => '_FIELDS_']) }}".replace('_FIELDS_', emptyFields.join(', ')),
                        confirmButtonText: 'OK'
                    }).then(() => {
                        if (firstEmptyInput) {
                            firstEmptyInput.focus();
                            firstEmptyInput.classList.add('is-invalid');
                            
                            // Remove red outline once user starts typing
                            firstEmptyInput.addEventListener('input', function removeInvalid() {
                                this.classList.remove('is-invalid');
                                this.removeEventListener('input', removeInvalid);
                            });
                        }
                    });
                    return;
                }
            }
            // Auto-save on valid change or disable
            autoSaveSettings();
        });
    });

    // Helper to validate the entire form (checks active channels have required fields)
    function validateForm() {
        let isValid = true;
        for (const switchId of Object.keys(channelFields)) {
            const toggle = document.getElementById(switchId);
            if (toggle && toggle.checked) {
                const emptyFields = [];
                channelFields[switchId].forEach(field => {
                    const input = document.getElementById(field.id);
                    if (input && !input.value.trim()) {
                        emptyFields.push(field.name);
                    }
                });

                if (emptyFields.length > 0) {
                    isValid = false;
                }
            }
        }
        return isValid;
    }

    // AJAX auto-save settings helper
    function autoSaveSettings() {
        if (!validateForm()) {
            return;
        }

        const form = document.getElementById('notificationSettingsForm');
        const actionUrl = form.getAttribute('action');
        const formData = new FormData(form);

        fetch(actionUrl, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            return response.json().then(data => {
                return { ok: response.ok, data };
            }).catch(() => {
                return { ok: response.ok, data: null };
            });
        })
        .then(({ ok, data }) => {
            if (ok && data && data.success) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500,
                    icon: 'success',
                    title: data.message || "{{ __('admin.notification_settings.save_success') }}"
                });
            } else {
                const errMsg = (data && data.message) || 'Không thể lưu cấu hình. Vui lòng thử lại.';
                console.error('Auto-save failed:', errMsg);
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi / Error',
                    text: errMsg,
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.reload();
                });
            }
        })
        .catch(error => {
            console.error('Auto-save connection error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Lỗi kết nối / Connection Error',
                text: 'Không thể kết nối đến máy chủ. Vui lòng thử lại.',
                confirmButtonText: 'OK'
            });
        });
    }

    // Submit listener on form (e.g. if user hits Enter in an input field)
    document.getElementById('notificationSettingsForm').addEventListener('submit', function (e) {
        e.preventDefault();
        autoSaveSettings();
    });

    // Auto-save when input changes or blurs
    document.querySelectorAll('#notificationSettingsForm input:not([type="checkbox"]), #notificationSettingsForm textarea, #notificationSettingsForm select').forEach(input => {
        input.addEventListener('change', function () {
            autoSaveSettings();
        });
    });

    // Auto get Zalo Chat ID
    const btnGetZaloChatId = document.getElementById('btn_get_zalo_chat_id');
    if (btnGetZaloChatId) {
        btnGetZaloChatId.addEventListener('click', function () {
            const botTokenInput = document.getElementById('zalo_personal_bot_token');
            const botToken = botTokenInput ? botTokenInput.value.trim() : '';

            if (!botToken) {
                Swal.fire({
                    icon: 'warning',
                    title: "{{ __('admin.notification_settings.validation_title') }}",
                    text: "{{ __('admin.notification_settings.zalo_personal.token_required') }}"
                });
                if (botTokenInput) {
                    botTokenInput.classList.add('is-invalid');
                    botTokenInput.focus();
                }
                return;
            }

            // Set loading state
            const spinner = document.getElementById('spinner_get_zalo_chat_id');
            const icon = document.getElementById('icon_get_zalo_chat_id');
            const text = document.getElementById('text_get_zalo_chat_id');

            if (spinner) spinner.classList.remove('hidden');
            if (icon) icon.classList.add('hidden');
            if (text) text.textContent = "{{ __('admin.notification_settings.zalo_personal.get_chat_id_loading') }}";
            btnGetZaloChatId.disabled = true;

            fetch("{{ route('admin.notification-settings.get-chat-id') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    bot_token: botToken
                })
            })
            .then(response => {
                return response.json().then(data => {
                    return { ok: response.ok, data };
                });
            })
            .then(({ ok, data }) => {
                // Reset button state
                if (spinner) spinner.classList.add('hidden');
                if (icon) icon.classList.remove('hidden');
                if (text) text.textContent = "{{ __('admin.notification_settings.zalo_personal.get_chat_id') }}";
                btnGetZaloChatId.disabled = false;

                if (!ok || !data.success) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi / Error',
                        text: data.message || "{{ __('admin.notification_settings.zalo_personal.get_chat_id_error') }}"
                    });
                    return;
                }

                if (!data.chats || data.chats.length === 0) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Thông báo / Info',
                        text: data.message || "{{ __('admin.notification_settings.zalo_personal.get_chat_id_empty') }}"
                    });
                    return;
                }

                // Multiple/Single chats found, display selection modal
                let selectHtml = `<p class="mb-3 text-start">{{ __('admin.notification_settings.zalo_personal.get_chat_id_desc') }}</p>`;
                selectHtml += `<select id="swal_chat_id_select" class="form-select text-dark mb-3">`;
                data.chats.forEach(chat => {
                    selectHtml += `<option value="${chat.chat_id}">${chat.display_name} (Chat ID: ${chat.chat_id})</option>`;
                });
                selectHtml += `</select>`;

                Swal.fire({
                    title: "{{ __('admin.notification_settings.zalo_personal.get_chat_id_title') }}",
                    html: selectHtml,
                    showCancelButton: true,
                    confirmButtonText: 'Chọn / Select',
                    cancelButtonText: 'Hủy / Cancel',
                    preConfirm: () => {
                        return document.getElementById('swal_chat_id_select').value;
                    }
                }).then((result) => {
                    if (result.isConfirmed && result.value) {
                        const chatIdInput = document.getElementById('zalo_personal_chat_id');
                        if (chatIdInput) {
                            chatIdInput.value = result.value;
                            chatIdInput.classList.remove('is-invalid');
                            autoSaveSettings();
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error:', error);
                // Reset button state
                if (spinner) spinner.classList.add('hidden');
                if (icon) icon.classList.remove('hidden');
                if (text) text.textContent = "{{ __('admin.notification_settings.zalo_personal.get_chat_id') }}";
                btnGetZaloChatId.disabled = false;

                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi kết nối / Connection Error',
                    text: 'Không thể kết nối đến máy chủ. Vui lòng thử lại.'
                });
            });
        });
    }

    // Clear is-invalid style when user types and auto-retrieve on change
    const botTokenInput = document.getElementById('zalo_personal_bot_token');
    if (botTokenInput) {
        botTokenInput.addEventListener('input', function() {
            this.classList.remove('is-invalid');
        });
        botTokenInput.addEventListener('change', function() {
            checkAndAutoRetrieveChatId();
        });
    }

    function checkAndAutoRetrieveChatId() {
        const botTokenInput = document.getElementById('zalo_personal_bot_token');
        const chatIdInput = document.getElementById('zalo_personal_chat_id');
        if (!botTokenInput || !chatIdInput) return;

        const botToken = botTokenInput.value.trim();
        const chatId = chatIdInput.value.trim();

        if (botToken && !chatId) {
            fetch("{{ route('admin.notification-settings.get-chat-id') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    bot_token: botToken
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.chats && data.chats.length > 0) {
                    if (data.chats.length === 1) {
                        chatIdInput.value = data.chats[0].chat_id;
                        chatIdInput.classList.remove('is-invalid');
                        
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3500,
                            icon: 'success',
                            title: `Tự động nhận diện Chat ID: ${data.chats[0].display_name}`
                        });

                        autoSaveSettings();
                    } else {
                        let selectHtml = `<p class="mb-3 text-start">{{ __('admin.notification_settings.zalo_personal.get_chat_id_desc') }}</p>`;
                        selectHtml += `<select id="swal_chat_id_select" class="form-select text-dark mb-3">`;
                        data.chats.forEach(chat => {
                            selectHtml += `<option value="${chat.chat_id}">${chat.display_name} (Chat ID: ${chat.chat_id})</option>`;
                        });
                        selectHtml += `</select>`;

                        Swal.fire({
                            title: "{{ __('admin.notification_settings.zalo_personal.get_chat_id_title') }}",
                            html: selectHtml,
                            showCancelButton: true,
                            confirmButtonText: 'Chọn / Select',
                            cancelButtonText: 'Hủy / Cancel',
                            preConfirm: () => {
                                return document.getElementById('swal_chat_id_select').value;
                            }
                        }).then((result) => {
                            if (result.isConfirmed && result.value) {
                                chatIdInput.value = result.value;
                                chatIdInput.classList.remove('is-invalid');
                                autoSaveSettings();
                            }
                        });
                    }
                }
            })
            .catch(error => {
                console.error('Background auto-retrieval error:', error);
            });
        }
    }

    // Trigger auto-retrieval on load
    setTimeout(checkAndAutoRetrieveChatId, 500);

    // Auto-sync smtp_username with smtp_from_email for convenience
    const usernameInput = document.getElementById('smtp_username');
    const fromEmailInput = document.getElementById('smtp_from_email');
    if (usernameInput && fromEmailInput) {
        if (!fromEmailInput.value) {
            fromEmailInput.value = usernameInput.value;
        }
        usernameInput.addEventListener('input', function () {
            if (!fromEmailInput.dataset.manual) {
                fromEmailInput.value = this.value;
            }
        });
        fromEmailInput.addEventListener('input', function () {
            this.dataset.manual = 'true';
        });
    }
</script>
@endpush
