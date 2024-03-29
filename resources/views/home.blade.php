@extends('layouts.backend')

@section('page_content')
    <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="row">
                @forelse($dashboard_items as $item)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 dash_widget" hidden="true" id="{{str_replace(' ', '_', $item['title'])}}"><span hidden>{{ json_encode($item) }}</span><div></div></div>
                @empty
                    <p>Dashboards coming here</p>
                @endforelse
            </div>
{{--                outstanding debts trends here--}}
                <div id="outstanding_trend"></div>
                <div id="due_debts"><span>Loading Dashboards</span></div>
        </div>
    </div>
@endsection

@section('additional_scripts')

    <script>



        $(document).ready(function () {
            load_dashboards();
            LoadWidget('due_debts', "{{App\Http\Controllers\HomeController::WIDGET_DUE}}");
            setInterval(function() {
                LoadWidget('due_debts', "{{App\Http\Controllers\HomeController::WIDGET_DUE}}");
            }, 600000);
            setInterval(function() {
                load_dashboards();
            }, 5000);
        });

        // load table widget after 10 mins



        function load_dashboards() {
            widget_containers = document.getElementsByClassName('dash_widget');
            for (var i = 0; i < widget_containers.length; i++) {
                a = widget_containers.item(i)
                item = a.firstChild.innerText;
                widget_id = a.id;
                item_title = widget_id.replace(/_/g, " ")  ;
                LoadWidget(widget_id, item_title, item);
            }

        }

        function LoadWidget(widget_id, item_title,item=null) {
            $.ajax({
                type: "GET",
                url: "{{route('load_widget')}}",
                data: {
                    'item_title': item_title,
                    'item':item
                },
                success: function (data) {
                    document.getElementById(widget_id).lastChild.innerHTML = data.content;
                    document.getElementById(widget_id).hidden = false;
                    $('.dataTable').DataTable();
                },
                error: function () {
                    document.getElementById(widget_id).lastChild.innerText = 'Error';
                    document.getElementById(widget_id).hidden = false;

                }
            });
        }
    </script>
@endsection

