@section('content')
<a href="{{ route('roles.create') }}" class="btn btn-sm pull-right" title="new role"><span class="glyphicon glyphicon-plus"></span></a>

@if ($roles->count())
	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($roles as $role)
			<tr>
				<td>{{{ $role->id }}}</td>
					<td>{{{ $role->name }}}</td>
                    <td>{{ link_to_route('roles.edit', 'Edit', array($role->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('roles.destroy', $role->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
			</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no roles
@endif

@stop
