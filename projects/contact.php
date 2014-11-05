<?php include 'includes/Bluehost_connect.php'; ?>

<?php 	
	$projectId = $_POST['id'];	

	if( $projectId !="") {		
		$query = "SELECT  * FROM  `PROJECT` WHERE `ID`='".$projectId."' LIMIT 1 ";
	} 
	$result = mysql_query($query,$connection);
	if (!$result) { 
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    die($message);
	}
	while ($subject = mysql_fetch_assoc( $result)){ 
		$projectName = ($subject['NAME']);	    
	}


    $getCreatorQuery = "SELECT  * FROM  `PROJECT_CREATOR` WHERE `PROJECT_ID`='".$projectId."'";
	$getCreatorResult = mysql_query($getCreatorQuery,$connection);
	if (!$getCreatorResult) { 
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $getCreatorQuery;
	    die($message);
	}
	$userEmailArray =  array();
	while ($subject = mysql_fetch_assoc( $getCreatorResult)){ 
		$projectIdForCreators = ($subject['PROJECT_ID']);
	    $creatorEmail = ($subject['CREATOR_EMAIL']);
	    if ($projectId==$projectIdForCreators){
		    array_push($userEmailArray, $creatorEmail);
	    }
	}

	// ///////////////////////////////////////////////////////////////////////////////////////////

	$getAdvisorQuery = "SELECT  * FROM  `PROJECT_ADVISOR` WHERE `PROJECT_ID`='".$projectId."' ";
	$getAdvisorResult = mysql_query($getAdvisorQuery,$connection);
	if (!$getAdvisorResult) { 
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $getAdvisorQuery;
	    die($message);
	}
    $advisorEmailArray =  array();
	while ($subject = mysql_fetch_assoc( $getAdvisorResult)){ 
		$projectIdForAdvisors = ($subject['PROJECT_ID']);
	    $advisorEmail = ($subject['ADVISOR_EMAIL']);
	    if ($projectId==$projectIdForAdvisors){
	      array_push($advisorEmailArray, $advisorEmail);
	    }
	}

	$Name = $_POST['inputName'];
    $email = $_POST['inputEmail'];
    $mail_body = $_POST['inputMessage'];
	$recipient = implode(',', $userEmailArray).','.implode(',', $advisorEmailArray); //recipient 
	$subject = "Mail regarding ".$projectName; //subject 
	$header = "From: ". $Name . " <" . $email . ">\r\n"; //optional headerfields 

	mail($recipient, $subject, $mail_body, $header); //mail command :) 

echo(json_encode($recipient));
?>
<?php 	mysql_close($connection); ?>