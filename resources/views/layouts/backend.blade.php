<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Ponacare') }} @yield('page_title')</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--    <meta name="description" content="Elephant is an admin template that helps you build modern Admin Applications, professionally fast! Built on top of Bootstrap, it includes a large collection of HTML, CSS and JS components that are simple to use and easy to customize.">--}}
    {{--    <meta property="og:url" content="http://demo.madebytilde.com/elephant">--}}
    {{--    <meta property="og:type" content="website">--}}
    {{--    <meta property="og:title" content="The fastest way to build Modern Admin APPS for any platform, browser, or device.">--}}
    {{--    <meta property="og:description" content="Elephant is an admin template that helps you build modern Admin Applications, professionally fast! Built on top of Bootstrap, it includes a large collection of HTML, CSS and JS components that are simple to use and easy to customize.">--}}
    {{--    <meta property="og:image" content="http://demo.madebytilde.com/elephant.jpg">--}}
    {{--    <meta name="twitter:card" content="summary_large_image">--}}
    {{--    <meta name="twitter:site" content="@madebytilde">--}}
    {{--    <meta name="twitter:creator" content="@madebytilde">--}}
    {{--    <meta name="twitter:title" content="The fastest way to build Modern Admin APPS for any platform, browser, or device.">--}}
    {{--    <meta name="twitter:description" content="Elephant is an admin template that helps you build modern Admin Applications, professionally fast! Built on top of Bootstrap, it includes a large collection of HTML, CSS and JS components that are simple to use and easy to customize.">--}}
    {{--    <meta name="twitter:image" content="http://demo.madebytilde.com/elephant.jpg">--}}
    {{--    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">--}}
    {{--    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">--}}
    {{--    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">--}}
    {{--    <link rel="manifest" href="manifest.json">--}}
    {{--    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#27ae60">--}}
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    <link href="{{ asset('css/vendor.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/elephant.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/application.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/demo.min.css') }}" rel="stylesheet">

    <style>
        .card-header {
            font-size: 20px;
        }
        .underline {
            border-bottom: solid #bbb 1px;
        }
    </style>
    @yield('additional_styles')
</head>
<body class="layout layout-header-fixed">
<div class="layout-header">
    @include('layouts.topnav')
</div>
<div class="layout-main">
    <div class="layout-sidebar">
        @include('layouts.sidenav')
    </div>
    <div class="layout-content">
        <div class="layout-content-body">
            @yield('page_content')
        </div>
    </div>
    <div class="layout-footer">
        <div class="layout-footer-body">
            @include('layouts.footer')
        </div>
    </div>
</div>
<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/elephant.min.js') }}"></script>
<script src="{{ asset('js/application.min.js') }}"></script>
<script src="{{ asset('js/demo.min.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
@yield('additional_scripts')

</body>
</html>
