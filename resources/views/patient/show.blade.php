@extends('layouts.backend')

@section('page_content')
    <div class="card">
        <div class="card-header">{{ $patient->full_name }}
            <a style="float: right" href="{{ route('edit_patient', [$patient, $patient->last_name]) }}">Edit Patient</a></div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <h4 class="underline">Patient details</h4>
            {{$patient}}
                <hr>
                <h4 class="underline">Credits <a style="float: right" href="{{ route('create_credit', [$patient, $patient->last_name]) }}">New Credit Record</a></h4>
                {{$patient->credits}}
                <hr>
            <h4 class="underline">Next of Kins <a style="float: right" href="{{ route('associate_nok', [$patient, $patient->last_name]) }}">Associate NOK</a></h4>
            {{ json_encode($patient->noks) }}
        </div>
    </div>
@endsection
