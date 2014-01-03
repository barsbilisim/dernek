@section('content')
<div class="tooltip-div">
	<a href="{{ route('articles.images.create', $art) }}" class="btn btn-lg pull-left" data-placement="right" title="add image"><span class="glyphicon glyphicon-plus"></a>
	<a href="{{ route('articles.images.index', $art) }}" class="btn btn-lg pull-right" data-placement="left" title="back"><span class="glyphicon glyphicon-share"></span></a>
</div>
<div style="clear:both"><br></div>

<a href="{{{ $image->big() }}}" rel="prettyPhoto" id="title-{{{ $image->id }}}" title="{{{ $image->desc() }}}">
	<img src="{{{ $image->thumb() }}}" class="img-responsive img-thumbnail image-list @if($image->main == 1) main-image @endif @if($image->status == 0) unpublished-image @endif">
</a>
<div image="{{{ $image->id }}}" class="tooltip-div image-btns">
	<button type="submit" class="btn btn-primary btn-sm" form="delete-form-{{{ $image->id }}}" title="{{ trans('messages.delete') }}"><span class="glyphicon glyphicon-trash"></span></button> |
	<a href="{{ route('articles.images.edit', [$art, $image->id]) }}" class="btn btn-primary btn-sm" title="{{ trans('messages.edit') }}"><span class="glyphicon glyphicon-camera"></a> |
	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-{{ $image->id }}" title="{{ trans('messages.description') }}"><span class="glyphicon glyphicon-th-list"></button> |
	<button type="button" class="btn btn-primary btn-sm set-main-image"
			title="@if($image->main == 0){{ trans('messages.set-as-main-image') }}@else{{ trans('messages.remove-main-image') }}@endif">
			<span class="glyphicon @if($image->main == 0) glyphicon-pushpin @else glyphicon-star @endif"></button> |
	<button type="button" class="btn btn-primary btn-sm set-image-status"
			title="@if($image->status == 1) {{ trans('messages.unpublish') }} @else {{ trans('messages.publish') }} @endif">
			<span class="glyphicon @if($image->status == 1) glyphicon-eye-open @else glyphicon-eye-close @endif"></span></button> 
</div>

{{ Form::open(['route' => ['articles.images.destroy', $image->article_id, $image->id], 'style' => 'display: hidden', 'method' => 'DELETE', 'id' => 'delete-form-'.$image->id, 'onsubmit' => "return confirm('".trans('messages.Are you sure?')."')"]) }}
{{ Form::close() }}

<div class="modal" id="modal-{{{ $image->id }}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">image description</h4>
			</div>
			<div class="modal-body">
				{{ Form::open(['id' => $image->id]) }}
					<textarea name="desc" class="form-control">{{{ $image->desc() }}}</textarea>
				{{ Form::close() }}
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" form="{{ $image->id }}">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@stop

@section('style')
{{ HTML::style("css/prettyPhoto/3.1.15/css/prettyPhoto.css") }}
<style type="text/css">
.image-btns {margin: 20px auto 40px auto;}
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