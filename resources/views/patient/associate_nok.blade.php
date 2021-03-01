@extends('layouts.backend')

@section('page_content')
    <div class="card">
        <div class="card-header">{{ $patient->full_name }}
            <a style="float: right" class="btn btn-primary" href="{{ route('edit_patient', [$patient, $patient->last_name]) }}">Edit Patient</a>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <h4 class="underline"><b>Patient details</b></h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-5 font-weight-bold">PC Number:</div>
                            <div class="col-md-7">{{ $patient->pc_number }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-5 font-weight-bold">Sex:</div>
                            <div class="col-md-7">{{ $patient->gender }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-5 font-weight-bold">Date of Birth:</div>
                            <div class="col-md-7"> {{ \Carbon\Carbon::parse($patient->dob)->format('Y M d') }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-5 font-weight-bold">Age:</div>
                            <div class="col-md-7">{{ $patient->age }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-5 font-weight-bold">Residence:</div>
                            <div class="col-md-7">{{ $patient->residence }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-5 font-weight-bold">Phone Number:</div>
                            <div class="col-md-7">{{ $patient->phone }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-5 font-weight-bold">Primary NOK:</div>
                            <div class="col-md-7">
                                @isset($patient->primary_nok)
                                    <?php $nok = $patient->primary_nok ?>
                                    <a href="{{ route('show_nok', [$nok, $nok->last_name]) }}">{{ $nok->full_name }}</a>
                                @else
                                    None <small>(Edit Patient put NOK ID)</small>
                                @endisset
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-5 font-weight-bold">Reg. Date:</div>
                            <div class="col-md-7"> {{ \Carbon\Carbon::parse($patient->created_at)->format('Y M d') }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-5 font-weight-bold">Registered By:</div>
                            <div class="col-md-7"><a
                                    href="{{ route('show_user', $patient->creator) }}">{{ $patient->creator->name }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            <hr>
            <h4 class="underline"><b>Associated Next of Kins</b></h4>
            <div id="associated" style="min-height: 50px"></div>
            <h4 class="underline"><b>Other Next of Kins</b></h4>
            <div id="other" style="min-height: 50px"></div>
        </div>
    </div>

@endsection

@section('additional_scripts')
    <script>
        Associate('patient', {{$patient->id}},0);
    </script>
@endsection

