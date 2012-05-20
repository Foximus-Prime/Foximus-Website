<?php 

include_once("../inc/sessionNew.php");

/**
 * User not an administrator, redirect to main page
 * automatically.
**/

if(!$session->isAdmin()){
   header("Location: ../index.php");
}else{
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
<base href="http://robotics.cyberdenton.com/" />

<?php 
	include_once("../inc/header.php");
?>

		<div class="container_12" style="padding-top: 20px;">
        	<div class="grid_6">
            	<div class="contentHead">
                	<h3>User Panel</h3>
                </div>
                <article class="contentCont"  id="topInfo">
                        <form style="display:inline;" onClick="window.open('admin/adminprocess2.php?list_users=1','', 'width=550, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">
                        	<input style="display:none;" type="text" value="1" />
                            <input type="image" src="img/icons/list_users.png" style="width:101px; height:103px;" alt="List Users" value="List Users" />
                        </form>
                        <form style="display:inline;" onClick="window.open('admin/adminprocess2.php?delete_user=1','', 'width=550, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">
                        	<input style="display:none;" type="text" value="1" />
                            <input type="image" src="img/icons/remove_user.png" style="width:101px; height:103px;" alt="List Users" value="List Users" />
                        </form>
                        <form style="display:inline;" onClick="window.open('admin/adminprocess2.php?list_banned_users=1','', 'width=550, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">
                        	<input style="display:none;" type="text" value="1" />
                            <input type="image" src="img/icons/list_banned_users.png" style="width:101px; height:103px;" alt="List Users" value="List Users" />
                        </form>
                        <form style="display:inline;" onClick="window.open('admin/adminprocess2.php?add_user=1','', 'width=550, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">
                         <input style="display:none;" type="text" value="1" />
                        	<input type="image" src="img/icons/add_user.png" style="width:101px; height:103px;" alt="List Users" value="List Users" />
                        </form>
                        <form style="display:inline;" onClick="window.open('admin/adminprocess2.php?ban_user=1','', 'width=550, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">
                       	  <input style="display:none;" type="text" value="1" />
                            <input type="image" src="img/icons/ban_user.png" style="width:101px; height:103px;" alt="List Users" value="List Users" />
                        </form>
                        <form style="display:inline;" onClick="window.open('admin/adminprocess2.php?update_user_level=1','', 'width=550, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">
                        	<input style="display:none;" type="text" value="1" />
                            <input type="image" src="img/icons/change_user_permisions.png" style="width:101px; height:103px;" alt="List Users" value="List Users" />
                        </form>
              </article>
            </div>
        	<div class="grid_6">
            	<div class="contentHead">
                	<h3>Content Panel</h3>
                </div>
                <article class="contentCont treeCont" id="topInfo" style="background:#FFF; color:#000; overflow: auto;">
                    <ul id="browser" class="filetree">
                        <li class="closed"><span class="folder">Home Page</span>
                            <ul>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=1','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">About Us</a></span></li>
                            </ul>
                        </li>
                        <li class="closed"><span class="folder">About Us</span>
                            <ul>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=18','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">Website</a></span></li>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=19','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">Website Sidebar</a></span></li>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=16','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">History</a></span></li>                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=17','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">History Sidebar</a></span></li>
                            </ul>
                        </li>
                        <li class="closed"><span class="folder">US First Info</span>
                            <ul>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=20','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">First Info</a></span></li>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=21','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">First Info Sidebar</a></span></li>                            </ul>
                        </li>
                        <li class="closed"><span class="folder">FRC</span>
                            <ul>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=6','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">2012 Game</a></span></li>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=7','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">2012 Game Sidebar</a></span></li>                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=10','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">Our Robot</a></span></li>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=11','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">Our Robot Sidebar</a></span></li>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=12','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">Robot Archive</a></span></li>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=13','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">Robot Archive Sidebar</a></span></li>
                            </ul>
                        </li>
                        <li class="closed"><span class="folder">Forums</span>
                            <ul>
                                <li><span class="file">Edit via Forum Admin Panel</span></li>
                            </ul>
                        </li>
                        <li class="closed"><span class="folder">Media</span>
                            <ul>
                                <li><span class="file"><a href="#" onClick="window.open('http://robotics.cyberdenton.com/gallery/plog-admin/','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">Photo Gallery</a></span></li>
                                <li><span class="file">Edit video archive by adding or deleting videos in the "Web" playlist.</span></li>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=26','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">Resources</a></span></li>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=27','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">Resources Sidebar</a></span></li>
                            </ul>
                        </li>
                        <li class="closed"><span class="folder">Contact</span>
                            <ul>
                                <li><span class="file">Email must be edited from within the contact file.</span></li>
                            </ul>
                        </li>
                    </ul>
                </article>
            </div>
        </div>
        <div class="clear"></div>
		<div class="container_12" style="padding-top: 20px;">
        	<div class="grid_6">
            	<div class="contentHead">
                	<h3>Statistics Panel</h3>
                </div>
                <article class="contentCont"  id="topInfo">
                    <p>
                    		<?php

                            echo "</td></tr><tr><td align=\"center\"><br><br>";

                            echo "<b>Member Total:</b> ".$database->getNumMembers()."<br>";

                            echo "There are $database->num_active_users registered members and ";

                            echo "$database->num_active_guests guests viewing the site.<br><br>";

                            

                            include_once("../inc/view_active.php");

                            ?>
                    </p>
                </article>
            </div>
        	<div class="grid_6">
            	<div class="contentHead">
                	<h3>Current Team Panel</h3>
                </div>
                <article class="contentCont"  id="topInfo">
                        <form style="display:inline;" onClick="window.open('admin/adminprocess2.php?edit_roster=1','', 'width=800, height=800, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">
                        	<input style="display:none;" type="text" value="1" />
                            <input type="image" src="img/icons/change_user_permisions.png" style="width:101px; height:103px;" alt="List Users" value="List Users" />
                        </form>
                        <form style="display:inline;" onClick="window.open('admin/userPics/doUserPics.php','', 'width=800, height=800, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">
                        	<input style="display:none;" type="text" value="1" />
                            <input type="image" src="img/icons/list_users.png" style="width:101px; height:103px;" alt="List Users" value="List Users" />
                        </form>
                </article>
            </div>
        </div>
        <div class="clear"></div>
<?php } ?>
<?php  include_once("../inc/js.php"); ?>
			    <link type="text/css" rel="stylesheet" href="js/mylibs/treeview/jquery.treeview.css">
                <link type="text/css" rel="stylesheet" href="admin/admin.css">
				<script type="text/javascript" src="js/mylibs/treeview/jquery.treeview.js"></script>
                <script type="text/javascript">$("#browser").treeview();</script>
<?php  include_once("../inc/footer.php"); ?>