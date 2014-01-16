@section('content')
@if(User::inRoles(['admin', 'moder']))
<div class="tooltip-div" style="margin-top:20px">
	<div class="pull-left">
		<button type="submit" class="btn btn-primary btn-sm" form="delete-article" title="@if($article->deleted_at == null) {{ trans('messages.delete') }} @else Delete permanently @endif"><span class="glyphicon glyphicon-trash"></span></button> | 
		<a href="{{ route('categories.articles.edit', [$cat, $article->id]) }}" class="btn btn-primary btn-sm" title="{{ trans('messages.edit') }}"><span class="glyphicon glyphicon-pencil"></span></a> |
		<a href="{{ route('articles.images.index', $article->id) }}" class="btn btn-primary btn-sm" title="{{ trans('messages.image-upload') }}"><span class="glyphicon glyphicon-camera"></span></a> |
		<a href="{{ route('categories.articles.create', $cat) }}" class="btn btn-primary btn-sm" title="{{ trans('messages.add-translation') }}"><span class="glyphicon glyphicon-plus"></span></a> |
		<button type="button" class="btn btn-primary btn-sm" id="article-status" title="@if($article->status == 1) {{ trans('messages.unpublish') }} @else {{ trans('messages.publish') }} @endif"><span class="glyphicon @if($article->status == 1) glyphicon-eye-open @else glyphicon-eye-close @endif"></span></button> 

		{{ Form::open(["route" => ["categories.articles.destroy", $cat, $article->id], "method" => "delete", "id" => "delete-article", "onsubmit" => "return confirm('".trans('messages.Are you sure?')."')"]) }}
		{{ Form::close() }}
	</div>
	<a href="{{ route('categories.show', $cat) }}" class="btn btn-primary btn-sm pull-right" data-placement="left" title="return"><span class="glyphicon glyphicon-new-window"></span></a>
</div>
<div style="clear:both"></div>
@endif

<div style="margin-top:30px">
	<h2>{{{ $article->title }}}</h2>
	<p>{{ $article->content }}</p>
	<p>{{{ $article->created_at }}}</p>
</div>

<div class="row">
	@foreach($article->getImages() as $image)
	<a href="{{{ $image->big() }}}" rel="prettyPhoto[front-page]" title="{{{ $image->desc() }}}" class="col-sm-3">
		<img class="img-thumbnail" src="{{{ $image->thumb() }}}">
	</a>
	@endforeach
</div>

<div class="fb-like" data-href="{{ Request::url() }}" data-layout="standard" data-action="like" data-show-faces="true" data-share="true" style="width:100%;"></div>
<div class="fb-comments" data-href="{{ Request::url() }}" data-numposts="10" data-colorscheme="light"></div>
<div id="fb-root"></div>
@stop

@section('style')
{{ HTML::style("css/prettyPhoto/3.1.15/css/prettyPhoto.css") }}
<style type="text/css">
.row {margin-top: 30px; margin-bottom: 30px}
@media (max-width: 767px) {
	.article-details img {margin-bottom: 10px}
}
</style>
@stop

@section('script')
{{ HTML::script("js/prettyPhoto/3.1.15/jquery.prettyPhoto.js") }}
<script type="text/javascript">
$(".tooltip-div").tooltip({
	selector: "button, a",
	container: "body"
});

$("[rel^='prettyPhoto']").prettyPhoto({
	theme: 'facebook',
	overlay_gallery: false,
	social_tools: ''
});

$("#article-status").on("click", function(e){
	e.preventDefault();
	var btn = $(this);
	btn.prop("disabled",true);
	$.ajax({
		type:		'post',
		url:		'/api/article/{{{ $article->id }}}/status',
		headers:	{'X-CSRF-Token': '{{ Session::token() }}'},
		error:		function () { console.log("error"); },
		success:	function (response) {
						if(response == 1)
						{
							btn.attr("title", '{{ trans("messages.unpublish") }}').attr("data-original-title", btn.attr("title"));
							btn.children("span").removeClass("glyphicon-eye-close").addClass("glyphicon-eye-open");
						}
						else
						{
							btn.attr("title", '{{ trans("messages.publish") }}').attr("data-original-title", btn.attr("title"));
							btn.children("span").removeClass("glyphicon-eye-open").addClass("glyphicon-eye-close");
						}
					},
		complete:	function(){ btn.prop("disabled", false); }
	});
});

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=490704797709770";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
@stop
