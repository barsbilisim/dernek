@section('content')
@include('partial.errors')

{{ Form::model($image, ['method' => 'PATCH', 'route' => ['articles.images.update', $art, $image->id], 'role' => 'form', 'class' => 'form-horizontal']) }}
<input type="hidden" name="coords" value="">
<input type="hidden" name="dataUrl" value="">
<input type="text" name="description" value="{{ Input::old('description', $image->desc()) }}" class="form-control" placeholder="description">
<input type="file" name="file" accept="image/*" id="file" class="btn btn-default btn-sm" style="margin: 10px 0;">

<div class="form-group">
	<div class="col-sm-12">
		<button type="submit" class="btn btn-primary">update</button> | 
		<a href="{{ route('articles.images.index', $art) }}" class="btn btn-warning">cancel</a>
	</div>
</div>

{{ Form::close() }}

<div id="img-box">
	<img class="cropbox" src="{{{ $image->big() }}}">
</div>
@stop

@section('style')
{{ HTML::style("css/jcrop/0.9.12/jquery.Jcrop.min.css") }}
<style type="text/css">
.img-preview {height: 300px;}
</style>
@stop

@section('script')
{{ HTML::script("js/jcrop/0.9.12/jquery.Jcrop.min.js") }}
<script type="text/javascript">
$('.cropbox').Jcrop({
	//aspectRatio: 3 / 2,
	minSize: [75,50],
	boxHeight: 300,
	onSelect: updateCoords
	}, function () {
		setCoords(this);
});

function updateCoords(c) {
	$("input[name='coords']").val('{"x": "' + Math.floor(c.x) + '", "y": "' + Math.floor(c.y) + '", "w": "' + Math.floor(c.w) + '", "h": "' + Math.floor(c.h) + '"}');
};

function setCoords(obj) {
	var dim = obj.getBounds();
	obj.setSelect([0, 0, Math.floor(dim[0]), Math.floor(dim[1])]);
};
</script>
@stop