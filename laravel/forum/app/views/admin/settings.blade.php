@extends('../layouts/default')

@section('title')
{{Lang::get('messages.basic_settings')}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-3 box">
        <ul class='nav nav-pills nav-stacked'>
            <li><a href="{{URL::to('admin-panel')}}"><i class='fa fa-home'></i> {{Lang::get('messages.home')}}</a></li>
            <li class="active"><a href="{{URL::to('admin-panel/settings')}}"><i class='fa fa-wrench'></i> {{Lang::get('messages.basic_settings')}}</a></li>
            <li><a href="{{URL::to('admin-panel/themes')}}"><i class='fa fa-desktop'></i> {{Lang::get('messages.themes')}}</a></li>
            <li><a href="{{URL::to('admin-panel/users')}}"><i class='fa fa-group'></i> {{Lang::get('messages.users')}}</a></li>
            <li><a href="{{URL::to('admin-panel/reports')}}"><i class='fa fa-flag'></i> {{Lang::get('messages.reports')}}</a></li>
            <li><a href="{{URL::to('admin-panel/bans')}}"><i class='fa fa-ban'></i> {{Lang::get('messages.bans')}}</a></li>
            <li><a href="{{URL::to('admin-panel/tos')}}"><i class="fa fa-list"></i> {{Lang::get('messages.terms_of_service')}}</a></li>
        </ul>
    </div>
    <div class='col-sm-1'></div>
    <div class="col-sm-8 box">
        <h3 align="center"><i class='fa fa-wrench'></i> {{Lang::get('messages.basic_settings')}}</h3>
        @if(Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><i class='fa fa-check'></i> {{Session::get('success')}}</strong>
        </div>
        @endif
        <form method="post" action="{{URL::to('admin-panel/settings')}}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <strong>{{Lang::get('messages.site_title')}}</strong>
            <input type="text" name="site_title" id="inputSite_titel" class="form-control" value="{{$settings->title}}" maxlength="100">
            <strong>{{Lang::get('messages.site_description')}}</strong>
            <textarea name="site_description" class="form-control" maxlength="255">{{$settings->description}}</textarea>
            <strong>{{Lang::get('messages.keywords')}}</strong>
            <textarea name="keywords" class="form-control" maxlength="255">{{$settings->keywords}}</textarea>
            <strong>{{Lang::get('messages.max_profile_pic_upload_size')}}</strong>
            <input type="text" name="maxsize" id="inputMaxsize" class="form-control" pattern="[0-9]*" value="{{$settings->max_pic_upload_size}}">
            <div class="checkbox">
                <label>
                    @if($settings->acc_activation==1)
                    <input type="checkbox" name="acc_activation" checked="checked">
                    @else
                    <input type="checkbox" name="acc_activation">
                    @endif
                    {{Lang::get('messages.account_activation')}}
                </label>
            </div>
            <div class="checkbox">
                <label>
                    @if($settings->tos==1)
                    <input type="checkbox" name="tos" checked="checked">
                    @else
                    <input type="checkbox" name="tos">
                    @endif
                    {{Lang::get('messages.tos_admin')}}
                </label>
            </div>
            <br />
            <button type="submit" class="btn btn-primary">{{Lang::get('messages.update')}}</button>
        </form>
    </div>
</div>
@stop