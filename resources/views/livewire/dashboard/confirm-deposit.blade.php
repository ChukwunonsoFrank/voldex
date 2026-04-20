<div x-data="{ uploadError: false }" class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:px-96 lg:pt-6">
            <div class="pt-2 lg:h-full lg:pb-24 lg:overflow-scroll scrollbar-hide">
                <div class="flex items-center mb-2">
                    <div class="flex-none">
                        <div wire:click="back()" class="flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left">
                                <path d="m12 19-7-7 7-7" />
                                <path d="M19 12H5" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="p-4 bg-dim rounded-lg border border-[#323335]">
                    <div class="flex items-center gap-x-3 mb-3 text-left pb-2 lg:pt-4">
                        <div class="flex-none">
                            <h1 class="text-white text-lg md:text-xl lg:text-2xl font-bold">Deposit with
                                <img class="inline-block -mt-1 align-middle"
                                    src="{{ asset('storage/' . $this->iconUrl) }}">
                                {{ $this->method }}
                            </h1>
                        </div>
                    </div>

                    <div class="mb-3 text-left">
                        <p class="text-base font-medium text-[#a4a4a4]">Payment Details</p>
                    </div>

                    <div class="mb-4 text-left">
                        <p class="text-sm font-semibold text-white mb-2">Amount</p>
                        <div class="flex items-center">
                            <div class="flex-none text-wrap">
                                <p class="text-white font-light break-words">{{ $this->formatAmountToPay() }}</p>
                                <input id="amount" type="text" id="hs-trailing-icon" name="hs-trailing-icon"
                                    class="hidden" value="{{ $this->amountToPay }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="text-sm font-semibold text-white mb-2">Wallet Address</p>
                        <div class="flex items-center gap-x-16">
                            <div class="flex-1 overflow-x-auto">
                                <input id="address" type="text" id="hs-trailing-icon" name="hs-trailing-icon"
                                    class="hidden" value="{{ $this->address }}">
                                <p class="text-white font-light break-words whitespace-normal"
                                    style="word-break: break-all;">{{ $this->address }}</p>
                            </div>
                            <div wire:click="storeDepositIntent()"
                                x-on:click="$store.confirmDepositPage.copyWalletAddress($wire)"
                                class="flex-none flex items-center gap-x-1.5 cursor-pointer">
                                <span class="text-sm text-white font-light">Copy</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="js-clipboard-default size-4 group-hover:rotate-6 transition lucide lucide-copy-icon lucide-copy">
                                    <rect width="14" height="14" x="8" y="8" rx="2" ry="2" />
                                    <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <a wire:click="storeDepositIntent()"
                            x-on:click="$store.confirmDepositPage.toggleQRModal($wire);">
                            <div class="w-full py-3 rounded-full flex items-center justify-center bg-dashboard gap-x-2">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-qr-code-icon lucide-qr-code">
                                        <rect width="5" height="5" x="3" y="3" rx="1" />
                                        <rect width="5" height="5" x="16" y="3" rx="1" />
                                        <rect width="5" height="5" x="3" y="16" rx="1" />
                                        <path d="M21 16h-3a2 2 0 0 0-2 2v3" />
                                        <path d="M21 21v.01" />
                                        <path d="M12 7v3a2 2 0 0 1-2 2H7" />
                                        <path d="M3 12h.01" />
                                        <path d="M12 3h.01" />
                                        <path d="M12 16v.01" />
                                        <path d="M16 12h1" />
                                        <path d="M21 12v.01" />
                                        <path d="M12 21v-1" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white text-sm">Scan QR Code</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="mb-4">
                        <div class="flex items-center gap-x-1 mb-2">
                            <label for="file-upload" class="text-sm font-semibold text-white">Upload Payment
                                Screenshot</label>
                            <svg x-show="uploadError" x-cloak width="14" height="14" viewBox="0 0 14 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_27_18)">
                                        <path
                                            d="M6.99984 12.8333C10.2215 12.8333 12.8332 10.2216 12.8332 6.99996C12.8332 3.7783 10.2215 1.16663 6.99984 1.16663C3.77818 1.16663 1.1665 3.7783 1.1665 6.99996C1.1665 10.2216 3.77818 12.8333 6.99984 12.8333Z"
                                            stroke="#EE1600" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M7 4.66663V6.99996" stroke="#EE1600" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M7 9.33337H7.00583" stroke="#EE1600" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_27_18">
                                            <rect width="14" height="14" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                        </div>
                        <div class="relative">
                            <div class="flex items-center gap-x-1">
                                <div>
                                    <label for="file-upload"
                                        class="inline-flex items-center gap-x-1 bg-[#40FFDD] text-black font-semibold text-xs py-1 px-2 rounded-lg cursor-pointer">
                                        <div class="-mt-0.5">
                                            {{-- <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.16494 2.33337C8.3754 2.33337 8.58194 2.3903 8.76269 2.49813C8.94343 2.60596 9.09163 2.76067 9.1916 2.94587L9.4751 3.47087C9.57507 3.65608 9.72328 3.81079 9.90402 3.91862C10.0848 4.02645 10.2913 4.08338 10.5018 4.08337H11.6667C11.9761 4.08337 12.2729 4.20629 12.4916 4.42508C12.7104 4.64388 12.8334 4.94062 12.8334 5.25004V10.5C12.8334 10.8095 12.7104 11.1062 12.4916 11.325C12.2729 11.5438 11.9761 11.6667 11.6667 11.6667H2.33335C2.02393 11.6667 1.72719 11.5438 1.5084 11.325C1.2896 11.1062 1.16669 10.8095 1.16669 10.5V5.25004C1.16669 4.94062 1.2896 4.64388 1.5084 4.42508C1.72719 4.20629 2.02393 4.08337 2.33335 4.08337H3.49827C3.70852 4.08339 3.91486 4.02658 4.09548 3.91897C4.27609 3.81136 4.42428 3.65694 4.52435 3.47204L4.8096 2.94471C4.90968 2.75981 5.05786 2.60539 5.23848 2.49778C5.4191 2.39017 5.62544 2.33336 5.83569 2.33337H8.16494Z"
                                                    stroke="black" stroke-width="1.33333" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M7 9.33337C7.9665 9.33337 8.75 8.54987 8.75 7.58337C8.75 6.61688 7.9665 5.83337 7 5.83337C6.0335 5.83337 5.25 6.61688 5.25 7.58337C5.25 8.54987 6.0335 9.33337 7 9.33337Z"
                                                    stroke="black" stroke-width="1.33333" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg> --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-file-image-icon lucide-file-image">
                                                <path
                                                    d="M6 22a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h8a2.4 2.4 0 0 1 1.704.706l3.588 3.588A2.4 2.4 0 0 1 20 8v12a2 2 0 0 1-2 2z" />
                                                <path d="M14 2v5a1 1 0 0 0 1 1h5" />
                                                <circle cx="10" cy="12" r="2" />
                                                <path d="m20 17-1.296-1.296a2.41 2.41 0 0 0-3.408 0L9 22" />
                                            </svg>
                                        </div>
                                        <span>Upload</span>
                                    </label>
                                </div>
                                <div wire:loading wire:target="id">
                                    <i class="fa-solid fa-circle-notch fa-spin text-gray-400"></i>
                                    <span class="text-xs text-gray-400">Uploading...</span>
                                </div>
                            </div>

                            <input id="file-upload" type="file" wire:model="screenshot" class="hidden" />

                            <div class="mt-1 text-xs text-gray-400" wire:loading.remove wire:target="screenshot">
                                @if ($screenshot)
                                    Uploaded
                                @endif
                            </div>
                        </div>
                    </div>

                    <div x-cloak x-transition x-show="$store.confirmDepositPage.isQRModalOpen"
                        class="fixed top-0 left-0 h-svh w-full px-4 lg:px-96 pt-6 z-20">
                        <div class="absolute inset-0 h-svh w-full px-4 lg:px-96 pt-6 z-20 bg-dashboard opacity-85">
                        </div>
                        <div class="relative w-full h-full flex items-center justify-center z-30">
                            <div
                                class="max-w-sm mx-auto flex flex-col bg-dashboard border border-[#26252a] rounded-2xl pointer-events-auto">
                                <div class="p-6 overflow-y-auto">
                                    <div class="flex mb-6 items-center">
                                        <div class="flex-1">
                                            <h3 class="font-semibold text-white">
                                                Payment details QR code
                                            </h3>
                                        </div>
                                        <div class="flex-none">
                                            <div class="size-4 flex justify-center items-center cursor-pointer"
                                                x-on:click="$store.confirmDepositPage.toggleQRModal($wire)">
                                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M18 6 6 18"></path>
                                                    <path d="m6 6 12 12"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex justify-center mb-8">
                                        <div class="size-52 bg-[#FFFFFF] p-2 flex rounded-lg">
                                            <div wire:ignore class="size-52" id="qrcode"></div>
                                        </div>
                                    </div>
                                    <div class="mb-4 text-left">
                                        <p class="text-sm font-semibold text-white mb-2">Amount</p>
                                        <div class="flex items-center">
                                            <div class="flex-none text-wrap">
                                                <p class="text-white font-light break-words">
                                                    {{ $this->formatAmountToPay() }}</p>
                                                <input id="amount" type="text" id="hs-trailing-icon"
                                                    name="hs-trailing-icon" class="hidden"
                                                    value="{{ $this->amountToPay }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <p class="text-sm font-semibold text-white mb-2">Wallet Address</p>
                                        <div class="flex items-center gap-x-16">
                                            <div class="flex-1 overflow-x-auto">
                                                <input id="address" type="text" id="hs-trailing-icon"
                                                    name="hs-trailing-icon" class="hidden"
                                                    value="{{ $this->address }}">
                                                <p class="text-white font-light break-words whitespace-normal"
                                                    style="word-break: break-all;">{{ $this->address }}</p>
                                            </div>
                                            <div wire:click="storeDepositIntent()"
                                                x-on:click="$store.confirmDepositPage.copyWalletAddress($wire)"
                                                class="flex-none flex items-center gap-x-1.5 cursor-pointer">
                                                <span class="text-sm text-white font-light">Copy</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="#FFFFFF"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="js-clipboard-default size-4 group-hover:rotate-6 transition lucide lucide-copy-icon lucide-copy">
                                                    <rect width="14" height="14" x="8" y="8" rx="2"
                                                        ry="2" />
                                                    <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div x-cloak x-transition x-show="$store.confirmDepositPage.isClickOnPaidModalCopyOpen"
                        class="fixed top-0 left-0 h-svh w-full px-4 lg:px-96 pt-6 z-20">
                        <div class="absolute inset-0 h-svh w-full px-4 lg:px-96 pt-6 z-20 bg-dashboard opacity-85">
                        </div>
                        <div class="relative w-full h-full flex items-center justify-center z-30">
                            <div
                                class="max-w-sm mx-2 flex flex-col bg-dashboard border border-[#26252a] rounded-2xl pointer-events-auto">
                                <div class="p-6 pb-5 overflow-y-auto">
                                    <div class="mb-4 flex items-center gap-x-1">
                                        <h1 class="font-bold text-white">Steps to Deposit</h1>
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.75 10.6H3.25L2.25 0.5H6.75L5.75 10.6Z" fill="#EE1600" />
                                            <path
                                                d="M4.5002 15.5C5.56334 15.5 6.4252 14.6493 6.4252 13.6C6.4252 12.5506 5.56334 11.7 4.5002 11.7C3.43705 11.7 2.5752 12.5506 2.5752 13.6C2.5752 14.6493 3.43705 15.5 4.5002 15.5Z"
                                                fill="#EE1600" />
                                            <path d="M12.75 10.6H10.25L9.25 0.5H13.75L12.75 10.6Z" fill="#EE1600" />
                                            <path
                                                d="M11.5002 15.5C12.5633 15.5 13.4252 14.6493 13.4252 13.6C13.4252 12.5506 12.5633 11.7 11.5002 11.7C10.437 11.7 9.5752 12.5506 9.5752 13.6C9.5752 14.6493 10.437 15.5 11.5002 15.5Z"
                                                fill="#EE1600" />
                                        </svg>
                                    </div>
                                    <ul class="list-decimal list-inside text-white text-sm mb-4">
                                        <li>Copy the wallet address</li>
                                        <li class="my-1">Send payments to the address</li>
                                        <li>Upload a screenshot of your deposits and submit(only upload valid
                                            screenshots from your wallet app)</li>
                                    </ul>
                                    <div class="text-sm text-white rounded-lg border border-[#26252a] bg-dashboard p-2 mb-4"
                                        role="alert" tabindex="-1" aria-labelledby="hs-with-description-label">
                                        <div class="flex items-start">
                                            <div>
                                                <div class="text-xs text-zinc-300">
                                                    <span class="font-bold">NB</span>: Ensure to follow this steps for
                                                    your deposits to be confirmed.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button"
                                            x-on:click="$store.confirmDepositPage.toggleClickOnPaidModal();"
                                            type="button"
                                            class="py-2 px-5 w-full text-center text-sm font-semibold rounded-lg border border-transparent bg-accent text-black cursor-pointer hover:bg-accent focus:outline-hidden focus:bg-accent disabled:opacity-50 disabled:pointer-events-none">
                                            Okay
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div x-cloak x-transition x-show="$store.confirmDepositPage.isClickOnPaidModalQROpen"
                        class="fixed top-0 left-0 h-svh w-full px-4 lg:px-96 pt-6 z-20">
                        <div class="absolute inset-0 h-svh w-full px-4 lg:px-96 pt-6 z-20 bg-dashboard opacity-85">
                        </div>
                        <div class="relative w-full h-full flex items-center justify-center z-30">
                            <div
                                class="max-w-sm mx-2 flex flex-col bg-dashboard border border-[#26252a] rounded-2xl pointer-events-auto">
                                <div class="p-6 pb-5 overflow-y-auto">
                                    <div class="mb-4 flex items-center gap-x-1">
                                        <h1 class="font-bold text-white">Steps to Deposit</h1>
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.75 10.6H3.25L2.25 0.5H6.75L5.75 10.6Z" fill="#EE1600" />
                                            <path
                                                d="M4.5002 15.5C5.56334 15.5 6.4252 14.6493 6.4252 13.6C6.4252 12.5506 5.56334 11.7 4.5002 11.7C3.43705 11.7 2.5752 12.5506 2.5752 13.6C2.5752 14.6493 3.43705 15.5 4.5002 15.5Z"
                                                fill="#EE1600" />
                                            <path d="M12.75 10.6H10.25L9.25 0.5H13.75L12.75 10.6Z" fill="#EE1600" />
                                            <path
                                                d="M11.5002 15.5C12.5633 15.5 13.4252 14.6493 13.4252 13.6C13.4252 12.5506 12.5633 11.7 11.5002 11.7C10.437 11.7 9.5752 12.5506 9.5752 13.6C9.5752 14.6493 10.437 15.5 11.5002 15.5Z"
                                                fill="#EE1600" />
                                        </svg>
                                    </div>
                                    <ul class="list-decimal list-inside text-white text-sm mb-4">
                                        <li>Copy the wallet address</li>
                                        <li class="my-1">Send payments to the address</li>
                                        <li>Upload a screenshot of your deposits and submit(only upload valid
                                            screenshots from your wallet app)</li>
                                    </ul>
                                    <div class="text-sm text-white rounded-lg border border-[#26252a] bg-dashboard p-2 mb-4"
                                        role="alert" tabindex="-1" aria-labelledby="hs-with-description-label">
                                        <div class="flex items-start">
                                            <div>
                                                <div class="text-xs text-zinc-300">
                                                    <span class="font-bold">NB</span>: Ensure to follow this steps for
                                                    your deposits to be confirmed.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button"
                                            x-on:click="$store.confirmDepositPage.isClickOnPaidModalQROpen = false; $store.confirmDepositPage.isClickOnPaidViewedOnce = true; $store.confirmDepositPage.isQRModalOpen = !$store.confirmDepositPage.isQRModalOpen;"
                                            type="button"
                                            class="py-2 px-5 w-full text-center text-sm font-semibold rounded-lg border border-transparent bg-accent text-black cursor-pointer hover:bg-accent focus:outline-hidden focus:bg-accent disabled:opacity-50 disabled:pointer-events-none">
                                            Okay
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div x-cloak x-transition x-show="$store.confirmDepositPage.isDepositStepsModalOpen"
                        class="fixed top-0 left-0 h-svh w-full px-4 lg:px-96 pt-6 z-20">
                        <div class="absolute inset-0 h-svh w-full px-4 lg:px-96 pt-6 z-20 bg-dashboard opacity-85">
                        </div>
                        <div class="relative w-full h-full flex items-center justify-center z-30">
                            <div
                                class="max-w-sm mx-2 flex flex-col bg-dashboard border border-[#26252a] rounded-2xl pointer-events-auto">
                                <div class="p-6 pb-5 overflow-y-auto">
                                    <div class="mb-4 flex items-center gap-x-1">
                                        <h1 class="font-bold text-white">Steps to Deposit</h1>
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.75 10.6H3.25L2.25 0.5H6.75L5.75 10.6Z" fill="#EE1600" />
                                            <path
                                                d="M4.5002 15.5C5.56334 15.5 6.4252 14.6493 6.4252 13.6C6.4252 12.5506 5.56334 11.7 4.5002 11.7C3.43705 11.7 2.5752 12.5506 2.5752 13.6C2.5752 14.6493 3.43705 15.5 4.5002 15.5Z"
                                                fill="#EE1600" />
                                            <path d="M12.75 10.6H10.25L9.25 0.5H13.75L12.75 10.6Z" fill="#EE1600" />
                                            <path
                                                d="M11.5002 15.5C12.5633 15.5 13.4252 14.6493 13.4252 13.6C13.4252 12.5506 12.5633 11.7 11.5002 11.7C10.437 11.7 9.5752 12.5506 9.5752 13.6C9.5752 14.6493 10.437 15.5 11.5002 15.5Z"
                                                fill="#EE1600" />
                                        </svg>
                                    </div>
                                    <ul class="list-decimal list-inside text-white text-sm mb-4">
                                        <li>Copy the wallet address</li>
                                        <li class="my-1">Send payments to the address</li>
                                        <li>Upload a screenshot of your deposits and submit(only upload valid
                                            screenshots from your wallet app)</li>
                                    </ul>
                                    <div class="text-sm text-white rounded-lg border border-[#26252a] bg-dashboard p-2 mb-4"
                                        role="alert" tabindex="-1" aria-labelledby="hs-with-description-label">
                                        <div class="flex items-start">
                                            <div>
                                                <div class="text-xs text-zinc-300">
                                                    <span class="font-bold">NB</span>: Ensure to follow this steps for
                                                    your deposits to be confirmed.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button"
                                            x-on:click="$store.confirmDepositPage.isDepositStepsModalOpen = false;"
                                            type="button"
                                            class="py-2 px-5 w-full text-center text-sm font-semibold rounded-lg border border-transparent bg-accent text-black cursor-pointer hover:bg-accent focus:outline-hidden focus:bg-accent disabled:opacity-50 disabled:pointer-events-none">
                                            Okay
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-sm text-white rounded-lg bg-dashboard p-4 mb-2 mt-2" role="alert"
                        tabindex="-1" aria-labelledby="hs-with-description-label">
                        <div class="flex items-center">
                            <div class="shrink-0">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1668_24)">
                                        <path
                                            d="M9.99984 1.66675C14.6023 1.66675 18.3332 5.39758 18.3332 10.0001C18.3332 14.6026 14.6023 18.3334 9.99984 18.3334C5.39734 18.3334 1.6665 14.6026 1.6665 10.0001C1.6665 5.39758 5.39734 1.66675 9.99984 1.66675ZM9.9915 8.33341H9.1665C8.9541 8.33365 8.74981 8.41498 8.59536 8.56079C8.44092 8.7066 8.34797 8.90588 8.33553 9.11791C8.32308 9.32994 8.39207 9.53873 8.52839 9.70161C8.66472 9.86449 8.85809 9.96916 9.069 9.99425L9.1665 10.0001V14.1584C9.1665 14.5917 9.49484 14.9501 9.9165 14.9951L10.0082 15.0001H10.4165C10.5918 15.0001 10.7626 14.9448 10.9046 14.8422C11.0467 14.7395 11.1527 14.5947 11.2077 14.4283C11.2628 14.2619 11.2639 14.0824 11.211 13.9153C11.1581 13.7482 11.0539 13.602 10.9132 13.4976L10.8332 13.4451V9.17508C10.8332 8.74175 10.5048 8.38341 10.0832 8.33841L9.9915 8.33341ZM9.99984 5.83341C9.77882 5.83341 9.56686 5.92121 9.41058 6.07749C9.2543 6.23377 9.1665 6.44573 9.1665 6.66675C9.1665 6.88776 9.2543 7.09972 9.41058 7.256C9.56686 7.41228 9.77882 7.50008 9.99984 7.50008C10.2209 7.50008 10.4328 7.41228 10.5891 7.256C10.7454 7.09972 10.8332 6.88776 10.8332 6.66675C10.8332 6.44573 10.7454 6.23377 10.5891 6.07749C10.4328 5.92121 10.2209 5.83341 9.99984 5.83341Z"
                                            fill="white" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1668_24">
                                            <rect width="20" height="20" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="ms-1">
                                <div class="text-xs text-zinc-300">
                                    Only send {{ $this->method }} to this wallet address.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="md:px-52">
                        <a wire:click="createDeposit()">
                            <button type="button" wire:loading.attr="disabled"
                                class="py-3 cursor-pointer px-4 w-full md:px-6 md:py-3 text-center gap-x-2 text-sm md:text-base font-semibold rounded-lg bg-accent text-black focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">
                                <i wire:loading class="fa-solid fa-circle-notch fa-spin"></i>
                                <span wire:loading.remove>Submit</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let lastToast = null;

    function toast(type, message) {
        if (lastToast) {
            lastToast.hideToast();
        }

        let toastMarkup = '';

        if (type === 'info') {
            toastMarkup = `
            <div class="flex items-center p-4">
                <div class="shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                </div>
                <div class="ms-3 flex-1">
                    <p class="text-xs font-semibold text-white">${message}</p>
                </div>
            </div>
        `;
        }

        if (type === 'deposit-error') {
            toastMarkup = `
            <div class="flex items-center p-4">
                <div class="shrink-0">
                    <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-alert-icon lucide-shield-alert"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>
                </div>
                <div class="ms-3 flex-1">
                    <p class="text-xs font-semibold text-white">${message}</p>
                </div>
            </div>
            `;
        }

        lastToast = Toastify({
            text: toastMarkup,
            className: "hs-toastify-on:opacity-100 opacity-0 absolute top-0 start-1/2 -translate-x-1/2 z-90 w-4/5 md:w-1/2 lg:w-1/4 transition-all duration-300 bg-dim border border-[#26252a] text-sm text-white rounded-xl shadow-lg [&>.toast-close]:hidden",
            duration: 4000,
            close: true,
            escapeMarkup: false
        });

        lastToast.showToast();
    }

    document.addEventListener('alpine:init', () => {
        Alpine.store('confirmDepositPage', {
            isQRModalOpen: false,
            isDepositStepsModalOpen: true,
            isClickOnPaidModalCopyOpen: false,
            isClickOnPaidModalQROpen: false,
            isClickOnPaidViewedOnce: false,
            init() {
                this.generateQRCode()
            },
            generateQRCode() {
                var qrcode = new QRCode("qrcode");
                var address = new URLSearchParams(window.location.search).get('address');
                qrcode.makeCode(address);
            },
            toggleClickOnPaidModal() {
                this.isClickOnPaidModalCopyOpen = !this.isClickOnPaidModalCopyOpen;
            },
            copyWalletAddress(wire) {
                var copyText = document.getElementById("address");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                navigator.clipboard.writeText(copyText.value);
                toast('info', 'Copied');
                if (wire.hasUserMadeTwoSuccessfulDeposits) {
                    return;
                }
                setTimeout(() => {
                    if (this.isClickOnPaidViewedOnce) {
                        return;
                    }
                    // Only show the modal if QR modal is not open
                    if (!this.isQRModalOpen) {
                        this.isClickOnPaidModalCopyOpen = true;
                    }
                    this.isClickOnPaidViewedOnce = true;
                }, 1000);
            },
            toggleQRModal(wire) {
                if (wire.hasUserMadeTwoSuccessfulDeposits) {
                    this.isQRModalOpen = !this.isQRModalOpen;
                    return;
                }
                if (this.isClickOnPaidViewedOnce) {
                    this.isQRModalOpen = !this.isQRModalOpen;
                    return;
                }
                this.isClickOnPaidModalQROpen = true;
            },
        })
    })
</script>

@script
    <script>
        $wire.on('deposit-error', (event) => {
            toast('deposit-error', event.message);
            Alpine.$data($wire.el).uploadError = true;
        });
    </script>
@endscript
