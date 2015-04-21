@extends('../layouts/default')

@section('title')
{{Lang::get('messages.bans')}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6 box">
        <h3 align="center"><i class="fa fa-ban text-danger"></i> {{Lang::get('messages.ban')}}</h3>
        @if(Session::has('errors'))
        @foreach(Session::get('errors')->all() as $err)
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><i class="fa fa-warning"></i> {{$err}}</strong>
        </div>
        @endforeach
        @endif
        <form method="post" action="{{URL::to('ban/create')}}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <strong>{{Lang::get('messages.type')}}: </strong>
            <select name="type" id="banType" class="form-control">
                <option id="choose" value="0" selected="selected">{{Lang::get('messages.choose_ban_type')}}</option>
                <option value="ip">{{Lang::get('messages.ip_address')}}</option>
                <option value="user">{{Lang::get('messages.user')}}</option>
            </select>
            <div id="inputIp" style="display:none">
                <strong>{{Lang::get('messages.ip_address')}}:</strong>
                <input type="text" name="ip" id="ip" class="form-control" maxlength="25">
            </div>
            <div id="inputUser" style="display:none">
                <strong>{{Lang::get('messages.e-mail')}}:</strong>
                <input type="text" name="email" id="email" class="form-control">
            </div>
            <br>
            <div id="other" style="display:none">
                <strong>{{Lang::get('messages.time')}} ({{Lang::get('messages.days')}} {{Lang::get('messages.0_for_forever')}})</strong>
                <input type="text" name="time" id="inputTime" class="form-control" maxlength="20" pattern="[0-9]*">
                <br>
                <button type="submit" class="btn btn-primary"><i class="fa fa-ban"></i> {{Lang::get('messages.ban')}}</button>
            </div>
        </form>
    </div>
    <div class="col-sm-3"></div>
</div>
<script type="text/javascript">
    $("#banType").change(function() {
        $("#choose").hide();
        $("#other").show();
        if ($("#banType").val() == "ip") {
            $("#inputUser").hide();
            $("#inputIp").show();
            $("#email").val("");
        } else {
            $("#inputUser").show();
            $("#inputIp").hide();
            $("#ip").val("");
        }
    });
</script>
@stop