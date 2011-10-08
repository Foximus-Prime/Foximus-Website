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
      					  $r = $database->query("SELECT `Text` FROM `Content` WHERE `ID` = 1");
						  echo mysql_result($r, 0);
					?>
                    </p>
                </article>
            </div>
            <div class="grid_8">
               <div class="contentHead"></div>
               <div class="contentCont" style="padding:0;">
                   <div class="aviaslider" id="custom-fade-slider">
                        <div class="featured">
                            <a href="img/pics/DSCF1058.jpg">
                                <img title="The Lift!" alt="The Lift! :: Left to right: Garrett Knox, Nick Gillette, Amy Hosey, Maria, Travis. Center: Elia" src="phpThumb/phpThumb.php?src=../img/pics/DSCF1058.jpg&amp;w=616&amp;h=320&amp;zc=1&amp;fltr[]=wmi|pics/fox.png|BR" />
                            </a>
                        </div>
                        <div class="featured">
                            <a href="img/pics/DSCN2761.jpg">
                                <img title="Just Chillin'" alt="Just Chillin' :: Left to right: Austin Hampton, Elia, Garrett Knox" src="phpThumb/phpThumb.php?src=../img/pics/DSCN2761.jpg&amp;w=616&amp;h=320&amp;zc=1&amp;fltr[]=wmi|pics/fox.png|BR" />
                            </a>
                        </div>
                        <div class="featured">
                            <a href="img/pics/DSCN2894.jpg">
                                <img title="Sparks a Flyin'" alt="Sparks a Flyin' :: Left to right: Garrett Knox, Elia, Tracey Hosey" src="phpThumb/phpThumb.php?src=../img/pics/DSCN2894.jpg&amp;w=616&amp;h=320&amp;zc=1&amp;fltr[]=wmi|pics/fox.png|BR" />
                            </a>
                        </div>
                        <div class="featured">
                            <a href="img/pics/DSCN2865.jpg">
                                <img title="Just Tinkering" alt="Just Tinkering :: Left to right: Nick, Austin Hampton, Jordan, Garrett Knox" src="phpThumb/phpThumb.php?src=../img/pics/DSCN2865.jpg&amp;w=616&amp;h=320&amp;zc=1&amp;fltr[]=wmi|pics/fox.png|BR" />
                            </a>
                        </div>
                        <div class="featured">
                            <a href="img/pics/Robot%20Before%20Ship.jpg">
                                <img title="The Beast!" alt="The Beast! :: Trial run before shipping" src="phpThumb/phpThumb.php?src=../img/pics/Robot%20Before%20Ship.jpg&amp;w=616&amp;h=320&amp;zc=1&amp;fltr[]=wmi|pics/fox.png|BR" />
                            </a>
                        </div>
                    </div>
                </div>
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
            
<?php  include("inc/footer.php"); ?>