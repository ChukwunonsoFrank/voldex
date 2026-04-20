<div x-data class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:px-96 lg:pt-6">
            <div class="my-3 sticky top-0 bg-dashboard rounded-lg border border-[#323335] z-10 p-3 lg:pt-4">
                <h1 class="text-white mb-2 text-lg md:text-xl lg:text-2xl font-semibold">Verify Your Identity</h1>
                <p class="text-zinc-300 text-xs">For your security and to uniock full access, please complete your
                    verification.</p>
            </div>
            <div class="lg:h-full lg:pb-24 lg:overflow-scroll scrollbar-hide">
                <div class="mb-5 flex gap-x-3 items-center">
                    {{-- <div class="flex-none">
                        @if (!$this->isKycPending && $this->kycStatus === 'Not verified')
                            <span
                                class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-lg text-xs font-semibold bg-[#282828] text-white">
                                Not verified
                            </span>
                        @endif
                        @if ($this->isKycPending && $this->kycStatus === 'Not verified')
                            <span
                                class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-lg text-xs font-semibold bg-[#F59E0B] text-white">
                                Pending Review
                            </span>
                        @endif
                        @if ($this->kycStatus === 'Verified')
                            <span
                                class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-lg text-xs font-semibold bg-green-100 text-green-800">
                                Verified
                            </span>
                        @endif
                    </div> --}}
                    {{-- <div class="flex-1">
                        @if (!$this->isKycPending && $this->kycStatus === 'Not verified')
                            <p class="text-xs text-white">Your current verification level: (Not verified)</p>
                        @endif
                        @if ($this->isKycPending && $this->kycStatus === 'Not verified')
                            <p class="text-xs text-white">Your current verification level: (Pending review)</p>
                        @endif
                        @if ($this->kycStatus === 'Verified')
                            <p class="text-xs text-white">Your current verification level: (Verified)</p>
                        @endif
                    </div> --}}
                </div>

                <div class="mb-5">
                    <label for="input-label" class="block text-sm font-medium mb-2 text-zinc-300">Full name (as it
                        appears
                        on your ID)</label>
                    <div class="relative">
                        <input wire:model="fullname" type="text"
                            class="text-white border border-[#26252a] bg-transparent text-sm peer py-2.5 sm:py-3 px-4 ps-4 block w-full rounded-lg sm:text-sm focus:outline-0"
                            placeholder="">
                    </div>
                </div>

                <div class="mb-5">
                    <label for="input-label" class="block text-sm font-medium mb-2 text-zinc-300">Date of Birth</label>
                    <div class="relative">
                        <input wire:model="dob" type="date"
                            class="appearance-none text-white border border-[#26252a] bg-transparent text-sm peer py-2.5 sm:py-3 px-4 block w-full rounded-lg sm:text-sm focus:outline-0"
                            placeholder="" style="color-scheme: dark;">
                    </div>
                </div>

                <div class="mb-5">
                    <label for="input-label" class="block text-sm font-medium mb-2 text-zinc-300">Nationality</label>
                    <div class="flex-1 md:flex-none relative">
                        <div x-on:click="$store.kycPage.toggleCountrySelect()"
                            class="flex items-center space-x-3 py-3 px-4 border border-[#26252a] bg-transparent rounded-lg text-[#FFFFFF]">
                            <div class="flex-1">
                                <p class="text-sm">{{ $this->selectedCountry }}</p>
                            </div>
                            <div class="flex-none justify-self-end">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-chevron-down-icon lucide-chevron-down">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <div x-cloak x-show="$store.kycPage.isCountrySelectOpen"
                            @click.outside="$store.kycPage.isCountrySelectOpen = false"
                            class="border border-[#26252a] bg-dim absolute rounded-lg w-full h-72 overflow-scroll scrollbar-hide z-10 p-2 mt-1">
                            @foreach ($this->countriesList as $isoCode => $countryName)
                                <div wire:key="country-{{ $isoCode }}"
                                    wire:click="selectCountry('{{ $countryName }}')"
                                    x-on:click="$store.kycPage.isCountrySelectOpen = false"
                                    class="hover:bg-[#3b3a41] cursor-pointer flex items-center space-x-3 px-4 py-2 rounded-md text-[#FFFFFF]">
                                    <div class="flex-1">
                                        <p class="text-sm">{{ $countryName }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="file-upload" class="block text-sm font-medium mb-2 text-zinc-300">Upload Valid
                        ID</label>
                    <div class="relative">
                        <div class="flex items-center gap-x-1">
                            <div>
                                <label for="file-upload"
                                    class="inline-flex items-center gap-x-1 bg-[#40FFDD] text-black text-xs p-2 rounded-lg cursor-pointer">
                                    <div class="-mt-0.5">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.16494 2.33337C8.3754 2.33337 8.58194 2.3903 8.76269 2.49813C8.94343 2.60596 9.09163 2.76067 9.1916 2.94587L9.4751 3.47087C9.57507 3.65608 9.72328 3.81079 9.90402 3.91862C10.0848 4.02645 10.2913 4.08338 10.5018 4.08337H11.6667C11.9761 4.08337 12.2729 4.20629 12.4916 4.42508C12.7104 4.64388 12.8334 4.94062 12.8334 5.25004V10.5C12.8334 10.8095 12.7104 11.1062 12.4916 11.325C12.2729 11.5438 11.9761 11.6667 11.6667 11.6667H2.33335C2.02393 11.6667 1.72719 11.5438 1.5084 11.325C1.2896 11.1062 1.16669 10.8095 1.16669 10.5V5.25004C1.16669 4.94062 1.2896 4.64388 1.5084 4.42508C1.72719 4.20629 2.02393 4.08337 2.33335 4.08337H3.49827C3.70852 4.08339 3.91486 4.02658 4.09548 3.91897C4.27609 3.81136 4.42428 3.65694 4.52435 3.47204L4.8096 2.94471C4.90968 2.75981 5.05786 2.60539 5.23848 2.49778C5.4191 2.39017 5.62544 2.33336 5.83569 2.33337H8.16494Z"
                                                stroke="black" stroke-width="1.33333" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M7 9.33337C7.9665 9.33337 8.75 8.54987 8.75 7.58337C8.75 6.61688 7.9665 5.83337 7 5.83337C6.0335 5.83337 5.25 6.61688 5.25 7.58337C5.25 8.54987 6.0335 9.33337 7 9.33337Z"
                                                stroke="black" stroke-width="1.33333" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <span>Upload ID</span>
                                </label>
                            </div>
                            <div wire:loading wire:target="id">
                                <i class="fa-solid fa-circle-notch fa-spin text-gray-400"></i>
                                <span class="text-xs text-gray-400">Uploading...</span>
                            </div>
                        </div>

                        <input id="file-upload" type="file" wire:model="id" class="hidden" />

                        <div class="mt-1 text-xs text-gray-400" wire:loading.remove wire:target="id">
                            @if ($id)
                                Uploaded
                            @endif
                        </div>
                    </div>
                </div>

                <div>
                    <a wire:click="submitKYCApplication()">
                        <button type="button" wire:loading.attr="disabled"
                            class="py-2.5 cursor-pointer px-4 w-full md:px-6 text-center gap-x-2 text-sm font-semibold rounded-lg bg-accent text-black focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">
                            <i wire:loading class="fa-solid fa-circle-notch fa-spin"></i>
                            <span wire:loading.remove>Get Verified</span>
                        </button>
                    </a>
                </div>

                <div x-cloak x-show="$store.kycPage.isSuccessModalOpen"
                    class="fixed top-0 left-0 h-svh w-full px-4 lg:px-96 pt-6 z-20">
                    <div class="absolute inset-0 h-svh w-full px-4 lg:px-96 pt-6 z-20 bg-dashboard opacity-85">
                    </div>
                    <div class="relative w-full h-full flex items-center justify-center z-30">
                        <div
                            class="max-w-sm mx-8 flex flex-col bg-dashboard border border-[#26252a] rounded-2xl pointer-events-auto">
                            <div class="p-4 pb-5 overflow-y-auto text-center">
                                <div class="flex justify-center mb-4">
                                    <div>
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_17_26)">
                                                <mask id="mask0_17_26" style="mask-type:luminance"
                                                    maskUnits="userSpaceOnUse" x="0" y="0" width="48"
                                                    height="48">
                                                    <path d="M48 0H0V48H48V0Z" fill="white" />
                                                </mask>
                                                <g mask="url(#mask0_17_26)">
                                                    <path
                                                        d="M23.9995 4.00024C35.0454 4.00024 43.9996 12.9542 43.9996 24.0003C43.9996 35.0463 35.0454 44.0002 23.9995 44.0002C12.9535 44.0002 3.99951 35.0463 3.99951 24.0003C3.99951 12.9542 12.9535 4.00024 23.9995 4.00024ZM23.9795 20.0002H21.9995C21.4898 20.0008 20.9995 20.196 20.6288 20.5459C20.2581 20.8959 20.035 21.3742 20.0052 21.883C19.9753 22.3919 20.1409 22.893 20.468 23.2839C20.7952 23.6748 21.2593 23.926 21.7655 23.9862L21.9995 24.0003V33.9802C21.9995 35.0201 22.7875 35.8803 23.7995 35.9883L24.0196 36.0003H24.9995C25.4202 36.0003 25.8302 35.8676 26.171 35.6213C26.512 35.3748 26.7664 35.0273 26.8984 34.628C27.0306 34.2286 27.0333 33.7978 26.9063 33.3968C26.7794 32.9957 26.5293 32.6448 26.1916 32.3943L25.9996 32.2683V22.0202C25.9996 20.9802 25.2114 20.1202 24.1996 20.0122L23.9795 20.0002ZM23.9995 14.0002C23.4691 14.0002 22.9604 14.2109 22.5853 14.586C22.2102 14.9611 21.9995 15.4698 21.9995 16.0002C21.9995 16.5307 22.2102 17.0394 22.5853 17.4144C22.9604 17.7895 23.4691 18.0002 23.9995 18.0002C24.5301 18.0002 25.0386 17.7895 25.4137 17.4144C25.7889 17.0394 25.9996 16.5307 25.9996 16.0002C25.9996 15.4698 25.7889 14.9611 25.4137 14.586C25.0386 14.2109 24.5301 14.0002 23.9995 14.0002Z"
                                                        fill="#40FFDD" />
                                                </g>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_17_26">
                                                    <rect width="48" height="48" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-white font-medium text-base mb-4">
                                    Your details have been received and are now under review. You'll get an update
                                    within 24 hours.
                                </p>
                                <div class="flex justify-center">
                                    <div class="flex-none">
                                        <button type="button" x-on:click="$store.kycPage.isSuccessModalOpen = false;"
                                            wire:click="robot()" type="button"
                                            class="py-3 px-5 text-center text-sm font-semibold rounded-lg border border-transparent bg-accent text-black cursor-pointer hover:bg-accent focus:outline-hidden focus:bg-accent disabled:opacity-50 disabled:pointer-events-none">
                                            Okay
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-x-2 p-3 my-3 bg-dim rounded-lg border border-[#323335]">
                    <div class="flex-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-lock-keyhole-icon lucide-lock-keyhole">
                            <circle cx="12" cy="16" r="1" />
                            <rect x="3" y="10" width="18" height="12" rx="2" />
                            <path d="M7 10V7a5 5 0 0 1 10 0v3" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-[#a4a4a4]">
                            Your data is encrypted and stored securely. Verification is fast, and usually done within 24
                            hours.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('kycPage', {
            isCountrySelectOpen: false,

            isSuccessModalOpen: false,

            toggleCountrySelect() {
                this.isCountrySelectOpen = !this.isCountrySelectOpen
            }
        })
    })
</script>

@script
    <script>
        $wire.on('error-message', (event) => {
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

        $wire.on('success-message', (event) => {
            // Access Alpine store data
            const kycPageStore = Alpine.store('kycPage');

            // Example: open the success modal
            kycPageStore.isSuccessModalOpen = true;
        });
    </script>
@endscript
