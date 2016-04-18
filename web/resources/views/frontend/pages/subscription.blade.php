@extends('frontend.layouts.site')
@section('content')
<section id="page-title">

    <div class="container clearfix">
        <h1>My Account</h1>

    </div>

</section><!-- #page-title end -->

<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">
            <div class="sidebar nobottommargin">
                <div class="sidebar-widgets-wrap">
                    <div class="widget clearfix">
                        <div class="fancy-title title-bottom-border">
                            <h4>NEELYOG ANAND</h4>
                        </div>
                        <div id="headsub">
                            <ul class="icons iconlist-large iconlist-color">
                                <li><a href="{{route('user.myaccount.view')}}">Service Summary</a></li>
                                <li class="actives"><a href="{{route('user.subscription.view')}}">My Subscriptions</a></li>
                                <li><a href="{{route('user.myprofile.view')}}">My Profile</a></li>
                            </ul>

                        </div>
                    </div>

                </div>
            </div>

            <div class="postcontent col_last nobottommargin">

                <!-- Portfolio Single Image
                ============================================= -->
                <div class="col_full portfolio-single-image">
                    <div class="fancy-title title-bottom-border">
                        <h4>User Subscription</h4>
                    </div>
                    <div class="contact-widget">

                        <div class="contact-form-result"></div>

                        <form class="nobottommargin" id="template-contactform" name="template-contactform" action="include/sendemail.php" method="post">

                            <div class="form-process"></div>
                            <div class="col_one_third">
                                <label for="template-contactform-phone">Address:</label>
                                <input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="sm-form-control" disabled placeholder="Neelyog Anand, Laxmi Nagar, Ghatkopar East"/>
                            </div>

                            <div class="col_one_third">
                                <label for="template-contactform-service">City:</label>
                                <input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="sm-form-control" disabled placeholder="Mumbai"/>
                            </div>

                            <div class="col_one_third col_last">
                                <label for="template-contactform-phone">Pincode:</label>
                                <input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="sm-form-control" disabled placeholder="400075"/>
                            </div>

                            <div class="clear"></div>

                            <div class="col_one_third">
                                <label for="template-contactform-service">Occupancy Category:</label>
                                <input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="sm-form-control" disabled placeholder="Residential Society"/>
                            </div>

                            <div class="col_one_third">
                                <label for="template-contactform-service">Waste Category:</label>
                                <input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="sm-form-control" disabled placeholder="Wet Waste"/>
                            </div>

                            <div class="col_one_third col_last">
                                <label for="template-contactform-phone">Max Waste Quantity (Kg):</label>
                                <input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="sm-form-control" disabled placeholder="68"/>
                            </div>

                            <div class="clear"></div>

                            <div class="col_one_third">
                                <label for="template-contactform-service">Preferred Timeslot:</label>
                                <input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="sm-form-control" disabled placeholder="3PM - 6 PM"/>
                            </div>

                            <div class="col_one_third">
                                <label for="template-contactform-service">Package:</label>
                                <input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="sm-form-control" disabled placeholder="XYZ"/>
                            </div>

                            <div class="col_one_third col_last">
                                <label for="">Service Start Date:</label>
                                <input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="sm-form-control" disabled placeholder="15/04/2016"/>
                            </div>
                            <div class="clear"></div>
                            <div class="col_full">
                                <label for="login-form-username">Return oF Compost: <span class="tab-space"><a href="javascript:void(0);" id="yesweight">Yes</a></span></label>
                            </div>
                            <div class="col_full" style="display:none;" id="weightpas">
                                <label for="login-form-password">Weekly Quantity :</label>
                                <input type="text" id="login-form-password" name="login-form-password" value="" class="form-control" disabled/>
                            </div>
                            <div class="clear"></div>
                            <div class="col_one_third">
                                <label for="template-contactform-service">Agreement Duration:</label>
                                <input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="sm-form-control" disabled placeholder="12 Months"/>
                            </div>

                            <div class="col_two_third col_last">
                                <label for="template-contactform-phone">Remarks:</label>
                                <input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="sm-form-control" disabled placeholder="Come only within prefered time slot"/>
                            </div>

                            <center>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <button class="button button-3d button-black nomargin" id="register-form-submit" name="register-form-submit" value="register">Add New Subscription</button>
                                </div>
                            </center>

                        </form>

                    </div>
                </div><!-- .portfolio-single-image end -->
                <div class="clear"></div>
            </div>
        </div>

    </div>

</section><!-- #content end -->

@stop