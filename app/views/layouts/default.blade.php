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
<link rel="stylesheet" type="text/css" href="/css/default.css">
<link href="css/bootstrap.icon-large.min.css" rel="stylesheet">
@yield('style')
</head>
<body>
<div class="topKdmk"></div>
<div class="container">
<div class="row">
@include('partial.menu')
</div>
<div class="row">
@yield('content')
</div>
</div>
<script src="/js/jquery/2.0.3/jquery.min.js"></script>
<script src="/js/bootstrap/3.0.3/bootstrap.min.js"></script>
@yield('script')
<a href="#" class="btn btn-primary btn-sm" style="z-index:99999;position: fixed; bottom: 0; right: 0; border-radius: 0; border-top-left-radius: 6px;">{{ trans('messages.go-top') }}</a>
@include('partial.footer')
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-47056558-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>