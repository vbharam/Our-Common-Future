<?php include 'includes/Bluehost_connect.php'; ?>

<?php 	
	// Storing the received information from INITIATIVE-DESCRIPTION
	$projectId = addslashes($_POST['id']); 	
	$userName = addslashes($_POST['name']);
	$emailId= addslashes($_POST['emailId']);
	$myUpdates = addslashes($_POST['myUpdates']);
	$action = addslashes($_POST['action']);
	$removeUpdateId= addslashes($_POST['removeUpdateId']);

	if ($action =="Post"){
		$updateQuery = "INSERT INTO `PROJECT_UPDATES`(`PROJECT_ID`,`UPDATES`,`USER_NAME`,`USER_EMAIL`,`DATETIME`)
			VALUES ('".$projectId."','".$myUpdates."','".$userName."','".$emailId."',NOW()) ";
	
		$updateResult = mysql_query($updateQuery,$connection);
		if (!$updateResult) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $updateQuery; 
		    die($message);
		}
		echo(json_encode("submitted"));



	} else if ($action =="get"){

		$updateQuery = "SELECT  * FROM  `PROJECT_UPDATES` WHERE `PROJECT_ID`='".$projectId."' ORDER BY `ID` DESC ";
	
		$updateResult = mysql_query($updateQuery,$connection);
		if (!$updateResult) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $updateQuery; 
		    die($message);
		}

		$updateData = array();
		while ($subject = mysql_fetch_assoc($updateResult)){ 
			$updateData[] = $subject;
		}

		echo(json_encode($updateData));		
	



	} else if ($action =="delete"){
		$updateQuery = "DELETE FROM `PROJECT_UPDATES` WHERE `ID`='$removeUpdateId'";
	
		$updateResult = mysql_query($updateQuery,$connection);
		if (!$updateResult) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $updateQuery; 
		    die($message);
		}
		echo(json_encode("Deleted !"));


}


	


	?>

<?php 	mysql_close($connection); ?> 
