@section('content')
@include('partial.errors')

{{ Form::model($image, ['method' => 'PATCH', 'route' => ['articles.images.update', $art, $image->id], 'role' => 'form', 'class' => 'form-horizontal']) }}

<div class="form-group">
	<div class="col-sm-12">
		        <li>
            {{ Form::label('id', 'Id:') }}
            {{ Form::text('id') }}
        </li>

        <li>
            {{ Form::label('article_id', 'Article_id:') }}
            {{ Form::text('article_id') }}
        </li>

        <li>
            {{ Form::label('big', 'Big:') }}
            {{ Form::textarea('big') }}
        </li>

        <li>
            {{ Form::label('thumb', 'Thumb:') }}
            {{ Form::textarea('thumb') }}
        </li>

        <li>
            {{ Form::label('description', 'Description:') }}
            {{ Form::text('description') }}
        </li>

        <li>
            {{ Form::label('status', 'Status:') }}
            {{ Form::checkbox('status') }}
        </li>

	</div>
</div>
<div class="form-group">
	<div class="col-sm-12">
		<button type="submit" class="btn btn-primary">update</button> | 
		<a href="{{ route('articles.images.index', $art) }}" class="btn btn-warning">cancel</a>
	</div>
</div>

{{ Form::close() }}

@stop