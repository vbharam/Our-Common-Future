<?php




function sendmail($from,$to,$subject,$body,$username)
{


$email=$to;
$len=strlen($email);
if($len<65)
{
error_reporting(E_STRICT);
date_default_timezone_set('Asia/Kolkata');
require_once('class.phpmailer.php');
$mail= new PHPMailer();

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "relay-hosting.secureserver.net"; // SMTP server
//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "relay-hosting.secureserver.net"; // sets the SMTP server                  // set the SMTP port for the GMAIL server
$mail->Username   = "info@happyshoppie.in"; // SMTP account username
    // SMTP account password

$mail->SetFrom('info@happyshoppie.in', 'HappyShoppie');

$mail->AddReplyTo("info@happyshoppie.in","HappyShoppie");

$mail->Subject    = $subject;
$mail->MsgHTML($body);
$address = $email;
$mail->AddAddress($address, $address);
if(!$mail->Send()) {

} else {
 
}
}
}


	
?>