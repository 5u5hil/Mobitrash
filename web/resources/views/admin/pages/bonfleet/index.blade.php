@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Bonfleet Management
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">  Bonfleet Management</li>
    </ol>
</section>


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">  
                        @permission('admin.bonfleet.add')  
                        <a href="{!! route('admin.bonfleet.add') !!}" class="btn btn-default" type="button">Add New Bonfleet</a>      
                        @endpermission
                    </h3>
                    <div class="filter-box">
                        
                    </div>
                    

                    <div class="message-box">
                        <p style="color:red;text-align: center">{{ Session::get('message') }}</p>
                    </div>

                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Balance</th>
                                <th>Litres</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bonfleets as $bonfleet)
                            <tr>
                                <td>{{ $bonfleet->id }}</td>
                                <td>{{ $bonfleet->name }}</td>
                                <td>{{ $bonfleet->amount }}</td>
                                <td>{{ $bonfleet->balance }}</td>
                                <td>{{ $bonfleet->litres }}</td>
                                <td>{{ $bonfleet->created_at }}</td>
                                <td>
                                    <!--<a href="{{ route('admin.bonfleet.show',['id' => $bonfleet->id ])  }}" class="label label-success active" ui-toggle-class="">View</a>-->
                                    @permission('admin.bonfleet.edit')  
                                    <a href="{{ route('admin.bonfleet.edit',['id' => $bonfleet->id ])  }}" class="label label-success active" ui-toggle-class="">Edit</a>                                
                                    @endpermission
                                    @permission('admin.bonfleet.delete')  
                                    <a href="{{ route('admin.bonfleet.delete',['id' => $bonfleet->id ])  }}" class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>
                                    @endpermission
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= $bonfleets->render() ?> 

                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div> 
</section>
@stop 

@section('myscripts')

<script>
 
</script>

@stop