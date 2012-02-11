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

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Foximus-Prime</title>
  	<link rel="stylesheet" type="text/css" media="all" href="js/mylibs/niceforms/niceforms-default.css" />
<?php
include_once("inc/header.php");
if($session->isAdmin()){
?>
<div class="container_12" style="padding-top: 20px;">
    <div class="grid_12">
        <div class="contentHead">
            <h3>Admin Link</h3>
        </div>
        <article class="contentCont"  id="topInfo">
            <h1><a href="admin/admin.php">CLICKY</a></h1>
      </article>
    </div>
</div>
<div id="clear"></div>
<?php
}
else{
?>
<div class="container_12" style="padding-top: 20px;">
    <div class="grid_12">
        <div class="contentHead">
            <h3>Login</h3>
        </div>
        <article class="contentCont"  id="topInfo">
<?php
if($form->num_errors > 0){
   echo "<p class=\"errors\">".$form->num_errors." error(s) found</p>";
}
?>
        <form id="login" action="loginCheck.php" method="post" class="niceform">
            <fieldset>
                <legend>Log In</legend>
                    <dl>
                        <dt><label for="username" maxlength="30" value="<? echo $form->value("user"); ?>">Username:</label></dt>
                        <dd><input id="username" type="text" name="user" /><? echo $form->error("user"); ?></dd>
                    </dl>
                    <dl>
                        <dt><label for="password" maxlength="30" value="<? echo $form->value("pass"); ?>">Password:</label></dt>
                        <dd><input id="password" type="password" name="pass" /><? echo $form->error("pass"); ?></dd>
                    </dl>
                    <dl>
                        <dt><label for="remember">Remember Me:</label></dt>
                        <dd><input type="checkbox" name="remember" value="<? if($form->value("remember") != ""){ echo "checked"; } ?>" /></dd>
                    </dl>
              </fieldset>
               <fieldset class="action">
                   <input type="hidden" name="sublogin" value="1">
                   <input type="submit" value="Login" />
               </fieldset>
            </form>
      </article>
    </div>
</div>
<div id="clear"></div>
<?php
}
include_once("inc/js.php");
?>
<script language="javascript" type="text/javascript" src="js/mylibs/niceforms/niceforms.js"></script>
<?php
include_once("inc/footer.php");
?>

</div>
</body>
</html>