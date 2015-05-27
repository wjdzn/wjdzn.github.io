@extends('layouts.default')
@section('title','InventPalooza - Success Through Commmunity')
@stop

@section('content')
    <!-- Part 2: #Contact -->
    <div class="pixfort_corporate_2">

    <div class="page_style">
        <div class="container">
            <div class="sixteen columns context_style">
                @if (count($errors) > 0)
                    <input type="hidden" id="errors" value="@foreach ($errors->all() as $error){{ $error." "}}@endforeach ">
                @endif
                <div class="logotext">
                    InventPalooza!
                </div>
                <div class="subtitle_style">
                    <h3 class="strapline">Work smarter, work safer, work together.</h3><p>Join an alliance of independent inventors. Get your project in front of the Power Panel at InventPalooza!2015*</p>
                </div>

                <div class="contact_style">
                    <div class="contact_btn"> <a class="a_join">Join</a> </div>
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
    <div class="modal fade " id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                        <h5>no worries, click <a href="{{ url('forum_forgot_password') }}">here</a> to reset your password.</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer modal_transparent_footer">
                    <div class="controls mbottom5">
                        <div class="input-group">
                            <h4 class="pull-left">Don't have an account yet ?<a href="{{ url('forum_register') }}" class="fS15"> Create an account</a> </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  <!-- Modal -->
@stop

