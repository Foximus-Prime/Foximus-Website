<?php
	$directory = '../gallery/plog-content/images/build/2011-12/';
	$scanned_directory = array_diff(scandir($directory), array('..', '.'));
 	foreach($scanned_directory as $img) {
		echo '<img src="http://robotics.cyberdenton.com/thumbtest/616x320/gallery/plog-content/images/build/2011-12/'.$img.'" />';
	}
?>