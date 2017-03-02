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
                                <li><a href="{{route('user.pickup.history')}}">Pickup History</a></li>
                                <li class="actives"><a href="{{route('user.message.view')}}">Message Us</a></li>
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
                        <h3>Message Us</h3>
                    </div>
                    <div class="col-md-7" style="padding-left: 0px;">
                        <div class="gunny-bags">  
                            <h4></h4>

                            <div class="form-process"></div>
                            <div class=" gunny-form">
                                {!! Form::model(null, ['method' => 'post','route' => $action , 'class' => 'nobottommargin gunny-bag-count' ]) !!}
                                {!! Form::textarea('msg',null, ["class"=>"sm-form-control validate[required]", "rows"=>"6", "placeholder"=>"Leave your queries, comments, concerns & feedback. We shall get back to you for sure!"]) !!}
                                <button type="submit" class="button button-3d button-black gunny-bag-button" style="width: 100%;margin: 15px 0px;">Submit</button>
                                {!! Form::hidden('user_id',Auth::id()) !!}
                                {!! Form::close() !!} 
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-4 pickup-summary" style="display: none;">
                        <h4></h4>
                        
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