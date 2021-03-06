@section('content')
@include('partial.errors')

{{ Form::model($article, ['method' => 'PATCH', 'route' => ['categories.articles.update', $cat, $article->id], 'class' => 'form-horizontal', 'role' => 'form']) }}

	<div class="form-group">
		<p class="col-sm-3">
			{{ Form::text('lang', trans('messages.'.$article->lang), ['class' => 'form-control', 'readonly' => true]) }}
		</p>
		<p class="col-sm-3">
			{{ Form::select('category', $category, Input::old('category', $article->category), ['class' => 'form-control']) }}
		</p>
		<p class="col-sm-3">
			{{ Form::text('create_date', $create_date, ['id' => 'create_date', 'class' => 'form-control', 'readonly' => true ]) }}
			{{ Form::hidden('create_alt', $cd->format('Y-m-d'), ['id' => 'create_alt' ]) }}
		</p>
		<p class="col-sm-3">
			{{ Form::text('end_date', $end_date, ['id' => 'end_date', 'class' => 'form-control', 'readonly' => true ]) }}
			{{ Form::hidden('end_alt', $ed->format('Y-m-d'), ['id' => 'end_alt' ]) }}
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
@if($article->deleted_at != null)
<div class="form-group">
	<div class="col-sm-12">
		{{ Form::checkbox('deleted', 1, Input::old('deleted', $article->deleted_at), ["style" => "vertical-align:middle; margin-top:0" ]) }}
		{{ Form::label('deleted', 'deleted', ['class' => 'control-label']) }}
	</div>
</div>
@endif	
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
{{ HTML::script('js/jqueryui/1.10.3/locales/jquery.ui.datepicker-'.Config::get("app.locale").'.min.js') }}
<script type="text/javascript">
$("#create_date").datepicker({
	dateFormat	: 'dd MM yy ',
	altField	: '#create_alt',
	altFormat	: 'yy-mm-dd'
});

$("#end_date").datepicker({
	dateFormat	: 'dd MM yy ',
	altField	: '#end_alt',
	altFormat	: 'yy-mm-dd'
});
</script>
@stop