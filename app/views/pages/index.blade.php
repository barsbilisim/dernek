@section('content')
<div class="tooltip-div">
	<a href="{{ route('pages.create') }}" class="btn btn-lg pull-left" data-placement="right" title="add page"><span class="glyphicon glyphicon-plus"></a>
</div>
<div style="clear:both"></div>

@if ($pages->count())
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Content</th>
				<th>Language</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($pages as $page)
				<tr>
					<td>{{{ $page->name }}}</td>
					<td>{{ $page->content }}</td>
					<td>{{ trans('messages.'.$page->lang) }}</td>
                    <td><a href="{{ route('pages.edit', $page->id) }}" class="btn btn-primary">{{ trans('messages.edit') }}</a></td>
                    <td>
                        {{ Form::open(['method' => 'DELETE', 'route' => ['pages.destroy', $page->id], 'onsubmit' => 'return confirm("Are you sure?")']) }}
                            {{ Form::submit('delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no pages
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