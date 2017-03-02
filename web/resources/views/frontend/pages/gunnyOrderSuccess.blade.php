@extends('frontend.layouts.site')
@section('content')
<style>
    .gunny-form label{
        margin-top: 13px;
        margin-bottom: 3px;
    }
</style>
<section id="content">
    <div class="content-wrap">
        <div class="flash-message green">
            {{Session::pull('messageSuccess')}}
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
                                <li class="actives"><a href="{{route('garden.waste.emptygunny')}}">Order Bags</a></li>
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
                        <h3>Order Bags</h3>
                    </div>
                    <div class="fancy-title title-bottom-border">
                        <?php if($success == 1): ?><div style="position: absolute; width: 85px; height: 85px; font-size: 50px; border: 2px solid #87c540; color:#87c540;  border-radius: 50%;text-align: center;"><i class="icon icon-ok"></i></div><?php endif; ?>
                        <h4 style="margin-left: 100px; padding-top: 16px;"><?= $success == 1 ? 'Your request for empty gunny bags have been placed!</a>' : ( $success == 2 ? 'Thank You! Your Payment is under review & in Pending status for now. We will update you shortly' : 'Oops! Looks like something went wrong.') ?></h4>
                    </div>
                    <?php if($success == 1 && $gunnyOrder): ?>
                    <div class="col-md-6 pickup-summary" style="margin-top: 25px;">
                        <h4>Empty Gunny Drop Request Summary</h4>
                        <table style="width: 100%;">
                            <tr><td>Empty Garden Gunny Bags</td><td class="bag_count" style="font-weight: bold;text-align: right;"><?= $gunnyOrder['no_of_bags'] ?></td></tr>
                            <!--<tr><td>Pickup Date</td><td  style="font-weight: bold;text-align: right;"><span class="display-pickup-date"></span></td></tr>-->
                            <tr><td>Drop Address</td><td  style="font-weight: bold;text-align: right;"><?= $gunnyOrder['address']['address_line_1'] .', '. $gunnyOrder['address']['address_line_2'] . ', ' . $gunnyOrder['address']['locality'] . ', ' . $gunnyOrder['address']['city'] . ', ' . $gunnyOrder['address']['pincode'] ?></td></tr>
                        </table>
                        
                    </div>
                    <?php endif; ?>
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
