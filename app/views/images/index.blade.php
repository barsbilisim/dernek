@section('content')
<div class="tooltip-div" style="position:relative">
	<h3><a href="{{ route('categories.articles.show', [$article->category->name, $article->id]) }}" class="format-link">{{{ $article->detail()->title }}}</a></h3>
	<a href="{{ route('articles.images.create', $article->id) }}" class="btn btn-lg create-link" data-placement="left" title="new image"><span class="glyphicon glyphicon-plus"></span></a>
</div>
@if ($images->count())
<div class="row">
	@foreach($images as $img)
	<div class="col-sm-6 col-md-4 col-lg-3">
		<a href="{{{ $img->big }}}" rel="prettyPhoto" id="title-{{ $img->id }}" title="{{{ $img[Config::get('app.locale')] }}}">
			<img src="{{{ $img->thumb }}}" class="img-responsive img-thumbnail image-list @if($img->main == 1) main-image @endif @if($img->status == 0) unpublished-image @endif">
		</a>
		<div image="{{{ $img->id }}}" class="tooltip-div image-btns">
			<button type="button" class="btn btn-primary btn-sm delete-image-btn" title="{{ trans('messages.delete') }}"><span class="glyphicon glyphicon-trash"></span></button> |
			<a href="{{ route('articles.images.edit', [$article->id, $img->id]) }}" class="btn btn-primary btn-sm" title="{{ trans('messages.edit') }}"><span class="glyphicon glyphicon-camera"></a> |
			<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-{{ $img->id }}" title="{{ trans('messages.description') }}"><span class="glyphicon glyphicon-th-list"></button> |
			<button type="button" class="btn btn-primary btn-sm set-main-image"
					title="@if($img->main == 0){{ trans('messages.set-as-main-image') }}@else{{ trans('messages.remove-main-image') }}@endif">
					<span class="glyphicon @if($img->main == 0) glyphicon-pushpin @else glyphicon-star @endif"></button> |
			<button type="button" class="btn btn-primary btn-sm set-image-status"
					title="@if($img->status == 1) {{ trans('messages.unpublish') }} @else {{ trans('messages.publish') }} @endif">
					<span class="glyphicon @if($img->status == 1) glyphicon-eye-open @else glyphicon-eye-close @endif"></span></button> 
		</div>
	</div>

	<div class="modal" id="modal-{{ $img->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">image description</h4>
				</div>
				<div class="modal-body">
					{{ Form::open(['id' => $img->id]) }}
						<textarea name="desc" class="form-control">{{ $img[Config::get('app.locale')] }}</textarea>
					{{ Form::close() }}
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" form="{{ $img->id }}">Save</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</div>
@else
	There are no images
@endif
@stop

@section('style')
{{ HTML::style("css/prettyPhoto/3.1.15/css/prettyPhoto.css") }}
<style type="text/css">
.row {margin-top:20px; margin-bottom: 20px}
.image-btns {margin: 20px auto 40px auto;}
.create-link {position: absolute; top: -10px; right: 0;}
.format-link {color:inherit;}
.main-image { border:1px solid red }
.unpublished-image { opacity: 0.4; }
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

$(".modal form").on("submit", function(e){
	e.preventDefault();
	var desc = $(this).find("textarea[name='desc']").val(),
	id   = $(this).attr('id');
	$.ajax({
		type:		'post',
		url:		'/api/image/' + id + '/desc',
		headers:	{'X-CSRF-Token': '{{ Session::token() }}'},
		data:		'{"desc": "' + desc + '"}',
		dataType:	"json",
		error:		function () { console.log("error"); },
		success:	function (response) {
						if(response == "success")
							$("#title-" + id).attr("title", desc)
						else
							location.reload();

						$('.modal').modal('hide');
					},
		complete:	function(){ }
	});
});

$(".set-image-status").on("click", function(e){
	e.preventDefault();
	var btn = $(this),
	id  = btn.parent().attr('image');
	btn.prop("disabled",true);
	$.ajax({
		type:		'post',
		url:		'/api/image/' + id + '/status',
		headers:	{'X-CSRF-Token': '{{ Session::token() }}'},
		error:		function () { console.log("error"); },
		success:	function (response) {
						if(response == 1)
						{
							$('#title-' + id).find('img').removeClass('unpublished-image');
							btn.attr("title", '{{ trans("messages.unpublish") }}');
							btn.attr("data-original-title", btn.attr("title"));
							btn.children("span").removeClass("glyphicon-eye-close").addClass("glyphicon-eye-open")
						}
						else
						{
							$('#title-' + id).find('img').addClass('unpublished-image');
							btn.attr("title", '{{ trans("messages.publish") }}');
							btn.attr("data-original-title", btn.attr("title"));
							btn.children("span").removeClass("glyphicon-eye-open").addClass("glyphicon-eye-close");
						}
					},
		complete:	function(){ btn.prop("disabled", false); }
	});
});

$(".set-main-image").on("click", function(){
	var btn = $(this),
	id = btn.parent().attr("image");
	btn.prop("disabled",true);
	$.ajax({
		type:		'post',
		url:		'/api/image/' + id + '/main',
		headers:	{'X-CSRF-Token': '{{ Session::token() }}'},
		error:		function () { console.log("error"); },
		success:	function (response) {
						if(response == 0)
						{
							$("#title-" + id).find('img').removeClass("main-image");
							btn.attr("title", '{{ trans("messages.set-as-main-image") }}');
							btn.attr("data-original-title", btn.attr("title"));
							btn.children("span").removeClass("glyphicon-star").addClass("glyphicon-pushpin");
						}
						else
						{
							$("#title-" + id).find('img').addClass("main-image");
							btn.attr("title", '{{ trans("messages.remove-main-image") }}');
							btn.attr("data-original-title", btn.attr("title"));
							btn.children("span").removeClass("glyphicon-pushpin").addClass("glyphicon-star");
						}

					},
		complete:	function(){ btn.prop("disabled", false); }
	});
});
</script>
@stop