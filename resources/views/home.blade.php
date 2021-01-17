@extends('layouts.backend')

@section('page_content')
    <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            You are logged in!
                <br>
            Graphs and charts coming here
        </div>
    </div>
@endsection
