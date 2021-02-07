<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Ponacare') }} @yield('page_title')</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <meta name="description" content="{{ config('app.name', 'Ponacare') }} | By consult mCornel">
   <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    <link href="{{ asset('css/vendor.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/elephant.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login-3.min.css') }}" rel="stylesheet">
    <style>
        body {
            color: #384243;
            background-color: #2e96b9;
        }
    </style>
</head>
<body>
<div class="login">
    <div class="login-body">
        <a class="login-brand" href="{{ route('landing') }}">
            <img class="img-responsive" src="{{ asset('img/logo_blue_white.png') }}" alt="Ponacare">
        </a>
        <h3 class="login-heading">{{ __('Login') }}</h3>
        <div class="login-form">
            <form data-toggle="md-validator" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="md-form-group md-label-floating">
                    <input id="email" type="email" class="md-form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <label class="md-control-label">{{ __('E-Mail Address') }}
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </label>
                </div>
                <div class="md-form-group md-label-floating">
                    <input id="password" type="password" class="md-form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" data-msg-required="Please enter your password." >
                    <label class="md-control-label">Password @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </label>
                </div>
                <div class="md-form-group md-custom-controls">
                    <label class="custom-control custom-control-primary custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-label">{{ __('Remember Me') }}</span>
                    </label>
                    <br>
                    <span aria-hidden="true"> * Forgot password? <a href="mailto:{{env('ADMIN_EMAIL', 'mrtncornel@gmail.com')}}?subject=Forgot Password for {{env('APP_NAME', 'Ponacare')}}">Seek Admin assistance.</a></span>
                </div>
                <button class="btn btn-primary btn-block" type="submit">Sign in</button>
            </form>
        </div>
    </div>
    <div class="login-footer">
        Don't have an account? <a style="color: #444444; text-decoration: underline" href="mailto:{{env('ADMIN_EMAIL', 'mrtncornel@gmail.com')}}?subject=Need Account on {{env('APP_NAME', 'Ponacare')}}">Seek assistance from a system admin.</a>
    </div>
</div>
<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/elephant.min.js') }}"></script>
</body>
</html>
