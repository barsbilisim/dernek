@section('content')
<div class="tooltip-div">
	<a href="{{ route('users.index') }}" class="btn btn-lg pull-right" data-placement="left" title="return to users"><span class="glyphicon glyphicon-new-window"></span></a>
</div>
<div style="clear:both"></div>

<table class="table">
	<thead>
		<tr>
		<th>email</th>
		<th>balance</th>
		<th>phone</th>
		<th>deleted</th>
		<th></th>
		<th></th>
		</tr>
	</thead>

	<tbody>
		<tr>
		<td>{{{ $user->email }}}</td>
		<td>{{{ $user->balance }}}</td>
		<td>{{{ $user->phone }}}</td>
		<td>{{{ $user->deleted_at }}}</td>
		<td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">{{ trans('messages.edit') }}</a></td>
		<td>
			{{ Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'onsubmit' => 'return confirm("Are you sure?")']) }}
				<button type="submit" class="btn btn-danger">delete</button>
			{{ Form::close() }}
		</td>
		</tr>
	</tbody>
</table>

@stop

@section('script')
<script type="text/javascript">
$(".tooltip-div").tooltip({
	selector: "button, a",
	container: "body"
});
</script>
@stop