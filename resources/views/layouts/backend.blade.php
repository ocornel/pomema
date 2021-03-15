<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Ponacare') }} @yield('page_title')</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    <link href="{{ asset('css/vendor.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/elephant.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/application.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/demo.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

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
<body class="layout layout-header-fixed layout-sidebar-fixed layout-footer-fixed">
<div class="layout-header">
    @include('layouts.topnav')
</div>
<div class="layout-main">
    <div class="layout-sidebar">
        @include('layouts.sidenav')
    </div>
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="row">
                <div class="col-md-12">
                    <div id="search_results" class="hidden search-results"></div>
                </div>
            </div>
            @yield('page_content')
        </div>
    </div>
    <div class="layout-footer ">
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
