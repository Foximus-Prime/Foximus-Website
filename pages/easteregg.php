<?php 
include_once("../inc/sessionNew.php");
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
  <base href=<?php echo("\"".BASE_ADRS."\"") ?> />
<?php 
	include_once("../inc/header.php");
?>
        <div class="container_12">
        	<div class="grid_8">
            	<div class="contentHead"><h3>SURPRISE</h3></div>
                <article class="contentCont">
					<p>You found this sweet place of pure cool. Don't forget to check out the sweet paralaxing URL above (<a href="http://cameronmcefee.com/parallax-url">HERE</a>)!</p>
                </article>
            </div>
            <div class="grid_4">
               <div class="contentHead"></div>
               <div class="contentCont">

                </div>
            </div>
            </div>
            <div class="clear"></div>

<?php  include_once("../inc/js.php"); ?>
<script type="text/javascript">
$(document).ready(function () {        
        $.plax.enable()
      })
</script>
<script src="../js/plax-url.js" type="text/javascript"></script>
<?php  include_once("../inc/footer.php"); ?>
