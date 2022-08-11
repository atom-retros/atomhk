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

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body id="page-top">
<div id="wrapper">
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
        <div class="container-fluid d-flex flex-column p-0">
            <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="{{ route('dashboard') }}">
                <img class="w-75 drop-shadow" src="{{ asset('assets/images/kasja_atom_logo.png') }}" alt="Atom logo">
            </a>
            <hr class="sidebar-divider my-0">
            <ul class="nav navbar-nav text-light" id="accordionSidebar">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                        <i  class="fas fa-user"></i>
                        <span>User Management</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="dropdown-toggle nav-link {{ request()->routeIs('articles.*') ? 'active' : '' }}" data-toggle="dropdown" aria-expanded="false" href="javascript:void(0)">
                        <i class="fa fa-newspaper-o"></i>
                        Article Management
                    </a>

                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" role="presentation" href="{{ route('articles.index') }}">
                            View All
                        </a>
                        <hr>

                        <a class="dropdown-item" role="presentation" href="post-article.html">
                            Post Article
                        </a>
                    </div>
                </li>
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

                    <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input class="bg-light form-control border-0 small" type="text"  placeholder="Search for a username">

                            <div class="input-group-append">
                                <button class="btn btn-primary py-0" type="button">
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
                                    <img class="mt-4" src="https://imager.habstar.net/?figure={{ auth()->user()->look }}&direction=2&headonly=1&head_direction=2&gesture=sml" alt="Profile pic" />
                                </a>

                                <div  class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu">
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

            <main class="container-fluid">
                {{ $slot }}
            </main>
        </div>

        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright">
                    <span>&copy {{ setting('hotel_name') }} - Made with</span>

                    <svg xmlns="http://www.w3.org/2000/svg" style="height: 15px; width: 15px; color: red;"" viewBox="0 0 20 20" fill="currentColor">
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

@stack('javascript'))
</body>
</html>
