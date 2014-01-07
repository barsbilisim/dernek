@section('content')
@include('partial.errors')

{{ Form::model($group, ['method' => 'PATCH', 'route' => ['groups.update', $group->id], 'role' => 'form', 'class' => 'form-horizontal']) }}

<div class="form-group">
	<div class="col-sm-12">
		        <li>
            {{ Form::label('id', 'Id:') }}
            {{ Form::text('id') }}
        </li>

        <li>
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name') }}
        </li>

	</div>
</div>
<div class="form-group">
	<div class="col-sm-12">
		<button type="submit" class="btn btn-primary">update</button> | 
		<a href="{{ route('groups.show', $group->id) }}" class="btn btn-warning">cancel</a>
	</div>
</div>

{{ Form::close() }}

@stop