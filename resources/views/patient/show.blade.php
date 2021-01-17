@extends('layouts.backend')

@section('page_content')
    <div class="card">
        <div class="card-header">{{ $patient->full_name }}
            <a style="float: right" href="{{ route('edit_patient', [$patient, $patient->last_name]) }}">Edit Patient</a>
        </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <h4 class="underline"><b>Patient details</b></h4>
{{--            {{$patient}}--}}
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-6 font-weight-bold">PC Number:</div>
                        <div class="col-md-6">{{ $patient->pc_number }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-6 font-weight-bold">Sex:</div>
                        <div class="col-md-6">{{ $patient->gender }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-6 font-weight-bold">Date of Birth:</div>
                        <div class="col-md-6"> {{ \Carbon\Carbon::parse($patient->dob)->format('Y M d') }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-6 font-weight-bold">Age:</div>
                        <div class="col-md-6">{{ $patient->age }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-6 font-weight-bold">Residence:</div>
                        <div class="col-md-6">{{ $patient->residence }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-6 font-weight-bold">Phone Number:</div>
                        <div class="col-md-6">{{ $patient->phone }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-6 font-weight-bold">Reg. Date:</div>
                        <div class="col-md-6"> {{ \Carbon\Carbon::parse($patient->created_at)->format('Y M d') }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-6 font-weight-bold">Registered By:</div>
                        <div class="col-md-6"><a href="{{ route('show_user', $patient->creator) }}">{{ $patient->creator->name }}</a></div>
                    </div>
                </div>
            </div>
            <hr>
            <h4 class="underline"><b>Credits</b> (Pending: {{number_format($patient->credit_due,2)}} | Cleared: {{number_format($patient->credit_cleared,2)}} | Total: {{number_format($patient->credit_total,2)}}) <a style="float: right"
                                             href="{{ route('create_credit', [$patient, $patient->last_name]) }}">New
                    Credit Record</a></h4>

            @component('components.table_credits', ['credits' => $patient->credits, 'extractions'=>true])
            @endcomponent

            <hr>
            <h4 class="underline"><b>Next of Kins</b> <a style="float: right"
                                                  href="{{ route('associate_nok', [$patient, $patient->last_name]) }}">Associate
                    NOK</a></h4>
            @component('components.table_noks', ['noks' => $patient->noks, 'extractions'=>true])
            @endcomponent
        </div>
    </div>
@endsection
