@extends('../layouts/default')

@section('title')
{{Lang::get('messages.forgot_password')}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6 box">
        <h3 align="center">{{Lang::get('messages.forgot_password')}}</h3>
        @if(Session::has('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><i class="fa fa-warning"></i> {{Session::get('error')}}</strong>
        </div>
        @endif
        @if(Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><i class="fa fa-check"></i> {{Session::get('success')}}</strong>
        </div>
        @endif
        <form method="post" action="{{URL::to('forgot')}}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <strong>Email: </strong>
            <input type="text" name="email" id="input" class="form-control">
            <br />
            <button type="submit" class="btn btn-primary"><i class='fa fa-send'></i> {{Lang::get('messages.send')}}</button>
        </form>		
    </div>
    <div class="col-sm-3"></div>
</div>
@stop