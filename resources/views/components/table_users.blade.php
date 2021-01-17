@isset($users)
<table class="table table-bordered table-striped table-hover dataTable">
    <thead>
    <tr>
        <th>UID</th>
        <th>NAME</th>
        <th>EMAIL</th>
        <th>REGISTERED</th>
        @isset($actions)
        <th>ACTIONS</th>
        @endisset
    </tr>
    </thead>
    <tbody>
    @forelse($users as $user)
    <tr>
        <td>{{$user->id}}</td>
        <td><a href="{{ route('show_user', [$user, $user->name]) }}">{{ $user->name }}</a></td>
        <td>{{ $user->email }}</td>
        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y M d') }}</td>
        @isset($actions)
        <td>
            <a href="{{ route('edit_user', [$user, $user->name]) }}" title="Edit"
               class="btn-sm btn-secondary"><i class="fa fa-edit"></i></a>
            <a href="{{ route('delete_user', [$user]) }}" title="Delete" class="btn-sm btn-danger"><i
                    class="fa fa-trash"></i></a>
        </td>@endisset
    </tr>
    @empty
        <tr><td colspan="10">No records found</td></tr>
    @endforelse
    </tbody>
</table>
@else
<p>Please define $users</p>
@endif
