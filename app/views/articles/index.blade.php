@section('content')

@if ($articles->count())
<div class="article">
@foreach($articles as $key => $art)
@if($img = $art->link())@endif
<hr class="featurette-divider" @if($key == 0) style="display:none" @endif>
<div class="row featurette">
	@if($key % 2)
	<div class="col-md-5" style="margin-right: -5px; text-align: center">
		<a href="{{{ $img->big }}}" rel="prettyPhoto[front-page]" title="{{{ $img->desc }}}">
			<img class="img-responsive visible-md visible-lg img-thumbnail" src="{{{ $img->thumb }}}">
		</a>
	</div>
	<div class="col-md-7">
		<h2 class="featurette-heading"><a href="/categories/{{{ $cat }}}/articles/{{{ $art->id }}}" class="news-box-content">{{{ $art->title }}}</a></h2>
		<p class="lead">@if($art->desc == ""){{ $art->content }} @else {{ $art->desc }} @endif</p>
	</div>
	@else
	<div class="col-md-7">
		<h2 class="featurette-heading"><a href="/categories/{{{ $cat }}}/articles/{{{ $art->id }}}" class="news-box-content">{{{ $art->title }}}</a></h2>
		<p>@if($art->desc == ""){{ $art->content }} @else {{ $art->desc }} @endif</p>
	</div>
	<div class="col-md-5" style="margin-left: -5px; text-align: center">
		<a href="{{{ $img->big }}}" rel="prettyPhoto[front-page]" title="{{{ $img->desc }}}">
			<img class="img-responsive visible-md visible-lg img-thumbnail" src="{{{ $img->thumb }}}">
		</a>
	</div>
	@endif
</div>
@endforeach

<div style="text-align: center;">
	{{ $articles->links() }}
</div>

</div>
@else
	There are no articles
@endif

@stop

@section('style')
{{ HTML::style("css/prettyPhoto/3.1.15/css/prettyPhoto.css") }}
<style type="text/css">
.featurette-divider { margin: 5px 0; border-color:#ddd; }
.featurette-heading { line-height: 1; letter-spacing: -1px; }

@media (min-width: 992px) {
	.featurette-divider { margin: 60px 0; border-color:#ddd; }
	.featurette-heading { font-size: 30px; }
	.featurette div { float: none; display: inline-block; vertical-align: middle; }
	.featurette img {width: 100%;}
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
</script>
@stop