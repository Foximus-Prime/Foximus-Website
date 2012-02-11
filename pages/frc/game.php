<?php 
include_once("../../inc/sessionNew.php");
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
	include_once("../../inc/header.php");

	$rs = $database->query("SELECT `Text` FROM `Content` WHERE `Page` = 2 ORDER BY `Area`");
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

<?php  include_once("../../inc/js.php"); ?>
<?php  include_once("../../inc/footer.php"); ?>