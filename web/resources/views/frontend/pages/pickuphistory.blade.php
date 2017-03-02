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
                    <div class="col-md-7" style="padding-left: 0px;">
                 
                        <div class="table-responsive">
                            <table class="table table-bordered nobottommargin">
                                <thead>
                                    <tr>
                                        <th>Pickup Date</th>
                                        <th>Pickup Id</th>
                                        <th>Garden Gunny</th>
                                        <th>Invoice</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pickups as $pickup)
                                    <tr>
                                        <td>{{@$pickup->pickup_date}}</td>
                                        <td><a href="{{ route("pickup.history.view",['id' =>$pickup->id ])}}" >{{@$pickup->id}}</a></td>
                                        <td>{{@$pickup->gunny_bags}}</td>
                                        <td>
                                            @if(!empty($pickup->file))
                                            <a href="" target="_BLANK">Invoice</a>
                                            @endif
                                        </td> 
                                        <td><a href="{{ route("pickup.history.view",['id' =>$pickup->id ])}}" >View</a></td>
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
