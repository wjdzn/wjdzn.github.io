@extends('../layouts/default')

@section('title')
{{Lang::get('messages.login')}}
@stop

@section('content')


<div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 box">
        <form method="post" action="{{URL::to('login')}}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <fieldset>
                <h2><i class='fa fa-user'></i> {{Lang::get('messages.login')}}</h2>
                @if(Session::has('error'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong><i class="fa fa-warning"></i> {{Session::get('error')}}</strong>
                </div>
                @endif
                @if(Session::has('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong><i class="fa fa-warning"></i> {{Session::get('success')}}</strong>
                </div>
                @endif
                <hr class="colorgraph">
                <div class="form-group">
                    <input type="email" name="email" class="form-control input-lg" placeholder="{{Lang::get('messages.e-mail')}}">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control input-lg" placeholder="{{Lang::get('messages.password')}}">
                </div>
                <span class="button-checkbox">
                    <a href="{{URL::to('fbLogin')}}" class="btn btn-primary" data-color="info"><i class="fa fa-facebook"></i> Facebook</a>
                    <input type="checkbox" name="remember_me" id="remember_me" checked="checked" class="hidden">
                    <a href="{{URL::to('forgot')}}" class="btn btn-link pull-right">{{Lang::get('messages.forgot_password')}}?</a>
                </span>
                <hr class="colorgraph">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <input type="submit" class="btn btn-lg btn-success btn-block" value="Sign In">
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <a href="{{URL::to('register')}}" class="btn btn-lg btn-primary btn-block">{{Lang::get('messages.register')}}</a>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

@stop
