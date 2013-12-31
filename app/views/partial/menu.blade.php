<div class="navbar-wrapper">
	<div style="text-align: center; position: relative; height: 40px;">
		<div class="" style="position: absolute; top: 10px; right: 20px;">
				<a href="/lang/kg" title="kg"><img src="/img/kg.gif" style="border-radius: 2px; width: 27px; height: 18px;"></a> | 
				<a href="/lang/tr" title="tr"><img src="/img/tr.jpg" style="border-radius: 2px; width: 27px; height: 18px;"></a>
		</div>
	</div>

	<div class="navbar navbar-inverse" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/"><span class="glyphicon glyphicon-home"></span></a>
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
						<li><a href="/pages/projects">{{ trans('messages.projects') }}</a></li>
						<li><a href="/pages/business">{{ trans('messages.business') }}</a></li>
						<li><a href="/pages/help">{{ trans('messages.help') }}</a></li>
						<li><a href="/pages/associates">{{ trans('messages.associates') }}</a></li>
					</ul>
				</li>
				<li><a href="/pages/contacts">{{ trans('messages.contacts') }}</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				@if(Auth::check())
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> {{ Auth::user()->email }} <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="/users/{{{ Auth::user()->id }}}">profile</a></li>
						<li><a href="/user/password/{{{ Auth::user()->id }}}">password</a></li>
						<li><a href="/user/details/{{{ Auth::user()->id }}}">message</a></li>
						<li class="divider"></li>
						<li><a href="javascript:document.getElementById('logoutForm').submit()">logout</a></li>
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