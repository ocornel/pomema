@isset($credits)
<table class="table table-bordered table-striped table-hover dataTable">
    <thead>
    <tr>
        <th>CODE</th>
        <th>PATIENT</th>
        <th>AMOUNT</th>
        <th>RECORD DATE</th>
        <th>DUE DATE</th>
        <th>CLEARED</th>
        <th>CLEARED ON</th>
        @isset($actions)
        <th>ACTIONS</th>
        @endisset
    </tr>
    </thead>
    <tbody>
    @foreach($credits as $credit)
    <tr>
        <td><a href="{{ route('show_credit', [$credit]) }}">{{ $credit->code }}</a></td>
        <td><a href="{{ route('show_patient', [$credit->patient_id, $credit->patient->last_name]) }}">{{ $credit->patient->full_name }}</a></td>
        <td>{{ number_format($credit->amount_due,2) }}</td>
        <td>{{ \Carbon\Carbon::parse($credit->created_at)->format('Y M d') }}</td>
        <td>{{ \Carbon\Carbon::parse($credit->due_date)->format('Y M d') }}</td>
        <td>{{ $credit->status_text }}</td>
        <td>{{ \Carbon\Carbon::parse($credit->cleared_on)->format('Y M d') }}</td>
        @isset($actions)
        <td>
            <a href="{{ route('edit_credit', [$credit]) }}" title="Edit"
               class="btn-sm btn-secondary"><i class="fa fa-edit"></i></a>
            <a href="{{ route('delete_credit', [$credit]) }}" title="Delete" class="btn-sm btn-danger"><i
                    class="fa fa-trash"></i></a>
        </td>@endisset
    </tr>
    @endforeach
    </tbody>
</table>
@else
<p>Please define $credits</p>
@endif
