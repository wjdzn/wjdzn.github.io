@extends('../layouts/default')

@section('title')
{{Lang::get('messages.activate_your_account')}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8 box">
        <h3 align="center">{{Lang::get('messages.activate_account')}}</h3>
        @if(Session::has('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><i class="fa fa-info"></i> {{Session::get('error')}}</strong>
        </div>
        @endif
        <form method="post" action="{{URL::to('activate')}}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <strong>Email:</strong>
            <input type="text" name="email" id="email" class="form-control">
            <strong>Activation code:</strong>
            <input type="text" name="code" id="code" class="form-control" style="max-width:200px;" maxlength="12">
            <br />
            <button type="submit" class="btn btn-primary" id="activate">{{Lang::get('messages.activate')}}</button>
        </form>
    </div>
    <div class="col-sm-2"></div>
</div>
@stop