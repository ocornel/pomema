@extends('layouts.backend')

@section('page_content')
    <div class="card">
        <div class="card-header">{{$status_filter}} Credits</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @component('components.table_credits', ['credits' => $credits, 'actions'=>true])
            @endcomponent
        </div>
    </div>
@endsection
