@extends('frontend.layouts.site')
@section('content')

<section id="slider" class="slider-parallax loginsec" data-height-lg="300" data-height-md="500" data-height-sm="250px" data-height-xs="250" data-height-xxs="200">
            <div class="slider-parallax-inner">
                <div class="container clearfix">
                    <div class="vertical-middle">

                        <div class="heading-block nobottomborder">
                            <h1>
                                <div>
                                 <span>Profile</span>
                                </div>
                            </h1>
                             <p>Your Account Information</p>
                        </div>

                    </div>
                </div>
            </div>
        </section>
<!-- <section id="page-title">

    <div class="container clearfix">
        <h1>My Account</h1>

    </div>

</section>  --> <!-- #page-title end -->

<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">
            <div class="sidebar nobottommargin">
                <div class="sidebar-widgets-wrap">
                    <div class="widget clearfix">
                        <div class="fancy-title title-bottom-border">
                            <h4>{{Auth::user()->name}}</h4>
                        </div>
                        <div id="headsub">
                            <ul class="icons iconlist-large iconlist-color">
                                <li><a href="{{route('user.myaccount.view')}}">Service Summary</a></li>
                                <li class="actives"><a href="{{route('user.subscription.view')}}">My Subscription</a></li>
                                <li><a href="{{route('user.payment.info')}}">Payment Info</a></li>
                                <li><a href="{{route('user.myprofile.view')}}">My Profile</a></li>
                                <li><a href="{{route('user.mypassword.view')}}">Change Password</a></li>
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
                        <h4>My Subscription</h4>
                    </div>
                    <div class="contact-widget">
                        <div class="contact-form-result"></div>
                        <?php if($subscription):?>
                        {!! Form::model(@$subscription, ['method' => 'post', 'route' => $action , 'class' => 'nobottommargin' ]) !!}

                        <div class="form-process"></div>
                        <div class="col_one_third">
                            <label for="template-contactform-phone">Subscription Name:</label>
                            {!! Form::text('name',@$subscription->name, ["class"=>"sm-form-control validate[required]" ,"disabled"=>"disabled"]) !!}
                        </div>
                        <div class="col_one_third">
                            <label for="template-contactform-phone">Address:</label>
                            {!! Form::text('address',@$address->address, ["class"=>"sm-form-control validate[required]" ,"disabled"=>"disabled"]) !!}
                        </div>

                        <div class="col_one_third">
                            <label for="template-contactform-service">City:</label>
                            {!! Form::text('city_id',@$address->cities->name, ["class"=>"sm-form-control validate[required]" ,"disabled"=>"disabled"]) !!}
                        </div>

                        <div class="col_one_third col_last">
                            <label for="template-contactform-phone">Pincode:</label>
                            {!! Form::text('pincode',@$address->pincode, ["class"=>"sm-form-control validate[required]" ,"disabled"=>"disabled","placeholder"=>"Pincode"]) !!}
                        </div>

                        <div class="clear"></div>

                        <div class="col_one_third">
                            <label for="template-contactform-service">Occupancy Category:</label>
                            {!! Form::text('occupancy_id',@$subscription->occupancy->name, ["class"=>"sm-form-control validate[required]" ,"disabled"=>"disabled","placeholder"=>"Occupancy Category"]) !!}
                        </div> 

                        <div class="col_one_third">
                            <label for="template-contactform-service">Waste Category:</label>
                            
                            {!! Form::text('wastetype_id', @$wastetypes, ["class"=>"sm-form-control validate[required]" ,"disabled"=>"disabled"]) !!}
                        </div>

                        <div class="col_one_third col_last">
                            <label for="template-contactform-phone">Max Waste Quantity (Kg):</label>
                            {!! Form::text('max_waste',null, ["class"=>"sm-form-control validate[required]" ,"disabled"=>"disabled","placeholder"=>"Max Waste Quantity (Kg)"]) !!}
                        </div>

                        <div class="clear"></div>

                        <div class="col_one_third">
                            <label for="template-contactform-service">Preferred Timeslot:</label>
                            {!! Form::text('prefered_timeslot',null, ["class"=>"sm-form-control validate[required]" ,"disabled"=>"disabled","placeholder"=>"Preferred Timeslot"]) !!}
                        </div>

                        <div class="col_one_third">
                            <label for="">Service Start Date:</label>
                            {!! Form::text('start_date',null, ["class"=>"sm-form-control validate[required]" ,"disabled"=>"disabled","placeholder"=>"Service Start Date"]) !!}
                        </div>

                        <div class="col_one_third col_last">
                            <label for="template-contactform-service">Agreement End Date:</label>
                            {!! Form::text('end_date',null, ["class"=>"sm-form-control validate[required]" ,"disabled"=>"disabled","placeholder"=>"Agreement End Date"]) !!}
                        </div>
                        <div class="clear"></div>
                        <div class="col_full">
                            <label for="login-form-username">Return oF Compost: <span class="tab-space">{{@$subscription->return_of_compost ? 'Yes':'No'}}</span></label>
                        </div>
                        <div class="col_one_third" style="{{@$subscription->return_of_compost?'display:block;':'display:none;'}}" id="weightpas">
                            <label for="login-form-password">Weekly Quantity :</label>
                            {!! Form::text('weekly_quantity',null, ["class"=>"sm-form-control" ,"disabled"=>"disabled","placeholder"=>"Weekly Quantity"]) !!}
                        </div>

                        <div class="col_two_third col_last">
                            <label for="template-contactform-phone">Remarks:</label>
                            {!! Form::text('remark',null, ["class"=>"sm-form-control" ,"disabled"=>"disabled","placeholder"=>"Remark"]) !!}
                        </div>
                        {!! Form::hidden('id',null) !!}
                        {!! Form::close() !!} 
                        <?php
                        else:
                            echo '<div>You are not subscribed!</div>';
                        endif; ?>
                    </div>
                </div><!-- .portfolio-single-image end -->
                <div class="clear"></div>
            </div>
        </div>

    </div>

</section><!-- #content end -->

@stop