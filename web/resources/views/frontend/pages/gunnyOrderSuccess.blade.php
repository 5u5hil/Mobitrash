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
            <div class="sidebar nobottommargin">
                <div class="sidebar-widgets-wrap">
                    <div class="widget clearfix">
                        <div class="fancy-title title-bottom-border">
                            <h3></h3>
                        </div>
                        <div id="headsub">
                            <ul class="icons iconlist-large iconlist-color">
                                <li><a href="{{route('garden.waste')}}">Schedule Pickup</a></li>
                                <li class="actives"><a href="{{route('garden.waste.emptygunny')}}">Empty Gunny</a></li>
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
                        <h3>Empty Gunny</h3>
                    </div>
                    <div class="fancy-title title-bottom-border">
                        <h4><?= $success == 1 ? 'Thank you! Your order for empty gunny bags has been received successfully ! <br><a href="'.route('garden.waste').'">Click here to Schedule Garden Waste Pickup.</a>' : ( $success == 2 ? 'Thank You! Your Payment is under review & in Pending status for now. We will update you shortly' : 'Oops! Looks like something went wrong.') ?></h4>
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
