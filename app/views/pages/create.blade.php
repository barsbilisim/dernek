@section('content')
@include('partial.errors')

{{ Form::open(['route' => 'pages.store', "role" => "form", "class" => "form-horizontal"]) }}
<div class="form-group">
	<p class="col-sm-9">
		{{ Form::text('name', Input::old('name'), ["class" => "form-control"]) }}
	</p>
	<p class="col-sm-3">
		{{ Form::select("lang", $lang, Input::old("lang"), [ "class" => "form-control"]) }}
	</p>
</div>
<div class="form-group">
	<p class="col-sm-12">
		{{ Form::textarea('content', Input::old('content'), ["class" => "form-control ckeditor"]) }}
	</p>
</div>
<div class="form-group">
	<p class="col-sm-12">
		<button type="submit" class="btn btn-primary">create</button> |
		<a href="{{ route('pages.index') }}" class="btn btn-warning">cancel</a>
	</p>
</div>
{{ Form::close() }}

@stop

@section('script')
	{{ HTML::script('js/ckeditor/4.3.1/ckeditor.js') }}
@stop