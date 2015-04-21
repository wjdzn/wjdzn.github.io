<?php
$settings = Settings::first();
if ($settings == null) {
    echo "SETTINGS NOT CONFIGURED!";
    exit();
}
if (Session::has('logged')) {
    $info = User::where('email', Session::get('logged'))->first();
    $info->last_seen = time();
    $info->save();
    if (Ban::where('BannedUser', 1)->where('user_id', $info->id)->where("ban_to", '>', time())->count() > 0) {
        Session::forget('logged');
    }
    $fr_requests = Friendship::where('acc_2', $info->id)->where('status', 0)->count();
    if ($info->membership < 3 && (Post::where('by',$info->id)->where('created_at','>',date("Y-m-d H:i:s", time() - 300))->count()>5 || Discussion::where('by_id', $info->id)->where('created_at', '>', date("Y-m-d H:i:s", time() - 300))->count() > 5 || Message::where('msg_from', $info->id)->where('created_at', '>', date("Y-m-d H:i:s", time() - 200))->count() > 20)) {
        if (!User::isMuted(Session::get('logged'))) {
            Mute::create(array(
                'muted_from' => time(),
                'muted_to' => time() + 1800,
                'reason' => Lang::get('messages.reason-spamming'),
                'user_id' => $info->id
            ));
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{$settings->title}} - 
            @yield('title')
        </title>
        <meta name="description" content="{{$settings->description}}">
        <meta name="keywords" content="{{$settings->keywords}}">
        {{HTML::style('assets/css/font-awesome.css')}}
        {{HTML::style('assets/css/ui-lightness/jquery-ui-1.10.4.css')}}
        @if(File::exists("assets/themes/".$settings->theme."/style.css") && File::exists("assets/themes/".$settings->theme."/custom.css"))
        {{HTML::style('assets/themes/'.$settings->theme.'/style.css')}}
        {{HTML::style('assets/themes/'.$settings->theme.'/custom.css')}}
        @else
        MISSING THEME FILES.
        <?php exit(); ?>
        @endif
        {{HTML::style('assets/css/style.css')}}
        {{HTML::script('assets/js/jquery.js')}}
        {{HTML::script('assets/js/jquery-ui-1.10.4.js')}}
        {{HTML::script('assets/js/bootstrap.js')}}
        {{HTML::script('assets/js/ckeditor/ckeditor.js')}}
    </head>
    <body>
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{URL::to('/')}}">{{$settings->title}}</a>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav pull-left">

                        <li><a href="{{URL::to('/')}}"><i class="fa fa-home"></i> {{Lang::get('messages.home')}}</a></li>
                        @if(Session::has('logged'))
                        <li><a href="{{URL::to('profile/'.Session::get('logged'))}}" data-toggle="dropdown" role="menu"><i class="fa fa-list"></i> <strong>{{$info->first_name}}</strong> <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{URL::to('profile/'.Session::get('logged'))}}"><i class="fa fa-user"></i> {{Lang::get('messages.profile')}}</a></li>
                                <li><a href="{{URL::to('mail/1')}}"><span class="label label-warning">{{Message::where("msg_to",$info->id)->where('read',0)->where('deleted',0)->where('box',$info->id)->count()}}</span> <i class="fa fa-envelope"></i> {{Lang::get('messages.mail')}}</a></li>
                                <li><a href="{{URL::to('friend_requests')}}"> <span class="label label-success">{{$fr_requests}} </span> <i class="fa fa-group"></i> {{Lang::get('messages.friend_requests')}} </a></li>
                                <li><a href="{{URL::to('logout')}}"><i class="fa fa-sign-out"></i> {{Lang::get('messages.logout')}}</a></li>
                            </ul></li>
                        @if(User::where('email',Session::get('logged'))->first()->membership>=4)
                        <li><a href="{{URL::to('admin-panel')}}"><i class='fa fa-dashboard'></i> {{Lang::get('messages.admin_panel')}}</a></li>
                        @endif	
                        @else
                        <li><a href="{{URL::to('register')}}"><i class="fa fa-user"></i> {{Lang::get('messages.register')}}</a></li>
                        <li><a href="{{URL::to('login')}}"><i class="fa fa-sign-in"></i> {{Lang::get('messages.login')}}</a></li>
                        @endif
                    </ul>
                    @if(count(scandir(app_path()."/lang/"))>3)
                    <ul class='nav navbar-nav pull-right'>
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class='fa fa-globe'></i> {{Lang::get('messages.language')}}<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                @foreach(scandir(app_path()."/lang/") as $lang)
                                @if($lang!="." && $lang!="..")
                                <li><a href="{{URL::to('changelang/'.$lang)}}">{{strtoupper($lang)}}</a></li>
                                @endif
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                    @endif
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container -->
        </nav>
        <div class="container">
            @if(Session::has('logged'))
            @if(User::isMuted(Session::get('logged')))
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong><i class="fa fa-warning"></i> {{Lang::get('messages.you_are_muted_the_reason_is')}}: {{Mute::where('user_id',$info->id)->where('muted_to','>',time())->first()->reason}}! {{Lang::get('messages.the_mute_will_expire_on')}} {{date('Y-m-d h:i:s',Mute::where('user_id',$info->id)->where('muted_to','>',time())->first()->muted_to)}}</strong>
            </div>
            @endif
            @endif
            @yield('content')
        </div>
        <div id="msg_panel" class="panel panel-primary hidden-xs hidden-sm" style="position:absolute;right:0px;width:400px;min-height:500px;top:50px;">
            <div class="panel-heading">
                {{Lang::get('messages.compose')}}
                <a href="#" onclick="$('#msg_panel').hide('slow');" class="label label-primary pull-right"><i class="fa fa-times"></i></a><button id="submit_msg" class="label label-success pull-right" style="outline:none;border:none;box-shadow:0px 0px 10px #eee;"><i class="fa fa-send"></i> {{Lang::get('messages.send')}}</button>

            </div>
            <div class="panel-body">
                <div id="msg_success"></div>
                <strong>{{Lang::get('messages.to')}}</strong>
                <div id="has_to" >
                    <input type="text" name="to" id="msg_to" class="form-control input-sm">
                    <div id="error_to"></div>
                </div>
                <strong>{{Lang::get('messages.subject')}}</strong>
                <div id="has_to" >
                    <input type="text" name="subject" id="msg_title" class="form-control input-sm">
                    <div id="error_subject"></div>
                </div>
                <br />
                <small>{{Lang::get('messages.min_50')}}</small><br />
                <small>{{Lang::get('messages.limit_1000')}}</small>
                <textarea id="msg_text_send" ></textarea>
                <div id="error_msg"></div>
                <br />
            </div>
        </div>
    </body>
</html>
<script>
            $("#inputQuery").keypress(function(e){
    if (e.keyCode == 13){
    $("#searchForm").submit();
    }
    });
            var editor = CKEDITOR.replace('msg_text_send');
            $("#msg_panel").hide();
            $("#compose").click(function(){
    $("#msg_panel").toggle('slow');
    });</script>
@if(Session::has('logged'))
<script>
            $("#submit_msg").click(function(){
    $.ajax({
    url: "{{URL::to('sendmsgajax')}}",
            type: "POST",
            data:{
            _token: '{{csrf_token()}}',
                    to: $("#msg_to").val(),
                    title: $("#msg_title").val(),
                    text: CKEDITOR.instances.msg_text_send.getData(),
                    by: "{{User::where('email', Session::get('logged'))->first()->id}}"
            }
    }).done(function(data){
    if (data == 1){
    $("#error_to").html("<i class='fa fa-warning'></i> {{Lang::get('messages.the_user_does_not_exist')}}");
            $("#has_to").addClass("has-error");
    } else{
    $("#has_to").removeClass("has-error");
            $("#error_to").html("");
    }

    if (data == 2){
    $("#error_to").html("<i class='fa fa-warning'></i> {{Lang::get('messages.you_can_not_send_messages_to_yourself')}}");
            $("#has_to").addClass("has-error");
    } else{
    if (data != 1){
    $("#has_to").removeClass("has-error");
            $("#error_to").html("");
    }
    }
    if (data == 3){
    $("#error_subject").html("<i class='fa fa-warning'></i> {{Lang::get('messages.too_short_subject')}}");
            $("#has_subject").addClass("has-error");
    } else{
    $("#has_subject").removeClass("has-error");
            $("#error_subject").html("");
    }
    if (data == 4){
    $("#error_msg").html("<i class='fa fa-warning'></i> {{Lang::get('messages.too_short_message')}}");
    } else{
    $("#error_msg").html("");
    }
    if (data == 5){
    $("#msg_success").html("<i class='fa fa-check'></i> {{Lang::get('messages.successifully_sent_message_to')}} " + $("#msg_to").val());
    } else{
    $("#msg_success").html("");
    }
    console.log(data);
    });
    });
</script>
@endif