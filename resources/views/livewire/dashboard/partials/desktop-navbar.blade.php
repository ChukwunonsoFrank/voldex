<div x-data class="hidden lg:flex flex-none flex-col items-center space-y-3 w-16 lg:border-r lg:border-[#26252a]">
    <div @class([
        'w-full' => true,
        'py-3' => true,
        'cursor-pointer' => true,
        'hover:bg-dim' => true,
    ])>
        <a class="block" href="{{ route('dashboard') }}">
            <div class="mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="#D4D4D4" stroke-width="{{ request()->is('dashboard') ? 2 : 1 }}" stroke-linecap="round"
                    stroke-linejoin="round"
                    class="block mx-auto icon icon-tabler icons-tabler-outline icon-tabler-chart-candle">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 6m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                    <path d="M6 4l0 2" />
                    <path d="M6 11l0 9" />
                    <path d="M10 14m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                    <path d="M12 4l0 10" />
                    <path d="M12 19l0 1" />
                    <path d="M16 5m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                    <path d="M18 4l0 1" />
                    <path d="M18 11l0 9" />
                </svg>
            </div>
            <div class="text-center">
                <p
                    class="text-[9px] font-semibold tracking-wide {{ request()->is('dashboard') ? 'text-white' : 'text-[#a4a4a4]' }}">
                    Chart</p>
            </div>
        </a>
    </div>

    <div @class([
        'w-full' => true,
        'py-3' => true,
        'cursor-pointer' => true,
        'hover:bg-dim' => true,
    ])>
        <a class="block" href="{{ route('dashboard.history') }}">
            <div class="mb-1">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="block mx-auto"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 12H12.01" stroke="#D4D4D4"
                        stroke-width="{{ request()->is('dashboard/history') || request()->is('dashboard/history/details') ? 2 : 1 }}"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M16 6V4C16 3.46957 15.7893 2.96086 15.4142 2.58579C15.0391 2.21071 14.5304 2 14 2H10C9.46957 2 8.96086 2.21071 8.58579 2.58579C8.21071 2.96086 8 3.46957 8 4V6"
                        stroke="#D4D4D4"
                        stroke-width="{{ request()->is('dashboard/history') || request()->is('dashboard/history/details') ? 2 : 1 }}"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M22 13C19.0328 14.959 15.5555 16.0033 12 16.0033C8.44445 16.0033 4.96721 14.959 2 13"
                        stroke="#D4D4D4"
                        stroke-width="{{ request()->is('dashboard/history') || request()->is('dashboard/history/details') ? 2 : 1 }}"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M20 6H4C2.89543 6 2 6.89543 2 8V18C2 19.1046 2.89543 20 4 20H20C21.1046 20 22 19.1046 22 18V8C22 6.89543 21.1046 6 20 6Z"
                        stroke="#D4D4D4"
                        stroke-width="{{ request()->is('dashboard/history') || request()->is('dashboard/history/details') ? 2 : 1 }}"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div class="text-center">
                <p
                    class="text-[9px] font-semibold tracking-wide {{ request()->is('dashboard/history') || request()->is('dashboard/history/details') ? 'text-white' : 'text-[#a4a4a4]' }}">
                    Deals</p>
            </div>
        </a>
    </div>

    <div @class([
        'w-full' => true,
        'py-3' => true,
        'cursor-pointer' => true,
        'hover:bg-dim' => true,
    ])>
        <a class="block" wire:click="robot()">
            <div class="mb-1">
                <svg class="block mx-auto" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M22 5H16V8H17V16H16V19H22V16H21V8H22V5Z"
                        fill="{{ request()->is('dashboard/robot') || request()->is('dashboard/robot/traderoom') ? 'white' : '#A4A4A4' }}" />
                    <path d="M13 5V19H9.5V15H6.5V19H3V5H13ZM6.5 8.5V11.5H9.5V8.5H6.5Z"
                        fill="{{ request()->is('dashboard/robot') || request()->is('dashboard/robot/traderoom') ? 'white' : '#A4A4A4' }}" />
                </svg>
            </div>
            <div class="text-center">
                <p
                    class="text-[9px] font-semibold tracking-wide {{ request()->is('dashboard/robot') || request()->is('dashboard/robot/traderoom') ? 'text-white' : 'text-[#a4a4a4]' }}">
                    Robot</p>
            </div>
        </a>
    </div>

    <div @class([
        'w-full' => true,
        'py-3' => true,
        'cursor-pointer' => true,
        'hover:bg-dim' => true,
    ])>
        <a class="block" x-on:click="$store.desktopNavbar.toggleSupportModal()">
            <div class="mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="#D4D4D4" stroke-width="{{ request()->is('dashboard/support') ? 2 : 1 }}"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="block mx-auto icon icon-tabler icons-tabler-outline icon-tabler-message-2">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M8 9h8" />
                    <path d="M8 13h6" />
                    <path
                        d="M9 18h-3a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-3l-3 3l-3 -3z" />
                </svg>
            </div>
            <div class="text-center">
                <p
                    class="text-[9px] font-semibold tracking-wide {{ request()->is('dashboard/support') ? 'text-white' : 'text-[#a4a4a4]' }}">
                    Support</p>
            </div>
        </a>
    </div>

    <div @class([
        'w-full' => true,
        'py-3' => true,
        'cursor-pointer' => true,
        'hover:bg-dim' => true,
    ])>
        <a class="block" href="{{ route('dashboard.account') }}">
            <div class="mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="#D4D4D4" stroke-width="{{ request()->is('dashboard/account') ? 2 : 1 }}"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="block mx-auto icon icon-tabler icons-tabler-outline icon-tabler-user">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                </svg>
            </div>
            <div class="text-center">
                <p
                    class="text-[9px] font-semibold tracking-wide {{ request()->is('dashboard/account') ? 'text-white' : 'text-[#a4a4a4]' }}">
                    Account</p>
            </div>
        </a>
    </div>

    <div x-cloak x-show="$store.desktopNavbar.isSupportModalOpen" x-transition
        class="fixed top-0 right-0 h-svh w-96 bg-dashboard z-20 flex flex-col border border-[#26252a]">
        <div class="flex items-center px-4 py-4 border-y border-[#26252a]">
            <div class="flex-1">
                <h1 class="text-white text-base font-bold">Support</h1>
            </div>
            <div class="flex-none">
                <svg x-on:click="$store.desktopNavbar.toggleSupportModal()" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-x-icon lucide-x">
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg>
            </div>
        </div>
        <div class="grow">
            <iframe frameborder="0" width="100%" height="100%"
                src="https://tawk.to/chat/693d5de40981ca197f7a915d/1jcbrdhu4"></iframe>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('desktopNavbar', {
            isSupportModalOpen: false,
            toggleSupportModal() {
                this.isSupportModalOpen = !this.isSupportModalOpen;
            },
        })
    })
</script>
