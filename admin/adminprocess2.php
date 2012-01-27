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

class AdminProcess2
{
	var $rs;
	var $cID;
	
   /* Class constructor */
   function AdminProcess2(){
      global $session;
      /* Make sure administrator is accessing page */
      if(!$session->isAdmin()){
         header("Location: ../index.php");
         return;
      }
      /* Check what type of form was submitted by Admin */
      if(isset($_GET['list_users'])){
         $this->procLsUsers();
      }
      else if(isset($_GET['list_banned_users'])){
         $this->procLsBannedUsers();
      }
      else if(isset($_GET['update_user_level'])){
         $this->procUpdLevel();
      }
      else if(isset($_GET['delete_user'])){
         $this->procDelUser();
      }
	  else if(isset($_GET['add_user'])){
         $this->procAddUser();
      }
	  else if(isset($_GET['add_user'])){
         $this->procAddUser();
      }
      else if(isset($_GET['delete_inactive'])){
         $this->procDelInactive();
      }
      else if(isset($_GET['ban_user'])){
         $this->procBanUser();
      }
      else if(isset($_GET['delete_banned_user'])){
         $this->procDelBannedUser();
      }
	  else if(isset($_GET['edit_content'])){
         $this->procEditContent($_GET['contentID']);
      }
	  else if(isset($_GET['edit_roster'])){
         $this->procUpdateTeamRoster();
      }
      /* Should not get here, redirect to home page */
      else{
         header("Location: ../index.php");
      }


   }
 
	function checkForm($type,$name) {
		global $form;
		if($type == 0) {
			if($form->num_errors > 0){
				return "<p style=\"color:red\">"
				   ."!*** Error with request, please fix</p>";
			} else {
				return;
			}
		} else if ($type == 1) {
			return $form->error($name);
		} else if ($type == 2) {
			return $form->value($name);
		}
		
	}
	
    function footer() {
		 echo "<br />"
			 ."<p>Generated ".date("F j, Y, g:i a")."</p>";   
    }
   
   /*
   *
   */
   function addDataTable() {
	   echo "<link rel=\"stylesheet\" href=\"../js/mylibs/datatable/css/demo_table.css\" type=\"text/css\" />
	   <link rel=\"stylesheet\" href=\"../js/mylibs/datatable/css/demo_table_jui.css\" type=\"text/css\" />
	   <script src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.js\"></script>
	     <script src=\"../js/mylibs/datatable/js/jquery.dataTables.min.js\"></script>
	   <script type='text/javascript'>
		$(document).ready(function() {
			$('#datatable').dataTable( {
				\"aaSorting\": [[ 4, \"desc\" ]]
			} );
		} );
			</script>";
   }

   /**
    */
   function procLsUsers(){
   
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
	
		$this->addDataTable();
	   /* Display table contents */
	   echo "<table id=\"datatable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"display\">\n";
	   echo "<thead><tr><th>Username</th><th>Level</th><th>Email</th><th>Last Active</th></tr></thead><tbody>\n";
	   for($i=0; $i<$num_rows; $i++){
		  $uname  = mysql_result($result,$i,"Name");
		  $ulevel = mysql_result($result,$i,"Permisions");
		  $email  = mysql_result($result,$i,"Email");
		  $time   = mysql_result($result,$i,"Timestamp");
		  echo "<tr><td>$uname</td><td>$ulevel</td><td>$email</td><td>".date("m/d/Y",$time)."</td></tr>\n";
	   }
	   echo "</tbody></table><br />\n";
	   $this->footer();
   }
   
   /**
    */
   function procLsBannedUsers(){
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
	   
	   
	   $this->addDataTable();
	   /* Display table contents */
	   echo "<table id=\"datatable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"display\">\n";
	   echo "<thead><tr><th>Username</th><th>Time Banned</th></tr></thead><tbody>\n";
	   
	   for($i=0; $i<$num_rows; $i++){
		  $uname = mysql_result($result,$i,"Name");
		  $time  = mysql_result($result,$i,"Timestamp");
		  echo "<tr><td>$uname</td><td>".date("m/d/Y",$time)."</td></tr>\n";
	   }
	   echo "</tbody></table><br />\n";
	   $this->footer();
   }
   
   
   /**
    */
   function procDelUser(){
	   echo "<html><head></head><body>"
					.$this->checkForm(0,"deluser")
					.$this->checkForm(1,"deluser")
					."<fieldset>
                        <legend>Delete User</legend>
                        <form action=\"adminprocess.php\" method=\"post\">
                            <dl>
                                <dt><label for=\"username\" maxlength=\"30\" value=\"".$this->checkForm(2,"deluser")."\">Username:</label></dt>
                                <dd><input id=\"username\" type=\"text\" name=\"deluser\" /></dd>
                            </dl>
                            <input type=\"hidden\" name=\"subdeluser\" value=\"1\">
                            <input type=\"submit\" value=\"Delete User\" />
                        </form>
                    </fieldset>";
	   $this->footer();
	   echo "</body></html>";
   }
   
   /**
    */
   function procAddUser(){
	   echo "<html><head></head><body>"
					."<fieldset>
						<legend>Add User</legend>
						<form action=\"adminprocess.php\" method=\"post\">
							<dl>
								<dt><label for=\"username\" maxlength=\"30\" value=\"\">Username:</label></dt>
								<dd><input id=\"username\" type=\"text\" name=\"user\" /></dd>
								<dt><label for=\"password\" maxlength=\"30\" value=\"\">Password:</label></dt>
								<dd><input id=\"password\" type=\"password\" name=\"pass\" /></dd>
								<dt><label for=\"email\" maxlength=\"50\" value=\"\">Email:</label></dt>
								<dd><input id=\"email\" type=\"email\" name=\"email\" /></dd>
							</dl>
							<input type=\"hidden\" name=\"subadduser\" value=\"1\">
							<input type=\"submit\" value=\"Add\" />
						</form>
					</fieldset>";
	   $this->footer();
	   echo "</body></html>";
   }
   
   /**
    */
   function procBanUser(){
	   echo "<html><head></head><body>"
					.$this->checkForm(0,"banuser")
					.$this->checkForm(1,"banuser")
					."<fieldset>
                        <legend>Ban User</legend>
                        <form action=\"adminprocess.php\" method=\"post\">
                            <dl>
                                <dt><label for=\"username\" maxlength=\"30\" value=\"".$this->checkForm(2,"banuser")."\">Username:</label></dt>
                                <dd><input id=\"username\" type=\"text\" name=\"banuser\" /></dd>
                            </dl>
                            <input type=\"hidden\" name=\"subbanuser\" value=\"1\">
                            <input type=\"submit\" value=\"Ban User\" />
                        </form>
                    </fieldset>";
	   $this->footer();
	   echo "</body></html>";
   }
   
   /**
    */
   function procUpdLevel(){
	   echo "<html><head></head><body>"
					.$this->checkForm(0,"upduser")
					.$this->checkForm(1,"upduser")
					."<fieldset>
                        <legend>Update User Level</legend>
                        <form action=\"adminprocess.php\" method=\"post\">
                            <dl>
                                <dt><label for=\"username\" maxlength=\"30\" value=\"".$this->checkForm(2,"upduser")."\">Username:</label></dt>
                                <dd><input id=\"username\" type=\"text\" name=\"upduser\" /></dd>
                            </dl>
                                <select name=\"updlevel\">
                                <option value=\"1\">1</option>
                                <option value=\"9\">9 (Admin)</option>
                                </select>
                            <input type=\"hidden\" name=\"subupdlevel\" value=\"1\">
                            <input type=\"submit\" value=\"Update Level\" />
                        </form>
                    </fieldset>";
	   $this->footer();
	   echo "</body></html>";
   }
   
   /**
    */
   function procDelBannedUser(){
	   echo "<html><head></head><body>"
					.$this->checkForm(0,"delbanuser")
					.$this->checkForm(1,"delbanuser")
					."<fieldset>
                        <legend>Delete Banned User</legend>
                        <form action=\"adminprocess.php\" method=\"post\">
                            <dl>
                                <dt><label for=\"username\" maxlength=\"30\" value=\"".$this->checkForm(2,"delbanuser")."\">Username:</label></dt>
                                <dd><input id=\"username\" type=\"text\" name=\"delbanuser\" /></dd>
                            </dl>
                            <input type=\"hidden\" name=\"subdelbanned\" value=\"1\">
                            <input type=\"submit\" value=\"Delete Banned User\" />
                        </form>
                    </fieldset>";
	   $this->footer();
	   echo "</body></html>";
   }

   /**
    */
   function procDelInactive(){
	   echo "<html><head></head><body>"
					."<fieldset>
                        <legend>Delete Inactive Users (By Days)</legend>
                        <form action=\"adminprocess.php\" method=\"post\">
                                <select name=\"inactdays\">
                                    <option value=\"3\">3</option>
                                    <option value=\"7\">7</option>
                                    <option value=\"14\">14</option>
                                    <option value=\"30\">30</option>
                                    <option value=\"100\">100</option>
                                    <option value=\"365\">365</option>
                                </select>
                            <input type=\"hidden\" name=\"subdelinact\" value=\"1\">
                            <input type=\"submit\" value=\"Delete All Inactive\" />
                        </form>
                    </fieldset>";
	   $this->footer();
	   echo "</body></html>";
   }
   
  /**
    */
   function procUpdateTeamRoster(){
	   	echo "<html><head><link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"../js/mylibs/niceforms/niceforms-default.css\" /></head><body>";
	   	//modifyCont.php
		global $database;
	   	$rs = $database->query("SELECT `First_Name`, `Last_Name`, `Team`, `Name` FROM `user` WHERE `Team` > 0");
		$msresult = array();
		$cache = array();
		for($i = 0; $i < mysql_num_rows($rs); $i++) {
			$msresult[$i] = mysql_fetch_array($rs, MYSQL_NUM);
			for($q = 0; $q < strlen(strval($msresult[$i][2])); $q++) {
				$cache[$i][$q] = intval(substr(strval($msresult[$i][2]),$q,1),16);
			}
		}
		echo "<form id=\"updateRoster\" action=\"modifyCont.php\" method=\"post\" class=\"niceform\">
			<fieldset>
                <legend>Roster</legend>
                    <dl>
                        <dt><label for=\"fname\" value=\"\">Current Member List:</label></dt>
                        <dd>
							<select multiple=\"multiple\" name=\"cRoster\">";
								for($i = 0; $i < count($cache);$i++) {
									echo "<option value=\"".$msresult[$i][3]."\">".$msresult[$i][0]." ".$msresult[$i][1]."</option>";
								}
		echo				"</select>
						</dd>
                    </dl>
            </fieldset>";
	   	$this->footer();
	   	echo "</body><script language=\"javascript\" type=\"text/javascript\" src=\"../js/mylibs/niceforms/niceforms.js\"></script></html>";
   }
   
   function procEditContent($cID){
		global $database;
	   echo '<html><head>';
	   if(filter_var($cID,FILTER_VALIDATE_INT)) {
		   echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.js"></script>
				<script type="text/javascript" src="../js/mylibs/tiny_mce/tiny_mce_src.js"></script>
				<script type="text/javascript">
					$(document).ready(function(){			
							tinyMCE.init({
								mode : "textareas",
								theme : "advanced",
								plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
								theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
								theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
								theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
								theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
								theme_advanced_resizing : true,
								theme_advanced_toolbar_location : "top",
								theme_advanced_toolbar_align : "left",
								theme_advanced_statusbar_location : "bottom"
							});
					});
					
					function ajaxSave(id) {
							var ed = tinyMCE.get(\'content\');
														
							ed.setProgressState(1); // Show progress
							$.post("modifyCont.php", { sendData: 1, ID: id, Data: ed.getContent() }, function(data){
								ed.setContent(data);
								ed.setProgressState(0);
							});
							
							return false;
					}
					</script>'
				.'</head><body>';
			$rs = $database->query("SELECT `Description` FROM `Content` WHERE `ID` = $cID");
			echo '<h2>'.mysql_result($rs, 0).'</h2>';
			$rs = $database->query("SELECT `Text` FROM `Content` WHERE `ID` = $cID");
			echo '<textarea id="content" style="width:100%">'
				. mysql_result($rs, 0)
				. '</textarea><input type="submit" value="Save" onClick="javascript:ajaxSave('.$cID.');" />';
		   $this->footer();
	   } else {
			echo 'Get lost you little hacker. Please note('+$_SERVER['REMOTE_ADDR']+') along with some other useful information has been logged =).';   
	   }
	   echo "</body></html>";
   }

};

/* Initialize process */
$adminprocess2 = new AdminProcess2;

?>
