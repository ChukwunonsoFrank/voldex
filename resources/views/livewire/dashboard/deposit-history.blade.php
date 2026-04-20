<div class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:pl-6 lg:pr-4">
            <div class="my-3 sticky top-0 bg-dashboard pb-2 lg:pt-4">
                <h1 class="text-white text-lg md:text-xl lg:text-2xl font-semibold">Deposits</h1>
            </div>
            <div class="lg:h-full lg:pb-24 lg:overflow-scroll scrollbar-hide">
                @forelse ($deposits as $deposit)
                    <div wire:key="deposit-{{ $deposit['id'] }}"
                        class="bg-dim w-full rounded-lg flex flex-col space-y-2 p-3 px-4 mb-3">
                        <div class="flex items-center gap-x-4">
                            <div class="flex-none">
                                <img class="w-7"
                                    src="{{ asset('storage/' . $this->getPaymentMethodIconUrl($deposit['payment_method'])) }}"
                                    alt="">
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center mb-1.5">
                                    <div class="flex-1">
                                        <span
                                            class="inline-flex items-center gap-x-1 py-0.5 px-2.5 rounded-md text-[10px] {{ $this->getStatusIndicatorColor($deposit['status']) }} uppercase font-medium text-white"><span
                                                class="size-1 inline-block rounded-full bg-white"></span>{{ ucfirst($deposit['status']) }}</span>
                                    </div>
                                    <div class="flex-1 text-end">
                                        <p class="text-[#8d8d8d] text-xs">{{ $deposit['created_at_formatted'] }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="flex-1 inline-flex items-center gap-x-1">
                                        <p class="font-semibold text-xs inline text-white md:text-sm">
                                            {{ $deposit['payment_method'] }}
                                        </p>
                                    </div>
                                    <div class="flex-1 text-end">
                                        <p class="font-semibold text-sm md:text-base text-green-500">
                                            +@money($deposit['amount'] / 100)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flex justify-center items-center">
                        <div class="bg-dim w-full rounded-lg flex flex-col space-y-2 p-3 mb-3">
                            <div class="text-center">
                                <p class="text-xs text-zinc-300">No deposit activity yet.</p>
                            </div>
                        </div>
                    </div>
                @endforelse
                @if ($showLoadMoreButton)
                    <div class="flex justify-center">
                        <button wire:click="loadMore" wire:loading.attr="disabled" type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-xs font-normal rounded-full border border-gray-400 text-white shadow-2xs cursor-pointer disabled:opacity-50 disabled:pointer-events-none">
                            <span wire:loading.remove wire:target="loadMore">Load more</span>
                            <i wire:loading.remove wire:target="loadMore" class="fas fa-rotate"></i>
                            <i wire:loading class="fas fa-rotate fa-spin"></i>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@script
    <script>
        $wire.on('deposit-created', (event) => {
            const toastMarkup = `
                <div class="flex items-center p-4">
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
                duration: 6000,
                close: true,
                escapeMarkup: false
            }).showToast();
        });
    </script>
@endscript
