@extends('layouts.backend')

@section('page_content')
    <div class="card">
        <div class="card-header">{{ $credit->code }}</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            credit details
            <br>
            {{$credit}}
        </div>
    </div>
@endsection
