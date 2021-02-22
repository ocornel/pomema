@extends('utils.reports.pdfs.template')

@section('report_name')
    {{$report_title}}
@endsection

@section('report_header')
    <?php
    $patient = $report_data['patient']
    ?>
    <p style="text-align: center; color: #555">
        <b>PC Number:</b>
        {{ $patient->pc_number }} &nbsp;
        <b>Sex:</b>
        {{ $patient->gender }} &nbsp;
        <b>Date of Birth:</b>
        {{ \Carbon\Carbon::parse($patient->dob)->format('Y M d') }} &nbsp;
        <b>Age:</b>
        {{ $patient->age }} &nbsp;
        <b>Residence:</b>
        {{ $patient->residence }} &nbsp;
        <br>
        <b>Phone Number:</b>
        {{ $patient->phone }} &nbsp;
        <b>Reg. Date:</b>
        {{ \Carbon\Carbon::parse($patient->created_at)->format('Y M d') }} &nbsp;
        <b>Registered By:</b>
        <a href="{{ route('show_user', $patient->creator) }} &nbsp;">{{ $patient->creator->name }} &nbsp;</a>
        <b></b>
    </p>
@endsection

@section('content')

    @include('components.table_credits', ['credits'=>$report_data['credits']])
@endsection
