@extends('frontend.layouts.site')
@section('content')
<style>
    .s-td{
        width: 30%;
    }
    .subscription-details tr td{
        height: 50px;
        line-height: 50px;
        border-bottom: 1px solid #e8e8e8;
    }
</style>


<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">
            <ul class="nav nav-tabs mb30">
                <li class="active"><a>Kitchen Waste</a></li>
                <li><a href="{{route('garden.waste')}}">Garden Waste</a></li>
            </ul>
            <div class="sidebar nobottommargin">
                <div class="sidebar-widgets-wrap">
                    <div class="widget clearfix">
                        <div class="fancy-title title-bottom-border">
                            <h3>{{ @Auth::user()->subscriptions()->first()->name }}</h3>
                        </div>
                        <div id="headsub">
                            <ul class="icons iconlist-large iconlist-color">
                                <li class="actives"><a href="{{route('user.subscription.view')}}">My Subscription</a></li>
                                <li><a href="{{route('user.myaccount.view')}}">Service Summary</a></li>                                
                                <li><a href="{{route('user.payment.info')}}">Payment Info</a></li>
<!--                                <li><a href="{{route('user.myprofile.view')}}">My Profile</a></li>
                                <li><a href="{{route('user.mypassword.view')}}">Change Password</a></li>-->
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
                        <h3>My Subscription</h3>
                    </div>
                    <div class="contact-widget ">
                         <?php if ($subscription):?>
                        <table class="subscription-details" style="width: 100%;">
                        <tr>
                            <td class="s-td">Subscription Name:</td><td>{{@$subscription->name}}</td>
                        </tr>
                        <tr>
                            <td class="s-td">Address:</td><td>{{@$address->address}}</td>
                        </tr>
                        <tr>
                            <td class="s-td">City:</td><td>{{@$address->cities->name}}</td>
                        </tr>
                        <tr>
                            <td class="s-td">Pincode:</td><td>{{@$address->pincode}}</td>
                        </tr>
                        <tr>
                            <td class="s-td">Frequency of Service:</td><td>{{@$subscription->occupancy->name}}</td>
                        </tr>
                        <!-- <tr>
                            <td class="s-td">Occupancy Category:</td><td>{{@$subscription->occupancy->name}}</td>
                        </tr> -->
                        <tr>
                            <td class="s-td">Waste Category:</td><td>{{@$wastetypes}}</td>
                        </tr>
                        <tr>
                            <td class="s-td">Max Waste Quantity (Kg):</td><td>{{@$subscription->max_waste}}</td>
                        </tr>
                        <tr>
                            <td class="s-td">Preferred Timeslot:</td><td>{{@$subscription->prefered_timeslot}}</td>
                        </tr>
                        <tr>
                            <td class="s-td">Service Start Date:</td><td>{{@$subscription->start_date}}</td>
                        </tr>
                        <tr>
                            <td class="s-td">Agreement End Date:</td><td>{{@$subscription->end_date}}</td>
                        </tr>
                        <tr>
                            <td class="s-td">Return of Compost:</td><td>{{@$subscription->return_of_compost ? 'Yes':'No'}}</td>
                        </tr>
                        <tr>
                            <td class="s-td">Weekly Quantity:</td><td>{{@$subscription->weekly_quantity}}</td>
                        </tr>
                        <tr>
                            <td class="s-td">Remarks:</td><td>{{@$subscription->Remarks}}</td>
                        </tr>
                        </table>

                       <?php
                        else:
                            echo '<div>You are not subscribed!</div>';
                        endif;
                        ?>
                    </div>
                </div><!-- .portfolio-single-image end -->
                <div class="clear"></div>
            </div>
        </div>

    </div>

</section><!-- #content end -->

@stop