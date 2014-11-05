<?php
	$owner_email = $_POST["owner_email"];
	$headers .= 'From: uwcnext@gmail.com' . "\r\n" . 'Reply-To:'.$_POST['email'];
	// $headers = 'From:' . 'uwcnext@gmail.com';
	$subject = 'A message from your site visitor ' . $_POST["name"];
	$messageBody = "";
	
	if($_POST['name']!='nope'){
		$messageBody .= '<p>Visitor: ' . $_POST["name"] . '</p>' . "\n";
		$messageBody .= '<br>' . "\n";
	}
	if($_POST['email']!='nope'){
		$messageBody .= '<p>Email Address: ' . $_POST['email'] . '</p>' . "\n";
		$messageBody .= '<br>' . "\n";
	}else{
		$headers = '';
	}
	if($_POST['state']!='nope'){		
		$messageBody .= '<p>State: ' . $_POST['state'] . '</p>' . "\n";
		$messageBody .= '<br>' . "\n";
	}
	if($_POST['phone']!='nope'){		
		$messageBody .= '<p>Phone Number: ' . $_POST['phone'] . '</p>' . "\n";
		$messageBody .= '<br>' . "\n";
	}	
	if($_POST['fax']!='nope'){		
		$messageBody .= '<p>Fax Number: ' . $_POST['fax'] . '</p>' . "\n";
		$messageBody .= '<br>' . "\n";
	}
	if($_POST['message']!='nope'){
		$messageBody .= '<p>Message: ' . $_POST['message'] . '</p>' . "\n";
	}
	
	if($_POST["stripHTML"] == 'true'){
		$messageBody = strip_tags($messageBody);
	}
	
	try{
		if(!mail($owner_email, $subject, $messageBody, $headers)){
		// if (!sendmail($owner_email,$subject,$messageBody)){
			throw new Exception('mail failed');		
		}else{
			echo 'mail sent';
		}
	}catch(Exception $e){
		echo $e->getMessage() ."\n";
	}

function sendmail($to,$subject,$body){
	require_once('.../mailer/class.phpmailer.php');
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

	$messageBody .= '<p>Visitor Email Address: ' . $to . '</p>' . "\n";
	$messageBody .= '<br>' . "\n";
	$messageBody .= '<p>Message: ' . $body . '</p>' . "\n";
 
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


?>