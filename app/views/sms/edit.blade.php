@section('content')
@include('partial.errors')

{{ Form::model($sm, ['method' => 'PATCH', 'route' => ['sms.update', $sm->id], 'role' => 'form', 'class' => 'form-horizontal']) }}

<div class="form-group">
	<div class="col-sm-12">
		        <li>
            {{ Form::label('id', 'Id:') }}
            {{ Form::text('id') }}
        </li>

        <li>
            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title') }}
        </li>

        <li>
            {{ Form::label('content', 'Content:') }}
            {{ Form::textarea('content') }}
        </li>

        <li>
            {{ Form::label('pinned', 'Pinned:') }}
            {{ Form::checkbox('pinned') }}
        </li>

	</div>
</div>
<div class="form-group">
	<div class="col-sm-12">
		<button type="submit" class="btn btn-primary">update</button> | 
		<a href="{{ route('sms.show', $sm->id) }}" class="btn btn-warning">cancel</a>
	</div>
</div>

{{ Form::close() }}

@stop