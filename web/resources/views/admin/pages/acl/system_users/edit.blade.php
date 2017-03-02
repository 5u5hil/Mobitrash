@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        System Users
        <small>Add/Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.systemusers.view') }}"><i class="fa fa-coffee"></i>System Users</a></li>
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

                        {!! Form::model($user, ['method' => 'post', 'route' => $action , 'class' => 'form-horizontal', 'files'=>true ]) !!}
                        {!! Form::hidden('id',null) !!}
                        <div class="form-group">
                            {!!Form::label('Role','Role',['class'=>'col-sm-2 control-label required']) !!}
                            <div class="col-sm-10">
                                {!! Form::select('roles',$roles_name,!empty($user->roles()->first()->id)?$user->roles()->first()->id:null,["class"=>'form-control m-b user-role' , "required"]) !!}
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            {!!Form::label('Name','Name',['class'=>'col-sm-2 control-label required']) !!}                            
                            <div class="col-sm-10">
                                {!! Form::text('name',null, ["class"=>'form-control' ,"placeholder"=>'Name', "required"]) !!}
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            {!!Form::label('Phone','Phone Number',['class'=>'col-sm-2 control-label required']) !!}
                            <div class="col-sm-10">
                                {!! Form::tel('phone_number',null, ["class"=>'form-control' ,"placeholder"=>'Phone Number', "required"]) !!}
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        
                        <div class="form-group email_id">
                            <?php 
                            $email_is_required = $user->roles()->first()->id == 3 || $user->roles()->first()->id == 4 ? 'optional' : 'required';
                            ?>
                            {!!Form::label('Email','Email',['class'=>'col-sm-2 control-label '.$email_is_required]) !!}
                            <div class="col-sm-10">
                                {!! Form::email('email',null, ["class"=>'form-control' ,"placeholder"=>'Email', $email_is_required == 'required'? 'required': '']) !!}
                            </div>
                        </div>
                        
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            {!!Form::label('Password','Password',['class'=>'col-sm-2 control-label optional']) !!}
                            <div class="col-sm-10">
                                {!! Form::password('password', ["class"=>'form-control' ,"placeholder"=>'Password']) !!}
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            {!!Form::label('Profile Picture','Profile Picture',['class'=>'col-sm-2 control-label optional']) !!}
                            <div class="col-sm-10">
                                {!! Form::file('profile_picture', ["class"=>'form-control' ,"placeholder"=>'Profile Picture']) !!}
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
    $(document).ready(function () {
        $(".user-role").change(function(){
            if($(this).val() == 3 || $(this).val() == 4){
                $(".email_id input").prop("required",false);
                $(".email_id label").removeClass("required");
                $(".email_id label").addClass("optional");
            }else{
                $(".email_id input").prop("required",true);
                $(".email_id label").removeClass("optional");
                $(".email_id label").addClass("required");
            }
        });
    });

</script>



@stop