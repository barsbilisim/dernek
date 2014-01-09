@section('content')
<div id="article-list"></div>
@stop

@section('script')
<script type="text/javascript">
$('#article-list').load('/api/article/list');
</script>
@stop