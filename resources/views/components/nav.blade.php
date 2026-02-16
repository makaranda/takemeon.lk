<!-- ================= ADMIN NAVBAR (KEEP AS IT IS) ================= -->
@if(Auth::check())
    @if(Auth::user()->role === 'admin')
        <nav class="navbar navbar-expand-sm navbar-expand-lg bg-dark navbar-dark dashboard-nav" id="admin_navbar">
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="row justify-content-center w-100">

                        <ul class="navbar-nav col-md-6">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.users') }}">Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.pages') }}">Pages</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.blogs') }}">Blogs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.mainslider') }}">Sliders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.contacts') }}">Contact</a>
                            </li>
                        </ul>

                        <ul class="navbar-nav ms-auto col-md-6">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white"
                                   href="#"
                                   data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item"
                                           href="{{ route('admin.edituser', Auth::user()->id) }}">
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                           href="{{ route('admin.settings') }}">
                                            Settings
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item"
                                           href="#"
                                           id="logout_btn">
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </nav>
    @endif
@endif
<!-- ================= END ADMIN NAVBAR ================= -->

    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{ url('public/assets/frontend/img/logo/logo.png') }}" alt=""/>
                </div>
            </div>
        </div>
    </div>

<!-- ================= NEW FRONTEND HEADER ================= -->
<header>
    <div class="header-area header-transparrent">
        <div class="headder-top header-sticky">
            <div class="container">
                <div class="row align-items-center">

                    <!-- Logo -->
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="{{ route('home.index') }}">
                                <img src="{{ url('public/assets/frontend/img/' . $settings['main_logo']) }}"
                                     alt="{{ $settings['website_name'] }}">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-10 col-md-9">
                        <div class="menu-wrapper">

                            <!-- Main Menu -->
                            <div class="main-menu">
                                <nav class="d-none d-lg-block">
                                    <ul id="navigation">

                                        <li class="{{ request()->routeIs('home.index') ? 'active' : '' }}">
                                            <a href="{{ route('home.index') }}">Home</a>
                                        </li>

                                        <li class="{{ request()->routeIs('frontend.home.products') ? 'active' : '' }}">
                                            <a href="{{ route('frontend.home.products') }}">Find a Jobs</a>
                                        </li>

                                        <li>
                                            <a href="#">Need a Training</a>
                                        </li>

                                        <li class="{{ request()->routeIs('frontend.about') ? 'active' : '' }}">
                                            <a href="{{ route('frontend.about') }}">About</a>
                                        </li>

                                        <li class="{{ request()->routeIs('frontend.home.blogs') ? 'active' : '' }}">
                                            <a href="{{ route('frontend.home.blogs') }}">Blogs</a>
                                        </li>

                                        <li class="{{ request()->routeIs('frontend.contact') ? 'active' : '' }}">
                                            <a href="{{ route('frontend.contact') }}">Contact</a>
                                        </li>

                                    </ul>
                                </nav>
                            </div>

                            <!-- Header Buttons -->
                            <div class="header-btn d-none f-right d-lg-block">

                                @auth
                                    @if(Auth::user()->role === 'customer')
                                        <a href="{{ route('customer.dashboard') }}"
                                           class="btn head-btn1">
                                            {{ Auth::user()->name }}
                                        </a>

                                        <a href="#"
                                           id="customer_logout_btn"
                                           class="btn head-btn2">
                                            Logout
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('frontend.userregister') }}"
                                       class="btn head-btn1">
                                        Register
                                    </a>

                                    <a href="{{ route('frontend.userlogin') }}"
                                       class="btn head-btn2">
                                        Login
                                    </a>
                                @endauth

                            </div>

                        </div>
                    </div>

                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</header>
<main>
