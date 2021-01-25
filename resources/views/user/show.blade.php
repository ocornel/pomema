@extends('layouts.backend')

@section('page_content')
    <div class="card">
        <div class="card-header">{{ $user->name }}
            <a style="float: right" href="{{ route('edit_user', [$user, $user->name]) }}">Edit User</a></div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <h4 class="underline">User details</h4>
                {{$user}}
                <hr>
                <h4 class="underline">Records by user</h4>
            {!! json_encode($user->creations)  !!}
        </div>
    </div>
@endsection
