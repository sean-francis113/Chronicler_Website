<?php
if(isset($_POST['email'])) {
 
    $email_to = "thechroniclerbot@gmail.com";
    $email_subject = "";
 
    function died($error) {
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    } 
 
    if(!isset($_POST['email']) ||
		!isset($_POST['category']) ||
		!isset($_POST['subject']) ||
        !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
 	$name = "";
	
    if(!isset($_POST['name']))
	{
	
		$name = "Anonymous";
		
	}
	else
	{
	
		$name = $_POST['name'];
		
	}
	
 	$email_from = $_POST['email'];
    $category = $_POST['category'];
    $subject = $_POST['subject'];
	$message = $_POST['message'];
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
	if(!preg_match($email_exp,$email_from)) {
	  $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
	}
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
    if(strlen($message) < 2) {
      $error_message .= 'The Message was not valid<br />';
    }
 
    if(strlen($error_message) > 0) {
      died($error_message);
    } 	
	
	$email_subject = "[".$category."] ".$subject;
    $email_message = "Form details below.\n\n";
 
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
    $email_message .= "Name: ".clean_string($name)."\n";
	$email_message .= "Email: ".clean_string($email_from)."\n";
	$email_message .= "Subject: ".clean_string($subject)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";
 
	// create email headers
	$headers = 'From: '.$email_from."\r\n".
	'Reply-To: '.$email_from."\r\n" .
	'X-Mailer: PHP/' . phpversion();
	mail($email_to, $email_subject, $email_message, $headers);  

	date_default_timezone_set('UCT');
    
    include("connect.php");

    include("pages/header.php");
    include("pages/sidebar.php");
	include("pages/settings_bar.php");
?>

<div id="main_content" class="dfs">
	<h1 id="page_title">Thank You</h1>
	<p>Your message has been sent to our email and will be looked at as soon as possible!</p>
	<p>We would like to say that even if we never directly contact you, please know that we look at every comment, suggestion and issue we possibly can. Like you, we want to make The Chronicler the best it possibly can, and that can only happen with this kind of communication. Your help is appreciated.</p>
</div>

<?php
    include("pages/footer.php");
	include("scripts/dynamic_adjust.php");
	include("scripts/cookies.php");
	include("scripts/alter_page.php");
	include("scripts/final_checks.php");
	
	mysqli_close($conn);
}
?>