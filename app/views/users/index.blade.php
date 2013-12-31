@section('main')

<p><a href="{{ route('users.create') }}" style="color: #666; margin-left: 10px;">NEW USER</a></p>

@if ($users->count())
	<table class="table">
		<thead>
			<tr>
				<th>Email</th>
				<th>Balance</th>
				<th></th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach ($users as $user)
				<tr>
					<td>{{{ $user->email }}}</td>
					<td>{{{ $user->balance }}}</td>
                    <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">{{ trans('messages.edit') }}</a></td>
                    <td>
                        {{ Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id]]) }}
                            {{ Form::submit(trans('messages.delete'), array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no users
@endif

@stop
