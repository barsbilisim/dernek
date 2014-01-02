@section('content')

{{ Form::open(['route' => ['categories.articles.store', $cat]]) }}
	<ul>
        <li>
            {{ Form::label('id', 'Id:') }}
            {{ Form::text('id') }}
        </li>

        <li>
            {{ Form::label('image_id', 'Image_id:') }}
            {{ Form::text('image_id') }}
        </li>

        <li>
            {{ Form::label('category', 'Category:') }}
            {{ Form::input('number', 'category') }}
        </li>

        <li>
            {{ Form::label('status', 'Status:') }}
            {{ Form::checkbox('status') }}
        </li>

        <li>
            {{ Form::label('slider', 'Slider:') }}
            {{ Form::checkbox('slider') }}
        </li>

		<li>
			{{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


