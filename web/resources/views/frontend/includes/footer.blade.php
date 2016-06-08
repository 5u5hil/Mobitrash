<!-- <section id="content">

    <div class="content-wrap nopadding">

        <div class="section nopadding nomargin" style="background: url('{{asset('public/Frontend/images/parallax/home/footer-truck.png')}}') no-repeat;background-size: 100% 100% !important;height: 176px;"></div>

    </div>

</section> -->
<section id="content" style="{{ preg_match("/\//",Route::currentRouteName())? 'display:none' : 'display:block'}}">

    <div class="content-wrap nopadding">

       <img src="public/Frontend/images/parallax/home/footer-truck.png" class="img-responsive">

    </div>

</section>

<!-- Footer============================================= -->
<footer id="footer" class="dark" style="margin-top:0px !important;">

    	<!-- Copyrights
			============================================= -->
			<div id="copyrights">
				<div class="container clearfix">
					<div class="col_half">
						 <div>
           				 Copyrights &copy; 2016. <a href="{{route('/')}}" class="footcolor">MobiTrash</a>. All Rights Reserved. Developed by <a href="http://infinisystem.com/" target="_blank" class="footcolor">Infini Systems</a>.
        		</div>	
		</div>
					<div class="col_half col_last tright">
						<div class="copyright-links"><a href="{{route('user.terms')}}">Terms & Conditions</a> / <a href="{{route('user.privacy')}}">Privacy Policy</a></div>
					</div>

				</div>

			</div><!-- #copyrights end -->

</footer><!-- #footer end -->