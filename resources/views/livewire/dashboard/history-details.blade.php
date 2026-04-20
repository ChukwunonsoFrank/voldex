<div class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:pl-6 lg:pr-4">
            <div class="my-3 sticky top-0 bg-dashboard pb-2 lg:pt-4">
                <h1 class="text-white text-lg md:text-xl lg:text-2xl font-semibold">Trades by Yfxai Scalping Bot</h1>
            </div>
            <div class="lg:h-full pb-14 lg:pb-24 lg:overflow-scroll scrollbar-hide">
                @forelse ($trades as $trade)
                    <div wire:key="bot-trade-{{ $trade['id'] }}"
                        class="bg-dim w-full rounded-lg flex flex-col space-y-2 p-3 px-4 mb-3">
                        <div class="flex items-center gap-x-4">
                            <div class="flex-none">
                                <span
                                    class="inline-flex items-center gap-x-1.5 py-0.5 px-1.5 rounded-md text-[9px] font-medium {{ $trade['sentiment'] === 'BUY' ? 'bg-[#31865b]' : 'bg-[#e32d2d]' }} text-white">{{ $trade['sentiment'] }}</span>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center mb-1.5">
                                    <div class="flex-1">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded-md text-[10px] bg-[#3b3a41] uppercase font-medium text-white">{{ ucfirst($trade['account_type']) }}</span>
                                    </div>
                                    <div class="flex-1 text-end">
                                        <p class="text-[#8d8d8d] text-xs">{{ $trade['created_at_formatted'] }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="flex-1 inline-flex items-center gap-x-1">
                                        <p class="font-semibold text-xs inline text-white md:text-sm">
                                            Traded
                                        </p>
                                        <img class="md:w-7" src="{{ asset($trade['asset_image_url']) }}" alt="">
                                        <p class="font-semibold text-xs inline text-white md:text-sm">
                                            {{ $trade['asset'] }} on
                                        </p>
                                        @if ($this->getAssetClass($trade['asset']) === 'crypto')
                                            <img class="inline-block -mt-0.5 w-9"
                                                src="{{ asset('assets/icons/bybit.svg') }}" alt="bybit-logo">
                                        @endif
                                        @if ($this->getAssetClass($trade['asset']) === 'forex')
                                            <img class="inline" src="{{ asset('assets/icons/xtb.svg') }}"
                                                alt="xtb-logo">
                                        @endif
                                    </div>
                                    <div class="flex-none text-end">
                                        <p class="font-semibold text-sm md:text-base text-green-500">+@money($trade['profit'] / 100)
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
                                <p class="text-xs text-zinc-300">No trade activity yet.</p>
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
