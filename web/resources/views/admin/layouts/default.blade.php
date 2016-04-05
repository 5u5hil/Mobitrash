<!DOCTYPE html>
<html>
    <head>
        @include('admin.includes.head')
        @yield('mystyles')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            @include('admin.includes.header')
            <!-- Left side column. contains the logo and sidebar -->
            @include('admin.includes.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
            </div><!-- /.content-wrapper -->

            @include('admin.includes.footer')

        </div><!-- ./wrapper -->
        @include('admin.includes.foot')
          @yield('myscripts')
    </body>
</html>
