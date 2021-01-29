<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>PONACARE | @yield('report_name') </title>
    <style>
        @page {
            margin: 0px;
        }

        body {
            font-size: 12px;
            padding: 20px;
            margin: 0px;
            font-family: sans-serif;
        }

        div .inline {
            color: black;
            float: left;
            line-height: 1;
            font-size: 13px;
        }

        .report-title {
            float: left;
            font-size: 1.7em;
            font-weight: 100;
            font-family: sans-serif;
            text-align: center;
            width: 100%;
            text-transform: uppercase;
        }

        .right {
            float: right;
        }

        .header {
            font-size: 9px;
            color: #525659;
            line-height: 1.5;
        }

        table {
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
        }

        .table {
            width: 100%;
        }

        td {
            margin: 0;
            border: none;
            padding: 5px;
            text-align: left;
            font-size: 9px;
            border-bottom: #ddd 1px solid;
        }

        tr {
            border-bottom: #ddd 10px solid;
            width: 100%;
        }

        th {
            padding: 3px;
            background: #eee;
            border-bottom: 1px solid #eee;
            font-size: 9px;
            font-weight: bold;
            color: black;
        }

        td a {
            text-decoration: none;
            color: black;
        }

        .summary-table {
            width: 50%;
            margin-bottom: 20px;
            color: black
        }

        .summary-table tr {
            border-bottom: #eee 0.5pt solid;
            border-top: #eee 0.5pt solid
        }

        .key {
            font-weight: bold;
            background: #eee
        }

        .value {
            text-align: center;
        }

        .text-uppercase {
            text-transform: uppercase;
        }
    </style>

    @yield('styles')
</head>
<body>

<div style="width: 100%; background: #FFFFFF;">
    <div style="width: 60%;" class="inline">
        <p class="header">{{env('APP_NAME')}}<br>
            [full_address_here]</p>
    </div>

    <div style="width: 40%;" class="inline">
        <img style="width: 150px;" class="right" src="{{public_path('img/logo_blue_white.png')}}">
    </div>

    <div style="width: 100%; clear: both;">
        <hr style="width: 100%;height: 1px; border-bottom: #A3A3A3 0.5px solid; border-top: none; border-left: none; border-right: none">
        <p class="report-title">@yield('report_name')</p>
    </div>

    <div style="width: 100%; clear: both;">
        @yield('report_header')
    </div>
    <hr style="width: 100%;height: 1px; border-bottom: #A3A3A3 0.5px solid; border-top: none; border-left: none; border-right: none">
</div>

<table class="summary-table">
    @foreach($report_summary as $k => $v)
        <tr>
            <td class="key">{{$k}}</td>
            <td class="value">{{$v}}</td>
        </tr>
    @endforeach
</table>
@yield('content')


<footer style="position: absolute; bottom: 0; width: 50%;">
    <div style="text-align: left; font-size: 0.9em; ">
        <div class="contentEditableContainer contentTextEditable">
            <div class="contentEditable">
                <p style="color:#525659; font-weight:bold;">
                    Report Produced By
                    @if(\Illuminate\Support\Facades\Auth::user())
                        {{\Illuminate\Support\Facades\Auth::user()->name}}
                    @else System Generated
                    @endif
                </p>
            </div>
        </div>
        <div class="contentEditableContainer contentTextEditable">
            <div class="contentEditable">
                <p style="color:#A8B0B6;">
                    Time Produced {{Carbon\Carbon::now()}}</p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
