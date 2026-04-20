<div x-data class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:px-96 lg:pt-6">
            <div id="hs-vertically-centered-modal"
                class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
                role="dialog" tabindex="-1" aria-labelledby="hs-vertically-centered-modal-label">
                <div
                    class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
                    <div class="w-full flex flex-col bg-dashboard rounded-xl pointer-events-auto">
                        <div class="flex justify-between items-center py-3 px-4 border-b border-[#26252a]">
                            <h3 id="hs-vertically-centered-modal-label" class="font-bold text-white">
                                How to use the Yfxai Robot
                            </h3>
                            <button type="button"
                                class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-dim text-white  focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none"
                                aria-label="Close" data-hs-overlay="#hs-vertically-centered-modal">
                                <span class="sr-only">Close</span>
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6 6 18"></path>
                                    <path d="m6 6 12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="p-4 overflow-y-auto">
                            <div>
                                <span class="font-medium text-semibold text-white mb-6">How to start the robot:</span>
                                <ul class="list-disc list-inside text-white text-sm">
                                    <li>Step 1: Enter your trade amount.</li>
                                    <li>Step 2: Choose Demo or Live.</li>
                                    <li>Step 3: Activate the robot. Click "Start Robot" and it will begin trading on
                                        your behalf, generating profits every 5 minutes.</li>
                                </ul>
                            </div>
                            <div class="mt-6">
                                <span class="font-medium text-semibold text-white mb-6">Important Notes:</span>
                                <ul class="list-decimal list-inside text-white text-sm">
                                    <li>Your capital is always returned after each trade.</li>
                                    <li>You can stop the robot at any time.</li>
                                    <li>The robot generates profits every 5 minutes.</li>
                                    <li>After starting the robot, you don’t need to do anything else. It will
                                        automatically trade and accumulate profits for you until it reaches the profit
                                        limit.</li>
                                    <li>There are both Live and Demo accounts available. To make real profits, deposit
                                        funds into your Live account and start using the robot.</li>
                                </ul>
                            </div>
                            <div class="mt-4 text-white text-sm">
                                Feel free to contact us if you need any help with using the Yfxai Robot.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center mb-3 mt-2 sticky top-0 bg-dashboard z-10 py-2 lg:pt-4">
                <div class="flex-1">
                    <h1 class="text-white text-lg md:text-xl lg:text-2xl font-bold tracking-[0.15px]">Setup Robot
                    </h1>
                </div>
                <div class="flex-none">
                    <button type="button" class="flex items-center gap-x-1" aria-haspopup="dialog"
                        aria-expanded="false" aria-controls="hs-vertically-centered-modal"
                        data-hs-overlay="#hs-vertically-centered-modal">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="#a4a4a4" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-info-icon lucide-info">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M12 16v-4" />
                                <path d="M12 8h.01" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-[#a4a4a4]">How it works?</p>
                        </div>
                    </button>
                </div>
            </div>

            <div class="lg:h-full lg:pb-24 lg:overflow-scroll scrollbar-hide">
                <div class="flex items-start gap-x-2 mb-6">
                    <div class="flex-1">
                        <div class="text-start">
                            <label for="input-label" class="block text-sm font-medium mb-2 text-zinc-300">Trade
                                Amount</label>
                            <div class="relative">
                                <input wire:model="amount" wire:keyup="calculateProfitExpected"
                                    @input="$store.robotPage.checkMinimumAmount($wire)" type="text"
                                    class="bg-transparent text-white border border-[#26252a] text-sm peer py-2.5 px-4 ps-11 block w-full rounded-lg sm:text-sm focus:outline-0"
                                    placeholder="">
                                <div
                                    class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                    <p class="text-white text-sm font-semibold">$</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1">
                        <label for="input-label" class="block text-sm font-medium mb-2 text-zinc-300">Choose
                            Account</label>
                        <div class="grid grid-cols-2 gap-x-2">
                            <label for="hs-vertical-radio-in-form-demo"
                                wire:click="selectAccountType('Demo account', 'demo')"
                                class="px-4 py-2 w-full {{ $this->accountTypeSlug === 'demo' ? 'border-3 border-[#40FFDD]' : 'border border-[#323335]' }} bg-transparent rounded-lg text-base focus:border-[#1a1b20] focus:ring-[#1a1b20]">
                                <div class="flex-1 text-center">
                                    <h2 class="text-white uppercase font-semibold text-sm">Demo</h2>
                                </div>
                            </label>
                            <label for="hs-vertical-radio-in-form-live"
                                wire:click="selectAccountType('Live account', 'live')"
                                class="px-4 py-2 w-full {{ $this->accountTypeSlug === 'live' ? 'border-3 border-[#40FFDD]' : 'border border-[#323335]' }} bg-transparent rounded-lg text-base focus:border-[#1a1b20] focus:ring-[#1a1b20]">
                                <div class="flex-1 text-center text-white">
                                    <h2 class="text-white uppercase font-semibold text-sm">Live</h2>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="input-label" class="block text-sm text-center font-medium mb-2 text-zinc-300">
                        Estimated Profits in 24hrs
                    </label>
                    <div class="flex justify-center w-full">
                        <div
                            class="flex items-center justify-center w-full border border-[#26252a] rounded-lg py-1.5 px-4">
                            <div class="flex-none text-sm text-white p-2 pl-0 py-1" role="alert" tabindex="-1"
                                aria-labelledby="hs-with-description-label">
                                <div class="flex items-center">
                                    <div class="shrink-0 text-green-400">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_776_2)">
                                                <path
                                                    d="M12.525 6C12.3757 5.57643 12.1031 5.20722 11.7422 4.9399C11.3813 4.67258 10.9487 4.51937 10.5 4.5H7.5C6.90326 4.5 6.33097 4.73705 5.90901 5.15901C5.48705 5.58097 5.25 6.15326 5.25 6.75C5.25 7.34674 5.48705 7.91903 5.90901 8.34099C6.33097 8.76295 6.90326 9 7.5 9H10.5C11.0967 9 11.669 9.23705 12.091 9.65901C12.5129 10.081 12.75 10.6533 12.75 11.25C12.75 11.8467 12.5129 12.419 12.091 12.841C11.669 13.2629 11.0967 13.5 10.5 13.5H7.5C7.05131 13.4806 6.61868 13.3274 6.2578 13.0601C5.89691 12.7928 5.62429 12.4236 5.475 12"
                                                    stroke="#05DF72" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M9 2.25V4.5M9 13.5V15.75" stroke="#05DF72" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_776_2">
                                                    <rect width="18" height="18" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                    <div class="flex-none">
                                        <p wire:text="expectedProfitMin" class="text-white text-base font-bold"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-none text-sm text-white pr-1">
                                <p class=""> - </p>
                            </div>

                            <div class="flex-none text-sm text-white p-2 pl-0 py-1" role="alert" tabindex="-1"
                                aria-labelledby="hs-with-description-label">
                                <div class="flex items-center">
                                    <div class="shrink-0 text-green-400">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_776_2)">
                                                <path
                                                    d="M12.525 6C12.3757 5.57643 12.1031 5.20722 11.7422 4.9399C11.3813 4.67258 10.9487 4.51937 10.5 4.5H7.5C6.90326 4.5 6.33097 4.73705 5.90901 5.15901C5.48705 5.58097 5.25 6.15326 5.25 6.75C5.25 7.34674 5.48705 7.91903 5.90901 8.34099C6.33097 8.76295 6.90326 9 7.5 9H10.5C11.0967 9 11.669 9.23705 12.091 9.65901C12.5129 10.081 12.75 10.6533 12.75 11.25C12.75 11.8467 12.5129 12.419 12.091 12.841C11.669 13.2629 11.0967 13.5 10.5 13.5H7.5C7.05131 13.4806 6.61868 13.3274 6.2578 13.0601C5.89691 12.7928 5.62429 12.4236 5.475 12"
                                                    stroke="#05DF72" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M9 2.25V4.5M9 13.5V15.75" stroke="#05DF72" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_776_2">
                                                    <rect width="18" height="18" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                    <div class="flex-none">
                                        <p wire:text="expectedProfitMax" class="text-white text-base font-bold"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4 flex items-center space-x-2">
                    <div class="flex-1">
                        <label for="input-label" class="block text-sm font-medium mb-2 text-zinc-300">Crypto
                            Exchange</label>
                        <div
                            class="flex items-center justify-center gap-x-1 w-full text-sm self-center text-center border border-[#26252a] bg-transparent py-2.5 sm:py-3 px-4 rounded-lg text-[#FFFFFF] focus:outline-0">
                            <div class="flex-none">
                                <img class="inline" src="{{ asset('assets/icons/bybit.svg') }}" alt="bybit-logo">
                            </div>
                            <div class="flex-none w-4 mt-1">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_793_3)">
                                        <path
                                            d="M8.00662 1.34067C8.52514 1.3407 9.0259 1.52958 9.41528 1.872L9.51795 1.96867L9.98328 2.434C10.111 2.56088 10.2778 2.64097 10.4566 2.66133L10.5466 2.66667H11.2133C11.7581 2.66664 12.2823 2.87505 12.6783 3.24916C13.0744 3.62327 13.3123 4.13474 13.3433 4.67867L13.3466 4.8V5.46667C13.3466 5.64667 13.4079 5.822 13.5186 5.962L13.5786 6.02867L14.0433 6.494C14.4284 6.87697 14.653 7.39241 14.6712 7.93525C14.6894 8.47808 14.4999 9.00742 14.1413 9.41533L14.0446 9.518L13.5793 9.98333C13.4524 10.111 13.3723 10.2778 13.3519 10.4567L13.3466 10.5467V11.2133C13.3466 11.7581 13.1382 12.2823 12.7641 12.6784C12.39 13.0744 11.8785 13.3123 11.3346 13.3433L11.2133 13.3467H10.5466C10.3669 13.3467 10.1924 13.4073 10.0513 13.5187L9.98462 13.5787L9.51928 14.0433C9.13632 14.4285 8.62087 14.6531 8.07804 14.6713C7.5352 14.6895 7.00586 14.4999 6.59795 14.1413L6.49528 14.0447L6.02995 13.5793C5.90224 13.4525 5.73548 13.3724 5.55662 13.352L5.46662 13.3467H4.79995C4.25514 13.3467 3.73096 13.1383 3.3349 12.7642C2.93885 12.3901 2.70094 11.8786 2.66995 11.3347L2.66662 11.2133V10.5467C2.66656 10.3669 2.60597 10.1924 2.49462 10.0513L2.43462 9.98467L1.96995 9.51933C1.5848 9.13637 1.36023 8.62092 1.34202 8.07809C1.32381 7.53526 1.51333 7.00592 1.87195 6.598L1.96862 6.49533L2.43395 6.03C2.56082 5.90229 2.64092 5.73553 2.66128 5.55667L2.66662 5.46667V4.8L2.66995 4.67867C2.69972 4.15563 2.9209 3.66183 3.29134 3.29139C3.66178 2.92095 4.15558 2.69977 4.67862 2.67L4.79995 2.66667H5.46662C5.64636 2.66661 5.82085 2.60602 5.96195 2.49467L6.02862 2.43467L6.49395 1.97C6.69217 1.77059 6.92786 1.61234 7.18746 1.50433C7.44706 1.39633 7.72545 1.34071 8.00662 1.34067ZM10.4713 6.19533C10.3463 6.07035 10.1767 6.00014 9.99995 6.00014C9.82317 6.00014 9.65363 6.07035 9.52862 6.19533L7.33328 8.39L6.47128 7.52867L6.40862 7.47333C6.27462 7.36973 6.10621 7.32101 5.9376 7.33707C5.76898 7.35313 5.6128 7.43277 5.50078 7.55982C5.38876 7.68686 5.32929 7.85178 5.33446 8.02108C5.33963 8.19038 5.40905 8.35136 5.52862 8.47133L6.86195 9.80467L6.92462 9.86C7.05289 9.9595 7.21305 10.0088 7.37507 9.99859C7.53709 9.98841 7.68982 9.91945 7.80462 9.80467L10.4713 7.138L10.5266 7.07533C10.6261 6.94706 10.6754 6.7869 10.6652 6.62488C10.655 6.46286 10.5861 6.31013 10.4713 6.19533Z"
                                            fill="#05DF72" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_793_3">
                                            <rect width="16" height="16" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1">
                        <label for="input-label" class="block text-sm font-medium mb-2 text-zinc-300">Forex
                            Broker</label>
                        <div
                            class="flex items-center justify-center gap-x-1 border border-[#26252a] bg-transparent w-full text-sm self-center text-center py-2.5 sm:py-3 px-4 rounded-lg text-[#FFFFFF] focus:outline-0">
                            <div class="flex-none">
                                <img class="inline" src="{{ asset('assets/icons/xtb.svg') }}" alt="xtb-logo">
                            </div>
                            <div class="flex-none w-4">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_793_3)">
                                        <path
                                            d="M8.00662 1.34067C8.52514 1.3407 9.0259 1.52958 9.41528 1.872L9.51795 1.96867L9.98328 2.434C10.111 2.56088 10.2778 2.64097 10.4566 2.66133L10.5466 2.66667H11.2133C11.7581 2.66664 12.2823 2.87505 12.6783 3.24916C13.0744 3.62327 13.3123 4.13474 13.3433 4.67867L13.3466 4.8V5.46667C13.3466 5.64667 13.4079 5.822 13.5186 5.962L13.5786 6.02867L14.0433 6.494C14.4284 6.87697 14.653 7.39241 14.6712 7.93525C14.6894 8.47808 14.4999 9.00742 14.1413 9.41533L14.0446 9.518L13.5793 9.98333C13.4524 10.111 13.3723 10.2778 13.3519 10.4567L13.3466 10.5467V11.2133C13.3466 11.7581 13.1382 12.2823 12.7641 12.6784C12.39 13.0744 11.8785 13.3123 11.3346 13.3433L11.2133 13.3467H10.5466C10.3669 13.3467 10.1924 13.4073 10.0513 13.5187L9.98462 13.5787L9.51928 14.0433C9.13632 14.4285 8.62087 14.6531 8.07804 14.6713C7.5352 14.6895 7.00586 14.4999 6.59795 14.1413L6.49528 14.0447L6.02995 13.5793C5.90224 13.4525 5.73548 13.3724 5.55662 13.352L5.46662 13.3467H4.79995C4.25514 13.3467 3.73096 13.1383 3.3349 12.7642C2.93885 12.3901 2.70094 11.8786 2.66995 11.3347L2.66662 11.2133V10.5467C2.66656 10.3669 2.60597 10.1924 2.49462 10.0513L2.43462 9.98467L1.96995 9.51933C1.5848 9.13637 1.36023 8.62092 1.34202 8.07809C1.32381 7.53526 1.51333 7.00592 1.87195 6.598L1.96862 6.49533L2.43395 6.03C2.56082 5.90229 2.64092 5.73553 2.66128 5.55667L2.66662 5.46667V4.8L2.66995 4.67867C2.69972 4.15563 2.9209 3.66183 3.29134 3.29139C3.66178 2.92095 4.15558 2.69977 4.67862 2.67L4.79995 2.66667H5.46662C5.64636 2.66661 5.82085 2.60602 5.96195 2.49467L6.02862 2.43467L6.49395 1.97C6.69217 1.77059 6.92786 1.61234 7.18746 1.50433C7.44706 1.39633 7.72545 1.34071 8.00662 1.34067ZM10.4713 6.19533C10.3463 6.07035 10.1767 6.00014 9.99995 6.00014C9.82317 6.00014 9.65363 6.07035 9.52862 6.19533L7.33328 8.39L6.47128 7.52867L6.40862 7.47333C6.27462 7.36973 6.10621 7.32101 5.9376 7.33707C5.76898 7.35313 5.6128 7.43277 5.50078 7.55982C5.38876 7.68686 5.32929 7.85178 5.33446 8.02108C5.33963 8.19038 5.40905 8.35136 5.52862 8.47133L6.86195 9.80467L6.92462 9.86C7.05289 9.9595 7.21305 10.0088 7.37507 9.99859C7.53709 9.98841 7.68982 9.91945 7.80462 9.80467L10.4713 7.138L10.5266 7.07533C10.6261 6.94706 10.6754 6.7869 10.6652 6.62488C10.655 6.46286 10.5861 6.31013 10.4713 6.19533Z"
                                            fill="#05DF72" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_793_3">
                                            <rect width="16" height="16" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="input-label" class="block text-sm font-medium mb-2 text-zinc-300">Trading
                        Strategy</label>
                    <div class="grid space-y-2">
                        @foreach ($this->strategies as $strategy)
                            <div class="relative">
                                <div
                                    class="absolute -inset-0 bg-linear-to-r from-accent to-[#F76CC6] rounded-lg blur opacity-50">
                                </div>
                                <label for="hs-vertical-radio-in-form-{{ $strategy['id'] }}"
                                    wire:key="strategy-{{ $strategy['id'] }}"
                                    class="flex relative px-3 py-3 pb-4 gap-x-4 items-center w-full bg-dashboard rounded-lg border-3 border-[#26252a] text-sm focus:border-blue-500 focus:ring-blue-500">
                                    <div class="flex-none w-12">
                                        <img class="w-24" src="{{ asset('assets/images/robot-illustration.png') }}"
                                            alt="">
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="font-bold mb-1 text-base text-white">
                                            {{ $strategy['name'] }}
                                        </h2>
                                        <div class="mb-1">
                                            <p class="text-xs text-[#a4a4a4] font-normal">
                                                Estimated 24 hours returns range from
                                                8% to
                                                14%, depending on market
                                                conditions.
                                            </p>
                                            {{-- <div class="flex items-center gap-x-1">
                                                <div>
                                                    <svg width="16" height="16" viewBox="0 0 16 16"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.4443 0C14.408 0 16 1.59198 16 3.55566V12.4443C16 14.408 14.408 16 12.4443 16H3.55566C1.59198 16 0 14.408 0 12.4443V3.55566C0 1.59198 1.59198 0 3.55566 0H12.4443ZM8 2.66699C5.05448 2.66699 2.66699 5.05448 2.66699 8C2.66699 10.9455 5.05448 13.333 8 13.333C10.9455 13.333 13.333 10.9455 13.333 8C13.333 5.05448 10.9455 2.66699 8 2.66699Z"
                                                            fill="url(#paint0_linear_896_32)" />
                                                        <rect x="7.11108" y="5.33331" width="0.977778"
                                                            height="3.37778" rx="0.488889" fill="#009CC2" />
                                                        <rect x="7.11108" y="8.97778" width="0.977778"
                                                            height="3.37778" rx="0.488889"
                                                            transform="rotate(-90 7.11108 8.97778)" fill="#009CC2" />
                                                        <defs>
                                                            <linearGradient id="paint0_linear_896_32" x1="0.614857"
                                                                y1="1.29257" x2="18.8503" y2="11.5714"
                                                                gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#00D078" />
                                                                <stop offset="1" stop-color="#007DF0" />
                                                            </linearGradient>
                                                        </defs>
                                                    </svg>
                                                </div>
                                                <p class="text-xs text-zinc-300 font-normal">
                                                    Estimated 24 hours returns range from
                                                    {{ $this->strategy['min_roi'] }}% to
                                                    {{ $this->strategy['max_roi'] }}%, depending on market
                                                    conditions.
                                                </p>
                                            </div> --}}
                                            {{-- <div>
                                                <ul class="list-disc list-inside text-xs text-zinc-300 font-normal">
                                                    <li>Estimated 24 hours returns range from
                                                    {{ $this->strategy['min_roi'] }}% to
                                                    {{ $this->strategy['max_roi'] }}%, depending on market
                                                    conditions.</li>
                                                </ul>
                                            </div> --}}
                                        </div>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mb-6 flex items-center space-x-2">
                    <div class="flex-1">
                        <label for="input-label" class="block text-sm font-medium mb-2 text-zinc-300">
                            Robot Takes Profits
                        </label>
                        <input type="text" value="Every 5 mins"
                            class="border border-[#26252a] bg-transparent text-white text-start text-sm py-2.5 sm:py-3 px-4 block w-full rounded-lg sm:text-sm focus:outline-0"
                            placeholder="" readonly>
                    </div>
                    <div class="flex-1">
                        <label for="input-label" class="block text-sm font-medium mb-2 text-zinc-300">Capital</label>
                        <input type="text" value="Returned after trade"
                            class="border border-[#26252a] bg-transparent text-white text-start text-sm py-2.5 sm:py-3 px-4 block w-full rounded-lg sm:text-sm focus:outline-0"
                            placeholder="" readonly>
                    </div>
                </div>

                <div class="sticky bottom-2">
                    <a x-on:click="$store.robotPage.toggleTradeDetailsConfirmationModal($wire);">
                        <button type="button" wire:loading.attr="disabled"
                            class="py-2.5 cursor-pointer px-4 w-full md:px-6 text-center gap-x-2 text-sm font-semibold rounded-lg bg-accent text-black focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">
                            <i wire:loading class="fa-solid fa-circle-notch fa-spin"></i>
                            <span wire:loading.remove>Start Robot</span>
                        </button>
                    </a>
                </div>

                <div x-cloak x-transition x-show="$store.robotPage.isTradeDetailsConfirmationModalOpen"
                    class="fixed top-0 left-0 h-svh w-full px-4 lg:px-96 pt-6 z-20">
                    <div class="absolute inset-0 h-svh w-full px-4 lg:px-96 pt-6 z-20 bg-dashboard opacity-85"></div>
                    <div class="relative w-full h-full flex items-center justify-center z-30">
                        <div
                            class="max-w-sm mx-auto flex flex-col bg-dashboard border border-[#26252a] rounded-2xl pointer-events-auto">
                            <div class="p-6 overflow-y-auto text-center">
                                <div class="flex justify-center mb-8">
                                    <div
                                        class="size-18 flex items-center justify-center rounded-full border-3 border-accent">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                            viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-bot-icon lucide-bot">
                                            <path d="M12 8V4H8" />
                                            <rect width="16" height="12" x="4" y="8" rx="2" />
                                            <path d="M2 14h2" />
                                            <path d="M20 14h2" />
                                            <path d="M15 13v2" />
                                            <path d="M9 13v2" />
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-white font-medium text-base">
                                    Start robot with @money(floatval($this->amount)) on {{ $this->accountType }}?
                                </p>
                                <div class="mt-6 grid grid-cols-2 gap-x-2">
                                    <div>
                                        <button type="button"
                                            x-on:click="$store.robotPage.toggleTradeDetailsConfirmationModal($wire); $store.robotPage.toggleStartRobotConfirmationModal($wire);"
                                            type="button"
                                            class="p-3 w-full text-center text-sm font-semibold rounded-lg border border-transparent bg-accent text-black cursor-pointer hover:bg-accent focus:outline-hidden focus:bg-accent disabled:opacity-50 disabled:pointer-events-none">
                                            Start
                                        </button>
                                    </div>
                                    <div>
                                        <button
                                            x-on:click="$store.robotPage.toggleTradeDetailsConfirmationModal($wire)"
                                            type="button"
                                            class="p-3 w-full text-center text-sm font-semibold rounded-lg border border-white text-white shadow-2xs cursor-pointer focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="downloadModal" class="hidden fixed top-0 left-0 h-svh w-full px-4 lg:px-96 pt-6 z-20">
                    <div class="absolute inset-0 h-svh w-full px-4 lg:px-96 pt-6 z-20 bg-dashboard opacity-85"></div>
                    <div class="relative w-full h-full flex items-center justify-center z-30">
                        <div
                            class="max-w-sm mx-auto flex flex-col bg-dashboard border border-[#26252a] rounded-2xl pointer-events-auto">
                            <div class="p-4 overflow-y-auto">
                                <div class="flex justify-end">
                                    <div id="cancelDownloadModalBtn" class="flex-none">
                                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="16" cy="16" r="16" fill="#1A1B20" />
                                            <path d="M21 11L11 21" stroke="white" stroke-width="1.66667"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M11 11L21 21" stroke="white" stroke-width="1.66667"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="text-center mb-4">
                                    <h1 class="text-white font-bold text-xl">Download Yfxai App</h1>
                                </div>

                                <div class="mt-6 flex items-center justify-center gap-x-2">
                                    <div>
                                        <a id="appStoreDownloadBtn"
                                            href="https://apps.apple.com/ng/app/yfxai/id6755783410">
                                            <svg width="159" height="49" viewBox="0 0 159 49" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="158.017" height="48.9764" rx="8"
                                                    fill="#1A1B20" />
                                                <path
                                                    d="M31.7428 25.3786C31.7566 24.3053 32.0417 23.253 32.5715 22.3196C33.1012 21.3861 33.8585 20.6019 34.7729 20.0398C34.192 19.2102 33.4257 18.5275 32.5349 18.0459C31.644 17.5643 30.6532 17.297 29.641 17.2654C27.4818 17.0387 25.3885 18.5574 24.2882 18.5574C23.1666 18.5574 21.4726 17.2879 19.6483 17.3254C18.4684 17.3635 17.3184 17.7066 16.3105 18.3213C15.3025 18.936 14.471 19.8013 13.897 20.8329C11.4102 25.1384 13.2651 31.466 15.6472 34.9462C16.839 36.6504 18.2319 38.554 20.0545 38.4865C21.838 38.4125 22.5042 37.3492 24.657 37.3492C26.7899 37.3492 27.4148 38.4865 29.2744 38.4436C31.1882 38.4125 32.394 36.7318 33.544 35.0115C34.4003 33.7972 35.0592 32.4552 35.4964 31.0351C34.3845 30.5648 33.4357 29.7777 32.7682 28.7718C32.1007 27.7659 31.7441 26.5858 31.7428 25.3786V25.3786Z"
                                                    fill="white" />
                                                <path
                                                    d="M28.2304 14.9765C29.2739 13.7239 29.788 12.1138 29.6635 10.4882C28.0693 10.6557 26.5967 11.4176 25.5391 12.6222C25.022 13.2106 24.626 13.8953 24.3737 14.6369C24.1213 15.3785 24.0176 16.1626 24.0685 16.9443C24.8659 16.9525 25.6547 16.7797 26.3756 16.4388C27.0966 16.098 27.7307 15.598 28.2304 14.9765Z"
                                                    fill="white" />
                                                <path
                                                    d="M57.1722 33.4378H51.7868L50.4935 37.1693H48.2124L53.3134 23.3638H55.6833L60.7843 37.1693H58.4644L57.1722 33.4378ZM52.3445 31.7159H56.6134L54.509 25.6601H54.4501L52.3445 31.7159Z"
                                                    fill="white" />
                                                <path
                                                    d="M71.8007 32.1372C71.8007 35.265 70.0874 37.2746 67.5019 37.2746C66.847 37.308 66.1956 37.1606 65.6224 36.8492C65.0492 36.5377 64.5774 36.0749 64.2609 35.5136H64.212V40.499H62.0976V27.104H64.1442V28.7781H64.1831C64.5141 28.2195 64.994 27.759 65.5715 27.4457C66.1491 27.1323 66.8028 26.9778 67.463 26.9987C70.0773 26.9987 71.8007 29.018 71.8007 32.1372ZM69.6274 32.1372C69.6274 30.0994 68.5496 28.7596 66.9052 28.7596C65.2897 28.7596 64.2031 30.1276 64.2031 32.1372C64.2031 34.1652 65.2897 35.5234 66.9052 35.5234C68.5496 35.5234 69.6274 34.1934 69.6274 32.1372Z"
                                                    fill="white" />
                                                <path
                                                    d="M83.1382 32.1372C83.1382 35.2651 81.4249 37.2746 78.8394 37.2746C78.1844 37.3081 77.5331 37.1607 76.9599 36.8493C76.3867 36.5378 75.9149 36.0749 75.5984 35.5137H75.5494V40.4991H73.4351V27.104H75.4817V28.7781H75.5206C75.8516 28.2195 76.3314 27.7591 76.909 27.4457C77.4865 27.1324 78.1402 26.9779 78.8005 26.9987C81.4149 26.9987 83.1382 29.0181 83.1382 32.1372ZM80.9649 32.1372C80.9649 30.0994 79.8871 28.7597 78.2427 28.7597C76.6272 28.7597 75.5406 30.1276 75.5406 32.1372C75.5406 34.1653 76.6272 35.5234 78.2427 35.5234C79.8871 35.5234 80.9649 34.1935 80.9649 32.1372H80.9649Z"
                                                    fill="white" />
                                                <path
                                                    d="M90.6313 33.3228C90.788 34.6918 92.1491 35.5907 94.009 35.5907C95.7912 35.5907 97.0734 34.6918 97.0734 33.4573C97.0734 32.3858 96.3 31.7442 94.469 31.3045L92.6379 30.8734C90.0436 30.2611 88.8391 29.0756 88.8391 27.1517C88.8391 24.7698 90.9635 23.1337 93.9801 23.1337C96.9656 23.1337 99.0122 24.7698 99.0811 27.1517H96.9467C96.8189 25.774 95.6534 24.9424 93.9501 24.9424C92.2468 24.9424 91.0813 25.7838 91.0813 27.0084C91.0813 27.9845 91.8257 28.5588 93.6468 28.9984L95.2034 29.3719C98.1022 30.0418 99.3066 31.1796 99.3066 33.1989C99.3066 35.7817 97.2011 37.3994 93.8523 37.3994C90.719 37.3994 88.6036 35.8197 88.4669 33.3227L90.6313 33.3228Z"
                                                    fill="white" />
                                                <path
                                                    d="M103.87 24.722V27.104H105.829V28.7401H103.87V34.289C103.87 35.151 104.262 35.5527 105.123 35.5527C105.356 35.5488 105.588 35.5328 105.819 35.5049V37.1313C105.432 37.202 105.038 37.234 104.644 37.2268C102.559 37.2268 101.745 36.4614 101.745 34.5094V28.7401H100.248V27.104H101.745V24.722H103.87Z"
                                                    fill="white" />
                                                <path
                                                    d="M106.963 32.1372C106.963 28.9703 108.872 26.9803 111.849 26.9803C114.835 26.9803 116.735 28.9702 116.735 32.1372C116.735 35.3128 114.845 37.2942 111.849 37.2942C108.853 37.2942 106.963 35.3128 106.963 32.1372ZM114.581 32.1372C114.581 29.9648 113.562 28.6826 111.849 28.6826C110.135 28.6826 109.118 29.9745 109.118 32.1372C109.118 34.3183 110.135 35.5907 111.849 35.5907C113.562 35.5907 114.581 34.3183 114.581 32.1372H114.581Z"
                                                    fill="white" />
                                                <path
                                                    d="M118.478 27.104H120.495V28.8172H120.544C120.68 28.2821 121.001 27.8093 121.452 27.4781C121.904 27.147 122.458 26.9777 123.022 26.9987C123.265 26.9979 123.508 27.0237 123.746 27.0758V29.0083C123.438 28.9164 123.118 28.8743 122.796 28.8834C122.489 28.8713 122.183 28.9242 121.898 29.0386C121.614 29.1529 121.359 29.3261 121.149 29.5461C120.94 29.7661 120.782 30.0277 120.686 30.3131C120.59 30.5984 120.558 30.9007 120.593 31.1992V37.1693H118.478L118.478 27.104Z"
                                                    fill="white" />
                                                <path
                                                    d="M133.495 34.213C133.21 36.0402 131.389 37.2942 129.059 37.2942C126.063 37.2942 124.203 35.3323 124.203 32.185C124.203 29.0278 126.073 26.9803 128.97 26.9803C131.82 26.9803 133.612 28.8932 133.612 31.945V32.6529H126.337V32.7777C126.303 33.1482 126.351 33.5213 126.476 33.8725C126.602 34.2236 126.802 34.5447 127.064 34.8143C127.326 35.084 127.644 35.296 127.996 35.4364C128.349 35.5769 128.728 35.6424 129.108 35.6287C129.608 35.6745 130.109 35.5614 130.538 35.3063C130.966 35.0512 131.299 34.6678 131.487 34.213L133.495 34.213ZM126.347 31.209H131.497C131.516 30.8759 131.464 30.5426 131.345 30.2299C131.226 29.9173 131.042 29.6321 130.805 29.3922C130.568 29.1524 130.282 28.963 129.966 28.836C129.651 28.709 129.312 28.6472 128.97 28.6544C128.626 28.6524 128.285 28.717 127.966 28.8446C127.647 28.9721 127.358 29.1601 127.114 29.3976C126.87 29.6351 126.677 29.9174 126.545 30.2283C126.413 30.5392 126.346 30.8725 126.347 31.209V31.209Z"
                                                    fill="white" />
                                                <path
                                                    d="M52.5138 8.87531C53.0535 8.83747 53.595 8.91714 54.0994 9.10856C54.6037 9.29998 55.0583 9.59839 55.4303 9.98226C55.8023 10.3661 56.0825 10.8259 56.2507 11.3284C56.4188 11.8309 56.4708 12.3636 56.4027 12.8881C56.4027 15.4681 54.9757 16.9511 52.5138 16.9511H49.5285V8.87531H52.5138ZM50.8122 15.809H52.3705C52.7561 15.8315 53.142 15.7698 53.5001 15.6282C53.8582 15.4866 54.1795 15.2687 54.4406 14.9905C54.7017 14.7123 54.896 14.3807 55.0094 14.0198C55.1228 13.659 55.1524 13.278 55.096 12.9045C55.1483 12.5325 55.1157 12.1539 55.0005 11.7957C54.8854 11.4375 54.6906 11.1086 54.4301 10.8326C54.1696 10.5566 53.8499 10.3403 53.4938 10.1992C53.1377 10.0581 52.7541 9.99575 52.3705 10.0166H50.8122V15.809Z"
                                                    fill="white" />
                                                <path
                                                    d="M57.8528 13.9011C57.8136 13.5006 57.8605 13.0965 57.9904 12.7148C58.1204 12.333 58.3306 11.982 58.6076 11.6842C58.8845 11.3865 59.2221 11.1486 59.5986 10.9858C59.9752 10.823 60.3824 10.739 60.7941 10.739C61.2059 10.739 61.6131 10.823 61.9896 10.9858C62.3662 11.1486 62.7038 11.3865 62.9807 11.6842C63.2576 11.982 63.4678 12.333 63.5978 12.7148C63.7278 13.0965 63.7747 13.5006 63.7355 13.9011C63.7754 14.302 63.7291 14.7067 63.5995 15.0891C63.4698 15.4715 63.2598 15.8231 62.9827 16.1214C62.7057 16.4197 62.3679 16.6581 61.991 16.8213C61.6141 16.9844 61.2064 17.0687 60.7941 17.0687C60.3819 17.0687 59.9742 16.9844 59.5973 16.8213C59.2204 16.6581 58.8825 16.4197 58.6055 16.1214C58.3285 15.8231 58.1184 15.4715 57.9888 15.0891C57.8592 14.7067 57.8128 14.302 57.8528 13.9011V13.9011ZM62.4694 13.9011C62.4694 12.5801 61.862 11.8075 60.7962 11.8075C59.7262 11.8075 59.1243 12.5801 59.1243 13.9011C59.1243 15.2328 59.7263 15.9994 60.7962 15.9994C61.8621 15.9994 62.4694 15.2275 62.4694 13.9011H62.4694Z"
                                                    fill="white" />
                                                <path
                                                    d="M71.5552 16.951H70.2783L68.9892 12.4624H68.8918L67.6082 16.951H66.3434L64.6242 10.8565H65.8727L66.99 15.5069H67.082L68.3643 10.8565H69.5452L70.8275 15.5069H70.9249L72.0368 10.8565H73.2677L71.5552 16.951Z"
                                                    fill="white" />
                                                <path
                                                    d="M74.7137 10.8565H75.8986V11.8246H75.9906C76.1466 11.4769 76.4098 11.1854 76.7434 10.9908C77.0771 10.7961 77.4645 10.7081 77.8518 10.7388C78.1553 10.7165 78.46 10.7612 78.7434 10.8697C79.0268 10.9781 79.2816 11.1474 79.4889 11.3651C79.6963 11.5828 79.8508 11.8433 79.9411 12.1272C80.0314 12.4112 80.0552 12.7114 80.0107 13.0056V16.9509H78.7797V13.3076C78.7797 12.3282 78.3442 11.8412 77.4338 11.8412C77.2278 11.8318 77.0221 11.866 76.8309 11.9416C76.6397 12.0172 76.4674 12.1322 76.326 12.2789C76.1845 12.4256 76.0772 12.6005 76.0114 12.7915C75.9455 12.9825 75.9227 13.1852 75.9446 13.3856V16.9509H74.7137L74.7137 10.8565Z"
                                                    fill="white" />
                                                <path d="M81.972 8.47739H83.2029V16.951H81.972V8.47739Z"
                                                    fill="white" />
                                                <path
                                                    d="M84.914 13.9011C84.8748 13.5006 84.9218 13.0965 85.0518 12.7147C85.1818 12.3329 85.392 11.9819 85.669 11.6842C85.946 11.3864 86.2836 11.1485 86.6601 10.9857C87.0367 10.823 87.4439 10.7389 87.8557 10.7389C88.2675 10.7389 88.6747 10.823 89.0513 10.9857C89.4279 11.1485 89.7655 11.3864 90.0424 11.6842C90.3194 11.9819 90.5296 12.3329 90.6597 12.7147C90.7897 13.0965 90.8366 13.5006 90.7974 13.9011C90.8373 14.3021 90.7909 14.7067 90.6613 15.0891C90.5316 15.4715 90.3215 15.8231 90.0444 16.1214C89.7674 16.4198 89.4295 16.6581 89.0526 16.8213C88.6757 16.9844 88.268 17.0687 87.8557 17.0687C87.4435 17.0687 87.0358 16.9844 86.6588 16.8213C86.2819 16.6581 85.944 16.4198 85.667 16.1214C85.39 15.8231 85.1799 15.4715 85.0502 15.0891C84.9205 14.7067 84.8741 14.3021 84.914 13.9011V13.9011ZM89.5306 13.9011C89.5306 12.5801 88.9233 11.8075 87.8574 11.8075C86.7875 11.8075 86.1856 12.5801 86.1856 13.9011C86.1856 15.2328 86.7875 15.9994 87.8574 15.9994C88.9233 15.9994 89.5306 15.2275 89.5306 13.9011H89.5306Z"
                                                    fill="white" />
                                                <path
                                                    d="M92.0932 15.2274C92.0932 14.1304 92.9292 13.498 94.413 13.4081L96.1025 13.3129V12.7869C96.1025 12.1432 95.6669 11.7797 94.8256 11.7797C94.1385 11.7797 93.6623 12.0262 93.5257 12.4571H92.334C92.4598 11.4103 93.4675 10.7389 94.8824 10.7389C96.4461 10.7389 97.328 11.4995 97.328 12.7869V16.951H96.1431V16.0945H96.0457C95.848 16.4017 95.5704 16.6522 95.2413 16.8203C94.9122 16.9884 94.5433 17.0681 94.1723 17.0514C93.9104 17.078 93.6458 17.0507 93.3954 16.9712C93.145 16.8918 92.9145 16.762 92.7186 16.5901C92.5227 16.4183 92.3659 16.2082 92.2582 15.9735C92.1504 15.7388 92.0943 15.4847 92.0932 15.2274V15.2274ZM96.1025 14.7067V14.1971L94.5794 14.2923C93.7205 14.3485 93.3309 14.634 93.3309 15.1712C93.3309 15.7198 93.8179 16.039 94.4875 16.039C94.6837 16.0584 94.8819 16.039 95.0702 15.982C95.2586 15.9251 95.4334 15.8317 95.584 15.7074C95.7347 15.5831 95.8583 15.4304 95.9473 15.2585C96.0364 15.0866 96.0892 14.8989 96.1025 14.7067V14.7067Z"
                                                    fill="white" />
                                                <path
                                                    d="M98.9458 13.9011C98.9458 11.9754 99.9589 10.7554 101.535 10.7554C101.925 10.7378 102.311 10.8291 102.65 11.0184C102.989 11.2078 103.265 11.4874 103.447 11.8246H103.539V8.47739H104.77V16.951H103.591V15.9881H103.493C103.297 16.323 103.011 16.5992 102.666 16.7866C102.321 16.974 101.929 17.0656 101.535 17.0514C99.9481 17.0515 98.9458 15.8315 98.9458 13.9011ZM100.217 13.9011C100.217 15.1938 100.841 15.9716 101.884 15.9716C102.921 15.9716 103.562 15.1825 103.562 13.9064C103.562 12.6362 102.915 11.8359 101.884 11.8359C100.848 11.8359 100.217 12.619 100.217 13.9011H100.217Z"
                                                    fill="white" />
                                                <path
                                                    d="M109.863 13.9011C109.824 13.5006 109.871 13.0965 110.001 12.7148C110.131 12.333 110.341 11.982 110.618 11.6842C110.895 11.3865 111.232 11.1486 111.609 10.9858C111.985 10.823 112.393 10.739 112.804 10.739C113.216 10.739 113.623 10.823 114 10.9858C114.376 11.1486 114.714 11.3865 114.991 11.6842C115.268 11.982 115.478 12.333 115.608 12.7148C115.738 13.0965 115.785 13.5006 115.746 13.9011C115.786 14.302 115.739 14.7067 115.61 15.0891C115.48 15.4715 115.27 15.8231 114.993 16.1214C114.716 16.4197 114.378 16.6581 114.001 16.8213C113.624 16.9844 113.217 17.0687 112.804 17.0687C112.392 17.0687 111.985 16.9844 111.608 16.8213C111.231 16.6581 110.893 16.4197 110.616 16.1214C110.339 15.8231 110.129 15.4715 109.999 15.0891C109.869 14.7067 109.823 14.302 109.863 13.9011V13.9011ZM114.48 13.9011C114.48 12.5801 113.872 11.8075 112.806 11.8075C111.737 11.8075 111.135 12.5801 111.135 13.9011C111.135 15.2328 111.737 15.9994 112.806 15.9994C113.872 15.9994 114.48 15.2275 114.48 13.9011Z"
                                                    fill="white" />
                                                <path
                                                    d="M117.397 10.8565H118.582V11.8246H118.674C118.83 11.4769 119.093 11.1854 119.427 10.9908C119.761 10.7961 120.148 10.7081 120.536 10.7388C120.839 10.7165 121.144 10.7612 121.427 10.8697C121.71 10.9781 121.965 11.1474 122.173 11.3651C122.38 11.5828 122.535 11.8433 122.625 12.1272C122.715 12.4112 122.739 12.7114 122.694 13.0056V16.9509H121.463V13.3076C121.463 12.3282 121.028 11.8412 120.118 11.8412C119.911 11.8318 119.706 11.866 119.515 11.9416C119.323 12.0172 119.151 12.1322 119.01 12.2789C118.868 12.4256 118.761 12.6005 118.695 12.7915C118.629 12.9825 118.606 13.1852 118.628 13.3856V16.9509H117.397V10.8565Z"
                                                    fill="white" />
                                                <path
                                                    d="M129.65 9.33916V10.8843H131.001V11.8974H129.65V15.0312C129.65 15.6696 129.919 15.9491 130.532 15.9491C130.689 15.9486 130.845 15.9393 131.001 15.9213V16.9232C130.78 16.9619 130.556 16.9824 130.331 16.9847C128.963 16.9847 128.417 16.5141 128.417 15.3391V11.8973H127.427V10.8842H128.417V9.33916H129.65Z"
                                                    fill="white" />
                                                <path
                                                    d="M132.682 8.47739H133.902V11.8359H134C134.164 11.4849 134.434 11.1918 134.774 10.9964C135.115 10.801 135.508 10.713 135.902 10.7441C136.204 10.7281 136.505 10.7773 136.786 10.8884C137.066 10.9994 137.317 11.1695 137.523 11.3865C137.728 11.6035 137.881 11.8621 137.972 12.1438C138.064 12.4255 138.09 12.7234 138.05 13.0162V16.951H136.818V13.3129C136.818 12.3395 136.354 11.8465 135.484 11.8465C135.272 11.8295 135.059 11.8579 134.86 11.9297C134.661 12.0015 134.48 12.115 134.331 12.2622C134.181 12.4093 134.066 12.5867 133.994 12.7817C133.922 12.9768 133.895 13.1849 133.913 13.3915V16.9509H132.682L132.682 8.47739Z"
                                                    fill="white" />
                                                <path
                                                    d="M145.227 15.3054C145.06 15.8624 144.697 16.3442 144.203 16.6666C143.709 16.9889 143.115 17.1312 142.524 17.0686C142.113 17.0792 141.705 17.0023 141.328 16.8432C140.95 16.6842 140.613 16.4467 140.339 16.1474C140.064 15.8481 139.86 15.4941 139.74 15.11C139.62 14.7259 139.587 14.3208 139.643 13.9229C139.588 13.5238 139.622 13.1179 139.742 12.7326C139.862 12.3473 140.065 11.9916 140.338 11.6897C140.61 11.3878 140.946 11.1467 141.322 10.9826C141.699 10.8186 142.107 10.7354 142.519 10.7389C144.254 10.7389 145.301 11.8974 145.301 13.8112V14.2309H140.897V14.2983C140.878 14.5219 140.907 14.7471 140.982 14.9592C141.057 15.1714 141.176 15.3659 141.332 15.5303C141.489 15.6946 141.679 15.8253 141.89 15.9138C142.101 16.0023 142.328 16.0467 142.558 16.0442C142.853 16.0788 143.151 16.027 143.415 15.8954C143.679 15.7638 143.898 15.5585 144.042 15.3054L145.227 15.3054ZM140.897 13.3414H144.047C144.063 13.1368 144.034 12.9314 143.964 12.7382C143.893 12.545 143.782 12.3684 143.638 12.2197C143.493 12.0711 143.318 11.9536 143.124 11.8748C142.93 11.7961 142.722 11.7579 142.512 11.7626C142.299 11.7599 142.088 11.799 141.891 11.8774C141.694 11.9559 141.514 12.0721 141.364 12.2192C141.213 12.3663 141.095 12.5414 141.014 12.7341C140.934 12.9269 140.894 13.1333 140.897 13.3414H140.897Z"
                                                    fill="white" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div>
                                        <a id="googlePlayDownloadBtn"
                                            href="https://play.google.com/store/apps/details?id=com.haryadewalayanankonstruksi&hl=en">
                                            <svg width="159" height="47" viewBox="0 0 159 47" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="158.66" height="46.3438" rx="8"
                                                    fill="#1A1B20" />
                                                <path
                                                    d="M24.4934 22.4789L11.7039 36.0528C11.7051 36.0552 11.7051 36.0588 11.7063 36.0612C12.0991 37.5351 13.4445 38.6198 15.0421 38.6198C15.6812 38.6198 16.2806 38.4469 16.7947 38.1442L16.8356 38.1201L31.2311 29.8136L24.4934 22.4789Z"
                                                    fill="#EA4335" />
                                                <path
                                                    d="M37.4318 20.1675L37.4198 20.1591L31.2046 16.5566L24.2026 22.7874L31.2298 29.8122L37.4114 26.2457C38.4949 25.6595 39.2312 24.5172 39.2312 23.2006C39.2312 21.8913 38.5057 20.7549 37.4318 20.1675Z"
                                                    fill="#FBBC04" />
                                                <path
                                                    d="M11.7037 10.29C11.6268 10.5735 11.586 10.8714 11.586 11.1789V35.1651C11.586 35.4726 11.6268 35.7705 11.7049 36.0528L24.9328 22.8261L11.7037 10.29Z"
                                                    fill="#4285F4" />
                                                <path
                                                    d="M24.5879 23.1718L31.2067 16.5542L16.8279 8.21767C16.3054 7.90415 15.6952 7.72396 15.0429 7.72396C13.4453 7.72396 12.0975 8.81108 11.7047 10.2862C11.7047 10.2874 11.7035 10.2886 11.7035 10.2898L24.5879 23.1718Z"
                                                    fill="#34A853" />
                                                <path
                                                    d="M58.0572 11.5594C58.0572 12.5109 57.7756 13.2682 57.2113 13.8337C56.5698 14.5058 55.7352 14.8419 54.7088 14.8419C53.7244 14.8419 52.8887 14.5013 52.2018 13.8189C51.5126 13.1377 51.1697 12.2918 51.1697 11.2835C51.1697 10.2741 51.5126 9.42936 52.2018 8.74696C52.8887 8.06571 53.7244 7.72394 54.7088 7.72394C55.1959 7.72394 55.6637 7.81932 56.1065 8.01007C56.5505 8.20082 56.9059 8.45402 57.1727 8.77081L56.5732 9.37031C56.1224 8.83212 55.5013 8.56189 54.7088 8.56189C53.9912 8.56189 53.3713 8.81395 52.8478 9.31808C52.3244 9.82335 52.0633 10.4774 52.0633 11.2835C52.0633 12.0885 52.3244 12.7437 52.8478 13.2478C53.3713 13.7531 53.9912 14.004 54.7088 14.004C55.4695 14.004 56.1031 13.7508 56.6118 13.2433C56.9411 12.9128 57.1307 12.4541 57.1818 11.8637H54.7088V11.0451H58.0095C58.0413 11.2233 58.0572 11.3948 58.0572 11.5594Z"
                                                    fill="white" />
                                                <path
                                                    d="M58.0572 11.5594C58.0572 12.5109 57.7756 13.2682 57.2113 13.8337C56.5698 14.5058 55.7352 14.8419 54.7088 14.8419C53.7244 14.8419 52.8887 14.5013 52.2018 13.8189C51.5126 13.1377 51.1697 12.2918 51.1697 11.2835C51.1697 10.2741 51.5126 9.42936 52.2018 8.74696C52.8887 8.06571 53.7244 7.72394 54.7088 7.72394C55.1959 7.72394 55.6637 7.81932 56.1065 8.01007C56.5505 8.20082 56.9059 8.45402 57.1727 8.77081L56.5732 9.37031C56.1224 8.83212 55.5013 8.56189 54.7088 8.56189C53.9912 8.56189 53.3713 8.81395 52.8478 9.31808C52.3244 9.82335 52.0633 10.4774 52.0633 11.2835C52.0633 12.0885 52.3244 12.7437 52.8478 13.2478C53.3713 13.7531 53.9912 14.004 54.7088 14.004C55.4695 14.004 56.1031 13.7508 56.6118 13.2433C56.9411 12.9128 57.1307 12.4541 57.1818 11.8637H54.7088V11.0451H58.0095C58.0413 11.2233 58.0572 11.3948 58.0572 11.5594Z"
                                                    fill="white" />
                                                <path
                                                    d="M63.2907 8.71415H60.1887V10.8737H62.9864V11.6924H60.1887V13.852H63.2907V14.6899H59.3133V7.87734H63.2907V8.71415Z"
                                                    fill="white" />
                                                <path
                                                    d="M63.2907 8.71415H60.1887V10.8737H62.9864V11.6924H60.1887V13.852H63.2907V14.6899H59.3133V7.87734H63.2907V8.71415Z"
                                                    fill="white" />
                                                <path
                                                    d="M66.982 14.6896H66.1066V8.71385H64.2036V7.87704H68.885V8.71385H66.982V14.6896Z"
                                                    fill="white" />
                                                <path
                                                    d="M66.982 14.6896H66.1066V8.71385H64.2036V7.87704H68.885V8.71385H66.982V14.6896Z"
                                                    fill="white" />
                                                <path d="M72.2722 7.87704H73.1476V14.6896H72.2722V7.87704Z"
                                                    fill="white" />
                                                <path
                                                    d="M77.03 14.6896H76.1546V8.71385H74.2516V7.87704H78.933V8.71385H77.03V14.6896Z"
                                                    fill="white" />
                                                <path
                                                    d="M77.03 14.6896H76.1546V8.71385H74.2516V7.87704H78.933V8.71385H77.03V14.6896Z"
                                                    fill="white" />
                                                <path
                                                    d="M83.4463 13.2387C83.9504 13.7497 84.5669 14.004 85.297 14.004C86.0271 14.004 86.6436 13.7497 87.1477 13.2387C87.6519 12.7278 87.9051 12.076 87.9051 11.2835C87.9051 10.491 87.6519 9.83811 87.1477 9.3283C86.6436 8.81736 86.0271 8.56189 85.297 8.56189C84.5669 8.56189 83.9504 8.81736 83.4463 9.3283C82.9433 9.83811 82.6901 10.491 82.6901 11.2835C82.6901 12.076 82.9433 12.7278 83.4463 13.2387ZM87.7949 13.8087C87.125 14.4979 86.2928 14.8419 85.297 14.8419C84.3012 14.8419 83.469 14.4979 82.8002 13.8087C82.1303 13.1206 81.7965 12.2793 81.7965 11.2835C81.7965 10.2877 82.1303 9.44525 82.8002 8.75718C83.469 8.06911 84.3012 7.72394 85.297 7.72394C86.2871 7.72394 87.1171 8.07025 87.7904 8.76172C88.4626 9.4532 88.7987 10.2934 88.7987 11.2835C88.7987 12.2793 88.4637 13.1206 87.7949 13.8087Z"
                                                    fill="white" />
                                                <path
                                                    d="M83.4463 13.2387C83.9504 13.7497 84.5669 14.004 85.297 14.004C86.0271 14.004 86.6436 13.7497 87.1477 13.2387C87.6519 12.7278 87.9051 12.076 87.9051 11.2835C87.9051 10.491 87.6519 9.83811 87.1477 9.3283C86.6436 8.81736 86.0271 8.56189 85.297 8.56189C84.5669 8.56189 83.9504 8.81736 83.4463 9.3283C82.9433 9.83811 82.6901 10.491 82.6901 11.2835C82.6901 12.076 82.9433 12.7278 83.4463 13.2387ZM87.7949 13.8087C87.125 14.4979 86.2928 14.8419 85.297 14.8419C84.3012 14.8419 83.469 14.4979 82.8002 13.8087C82.1303 13.1206 81.7965 12.2793 81.7965 11.2835C81.7965 10.2877 82.1303 9.44525 82.8002 8.75718C83.469 8.06911 84.3012 7.72394 85.297 7.72394C86.2871 7.72394 87.1171 8.07025 87.7904 8.76172C88.4626 9.4532 88.7987 10.2934 88.7987 11.2835C88.7987 12.2793 88.4637 13.1206 87.7949 13.8087Z"
                                                    fill="white" />
                                                <path
                                                    d="M90.0271 14.6896V7.87704H91.0921L94.403 13.1761H94.4416L94.403 11.8635V7.87704H95.2796V14.6896H94.3656L90.9014 9.13282H90.8639L90.9014 10.4465V14.6896H90.0271Z"
                                                    fill="white" />
                                                <path
                                                    d="M90.0271 14.6896V7.87704H91.0921L94.403 13.1761H94.4416L94.403 11.8635V7.87704H95.2796V14.6896H94.3656L90.9014 9.13282H90.8639L90.9014 10.4465V14.6896H90.0271Z"
                                                    fill="white" />
                                                <path
                                                    d="M125.635 33.9918H127.754V19.7979H125.635V33.9918ZM144.718 24.9107L142.289 31.0647H142.217L139.696 24.9107H137.414L141.194 33.5116L139.04 38.2962H141.248L147.074 24.9107H144.718ZM132.703 32.3795C132.008 32.3795 131.041 32.0332 131.041 31.1737C131.041 30.0792 132.245 29.6591 133.287 29.6591C134.218 29.6591 134.657 29.86 135.223 30.1337C135.058 31.4485 133.926 32.3795 132.703 32.3795ZM132.958 24.6007C131.425 24.6007 129.835 25.2763 129.179 26.7739L131.059 27.5585C131.461 26.7739 132.209 26.5173 132.995 26.5173C134.09 26.5173 135.204 27.1747 135.223 28.3442V28.4896C134.839 28.2704 134.018 27.9423 133.013 27.9423C130.986 27.9423 128.922 29.0561 128.922 31.1374C128.922 33.0369 130.584 34.2609 132.446 34.2609C133.871 34.2609 134.657 33.6217 135.15 32.8723H135.223V33.968H137.267V28.5259C137.267 26.0064 135.387 24.6007 132.958 24.6007M119.865 26.6388H116.851V21.7735H119.865C121.449 21.7735 122.348 23.0849 122.348 24.2056C122.348 25.3058 121.449 26.6388 119.865 26.6388ZM119.81 19.7979H114.734V33.9918H116.851V28.6145H119.81C122.158 28.6145 124.467 26.9136 124.467 24.2056C124.467 21.4976 122.158 19.7979 119.81 19.7979M92.1274 32.3818C90.6638 32.3818 89.4387 31.1567 89.4387 29.474C89.4387 27.7731 90.6638 26.5287 92.1274 26.5287C93.5728 26.5287 94.7059 27.7731 94.7059 29.474C94.7059 31.1567 93.5728 32.3818 92.1274 32.3818ZM94.5606 25.7055H94.4868C94.0111 25.1389 93.0971 24.6268 91.9446 24.6268C89.5295 24.6268 87.3166 26.7478 87.3166 29.474C87.3166 32.1808 89.5295 34.2848 91.9446 34.2848C93.0971 34.2848 94.0111 33.7727 94.4868 33.1868H94.5606V33.8828C94.5606 35.7302 93.5728 36.718 91.9809 36.718C90.682 36.718 89.877 35.7847 89.5477 34.9978L87.7004 35.7665C88.2306 37.0473 89.6397 38.6198 91.9809 38.6198C94.4686 38.6198 96.5726 37.1563 96.5726 33.5899V24.9186H94.5606V25.7055ZM98.0362 33.9918H100.158V19.7967H98.0362V33.9918ZM103.285 29.3093C103.231 27.4438 104.731 26.4924 105.809 26.4924C106.652 26.4924 107.365 26.9125 107.602 27.5165L103.285 29.3093ZM109.871 27.6993C109.469 26.6207 108.243 24.6268 105.737 24.6268C103.249 24.6268 101.182 26.5832 101.182 29.4558C101.182 32.1627 103.231 34.2848 105.974 34.2848C108.188 34.2848 109.469 32.9314 109.999 32.1445L108.353 31.0465C107.804 31.8516 107.054 32.3818 105.974 32.3818C104.895 32.3818 104.127 31.8879 103.633 30.9194L110.09 28.2477L109.871 27.6993ZM58.4268 26.1086V28.1569H63.3284C63.182 29.3093 62.7982 30.1507 62.2134 30.7354C61.4993 31.4496 60.3831 32.2365 58.4268 32.2365C55.4077 32.2365 53.0483 29.8033 53.0483 26.7853C53.0483 23.7662 55.4077 21.3341 58.4268 21.3341C60.055 21.3341 61.2438 21.9745 62.1215 22.7977L63.5669 21.3523C62.3406 20.1816 60.7135 19.2847 58.4268 19.2847C54.2927 19.2847 50.8172 22.6512 50.8172 26.7853C50.8172 30.9194 54.2927 34.2848 58.4268 34.2848C60.6579 34.2848 62.3406 33.5524 63.6577 32.1808C65.0123 30.8274 65.4324 28.9256 65.4324 27.3882C65.4324 26.9125 65.396 26.4742 65.3222 26.1086H58.4268ZM71.0062 32.3818C69.5426 32.3818 68.28 31.1748 68.28 29.4558C68.28 27.7175 69.5426 26.5287 71.0062 26.5287C72.4686 26.5287 73.7312 27.7175 73.7312 29.4558C73.7312 31.1748 72.4686 32.3818 71.0062 32.3818ZM71.0062 24.6268C68.3345 24.6268 66.1579 26.657 66.1579 29.4558C66.1579 32.2365 68.3345 34.2848 71.0062 34.2848C73.6767 34.2848 75.8533 32.2365 75.8533 29.4558C75.8533 26.657 73.6767 24.6268 71.0062 24.6268ZM81.5804 32.3818C80.1169 32.3818 78.8543 31.1748 78.8543 29.4558C78.8543 27.7175 80.1169 26.5287 81.5804 26.5287C83.044 26.5287 84.3054 27.7175 84.3054 29.4558C84.3054 31.1748 83.044 32.3818 81.5804 32.3818ZM81.5804 24.6268C78.9099 24.6268 76.7333 26.657 76.7333 29.4558C76.7333 32.2365 78.9099 34.2848 81.5804 34.2848C84.2509 34.2848 86.4276 32.2365 86.4276 29.4558C86.4276 26.657 84.2509 24.6268 81.5804 24.6268Z"
                                                    fill="white" />
                                            </svg>

                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-cloak x-transition x-show="$store.robotPage.isStartRobotConfirmationModalOpen"
                    class="fixed top-0 left-0 h-svh w-full px-4 lg:px-96 pt-6 z-20">
                    <div class="absolute inset-0 h-svh w-full px-4 lg:px-96 pt-6 z-20 bg-dashboard opacity-85"></div>
                    <div class="relative w-full h-full flex items-center justify-center z-30">
                        <div
                            class="max-w-sm mx-auto bg-dashboard border border-[#26252a] rounded-2xl pointer-events-auto">
                            <div class="p-6 overflow-y-auto text-center">
                                <div class="flex justify-center mb-8">
                                    <div
                                        class="size-18 flex items-center justify-center rounded-full border-3 border-[#05df72]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                            viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="animate-spin lucide lucide-radio-icon lucide-radio">
                                            <path d="M16.247 7.761a6 6 0 0 1 0 8.478" />
                                            <path d="M19.075 4.933a10 10 0 0 1 0 14.134" />
                                            <path d="M4.925 19.067a10 10 0 0 1 0-14.134" />
                                            <path d="M7.753 16.239a6 6 0 0 1 0-8.478" />
                                            <circle cx="12" cy="12" r="2" />
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-white font-semibold text-xl mb-4">
                                    Robot is connecting to the markets...
                                </p>
                                <div class="w-full flex flex-col gap-y-2 justify-center items-center mb-5">
                                    <template x-if="$store.robotPage.isBrokerConnecting === true">
                                        <div
                                            class="bg-dashboard border border-[#26252a] py-2 px-3 flex items-center gap-x-1.5 rounded-full">
                                            <div>
                                                <i class="fa-solid fa-circle-notch fa-spin text-[#05df72]"></i>
                                            </div>
                                            <div>
                                                <p class="font-light text-xs text-white">Connecting to broker</p>
                                            </div>
                                        </div>
                                    </template>

                                    <template x-if="$store.robotPage.isBrokerConnecting === false">
                                        <div
                                            class="bg-dashboard border border-[#26252a] py-2 px-3 flex items-center gap-x-1.5 rounded-full">
                                            <div>
                                                <svg width="16" height="16" viewBox="0 0 16 16"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_850_2)">
                                                        <path
                                                            d="M11.3335 2.22667C12.339 2.80724 13.1755 3.64035 13.76 4.64353C14.3446 5.64672 14.6571 6.78518 14.6664 7.94623C14.6758 9.10727 14.3818 10.2506 13.8135 11.2631C13.2452 12.2756 12.4223 13.1221 11.4263 13.7189C10.4303 14.3156 9.29574 14.6419 8.13489 14.6654C6.97405 14.6889 5.8272 14.4088 4.80787 13.8528C3.78854 13.2969 2.93208 12.4844 2.32327 11.4957C1.71447 10.507 1.37444 9.37647 1.33683 8.216L1.3335 8L1.33683 7.784C1.37416 6.63266 1.70919 5.51064 2.30926 4.52733C2.90932 3.54402 3.75393 2.73297 4.76076 2.17325C5.76758 1.61354 6.90226 1.32426 8.05417 1.33362C9.20607 1.34299 10.3359 1.65066 11.3335 2.22667ZM10.4715 6.19533C10.3567 6.08055 10.204 6.01159 10.0419 6.00141C9.87993 5.99122 9.71976 6.0405 9.5915 6.14L9.52883 6.19533L7.3335 8.39L6.4715 7.52867L6.40883 7.47333C6.28055 7.3739 6.12041 7.32468 5.95843 7.3349C5.79645 7.34512 5.64377 7.41408 5.529 7.52884C5.41424 7.6436 5.34528 7.79629 5.33506 7.95827C5.32485 8.12025 5.37407 8.28039 5.4735 8.40867L5.52883 8.47133L6.86216 9.80467L6.92483 9.86C7.04174 9.95071 7.18552 9.99994 7.3335 9.99994C7.48147 9.99994 7.62525 9.95071 7.74216 9.86L7.80483 9.80467L10.4715 7.138L10.5268 7.07533C10.6263 6.94706 10.6756 6.7869 10.6654 6.62488C10.6552 6.46286 10.5863 6.31013 10.4715 6.19533Z"
                                                            fill="#05DF72" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_850_2">
                                                            <rect width="16" height="16" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-light text-xs text-white">Connected to </p>
                                            </div>
                                            <div>
                                                <img class="inline" src="{{ asset('assets/icons/xtb.svg') }}"
                                                    alt="xtb-logo">
                                            </div>
                                        </div>
                                    </template>

                                    <template x-if="$store.robotPage.isExchangeConnecting === true">
                                        <div
                                            class="bg-dashboard border border-[#26252a] py-2 px-3 flex items-center gap-x-1.5 rounded-full">
                                            <div>
                                                <i class="fa-solid fa-circle-notch fa-spin text-[#05df72]"></i>
                                            </div>
                                            <div>
                                                <p class="font-light text-xs text-white">Connecting to crypto exchange
                                                </p>
                                            </div>
                                        </div>
                                    </template>

                                    <template x-if="$store.robotPage.isExchangeConnecting === false">
                                        <div
                                            class="bg-dashboard border border-[#26252a] py-2 px-3 flex items-center gap-x-1.5 rounded-full">
                                            <div>
                                                <svg width="16" height="16" viewBox="0 0 16 16"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_850_2)">
                                                        <path
                                                            d="M11.3335 2.22667C12.339 2.80724 13.1755 3.64035 13.76 4.64353C14.3446 5.64672 14.6571 6.78518 14.6664 7.94623C14.6758 9.10727 14.3818 10.2506 13.8135 11.2631C13.2452 12.2756 12.4223 13.1221 11.4263 13.7189C10.4303 14.3156 9.29574 14.6419 8.13489 14.6654C6.97405 14.6889 5.8272 14.4088 4.80787 13.8528C3.78854 13.2969 2.93208 12.4844 2.32327 11.4957C1.71447 10.507 1.37444 9.37647 1.33683 8.216L1.3335 8L1.33683 7.784C1.37416 6.63266 1.70919 5.51064 2.30926 4.52733C2.90932 3.54402 3.75393 2.73297 4.76076 2.17325C5.76758 1.61354 6.90226 1.32426 8.05417 1.33362C9.20607 1.34299 10.3359 1.65066 11.3335 2.22667ZM10.4715 6.19533C10.3567 6.08055 10.204 6.01159 10.0419 6.00141C9.87993 5.99122 9.71976 6.0405 9.5915 6.14L9.52883 6.19533L7.3335 8.39L6.4715 7.52867L6.40883 7.47333C6.28055 7.3739 6.12041 7.32468 5.95843 7.3349C5.79645 7.34512 5.64377 7.41408 5.529 7.52884C5.41424 7.6436 5.34528 7.79629 5.33506 7.95827C5.32485 8.12025 5.37407 8.28039 5.4735 8.40867L5.52883 8.47133L6.86216 9.80467L6.92483 9.86C7.04174 9.95071 7.18552 9.99994 7.3335 9.99994C7.48147 9.99994 7.62525 9.95071 7.74216 9.86L7.80483 9.80467L10.4715 7.138L10.5268 7.07533C10.6263 6.94706 10.6756 6.7869 10.6654 6.62488C10.6552 6.46286 10.5863 6.31013 10.4715 6.19533Z"
                                                            fill="#05DF72" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_850_2">
                                                            <rect width="16" height="16" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-light text-xs text-white">Connected to </p>
                                            </div>
                                            <div class="-mt-1">
                                                <img class="inline" src="{{ asset('assets/icons/bybit.svg') }}"
                                                    alt="bybit-logo">
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                <div class="w-full flex justify-center items-center">
                                    <div class="p-4 bg-dashboard border border-[#26252a] w-full rounded-lg">
                                        <p class="text-white font-semibold text-base mb-4 leading-4">Trade Details</p>
                                        <div
                                            class="flex items-center justify-center gap-x-1 pb-2 border-b border-[#26252a]">
                                            <div class="flex-none">
                                                <svg width="22" height="22" viewBox="0 0 22 22"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_519_351)">
                                                        <mask id="mask0_519_351" style="mask-type:luminance"
                                                            maskUnits="userSpaceOnUse" x="0" y="0" width="22"
                                                            height="22">
                                                            <path d="M22 0H0V22H22V0Z" fill="white" />
                                                        </mask>
                                                        <g mask="url(#mask0_519_351)">
                                                            <path
                                                                d="M15.3086 7.33333C15.1262 6.81563 14.7929 6.36438 14.3519 6.03766C13.9108 5.71093 13.382 5.52368 12.8336 5.5H9.16699C8.43764 5.5 7.73817 5.78973 7.22244 6.30546C6.70672 6.82118 6.41699 7.52065 6.41699 8.25C6.41699 8.97935 6.70672 9.67882 7.22244 10.1945C7.73817 10.7103 8.43764 11 9.16699 11H12.8336C13.563 11 14.2624 11.2897 14.7782 11.8055C15.2939 12.3212 15.5836 13.0207 15.5836 13.75C15.5836 14.4793 15.2939 15.1788 14.7782 15.6945C14.2624 16.2103 13.563 16.5 12.8336 16.5H9.16699C8.61859 16.4763 8.08982 16.2891 7.64874 15.9623C7.20766 15.6356 6.87445 15.1844 6.69199 14.6667"
                                                                stroke="#05DF72" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M11 2.75V5.5M11 16.5V19.25" stroke="#05DF72"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </g>
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_519_351">
                                                            <rect width="22" height="22" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </div>
                                            <div class="flex-none">
                                                <p class="text-zinc-300 text-xs">Trade Amount</p>
                                            </div>
                                            <div class="flex-1 text-end text-white font-medium text-sm">
                                                @money(floatval($this->amount))</div>
                                        </div>

                                        <div
                                            class="flex items-center justify-center gap-x-1 py-2 border-b border-[#26252a]">
                                            <div class="flex-none">
                                                <svg width="22" height="22" viewBox="0 0 22 22"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_519_298)">
                                                        <path
                                                            d="M7.3335 6.41667C7.3335 7.38913 7.7198 8.32176 8.40744 9.00939C9.09507 9.69703 10.0277 10.0833 11.0002 10.0833C11.9726 10.0833 12.9053 9.69703 13.5929 9.00939C14.2805 8.32176 14.6668 7.38913 14.6668 6.41667C14.6668 5.44421 14.2805 4.51158 13.5929 3.82394C12.9053 3.13631 11.9726 2.75 11.0002 2.75C10.0277 2.75 9.09507 3.13631 8.40744 3.82394C7.7198 4.51158 7.3335 5.44421 7.3335 6.41667Z"
                                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M5.5 19.25V17.4167C5.5 16.4442 5.88631 15.5116 6.57394 14.8239C7.26158 14.1363 8.19421 13.75 9.16667 13.75H12.8333C13.8058 13.75 14.7384 14.1363 15.4261 14.8239C16.1137 15.5116 16.5 16.4442 16.5 17.4167V19.25"
                                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_519_298">
                                                            <rect width="22" height="22" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </div>
                                            <div class="flex-none">
                                                <p class="text-zinc-300 text-xs">Account</p>
                                            </div>
                                            <div class="flex-1 text-end text-white font-medium text-sm">
                                                {{ $this->accountType }}</div>
                                        </div>

                                        <div class="flex items-center justify-center gap-x-1 py-2">
                                            <div class="flex-none">
                                                <img class="w-4.5"
                                                    src="{{ asset('assets/images/robot-illustration.png') }}"
                                                    alt="">
                                            </div>
                                            <div class="flex-none">
                                                <p class="text-zinc-300 text-xs">Trading Strategy</p>
                                            </div>
                                            <div class="flex-1 text-end text-white font-medium text-sm">
                                                {{ $this->strategy['name'] }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        $wire.on('robot-stopped', (event) => {
            const robotStoppedToastMarkup = `
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
                text: robotStoppedToastMarkup,
                className: "hs-toastify-on:opacity-100 opacity-0 absolute top-0 start-1/2 -translate-x-1/2 z-90 w-4/5 md:w-1/2 lg:w-1/4 transition-all duration-300 bg-dim border border-[#26252a] text-sm text-white rounded-xl shadow-lg [&>.toast-close]:hidden",
                duration: 4000,
                close: true,
                escapeMarkup: false
            }).showToast();
        });
    </script>
@endscript


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cancelInstallCount = parseInt(localStorage.getItem('cancelInstallCount') || '0', 10);
        const lastShownDate = localStorage.getItem('lastShownDate');
        const today = new Date().toDateString();

        if (cancelInstallCount < 3 && lastShownDate !== today) {
            setTimeout(function() {
                const modal = document.getElementById('downloadModal');
                if (modal) {
                    modal.classList.remove('hidden');
                }
            }, 5000);
        }

        // Download buttons set count to 3
        const googlePlayBtn = document.getElementById('googlePlayDownloadBtn');
        const appStoreBtn = document.getElementById('appStoreDownloadBtn');

        if (googlePlayBtn) {
            googlePlayBtn.addEventListener('click', function() {
                localStorage.setItem('cancelInstallCount', '3');
                const modal = document.getElementById('downloadModal');
                if (modal) {
                    modal.classList.add('hidden');
                }
            });
        }

        if (appStoreBtn) {
            appStoreBtn.addEventListener('click', function() {
                localStorage.setItem('cancelInstallCount', '3');
                const modal = document.getElementById('downloadModal');
                if (modal) {
                    modal.classList.add('hidden');
                }
            });
        }

        // Cancel button increments count and sets today's date
        const cancelBtn = document.getElementById('cancelDownloadModalBtn');
        if (cancelBtn) {
            cancelBtn.addEventListener('click', function() {
                const current = parseInt(localStorage.getItem('cancelInstallCount') || '0', 10);
                localStorage.setItem('cancelInstallCount', current + 1);
                localStorage.setItem('lastShownDate', today);

                const modal = document.getElementById('downloadModal');
                if (modal) {
                    modal.classList.add('hidden');
                }
            });
        }
    });
</script>

<script>
    let lastToast = null;

    function toastRobotError(message) {
        if (lastToast) {
            lastToast.hideToast();
        }

        const robotErrorToastMarkup = `
            <div class="flex items-center p-4">
                <div class="shrink-0">
                    <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-alert-icon lucide-shield-alert"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>
                </div>
                <div class="ms-3 flex-1">
                    <p class="text-xs font-semibold text-white">${message}</p>
                </div>
            </div>
        `;

        lastToast = Toastify({
            text: robotErrorToastMarkup,
            className: "hs-toastify-on:opacity-100 opacity-0 absolute top-0 start-1/2 -translate-x-1/2 z-90 w-4/5 md:w-1/2 lg:w-1/4 transition-all duration-300 bg-dim border border-[#26252a] text-sm text-white rounded-xl shadow-lg [&>.toast-close]:hidden",
            duration: 3000,
            close: true,
            escapeMarkup: false
        });

        lastToast.showToast();
    }

    document.addEventListener('alpine:init', () => {
        Alpine.store('robotPage', {
            isStartRobotConfirmationModalOpen: false,

            isTradeDetailsConfirmationModalOpen: false,

            isBrokerConnecting: true,

            isExchangeConnecting: true,

            checkMinimumAmount(wire) {
                if (parseFloat(wire.amount) < parseInt(wire.minimumAmount) && parseFloat(wire
                        .amount) !== 0) {
                    let message = `Minimum amount is $${wire.minimumAmount}`;
                    toastRobotError(message);
                    return;
                }
            },

            toggleTradeDetailsConfirmationModal(wire) {
                if (wire.amount === '') {
                    toastRobotError('Amount field is empty');
                    return;
                }
                this.isTradeDetailsConfirmationModalOpen = !this.isTradeDetailsConfirmationModalOpen;
            },

            toggleStartRobotConfirmationModal(wire) {
                if (wire.isBanned) {
                    toastRobotError(
                        'Your account has been banned. Reach out to support at support@yfxai.com.'
                    );
                    return;
                }

                if (wire.country === 'Brazil') {
                    toastRobotError(
                        'Brazil Region Upgrade in Progress. Trades and withdrawals are temporarily paused while we complete a system upgrade. Services will resume shortly'
                    );
                    return;
                }

                if (wire.isUserPioneer) {
                    toastRobotError(
                        'Yfxai is currently not available in your region.'
                    );
                    return;
                }

                // if (wire.activeBotCount > 0) {
                //     if (wire.accountTypeSlug === 'live' && wire.totalLiveBalance < wire
                //         .minimumBalanceForDoubleTrades) {
                //         let message =
                //             `Multiple bots are available only for accounts with a minimum balance of $${wire.minimumBalanceForDoubleTrades}`;
                //         toastRobotError(message);
                //         return;
                //     }
                //     if (wire.accountTypeSlug === 'demo' && wire.totalDemoBalance < wire
                //         .minimumBalanceForDoubleTrades) {
                //         let message =
                //             `You need to have at least $${wire.minimumBalanceForDoubleTrades} minimum balance to initiate multiple trades`;
                //         toastRobotError(message);
                //         return;
                //     }
                // }

                // if (wire.isLockoutActive ) {
                //     wire.redirectToLockoutRoute();
                //     return;
                // }

                if (wire.accountStatus === 'inactive') {
                    toastRobotError(
                        'This account has been disabled and unable to perform any transactions. Kindly contact support for more details.'
                    );
                    return;
                }

                if (wire.amount === '') {
                    toastRobotError('Amount field is empty');
                    return;
                }

                if (parseInt(wire.amount) === 0) {
                    toastRobotError('Amount must be greater than 0');
                    return;
                }

                if (parseFloat(wire.amount) < parseInt(wire.minimumAmount) && parseFloat(wire
                        .amount) !== 0) {
                    let message = `Minimum amount is $${wire.minimumAmount}`;
                    toastRobotError(message);
                    return;
                }

                if (parseFloat(wire.amount) > parseFloat(wire.accountBalance / 100)) {
                    toastRobotError('Insufficient balance');
                    return;
                }

                // if (wire.activeBotCount > 0) {
                //     toastRobotError('Bot is still trading');
                //     return;
                // }

                this.isStartRobotConfirmationModalOpen = !this.isStartRobotConfirmationModalOpen;

                setTimeout(() => {
                    this.isBrokerConnecting = false;
                }, 4000);

                setTimeout(() => {
                    this.isExchangeConnecting = false;
                }, 8000);

                setTimeout(() => {
                    wire.startRobot();
                }, 10000);
            }
        })
    })
</script>
