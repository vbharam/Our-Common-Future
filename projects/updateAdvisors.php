<?php include 'includes/Bluehost_connect.php'; ?>

<?php
	$projectId= addslashes($_POST['id']);
	$advisorIdArray = addslashes($_POST['idArray']);
	$advisorIdArray = explode(',', $advisorIdArray);


///////////////////////////////////////////////////////////////////////////////////////////
	$advisor1Name = addslashes($_POST['advisor1Name']); 	
	$advisor1Email = addslashes($_POST['advisor1Email']);	

	if ($advisor1Name !="" && $advisor1Email !=""){
		$updateProjectAdvisor1 = "UPDATE `PROJECT_ADVISOR` SET `ADVISOR_NAME` = '{$advisor1Name}',`ADVISOR_EMAIL` = '{$advisor1Email}' WHERE `PROJECT_ID` = '{$projectId}' AND `ID`='{$advisorIdArray[0]}' ";
		$Advisor1Result = mysql_query($updateProjectAdvisor1,$connection);
		if (!$Advisor1Result) { 
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $updateProjectAdvisor1;
		die($message);
		}
	}

///////////////////////////////////////////////////////////////////////////////////////////
	$advisor2Name = addslashes($_POST['advisor2Name']); 	
	$advisor2Email = addslashes($_POST['advisor2Email']);	

	if ($advisor2Name !="" && $advisor2Email !=""){
		$updateProjectAdvisor2 = "UPDATE `PROJECT_ADVISOR` SET `ADVISOR_NAME` = '{$advisor2Name}',`ADVISOR_EMAIL` = '{$advisor2Email}' WHERE `PROJECT_ID` = '{$projectId}' AND `ID`='{$advisorIdArray[1]}' ";
		$Advisor2Result = mysql_query($updateProjectAdvisor2,$connection);
		if (!$Advisor2Result) { 
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $updateProjectAdvisor2;
		die($message);
		}
	}

///////////////////////////////////////////////////////////////////////////////////////////
	$advisor3Name = addslashes($_POST['advisor3Name']); 	
	$advisor3Email = addslashes($_POST['advisor3Email']);	

	if ($advisor3Name !="" && $advisor3Email !=""){
		$updateProjectAdvisor3 = "UPDATE `PROJECT_ADVISOR` SET `ADVISOR_NAME` = '{$advisor3Name}',`ADVISOR_EMAIL` = '{$advisor3Email}' WHERE `PROJECT_ID` = '{$projectId}' AND `ID`='{$advisorIdArray[2]}' ";
		$Advisor3Result = mysql_query($updateProjectAdvisor3,$connection);
		if (!$Advisor3Result) { 
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $updateProjectAdvisor3;
		die($message);
		}
	}

///////////////////////////////////////////////////////////////////////////////////////////
	$advisor4Name = addslashes($_POST['advisor4Name']); 	
	$advisor4Email = addslashes($_POST['advisor4Email']);	

	if ($advisor4Name !="" && $advisor4Email !=""){
		$updateProjectAdvisor4 = "UPDATE `PROJECT_ADVISOR` SET `ADVISOR_NAME` = '{$advisor4Name}',`ADVISOR_EMAIL` = '{$advisor4Email}' WHERE `PROJECT_ID` = '{$projectId}' AND `ID`='{$advisorIdArray[3]}' ";
		$Advisor4Result = mysql_query($updateProjectAdvisor4,$connection);
		if (!$Advisor4Result) { 
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $updateProjectAdvisor4;
		die($message);
		}
	}

	echo(json_encode($updateProjectAdvisor1.$updateProjectAdvisor2));
	//mysql_free_result($creatorResult);
?>

<?php 	mysql_close($connection); ?>