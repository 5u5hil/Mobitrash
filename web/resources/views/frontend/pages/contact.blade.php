@extends('frontend.layouts.site')
@section('content')

<!-- <section id="slider" class="slider-parallax loginsec" data-height-lg="300" data-height-md="500" data-height-sm="250px" data-height-xs="250" data-height-xxs="200">
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
</section> -->
<section id="content" style="margin-bottom: 0px;">
    <div class="secpad" style="background: url('http://mobitrash.in/public/Frontend/images/parallax/home/clouds-background.jpg') no-repeat;
         background-size: 100% auto;padding-bottom: 237px;padding-top:88px">
        <div class="container clearfix">
            <div class="col_full">
                <div class="nobg full-screen" style="overflow:visible;max-height:825px;">
                    <div class="container vertical-middle divcenter clearfix">
                        <div class="row center">
                            <div class="container clearfix">
                                <h1 class="contex conhead">Contact Us</h1>
                                <!-- <h1 class="contex conhead">Thank you</h1> -->
                                <!-- <h4 class="contex">For Being A Concerned Citizen </h4> -->
                            </div>
                        </div>
                        <div class="flash-message conmessg">
                            {{@Session::pull('contactSuccess')}}
                            {{@Session::pull('contactError')}}
                        </div>

                        <div class="panel-default divcenter noradius noborder" style="max-width:500px;">
                            <div class="panel-body" style="padding:2px;">
                                <form id="login-form" name="login-form" class="nobottommargin" action="{{ route($action)}}" method="post">
                                    @if(!Auth::id())<center><!-- <h4 class="consub">Become a Mobitrasher</h4> --></center>@endif

                                    <div class="col_full">
                                        <input type="text" id="name" name="name" value="" class="sm-form-control required  validate[required]" aria-required="true" placeholder="Name ">
                                    </div>

                                    <div class="col_full">
                                        <input type="text" id="email" name="email" value="" class="sm-form-control required  validate[required]" aria-required="true" placeholder="Email Id ">
                                    </div>

                                    <div class="col_full">
                                        <input type="text" id="phone" name="phone_number" value="" class="sm-form-control required  validate[required]" aria-required="true" placeholder="Phone No ">
                                    </div>

                                    <div class="col_full">
                                        <select id="location" name="location"  class="sm-form-control required  validate[required]" aria-required="true" placeholder="Location ">
                                            <option value="">Select Your Location</option>
                                            <?php
                                            foreach ($city as $val) {
                                                echo '<option value="'.$val['id'].'">'.$val['name'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
                                    <div class="col_full">
                                        <input type="text" id="other-city" name="city_name" style="display: none;" value="" disabled="true" class="sm-form-control required  validate[required]" aria-required="true" placeholder="Enter your city">
                                    </div>
                                    <center>
                                        <button type="submit" class="button button-3d button-rounded button-green">Submit</button>
                                    </center>
                                    <div class="line line-sm"></div>
                                </form>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <!-- Contact Info
                                 ============================================= -->
                        <div class="row center clear-bottommargin ">
                            <div class="col_md col_con col-xs-hidden col-sm-hidden  bottommargin clearfix">
                            </div>
                            <div class="col-md-3 col-sm-6 bottommargin clearfix">
                                <div class="team">
                                    <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
                                        <div class="fbox-icon">
                                            <i class="fa fa-envelope-o"></i>
                                        </div>
                                        <h3 class="mobiupper">Email Us<span class="subtitle">getit@mobitrash.in</span></h3>
                                    </div> 

                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 bottommargin clearfix">
                                <div class="team">
                                    <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
                                        <div class="fbox-icon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <h3 class="mobiupper">Speak to Us<span class="subtitle">+91 9158285796</span></h3>
                                    </div> 

                                </div>
                            </div>

                        </div><!-- Contact Info End -->

        <!-- <div class="row center dark"><small>Copyrights &copy; All Rights Reserved by Canvas Inc.</small></div> -->

                    </div>
                </div>
                <div class="col_full">


                </div>
            </div>

        </div>


</section>
@stop
@section("myscripts")
<script>
    $(document).ready(function () {
        $('#location').change(function (e) {            
            var option = $(this).find("option:selected").text();            
            if(option == 'Other'){
                $('#other-city').slideDown().prop('disabled', false);
            }else{
                $('#other-city').slideUp().prop('disabled', true);
            }
        });
    });
</script>
@stop

<!-- External JavaScripts
============================================= -->


