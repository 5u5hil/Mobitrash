@extends('frontend.layouts.site')
@section('content')

<section id="content">
    <div class="content-wrap">
        <div class="flash-message green">
            {{Session::pull('message')}}
        </div>
        <div class="flash-message red">
            {{Session::pull('messageError')}}  
        </div>
        <div class="container clearfix">
            <ul class="nav nav-tabs mb30">
                <li class=""><a href="{{route('user.subscription.view')}}">Kitchen Waste</a></li>
                <li class="active"><a>Garden Waste</a></li>
            </ul>
            <div class="sidebar nobottommargin">
                <div class="sidebar-widgets-wrap">
                    <div class="widget clearfix">
                        <div class="fancy-title title-bottom-border">
                            <h3></h3>
                        </div>
                        <div id="headsub">
                            <ul class="icons iconlist-large iconlist-color">
                                <li class="actives"><a href="{{route('garden.waste')}}">Schedule Pickup</a></li>
                                <li><a href="{{route('garden.waste.emptygunny')}}">Order Bags</a></li>
                                <li><a href="{{route('user.pickup.history')}}">Pickup History</a></li>
                                <li><a href="{{route('user.message.view')}}">Message Us</a></li>
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
                        <h3>Schedule Pickup</h3>
                    </div>
                    <div class="col-md-7">
                        <div class="fancy-title title-bottom-border">
                            <h4>Confirm Payment Details</h4>
                        </div>
                        <div class="">  
                            {!! Form::model($user, ['method' => 'post', 'route' => 'payment.paytm' , 'class' => 'nobottommargin' ]) !!}
                            <div class="form-process"></div>
                            <div class="">
                                <label for="firstname">Name:</label><small>*</small>
                                {!! Form::text('name',null, ["class"=>"sm-form-control validate[required]" ,"placeholder"=>"Name" ,"disabled"]) !!}
                            </div>

                            <div class="">
                                <label for="phone-number">Phone No:</label><small>*</small>
                                {!! Form::text('phone_number',null, ["class"=>"sm-form-control validate[required,custom[number]]","disabled" ,"placeholder"=>"Phone No"]) !!}
                            </div>

                            <div class="">
                                <label for="email">Email Id:</label><small>*</small>
                                {!! Form::text('email',null, ["class"=>"sm-form-control validate[required,custom[email]]","disabled" ,"placeholder"=>"Email Address"]) !!}
                            </div>
                            <div style="height: 65px;padding: 21px 0px;">
                                <h4 class="text-right">Amount Payable : Rs. {{ $amount }}</h4>
                            </div>



                            <div class="clear"></div>

                            <div class="text-right">
                                <button type="submit" class="button button-3d button-black nomargin">Confirm & Pay</button>
                            </div>

                            {!! Form::hidden('id',$id) !!}
                            {!! Form::hidden('payment_for',$payment_for) !!}
                            {!! Form::close() !!}  



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
