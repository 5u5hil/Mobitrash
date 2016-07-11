@extends('frontend.layouts.site')
@section('content')
<!--<section id="slider" class="slider-parallax loginsec" data-height-lg="300" data-height-md="500" data-height-sm="250px" data-height-xs="250" data-height-xxs="200">
    <div class="slider-parallax-inner">
        <div class="container clearfix">
            <div class="vertical-middle">

                <div class="heading-block nobottomborder">
                    <h1>
                        <div>
                            <span>Payment Details</span>
                        </div>
                    </h1>
                    <p>Your Payment Information</p>
                </div>

            </div>
        </div>
    </div>
</section>-->

<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">
            <div class="sidebar nobottommargin">
                <div class="sidebar-widgets-wrap">
                    <div class="widget clearfix">
                        <div class="fancy-title title-bottom-border">
                            <h4>{{ @Auth::user()->subscriptions()->first()->name }}</h4>
                        </div>
                        <div id="headsub">
                            <ul class="icons iconlist-large iconlist-color">
                                <li><a href="{{route('user.myaccount.view')}}">Service Summary</a></li>
                                <li><a href="{{route('user.subscription.view')}}">Subscription</a></li>
                                <li class="actives"><a href="{{route('user.payment.info')}}">Payment Info</a></li>
                                <li><a href="{{route('user.myprofile.view')}}">Profile</a></li>
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
                        <h4>{{ $success == 1 ? 'Thank you! We have received your payment.' : ( $success == 2 ? 'Thank You! Your Payment is under review & in Pending status for now. We will update you shortly' : 'Oops! Looks like something went wrong.') }}</h4>
                    </div>
                </div>
            </div><!-- .portfolio-single-image end -->
            <div class="clear"></div>
        </div>
    </div>

</div>

</section><!-- #content end -->
@stop


@section("myscripts")
<script>
</script>



@stop
