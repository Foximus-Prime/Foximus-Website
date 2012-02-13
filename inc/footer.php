     </div>
  </div> 
  <!--! end of #container -->
  <footer>
        <div class="container_12" style="padding-top: 20px;">
            <div class="grid_12">
                <div class="contentHead">
                    <h3>Badges</h3>
                </div>
                <article class="contentCont" style="border-bottom-width: 0; height:31px; display:block;">
                    <a href="http://978.gs" id="gs-overlay-badge" style="outline: 0;">
                        <img src="http://978.gs/resources/img/978-badge.png" alt="This site is built with 978 grid system" width="88" height="31"  style="border: 0;">
                    </a>
                    <a href="https://github.com/Foximus-Prime">
                        <img src="img/github_logo.png" alt="We're on Github!" width="88" height="31">
                    </a>
                    <a href="http://en.wikipedia.org/wiki/HTML5">
                        <img src="img/html5.png" alt="Uses HTML5." width="88" height="31">
                    </a>
                    <a href="http://www.w3schools.com/css3/default.asp">
                        <img src="img/css3.png" alt="Uses CSS3." width="88" height="31">
                    </a>
                    <a href="http://www.php.net/">
                        <img src="img/php.png" alt="Uses PHP." width="88" height="31">
                    </a>
                    <a href="http://www.mysql.com/">
                        <img src="img/mysql.png" alt="Uses MySQL." width="88" height="31">
                    </a>
                    <a href="http://jquery.com/">
                        <img src="img/jquery.png" alt="Uses jQuery." width="88" height="31">
                    </a>
                </article>
            </div>
       </div>
        <div id="clear"></div>
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

  <!-- scripts concatenated and minified via ant build script-->
  <script src="js/plugins.js"></script>
  <script src="js/script.js"></script>
	<script type="text/javascript" src="http://978.gs/resources/js/jquery.gs-overlay.min.js"></script>
    <script type="text/javascript">
    jQuery(function() {
      jQuery('div#gs-overlay').gsoverlay({
        trigger: jQuery('a#gs-overlay-badge'),
        grid: 978,
        color: '#aa1b4a',
        opacity: 0.15
      });
    });
    </script>

  <!--[if lt IE 7 ]>
    <script src="js/libs/dd_belatedpng.js"></script>
    <script>DD_belatedPNG.fix("img, .png_bg"); // Fix any <img> or .png_bg bg-images. Also, please read goo.gl/mZiyb </script>
  <![endif]-->


  <!-- mathiasbynens.be/notes/async-analytics-snippet Change UA-XXXXX-X to be your site's ID -->
  <script>
    var _gaq=[["_setAccount","UA-28474820-1"],["_trackPageview"]];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
    g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
    s.parentNode.insertBefore(g,s)}(document,"script"));
  </script>

</body>
</html>