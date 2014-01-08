@section('content')
<div class="tooltip-div">
	<a href="{{ route('categories.create') }}" class="btn pull-right" data-placement="left" title="add category"><span class="glyphicon glyphicon-plus"></span></a>
</div>
<div style="clear:both"></div>

@if ($categories->count())
	<table class="table">
		<thead>
			<tr>
				<th>name</th>
				<th>articles</th>
				<th>deleted</th>
				<th></th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach ($categories as $category)
				<tr>
					<td><a href="{{ route('categories.show', $category->name) }}">{{{ $category->name }}}</a></td>
					<td>{{{ $category->articles->count() }}}</td>
					<td>{{{ $category->deleted_at }}}</td>
					<td><a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">edit</a></td>
					<td>
						{{ Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $category->id], 'onsubmit' => 'return confirm("Are you sure?")']) }}
							<button type="submit" class="btn btn-danger">delete</button>
						{{ Form::close() }}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no categories
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