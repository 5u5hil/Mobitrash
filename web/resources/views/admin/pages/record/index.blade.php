@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Record
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
                        <label>Filter </label>
                        {!! Form::select('filter_type',$filter,$filter_type, ["class"=>'form-control filter_type']) !!}
                        {!! Form::select('filter_value',$recordtypes, $record_type, ["class"=>'form-control f2', "style"=>$show_record, $dis_record]) !!}
                        {!! Form::select('filter_value',$vans, $assets_type, ["class"=>'form-control f3', "style"=>$show_assets, $dis_assets]) !!}
                        {!! Form::text('filter_value',$filter_date, ["class"=>'form-control f1 datepicker2', "style"=>$show_val, $dis_val]) !!}
                        {!! Form::submit('Go',["class" => "btn btn-primary filter-button"]) !!}
                        {!! Form::close() !!}
                    </div>
                    <h3 class="box-title">  
                        @permission('admin.record.add')
                        <a href="{!! route('admin.record.add') !!}" class="btn btn-default pull-right" type="button">Add New Record</a>      
                        @endpermission
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
                                <th>Attachment</th>
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
                                <td>{{ @$city->addedBy->name }}</td>
                                <td>{{ date("d M Y",strtotime($city->updated_at)) }}</td>
                                <td>
                                    @if(@$city->recordtype_id == 1 || @$city->recordtype_id == 2)
                                    @foreach(@$city->atts->where("is_active", 1) as $at)

                                    <a href="{{ Config('constants.uploadRecord').$at->file }}" target="_BLANK"><i class="fa fa-file"></i></a>
                                    @endforeach
                                    @endif
                                </td>
                                <td>
                                    @permission('admin.record.show')
                                    <a href="{{ route('admin.record.show',['id' => $city->id ])  }}" class="label label-success active" ui-toggle-class="">View</a>
                                    @endpermission
                                    @permission('admin.record.edit')
                                    <a href="{{ route('admin.record.edit',['id' => $city->id ])  }}" class="label label-success active" ui-toggle-class="">Edit</a>
                                    @endpermission
                                    @permission('admin.record.delete')
                                    <a href="{{ route('admin.record.delete',['id' => $city->id ])  }}" class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>
                                    @endpermission
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
            $(".f1").show().prop('disabled', false);
            $(".f2, .f3").hide().prop('disabled', true);
        } else if ($(this).val() == 'recordtype_id') {
            $(".f2").show().prop('disabled', false);
            $(".f1, .f3").hide().prop('disabled', true);
        } else if ($(this).val() == 'asset_id') {
            $(".f3").show().prop('disabled', false);
            $(".f1, .f2").hide().prop('disabled', true);
        } else {
            $(".f1, .f2, .f3").hide().prop('disabled', true);
        }
    });
</script>

@stop