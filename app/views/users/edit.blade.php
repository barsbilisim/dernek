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
		<input type="number" name="balance" class="form-control" value="{{ Input::old('balance', $user->balance) }}" required min="-10000" max="10000">
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
