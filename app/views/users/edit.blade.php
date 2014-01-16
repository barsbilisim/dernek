@section('content')
@include('partial.errors')

@if(Input::get('part') == 'avatar')
{{ Form::model($user, ['method' => 'PATCH', 'role' => 'form', 'route' => ['users.update', $user->id]]) }}
	<input type="hidden" name="coords" value="">
	<input type="hidden" name="dataUrl" value="">
	<input type="file" name="file" accept="image/*" id="upload-input" class="form-control" style=""><br>
	<div id="img-box">@if($user->photo != null || $user->photo != "")<img class="cropbox" src="{{ $user->getPhoto() }}">@endif</div><br>
	<button type="submit" class="btn btn-primary">update</button> |
	<a href="{{ route('users.show', $user->id) }}" class="btn btn-warning">cancel</a>
{{ Form::close() }}
@elseif(Input::get('part') == 'settings')

{{ Form::model($user, ['method' => 'PATCH', 'role' => 'form', 'route' => ['users.update', $user->id]]) }}
<table class="table">
	<tr>
		<td>{{ trans('messages.email') }}</td>
		<td><input type="email" name="email" class="form-control" value="{{ Input::old('email', $user->email) }}" required></td>
	</tr>
	<tr>
		<td>{{ trans('messages.password') }}</td>
		<td><input type="password" name="password" class="form-control" value="{{ Input::old('password') }}"></td>
	</tr>
	@if(User::inRoles(['admin']))
	<tr>
		<td>{{ trans('messages.roles') }}</td>
		<td>
			@foreach($roles as $key => $role)
				{{ Form::checkbox('roles[]', $role->name, ($user->hasRole($role->name)), ["style" => "vertical-align:middle; margin-top:0" ]) }}
				<label for="roles">{{{ $role->name }}}</label> &nbsp;
			@endforeach
		</td>
	</tr>
	@endif
	@if(Auth::user()->id != $user->id && User::inRoles(['admin']))
	<tr>
		<td>{{ Lang::get("messages.deleted") }}</td>
		<td>{{ Form::checkbox('deleted', 1, ($user->deleted_at != null), ["style" => "vertical-align:middle; margin-top:0" ]) }} {{{ $user->deleted_at }}}</td>
	</tr>
	@endif
	<tr>
		<td></td>
		<td>
			<button type="submit" class="btn btn-primary">update</button> |
			<a href="{{ route('users.show', $user->id) }}" class="btn btn-warning">cancel</a>
		</td>
	</tr>
</table>
@else

{{ Form::model($user, ['method' => 'PATCH', 'role' => 'form', 'route' => ['users.update', $user->id]]) }}
<table class="table">
	<tr>
		<td style="width:40%">{{ trans('messages.firstname') }}</td>
		<td><input type="text" name="firstname" class="form-control" value="{{ Input::old('firstname', $user->firstname) }}" required></td>
	</tr>
	<tr>
		<td>{{ trans('messages.lastname') }}</td>
		<td><input type="text" name="lastname" class="form-control" value="{{ Input::old('lastname', $user->lastname) }}" required></td>
	</tr>
	<tr>
		<td>{{ trans('messages.gsm') }}</td>
		<td><input type="text" name="phone" class="form-control" value="{{ Input::old('phone', $user->phone) }}" required maxlength="10"></td>
	</tr>
	<tr>
		<td>{{ trans('messages.tckimlik_or_passport_no') }}</td>
		<td><input type="text" name="passport" class="form-control" value="{{ Input::old('passport', $user->passport) }}" maxlength="20"></td>
	</tr>
	<tr>
		<td>{{ trans('messages.birth_date') }}</td>
		<td>
			<input type="text" name="date" class="form-control" value="{{ Input::old('date', $date) }}" required>
			<input type="hidden" name="birth_date" id="birth_date" class="form-control" value="{{ Input::old('birth_date', $user->birth_date) }}" required>
		</td>
	</tr>
	<tr>
		<td>{{ trans('messages.marital_status') }}</td>
		<td>{{ Form::select('marital_status', ['single' => trans('messages.single'), 'married' => trans('messages.married')], Input::old('marital_status', $user->marital_status), ['class' => 'form-control']) }}</td>
	</tr>
	<tr>
		<td>{{ trans('messages.occupation_title') }}</td>
		<td><input type="text" name="occupation" class="form-control" value="{{ Input::old('occupation', $user->occupation) }}"></td>
	</tr>
	<tr>
		<td>{{ trans('messages.company_general_description') }}</td>
		<td><input type="text" name="company" class="form-control" value="{{ Input::old('company', $user->company) }}"></td>
	</tr>
	<tr>
		<td>{{ trans('messages.bachelors_degree_university') }}</td>
		<td><input type="text" name="bachelor" class="form-control" value="{{ Input::old('bachelor', $user->bachelor) }}"></td>
	</tr>
	<tr>
		<td>{{ trans('messages.master_degree_university') }}</td>
		<td><input type="text" name="master" class="form-control" value="{{ Input::old('master', $user->master) }}"></td>
	</tr>
	<tr>
		<td>{{ trans('messages.phd_degree_university') }}</td>
		<td><input type="text" name="phd" class="form-control" value="{{ Input::old('phd', $user->phd) }}"></td>
	</tr>
	<tr>
		<td></td>
		<td>
			<button type="submit" class="btn btn-primary">update</button> |
			<a href="{{ route('users.show', $user->id) }}" class="btn btn-warning">cancel</a>
		</td>
	</tr>
</table>
@endif

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
			$("#img-box").html('<img class="cropbox" src="' + reader.result + '">');
			$("input[name='dataUrl']").val(reader.result.substring(reader.result.indexOf(";base64,") + 8));
			initJcrop();
		}
	});

	function initJcrop(){
		$('.cropbox').Jcrop({
		aspectRatio: 1,
		minSize: [80,80],
		boxHeight: 400,
		onSelect: updateCoords
		}, function () {
			setCoords(this);
		});
	}

	function imageUrl()
	{
		initJcrop();

		var canvas = document.createElement('canvas'),
		ctx = canvas.getContext('2d'),
		img = new Image();

		img.onload = function(){
			canvas.width  = img.width;
			canvas.height = img.height;
			ctx.drawImage(img, 0, 0, img.width, img.height);
			$('input[name="dataUrl"]').val(canvas.toDataURL().substring(canvas.toDataURL().indexOf(";base64,") + 8));
		}
		img.src = $("#img-box img").attr("src");
	}

	function updateCoords(c) {
		$("input[name='coords']").val('{"x": "' + Math.floor(c.x) + '", "y": "' + Math.floor(c.y) + '", "w": "' + Math.floor(c.w) + '", "h": "' + Math.floor(c.h) + '"}');
	}

	function setCoords(obj) {
		var dim = obj.getBounds();
		obj.setSelect([0, 0, Math.floor(dim[0]), Math.floor(dim[1])]);
	}

	imageUrl();
</script>
@stop