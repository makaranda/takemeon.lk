@php
$current_route_name = Route::currentRouteName();
$page_seo = App\Models\Page::where('route_name', $current_route_name)->where('status', 1)->first();
$seo_keywords = '';
$seo_description = '';

if ($page_seo) {
    // If page_seo is found, use its SEO details
    $seo_keywords = ($page_seo->seo_keywords) ? $page_seo->seo_keywords : $settings['seo_keywords'];
    $seo_description = ($page_seo->seo_description) ? $page_seo->seo_description : $settings['seo_description'];
} else {
    // If no page_seo found, use global settings
    $settings = App\Models\Setting::where('status', 1)->first();
    $seo_keywords = isset($settings['seo_keywords']) ? $settings['seo_keywords'] : '';
    $seo_description = isset($settings['seo_description']) ? $settings['seo_description'] : '';
}
@endphp
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index,follow">
    <link rel="icon" type="image/jpg" href="{{ url('public/assets/frontend/img/'.$settings['fevicon_logo']) }}"/>
    <title>{{ $settings['website_title'] }}</title>
    <meta name="description" content="{{ $seo_description }}">
    <meta name="keywords" content="{{ $seo_keywords }}">
    <meta property="og:locale" content="en_US" />
	  <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $settings['website_name'] }} | {{ $settings['website_title'] }}" />
    <meta property="og:url" content="{{ env('APP_URL') }}" />
    <meta property="og:site_name" content="{{ $settings['website_name'] }} | {{ $settings['website_title'] }}" />
    <meta property="article:publisher" content="{{ $settings['social_facebook'] }}" />
    <meta property="article:modified_time" content="{{ time() }}" />
    <meta property="og:image" content="{{ url('public/assets/images/'.$settings['main_logo']) }}" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="{{ $settings['social_twitter'] }}" />
    <meta name="twitter:label1" content="Est. reading time" />
    <meta name="twitter:data1" content="14 minutes" />
    <link rel="canonical" href="{{ env('APP_URL') }}">

        @include('libraries.frontend.styles')
        @stack('css')
        <style>
            .sidebar .nav>.nav-item.active>a p, .nav>.nav-item.active>a p {
                font-weight: 200 !important;
            }
            .header-area {
                top: {{ Auth::check() ? '60px' : '0px' }};
            }
            .bg-dark {
                background-color: #000000 !important;
            }
            .nav-md-block{
              display: block !important;
            }
            .breadcam_bg_2 {
                background: url("{{ url('public/assets/frontend/img/banner/' . $settings['page_banner']) }}") no-repeat center center;
                background-size: cover;
                object-fit: fill;
                background-attachment: fixed;
            }
            .cursor-pointer {
                cursor: pointer;
            }

        </style>
    </head>
  <body class="website-body">
        @include('components.nav')
        <div class="page-content"> 
            @yield('content')
        </div> 
        @include('components.footer')
        @include('others.modals')
        @include('libraries.frontend.scripts')
        @stack('scripts')
  </body>
</html>
