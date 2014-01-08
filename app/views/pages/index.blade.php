@section('content')
<div class="tooltip-div">
	<a href="{{ route('pages.create') }}" class="btn pull-right" data-placement="left" title="add page"><span class="glyphicon glyphicon-plus"></a>
</div>
<div style="clear:both"></div>

@if ($pages->count())
	<table class="table">
		<thead>
			<tr>
				<th>name</th>
				<th>content</th>
				<th>language</th>
				<th>deleted</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($pages as $page)
			<tr>
				<td><a href="{{ route('pages.show', $page->name) }}">{{{ $page->name }}}</a></td>
				<td>{{ $page->content }}</td>
				<td>{{ trans('messages.'.$page->lang) }}</td>
				<td>{{{ $page->deleted_at }}}</td>
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