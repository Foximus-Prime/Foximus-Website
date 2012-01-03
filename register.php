<?php
include("inc/sessionNew.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fluid Logins - Register</title>
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
<?
/**
 * The user is already logged in, not allowed to register.
 */
if($session->logged_in){
   echo "<h1>Registered</h1>";
   echo "<p>We're sorry <b>$session->username</b>, but you've already registered. "
       ."<a href=\"index.php\">Main</a>.</p>";
}
/**
 * The user has submitted the registration form and the
 * results have been processed.
 */
else if(isset($_SESSION['regsuccess'])){
   /* Registration was successful */
   if($_SESSION['regsuccess']){
      echo "<h1>Registered!</h1>";
      echo "<p>Thank you <b>".$_SESSION['reguname']."</b>, your information has been added to the database, "
          ."you may now <a href=\"index.php\">log in</a>.</p>";
   }
   /* Registration failed */
   else{
      echo "<h1>Registration Failed</h1>";
      echo "<p>We're sorry, but an error has occurred and your registration for the username <b>".$_SESSION['reguname']."</b>, "
          ."could not be completed.<br>Please try again at a later time.</p>";
   }
   unset($_SESSION['regsuccess']);
   unset($_SESSION['reguname']);
}
/**
 * The user has not filled out the registration form yet.
 * Below is the page with the sign-up form, the names
 * of the input fields are important and should not
 * be changed.
 */
else{
?>
<?
if($form->num_errors > 0){
   echo "<p class=\"errors\">".$form->num_errors." error(s) found</p>";
}
?>
<div class="container_12" style="padding-top: 20px;">
    <div class="grid_12">
        <div class="contentHead">
            <h3>Register</h3>
        </div>
        <article class="contentCont"  id="topInfo">
            <fieldset>
                <legend>Register</legend>
                <form id="login" action="loginCheck.php" method="post">
                    <dl>
                        <dt><label for="username" maxlength="30" value="<? echo $form->value("user"); ?>">Username:</label></dt>
                        <dd><input id="username" type="text" name="user" /><? echo $form->error("user"); ?></dd>
                        <dt><label for="password" maxlength="30" value="<? echo $form->value("pass"); ?>">Password:</label></dt>
                        <dd><input id="password" type="password" name="pass" /><? echo $form->error("pass"); ?></dd>
                        <dt><label for="email" maxlength="50" value="<? echo $form->value("email"); ?>">Email:</label></dt>
                        <dd><input id="email" type="email" name="email" /><? echo $form->error("email"); ?></dd>
                    </dl>
                    <input type="hidden" name="subjoin" value="1">
                    <input type="submit" value="Join" />
                </form>
            </fieldset>
      </article>
    </div>
</div>


<?
}
?>
  		</section>

        
		<footer id="footer">
<?php  include("inc/js.php"); ?>
<?php  include("inc/footer.php"); ?>
		</footer>

</div>
</body>
</html>
