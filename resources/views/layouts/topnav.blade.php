<?php
$auth_user = Auth::user();
?>
<div class="navbar navbar-default">
    <div class="navbar-header">
        <a class="navbar-brand navbar-brand-center" style="padding: 0" href="{{ url('/') }}">
            <img class="navbar-brand-logo" src="{{ asset('img/logo_blue_white.png') }}" alt="Ponacare">
        </a>
        <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#sidenav">
            <span class="sr-only">Toggle navigation</span>
            <span class="bars">
              <span class="bar-line bar-line-1 out"></span>
              <span class="bar-line bar-line-2 out"></span>
              <span class="bar-line bar-line-3 out"></span>
            </span>
            <span class="bars bars-x">
              <span class="bar-line bar-line-4"></span>
              <span class="bar-line bar-line-5"></span>
            </span>
        </button>
        <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="arrow-up"></span>
            <span class="ellipsis ellipsis-vertical">
              <img class="ellipsis-object" width="32" height="32" src="{{ asset('img/no-ppic.png') }}" alt="{{ $auth_user->name }}">
            </span>
        </button>
    </div>
    <div class="navbar-toggleable">
        <nav id="navbar" class="navbar-collapse collapse">
            <button class="sidenav-toggler hidden-xs" title="Collapse sidenav ( [ )" aria-expanded="true" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="bars">
                <span class="bar-line bar-line-1 out"></span>
                <span class="bar-line bar-line-2 out"></span>
                <span class="bar-line bar-line-3 out"></span>
                <span class="bar-line bar-line-4 in"></span>
                <span class="bar-line bar-line-5 in"></span>
                <span class="bar-line bar-line-6 in"></span>
              </span>
            </button>
            <ul class="nav navbar-nav navbar-right">
                <li class="visible-xs-block">
                    <h4 class="navbar-text text-center">Hi, {{ $auth_user->name }}</h4>
                </li>
                <li class="hidden-xs hidden-sm">
                    <form class="navbar-search navbar-search-collapsed">
                        <div class="navbar-search-group">
                            <input class="navbar-search-input" type="text"
                                   onchange="systemSearch(this.value)" name="search_text" id="search_text"
                                   placeholder="Search for patient, next of kin, and credit&hellip;">
                            <button class="navbar-search-toggler" title="Expand search form ( S )" aria-expanded="false" type="submit"
                                    onclick="systemSearch(document.getElementById('search_text').value)">
                                <span class="icon icon-search icon-lg"></span>
                            </button>
{{--                            <button class="navbar-search-adv-btn" type="button">Advanced</button>--}}
                        </div>
                    </form>
                </li>
                <li class="dropdown hidden-xs">
                    <button class="navbar-account-btn" data-toggle="dropdown" aria-haspopup="true">
                        <img class="rounded" width="36" height="36" src="{{ asset('img/no-ppic.png') }}" alt="{{ $auth_user->name }}"> {{ $auth_user->name }}
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li>
                            <a href="mailto:{{env('ADMIN_EMAIL', 'mrtncornel@gmail.com')}}?subject={{ $auth_user->name }} Need Help for {{env('APP_NAME', 'Ponacare')}}">
                                <h5 class="navbar-upgrade-heading">
                                    Need Help?
                                    <small class="navbar-upgrade-notification">Contact the system developer</small>
                                </h5>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li class="navbar-upgrade-version">Version: {{ env('APP_VERSION', '1.0.0') }}</li>
                        <li class="divider"></li>
                        <li><a href="{{ route('show_user', [$auth_user, $auth_user->name]) }}">Profile</a></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a>
                        </li>
                    </ul>
                </li>
                <li class="visible-xs-block">
                    <a href="{{ route('show_user', [$auth_user, $auth_user->name]) }}"><span class="icon icon-user icon-lg icon-fw"></span> Profile</a>
                </li>
                <li class="visible-xs-block">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a>

                </li>
            </ul>
        </nav>
    </div>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">  @csrf</form>

