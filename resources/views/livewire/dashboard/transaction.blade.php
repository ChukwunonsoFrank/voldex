<div class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:pl-6 lg:pr-4">
            <div class="my-3 sticky top-0 bg-dashboard pb-2 lg:pt-4">
                <h1 class="text-white text-lg md:text-xl lg:text-2xl font-semibold">Transactions</h1>
            </div>
            <div class="lg:h-full lg:pb-24 lg:overflow-scroll scrollbar-hide">
                <nav class="flex gap-x-1" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                    <button type="button"
                        class="hs-tab-active:bg-accent hs-tab-active:text-black hs-tab-active:hover:text-black py-1.5 px-4 inline-flex items-center gap-x-2 text-white bg-dim border border-[#323335] text-sm font-medium text-center hover:text-accent focus:outline-hidden focus:text-accent rounded-full disabled:opacity-50 disabled:pointer-events-none {{ $this->activeTab === 'all' ? 'active' : '' }}"
                        id="pills-with-brand-color-item-1" data-hs-tab="#pills-with-brand-color-1"
                        aria-controls="pills-with-brand-color-1" role="tab">
                        All
                    </button>
                    <button type="button"
                        class="hs-tab-active:bg-accent hs-tab-active:text-black hs-tab-active:hover:text-black py-1.5 px-4 inline-flex items-center gap-x-2 text-white bg-dim border border-[#323335] text-sm font-medium text-center hover:text-accent focus:outline-hidden focus:text-accent rounded-full disabled:opacity-50 disabled:pointer-events-none {{ $this->activeTab === 'deposits' ? 'active' : '' }}"
                        id="pills-with-brand-color-item-2" data-hs-tab="#pills-with-brand-color-2"
                        aria-controls="pills-with-brand-color-2" role="tab">
                        Deposits
                    </button>
                    <button type="button"
                        class="hs-tab-active:bg-accent hs-tab-active:text-black hs-tab-active:hover:text-black py-1.5 px-4 inline-flex items-center gap-x-2 text-white bg-dim border border-[#323335] text-sm font-medium text-center hover:text-accent focus:outline-hidden focus:text-accent rounded-full disabled:opacity-50 disabled:pointer-events-none {{ $this->activeTab === 'withdrawals' ? 'active' : '' }}"
                        id="pills-with-brand-color-item-3" data-hs-tab="#pills-with-brand-color-3"
                        aria-controls="pills-with-brand-color-3" role="tab">
                        Withdrawals
                    </button>
                </nav>

                <div class="mt-3">
                    <div id="pills-with-brand-color-1" class="{{ $this->activeTab === 'all' ? '' : 'hidden' }}"
                        role="tabpanel" aria-labelledby="pills-with-brand-color-item-1">
                        @forelse ($transactions as $transaction)
                            <div wire:key="transaction-{{ $transaction['id'] }}"
                                class="bg-dim w-full rounded-lg flex flex-col space-y-2 p-3 px-4 mb-3">
                                <div class="flex items-start gap-x-3">
                                    <div class="flex-none">
                                        <img class="w-7"
                                            src="{{ asset('storage/' . $this->getPaymentMethodIconUrl($transaction['payment_method'])) }}"
                                            alt="">
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center">
                                            <div class="flex-1">
                                                <p class="text-white text-xs font-semibold">{{ $transaction['type'] }}
                                                </p>
                                            </div>
                                            <div class="flex-1 text-end">
                                                <p class="font-semibold text-sm md:text-base text-white">
                                                    @money($transaction['amount'] / 100)
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center my-0.5">
                                            <div class="flex-none">
                                                <p class="text-[#a4a4a4] text-xs font-semibold">
                                                    {{ $transaction['payment_method'] }}
                                                </p>
                                            </div>
                                            @if ($transaction['type'] === 'Withdrawal')
                                                <div class="flex-1 inline-flex items-center justify-end gap-x-2">
                                                    <p class="font-normal text-xs text-white">
                                                        <input
                                                            id="transaction-{{ $transaction['type'] }}-{{ $transaction['id'] }}"
                                                            type="text" class="hidden"
                                                            value="{{ $transaction['address'] }}">
                                                        Wallet:
                                                        {{ strlen($transaction['address']) > 9 ? substr($transaction['address'], 0, 4) . '...' . substr($transaction['address'], -5) : $transaction['address'] }}
                                                    </p>
                                                    <svg x-on:click="$store.transactionPage.copyAddress('transaction-{{ $transaction['type'] }}-{{ $transaction['id'] }}')"
                                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="#ffffff"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-copy-icon lucide-copy">
                                                        <rect width="14" height="14" x="8" y="8" rx="2"
                                                            ry="2" />
                                                        <path
                                                            d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex items-center">
                                            <div class="flex-1">
                                                <p class="font-semibold text-xs inline text-white md:text-sm">
                                                <p class="text-[#a4a4a4] text-xs">
                                                    {{ $transaction['created_at_formatted'] }}
                                                </p>
                                            </div>
                                            <div class="flex-1 text-end">
                                                <span
                                                    class="inline-flex items-center gap-x-1 py-0.5 px-2.5 rounded-md text-[10px] {{ $this->getStatusIndicatorColor($transaction['status']) }} uppercase font-medium text-white"><span
                                                        class="size-1 inline-block rounded-full bg-white"></span>{{ ucfirst($transaction['status']) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="flex justify-center items-center">
                                <div class="bg-dim w-full rounded-lg flex flex-col space-y-2 p-3 mb-3">
                                    <div class="text-center">
                                        <p class="text-xs text-zinc-300">No transaction activity yet.</p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                        @if ($showTransactionsLoadMoreButton)
                            <div class="flex justify-center">
                                <button wire:click="loadMoreTransactions" wire:loading.attr="disabled" type="button"
                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-xs font-normal rounded-full border border-gray-400 text-white shadow-2xs cursor-pointer disabled:opacity-50 disabled:pointer-events-none">
                                    <span wire:loading.remove wire:target="loadMoreTransactions">Load more</span>
                                    <i wire:loading.remove wire:target="loadMoreTransactions" class="fas fa-rotate"></i>
                                    <i wire:loading class="fas fa-rotate fa-spin"></i>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div id="pills-with-brand-color-2" class="{{ $this->activeTab === 'deposits' ? '' : 'hidden' }}"
                        role="tabpanel" aria-labelledby="pills-with-brand-color-item-2">
                        @forelse ($deposits as $deposit)
                            <div wire:key="deposit-{{ $deposit['id'] }}"
                                class="bg-dim w-full rounded-lg flex flex-col space-y-2 p-3 px-4 mb-3">
                                <div class="flex items-start gap-x-3">
                                    <div class="flex-none">
                                        <img class="w-7"
                                            src="{{ asset('storage/' . $this->getPaymentMethodIconUrl($deposit['payment_method'])) }}"
                                            alt="">
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center">
                                            <div class="flex-1">
                                                <p class="text-white text-xs font-semibold">Deposit
                                                </p>
                                            </div>
                                            <div class="flex-1 text-end">
                                                <p class="font-semibold text-sm md:text-base text-white">
                                                    @money($deposit['amount'] / 100)
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center my-0.5">
                                            <div class="flex-1">
                                                <p class="text-[#a4a4a4] text-xs font-semibold">
                                                    {{ $deposit['payment_method'] }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="flex-1">
                                                <p class="font-semibold text-xs inline text-white md:text-sm">
                                                <p class="text-[#a4a4a4] text-xs">
                                                    {{ $deposit['created_at_formatted'] }}
                                                </p>
                                            </div>
                                            <div class="flex-1 text-end">
                                                <span
                                                    class="inline-flex items-center gap-x-1 py-0.5 px-2.5 rounded-md text-[10px] {{ $this->getStatusIndicatorColor($deposit['status']) }} uppercase font-medium text-white"><span
                                                        class="size-1 inline-block rounded-full bg-white"></span>{{ ucfirst($deposit['status']) }}</span>
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
                        @if ($showDepositsLoadMoreButton)
                            <div class="flex justify-center">
                                <button wire:click="loadMoreDeposits" wire:loading.attr="disabled" type="button"
                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-xs font-normal rounded-full border border-gray-400 text-white shadow-2xs cursor-pointer disabled:opacity-50 disabled:pointer-events-none">
                                    <span wire:loading.remove wire:target="loadMoreDeposits">Load more</span>
                                    <i wire:loading.remove wire:target="loadMoreDeposits" class="fas fa-rotate"></i>
                                    <i wire:loading class="fas fa-rotate fa-spin"></i>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div id="pills-with-brand-color-3"
                        class="{{ $this->activeTab === 'withdrawals' ? '' : 'hidden' }}" role="tabpanel"
                        aria-labelledby="pills-with-brand-color-item-3">
                        @forelse ($withdrawals as $withdrawal)
                            <div wire:key="withdrawal-{{ $withdrawal['id'] }}"
                                class="bg-dim w-full rounded-lg flex flex-col space-y-2 p-3 px-4 mb-3">
                                <div class="flex items-start gap-x-3">
                                    <div class="flex-none">
                                        <img class="w-7"
                                            src="{{ asset('storage/' . $this->getPaymentMethodIconUrl($withdrawal['payment_method'])) }}"
                                            alt="">
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center">
                                            <div class="flex-1">
                                                <p class="text-white text-xs font-semibold">Withdrawal
                                                </p>
                                            </div>
                                            <div class="flex-1 text-end">
                                                <p class="font-semibold text-sm md:text-base text-white">
                                                    @money($withdrawal['amount'] / 100)
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center my-0.5">
                                            <div class="flex-none">
                                                <p class="text-[#a4a4a4] text-xs font-semibold">
                                                    {{ $withdrawal['payment_method'] }}
                                                </p>
                                            </div>
                                            <div class="flex-1 inline-flex items-center justify-end gap-x-2">
                                                <p class="font-normal text-xs text-white">
                                                    <input id="withdrawal-{{ $withdrawal['id'] }}" type="text"
                                                        class="hidden" value="{{ $withdrawal['address'] }}">
                                                    Wallet:
                                                    {{ strlen($withdrawal['address']) > 9 ? substr($withdrawal['address'], 0, 4) . '...' . substr($withdrawal['address'], -5) : $withdrawal['address'] }}
                                                </p>
                                                <svg x-on:click="$store.transactionPage.copyAddress('withdrawal-{{ $withdrawal['id'] }}')"
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="#ffffff"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-copy-icon lucide-copy">
                                                    <rect width="14" height="14" x="8" y="8" rx="2"
                                                        ry="2" />
                                                    <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="flex-1">
                                                <p class="font-semibold text-xs inline text-white md:text-sm">
                                                <p class="text-[#a4a4a4] text-xs">
                                                    {{ $withdrawal['created_at_formatted'] }}
                                                </p>
                                            </div>
                                            <div class="flex-1 text-end">
                                                <span
                                                    class="inline-flex items-center gap-x-1 py-0.5 px-2.5 rounded-md text-[10px] {{ $this->getStatusIndicatorColor($withdrawal['status']) }} uppercase font-medium text-white"><span
                                                        class="size-1 inline-block rounded-full bg-white"></span>{{ ucfirst($withdrawal['status']) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="flex justify-center items-center">
                                <div class="bg-dim w-full rounded-lg flex flex-col space-y-2 p-3 mb-3">
                                    <div class="text-center">
                                        <p class="text-xs text-zinc-300">No withdrawal activity yet.</p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                        @if ($showWithdrawalsLoadMoreButton)
                            <div class="flex justify-center">
                                <button wire:click="loadMoreWithdrawals" wire:loading.attr="disabled" type="button"
                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-xs font-normal rounded-full border border-gray-400 text-white shadow-2xs cursor-pointer disabled:opacity-50 disabled:pointer-events-none">
                                    <span wire:loading.remove wire:target="loadMoreWithdrawals">Load more</span>
                                    <i wire:loading.remove wire:target="loadMoreWithdrawals"
                                        class="fas fa-rotate"></i>
                                    <i wire:loading class="fas fa-rotate fa-spin"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        let depositTabButton = document.getElementById('pills-with-brand-color-item-2');
        let withdrawalTabButton = document.getElementById('pills-with-brand-color-item-3');
        let transactionsTabPane = document.getElementById('pills-with-brand-color-1');

        depositTabButton.addEventListener('click', () => {
            transactionsTabPane.classList.add('hidden');
        });

        withdrawalTabButton.addEventListener('click', () => {
            transactionsTabPane.classList.add('hidden');
        });

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

<script>
    let lastToast = null;

    function toastCopied() {
        if (lastToast) {
            lastToast.hideToast();
        }

        const copiedToastMarkup = `
            <div class="flex items-center p-4">
                <div class="shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                </div>
                <div class="ms-3 flex-1">
                    <p class="text-xs font-semibold text-white">Copied</p>
                </div>
            </div>
        `;

        lastToast = Toastify({
            text: copiedToastMarkup,
            className: "hs-toastify-on:opacity-100 opacity-0 absolute top-0 start-1/2 -translate-x-1/2 z-90 w-4/5 md:w-1/2 lg:w-1/4 transition-all duration-300 bg-dim border border-[#26252a] text-sm text-white rounded-xl shadow-lg [&>.toast-close]:hidden",
            duration: 4000,
            close: true,
            escapeMarkup: false
        });

        lastToast.showToast();
    }

    document.addEventListener('alpine:init', () => {
        Alpine.store('transactionPage', {
            copyAddress(id) {
                var copyText = document.getElementById(id);
                copyText.select();
                copyText.setSelectionRange(0, 99999); // For mobile devices
                navigator.clipboard.writeText(copyText.value);
                toastCopied();
            }
        })
    })
</script>
