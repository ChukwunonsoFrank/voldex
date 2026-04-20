<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <title>Voldex</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @livewireStyles
    @vite('resources/css/app.css')

    <style>
        [x-cloak] {
            display: none !important;
        }

        a.gt_switcher-popup span {
            display: none;
        }
    </style>
</head>

<body>

    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#sidebarPanel">
                <ion-icon name="menu-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            <img src="{{ asset('assets/img/logo.png') }}" alt="logo" class="logo">
        </div>
        <div class="right">
            <a class="headerButton">
                <div class="gtranslate_wrapper"></div>
            </a>
            <a href="{{ route('dashboard.alert') }}" class="headerButton">
                <ion-icon class="icon" name="notifications-outline"></ion-icon>
                {{-- <span class="badge badge-danger">4</span> --}}
            </a>
            <a href="{{ route('dashboard.contact') }}" class="headerButton">
                <ion-icon name="chatbox-ellipses-outline"></ion-icon>
            </a>
        </div>
    </div>
    <!-- * App Header -->

    {{ $slot }}

    <!-- App Bottom Menu -->
    <div class="appBottomMenu">
        <a href="{{ route('dashboard') }}" class="item">
            <div class="col">
                <ion-icon name="home"></ion-icon>
                <strong>Home</strong>
            </div>
        </a>
        <a href="{{ route('dashboard.start') }}" class="item">
            <div class="col">
                <ion-icon name="cart"></ion-icon>
                <strong>Start</strong>
            </div>
        </a>
        <a href="{{ route('dashboard.record') }}" class="item">
            <div class="col">
                <ion-icon name="receipt"></ion-icon>
                <strong>Record</strong>
            </div>
        </a>
        <a href="{{ route('dashboard.account') }}" class="item">
            <div class="col">
                <ion-icon name="person-circle"></ion-icon>
                <strong>Profile</strong>
            </div>
        </a>
    </div>
    <!-- * App Bottom Menu -->

    <!-- App Sidebar -->
    <div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <!-- others -->
                    <div class="listview-title mt-1">Menu</div>
                    <ul class="listview flush transparent no-line image-listview">
                        <li>
                            <a href="{{ route('dashboard') }}" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="home"></ion-icon>
                                </div>
                                <div class="in">
                                    Home
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.start') }}" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="cart"></ion-icon>
                                </div>
                                <div class="in">
                                    Start
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.record') }}" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="receipt"></ion-icon>
                                </div>
                                <div class="in">
                                    Record
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.account') }}" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="person-circle"></ion-icon>
                                </div>
                                <div class="in">
                                    Profile
                                </div>
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="item"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="log-out-outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        Log out
                                    </div>
                                </a>
                            </form>
                        </li>


                    </ul>
                    <!-- * others -->
                </div>
            </div>
        </div>
    </div>
    <!-- * App Sidebar -->

    <script>
        window.gtranslateSettings = {
            "default_language": "en",
            "detect_browser_language": true,
            "wrapper_selector": ".gtranslate_wrapper",
            "flag_size": 24,
            "flag_style": "3d"
        }
    </script>
    <script src="https://cdn.gtranslate.net/widgets/latest/popup.js" defer></script>
    <script>
        // Wait for the DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Select all elements with class 'gt_switcher-popup'
            document.querySelectorAll('.gt_switcher-popup').forEach(function(el) {
                // Find all span children and hide them
                el.querySelectorAll('span').forEach(function(span) {
                    span.style.display = 'none';
                });
            });
        });
    </script>

    <!-- ========= JS Files =========  -->
    <!-- Toastify -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/js/lib/bootstrap.bundle.min.js') }}"></script>
    <!-- Ionicons -->
    <script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@7/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/npm/ionicons@7/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="{{ asset('assets/js/plugins/splide/splide.min.js') }}"></script>
    <!-- Base Js File -->
    <script src="{{ asset('assets/js/base.js') }}"></script>

    @livewireScripts
</body>

</html>
