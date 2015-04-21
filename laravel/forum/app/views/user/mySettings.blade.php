@extends('../layouts/default')

@section('title')
{{Lang::get('messages.my_settings')}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <div class="box">
            <h3 align="center"><i class="fa fa-wrench"></i> {{Lang::get('messages.my_settings')}}</h3>
            <form method="post" action="{{URL::to('user/update_profile')}}">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <strong>{{Lang::get('messages.city')}}:</strong>
                <input type="text" name="city" class="form-control" value="{{$user->profile()->first()->city}}">
                <br>
                <select name="city_public">
                    @if($user->profile()->first()->city_public==0)
                    <option value="0" selected="selected">{{Lang::get('messages.friends_only')}}</option>
                    <option value="1">{{Lang::get('messages.public')}}</option>
                    @else
                    <option value="0">{{Lang::get('messages.friends_only')}}</option>
                    <option value="1" selected="selected">{{Lang::get('messages.public')}}</option>
                    @endif
                </select><br /><br />
                <strong>{{Lang::get('messages.job')}}:</strong>
                <input type="text" name="job" class="form-control" value="{{$user->profile()->first()->job}}">
                <br>
                <select name="job_public">
                    @if($user->profile()->first()->job_public==0)
                    <option value="0" selected="selected">{{Lang::get('messages.friends_only')}}</option>
                    <option value="1">{{Lang::get('messages.public')}}</option>
                    @else
                    <option value="0">{{Lang::get('messages.friends_only')}}</option>
                    <option value="1" selected="selected">{{Lang::get('messages.public')}}</option>
                    @endif
                </select><br /><br />
                <strong>{{Lang::get('messages.your_description')}}:</strong>
                <textarea class="form-control" rows="7" name="description">{{$user->profile()->first()->about}}</textarea>
                <br>
                <select name="description_public">
                    @if($user->profile()->first()->about_public==0)
                    <option value="0" selected="selected">{{Lang::get('messages.friends_only')}}</option>
                    <option value="1">{{Lang::get('messages.public')}}</option>
                    @else
                    <option value="0">{{Lang::get('messages.friends_only')}}</option>
                    <option value="1" selected="selected">{{Lang::get('messages.public')}}</option>
                    @endif
                </select>
                <br />
                <br />
                <button type="submit" class="btn btn-primary">{{Lang::get('messages.update')}}</button>
            </form>
        </div>	
    </div>
    <div class="col-sm-3"></div>
</div>
@stop