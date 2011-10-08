<?
if(!defined('TBL_ACTIVE_USERS')) {
  die("Error processing page");
}

$q = "SELECT Name FROM ".TBL_ACTIVE_USERS
    ." ORDER BY Timestamp DESC,Name";
$result = $database->query($q);
/* Error occurred, return given name by default */
$num_rows = mysql_numrows($result);
if(!$result || ($num_rows < 0)){
   echo "Error displaying info";
}
else if($num_rows > 0){
   /* Display active users, with link to their info */
   echo "<div>";
   for($i=0; $i<$num_rows; $i++){
      $uname = mysql_result($result,$i,"Name");

      echo "<a href=\"userinfo.php?user=$uname\">$uname</a> / ";
   }
   echo "</div><br />";
}
?>
