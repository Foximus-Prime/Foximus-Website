<?php
	$uri = $_GET['uri'];
	$im = file_get_contents('http://www.linux.org/images/logo/linuxorg.gif'); 
	header('content-type: image/jpg'); 
	echo $im;
?>