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

            <h4 class="underline">Next of Kin details</h4>
{{--            {{$nok}}--}}
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6 font-weight-bold">ID Number:</div>
                            <div class="col-md-6">{{ $nok->id_number }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6 font-weight-bold">Date of Birth:</div>
                            <div class="col-md-6"> {{ \Carbon\Carbon::parse($nok->dob)->format('Y M d') }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6 font-weight-bold">Age:</div>
                            <div class="col-md-6">{{ $nok->age }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6 font-weight-bold">Residence:</div>
                            <div class="col-md-6">{{ $nok->residence }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6 font-weight-bold">Place of Work:</div>
                            <div class="col-md-6">{{ $nok->work_place }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6 font-weight-bold">Phone Number:</div>
                            <div class="col-md-6">{{ $nok->phone }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6 font-weight-bold">Reg. Date:</div>
                            <div class="col-md-6"> {{ \Carbon\Carbon::parse($nok->created_at)->format('Y M d') }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6 font-weight-bold">Registered By:</div>
                            <div class="col-md-6"><a href="{{ route('show_user', $nok->creator) }}">{{ $nok->creator->name }}</a></div>
                        </div>
                    </div>
                </div>
                <hr>
            <h4 class="underline">Associated Patients (Total Credit Due: {{number_format($nok->credit_due,2)}})<a style="float: right" href="{{ route('associate_patient', [$nok, $nok->last_name]) }}">Associate Patient</a></h4>

                @component('components.table_patients', ['patients' => $nok->patients, 'extractions'=>true])
                @endcomponent        </div>
    </div>
@endsection