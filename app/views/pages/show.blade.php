@section('content')

{{ $page->content }}

@if(Auth::check() && $page->name != '404' && Auth::user()->inRoles(['admin']))
	<hr>
	<a href="{{ route('pages.edit', $page->id) }}" class="btn btn-primary">{{ Lang::get('messages.edit') }}</a> |
	<button type="submit" form="delete-page" class="btn btn-primary">{{ Lang::get('messages.delete') }}</button>
	
	{{ Form::open(['method' => 'DELETE', 'id' => 'delete-page', 'route' => ['pages.destroy', $page->id]]) }}
	{{ Form::close() }}
@endif
@stop
