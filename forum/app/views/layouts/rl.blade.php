<?php $settings = Settings::first(); ?>
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
        @if(File::exists("assets/themes/".$settings->theme."/style.css"))
        {{HTML::style('assets/themes/'.$settings->theme.'/style.css')}}
        @else
        {{HTML::style('assets/css/bootstrap.css')}}
        @endif
        {{HTML::style('assets/css/style.css')}}
        {{HTML::script('assets/js/jquery.js')}}
        {{HTML::script('assets/js/jquery-ui-1.10.4.js')}}
        {{HTML::script('assets/js/bootstrap.js')}}
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
                        <li><a href="{{URL::to('register')}}"><i class="fa fa-user"></i> {{Lang::get('messages.register')}}</a></li>
                        <li><a href="{{URL::to('login')}}"><i class="fa fa-sign-in"></i> {{Lang::get('messages.login')}}</a></li>
                    </ul>
                    <ul class='nav navbar-nav pull-right'>
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Language<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                @foreach(scandir(app_path()."/lang/") as $lang)
                                @if($lang!="." && $lang!="..")
                                <li><a href="{{URL::to('changelang/'.$lang)}}">{{strtoupper($lang)}}</a></li>
                                @endif
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container -->
        </nav>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
<script>
    $("#inputQuery").keypress(function(e) {
        if (e.keyCode == 13) {
            $("#searchForm").submit();
        }
    });
</script>