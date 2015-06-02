<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Mobile Specific Metas
  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
  ================================================== -->
    <link href="{{ asset('/plugins/AdminJhon/vendors/font-awesome-4.2.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/corp/stylesheets/base.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/corp/stylesheets/skeleton.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/corp/stylesheets/2_corporate.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/corp/stylesheets/layout_2.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/corp/stylesheets/box.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/corp/stylesheets/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/AdminJhon/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('http://fonts.googleapis.com/css?family=Knewave') }}" rel='stylesheet' type='text/css'>
    @yield('header_styles')

    <!--[if lt IE 9]>
    <script src="{{ asset('http://html5shim.googlecode.com/svn/trunk/html5.js') }}"></script>
   <![endif]-->

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="{{ asset('/plugins/corp/images/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('/plugins/corp/images/apple-touch-icon.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/plugins/corp/images/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/plugins/corp/images/apple-touch-icon-114x114.png') }}">

    <style type="text/css">
        iframe.c1 {border:none; overflow:hidden; height:20px;width:50px; }
    </style>
</head>

<!-- Body -->
<!-- Part 1: #Header -->
<div class="pixfort_corporate_2">
    <div class="header_style">
        <div class="container">
            <div class="sixteen columns header_area">
                <a href="#" class="yt_button"></a>
                <a href="#" class="twitter_button"></a>
                <a href="#" class="facebook_button"></a>

                <div class="htext_style">Stay connected</div>
            </div>
        </div><!-- container -->
    </div>
</div>

@yield('content')




<!-- Part 10: #Footer -->

<div class="pixfort_corporate_2">

    <div  class="foot_st">
        <div class="container ">
            <div class="seven columns alpha ">
            <span class="rights_st"> All rights reserved Copyright &copy; 2014 FLATPACK by
                    <span class="pixfort_st">PixFort</span>
            </span>
            </div>


            <div class="nine columns omega ">
                <div class="socbuttons">

                    <div class="soc_icons">
                        <a href="https://twitter.com/share" class=
                        "twitter-share-button" data-via="pixfort" data-count="none">
                            Tweet
                        </a>
                        &nbsp;&nbsp;&nbsp;
                        <!-- Place this tag where you want the +1 button to render. -->
                        <!-- <span class="confirm_gp">
                                            <div class="g-plusone " data-size="medium" data-annotation="none"></div>
                                        </span>

                         <!== Place this tag after the last +1 button tag. -->
                        <iframe src=
                                "https://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fthemeforest.net%2Fuser%2FPixFort&amp;width&amp;layout=button&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=35&amp;appId=445119778844521"
                                class="c1">
                        </iframe>
                    </div>
                    <div class="likes_st">Your likes &amp; share makes us happy!</div>

                </div>
            </div><!-- container -->
        </div>
    </div>

</div>


<div class="modal fade " id="MSGModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal_transparent">
            <div class="modal-header without_border">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title modal_transparent_title" id="MSGModalTitle"></h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4 id="h4MSG"></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  <!-- Modal -->

<!-- JavaScript
  ================================================== -->

<script src="{{ asset('/plugins/AdminJhon/js/jquery-1.11.1.min.js') }}" type="text/javascript"></script> <!-- jQuery -->
<script src="{{ asset('/plugins/corp/js-files/jquery.easing.1.3.js') }}" type="text/javascript"></script> <!-- jQuery easing -->
<script type='text/javascript' src="{{ asset('/plugins/corp/js-files/jquery.common.min.js') }}"></script>
<script src="{{ asset('/plugins/corp/js-files/custom.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/AdminJhon/vendors/livicons/minified/raphael-min.js') }}"></script>
<script src="{{ asset('/plugins/AdminJhon/vendors/livicons/minified/livicons-1.4.min.js') }}"></script>

<script src="{{ asset('/plugins/corp/assets/js/smoothscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/corp/assets/js/appear.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/corp/assets/js/animations.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/AdminJhon/js/bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/main.js') }}" type="text/javascript"></script>
@yield('footer_scripts')

<script>
    !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
</script> <script type="text/javascript">
    (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/platform.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    })();
</script>

<!-- End Document
<<<<<<< HEAD
================================================== -->
=======
================================================== -->
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
