@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Assets Management
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">  Assets Management</li>
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
                        {!! Form::open(['method'=>'GET','route' => 'admin.assets.view' , 'class' => 'form-horizontal' ]) !!}
                        <label>Filter </label>
                        {!! Form::select('filter_type',$filter,$filter_type, ["class"=>'form-control filter_type']) !!}
                        {!! Form::text('filter_value',$field1, ["class"=>'form-control f1', "style"=>$show_f1, $dis_f1]) !!}
                        {!! Form::select('filter_value',$types,$field2, ["class"=>'form-control f2 datepicker2', "style"=>$show_f2, $dis_f2]) !!}
                        {!! Form::select('filter_value',$cities, $field3, ["class"=>'form-control f3', "style"=>$show_f3, $dis_f3]) !!}
                        {!! Form::submit('Go',["class" => "btn btn-primary filter-button"]) !!}
                        {!! Form::close() !!}
                    </div>
                    <h3 class="box-title">  
                        @permission('admin.assets.add')  
                        <a href="{!! route('admin.assets.add') !!}" class="btn btn-default pull-right" type="button">Add New Asset</a>      
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
                                <th>Id</th>
                                <th>Name</th>
                                <th>Asset No.</th>
                                <th>Type</th>
                                <th>Part Of</th>
                                <th>City</th>
                                <th>DOP</th>
                                <th>Active</th>
                                <th>Last Updated By</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assets as $asset)
                            <tr>
                                <td>{{ $asset->id }}</td>
                                <td>{{ $asset->name }}</td>
                                <td>{{ $asset->asset_no }}</td>
                                <td>{{ @$asset->type()->first()->name }}</td>
                                <td>{{ empty($asset->partOf()->first()->name) ? "-" : $asset->partOf()->first()->name }}</td>
                                <td>{{ @$asset->city()->first()->name }}</td>
                                <td>{{ date('d M Y', strtotime($asset->dop)) }}</td>
                                <td>{{ $asset->is_active == 1 ? 'Yes' : 'No' }}</td>
                                <td>{{ @$asset->addedBy()->first()->name }}</td>

                                <td>
                                    <!--<a href="{{ route('admin.assets.show',['id' => $asset->id ])  }}" class="label label-success active" ui-toggle-class="">View</a>-->
                                    @permission('admin.assets.edit')  
                                    <a href="{{ route('admin.assets.edit',['id' => $asset->id ])  }}" class="label label-success active" ui-toggle-class="">Edit</a>                                
                                    @endpermission
                                    @permission('admin.assets.delete')  
                                    <a href="{{ route('admin.assets.delete',['id' => $asset->id ])  }}" class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>
                                    @endpermission
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= $assets->appends(['filter_type' => $filter_type, 'filter_value' => $filter_value])->render() ?> 

                </div>
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
        } else if ($(this).val() == 'type_id') {
            $(".f2").show().prop('disabled', false);
            $(".f1, .f3").hide().prop('disabled', true);
        } else if ($(this).val() == 'city_id') {
            $(".f3").show().prop('disabled', false);
            $(".f1, .f2").hide().prop('disabled', true);
        } else {
            $(".f1, .f2, .f3").hide().prop('disabled', true);
        }
    });
</script>

@stop