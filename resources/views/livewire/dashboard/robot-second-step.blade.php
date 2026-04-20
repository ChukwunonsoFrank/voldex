<div x-data class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:px-96 lg:pt-6">

            <div class="flex items-center mb-3 mt-2 sticky top-0 bg-dashboard z-10 py-2 lg:pt-4">
                <div class="flex-1">
                    <h1 class="text-white text-lg md:text-xl lg:text-2xl font-bold tracking-[0.15px]">
                        Next Step
                    </h1>
                </div>
            </div>

            <div class="lg:h-full lg:pb-24 lg:overflow-scroll scrollbar-hide">
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

                <div class="mb-4">
                    <label for="input-label" class="block text-sm font-medium mb-2 text-zinc-300">Lot Size</label>
                    <div class="w-full overflow-scroll scrollbar-hide">
                        @foreach ($strategies as $strategy)
                            <div wire:click="selectStrategy({{ $strategy['id'] }})"
                                class="{{ $this->strategySlug === $strategy['name'] ? 'border border-[#1E90FF]' : 'border border-[#26252a]' }} hover:bg-[#3b3a41] cursor-pointer flex px-3 py-3 pb-4 gap-x-4 items-center mb-1.5 text-[#FFFFFF] bg-dim rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
                                <div class="flex-none">
                                    <img class="w-12" src="{{ asset('assets/images/robot-illustration.png') }}">
                                </div>
                                <div class="flex-1">
                                    <h2 class="font-bold mb-1 text-base text-white">
                                        {{ $strategy['name'] }}
                                    </h2>
                                    <div class="mb-1">
                                        <p class="text-xs text-[#a4a4a4] font-normal">
                                            Estimated 24 hours returns range from
                                            {{ $strategy['min_roi'] }}% to
                                            {{ $strategy['max_roi'] }}%, depending on market
                                            conditions.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mb-6 flex items-center space-x-2">
                    <div class="flex-1">
                        <label for="input-label" class="block text-sm font-medium mb-2 text-zinc-300">
                            Duration
                        </label>
                        <div wire:click="selectDurationType('fixed')"
                            class="{{ $this->durationType === 'fixed' ? 'border border-[#1E90FF]' : 'border border-[#26252a]' }} hover:bg-[#3b3a41] cursor-pointer flex px-5 py-3 pb-4 gap-x-4 items-center mb-1.5 text-[#FFFFFF] bg-dim rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
                            <div class="flex-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-lock-keyhole-icon lucide-lock-keyhole">
                                    <circle cx="12" cy="16" r="1" />
                                    <rect x="3" y="10" width="18" height="12" rx="2" />
                                    <path d="M7 10V7a5 5 0 0 1 10 0v3" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h2 class="font-bold mb-1 text-base text-white">
                                    Fixed
                                </h2>
                                <div>
                                    <p class="text-xs text-[#a4a4a4] font-normal">
                                        Runs for 24 hours
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div wire:click="selectDurationType('flexible')"
                            class="{{ $this->durationType === 'flexible' ? 'border border-[#1E90FF]' : 'border border-[#26252a]' }} hover:bg-[#3b3a41] cursor-pointer flex px-5 py-3 pb-4 gap-x-4 items-center mb-1.5 text-[#FFFFFF] bg-dim rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
                            <div class="flex-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-lock-keyhole-open-icon lucide-lock-keyhole-open">
                                    <circle cx="12" cy="16" r="1" />
                                    <rect width="18" height="12" x="3" y="10" rx="2" />
                                    <path d="M7 10V7a5 5 0 0 1 9.33-2.5" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h2 class="font-bold mb-1 text-base text-white">
                                    Flexible
                                </h2>
                                <div>
                                    <p class="text-xs text-[#a4a4a4] font-normal">
                                        Runs indefinitely(stop anytime)
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sticky bottom-2">
                    <a x-on:click="$store.robotSecondStepPage.toggleTradeDetailsConfirmationModal($wire);">
                        <button type="button" wire:loading.attr="disabled"
                            class="py-2.5 cursor-pointer px-4 w-full md:px-6 text-center gap-x-2 text-sm font-semibold rounded-lg bg-accent text-white focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">
                            <i wire:loading class="fa-solid fa-circle-notch fa-spin"></i>
                            <span wire:loading.remove>Start Robot</span>
                        </button>
                    </a>
                </div>

                <div x-cloak x-transition x-show="$store.robotSecondStepPage.isTradeDetailsConfirmationModalOpen"
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
                                            x-on:click="$store.robotSecondStepPage.toggleTradeDetailsConfirmationModal($wire); $store.robotSecondStepPage.toggleStartRobotConfirmationModal($wire);"
                                            type="button"
                                            class="p-3 w-full text-center text-sm font-semibold rounded-lg border border-transparent bg-accent text-white cursor-pointer hover:bg-accent focus:outline-hidden focus:bg-accent disabled:opacity-50 disabled:pointer-events-none">
                                            Start
                                        </button>
                                    </div>
                                    <div>
                                        <button
                                            x-on:click="$store.robotSecondStepPage.toggleTradeDetailsConfirmationModal($wire)"
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

                <div x-cloak x-transition x-show="$store.robotSecondStepPage.isStartRobotConfirmationModalOpen"
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
                                    <template x-if="$store.robotSecondStepPage.isBrokerConnecting === true">
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

                                    <template x-if="$store.robotSecondStepPage.isBrokerConnecting === false">
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

                                    <template x-if="$store.robotSecondStepPage.isExchangeConnecting === true">
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

                                    <template x-if="$store.robotSecondStepPage.isExchangeConnecting === false">
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
                                    <div class="p-4 bg-dashboard border border-[#3c3a43] w-full rounded-lg">
                                        <p class="text-white font-semibold text-base mb-4 leading-4">Trade Details</p>
                                        <div
                                            class="flex items-center justify-center gap-x-1 pb-2 border-b border-[#3c3a43]">
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
                                            class="flex items-center justify-center gap-x-1 py-2 border-b border-[#3c3a43]">
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
                                                @if ($this->strategy)
                                                    {{ $this->strategy['name'] }}
                                                @endif
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
            duration: 1500,
            close: true,
            escapeMarkup: false
        });

        lastToast.showToast();
    }

    document.addEventListener('alpine:init', () => {
        Alpine.store('robotSecondStepPage', {
            isStartRobotConfirmationModalOpen: false,

            isTradeDetailsConfirmationModalOpen: false,

            isBrokerConnecting: true,

            isExchangeConnecting: true,

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

                if (wire.activeBotCount > 0) {
                    toastRobotError('Bot is still trading');
                    return;
                }

                this.isStartRobotConfirmationModalOpen = !this.isStartRobotConfirmationModalOpen;

                setTimeout(() => {
                    this.isBrokerConnecting = false;
                }, 4000);

                setTimeout(() => {
                    this.isExchangeConnecting = false;
                }, 8000);

                setTimeout(() => {
                    wire.createRobot();
                }, 10000);
            }
        })
    })
</script>
