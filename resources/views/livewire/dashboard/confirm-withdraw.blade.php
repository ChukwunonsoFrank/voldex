<div class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:px-96 lg:pt-6">
            <div class="pt-2 lg:h-full lg:pb-24 lg:overflow-scroll scrollbar-hide">
                <div class="flex items-center mb-2">
                    <div class="flex-none">
                        <div wire:click="back()" class="flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left">
                                <path d="m12 19-7-7 7-7" />
                                <path d="M19 12H5" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="p-4 bg-dim rounded-lg border border-[#323335]">
                    <div class="flex items-center gap-x-3 mb-3 text-left pb-2 lg:pt-4">
                        <div class="flex-none">
                            <h1 class="text-white text-lg md:text-xl lg:text-2xl font-bold">Withdraw with
                                <img class="inline-block -mt-1 align-middle" src="{{ Storage::url($this->iconUrl) }}">
                                {{ $this->method }}
                            </h1>
                        </div>
                    </div>

                    <div class="mb-3 text-left">
                        <p class="text-base font-medium text-[#a4a4a4]">Withdrawal Details</p>
                    </div>

                    <div class="mb-4">
                        <p class="text-sm font-semibold text-white mb-2">Amount</p>
                        <div class="flex items-center gap-x-16">
                            <div class="flex-1 text-wrap">
                                <p class="text-white font-light break-words">{{ $this->formatAmountToPay() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="text-sm font-semibold text-white mb-2">Fee</p>
                        <div class="flex items-center gap-x-16">
                            <div class="flex-1 text-wrap">
                                <p class="text-white font-light break-words">
                                    {{ $this->feePercentage }}% ({{ $this->formatFee() }})</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="text-sm font-semibold text-white mb-2">Amount to Receive</p>
                        <div class="flex items-center gap-x-16">
                            <div class="flex-1 text-wrap">
                                <p class="text-white font-light break-words">{{ $this->formatAmountToReceive() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="text-sm font-semibold text-white mb-2">Wallet Address</p>
                        <div class="flex items-center gap-x-16">
                            <div class="flex-1 overflow-x-auto">
                                <p class="text-white font-light break-words whitespace-normal"
                                    style="word-break: break-all;">{{ $this->address }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="md:px-52">
                        <button wire:click="generateOTP()" type="button" wire:loading.attr="disabled"
                            class="py-2.5 cursor-pointer px-4 w-full md:px-6 text-center gap-x-2 text-sm font-semibold rounded-lg bg-accent text-black focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">
                            <i wire:loading class="fa-solid fa-circle-notch fa-spin"></i>
                            <span wire:loading.remove>Confirm</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let lastToast = null;

    function toast(type, message) {
        if (lastToast) {
            lastToast.hideToast();
        }

        let toastMarkup = '';

        if (type === 'info') {
            toastMarkup = `
            <div class="flex items-center p-4">
                <div class="shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                </div>
                <div class="ms-3 flex-1">
                    <p class="text-xs font-semibold text-white">${message}</p>
                </div>
            </div>
        `;
        }

        if (type === 'withdraw-error') {
            toastMarkup = `
            <div class="flex items-center p-4">
                <div class="shrink-0">
                    <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-alert-icon lucide-shield-alert"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>
                </div>
                <div class="ms-3 flex-1">
                    <p class="text-xs font-semibold text-white">${message}</p>
                </div>
            </div>
            `;
        }

        lastToast = Toastify({
            text: toastMarkup,
            className: "hs-toastify-on:opacity-100 opacity-0 absolute top-0 start-1/2 -translate-x-1/2 z-90 w-4/5 md:w-1/2 lg:w-1/4 transition-all duration-300 bg-dim border border-[#26252a] text-sm text-white rounded-xl shadow-lg [&>.toast-close]:hidden",
            duration: 4000,
            close: true,
            escapeMarkup: false
        });

        lastToast.showToast();
    }
</script>

@script
    <script>
        $wire.on('withdraw-error', (event) => {
            toast('withdraw-error', event.message);
        });
    </script>
@endscript
