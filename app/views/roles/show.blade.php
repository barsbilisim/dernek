@section('content')
<a href="{{ route('roles.index') }}" class="btn btn-lg pull-right" title="return to all roles"><span class="glyphicon glyphicon-new-window"></span></a>

<table class="table">
	<thead>
		<tr>
			<th>name</th>
			<th>users</th>
			<th></th>
			<th></th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $role->name }}}</td>
			<td>{{{ $role->users->count() }}}</td>
			<td><a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary">edit</a></td>
			<td>
				{{ Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'onsubmit' => 'return confirm("Are you sure?")']) }}
					<button type="submit" class="btn btn-danger">delete</button>
				{{ Form::close() }}
			</td>
		</tr>
	</tbody>
</table>

@stop