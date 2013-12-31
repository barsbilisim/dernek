@section('main')

<a href="{{ route('categories.create') }}" style="color: #666; margin-left: 10px;">NEW CATEGORY</a>

@if ($categories->count())
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Status</th>
				<th></th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach ($categories as $category)
				<tr>
					<td>{{{ $category->name }}}</td>
					<td>{{{ $category->status }}}</td>
                    <td><a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info">edit</a></td>
                    <td>
                        {{ Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $category->id]]) }}
                            {{ Form::submit(trans('messages.delete'), ['class' => 'btn btn-danger']) }}
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
