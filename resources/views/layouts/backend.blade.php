@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <ul>
                    <li><a href="{{ route('home') }}">Dashboard</a></li>
                    <li><a href="{{ route('patients') }}">Patients</a></li>
                    <li><a href="{{ route('credits') }}">Credits</a></li>
                    <li><a href="{{ route('noks') }}">Next of Kins</a></li>
                    <li><a href="{{ route('users') }}">Users</a></li>
                </ul>
            </div>
            <div class="col-md-10">
                @yield('page_content')
            </div>
        </div>
    </div>
@endsection
