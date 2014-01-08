@section('content')
@include('partial.errors')

{{ Form::model($category, ['method' => 'PATCH', 'route' => ['categories.update', $category->id], 'class' => 'form-horizontal']) }}
<div class="form-group">
	<div class="col-sm-12">
		{{ Form::label('name', 'Category name:') }}
		{{ Form::text('name', Input::old('name', $category->name), ['class' => 'form-control', 'maxlength' => 100, 'required' => true]) }}
	</div>
	<div class="col-sm-12">
		<input type="checkbox" name="deleted" style="vertical-align:middle; margin-top:0" value="1" @if($category->deleted_at != null) checked="checked" @endif>
		<label for="save">deleted</label>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-12">
		<button type="submit" class="btn btn-primary">update</button> | 
		<a href="{{ route('categories.index') }}" class="btn btn-warning">cancel</a>
	</div>
</div>
{{ Form::close() }}

@stop
