<?php include 'includes/Bluehost_connect.php'; ?>

<?php 	
	// Storing the received information from INITIATIVE-DESCRIPTION
	$projectId = addslashes($_POST['id']); 	
	$name = addslashes($_POST['fullName']);
	$email= addslashes($_POST['emailId']);
	$UWC = addslashes($_POST['selectUWC']);
	$year = addslashes($_POST['selectYear']);
	$message = addslashes($_POST['message']);
	$action = addslashes($_POST['action']);
	$removeCommentId= addslashes($_POST['removeCommentId']);

	if ($action =="submit"){
		$feedbackQuery = "INSERT INTO `PROJECT_REPLY`(`PROJECT_ID`,`NAME`, `EMAIL`, `UWC`,`UWC_YEAR`,`COMMENT`,`DATETIME`) 
						VALUES ('".$projectId."','".$name."','".$email."','".$UWC."','".$year."','".$message."',NOW()) ";
	
		$feedbackResult = mysql_query($feedbackQuery,$connection);
		if (!$feedbackResult) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $feedbackQuery; 
		    die($message);
		}
		echo(json_encode($UWC.$year));

	} else if ($action =="receive"){

		$feedbackQuery = "SELECT  * FROM  `PROJECT_REPLY` WHERE `PROJECT_ID`='".$projectId."' ";
	
		$feedbackResult = mysql_query($feedbackQuery,$connection);
		if (!$feedbackResult) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $feedbackQuery; 
		    die($message);
		}

		$feedbackData = array();
		while ($subject = mysql_fetch_assoc( $feedbackResult)){ 
			$feedbackData[] = $subject;
		}

		echo(json_encode($feedbackData));	

	} else if ($action =="delete"){

		$feedbackQuery = "DELETE FROM  `PROJECT_REPLY` WHERE `ID`='".$removeCommentId."' ";
	
		$feedbackResult = mysql_query($feedbackQuery,$connection);
		if (!$feedbackResult) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $feedbackQuery; 
		    die($message);
		}

		echo(json_encode("Deleted the comment !!!"));		
	}

	?>

<?php 	mysql_close($connection); ?>