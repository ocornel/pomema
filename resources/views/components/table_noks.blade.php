@isset($noks)
<table class="table table-bordered table-striped table-hover dataTable">
    <thead>
    <tr>
        <th>NID</th>
        <th>FULL NAME</th>
        <th>ID NO</th>
        <th>AGE</th>
        <th>DOB</th>
        <th>RESIDENCE</th>
        <th>WORK PLACE</th>
        <th>PHONE</th>
        <th>PATIENTS</th>
        @isset($actions)
        <th>ACTIONS</th>
        @endisset
    </tr>
    </thead>
    <tbody>
    @foreach($noks as $nok)
    <tr>
        <td>{{$nok->id}}</td>
        <td><a href="{{ route('show_nok', [$nok, $nok->last_name]) }}">{{ $nok->full_name }}</a></td>
        <td>{{ $nok->id_number }}</td>
        <td>{{ $nok->age }}</td>
        <td>{{ \Carbon\Carbon::parse($nok->dob)->format('Y M d') }}</td>
        <td>{{ $nok->residence }}</td>
        <td>{{ $nok->work_place }}</td>
        <td>{{ $nok->phone }}</td>
        <td>{{ $nok->patients_count }}</td>
        @isset($actions)
        <td>
            <a href="{{ route('edit_nok', [$nok, $nok->last_name]) }}" title="Edit"
               class="btn-sm btn-secondary"><i class="fa fa-edit"></i></a>
            <a href="{{ route('delete_nok', [$nok]) }}" title="Delete" class="btn-sm btn-danger"><i
                    class="fa fa-trash"></i></a>
        </td>@endisset
    </tr>
    @endforeach
    </tbody>
</table>
@else
<p>Please define $noks</p>
@endif
