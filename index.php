<?php 
include_once("inc/sessionNew.php");
?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html class="no-js ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<!--[if IE]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<head>
  <meta charset="utf-8">

  <title>Foximus-Prime</title>
  
    <link rel="stylesheet" href="js/mylibs/countdown/jquery.countdown.css" type="text/css" media="screen" />
<?php 
	include_once("inc/header.php");
	$rs = $database->query("SELECT `Text` FROM `Content` WHERE `Page` = 1");
?>
        <div class="container_12">
        	<div class="grid_4">
            	<div class="contentHead">
                	<h3>About Us</h3>
                </div>
                <article class="contentCont"  id="topInfo">
					<?php 
						echo mysql_result($rs, 0);
					?>
                </article>
            </div>
            <div class="grid_8">
               <div class="contentHead"></div>
               <div class="contentCont" style="padding:0;">
                   <div class="aviaslider" id="custom-fade-slider">
                       <?php include_once('gallery/plog-content/plugins/slider-generation/slider.php'); ?>
                    </div>
                </div>
            </div>
            </div>
            <div class="clear"></div>
            <div class="container_12" style="padding-top: 20px;">
            	<div class="grid_12">
                    <div class="contentHead">
                        <h3>Countdown</h3>
                    </div>
                    <article class="contentCont">
                        <div id="countdown"></div>
                        <div id="note"></div>
                    </article>
                </div>
            </div>
            <div class="clear"></div>
            <div class="container_12" style="padding-top: 20px;">
                <div class="grid_4">
                    <div class="contentHead">
                        <h3>Sponsors</h3>
                    </div>
                    <article class="contentCont" style="height:250px;">
                   	<?php 
						echo mysql_result($rs, 2);
					?>
                    </article>
                </div>
                <div class="grid_4">
                    <div class="contentHead">
                        <h3>Current Game</h3>
                    </div>
                    <article class="contentCont" style="height:250px;">
                   	<?php 
						echo mysql_result($rs, 3);
					?>
                    </article>
                </div>
                <div class="grid_4">
                    <div class="contentHead">
                        <h3><a href="http://twitter.com/#!/FoximusPrime369"><img alt="Twitter" src="img/twitterIcon.png"/>&nbsp;Twitter</a></h3>
                    </div>
                    <article class="contentCont" style="height:250px;">
                   	<?php 
						echo mysql_result($rs, 4);
					?>
                    </article>
                </div>
            </div>
            <div class="clear"></div>

<?php  include_once("inc/js.php"); ?>
		<!-- Twitter -->
	<script src="http://twitter.com/javascripts/blogger.js" type="text/javascript"></script>
	<script src="http://twitter.com/statuses/user_timeline/FoximusPrime369.json?callback=twitterCallback2&amp;count=3" type="text/javascript"></script>
        <!-- Aviva Slider -->
	<script src="js/aviaslider/prettyPhoto/js/jquery.prettyPhoto.js" type="text/javascript"></script>	
	<script type='text/javascript' src='js/aviaslider/jquery.aviaSlider.min.js'></script>
	<script type='text/javascript' src='js/aviaslider/custom.min.js'></script>
    	<!-- Hover Intent -->
	<script type='text/javascript' src='js/jquery.hoverIntent.minified.js'></script>
    	<!-- Countdown -->
    <script type='text/javascript' src='js/mylibs/countdown/jquery.countdown.js'></script>
    <script type='text/javascript' src='js/mylibs/countdown/script.js'></script>
<?php  include_once("inc/footer.php"); ?>