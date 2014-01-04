@section('content')
<a href="{{ route('roles.index') }}" class="btn btn-lg pull-right" title="return to all roles"><span class="glyphicon glyphicon-new-window"></span></a>

<table class="table">
	<thead>
		<tr>
			<th>Id</th>
				<th>Name</th>
		</tr>
	</thead>

	<tbody>
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
	</tbody>
</table>

@stop