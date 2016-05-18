@extends('frontend.layouts.site')
@section('content')
<style>
    p, pre, ul, ol, dl, dd, blockquote, address, table, fieldset, form {
    margin-bottom: 10px;
}
</style>
<section id="slider" class="slider-parallax loginsec" data-height-lg="300" data-height-md="500" data-height-sm="400" data-height-xs="250" data-height-xxs="200">
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

</section> -->  <!-- #page-title end -->

<!-- Content
============================================= -->
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
                                <li class="actives"><a href="{{route('user.myaccount.view')}}">Service Summary</a></li>
                                <li><a href="{{route('user.subscription.view')}}">My Subscription</a></li>
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
                        <h4>Service Summary</h4>
                    </div>
                    <div id='calendar'></div>
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
<?php
$data = '[';
foreach ($services as $service) {

    $data .= "{
                    title:'',
                    start: '" . $service->created_at . "'
                }, ";
    foreach ($service->wastetypes as $waste):
        $data .= "{
                    title: '" . $waste->name . ": " . $waste->pivot->quantity . " kg.',
                    allDay: true,
                    start: '" . $service->created_at . "'
                }, ";
    endforeach;
}
$data .= ']';
?>
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month'
            },
            defaultDate: new Date(),
            defaultView: 'month',
            editable: false,
            timeFormat: 'LT',
            events: <?php echo $data;
?>
        });
<?php
foreach ($services as $service) {
    $day = explode(' ', $service->created_at);
    echo "$('.fc-day[data-date=\"" . $day[0] . "\"]').css('background', '#95BB56');";
}
?>
    });
</script>



@stop
