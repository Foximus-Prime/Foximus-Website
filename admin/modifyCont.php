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

class Content
{
   /* Class constructor */
   function Content(){
      global $session;
      /* Make sure administrator is accessing page */
      if(!$session->isAdmin()){
         header("Location: ../index.php");
         return;
      }
      /* Check what type of form was submitted by Admin */
      if(isset($_POST['reqData'])){
         $this->sendData($_POST['contID']);
      }
      else if(isset($_POST['sendData'])){
         $this->saveData($_POST['contID'], $_POST['data']);
	  }
      /* Should not get here, redirect to home page */
      else{
         header("Location: ../index.php");
      }


   }
   
   /**
    */
   function sendData($id){
	   $rs = $database->query("SELECT `Text` FROM `Content` WHERE `ID` = ".$id);
	   echo mysql_result($rs, 0);
   }
   
   /**
    */
   function saveData($id, $cont){
	   $rs = $database->query("UPDATE `Content` SET `Text` = ".$cont." FROM  WHERE `ID` = ".$id);
   }

};

/* Initialize process */
$Content = new Content;

?>
