@extends('../layouts/default')

@section('title')
{{Lang::get('messages.set_password')}}
@stop

@section('content')
<div class="box">

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <h3 align="center">{{Lang::get('messages.set_password')}}</h3>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong><i class="fa fa-info"></i> {{Lang::get('messages.after_set_password_info')}}</strong>
            </div>
            @if(Session::has('error'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong><i class="fa fa-warning"></i> {{Session::get('error')}}</strong>
            </div>
            @endif
            <form method="post" action="{{URL::to('user/set_password')}}">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <strong>{{Lang::get('messages.new_password')}}: </strong>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="{{Lang::get('messages.new_password')}}">
                <br />
                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{Lang::get('messages.set')}}</button>
            </form>	
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>
@stop