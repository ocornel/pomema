@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                @include('layouts.sidenav')
            </div>
            <div class="col-md-10">
                @yield('page_content')
            </div>
        </div>
    </div>
@endsection
