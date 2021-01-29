@extends('layouts.backend')

@section('page_content')
    <div class="card">
        <div class="card-header">{{ $age_filter }} Patients
            <a style="float: right" href="{{ route('create_patient') }}" class="btn btn-primary">Add Patient</a>
        </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @component('components.table_patients', ['patients' => $patients, 'actions'=>true])
            @endcomponent
        </div>
    </div>
@endsection
