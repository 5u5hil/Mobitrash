@extends('frontend.layouts.site')
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
                    <form id="login-form" name="login-form" class="nobottommargin" action="{{ route('user.register.save') }}" method="post">
                        <div class="col_full">
                            <label for="first_name">First Name <small>*</small></label>

                            <input type="text" id="first_name" name="first_name" value="" class="sm-form-control required validate[required]" />
                        </div>
                        <div class="col_full">
                            <label for="last_name">Last Name <small></small></label>
                            <input type="text" id="last_name" name="last_name" value="" class="sm-form-control required" />
                        </div>
                        <div class="col_full">
                            <label for="phone_number">Phone No: <small>*</small></label>
                            <input type="number" id="phone_number" name="phone_number" value=""  class="sm-form-control required validate[required]" />
                        </div>

                        <div class="col_full">
                            <label for="email">Email Id: <small>*</small></label>
                            <input type="text" id="email" name="email" value="" class="sm-form-control required validate[required,custom[email]]" />
                        </div>

                        <div class="col_full">
                            <label for="password">Password: <small>*</small></label>
                            <input type="password" id="password" name="password" value="" class="sm-form-control required validate[required]" />
                        </div>
                        <div class="col_full">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" id="confirm_password" name="confirm_password" value="" class="sm-form-control required validate[required,equals[password]]"/>
                        </div>
                        <div class="col-md-12 pull-left">	
                            <center>
                                <button type="submit" class="button button-3d button-black nomargin " id="register-form-submit">Register</button></center>
                        </div>
                    </form>
                </div>

                <div id="subscription-block" class="acctitle"><i class="acc-closed icon-play"></i><i class="acc-open icon-ok-sign"></i>Subscription Details</div>
                <div class="acc_content clearfix">
                    {!! Form::open( ['method' => 'post', 'route' => 'user.subscription.save' , 'class' => 'nobottommargin', 'id'=> 'sub-form', 'files'=>true ]) !!}

                    <div class="col_full">
                        <label for="template-contactform-message">Address <small>*</small></label>
                        {!! Form::textarea('address',null, ["class"=>'required sm-form-control validate[required]', "data-show-content" => "false"]) !!}

                    </div>
                    <div class="col_half">
                        <label for="template-contactform-service">City <small>*</small></label>
                        {!! Form::select('city',$cities,null, ["class"=>'required sm-form-control validate[required]', "data-show-content" => "false"]) !!}

                    </div>

                    <div class="col_half col_last">
                        <label for="template-contactform-phone">Pincode</label>
                        {!! Form::text('pincode',null, ["class"=>'required sm-form-control', "data-show-content" => "false"]) !!}

                    </div>

                    <div class="col_half">
                        <label for="template-contactform-service">Occupancy Category <small>*</small></label>
                        {!! Form::select('occupancy_id',$occupancy,null, ["class"=>'required sm-form-control validate[required]', "data-show-content" => "false"]) !!}

                    </div>

                    <div class="col_half col_last">
                        <label for="template-contactform-service">Waste Category <small>*</small></label>
                        {!! Form::select('wastetype[]',$wastetype, null, ["class"=>'required sm-form-control validate[required]', "required", "multiple" => true]) !!}

                    </div>

                    <div class="col_full">
                        <label for="template-contactform-phone">Max Waste Quantity (Kg): <small>*</small></label>
                        {!! Form::text('max_waste',null, ["class"=>'required sm-form-control validate[required]', "data-show-content" => "false"]) !!}

                    </div>
                    <div class="col_full">
                        <label for="login-form-username">Return oF Compost: <span class="tab-space"><a href="javascript:void(0);" id="yesweight">Yes</a> / <a href="javascript:void(0);" id="noweight">No</a></span></label>
                    </div>
                    <div class="col_full" style="display:none;" id="weightpas">
                        <label for="login-form-password">Weekly Quantity : </label>
                        {!! Form::text('weekly_quantity',null, ["class"=>' sm-form-control', "data-show-content" => "false"]) !!}

                    </div>

                    <div class="col_half">
                        <label for="template-contactform-service">Preferred Timeslot  <small>*</small></label>
                        {!! Form::select('timeslot_id',$timeslot,null, ["class"=>'required sm-form-control validate[required]', "data-show-content" => "false"]) !!}

                    </div>

                    <div class="col_half col_last">
                        <label for="template-contactform-service">Package  <small>*</small></label>
                        {!! Form::select('package_id',$packages, null, ["class"=>'sm-form-control validate[required]', "required"]) !!}
                    </div>


                    <div class="col_half">
                        <label for="">Service Start Date:</label>
                        <div class="input-group input-daterange travel-date-group">
                            {!! Form::text('start_date',null, ["class"=>'sm-form-control validate[required] datepicker', 'placeholder'=>'YYYY-MM-DD', "required"]) !!}

                        </div>
                    </div>

                    <div class="col_half col_last">
                        <label for="">Service Start Date:</label>
                        <div class="input-group input-daterange travel-date-group">
                            {!! Form::text('end_date',null, ["class"=>'sm-form-control validate[required] datepicker', 'placeholder'=>'YYYY-MM-DD', "required"]) !!}

                        </div>
                    </div>

                    <div class="col_full">
                        <label for="template-contactform-phone">Approximate Processing Time <small>*</small></label>
                        {!! Form::text('approximate_processing_time',null, ["class"=>'required sm-form-control validate[required] timepicker', "data-show-content" => "false"]) !!}

                    </div>
                    <div class="col_half">
                        <label for="template-contactform-service">Frequency  <small>*</small></label>
                        {!! Form::select('frequency_id',$frequency,null, ["class"=>'required sm-form-control validate[required]', "data-show-content" => "false"]) !!}

                    </div>

                    <div class="col_full">
                        <label for="template-contactform-message">Remarks <small>*</small></label>
                        {!! Form::textarea('remark',null, ["class"=>'sm-form-control validate[required]', "required"]) !!}

                    </div>
                    <center>
                        <div class="col_one_third nobottommargin">
                            <button type="submit" class="button button-3d button-black nomargin" id="subscribe-form-submit">Save</button>
                        </div>

                    </center>
                    {!! Form::close() !!}  
                </div>
                <div class="acctitle"><i class="acc-closed icon-money"></i><i class="acc-open icon-ok-sign"></i>Payment Due</div>
                <div class="acc_content clearfix">
                </div>
            </div>

        </div>

    </div>

</section><!-- #content end -->


@stop

@section("myscripts")
<script>

    $(document).ready(function () {
        $("#register-form-submit").click(function (e) {
            e.preventDefault();
            $.ajax({
                url: '<?= route('user.register.save') ?>',
                type: "POST",
                data: $("#login-form").serialize(),
                success: function (data) {
                    $("#subscription-block").click();
                    $(".acctitle").click(function (e) {
                        e.preventDefault();
                    });
                }

            });
        });

        $("#subscribe-form-submit").click(function (e) {
            e.preventDefault();
            $.ajax({
                url: '<?= route('user.subscription.save') ?>',
                type: "POST",
                data: $("#sub-form").serialize(),
                success: function (data) {
                    window.location.href = "/my-profile";
                }

            });
        });

    });

</script>



@stop


