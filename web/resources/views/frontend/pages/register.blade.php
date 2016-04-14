@extends('frontend.layouts.default')
@section('content')
<section id="page-title">

    <div class="container clearfix">
        <h1>Register</h1>
    </div>

</section><!-- #page-title end -->

<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">

            <div class="accordion accordion-lg divcenter nobottommargin clearfix" style="max-width: 550px;">

                <div class="acctitle"><i class="acc-closed icon-lock3"></i><i class="acc-open icon-unlock"></i>Register</div>
                <div class="acc_content clearfix">
                    <form id="login-form" name="login-form" class="nobottommargin" action="{{ route('check_user') }}" method="post">
                        <div class="col_full">
                            <label for="template-contactform-name">Name <small>*</small></label>
                            <input type="text" id="template-contactform-name" name="template-contactform-name" value="" class="sm-form-control required" />
                        </div>
                        <div class="col_full">
                            <label for="template-contactform-name">Phone No: <small>*</small></label>
                            <input type="text" id="template-contactform-name" name="template-contactform-name" value="" class="sm-form-control required" />
                        </div>

                        <div class="col_full">
                            <label for="template-contactform-name">Email Id: <small>*</small></label>
                            <input type="text" id="template-contactform-name" name="template-contactform-name" value="" class="sm-form-control required" />
                        </div>

                        <div class="col_full">
                            <label for="template-contactform-name">Password: <small>*</small></label>
                            <input type="password" id="login-form-password" name="login-form-password" value="" class="sm-form-control required" />
                        </div>
                        <div class="col_full">
                            <label for="template-contactform-name">Confirm Password:</label>
                            <input type="password" id="login-form-password" name="login-form-password" value="" class="sm-form-control required"/>
                        </div>
                        <div class="col-md-12 pull-left">	
                            <center>
                                <button class="button button-3d button-black nomargin " id="register-form-submit" name="register-form-submit" value="register">Register</button></center>
                        </div>
                    </form>
                </div>

                <div class="acctitle"><i class="acc-closed icon-play"></i><i class="acc-open icon-ok-sign"></i>Subscription Details</div>
                <div class="acc_content clearfix">
                    <form id="register-form" name="register-form" class="nobottommargin" action="#" method="post">
                        <div class="col_full">
                            <label for="template-contactform-message">Address <small>*</small></label>
                            <textarea class="required sm-form-control" id="template-contactform-message" name="template-contactform-message" rows="6" cols="30"></textarea>
                        </div>
                        <div class="col_half">
                            <label for="template-contactform-service">City</label>
                            <select id="template-contactform-service" name="template-contactform-service" class="sm-form-control">
                                <option value=""> Select One </option>
                                <option value="Wordpress">Wordpress</option>
                                <option value="PHP / MySQL">PHP / MySQL</option>
                                <option value="HTML5 / CSS3">HTML5 / CSS3</option>
                                <option value="Graphic Design">Graphic Design</option>
                            </select>
                        </div>

                        <div class="col_half col_last">
                            <label for="template-contactform-phone">Pincode</label>
                            <input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="sm-form-control" />
                        </div>

                        <div class="col_half">
                            <label for="template-contactform-service">Occupancy Category</label>
                            <select id="template-contactform-service" name="template-contactform-service" class="sm-form-control">
                                <option value="">-- Select One --</option>
                                <option value="Wordpress">Residential Society</option>
                                <option value="PHP / MySQL">Restaurant/Hotel</option>
                                <option value="HTML5 / CSS3">Corporate Office</option>
                                <option value="Graphic Design">Educational Institute</option>
                                <option value="Graphic Design">Hospital</option>
                                <option value="Graphic Design">Factory/Industry</option>
                                <option value="Graphic Design">Others- allow them to enter the category</option>
                            </select>
                        </div>

                        <div class="col_half col_last">
                            <label for="template-contactform-service">Waste Category</label>
                            <select id="template-contactform-service" name="template-contactform-service" class="sm-form-control">
                                <option value="">-- Select One --</option>
                                <option value="Wordpress">Wordpress</option>
                                <option value="PHP / MySQL">PHP / MySQL</option>
                                <option value="HTML5 / CSS3">HTML5 / CSS3</option>
                                <option value="Graphic Design">Graphic Design</option>
                            </select>
                        </div>

                        <div class="col_full">
                            <label for="template-contactform-phone">Max Waste Quantity (Kg):</label>
                            <input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="sm-form-control" />
                        </div>
                        <div class="col_full">
                            <label for="login-form-username">Return oF Compost: <span class="tab-space"><a href="javascript:void(0);" id="yesweight">Yes</a> / <a href="javascript:void(0);" id="noweight">No</a></span></label>
                        </div>
                        <div class="col_full" style="display:none;" id="weightpas">
                            <label for="login-form-password">Weekly Quantity :</label>
                            <input type="text" id="login-form-password" name="login-form-password" value="" class="form-control" />
                        </div>

                        <div class="col_half">
                            <label for="template-contactform-service">Preferred Timeslot</label>
                            <select id="template-contactform-service" name="template-contactform-service" class="sm-form-control">
                                <option value="">-- Select One --</option>
                                <option value="Wordpress">Wordpress</option>
                                <option value="PHP / MySQL">PHP / MySQL</option>
                                <option value="HTML5 / CSS3">HTML5 / CSS3</option>
                                <option value="Graphic Design">Graphic Design</option>
                            </select>
                        </div>

                        <div class="col_half col_last">
                            <label for="template-contactform-service">Package</label>
                            <select id="template-contactform-service" name="template-contactform-service" class="sm-form-control">
                                <option value="">-- Select One --</option>
                                <option value="Wordpress">Wordpress</option>
                                <option value="PHP / MySQL">PHP / MySQL</option>
                                <option value="HTML5 / CSS3">HTML5 / CSS3</option>
                                <option value="Graphic Design">Graphic Design</option>
                            </select>
                        </div>


                        <div class="col_half">
                            <label for="">Service Start Date:</label>
                            <div class="input-group input-daterange travel-date-group">
                                <input type="text" value="" class="sm-form-control tleft past-enabled" placeholder="MM/DD/YYYY">
                                <span class="input-group-addon" style="padding: 9px 12px;">
                                    <i class="icon-calendar2"></i>
                                </span>
                            </div>
                        </div>

                        <div class="col_half col_last">
                            <label for="template-contactform-service">Agreement Duration</label>
                            <select id="template-contactform-service" name="template-contactform-service" class="sm-form-control">
                                <option value="">-- Select One --</option>
                                <option value="Wordpress">Wordpress</option>
                                <option value="PHP / MySQL">PHP / MySQL</option>
                                <option value="HTML5 / CSS3">HTML5 / CSS3</option>
                                <option value="Graphic Design">Graphic Design</option>
                            </select>
                        </div>

                        <div class="col_full">
                            <label for="template-contactform-message">Remarks <small>*</small></label>
                            <textarea class="required sm-form-control" id="template-contactform-message" name="template-contactform-message" rows="6" cols="30"></textarea>
                        </div>
                        <center>
                            <div class="col_one_third nobottommargin">
                                <button class="button button-3d button-black nomargin" id="register-form-submit" name="register-form-submit" value="register">Save</button>
                            </div>
                            <div class="col_one_third col_last">
                                <button class="button button-3d button-black nomargin" id="register-form-submit" name="register-form-submit" value="register">Add Subscription</button>
                            </div>
                        </center>
                    </form>
                </div>
                <div class="acctitle"><i class="acc-closed icon-money"></i><i class="acc-open icon-ok-sign"></i>Payment Due</div>
                <div class="acc_content clearfix">
                </div>
            </div>

        </div>

    </div>

</section><!-- #content end -->

@stop