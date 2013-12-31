@section('main')

<a href="{{ route('pages.create') }}" style="color: #666; margin-left: 10px;">NEW PAGE</a>

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
					<td>{{ trans('messages.'.$page->name) }}</td>
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
