@extends('frontend.layouts.site')
@section('content')
<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">
            <div class="sidebar nobottommargin">
                <div class="sidebar-widgets-wrap">
                    <div class="widget clearfix">
                        <div class="fancy-title title-bottom-border">
                            <h3>{{ @Auth::user()->subscriptions()->first()->name }}</h3>
                        </div>
                        <div id="headsub">
                            <ul class="icons iconlist-large iconlist-color">
                                <li><a href="{{route('user.myaccount.view')}}">Service Summary</a></li>
                                <li><a href="{{route('user.subscription.view')}}">My Subscription</a></li>
                                <li class="actives"><a href="{{route('user.payment.info')}}">Payment Info</a></li>
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
                        <h3>Payment Info</h3>
                    </div>
                    <div>  
                        <div class="table-responsive">
                            <table class="table table-bordered nobottommargin">
                                <thead>
                                    <tr>
                                        <th>Subscription</th>
                                        <th>Invoice Date/Month</th>
                                        <th>Invoice Amount</th>
                                        <th>Payment Date</th>
                                        <th>Remark</th>
                                        <th>Attachment</th>
                                        <th>Payment Made</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payments as $payment)
                                    <tr>
                                        <td>{{@$payment->subscription->name}}</td>
                                        <td>{{@$payment->billing_method == 1 ? date('M Y', strtotime($payment->invoice_month)) : date('d M Y', strtotime($payment->invoice_date))}}</td>
                                        <td>{{@$payment->invoice_amount}}</td>

                                        <td>{{ ($payment->payment_made == 1 || $payment->payment_made == 2) ? date('d M Y', strtotime(@$payment->payment_date)) : '-' }}</td>
                                        <td>{{@$payment->remark}}</td>
                                        <td>


                                            @if(!empty($payment->file))
                                            <a href="{{ Config('constants.uploadRecord').@$payment->file }}" target="_BLANK"><i class="fa fa-paperclip attachfileicon" aria-hidden="true"></i></a>
                                            @endif
                                        </td>
                                        <td>

                                            @if($payment->payment_made == 0)
                                            <a href="{{ route("payment.paynow",['id' =>$payment->id ])}}" class="btn btn-success btn-small">Pay Now</a>
                                            @elseif($payment->payment_made == 2)
                                            Pending
                                            @else 
                                            Yes
                                            @endif

                                        </td>
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
