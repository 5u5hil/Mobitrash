@extends('admin.layouts.default')
@section('content')

<section class="content-header">
    <h1>
        Coupons
        <small>Add/Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.coupons.view') }}"><i class="fa fa-coffee"></i> Coupon</a></li>
        <li class="active">Add/Edit</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div>
            <p style="color: red;text-align: center;">{{ Session::get('messege') }}</p>
        </div>

        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    {!! Form::model($coupon, ['method' => 'post', 'files'=> true, 'url' => $action , 'class' => 'form-horizontal' ]) !!}

                    <div class="form-group">
                        {!! Form::label('coupon_name', 'Coupon Name',['class'=>'col-sm-2 control-label']) !!}
                        {!! Form::hidden('id',null) !!}
                        <div class="col-sm-10">
                            {!! Form::text('coupon_name',null, ["class"=>'form-control' ,"placeholder"=>'Enter Coupon Name', "required"]) !!}
                        </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        {!! Form::label('coupon_code', 'Coupon Code',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('coupon_code',null, ["class"=>'form-control' ,"placeholder"=>'Enter Coupon Code', "required"]) !!}
                        </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        {!!Form::label('discount_type','Discount Type ?',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('discount_type',["2" => "Fixed", "1" => "Percentage"],null,["class"=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        {!!Form::label('coupon_value','Enter Coupon Value',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('coupon_value',null,["class"=>'form-control',"placeholder"=>"Enter Coupon Value"]) !!}
                        </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        {!!Form::label('min_order_amt','Enter Minimum Order Amt',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('min_order_amt',null,["class"=>'form-control',"placeholder"=>"Enter Minimum Order Amt"]) !!}
                        </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <?php
                    if ($coupon->coupon_type != 0) {
                        ?>
                        <div class="form-group">
                            {!!Form::label('coupon_type','Coupon Type ?',['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::select('coupon_type',["1" => "Entire Order", "2" => "Specific Categories", "3" => "Specific Products"],null,["class"=>'form-control' , "disabled"=>"disabled"]) !!}
                                <input type="hidden" value="<?php echo $coupon->coupon_type; ?>" name="coupon_type">
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>            
                        <div class="form-group">
                            {!!Form::label('coupon_type','Coupon Type ?',['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::select('coupon_type',["1" => "Entire Order", "2" => "Specific Categories", "3" => "Specific Products"],null,["class"=>'form-control']) !!}
                            </div>
                        </div>

                        <?php
                    }
                    ?>

                    <div class="col-md-12 form-group" id="showCategories">
                        {!!Form::label('parent_id','Select Categories',['class'=>'col-sm-2 control-label']) !!}

                        <div class="col-sm-10 allCategories">
                            <?php
                            if (!empty($coupon->categories()->get()->toArray())) {
                                $idArr = [];
                                $arr = $coupon->categories()->get(['categories.id'])->toArray();
                                foreach ($arr as $a) {
                                    array_push($idArr, $a['id']);
                                }
                            } else
                                $idArr = [];

                            $roots = App\Models\Category::roots()->get();
                            echo "<ul id='catTree' class='tree icheck'>";
                            foreach ($roots as $root)
                                renderNode($root, $idArr);
                            echo "</ul>";

                            function renderNode($node, $idArr) {
                                echo "<li class='tree-item fl_left ps_relative_li'>";
                                echo '<div class="checkbox">
                        <label class="i-checks checks-sm"><input type="checkbox" class="checkCategoryId" name="category_id[]" value="' . $node->id . '" ' . (in_array($node->id, $idArr) ? 'checked' : '') . '  /><i></i>' . $node->category . '</label></div>';

                                if ($node->children()->count() > 0) {
                                    echo "<ul class='treemap fl_left'>";
                                    foreach ($node->children as $child)
                                        renderNode($child, $idArr);
                                    echo "</ul>";
                                }

                                echo "</li>";
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-md-12 form-group" id="showProducts">
                        {!!Form::label('parent_id','Select Products',['class'=>'col-sm-2 control-label']) !!}

                        <div class="col-sm-10 allProducts">
                            <?php
                            if (!empty($coupon->products()->get()->toArray())) {
                                $pIDArr = [];
                                $arr = $coupon->products()->get(['products.id'])->toArray();
                                foreach ($arr as $a) {
                                    array_push($pIDArr, $a['id']);
                                }
                            } else
                                $pIDArr = [];

                            echo "<ul id='catTree' class='tree icheck'>";
                            foreach ($products as $product) {
                                echo "<li class='tree-item fl_left ps_relative_li' style='list-style-type:none;'>";
                                echo '<div class="checkbox">
                                <label class="i-checks checks-sm"><input type="checkbox" class="checkProductId" name="product_id[]" value="' . $product->id . '" ' . (in_array($product->id, $pIDArr) ? 'checked' : '') . '  /><i></i>' . $product->product . '</label>
                            </div>';
                                echo "</li>";
                            }
                            echo "</ul>";
                            ?>
                        </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        {!!Form::label('start_date','From Coupon Date ?',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input type="text" name="start_date" value="{{ $coupon->start_date }}"  class="form-control fromDate " placeholder="From Order Date" autocomplete="off" id="fromdatepicker">
                        </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        {!!Form::label('end_date','To Coupon Date ?',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input type="text" name="end_date" value="{{ $coupon->end_date }}" class="form-control toDate col-md-3" placeholder="To Order Date" autocomplete="off" id="todatepicker">
                        </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        {!!Form::label('coupon_desc','Enter Coupon Description',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::textarea('coupon_desc',null,["class"=>'form-control',"placeholder"=>"Enter Coupon Description"]) !!}
                        </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        {!!Form::label('no_times_allowed','Enter no of times allowed',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('no_times_allowed',null,["class"=>'form-control',"placeholder"=>"Enter no of times allowed"]) !!}
                        </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        {!!Form::label('user_specific','User Specific ?',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('user_specific',["0" => "No", "1" => "Yes"],null,["class"=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-12 form-group userslist">
                        <div class="col-sm-2 control-label">
                            Search User
                        </div>
                        <div class="col-sm-10">
                            <input class="input-text" type="text" name="pdcts" onclick="tagFunction()" id="pdcts" placeholder="Start Typing Email...">
                        </div>
                    </div>

                    <div class="col-md-12 form-group userslist">
                        <div class="col-sm-2 control-label">
                            Selected Users
                        </div>

                        <div class="col-sm-10">
                            <?php
                            if (!empty($coupon->userspecific()->get()->toArray())) {
                                $arr = $coupon->userspecific()->get()->toArray();
                                ?>
                                <div id="log" style="height: 200px; width: 100%; overflow: auto;" class="ui-widget-content">
                                    <?php
                                    foreach ($arr as $a) {
                                        ?>
                                        <div><?php echo $a['email']; ?><input type='hidden' name='uid[]' value='<?php echo trim($a['id']); ?>' ><a href='#' class='pull-right remove-rag'  ><i class='fa fa-trash'></i></a></div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div id="log" style="height: 200px; width: 100%; overflow: auto;" class="ui-widget-content"></div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        {!!Form::label('image','Select Coupon Image',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">  
                            <input type="file" name="c_image" id="c_image">
                        </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <?php if (!empty($coupon->coupon_image)) { ?>
                        <div class="form-group">
                            <div class="col-sm-2">
                                <img src="{{asset('public/Admin/uploads/coupons/')."/".$coupon->coupon_image}}" class="img-responsive"   >
                                <a href="javascript:void();" class="deleteImg" data-value="{{ $coupon->coupon_image }}"><span class="label label-danger label-mini">Delete</span></a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    {!! Form::hidden('c_image', $coupon->coupon_image) !!}

                    <input type="hidden" value="" name="CategoryIds">
                    <input type="hidden" value="" name="ProductIds">

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            {!! Form::submit('Submit',["class" => "btn btn-primary"]) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> 
@stop 

@section('myscripts')
<script>

    $("#showCategories").hide();
    $("#showProducts").hide();

    $("a.deleteImg").click(function () {
        var imgs = $("input[name='c_image']").val();
        var r = confirm("Are You Sure You want to Delete this Image?");
        if (r == true) {
            $("input[name='c_image']").val('');
            $(this).parent().hide();
        } else {

        }
    });

    $(".checkCategoryId").click(function () {
        var ids = $(".allCategories input.checkCategoryId:checkbox:checked").map(function () {
            return $(this).val();
        }).toArray();
        $("input[name='CategoryIds']").val(ids);

    });

    $(".checkProductId").click(function () {
        var ids = $(".allProducts input.checkProductId:checkbox:checked").map(function () {
            return $(this).val();
        }).toArray();
        $("input[name='ProductIds']").val(ids);
    });

    if ($("#coupon_type").val() == 2) {
        $("#showProducts").hide();
        $("#showCategories").show();

        var ids = $(".allCategories input.checkCategoryId:checkbox:checked").map(function () {
            return $(this).val();
        }).toArray();
        $("input[name='CategoryIds']").val(ids);
    }

    if ($("#coupon_type").val() == 3) {
        $("#showCategories").hide();
        $("#showProducts").show();

        var ids = $(".allProducts input.checkProductId:checkbox:checked").map(function () {
            return $(this).val();
        }).toArray();
        $("input[name='ProductIds']").val(ids);
    }

    $("#coupon_type").change(function () {
        if ($("#coupon_type").val() == 2) {
            $("#showProducts").hide();
            $("#showCategories").show();
            $("input[name='ProductIds']").val("");
        }

        if ($("#coupon_type").val() == 3) {
            $("#showCategories").hide();
            $("#showProducts").show();
            $("input[name='CategoryIds']").val("");
        }

        if ($("#coupon_type").val() == 1) {
            $("#showCategories").hide();
            $("#showProducts").hide();
            $("input[name='CategoryIds']").val("");
            $("input[name='ProductIds']").val("");
        }
    });

    if ($("#user_specific").val() == 0) {
        $(".userslist").hide();
    }

    $("#user_specific").change(function () {
        if ($("#user_specific").val() == 1) {
            $(".userslist").show();
        }
        else {
            $(".userslist").hide();
        }
    });

    $("#fromdatepicker").datepicker({dateFormat: 'yy-mm-dd'});
    $("#todatepicker").datepicker({dateFormat: 'yy-mm-dd'});


</script>
<script>
    var tagFunction = function () {
        function log(message) {
            $("<div>").html(message).prependTo("#log");
            $("#log").scrollTop(0);
        }

        $products = $("#pdcts");

        $products.autocomplete({
            source: "{{route('admin.coupons.searchUser')}}",
            minLength: 2,
            select: function (event, ui) {
                log(ui.item ?
                        ui.item.email + "<input type='hidden' name='uid[]' value='" + ui.item.id + "' ><a href='#' class='pull-right remove-rag'  ><i class='fa fa-trash'></i></a>" : "");
            }
        });

        $products.data("ui-autocomplete")._renderItem = function (ul, item) {
            return $("<li>")
                    .append("<a>" + item.email + "</a>")
                    .appendTo(ul);
        };
        ;
    };

    jQuery('body').on('click', '.remove-rag', function (event) {
        /* Act on the event */
        event.preventDefault();
        jQuery(this).parent().remove();
    });
</script>
@stop