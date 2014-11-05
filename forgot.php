<?php 

error_reporting(0);
$passwordResetEmail=$_POST['email'];
if($_POST['submit']=='Send') {
	include 'includes/Bluehost_connect.php'; 

  if ($passwordResetEmail !=""){
		$fetchId = "SELECT `PASSWORD` FROM  `USER_INFO` WHERE `EMAIL`= '$passwordResetEmail'";
		$fetchIdresult = mysql_query($fetchId,$connection);
		if (!$fetchIdresult) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $fetchId;
		    die($message);
		}
		if ($subject = mysql_fetch_assoc( $fetchIdresult)){ 
			$getThePassword = "SELECT * FROM  `USER_INFO` WHERE `EMAIL`= '$passwordResetEmail'";
			$getThePasswordResult = mysql_query($getThePassword,$connection);
			if (!$getThePasswordResult) { 
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $getThePassword;
			    die($message);
			}
			while ($subject = mysql_fetch_assoc( $getThePasswordResult)){ 
				$password = ($subject['PASSWORD']);
				$social_media = ($subject['SOCIAL_MEDIA_TYPE']);
				if ($password !="" || $password != null){
					$message="Password for your Our Common Future account '".$password."'<br><br> Thanks! <br> OCF Team";
					sendmail($passwordResetEmail,"OCF Password Help! ",$message);
				}else{
					echo "This email is associated with a ". $social_media . " account. Please use ". $social_media ." to log in. <br> <br>";
				}
			}					
		} else {
			echo "No user exist with this email id";
		}
	}
}

function sendmail($to,$subject,$message){
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
	$mail->MsgHTML($message);

	// To address
	$mail->AddAddress($to);

	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		echo $error;

	} else {
		echo '<script type="text/javascript">';
		echo 'alert("Please check your email. Your password has been sent to you.");';
		echo('window.close();');
		echo '</script>';			
	}
}

	mysql_free_result($fetchIdresult);
?>

<?php 	mysql_close($connection); ?>

<form action="forgot.php" method="post">
	Please enter your email ID: <input type="email" id="email" name="email">
	<input type="submit" name="submit" value="Send">
</form>