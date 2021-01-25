@extends('layouts.backend')

@section('page_content')
    <div class="card">
        <div class="card-header">Users
            <a style="float: right" href="{{ route('create_user') }}">Add User</a>
        </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @component('components.table_users', ['users' => $users, 'actions'=>true])
            @endcomponent
        </div>
    </div>
@endsection
