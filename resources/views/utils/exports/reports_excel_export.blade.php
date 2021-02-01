<table>
    <!-- details -->
    <tr>
        <td>PONACARE</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        @isset($name)
            <td>{{$name}}</td>
        @endisset
    </tr>
    <tr></tr>
    <!-- table -->
    <tr>
        @isset($table)
            <table class="summary-table">
                @foreach($report_summary as $k => $v)
                    <tr>
                        <td class="key">{{$k}}</td>
                        <td class="value">{{$v}}</td>
                    </tr>
                @endforeach
                <tr></tr>
            </table>

            {!! $table !!}
        @endisset
    </tr>
    <tr></tr>

    <tr>
        <td colspan="3">
            @isset($user)
                REPORT PRODUCED BY: {{$user->name}}
            @endisset
        </td>
    </tr>

    <tr>
        <td colspan="3">
            TIME PRODUCED: {{\Carbon\Carbon::now()}}
        </td>
    </tr>
</table>
