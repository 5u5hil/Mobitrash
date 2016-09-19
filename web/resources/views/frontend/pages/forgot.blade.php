@extends('frontend.layouts.site')
@section('content')
<!-- <section id="slider" class="slider-parallax loginsec" data-height-lg="300" data-height-md="500" data-height-sm="400" data-height-xs="250" data-height-xxs="200">
            <div class="slider-parallax-inner">
                <div class="container clearfix">
                    <div class="vertical-middle">

                        <div class="heading-block nobottomborder">
                            <h1>
                                <div>
                                 <span>Forgot Password</span>
                                </div>
                            </h1>
                        </div>

                    </div>
                </div>
            </div>
        </section> -->
<!-- Content
============================================= -->
<section id="content" style="margin-bottom: 0px;">
     <div style="background: url('{{asset('public/Frontend/images/parallax/home/clouds-background.jpg')}}') no-repeat;
    background-size: 100% auto;padding-bottom:190px;
    padding-top: 18px;">
        <div class="container clearfix">
       <div class="col_full">
        <div class="nobg full-screen nopadding nomargin">
            <div class="container vertical-middle divcenter clearfix">

<!--                 <div class="row center">
                    <a href="{{route('/')}}"><img src="{{asset('public/Frontend/images/loginlogo.png')}}" alt="Mobitrash"></a>
                </div> -->

                <div class="panel panel-default divcenter noradius noborder loginpan">
                    <div class="panel-body" style="padding: 40px;">
                    <h3 class="logintex">Forgot Your Password</h3>
                                <form id="forgot-password" name="login-form" class="nobottommargin" action="{{route('user.forgotpassword.update')}}" method="post">
                                    <div id="flash-message"></div>
                                    <span class="forgotspan logintex">Please enter the email address registered on your account</span><br><br>
                                   <!--  <div class="line line-sm forgot-line"></div> -->
                                    <div class="col_full">
                                        <label class="logintex" for="template-contactform-service">Email Address</label>
                                        <input type="text" id="template-contactform-phone" name="email" value="" class="sm-form-control validate[required, custom[email]]"/>
                                    </div>
                                    <!-- Small modal -->
                                    <button type="button" class="button button-3d button-black nomargin forgot">Reset Password</button>
                                    <span style="margin-left: 10px; display: none; color: #fff; font-size: 21px;" class="small-loading" ><i class="fa fa-refresh fa-spin fa-fw"></i></span>
                                    <button type="button" style="display: none;" id="show-mmodal-m" class="button button-3d button-black nomargin" data-toggle="modal" data-target=".bs-example-modal-sm"></button>
                                    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-body">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="resettex"><p class="resetpass">Password Reset link  has been send to your email id successfully.</p></div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>

                    </div> 
                </div>

            </div>
        </div>
                   
                </div>

            </div>


        </section>









<!-- #content end -->
@stop

@section("myscripts")
<script>
    $(document).ready(function () {
        $('.forgot').click(function (e) {            
            e.preventDefault();
            if ($("#forgot-password").validationEngine('validate') == true) {
                $('.small-loading').show();
                $('#flash-message').html('');
                $.ajax({
                    url: '<?= route('user.forgotpassword.update') ?>',
                    type: "POST",
                    data: $("#forgot-password").serialize(),
                    success: function (data) {
                        $('.small-loading').hide();
                        if (data.flash == 'success') {
                            $('#show-mmodal-m').click();
                        } else {
                            $('#flash-message').html('<div class="red">Email Address does not exist</div>');
                        }
                    }

                });
            }
        });
    });
</script>
@stop


