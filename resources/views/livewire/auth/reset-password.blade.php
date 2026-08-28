<div>
    <div class="section mt-5 mb-3 text-center">
        <img style="display: inline;" src="{{ asset('assets/img/logo.png') }}" width="180" alt="logo">
    </div>

    <div class="section mb-5 p-2">
        <form wire:submit="resetPassword">
            <div class="card">
                <div class="section mt-2 text-start">
                    <h3>Reset password</h3>
                    <p>Enter your new password below.</p>
                </div>

                <div class="card-body pb-1">
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <label class="label" for="email">Email</label>
                            <input wire:model="email" type="email" class="form-control" id="email"
                                autocomplete="email" placeholder="Your email" required>
                        </div>
                        @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <label class="label" for="password">New password</label>
                            <input wire:model="password" type="password" class="form-control" id="password"
                                autocomplete="new-password" placeholder="Your new password" required>
                        </div>
                        @error('password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <label class="label" for="password_confirmation">Confirm new password</label>
                            <input wire:model="password_confirmation" type="password" class="form-control"
                                id="password_confirmation" autocomplete="new-password"
                                placeholder="Confirm your new password" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-links mt-2">
                <div>
                    <a href="{{ route('login') }}">Back to Log in</a>
                </div>
            </div>

            <div class="form-button-group transparent">
                <button type="submit" class="btn btn-primary btn-block btn-lg">Reset password</button>
            </div>
        </form>
    </div>
</div>
