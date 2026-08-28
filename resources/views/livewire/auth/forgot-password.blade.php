<div>
    <div class="section mt-5 mb-3 text-center">
        <img style="display: inline;" src="{{ asset('assets/img/logo.png') }}" width="180" alt="logo">
    </div>

    <div class="section mb-5 p-2">
        <form wire:submit="sendPasswordResetLink">
            <div class="card">
                <div class="section mt-2 text-start">
                    <h3>Forgot password</h3>
                    <p>Enter your email to receive a password reset link.</p>
                </div>

                <div class="card-body pb-1">
                    <x-auth-session-status class="text-center" :status="session('status')" />

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <label class="label" for="email">Email</label>
                            <input wire:model="email" type="email" class="form-control" id="email"
                                autocomplete="email" placeholder="Your email" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                        @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-links mt-2">
                <div>
                    <a href="{{ route('login') }}">Back to Log in</a>
                </div>
            </div>

            <div class="form-button-group transparent">
                <button type="submit" class="btn btn-primary btn-block btn-lg">Email Password Reset Link</button>
            </div>
        </form>
    </div>
</div>
