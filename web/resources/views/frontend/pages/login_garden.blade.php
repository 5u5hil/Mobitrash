@extends('frontend.layouts.site')
@section('content')

<section id="content" style="margin-bottom: 0px;">
    <div class="secpad" style="background: url('http://mobitrash.in/public/Frontend/images/parallax/home/clouds-background.jpg') no-repeat; background-size: 100% auto;padding-bottom: 237px;padding-top:88px">
        <div class="container clearfix">
            <div class="col_full">

                <!--<h2>Gallery</h2>-->
                <div style="width: 100%;text-align: center;">
                    <div class="" style="width: 510px; margin: auto;padding-top: 100px;">
                        <div class="round-content"></div>
                        <div class="round-content"></div>
                        <div class="round-content"></div>
                        <div class="round-content"></div>
                        <div style="margin-top: 20px;width: 510px;">
                            <a href="{{ route('user.register') }}" class="button btn-rounded2"><b>New User?</b> Sign Up</a>
                            <a href="{{ route('user.login', array('rurl'=>'garden.waste')) }}" class="button btn-rounded2">Login</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</section>
@stop
@section("myscripts")
<script>

</script>
@stop

<!-- External JavaScripts
============================================= -->


