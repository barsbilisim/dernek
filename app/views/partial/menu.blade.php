<header>
		<div class="col-sm-4 logo padding00">
			<div class="col-sm-4 padding00"><img src="/img/logo.png"></div>
			<div class="col-sm-8 kdmk">{{ trans('messages.kdmk') }}</div>
		</div>

<div class="col-sm-8 padding00">
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="navbar-collapse collapse">
      <ul class="nav menu navbar-nav">
        <li><a class="navbar-brand active" href="/">{{ trans('messages.home') }}</a></li>
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
        <li><a href="{{ route('pages.show', 'contacts') }}">{{ trans('messages.media') }}</a></li>
        <li><a href="{{ route('pages.show', 'contacts') }}">{{ trans('messages.contacts') }}</a></li>
      </ul>
    </div>
  </div><!-- /.container-fluid -->
</nav>

<div class="row rowMarginNo login col-sm-12">
		<ul class="navbar-right kdmk-user">
		 <li><a href="http://facebook.com"><span class="glyphicon glyphicon-user"></span> Facebook</a></li>
		 <li><a href="http://facebook.com"><span class="glyphicon glyphicon-user"></span> Twitter</a></li>
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
        <li><a href="/lang/kg" class="lang" title="kg"><img src="/img/kg.gif"></a></li>
		<li><a href="/lang/tr" class="lang" title="tr"><img src="/img/tr.jpg"></a></li>
      </ul>

</div>
</div>
</header>
{{ Form::open(['url' => '/logout', 'id' => 'logoutForm', 'style' => 'display:none']) }}
{{ Form::close() }}