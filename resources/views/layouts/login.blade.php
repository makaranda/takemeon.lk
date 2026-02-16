<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex,nofollow">
    <link rel="icon" type="image/jpeg" href="{{ url('public/assets/images/'.$settings['fevicon_logo']) }}"/>
    <title>{{ $settings['website_title'] }} | Login Form</title>
        @include('libraries.login.styles')
        @stack('css')
    </head>
  <body>

        @yield('content')

        @include('libraries.login.scripts')
        @stack('scripts')
  </body>
</html>
