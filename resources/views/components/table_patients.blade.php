@isset($patients)
<table class="table table-striped table-hover dataTable">
    <thead>
    <tr>
        <th>PID</th>
        <th>FULL NAME</th>
        <th>PC NO</th>
        <th>SEX</th>
        <th>AGE</th>
        <th>DUE CREDITS</th>
        <th>PHONE</th>
        @isset($actions)
        <th>ACTIONS</th>
            @elseif(isset($extractions))
            <th>ACTIONS</th>
        @endisset
    </tr>
    </thead>
    <tbody>
    @forelse($patients as $patient)
    <tr>
        <td>{{$patient->id}}</td>
        <td><a href="{{ route('show_patient', [$patient, $patient->last_name]) }}">{{ $patient->full_name }}</a></td>
        <td>{{ $patient->pc_number }}</td>
        <td>{{ \App\Patient::GENDERS[$patient->sex] }}</td>
        <td>{{ $patient->age }}</td>
        <td align="right">{{ number_format($patient->credit_due, 2) }}</td>
        <td>{{ $patient->phone }}</td>
        @isset($actions)
        <td>
            <a href="{{ route('edit_patient', [$patient, $patient->last_name]) }}" title="Edit"
               class="btn-sm btn-secondary"><i class="fa fa-edit"></i></a>
            <a href="{{ route('delete_patient', [$patient]) }}" title="Delete" class="btn-sm btn-danger"><i
                    class="fa fa-trash"></i></a>
        </td>@elseif(isset($extractions))
            <td>
                <a href="" title="Disassociate" class="btn btn-secondary"><i class="fa fa-times"></i></a>
            </td>
        @endisset
    </tr>
    @empty
        <tr><td colspan="10">No records found</td></tr>
    @endforelse
    </tbody>
</table>
@else
<p>Please define $patients</p>
@endif
