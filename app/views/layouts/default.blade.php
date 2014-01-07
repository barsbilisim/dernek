<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link href="favicon.ico" rel="shortcut icon">
<title>{{ $title }}</title>
{{ HTML::style('css/bootstrap/bootstrap.min.css') }}
{{ HTML::style('css/jquery.countdown.css') }}
{{ HTML::style('css/default.css') }}
@yield("style")
</head>
<body>
<div class="container">
@include('partial.menu')
@yield('content')
</div>
{{ HTML::script('js/jquery-2.0.3.min.js') }}
{{ HTML::script('js/jquery.countdown.min.js') }}
{{ HTML::script('js/bootstrap/bootstrap.min.js') }}
@yield("script")
<a href="#" class="btn btn-primary btn-sm" style="position: fixed; bottom: 0; right: 0; border-radius: 0; border-top-left-radius: 6px;">{{ Lang::get('messages.go-top') }}</a>
<div class="container">
@include('partial.footer')
</div>
</body>
</html>