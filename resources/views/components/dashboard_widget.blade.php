@section('content')
    <style>
        .dashboard-item {
            box-shadow: 0 2px 10px rgba(0, 0, 0, .1);
            height: 145px;
            display: flex;
            cursor: default;
            background-color: #fff;
            position: relative;
            overflow: hidden;
            margin-bottom: 30px;
            padding: 8px;
            vertical-align: middle;
            border: #eee 1pt solid;
            border-radius: 5px;
        }

        .dashboard-item .content {
            width: 100%;
            color: black;
            text-align: right;
            height: 100%;
        }

        .dashboard-item .content .chart {
            width: 50%;
            background: black;
        }

        .dashboard-item .content .title {
            font-family: 'Clan-Book Book', serif;
            font-weight: 200;
            text-transform: uppercase;
            font-size: 12px;
            margin: auto;
        }

        .dashboard-item .content .value1 {
            font-size: 3em;
            font-family: 'Clan-Book Book', sans-serif;
            font-weight: 700;
        }

        .dashboard-item .content .value2 {
            font-family: 'Clan-Book Book', sans-serif;
            font-size: 11px;
            font-weight: 600;
        }

        .dashboard-item .content .value3 {
            font-family: 'Clan-Book Book', sans-serif;
            font-size: 11px;
            font-weight: 600;
        }

        .dashboard-item-link :hover {
            border: black 1pt solid;
            color: black;
        }

    </style>

    <?php $result = $widget_variables;
    $has_prefix = array_key_exists('prefix', $result);
    $has_suffix = array_key_exists('suffix', $result);
    $has_value2 = array_key_exists('value2', $result);
    $has_value3 = array_key_exists('value3', $result);

    $is_percentage = $has_suffix && $result['suffix'] == "%" ? true : false;
    $value1 = $result['value1'];

    $color = $is_percentage ? ($value1 < 80 ? "red" : ($value1 >= 80 && $value1 <= 99 ? "#FFC200" : ($value1 > 99 ? "green" : "black"))) : "black";
    ?>
    <div class="dashboard-item">
        {{--style="border-left: rgba(255,255,255, .0) 15pt solid;">--}}
        <div class="content" title="{{$item->description}}" style="color: {{$color}}">
                                    <span class="title">
                                         <a href="{{route('dashboard_item_link', ['title' => $item->title])}}"
                                            style="text-decoration:none;" class="dashboard-item-link">
                                        @if(strlen($item->title) < 50)
                                                 {{$item->title}}
                                             @else
                                                 <small>{{$item->title}}</small>
                                             @endif
                                         </a>
                                    </span>

            <br>
            <span class="value1">
{{--                                          @if(!$has_value2 && !$has_value3)style="line-height: 80px; font-size: 2.5em;" @endif>--}}
                @if($has_prefix){{$result['prefix']}} @endif
                {{number_format($result['value1'])}}
                @if($has_suffix){{$result['suffix']}} @endif
                                    </span>
            <br>
            @if($has_value2)
                <span class="value2">
                                            {{$result['value2']}}
                                        </span>
            @endif
            <br>
            @if($has_value3)
                <span class="value3">
                                            {{$result['value3']}}
                                        </span>
            @endif
        </div>
    </div>
@endsection


<span class="value1">
                                    @if($has_prefix){{$result['prefix']}} @endif
    {{$result['value1']}}
    @if($has_suffix){{$result['suffix']}} @endif
                                    </span>
<br>
@if($has_value2)
    <span class="value2">
                                            {{$result['value2']}}
                                        </span>
@endif
<br>
@if($has_value3)
    <span class="value3">
                                            {{$result['value3']}}
                                        </span>
@endif
