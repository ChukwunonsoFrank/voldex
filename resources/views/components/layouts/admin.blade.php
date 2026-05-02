<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>
        Voldex - Admin Dashboard
    </title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

    <link href="{{ asset('assets/admin/style.css') }}" rel="stylesheet">
    @livewireStyles
</head>

<body x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'dark bg-gray-900': darkMode === true }">
    <!-- ===== Preloader Start ===== -->
    <div x-show="loaded" x-init="window.addEventListener('DOMContentLoaded', () => { setTimeout(() => loaded = false, 500) })"
        class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-black">
        <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-brand-500 border-t-transparent">
        </div>
    </div>

    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">
        <!-- ===== Sidebar Start ===== -->
        <aside :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
            class="sidebar fixed top-0 left-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-auto border-r border-gray-200 bg-white px-5 transition-all duration-300 lg:static lg:translate-x-0 dark:border-gray-800 dark:bg-black"
            @click.outside="sidebarToggle = false">

            <div class="no-scrollbar flex flex-col pt-8 overflow-y-auto duration-300 ease-linear">
                <!-- Sidebar Menu -->
                <nav x-data="{ selected: $persist('Users') }">
                    <!-- Menu Group -->
                    <div class="pt-16">
                        <ul class="mb-6 flex flex-col gap-4">

                            <!-- Menu Item Users -->
                            <li>
                                <a href="{{ route('admin.dashboard.users') }}"
                                    @click="selected = (selected === 'Users' ? '':'Users')" class="menu-item group"
                                    :class="(selected === 'Users') && (page === 'users') ? 'menu-item-active' :
                                    'menu-item-inactive'">
                                    <svg :class="(selected === 'Users') && (page === 'users') ? 'menu-item-icon-active' :
                                    'menu-item-icon-inactive'"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12 3.5C7.30558 3.5 3.5 7.30558 3.5 12C3.5 14.1526 4.3002 16.1184 5.61936 17.616C6.17279 15.3096 8.24852 13.5955 10.7246 13.5955H13.2746C15.7509 13.5955 17.8268 15.31 18.38 17.6167C19.6996 16.119 20.5 14.153 20.5 12C20.5 7.30558 16.6944 3.5 12 3.5ZM17.0246 18.8566V18.8455C17.0246 16.7744 15.3457 15.0955 13.2746 15.0955H10.7246C8.65354 15.0955 6.97461 16.7744 6.97461 18.8455V18.856C8.38223 19.8895 10.1198 20.5 12 20.5C13.8798 20.5 15.6171 19.8898 17.0246 18.8566ZM2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM11.9991 7.25C10.8847 7.25 9.98126 8.15342 9.98126 9.26784C9.98126 10.3823 10.8847 11.2857 11.9991 11.2857C13.1135 11.2857 14.0169 10.3823 14.0169 9.26784C14.0169 8.15342 13.1135 7.25 11.9991 7.25ZM8.48126 9.26784C8.48126 7.32499 10.0563 5.75 11.9991 5.75C13.9419 5.75 15.5169 7.32499 15.5169 9.26784C15.5169 11.2107 13.9419 12.7857 11.9991 12.7857C10.0563 12.7857 8.48126 11.2107 8.48126 9.26784Z"
                                            fill="" />
                                    </svg>

                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                        Users
                                    </span>
                                </a>
                            </li>
                            <!-- Menu Item Users -->

                            <!-- Menu Item Withdrawals -->
                            <li>
                                <a href="{{ route('admin.dashboard.withdrawals') }}"
                                    @click="selected = (selected === 'Withdrawals' ? '':'Withdrawals')"
                                    class="menu-item group"
                                    :class="(selected === 'Withdrawals') && (page === 'withdrawals') ? 'menu-item-active' :
                                    'menu-item-inactive'">
                                    <svg class="fill-current" width="25" height="24" viewBox="0 0 25 24"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M13.4164 2.79175C13.4164 2.37753 13.0806 2.04175 12.6664 2.04175C12.2522 2.04175 11.9164 2.37753 11.9164 2.79175V4.39876C9.94768 4.67329 8.43237 6.36366 8.43237 8.40795C8.43237 10.0954 9.47908 11.6058 11.0591 12.1984L13.7474 13.2066C14.7419 13.5795 15.4008 14.5303 15.4008 15.5925C15.4008 16.9998 14.2599 18.1407 12.8526 18.1407H11.7957C10.7666 18.1407 9.93237 17.3064 9.93237 16.2773C9.93237 15.8631 9.59659 15.5273 9.18237 15.5273C8.76816 15.5273 8.43237 15.8631 8.43237 16.2773C8.43237 18.1348 9.9382 19.6407 11.7957 19.6407H11.9164V21.2083C11.9164 21.6225 12.2522 21.9583 12.6664 21.9583C13.0806 21.9583 13.4164 21.6225 13.4164 21.2083V19.6017C15.3853 19.3274 16.9008 17.6369 16.9008 15.5925C16.9008 13.905 15.8541 12.3946 14.2741 11.8021L11.5858 10.7939C10.5912 10.4209 9.93237 9.47013 9.93237 8.40795C9.93237 7.00063 11.0732 5.85976 12.4806 5.85976H13.5374C14.5665 5.85976 15.4008 6.69401 15.4008 7.72311C15.4008 8.13732 15.7366 8.47311 16.1508 8.47311C16.565 8.47311 16.9008 8.13732 16.9008 7.72311C16.9008 5.86558 15.395 4.35976 13.5374 4.35976H13.4164V2.79175Z"
                                            fill=""></path>
                                    </svg>

                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                        Withdrawals
                                    </span>
                                </a>
                            </li>
                            <!-- Menu Item Withdrawals -->

                            <!-- Menu Item Events -->
                            <li>
                                <a href="{{ route('admin.dashboard.events') }}"
                                    @click="selected = (selected === 'Events' ? '':'Events')" class="menu-item group"
                                    :class="(selected === 'Events') && (page === 'events') ? 'menu-item-active' :
                                    'menu-item-inactive'">
                                    <svg class="menu-item-icon-inactive" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        class="menu-item-icon-inactive">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8 2C8.41421 2 8.75 2.33579 8.75 2.75V3.75H15.25V2.75C15.25 2.33579 15.5858 2 16 2C16.4142 2 16.75 2.33579 16.75 2.75V3.75H18.5C19.7426 3.75 20.75 4.75736 20.75 6V9V19C20.75 20.2426 19.7426 21.25 18.5 21.25H5.5C4.25736 21.25 3.25 20.2426 3.25 19V9V6C3.25 4.75736 4.25736 3.75 5.5 3.75H7.25V2.75C7.25 2.33579 7.58579 2 8 2ZM8 5.25H5.5C5.08579 5.25 4.75 5.58579 4.75 6V8.25H19.25V6C19.25 5.58579 18.9142 5.25 18.5 5.25H16H8ZM19.25 9.75H4.75V19C4.75 19.4142 5.08579 19.75 5.5 19.75H18.5C18.9142 19.75 19.25 19.4142 19.25 19V9.75Z"
                                            fill="currentColor"></path>
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                        Events
                                    </span>
                                </a>
                            </li>
                            <!-- Menu Item Events -->

                            <!-- Menu Item Tasks -->
                            <li>
                                <a href="{{ route('admin.dashboard.tasks') }}"
                                    @click="selected = (selected === 'Tasks' ? '':'Tasks')" class="menu-item group"
                                    :class="(selected === 'Tasks') && (page === 'tasks') ? 'menu-item-active' :
                                    'menu-item-inactive'">
                                    <svg class="menu-item-icon-inactive" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        class="menu-item-icon-inactive">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7.75586 5.50098C7.75586 5.08676 8.09165 4.75098 8.50586 4.75098H18.4985C18.9127 4.75098 19.2485 5.08676 19.2485 5.50098L19.2485 15.4956C19.2485 15.9098 18.9127 16.2456 18.4985 16.2456H8.50586C8.09165 16.2456 7.75586 15.9098 7.75586 15.4956V5.50098ZM8.50586 3.25098C7.26322 3.25098 6.25586 4.25834 6.25586 5.50098V6.26318H5.50195C4.25931 6.26318 3.25195 7.27054 3.25195 8.51318V18.4995C3.25195 19.7422 4.25931 20.7495 5.50195 20.7495H15.4883C16.7309 20.7495 17.7383 19.7421 17.7383 18.4995L17.7383 17.7456H18.4985C19.7411 17.7456 20.7485 16.7382 20.7485 15.4956L20.7485 5.50097C20.7485 4.25833 19.7411 3.25098 18.4985 3.25098H8.50586ZM16.2383 17.7456H8.50586C7.26322 17.7456 6.25586 16.7382 6.25586 15.4956V7.76318H5.50195C5.08774 7.76318 4.75195 8.09897 4.75195 8.51318V18.4995C4.75195 18.9137 5.08774 19.2495 5.50195 19.2495H15.4883C15.9025 19.2495 16.2383 18.9137 16.2383 18.4995L16.2383 17.7456Z"
                                            fill="currentColor"></path>
                                    </svg>

                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                        Tasks
                                    </span>
                                </a>
                            </li>
                            <!-- Menu Item Tasks -->

                            <!-- Menu Item Membership Levels -->
                            <li>
                                <a href="{{ route('admin.dashboard.membershiplevels') }}"
                                    @click="selected = (selected === 'MembershipLevels' ? '':'MembershipLevels')" class="menu-item group"
                                    :class="(selected === 'MembershipLevels') && (page === 'membershiplevels') ? 'menu-item-active' :
                                    'menu-item-inactive'">
                                    <svg class="menu-item-icon-inactive" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        class="menu-item-icon-inactive">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12 2.25C12.2841 2.25 12.5451 2.40563 12.6803 2.65538L15.2362 7.36087L20.4854 8.30403C20.7642 8.35411 20.9952 8.5489 21.0858 8.81698C21.1764 9.08506 21.1115 9.38116 20.9171 9.58626L17.2654 13.4393L17.9882 18.7314C18.0265 19.0117 17.9075 19.291 17.6779 19.4577C17.4483 19.6244 17.146 19.6502 16.8911 19.5247L12 17.1199L7.10892 19.5247C6.85399 19.6502 6.55173 19.6244 6.32213 19.4577C6.09253 19.291 5.97351 19.0117 6.0118 18.7314L6.73465 13.4393L3.08291 9.58626C2.88848 9.38116 2.82362 9.08506 2.91421 8.81698C3.00481 8.5489 3.23583 8.35411 3.51458 8.30403L8.76382 7.36087L11.3197 2.65538C11.4549 2.40563 11.7159 2.25 12 2.25Z"
                                            fill="currentColor"></path>
                                    </svg>

                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                        Membership Levels
                                    </span>
                                </a>
                            </li>
                            <!-- Menu Item Membership Levels -->
                        </ul>
                    </div>
                </nav>
                <!-- Sidebar Menu -->
            </div>
        </aside>
        <!-- ===== Sidebar End ===== -->

        {{ $slot }}

    </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @livewireScripts
    {{-- @vite('resources/js/app.js') --}}
</body>

</html>
