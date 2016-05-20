@extends('frontend.layouts.site')
@section('content')

<section id="slider" class="slider-parallax loginsec" data-height-lg="300" data-height-md="500" data-height-sm="400" data-height-xs="250" data-height-xxs="200">
    <div class="slider-parallax-inner">
        <div class="container clearfix">
            <div class="vertical-middle">

                <div class="heading-block nobottomborder">
                    <h1>
                        <div>
                            <span>Contact</span>
                        </div>
                    </h1>
                    <p>Get In Touch With Us</p>
                </div>

            </div>
        </div>
    </div>
</section>
<section id="content">

    <div class="content-wrap">

        <div class="section bottommargin conback"></div>

        <div class="section nobg full-screen" style="min-height: 1041px !important;">
            <div class="container vertical-middle divcenter clearfix">
                <div class="row center">
                    <div class="container clearfix">
                        <h1 class="contex conhead">Thank you</h1>
                        <h4 class="contex">For Being A Concerned Citizen </h4>
                    </div>
                </div>
                <div class="flash-message" style="color: #fff;padding: 15px;">
                    {{@Session::pull('contactSuccess')}}
                    {{@Session::pull('contactError')}}
                </div>

                <div class="panel-default divcenter noradius noborder" style="max-width:500px;">
                    <div class="panel-body" style="padding:2px;">
                        <form id="login-form" name="login-form" class="nobottommargin" action="{{ route($action)}}" method="post">
                           @if(!Auth::id())<center><h4 class="consub">Become a Mobitrasher</h4></center>@endif

                            <div class="col_full">
                                <input type="text" id="name" name="name" value="" class="sm-form-control required bordercolors validate[required]" aria-required="true" placeholder="Name ">
                            </div>

                            <div class="col_full">
                                <input type="text" id="email" name="email" value="" class="sm-form-control required bordercolors validate[required]" aria-required="true" placeholder="Email Id ">
                            </div>

                            <div class="col_full">
                                <input type="text" id="phone" name="phone" value="" class="sm-form-control required bordercolors validate[required]" aria-required="true" placeholder="Phone No ">
                            </div>

                            <div class="col_full">
                                <input type="text" id="location" name="location" value="" class="sm-form-control required bordercolors validate[required]" aria-required="true" placeholder="Location ">
                            </div>
                            <div class="line line-sm"></div>
                            <center>
                                <button type="submit" class="button button-3d button-rounded button-green">Submit</button>
                            </center>
                        </form>


                    </div>
                    <div><center><h1 class="contex">500+ Mobitrashers</h1>
                            <h5 class="dark">Featured In : </h5>
                        </center>
                    </div>
                    <div class="row center bottommargin ">
                        <div class="col-md-3 col-sm-6 bottommargin clearfix">
                            <img src="{{asset('public/Frontend/images/midday.png')}}"/>
                        </div>

                        <div class="col-md-3 col-sm-6 bottommargin clearfix">
                            <img src="{{asset('public/Frontend/images/midday.png')}}"/>
                        </div>

                        <div class="col-md-3 col-sm-6 bottommargin clearfix">
                            <img src="{{asset('public/Frontend/images/midday.png')}}"/>
                        </div>
                        <div class="col-md-3 col-sm-6 bottommargin clearfix">
                            <img src="{{asset('public/Frontend/images/midday.png')}}"/>
                        </div>

                    </div><!-- Contact Info End -->
                </div>
                <div class="clear"></div>
                <!-- Contact Info
                         ============================================= -->
                <div class="row center clear-bottommargin ">
                    <div class="col_md col-xs-hidden col-sm-hidden  bottommargin clearfix">
                    </div>
                    <div class="col-md-3 col-sm-6 bottommargin clearfix">
                        <div class="feature-box fbox-center fbox-bg fbox-plain">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-envelope"></i></a>
                            </div>
                            <h3>Email Us<span class="subtitle">mobitrash@gmail.com</span></h3>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 bottommargin clearfix">
                        <div class="feature-box fbox-center fbox-bg fbox-plain">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-phone3"></i></a>
                            </div>
                            <h3>Speak to Us<span class="subtitle">+91 9158285796</span></h3>
                        </div>
                    </div>

                </div><!-- Contact Info End -->

        <!-- <div class="row center dark"><small>Copyrights &copy; All Rights Reserved by Canvas Inc.</small></div> -->

            </div>
        </div>

    </div>

</section><!-- #content end -->
@stop
<!-- External JavaScripts
============================================= -->


