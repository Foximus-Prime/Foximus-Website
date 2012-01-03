<?php 

include("../inc/sessionNew.php");

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
<base href="../" />

<?php 
	include("../inc/header.php");
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
                <article class="contentCont"  id="topInfo" style="background:#FFF; color:#000; overflow: auto;">
                    <ul id="browser" class="filetree">
                        <li class="closed"><span class="folder">Home Page</span>
                            <ul>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=1','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">About Us</a></span></li>
                            </ul>
                        </li>
                        <li class="closed"><span class="folder">About Us</span>
                            <ul>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=1','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">Current Team</a></span></li>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=1','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">Students</a></span></li>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=1','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">Mentors</a></span></li>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=1','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">Website</a></span></li>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=1','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">History</a></span></li>
                            </ul>
                        </li>
                        <li class="closed"><span class="folder">First Info</span>
                            <ul>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=1','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">First Info</a></span></li>
                            </ul>
                        </li>
                        <li class="closed"><span class="folder">FRC</span>
                            <ul>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=1','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">2012 Game</a></span></li>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=1','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">Our Robot</a></span></li>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=1','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">Robot Archive</a></span></li>
                            </ul>
                        </li>
                        <li class="closed"><span class="folder">Forums</span>
                            <ul>
                                <li><span class="file">Edit via Forum Admin Panel</span></li>
                            </ul>
                        </li>
                        <li class="closed"><span class="folder">Media</span>
                            <ul>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=1','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">Photo Gallery</a></span></li>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=1','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">Video Archive</a></span></li>
                            </ul>
                        </li>
                        <li class="closed"><span class="folder">Resources</span>
                            <ul>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=1','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">Robot Help</a></span></li>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=1','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">Website Help</a></span></li>
                            </ul>
                        </li>
                        <li class="closed"><span class="folder">Contact</span>
                            <ul>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=1','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">Student Info / Signup</a></span></li>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=1','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">Mentor Info / Signup</a></span></li>
                                <li><span class="file"><a href="#" onClick="window.open('admin/adminprocess2.php?edit_content=1&contentID=1','', 'width=700, height=402, location=no, menubar=no, status=no,toolbar=no, scrollbars=no, resizable=yes'); return false">Sponsor Info / Signup</a></span></li>
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

                            

                            include("../inc/view_active.php");

                            ?>
                    </p>
                </article>
            </div>
        	<div class="grid_6">
            	<div class="contentHead">
                	<h3> Panel</h3>
                </div>
                <article class="contentCont"  id="topInfo">
                    <p>
                    </p>
                </article>
            </div>
        </div>
        <div class="clear"></div>
<?php } ?>
<?php  include("../inc/js.php"); ?>
			    <link type="text/css" rel="stylesheet" href="js/mylibs/treeview/jquery.treeview.css">
				<script type="text/javascript" src="js/mylibs/treeview/jquery.treeview.js"></script>
                <script type="text/javascript">$("#browser").treeview();</script>
<?php  include("../inc/footer.php"); ?>