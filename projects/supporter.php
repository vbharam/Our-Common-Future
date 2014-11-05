<?php include 'includes/Bluehost_connect.php'; ?>

<?php 	
	// Storing the received information from INITIATIVE-DESCRIPTION
	$projectId = addslashes($_POST['id']); 	
	$project = addslashes($_POST['project']); 	
	$name = addslashes($_POST['fullName']);
	$email= addslashes($_POST['emailId']);
	$creatorName = addslashes($_POST['creatorName']);
	$creatorEmail = addslashes($_POST['creatorEmail']);
	$pledgeType = addslashes($_POST['selectPledge']);
	$pledgeMessage = addslashes($_POST['pledgeMessage']);
	$action = addslashes($_POST['action']);
	$removePledgeId= addslashes($_POST['removePledgeId']);

	if ($action =="submit"){
		$supportQuery = "INSERT INTO `PROJECT_SUPPORTER`(`PROJECT_ID`,`SUPPORTER_NAME`, `SUPPORTER_EMAIL`, `SUPPORT_TYPE`,`PLEDGE`,`DATETIME`) 
						VALUES ('".$projectId."','".$name."','".$email."','".$pledgeType."','".$pledgeMessage."',NOW()) ";
	
		$supportResult = mysql_query($supportQuery,$connection);
		if (!$supportResult) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $supportQuery; 
		    die($message);
		} else {
			$subject = $name . " is willing to contribute for " . " " . $project;
			$message = '<p>Hi ' . $creatorName . ',</p>';
			$message .= '<p>' . $name . " is willing to contribute for " . " " . $project. '.</p>' . "\n";
			$message .= '<p>Message: ' . $pledgeMessage . '</p>' . "\n";
			$message .= '<p>Contact ' . $name . ' @ ' . $email . '' ;
			$message .= '<p> Visit <a href="http://www.ocf.co">Our Common Future</a> at <a href="http://www.ocf.co"> http://www.ocf.co</a> to connect with '. $name . " through My Initiative -> Active -> EDIT -> Pledges.</p><br>\n";
			$message .= '<p> Thank You! <br>- Our Common Future Team <p>';
			sendmail($creatorEmail, $subject, $message);
		}

	} else if ($action =="receive"){

		$supportQuery = "SELECT  * FROM  `PROJECT_SUPPORTER` WHERE `PROJECT_ID`='".$projectId."' ";
	
		$supportResult = mysql_query($supportQuery,$connection);
		if (!$supportResult) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $supportQuery; 
		    die($message);
		}

		$supportData = array();
		while ($subject = mysql_fetch_assoc( $supportResult)){ 
			$supportData[] = $subject;
		}

		echo(json_encode($supportData));	

	} else if ($action =="delete"){

		$supportQuery = "DELETE FROM  `PROJECT_SUPPORTER` WHERE `ID`='".$removePledgeId."' ";
	
		$supportResult = mysql_query($supportQuery,$connection);
		if (!$supportResult) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $supportQuery; 
		    die($message);
		}

		echo(json_encode("Deleted the pledge !!!"));		
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
	  $mail->SetFrom("ourcommonfuture@gmail.com", "OCF");
	  $mail->AddReplyTo("ourcommonfuture@gmail.com","OCF");
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);

		// To address
		$mail->AddAddress($to);

		if(!$mail->Send()) {
			$error = 'Mail error: '.$mail->ErrorInfo; 
			echo $error;

		} else {
			echo '<script type="text/javascript">';
			echo 'alert("The project creator is been informed about this pledge !!!");';
			echo '</script>';			
		}
	}

	// echo($projectId.$pledgeMessage.$pledgeType.$action.$email.$name);

	?>

<?php 	mysql_close($connection); ?>