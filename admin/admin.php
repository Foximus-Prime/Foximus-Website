<?
include("inc/sessionNew.php");

/**
 * displayUsers - Displays the users database table in
 * a nicely formatted html table.
 */
function displayUsers(){
   global $database;
   $q = "SELECT Name,Permisions,Email,Timestamp "
       ."FROM ".TBL_USERS." ORDER BY Permisions DESC,Name";
   $result = $database->query($q);
   /* Error occurred, return given name by default */
   $num_rows = mysql_numrows($result);
   if(!$result || ($num_rows < 0)){
      echo "Error displaying info";
      return;
   }
   if($num_rows == 0){
      echo "Database table empty";
      return;
   }
   /* Display table contents */
   echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\n";
   echo "<tr><td><b>Username</b></td><td><b>Level</b></td><td><b>Email</b></td><td><b>Last Active</b></td></tr>\n";
   for($i=0; $i<$num_rows; $i++){
      $uname  = mysql_result($result,$i,"Name");
      $ulevel = mysql_result($result,$i,"Permisions");
      $email  = mysql_result($result,$i,"Email");
      $time   = mysql_result($result,$i,"Timestamp");

      echo "<tr><td>$uname</td><td>$ulevel</td><td>$email</td><td>$time</td></tr>\n";
   }
   echo "</table><br>\n";
}


/**
 * User not an administrator, redirect to main page
 * automatically.
 */
if(!$session->isAdmin()){
   header("Location: ../index.php");
}
else{
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fluid Logins - Admin Center</title>
<base href="file:///C|/Users/Austin's Machine/Documents/Web Sites" />
<?php
	include("file:///C|/Users/Austin's Machine/Documents/Web Sites/inc/header.php");
?>
        
		<section id="mainCont">
<?php

/**
 * displayBannedUsers - Displays the banned users
 * database table in a nicely formatted html table.
 */
function displayBannedUsers(){
   global $database;
   $q = "SELECT Name,Timestamp "
       ."FROM ".TBL_BANNED_USERS." ORDER BY Name";
   $result = $database->query($q);
   /* Error occurred, return given name by default */
   $num_rows = mysql_numrows($result);
   if(!$result || ($num_rows < 0)){
      echo "Error displaying info";
      return;
   }
   if($num_rows == 0){
      echo "Database table empty";
      return;
   }
   /* Display table contents */
   echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\n";
   echo "<tr><td><b>Username</b></td><td><b>Time Banned</b></td></tr>\n";
   for($i=0; $i<$num_rows; $i++){
      $uname = mysql_result($result,$i,"Name");
      $time  = mysql_result($result,$i,"Timestamp");

      echo "<tr><td>$uname</td><td>$time</td></tr>\n";
   }
   echo "</table><br>\n";
}
   

/**
 * Administrator is viewing page, so display all
 * forms.
 */
?>

<h1>Admin Center</h1>

<?
if($form->num_errors > 0){
   echo "<p style=\"color:red\">"
       ."!*** Error with request, please fix</p>";
}

/**
 * Display Users Table
 */
?>
<h3>Users Table Contents:</h3>
<?
displayUsers();
?>

<br>
<?
/**
 * Update User Level
 */
?>
<h3>Update User Level</h3>
<? echo $form->error("upduser"); ?>
<fieldset>
    <legend>Update User Level</legend>
    <form action="file:///C|/Users/Austin's Machine/Documents/Web Sites/admin/adminprocess.php" method="post">
        <dl>
            <dt><label for="username" maxlength="30" value="<?php echo $form->value("upduser"); ?>">Username:</label></dt>
            <dd><input id="username" type="text" name="upduser" /></dd>
        </dl>
        	<select name="updlevel">
			<option value="1">1</option>
			<option value="9">9</option>
			</select>
        <input type="hidden" name="subupdlevel" value="1">
        <input type="submit" value="Update Level" />
    </form>
</fieldset>

<?
/**
 * Delete User
 */
?>
<? echo $form->error("deluser"); ?>
<fieldset>
    <legend>Delete User</legend>
    <form action="file:///C|/Users/Austin's Machine/Documents/Web Sites/admin/adminprocess.php" method="post">
        <dl>
            <dt><label for="username" maxlength="30" value="<?php echo $form->value("deluser"); ?>">Username:</label></dt>
            <dd><input id="username" type="text" name="deluser" /></dd>
        </dl>
        <input type="hidden" name="subdeluser" value="1">
        <input type="submit" value="Delete User" />
    </form>
</fieldset>

<?
/**
 * Delete Inactive Users
 */
?>
<h3>Delete Inactive Users</h3>
This will delete all users (not administrators), who have not logged in to the site<br>
within a certain time period. You specify the days spent inactive.<br><br>

<fieldset>
    <legend>Delete Inactive Users</legend>
    <form action="file:///C|/Users/Austin's Machine/Documents/Web Sites/admin/adminprocess.php" method="post">
        	<select name="inactdays">
				<option value="3">3</option>
				<option value="7">7</option>
            	<option value="14">14</option>
				<option value="30">30</option>
				<option value="100">100</option>
				<option value="365">365</option>
			</select>
        <input type="hidden" name="subdelinact" value="1">
        <input type="submit" value="Delete All Inactive" />
    </form>
</fieldset>

<?
/**
 * Ban User
 */
?>
<? echo $form->error("banuser"); ?>
<fieldset>
    <legend>Ban User</legend>
    <form action="file:///C|/Users/Austin's Machine/Documents/Web Sites/admin/admin/adminprocess.php" method="post">
        <dl>
            <dt><label for="username" maxlength="30" value="<?php echo $form->value("banuser"); ?>">Username:</label></dt>
            <dd><input id="username" type="text" name="banuser" /></dd>
        </dl>
        <input type="hidden" name="subbanuser" value="1">
        <input type="submit" value="Ban User" />
    </form>
</fieldset>

<?
/**
 * Display Banned Users Table
 */
?>
<h3>Banned Users Table Contents:</h3>
<?
displayBannedUsers();

/**
 * Delete Banned User
 */
?>
<? echo $form->error("delbanuser"); ?>
<fieldset>
    <legend>Delete Banned User</legend>
    <form action="file:///C|/Users/Austin's Machine/Documents/Web Sites/admin/adminprocess.php" method="post">
        <dl>
            <dt><label for="username" maxlength="30" value="<?php echo $form->value("delbanuser"); ?>">Username:</label></dt>
            <dd><input id="username" type="text" name="delbanuser" /></dd>
        </dl>
        <input type="hidden" name="subdelbanned" value="1">
        <input type="submit" value="Delete Banned User" />
    </form>
</fieldset>
<?
}
?>
  		</section>

        
		<footer id="footer">
<?php
echo "</td></tr><tr><td align=\"center\"><br><br>";
echo "<b>Member Total:</b> ".$database->getNumMembers()."<br>";
echo "There are $database->num_active_users registered members and ";
echo "$database->num_active_guests guests viewing the site.<br><br>";

include("file:///C|/Users/Austin's Machine/Documents/Web Sites/inc/view_active.php");
?>
		</footer>

</div>
</body>
</html>

