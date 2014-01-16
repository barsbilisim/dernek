@section('content')
@if(User::inRoles(['admin']))
<div class="tooltip-div">
	@if($user->active == 2)
	{{ Form::open(['url' => '/approve/'.$user->id, 'id' => 'approve-user']) }}
	{{ Form::close() }}
	<a href="javascript:document.getElementById('approve-user').submit()" class="btn btn-lg pull-left" data-placement="right" title="approve user"><span class="glyphicon glyphicon-check"></span></a>
	@endif
	<a href="{{ route('users.index') }}" class="btn btn-lg pull-right" data-placement="left" title="return to users"><span class="glyphicon glyphicon-new-window"></span></a>
</div>
<div style="clear:both"></div>
@endif

<div class="row tooltip-div" style="margin-top:10px">
	<div class="col-sm-3 col-xs-5" style="margin-bottom:10px;">
		@if($user->photo != null || $user->photo != "")
			<img class="img-thumbnail img-responsive avatar" src="{{ $user->getPhoto() }}" title="change" onclick="location.href='/users/{{ $user->id }}/edit?part=avatar'">
		@else
			<img class="img-thumbnail img-responsive" src="/img/noimg.png">
		@endif
	</div>

	<div class="col-sm-9 col-xs-12">

		<ul class="nav nav-tabs tooltip-div" style="margin: 0 0 10px 0">
			<li class="active"><a href="#general" data-toggle="tab" id="tab-general" class="btn-default" title="{{ trans('messages.profile') }}"><span class="glyphicon glyphicon-user"></span></a></li>
			<li><a href="#settings" data-toggle="tab" id="tab-settings" class="btn-default" title="{{ trans('messages.settings') }}"><span class="glyphicon glyphicon-briefcase"></span></span></a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="general">
				<table class="table">
					<tr>
						<td style="width:40%">{{ trans('messages.firstname') }}</td>
						<td>{{{ $user->firstname }}}</td>
					</tr>
					<tr>
						<td>{{ trans('messages.lastname') }}</td>
						<td>{{{ $user->lastname }}}</td>
					</tr>
					<tr>
						<td>{{ trans('messages.gsm') }}</td>
						<td>{{{ $user->phone }}}</td>
					</tr>
					<tr>
						<td>{{ trans('messages.passport') }}</td>
						<td>{{{ $user->passport }}}</td>
					</tr>
					<tr>
						<td>{{ trans('messages.birth_date') }}</td>
						<td>{{{ $date }}}</td>
					</tr>
					<tr>
						<td>{{ trans('messages.marital_status') }}</td>
						<td>{{ trans('messages.'.$user->marital_status) }}</td>
					</tr>
					<tr>
						<td>{{ trans('messages.occupation_title') }}</td>
						<td>{{{ $user->occupation }}}</td>
					</tr>
					<tr>
						<td>{{ trans('messages.company_general_description') }}</td>
						<td>{{{ $user->company }}}</td>
					</tr>
					<tr>
						<td>{{ trans('messages.bachelors_degree_university') }}</td>
						<td>{{{ $user->bachelor }}}</td>
					</tr>
					<tr>
						<td>{{ trans('messages.master_degree_university') }}</td>
						<td>{{{ $user->master }}}</td>
					</tr>
					<tr>
						<td>{{ trans('messages.phd_degree_university') }}</td>
						<td>{{{ $user->phd }}}</td>
					</tr>
				</table>
				<a href="/users/{{ $user->id }}/edit?part=profile" class="btn btn-primary btn-xs" data-placement="right" title="{{ trans('messages.edit') }}">{{ trans('messages.edit') }}</a>
			</div>
			<div class="tab-pane" id="settings">
				<table class="table">
					<tr style="width:40%">
						<td>{{ trans('messages.email') }}</td>
						<td>{{{ $user->email }}}</td>
					</tr>
					@if(User::inRoles(['admin']))
					<tr>
						<td>{{ trans('messages.roles') }}</td>
						<td>
							@foreach($user->roles as $key => $role)
								@if($key != 0) , @endif
								{{{ $role->name }}}
							@endforeach
						</td>
					</tr>
					@endif
					@if($user->deleted_at != null)
					<tr>
						<td>{{ trans('messages.deleted at') }}</td>
						<td>{{{ (new Datetime($user->deleted_at))->format('d M Y') }}}</td>
					</tr>
					@endif
					<tr>
						<td>{{ trans('messages.password') }}</td>
						<td> ********* </td>
					</tr>
				</table>
				<a href="/users/{{ $user->id }}/edit?part=settings" class="btn btn-primary btn-xs" data-placement="right" title="{{ trans('messages.edit') }}">{{ trans('messages.edit') }}</a>
			</div>
		</div>
	</div> <!-- col-sm8 end -->
</div> <!-- row end -->
@stop

@section('style')
<style type="text/css">
.avatar:hover {opacity: 0.4; text-decoration: none; cursor: pointer;}
</style>
@stop

@section('script')
<script type="text/javascript">
$(".tooltip-div").tooltip({
	selector: "button, a, img",
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