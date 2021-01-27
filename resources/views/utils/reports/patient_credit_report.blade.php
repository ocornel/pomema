@extends('utils.reports.template')
@section('table')
    @include('components.table_credits', ['credits' => $report_data['credits']])
@endsection
