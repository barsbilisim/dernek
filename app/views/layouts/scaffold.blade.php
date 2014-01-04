<!doctype html>
<html lang="en">
<head>
<title>{{ $title }}</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="/css/bootstrap/3.0.3/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/css/default.css">
<!-- <link rel="stylesheet" type="text/css" href="/css/default.min.css"> -->
@yield('style')
</head>
<body>
<div class="container">
@include('partial.menu')
@yield('content')
</div>
<script src="/js/jquery/2.0.3/jquery.min.js"></script>
<script src="/js/bootstrap/3.0.3/bootstrap.min.js"></script>
@yield('script')
</body>
</html>