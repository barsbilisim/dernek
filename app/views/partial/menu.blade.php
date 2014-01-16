<div class="col-sm-12 hidden-xs" style="position:relative;height:100px;">
	<div class="col-sm-2 "><img  style="width:100px;"src="/img/logo.png"></div>
	<div class="col-sm-10 headertext"><p>КЫРГЫЗСТАН ДОСТУК ЖАНА МАДАНИЯТ КООМУ<p></div>
	

<!-- <div class="" style="position: absolute; top: 0; right: 0;z-index:99999;">
		<a href="/lang/kg" title="kg"><img src="/img/kg.gif" style="border-radius: 2px; width: 27px; height: 18px;"></a>
		<a href="/lang/tr" title="tr"><img src="/img/tr.jpg" style="border-radius: 2px; width: 27px; height: 18px;"></a>
</div> -->
	
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
			<a class="navbar-brand active" href="/">{{ trans('messages.home') }}</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('messages.news') }}<b class="caret" style="margin-top:-4px"></b></a>
					<ul class="dropdown-menu">
						<li><a href="{{ route('categories.articles.index', 'news') }}">{{ trans('messages.news') }}</a></li>
						<li><a href="{{ route('categories.articles.index', 'ints') }}">{{ trans('messages.interviews') }}</a></li>
						<li><a href="{{ route('categories.articles.index', 'events') }}">{{ trans('messages.events') }}</a></li>
						@if(User::inRoles(['moder', 'admin']))
							<li><a href="{{ route('categories.articles.create', 'news') }}">ADD ARTICLE</a></li>
							<li><a href="{{ route('categories.index') }}">CATEGORIES</a></li>
						@endif
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('messages.our-organization') }}<b class="caret" style="margin-top:-4px"></b></a>
					<ul class="dropdown-menu">
						<li><a href="{{ route('pages.show', 'projects') }}">{{ trans('messages.projects') }}</a></li>
						<li><a href="{{ route('pages.show', 'business') }}">{{ trans('messages.business') }}</a></li>
						<li><a href="{{ route('pages.show', 'help') }}">{{ trans('messages.help') }}</a></li>
						<li><a href="{{ route('pages.show', 'associates') }}">{{ trans('messages.associates') }}</a></li>
					</ul>
				</li>
				<li><a href="{{ route('pages.show', 'contacts') }}">{{ trans('messages.contacts') }}</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				@if(Auth::check())
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{{ Auth::user()->firstname }}} {{{ Auth::user()->lastname }}}<b class="caret" style="margin-top:-4px"></b></a>
					<ul class="dropdown-menu">
						<li><a href="{{ route('users.show', Auth::user()->id) }}"><span class="glyphicon glyphicon-user"></span> &nbsp; profile</a></li>
						<li><a href="#"><span class="glyphicon glyphicon-envelope"></span> &nbsp; message <span class="badge">0</span></a></li>
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