     </div>
  </div> 
  <!--! end of #container -->
  <footer>
        <div id="footL"></div>
        <div id="footR"></div>
        <div id="footCont">
        	<div id="footBtmL" class="footBtm"></div>
            <div id="footBtmC">
            	<div id="footBtmCL"></div>
                <div id="footBtmCR" class="flipH"></div>
            </div>
            <div id="footBtmR" class=" footBtm flipH"></div>
        </div>
  </footer>
  
<a href="http://usfirst.org/"><div id="RightSide"></div></a>


  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if necessary -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.5.1.min.js">\x3C/script>')</script>

  <script src="js/mylibs/beautyTips/jquery.bt.min.js"></script>

  <!-- scripts concatenated and minified via ant build script-->
  <script src="js/plugins.js"></script>
  <script src="js/script.js"></script>
  <!--<script src="js/mylibs/curvycorners.js"></script>-->
  
        <!-- load Aviva Slider -->
	<script src="js/aviaslider/prettyPhoto/js/jquery.prettyPhoto.js" type="text/javascript"></script>	
	
	<script type='text/javascript' src='js/aviaslider/jquery.aviaSlider.min.js'></script>
	<script type='text/javascript' src='js/aviaslider/custom.min.js'></script>
    
    <?php
		if($session->isAdmin()) {
	?>
			                <link type="text/css" rel="stylesheet" href="js/mylibs/treeview/jquery.treeview.css">
				<script type="text/javascript" src="js/mylibs/treeview/jquery.treeview.js"></script>
                <script type="text/javascript">$("#browser").treeview();</script>
    <?php
		}
	?>

  <!--[if lt IE 7 ]>
    <script src="js/libs/dd_belatedpng.js"></script>
    <script>DD_belatedPNG.fix("img, .png_bg"); // Fix any <img> or .png_bg bg-images. Also, please read goo.gl/mZiyb </script>
  <![endif]-->


  <!-- mathiasbynens.be/notes/async-analytics-snippet Change UA-XXXXX-X to be your site's ID -->
  <script>
    var _gaq=[["_setAccount","UA-XXXXX-X"],["_trackPageview"]];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
    g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
    s.parentNode.insertBefore(g,s)}(document,"script"));
  </script>

</body>
</html>