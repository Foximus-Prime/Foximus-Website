<?php 
include("../inc/sessionNew.php");

/**

 * User not an administrator, redirect to main page

 * automatically.

 */

if(!$session->isAdmin()){

   header("Location: ../index.php");

} else {

$type = (int)$_GET['t'];



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



  <title>Foximus-Prime Users Table</title>

  </head>

  <body>

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

                    if($form->num_errors > 0){

                       echo "<p style=\"color:red\">"

                           ."!*** Error with request, please fix</p>";

                    }

					

					if ($type == 1) {

                    

                    /**

                     * Display Users Table

                     */

                    ?>

                    <fieldset>

                    	<legend>Users Table Contents:</legend>

                    <?php

                    	displayUsers();

					?>

                    </fieldset>

                    <?php

					} else if ($type == 2) {

						

                    /**

                     * Display Banned Users Table

                     */

                    ?>

                    <fieldset>

                    	<legend>Banned Users Table Contents:</legend>

                    <?php

                    	displayBannedUsers();

                    

					}

				}

                    ?>

                    </fieldset>

</body>

</html>

<?php } ?>