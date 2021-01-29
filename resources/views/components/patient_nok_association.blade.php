@section('associated')
    <style>
        .columns-var {
            column-count: var(--columns);
            column-rule: 1px solid var(--5c-faint-grey, #D3D3D3);
        }
    </style>
    <p>Uncheck to Disassociate</p>
    <div class="max-height-var" style="--max-height:50vh; margin-bottom: 10px">
        <div class="form-group columns-var" style="--columns:3">
            @foreach($associated as $a)
                <input type="checkbox" checked id="nok_{{$a->id}}" value="{{$a->id}}" oninput="Associate('{{$origin}}', {{ $candidate_id }}, {{ $a->id }})">
                <label for="nok_{{$a->id}}"> {{ $a->full_name }} ({{$a->uid}})</label><br>
            @endforeach
        </div>
    </div>

@endsection

@section('other')
    <p>Check to Associate</p>
    <div class="max-height-var" style="--max-height:50vh; margin-bottom: 10px">
        <div class="form-group columns-var" style="--columns:3">
            @foreach($other as $a)
                <input type="checkbox" id="nok_{{$a->id}}" value="{{$a->id}}" oninput="Associate('{{$origin}}',{{ $candidate_id }}, {{ $a->id }})">
                <label for="nok_{{$a->id}}"> {{ $a->full_name }} ({{$a->uid}})</label><br>
            @endforeach
        </div>
    </div>
@endsection
