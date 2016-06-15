<!DOCTYPE html>
<html>
  <head>
    @include('admin.includes.head')
    
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Login</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
          
          <p style="color: red;text-align: center;">{{ Session::get('invalidUser') }}</p>
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="{{ route('check_admin_user') }}" method="post">
          <div class="form-group has-feedback">
              <input type="email" class="form-control" name="email" placeholder="Email" required="true">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
              <input type="password" class="form-control" name="password" placeholder="Password" required="true">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
<!--            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
            </div>-->
            <div class="col-xs-4 pull-right">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

<!--        <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a>-->

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
<script src="{{ asset('public/Admin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{ asset('public/Admin/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('public/Admin/plugins/iCheck/icheck.min.js') }}"></script>
    
    
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
