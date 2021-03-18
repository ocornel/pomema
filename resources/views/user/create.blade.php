@extends('layouts.backend')

@section('page_content')
    <div class="card">
        <div class="card-header">@isset($user)Update {{$user->name}} @else Create new
            User @endisset</div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="post"
                  action="@isset($user){{ route('update_user', $user) }}@else{{ route('store_user') }}@endisset">
                @csrf
                <input type="text" name="created_by"
                       @isset($user) value="{{ $user->created_by }}" @else value="{{ Auth::user()->id }}"
                       @endisset hidden>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name" class="control-label">Full Name</label>
                            <input type="text" class="form-control" id="name" required
                                   name="name"
                                   @isset($user)
                                   value="{{ $user->name }}"
                                @endisset>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email" class="control-label">Email</label>
                            <input type="email" class="form-control" id="email" required
                                   name="email"
                                   @isset($user)
                                   value="{{ $user->email }}"
                                @endisset>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="description" class="control-label">Password</label>
                            <input type="password" class="form-control" id="password" required
                                   name="password"
                                   >
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button onclick="goBack()"  class="btn btn-outline-warning" >Cancel</button>
                        <button type="submit" class="btn btn-outline-success pull-right">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
