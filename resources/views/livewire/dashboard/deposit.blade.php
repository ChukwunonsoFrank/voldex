<div x-data="{ amount: 0 }">
    <!-- App Capsule -->
    <div id="appCapsule">
        <div class="section mt-2 mb-2">
            <div class="section-title">Deposit</div>
            <div class="card">
                <div class="card-body">
                    <form wire:submit="submitDeposit">
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="amount">Amount</label>
                                <input wire:model="amount" x-model.number="amount" type="number" class="form-control" id="amount"
                                    step="0.01" min="0">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-lg btn-block mt-3"
                            x-on:click="if (amount > 0) { new bootstrap.Modal(document.getElementById('sendActionSheet')).show() }">
                            Deposit
                        </button>
                    </form>
                </div>
            </div>
        </div>

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
    </div>
    <!-- * App Capsule -->
</div>

<script>
    let lastToast = null;

    function successToast(message) {
        if (lastToast) {
            lastToast.hideToast();
        }

        const copiedToastMarkup = `
            <div class="flex items-center p-2">
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

    function errorToast(message) {
        if (lastToast) {
            lastToast.hideToast();
        }

        const copiedToastMarkup = `
            <div class="flex items-center p-2">
                <div class="shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FF396F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-triangle-alert-icon lucide-triangle-alert"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
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
        $wire.on('change-success', (event) => {
            successToast(event.message)
        });

        $wire.on('change-error', (event) => {
            errorToast(event.message)
        });
    </script>
@endscript
