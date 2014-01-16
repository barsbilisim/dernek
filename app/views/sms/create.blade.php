@section('content')
<div class="tooltip-div">
	<a href="{{ route('sms.index') }}" class="btn pull-right" data-placement="left" title="return"><span class="glyphicon glyphicon-new-window"></span></a>
</div>
<div style="clear:both"></div>

@include('partial.errors')

<div class="row">
	<div class="col-sm-6">
		{{ Form::open(['route' => 'sms.store', 'role' => 'form']) }}
		<input type="hidden" name="smsid">
		<div class="form-group">
			<input type="text" name="title" class="form-control" value="{{ Input::old('title') }}" required placeholder="title">
		</div>
		<div class="form-group">
			<textarea name="content" class="form-control" value="{{ Input::old('content') }}" required style="min-height:150px;" placeholder="content"></textarea>
		</div>
		<div class="form-group">
			<input type="checkbox" name="pin" style="vertical-align:middle; margin-top:0" value="1">
			<label for="save">pin</label>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">create</button> | 
			<a href="{{ route('sms.index') }}" class="btn btn-warning">back</a>
		</div>
		{{ Form::close() }}

		@if ($pinned->count())
		<div class="panel-group" id="accordion-pinned">
			@foreach($pinned as $pin)
			<div class="panel panel-default panel-success">
				<div class="panel-heading" style="position: relative;">
					<div class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion-pinned" href="#collapse-{{ $pin->id }}">
						@if($pin->title == ""){{ substr($pin->content, 0, 100) }} @else {{ substr($pin->title, 0, 100) }} @endif
					</div>
					<button type="button" class="btn btn-default btn-xs" sms-id="{{ $pin->id }}" style="position: absolute; top: 10px; right: 12px;"><span class="glyphicon glyphicon-remove"></span></button>
				</div>
				<div id="collapse-{{ $pin->id }}" class="panel-collapse collapse" style="height: auto;">
					<div class="panel-body" sms-title="{{ $pin->title }}" sms-id="{{ $pin->id }}" sms-pin="{{ $pin->pinned }}">
						{{ $pin->content }}
					</div>
				</div>
			</div>
			@endforeach
		</div>
		@endif
	</div>

	<div class="col-sm-6">
		@if ($normal->count())
		<div class="panel-group" id="accordion-normal">
			@foreach($normal as $nrm)
			<div class="panel panel-default">
				<div class="panel-heading" style="position: relative;">
					<div class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion-normal" href="#collapse-{{ $nrm->id }}">
						@if($nrm->title == ""){{ substr($nrm->content, 0, 100) }} @else {{ substr($nrm->title, 0, 100) }} @endif
					</div>
					<button type="button" class="btn btn-default btn-xs" sms-id="{{ $nrm->id }}" style="position: absolute; top: 10px; right: 12px;"><span class="glyphicon glyphicon-remove"></span></button>
				</div>
				<div id="collapse-{{ $nrm->id }}" class="panel-collapse collapse" style="height: auto;">
					<div class="panel-body" sms-title="{{ $nrm->title }}" sms-id="{{ $nrm->id }}" sms-pin="{{ $nrm->pinned }}">
						{{ $nrm->content }}
					</div>
				</div>
			</div>
			@endforeach
		</div>
		@endif
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

$(".row").on("click", ".panel-body", function(e){
	e.preventDefault();
	$("textarea[name='content']").text(($(this).text()).trim());
	$("input[name='title']").val($(this).attr("sms-title"));
	$("input[name='smsid']").val($(this).attr("sms-id"));
	$("input[name='pin']").prop("checked", ($(this).attr("sms-pin") == 1)?true:false);
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
</script>
@stop