
<script type="text/javascript" src="{{ asset('public/Frontend/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/Frontend/js/plugins.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/Frontend/js/functions.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/Frontend/js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/Frontend/js/fullcalendar.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/Admin/dist/js/jqueryui1.11.4.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/Admin/dist/js/jquery-ui-timepicker-addon.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/Frontend/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/Frontend/js/jquery.validationEngine.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/Frontend/js/jquery.validationEngine-en.js') }}"></script>

 <script type = "text/javascript">

    jQuery(window).load(function($) {
    	

     function displayNextImage() {
           //   x = (x === images.length - 1) ? 0 : x + 1;
		   x=x+1;
		      document.getElementById("img").src = 'public/Frontend/images/bannerimg/'+x+'.jpg';
			 if(x==38){
			 	x=1;
			 	}
          }

 	x = 0;
    var images = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38];
var myVar = setInterval(function(){ displayNextImage() }, 500);
function myStopFunction() {
    clearInterval(myVar);
}	
    });
         
 </script>
<script type="text/javascript">
  setTimeout(function () {
   jQuery('#footer').css('margin-top', '0px');
  }, 2000)
 </script>
