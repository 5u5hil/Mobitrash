@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Users
        <small>Add/Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.systemusers.view') }}"><i class="fa fa-coffee"></i>Users</a></li>
        <li class="active">Add/Edit</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">

                    <div class="panel-body">
                        
                        <p style="color:red;text-align: center;">{{ Session::get('message') }}</p>

                        {!! Form::model($user, ['method' => 'post', 'route' => $action , 'class' => 'form-horizontal' ]) !!}
                        <div class="form-group">
                            {!!Form::label('Name','Name',['class'=>'col-sm-2 control-label required']) !!}
                            {!! Form::hidden('id',null) !!}
                            <div class="col-sm-10">
                                {!! Form::text('first_name',null, ["class"=>'form-control' ,"placeholder"=>'First Name', "required"]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!!Form::label('Last Name','Last Name',['class'=>'col-sm-2 control-label optional']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('last_name',null, ["class"=>'form-control' ,"placeholder"=>'Last Name']) !!}
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            {!!Form::label('Email','Email',['class'=>'col-sm-2 control-label required']) !!}
                            <div class="col-sm-10">
                                {!! Form::email('email',null, ["class"=>'form-control' ,"placeholder"=>'Email', "required"]) !!}
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            {!!Form::label('Password','Password',['class'=>'col-sm-2 control-label required']) !!}
                            <div class="col-sm-10">
                                {!! Form::password('password', ["class"=>'form-control' ,"placeholder"=>'Password' , "required"]) !!}
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            {!!Form::label('Role','Role',['class'=>'col-sm-2 control-label required']) !!}
                            <div class="col-sm-10">
                                {!! Form::select('roles',$roles_name,!empty($user->roles()->first()->id)?$user->roles()->first()->id:null,["class"=>'form-control m-b' , "required"]) !!}
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                {!! Form::submit('Submit',["class" => "btn btn-primary SustemUserSubmit"]) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop


@section("myscripts")
<script>
    $(document).ready(function() {
//    
//   $(".SustemUserSubmit").click(function(){
//       var username = $(".usernameAdmin").val();
//       
//     $.ajax({
//         type:"POST",
//         url:"{{ route('chk_existing_username') }}",
//         data:{username:username},
//         cache:false,
//         success:function(data){
//             alert(data);
//             
//             
//         }
//         
//         
//     });  
//       
//     
//      
//   }); 


    });

</script>


@stop