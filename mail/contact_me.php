<?php
require("/sendgrid-php/sendgrid-php.php");
// Check for empty fields
if(empty($_GET['name'])  		||
   empty($_GET['email']) 		||
   empty($_GET['phone']) 		||
   empty($_GET['message'])	||
   !filter_var($_GET['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }

$name = $_GET['name'];
$email_address = $_GET['email'];
$phone = $_GET['phone'];
$message = $_GET['message'];
$callback = $_GET['callback'];

// Create the email and send the message
$to = 'championswimmer+tosc@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Website Contact Form:  $name";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
$headers = "From: noreply@tosc.in\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";
// mail($to,$email_subject,$email_body,$headers);
$sendgrid = new SendGrid('SENDGRID_API_KEY');
$email = new SendGrid\Email();
$email
    ->addTo($to)
    ->setFrom($email_address)
    ->setSubject($email_subject)
    ->setText($email_body)
;

$sendgrid->send($email);


return true;
?>
