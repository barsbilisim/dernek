@section('content')
@include('partial.errors')

{{ Form::model($page, ['method' => 'PATCH', 'route' => ['pages.update', $page->id]]) }}
<div class="form-group" style="display:inline-block; min-width:88%">
	{{ Form::text('name', Input::old('name', $page->name), ['class' => 'form-control']) }}
</div>
<div class="form-group" style="display:inline-block; max-width:12%; float:right">
	{{ Form::select('lang', $lang, Input::old('lang', $page->lang), ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::textarea('content', Input::old('content', $page->content), ['class' => 'form-control ckeditor']) }}
</div>
<div class="form-group">
	<input type="checkbox" name="deleted" style="vertical-align:middle; margin-top:0" value="1" @if($page->deleted_at != null) checked="checked" @endif>
	<label for="save">deleted</label>
</div>
<div class="form-group">
	<button type="submit" class="btn btn-primary">update</button> |
	<a href="{{ route('pages.show', $page->name) }}" class="btn btn-warning">cancel</a>
</div>
{{ Form::close() }}

@stop

@section('script')
{{ HTML::script('js/ckeditor/4.3.1/ckeditor.js') }}
@stop