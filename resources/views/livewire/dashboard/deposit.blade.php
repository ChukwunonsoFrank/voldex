<div x-data class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:px-96 lg:pt-6">
            <div class="my-3 sticky top-0 bg-dashboard z-10 pb-2 lg:pt-4">
                <h1 class="text-white text-lg md:text-xl lg:text-2xl font-semibold">Deposit Now</h1>
            </div>
            <div class="lg:h-full lg:pb-24 lg:overflow-scroll scrollbar-hide">
                <div class="mb-4">
                    <label for="input-label" class="block text-xs font-medium mb-2 text-zinc-300">Enter Amount</label>
                    <div class="relative">
                        <input wire:model="amount" x-model="$store.depositPage.amount" type="text"
                            @input.debounce.1000ms="$store.depositPage.togglePaymentMethodSelect($wire)"
                            class="text-white border border-[#26252a] bg-transparent text-sm peer py-3.5 px-4 ps-11 block w-full rounded-lg sm:text-sm focus:outline-0 placeholder:text-zinc-500"
                            placeholder="0.00">
                        <div
                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                            <p class="text-white text-sm font-semibold">$</p>
                        </div>
                    </div>
                    <p class="text-[10px] text-zinc-500 font-medium mt-1 ml-1">Minimum deposit is $100</p>
                </div>

                <div x-cloak x-show="$store.depositPage.isPaymentMethodSelectVisible" class="mb-5">
                    <label for="input-label" class="block text-xs font-medium mb-2 text-zinc-300">Crypto</label>

                    <div class="w-full overflow-scroll scrollbar-hide">
                        <div wire:click="selectPaymentMethod('bitcoin')"
                            @click="$store.depositPage.proceedToDepositConfirmation($wire)"
                            class="{{ $this->selectedPaymentMethodSlug === 'bitcoin' ? 'border-3 border-[#1E90FF]' : 'border border-[#26252a]' }} bg-dim hover:bg-[#3b3a41] cursor-pointer flex items-center space-x-2 px-4 py-7 mb-1.5 rounded-md text-[#FFFFFF]">
                            <div class="flex-none">
                                <img src="{{ Storage::url('payment-method-icon/btc.svg') }}">
                            </div>
                            <div class="flex-1">
                                <p class="text-sm">Bitcoin</p>
                            </div>
                        </div>

                        <div wire:click="selectPaymentMethod('ethereum')"
                            @click="$store.depositPage.proceedToDepositConfirmation($wire)"
                            class="{{ $this->selectedPaymentMethodSlug === 'ethereum' ? 'border-3 border-[#1E90FF]' : 'border border-[#26252a]' }} bg-dim hover:bg-[#3b3a41] cursor-pointer flex items-center space-x-2 px-4 py-7 mb-1.5 rounded-md text-[#FFFFFF]">
                            <div class="flex-none">
                                <img src="{{ Storage::url('payment-method-icon/eth.svg') }}">
                            </div>
                            <div class="flex-1">
                                <p class="text-sm">Ethereum</p>
                            </div>
                        </div>

                        {{-- USDT --}}
                        <div class="relative">
                            <div x-on:click="$store.depositPage.toggleUSDTNetworksDropdown()"
                                class="border border-[#26252a] bg-dim hover:bg-[#3b3a41] cursor-pointer flex items-center space-x-2 px-4 py-7 mb-1.5 rounded-md text-[#FFFFFF]">
                                <div class="flex-none">
                                    <template x-if="!$store.depositPage.isUSDTNetworksDropdownOpen">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-chevron-down-icon lucide-chevron-down">
                                            <path d="m6 9 6 6 6-6" />
                                        </svg>
                                    </template>
                                    <template x-if="$store.depositPage.isUSDTNetworksDropdownOpen">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-chevron-up-icon lucide-chevron-up">
                                            <path d="m18 15-6-6-6 6" />
                                        </svg>
                                    </template>
                                </div>
                                <div class="flex-none">
                                    <img src="{{ Storage::url('payment-method-icon/usdt.svg') }}">
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm">USDT</p>
                                </div>
                                <div class="flex-none">
                                    <img class="inline-block"
                                        src="{{ Storage::url('payment-method-icon/an-trc20.svg') }}">
                                    <img class="inline-block -ml-1.5"
                                        src="{{ Storage::url('payment-method-icon/an-erc20.svg') }}">
                                    <img class="inline-block -ml-1.5"
                                        src="{{ Storage::url('payment-method-icon/an-bep20.svg') }}">
                                    <img class="inline-block -ml-1.5"
                                        src="{{ Storage::url('payment-method-icon/an-sol.svg') }}">
                                    <img class="inline-block -ml-1.5"
                                        src="{{ Storage::url('payment-method-icon/an-polygon.svg') }}">
                                </div>
                            </div>
                        </div>

                        <div class="relative pl-3" x-cloak x-show="$store.depositPage.isUSDTNetworksDropdownOpen">
                            <div wire:click="selectPaymentMethod('usdt-trc20')"
                                @click="$store.depositPage.proceedToDepositConfirmation($wire)"
                                class="{{ $this->selectedPaymentMethodSlug === 'usdt-trc20' ? 'border-3 border-[#1E90FF]' : 'border border-[#26252a]' }} bg-dim hover:bg-[#3b3a41] cursor-pointer flex items-center space-x-2 px-4 py-4.5 mb-1.5 rounded-md text-[#FFFFFF]">
                                <div class="flex-none">
                                    <img src="{{ Storage::url('payment-method-icon/usdt-trc20.svg') }}">
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm">USDT</p>
                                    <p class="text-[10px] text-[#a4a4a4]">Tron (TRC20)</p>
                                </div>
                            </div>
                            <div wire:click="selectPaymentMethod('usdt-bep20')"
                                @click="$store.depositPage.proceedToDepositConfirmation($wire)"
                                class="{{ $this->selectedPaymentMethodSlug === 'usdt-bep20' ? 'border-3 border-[#1E90FF]' : 'border border-[#26252a]' }} bg-dim hover:bg-[#3b3a41] cursor-pointer flex items-center space-x-2 px-4 py-4.5 mb-1.5 rounded-md text-[#FFFFFF]">
                                <div class="flex-none">
                                    <img src="{{ Storage::url('payment-method-icon/usdt-bep20.svg') }}">
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm">USDT</p>
                                    <p class="text-[10px] text-[#a4a4a4]">BNB (BEP20)</p>
                                </div>
                            </div>
                            <div wire:click="selectPaymentMethod('usdt-erc20')"
                                @click="$store.depositPage.proceedToDepositConfirmation($wire)"
                                class="{{ $this->selectedPaymentMethodSlug === 'usdt-erc20' ? 'border-3 border-[#1E90FF]' : 'border border-[#26252a]' }} bg-dim hover:bg-[#3b3a41] cursor-pointer flex items-center space-x-2 px-4 py-4.5 mb-1.5 rounded-md text-[#FFFFFF]">
                                <div class="flex-none">
                                    <img src="{{ Storage::url('payment-method-icon/usdt-erc20.svg') }}">
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm">USDT</p>
                                    <p class="text-[10px] text-[#a4a4a4]">Eth (ERC20)</p>
                                </div>
                            </div>
                            <div wire:click="selectPaymentMethod('usdt-polygon')"
                                @click="$store.depositPage.proceedToDepositConfirmation($wire)"
                                class="{{ $this->selectedPaymentMethodSlug === 'usdt-polygon' ? 'border-3 border-[#1E90FF]' : 'border border-[#26252a]' }} bg-dim hover:bg-[#3b3a41] cursor-pointer flex items-center space-x-2 px-4 py-4.5 mb-1.5 rounded-md text-[#FFFFFF]">
                                <div class="flex-none">
                                    <img src="{{ Storage::url('payment-method-icon/usdt-polygon.svg') }}">
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm">USDT</p>
                                    <p class="text-[10px] text-[#a4a4a4]">Polygon (Polygon)</p>
                                </div>
                            </div>
                            <div wire:click="selectPaymentMethod('usdt-sol')"
                                @click="$store.depositPage.proceedToDepositConfirmation($wire)"
                                class="{{ $this->selectedPaymentMethodSlug === 'usdt-sol' ? 'border-3 border-[#1E90FF]' : 'border border-[#26252a]' }} bg-dim hover:bg-[#3b3a41] cursor-pointer flex items-center space-x-2 px-4 py-4.5 mb-1.5 rounded-md text-[#FFFFFF]">
                                <div class="flex-none">
                                    <img src="{{ Storage::url('payment-method-icon/usdt-sol.svg') }}">
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm">USDT</p>
                                    <p class="text-[10px] text-[#a4a4a4]">Solana (SOL)</p>
                                </div>
                            </div>
                        </div>

                        {{-- USDC --}}
                        <div class="relative">
                            <div x-on:click="$store.depositPage.toggleUSDCNetworksDropdown()"
                                class="border border-[#26252a] bg-dim hover:bg-[#3b3a41] cursor-pointer flex items-center space-x-2 px-4 py-7 mb-1.5 rounded-md text-[#FFFFFF]">
                                <div class="flex-none">
                                    <template x-if="!$store.depositPage.isUSDCNetworksDropdownOpen">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-chevron-down-icon lucide-chevron-down">
                                            <path d="m6 9 6 6 6-6" />
                                        </svg>
                                    </template>
                                    <template x-if="$store.depositPage.isUSDCNetworksDropdownOpen">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-chevron-up-icon lucide-chevron-up">
                                            <path d="m18 15-6-6-6 6" />
                                        </svg>
                                    </template>
                                </div>
                                <div class="flex-none">
                                    <img src="{{ Storage::url('payment-method-icon/usdc.svg') }}">
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm">USDC</p>
                                </div>
                                <div class="flex-none">
                                    <img class="inline-block"
                                        src="{{ Storage::url('payment-method-icon/an-trc20.svg') }}">
                                    <img class="inline-block -ml-1.5"
                                        src="{{ Storage::url('payment-method-icon/an-erc20.svg') }}">
                                    <img class="inline-block -ml-1.5"
                                        src="{{ Storage::url('payment-method-icon/an-bep20.svg') }}">
                                    <img class="inline-block -ml-1.5"
                                        src="{{ Storage::url('payment-method-icon/an-sol.svg') }}">
                                    <img class="inline-block -ml-1.5"
                                        src="{{ Storage::url('payment-method-icon/an-polygon.svg') }}">
                                </div>
                            </div>
                        </div>

                        <div class="relative pl-3" x-cloak x-show="$store.depositPage.isUSDCNetworksDropdownOpen">
                            <div wire:click="selectPaymentMethod('usdc-erc20')"
                                @click="$store.depositPage.proceedToDepositConfirmation($wire)"
                                class="{{ $this->selectedPaymentMethodSlug === 'usdc-erc20' ? 'border-3 border-[#1E90FF]' : 'border border-[#26252a]' }} bg-dim hover:bg-[#3b3a41] cursor-pointer flex items-center space-x-2 px-4 py-4.5 mb-1.5 rounded-md text-[#FFFFFF]">
                                <div class="flex-none">
                                    <img src="{{ Storage::url('payment-method-icon/usdc-erc20.svg') }}">
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm">USDC</p>
                                    <p class="text-[10px] text-[#a4a4a4]">Eth (ERC20)</p>
                                </div>
                            </div>
                            <div wire:click="selectPaymentMethod('usdc-bep20')"
                                @click="$store.depositPage.proceedToDepositConfirmation($wire)"
                                class="{{ $this->selectedPaymentMethodSlug === 'usdc-bep20' ? 'border-3 border-[#1E90FF]' : 'border border-[#26252a]' }} bg-dim hover:bg-[#3b3a41] cursor-pointer flex items-center space-x-2 px-4 py-4.5 mb-1.5 rounded-md text-[#FFFFFF]">
                                <div class="flex-none">
                                    <img src="{{ Storage::url('payment-method-icon/usdc-bep20.svg') }}">
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm">USDC</p>
                                    <p class="text-[10px] text-[#a4a4a4]">BNB (BEP20)</p>
                                </div>
                            </div>
                            <div wire:click="selectPaymentMethod('usdc-sol')"
                                @click="$store.depositPage.proceedToDepositConfirmation($wire)"
                                class="{{ $this->selectedPaymentMethodSlug === 'usdc-sol' ? 'border-3 border-[#1E90FF]' : 'border border-[#26252a]' }} bg-dim hover:bg-[#3b3a41] cursor-pointer flex items-center space-x-2 px-4 py-4.5 mb-1.5 rounded-md text-[#FFFFFF]">
                                <div class="flex-none">
                                    <img src="{{ Storage::url('payment-method-icon/usdc-sol.svg') }}">
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm">USDC</p>
                                    <p class="text-[10px] text-[#a4a4a4]">Solana (SOL)</p>
                                </div>
                            </div>
                            <div wire:click="selectPaymentMethod('usdc-trc20')"
                                @click="$store.depositPage.proceedToDepositConfirmation($wire)"
                                class="{{ $this->selectedPaymentMethodSlug === 'usdc-trc20' ? 'border-3 border-[#1E90FF]' : 'border border-[#26252a]' }} bg-dim hover:bg-[#3b3a41] cursor-pointer flex items-center space-x-2 px-4 py-4.5 mb-1.5 rounded-md text-[#FFFFFF]">
                                <div class="flex-none">
                                    <img src="{{ Storage::url('payment-method-icon/usdc-trc20.svg') }}">
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm">USDC</p>
                                    <p class="text-[10px] text-[#a4a4a4]">Tron (TRC20)</p>
                                </div>
                            </div>
                            <div wire:click="selectPaymentMethod('usdc-polygon')"
                                @click="$store.depositPage.proceedToDepositConfirmation($wire)"
                                class="{{ $this->selectedPaymentMethodSlug === 'usdc-polygon' ? 'border-3 border-[#1E90FF]' : 'border border-[#26252a]' }} bg-dim hover:bg-[#3b3a41] cursor-pointer flex items-center space-x-2 px-4 py-4.5 mb-1.5 rounded-md text-[#FFFFFF]">
                                <div class="flex-none">
                                    <img src="{{ Storage::url('payment-method-icon/usdc-polygon.svg') }}">
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm">USDC</p>
                                    <p class="text-[10px] text-[#a4a4a4]">Polygon (Polygon)</p>
                                </div>
                            </div>
                        </div>

                        <div wire:click="selectPaymentMethod('solana')"
                            @click="$store.depositPage.proceedToDepositConfirmation($wire)"
                            class="{{ $this->selectedPaymentMethodSlug === 'solana' ? 'border-3 border-[#1E90FF]' : 'border border-[#26252a]' }} bg-dim hover:bg-[#3b3a41] cursor-pointer flex items-center space-x-2 px-4 py-7 mb-1.5 rounded-md text-[#FFFFFF]">
                            <div class="flex-none">
                                <img src="{{ Storage::url('payment-method-icon/sol.svg') }}">
                            </div>
                            <div class="flex-1">
                                <p class="text-sm">Solana</p>
                            </div>
                        </div>

                        <div wire:click="selectPaymentMethod('litecoin')"
                            @click="$store.depositPage.proceedToDepositConfirmation($wire)"
                            class="{{ $this->selectedPaymentMethodSlug === 'litecoin' ? 'border-3 border-[#1E90FF]' : 'border border-[#26252a]' }} bg-dim hover:bg-[#3b3a41] cursor-pointer flex items-center space-x-2 px-4 py-7 mb-1.5 rounded-md text-[#FFFFFF]">
                            <div class="flex-none">
                                <img src="{{ Storage::url('payment-method-icon/ltc.svg') }}">
                            </div>
                            <div class="flex-1">
                                <p class="text-sm">Litecoin</p>
                            </div>
                        </div>

                        <div wire:click="selectPaymentMethod('binance-coin')"
                            @click="$store.depositPage.proceedToDepositConfirmation($wire)"
                            class="{{ $this->selectedPaymentMethodSlug === 'binance-coin' ? 'border-3 border-[#1E90FF]' : 'border border-[#26252a]' }} bg-dim hover:bg-[#3b3a41] cursor-pointer flex items-center space-x-2 px-4 py-7 mb-1.5 rounded-md text-[#FFFFFF]">
                            <div class="flex-none">
                                <img src="{{ Storage::url('payment-method-icon/bnb.svg') }}">
                            </div>
                            <div class="flex-1">
                                <p class="text-sm">BNB</p>
                            </div>
                        </div>

                        <div wire:click="selectPaymentMethod('tron')"
                            @click="$store.depositPage.proceedToDepositConfirmation($wire)"
                            class="{{ $this->selectedPaymentMethodSlug === 'tron' ? 'border-3 border-[#1E90FF]' : 'border border-[#26252a]' }} bg-dim hover:bg-[#3b3a41] cursor-pointer flex items-center space-x-2 px-4 py-7 mb-1.5 rounded-md text-[#FFFFFF]">
                            <div class="flex-none">
                                <img src="{{ Storage::url('payment-method-icon/tron.svg') }}">
                            </div>
                            <div class="flex-1">
                                <p class="text-sm">Tron</p>
                            </div>
                        </div>

                        <div wire:click="selectPaymentMethod('ripple')"
                            @click="$store.depositPage.proceedToDepositConfirmation($wire)"
                            class="{{ $this->selectedPaymentMethodSlug === 'ripple' ? 'border-3 border-[#1E90FF]' : 'border border-[#26252a]' }} bg-dim hover:bg-[#3b3a41] cursor-pointer flex items-center space-x-2 px-4 py-7 mb-1.5 rounded-md text-[#FFFFFF]">
                            <div class="flex-none">
                                <img src="{{ Storage::url('payment-method-icon/xrp.svg') }}">
                            </div>
                            <div class="flex-1">
                                <p class="text-sm">XRP</p>
                            </div>
                        </div>

                        <div wire:click="selectPaymentMethod('bitcoin-cash')"
                            @click="$store.depositPage.proceedToDepositConfirmation($wire)"
                            class="{{ $this->selectedPaymentMethodSlug === 'bitcoin-cash' ? 'border-3 border-[#1E90FF]' : 'border border-[#26252a]' }} bg-dim hover:bg-[#3b3a41] cursor-pointer flex items-center space-x-2 px-4 py-7 mb-1.5 rounded-md text-[#FFFFFF]">
                            <div class="flex-none">
                                <img src="{{ Storage::url('payment-method-icon/bch.svg') }}">
                            </div>
                            <div class="flex-1">
                                <p class="text-sm">BCH</p>
                            </div>
                        </div>

                        <div wire:click="selectPaymentMethod('dogecoin')"
                            @click="$store.depositPage.proceedToDepositConfirmation($wire)"
                            class="{{ $this->selectedPaymentMethodSlug === 'dogecoin' ? 'border-3 border-[#1E90FF]' : 'border border-[#26252a]' }} bg-dim hover:bg-[#3b3a41] cursor-pointer flex items-center space-x-2 px-4 py-7 mb-1.5 rounded-md text-[#FFFFFF]">
                            <div class="flex-none">
                                <img src="{{ Storage::url('payment-method-icon/doge.svg') }}">
                            </div>
                            <div class="flex-1">
                                <p class="text-sm">Dogecoin</p>
                            </div>
                        </div>

                        <div wire:click="selectPaymentMethod('dash')"
                            @click="$store.depositPage.proceedToDepositConfirmation($wire)"
                            class="{{ $this->selectedPaymentMethodSlug === 'dash' ? 'border-3 border-[#1E90FF]' : 'border border-[#26252a]' }} bg-dim hover:bg-[#3b3a41] cursor-pointer flex items-center space-x-2 px-4 py-7 mb-1.5 rounded-md text-[#FFFFFF]">
                            <div class="flex-none">
                                <img src="{{ Storage::url('payment-method-icon/dash.svg') }}">
                            </div>
                            <div class="flex-1">
                                <p class="text-sm">DASH</p>
                            </div>
                        </div>
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

        if (type === 'deposit-error') {
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

    document.addEventListener('alpine:init', () => {
        Alpine.store('depositPage', {
            amount: '',

            isUSDTNetworksDropdownOpen: false,

            isUSDCNetworksDropdownOpen: false,

            isPaymentMethodSelectVisible: false,

            togglePaymentMethodSelect(wire) {
                if (this.amount === '' || this.amount === 0) {
                    this.isPaymentMethodSelectVisible = false;
                    return;
                }

                if (wire.isBanned) {
                    this.isPaymentMethodSelectVisible = false;
                    let message =
                        'Your account has been banned. Reach out to support at support@yfxai.com.';
                    toast('deposit-error', message);
                    return;
                }

                if (wire.isUserPioneer) {
                    let message = 'Yfxai is currently not available in your region.';
                    toast('deposit-error', message);
                    return;
                }

                if (parseFloat(this.amount) < parseInt(wire.minimumDepositAmount) && parseFloat(wire
                        .amount) !== 0) {
                    this.isPaymentMethodSelectVisible = false;
                    let message = `Minimum deposit is $${wire.minimumDepositAmount}`;
                    toast('deposit-error', message);
                    return;
                }

                this.isPaymentMethodSelectVisible = true;
            },

            toggleUSDTNetworksDropdown() {
                this.isUSDTNetworksDropdownOpen = !this.isUSDTNetworksDropdownOpen;
            },

            toggleUSDCNetworksDropdown() {
                this.isUSDCNetworksDropdownOpen = !this.isUSDCNetworksDropdownOpen;
            },

            proceedToDepositConfirmation(wire) {
                wire.confirmDeposit();
            }
        })
    })
</script>

@script
    <script>
        $wire.on('deposit-error', (event) => {
            toast('deposit-error', event.message);
        });
    </script>
@endscript
