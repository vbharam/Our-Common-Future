<?php
function sendmail($to,$subject,$body)
{
	require_once('class.phpmailer.php');
	date_default_timezone_set('Asia/Kolkata');
	$mail= new PHPMailer();

	// telling the class to use SMTP
	$mail->IsSMTP(); 

	// SMTP server
	$mail->Host = "relay-hosting.secureserver.net"; 

	// enable SMTP authentication
	$mail->SMTPAuth   = true;      

	// sets the SMTP server 
	$mail->Host       = "relay-hosting.secureserver.net";  

	// sets SMTP port
	$mail->Port = 25;

	// SMTP account username   
	$mail->Username   = "contact@weblessons.info";

	// SMTP account password   
	$mail->Password   = ""; 
	    
	$mail->SetFrom("contact@weblessons.info", "Web Lessons");
	$mail->AddReplyTo("contact@weblessons.info","Web Lessons");
	$mail->Subject    = $subject;
	$mail->MsgHTML($body);

	// To address
	$mail->AddAddress($to);

	if(!$mail->Send()) {
		echo "Oops!! Something went wrong";
	} else {
		echo "Email sent";
	}
	
}

$to = $_POST['to_email'];
$subject = $_POST['subject'];
$body = $_POST['body'];
sendmail($to,$subject,$body);
	
?>