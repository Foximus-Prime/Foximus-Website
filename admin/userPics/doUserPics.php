<?php

/**
 * User not an administrator, redirect to main page
 * automatically.
**/

if(!$session->isAdmin()){
   header("Location: ../index.php");
}else{
	
	$directory = '../../img/profilePics/';
	$scanned_directory = array_diff(scandir($directory), array('..', '.'));

}
?>