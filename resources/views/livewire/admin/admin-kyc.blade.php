<!-- ===== Content Area Start ===== -->
<div x-data class="relative flex flex-1 flex-col overflow-x-hidden overflow-y-auto">
    <!-- Small Device Overlay Start -->
    <div :class="sidebarToggle ? 'block lg:hidden' : 'hidden'" class="fixed z-9 h-screen w-full bg-gray-900/50">
    </div>
    <!-- Small Device Overlay End -->

    <!-- ===== Main Content Start ===== -->
    <main>
        <livewire:admin.partials.header :key="'header-' . now()" />
        <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                    <!-- Table Five -->
                    <div
                        class="rounded-2xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">
                        <div
                            class="mb-4 flex flex-col gap-2 px-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                    KYC Requests
                                </h3>
                            </div>
                        </div>

                        <div class="custom-scrollbar max-w-full overflow-x-auto overflow-y-visible px-5 sm:px-6">
                            <table class="min-w-full">
                                <thead class="border-y border-gray-100 py-3 dark:border-gray-800">
                                    <th class="py-3 pr-5 font-normal whitespace-nowrap sm:pr-6">
                                        <div class="flex items-center">
                                            <p class="text-theme-sm text-gray-500 dark:text-gray-400">User</p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 font-normal whitespace-nowrap sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-theme-sm text-gray-500 dark:text-gray-400">Country</p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 font-normal whitespace-nowrap sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-theme-sm text-gray-500 dark:text-gray-400">Status</p>
                                        </div>
                                    </th>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                    @forelse ($kycRequests as $kyc)
                                        <tr wire:key="kyc-{{ $kyc['id'] }}" x-data="{ isActionDropdownOpen: false }">
                                            <td class="py-3 pr-5 whitespace-nowrap sm:pr-5">
                                                <div class="flex items-center">
                                                    <p
                                                        class="text-theme-sm block font-medium text-gray-700 dark:text-gray-400">
                                                        {{ $kyc['fullname'] }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                                <div class="flex items-center">
                                                    <p class="text-theme-sm text-gray-700 dark:text-gray-400">
                                                        {{ $kyc['country'] }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                                <div class="flex items-center">
                                                    <p
                                                        class="text-theme-xs {{ $this->getStatusIndicatorColor($kyc['status']) }} rounded-full px-2 py-0.5 font-medium">
                                                        {{ ucfirst($kyc['status']) }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                                <div class="flex items-center justify-center">
                                                    <div class="relative">
                                                        <button
                                                            x-on:click="isActionDropdownOpen = !isActionDropdownOpen"
                                                            class="text-gray-500 dark:text-gray-400">
                                                            <svg class="fill-current" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M5.99902 10.245C6.96552 10.245 7.74902 11.0285 7.74902 11.995V12.005C7.74902 12.9715 6.96552 13.755 5.99902 13.755C5.03253 13.755 4.24902 12.9715 4.24902 12.005V11.995C4.24902 11.0285 5.03253 10.245 5.99902 10.245ZM17.999 10.245C18.9655 10.245 19.749 11.0285 19.749 11.995V12.005C19.749 12.9715 18.9655 13.755 17.999 13.755C17.0325 13.755 16.249 12.9715 16.249 12.005V11.995C16.249 11.0285 17.0325 10.245 17.999 10.245ZM13.749 11.995C13.749 11.0285 12.9655 10.245 11.999 10.245C11.0325 10.245 10.249 11.0285 10.249 11.995V12.005C10.249 12.9715 11.0325 13.755 11.999 13.755C12.9655 13.755 13.749 12.9715 13.749 12.005V11.995Z"
                                                                    fill="" />
                                                            </svg>
                                                        </button>
                                                        <div x-show="isActionDropdownOpen"
                                                            @click.outside="isActionDropdownOpen = false"
                                                            class="shadow-theme-lg dark:bg-gray-dark absolute top-0 left-0 z-40 w-fit-content space-y-1 rounded-2xl border border-gray-200 bg-white p-2 pr-4 dark:border-gray-800">
                                                            <a
                                                                href="{{ route('admin.dashboard.kyc.details', ['id' => $kyc['id']]) }}">
                                                                <button x-on:click="isActionDropdownOpen = false"
                                                                    class="text-theme-xs flex w-full rounded-lg px-3 py-2 text-left font-medium text-gray-700">
                                                                    Review
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4 text-theme-sm text-gray-500">
                                                No requests found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="flex justify-center mt-8">
                        <div>
                            {{ $kycRequests->links('livewire::tailwind') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ===== Main Content End ===== -->
</div>
<!-- ===== Content Area End ===== -->
