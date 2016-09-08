@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Package
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Package</li>
    </ol>
</section>


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        @permission('admin.package.add')
                        <a href="{!! route('admin.package.add') !!}" class="btn btn-default" type="button">Add New Package</a>      
                        @endpermission
                        @permission('admin.recordtype.delete')
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
                                <th>Fueltype</th>

                                <th>Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($package as $city)
                            <tr>
                                <td>{{ $city->id }}</td>
                                <td>{{ $city->name }}</td>
                                <td>{{ $city->is_active == 1 ? 'Yes' : 'No' }}</td>
                                <td>
                                    @permission('admin.package.edit')
                                    <a href="{{ route('admin.package.edit',['id' => $city->id ])  }}" class="label label-success active" ui-toggle-class="">Edit</a>
                                    @endpermission
                                    @permission('admin.package.delete')
                                    <a href="{{ route('admin.package.delete',['id' => $city->id ])  }}" class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>
                                    @endpermission
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= $package->render() ?> 

                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div> 
</section>






@stop 