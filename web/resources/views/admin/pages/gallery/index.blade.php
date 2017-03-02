@extends('admin.layouts.default')
@section('content')
<style>

</style>
<section class="content-header">
    <h1>
        Gallery
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Gallery</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="filter-box">
                    <form id="uploadImage" method="post" action="{{ route('admin.gallery.save')  }}" class="form-horizontal" enctype="multipart/form-data">
                        <input type="file" name="image" class="form-control" style="width: 300px;">
                        <button type="submit" class="btn btn-primary filter-button upload-button" style="width: 100px;">Upload</button>
                    </form>
                </div>
                <div class="box-header">                    
                    <div class="message-box">
                        <p style="color:green;text-align: center">{{ @Session::pull('message') }}</p>
                        <p style="color:red;text-align: center">{{ @Session::pull('messageError') }}</p>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding print">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Picture</th> 
                                <th>Name</th>                                 
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="indexdata">

                            @foreach($images as $gallery)                            
                            <tr>
                                <td>{{@$gallery->id}}</td>
                                <td><img src="{{ @$gallery->image ? Config('constants.uploadGallery').$gallery->image : asset('public/Admin/dist/img/noimage.jpg') }}" style="height: 100px;" /></td>
                                <td>{{@$gallery->name}}</td>                                
                                <td>
                                    @permission('admin.gallery.delete')  
                                    <a href="{{ route('admin.gallery.delete',['id' => @$gallery->id ])  }}" class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>
                                    @endpermission
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= $images->render() ?>
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div> 
</section>
@stop 

@section('myscripts')

<script>
//    $('.upload-button').click(function () {
//        var formData = new FormData($('#uploadImage')[0]);
//        $.ajax({
//            url: "<?= route('admin.gallery.save') ?>",
//            type: "POST",
//            data: formData,
//            async: false,
//            cache: false,
//            contentType: false,
//            processData: false,
//            success: function (data) {
//
//            }
//        });
//    });
</script>

@stop