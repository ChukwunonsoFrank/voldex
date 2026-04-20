<div x-data>
    <div class="w-48">
        <div class="flex-1 md:flex-none relative">
            <div x-on:click="$store.balanceDropdown.toggleSelect()"
                class="flex items-center space-x-3 py-1.5 px-3 border border-[#26252a] bg-transparent rounded-lg text-[#FFFFFF]">
                <div class="flex-1">
                    <p class="text-zinc-300 text-[10px] mb-1 font-medium">Demo Balance</p>
                    <p class="text-white font-bold text-xs md:text-sm">@money(auth()->user()->demo_balance / 100)</p>
                </div>
                <div class="flex-none justify-self-end">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-chevron-down-icon lucide-chevron-down">
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="relative z-20">
            <div x-cloak x-show="$store.balanceDropdown.isTradingAccountSelectOpen"
                @click.outside="$store.balanceDropdown.isTradingAccountSelectOpen = false"
                class="border border-[#26252a] bg-dim absolute rounded-lg w-full overflow-scroll p-1 scrollbar-hide mt-1">
                <div
                    class="hover:bg-gray-600 cursor-pointer flex items-center space-x-3 py-1.5 px-3 rounded-lg text-[#FFFFFF]">
                    <div class="flex-1">
                        <p class="text-zinc-300 text-[10px] mb-1 font-medium">Demo Account</p>
                        <p class="text-white font-bold text-xs md:text-sm">@money(auth()->user()->demo_balance / 100)</p>
                    </div>
                </div>
                <div
                    class="hover:bg-gray-600 cursor-pointer flex items-center space-x-3 py-1.5 px-3 rounded-lg text-[#FFFFFF]">
                    <div class="flex-1">
                        <p class="text-zinc-300 text-[10px] mb-1 font-medium">Live Account</p>
                        <p class="text-white font-bold text-xs md:text-sm">@money(auth()->user()->live_balance / 100)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('balanceDropdown', {
            isTradingAccountSelectOpen: false,

            toggleSelect() {
                this.isTradingAccountSelectOpen = !this.isTradingAccountSelectOpen
            }
        })
    })
</script>
