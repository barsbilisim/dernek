@section('content')
<div class="tooltip-div">
	<a href="{{ route('groups.create') }}" class="btn pull-right" data-placement="left" title="add group"><span class="glyphicon glyphicon-plus"></span></a>
</div>
<div style="clear:both"></div>

@if ($groups->count())
	<table class="table">
		<thead>
			<tr>
				<th>name</th>
				<th>users</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($groups as $group)
			<tr>
				<td><a href="{{ route('groups.show', $group->id) }}">{{{ $group->name }}}</a></td>
				<td>{{{ $group->users->count() }}}</td>
				<td><a href="{{ route('groups.edit', $group->id) }}" class="btn btn-primary">edit</a></td>
				<td>
					{{ Form::open(['method' => 'DELETE', 'route' => ['groups.destroy', $group->id], 'onsubmit' => 'return confirm("Are you sure?")']) }}
						<button type="submit" class="btn btn-danger">delete</button>
					{{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no groups
@endif

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

$('#sms-form').on('submit', function(e){
	e.preventDefault();
	if(confirm('{{ trans("messages.Are you sure?") }}'))
	{	
		var btn = $(this).find("button[type='submit']");
		btn.prop("disabled",true);
		$.ajax({
			type:		'post',
			url:		'/api/sms/send',
			headers:	{'X-CSRF-Token': '{{ Session::token() }}'},
			data:		'{"content": "' + $("textarea[name='content']").val()
							+ '", "title": "' + $("input[name='title']").val()
							+ '", "nums": "'  + $("input[name='nums']").val()
							+ '", "save": "'  + $("input[name='save']").prop('checked')
							+ '", "pin": "'   + $("input[name='pin']").prop('checked')
							+ '"}',
			dataType:	'json',
			error:		function(){
							console.log("error");
						},
			success:	function(response){
							if(response.status.indexOf('DONUS|OK') >= 0)
							{
								alert('sms sent successfully');
								$('#sms-durum').html(response.durum);
								location.reload();
							}
							else
							alert('error, reload page and try again');
						},
			complete:	function(){
							btn.prop("disabled", false);
						}
		});
	}
});
</script>
@stop