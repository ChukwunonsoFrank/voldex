<div class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:px-96 lg:pt-6">
            <div class="my-3 sticky top-0 bg-dashboard pb-2 lg:pt-4">
                <h1 class="text-white text-lg md:text-xl lg:text-2xl font-semibold">Identity Verification</h1>
            </div>
            <div class="lg:h-full lg:pb-24 lg:overflow-scroll scrollbar-hide">
                <div class="px-4 py-5 bg-dim rounded-lg border border-[#323335]">
                    <div class="flex items-center space-x-2 -mt-0.5">
                        <div class="grow">
                            <p class="text-[10px] text-[#a4a4a4] mb-1">Current Status </p>
                            @if ($this->kycStatus === 'Not verified')
                                <p class="text-sm text-yellow-500 font-bold">Not verified</p>
                            @endif
                            @if ($this->kycStatus === 'Verified')
                                <div
                                    class="px-1.5 py-0.5 cursor-pointer inline-flex items-center border border-green-300 justify-center gap-x-1 text-xs rounded-lg">
                                    <span class="text-green-300 font-bold mt-0.5">Verified</span>
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.33366 2.5L3.75033 7.08333L1.66699 5" stroke="#7bf1a8"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-none">
                            @if (!$this->isKycPending && $this->kycStatus === 'Not verified')
                                <a href="{{ route('dashboard.kyc') }}">
                                    <button type="button"
                                        class="w-full px-6 py-2 cursor-pointer inline-flex items-center justify-center gap-x-1 text-sm font-semibold rounded-lg bg-[#F59E0B] text-white focus:outline-hidden">
                                        Verify Now
                                    </button>
                                </a>
                            @endif
                            @if ($this->isKycPending && $this->kycStatus === 'Not verified')
                                <button type="button"
                                    class="w-full px-6 py-2 cursor-pointer inline-flex items-center justify-center gap-x-1 text-sm font-semibold rounded-lg bg-[#F59E0B] text-white focus:outline-hidden">
                                    Pending Review
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                @if ($this->kycStatus === 'Not verified')
                    <div class="p-3 mt-3 bg-dim rounded-lg border border-[#323335]">
                        <h2 class="text-white text-sm font-bold mb-2">Withdrawal Limits</h2>
                        <div class="flex items-center gap-x-2">
                            <div class="flex-1">
                                <div class="w-full py-2 px-4 lg:px-10 bg-dim rounded-lg border border-[#323335]">
                                    <p class="text-[10px] text-yellow-500">Not verified</p>
                                    <p class="text-xs text-white">$10,000 daily</p>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="w-full py-2 px-4 lg:px-10 bg-dim rounded-lg border border-[#323335]">
                                    <p class="text-[10px] text-green-500">Verified</p>
                                    <p class="text-xs text-white">$10,000,000 daily</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="p-3 mt-3 bg-dim rounded-lg border border-[#323335]">
                    <h2 class="text-white text-sm font-bold mb-3">Benefits of Verification</h2>
                    <ul class="space-y-3 text-xs">
                        <li class="flex items-center gap-x-3">
                            <svg class="shrink-0 size-4 mt-0.5 text-accent" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span class="text-white">
                                Unlimited withdrawal & trading limits
                            </span>
                        </li>

                        <li class="flex items-center gap-x-3">
                            <svg class="shrink-0 size-4 mt-0.5 text-accent" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span class="text-white">
                                Access to all features
                            </span>
                        </li>

                        <li class="flex items-center gap-x-3">
                            <svg class="shrink-0 size-4 mt-0.5 text-accent" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span class="text-white">
                                Enhanced account security
                            </span>
                        </li>

                        <li class="flex items-center gap-x-3">
                            <svg class="shrink-0 size-4 mt-0.5 text-accent" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span class="text-white">
                                Higher daily profit potential
                            </span>
                        </li>

                        <li class="flex items-center gap-x-3">
                            <svg class="shrink-0 size-4 mt-0.5 text-accent" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span class="text-white">
                                Verified badge on your account
                            </span>
                        </li>

                        <li class="flex items-center gap-x-3">
                            <svg class="shrink-0 size-4 mt-0.5 text-accent" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span class="text-white">
                                24/7 priority support
                            </span>
                        </li>

                        <li class="flex items-center gap-x-3">
                            <svg class="shrink-0 size-4 mt-0.5 text-accent" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span class="text-white">
                                Regulatory protection
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
