@section('content')
@if(User::inRoles(['admin']) && $page->name != '404')
<div class="tooltip-div">
	<a href="{{ route('pages.index') }}" class="btn btn-lg pull-right" data-placement="left" title="return to pages"><span class="glyphicon glyphicon-new-window"></span></a>
</div>
<div style="clear:both"></div>

@endif

{{ $page->content }}

@if(User::inRoles(['admin']) && $page->name != '404')
	<hr>
	<a href="{{ route('pages.edit', $page->id) }}" class="btn btn-primary">{{ trans('messages.edit') }}</a> |
	<button type="submit" form="delete-page" class="btn btn-danger">{{ trans('messages.delete') }}</button>
	
	{{ Form::open(['method' => 'DELETE', 'id' => 'delete-page', 'route' => ['pages.destroy', $page->id], 'onsubmit' => 'return confirm("Are you sure?")']) }}
	{{ Form::close() }}
@endif
@stop

@section('script')
{{ HTML::script("js/prettyPhoto/3.1.15/jquery.prettyPhoto.js") }}
<script type="text/javascript">
$(".tooltip-div").tooltip({
	selector: "button, a",
	container: "body"
});
</script>
@stop