@extends('frontend.layouts.site')
@section('content')
<section id="page-title">

    <div class="container clearfix">
        <h1>My Account</h1>

    </div>

</section><!-- #page-title end -->

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
                                <li><a href="{{route('user.subscription.view')}}">My Subscriptions</a></li>
                                <li><a href="{{route('user.myprofile.view')}}">My Profile</a></li>
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
                        <h4>SERVICE SUMMARY</h4>
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
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: new Date(),
            defaultView: 'month',            
            editable: false,
            <?php 
            $data = '[';
            foreach($services as $service){
                $data .= '{
                    title:\'Service\',
                    start: \''.$service->created_at.'\'
                },';
            }
               $data .= ']';
                ?>
            events: <?php echo $data; ?>
        });
    });
</script>



@stop
