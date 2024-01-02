<x-jet-action-section>
    <x-slot name="title">
        {{ __('Sesi Browser') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Kelola dan logout dari sesi aktif Anda di peramban dan perangkat lain.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Jika diperlukan, Anda dapat logout dari semua sesi peramban Anda di semua perangkat. Beberapa sesi terakhir Anda terdaftar di bawah ini; namun, daftar ini mungkin tidak lengkap. Jika Anda merasa akun Anda telah diakses tanpa izin, Anda juga sebaiknya memperbarui kata sandi Anda.') }}
        </div>

        @if (count($this->sessions) > 0)
            <div class="mt-5 space-y-6">
                <!-- Sesi Browser Lainnya -->
                @foreach ($this->sessions as $session)
                    <div class="flex items-center">
                        <div>
                            @if ($session->agent->isDesktop())
                                <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                    <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-gray-500">
                                    <path d="M0 0h24v24H0z" stroke="none"></path><rect x="7" y="4" width="10" height="16" rx="1"></rect><path d="M11 5h2M12 17v.01"></path>
                                </svg>
                            @endif
                        </div>

                        <div class="ml-3">
                            <div class="text-sm text-gray-600">
                                {{ $session->agent->platform() }} - {{ $session->agent->browser() }}
                            </div>

                            <div>
                                <div class="text-xs text-gray-500">
                                    {{ $session->ip_address }},

                                    @if ($session->is_current_device)
                                        <span class="text-green-500 font-semibold">{{ __('Perangkat ini') }}</span>
                                    @else
                                        {{ __('Terakhir aktif') }} {{ $session->last_active }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="flex items-center mt-5">
            <x-jet-button wire:click="confirmLogout" wire:loading.attr="disabled">
                {{ __('Logout dari Sesi Browser Lainnya') }}
            </x-jet-button>

            <x-jet-action-message class="ml-3" on="loggedOut">
                {{ __('Selesai.') }}
            </x-jet-action-message>
        </div>

        <!-- Modal Konfirmasi Logout dari Sesi Browser Lainnya -->
        <x-jet-dialog-modal wire:model="confirmingLogout">
            <x-slot name="title">
                {{ __('Logout dari Sesi Browser Lainnya') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Silakan masukkan kata sandi Anda untuk mengkonfirmasi bahwa Anda ingin logout dari sesi peramban lainnya di semua perangkat Anda.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" class="mt-1 block w-3/4"
                                placeholder="{{ __('Kata Sandi') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="logoutOtherBrowserSessions" />

                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
                    {{ __('Batal') }}
                </x-jet-secondary-button>

                <x-jet-button class="ml-2"
                            wire:click="logoutOtherBrowserSessions"
                            wire:loading.attr="disabled">
                    {{ __('Logout dari Sesi Browser Lainnya') }}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>
