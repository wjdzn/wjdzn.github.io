@extends('../layouts/default')

@section('title')
{{Lang::get('messages.mute')}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6 box">
        <h3 align="center"><i class='fa fa-comment'></i> {{Lang::get('messages.mute')}}</h3>
        <form method="post" action="{{URL::to('mute/'.$user->id)}}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            {{Lang::get('messages.mute')}}: {{$user->email}}<br>
            <strong>{{Lang::get('messages.reason')}}</strong>
            <input type="text" name="reason" id="inputReason" class="form-control" placeholder="{{Lang::get('messages.reason')}}">
            <br>
            <strong>{{Lang::get('messages.time')}}</strong>
            <select name="time" class="form-control">
                <option value="1800">30 {{Lang::get('messages.minutes')}}</option>
                <option value="3600">1 {{Lang::get('messages.hour')}}</option>
                <option value="21600">6 {{Lang::get('messages.hours')}}</option>
                <option value="43200">12 {{Lang::get('messages.hours')}}</option>
                <option value="86400">24 {{Lang::get('messages.hours')}}</option>
                <option value="604800">7 {{Lang::get('messages.days')}}</option>
                <option value="2592000">30 {{Lang::get('messages.days')}}</option>
            </select>
            <br>
            <button type="submit" class="btn btn-primary">{{Lang::get('messages.mute')}}</button>
        </form>
    </div>
    <div class="col-sm-3"></div>
</div>
@stop