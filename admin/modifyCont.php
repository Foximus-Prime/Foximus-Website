<?php
/**
 * AdminProcess.php
 * 
 * The AdminProcess class is meant to simplify the task of processing
 * admin submitted forms from the admin center, these deal with
 * member system adjustments.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 15, 2004
 */
include("../inc/sessionNew.php");

class modifyContent
{
	var $rs;
   /* Class constructor */
   function modifyContent(){
      global $session;
      /* Make sure administrator is accessing page */
      if(!$session->isAdmin()){
         header("Location: ../index.php");
         return;
      }
	  
      /* Check what type of form was submitted by Admin */
	  if(isset($_POST['sendData'])){
         $this->saveData($_POST['ID'], $_POST['Data']);
	  }
      /* Should not get here, redirect to home page */
      else{
         header("Location: ../index.php");
      }
	  
   }
	  
	  function sendData($id) {
		  global $database;
		  $rs = $database->query("SELECT `Text` FROM `Content` WHERE `ID` = $id");
		  echo mysql_result($rs, 0);
	  }
	  
	  function saveData($id, $data) {
		  global $database;
		  $rs = $database->query("UPDATE `Content` SET `Text` = '".$data."' WHERE `ID` = $id");
		  $rs = $database->query("SELECT `Text` FROM `Content` WHERE `ID` = $id");
		  echo mysql_result($rs, 0);
	  }
};

/* Initialize process */
$modifyContent = new modifyContent;

?>
