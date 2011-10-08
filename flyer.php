<?php 
include("inc/sessionNew.php");
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

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Foximus-Prime</title>
  <meta name="description" content="">
  <link type="text/plain" rel="author" href="http://domain/humans.txt" />

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Place favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/Foximus/favicon.ico">
  <link rel="apple-touch-icon" href="/Foximus/apple-touch-icon.png">


  <!-- CSS: implied media="all" -->
  <link type="text/css" rel="stylesheet" href="css/style.css?v=3">
  <link type="text/css" rel="stylesheet" href="css/978.css">
  
  	<!-- Aviva Screen CSS -->
	<link rel="stylesheet" href="css/aviaslider/style.css" type="text/css" media="screen" />
	<!-- Aviva lightbox CSS -->
	<link rel="stylesheet" href="js/aviaslider/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen" />	

  <!-- Uncomment if you are specifically targeting less enabled mobile browsers
  <link rel="stylesheet" media="handheld" href="css/handheld.css?v=2">  -->

  <!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
  <script src="js/libs/modernizr-1.7.min.js"></script>
  
  <!--[if IE]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->


</head>

<body>
<a href="http://usfirst.org/"><div id="LeftSide"></div></a>
  <div id="container">
    <header>
    	<div class="grill" id="topGrill">
            <div id="menuL"></div>
            <div id="menuR"></div>
            <div id="menuCont">
                <ul id="mainMenuR">
                    <li><a style="z-index:1;" href="simpleContact.php">Want to join or sponsor us? Click Here!</a></li>
                </ul>
           </div>
        </div>

       <div class="logo"></div>
    </header>
    <div id="main" class="layout-978" role="main">
        <div class="row">
        	<div class="col4" id="topInfo">
            	<div class="contentHead">
                	<h3>About Us</h3>
                </div>
                <article class="contentCont" style="height:273px;">
                    <p></p>
                </article>
            </div>
            <div class="col8">
               <div class="contentHead"></div>
               <div class="contentCont" style="padding:0;">
                   <div class="aviaslider" id="custom-fade-slider">
                        <div class="featured">
                            <a href="img/pics/DSCF1058.jpg">
                                <img title="The Lift!" alt="The Lift! :: Left to right: Garrett Knox, Nick, Amy Hosey, Maria, Travis Center: Elia" src="phpThumb/phpThumb.php?src=../img/pics/DSCF1058.jpg&w=638&h=320&zc=1&fltr[]=wmi|pics/fox.png|BR" />
                            </a>
                        </div>
                        <div class="featured">
                            <a href="img/pics/DSCN2761.jpg">
                                <img title="Just Chillin'" alt="Just Chillin' :: Left to right: Austin Hampton, Elia, Garrett Knox" src="phpThumb/phpThumb.php?src=../img/pics/DSCN2761.jpg&w=638&h=320&zc=1&fltr[]=wmi|pics/fox.png|BR" />
                            </a>
                        </div>
                        <div class="featured">
                            <a href="img/pics/DSCN2894.jpg">
                                <img title="Sparks a Flyin'" alt="Sparks a Flyin' :: Left to right: Garrett Knox, Elia, Tracey Hosey" src="phpThumb/phpThumb.php?src=../img/pics/DSCN2894.jpg&w=638&h=320&zc=1&fltr[]=wmi|pics/fox.png|BR" />
                            </a>
                        </div>
                        <div class="featured">
                            <a href="img/pics/DSCN2865.jpg">
                                <img title="Just Tinkering" alt="Just Tinkering :: Left to right: Nick, Austin Hampton, Jordan, Garrett Knox" src="phpThumb/phpThumb.php?src=../img/pics/DSCN2865.jpg&w=638&h=320&zc=1&fltr[]=wmi|pics/fox.png|BR" />
                            </a>
                        </div>
                        <div class="featured">
                            <a href="img/pics/Robot%20Before%20Ship.jpg">
                                <img title="The Beast!" alt="The Beast! :: Trial run before shipping" src="phpThumb/phpThumb.php?src=../img/pics/Robot%20Before%20Ship.jpg&w=638&h=320&zc=1&fltr[]=wmi|pics/fox.png|BR" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
<?php  include("inc/footer.php"); ?>