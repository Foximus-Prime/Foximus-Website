<?php
include("../../inc/sessionNew.php");
/**
 * User not an administrator, redirect to main page
 * automatically.
**/

if(!$session->isAdmin()){
   header("Location: ../index.php");
}else{
	global $database;
	if(!isset($_POST['name'])){
		$directory = '../../img/profilePics/';
		$scanned_directory = array_diff(scandir($directory), array('..', '.'));
		$picsTodo;
		$posPics;
		$msresult = array();
		$rs = $database->query("SELECT `First_Name`, `Last_Name`, `Team` FROM `user`");
		for($i = 0; $i < mysql_num_rows($rs); $i++) {
			$msresult[$i] = mysql_fetch_array($rs, MYSQL_NUM);
			if($msresult[$i][2] != 0)
				$posPics[$i] = $msresult[$i];
		}
		echo '<form id="image" action="doUserPics.php" method="post">
			<select name="name">';
			foreach($posPics as $a) {
				echo '<option value="'.$a[0].' '.$a[1].'">'.$a[0].' '.$a[1].'</option>';
			}
		echo '<input type="submit" value="Submit" />
		</form>';
		$i = 0;
		foreach($posPics as $a) {
			$q = false;
			foreach($scanned_directory as $b)
				if(strtolower($a[0].$a[1].".jpg") == $b)
					$q = true;
			if(!$q) {
				$picsTodo[$i] = $a;
				$i++;
			}
		}
		unset($posPics);
			
		echo '<br /><br /><br />
				<fieldset>
					<legend>Picture of '.$picsTodo[0][0].' '.$picsTodo[0][1].'</legend>
					<form id="image" action="adminUsersCrop.php" method="post">
						<dl>
							<dt><label for="image">Find a pic he/she is in via the <a href="http://robotics.cyberdenton.com/gallery">gallery</a> and paste the full url here:</label></dt>
							<dd><input id="image" type="text" name="image" /></dd>
						</dl>
						<input type="hidden" name="fname" value="'.$picsTodo[0][0].'">
						<input type="hidden" name="lname" value="'.$picsTodo[0][1].'">
						<input type="submit" value="Submit" />
					</form>
				</fieldset>';
	} else {
		$fname = substr($_POST['name'], 0, strpos($_POST['name'],' '));
		$lname = substr($_POST['name'], strpos($_POST['name'],' ')+1);
		echo '<fieldset>
					<legend>Picture of '.$fname.' '.$lname.'</legend>
					<form id="image" action="adminUsersCrop.php" method="post">
						<dl>
							<dt><label for="image">Find a pic he/she is in via the <a href="http://robotics.cyberdenton.com/gallery">gallery</a> and paste the full url here:</label></dt>
							<dd><input id="image" type="text" name="image" /></dd>
						</dl>
						<input type="hidden" name="fname" value="'.$fname.'">
						<input type="hidden" name="lname" value="'.$lname.'">
						<input type="submit" value="Submit" />
					</form>
				</fieldset>';
	}
}
?>