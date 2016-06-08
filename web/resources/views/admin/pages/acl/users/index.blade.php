@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Customers
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Customers</li>
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
                        {!! Form::open(['method'=>'GET','route' => 'admin.users.view' , 'class' => 'form-horizontal' ]) !!}
                        <label>Filter </label>
                        {!! Form::select('filter_type',$filter,$filter_type, ["class"=>'form-control filter_type']) !!}
                        {!! Form::text('filter_value',$field1, ["class"=>'form-control f1', "style"=>$show_f1, $dis_f1]) !!}
                        {!! Form::text('filter_value',$field2, ["class"=>'form-control f2', "style"=>$show_f2, $dis_f2]) !!}
                        {!! Form::text('filter_value', $field3, ["class"=>'form-control f3', "style"=>$show_f3, $dis_f3]) !!}
                        {!! Form::submit('Go',["class" => "btn btn-primary filter-button"]) !!}
                        {!! Form::close() !!}
                    </div>
                    <h3 class="box-title"> 
                        @permission('admin.users.add')  
                        <a href="{!! route('admin.users.add') !!}" class="btn btn-default pull-right" type="button">Add New User</a>      
                        @endpermission
                    </h3>

                </div>
                <div>
                    <p style="color: green;text-align: center;">{{ Session::get('message') }}</p>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $system_user)
                            <tr> 
                                <td>{{$system_user->id }}</td>
                                <td>{{$system_user->name }}</td>
                                <td>{{ $system_user->email }}</td>
                                <td>{{ $system_user->phone_number }}</td>
                                <td>{{ date("d-M-Y",strtotime($system_user->created_at)) }}</td>
                                <td>
                                    @permission('admin.users.edit')       
                                    <a href="{!! route('admin.users.edit',['id'=>$system_user->id]) !!}" class="label label-success active" ui-toggle-class="">Edit</a>
                                    @endpermission
                                    @permission('admin.users.delete')
                                    <a href="{!! route('admin.systemusers.delete',['id'=>$system_user->id]) !!}" onclick="return confirm('Are you sure you want to continue?')" class="label label-danger active" ui-toggle-class="">Delete</a>
                                    @endpermission
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= $users->appends(['filter_type' => $filter_type, 'filter_value' => $filter_value])->render() ?> 

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
        } else if ($(this).val() == 'email') {
            $(".f2").show().prop('disabled', false);
            $(".f1, .f3").hide().prop('disabled', true);
        } else if ($(this).val() == 'phone_number') {
            $(".f3").show().prop('disabled', false);
            $(".f1, .f2").hide().prop('disabled', true);
        } else {
            $(".f1, .f2, .f3").hide().prop('disabled', true);
        }
    });
</script>

@stop