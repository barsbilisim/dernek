@section('content')
<div class="tooltip-div">
	<a href="{{ route('articles.images.index', $art) }}" class="btn btn-lg pull-right" data-placement="left" title="return to images"><span class="glyphicon glyphicon-new-window"></span></a>
</div>

<table class="table">
	<thead>
		<tr>
			<th>Id</th>
				<th>Article_id</th>
				<th>Big</th>
				<th>Thumb</th>
				<th>Description</th>
				<th>Status</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $image->id }}}</td>
					<td>{{{ $image->article_id }}}</td>
					<td>{{{ $image->big }}}</td>
					<td>{{{ $image->thumb }}}</td>
					<td>{{{ $image->description }}}</td>
					<td>{{{ $image->status }}}</td>
                    <td>{{ link_to_route('articles.images.edit', 'Edit', array($art, $image->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('articles.images.destroy', $art, $image->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop

@section('script')
<script type="text/javascript">
$(".tooltip-div").tooltip({
	selector: "button, a",
	container: "body"
});
</script>
@stop