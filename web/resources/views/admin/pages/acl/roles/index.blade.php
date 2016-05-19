@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
      Roles
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Roles</li>
    </ol>
</section>


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">  
            <a href="{!! route('admin.roles.add') !!}" class="btn btn-default pull-right" type="button">Add New Role</a>      
                    </h3>
                    
                    <div>
                        <p style="color:red;text-align: center">{{ Session::get('message') }}</p>
                    </div>
                   
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-hover">
                     <thead>
            <tr>
                <th>Role</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Created On</th>
                <th>Actions</th>
            </tr>
        </thead>
                  <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ $role->display_name }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->description }}</td>
                <td>{{ date("d M Y h:i:s A", strtotime($role->created_at)) }}</td>
                <td>
                    <a href="{{ route('admin.roles.edit',['id' => $role->id ])  }}" class="label label-success active" ui-toggle-class="">Edit</a>
                </td>
                
                <td>
                    <a href="{{ route('admin.roles.delete',['id' => $role->id ])  }}" class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>
                </td>
                
            </tr>
            @endforeach
        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
  <?= $roles->render() ?> 

                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div> 
</section>






@stop 