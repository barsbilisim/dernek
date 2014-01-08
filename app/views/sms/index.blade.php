@section('content')
<div class="tooltip-div">
	<span class="pull-left" id="sms-durum">{{{ $durum }}}</span>
	<a href="{{ route('sms.create') }}" class="btn pull-right" data-placement="left" title="add sms"><span class="glyphicon glyphicon-plus"></span></a>
</div>
<div style="clear:both"></div>

<div class="row">
	<div class="col-sm-6">
		{{ Form::open(['url' => '/api/sms/send', 'role' => 'form', 'id' => 'sms-form']) }}
		<div class="form-group">
			<input type="text" name="title" class="form-control" value="{{ Input::old('title', 'KDMK') }}" required placeholder="title">
		</div>
		<div class="form-group">
			<textarea name="content" class="form-control" value="{{ Input::old('content') }}" required style="min-height:100px;" placeholder="content"></textarea>
		</div>
		<div class="form-group">
			<input type="checkbox" name="save" style="vertical-align:middle; margin-top:0">
			<label for="save">save</label> &nbsp; | &nbsp;&nbsp;
			<input type="checkbox" name="pin" style="vertical-align:middle; margin-top:0">
			<label for="save">pin</label>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">send</button>
		</div>
		{{ Form::close() }}

		<div id="sms-list">
			@if ($sms->count())
			<div class="panel-group" id="accordion">
				@foreach($sms as $s)
				<div class="panel panel-default @if($s->pinned) panel-success @endif">
					<div class="panel-heading" style="position: relative;">
						<div class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $s->id }}">
							@if($s->title == ""){{ substr($s->content, 0, 100) }} @else {{ substr($s->title, 0, 100) }} @endif
						</div>
						<button type="button" class="btn btn-default btn-xs" sms-id="{{ $s->id }}" style="position: absolute; top: 10px; right: 12px;"><span class="glyphicon glyphicon-remove"></span></button>
					</div>
					<div id="collapse-{{ $s->id }}" class="panel-collapse collapse" style="height: auto;">
						<div class="panel-body">
							{{ $s->content }}
						</div>
					</div>
				</div>
				@endforeach
			</div>
			@else
			no sms
			@endif
		</div>
	</div>

	<div class="col-sm-6 tooltip-div">
		{{ Form::select("groups", $groups, null, ["class" => "form-control", 'style' => 'max-width:300px; display:inline-block']) }}
		<button type="button" class="btn btn-default group-btn" id="group-load" title="load"><span class="glyphicon glyphicon-refresh"></span></button>
		<button type="button" class="btn btn-default group-btn" id="group-clear" title="clear"><span class="glyphicon glyphicon-remove"></span></button>
		<div id="user-list"></div>
	</div>
</div>

@stop

@section('style')
<style type="text/css">
.panel-heading { cursor: pointer; border-color: transparent;}
.row {margin-top: 20px;}
</style>
@stop

@section('script')
<script type="text/javascript">
$(".tooltip-div").tooltip({
	selector: "button, a",
	container: "body"
});

$("#sms-list").on("click", ".panel-body", function(e){
	$("textarea[name='content']").text(($(this).text()).trim());
});

$(".panel-heading").on("click", "button", function(e){
	e.preventDefault();
	if(confirm('{{ trans("messages.Are you sure?") }}'))
	{
		var btn = $(this);
		btn.prop("disabled",true);
		$.ajax({
			type:		'post',
			url:		'/api/sms/' + btn.attr('sms-id') + '/delete',
			headers:	{'X-CSRF-Token': '{{ Session::token() }}'},
			error:		function(){
							console.log("error");
						},
			success:	function(response){
							if(response == "success") btn.parent().parent().remove();
						},
			complete:	function(){
							btn.prop("disabled", false);
						}
		});
	}
});

$("#group-load").on("click", function(){
	var id = $("select[name='groups']").val();
	(id == 0)?$("#user-list").html(""):$('#user-list').load('/api/group/' + id);
});

$("select[name='groups']").on("change", function(){
	var id = $(this).val();
	(id == 0)?$("#user-list").html(""):$('#user-list').load('/api/group/' + id);
});

$("#group-clear").on("click", function(){
	$("#user-list").html("");
});

$("#user-list").on("click", "button.delete-user", function(){
	$(this).parent().parent("tr").remove();
});

$('#sms-form').on('submit', function(e){
	e.preventDefault();
	if(confirm('{{ trans("messages.Are you sure?") }}'))
	{	
		var arr = $.map($("#user-list td#user-phone"), function(n){
			return n.innerHTML;
		});

		var btn = $(this).find("button[type='submit']");
		btn.prop("disabled",true);
		$.ajax({
			type:		'post',
			url:		'/api/sms/send',
			headers:	{'X-CSRF-Token': '{{ Session::token() }}'},
			data:		'{"content": "' + $("textarea[name='content']").val()
							+ '", "title": "' + $("input[name='title']").val()
							+ '", "nums": "'  + arr.join(',')
							+ '", "save": "'  + $("input[name='save']").prop('checked')
							+ '", "pin": "'   + $("input[name='pin']").prop('checked')
							+ '"}',
			dataType:	'json',
			error:		function(){
							console.log("error");
						},
			success:	function(response){
							alert(response.status);
							if(response.status.indexOf('DONUS|OK') >= 0) location.reload();							
						},
			complete:	function(){
							btn.prop("disabled", false);
						}
		});
	}
});
</script>
@stop