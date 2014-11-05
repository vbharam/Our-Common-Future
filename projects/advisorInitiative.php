<?php include 'includes/Bluehost_connect.php'; ?>

<?php

	// Fetch the ID from the recently added project
	$fetchId = "SELECT `ID` FROM  `PROJECT` ORDER BY `ID` DESC LIMIT 1 ";
	$fetchIdresult = mysql_query($fetchId,$connection);
		if (!$fetchIdresult) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $fetchId;
		    die($message);
	}
	while ($subject = mysql_fetch_assoc( $fetchIdresult)){ 
		$id = $subject['ID'];
	}
	$size = $_POST['selectAdvisor'] + 1;

	for ($i=1; $i <=$size ; $i++) { 
		$tempName = 'advisor'.$i.'Name';
		$tempEmail = 'advisor'.$i.'Email';
		$advisorName = addslashes($_POST[$tempName]); 	
		$advisorEmail = addslashes($_POST[$tempEmail]);	

		if ($advisorName !="" || $advisorEmail !=""){
			$advisorQuery = "INSERT INTO `PROJECT_ADVISOR`(`PROJECT_ID`,`ADVISOR_NAME`,`ADVISOR_EMAIL`)
					VALUES ('".$id."','".$advisorName."', '".$advisorEmail."') ";		
			$advisorResult = mysql_query($advisorQuery,$connection);
			if (!$advisorResult) { 
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $advisorQuery;
			    die($message);
			}
		}	
	}
echo(json_encode($size));
?>

<?php 	mysql_close($connection); ?>