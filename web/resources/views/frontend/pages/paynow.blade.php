@extends('frontend.layouts.site')
@section('content')
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
                        <h4>Confirm Payment Details</h4>
                    </div>
                    <div class="">  
                        {!! Form::model($user, ['method' => 'post', 'route' => 'payment.paytm' , 'class' => 'nobottommargin' ]) !!}
                        <div class="form-process"></div>
                        <div class="col_one_third">
                            <label for="firstname">Name:</label><small>*</small>
                            {!! Form::text('name',null, ["class"=>"sm-form-control validate[required]" ,"placeholder"=>"Name" ,"disabled"]) !!}
                        </div>

                        <div class="col_one_third">
                            <label for="phone-number">Phone No:</label><small>*</small>
                            {!! Form::text('phone_number',null, ["class"=>"sm-form-control validate[required,custom[number]]","disabled" ,"placeholder"=>"Phone No"]) !!}
                        </div>

                        <div class="col_one_third col_last">
                            <label for="email">Email Id:</label><small>*</small>
                            {!! Form::text('email',null, ["class"=>"sm-form-control validate[required,custom[email]]","disabled" ,"placeholder"=>"Email Address"]) !!}
                        </div>
                        <div>
                            <h4 class="text-right">Amount Payable : {{ $amt }}</h4>
                        </div>



                        <div class="clear"></div>

                        <div class="text-right">
                            <button type="submit" class="button button-3d button-black nomargin">Confirm & Pay</button>
                        </div>

                        {!! Form::hidden('id',$id) !!}
                        {!! Form::hidden('payment_for','subscription') !!}
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
