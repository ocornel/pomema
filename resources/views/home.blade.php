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
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 dash_widget" hidden="true" id="{{str_replace(' ', '_', $item['title'])}}">{{ json_encode($item) }}</div>
                @empty
                    <p>Dashboards coming here</p>
                @endforelse
            </div>
{{--                outstanding debts trends here--}}
                <div id="outstanding_trend"></div>
                <div id="due_debts">Loading Dashobards</div>
        </div>
    </div>
@endsection


@section('additional_scripts')

    <script>
        widget_containers = document.getElementsByClassName('dash_widget');
        for (var i = 0; i < widget_containers.length; i++) {
            a = widget_containers.item(i)
            item = a.innerText;
            widget_id = a.id;
            item_title = widget_id.replace(/_/g, " ")  ;
            LoadWidget(widget_id, item_title, item);
        }
        LoadWidget('due_debts', "{{App\Http\Controllers\HomeController::WIDGET_DUE}}")

        function LoadWidget(widget_id, item_title,item=null) {
            $.ajax({
                type: "GET",
                url: "{{route('load_widget')}}",
                data: {
                    'item_title': item_title,
                    'item':item
                },
                success: function (data) {
                    console.log(item_title);
                    document.getElementById(widget_id).innerHTML = data.content;
                    document.getElementById(widget_id).hidden = false;
                    $('.dataTable').DataTable();
                },
                error: function () {
                    document.getElementById(widget_id).innerText = 'Error';
                    document.getElementById(widget_id).hidden = false;

                }
            });
        }
    </script>
@endsection

