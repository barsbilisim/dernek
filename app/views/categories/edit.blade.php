@section('main')

{{ Form::model($category, ['method' => 'PATCH', 'route' => ['categories.update', $category->id]]) }}
	<ul>
        <li>
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name') }}
        </li>

        <li>
            {{ Form::label('status', 'Status:') }}
            {{ Form::checkbox('status', Input::old('status', $category->id)) }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('categories.show', 'Cancel', $category->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
