<?php include_once("constants.php"); ?>
  <meta name="description" content="">
  <link type="text/plain" rel="author" href="http://yorkvillerobotics.com/humans.txt" />

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSS: implied media="all" -->
  <link type="text/css" rel="stylesheet" href="css/style.css?v=3">
  <link type="text/css" rel="stylesheet" href="css/960.css">
  
  <!--[if !IE 7]>
	<style type="text/css">
		#container {display:table;height:100%}
	</style>
  <![endif]-->
  
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
  <?php if(BANNER){ ?>
  	<div id="soupPromo" class="banner">
    	<a href="pages/promo/soup.php"><img src="img/soup-banner.png" class="centerH" alt="Soup-a-palooza" /></a>
    </div>
    <?php } ?>
<a href="http://usfirst.org/"><div id="LeftSide"></div></a>
  <div id="container">
    <header>
    	<div class="grill" id="topGrill">
            <div id="menuL"></div>
            <div id="menuR"></div>
            <div id="menuCont">
                <ul id="mainMenuL" class="topnav">
                    <li><a href="index.php">Home</a></li>
                    <li>
                        <a href="#">About Us</a>
                        <ul class="subnav">
                            <li><a href="pages/about/current.php">Current Team</a></li>
                            <li><a href="pages/about/sponsors.php">Sponsors</a></li>
                            <li><a href="pages/about/website.php">Website</a></li>
                            <li><a href="pages/about/history.php">History</a></li>
                        </ul>
                    </li>
                    <li><a href="pages/first.php">US FIRST Info</a></li>
                    <li>
                        <a href="#">FRC</a>
                        <ul class="subnav">
                            <li><a href="pages/frc/game.php">2012 Game</a></li>
                            <li><a href="pages/frc/robot.php">Our Robot</a></li>
                            <!--<li><a href="pages/frc/archive.php">Robot Archive</a></li>-->
                        </ul>
                    </li>
                </ul>
                <ul id="mainMenuR" class="topnav">
                    <li><a href="forums/">Forums</a></li>
                    <li>
                        <a href="#">Media</a>
                        <ul class="subnav">
                            <li><a href="gallery/">Photo Gallery</a></li>
                            <li><a href="http://www.youtube.com/user/FoximusPrime3695?feature=mhee">Video Archive</a></li>
                            <li><a href="pages/media/resources.php">Resources</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Resources</a>
                        <ul class="subnav">
                            <li><a href="http://www.chiefdelphi.com/forums/index.php?">Robot Help</a></li>
                            <li><a href="http://www.w3schools.com/">Website Help</a></li>
                        </ul>
                    </li>
                    <li><a href="http://robotics.cyberdenton.com/pages/contact.php">Contact</a></li>
                </ul>
           </div>
        </div>

       <a class="logo" href="#"></a>
    </header>
<?php flush(); ?>
    <div id="main" class="container_12" role="main">
    	<div id="gs-overlay">&nbsp;</div>
