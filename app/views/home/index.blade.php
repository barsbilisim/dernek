@section('content')
<div id="myCarousel" class="carousel carousel-fade slide hidden-xs col-sm-8 padding00">
<div class="carousel-inner">
@foreach($slider as $key => $s)
	@if($img = $s->link())@endif
	<div class="item @if($key == 0) active @endif">
		<img src="{{ $img->big }}">
			<div class="container">
				<div class="carousel-caption">
					<h2>{{ $img->desc }}</h2>
				</div>
		</div>
	</div>
@endforeach

</div>
	<a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
	<a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div>

<div class="col-sm-4  padding00">

@if($counter == 2)
		@if($img = $anounce->link())@endif
		<div class="col-sm-12 padding00" style="margin-bottom:12px;">
		<div class="news-box-block small-event">
			<p class="timer blackop" id="defaultCountdown2">{{$anounce->days}} {{ trans('messages.days') }}</p>
			<a href="{{ $img->big }}" class="news-box-link " rel="prettyPhoto[front-page]" title="{{ $img->desc }}">
				 <img class="events-image-small" src="{{ $img->thumb }}">
			</a>
			<p class="text-box blackop">{{ $anounce->title }}</p>
		</div>
		</div>
@endif

@foreach($events as $key => $ev)
	@if($img = $ev->link())@endif
	@if($counter == 3 && $key == 0) 		
		<div class="col-md-12 padding00" style=" padding-left:12px !important;margin-bottom:12px;">
		<div class="news-box-block small-event">
			<p class="timer blackop" id="defaultCountdown2">{{$ev->days}} {{ trans('messages.days') }}</p>
			<a href="{{ $img->big }}" class="news-box-link" rel="prettyPhoto[front-page]" title="{{ $img->desc }}">
				 <img class="events-image-small" src="{{ $img->thumb }}">
			</a>
			<p class="text-box blackop">{{ $ev->title }}</p>
		</div>
		</div> 
	@else
		<div class="col-sm-6 padding00" style="padding-left:12px;">
		<div class="news-box-block small-event">
			<p class="timer blackop" id="defaultCountdown2">{{$ev->days}} {{ trans('messages.days') }}</p>
			<a href="{{ $img->big }}" class="news-box-link" rel="prettyPhoto[front-page]" title="{{ $img->desc }}">
				 <img class="events-image-small" src="{{ $img->thumb }}">
			</a>
			<p class="text-box blackop">{{ $ev->title }}</p>
		</div>
		</div>
	@endif
@endforeach
</div>

<div class="col-sm-8 ds padding00 article">
	@if(count($news) > 0)
	<a href="{{ route('categories.articles.index', 'news')}}">
		<div class="panel panel-primary ">
			<div class="panel-heading header_text">
				<p>{{ trans("messages.news") }}</p>
			</div>
		</div>
	</a>
	<div class="row news-box " id="news-box-block">
			@foreach($news as $n)
				@if($img = $n->link())@endif
						<div class="col-sm-4 col-lg-4 news-box-block" style="position:relative;">
							<div class="thumbnail">
							<a href="{{ $img->big }}" class="news-box-link " rel="prettyPhoto[news]" title="{{ $img->desc }}">
								<img class="news-box-image" src="{{ $img->thumb }}">
							</a>
							<a href="{{ route('categories.articles.show', [$n->category, $n->id]) }}"><p>{{{ $n->title }}}</p></a>
							<p class="thumb_date" style="position:absolute; background: rgba(255,255,255, 0.8); padding:2px 5px; top:8px; right:8px; font-style:italic; color: #888; font-size:12px;">{{ (new DateTime($n->created_at))->format('d M Y') }}</p>
							</div>
						</div>
			@endforeach
	</div>
	<div class="btn btn-primary btn-xs pull-right" id="load-more-news" title="{{ Lang::get('messages.load-more') }}"><span class="glyphicon glyphicon-plus"></span></div>
	<br>
	@endif

	@if(count($ints) > 0)
	<a href="{{ route('categories.articles.index', 'ints')}}">
		<div class="panel panel-primary ">
			<div class="panel-heading header_text">
				<p>{{ trans("messages.interviews") }}</p>
			</div>
		</div>
	</a>
	<div class="row news-box" id="interviews-box-block">
		@foreach($ints as $n)
			@if($img = $n->link())@endif
			<div class="col-sm-4 col-lg-4 news-box-block">
				<div class="thumbnail">
					<a href="{{ $img->big }}" class="news-box-link" rel="prettyPhoto[news]" title="{{ $img->desc }}">
						<img class="news-box-image" src="{{ $img->thumb }}">
					</a>
					<a href="{{ route('categories.articles.show', [$n->category, $n->id]) }}"><p>{{{ $n->title }}}</p></a>
					<p class="thumb_date" style="position:absolute; background: rgba(255,255,255, 0.8); padding:2px 5px; top:8px; right:8px; font-style:italic; color: #888; font-size:12px;">{{ (new DateTime($n->created_at))->format('d M Y') }}</p>
				</div>
			</div>
		@endforeach
	</div>
	<div class="btn btn-primary btn-xs pull-right" id="load-more-ints" title="{{ Lang::get('messages.load-more') }}"><span class="glyphicon glyphicon-plus"></span></div>
	<br>
	@endif

</div>

<div class="col-sm-4 padding-left-12 ds padding00">
		
			<div class="panel panel-primary ">
				<div class="panel-heading header_text">
						<p>{{ Lang::get("messages.video") }}</p>
				</div>
			</div>
		<iframe  src="//www.youtube.com/embed/zDlC70xX8y8?wmode=transparent" wmode="Opaque" frameborder="0" allowfullscreen style="border:none; overflow:hidden; width:368px; height:258px;"></iframe>

		<div class="panel panel-primary ">
			<div class="panel-heading header_text">
					<p>{{ Lang::get("messages.facebook") }}</p>
			</div>
		</div>

		<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FKyrgyzstan.Dostuk.jana.Madaniyat.Koomu&amp;width=368&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:368px; height:258px;" allowTransparency="true"></iframe>
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

/* Declare heights because of positioning of img element */
.carousel .item {
	height: 400px;
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