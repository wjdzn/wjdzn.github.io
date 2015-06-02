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
<<<<<<< HEAD
                <div onclick="$('#ModModal').modal('show')" style="
    background: url('../../public/img/bg-white-lock.png') repeat;
    border-radius: 97px;
    width: 34px;
    height: 34px;
    padding: 6px;
    color: white;
    cursor: pointer;
    background-color: black;
    float: right;
">-&gt;</div>
=======

>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
                <div class="htext_style">Stay connected</div>
            </div>
        </div><!-- container -->
    </div>
</div>

    <!-- Part 2: #Contact -->
    <div class="pixfort_corporate_2">

    <div class="page_style">
        <div class="container">
            <div class="sixteen columns context_style">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="logotext">
                    InventPalooza!
                </div>
                <div class="subtitle_style">
                    <h3 class="strapline">Work smarter, work safer, work together.</h3><p>Join an alliance of independent inventors. Get your project in front of the Power Panel at InventPalooza!2015*</p>
                </div>

                <div class="contact_style">
                    <div class="contact_btn"> <a href="#">Join</a> </div>
                </div>


                <div class="note_st">*Qualification ends July X, 2015</div>
            </div>
        </div><!-- container -->
    </div>

</div>
    <!-- Part 3: #Features -->
    <div class="pixfort_corporate_2">

    <div class="adv_st">
        <div class="container">
            <div class="sixteen columns">

                <div class="four columns  alpha">
                    <a href="{{url('calendar')}}">
                        {!! HTML::image('/plugins/corp/images/2_corporate/calendar.png') !!}
                    </a>
                    <div class="head_style">InventPalooza!2015</div>
                    <div class="c_style">
                        Learn about the independent inventor's event of the year. Participate in the national inventor community.
                    </div>
                </div>

                <div class="four columns  ">
                    <a href="{{url('forum')}}">
                        {!! HTML::image('/plugins/corp/images/2_corporate/discuss.png') !!}
                    </a>
                    <div class="head_style">Engage</div>
                    <div class="c_style">
                        Join an active community of independent inventors. Share resources and experience with an international community of grassroots inventors and business people.
                    </div>
                </div>

                <div class="four columns  ">
                    {!! HTML::image('/plugins/corp/images/2_corporate/presale.png') !!}
                    <div class="head_style">Coffe Cup</div>
                    <div class="c_style">
                        The early bird catches the worm.  Presale tickets are 50% off for groups of 3 or more.  Individual presale tickets are just $20. Reserve now and get a free InventPalooza.com secure email address.
                    </div>
                </div>

                <div class="four columns  omega">
                    {!! HTML::image('/plugins/corp/images/2_corporate/invent.png') !!}
                    <div class="head_style">Connection</div>
                    <div class="c_style">
                        We've taken the guesswork out of selecting a patent attorney or product development contractor. We have carefully reviewed and qualified select contractors for their availability, speciality and how fair their offerings are for small businesses and independents.                   </div>
                </div>
            </div>
        </div><!-- container -->
    </div>

</div>
    <!-- Part 4: #Services -->
    <div class="pixfort_corporate_2">

    <div class="amazing_style">
        <div class="container">
            <div class="sixteen columns">
                <div class="gstyle">
                    <div class="t1_style">The most amazing thing is here</div>
                    <div class="t2_style">Our service is astonishingly thin and light.</div>
                    <div class="t3_style">Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud.</div>
                </div>
                <span>  {!! HTML::image('/plugins/corp/images/2_corporate/promo-image.png','',array( 'class' => 'pub_st')) !!}</span>
            </div>
        </div><!-- container -->
    </div>

</div>
    <!-- Part 5: #Clients -->
    <div class="pixfort_corporate_2">
        <div class="adv_style">
            <div class="container">
                <div class="sixteen columns">
                    <div class="L1_style">Great people trusted our services</div>
                    <div class="L2_style">great words from great people</div>

                    <div class="four columns just_st alpha">
                        <div class="h_style">+950</div>
                        <div class="cc_style">Themes and Templates Sales</div>
                    </div>

                    <div class="four columns just_st ">
                        <div class="h_style">+150</div>
                        <div class="cc_style">Followers love and trust us</div>
                    </div>

                    <div class="four columns just_st ">
                        <div class="h_style">+85</div>
                        <div class="cc_style">Items selling on themeforest</div>
                    </div>

                    <div class="four columns just_st omega">
                        <div class="h_style">+6K</div>
                        <div class="cc_style">Working hours this year wow</div>
                    </div>
                </div>
            </div><!-- container -->
        </div>
    </div>
    <!-- Part 7: #Partners -->
    <div class="pixfortx_2">

    <div class="logos_style">
        <div class="container">
            <div class="sixteen columns">
                <div class="LL1_style">Companies We Work With</div>
                <div class="LL2_style">great words from great people</div>
                <span>  {!! HTML::image('/plugins/corp/images/2_corporate/logos.png','logos', array('class' => 'logos')) !!} </span>
            </div>
        </div><!-- container -->
    </div>

</div>
    <!-- Part 8: #Feadback -->
    <div class="pixfort_corporate_2">

    <div class="awesome_style">
        <div class="container">
            <div class="sixteen columns">

                <h1 class="h_awesome"> What our awesome clients say </h1>

                <p class="txt_awesome">
                    Great service with fast and reliable support The design work and detail put into themes are great.
                </p>

                <div class="via_st">
                    {!! HTML::image('/plugins/corp/images/2_corporate/stars.original.png') !!}
                    <div class="top_3">via Unbounce.com</div>
                </div>

            </div>
        </div><!-- container -->
    </div>

</div>
    <!-- Part 9: #Contact -->
    <div class="pixfort_corporate_2">

    <div class="contact_section">
        <div class="container">
            <div class="sixteen columns">
                <div class="eight columns  alpha">
                    <div class="headtext_style">See our office</div>
                    <p class="subtext_style">Our service is totaly thin and light.</p>
                    <div class="plan">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d83998.91163207508!2d2.3470599!3d48.85885894999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e1f06e2b70f%3A0x40b82c3688c9460!2sParis%2C+France!5e0!3m2!1sen!2s!4v1408382253934" style="border:0"></iframe>
                    </div>
                </div>


                <div class="eight columns omega">
                    <div class="contact_zone">
                        <div class="headtext_style">Contact us now</div>
                        <p class="subtext_style">Our service is totaly thin and light.</p>
                        <div class="contact_st">
                            <fieldset id="contact_form">
                                <div id="result"></div>

                                <input type="text" name="name" id="name" placeholder="Your Full Name">
                                <input type="text"  name="company" id="company" placeholder="Your Company">
                                <input type="email" name="email" id="email" placeholder="Enter Your Email">
                                <textarea  rows="5" name="message" class="text_area" placeholder="Write your Message Here"></textarea>

                            </fieldset>


                            <button class="subscribe_btn submit_btn" id="subscribe_btn_2">Send it right away</button>

                        </div>
                    </div>
                </div>
            </div>
        </div><!-- container -->
    </div>

</div>
    <!-- ========================================================================================================= -->
    <!-- The Confirmation Page Popup -->
    <div id="hidden_pix_2" class="confirm_page confirm_page_2">
        <div class="pixfort_corporate_2">

            <div class="confirm_header">WOW, You Are AWESOME</div>
            <div class="confirm_text">
                Your form has been submitted and we will contact you as soon as possible.
            </div>

            <div class="confirm_social">
                <div class="confirm_social_box">
                    <a href="https://twitter.com/share" class="twitter-share-button" data-via="pixfort" data-count="none">Tweet</a>



                    <!-- Place this tag where you want the +1 button to render. -->
    <span class="confirm_gp">
      <span class="g-plusone " data-size="medium" data-annotation="none"></span>
    </span>


                    <!-- Place this tag after the last +1 button tag. -->



                    <iframe src="https://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fthemeforest.net%2Fuser%2FPixFort&amp;width&amp;layout=button&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=35&amp;appId=445119778844521" style="border:none; overflow:hidden; height:20px;width:50px;"></iframe>

                </div>
            </div>
        </div>
    </div>
    <!-- ========================================================================================================= -->

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

<div class="modal fade " id="ModModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal_transparent">
            <div class="modal-header without_border">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title modal_transparent_title" id="ModalFinal">Login to your account</h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="controls mbottom5">
                                <div class="input-group">
                                            <span class="input-group-addon minWidtht40">
                                                <i class="fa fa-envelope-o"></i>
                                            </span>
                                    <input type="text" id="email" name="email" value="{{ old('email') }}" class="form-control fS17" placeholder="Email">
                                </div>
                            </div>
                            <div class="controls mbottom5">
                                <div class="input-group">
                                            <span class="input-group-addon minWidtht40">
                                                <i class="fa fa-lock "></i>
                                            </span>
                                    <input type="password" id="password"  name="password" class="form-control fS17" placeholder="Password">
                                </div>
                            </div>
                            <div class="controls pull-left">
                                <div class="input-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="controls mbottom5 pull-right">
                                <div class="input-group">
                                    <button type="submit" class="btn btn-primary" id="senddata">
                                        Login <i class="fa fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="controls mbottom5 mTop50">
                                <div class="input-group">
                                    <h4>Forgot your password ?</h4>
                                    <h5>no worries, click <a href="{{ url('/password/email') }}">here</a> to reset your password.</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer modal_transparent_footer">
                <div class="controls mbottom5">
                    <div class="input-group">
                        <h4 class="pull-left">Don't have an account yet ?<a href="#" class="fS15"> Create an account</a> </h4>
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


