<?php
include("../../inc/sessionNew.php");

/**
 * User not an administrator, redirect to main page
 * automatically.
**/

if(!$session->isAdmin()){
   header("Location: ../index.php");
} else {
	if(isset($_POST['x'])){
		$targ_w = $targ_h = 130;
		$jpeg_quality = 90;
		
		$src = $_POST['src'];
		$img_r = imagecreatefromjpeg($src);
		$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
		imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
			$targ_w,$targ_h,$_POST['w'],$_POST['h']);
		
		if(isset($_POST['rotate']))
			$dst_r = imagerotate($dst_r, -90, 0);
			
		imagejpeg($dst_r, '../../img/profilePics/'.strtolower($_POST['fname'].$_POST['lname']).'.jpg', $jpeg_quality);
		echo 'Completed image for '.$_POST['fname'].' '.$_POST['lname'].'.<br />';
		echo "<meta HTTP-EQUIV=\"refresh\" CONTENT=\"2; URL=http://themrmiller.com/austin/admin/userPics/doUserPics.php\">";
		echo "Redirect in 2...";
		
	} else {
		$src;
		$subSRC = $_POST['image'];
		if(strstr($subSRC,'plog-content/images/'))
			$src = $subSRC;
		else {
			$src = 'http://themrmiller.com/austin/gallery/plog-content/images/'.rstrstr($subSRC,'build/');
			$src = substr($src,0,strlen($src)-1).'.jpg';
		}
		
		echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script src="../../js/mylibs/jcrop/js/jquery.Jcrop.js"></script>
		<link rel="stylesheet" href="../../js/mylibs/jcrop/css/jquery.Jcrop.css" type="text/css" />
		<script language="javascript">';

		echo "$(function(){
				$('#cropbox').Jcrop({
					aspectRatio: 1,
					setSelect: [130, 130, 130, 130],
					onSelect: updateCoords
				});
			});

			function updateCoords(c)
			{
				$('#x').val(c.x);
				$('#y').val(c.y);
				$('#w').val(c.w);
				$('#h').val(c.h);
			};

			function checkCoords()
			{
				if (parseInt($('#w').val())) return true;
				alert('Please select a crop region then press submit.');
				return false;
			};
		</script>".'<img src="'.$src.'" id="cropbox" />
		<form action="adminUsersCrop.php" method="post" onsubmit="return checkCoords();">
			<input type="hidden" id="x" name="x" />
			<input type="hidden" id="y" name="y" />
			<input type="hidden" id="w" name="w" />
			<input type="hidden" id="h" name="h" />	
			<input type="hidden" id="src" name="src" value = "'.$src.'" />';
			if(isset($_POST['rotate'])) echo '<input type="hidden" id="rotate" name="rotate" value="90" />';
			echo '<input type="hidden" id="fname" name="fname" value = "'.$_POST['fname'].'" />
			<input type="hidden" id="lname" name="lname" value = "'.$_POST['lname'].'" />
			<input type="submit" value="Crop Image" />
		</form>';
		if(!isset($_POST['rotate'])){
			echo'
		<form action="adminUsersCrop.php" method="post">
			<input type="hidden" id="rotate" name="rotate" value="90" />
			<input type="hidden" id="image" name="image" value = "'.$subSRC.'" />
			<input type="hidden" id="fname" name="fname" value = "'.$_POST['fname'].'" />
			<input type="hidden" id="lname" name="lname" value = "'.$_POST['lname'].'" />
			<input type="submit" value="Rotate Image" />
		</form>';
		}
	}
}

function rstrstr($haystack,$needle)
{
	return substr($haystack, strpos($haystack, $needle));
}
?>