@section('content')
@include('partial.errors')

{{ Form::open(['route' => ['articles.images.store', $art], 'role' => 'form', 'class' => 'form-horizontal']) }}
<input type="hidden" name="dataUrl" value="">
<input type="hidden" name="srcUrl" value="">
<input type="hidden" name="coords" value="">
<input type="text" name="description" value="{{ Input::old('description') }}" class="form-control" placeholder="description">
<input type="file" name="file" accept="image/*" id="file" class="btn btn-default btn-sm" style="margin: 10px 0;">

<div class="form-group">
	<div class="col-sm-12">
		<button type="submit" class="btn btn-primary">create</button> | 
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUrl">url</button> | 
		<a href="{{ route('articles.images.index', $art) }}" class="btn btn-warning">cancel</a>
	</div>
</div>
{{ Form::close() }}

<div id="img-box"></div>

<div class="modal" id="modalUrl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">image url</h4>
			</div>
			<div class="modal-body">
				<input type="text" name="url" placeholder="url" class="form-control">
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" id="url-crop">Crop</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

@stop

@section('style')
{{ HTML::style("css/jcrop/0.9.12/jquery.Jcrop.min.css") }}
@stop

@section('script')
{{ HTML::script("js/jcrop/0.9.12/jquery.Jcrop.min.js") }}
<script type="text/javascript">
$("#file").on("change", function(){
	var file   = this.files[0];
	var reader = new FileReader();
	reader.readAsDataURL(file);		
	reader.onload = function(){
		$("#img-box").html('<img class="cropbox" src="' + reader.result + '">');
		$("input[name='dataUrl']").val(reader.result.substring(reader.result.indexOf(";base64,") + 8));
		initJcrop();
	}
});

function initJcrop(){
	$('.cropbox').Jcrop({
	aspectRatio: 3 / 2,
	minSize: [75,50],
	boxHeight: 300,
	onSelect: updateCoords
	}, function () {
		setCoords(this);
	});
}

function updateCoords(c) {
	$("input[name='coords']").val('{"x": "' + Math.floor(c.x) + '", "y": "' + Math.floor(c.y) + '", "w": "' + Math.floor(c.w) + '", "h": "' + Math.floor(c.h) + '"}');
};

function setCoords(obj) {
	var dim = obj.getBounds();
	obj.setSelect([0, 0, Math.floor(dim[0]), Math.floor(dim[1])]);
};

$("#url-crop").on("click", function(e){
	e.preventDefault();
	var url = $("#modalUrl input[type='text']").val();
	$("#img-box").html('<img class="cropbox" src="' + url + '">');
	$("input[name='srcUrl']").val(url);
	initJcrop();
	$(".modal").modal('hide')
});
</script>
@stop