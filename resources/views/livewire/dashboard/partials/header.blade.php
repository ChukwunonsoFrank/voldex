<div>
    <header class="bg-dashboard flex-none lg:mb-0 md:border-b md:border-[#26252a]">
        <div class="flex items-center px-2 border-b border-[#26252a] justify-between gap-x-1 md:border-none">

            <div class="flex gap-x-1 flex-1 md:flex-none">
                <div
                    class="flex-1 md:flex-none md:px-10 relative border py-2 border-[#323335] bg-transparent rounded-lg text-center">
                    @if ($this->botOneAccountType === 'demo' || $this->botTwoAccountType === 'demo')
                        <div class="w-4 flex-none absolute top-0 left-0">
                            <div class="flex relative size-4 -mt-[1px] justify-center items-center">
                                <span
                                    class="absolute animate-pulse inset-0 inline-flex size-full rounded-full bg-accent opacity-30"></span>
                                <span class="relative inset-0 inline-flex rounded-full size-2 bg-accent"></span>
                            </div>
                        </div>
                    @endif
                    <div class="flex items-center justify-center gap-x-1.5">
                        <div class="flex-none">
                            <p class="text-zinc-300 text-xs font-black tracking-normal">Demo account</p>
                        </div>
                    </div>
                    <p class="text-white font-bold text-xs md:text-sm">@money(auth()->user()->demo_balance / 100)</p>
                </div>

                <div
                    class="flex-1 md:flex-none md:px-10 relative border py-2 border-[#323335] bg-transparent rounded-lg text-center">
                    @if ($this->botOneAccountType === 'live' || $this->botTwoAccountType === 'live')
                        <div class="w-4 flex-none absolute top-0 left-0">
                            <div class="flex relative size-4 -mt-[1px] justify-center items-center">
                                <span
                                    class="absolute animate-pulse inset-0 inline-flex size-full rounded-full bg-accent opacity-30"></span>
                                <span class="relative inset-0 inline-flex rounded-full size-2 bg-accent"></span>
                            </div>
                        </div>
                    @endif
                    <div class="flex items-center justify-center gap-x-1.5">
                        <div class="flex-none">
                            <p class="text-zinc-300 text-xs font-black tracking-normal">Live account</p>
                        </div>
                    </div>
                    <p class="text-white font-bold text-xs md:text-sm">@money(auth()->user()->live_balance / 100)</p>
                </div>
            </div>

            <div class="flex-none text-end py-3">
                <a href="{{ route('dashboard.deposit') }}">
                    <button type="button"
                        class="px-4 py-3.5 lg:px-10 inline-flex items-center gap-x-1 text-[13px] font-bold tracking-[0.15px] rounded-md bg-accent text-black focus:outline-hidden">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_1669_24)">
                                <path
                                    d="M16.5 7.5V12C16.5 12.7956 16.1839 13.5587 15.6213 14.1213C15.0587 14.6839 14.2956 15 13.5 15H4.5C3.70435 15 2.94129 14.6839 2.37868 14.1213C1.81607 13.5587 1.5 12.7956 1.5 12V7.5H16.5ZM5.2575 10.5H5.25C5.15151 10.5005 5.05408 10.5204 4.96327 10.5585C4.87247 10.5967 4.79006 10.6523 4.72077 10.7223C4.58082 10.8637 4.50276 11.0548 4.50375 11.2538C4.50424 11.3522 4.52413 11.4497 4.56228 11.5405C4.60042 11.6313 4.65608 11.7137 4.72607 11.783C4.79606 11.8523 4.87902 11.9071 4.9702 11.9443C5.06138 11.9816 5.15901 12.0005 5.2575 12C5.45641 12 5.64718 11.921 5.78783 11.7803C5.92848 11.6397 6.0075 11.4489 6.0075 11.25C6.0075 11.0511 5.92848 10.8603 5.78783 10.7197C5.64718 10.579 5.45641 10.5 5.2575 10.5ZM9.75 10.5H8.25C8.05109 10.5 7.86032 10.579 7.71967 10.7197C7.57902 10.8603 7.5 11.0511 7.5 11.25C7.5 11.4489 7.57902 11.6397 7.71967 11.7803C7.86032 11.921 8.05109 12 8.25 12H9.75C9.94891 12 10.1397 11.921 10.2803 11.7803C10.421 11.6397 10.5 11.4489 10.5 11.25C10.5 11.0511 10.421 10.8603 10.2803 10.7197C10.1397 10.579 9.94891 10.5 9.75 10.5ZM13.5 3C14.2956 3 15.0587 3.31607 15.6213 3.87868C16.1839 4.44129 16.5 5.20435 16.5 6H1.5C1.5 5.20435 1.81607 4.44129 2.37868 3.87868C2.94129 3.31607 3.70435 3 4.5 3H13.5Z"
                                    fill="black" />
                            </g>
                            <defs>
                                <clipPath id="clip0_1669_24">
                                    <rect width="18" height="18" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                        Deposit
                    </button>
                </a>
            </div>
        </div>
    </header>
</div>
