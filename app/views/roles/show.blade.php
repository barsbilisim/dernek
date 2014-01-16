@section('content')
<a href="{{ route('roles.index') }}" class="btn btn-lg pull-right" title="return to all roles"><span class="glyphicon glyphicon-new-window"></span></a>

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
			<td>{{{ $role->name }}}</td>
			<td>{{{ $role->users()->withTrashed()->count() }}}</td>
			<td style="text-align:center"><a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary">edit</a></td>
			<td style="text-align:center">
				{{ Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'onsubmit' => 'return confirm("Are you sure?")']) }}
					<button type="submit" class="btn btn-danger">delete</button>
				{{ Form::close() }}
			</td>
		</tr>
	</tbody>
</table>

<div id="user-role"></div>
@stop

@section('script')
<script type="text/javascript">
$(".tooltip-div").tooltip({
	selector: "button, a",
	container: "body"
});

$('#user-role').load('/api/role/{{{ $role->id }}}');

$("#user-role").on("click", "button.delete-user", function(){
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