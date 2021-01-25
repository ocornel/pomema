@extends('layouts.backend')

@section('page_content')
    <div class="card">
        <div class="card-header">{{ $nok->full_name }}</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            Next of Kin details
            <br>
            {{$nok}}
        </div>
    </div>
@endsection
