@section('content')
<div class="tooltip-div">
	<a href="{{ route('categories.articles.create', $category->name) }}" class="btn btn-lg pull-left" data-placement="right" title="add article"><span class="glyphicon glyphicon-plus"></a>
	<a href="{{ route('categories.index') }}" class="btn btn-lg pull-right" data-placement="left" title="return to categories"><span class="glyphicon glyphicon-new-window"></span></a>
</div>
<div style="clear:both"></div>

<table class="table">
	<thead>
		<tr>
			<th>name</th>
			<th>articles</th>
			<th>deleted</th>
			@if(User::inRoles(['super']))
			<th style="width:70px"></th>
			<th style="width:70px"></th>
			@endif
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>{{{ trans('messages.'.$category->name) }}}</td>
			<td >{{{ $category->articles->count() }}} | {{{ $category->articles()->onlyTrashed()->count() }}}</td>
			<td>{{{ $category->deleted_at }}}</td>
			@if(User::inRoles(['super']))
			<td style="text-align:center"><a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">edit</a></td>
			<td style="text-align:center">
				{{ Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $category->id], 'onsubmit' => 'return confirm("Are you sure?")']) }}
					<button type="submit" class="btn btn-danger">delete</button>
				{{ Form::close() }}
			</td>
			@endif
		</tr>
	</tbody>
</table>

<div>
	<input type="checkbox" name="deleted" style="vertical-align:middle; margin-top:0" value="1">
	<label for="deleted">deleted</label> &nbsp;&nbsp;&nbsp;
	<button type="button" id="article-load" class="btn btn-xs btn-primary">load</button>
</div>
<div id="article-list"></div>
@stop

@section('script')
<script type="text/javascript">
$(".tooltip-div").tooltip({
	selector: "button, a",
	container: "body"
});

var art = $('#article-list');

$('#article-load').on('click', function(){
	var del = ($('input[name="deleted"]').prop('checked'))?1:0;
	art.load('/api/article/list?cat={{{ $category->name }}}&del='+ del, function(){
	$(".tooltip-div").tooltip({
		selector: "button, a",
		container: "body"
	});
});
});

art.load('/api/article/list?cat={{{ $category->name }}}', function(){
	$(".tooltip-div").tooltip({
		selector: "button, a",
		container: "body"
	});
});

art.on('click', '.delete-article', function(){
	if(confirm('Are you sure?'))
	{
		var btn = $(this);
		$('.delete-article').prop('disabled', true);
		$.ajax({
			type     : 'post',
			headers  : {'X-CSRF-Token': '{{ Session::token() }}'},
			url      : '/api/article/' + btn.attr('article-id') + '/delete',
			error    : function(){},
			success  : function(response){	
							if(response == 'success')
								btn.parent().parent('tr').remove();
						},
			complete : function(){ $('.delete-article').prop('disabled', false); }
		});
	}
});
</script>
@stop