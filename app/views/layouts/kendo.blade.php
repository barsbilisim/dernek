<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link href="favicon.ico" rel="shortcut icon">
<title>{{ $title }}</title>
<link rel="stylesheet" href="/css/bootstrap/3.0.3/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/css/kendoui/2013.3.1119/kendo.common.min.css">
<link rel="stylesheet" type="text/css" href="/css/kendoui/2013.3.1119/kendo.silver.min.css">
<link rel="stylesheet" type="text/css" href="/css/default.css">
<link rel="stylesheet" type="text/css" href="/css/panel.css">
@yield('style')
</head>
<body>
<div class="container">
@include('partial.panelmenu')
@yield('content')
</div>
<script src="/js/jquery/2.0.3/jquery.min.js"></script>
<script src="/js/bootstrap/3.0.3/bootstrap.min.js"></script>
<script src="/js/kendoui/2013.3.1119/kendo.web.min.js"></script>
@yield('script')
</body>
</html>