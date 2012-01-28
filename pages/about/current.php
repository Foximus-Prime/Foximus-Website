<?php 
include("../../inc/sessionNew.php");
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

  <title>Foximus-Prime</title>
  <base href="../../" />
<?php 
	include("../../inc/header.php");

	$rs = $database->query("SELECT `First_Name`, `Last_Name`, `Team` FROM `user` ORDER BY LENGTH(Team) DESC");
?>
        <div class="container_12">
        
        <?php
			$msresult = array();
			$cache = array();
			$count = array();
			for($i = 0; $i < mysql_num_rows($rs); $i++) {
				$q = 0;
				$msresult[$i] = mysql_fetch_array($rs, MYSQL_NUM);
				while(intval(substr(strval($msresult[$i][2]),$q,1),16) > 0) {
					$temp = intval(substr(strval($msresult[$i][2]),$q,1),16);
					$cache[$i][$q] = $temp;
					$count[$i][$temp]++;
					$q++;
				}
			}
			
			
			/*foreach ($cache as $i => $row)
				for($t = 0; $t < 17; $t++) 
					for($r = 0; $r<count($cache[$i]); $r++)
						if ($cache[$i][$r] == $t)
							$count[$i][$t]++;
							
							*/
							
							
		/* List of team numbers:
			1 => "Programming", 2 => "Electrical", 3 => "Build",
			4 => "Communications/ Awards", 5 => "Pit",
			6 => "Party", 7 => "Safety", 8 => "Scout",
			9 => "Analyze", 10 => "Drive", 11 => "Fundraising",
			12 => "Anamation"
			*/
		?>
        
        
        
        
        
            <div class="grid_12 paddingTop">
            	<div class="contentHead"><h3>Programming Team</h3></div>
                <article class="contentCont" style="width:916px;">
		<?php $TEMP_TEAM_ID = 1; for($i = 0; $i < count($cache); $i++) { if($count[$i][$TEMP_TEAM_ID] > 0) { ?>
                <div class="clubMember <?php if($count[$i][$TEMP_TEAM_ID] == 2) { echo "subTeamLeader"; } else if($count[$i][$TEMP_TEAM_ID] > 2) { echo "subTeamMentor"; } ?>">
                    <img src="phpThumb/phpThumb.php?src=../img/profilePics/<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>.jpg&amp;w=130&amp;h=130" alt="<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>"  width="130" height="130"/>
                    <h4><?php echo $msresult[$i][0]."<br />".$msresult[$i][1]; ?></h4>
                </div>
        <?php } } flush();?>
                </article>
            </div>
            
            <div class="grid_12 paddingTop">
            	<div class="contentHead"><h3>Electrical Team</h3></div>
                <article class="contentCont" style="width:916px;">
		<?php $TEMP_TEAM_ID = 2; for($i = 0; $i < count($cache); $i++) { if($count[$i][$TEMP_TEAM_ID] > 0) { ?>
                <div class="clubMember <?php if($count[$i][$TEMP_TEAM_ID] == 2) { echo "subTeamLeader"; } else if($count[$i][$TEMP_TEAM_ID] > 2) { echo "subTeamMentor"; } ?>">
                    <img src="phpThumb/phpThumb.php?src=../img/profilePics/<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>.jpg&amp;w=130&amp;h=130" alt="<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>"  width="130" height="130"/>
                    <h4><?php echo $msresult[$i][0]."<br />".$msresult[$i][1]; ?></h4>
                </div>
        <?php } } flush();?>
                </article>
            </div>
            
            <div class="grid_12 paddingTop">
            	<div class="contentHead"><h3>Build Team</h3></div>
                <article class="contentCont" style="width:916px;">
		<?php $TEMP_TEAM_ID = 3; for($i = 0; $i < count($cache); $i++) { if($count[$i][$TEMP_TEAM_ID] > 0) { ?>
                <div class="clubMember <?php if($count[$i][$TEMP_TEAM_ID] == 2) { echo "subTeamLeader"; } else if($count[$i][$TEMP_TEAM_ID] > 2) { echo "subTeamMentor"; } ?>">
                    <img src="phpThumb/phpThumb.php?src=../img/profilePics/<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>.jpg&amp;w=130&amp;h=130" alt="<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>"  width="130" height="130"/>
                    <h4><?php echo $msresult[$i][0]."<br />".$msresult[$i][1]; ?></h4>
                </div>
        <?php } } flush();?>
                </article>
            </div>
            
            <div class="grid_12 paddingTop">
            	<div class="contentHead"><h3>Communications Team</h3></div>
                <article class="contentCont" style="width:916px;">
		<?php $TEMP_TEAM_ID = 4; for($i = 0; $i < count($cache); $i++) { if($count[$i][$TEMP_TEAM_ID] > 0) { ?>
                <div class="clubMember <?php if($count[$i][$TEMP_TEAM_ID] == 2) { echo "subTeamLeader"; } else if($count[$i][$TEMP_TEAM_ID] > 2) { echo "subTeamMentor"; } ?>">
                    <img src="phpThumb/phpThumb.php?src=../img/profilePics/<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>.jpg&amp;w=130&amp;h=130" alt="<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>"  width="130" height="130"/>
                    <h4><?php echo $msresult[$i][0]."<br />".$msresult[$i][1]; ?></h4>
                </div>
        <?php } } flush();?>
                </article>
            </div>
            
            <div class="grid_12 paddingTop">
            	<div class="contentHead"><h3>Pit Team</h3></div>
                <article class="contentCont" style="width:916px;">
		<?php $TEMP_TEAM_ID = 5; for($i = 0; $i < count($cache); $i++) { if($count[$i][$TEMP_TEAM_ID] > 0) { ?>
                <div class="clubMember <?php if($count[$i][$TEMP_TEAM_ID] == 2) { echo "subTeamLeader"; } else if($count[$i][$TEMP_TEAM_ID] > 2) { echo "subTeamMentor"; } ?>">
                    <img src="phpThumb/phpThumb.php?src=../img/profilePics/<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>.jpg&amp;w=130&amp;h=130" alt="<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>"  width="130" height="130"/>
                    <h4><?php echo $msresult[$i][0]."<br />".$msresult[$i][1]; ?></h4>
                </div>
        <?php } } flush();?>
                </article>
            </div>
            
            <div class="grid_12 paddingTop">
            	<div class="contentHead"><h3>Party Team</h3></div>
                <article class="contentCont" style="width:916px;">
		<?php $TEMP_TEAM_ID = 6; for($i = 0; $i < count($cache); $i++) { if($count[$i][$TEMP_TEAM_ID] > 0) { ?>
                <div class="clubMember <?php if($count[$i][$TEMP_TEAM_ID] == 2) { echo "subTeamLeader"; } else if($count[$i][$TEMP_TEAM_ID] > 2) { echo "subTeamMentor"; } ?>">
                    <img src="phpThumb/phpThumb.php?src=../img/profilePics/<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>.jpg&amp;w=130&amp;h=130" alt="<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>"  width="130" height="130"/>
                    <h4><?php echo $msresult[$i][0]."<br />".$msresult[$i][1]; ?></h4>
                </div>
        <?php } } flush();?>
                </article>
            </div>
            
            <div class="grid_12 paddingTop">
            	<div class="contentHead"><h3>Safety Team</h3></div>
                <article class="contentCont" style="width:916px;">
		<?php $TEMP_TEAM_ID = 7; for($i = 0; $i < count($cache); $i++) { if($count[$i][$TEMP_TEAM_ID] > 0) { ?>
                <div class="clubMember <?php if($count[$i][$TEMP_TEAM_ID] == 2) { echo "subTeamLeader"; } else if($count[$i][$TEMP_TEAM_ID] > 2) { echo "subTeamMentor"; } ?>">
                    <img src="phpThumb/phpThumb.php?src=../img/profilePics/<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>.jpg&amp;w=130&amp;h=130" alt="<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>"  width="130" height="130"/>
                    <h4><?php echo $msresult[$i][0]."<br />".$msresult[$i][1]; ?></h4>
                </div>
        <?php } } flush();?>
                </article>
            </div>
            
            <div class="grid_12 paddingTop">
            	<div class="contentHead"><h3>Scout Team</h3></div>
                <article class="contentCont" style="width:916px;">
		<?php $TEMP_TEAM_ID = 8; for($i = 0; $i < count($cache); $i++) { if($count[$i][$TEMP_TEAM_ID] > 0) { ?>
                <div class="clubMember <?php if($count[$i][$TEMP_TEAM_ID] == 2) { echo "subTeamLeader"; } else if($count[$i][$TEMP_TEAM_ID] > 2) { echo "subTeamMentor"; } ?>">
                    <img src="phpThumb/phpThumb.php?src=../img/profilePics/<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>.jpg&amp;w=130&amp;h=130" alt="<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>"  width="130" height="130"/>
                    <h4><?php echo $msresult[$i][0]."<br />".$msresult[$i][1]; ?></h4>
                </div>
        <?php } } flush();?>
                </article>
            </div>
            
            <div class="grid_12 paddingTop">
            	<div class="contentHead"><h3>Analyze Team</h3></div>
                <article class="contentCont" style="width:916px;">
		<?php $TEMP_TEAM_ID = 9; for($i = 0; $i < count($cache); $i++) { if($count[$i][$TEMP_TEAM_ID] > 0) { ?>
                <div class="clubMember <?php if($count[$i][$TEMP_TEAM_ID] == 2) { echo "subTeamLeader"; } else if($count[$i][$TEMP_TEAM_ID] > 2) { echo "subTeamMentor"; } ?>">
                    <img src="phpThumb/phpThumb.php?src=../img/profilePics/<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>.jpg&amp;w=130&amp;h=130" alt="<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>"  width="130" height="130"/>
                    <h4><?php echo $msresult[$i][0]."<br />".$msresult[$i][1]; ?></h4>
                </div>
        <?php } } flush();?>
                </article>
            </div>
            
            <div class="grid_12 paddingTop">
            	<div class="contentHead"><h3>Drive Team</h3></div>
                <article class="contentCont" style="width:916px;">
		<?php $TEMP_TEAM_ID = 10; for($i = 0; $i < count($cache); $i++) { if($count[$i][$TEMP_TEAM_ID] > 0) { ?>
                <div class="clubMember <?php if($count[$i][$TEMP_TEAM_ID] == 2) { echo "subTeamLeader"; } else if($count[$i][$TEMP_TEAM_ID] > 2) { echo "subTeamMentor"; } ?>">
                    <img src="phpThumb/phpThumb.php?src=../img/profilePics/<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>.jpg&amp;w=130&amp;h=130" alt="<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>"  width="130" height="130"/>
                    <h4><?php echo $msresult[$i][0]."<br />".$msresult[$i][1]; ?></h4>
                </div>
        <?php } } flush();?>
                </article>
            </div>

            <div class="grid_12 paddingTop">
            	<div class="contentHead"><h3>Fundraising Team</h3></div>
                <article class="contentCont" style="width:916px;">
		<?php $TEMP_TEAM_ID = 11; for($i = 0; $i < count($cache); $i++) { if($count[$i][$TEMP_TEAM_ID] > 0) { ?>
                <div class="clubMember <?php if($count[$i][$TEMP_TEAM_ID] == 2) { echo "subTeamLeader"; } else if($count[$i][$TEMP_TEAM_ID] > 2) { echo "subTeamMentor"; } ?>">
                    <img src="phpThumb/phpThumb.php?src=../img/profilePics/<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>.jpg&amp;w=130&amp;h=130" alt="<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>"  width="130" height="130"/>
                    <h4><?php echo $msresult[$i][0]."<br />".$msresult[$i][1]; ?></h4>
                </div>
        <?php } } flush();?>
                </article>
            </div>
            <div class="grid_12 paddingTop">
            	<div class="contentHead"><h3>Animation Team</h3></div>
                <article class="contentCont" style="width:916px;">
		<?php $TEMP_TEAM_ID = 12; for($i = 0; $i < count($cache); $i++) { if($count[$i][$TEMP_TEAM_ID] > 0) { ?>
                <div class="clubMember <?php if($count[$i][$TEMP_TEAM_ID] == 2) { echo "subTeamLeader"; } else if($count[$i][$TEMP_TEAM_ID] > 2) { echo "subTeamMentor"; } ?>">
                    <img src="phpThumb/phpThumb.php?src=../img/profilePics/<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>.jpg&amp;w=130&amp;h=130" alt="<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>"  width="130" height="130"/>
                    <h4><?php echo $msresult[$i][0]."<br />".$msresult[$i][1]; ?></h4>
                </div>
        <?php } } flush();?>
                </article>
            </div>
        </div>
        <div class="clear"></div>

<?php  include("../../inc/js.php"); ?>
<?php  include("../../inc/footer.php"); ?>