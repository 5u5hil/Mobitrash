@extends('frontend.layouts.site')
@section('content')
<section id="slider" class="slider-parallax loginsec" data-height-lg="300" data-height-md="500" data-height-sm="400" data-height-xs="250" data-height-xxs="200">
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
        </section>
<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">

            <div class="tabs divcenter nobottommargin clearfix" id="tab-login-register" style="max-width: 500px;">

                <div class="acctitle acctitlec forgot-title"><i class="acc-open icon-cog forgot-icon"></i>Forgot your password</div>
                <div class="tab-container">

                    <div>
                        <div class="panel panel-default nobottommargin">
                            <div class="panel-body" style="padding: 40px;">
                                <form id="forgot-password" name="login-form" class="nobottommargin" action="{{route('user.forgotpassword.update')}}" method="post">
                                    <div id="flash-message"></div>
                                    <span class="forgotspan">Please enter the email address registered on your account</span>
                                    <div class="line line-sm forgot-line"></div>
                                    <div class="col_full">
                                        <label for="template-contactform-service">Email Address:</label>
                                        <input type="text" id="template-contactform-phone" name="email" value="" class="sm-form-control validate[required, custom[email]]"/>
                                    </div>
                                    <!-- Small modal -->
                                    <button type="button" class="button button-3d button-black nomargin forgot">Reset Password</button>
                                    <span style="margin-left: 10px; display: none;" class="small-loading" ><img src="{{asset('public/Frontend/images/preloader.gif')}}" /></span>
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

    </div>

</section><!-- #content end -->
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


