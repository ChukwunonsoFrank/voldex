<div x-data class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:px-96 lg:pt-6">
            <div class="my-3 sticky top-0 bg-dashboard pb-2 lg:pt-4">
                <h1 class="text-white text-lg md:text-xl lg:text-2xl font-semibold">Account Information</h1>
            </div>
            <div class="lg:h-full lg:pb-24 lg:overflow-scroll scrollbar-hide">
                <div class="p-3 bg-dim rounded-lg border border-[#323335]">
                    <h2 class="text-white text-sm font-bold mb-3">Identity</h2>
                    <ul class="space-y-3 list-disc list-inside text-xs">
                        <li class="text-white flex items-center gap-x-1 pl-0">
                            <span class="list-disc list-inside mr-1"
                                style="display:inline-block;width:0.8em;">&#8226;</span>
                            <span class="flex-1">Full name: {{ auth()->user()->name }}</span>
                        </li>
                        <li class="text-white flex items-center gap-x-1 pl-0">
                            <span class="list-disc list-inside mr-1"
                                style="display:inline-block;width:0.8em;">&#8226;</span>
                            <span class="flex-1">Email: {{ auth()->user()->email }}</span>
                            <a href="{{ route('dashboard.security.changeemail') }}">
                                <button type="button"
                                    class="px-2 py-1 cursor-pointer inline-flex items-center justify-center gap-x-1 text-xs font-semibold rounded-lg bg-accent text-black focus:outline-hidden">
                                    Change Email
                                </button>
                            </a>
                        </li>
                        <li class="text-white flex items-center gap-x-1 pl-0">
                            <span class="list-disc list-inside mr-1"
                                style="display:inline-block;width:0.8em;">&#8226;</span>
                            <span class="flex-1">Country: {{ auth()->user()->country }}</span>
                        </li>
                    </ul>
                </div>
                <div class="p-3 mt-3 bg-dim rounded-lg border border-[#323335]">
                    <h2 class="text-white text-sm font-bold mb-2">Account Details</h2>
                    <ul class="space-y-3 list-disc list-inside text-xs">
                        <li class="text-white flex items-center gap-x-1 pl-0">
                            <span class="list-disc list-inside mr-1"
                                style="display:inline-block;width:0.8em;">&#8226;</span>
                            <input id="uid" type="text" class="hidden" value="{{ auth()->user()->uid }}">
                            <span class="flex-1">Yfxai UID: {{ auth()->user()->uid }}</span>
                            <button type="button" x-on:click="$store.accountInformationPage.copyUID()"
                                class="py-1 px-2 cursor-pointer inline-flex items-center justify-center text-xs font-semibold rounded-lg bg-[#282828] border border-[#323335] text-white focus:outline-hidden">
                                Copy
                            </button>
                        </li>
                        <li class="text-white flex items-center gap-x-1 pl-0">
                            <span class="list-disc list-inside mr-1"
                                style="display:inline-block;width:0.8em;">&#8226;</span>
                            <span class="flex-1">Registration Date: {{ auth()->user()->created_at }}</span>
                        </li>
                        <li class="text-white flex items-center gap-x-1 pl-0">
                            <span class="list-disc list-inside mr-1"
                                style="display:inline-block;width:0.8em;">&#8226;</span>
                            <span class="flex-1">Last Login:
                                {{ auth()->user()->last_login_at }}({{ auth()->user()->country }})</span>
                        </li>
                        <li class="text-white flex items-center gap-x-1 pl-0">
                            <span class="list-disc list-inside mr-1"
                                style="display:inline-block;width:0.8em;">&#8226;</span>
                            <span class="flex-1">IP: {{ auth()->user()->ip_address }}</span>
                        </li>
                    </ul>
                </div>
                <div class="p-3 mt-3 bg-dim rounded-lg border border-[#323335]">
                    <h2 class="text-white text-sm font-bold mb-3">Verification</h2>
                    <div class="flex items-center space-x-2 -mt-0.5">
                        <div class="grow">
                            @if (!$this->isKycPending && $this->kycStatus === 'Not verified')
                                <span
                                    class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-lg text-xs font-semibold bg-[#282828] text-white">Not
                                    Verified
                                </span>
                            @endif
                            @if ($this->isKycPending && $this->kycStatus === 'Not verified')
                                <span
                                    class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-lg text-xs font-semibold bg-[#F59E0B] text-white">Pending
                                    Review
                                </span>
                            @endif
                            @if ($this->kycStatus === 'Verified')
                                <span
                                    class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-lg text-xs font-semibold border border-green-300 text-green-300">Verified<svg
                                        width="10" height="10" viewBox="0 0 10 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.33366 2.5L3.75033 7.08333L1.66699 5" stroke="#7bf1a8"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                            @endif
                        </div>
                        <div class="flex-none">
                            @if ($this->isKycPending && $this->kycStatus === 'Not verified')
                                <a href="{{ route('dashboard.identityverification') }}">
                                    <button type="button"
                                        class="w-full py-2 px-3 cursor-pointer inline-flex items-center justify-center gap-x-1 text-xs font-semibold rounded-lg bg-accent text-white focus:outline-hidden">
                                        Increase Limits
                                    </button>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-3 lg:grid lg:grid-cols-2 lg:gap-4">
                    <a class="cursor-pointer" x-on:click="$store.accountInformationPage.toggleDeleteAccountModal();">
                        <div
                            class="bg-dim w-full rounded-lg flex items-center space-x-2 p-3 mb-1 border border-[#323335] lg:mb-0">
                            <div class="flex-none text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-trash-icon lucide-trash">
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                    <path d="M3 6h18" />
                                    <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-sm text-red-500">Delete Account</p>
                            </div>
                            <div class="flex-none text-end">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-chevron-right-icon lucide-chevron-right">
                                    <path d="m9 18 6-6-6-6" />
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div x-cloak x-transition x-show="$store.accountInformationPage.isDeleteAccountModalOpen"
                class="fixed top-0 left-0 h-svh w-full px-4 lg:px-96 pt-6 z-20">
                <div class="absolute inset-0 h-svh w-full px-4 lg:px-96 pt-6 z-20 bg-dashboard opacity-85"></div>
                <div class="relative w-full h-full flex items-center justify-center z-30">
                    <div
                        class="max-w-sm mx-auto flex flex-col bg-dashboard border border-[#26252a] rounded-2xl pointer-events-auto">
                        <div class="p-6 overflow-y-auto text-center">
                            <div class="flex justify-center mb-6">
                                <div class="size-14 flex items-center justify-center rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                        viewBox="0 0 24 24" fill="none" stroke="#fb2c36" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-triangle-alert-icon lucide-triangle-alert">
                                        <path
                                            d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3" />
                                        <path d="M12 9v4" />
                                        <path d="M12 17h.01" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-white font-medium text-base">
                                Are you sure you want to delete your account?
                                This action is permanent and cannot be undone.
                            </p>
                            <div class="mt-6 grid grid-cols-1 gap-y-2">
                                <div>
                                    <button type="button" wire:click="destroyAccount()" wire:loading.attr="disabled"
                                        type="button"
                                        class="p-3 w-full text-center text-sm font-semibold rounded-lg border border-transparent bg-[#fb2c36] text-white cursor-pointer hover:bg-[#fb2c36] focus:outline-hidden focus:bg-[#fb2c36] disabled:opacity-50 disabled:pointer-events-none">
                                        <i wire:loading class="fa-solid fa-circle-notch fa-spin"></i>
                                        <span wire:loading.remove>Yes, Delete My Account</span>
                                    </button>
                                </div>
                                <div>
                                    <button x-on:click="$store.accountInformationPage.toggleDeleteAccountModal();"
                                        type="button"
                                        class="p-3 w-full text-center text-sm font-semibold rounded-lg border border-white text-white shadow-2xs cursor-pointer focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none"
                                        data-hs-overlay="#hs-vertically-centered-modal">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        $wire.on('message', (event) => {
            const toastMarkup = `
                <div class="flex items-start p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4 text-teal-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>
                    </div>
                    <div class="ms-3 flex-1">
                        <p class="text-xs font-semibold text-white">${event.message}</p>
                    </div>
                </div>
            `;

            Toastify({
                text: toastMarkup,
                className: "hs-toastify-on:opacity-100 opacity-0 absolute top-0 start-1/2 -translate-x-1/2 z-90 w-4/5 md:w-1/2 lg:w-1/4 transition-all duration-300 bg-dim border border-[#26252a] text-sm text-white rounded-xl shadow-lg [&>.toast-close]:hidden",
                duration: 4000,
                close: true,
                escapeMarkup: false
            }).showToast();
        });
    </script>
@endscript

<script>
    let lastToast = null;

    function toastCopied() {
        if (lastToast) {
            lastToast.hideToast();
        }

        const copiedToastMarkup = `
            <div class="flex items-center p-4">
                <div class="shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                </div>
                <div class="ms-3 flex-1">
                    <p class="text-xs font-semibold text-white">Copied</p>
                </div>
            </div>
        `;

        lastToast = Toastify({
            text: copiedToastMarkup,
            className: "hs-toastify-on:opacity-100 opacity-0 absolute top-0 start-1/2 -translate-x-1/2 z-90 w-4/5 md:w-1/2 lg:w-1/4 transition-all duration-300 bg-dim border border-[#26252a] text-sm text-white rounded-xl shadow-lg [&>.toast-close]:hidden",
            duration: 4000,
            close: true,
            escapeMarkup: false
        });

        lastToast.showToast();
    }

    document.addEventListener('alpine:init', () => {
        Alpine.store('accountInformationPage', {
            isDeleteAccountModalOpen: false,
            copyUID() {
                var copyText = document.getElementById("uid");
                copyText.select();
                copyText.setSelectionRange(0, 99999); // For mobile devices
                navigator.clipboard.writeText(copyText.value);
                toastCopied();
            },
            toggleDeleteAccountModal() {
                this.isDeleteAccountModalOpen = !this.isDeleteAccountModalOpen;
            },
        })
    })
</script>
