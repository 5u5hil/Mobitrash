@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        System Users
        <small>Add/Edit/Delete</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">System Users</li>
    </ol>
</section>





<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">


                <div class="box-header">
                    <h3 class="box-title">  
                        <a href="{!! route('admin.systemusers.add') !!}" class="btn btn-default pull-right" target="_" type="button">Add New User</a>      
                    </h3>

                </div>
                <div>
                    <p style="color: red;text-align: center;">{{ Session::get('message') }}</p>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($system_users as $system_user)
                            <tr> <td>{{$system_user->id }}</td>
                                <td>{{$system_user->first_name }}</td>
                                <td>{{$system_user->last_name }}</td>
                                <td>{{ $system_user->email }}</td>
                                <td>{{ date("d-M-Y",strtotime($system_user->created_at)) }}</td>
                                <td>
                                    <a href="{!! route('admin.systemusers.edit',['id'=>$system_user->id]) !!}" class="label label-success active" ui-toggle-class="">Edit</a>
                                </td>

                                <td>
                                    <a href="{!! route('admin.systemusers.delete',['id'=>$system_user->id]) !!}" onclick="return confirm('Are you sure you want to continue?')" class="label label-danger active" ui-toggle-class="">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= $system_users->render() ?> 

                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div> 
</section>

@stop 