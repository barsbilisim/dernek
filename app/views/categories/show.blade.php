@section('content')
<div class="tooltip-div">
	<a href="{{ route('categories.index') }}" class="btn btn-lg pull-right" data-placement="left" title="return to categories"><span class="glyphicon glyphicon-new-window"></span></a>
</div>
<div style="clear:both"></div>

<table class="table">
	<thead>
		<tr>
			<th>name</th>
			<th>articles</th>
			<th>deleted</th>
			<th style="width:70px"></th>
			<th style="width:70px"></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>{{{ $category->name }}}</td>
			<td>{{{ $category->articles->count() }}}</td>
			<td>{{{ $category->deleted_at }}}</td>
			<td style="text-align:center"><a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">edit</a></td>
			<td style="text-align:center">
				{{ Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $category->id], 'onsubmit' => 'return confirm("Are you sure?")']) }}
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