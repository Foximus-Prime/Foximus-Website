<?php 
include("../../inc/sessionNew.php");
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
  <base href="../../" />
<?php 
	include("../../inc/header.php");

	$rs = $database->query("SELECT `Text` FROM `Content` WHERE `Page` = 5");
?>
        <div class="container_12">
        	<div class="grid_8">
            	<div class="contentHead"></div>
                <article class="contentCont">
					<?php 
						echo mysql_result($rs, 0);
					?>
                </article>
            </div>
            <div class="grid_4">
               <div class="contentHead"></div>
               <div class="contentCont">
                   	<?php 
						echo mysql_result($rs, 1);
					?>
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
<?php  include("../../inc/js.php"); ?>
<?php  include("../../inc/footer.php"); ?>