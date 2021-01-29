@extends('layouts.backend')

@section('page_content')
    <div class="card">
        <div class="card-header">{{ $nok->full_name }} <a style="float: right" class="btn btn-primary"
                                                          href="{{ route('edit_nok', [$nok, $nok->last_name]) }}">Edit
                NOK</a></div>

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
                        <div class="col-md-5 font-weight-bold">ID Number:</div>
                        <div class="col-md-7">{{ $nok->id_number }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-5 font-weight-bold">Date of Birth:</div>
                        <div class="col-md-7"> {{ \Carbon\Carbon::parse($nok->dob)->format('Y M d') }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-5 font-weight-bold">Age:</div>
                        <div class="col-md-7">{{ $nok->age }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-5 font-weight-bold">Residence:</div>
                        <div class="col-md-7">{{ $nok->residence }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-5 font-weight-bold">Place of Work:</div>
                        <div class="col-md-7">{{ $nok->work_place }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-5 font-weight-bold">Phone Number:</div>
                        <div class="col-md-7">{{ $nok->phone }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-5 font-weight-bold">Reg. Date:</div>
                        <div class="col-md-7"> {{ \Carbon\Carbon::parse($nok->created_at)->format('Y M d') }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-5 font-weight-bold">Registered By:</div>
                        <div class="col-md-7"><a
                                href="{{ route('show_user', $nok->creator) }}">{{ $nok->creator->name }}</a></div>
                    </div>
                </div>
            </div>
            <hr>
                <div class="row underline">
                    <div class="col-md-8"><h4 class=""><b>Associated Patients (Total Credit Due: {{number_format($nok->credit_due,2)}})</b></h4></div>
                    <div class="col-md-4"><a
                            style="float: right" class="btn btn-primary"
                            href="{{ route('associate_patient', [$nok, $nok->last_name]) }}">Associate Patient</a></div>
                </div>


            @component('components.table_patients', ['patients' => $nok->patients, 'extractions'=>true])
            @endcomponent        </div>
    </div>
@endsection
