<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Ponacare') }} @yield('page_title')</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <meta name="description" content="{{ config('app.name', 'Ponacare') }} | By consult mCornel">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    <link href="{{ asset('css/vendor.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/elephant.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landing-page.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <style>
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body class="spinner spinner-primary spinner-lg">

<div class="masthead">
    <div class="masthead-inner">
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <h3 class="masthead-heading">This system is only for use by PONACARE authorised personel only.</h3>
                            <p class="masthead-lead">Visit our main office at...</p>
                        </div>
                        <div class="col-sm-12 col-sm-offset-0">
                            <img class="masthead-img" src="{{ asset('img/logo_blue_white.png') }}" alt="Ponacare">
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <div class="links">
                                @if (Route::has('login'))

                                    @auth
                                        <a href="{{ url('/home') }}">Home</a>
                                        <a href="{{ route('patients') }}">Patients</a>
                                        <a href="{{ route('noks') }}">Referees</a>
                                        <a href="{{ route('credits') }}">Credits</a>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}">Login</a>
                                    @endauth
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-7">
                <h4 class="footer-heading">Ponacare</h4>
                <p>
                    <small>A paragraph describing ponacare to the visitors of this page. Connect with us on social media.</small>
                </p>
                <div class="social-list">
                    <a class="social-list-item" href="https://twitter.com/o_cornel">
                        <span class="icon icon-twitter"></span>
                    </a>
                    <a class="social-list-item" href="https://facebook.com/oumartinc">
                        <span class="icon icon-facebook"></span>
                    </a>
                    <a class="social-list-item" href="https://www.linkedin.com/in/martincornel">
                        <span class="icon icon-linkedin"></span>
                    </a>
                </div>
            </div>
            <div class="col-sm-12 col-md-5">
                <h4 class="footer-heading">Contact</h4>
                <i class="icon icon-phone"></i> +254724755556 <br>
                <i class="icon icon-mail-reply"></i> <a href="mailto:mrtncornel@gmail.com">mrtncornel@gmail.com</a><br>
                <i class="icon icon-envelope"></i> <a href="https://www.google.com/maps/@-1.3013234,36.753088,140m/data=!3m1!1e3">B15 Jampark Plaza, Ngong Road 6, Nairobi</a><br>
                <i class="icon icon-envelope"></i> 254724755556 - 00100, Nairobi, KENYA<br>
            </div>
        </div>
        <p>2021 &copy; {{ env('APP_NAME', 'Ponacare') }} <a href="{{ env('CREATOR_URL', '') }}">{{ env('CREATOR_NAME', 'Made for you.') }}</a></p>
    </div>
</div>
<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/elephant.min.js') }}"></script>
<script src="{{ asset('js/landing-page.min.js') }}"></script>

</body>
</html>
