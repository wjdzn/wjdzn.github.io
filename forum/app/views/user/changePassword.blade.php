@extends('../layouts/default')

@section('title')
{{Lang::get('messages.change_password')}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6 box">
        <h3 align="center">{{Lang::get('messages.change_password')}}</h3>
        @if(Session::has('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{Session::get('error')}}</strong>
        </div>
        @endif
        @if(Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{Session::get('success')}}</strong>
        </div>
        @endif
        <form method="post" action="{{URL::to('user/change_password')}}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <strong>{{Lang::get('messages.old_password')}}:</strong>
            <input type="password" name="old_password" class="form-control">
            <strong>{{Lang::get('messages.new_password')}}:</strong>
            <input type="password" name="new_password" class="form-control">
            <small>{{Lang::get('messages.min_6')}}</small>
            <br>
            <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{Lang::get('messages.change')}}</button>
        </form>		
    </div>
    <div class="col-sm-3"></div>
</div>
@stop