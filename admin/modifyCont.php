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
	  } else if(isset($_POST['setTeam'])) {
		 $this->setTeam($_POST['cRoster'],$_POST['cTeams'],1);
	  } else if(isset($_POST['removeTeam'])) {
		  $this->removeTeam($_POST['cRoster'],$_POST['cTeams']);
	  } else if(isset($_POST['makeLeader'])) {
		  $this->setTeam($_POST['cRoster'],$_POST['cTeams'],2);
	  } else if(isset($_POST['makeMentor'])) {
		  $this->setTeam($_POST['cRoster'],$_POST['cTeams'],3);
	  } else if(isset($_POST['removeLeader'])) {
		  $this->removerHigherStatus($_POST['cRoster'],$_POST['cTeams']);
	  } else if(isset($_POST['removeMentor'])) {
		  $this->removerHigherStatus($_POST['cRoster'],$_POST['cTeams']);
	  }
      /* Should not get here, redirect to home page */
      else{
         header("Location: ../index.php");
      }
	  
   }
   
	  function setTeam($array1,$array2, $c) {
              global $database;
              for($i = 0; $i < count($array1); $i++){
                    $change = false;
                    $rs = $database->query("SELECT `Team` FROM `user` WHERE Name = '$array1[$i]'");

                    if(intval(strval(mysql_result($rs, 0)),16) == 0)
                        $rs2 = "";
                    else
                        $rs2 = "".mysql_result($rs, 0);

                    for($h = 0; $h < count($array2); $h++){
                            $team = dechex(intval($array2[$h]));
                            if(!strpos(mysql_result($rs, 0), $team)) {
                                    for($a = 0; $a<$c; $a++)
                                        $rs2 = $rs2.$team;
                                    $change = true;
                            }
                    }
                    if($change)
                            $database->query("UPDATE `user` SET `Team` = '$rs2' WHERE Name = '$array1[$i]'");
              }
              echo "<meta HTTP-EQUIV=\"refresh\" CONTENT=\"2; URL=http://themrmiller.com/austin/admin/adminprocess2.php?edit_roster=1\">";
              echo "Redirect in 2...";
              //header("Location: http://themrmiller.com/austin/admin/adminprocess2.php?edit_roster=1");
	  }
	  
	  function removeTeam($array1,$array2) {
		  global $database;
		  for($i = 0; $i < count($array1); $i++){
			  	$rs = $database->query("SELECT Team FROM `user` WHERE Name = '$array1[$i]'");
				$rs2 = "".mysql_result($rs, 0);

				for($h = 0; $h < count($array2); $h++){
					$team = dechex(intval($array2[$h]));
					$rs2 = str_replace($team,"",$rs2);
				}
				$database->query("UPDATE `user` SET `Team` = '$rs2' WHERE Name = '$array1[$i]'");
		  }
		  echo "<meta HTTP-EQUIV=\"refresh\" CONTENT=\"2; URL=http://themrmiller.com/austin/admin/adminprocess2.php?edit_roster=1\">";
		  echo "Redirect in 2...";
		  //header("Location: http://themrmiller.com/austin/admin/adminprocess2.php?edit_roster=1");
	  }
	  
	  function removeHigherStatus($array1,$array2) {
		  global $database;
		  for($i = 0; $i < count($array1); $i++){
			  	$rs = $database->query("SELECT Team FROM `user` WHERE Name = '$array1[$i]'");
				$rs2 = "".mysql_result($rs, 0);

				for($h = 0; $h < count($array2); $h++){
					$team = dechex(intval($array2[$h]));
					$rs2 = str_replace($team,"",$rs2);
					$rs2 = $rs2.$team;
				}
				$database->query("UPDATE `user` SET `Team` = '$rs2' WHERE Name = '$array1[$i]'");
		  }
		  echo "<meta HTTP-EQUIV=\"refresh\" CONTENT=\"2; URL=http://themrmiller.com/austin/admin/adminprocess2.php?edit_roster=1\">";
		  echo "Redirect in 2...";
		  //header("Location: http://themrmiller.com/austin/admin/adminprocess2.php?edit_roster=1");
	  }
	  
	  function sendData($id) {
		  global $database;
		  $rs = $database->query("SELECT `Text` FROM `Content` WHERE `ID` = '$id'");
		  echo mysql_result($rs, 0);
	  }
	  
	  function saveData($id, $data) {
		  global $database;
		  $rs = $database->query("UPDATE `Content` SET `Text` = '".$data."' WHERE `ID` = '$id'");
		  $rs = $database->query("SELECT `Text` FROM `Content` WHERE `ID` = $id");
		  echo mysql_result($rs, 0);
	  }
};

/* Initialize process */
$modifyContent = new modifyContent;

?>
