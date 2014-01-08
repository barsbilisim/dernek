@section('content')
<div class="tooltip-div">
	<a href="{{ route('users.create') }}" class="btn btn-sm pull-right" data-placement="left" title="add user"><span class="glyphicon glyphicon-plus"></span></a>
</div>
<div style="clear:both"></div>

@if ($users->count())
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
			@foreach ($users as $user)
			<tr>
			<td><a href="{{ route('users.show', $user->id) }}">{{{ $user->email }}}</a></td>
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
			@endforeach
		</tbody>
	</table>
@else
	There are no users
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