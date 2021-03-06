@section('content')
<div class="tooltip-div">
	<a href="{{ route('categories.articles.create', 'news') }}" class="btn btn-lg pull-left" data-placement="right" title="add article"><span class="glyphicon glyphicon-plus"></a>
	@if(User::inRoles(['super']))
	<a href="{{ route('categories.create') }}" class="btn pull-right" data-placement="left" title="add category"><span class="glyphicon glyphicon-plus"></span></a>
	@endif
</div>
<div style="clear:both"></div>

@if ($categories->count())
	<table class="table">
		<thead>
			<tr>
				<th>name</th>
				<th>articles</th>
				@if(User::inRoles(['super']))
				<th style="width:70px"></th>
				<th style="width:70px"></th>
				@endif
			</tr>
		</thead>

		<tbody>
			@foreach ($categories as $category)
				<tr @if($category->deleted_at != null) class="danger" @endif>
					<td><a href="{{ route('categories.show', $category->name) }}">{{{ trans('messages.'.$category->name) }}}</a></td>
					<td>{{{ $category->articles->count() }}} | {{{ $category->articles()->onlyTrashed()->count() }}}</td>
					@if(User::inRoles(['super']))
					<td style="text-align:center"><a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">edit</a></td>
					<td style="text-align:center">
						{{ Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $category->id], 'onsubmit' => 'return confirm("Are you sure?")']) }}
							<button type="submit" class="btn btn-danger">delete</button>
						{{ Form::close() }}
					</td>
					@endif
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