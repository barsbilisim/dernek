@section('content')
@include('partial.errors')

{{ Form::open(['route' => 'users.store', 'role' => 'form']) }}
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
		<td>{{ trans('messages.roles') }}</td>
		<td>
			@foreach($roles as $key => $role)
				{{ Form::checkbox('roles[]', $role->name, ($role->name == 'user'), ["style" => "vertical-align:middle; margin-top:0" ]) }}
				<label for="roles">{{{ $role->name }}}</label> &nbsp;
			@endforeach
		</td>
	</tr>
	<tr>
		<td>{{ Lang::get("messages.image") }}</td>
		<td>
			<input type="hidden" name="coords" value="">
			<input type="hidden" name="dataUrl" value="">
			<input type="file" name="file" accept="image/*" id="upload-input" class="form-control" style=""><br>
			<div id="img-box"></div><br>
		</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<button type="submit" class="btn btn-primary">create</button> |
			<a href="{{ route('users.index') }}" class="btn btn-warning">cancel</a>
		</td>
	</tr>
</table>

{{ Form::close() }}
@stop

@section('style')
{{ HTML::style('css/jqueryui/1.10.3/jquery-ui.min.css') }}
{{ HTML::style('css/jcrop/0.9.12/jquery.Jcrop.min.css') }}
<style type="text/css">
input[required] { background: rgb(255, 236, 236); }
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

	$("#upload-input").on("change", function(){
		var file   = this.files[0];
		var reader = new FileReader();
		reader.readAsDataURL(file);		
		reader.onload = function(){
			$("#img-box").html('<img class="image-preview cropbox" src="' + reader.result + '">');
			$("input[name='dataUrl']").val(reader.result.substring(reader.result.indexOf(";base64,") + 8));
			initJcrop();
		}
	});

	function initJcrop(){
		$('.cropbox').Jcrop({
		aspectRatio: 1,
		minSize: [80,80],
		boxHeight: 150,
		onSelect: updateCoords
		}, function () {
			setCoords(this);
		});
	}

	function updateCoords(c) {
		$("input[name='coords']").val('{"x": "' + Math.floor(c.x) + '", "y": "' + Math.floor(c.y) + '", "w": "' + Math.floor(c.w) + '", "h": "' + Math.floor(c.h) + '"}');
	};

	function setCoords(obj) {
		var dim = obj.getBounds();
		obj.setSelect([0, 0, Math.floor(dim[0]), Math.floor(dim[1])]);
	};
</script>
@stop