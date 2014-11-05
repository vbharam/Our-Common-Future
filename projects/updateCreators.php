<?php include 'includes/Bluehost_connect.php'; ?>

<?php
	$projectId= addslashes($_POST['id']);
	$creatorIdArray = addslashes($_POST['idArray']);	
	$creatorIdArray = explode(',',$creatorIdArray);

///////////////////////////////////////////////////////////////////////////////////////////
	// Project Creator 1
	$creator1Name = addslashes($_POST['creator1Name']); 	
	$creator1Country= addslashes($_POST['creator1Country']);
	$creator1UWC = addslashes($_POST['creator1UWC']);
	$creator1Email = addslashes($_POST['creator1Email']);
	$creator1Phone = addslashes($_POST['creator1Phone']);
	$creator1Bio = addslashes($_POST['creator1Biography']);	

	if ($creator1Name !="" && $creator1Email !=""){
		if (($creatorIdArray[0]) != null){
			$creator1Query = "UPDATE `PROJECT_CREATOR` SET `CREATOR_NAME` = '{$creator1Name}',`CREATOR_COUNTRY` = '{$creator1Country}',`CREATOR_UWC` = '{$creator1UWC}',`CREATOR_EMAIL` = '{$creator1Email }',`CREATOR_PHONE` = '{$creator1Phone}',`CREATOR_BIO` = '{$creator1Bio}' WHERE `PROJECT_ID`='{$projectId}' AND `ID`='{$creatorIdArray[0]}' ";
		} else {		
			$creator1Query = "INSERT INTO `PROJECT_CREATOR`(`PROJECT_ID`,`CREATOR_NAME`, `CREATOR_COUNTRY`, `CREATOR_UWC`, `CREATOR_EMAIL`,`CREATOR_PHONE`,`CREATOR_BIO`)
				VALUES ('".$projectId."','".$creator1Name."','".$creator1Country."','".$creator1UWC."', '".$creator1Email."', '".$creator1Phone."', '".$creator1Bio."') ";	
		}	
		$creator1Result = mysql_query($creator1Query,$connection);
		if (!$creator1Result) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $creator1Query;
		    die($message);
		}
		
		$file1 =$_FILES['creator1Pic'];
		$creator1Pic = $_FILES['creator1Pic']['name'];	
		if ($creator1Pic[0] !== ""){
			$img_name = $file1['name'][0];	
			$tmp = $file1['tmp_name'][0];
			$fp = fopen($tmp, 'r');
			$data = fread($fp, filesize($tmp));
			$data = addslashes($data);
			fclose($fp);
			$datedImage1 = microtime(true).$img_name;
			move_uploaded_file($tmp,"uploads/" . $datedImage1);
			$addImage1Query = "UPDATE `PROJECT_CREATOR` SET `CREATOR_PIC` = '{$datedImage}'  WHERE `PROJECT_ID`='{$projectId}' AND `ID`='{$creatorIdArray[0]}'";	
				$addImage1Result = mysql_query($addImage1Query,$connection);
				if (!$addImage1Result) { 
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $addImage1Query;
			    die($message);
			}		
		}
	} else {
		$creator1Query = "DELETE FROM `PROJECT_CREATOR`  WHERE `PROJECT_ID`='{$projectId}' AND `ID`='{$creatorIdArray[0]}' ";		
		$creator1Result = mysql_query($creator1Query,$connection);
		if (!$creator1Result) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $creator1Query;
		    die($message);
		}
	}

///////////////////////////////////////////////////////////////////////////////////////////
	// Project Creator 2
	$creator2Name = addslashes($_POST['creator2Name']); 	
	$creator2Country= addslashes($_POST['creator2Country']);
	$creator2UWC = addslashes($_POST['creator2UWC']);
	$creator2Email = addslashes($_POST['creator2Email']);
	$creator2Phone = addslashes($_POST['creator2Phone']);
	$creator2Bio = addslashes($_POST['creator2Biography']);	

	if ($creator2Name !="" && $creator2Email !=""){
		if (($creatorIdArray[1]) != null){
			$creator2Query = "UPDATE `PROJECT_CREATOR` SET `CREATOR_NAME` = '{$creator2Name}',`CREATOR_COUNTRY` = '{$creator2Country}',`CREATOR_UWC` = '{$creator2UWC}',`CREATOR_EMAIL` = '{$creator2Email }',`CREATOR_PHONE` = '{$creator2Phone}',`CREATOR_BIO` = '{$creator2Bio}' WHERE `PROJECT_ID`='{$projectId}' AND `ID`='{$creatorIdArray[1]}' ";
		} else {		
			$creator2Query = "INSERT INTO `PROJECT_CREATOR`(`PROJECT_ID`,`CREATOR_NAME`, `CREATOR_COUNTRY`, `CREATOR_UWC`, `CREATOR_EMAIL`,`CREATOR_PHONE`,`CREATOR_BIO`)
				VALUES ('".$projectId."','".$creator2Name."','".$creator2Country."','".$creator2UWC."', '".$creator2Email."', '".$creator2Phone."', '".$creator2Bio."') ";	
		}
		$creator2Result = mysql_query($creator2Query,$connection);
		if (!$creator2Result) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $creator2Query;
		    die($message);
		}
		
		$file2 =$_FILES['creator2Pic'];
		$creator2Pic = $_FILES['creator2Pic']['name'];	
		if ($creator2Pic[0] !== ""){
			$img_name = $file2['name'][0];	
			$tmp = $file2['tmp_name'][0];
			$fp = fopen($tmp, 'r');
			$data = fread($fp, filesize($tmp));
			$data = addslashes($data);
			fclose($fp);
			$datedImage2 = microtime(true).$img_name;
			move_uploaded_file($tmp,"uploads/" . $datedImage2);
			$addImage2Query = "UPDATE `PROJECT_CREATOR` SET `CREATOR_PIC` = '{$datedImage}'  WHERE `PROJECT_ID`='{$projectId}' AND `ID`='{$creatorIdArray[1]}'";	
				$addImage2Result = mysql_query($addImage2Query,$connection);
				if (!$addImage2Result) { 
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $addImage2Query;
			    die($message);
			}		
		}
	} else {
		$creator2Query = "DELETE FROM `PROJECT_CREATOR` WHERE `PROJECT_ID`='{$projectId}' AND `ID`='{$creatorIdArray[1]}' ";		
		$creator2Result = mysql_query($creator2Query,$connection);
		if (!$creator2Result) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $creator2Query;
		    die($message);
		}
	}

///////////////////////////////////////////////////////////////////////////////////////////
	// Project Creator 3
	$creator3Name = addslashes($_POST['creator3Name']); 	
	$creator3Country= addslashes($_POST['creator3Country']);
	$creator3UWC = addslashes($_POST['creator3UWC']);
	$creator3Email = addslashes($_POST['creator3Email']);
	$creator3Phone = addslashes($_POST['creator3Phone']);
	$creator3Bio = addslashes($_POST['creator3Biography']);	

	if ($creator3Name !="" && $creator3Email !=""){
		if (($creatorIdArray[2]) != null){
			$creator3Query = "UPDATE `PROJECT_CREATOR` SET `CREATOR_NAME` = '{$creator3Name}',`CREATOR_COUNTRY` = '{$creator3Country}',`CREATOR_UWC` = '{$creator3UWC}',`CREATOR_EMAIL` = '{$creator3Email }',`CREATOR_PHONE` = '{$creator3Phone}',`CREATOR_BIO` = '{$creator3Bio}' WHERE `PROJECT_ID`='{$projectId}' AND `ID`='{$creatorIdArray[2]}' ";
		} else {		
			$creator3Query = "INSERT INTO `PROJECT_CREATOR`(`PROJECT_ID`,`CREATOR_NAME`, `CREATOR_COUNTRY`, `CREATOR_UWC`, `CREATOR_EMAIL`,`CREATOR_PHONE`,`CREATOR_BIO`)
				VALUES ('".$projectId."','".$creator3Name."','".$creator3Country."','".$creator3UWC."', '".$creator3Email."', '".$creator3Phone."', '".$creator3Bio."') ";	
		}
		$creator3Result = mysql_query($creator3Query,$connection);
		if (!$creator3Result) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $creator3Query;
		    die($message);
		}
		
		$file3 =$_FILES['creator3Pic'];
		$creator3Pic = $_FILES['creator3Pic']['name'];	
		if ($creator3Pic[0] !== ""){
			$img_name = $file3['name'][0];	
			$tmp = $file3['tmp_name'][0];
			$fp = fopen($tmp, 'r');
			$data = fread($fp, filesize($tmp));
			$data = addslashes($data);
			fclose($fp);
			$datedImage3 = microtime(true).$img_name;
			move_uploaded_file($tmp,"uploads/" . $datedImage3);
			$addImage3Query = "UPDATE `PROJECT_CREATOR` SET `CREATOR_PIC` = '{$datedImage}'  WHERE `PROJECT_ID`='{$projectId}' AND `ID`='{$creatorIdArray[2]}'";	
				$addImage3Result = mysql_query($addImage3Query,$connection);
				if (!$addImage3Result) { 
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $addImage3Query;
			    die($message);
			}		
		}
	} else {
		$creator3Query = "DELETE FROM `PROJECT_CREATOR`  WHERE `PROJECT_ID`='{$projectId}' AND `ID`= '{$creatorIdArray[2]}' ";		
		$creator3Result = mysql_query($creator3Query,$connection);
		if (!$creator3Result) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $creator3Query;
		    die($message);
		}
	}

///////////////////////////////////////////////////////////////////////////////////////////
	// Project Creator 4
	$creator4Name = addslashes($_POST['creator4Name']); 	
	$creator4Country= addslashes($_POST['creator4Country']);
	$creator4UWC = addslashes($_POST['creator4UWC']);
	$creator4Email = addslashes($_POST['creator4Email']);
	$creator4Phone = addslashes($_POST['creator4Phone']);
	$creator4Bio = addslashes($_POST['creator4Biography']);	

	if ($creator4Name !="" && $creator4Email !=""){
		if (($creatorIdArray[3]) != null){
			$creator4Query = "UPDATE `PROJECT_CREATOR` SET `CREATOR_NAME` = '{$creator4Name}',`CREATOR_COUNTRY` = '{$creator4Country}',`CREATOR_UWC` = '{$creator4UWC}',`CREATOR_EMAIL` = '{$creator4Email }',`CREATOR_PHONE` = '{$creator4Phone}',`CREATOR_BIO` = '{$creator4Bio}' WHERE `PROJECT_ID`='{$projectId}' AND `ID`='{$creatorIdArray[3]}' ";
		} else {		
			$creator4Query = "INSERT INTO `PROJECT_CREATOR`(`PROJECT_ID`,`CREATOR_NAME`, `CREATOR_COUNTRY`, `CREATOR_UWC`, `CREATOR_EMAIL`,`CREATOR_PHONE`,`CREATOR_BIO`)
				VALUES ('".$projectId."','".$creator4Name."','".$creator4Country."','".$creator4UWC."', '".$creator4Email."', '".$creator4Phone."', '".$creator4Bio."') ";	
		}
		$creator4Result = mysql_query($creator4Query,$connection);
		if (!$creator4Result) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $creator4Query;
		    die($message);
		}
		
		$file4 =$_FILES['creator4Pic'];
		$creator4Pic = $_FILES['creator4Pic']['name'];	
		if ($creator4Pic[0] !== ""){
			$img_name = $file4['name'][0];	
			$tmp = $file4['tmp_name'][0];
			$fp = fopen($tmp, 'r');
			$data = fread($fp, filesize($tmp));
			$data = addslashes($data);
			fclose($fp);
			$datedImage4 = microtime(true).$img_name;
			move_uploaded_file($tmp,"uploads/" . $datedImage4);
			$addImage4Query = "UPDATE `PROJECT_CREATOR` SET `CREATOR_PIC` = '{$datedImage}'  WHERE `PROJECT_ID`='{$projectId}' AND `ID`='{$creatorIdArray[3]}'";	
				$addImage4Result = mysql_query($addImage4Query,$connection);
				if (!$addImage4Result) { 
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $addImage4Query;
			    die($message);
			}		
		}
	} else {
		$creator4Query = "DELETE FROM `PROJECT_CREATOR` WHERE `PROJECT_ID`='{$projectId}' AND `ID`='{$creatorIdArray[3]}' ";		
		$creator4Result = mysql_query($creator4Query,$connection);
		if (!$creator4Result) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $creator4Query;
		    die($message);
		}
	}

	echo(json_encode($creatorIdArray[2] ));
?>

<?php 	mysql_close($connection); ?>