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

	$rs = $database->query("SELECT `First_Name`, `Last_Name`, `Team` FROM `user` WHERE `Team` > 0");
?>
        <div class="container_12">
        
        <?php
			$msresult = array();
			$cache = array();
			for($i = 0; $i < mysql_num_rows($rs); $i++) {
				$q = 0;
				$msresult[$i] = mysql_fetch_array($rs, MYSQL_NUM);
				while(intval(substr((string)$msresult[$i][2],$q,$q+1)) != 0) {
					$cache[$i][$q] = intval(substr((string)$msresult[$i][2],$q,$q+1));
					$q++;
				}
			}
		?>
        
        
        
        
        
            <div class="grid_12">
            	<div class="contentHead"><h3>Programming Team</h3></div>
                <article class="contentCont" style="width:916px;">
                <?php 
				/*echo $msresult[0][0]." ".$msresult[0][1]." is on Team #".$msresult[0][2];
				echo substr((string)$msresult[0][2],0,1);
				echo intval(substr((string)$msresult[0][2],0,1));
				echo $cache[0][0];*/
				?>
		<?php	
			$last = count($arr_nav) - 1;

			foreach ($cache as $i => $row)
			{
				$isFirst = ($i == 0);
				$isLast = ($i == $last);
				$count = 0;
				for($g = 0; $g < count($cache[$i]); $g++) {
					if($cache[$i][$g] == 1) {
						$count++;
					}
				}
				if($count > 0) {
		?>
                <div class="clubMember <?php if($count == 2) { echo "subTeamLeader"; } else if($count > 2) { echo "subTeamMentor"; } ?>">
                    <img src="phpThumb/phpThumb.php?src=../img/profilePics/<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>.jpg&amp;w=130&amp;h=130" alt="<?php echo $msresult[$i][0]." ".$msresult[$i][1]; ?>"  width="130" height="130"/>
                    <h4><?php echo $msresult[$i][0]."<br />".$msresult[$i][1]; ?></h4>
                </div>
        <?php
				}
			}
		?>
                </article>
            </div>
            
            





        </div>
        <div class="clear"></div>

<?php  include("../../inc/js.php"); ?>
<?php  include("../../inc/footer.php"); ?>