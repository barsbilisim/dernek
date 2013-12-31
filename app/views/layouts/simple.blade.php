<!doctype html>
<html lang="en">
<head>
<title>{{ $title }}</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" onerror="this.href='/css/bootstrap/3.0.3/css/bootstrap.min.css'">
<link rel="stylesheet" type="text/css" href="/css/default.css">
<!-- <link rel="stylesheet" type="text/css" href="/css/default.min.css"> -->
@yield('style')
</head>
<body>
@yield('main')
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="/js/jquery/2.0.3/jquery.min.js"><\/script>')</script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script>$.fn.button || document.write('<script src="/js/bootstrap/3.0.3/bootstrap.min.js"><\/script>')</script>
@yield('script')
</body>
</html>