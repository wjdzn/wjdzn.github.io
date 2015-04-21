@extends('../layouts/default')

@section('title')
{{Lang::get('messages.page_not_found')}}
@stop

@section('content')
<div class="box">
    <h1 align="center"><i class="fa fa-bug"></i> {{Lang::get('messages.page_not_found')}}</h1>
</div>	
@stop