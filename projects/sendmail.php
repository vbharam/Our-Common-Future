<?php
function sendmail($to,$subject,$messageBody){
	require_once('mailer/class.phpmailer.php');
	date_default_timezone_set('Asia/Kolkata');
	$mail= new PHPMailer();

	// telling the class to use SMTP
	$mail->IsSMTP(); 
	
	// enable SMTP authentication
	$mail->SMTPAuth   = true;      

    // sets SMTP server
    $mail->Host = "email-smtp.us-west-2.amazonaws.com";  

	// sets SMTP port
	$mail->Port = 465;

    // SMTP account username   
    $mail->Username   = "AKIAIQWFHLQSW7AJNTKQ";

 
    // SMTP account password   
    $mail->Password   = "AuSa1wrmmKbjsqf3A3TqbnUmchBq9sLrzX2MLZu+9y3Y"; 
	$mail->SMTPSecure = "ssl";
    $mail->SetFrom("uwcnext@gmail.com", "UWC Next");
    $mail->AddReplyTo("uwcnext@gmail.com","UWC Next");
	$mail->Subject    = $subject;
	$mail->MsgHTML($messageBody);

	// To address
	$mail->AddAddress($to);

	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		echo $error;

	} else {
		echo "Email sent";
	}	
}

$to = $_POST['to_email'];
$from = $_POST['visitorEmail'];
$name = $_POST['visitorName'];
$subject = $_POST['subject'];
$body = $_POST['initiatorMessage'];
$messageBody = '<p>Visitor Name: ' . $name . '</p>' . "\n";
$messageBody .= '<p>Visitor Email Address: ' . $from . '</p>' . "\n";
$messageBody .= '<br>' . "\n";
$messageBody .= '<p>Message: ' . $body . '</p>' . "\n";

sendmail($to,$subject,$messageBody);
	
?>