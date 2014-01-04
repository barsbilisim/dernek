@section('content')
@include('partial.errors')

{{ Form::model($article, ['method' => 'PATCH', 'route' => ['categories.articles.update', $cat, $article->id], 'class' => 'form-horizontal', 'role' => 'form']) }}

	<div class="form-group">
		<p class="col-sm-2">
			{{ Form::text('lang', trans('messages.'.$article->lang), ['class' => 'form-control', 'readonly' => true]) }}
		</p>
		<p class="col-sm-2">
			{{ Form::select('category', $category, Input::old('category', $article->cat_id), ['class' => 'form-control']) }}
		</p>
	
		<p class="col-sm-2">
			{{ Form::checkbox('slider', 1, Input::old('slider', $article->slider)) }}
			{{ Form::label('slider', 'slider', ['class' => 'control-label']) }}
		</p>

		<p class="col-sm-2">
			{{ Form::checkbox('anounce', 1, Input::old('anounce', $article->anounce)) }}
			{{ Form::label('anounce', 'anounce', ['class' => 'control-label']) }}
		</p>

		<p class="col-sm-3">
			{{ Form::text('date', null, ['id' => 'date', 'class' => 'form-control', 'readonly' => true ]) }}
			{{ Form::hidden('alt_date', null, ['id' => 'alt_date' ]) }}
		</p>
	</div>

	<div class="form-group">
		<div class="col-sm-12">
		{{ Form::text('title', Input::old('title', $article->title), ["class" => "form-control", "placeholder" => Lang::get('messages.title')]) }}
		</div>
	</div>

	<!-- Nav tabs -->
	<ul class="nav nav-tabs">
		<li class="active"><a href="#full-content" data-toggle="tab">Content</a></li>
		<li><a href="#short-content" data-toggle="tab">Description</a></li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div class="tab-pane active" id="full-content">
			<div class="col-sm-12">
			<div class="form-group">
				{{ Form::textarea('content', Input::old('content', $article->content), ['class' => 'form-control ckeditor']) }}
			</div>
			</div>
		</div>
		<div class="tab-pane" id="short-content">
			<div class="col-sm-12">
			<div class="form-group">
				{{ Form::textarea('desc', Input::old('content', $article->desc), ["class" => "form-control ckeditor"]) }}
			</div>
			</div>
		</div>
	</div>
	
<div class="form-group">
	<div class="col-sm-12">
		<button type="submit" class="btn btn-primary">update</button> | 
		<a href="{{ route('categories.articles.show', [$cat, $article->id]) }}" class="btn btn-warning">cancel</a>
	</div>
</div>    
{{ Form::close() }}

@stop

@section('style')
{{ HTML::style('css/jqueryui/1.10.3/jquery-ui.min.css') }}
@stop

@section('script')
{{ HTML::script('js/ckeditor/4.3.1/ckeditor.js') }}
{{ HTML::script('js/jqueryui/1.10.3/jquery.ui.core.min.js') }}
{{ HTML::script('js/jqueryui/1.10.3/jquery.ui.widget.min.js') }}
{{ HTML::script('js/jqueryui/1.10.3/jquery.ui.datepicker.min.js') }}
<script type="text/javascript">
	$("#date").datepicker({
		dateFormat	: 'dd MM yy ',
		altField	: '#alt_date',
		altFormat	: 'yy-mm-dd'
	}).datepicker("setDate", '+30d');
</script>
@stop