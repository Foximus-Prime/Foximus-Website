<?php 
include("inc/sessionNew.php");
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
<?php 
	include("inc/header.php");
?>
        <div class="container_12">
        	<div class="grid_4">
            	<div class="contentHead">
                	<h3>About Us</h3>
                </div>
                <article class="contentCont"  id="topInfo">
                    <p>
					<?php 
						$rs = $database->query("SELECT `Text` FROM `Content` WHERE `ID` = 1");
						echo mysql_result($rs, 0);
					?>
                    </p>
                </article>
            </div>
            <div class="grid_8">
               <div class="contentHead"></div>
               <div class="contentCont" style="padding:0;">
                   <div class="aviaslider" id="custom-fade-slider">
                   	<?php 
						$rs = $database->query("SELECT `Text` FROM `Content` WHERE `ID` = 2");
						echo mysql_result($rs, 0);
					?>
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
                   	<?php 
						$rs = $database->query("SELECT `Text` FROM `Content` WHERE `ID` = 3");
						echo mysql_result($rs, 0);
					?>
                    </article>
                </div>
            </div>
            <div class="clear"></div>
            <div class="container_12" style="padding-top: 20px;">
                <div class="grid_4">
                    <div class="contentHead">
                        <h3>Other Stuffz</h3>
                    </div>
                    <article class="contentCont" style="height:150px;">
                        <p>
                        0.o
                        </p>
                    </article>
                </div>
                <div class="grid_4">
                    <div class="contentHead">
                        <h3>Other Stuffz</h3>
                    </div>
                    <article class="contentCont" style="height:150px;">
                        <p>
                        o.O
                        </p>
                    </article>
                </div>
                <div class="grid_4">
                    <div class="contentHead">
                        <h3>Other Stuffz</h3>
                    </div>
                    <article class="contentCont" style="height:150px;">
                        <p>
                        0.o o.0
                        </p>
                    </article>
                </div>
            </div>
            <div class="clear"></div>
            <div class="container_12" style="padding-top: 20px;">
                <div class="grid_12">
                    <div class="contentHead">
                        <h3>Badges</h3>
                    </div>
                    <article class="contentCont" style="border-bottom-width: 0; height:100px;">
                        <p>
                        
                        </p>
                    </article>
                </div>
            </div>
            <div class="clear"></div>
<?php  include("inc/js.php"); ?>
        <!-- load Aviva Slider -->
	<script src="js/aviaslider/prettyPhoto/js/jquery.prettyPhoto.js" type="text/javascript"></script>	
	<script type='text/javascript' src='js/aviaslider/jquery.aviaSlider.min.js'></script>
	<script type='text/javascript' src='js/aviaslider/custom.min.js'></script>
    
	<script type='text/javascript' src='js/jquery.hoverIntent.minified.js'></script>
    
    <script type='text/javascript' src='js/mylibs/countdown/jquery.countdown.js'></script>
    <script type='text/javascript' src='js/mylibs/countdown/script.js'></script>
    <link rel="stylesheet" href="js/mylibs/countdown/jquery.countdown.css" type="text/css" media="screen" />
<?php  include("inc/footer.php"); ?>