<div class="lg:px-0 h-full">
    <div class="md:hidden h-full relative">
        <div class="px-12 flex items-center justify-center h-full">
            <div
                class="max-w-sm mx-auto flex flex-col bg-dim border border-[#26252a] rounded-2xl pointer-events-auto">
                <div class="p-6 overflow-y-auto text-center">
                    <div class="flex justify-center mb-4">
                        <div class="size-18 flex items-center justify-center rounded-full border-3 border-accent">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wifi-off-icon lucide-wifi-off"><path d="M12 20h.01"/><path d="M8.5 16.429a5 5 0 0 1 7 0"/><path d="M5 12.859a10 10 0 0 1 5.17-2.69"/><path d="M19 12.859a10 10 0 0 0-2.007-1.523"/><path d="M2 8.82a15 15 0 0 1 4.177-2.643"/><path d="M22 8.82a15 15 0 0 0-11.288-3.764"/><path d="m2 2 20 20"/></svg>
                        </div>
                    </div>
                    <h1 class="text-white font-bold text-base mb-3">
                        You are offline
                    </h1>
                    <p class="text-sm text-[#a4a4a4] mb-2">Connect to the internet to access trading features.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden md:block lg:hidden h-full relative">
        <div class="px-12 flex items-center justify-center h-full">
            <div
                class="max-w-sm mx-auto flex flex-col bg-dim border border-[#26252a] rounded-2xl pointer-events-auto">
                <div class="p-6 overflow-y-auto text-center">
                    <div class="flex justify-center mb-4">
                        <div class="size-18 flex items-center justify-center rounded-full border-3 border-accent">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wifi-off-icon lucide-wifi-off"><path d="M12 20h.01"/><path d="M8.5 16.429a5 5 0 0 1 7 0"/><path d="M5 12.859a10 10 0 0 1 5.17-2.69"/><path d="M19 12.859a10 10 0 0 0-2.007-1.523"/><path d="M2 8.82a15 15 0 0 1 4.177-2.643"/><path d="M22 8.82a15 15 0 0 0-11.288-3.764"/><path d="m2 2 20 20"/></svg>
                        </div>
                    </div>
                    <h1 class="text-white font-bold text-base mb-3">
                        You are offline
                    </h1>
                    <p class="text-sm text-[#a4a4a4] mb-2">Connect to the internet to access trading features.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden lg:flex h-full">
        <div class="h-full flex-1 relative">
            <div class="px-12 flex items-center justify-center h-full">
                <div
                    class="max-w-sm mx-auto flex flex-col bg-dim border border-[#26252a] rounded-2xl pointer-events-auto">
                    <div class="p-6 overflow-y-auto text-center">
                        <div class="flex justify-center mb-4">
                            <div
                                class="size-18 flex items-center justify-center rounded-full border-3 border-accent">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wifi-off-icon lucide-wifi-off"><path d="M12 20h.01"/><path d="M8.5 16.429a5 5 0 0 1 7 0"/><path d="M5 12.859a10 10 0 0 1 5.17-2.69"/><path d="M19 12.859a10 10 0 0 0-2.007-1.523"/><path d="M2 8.82a15 15 0 0 1 4.177-2.643"/><path d="M22 8.82a15 15 0 0 0-11.288-3.764"/><path d="m2 2 20 20"/></svg>
                            </div>
                        </div>
                        <h1 class="text-white font-bold text-base mb-3">
                            You are offline
                        </h1>
                        <p class="text-sm text-[#a4a4a4] mb-2">Connect to the internet to access trading features.
                        </p>
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
                <div class="flex items-center p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                        </svg>
                    </div>
                    <div class="ms-3 flex-1">
                        <p class="text-xs font-semibold text-white">${event.message}</p>
                    </div>
                </div>
            `;

            Toastify({
                text: toastMarkup,
                className: "hs-toastify-on:opacity-100 opacity-0 absolute top-0 start-1/2 -translate-x-1/2 z-90 w-4/5 md:w-1/2 lg:w-1/4 transition-all duration-300 bg-dim  border border-[#26252a] text-sm text-white rounded-xl shadow-lg [&>.toast-close]:hidden",
                duration: 6000,
                close: true,
                escapeMarkup: false
            }).showToast();
        });
    </script>
@endscript
