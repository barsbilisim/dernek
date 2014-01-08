<div class="col-sm-12" style="position:relative;height:100px;">
	<div class="col-sm-2"><img  style="width:100px;"src="/img/logo.png"></div>
	<div class="col-sm-10 headertext"><p>КЫРГЫЗСТАН ДОСТУК ЖАНА МАДАНИЯТ КООМУ<p></div>
	

<div class="" style="position: absolute; top: 10px; right: 20px;z-index:99999;">
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
			
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a class="navbar-brand" href="/">{{ trans('messages.home') }}</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('messages.news') }} <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="{{ route('categories.articles.index', 'news') }}">{{ trans('messages.news') }}</a></li>
						<li><a href="{{ route('categories.articles.index', 'ints') }}">{{ trans('messages.interviews') }}</a></li>
						<li><a href="{{ route('categories.articles.index', 'events') }}">{{ trans('messages.events') }}</a></li>
						@if(Auth::check() && Auth::user()->inRoles(['admin']))
						<li><a href="{{ route('categories.articles.create', 'news') }}">create</a></li>
						<li><a href="/panel/articles">articles</a></li>
						@endif
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('messages.our-organization') }} <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="{{ route('pages.show', 'projects') }}">{{ trans('messages.projects') }}</a></li>
						<li><a href="{{ route('pages.show', 'business') }}">{{ trans('messages.business') }}</a></li>
						<li><a href="{{ route('pages.show', 'help') }}">{{ trans('messages.help') }}</a></li>
						<li><a href="{{ route('pages.show', 'associates') }}">{{ trans('messages.associates') }}</a></li>
						@if(Auth::check() && Auth::user()->inRoles(['admin']))
						<li><a href="{{ route('pages.index') }}">pages</a></li>
						@endif
					</ul>
				</li>
				<li><a href="/pages/contacts">{{ trans('messages.contacts') }}</a></li>
				@if(Auth::check() && Auth::user()->inRoles(['admin']))
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">SMS<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="{{ route('sms.index') }}">SMS</a></li>
					</ul>
				</li>
				@endif
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