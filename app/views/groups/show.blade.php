@section('content')
<div class="tooltip-div">
	<a href="{{ route('groups.index') }}" class="btn btn-lg pull-right" data-placement="left" title="return to groups"><span class="glyphicon glyphicon-new-window"></span></a>
</div>
<div style="clear:both"></div>

<table class="table">
	<thead>
		<tr>
			<th>name</th>
			<th>users</th>
			<th style="width:70px"></th>
			<th style="width:70px"></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>{{{ $group->name }}}</td>
			<td>{{{ $group->users()->withTrashed()->count() }}}</td>
			<td style="text-align:center"><a href="{{ route('groups.edit', $group->id) }}" class="btn btn-primary">edit</a></td>
			<td style="text-align:center">
				{{ Form::open(['method' => 'DELETE', 'route' => ['groups.destroy', $group->id], 'onsubmit' => 'return confirm("Are you sure?")']) }}
					<button type="submit" class="btn btn-danger">delete</button>
				{{ Form::close() }}
			</td>
		</tr>
	</tbody>
</table>

<hr>

<div id="user-group"></div>
@stop

@section('script')
<script type="text/javascript">
$(".tooltip-div").tooltip({
	selector: "button, a",
	container: "body"
});

$('#user-group').load('/api/group/{{{ $group->id }}}');

$("#user-group").on("click", "button.delete-user", function(){
	if(confirm('{{ trans("messages.Are you sure?") }}'))
	{	
		var btn = $(this);
		btn.prop("disabled",true);
		$.ajax({
			type:		'post',
			url:		'/api/group/{{{ $group->id }}}/user/' + btn.attr('user-id') + '/delete',
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