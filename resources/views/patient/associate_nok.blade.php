@extends('layouts.backend')

@section('page_content')
    <div class="card">
        <div class="card-header">{{ $patient->full_name }}
            <a style="float: right" class="btn btn-primary"
               href="{{ route('edit_patient', [$patient, $patient->last_name]) }}">Edit Patient</a>
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
                        <div class="col-md-6"><a
                                href="{{ route('show_user', $patient->creator) }}">{{ $patient->creator->name }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <h4 class="underline"><b>Associated Next of Kins</b></h4>
            <div id="associated_noks" style="min-height: 50px"></div>
            <h4 class="underline"><b>Other Next of Kins</b></h4>
            <div id="other_noks" style="min-height: 50px"></div>
        </div>
    </div>

@endsection

@section('additional_scripts')

    <script>

        // assoc_container = document.getElementById('associated_noks');
        // other_container = document.getElementById('other_noks');
        Associate('patient', {{$patient->id}},0);

        function Associate(origin = 'patient', origin_id = 0, other_id = 0) {
            r_data = {
                'origin_id': origin_id,
                'other_id': other_id,
                'origin': origin
            };
            console.log(r_data);
            $.ajax({
                type: "GET",
                url: "{{route('nok_patient_association')}}",
                data: r_data,
                success: function (data) {
                    console.log(data);
                    document.getElementById('associated_noks').innerHTML = data.associated;
                    document.getElementById('other_noks').innerHTML = data.other;
                },
                error: function () {
                    document.getElementById('associated_noks').innerText = 'Error';
                    document.getElementById('other_noks').innerText = 'Error';

                }
            });
        }


        {{--widget_containers = document.getElementsByClassName('dash_widget');--}}
        {{--for (var i = 0; i < widget_containers.length; i++) {--}}
        {{--    a = widget_containers.item(i)--}}
        {{--    item = a.innerText;--}}
        {{--    widget_id = a.id;--}}
        {{--    item_title = widget_id.replace(/_/g, " ");--}}
        {{--    LoadWidget(widget_id, item_title, item);--}}
        {{--}--}}
        {{--LoadWidget('due_debts', "{{App\Http\Controllers\HomeController::WIDGET_DUE}}")--}}

        {{--function LoadWidget(widget_id, item_title, item = null) {--}}
        {{--    $.ajax({--}}
        {{--        type: "GET",--}}
        {{--        url: "{{route('load_widget')}}",--}}
        {{--        data: {--}}
        {{--            'item_title': item_title,--}}
        {{--            'item': item--}}
        {{--        },--}}
        {{--        success: function (data) {--}}
        {{--            document.getElementById(widget_id).innerHTML = data.content;--}}
        {{--            document.getElementById(widget_id).hidden = false;--}}
        {{--            $('.dataTable').DataTable();--}}
        {{--        },--}}
        {{--        error: function () {--}}
        {{--            document.getElementById(widget_id).innerText = 'Error';--}}
        {{--            document.getElementById(widget_id).hidden = false;--}}

        {{--        }--}}
        {{--    });--}}
        {{--}--}}
    </script>
@endsection

