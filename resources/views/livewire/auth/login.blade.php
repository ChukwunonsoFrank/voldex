<div x-data>

    <div class="section mt-5 mb-3 text-center">
        <img style="display: inline;" src="{{ asset('assets/img/logo.png') }}" width="180" alt="logo">
    </div>
    <div class="section mb-5 p-2">

        <form wire:submit="login">
            <div class="card">
                <div class="section mt-2 text-start">
                    <h3>Log in</h3>
                </div>
                <div class="card-body pb-1">
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <label class="label" for="username">Username</label>
                            <input wire:model="username" type="text" class="form-control" id="username"
                                autocomplete="username" placeholder="Your username" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <label class="label" for="password">Password</label>
                            <input wire:model="password" type="password" class="form-control" id="password"
                                autocomplete="current-password" placeholder="Your password" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-links mt-2">
                <div>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register Now</a>
                    @endif
                </div>
                <div>
                    @if (Route::has('password.request'))
                        <a href="#" class="text-muted">Forgot Password?</a>
                    @endif
                </div>
            </div>

            <div class="form-button-group transparent">
                <button type="submit" class="btn btn-primary btn-block btn-lg">Log in</button>
            </div>

        </form>
    </div>

</div>

<script>
    let lastToast = null;

    function toast(message) {
        if (lastToast) {
            lastToast.hideToast();
        }

        const copiedToastMarkup = `
            <div class="flex items-center p-2">
                <div class="shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert-icon lucide-circle-alert"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                </div>
                <div class="ms-1 flex-1">
                    <p class="text-xs font-semibold text-white" style="margin-bottom: 0 !important;">${message}</p>
                </div>
            </div>
        `;

        lastToast = Toastify({
            text: copiedToastMarkup,
            className: "fixed top-0 start-1/2 -translate-x-1/2 z-90 w-4/5 md:w-1/2 lg:w-1/4 bg-[#6236FF] border border-[#26252a] text-sm text-white rounded-xl shadow-lg [&>.toast-close]:hidden",
            duration: 4000,
            close: false,
            escapeMarkup: false
        });

        lastToast.showToast();
    }
</script>

@script
    <script>
        $wire.on('login-error', (event) => {
            toast(event.message)
        });
    </script>
@endscript
