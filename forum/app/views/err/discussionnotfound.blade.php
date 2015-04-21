@extends('../layouts/default')

@section('title')
{{Lang::get('messages.dis_not_found')}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6 box">
        <h3 align="center">
            <i class="fa fa-comment"></i>
            {{Lang::get('messages.dis_not_found')}}
    </div>
    <div class="col-sm-3"></div>
</div>
@stop