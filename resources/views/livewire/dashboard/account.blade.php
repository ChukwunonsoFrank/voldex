<div x-data>
    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-3 text-center">
            <div class="avatar-section">
                <a href="#">
                    <img src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}" alt="avatar"
                        class="imaged w100 rounded">
                </a>
            </div>
            <div class="mt-1">
                <h3>{{ $user->username }}</h3>
                <p class="text-sm" x-data="{ copied: false }">
                    Invitation Code: <span class="font-bold text-black">{{ $user->referral_code }}</span>
                    <a href="#"
                        @click.prevent="navigator.clipboard.writeText('{{ $user->referral_code }}'); copied = true; setTimeout(() => copied = false, 2000)">
                        <ion-icon x-show="!copied" name="copy-outline"
                            style="font-size: 16px; vertical-align: middle;"></ion-icon>
                        <ion-icon x-show="copied" x-cloak name="checkmark-outline"
                            style="font-size: 16px; vertical-align: middle; color: green;"></ion-icon>
                    </a>
                </p>
            </div>
        </div>

        <div class="section mt-2 mb-2">
            <div class="section-title">Credit Score</div>
            <div class="card">
                <div class="card-body">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $user->credit_score }}%;"
                            aria-valuenow="{{ $user->credit_score }}" aria-valuemin="0" aria-valuemax="100">
                            {{ $user->credit_score }}%</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wallet Card -->
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <!-- Wallet Footer -->
                <div class="wallet-footer mb-3">
                    <div class="item">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#sendActionSheet">
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
                        <a href="{{ route('dashboard.bind-wallet') }}">
                            <div class="icon-wrapper">
                                <ion-icon name="earth"></ion-icon>
                            </div>
                            <strong>Bind Wallet</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ route('dashboard.change-password') }}">
                            <div class="icon-wrapper">
                                <ion-icon name="briefcase"></ion-icon>
                            </div>
                            <strong>Change Password</strong>
                        </a>
                    </div>
                </div>
                <!-- * Wallet Footer -->

                <!-- Wallet Footer -->
                <div class="wallet-footer">
                    <div class="item">
                        <a href="{{ route('dashboard.alert') }}">
                            <div class="icon-wrapper">
                                <ion-icon name="search"></ion-icon>
                            </div>
                            <strong>Transactions</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ route('dashboard.contact') }}">
                            <div class="icon-wrapper">
                                <ion-icon name="document-text"></ion-icon>
                            </div>
                            <strong>Contact Us</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ route('dashboard.change-password') }}">
                            <div class="icon-wrapper">
                                <ion-icon name="briefcase"></ion-icon>
                            </div>
                            <strong>Withdrawal Password</strong>
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
            </div>
            <!-- Wallet Card -->

            <!-- Send Action Sheet -->
            <div class="modal fade action-sheet" id="sendActionSheet" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Recharge</h5>
                        </div>
                        <div class="modal-body">
                            <div class="action-sheet-content">
                                <form>
                                    <div class="form-group basic text-center">
                                        <p class="text-black">Please contact customer service for further assistance</p>
                                    </div>

                                    <div class="form-group basic">
                                        <a href="{{ route('dashboard.contact') }}">
                                            <button type="button" class="btn btn-primary btn-block btn-lg"
                                                data-bs-dismiss="modal">Confirm</button>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- * Send Action Sheet -->

            <!-- Stats -->
            <div class="pb-2">
                <div class="row mt-2 mb-1 gy-2">
                    <div class="col-12">
                        <div class="stat-box" style="padding: 14px 24px;">
                            <div class="title" style="font-size: 11px;">Account Balance</div>
                            <div class="value" style="font-size: 16px;">
                                @if (($user->lien_status ?? 'off_hold') === 'on_hold' && $user->lien_amount !== null)
                                    -{{ number_format((int) $user->lien_amount / 100, 2) }}
                                @else
                                    {{ number_format(($user->balance ?? 0) / 100, 2) }}
                                @endif
                                USDT
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="stat-box" style="padding: 14px 24px;">
                            <div class="title" style="font-size: 11px;">Total Commission</div>
                            <div class="value" style="font-size: 16px;">
                                {{ number_format(($user->total_commission ?? 0) / 100, 2) }} USDT</div>
                        </div>
                    </div>
                </div>
                <div class="row gy-2">
                    <div class="col-12">
                        <div class="stat-box" style="padding: 14px 24px;">
                            <div class="title" style="font-size: 11px;">Today's Commission</div>
                            <div class="value" style="font-size: 16px;">{{ number_format($todaysCommission, 2) }}
                                USDT
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="stat-box" style="padding: 14px 24px;">
                            <div class="title" style="font-size: 11px;">Processing Amount</div>
                            <div class="value" style="font-size: 16px;">
                                {{ number_format(($pendingWithdrawalsTotal ?? 0) / 100, 2) }} USDT</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- * Stats -->

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-primary btn-lg btn-block mb-2">
                    Logout
                </button>
            </form>

        </div>
        <!-- * App Capsule -->
    </div>
