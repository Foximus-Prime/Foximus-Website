<?php
//If the form is submitted
if(isset($_POST['submit'])) {

	//Check to make sure that the name field is not empty
	if(trim($_POST['contactname']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['contactname']);
	}

	//Check to make sure that the subject field is not empty
	if(trim($_POST['subject']) == '') {
		$hasError = true;
	} else {
		$subject = trim($_POST['subject']);
	}

	//Check to make sure sure that a valid email address is submitted
	if(trim($_POST['email']) == '')  {
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	//Check to make sure comments were entered
	if(trim($_POST['message']) == '') {
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['message']));
		} else {
			$comments = trim($_POST['message']);
		}
	}

	//If there is no error, send the email
	if(!isset($hasError)) {
		$emailTo = 'submit@yorkvillerobotics.com'; //Put your own email address here
		$body = "Name: $name \n\nEmail: $email \n\nSubject: $subject \n\nComments:\n $comments";
		$headers = 'From: Foximus <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}
}
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
  <style type="text/css">
	body {
		font-family:Arial, Tahoma, sans-serif;
	}
	#contact-wrapper {
		width:430px;
		border:1px solid #e2e2e2;
		background:#f1f1f1;
		padding:20px;
		position:relative;
		margin-left:auto;
		color:#000;
		margin-right:auto;
		padding: 10px;
	}
	#contact-wrapper div {
		clear:both;
		margin:1em 0;
	}
	#contact-wrapper label {
		display:block;
		float:none;
		font-size:16px;
		width:auto;
	}
	form#contactform input {
		border-color:#B7B7B7 #E8E8E8 #E8E8E8 #B7B7B7;
		border-style:solid;
		border-width:1px;
		padding:5px;
		font-size:16px;
		color:#333;
	}
	form#contactform textarea {
		font-family:Arial, Tahoma, Helvetica, sans-serif;
		font-size:100%;
		padding:0.6em 0.5em 0.7em;
		border-color:#B7B7B7 #E8E8E8 #E8E8E8 #B7B7B7;
		border-style:solid;
		border-width:1px;
	}
	</style>
	<script src="jquery.validate.pack.js" type="text/javascript"></script>
    
    <script type="text/javascript">
    $(document).ready(function(){
        $("#contactform").validate();
        //$("#click").click();
    });
    </script>
  
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

       <a class="logo"></a>
    </header>
    <div id="main" class="layout-978" role="main">
        <div class="row">
        	<div class="col12" id="topInfo">
            	<div class="contentHead">
                	<h3>Contact Us</h3>
                </div>
                <article class="contentCont" style="height:auto;">
                    <p>
                    	<div id="contact-wrapper">
                            <?php if(isset($hasError)) { //If errors are found ?>
                                <p class="error">Please check if you've filled all the fields with valid information. Thank you.</p>
                            <?php } ?>
                        
                            <?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
                                <p><strong>Email Successfully Sent!</strong></p>
                                <p>Thank you <strong><?php echo $name;?></strong> for using my contact form! Your email was successfully sent and I will be in touch with you soon.<br />Redirecting.....</p>
								<script type="text/javascript">
								<!--
								window.location = "http://yorkvillerobotics.com/"
								//-->
                                </script>
                            <?php } ?>
                        
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="contactform">
                                <div>
                                    <label for="name"><strong>Name:</strong></label>
                                    <input type="text" size="50" name="contactname" id="contactname" value="" class="required" />
                                </div>
                        
                                <div>
                                    <label for="email"><strong>Email:</strong></label>
                                    <input type="text" size="50" name="email" id="email" value="" class="required email" />
                                </div>
                        
                                <div>
                                    <label for="subject"><strong>Interested in being a Member or a Sponsor:</strong></label>
                                    <input type="text" size="50" name="subject" id="subject" value="" class="required" />
                                </div>
                        
                                <div>
                                    <label for="message"><strong>Other Info / About you:</strong></label>
                                    <textarea rows="5" cols="50" name="message" id="message" class="required"></textarea>
                                </div>
                                <input type="submit" id="#click" value="Send Message" name="submit" />
                            </form>
                        </div>
                    </p>
                </article>
            </div>
<?php include_once("inc/footer.php"); ?>