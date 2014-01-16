@section('content')
@include('partial.errors')

{{ Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id], 'role' => 'form', 'class' => 'form-horizontal']) }}
<div class="form-group">
	<div class="col-sm-12">
		{{ Form::label('name', 'Role name:') }}
		{{ Form::text('name', Input::old('name', $role->name), ['class' => 'form-control', 'maxlength' => 100, 'required' => true]) }}
	</div>
</div>
<div class="form-group">
	<div class="col-sm-12">
		<button type="submit" class="btn btn-primary">update</button> | 
		<a href="{{ route('roles.index') }}" class="btn btn-warning">cancel</a>
	</div>
</div>

<hr>

<div id="user-group" class="col-sm-6" style="margin-top:30px;"></div>
<div id="user-filter" class="col-sm-6">
	<input type="text" name="min" class="form-control" placeholder="min" maxlength="4">
	<input type="text" name="max" class="form-control" placeholder="max" maxlength="4">
	<button type="button" id="user-load" class="btn btn-primary">load</button>
	<input type="checkbox" name="deleted" style="vertical-align:middle; margin-top:0" value="1">
	<label for="deleted">deleted</label>
	<div id="user-list" style="margin-top:30px;"></div>
</div>

{{ Form::close() }}

@stop

@section('style')
{{ HTML::style('css/jqueryui/1.10.3/jquery-ui.min.css') }}
<style type="text/css">
#user-filter input {color:#f6931f; font-weight:bold; text-align: center}
#user-filter input[name="min"],
#user-filter input[name="max"]
{max-width:60px}
</style>
@stop

@section('script')
{{ HTML::script('js/ckeditor/4.3.1/ckeditor.js') }}
{{ HTML::script('js/jqueryui/1.10.3/jquery.ui.core.min.js') }}
{{ HTML::script('js/jqueryui/1.10.3/jquery.ui.widget.min.js') }}
{{ HTML::script('js/jqueryui/1.10.3/jquery.ui.datepicker.min.js') }}
<script type="text/javascript">
$('#user-load').on('click', function(){
	var min = $('input[name="min"]').val(),
		max = $('input[name="max"]').val();
		del = ($('input[name="deleted"]').prop('checked'))?1:0;
		$('#user-list').load('/api/user/list?min='+min+'&max='+max+'&del='+del);
});

$('#user-group').load('/api/role/{{{ $role->id }}}');

$("#user-list").on("click", "button.delete-user", function(){
	$(this).parent().parent("tr").remove();
});

$("#user-group").on("click", "button.delete-user", function(){
	if(confirm('{{ trans("messages.Are you sure?") }}'))
	{	
		var btn = $(this);
		btn.prop("disabled",true);
		$.ajax({
			type:		'post',
			url:		'/api/role/{{{ $role->id }}}/user/' + btn.attr('user-id') + '/delete',
			headers:	{'X-CSRF-Token': '{{ Session::token() }}'},
			error:		function(){
							console.log("error");
						},
			success:	function(response){
							if(response == 'success')
								btn.parent().parent("tr").remove();
						},
			complete:	function(){
							btn.prop("disabled", false);
						}
		});
	}
});
</script>
@stop