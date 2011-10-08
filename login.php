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

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Foximus-Prime</title>
<?php
	include("inc/header.php");
?>
        
		<section id="mainCont">
<?php
if($session->logged_in){
   
}
else{
?>

<fieldset>
    <legend>Log In</legend>
    <form id="login" action="loginCheck.php" method="post">
        <dl>
            <dt><label for="username" maxlength="30" value="<? echo $form->value("user"); ?>">Username:</label></dt>
            <dd><input id="username" type="text" name="user" /><? echo $form->error("user"); ?></dd>
            <dt><label for="password" maxlength="30" value="<? echo $form->value("pass"); ?>">Password:</label></dt>
            <dd><input id="password" type="password" name="pass" /><? echo $form->error("pass"); ?></dd>
            <dt><p>Remember me next time</p></dt>
            <dd><input type="checkbox" name="remember" <? if($form->value("remember") != ""){ echo "checked"; } ?>/></dd>
        </dl>
        <input type="hidden" name="sublogin" value="1">
        <input type="submit" value="Login" />
    </form>
</fieldset>

  		</section>

        
		<footer id="footer">
<?php
}
include("inc/footer.php");
?>
		</footer>

</div>
</body>
</html>