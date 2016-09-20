@extends('frontend.layouts.site')
@section('content')

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
                                <li class="actives"><a href="{{route('garden.waste')}}">Schedule Pickup</a></li>
                                <li><a href="{{route('garden.waste.emptygunny')}}">Empty Gunny</a></li>
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
                        <h3>Schedule Pickup</h3>
                    </div>
                    <div class="gunny-bags">  
                        <h4></h4>
                        {!! Form::model(null, ['method' => 'post', 'route' => $action , 'class' => 'nobottommargin' ]) !!}
                        <div class="form-process"></div>
                        <div class="col_half gunny-form">
                            <label>Enter the number of garden gunny bags</label><small>*</small>
                            {!! Form::text('no_of_gunny',null, ["class"=>"sm-form-control validate[required,custom[integer],min[1]] number_of_gunny_bags" ,"placeholder"=>"Enter the number of garden gunny bags"]) !!}
                            <div class="col_half" style="margin-bottom: 0px;">
                                <div style="line-height: 45px;height: 45px;"></div>
                                <div><span style="font-size: 40px;" class="bag_count">0</span><span style="font-size: 20px;" id="bag_price"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;x {{$config['gunny_bag_price']}} = </span></div>
                            </div>
                            <div class="col_one_third" style="margin-bottom: 0px;">
                                <div style="line-height: 45px;height: 45px;">Net Payable Amount</div>
                                <div><span style="font-size: 20px;">Rs.</span><span style="font-size: 40px;" class="total_payable">0</span></div>
                            </div>
                            <button type="button" class="button button-3d button-black gunny-bag-button" style="width: 100%;margin: 15px 0px;">Check Available Pickup Slots</button>
                           

                        </div>
                    </div>
                    <div class="drop-address" style="display: none;">
                        
                        <h4>Drop Location</h4>
                        <div class="form-process"></div>
                        <div class="col_half gunny-form">
                            <label>House No./ Flat No. </label><small>*</small>
                            {!! Form::text('address_line_1',null, ["class"=>"sm-form-control validate[required]" ,"placeholder"=>"House No./ Flat No."]) !!}
                            <label>Apartment Name/ Street Name </label><small>*</small>
                            {!! Form::text('address_line_2',null, ["class"=>"sm-form-control validate[required]" ,"placeholder"=>"Apartment Name, Street Name"]) !!}
                            <label>Locality </label> <small>*</small>
                            {!! Form::text('locality',null, ["class"=>"sm-form-control validate[required]]" ,"placeholder"=>"Locality"]) !!}
                            <label>City </label><small>*</small>
                            {!! Form::text('city',null, ["class"=>"sm-form-control validate[required]" ,"placeholder"=>"City"]) !!}
                            <label>Pincode </label><small>*</small>
                            {!! Form::text('pincode',null, ["class"=>"sm-form-control validate[required,custom[integer]]" ,"placeholder"=>"Pincode"]) !!}
                            <button type="submit" class="button button-3d button-black" style="width: 100%;margin: 15px 0px;">Submit & Proceed to Pay</button>
                            <div style="text-align: center;">This will be saved as your default pickup address but we shall confirm it always before scheduling a pickup.</div>
                            {!! Form::hidden('user_id',Auth::user()->id) !!}
                            {!! Form::close() !!}  

                        </div>

                        <div class="col_one_third">
                            <h4>Empty Gunny Drop Request</h4>
                            <table style="width: 100%;">
                                <tr><td>Empty Gunny Bags</td><td class="bag_count" style="font-weight: bold;text-align: right;"></td></tr>
                                <tr><td>Net Payable</td><td  style="font-weight: bold;text-align: right;">Rs.<span class="total_payable"></span></td></tr>
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