<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="html-theme">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/reboot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/logo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/color.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alert.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/button.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chart.css') }}">
    <link rel="stylesheet" href="{{ asset('css/container.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/messages.css') }}">
    <link rel="stylesheet" href="{{ asset('css/miscellaneous.css') }}">
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen" id="theme-container">
        <!-- Sidebar and Main Content Wrapper -->
        <div id="content-wrapper" class="flex">
            <!-- Sidebar -->
            <aside id="sidebar" class="fixed top-0 left-0 w-64 text-white h-full transform transition-margin duration-300 z-10 -translate-x-full">
                <nav class="p-2">
                    <!-- Button to toggle sidebar -->
                    <button id="sidebar-toggle-app">
                        <i class="fa-solid fa-bars"></i>
                    </button>

                    <ul class="nav-list">
                        <li>
                            <a href="#home" class="sidebar-list block py-2 px-4">
                                <div class="initial-content">
                                    <i class="fa-solid fa-house px-1"></i>
                                    Home
                                </div>
                            </a>
                        </li>

                        <li class="py-2 px-4">
                            <p style="color: rgb(255, 255, 255, 0.5) !important;">CRUD operations</p>
                        </li>
                        <!-- Jobs Dropdown -->
                        <li class="dropdown py-2 px-2">
                            <div class="initial-content">
                                <div class="dropdown-toggle d-flex align-items-center justify-content-between">
                                    <div class="left-side-content"><i class="fa-solid fa-briefcase px-1"></i>
                                        <span>Jobs</span>
                                    </div>
                                    <i class="fa-solid fa-angle-down rotate-icon"></i>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="jobsDropdown">
                                    <a href="#jobs" class="block py-2 px-4">Jobs</a>
                                    <a href="{{ route('jobs.create') }}" class="block py-2 px-4">Jobs Create</a>
                                </div>
                            </div>
                        </li>

                        <!-- Members Dropdown -->
                        <li class="dropdown py-2 px-2">
                            <div class="initial-content">
                                <div class="dropdown-toggle d-flex align-items-center justify-content-between">
                                    <div class="left-side-content">
                                        <i class="fa-solid fa-users px-1"></i>
                                        <span>Members</span>
                                    </div>
                                    <i class="fa-solid fa-angle-down rotate-icon"></i>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="membersDropdown">
                                    <a href="#members" class="block py-2 px-4">Members</a>
                                    <a href="{{ route('members.create') }}" class="block py-2 px-4">Members Create</a>
                                </div>
                            </div>
                        </li>

                        <!-- Partners Dropdown -->
                        <li class="dropdown py-2 px-2">
                            <div class="initial-content">
                                <div class="dropdown-toggle d-flex align-items-center justify-content-between">
                                    <div class="left-side-content">
                                        <i class="fa-regular fa-handshake px-1"></i>
                                        <span>Partners</span>
                                    </div>
                                    <i class="fa-solid fa-angle-down rotate-icon"></i>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="partnersDropdown">
                                    <a href="#partners" class="block py-2 px-4">Partners</a>
                                    <a href="{{ route('partners.create') }}" class="block py-2 px-4">Partners Create</a>
                                </div>
                            </div>
                        </li>

                        <!-- Testimonials Dropdown -->
                        <li class="dropdown py-2 px-2">
                            <div class="initial-content">
                                <div class="dropdown-toggle d-flex align-items-center justify-content-between">
                                    <div class="left-side-content">
                                        <i class="fa-solid fa-envelope-open-text px-1"></i>
                                        <span>Testimonials</span>
                                    </div>
                                    <i class="fa-solid fa-angle-down rotate-icon"></i>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="testimonialsDropdown">
                                    <a href="#testimonials" class="block py-2 px-4">Testimonials</a>
                                    <a href="{{ route('testimonials.create') }}" class="block py-2 px-4">Testimonials Create</a>
                                </div>
                            </div>
                        </li>

                        <!-- Industries Dropdown -->
                        <li class="dropdown py-2 px-2">
                            <div class="initial-content">
                                <div class="dropdown-toggle d-flex align-items-center justify-content-between">
                                    <div class="left-side-content">
                                        <i class="fa-solid fa-industry px-1"></i>
                                        <span>Industries</span>
                                    </div>
                                    <i class="fa-solid fa-angle-down rotate-icon"></i>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="industriesDropdown">
                                    <a href="#industries" class="block py-2 px-4">Industries</a>
                                    <a href="{{ route('industries.create') }}" class="block py-2 px-4">Industries Create</a>
                                </div>
                            </div>
                        </li>

                        <!-- Services Dropdown -->
                        <li class="dropdown py-2 px-2">
                            <div class="initial-content">
                                <div class="dropdown-toggle d-flex align-items-center justify-content-between">
                                    <div class="left-side-content">
                                        <i class="fa-solid fa-gears px-1"></i>
                                        <span>Services</span>
                                    </div>
                                    <i class="fa-solid fa-angle-down rotate-icon"></i>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                                    <a href="#services" class="block py-2 px-4">Services</a>
                                    <a href="{{ route('services.create') }}" class="block py-2 px-4">Services Create</a>
                                </div>
                            </div>
                        </li>

                        <!-- Service Categories -->

                        <li>
                            <a href="#serviceCategories" class="sidebar-list block py-2 px-4">
                                <div class="initial-content">
                                    <i class="fa-solid fa-gear px-1"></i>
                                    Service Categories
                                </div>
                            </a>
                        </li>
                    </ul>
                </nav>
            </aside>

            <!-- Main Content -->
            <div id="main-content" class="ml-0 transition-margin duration-300 w-full">
                @include('layouts.navigation')

                <!-- Page Heading -->
                @isset($header)
                <header class="shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
                @endisset

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('js/sidebarNavigation.js') }}"></script>
    <script src="{{ asset('js/toggle.js') }}"></script>
</body>

</html>