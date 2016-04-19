@extends('frontend.layouts.site')
@section('content')
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
                                    <span class="forgotspan">Please enter the email address registered on your account</span>
                                    <div class="line line-sm forgot-line"></div>
                                    <div class="col_full">
                                        <label for="template-contactform-service">Email Address:</label>
                                        <input type="text" id="template-contactform-phone" name="email" value="" class="sm-form-control validate[required]"/>
                                    </div>
                                    <!-- Small modal -->
                                    <button type="button" class="button button-3d button-black nomargin forgot">Reset Password</button>
                                    <button type="button" style="display: none;" id="show-mmodal-m" class="button button-3d button-black nomargin" data-toggle="modal" data-target=".bs-example-modal-sm"></button>
                                    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-body">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <!--<div class="resettex"><p class="resetpass">Reset link  has been send to your email id successfully.</p></div>-->
                                                        <div class="resettex"><p class="resetpass">New Password has been send to your email id successfully.</p></div>
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
            $.ajax({
                url: '<?= route('user.forgotpassword.update') ?>',
                type: "POST",
                data: $("#forgot-password").serialize(),
                success: function (data) {
                    if(data.flash == 'success'){
                        $('#show-mmodal-m').click();
                    }else{
                        
                    }
                }

            });
        });
    });
</script>
@stop


