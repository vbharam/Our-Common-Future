<?php include 'includes/Bluehost_connect.php'; ?>

<?php	
	$tag = addslashes($_POST['tag']);
	
	if ($tag != "addExtraTeamMembers"){
		// Fetch the ID from the recently added project
		$fetchId = "SELECT `ID`,`NAME` FROM  `PROJECT` ORDER BY `ID` DESC LIMIT 1 ";
		$fetchIdresult = mysql_query($fetchId,$connection);
			if (!$fetchIdresult) { 
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $fetchId;
			    die($message);
		}
		while ($subject = mysql_fetch_assoc( $fetchIdresult)){ 
			$projectId = $subject['ID'];
			$project = $subject['NAME'];
		}
	} else {
		$projectId= addslashes($_POST['id']);
	}

		
	$size = $_POST['selectTeam'] + 1;	//selectTeam contains the number of members the user to added

	for ($i=1; $i <=$size ; $i++) { 		
		$tempName = 'creator'.$i.'Name';
		$tempEmail = 'creator'.$i.'Email';
		$tempRole = 'creator'.$i.'Role';
		$creatorName = addslashes($_POST[$tempName]); 	
		$creatorEmail = addslashes($_POST[$tempEmail]);	
		$creatorRole = addslashes($_POST[$tempRole]);	

		if ($i==1){
			$creatorUWC = addslashes($_POST['selectUWC']);
			$creatorUWCYear = addslashes($_POST['selectYear']);
			$projectCreator = $creatorName;
		} else {
			$creatorUWC = "";
			$creatorUWCYear = "";
		}

		if ($creatorName !="" && $creatorEmail !=""){
			$creatorQuery = "INSERT INTO `PROJECT_CREATOR`(`PROJECT_ID`,`CREATOR_NAME`,`CREATOR_EMAIL`,`CREATOR_UWC`,`CREATOR_UWC_YEAR`, `CREATOR_ROLE`)
					VALUES ('".$projectId."','".$creatorName."', '".$creatorEmail."','".$creatorUWC."','".$creatorUWCYear."', '".$creatorRole."') ";		
			$creatorResult = mysql_query($creatorQuery,$connection);
			if (!$creatorResult) { 
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $creatorQuery;
			    die($message);
			} else {
				$subject = "Congratulations! You are now part of  " . " " . $project;
				$message = '<p>Hi ' . $creatorName . ',</p>';
				$message .= '<p>' . $projectCreator . " has added you as a member to " . " " . $project . '. We all will work togther to turn your idea into successful Initiative.</p>';
				$message .= ' You can keep of track of all the actions related to '. $project . ' through My Initiative -> Active.';
				$message .= ' Manage your project (EDIT, Updates, Comments, Contributions) through My Initiative -> Active -> EDIT.'. "\n";
				$message .= '<p> Visit <a href="http://www.ocf.co">Our Common Future</a> at <a href="http://www.ocf.co"> http://www.ocf.co</a> to keep ' . $project .  " up to date and check what other UWCers are up to.</p><br>\n";
				$message .= '<p> Thank You! <br>- Our Common Future Team <p>';
				sendmail($creatorEmail, $subject, $message);
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

echo(json_encode($size));
?>

<?php 	mysql_close($connection); ?>