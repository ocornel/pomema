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
            <h4 class="underline"><b>User details</b></h4>
{{--                {{$user}}--}}
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6 font-weight-bold">Email:</div>
                            <div class="col-md-6">{{ $user->email }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6 font-weight-bold">Created:</div>
                            <div class="col-md-6"> {{ \Carbon\Carbon::parse($user->created_at)->format('Y M d') }}</div>
                        </div>
                    </div>
                </div>
                <hr>
                <h4 class="underline"><b>Records Created By User</b></h4>
{{--            {!! json_encode($user->creations)  !!}--}}

                <p><b>Patients</b></p>
                @component('components.table_patients', ['patients' => $user->creations['patients']])
                @endcomponent
                <hr>
                <p><b>Next Of Kins</b></p>
                @component('components.table_noks', ['noks' => $user->creations['noks']])
                @endcomponent
                <hr>
                <p><b>Credits</b></p>
                @component('components.table_credits', ['credits' => $user->creations['credits']])
                @endcomponent
        </div>
    </div>
@endsection
