@section('content')
@include('partial.errors')

{{ Form::open(['route' => 'users.store', 'role' => 'form', 'class' => 'form-horizontal']) }}
<div class="form-group">
	<p class="col-sm-12">
		<label for="email">Email</label>
		<input type="email" name="email" class="form-control" value="{{ Input::old('email') }}" required>
	</p>
</div>
<div class="form-group">
	<p class="col-sm-12">
		<label for="password">Password</label>
		<input type="password" name="password" class="form-control" value="" required>
	</p>
</div>
<div class="form-group">
	<p class="col-sm-2">
		<label for="balance">Balance</label>
		<input type="text" name="balance" class="form-control" value="{{ Input::old('balance', 0) }}" required maxlength="6">
	</p>
</div>
<div class="form-group">
	<p class="col-sm-2">
		<label for="phone">Phone</label>
		<input type="text" name="phone" class="form-control" value="{{ Input::old('phone') }}" required maxlength="10">
	</p>
</div>
<div class="form-group">
	<p class="col-sm-4">
		@foreach($roles as $role)
		@if($role->name == 'user')
			{{ Form::checkbox('roles[]', $role->name, true) }}
		@else
			{{ Form::checkbox('roles[]', $role->name, false) }}
		@endif
		<label for="roles[]">{{{ $role->name }}}</label> &nbsp;
		@endforeach
	</p>
</div>
<div class="form-group">
	<p class="col-sm-12">
		<button type="submit" class="btn btn-primary">create</button> |
		<a href="{{ route('users.index') }}" class="btn btn-warning">cancel</a>
	</p>
</div>

{{ Form::close() }}
@stop