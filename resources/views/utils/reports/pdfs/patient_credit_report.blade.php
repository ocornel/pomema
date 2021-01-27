@extends('utils.reports.pdfs.template')

@section('report_name')
    {{$report_title}}
@endsection

@section('content')
    @include('components.table_credits', ['credits'=>$report_data['credits']])
@endsection
