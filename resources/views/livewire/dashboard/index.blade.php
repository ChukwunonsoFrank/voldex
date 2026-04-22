<div>
    <!-- App Capsule -->
    <div id="appCapsule">

        <!-- Wallet Card -->
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <!-- Balance -->
                <div class="balance">
                    <div class="left">
                        <span class="title">Welcome, {{ auth()->user()->username }}</span>
                        <h1 class="total">{{ auth()->user()->membership_level }}</h1>
                    </div>
                    <div class="right">
                        @php
                            $membershipLevelIcon = \App\Models\MembershipLevel::where(
                                'name',
                                auth()->user()->membership_level,
                            )->value('icon_image_path');
                        @endphp
                        @if ($membershipLevelIcon)
                            <img src="{{ asset($membershipLevelIcon) }}" alt="{{ auth()->user()->membership_level }}"
                                style="width: 48px; height: 48px;">
                        @endif
                    </div>
                </div>
                <!-- * Balance -->
            </div>
        </div>
        <!-- Wallet Card -->

        <!-- Wallet Card -->
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <!-- Wallet Footer -->
                <div class="wallet-footer mb-3">
                    <div class="item">
                        <a href="{{ route('dashboard.event') }}">
                            <div class="icon-wrapper">
                                <ion-icon name="calendar"></ion-icon>
                            </div>
                            <strong>Latest Event</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ route('dashboard.deposit') }}">
                            <div class="icon-wrapper">
                                <ion-icon name="card"></ion-icon>
                            </div>
                            <strong>Recharge</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ route('dashboard.withdraw-password-step') }}">
                            <div class="icon-wrapper">
                                <ion-icon name="arrow-up-circle"></ion-icon>
                            </div>
                            <strong>Withdrawal</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ route('dashboard.invite') }}">
                            <div class="icon-wrapper">
                                <ion-icon name="people"></ion-icon>
                            </div>
                            <strong>Invite</strong>
                        </a>
                    </div>

                </div>
                <!-- * Wallet Footer -->

                <!-- Wallet Footer -->
                <div class="wallet-footer">
                    <div class="item">
                        <a href="{{ route('dashboard.about-us') }}">
                            <div class="icon-wrapper">
                                <ion-icon name="earth"></ion-icon>
                            </div>
                            <strong>About Us</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ route('dashboard.terms-and-conditions') }}">
                            <div class="icon-wrapper">
                                <ion-icon name="briefcase"></ion-icon>
                            </div>
                            <strong>T&C</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ route('dashboard.faqs') }}">
                            <div class="icon-wrapper">
                                <ion-icon name="search"></ion-icon>
                            </div>
                            <strong>FAQs</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ route('dashboard.certificate') }}">
                            <div class="icon-wrapper">
                                <ion-icon name="document-text"></ion-icon>
                            </div>
                            <strong>Certificate</strong>
                        </a>
                    </div>
                </div>
                <!-- * Wallet Footer -->
            </div>
        </div>
        <!-- Wallet Card -->

        <!-- Transactions -->
        <div class="section mt-4 mb-4">
            <div class="section-heading">
                <h2 class="title">Our Partners</h2>
            </div>
            <div class="transactions" style="overflow: hidden; position: relative;">
                @php $brands = ['a16z.png', 'dune.png', 'makers_fund.png', 'mitimco.png', 'qia.jpg', 'raine.png', 'tirta.jpg']; @endphp
                <div class="marquee-track"
                    style="display: flex; gap: 3rem; animation: marquee-scroll 20s linear infinite; width: max-content;">
                    @for ($i = 0; $i < 4; $i++)
                        @foreach ($brands as $logo)
                            <a href="javascript:void(0)" class="item"
                                style="flex-shrink: 0; display: flex; align-items: center; justify-content: center; min-width: 150px;">
                                <img src="{{ asset('assets/img/brands/' . $logo) }}"
                                    alt="{{ pathinfo($logo, PATHINFO_FILENAME) }}"
                                    style="max-height: 40px; max-width: 120px; object-fit: contain;">
                            </a>
                        @endforeach
                    @endfor
                </div>
            </div>
            <style>
                @keyframes marquee-scroll {
                    0% {
                        transform: translateX(0);
                    }

                    100% {
                        transform: translateX(-50%);
                    }

                    /* shifts 2 of 4 sets, seamless loop */
                }
            </style>
        </div>
        <!-- * Transactions -->

        <!-- Transactions -->
        <div class="section mt-4 mb-4">
            <div class="section-heading">
                <h2 class="title">Membership Level</h2>
            </div>
            <div class="transactions">
                @foreach ($membershipLevels as $level)
                    <a href="javascript:void(0)" class="item" wire:key="level-{{ $level->id }}">
                        <div class="detail">
                            <img src="{{ asset($level->icon_image_path) }}" alt="{{ $level->name }}"
                                class="image-block imaged w48">
                            <div>
                                <strong>{{ $level->name }}</strong>
                            </div>
                        </div>
                        <div class="right">
                            <div class="price" style="color: #000;">
                                {{ $level->percentage }}%
                                @if (strtolower($userLevel) !== strtolower($level->name))
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="inline lucide lucide-lock-keyhole-icon lucide-lock-keyhole"
                                        style="margin-left: 4px;">
                                        <circle cx="12" cy="16" r="1" />
                                        <rect x="3" y="10" width="18" height="12" rx="2" />
                                        <path d="M7 10V7a5 5 0 0 1 10 0v3" />
                                    </svg>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <!-- * Transactions -->

    </div>
    <!-- * App Capsule -->
</div>

@script
    <script>
        $wire.on('message', (event) => {
            const toastMarkup = `
                <div class="flex items-center p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                        </svg>
                    </div>
                    <div class="ms-3 flex-1">
                        <p class="text-xs font-semibold text-white">${event.message}</p>
                    </div>
                </div>
            `;

            Toastify({
                text: toastMarkup,
                className: "hs-toastify-on:opacity-100 opacity-0 absolute top-0 start-1/2 -translate-x-1/2 z-90 w-4/5 md:w-1/2 lg:w-1/4 transition-all duration-300 bg-dim  border border-[#26252a] text-sm text-white rounded-xl shadow-lg [&>.toast-close]:hidden",
                duration: 6000,
                close: true,
                escapeMarkup: false
            }).showToast();
        });
    </script>
@endscript
