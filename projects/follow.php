<?php include 'includes/Bluehost_connect.php'; ?>

<?php 	
	// Storing the received information from INITIATIVE-DESCRIPTION
	$projectId = addslashes($_POST['projectId']);
	$name = addslashes($_POST['name']);
	$email = addslashes($_POST['email']);
	$followId = addslashes($_POST['follow']);	


	if ($followId==1) {
		$getProjectQuery = "SELECT `NAME` FROM `PROJECT` WHERE `ID`=".$projectId." ";
		$getProjectResult = mysql_query($getProjectQuery, $connection);
		if (!$getProjectResult) {
		  $message = 'Invalid query: ' . mysql_error() . "\n";
		  $message .= 'Whole query: ' . $getProjectQuery;
		  die($message);
		} else{
			if ($subject = mysql_fetch_assoc($getProjectResult)){
				$project = $subject['NAME'];
			}
		}		

		$data = mysql_fetch_object(mysql_query("SELECT COUNT(id) AS num_rows FROM `PROJECT_FOLLOWER` WHERE `PROJECT_ID`='$projectId' AND `FOLLOWER_EMAIL`='$email' "));
		$totalRows = $data->num_rows;
		if ($totalRows == 0){
			$followQuery = "INSERT INTO `PROJECT_FOLLOWER`(`PROJECT_ID`, `FOLLOWER_EMAIL`) VALUES ('".$projectId."','".$email."')";
			$followResult = mysql_query($followQuery,$connection);
			if (!$followResult) { 
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $followQuery;
			    die($message);
			} else {
				$subject = "Thanks! You are now following " . " " . $project;
				$message = '<p>Hi ' . $name . ',</p>';
				$message .= '<p>' . "Thank You! You are now following " . " " . $project . '.</p>';
				$message .= ' You can follow the complete action related to '. $project . ' through My Initiative.';
				$message .= ' Contribute to '. $project . ' through PLEDGE or share your your feedback/comment though COMMUNITY.'. "\n";
				$message .= '<p> Visit <a href="http://www.ocf.co">Our Common Future</a> at <a href="http://www.ocf.co"> http://www.ocf.co</a> to stay up to date on  ' . $project .  ".</p><br>\n";
				$message .= '<p> Thank You! <br>- Our Common Future Team <p>';
				sendmail($email, $subject, $message);
			}
			

			$dataFollowers = mysql_fetch_object(mysql_query("SELECT COUNT(id) AS num_rows FROM `PROJECT_FOLLOWER` WHERE `PROJECT_ID`='$projectId'"));
			$totalFollowers = $dataFollowers->num_rows;
			if ($totalFollowers%5 == 0){
				$getCreatorQuery  = "SELECT  * FROM  `PROJECT_CREATOR` WHERE `PROJECT_ID`='$projectId' ORDER BY `ID` ASC";
				$getCreatorResult = mysql_query($getCreatorQuery, $connection);
				if (!$getCreatorResult) {
				  $message = 'Invalid query: ' . mysql_error() . "\n";
				  $message .= 'Whole query: ' . $getCreatorQuery;
				  die($message);
				} 
				while ($subject = mysql_fetch_assoc($getCreatorResult)){
					$creatorName = $subject['CREATOR_NAME'];
					$creatorEmail = $subject['CREATOR_EMAIL'];

					$subject = "Congratulations! ". $project . " just "." received ". $totalFollowers . " followers";
					$message = '<p>Hi ' . $creatorName . ',</p>';
					$message .= '<p>' . "Congratulations on achieving your first milestone. Your initiative " . $project . " "." got ". $totalFollowers .' followers.</p>';
					$message .= ' Keep your followers engaged by constantly updating progress of your initiative through My Initiative -> Active -> EDIT -> Bulletin Board.';
					$message .= ' Check out Pledges and Community to see what other UWCers are offering.'. "\n";
					$message .= '<p> Visit <a href="http://www.ocf.co">Our Common Future</a> at <a href="http://www.ocf.co"> http://www.ocf.co</a> to stay up to date on  ' . $project .  ".</p><br>\n";
					$message .= '<p> Thank You! <br>- Our Common Future Team <p>';
					sendmail($creatorEmail, $subject, $message);
				}			
			}
			
			echo (json_encode(1));

		} 		
		
	} else if ($followId==0) {
		$unfollowQuery = "DELETE FROM `PROJECT_FOLLOWER` WHERE `PROJECT_ID`=".$projectId." ";
		$unfollowResult = mysql_query($unfollowQuery,$connection);
		if (!$unfollowResult) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $unfollowQuery;
		    die($message);
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
	  $mail->SetFrom("ourcommonfuture@gmail.com", "OCF");
	  $mail->AddReplyTo("ourcommonfuture@gmail.com","OCF");
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);

		// To address
		$mail->AddAddress($to);

		if(!$mail->Send()) {
			$error = 'Mail error: '.$mail->ErrorInfo; 
			echo $error;

		// } else {
		// 	echo '<script type="text/javascript">';
		// 	echo 'alert("The project creator is been informed about this pledge !!!");';
		// 	echo '</script>';			
		}
	}

?>

<?php 	mysql_close($connection); ?>