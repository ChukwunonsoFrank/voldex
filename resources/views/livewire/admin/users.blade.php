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
            <!-- Flash messages -->
            @if (session()->has('success-message'))
                <div wire:key="success-{{ time() }}" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => { show = false }, 4000)"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90"
                    class="rounded-xl border border-success-500 bg-success-50 p-4 mb-4 dark:border-success-500/30 dark:bg-success-500/15">
                    <div class="flex items-start gap-3">
                        <div class="-mt-0.5 text-success-500">
                            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.70186 12.0001C3.70186 7.41711 7.41711 3.70186 12.0001 3.70186C16.5831 3.70186 20.2984 7.41711 20.2984 12.0001C20.2984 16.5831 16.5831 20.2984 12.0001 20.2984C7.41711 20.2984 3.70186 16.5831 3.70186 12.0001ZM12.0001 1.90186C6.423 1.90186 1.90186 6.423 1.90186 12.0001C1.90186 17.5772 6.423 22.0984 12.0001 22.0984C17.5772 22.0984 22.0984 17.5772 22.0984 12.0001C22.0984 6.423 17.5772 1.90186 12.0001 1.90186ZM15.6197 10.7395C15.9712 10.388 15.9712 9.81819 15.6197 9.46672C15.2683 9.11525 14.6984 9.11525 14.347 9.46672L11.1894 12.6243L9.6533 11.0883C9.30183 10.7368 8.73198 10.7368 8.38051 11.0883C8.02904 11.4397 8.02904 12.0096 8.38051 12.3611L10.553 14.5335C10.7217 14.7023 10.9507 14.7971 11.1894 14.7971C11.428 14.7971 11.657 14.7023 11.8257 14.5335L15.6197 10.7395Z"
                                    fill="" />
                            </svg>
                        </div>

                        <div>
                            <h4 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white/90">
                                {{ session('success-message') }}
                            </h4>
                        </div>
                    </div>
                </div>
            @endif

            @if (session()->has('error-message'))
                <div wire:key="success-{{ time() }}" x-data="{ show: true }" x-show="show"
                    x-init="setTimeout(() => { show = false }, 4000)" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90"
                    class="rounded-xl border border-error-500 bg-error-50 mb-4 p-4 dark:border-error-500/30 dark:bg-error-500/15">
                    <div class="flex items-start gap-3">
                        <div class="-mt-0.5 text-error-500">
                            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M20.3499 12.0004C20.3499 16.612 16.6115 20.3504 11.9999 20.3504C7.38832 20.3504 3.6499 16.612 3.6499 12.0004C3.6499 7.38881 7.38833 3.65039 11.9999 3.65039C16.6115 3.65039 20.3499 7.38881 20.3499 12.0004ZM11.9999 22.1504C17.6056 22.1504 22.1499 17.6061 22.1499 12.0004C22.1499 6.3947 17.6056 1.85039 11.9999 1.85039C6.39421 1.85039 1.8499 6.3947 1.8499 12.0004C1.8499 17.6061 6.39421 22.1504 11.9999 22.1504ZM13.0008 16.4753C13.0008 15.923 12.5531 15.4753 12.0008 15.4753L11.9998 15.4753C11.4475 15.4753 10.9998 15.923 10.9998 16.4753C10.9998 17.0276 11.4475 17.4753 11.9998 17.4753L12.0008 17.4753C12.5531 17.4753 13.0008 17.0276 13.0008 16.4753ZM11.9998 6.62898C12.414 6.62898 12.7498 6.96476 12.7498 7.37898L12.7498 13.0555C12.7498 13.4697 12.414 13.8055 11.9998 13.8055C11.5856 13.8055 11.2498 13.4697 11.2498 13.0555L11.2498 7.37898C11.2498 6.96476 11.5856 6.62898 11.9998 6.62898Z"
                                    fill="#F04438" />
                            </svg>
                        </div>

                        <div>
                            <h4 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white/90">
                                {{ session('error-message') }}
                            </h4>
                        </div>
                    </div>
                </div>
            @endif

            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                    <!-- Table Five -->
                    <div
                        class="rounded-2xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">
                        <div
                            class="mb-4 flex flex-col gap-2 px-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                    Users
                                </h3>
                            </div>
                            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                                <form wire:submit.prevent="search">
                                    <div class="flex items-center space-x-2">
                                        <div class="relative">
                                            <span class="pointer-events-none absolute top-1/2 left-4 -translate-y-1/2">
                                                <svg class="fill-gray-500 dark:fill-gray-400" width="20"
                                                    height="20" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M3.04199 9.37381C3.04199 5.87712 5.87735 3.04218 9.37533 3.04218C12.8733 3.04218 15.7087 5.87712 15.7087 9.37381C15.7087 12.8705 12.8733 15.7055 9.37533 15.7055C5.87735 15.7055 3.04199 12.8705 3.04199 9.37381ZM9.37533 1.54218C5.04926 1.54218 1.54199 5.04835 1.54199 9.37381C1.54199 13.6993 5.04926 17.2055 9.37533 17.2055C11.2676 17.2055 13.0032 16.5346 14.3572 15.4178L17.1773 18.2381C17.4702 18.531 17.945 18.5311 18.2379 18.2382C18.5308 17.9453 18.5309 17.4704 18.238 17.1775L15.4182 14.3575C16.5367 13.0035 17.2087 11.2671 17.2087 9.37381C17.2087 5.04835 13.7014 1.54218 9.37533 1.54218Z"
                                                        fill="" />
                                                </svg>
                                            </span>
                                            <input type="text" wire:model="query"
                                                class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-[42px] w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-[42px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[300px]" />
                                        </div>
                                        <div>
                                            <button type="submit"
                                                class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                                                Search
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="custom-scrollbar max-w-full overflow-x-auto overflow-y-visible px-5 sm:px-6">
                            <table class="min-w-full">
                                <thead class="border-y border-gray-100 py-3 dark:border-gray-800">
                                    <th class="py-3 pr-5 font-normal whitespace-nowrap sm:pr-6">
                                        <div class="flex items-center">
                                            <p class="text-theme-sm text-gray-500 dark:text-gray-400">Username</p>
                                        </div>
                                    </th>
                                    <th class="py-3 pr-5 font-normal whitespace-nowrap sm:pr-6">
                                        <div class="flex items-center">
                                            <p class="text-theme-sm text-gray-500 dark:text-gray-400">Tasks Completed
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 font-normal whitespace-nowrap sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-theme-sm text-gray-500 dark:text-gray-400">Hold Status</p>
                                        </div>
                                    </th>
                                    <th class="py-3 pr-5 font-normal whitespace-nowrap sm:pr-6">
                                        <div class="flex items-center">
                                            <p class="text-theme-sm text-gray-500 dark:text-gray-400">Task Pole
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 font-normal whitespace-nowrap sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-theme-sm text-gray-500 dark:text-gray-400">Balance</p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 font-normal whitespace-nowrap sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-theme-sm text-gray-500 dark:text-gray-400">Status</p>
                                        </div>
                                    </th>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                    @forelse ($users as $user)
                                        <tr wire:key="user-{{ $user['id'] }}" x-data="{ isActionDropdownOpen: false }">
                                            <td class="py-3 pr-5 whitespace-nowrap sm:pr-5">
                                                <div class="flex gap-x-1 items-center">
                                                    <p
                                                        class="text-theme-sm block font-medium text-gray-700 dark:text-gray-400">
                                                        {{ $user['username'] }}
                                                    </p>
                                                    @if ($user['is_banned'])
                                                        <p
                                                            class="text-theme-xs bg-error-50 text-error-600 rounded-full px-2 py-0.5 font-medium">
                                                            Banned
                                                        </p>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="py-3 pr-5 whitespace-nowrap sm:pr-5">
                                                <div class="flex items-center">
                                                    <p
                                                        class="text-theme-sm block font-medium text-gray-700 dark:text-gray-400">
                                                        {{ $user['tasks_completed'] }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                                <div class="flex items-center">
                                                    <p
                                                        class="text-theme-xs {{ $this->getStatusIndicatorColor($user['lien_status']) }} rounded-full px-2 py-0.5 font-medium">
                                                        {{ $user['lien_status'] === 'on_hold' ? 'On Hold' : 'Off Hold' }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="py-3 pr-5 whitespace-nowrap sm:pr-5">
                                                <div class="flex items-center">
                                                    <p
                                                        class="text-theme-sm block font-medium text-gray-700 dark:text-gray-400">
                                                        {{ $user['task_pole'] }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                                <div class="flex items-center">
                                                    <p class="text-theme-sm text-gray-700 dark:text-gray-400">
                                                        @if ($user['lien_status'] === 'on_hold')
                                                            -@money((int) $user['lien_amount'] / 100)
                                                        @else
                                                            @money($user['balance'] / 100)
                                                        @endif
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                                <div class="flex items-center">
                                                    <p
                                                        class="text-theme-xs {{ $this->getStatusIndicatorColor($user['account_status']) }} rounded-full px-2 py-0.5 font-medium">
                                                        {{ ucfirst($user['account_status']) }}
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
                                                            class="shadow-theme-lg absolute top-0 left-0 z-40 w-fit-content space-y-1 rounded-2xl border border-gray-200 bg-white p-2 pr-4">
                                                            <a
                                                                href="{{ route('admin.dashboard.users.details', ['id' => $user['id']]) }}">
                                                                <button x-on:click="isActionDropdownOpen = false"
                                                                    class="text-theme-xs flex w-full rounded-lg px-3 py-2 text-left font-medium text-gray-700">
                                                                    View user
                                                                </button>
                                                            </a>
                                                            @if ($user['account_status'] === 'active')
                                                                <form
                                                                    wire:submit.prevent="deactivateUser({{ $user['id'] }})">
                                                                    <button type="submit"
                                                                        x-on:click="isActionDropdownOpen = false"
                                                                        class="text-theme-xs flex w-full rounded-lg px-3 py-2 text-left font-medium text-error-600">
                                                                        Deactivate
                                                                    </button>
                                                                </form>
                                                            @endif
                                                            @if ($user['account_status'] === 'inactive')
                                                                <form
                                                                    wire:submit.prevent="activateUser({{ $user['id'] }})">
                                                                    <button type="submit"
                                                                        x-on:click="isActionDropdownOpen = false"
                                                                        class="text-theme-xs flex w-full rounded-lg px-3 py-2 text-left font-medium text-success-600">
                                                                        Activate
                                                                    </button>
                                                                </form>
                                                            @endif
                                                            @if ($user['is_banned'])
                                                                <form
                                                                    wire:submit.prevent="unbanUser({{ $user['id'] }})">
                                                                    <button type="submit"
                                                                        x-on:click="isActionDropdownOpen = false"
                                                                        class="text-theme-xs flex w-full rounded-lg px-3 py-2 text-left font-medium text-success-600">
                                                                        Unban user
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <form
                                                                    wire:submit.prevent="banUser({{ $user['id'] }})">
                                                                    <button type="submit"
                                                                        x-on:click="isActionDropdownOpen = false"
                                                                        class="text-theme-xs flex w-full rounded-lg px-3 py-2 text-left font-medium text-error-600">
                                                                        Ban user
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4 text-theme-sm text-gray-500">
                                                No users found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="flex justify-center mt-8">
                        <div>
                            {{-- {{ $users->links('pagination::tailwind') }} --}}
                            {{ $users->links('livewire::tailwind') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ===== Main Content End ===== -->
</div>
<!-- ===== Content Area End ===== -->
