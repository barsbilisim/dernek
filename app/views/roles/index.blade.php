@section('content')
<div class="tooltip-div">
	<a href="{{ route('roles.create') }}" class="btn btn-sm pull-right" data-placement="left" title="add role"><span class="glyphicon glyphicon-plus"></span></a>
</div>
<div style="clear:both"></div>

@if ($roles->count())
	<table class="table">
		<thead>
			<tr>
				<th>role</th>
				<th>users</th>
				<th style="width:70px"></th>
				<th style="width:70px"></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($roles as $role)
			<tr>
				<td><a href="{{ route('roles.show', $role->id) }}">{{{ $role->name }}}</a></td>
				<td>{{{ $role->users()->withTrashed()->count() }}}</td>
				<td style="text-align:center"><a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary">edit</a></td>
				<td style="text-align:center">
					{{ Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'onsubmit' => 'return confirm("Are you sure?")']) }}
						<button type="submit" class="btn btn-danger">delete</button>
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

@section('script')
<script type="text/javascript">
$(".tooltip-div").tooltip({
	selector: "button, a",
	container: "body"
});
</script>
@stop