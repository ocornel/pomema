@extends('layouts.backend')

@section('page_content')
    @if(Auth::user()->id == \App\Utils::SUPER_ADMIN_ID)
        <div class="card">
            <div class="card-header">Users
                <a style="float: right" href="{{ route('create_user') }}" class="btn btn-primary">Add User</a>
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
    @else
        <h3>This page is only visible to the super admin.</h3>
    @endif
@endsection
