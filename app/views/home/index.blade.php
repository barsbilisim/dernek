
@section('content')

<div id="myCarousel" class="carousel carousel-fade slide hidden-xs col-sm-8">
<div class="carousel-inner">
@foreach($news as $key => $s)
@if($img = $s->link())@endif
<div class="item @if($key == 0) active @endif">
<img src="{{ $img->big }}">
<div class="container">
<div class="carousel-caption">
<h1>{{ $img->desc }}</h1>
</div>
</div>
</div>
@endforeach

</div>
<a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
<a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div>

<div class="col-sm-4 padding-left-12">

@if($counter == 2)
		@if($img = $anounce->link())@endif
		<div class="col-sm-12" style="margin-bottom:12px;">
		<div class="news-box-block small-event">
			<p class="timer blackop" id="defaultCountdown2">{{$anounce->days}} {{ trans('messages.days') }}</p>
			<a href="{{ $img->thumb }}" class="news-box-link " rel="prettyPhoto[front-page]" title="{{ $img->desc }}">
				 <img class="events-image-small" src="{{ $img->thumb }}">
			</a>
			<p class="text-box blackop">{{ $anounce->title }}</p>
		</div>
		</div>
@endif

@foreach($events as $key => $ev)
@if($img = $ev->link())@endif
 @if($counter == 3 && $key == 0) 		
 		<div class="col-md-12" style=" margin-bottom:12px;">
		<div class="news-box-block small-event">
			<p class="timer blackop" id="defaultCountdown2">{{$ev->days}} {{ trans('messages.days') }}</p>
			<a href="{{ $img->thumb }}" class="news-box-link" rel="prettyPhoto[front-page]" title="{{ $img->desc }}">
				 <img class="events-image-small" src="{{ $img->thumb }}">
			</a>
			<p class="text-box blackop">{{ $ev->title }}</p>
		</div>
		</div> 

		@else
		
		<div class="col-sm-6" style="padding-right:6px">
		<div class="news-box-block small-event">
			<p class="timer blackop" id="defaultCountdown2">{{$ev->days}} {{ trans('messages.days') }}</p>
			<a href="{{ $img->thumb }}" class="news-box-link" rel="prettyPhoto[front-page]" title="{{ $img->desc }}">
				 <img class="events-image-small" src="{{ $img->thumb }}">
			</a>
			<p class="text-box blackop">{{ $ev->title }}</p>
		</div>
		</div>
 @endif
@endforeach





</div>



<div class="col-sm-8">
	@if(count($news) > 0)
		<a href="/news">
			<div class="panel panel-primary ">
				<div class="panel-heading header_text">
					<p>{{ trans("messages.news") }}</p>
				</div>
			</div>
		</a>
	<div class="row news-box " id="news-box-block">
			@foreach($news as $n)
				@if($img = $n->link())@endif
						<div class="col-sm-4 col-lg-4 news-box-block">
							<div class="thumbnail">
							<a href="{{ $img->big }}" class="news-box-link " rel="prettyPhoto[news]" title="{{ $img->desc }}">
								<img class="news-box-image" src="{{ $img->thumb }}">
							</a>
							<p class="thumb_date">{{$n->created_at}}</p>
							<p>{{$n->title}}</p>
							</div>
						</div>
			@endforeach
	</div>
	@endif

	@if(count($ints) > 0)
		<a href="/news">
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
							<p class="thumb_date">{{$n->created_at}}</p>
							<p>{{$n->title}}</p>
							</div>
						</div>
			@endforeach
		</div>
	@endif

</div>

<div class="col-sm-4 padding-left-12">
		
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
