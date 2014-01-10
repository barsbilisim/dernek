@section('content')
@include('partial.errors')

{{ Form::model($user, ['method' => 'PATCH', 'role' => 'form', 'class' => 'form-horizontal', 'route' => ['users.update', $user->id]]) }}
<div class="form-group">
	<p class="col-sm-12">
		<label for="email">Email</label>
		<input type="email" name="email" class="form-control" value="{{ Input::old('email', $user->email) }}" required>
	</p>
</div>
<div class="form-group">
	<p class="col-sm-12">
		<label for="password">Password</label>
		<input type="password" name="password" class="form-control" value="">
	</p>
</div>
<div class="form-group">
	<p class="col-sm-2">
		<label for="balance">Balance</label>
		<input type="text" name="balance" class="form-control" value="{{ Input::old('balance', $user->balance) }}" required maxlength="4">
	</p>
</div>
<div class="form-group">
	<p class="col-sm-2">
		<label for="phone">Phone</label>
		<input type="text" name="phone" class="form-control" value="{{ Input::old('phone', $user->phone) }}" required maxlength="10">
	</p>
</div>
<div class="form-group">
	<p class="col-sm-4">
		@foreach($roles as $key => $role)
		@if($user->hasRole($role->name))
			{{ Form::checkbox('roles[]', $role->name, true) }}
		@else
			{{ Form::checkbox('roles[]', $role->name,false) }}
		@endif
		<label for="roles">{{{ $role->name }}}</label> &nbsp;
		@endforeach
	</p>
</div>
<div class="form-group">
	<p class="col-sm-2">
		<input type="checkbox" name="deleted" style="vertical-align:middle; margin-top:0" value="1" @if($user->deleted_at != null) checked="checked" @endif>
		<label for="deleted">deleted</label>
	</p>
</div>
<div class="form-group">
	<p class="col-sm-12">
		<button type="submit" class="btn btn-primary">update</button> |
		<a href="{{ route('users.index') }}" class="btn btn-warning">cancel</a>
	</p>
</div>

{{ Form::close() }}
@stop
