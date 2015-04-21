@extends('../layouts/default')

@section('title')
{{Lang::get('messages.user_not_found')}}
@stop

@section('content')
<div class="box">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h3 align="center"><i class="fa fa-warning"></i> {{Lang::get('messages.user_not_found')}}</h3>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>
@stop