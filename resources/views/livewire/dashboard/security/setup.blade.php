<div x-data class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:pl-6 lg:pr-4">
            <div class="bg-dashboard lg:pt-4">
                <h1 class="text-white my-3 text-lg md:text-xl lg:text-2xl font-semibold">Security</h1>
            </div>

            <div class="mb-3 lg:grid lg:grid-cols-2 lg:gap-4">
                <div
                    class="bg-dim w-full rounded-lg flex items-center space-x-2 p-3 mb-3 border border-[#323335] lg:mb-0">
                    <div class="flex-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-shield-check-icon lucide-shield-check">
                            <path
                                d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z" />
                            <path d="m9 12 2 2 4-4" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-sm text-white">2FA</p>
                    </div>
                    <div class="flex-none mt-0.5 text-end">
                        @if ($this->is2faEnabled)
                            <p class="font-semibold text-xs text-green-500">Enabled</p>
                        @else
                            <p class="font-semibold text-xs text-red-500">Disabled</p>
                        @endif
                    </div>
                    <div class="flex-none text-end">
                        @if ($this->is2faEnabled)
                            <a href="{{ route('dashboard.security.2fa.disabletwofa') }}">
                                <button type="button"
                                    class="w-full py-1 px-3 cursor-pointer inline-flex items-center justify-center text-[10px] font-semibold rounded-md bg-accent text-black focus:outline-hidden">
                                    Disable
                                </button>
                            </a>
                        @else
                            <button type="button" wire:click="generateSecretKey()"
                                class="w-full py-1 px-3 cursor-pointer inline-flex items-center justify-center text-[10px] font-semibold rounded-md bg-accent text-black focus:outline-hidden">
                                Enable
                            </button>
                        @endif
                    </div>
                </div>

                <a href="{{ route('dashboard.security.changepassword') }}">
                    <div
                        class="bg-dim w-full rounded-lg flex items-center space-x-2 p-3 mb-3 border border-[#323335] lg:mb-0">
                        <div class="flex-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-rectangle-ellipsis-icon lucide-rectangle-ellipsis">
                                <rect width="20" height="12" x="2" y="6" rx="2" />
                                <path d="M12 12h.01" />
                                <path d="M17 12h.01" />
                                <path d="M7 12h.01" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-sm text-white">Change Password</p>
                        </div>
                        <div class="flex-none text-end">
                            <p class="font-medium text-xs text-[#a4a4a4]"></p>
                        </div>
                        <div class="flex-none text-end">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </div>
                    </div>
                </a>

                <div class="p-3 bg-dim rounded-lg border border-[#323335]">
                    <h2 class="text-white text-sm font-bold mb-2">Login Activity</h2>
                    <ul class="space-y-3 list-disc list-inside text-xs">
                        <li class="text-white flex items-center gap-x-1 pl-0">
                            <span class="list-disc list-inside mr-1"
                                style="display:inline-block;width:0.8em;">&#8226;</span>
                            <span class="flex-1">Last Login:
                                {{ auth()->user()->last_login_at }}({{ auth()->user()->country }})</span>
                        </li>
                        <li class="text-white flex items-center gap-x-1 pl-0">
                            <span class="list-disc list-inside mr-1"
                                style="display:inline-block;width:0.8em;">&#8226;</span>
                            <span class="flex-1">IP: {{ auth()->user()->ip_address }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        $wire.on('error', (event) => {
            const toastMarkup = `
                <div class="flex items-start p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-alert-icon lucide-shield-alert"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>
                    </div>
                    <div class="ms-3 flex-1">
                        <p class="text-xs font-semibold text-white">${event.message}</p>
                    </div>
                </div>
            `;

            Toastify({
                text: toastMarkup,
                className: "hs-toastify-on:opacity-100 opacity-0 absolute top-0 start-1/2 -translate-x-1/2 z-90 w-4/5 md:w-1/2 lg:w-1/4 transition-all duration-300 bg-dim border border-[#26252a] text-sm text-white rounded-xl shadow-lg [&>.toast-close]:hidden",
                duration: 4000,
                close: true,
                escapeMarkup: false
            }).showToast();
        });

        $wire.on('message', (event) => {
            const toastMarkup = `
                <div class="flex items-start p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4 text-teal-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>
                    </div>
                    <div class="ms-3 flex-1">
                        <p class="text-xs font-semibold text-white">${event.message}</p>
                    </div>
                </div>
            `;

            Toastify({
                text: toastMarkup,
                className: "hs-toastify-on:opacity-100 opacity-0 absolute top-0 start-1/2 -translate-x-1/2 z-90 w-4/5 md:w-1/2 lg:w-1/4 transition-all duration-300 bg-dim border border-[#26252a] text-sm text-white rounded-xl shadow-lg [&>.toast-close]:hidden",
                duration: 4000,
                close: true,
                escapeMarkup: false
            }).showToast();
        });
    </script>
@endscript
