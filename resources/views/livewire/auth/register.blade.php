<div x-data>
    <div class="section mt-5 mb-3 text-center">
        <img style="display: inline;" src="{{ asset('assets/img/logo.png') }}" width="180" alt="logo">
    </div>

    <div class="section mb-5 p-2">
        <form wire:submit="register">
            <div class="card">
                <div class="section mt-2 text-start">
                    <h3>Register</h3>
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
                            <label class="label" for="mobile_number">Mobile Number</label>
                            <input wire:model="mobile_number" type="text" class="form-control" id="mobile_number"
                                autocomplete="tel" placeholder="Your mobile number" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <label class="label" for="password">Password</label>
                            <input wire:model="password" type="password" class="form-control" id="password"
                                autocomplete="new-password" placeholder="Your password" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <label class="label" for="password_confirmation">Confirm Password</label>
                            <input wire:model="password_confirmation" type="password" class="form-control"
                                id="password_confirmation" autocomplete="new-password" placeholder="Type password again"
                                required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <label class="label" for="withdrawal_password">Withdrawal Password</label>
                            <input wire:model="withdrawal_password" type="password" class="form-control"
                                id="withdrawal_password" autocomplete="off" placeholder="Your withdrawal password"
                                required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <label class="label" for="ref_code">Invitation Code</label>
                            <input wire:model="ref_code" type="text" class="form-control" id="ref_code"
                                autocomplete="off" placeholder="Invitation code (optional)">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="custom-control custom-checkbox mt-2 mb-1">
                        <div class="form-check">
                            <input wire:model="termsAndPrivacyPolicyAccepted" type="checkbox" class="form-check-input"
                                id="termsCheckbox">
                            <label class="form-check-label" for="termsCheckbox"
                                style="color: #6236ff; font-size: 14px;">
                                Register Agreement</a>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div wire:ignore class="g-recaptcha mt-2 mb-1 px-2" data-sitekey="{{ config('services.recaptcha.key') }}"
                data-callback="onRecaptchaSuccess"></div>

            <div class="form-links mt-2 mb-5">
                <div>
                    <a href="{{ route('login') }}">Back to login</a>
                </div>
                <div></div>
            </div>

            <div class="form-button-group transparent">
                <button type="submit" class="btn btn-primary btn-block btn-lg">Register</button>
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
        $wire.on('signup-error', (event) => {
            toast(event.message)
        });
    </script>
@endscript
