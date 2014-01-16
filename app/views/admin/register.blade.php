@section('content')
<div class="login">

@include('partial.errors')
@if(Session::has("message"))
<div class="alert alert-danger">
	{{ Session::get("message") }}
</div>
@endif

@if(Session::has("success"))
<div class="alert alert-success">
	{{ Session::get("success") }}
</div>
@endif
	<h1 style="width:100%; text-align:center">{{ trans('messages.Registration') }}</h1>
	<form method="post" action="/register" role="form">
		{{ Form::token() }}
		<table class="table">
			<tr>
				<td style="width:40%">{{ trans('messages.firstname') }}</td>
				<td><input type="text" name="firstname" class="form-control" value="{{ Input::old('firstname') }}" required></td>
			</tr>
			<tr>
				<td>{{ trans('messages.lastname') }}</td>
				<td><input type="text" name="lastname" class="form-control" value="{{ Input::old('lastname') }}" required></td>
			</tr>
			<tr>
				<td>{{ trans('messages.email') }}</td>
				<td><input type="email" name="email" class="form-control" value="{{ Input::old('email') }}" required></td>
			</tr>
			<tr>
				<td>{{ trans('messages.gsm') }}</td>
				<td><input type="text" name="phone" class="form-control" value="{{ Input::old('phone') }}" required maxlength="10"></td>
			</tr>
			<tr>
				<td>{{ trans('messages.tckimlik_or_passport_no') }}</td>
				<td><input type="text" name="passport" class="form-control" value="{{ Input::old('passport') }}" maxlength="20"></td>
			</tr>
			<tr>
				<td>{{ trans('messages.birth_date') }}</td>
				<td>
					<input type="text" name="date" class="form-control" value="{{ Input::old('date') }}" required>
					<input type="hidden" name="birth_date" id="birth_date" class="form-control" value="{{ Input::old('birth_date') }}" required>
				</td>
			</tr>
			<tr>
				<td>{{ trans('messages.marital_status') }}</td>		
				<td>{{ Form::select('marital_status', ['single' => trans('messages.single'), 'married' => trans('messages.married')], Input::old('marital_status'), ['class' => 'form-control']) }}</td>
			</tr>
			<tr>
				<td>{{ trans('messages.occupation_title') }}</td>
				<td><input type="text" name="occupation" class="form-control" value="{{ Input::old('occupation') }}"></td>
			</tr>
			<tr>
				<td>{{ trans('messages.company_general_description') }}</td>
				<td><input type="text" name="company" class="form-control" value="{{ Input::old('company') }}"></td>
			</tr>
			<tr>
				<td>{{ trans('messages.bachelors_degree_university') }}</td>
				<td><input type="text" name="bachelor" class="form-control" value="{{ Input::old('bachelor') }}"></td>
			</tr>
			<tr>
				<td>{{ trans('messages.master_degree_university') }}</td>
				<td><input type="text" name="master" class="form-control" value="{{ Input::old('master') }}"></td>
			</tr>
			<tr>
				<td>{{ trans('messages.phd_degree_university') }}</td>
				<td><input type="text" name="phd" class="form-control" value="{{ Input::old('phd') }}"></td>
			</tr>
			<tr>
				<td></td>
				<td><a href="{{ route('pages.show', 'regulations') }}" target="_blank">{{ trans('messages.regulation') }}</a></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<button class="btn btn-lg btn-primary" type="submit">{{ trans('messages.register') }}</button>
					<a href="/login" class="btn btn-lg">{{ trans('messages.login') }}</a>
				</td>
			</tr>		
		</table>
	</form>
</div>

@stop

@section('style')
{{ HTML::style('css/jqueryui/1.10.3/jquery-ui.min.css') }}
<style type="text/css">
input[required] { background: rgb(255, 236, 236); }
.login {width: 800px; margin: 20px auto;}
.login .input-group, .login .btn {margin-bottom: 10px}
.login input {color: #999; font-weight: bold}
.login .alert-danger {list-style: none; font-weight: bold; padding-left: 40px}
</style>
@stop

@section('script')
{{ HTML::script('js/jcrop/0.9.12/jquery.Jcrop.min.js') }}
{{ HTML::script('js/jqueryui/1.10.3/jquery.ui.core.min.js') }}
{{ HTML::script('js/jqueryui/1.10.3/jquery.ui.widget.min.js') }}
{{ HTML::script('js/jqueryui/1.10.3/jquery.ui.datepicker.min.js') }}
{{ HTML::script('js/jqueryui/1.10.3/locales/jquery.ui.datepicker-'.Config::get("app.locale").'.min.js') }}
<script type="text/javascript">
var date = $("input[name='date']");
date.datepicker({
	dateFormat	: 'd MM yy',
	altField	: '#birth_date',
	altFormat	: 'yy-mm-dd',
	firstDay    : 1,
	changeMonth : true,
	changeYear  : true,
	defaultDate    : "-20y",
	yearRange      : "1940:2040"
});
</script>
@stop