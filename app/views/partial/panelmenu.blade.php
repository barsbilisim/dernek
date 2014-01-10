<div style="position:relative; min-height:22px">
<div class="" style="position: absolute; top: 10px; right: 20px;">
		<a href="/lang/kg" title="kg"><img src="/img/kg.gif" style="border-radius: 2px; width: 27px; height: 18px;"></a> | 
		<a href="/lang/tr" title="tr"><img src="/img/tr.jpg" style="border-radius: 2px; width: 27px; height: 18px;"></a>
</div>
	
</div>
<div class="clear"></div>
<div class="navbar-wrapper">
	<div class="navbar navbar-default" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand active" href="/"><span class="glyphicon glyphicon-home"></span></a>			
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('messages.news') }} <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="{{ route('categories.articles.index', 'news') }}">{{ trans('messages.news') }}</a></li>
						<li><a href="{{ route('categories.articles.index', 'ints') }}">{{ trans('messages.interviews') }}</a></li>
						<li><a href="{{ route('categories.articles.index', 'events') }}">{{ trans('messages.events') }}</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('messages.our-organization') }} <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="{{ route('pages.show', 'projects') }}">{{ trans('messages.projects') }}</a></li>
						<li><a href="{{ route('pages.show', 'business') }}">{{ trans('messages.business') }}</a></li>
						<li><a href="{{ route('pages.show', 'help') }}">{{ trans('messages.help') }}</a></li>
						<li><a href="{{ route('pages.show', 'associates') }}">{{ trans('messages.associates') }}</a></li>
						<li><a href="{{ route('pages.show', 'contacts') }}">{{ trans('messages.contacts') }}</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">ADMIN<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="{{ route('roles.index') }}">Roles</a></li>
						<li><a href="{{ route('users.index') }}">Users</a></li>
						<li><a href="{{ route('pages.index') }}">Pages</a></li>
						<li><a href="{{ route('sms.index') }}">SMS</a></li>
						<li><a href="{{ route('groups.index') }}">Groups</a></li>
						<li><a href="{{ route('categories.index') }}">Categories</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">PAYMENTS<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#">payments</a></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				@if(Auth::check())
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-large"></span> {{{ Auth::user()->email }}} <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="{{ route('users.show', Auth::user()->id) }}"><span class="glyphicon glyphicon-user"></span> &nbsp; profile</a></li>
						<li><a href="#"><span class="glyphicon glyphicon-envelope"></span> &nbsp; message <span class="badge">7</span></a></li>
						<li><a href="/panel"><span class="glyphicon glyphicon-briefcase"></span> &nbsp; settings</a></li>
						<li class="divider"></li>
						<li><a href="javascript:document.getElementById('logoutForm').submit()"><span class="glyphicon glyphicon-off"></span> &nbsp; logout</a></li>
					</ul>
				</li>
				@else
				<li>
					<a href="/login" title="Login"><span class="glyphicon glyphicon-user"></span></a>
				</li>
				@endif
			</ul>
		</div>
	</div>
</div>
{{ Form::open(['url' => '/logout', 'id' => 'logoutForm', 'style' => 'display:none']) }}
{{ Form::close() }}