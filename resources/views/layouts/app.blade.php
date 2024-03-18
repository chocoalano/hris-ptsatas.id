<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keyword')">
    <meta name="author" content="Createx Studio">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />

    <!-- Viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon and Touch Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('compro/assets/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('compro/assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('compro/assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('compro/assets/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('compro/assets/favicon/safari-pinned-tab.svg') }}" color="#6366f1">
    <link rel="shortcut icon" href="{{ asset('compro/assets/favicon/favicon.ico') }}">
    <meta name="msapplication-TileColor" content="#080032">
    <meta name="msapplication-config" content="{{ asset('compro/assets/favicon/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Vendor Styles -->
    <link rel="stylesheet" media="screen" href="{{ asset('compro/assets/vendor/boxicons/css/boxicons.min.css') }}"/>
    <link rel="stylesheet" media="screen" href="{{ asset('compro/assets/vendor/swiper/swiper-bundle.min.css') }}"/>
    <link rel="stylesheet" media="screen" href="{{ asset('compro/assets/vendor/img-comparison-slider/dist/styles.css') }}"/>

    <!-- Main Theme Styles + Bootstrap -->
    <link rel="stylesheet" media="screen" href="{{ asset('compro/assets/css/theme.min.css') }}"/>

    <!-- Page loading styles -->
    <link rel="stylesheet" href="{{ asset('compro.css') }}">
    <script src="{{ asset('compro.js') }}"></script>
  </head>
  <body>
    <noscript>
        <iframe src="http://www.googletagmanager.com/ns.html?id=GTM-WKV3GT5" height="0" width="0"
            style="display: none; visibility: hidden;"></iframe>
    </noscript>
    <!-- Page loading spinner -->
    <div class="page-loading active">
        <div class="page-loading-inner">
            <div class="page-spinner"></div><span>Loading...</span>
        </div>
    </div>
    <main class="page-wrapper">
        @include('layouts.header')
        @yield('content')
    </main>
    @include('layouts.footer')

    {{-- page loaded javascript::start --}}
    <script src="{{ asset('compro/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('compro/assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
    <script src="{{ asset('compro/assets/vendor/vanilla-tilt/dist/vanilla-tilt.min.js') }}"></script>
    <script src="{{ asset('compro/assets/vendor/rellax/rellax.min.js') }}"></script>
    <script src="{{ asset('compro/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('compro/assets/vendor/img-comparison-slider/dist/index.js') }}"></script>
    <script src="{{ asset('compro/assets/js/theme.min.js') }}"></script>
    {{-- page loaded javascript::end --}}
  </body>