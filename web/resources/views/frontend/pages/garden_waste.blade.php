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
                    <div class="col-md-7">
                        <div class="gunny-bags">  
                            <h4></h4>

                            <div class="form-process"></div>
                            <div class=" gunny-form">
                                {!! Form::model(null, ['method' => 'post', null , 'class' => 'nobottommargin gunny-bag-count' ]) !!}
                                <label>Enter the number of garden gunny bags</label><small>*</small>
                                {!! Form::text('no_of_gunny',null, ["class"=>"sm-form-control validate[required,custom[integer],min[1],max[".$config['max_gunny_bags']."]] number_of_gunny_bags" ,"placeholder"=>"Enter the number of garden gunny bags"]) !!}
                                <div class="col_half" style="margin-bottom: 0px;">
                                    <div style="line-height: 45px;height: 45px;"></div>
                                    <div><span style="font-size: 40px;" class="bag_count">0</span><span style="font-size: 20px;" id="bag_price"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;x {{$config['garden_waste_pickup_price']}} = </span></div>
                                </div>
                                <div class="col_one_third" style="margin-bottom: 0px;">
                                    <div style="line-height: 45px;height: 45px;">Net Payable Amount</div>
                                    <div><span style="font-size: 20px;">Rs.</span><span style="font-size: 40px;" class="total_payable">0</span></div>
                                </div>
                                <button type="button" class="button button-3d button-black gunny-bag-button" style="width: 100%;margin: 15px 0px;">Check Available Pickup Slots</button>

                                {!! Form::hidden('user_id',Auth::id()) !!}
                                {!! Form::close() !!}  

                            </div>
                        </div>
                        <div class="pickup-slot" style="display: none;">
                            <div class="">                            
                                {!! Form::model(null, ['method' => 'post', null , 'class' => 'nobottommargin validate-pickup-date' ]) !!}
                                <div class="col_two_third pull-right">Please select your Preferred Date to proceed</div>
                                <div class="col-md-4" style="height: 211px;">
                                    <div style="position: absolute;margin-bottom: 0px;bottom: 10px;">
                                        <div class="display-date-text"></div>
                                        <div class="display-pickup-date" style="font-size: 18px;font-weight: bold;">&nbsp;</div>
                                    </div>
                                </div>
                                <div class="datepicker-pickup col-md-8 pull-right" ></div>
                                {!! Form::text('pickup_date',null , ["class"=>'form-control pickup-date-input validate[required]', 'data-errormessage'=> 'Please Select Pickup Date', 'style'=>'visibility:hidden;height:1px;', "id"=>"pickup-date"]) !!}
                                <button type="button" class="button button-3d button-black proceed-pickup-button" style="width: 100%;margin: 15px 0px;">Proceed</button>
                                {!! Form::hidden('user_id',Auth::id()) !!}
                                {!! Form::close() !!}  
                            </div>
                        </div>
                        <div class="drop-address" style="display: none;">
                            <h4>Pickup Address</h4>
                            <div class='addresses'>
                                {!! Form::model(null, ['method' => 'post', 'route' => $action , 'class' => 'nobottommargin pickup-final-address' ]) !!}
                                <div class="pickup-final-address-input">
                                    @foreach($addresses as $address)
                                    <div class="checkbox-circle">   
                                        <label class="checkbox-circle-label col-md-10">{{$address['address_line_1']. ' ' .$address['address_line_2']. ' ' .$address['locality']. ' ' .$address['city']. ' ' .$address['pincode'] }}</label>
                                        <input class="checkbox-circle-input" type="radio" value="{{$address['id']}}" name="pickup_address_id" />
                                    </div>
                                    @endforeach
                                </div>
                                <div class=" pickup-summary-2" style="display: none;">
                                    <h4 style="margin-top: 30px;padding-bottom: 10px;border-bottom: 1px solid #ccc;">Pickup Request Summary</h4>
                                    <table style="width: 100%;">
                                        <tr><td>Garden Gunny Bags</td><td class="bag_count" style="font-weight: bold;text-align: right;"></td></tr>
                                        <tr><td>Pickup Date</td><td  style="font-weight: bold;text-align: right;"><span class="display-pickup-date"></span></td></tr>
                                        <tr><td>Net Payable</td><td  style="font-weight: bold;text-align: right;">Rs.<span class="total_payable"></span></td></tr>
                                        <tr><td>Pickup Address</td><td  style="text-align: right;" class="pickup-address-detail"></td></tr>
                                    </table>
                                </div>
                                <button type="button" class="button button-3d button-black show-address-form" style="width: 100%;margin: 15px 0px;">Pickup at a different address</button>
                                <button type="submit" class="button button-3d button-black proceed-to-pay" style="width: 100%;margin: 15px 0px;display: none;">Proceed to Pay</button>
                                {!! Form::hidden('user_id',Auth::id()) !!}
                                {!! Form::text('no_of_gunny', null, ['class'=>'no_of_gunny_bags validate[required]','style'=>'visibility:hidden;height:1px;']) !!}
                                {!! Form::text('date_of_pickup', null, ['class'=>'date_of_pickup validate[required]','style'=>'visibility:hidden;height:1px;']) !!}
                                {!! Form::close() !!}  
                            </div>
                            <div class="pickup-address-form" style="display: none;">
                                {!! Form::model(null, ['method' => 'post', 'route' => $action , 'class' => 'nobottommargin new-pickup-address-form' ]) !!}
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
                                <button type="button" class="button button-3d button-black save-address" style="width: 100%;margin: 15px 0px;">Submit & Proceed<div class="small-loading button-loading" ><i class="fa fa-refresh fa-spin fa-fw"></i></div></button>
                                <div style="text-align: center;">This will be saved as your default pickup address but we shall confirm it always before scheduling a pickup.</div>
                                {!! Form::hidden('flag',1) !!}                                
                                {!! Form::hidden('user_id',Auth::id()) !!}                                
                                {!! Form::close() !!}
                            </div>                        
                        </div>

                    </div>
                    <div class="col-md-4 pickup-summary" style="display: none;">
                        <h4>Pickup Request Summary</h4>
                        <table style="width: 100%;">
                            <tr><td>Garden Gunny Bags</td><td class="bag_count" style="font-weight: bold;text-align: right;"></td></tr>
                            <tr><td>Pickup Date</td><td  style="font-weight: bold;text-align: right;"><span class="display-pickup-date"></span></td></tr>
                            <tr><td>Net Payable</td><td  style="font-weight: bold;text-align: right;">Rs.<span class="total_payable"></span></td></tr>
                        </table>
                        <div>
                            <div>Please Note:</div>
                            <div>Pickup will happen between 10 AM & 6 PM on <span class="pickup_date"></span>. We shall call you to confirm actual pickup time</div>
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
        var pickup_slots = <?= $pickupslots ?>;
        $('.datepicker-pickup').datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            minDate: new Date(),
            beforeShowDay: function (date) {
                var formatted_date = '', ret = [true, "", ""];
                if (date instanceof Date)
                {
                    formatted_date = $.datepicker.formatDate('yy-mm-dd', date);
                } else
                {
                    formatted_date = '' + date;
                }
                if (-1 === pickup_slots.indexOf(formatted_date))
                {
                    ret[0] = false;
                    ret[1] = "date-disabled"; // put yopur custom csc class here for disabled dates
                    ret[2] = "Date not available"; // put your custom message here
                }
                return ret;
            },
            onSelect: function (date) {
                $('.display-date-text').html('You Selected');
                $('.display-pickup-date').html(moment(date).format('DD MMM YYYY'));
                $('.date_of_pickup').val(moment(date).format('YYYY-MM-DD'));
                $('.pickup-date-input').val(moment(date).format('YYYY-MM-DD'));
                $('.pickup-summary').show();
            }
        });
        var bag_price = <?= $config['garden_waste_pickup_price'] ?>;
        $('.number_of_gunny_bags').on('keyup change', function () {
            if ($(".gunny-bag-count").validationEngine('validate') == true) {
                $('.bag_count').html($(this).val());
                $('.total_payable').html($(this).val() * bag_price);
                $('.no_of_gunny_bags').val($(this).val());
            } else {
                $('.bag_count').html(0);
                $('.total_payable').html(0);
                $('.no_of_gunny_bags').val('');
            }
        });
        $('.gunny-bag-button').click(function (e) {
            if ($(".gunny-bag-count").validationEngine('validate') == true) {
                $('.pickup-slot').slideDown();

            }
        });
        $('.proceed-pickup-button').click(function (e) {
            if ($(".validate-pickup-date").validationEngine('validate') == true) {
                $('.gunny-bags').hide();
                $('.drop-address').show();
                $('.pickup-slot').slideUp();
            }
        });
        $('.show-address-form').click(function () {
            $('.pickup-address-form').slideDown();
        });
        $('.save-address').click(function () {
            if ($(".new-pickup-address-form").validationEngine('validate') == true) {
                $(this).prop('disabled', true);
                $('.small-loading').show();
                $.ajax({
                    url: '<?= route('user.address.add') ?>',
                    type: "POST",
                    data: $(".new-pickup-address-form").serialize(),
                    success: function (data) {
                        $(this).prop('disabled', false);
                        $('.small-loading').hide();
                        if (data.flash == 'success') {
                            $('.pickup-final-address-input input[type=radio]').removeAttr('checked');
                            var option = '<div class="checkbox-circle"><label class="checkbox-circle-label col-md-10">' + data.address + '</label><input class="checkbox-circle-input" type="radio" checked="checked" value="' + data.address_id + '" name="pickup_address_id" /></div>';
                            $('.pickup-final-address-input').append(option);
                            $('.show-address-form').hide();
                            $('.pickup-address-form').hide();
                            $('.proceed-to-pay').show();
                            $('.pickup-summary-2').show();
                            $('.pickup-summary').hide();
                            $('.pickup-address-detail').html(data.address);
                        } else {
                            $('#flash-message').html('<div class="red">Unable to save data. Please try again!</div>');

                        }
                    },
                    error: function (error) {
                        $(this).prop('disabled', false);
                        $('.small-loading').hide();
                    }

                });
            }
        });
        $('.pickup-final-address-input input[name=pickup_address_id]').click(function () {
            $('.proceed-to-pay').show();
            $('.show-address-form').hide();
            $('.pickup-summary-2').show();
            $('.pickup-summary').hide();
            $('.pickup-address-detail').html($(this).closest('.checkbox-circle').find('label').html());

        });
    });
</script>
@stop