<div x-data="lockout" class="lg:px-0 h-full">
    <div class="lg:flex h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="h-full flex-1">
            <div class="px-8 flex items-center justify-center h-full">
                <div class="max-w-sm mx-auto p-6 bg-dim rounded-2xl text-center border border-[#26252a]">
                    <div class="flex items-center justify-center gap-x-2 my-4">
                        <div class="flex-none">
                            <div class="flex items-center justify-center size-16 gap-x-2 rounded-full bg-accent">
                                <div class="flex-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                        viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-timer-reset-icon lucide-timer-reset">
                                        <path d="M10 2h4" />
                                        <path d="M12 14v-4" />
                                        <path d="M4 13a8 8 0 0 1 8-7 8 8 0 1 1-5.3 14L4 17.6" />
                                        <path d="M9 17H4v5" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-6">
                        <p class="text-xs leading-5 text-white mb-1">
                            Next session available in
                        </p>

                        <p x-text="timer" class="text-2xl font-bold text-accent"></p>
                    </div>
                    <h1 class="text-white text-sm lg:text-base font-bold mb-2">Status:
                        Strategy Reset in Progress</h1>
                    <div class="text-center">
                        <p class="text-xs leading-5 text-[#a4a4a4] mb-4">
                            Each trading session completes a full execution cycle.
                            A short reset is required before the next session begins to ensure execution consistency.
                        </p>
                    </div>
                    @if ($this->activeBotCount > 0)
                        <div>
                            <div>
                                <a href="{{ route('dashboard.robot.traderoom') }}">
                                    <button type="button"
                                        class="p-3 w-full text-center text-sm font-semibold rounded-lg bg-accent text-black shadow-2xs cursor-pointer focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">
                                        Go to active trade
                                    </button>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        $wire.on('lockout-message', (event) => {
            const robotStoppedToastMarkup = `
                <div class="flex items-start p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4 text-teal-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>
                    </div>
                    <div class="ms-2 flex-1">
                        <p class="text-xs font-semibold text-white">${event.message}</p>
                    </div>
                </div>
            `;

            Toastify({
                text: robotStoppedToastMarkup,
                className: "hs-toastify-on:opacity-100 opacity-0 absolute top-0 start-1/2 -translate-x-1/2 z-90 w-4/5 md:w-1/2 lg:w-1/4 transition-all duration-300 bg-dim border border-[#26252a] text-sm text-white rounded-xl shadow-lg [&>.toast-close]:hidden",
                duration: 8000,
                close: true,
                escapeMarkup: false
            }).showToast();
        });
    </script>
@endscript

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('lockout', () => ({
            timer: '',
            timeLeft: {},
            timerInterval: null,

            init() {
                // Start the timer when the component initializes
                this.startTimer();
            },

            startTimer() {
                this.timerInterval = setInterval(() => {
                    this.refreshTimer();
                }, 1000);
            },

            calculateTimeLeftTillNextCheckpoint(checkpoint) {
                let difference = checkpoint - Date.now();

                if (0 > difference) {
                    return {
                        minutes: 0,
                        seconds: 0
                    }
                }

                let minutes = Math.floor((difference / (1000 * 60)) % 60);
                let seconds = Math.floor((difference / 1000) % 60);

                return {
                    minutes: minutes,
                    seconds: seconds
                }
            },

            formatTimeLeft(minutes, seconds) {
                let minuteString = 0;
                let secondString = 0;

                if (minutes < 10) {
                    minuteString = `0${String(minutes)}`;
                } else {
                    minuteString = String(minutes);
                }

                if (seconds < 10) {
                    secondString = `0${String(seconds)}`;
                } else {
                    secondString = String(seconds);
                }

                return `${minuteString}:${secondString}`;
            },

            async refreshTimer() {
                if (this.$wire.timerCheckpointOne && Date.now() < this.$wire
                    .timerCheckpointOne) {
                    this.timeLeft = this.calculateTimeLeftTillNextCheckpoint(this.$wire
                        .timerCheckpointOne);

                    let formatted = this.formatTimeLeft(this.timeLeft.minutes, this
                        .timeLeft
                        .seconds);

                    this.timer = formatted;
                    return;
                }

                if (this.$wire.activeBotCount > 0 && this.$wire
                    .timerCheckpointOne && Date.now() > this.$wire
                    .timerCheckpointOne) {
                    this.$wire.redirectToTraderoomRoute();
                    return;
                }

                if (this.$wire.timerCheckpointTwo && Date.now() < this.$wire
                    .timerCheckpointTwo) {
                    this.timeLeft = this.calculateTimeLeftTillNextCheckpoint(this.$wire
                        .timerCheckpointTwo);

                    let formatted = this.formatTimeLeft(this.timeLeft.minutes, this
                        .timeLeft
                        .seconds);

                    this.timer = formatted;
                    return;
                }

                if (this.$wire.activeBotCount > 0 && this.$wire
                    .timerCheckpointTwo && Date.now() > this.$wire
                    .timerCheckpointTwo) {
                    this.$wire.redirectToTraderoomRoute();
                    return;
                }

                if (Date.now() > this.$wire.timerCheckpointOne || Date.now() > this.$wire
                    .timerCheckpointTwo) {
                    await this.$wire.refreshBotData();
                    if (this.$wire.activeBotCount === 0 && !this.$wire.timerCheckpointOne && !
                        this
                        .$wire.timerCheckpointTwo) {
                        this.$wire.redirectToRobotSetupRoute();
                        return;
                    }
                }
                // this.timeLeft = this.calculateTimeLeftTillNextCheckpoint(this.$wire
                //     .timerCheckpointOne);

                // if (this.$wire.activeBotCount === 0 && Date.now() > this.$wire.timerCheckpointOne) {
                //     this.timer = '00:00';
                //     this.$wire.redirectToRobotSetupRoute();
                // }

                // if (this.$wire.activeBotCount > 0 && Date.now() > this.$wire.timerCheckpointOne) {
                //     this.timer = '00:00';
                //     this.$wire.redirectToTraderoomRoute();
                // }

                // let formatted = this.formatTimeLeft(this.timeLeft.minutes, this
                //     .timeLeft
                //     .seconds);
                // this.timer = formatted;
            },
        }))
    })
</script>
