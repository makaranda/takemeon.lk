  <!-- header-start -->
  @if(Auth::check())
    <nav class="navbar navbar-expand-sm navbar-expand-lg bg-dark navbar-dark dashboard-nav" id="admin_navbar">
        <div class="container-fluid">
            <!-- Navbar Toggler for Mobile View -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="row justify-content-center w-100">

                    <ul class="navbar-nav col-md-6">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('admin.dashboard') }}">Dashboard</a>
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
                            <a class="nav-link" href="{{ route('admin.programmes') }}">Programmes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.mainslider') }}">Sliders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.galleryhome') }}">Galleries</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.contacts') }}">Contact</a>
                        </li>
                    </ul>

                    <!-- Right-aligned Dropdown -->
                    <ul class="navbar-nav ms-auto col-md-6 float-right justify-content-right pr-5">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('admin.edituser',Auth::user()->id) }}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.settings') }}">Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#" id="logout_btn">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
@endif


<!-- ===============>> Preloader start here <<================= -->
<div class="preloader">
    <div class="preloader-container">
        <div class="preloader-logo">
            <img loading="lazy" src="{{ url('public/assets/frontend/img/preloader.png') }}" alt="Preloader"/>
        </div>
    </div>
</div>
<!-- ===============>> Preloader end here <<================= -->

<!-- ===============>> Header section start here <<================= -->
<header class="header-section brand-1" id="main_header" style="{{ Auth::check() ? 'top: 57px;' : '' }}">
    <div class="header-top d-none d-sm-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <div class="row justify-content-start">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <div class="footer__links-content">
                                <div class="mobile-575-center">
                                    <ul class="social">
                                        <li class="social__item">
                                            <a href="{{ $settings['social_facebook'] }}"
                                                target="_blank" class="social__link"><i
                                                    class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li class="social__item">
                                            <a href="{{ $settings['social_instagram'] }}"
                                                target="_blank" class="social__link"><i
                                                    class="fab fa-instagram"></i></a>
                                        </li>
                                        <li class="social__item">
                                            <a href="{{ $settings['social_youtube'] }}"
                                                target="_blank" class="social__link"><i
                                                    class="fab fa-youtube"></i></a>
                                        </li>
                                        <li class="social__item">
                                            <a href="{{ $settings['social_linkedin'] }}"
                                                class="social__link" target="_blank"><i
                                                    class="fab fa-linkedin"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="footer_links">
                                <ul class="footer__end-links header-top-contact pb-0 mb-0 pt-0 justify-items-left item-flex-center d-block mt-0 justify-items-start">
                                    <li class="footer__end-item text-center px-1">
                                        <i class="fas fa-envelope"></i> <a href="mailto:">{{ $settings['email_address'] }}</a>
                                    </li>
                                    <li class="footer__end-item text-center px-1">
                                        @php
                                            $num = $settings['contact_number'];
                                            $num2 = $settings['contact_number2'];
                                            $contact_number = '+(' . substr($num, 0, 2) . ') ' . substr($num, 2, 3) . ' ' . substr($num, 5, 3) . ' ' . substr($num, 8);
                                            $contact_number2 = '+(' . substr($num2, 0, 2) . ') ' . substr($num2, 2, 3) . ' ' . substr($num2, 5, 3) . ' ' . substr($num2, 8);
                                        @endphp
                                        <i class="fas fa-phone"></i> <a href="tel:{{ $settings['contact_number'] }}">{{ $contact_number }}</a>
                                        @if ($settings['contact_number2'])
                                            <span class="text-white">|</span> <a href="tel:{{ $settings['contact_number2'] }}">{{ $contact_number2 }}
                                        @endif</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                    <div class="item-flex-end top-bar-menu-items justify-content-end p-0 m-0 align-items-center">
                        <span><a href="#" class="btn btn-link ">Enroll</a></span>
                        <span><a href="#" class="btn btn-link">Pay Online</a></span>
                        <span><a href="#" class="btn btn-link button-red">LMS</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="header-wrapper">
                <div class="header-start header-start--style1">

                    <div class="logo">
                        <a href="{{ route('home.construction') }}">
                            <img loading="lazy" src="{{ url('public/assets/frontend/img/'.$settings['main_logo']) }}" alt="logo"/>
                        </a>
                    </div>

                    <!-- Desktop Menu -->
                    <div class="menu-area cus-ml" id="desktopMenu">
                        <div>
                            <ul class="menu menu--style2 item-flex-end">
                                <li>
                                    <a href="{{ route('home.construction') }}" class="current-menu-item {{ route('home.construction') == request()->url() ? 'active' : 'active' }}">
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="" data-bs-auto-close="outside">
                                        About Us
                                    </a>
                                    <ul class="submenu">
                                        <li><a href="#">Academic Team</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="mega-nav-item nav-item dropdown dropdown-mega position-static">
                                    <a href="{{ route('frontend.programmes') }}" class=""
                                        data-bs-auto-close="outside">
                                        Programmes
                                    </a>
                                    <div class="submenu show dropdown-menu shadow">
                                        <div class="mega-content px-4">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    @php
                                                        $program_categories = \App\Models\ProgramCategory::where('status', 1)->get();
                                                        $program_sub_categories = \App\Models\ProgramSubCategory::where('status', 1)->get();
                                                        $program_sub_category_items = \App\Models\ProgramSubCategoryItem::where('status', 1)->get();
                                                    @endphp

                                                    @if ($program_categories)
                                                        @foreach ($program_categories as $category)
                                                            <div class="col-lg-4 col-md-6 col-sm-12 py-4">
                                                                <a href="{{ route('frontend.programme.category', $category->slug) }}">
                                                                    <h5 class="pb-4">{{ $category->name }}</h5>
                                                                </a>
                                                                <div class="py-2">
                                                                    @foreach ($program_sub_categories as $sub_category)
                                                                        @if ($sub_category['category_id'] == $category['id'])
                                                                            <a href="{{ route('frontend.programme.subcategory', ['slug' => $category->slug, 'sub_slug' => $sub_category['slug']]) }}">
                                                                                <div class="item-flex-start">{{ $sub_category['name'] }}</div>
                                                                            </a>
                                                                            <div class="list-group">
                                                                                @foreach ($program_sub_category_items as $item)
                                                                                    @if ($item['sub_category_id'] == $sub_category['id'])
                                                                                        <a class="list-group-item pt-2 pb-1"
                                                                                            href="{{ route('frontend.programme.programmeitem', ['slug' => $category->slug, 'sub_slug' => $sub_category['slug'], 'sub_sub_slug' => $item['slug']]) }}">
                                                                                            <div class="item-flex-start">{{ $item['name'] }}</div>
                                                                                        </a>
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>

                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>

                                                <div class="row">
                                                    <!-- 1 -->
                                                    <div class="col-lg-4 col-md-6 col-sm-12 py-4">
                                                        <a href="#">
                                                            <h5 class="pb-4">University Programs</h5>
                                                        </a>
                                                        <div class="py-2">
                                                            <a href="javascript:void(0)">
                                                                <div class="item-flex-start"> Avid College - Maldives </div>
                                                            </a>
                                                            <div class="list-group">
                                                                <a class="list-group-item pt-2 pb-1"
                                                                    href="#">
                                                                    <div class="item-flex-start"> Faculty of Psychology </div>
                                                                </a>
                                                                <a class="list-group-item pt-2 pb-1"
                                                                    href="#">
                                                                    <div class="item-flex-start"> Faculty of Education </div>
                                                                </a>
                                                                <a class="list-group-item pt-2 pb-1"
                                                                    href="#">
                                                                    <div class="item-flex-start"> Faculty of Business </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- 2 -->
                                                    <div class="col-lg-4 col-md-6 col-sm-12 py-4">
                                                        <a href="#">
                                                            <h5 class="pb-4">Ofqual - UK Regulated Programs</h5>
                                                        </a>
                                                        <div class="py-2">
                                                            <a
                                                                href="#">
                                                                <div class="item-flex-start">
                                                                    QUALIFI
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <!-- 3 -->
                                                    <div class="col-lg-4 col-md-6 col-sm-12 py-4">
                                                        <a href="#">
                                                            <h5 class="pb-4">Other</h5>
                                                        </a>
                                                        <div class="py-2">
                                                            <a href="#">
                                                                <div class="item-flex-start"> CPD - UK </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="#" class="
                                        ">
                                        Study Abroad
                                    </a>
                                    <ul class="submenu">
                                        <li><a href="#"><b>Transfer
                                                    Pathway</b></a></li>
                                        <li><a class="p-1 ps-4"
                                                href="#">Australia</a></li>
                                        <li><a class="p-1 ps-4" href="#">UK</a></li>
                                        <li><a class="p-1 ps-4 mb-2"
                                                href="#">UAE</a>
                                        </li>
                                        <li><a href="#"><b>Direct
                                                    Placement</b></a></li>
                                        <li><a class="p-1 ps-4"
                                                href="#">Australia</a>
                                        </li>
                                        <li><a class="p-1 ps-4 mb-2"
                                                href="#">UK</a>
                                        </li>
                                        <li><a class="p-1 ps-4 mb-2"
                                                href="#">UAE</a>
                                        </li>
                                    </ul>
                                </li>
                                {{-- <li>
                                    <a href="javascript:void(0)" class="
                                        ">
                                        Pay Online
                                    </a>
                                    <ul class="submenu">
                                        <li><a href="#">International Students</a></li>
                                        <li><a href="#" target="_blank">Local Students</a></li>
                                    </ul>
                                </li> --}}
                                <li>
                                    <a href="javascript:void(0)" class="">
                                        Blogs
                                    </a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('frontend.blogs.article') }}">Blogs & Articles</a></li>
                                        <li><a href="{{ route('frontend.news.events') }}">News & Events</a></li>
                                        <!--<li><a href="https://icbsgroup.lk/events/index">Events</a></li>-->
                                        <!--<li><a href="https://icbsgroup.lk/csr/index">CSR</a></li>-->
                                    </ul>
                                </li>
                                {{-- <li>
                                    <a href="#" class="
                                        ">
                                        Gallery
                                    </a>
                                </li> --}}
                                <li>
                                    <a href="{{ route('frontend.contact') }}" class="
                                        ">
                                        Contact Us
                                    </a>
                                    {{-- <ul class="submenu">
                                        <li><a href="#">Colombo Campus
                                                Undergraduate Division</a></li>
                                        <li><a href="#">Colombo
                                                Campus Postgraduate Division</a></li>
                                        <li><a href="#">Kandy Campus</a></li>
                                    </ul> --}}
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Mobile Menu - below 1200px -->
                    <div class="menu-area cus-ml" id="mobileMenu">
                        <!-- <div> -->
                        <ul class="menu menu-mobile menu--style2 item-flex-center">
                            <li>
                                <a href="{{ route('home.construction') }}" class=" ">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="">
                                    About Us <i class="float-end fa-solid fa-caret-down"></i>
                                </a>
                                <ul class="submenu">
                                    <!-- <li><a href="https://icbsgroup.lk/about">About Imperial College</a></li> -->
                                    <li><a href="#">Academic Team</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="">
                                    Programmes <i class="float-end fa-solid fa-caret-down"></i>
                                </a>
                                <ul class="submenu">
                                    <!-- 1 -->
                                    <li class="">
                                        <a href="#"><strong>Postgraduate
                                                Programmes</strong></a>
                                    </li>
                                    <!-- Uni 1 -->
                                    <li class="ps-3">
                                        <a href="javascript:void(0)">University of West of Scotland, UK</a>
                                    </li>
                                    <li class="ps-4">
                                        <a
                                            href="#">MBA
                                            International Business</a>
                                    </li>
                                    <!-- Uni 2 -->
                                    <li class="ps-3">
                                        <a href="javascript:void(0)">Queen Margaret University, UK</a>
                                    </li>
                                    <li class="ps-4">
                                        <a
                                            href="#">MBA
                                            (General)</a>
                                    </li>
                                    <li class="ps-4">
                                        <a
                                            href="#">MBA
                                            with Human Resource Management</a>
                                    </li>
                                    <li class="ps-4">
                                        <a
                                            href="#">MBA
                                            with Business Analytics</a>
                                    </li>
                                    <li class="ps-4">
                                        <a href="#">MSc.
                                            Strategic Marketing </a>
                                    </li>
                                    <!-- 2 -->
                                    <li class="">
                                        <a href="#"><strong>Undergraduate
                                                Programmes</strong></a>
                                    </li>
                                    <li class="ps-4">
                                        <a href="#">
                                            International Foundation Certificate in Business/IT</a>
                                    </li>

                                    <li class="ps-3">
                                        <a href="#"> International Specialised Diploma</a>
                                    </li>
                                    <li class="ps-4">
                                        <a
                                            href="#">International Specialised Diploma in Marketing Management</a>
                                    </li>
                                    <li class="ps-4">
                                        <a
                                            href="#">International Specialised Diploma in Human Resource Management</a>
                                    </li>
                                    <li class="ps-4">
                                        <a
                                            href="#">International Specialised Diploma in International Business</a>
                                    </li>
                                    <!-- Uni.sss -->
                                    <li class="ps-3">
                                        <a href="javascript:void(0">Top Up Programs</a>
                                    </li>
                                    <!-- Uni 1 -->
                                    <li class="ps-3">
                                        <a href="javascript:void(0)">University of West of Scotland, UK</a>
                                    </li>
                                    <li class="ps-4">
                                        <a href="#">BA Global
                                            Business (Top-Up)</a>
                                    </li>
                                    <li class="ps-4">
                                        <a href="#">BA
                                            (Hons) International Business & Finance</a>
                                    </li>
                                    <!-- Uni 2 -->
                                    <li class="ps-3">
                                        <a href="javascript:void(0)">Queen Margaret University, UK</a>
                                    </li>
                                    <li class="ps-4">
                                        <a
                                            href="#">BSc
                                            (Hons) Business Management with International Business</a>
                                    </li>
                                    <li class="ps-4">
                                        <a href="#">BSc
                                            (Hons) Business Management with Marketing Management</a>
                                    </li>
                                    <li class="ps-4">
                                        <a
                                            href="#">BSc
                                            (Hons) Business Management with Human Resource Management</a>
                                    </li>
                                    <li class="">
                                        <a href="javascript:void(0)"><strong>Professional Programmes</strong></a>
                                    </li>
                                    <li class="ps-4">
                                        <a href="#">CIMA</a>
                                    </li>
                                    <li class="">
                                        <a href="javascript:void(0)"><strong>Transfer Programmes</strong></a>
                                    </li>
                                    <li class="ps-4">
                                        <a href="#">Australian Year
                                            1 Diploma</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="">
                                    Study Abroad <i class="float-end fa-solid fa-caret-down"></i>
                                </a>
                                <ul class="submenu">
                                    <li><a href="#">Transfer Pathway</a></li>
                                    <li class="ps-3">
                                        <a href="#">Australia</a>
                                    </li>
                                    <li class="ps-3">
                                        <a href="#">UK</a>
                                    </li>
                                    <li><a class="p-1 ps-4 mb-2"
                                                href="#">UAE</a>
                                    </li>

                                    <li><a href="#">Direct Placement</a></li>
                                    <li class="ps-3">
                                        <a href="#">Australia</a>
                                    </li>
                                    <li class="ps-3">
                                        <a href="#">UK</a>
                                    </li>
                                    <li><a class="p-1 ps-4 mb-2"
                                                href="#">UAE</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="">
                                    Pay Online <i class="float-end fa-solid fa-caret-down"></i>
                                </a>
                                <ul class="submenu">
                                    <li><a href="#">International Students</a></li>
                                    <li><a href="https://myfees.lk/" target="_blank">Local Students</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="">
                                    Blogs <i class="float-end fa-solid fa-caret-down"></i>
                                </a>
                                <ul class="submenu">
                                    <li><a href="#">Blogs & Articles</a></li>
                                    <li><a href="#">News & Events</a></li>
                                    <!--<li><a href="https://icbsgroup.lk/events/index">Events</a></li>-->
                                    <!--<li><a href="https://icbsgroup.lk/csr/index">CSR</a></li>-->
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="">
                                    Contact Us <i class="float-end fa-solid fa-caret-down"></i>
                                </a>
                                <ul class="submenu">
                                    <li><a href="#">Colombo Undergraduate
                                            Division</a></li>
                                    <li><a href="#">Colombo
                                            Postgraduate Division</a></li>
                                    <li><a href="#">Kandy</a></li>
                                </ul>
                            </li>
                            <li class="li-sp-mobile">
                                <a href="{{ url('public/assets/pdf/imperial_times_catalogue.pdf') }}"
                                target="_blank" class="text-white">
                                    Student Life
                                </a>
                            </li>
                            <li class="li-sp-mobile">
                                <a href="#" target="_blank" class="text-white">
                                    LMS
                                </a>
                            </li>
                            <li class="li-sp-mobile">
                                <a href="#alumni" class="text-white" data-bs-toggle="modal">
                                    Alumni
                                </a>
                            </li>
                            <li class="li-sp-mobile pb-7">
                                <a href="#" class="text-white">
                                    Q&A
                                </a>
                            </li>
                        </ul>
                        <!-- </div> -->
                    </div>
                </div>
                <div class="header-end d-xl-none">
                    <div class="menu-area">
                        <!-- toggle icons -->
                        <div class="header-bar d-xl-none home1">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- ===============>> Header section end here <<================= -->





