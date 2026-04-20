<div x-data="secret" class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:pl-6 lg:pr-4 text-center">
            <div class="bg-dashboard lg:pt-4">
                <h1 class="text-white my-3 text-lg md:text-xl lg:text-2xl font-semibold">2FA Setup</h1>
                <p class="text-zinc-300 text-xs leading-normal my-3">Scan the QR code below using the Google
                    Authenticator
                    app.</p>
            </div>

            <div class="flex items-center justify-center my-8">
                <div class="size-42 bg-[#FFFFFF] p-2 flex rounded-lg">
                    <div wire:ignore class="size-42" id="qrcode"></div>
                </div>
            </div>

            <div>
                <p class="text-zinc-300 text-xs leading-normal">Can’t scan the QR code? Enter this code into your
                    authenticator app instead.</p>
            </div>

            <div class="mt-8 mb-2">
                <input id="google-2fa-secret" type="text" class="hidden" value="{{ $this->google2faSecret }}">
                <p class="text-white text-2xl font-bold leading-normal">{{ $this->google2faSecret }}</p>
            </div>

            <div class="flex items-center justify-center mb-10">
                <button type="button" x-on:click="copy2faSecret()"
                    class="py-1 px-3 cursor-pointer inline-flex items-center justify-center text-xs font-semibold rounded-lg bg-[#282828] border border-[#323335] text-white focus:outline-hidden">
                    Copy code
                </button>
            </div>

            <div>
                <a href="{{ route('dashboard.security.2fa.verifytwofa') }}">
                    <button type="button"
                        class="py-2.5 cursor-pointer px-4 w-full md:px-6 text-center gap-x-2 text-sm font-semibold rounded-lg bg-accent text-black focus:outline-hidden disabled:pointer-events-none">
                        Next
                    </button>
                </a>
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

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('secret', () => ({
            init() {
                this.generateQRCode()
            },
            generateQRCode() {
                var qrcode = new QRCode("qrcode");
                qrcode.makeCode(this.$wire.qrCodeUrl);
            },
            toast() {
                const toastMarkup = `
                <div class="flex items-center p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4 text-teal-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                        </svg>
                    </div>
                    <div class="ms-3 flex-1">
                        <p class="text-xs font-semibold text-white">Copied</p>
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
            },
            copy2faSecret() {
                var copyText = document.getElementById("google-2fa-secret");
                copyText.select();
                copyText.setSelectionRange(0, 99999); // For mobile devices
                navigator.clipboard.writeText(copyText.value);
                this.toast();
            }
        }))
    })
</script>
