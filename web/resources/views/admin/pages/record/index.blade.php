@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Record
        <small>Add/Edit/Delete</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Record</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="filter-box">
                        <?php
                        $show_record = 'display:none;';
                        $show_assets = 'display:none;';
                        $show_val = 'display:none;';
                        $dis_record = 'disabled';
                        $dis_assets = 'disabled';
                        $dis_val = 'disabled';
                        if ($record_type) {
                            $show_record = '';
                            $dis_record = '';
                        }
                        if ($assets_type) {
                            $show_assets = '';
                            $dis_assets = '';
                        }
                        if ($filter_date) {
                            $show_val = '';
                            $dis_val = '';
                        }
                        ?>
                        {!! Form::open(['method'=>'GET','route' => 'admin.record.view' , 'class' => 'form-horizontal' ]) !!}
                        {!! Form::select('filter_type',$filter,$filter_type, ["class"=>'form-control filter_type']) !!}
                        {!! Form::select('filter_value',$recordtypes, $record_type, ["class"=>'form-control record_type', "style"=>$show_record, $dis_record]) !!}
                        {!! Form::select('filter_value',$vans, $assets_type, ["class"=>'form-control assets_type', "style"=>$show_assets, $dis_assets]) !!}
                        {!! Form::text('filter_value',$filter_date, ["class"=>'form-control filter_value datepicker', "style"=>$show_val, $dis_val]) !!}
                        {!! Form::submit('Go',["class" => "btn btn-primary filter-button"]) !!}
                        {!! Form::close() !!}
                    </div>
                    <h3 class="box-title">  
                        <a href="{!! route('admin.record.add') !!}" class="btn btn-default pull-right" target="_" type="button">Add New Record</a>      
                    </h3>

                    <div>
                        <p style="color:red;text-align: center">{{ Session::get('message') }}</p>
                    </div>

                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Record Type</th>
                                <th>Record For</th>
                                <th>Remarks</th>
                                <th>Receipt Date</th>
                                <th>Last Updated By</th>
                                <th>Last Updated At</th>
                            </tr>
                        </thead>
                        <tbody id="indexdata">                          
                            @foreach($record as $city)                            
                            <tr>
                                <td>{{ @$city->id }}</td>
                                <td>{{ @$city->rtype->name }}</td>
                                <td>{{ @$city->asset->name ." " . @$city->asset->asset_no }}</td>
                                <td>{{ $city->remarks }}</td>
                                <td>{{ date("d M Y",strtotime($city->date)) }}</td>
                                <td>{{ @$city->addedBy->first_name }}</td>
                                <td>{{ date("d M Y",strtotime($city->updated_at)) }}</td>
                                <td>
                                    <a href="{{ route('admin.record.show',['id' => $city->id ])  }}" target="_" class="label label-success active" ui-toggle-class="">View</a>
                                    <a href="{{ route('admin.record.edit',['id' => $city->id ])  }}" target="_" class="label label-success active" ui-toggle-class="">Edit</a>
                                    <a href="{{ route('admin.record.delete',['id' => $city->id ])  }}" target="_" class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= $record->appends(['filter_type' => $filter_type, 'filter_value' => $filter_value])->render() ?>
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div> 
</section>
@stop 

@section('myscripts')

<script>

    $(".filter_type").change(function () {
        if ($(this).val() == 'date') {
            $(".filter_value").show();
            $(".filter_value").prop('disabled', false);
            $(".record_type").hide();
            $(".record_type").prop('disabled', true);
            $(".assets_type").hide();
            $(".assets_type").prop('disabled', true);
        } else if ($(this).val() == 'recordtype_id') {
            $(".filter_value").hide();
            $(".filter_value").prop('disabled', true);
            $(".record_type").show();
            $(".record_type").prop('disabled', false);
            $(".assets_type").hide();
            $(".assets_type").prop('disabled', true);
        } else if ($(this).val() == 'asset_id') {
            $(".filter_value").hide();
            $(".filter_value").prop('disabled', true);
            $(".record_type").hide();
            $(".record_type").prop('disabled', true);
            $(".assets_type").show();
            $(".assets_type").prop('disabled', false);
        }
    });
//    $(".filter_value, .record_type, .assets_type").change(function () {
//        $this = $(this);
//        $.ajax({
//            url: "<?= route('recordIndexFilter') ?>",
//            type: "GET",
//            data: {
//                type:  $(".filter_type").val(),
//                query: $this.val()
//            },
//            success: function (response) {
//                if (response) {
//                    var data;
//                    $('#indexdata').append(data);
//                }
//            }
//        });
//    });
</script>

@stop