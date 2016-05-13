@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Schedule Management
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">  Schedule Management</li>
    </ol>
</section>


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="filter-box">

                        <?php
                        $show_f1 = 'display:none;';
                        $show_f2 = 'display:none;';
                        $show_f3 = 'display:none;';
                        $dis_f1 = 'disabled';
                        $dis_f2 = 'disabled';
                        $dis_f3 = 'disabled';
                        if ($field1) {
                            $show_f1 = '';
                            $dis_f1 = '';
                        }
                        if ($field2) {
                            $show_f2 = '';
                            $dis_f2 = '';
                        }
                        if ($field3) {
                            $show_f3 = '';
                            $dis_f3 = '';
                        }
                        ?>
                        {!! Form::open(['method'=>'GET','route' => 'admin.schedule.view' , 'class' => 'form-horizontal' ]) !!}
                        <label>Filter </label>
                        {!! Form::select('filter_type',$filter,$filter_type, ["class"=>'form-control filter_type']) !!}
                        {!! Form::text('filter_value',$field1, ["class"=>'form-control f1', "style"=>$show_f1, $dis_f1]) !!}
                        {!! Form::text('filter_value',$field2, ["class"=>'form-control f2 datepicker', "style"=>$show_f2, $dis_f2]) !!}
                        {!! Form::select('filter_value',$vans, $field3, ["class"=>'form-control f3', "style"=>$show_f3, $dis_f3]) !!}
                        {!! Form::submit('Go',["class" => "btn btn-primary filter-button"]) !!}
                        {!! Form::close() !!}
                    </div>
                    <h3 class="box-title">  
                        <a href="{!! route('admin.schedule.add') !!}" class="btn btn-default pull-right" type="button">Add New Schedule</a>      
                    </h3>

                    <div style="text-align: center;">
                        <p style="color:green;">{{ Session::get('message') }}</p>
                        <p style="color:green;">{{ html_entity_decode(Session::get('duplicateSuccess')) }}</p>
                    </div>

                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Schedule Name</th>
                                <th>Van</th>
                                <th>Schedule For</th>                               
                                <th>Last Updated By</th>
                                <!--<th>Last Updated At</th>-->

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedule as $asset)
                            <tr>
                                <td>{{ $asset->id }}</td> 
                                <td>{{ $asset->name }}</td> 
                                <td>{{ @$asset->van()->first()->name }}</td>
                                <td>{{ date('d M Y', strtotime($asset->for)) }}</td>                                
                                <td>{{ @$asset->addedBy()->first()->name }}</td>
                                <!--<td>{{ date('d M Y', strtotime($asset->updated_at)) }}</td>-->
                                <td>
                                    <a href="{{ route('admin.schedule.map',['id' => $asset->id ])  }}" class="label label-success active" ui-toggle-class="">Map</a>
                                    <a href="{{ route('admin.schedule.show',['id' => $asset->id ])  }}" class="label label-success active" ui-toggle-class="">View</a>                                    
                                    <a href="{{ route('admin.schedule.edit',['id' => $asset->id ])  }}"  class="label label-success active" ui-toggle-class="">Edit</a>
                                    <a class="label label-primary active" data-toggle="modal" data-scheduleid="{{$asset->id}}" data-target="#duplicate-schedule">Duplicate</a>
                                    <a href="{{ route('admin.schedule.delete',['id' => $asset->id ])  }}"  class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>                                    
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= $schedule->appends(['filter_type' => $filter_type, 'filter_value' => $filter_value])->render() ?> 

                </div>
                <div class="modal fade" id="duplicate-schedule" tabindex="-1" role="dialog">
                    <div class="modal-dialog" style="text-align: center;">
                        <div class="modal-content">
                            <form action="{{ route('admin.schedule.duplicate') }}" method="post" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Duplicate Schedule</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="control-label">Select Dates for Schedule:</label>
                                        <div class="multidatepicker" style="width: 240px; margin: 0 auto;"></div>
                                        <input type="text" name="multiple_dates" style="display: none;" id="multiple-dates" required="required" class="form-control">
                                        <input type="hidden" name="schedule_id" id="schedule-id" /> 
                                    </div>                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Duplicate</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div> 
</section>
@stop 


@section('myscripts')

<script>
    $(".filter_type").change(function () {
        if ($(this).val() == 'name') {
            $(".f1").show().prop('disabled', false);
            $(".f2, .f3").hide().prop('disabled', true);
        } else if ($(this).val() == 'for') {
            $(".f2").show().prop('disabled', false);
            $(".f1, .f3").hide().prop('disabled', true);
        } else if ($(this).val() == 'van_id') {
            $(".f3").show().prop('disabled', false);
            $(".f1, .f2").hide().prop('disabled', true);
        } else {
            $(".f1, .f2, .f3").hide().prop('disabled', true);
        }
    });

    $('#duplicate-schedule').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var scheduleid = button.data('scheduleid')
        var modal = $(this);
        modal.find('.modal-title').text('Duplicate Schedule id: ' + scheduleid);
        modal.find('.modal-body #schedule-id').val(scheduleid);
    });
    $('#duplicate-schedule').on('hidden.bs.modal', function (event) {
        var modal = $(this);
        modal.find('.modal-body #multiple-dates').val('');
    });

    var default_date = new Date();
    $('.multidatepicker').multiDatesPicker({
        dateFormat: "yy-mm-dd",
        defaultDate: default_date,
        altField: "#multiple-dates"
    });
</script>

@stop