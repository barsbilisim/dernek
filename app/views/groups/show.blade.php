@section('content')
<a href="{{ route('groups.index') }}" class="btn btn-lg pull-right" title="return to all groups"><span class="glyphicon glyphicon-new-window"></span></a>

<table class="table">
	<thead>
		<tr>
			<th>Id</th>
				<th>Name</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $group->id }}}</td>
					<td>{{{ $group->name }}}</td>
                    <td>{{ link_to_route('groups.edit', 'Edit', array($group->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('groups.destroy', $group->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop