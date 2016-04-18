<!DOCTYPE html>
<html>
    <head>
        @include('frontend.includes.head')
        @yield('mystyles')
    </head>
    <body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Header
		============================================= -->
            @include('frontend.includes.header')
            <!-- Content  -->            
                @yield('content')
            <!-- /.content -->

            @include('frontend.includes.footer')

        </div><!-- #wrapper end -->
        
        <!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>
        
        @include('frontend.includes.foot')
          @yield('myscripts')
    </body>
</html>
