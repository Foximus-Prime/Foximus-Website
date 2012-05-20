	</div><!-- /main-container -->
<?php echo plogger_download_selected_form_end(); ?>

	<div id="pagination">
		<table id="pagination-table">
			<tr>
				<td><?php echo plogger_slideshow_link(); ?></td>
				<td><?php echo plogger_pagination_control(); ?></td>
				<td id="sortby-container"><?php echo plogger_sort_control(); ?></td>
				<td id="rss-tag-container"><?php echo plogger_rss_feed_button(); ?></td>
			</tr>
		</table><!-- /pagination-table -->
	</div><!-- /pagination -->

	<div id="link-back"><?php echo plogger_link_back(); ?></div>

</div><!-- /plog-wrapper -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if necessary -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.js"></script>
  <script>window.jQuery || document.write('<script src="http://robotics.cyberdenton.com/js/libs/jquery-1.5.1.min.js">\x3C/script>')</script>

     </div>
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
                        <img src="http://robotics.cyberdenton.com/img/github_logo.png" alt="We're on Github!" width="88" height="31">
                    </a>
                    <a href="http://en.wikipedia.org/wiki/HTML5">
                        <img src="http://robotics.cyberdenton.com/img/html5.png" alt="Uses HTML5." width="88" height="31">
                    </a>
                    <a href="http://www.w3schools.com/css3/default.asp">
                        <img src="http://robotics.cyberdenton.com/img/css3.png" alt="Uses CSS3." width="88" height="31">
                    </a>
                    <a href="http://www.php.net/">
                        <img src="http://robotics.cyberdenton.com/img/php.png" alt="Uses PHP." width="88" height="31">
                    </a>
                    <a href="http://www.mysql.com/">
                        <img src="http://robotics.cyberdenton.com/img/mysql.png" alt="Uses MySQL." width="88" height="31">
                    </a>
                    <a href="http://jquery.com/">
                        <img src="http://robotics.cyberdenton.com/img/jquery.png" alt="Uses jQuery." width="88" height="31">
                    </a>
                    <div style="float:right;">
                        <a href="http://www.facebook.com/profile.php?id=100003187120085&sk=wall">
                            <img src="http://robotics.cyberdenton.com/img/facebook.png" alt="Like us on Facebook!" width="22" height="22">
                        </a>
                        <a href="http://twitter.com/FoximusPrime369">
                            <img src="http://robotics.cyberdenton.com/img/Twitter-icon.png" alt="Follow us on Twitter!" width="22" height="22">
                        </a>
                    </div>
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
  <script src="http://robotics.cyberdenton.com/js/plugins.js"></script>
  <script src="http://robotics.cyberdenton.com/js/script.js"></script>
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
