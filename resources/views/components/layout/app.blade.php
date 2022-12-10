<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ setting('hotel_name') }} - @stack('title')</title>

    <link rel="icon" type="image/gif" sizes="18x17" href="{{ asset('assets/images/home_icon.gif') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome5-overrides.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/tinymce.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/untitled.css') }}">
    <script src="https://cdn.tiny.cloud/1/[APIKEYHERE]/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body id="page-top">
<div id="wrapper">
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
        <div class="container-fluid d-flex flex-column p-0">
            <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="{{ route('dashboard') }}">
                <img class="w-75 drop-shadow" src="{{ setting('hk_logo') }}" alt="Atom logo">
            </a>
            <hr class="sidebar-divider my-0">
            <ul class="nav navbar-nav text-light" id="accordionSidebar">
                <x-navigation.navigation-item :classes="request()->routeIs('dashboard') ? 'active' : ''">
                    <a href="{{ route('dashboard') }}">
                        <x-icons.home-icon />
                        <span>Dashboard</span>
                    </a>
                </x-navigation.navigation-item>

                <x-navigation.navigation-section>
                    <x-slot:header>
                        Hotel
                    </x-slot:header>

                    @if(hasPermission('edit_user'))
                        <x-navigation.navigation-item :classes="request()->routeIs('users.*') ? 'active' : ''">
                            <a href="{{ route('users.index') }}">
                                <x-icons.users-icon />
                                <span>User Management</span>
                            </a>
                        </x-navigation.navigation-item>
                    @endif

                    @if(hasPermission('manage_wordfilter'))
                        <x-navigation.navigation-item :classes="request()->routeIs('wordfilter.*') ? 'active' : ''">
                            <a href="{{ route('wordfilter.index') }}">
                                <x-icons.wordfilter-icon />
                                <span>Wordfilter Management</span>
                            </a>
                        </x-navigation.navigation-item>
                    @endif

                    @if(hasPermission('manage_bans'))
                        <x-navigation.navigation-item :classes="request()->routeIs('bans.*') ? 'active' : ''">
                            <a href="{{ route('bans.index') }}">
                                <x-icons.denied-icon />
                                <span>Ban Management</span>
                            </a>
                        </x-navigation.navigation-item>
                    @endif

                    @if(hasPermission('manage_staff_applications'))
                        <x-navigation.navigation-item :classes="request()->routeIs('staff-applications.*') ? 'active' : ''">
                            <a href="{{ route('staff-applications.index') }}">
                                <x-icons.document-icon />
                                <span>Staff Applications</span>
                            </a>
                        </x-navigation.navigation-item>
                    @endif

                    @if(hasPermission('manage_private_chatlogs') || hasPermission('manage_room_chatlogs'))
                        <x-navigation.dropdown-menu :classes="request()->routeIs('articles.*') ? 'active' : ''">
                            <x-slot:parent>
                                <x-icons.chat-icon />
                                <span>Chatlogs</span>
                            </x-slot:parent>

                            @if(hasPermission('manage_room_chatlogs'))
                                <x-navigation.dropdown-child>
                                    <a href="{{ route('chatlogs.room') }}">
                                        Room chatlogs
                                    </a>
                                </x-navigation.dropdown-child>
                            @endif

                            @if(hasPermission('manage_private_chatlogs') )
                                <x-navigation.dropdown-child>
                                    <a href="{{ route('chatlogs.private') }}">
                                        Private chatlogs
                                    </a>
                                </x-navigation.dropdown-child>
                            @endif
                        </x-navigation.dropdown-menu>

                    @endif
                </x-navigation.navigation-section>

                @if(hasPermission('manage_website_settings') || hasPermission('manage_website_whitelists') || hasPermission('manage_website_blacklists') || hasPermission('write_article'))
                    <x-navigation.navigation-section>
                        <x-slot:header>
                            CMS
                        </x-slot:header>

                        @if(hasPermission('manage_website_settings'))
                            <x-navigation.navigation-item :classes="request()->routeIs('website-settings.*') ? 'active' : ''">
                                <a href="{{ route('website-settings.index') }}">
                                    <x-icons.settings-icon/>
                                    <span>{{ __('Website Settings') }}</span>
                                </a>
                            </x-navigation.navigation-item>
                        @endif

                        @if(hasPermission('manage_website_whitelists'))
                            <x-navigation.navigation-item :classes="request()->routeIs('website-whitelist.*') ? 'active' : ''">
                                <a href="{{ route('website-whitelist.index') }}">
                                    <x-icons.fingerprint-icon />
                                    <span>{{ __('Website IP whitelist') }}</span>
                                </a>
                            </x-navigation.navigation-item>
                        @endif

                        @if(hasPermission('manage_website_blacklists'))
                            <x-navigation.navigation-item :classes="request()->routeIs('website-blacklist.*') ? 'active' : ''">
                                <a href="{{ route('website-blacklist.index') }}">
                                    <x-icons.denied-icon />
                                    <span>{{ __('Website IP blacklist') }}</span>
                                </a>
                            </x-navigation.navigation-item>
                        @endif

                       @if(hasPermission('write_article'))
                            <x-navigation.dropdown-menu :classes="request()->routeIs('articles.*') ? 'active' : ''">
                                <x-slot:parent>
                                    <x-icons.article-icon />
                                    <span>Article management</span>
                                </x-slot:parent>

                                <x-navigation.dropdown-child>
                                    <a href="{{ route('articles.index') }}">
                                        All Articles
                                    </a>
                                </x-navigation.dropdown-child>

                                <x-navigation.dropdown-child>
                                    <a href="{{ route('articles.create') }}">
                                        Create Article
                                    </a>
                                </x-navigation.dropdown-child>
                            </x-navigation.dropdown-menu>
                       @endif
                    </x-navigation.navigation-section>
                @endif

                @if(hasPermission('manage_catalog_pages'))
                    <x-navigation.navigation-section>
                        <x-slot:header>
                            Catalog
                        </x-slot:header>

                        <x-navigation.navigation-item :classes="request()->routeIs('catalog.*') ? 'active' : ''">
                            <a href="{{ route('catalog-pages.index') }}">
                                <x-icons.table-icon />
                                <span>Catalog pages</span>
                            </a>
                        </x-navigation.navigation-item>
                    </x-navigation.navigation-section>
                @endif

                @if(hasPermission('manage_emulator_settings') || hasPermission('manage_emulator_texts'))
                    <x-navigation.navigation-section>
                        <x-slot:header>
                            Emulator
                        </x-slot:header>

                        @if(hasPermission('manage_emulator_settings'))
                            <x-navigation.navigation-item :classes="request()->routeIs('emulator-settings.*') ? 'active' : ''">
                                <a href="{{ route('emulator-settings.index') }}">
                                    <x-icons.settings-icon/>
                                    <span>Emulator Settings</span>
                                </a>
                            </x-navigation.navigation-item>
                        @endif

                        @if(hasPermission('manage_emulator_texts'))
                            <x-navigation.navigation-item :classes="request()->routeIs('emulator-texts.*') ? 'active' : ''">
                                <a href="{{ route('emulator-texts.index') }}">
                                    <x-icons.text-icon />
                                    <span>Emulator Text</span>
                                </a>
                            </x-navigation.navigation-item>
                        @endif
                    </x-navigation.navigation-section>
                @endif

                @if(hasPermission('view_activity_logs'))
                    <x-navigation.navigation-section>
                        <x-slot:header>
                            Miscellaneous
                        </x-slot:header>

                        <x-navigation.navigation-item :classes="request()->routeIs('miscellaneous.*') ? 'active' : ''">
                            <a href="{{ route('activity-logs.index') }}">
                                <x-icons.text-icon />
                                <span>Activity Logs</span>
                            </a>
                        </x-navigation.navigation-item>
                    </x-navigation.navigation-section>
                @endif
            </ul>
        </div>
    </nav>

    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                <div class="container-fluid">
                    <button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button">
                        <i class="fas fa-bars"></i>
                    </button>

                    <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="GET" action="{{ route('users.search') }}">
                        <div class="input-group">
                            <input class="bg-light form-control border-0 small" type="text" name="username" placeholder="Search for a username">

                            <div class="input-group-append">
                                <button class="btn btn-primary py-0" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <ul class="nav navbar-nav flex-nowrap ml-auto">
                        <li class="nav-item dropdown d-sm-none no-arrow">
                            <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">
                                <i class="fas fa-search"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" role="menu" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto navbar-search w-100">
                                    <div class="input-group">
                                        <input class="bg-light form-control border-0 small" type="text" placeholder="Search for a username">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary py-0" type="button">
                                                <i  class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <li class="nav-item dropdown no-arrow" role="presentation">
                            <div class="nav-item dropdown no-arrow">
                                <a class="dropdown-toggle nav-link"
                                   data-toggle="dropdown" aria-expanded="false"
                                   href="#">
                                    <span class="d-none d-lg-inline mr-2 text-gray-600 small">
                                        {{ auth()->user()->username }}
                                    </span>
                                    <img class="mt-4" src="{{ setting('avatar_imager') }}{{ auth()->user()->look }}&direction=2&headonly=1&head_direction=2&gesture=sml" alt="Profile pic" />
                                </a>

                                <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu">
                                    <a class="dropdown-item" role="presentation" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="container-fluid mb-4">
                {{ $slot }}
            </main>
        </div>

        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright">
                    <span>&copy {{ setting('hotel_name') }} - Made with</span>

                    <svg xmlns="http://www.w3.org/2000/svg" style="height: 15px; width: 15px; color: red;" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                    </svg>

                    By <a href="https://devbest.com/members/object.78351/" target="_blank">Object</a>
                </div>
            </div>
        </footer>
    </div>

    <a class="border rounded d-inline scroll-to-top" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
</div>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="{{ asset('assets/js/theme.js') }}"></script>
<script src="{{ asset('assets/js/tinymce.js') }}"></script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>


@stack('javascript')
</body>
</html>
