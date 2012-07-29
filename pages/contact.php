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
		$emailTo = 'THosey@y115.org'; //Put your own email address here
		$body = "Name: $name \n\nEmail: '$email' \n\nSubject: Foximus-Prime('$subject') \n\nComments:\n '$comments'";
		$headers = 'From: Foximus-Prime <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}
}


include_once("../inc/sessionNew.php");
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
  <base href=<?php echo("\"".BASE_ADRS."\"") ?> />
  <?php
  include_once("../inc/header.php");
  ?>
  <style type="text/css">
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
    <div class="container_12">
            <div class="grid_12">
               <div class="contentHead"><h3>Contact</h3></div>
               <div class="contentCont">
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
                </div>
            </div>
            </div>
            <div class="clear"></div>

<?php  include_once("../inc/js.php"); ?>
	<script src="js/mylibs/validation/jquery.validate.js" type="text/javascript"></script>
    
    <script type="text/javascript">
    $(document).ready(function(){
        $("#contactform").validate();
        //$("#click").click();
    });
    </script>
<?php  include_once("../inc/footer.php"); ?>
