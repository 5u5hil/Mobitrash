@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Shift
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Shift</li>
    </ol>
</section>


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        @permission('admin.shift.add')
                        <a href="{!! route('admin.shift.add') !!}" class="btn btn-default" type="button">Add New Shift</a>      
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
                                <th>Shift</th>
                                <th>Sort Order</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shift as $sh)
                            <tr>
                                <td>{{ $sh->id }}</td>
                                <td>{{ $sh->name }}</td>
                                <td>{{ $sh->sort_order }}</td>                                
                                <td>
                                    @permission('admin.shift.edit')
                                    <a href="{{ route('admin.shift.edit',['id' => $sh->id ])  }}" class="label label-success active" ui-toggle-class="">Edit</a>
                                    @endpermission
                                    @permission('admin.shift.delete')
                                    <a href="{{ route('admin.shift.delete',['id' => $sh->id ])  }}" class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>
                                    @endpermission
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= $shift->render() ?> 

                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div> 
</section>






@stop 