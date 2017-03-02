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
                                <li><a href="{{route('garden.waste')}}">Schedule Pickup</a></li>
                                <li><a href="{{route('garden.waste.emptygunny')}}">Order Bags</a></li>
                                <li class="actives"><a href="{{route('user.pickup.history')}}">Pickup History</a></li>
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
                        <h3>Pickup History</h3>
                    </div>
                    <div class="col-md-7">
                       
                        <div class="drop-address">
                            <div class='addresses'> 
                                    <table style="width: 100%;border-bottom: 1px solid #ccc;margin-bottom: 10px;">
                                        <tr><td style="padding: 5px 0px;">Pickup Id</td><td style="font-weight: bold;text-align: right;">{{@$pickup->id}}</td></tr>
                                    </table>
                                    <table style="width: 100%;border-bottom: 1px solid #ccc;margin-bottom: 10px;">
                                        <tr><td style="padding: 5px 0px;">Garden Gunny Bags</td><td style="font-weight: bold;text-align: right;">{{@$pickup->gunny_bags}}</td></tr>
                                        <tr><td style="padding: 5px 0px;">Pickup Date</td><td  style="font-weight: bold;text-align: right;">{{@$pickup->pickup_date}}</td></tr>
                                        <tr><td style="padding: 5px 0px;">Net Amount Paid</td><td  style="font-weight: bold;text-align: right;">Rs. {{@$pickup->amount}}</td></tr>
                                    </table>
                                    <table style="width: 100%;border-bottom: 1px solid #ccc;margin-bottom: 10px;">
                                        <tr><td style="padding: 5px 0px;">Pickup Attempted At</td><td style="font-weight: bold;text-align: right;">{{@$pickup->pickup_attempted_at}}</td></tr>
                                        <tr><td style="padding: 5px 0px;">Pickup Status</td><td  style="font-weight: bold;text-align: right;">{{@$pickup->status}}</td></tr>
                                        <tr><td style="padding: 5px 0px;">Remark</td><td  style="font-weight: bold;text-align: right;">{{@$pickup->remark}}</td></tr>
                                    </table>
                            </div>
                                                 
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
    $(document).ready(function () {
        
    });
</script>
@stop