@section('content')
<div id="myCarousel" data-ride="carousel" class="carousel carousel-fade slide hidden-xs col-sm-12 padding00">
@if($slider->count() > 0)
	<div class="carousel-inner">
	@foreach($slider as $key => $s)
		@if($img = $s->link())@endif
		<div class="item @if($key == 0) active @endif">
			<img src="{{ $img->big }}">
				<div class="container">
					<div class="carousel-caption">
					<h2>{{ $img->desc }}</h2>
						<p><a href="{{ route('categories.articles.show', [$s->category, $s->id]) }}">{{ $s->title }}</a></p>
					</div>
				</div>
		</div>
	@endforeach
	</div>

	<a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
	<a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>

@endif
</div>

<!-- <div class="col-sm-4  padding00">

@foreach($anev as $key => $ev)
	@if($img = $ev->link())@endif
	@if($key == 0) 		
		<div class="col-md-12 padding00" style=" padding-left:12px !important;margin-bottom:12px;">
		<div class="news-box-block small-event">
			<p class="timer blackop" id="defaultCountdown2">{{$ev->days}} {{ trans('messages.days') }}</p>
			<a href="{{ $img->big }}" class="news-box-link" rel="prettyPhoto[front-page]" title="{{ $img->desc }}">
				 <img class="events-image-small" src="{{ $img->thumb }}">
			</a>
			<p class="text-box blackop"><a href="{{ route('categories.articles.show', [$ev->category, $ev->id]) }}">{{ $ev->title }}</p>
		</div>
		</div> 
	@else
		<div class="col-sm-6 padding00" style="padding-left:12px;">
		<div class="news-box-block small-event">
			<p class="timer blackop" id="defaultCountdown2">{{$ev->days}} {{ trans('messages.days') }}</p>
			<a href="{{ $img->big }}" class="news-box-link" rel="prettyPhoto[front-page]" title="{{ $img->desc }}">
				 <img class="events-image-small" src="{{ $img->thumb }}">
			</a>
			<p class="text-box blackop"><a href="{{ route('categories.articles.show', [$ev->category, $ev->id]) }}">{{ $ev->title }}</p>
		</div>
		</div>
	@endif
@endforeach
</div> -->

<div class="col-sm-9 ds padding00 article">

	@if(count($all) > 0)
	<a href="{{ route('categories.articles.index', 'news')}}">
		<div class="panel panel-primary ">
			<div class="panel-heading header_text">
				<p>{{ trans("messages.news") }}</p>
			</div>
		</div>
	</a>
	<div id="time-line"></div>
	<div class="news-box " id="news-box-block">
			@foreach($all as $n)
				@if($img = $n->link())@endif
				@if($n->category =='news') @include('home.categoryView.news') @endif
				@if($n->category =='ints') @include('home.categoryView.ints') @endif
				@if($n->category =='events') @include('home.categoryView.events') @endif
				@if($n->category =='announces') @include('home.categoryView.announces') @endif
			@endforeach
	</div>
	<div class="btn btn-primary btn-xs pull-right" id="load-more-news" title="{{ Lang::get('messages.load-more') }}"><span class="glyphicon glyphicon-plus"></span></div>
	<br>
	@endif
</div>

<div class="col-sm-3 padding-left-12 ds sidebar">
@include('home.sidebarView.sidebar2')
</div>
@stop

@section('style')
{{ HTML::style("css/prettyPhoto/3.1.15/css/prettyPhoto.css") }}
<style type="text/css">
/* CUSTOMIZE THE CAROUSEL Daniiar*/
.events-image-big{width:100%;}
.events-image-small{width:100%;}

/* CUSTOMIZE THE CAROUSEL
-------------------------------------------------- */

/* Carousel base class */
.carousel {
	overflow: hidden;
	height: 376px;
	border: 0px solid #aaa;
}
/* Since positioning the image, we need to help out the caption */
.carousel-caption {
	z-index: 10;
	width: 100%;
	background-color: rgba(0, 0, 0, 0.6);
	left:0px;
	padding:20px;
}

.carousel-caption a {color: #fff; text-decoration: none;}

/* Declare heights because of positioning of img element */
.carousel .item {
	height: 300px;
}

.carousel-inner > .item > img {
	position: absolute;
	top: 0;
	left: 0;
	min-width: 100%;

}

.carousel-fade .item {-webkit-transition: opacity 1s; -moz-transition: opacity 1s; -ms-transition: opacity 1s; -o-transition: opacity 1s; transition: opacity 1s;}
.carousel-fade .active.left {left:0;opacity:0;z-index:2;}
.carousel-fade .next {left:0;opacity:1;z-index:1;}
.carousel-fade .active.right {left:0;opacity:0;z-index:2;}
.carousel-fade .prev {left:0;opacity:1;z-index:1;}

.carousel-control {
	opacity: 0;
	filter: alpha(opacity=0);
}

.carousel-control.left
{
	background-image: none;
}

.carousel-control.right
{
	background-image: none;
}

.carousel-control .icon-prev,
.carousel-control .glyphicon-chevron-left {
	left: 25%;
}

.carousel-control .icon-next,
.carousel-control .glyphicon-chevron-right {
	right: 25%;
}
</style>
@stop

@section('script')
{{ HTML::script("js/prettyPhoto/3.1.15/jquery.prettyPhoto.js") }}
<script type="text/javascript">
$("[rel^='prettyPhoto']").prettyPhoto({
	theme: 'facebook',
	overlay_gallery: false,
	social_tools: ''
});

news = 2;
$("#load-more-news").on("click", function(){
	$.ajax({
			type:		"get",
			url:		'/api/article/loadmore?cat=news&next=' + news++,
			error:		function () { console.log("error"); },
			success:	function (response) {
							if(response.length > 10)
							{
								document.getElementById("news-box-block").innerHTML += response;
							}
							else
							$("#load-more-news").addClass("disabled");
						},
			complete:	function() {
							$("a[rel^='prettyPhoto']").prettyPhoto({
								theme: 'facebook',
								overlay_gallery: false,
								social_tools: ''
							}); 
						}
		});
});

ints = 2;
$("#load-more-ints").on("click", function(){
	$.ajax({
			type:		"get",
			url:		'/api/article/loadmore?cat=ints&next=' + ints++,
			error:		function () { console.log("error"); },
			success:	function (response) {
							if(response.length > 10)
							{
								document.getElementById("interviews-box-block").innerHTML += response;
							}
							else
							$("#load-more-ints").addClass("disabled");
						},
			complete:	function() {
							$("a[rel^='prettyPhoto']").prettyPhoto({
								theme: 'facebook',
								overlay_gallery: false,
								social_tools: ''
							}); 
						}
		});
});
</script>
@stop