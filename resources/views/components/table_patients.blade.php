@isset($patients)
<table class="table table-bordered table-striped table-hover dataTable">
    <thead>
    <tr>
        <th>PID</th>
        <th>FULL NAME</th>
        <th>PC NO</th>
        <th>SEX</th>
        <th>AGE</th>
        <th>DOB</th>
        <th>RESIDENCE</th>
        <th>PHONE</th>
        <th>REGISTERED</th>
        @isset($actions)
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
        <td>{{ \Carbon\Carbon::parse($patient->dob)->format('Y M d') }}</td>
        <td>{{ $patient->residence }}</td>
        <td>{{ $patient->phone }}</td>
        <td>{{ \Carbon\Carbon::parse($patient->created_at)->format('Y M d') }}</td>
        @isset($actions)
        <td>
            <a href="{{ route('edit_patient', [$patient, $patient->last_name]) }}" title="Edit"
               class="btn-sm btn-secondary"><i class="fa fa-edit"></i></a>
            <a href="{{ route('delete_patient', [$patient]) }}" title="Delete" class="btn-sm btn-danger"><i
                    class="fa fa-trash"></i></a>
        </td>@endisset
    </tr>
    @empty
        <tr><td colspan="10">No records found</td></tr>
    @endforelse
    </tbody>
</table>
@else
<p>Please define $patients</p>
@endif
