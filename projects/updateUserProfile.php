<?php 
ob_start();
session_start();
include 'includes/Bluehost_connect.php'; 
  include 'includes/googleAnalytics.php';

?>
<?php
	$userEmail = $_SESSION["email"];
	$uid= addslashes($_POST['id']);
	$userName = addslashes($_POST['name']);	
	$userCountry = addslashes($_POST['country']);	
	$userUWC = addslashes($_POST['selectUWC']);
	$userUWCYear = 	addslashes($_POST['selectYear']);
	$userPhone = addslashes($_POST['phone']);		
	$userLanguages = addslashes($_POST['languages']);	
	$userSkills = addslashes($_POST['skills']);	
	$userBiography = addslashes($_POST['biography']);

///////////////////////////////////////////////////////////////////////////////////////////
	//$creator4Query = "UPDATE `PROJECT_CREATOR` SET `CREATOR_NAME` = '{$creator4Name}',`CREATOR_COUNTRY` = '{$creator4Country}',`CREATOR_UWC` = '{$creator4UWC}',`CREATOR_EMAIL` = '{$creator4Email }',`CREATOR_PHONE` = '{$creator4Phone}',`CREATOR_BIO` = '{$creator4Bio}' WHERE `PROJECT_ID`='{$projectId}' AND `ID`='{$creatorIdArray[3]}' ";		


	$userQuery = "UPDATE `USER_INFO` SET `NAME` = '$userName',`COUNTRY` = '$userCountry',`UWC` = '$userUWC',`UWC_YEAR` =         '$userUWCYear', `EMAIL` = '$userEmail',`PHONE` = '$userPhone',`LANGUAGES` = '$userLanguages',`SKILLS` = '$userSkills',`BIO` = '$userBiography' WHERE `ID`='$uid' ";		
	$userResult = mysql_query($userQuery,$connection);
	if (!$userResult) { 
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $userQuery;
	    die($message);
	}
	
	$file =$_FILES['userPic'];
	$userPic = $_FILES['userPic']['name'];	
	if ($userPic[0] !== ""){
		$img_name = $file['name'][0];	
		$tmp = $file['tmp_name'][0];
		$fp = fopen($tmp, 'r');
		$data = fread($fp, filesize($tmp));
		$data = addslashes($data);
		fclose($fp);
		$datedImage = microtime(true).$img_name;
		move_uploaded_file($tmp,"uploads/" . $datedImage);
		$addImageQuery = "UPDATE `USER_INFO` SET `PROFILE_PIC` = '{$datedImage}'  WHERE `ID`='{$uid}'";		
			$addImageResult = mysql_query($addImageQuery,$connection);
			if (!$addImageResult) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $addImageQuery;
		    die($message);
		}		
	}

	// echo (json_encode("userCountry"));	
?>
<?php 	mysql_close($connection); ?>