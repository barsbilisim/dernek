@section('content')

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
		<tr>
			<td>{{{ $user->email }}}</td>
			<td>{{{ $user->balance }}}</td>
			<td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">{{ trans('messages.edit') }}</a></td>
			<td>
				{{ Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id]]) }}
					{{ Form::submit(trans('messages.delete'), ['class' => 'btn btn-danger']) }}
				{{ Form::close() }}
			</td>
		</tr>
	</tbody>
</table>

@stop
