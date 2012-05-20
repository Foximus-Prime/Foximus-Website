<a href="http://usfirst.org/"><div id="LeftSide"></div></a>
  <div id="container">
    <header>
    	<div class="grill" id="topGrill">
            <div id="menuL"></div>
            <div id="menuR"></div>
            <div id="menuCont">
                <ul id="mainMenuL" class="topnav">
                    <li><a href="http://robotics.cyberdenton.com">Home</a></li>
                    <li>
                        <a href="#">About Us</a>
                        <ul class="subnav">
                            <li><a href="http://robotics.cyberdenton.com/pages/about/current.php">Current Team</a></li>
                            <li><a href="http://robotics.cyberdenton.com/pages/about/sponsors.php">Sponsors</a></li>
                            <li><a href="http://robotics.cyberdenton.com/pages/about/website.php">Website</a></li>
                            <li><a href="http://robotics.cyberdenton.com/pages/about/history.php">History</a></li>
                        </ul>
                    </li>
                    <li><a href="http://robotics.cyberdenton.com/pages/first.php">US FIRST Info</a></li>
                    <li>
                        <a href="#">FRC</a>
                        <ul class="subnav">
                            <li><a href="http://robotics.cyberdenton.com/pages/frc/game.php">2012 Game</a></li>
                            <li><a href="http://robotics.cyberdenton.com/pages/frc/robot.php">Our Robot</a></li>
                        </ul>
                    </li>
                </ul>
                <ul id="mainMenuR" class="topnav">
                    <li><a href="forums/">Forums</a></li>
                    <li>
                        <a href="#">Media</a>
                        <ul class="subnav">
                            <li><a href="http://robotics.cyberdenton.com/gallery/">Photo Gallery</a></li>
                            <li><a href="http://www.youtube.com/user/FoximusPrime3695?feature=mhee">Video Archive</a></li>
                            <li><a href="http://robotics.cyberdenton.com/pages/media/resources.php">Resources</a></li>
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
        <div style="background:#FFF">

<?php include('theme_functions.php'); ?>
<!--Output highest level container division-->
<div id="plog-wrapper">
	<table id="header-table">
		<tr>
			<td><?php echo generate_header(); ?></td>
			<td id="jump-search-container">
				<?php echo generate_jump_menu(); ?>
				<br />
				<?php echo generate_search_box(); ?>
			</td>
		</tr>
	</table><!-- /header-table -->
<?php echo plogger_download_selected_form_start(); ?>

	<div id="main-container">
		<div id="breadcrumbs">
			<table id="breadcrumb-table">
				<tr>
					<td><?php echo generate_breadcrumb(); ?></td>
					<td class="align-right"><?php echo plogger_download_selected_button(); ?><?php echo plogger_print_button(); ?></td>
				</tr>
			</table><!-- /breadcrumb-table -->
		</div><!-- /breadcrumbs -->
