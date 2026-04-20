<div>
    <!-- App Capsule -->
    <div id="appCapsule">
        <!-- Transactions -->
        <div class="section mt-2">
            <div class="section-title fw-bold">Invite</div>
            <!-- Stats -->
            <div class="section">
                <div class="wallet-card p-5 mb-2">
                    <div class="flex items-center justify-center w-full h-48">
                        <div><img src="{{ asset('assets/img/logo.png') }}" width="180" alt="logo"></div>
                    </div>
                </div>
                <div class="section mt-3 text-center" x-data="{ copied: false }">
                    <div class="mt-1">
                        <p class="text-sm">
                            Invitation Code: <span class="font-bold text-black">{{ $user->referral_code }}</span>
                        </p>
                    </div>
                    <div class="mt-2">
                        <button type="button" class="btn btn-primary btn-block"
                            @click="navigator.clipboard.writeText('{{ $user->referral_code }}'); copied = true; setTimeout(() => copied = false, 2000)">
                            <ion-icon x-show="!copied" name="copy-outline"
                                style="font-size: 18px; vertical-align: middle;" class="me-1"></ion-icon>
                            <ion-icon x-show="copied" x-cloak name="checkmark-outline"
                                style="font-size: 18px; vertical-align: middle; color: #fff;" class="me-1"></ion-icon>
                            <span x-show="!copied">Copy Code</span>
                            <span x-show="copied" x-cloak>Copied!</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Transactions -->
    </div>
    <!-- * App Capsule -->
</div>
