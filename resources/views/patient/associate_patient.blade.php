@extends('layouts.backend')

@section('page_content')
    <div class="card">
        <div class="card-header"><a href="{{ route('show_nok', [$nok, $nok->last_name]) }}">{{ $nok->full_name }}</a>
            <a style="float: right" class="btn btn-primary"
               href="{{ route('edit_nok', [$nok, $nok->last_name]) }}">Edit
                NOK</a></div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <h4 class="underline">Next of Kin details</h4>
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
            <h4 class="underline"><b>Associated Patients</b></h4>
            <div id="associated" style="min-height: 50px"></div>
            <h4 class="underline"><b>Other Patients</b></h4>
            <div id="other" style="min-height: 50px"></div>
        </div>
    </div>

@endsection

@section('additional_scripts')
    <script>
        Associate('nok', {{$nok->id}},0);
    </script>
@endsection

