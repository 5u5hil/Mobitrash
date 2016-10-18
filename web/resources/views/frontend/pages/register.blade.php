@extends('frontend.layouts.site')
@section('content')
<style>
    .col_full{
        margin-bottom: 5px!important;
    }
    .col_full input[disabled]{
        background: #ccc;
    }
</style>
<!-- Content
============================================= -->
<section id="content" style="margin-bottom: 0px;height: 800px;">
    <div style="background: url('{{asset('public/Frontend/images/parallax/home/clouds-background.jpg')}}') no-repeat;
         background-size: 100% auto;padding-bottom:190px;;
         padding-top: 18px;">
        <div class="container clearfix">
            <div class="col_full">

                <div class="nobg full-screen nopadding nomargin">
                    <div class="container vertical-middle divcenter clearfix">

                        <div class="panel panel-default divcenter noradius noborder loginpan">
                            <div class="panel-body" style="padding: 40px;"> 
                                <h3 class="logintex">Register</h3>
                                <div class="flash-message red" style="">
                                    {{@Session::pull('messageError')}}                            
                                </div>
                                <div class="flash-message" style="color: #74f774;">
                                    {{@Session::pull('message')}}                            
                                </div>
                                <form id="register-form" name="login-form" class="nobottommargin" action="{{ route($action) }}" method="post">

                                    <div class="col_full">
                                        <label class="logintex" for="template-contactform-service">City <small>*</small></label>
                                        {!! Form::select('location',$cities,null, ["class"=>'required sm-form-control validate[required] select-city', "data-show-content" => "false"]) !!}
                                    </div>                                    
                                    <div class="col_full user_location" style="display: none;">
                                        <label class="logintex" for="phone_number">Enter City:</label>
                                        <input type="text" id="location" name="city_name" value=""  class="sm-form-control" />
                                        <input type="hidden" id="redirect_url" name="redirect_url" value="<?= Input::get('redirect_url')?Input::get('redirect_url'): 'user.register' ?>"  class="sm-form-control" />
                                    </div>
                                    <div class="city_message" style="color: #fff;"></div>
                                    <hr />
                                    <div class="col_full reg-input">
                                        <label class="logintex" for="name">Full Name <small>*</small></label>
                                        <input disabled type="text" id="name" name="name" value="" class="sm-form-control required validate[required]" />
                                    </div>

                                    <div class="col_full reg-input">
                                        <label class="logintex" for="phone_number">Phone No: <small>*</small></label>
                                        <input disabled type="number" id="phone_number" name="phone_number" value=""  class="sm-form-control required validate[required]" />
                                    </div>

                                    <div class="col_full reg-input">
                                        <label class="logintex" for="email">Email Id: <small>*</small></label>
                                        <input disabled type="text" id="email" name="email" value="" class="sm-form-control required validate[required,custom[email]]" />
                                    </div>

                                    <div class="col_full reg-input user_password">
                                        <label class="logintex" for="password">Password: <small>*</small></label>
                                        <input disabled type="password" id="password" name="password" value="" class="sm-form-control required validate[required]" />
                                    </div>
                                    
                                    <div class="col-md-12 pull-left">	
                                        <center>
                                            <button type="submit" class="button button-3d button-black nomargin " id="register-form-submit">Submit</button></center>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- #content end -->


@stop

@section("myscripts")
<script>

    $(document).ready(function () {
        
        $(".select-city").change(function(){
            var option = $(this).find("option:selected").text();
            if(option == 'Other'){
                $('.city_message').html('');
                $('.user_password').hide();
                $('.user_password input').prop('disabled',true);
                $('.user_location').slideDown();  
                $('.reg-input input').prop('disabled',false);
            }else if($(this).val()){                
                $('.city_message').html('We are present in your city. Please Proceed.');
                $('.user_location').slideUp();
                $('.user_password').show();
                $('.reg-input input').prop('disabled',false);
            }else{
                $('.user_location').slideUp();
                $('.reg-input input').prop('disabled',true);
            }
        });
        $(".user_location input").on('keyup change', function (){           
                $('.city_message').html('Mobitrash is soon coming to '+ $(this).val() +'!<br>If you\'d like to get a heads up when we are in your city, please enter your email id');           
        });
        
        

    });

</script>



@stop


