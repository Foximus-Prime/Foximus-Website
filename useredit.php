<?php
include("inc/sessionNew.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fluid Logins - Edit User</title>
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
/**
 * User has submitted form without errors and user's
 * account has been edited successfully.
 */
if(isset($_SESSION['useredit'])){
   unset($_SESSION['useredit']);
   
   echo "<h1>User Account Edit Success!</h1>";
   echo "<p><b>$session->username</b>, your account has been successfully updated. "
       ."<a href=\"index.php\">Main</a>.</p>";
}
else{
?>

<?php
/**
 * If user is not logged in, then do not display anything.
 * If user is logged in, then display the form to edit
 * account information, with the current email address
 * already in the field.
 */
if($session->logged_in){
?>

<h1>User Account Edit : <? echo $session->username; ?></h1>
<?php
if($form->num_errors > 0){
   echo "<td><font size=\"2\" color=\"#ff0000\">".$form->num_errors." error(s) found</font></td>";
}
?>

<fieldset>
    <legend>Log In</legend>
    <form id="login" action="../Login/login2.php" method="post">
        <dl>
            <dt><label for="password" maxlength="30" value="<?php echo $form->value("curpass"); ?>">Current Password:</label></dt>
            <dd><input id="password" type="password" name="curpass" /><?php echo $form->error("curpass"); ?></dd>
            <dt><label for="password" maxlength="30" value="<?php echo $form->value("newpass"); ?>">New Password:</label></dt>
            <dd><input id="password" type="password" name="newpass" /><?php echo $form->error("newpass"); ?></dd>
            <dt><label for="email" maxlength="50" value="<?php if($form->value("email") == ""){ echo $session->userinfo['email']; }else{ echo $form->value("email"); } ?>">Email:</label></dt>
            <dd><input id="email" type="email" name="email" /><?php echo $form->error("email"); ?></dd>
        </dl>
        <input type="hidden" name="subedit" value="1">
        <input type="submit" value="Login" />
    </form>
</fieldset>

<?php
}
}
?>
  		</section>

        
		<footer id="footer">
<?php
include("inc/footer.php");
?>
		</footer>

</div>
</body>
</html>