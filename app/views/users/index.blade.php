@section('content')
<div class="tooltip-div">
	@if(Input::get('show'))
	<a href="/users" class="btn btn-lg pull-left" data-placement="right" title="show users"><span class="glyphicon glyphicon-user"></span></a>
	@else
	<a href="/users?show=deleted" class="btn btn-lg pull-left" data-placement="right" title="show deleted users"><span class="glyphicon glyphicon-trash"></span></a>
	@endif
	<a href="{{ route('users.create') }}" class="btn btn-lg pull-right" data-placement="left" title="add user"><span class="glyphicon glyphicon-plus"></span></a>
</div>
<div style="clear:both"></div>

<ul class="nav nav-tabs" style="margin: 10px 0 10px 0">
	<li class="active"><a href="#approved" data-toggle="tab" id="tab-approved">{{ trans("messages.members")}} &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge">{{ count($users) }}</a></li>
	<li><a href="#registered" data-toggle="tab" id="tab-registered">{{ trans("messages.waiting-approval")}} &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge">{{ count($regs) }}</span></a></li>
</ul>

<div class="tab-content">
	<div class="tab-pane active" id="approved">
		@if ($users->count())
			<table class="table">
				<thead>
					<tr>
						<th>email</th>
						<th>phone</th>
						<th>role</th>
						<th style="width:70px"></th>
					</tr>
				</thead>

				<tbody>
					@foreach ($users as $user)
					<tr class="@if($user->active == 0) danger @endif">
						<td style="@if($user->deleted_at != null) text-decoration:line-through @endif"><a href="{{ route('users.show', $user->id) }}">{{{ $user->email }}}</a></td>
						<td>{{{ $user->phone }}}</td>
						<td>
							@foreach($user->roles as $key => $role)
								@if($key != 0) , @endif
								{{{ $role->name }}}
							@endforeach
						</td>
						<td style="text-align:center">
							{{ Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'onsubmit' => 'return confirm("Are you sure?")']) }}
								<button type="submit" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove"></span></button>
							{{ Form::close() }}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		@else
			There are no users
		@endif
	</div>
	<div class="tab-pane" id="registered">
		@if ($regs->count())
			<table class="table">
				<thead>
					<tr>
						<th>email</th>
						<th>phone</th>
						<th>role</th>
						<th style="width:70px"></th>
					</tr>
				</thead>

				<tbody>
					@foreach ($regs as $reg)
					<tr>
						<td style="@if($reg->deleted_at != null) text-decoration:line-through @endif"><a href="{{ route('users.show', $reg->id) }}">{{{ $reg->email }}}</a></td>
						<td>{{{ $reg->phone }}}</td>
						<td>
							@foreach($reg->roles as $key => $role)
								@if($key != 0) , @endif
								{{{ $role->name }}}
							@endforeach
						</td>
						<td style="text-align:center">
							{{ Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $reg->id], 'onsubmit' => 'return confirm("Are you sure?")']) }}
								<button type="submit" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove"></span></button>
							{{ Form::close() }}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		@else
			There are no registered users
		@endif
	</div>
</div>

@stop

@section('script')
<script type="text/javascript">
$(".tooltip-div").tooltip({
	selector: "button, a",
	container: "body"
});

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	if(localStorage) localStorage.user_tab = e.target.id;
	
	// localStorage.clear();
	// console.log(localStorage.user_tab);
});

if(localStorage.user_tab)
	$("#" + localStorage.user_tab).tab("show");
</script>
@stop