<div x-data>
    <!-- App Capsule -->
    <div id="appCapsule">

        <!-- Wallet Card -->
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card p-5 mb-2">
                <div class="flex items-center justify-center w-full h-48 rounded-2xl"
                    style="background: rgba(255,255,255,.8); box-shadow: 0 0 30px #ccc;">
                    <div><img src="{{ asset('assets/img/logo.png') }}" width="180" alt="logo"></div>
                </div>
                <button type="button" class="btn btn-primary btn-lg btn-block mt-3" wire:click="startTask">
                    Start Now ({{ $user->tasks_completed ?? 0 }}/35)
                </button>
            </div>
        </div>
        <!-- Wallet Card -->

        <!-- Transactions -->
        <div class="section mt-2">
            <div class="transactions">
                @foreach ($membershipLevels as $level)
                    @if (strtolower($userLevel) === strtolower($level->name))
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
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
        <!-- * Transactions -->

        <!-- Stats -->
        <div class="section pb-2">
            <div class="row mt-1 mb-1 gy-2">
                <div class="col-12">
                    <div class="stat-box">
                        <div class="title">Account Balance</div>
                        <div class="value">
                            @if (($user->lien_status ?? 'off_hold') === 'on_hold' && $user->lien_amount !== null)
                                -{{ number_format((int) $user->lien_amount / 100, 2) }} USDT
                            @else
                                {{ number_format(($user->balance ?? 0) / 100, 2) }} USDT
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="stat-box">
                        <div class="title">Today's Commission</div>
                        <div class="value">{{ number_format($todaysCommission, 2) }} USDT</div>
                    </div>
                </div>
            </div>
            <div class="row gy-2">
                <div class="col-12">
                    <div class="stat-box">
                        <div class="title">Total Commission</div>
                        <div class="value">{{ number_format(($user->total_commission ?? 0) / 100, 2) }} USDT</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="stat-box">
                        <div class="title">Processing Amount</div>
                        <div class="value">{{ number_format(($pendingWithdrawalsTotal ?? 0) / 100, 2) }} USDT</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Stats -->

    </div>
    <!-- * App Capsule -->
</div>

<script>
    let lastToast = null;

    function toast(message) {
        if (lastToast) {
            lastToast.hideToast();
        }

        const copiedToastMarkup = `
            <div class="flex items-start p-2">
                <div class="shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6236ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>
                </div>
                <div class="ms-1 flex-1">
                    <p class="text-xs font-semibold text-black" style="margin-bottom: 0 !important;">${message}</p>
                </div>
            </div>
        `;

        lastToast = Toastify({
            text: copiedToastMarkup,
            className: "fixed top-1 start-1/2 -translate-x-1/2 z-[1000] w-4/5 md:w-1/2 lg:w-1/4 bg-white text-sm text-black rounded-xl shadow-lg [&>.toast-close]:hidden",
            duration: 4000,
            close: false,
            escapeMarkup: false
        });

        lastToast.showToast();
    }
</script>

@script
    <script>
        $wire.on('task-completed', (event) => {
            toast(event.message)
        });

        $wire.on('task-limit-reached', (event) => {
            toast(event.message)
        });

        $wire.on('insufficient-balance', (event) => {
            toast(event.message)
        });
    </script>
@endscript
