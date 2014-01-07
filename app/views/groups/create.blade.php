@section('content')
@include('partial.errors')

{{ Form::open(['route' => 'groups.store', 'role' => 'form', 'class' => 'form-horizontal']) }}
<div class="form-group">
	<div class="col-sm-12">
		{{ Form::label('name', 'Group name:') }}
		{{ Form::text('name', Input::old('name'), ['class' => 'form-control', 'maxlength' => 100, 'required' => true]) }}
	</div>
</div>
<div class="form-group">
	<div class="col-sm-12">
		<button type="submit" class="btn btn-primary">create</button> | 
		<a href="{{ route('groups.index') }}" class="btn btn-warning">cancel</a>
	</div>
</div>
{{ Form::close() }}

@stop