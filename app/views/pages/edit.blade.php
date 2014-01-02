@section('content')

@include('partial.errors')

{{ Form::model($page, ['method' => 'PATCH', 'route' => ['pages.update', $page->id]]) }}
<div class="form-group">
	<p class="col-sm-9">
		{{ Form::text('name', Input::old('name', $page->name), ['class' => 'form-control']) }}
	</p>
	<p class="col-sm-3">
		{{ Form::select('lang', $lang, Input::old('lang', $page->lang), ['class' => 'form-control']) }}
	</p>
</div>
<div class="form-group">
	<p class="col-sm-12">
		{{ Form::textarea('content', Input::old('content', $page->content), ['class' => 'form-control ckeditor']) }}
	</p>
</div>
<div class="form-group">
	<p class="col-sm-12">
	    <button type="submit" class="btn btn-primary">update</button> |
		<a href="{{ route('pages.show', $page->name) }}" class="btn btn-warning">cancel</a>
	</p>
</div>
{{ Form::close() }}

@stop

@section('script')
    {{ HTML::script('js/ckeditor/4.3.1/ckeditor.js') }}
@stop