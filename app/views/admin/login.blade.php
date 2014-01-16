@section('content')
<div class="login">
	<a href="/" class="logo"><img src="/img/logo.png"></a>
	<form method="post" action="/login" role="form">
		{{ Form::token() }}
		<div class="input-group">
			<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
			<input type="email" name="email" class="form-control" placeholder="email" value="{{ Input::old('email') }}" required autofocus maxlength="100">
		</div>
		<div class="input-group">
			<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
			<input type="password" name="password" class="form-control" placeholder="password" value="{{ Input::old('password') }}" required maxlength="100">
		</div>
		<!-- <label class="checkbox">
		<input type="checkbox" value="remember-me"> remember me
		</label> -->
		<button class="btn btn-lg btn-primary btn-block" type="submit">login</button>
		<a href="/register" class="btn btn-lg btn-block" >{{ trans('messages.register') }}</a>
	</form>

@include('partial.errors')
@if(Session::has("message"))
	<div class="alert alert-danger">
        {{ Session::get("message") }}
    </div>
@endif
</div>
@stop
@section('style')
<style type="text/css">
.login {width: 400px; margin: 10px auto; text-align: center}
.login .logo img { width: 150px; margin-bottom:15px}
.login .input-group, .login .btn {margin-bottom: 10px}
.login input {text-align: center; color: #999; font-weight: bold}
.login .alert-danger {list-style: none; font-weight: bold; padding-left: 40px}
</style>
@stop