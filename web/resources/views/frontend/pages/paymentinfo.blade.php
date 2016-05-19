@extends('frontend.layouts.site')
@section('content')
<section id="slider" class="slider-parallax loginsec" data-height-lg="300" data-height-md="500" data-height-sm="400" data-height-xs="250" data-height-xxs="200">
    <div class="slider-parallax-inner">
        <div class="container clearfix">
            <div class="vertical-middle">

                <div class="heading-block nobottomborder">
                    <h1>
                        <div>
                            <span>Payment Info</span>
                        </div>
                    </h1>
                    <p>Your Account Information</p>
                </div>

            </div>
        </div>
    </div>
</section>

<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">
            <div class="sidebar nobottommargin">
                <div class="sidebar-widgets-wrap">
                    <div class="widget clearfix">
                        <div class="fancy-title title-bottom-border">
                            <h4>{{$user->name}}</h4>
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
                        <h4>Payment Info</h4>
                    </div>
                    <div>  
                        <div class="table-responsive">
                          <table class="table table-bordered nobottommargin">
                            <thead>
                              <tr>
                                <th>Subscription</th>
                                <th>Invoice Date/Month</th>
                                <th>Invoice Amount</th>
                                <th>Payment Made</th>
                                <th>Payment Date</th>
                                <th>Remark</th>
                                <th>Attachment</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $payment)
                              <tr>
                                <td>{{@$payment->subscription->name}}</td>
                                <td>{{@$payment->billing_method == 1 ? date('M Y', strtotime($payment->invoice_month)) : date('d M Y', strtotime($payment->invoice_date))}}</td>
                                <td>{{@$payment->invoice_amount}}</td>
                                <td>{{@$payment->payment_made == 1? 'Yes' : 'No'}}</td>
                                <td>{{ $payment->payment_date ? date('d M Y', strtotime(@$payment->payment_date)) : '' }}</td>
                                <td>{{@$payment->remark}}</td>
                                <td><a href="{{ Config('constants.uploadRecord').@$payment->file }}" target="_BLANK"><i class="fa fa-paperclip attachfileicon" aria-hidden="true"></i></a></td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
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
