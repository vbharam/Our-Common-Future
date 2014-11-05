<?php include 'includes/Bluehost_connect.php'; ?>

<?php 	
	// Storing the received information from INITIATIVE-DESCRIPTION
	$projectName = addslashes($_POST['projectName']); 	
	$category = implode(",", $_POST['category']);	
	$location = addslashes($_POST['location']);
	$country = addslashes($_POST['countryName']);
	$shortBlurb = addslashes($_POST['shortBlurb']);
	$funding = addslashes($_POST['funding']);
	$benefit = addslashes($_POST['benefit']);
	$video = addslashes($_POST['video']);
	$description = addslashes($_POST['description']);
	$risksAndChallenges = addslashes($_POST['risksAndChallenges']);
	$lookingFor = addslashes($_POST['lookingFor']);
	$publishStatus = addslashes($_POST['radioValue']); 
	$image = "UWC-circles-grey.svg";
	
	$projectQuery = "INSERT INTO `PROJECT`(`NAME`,`CATEGORY`, `LOCATION`, `COUNTRY`, `SHORT_BLURB`, `FUNDING`,`BENEFIT`, `VIDEO`,`DESCRIPTION`, `RISKS_CHALLENGES`,`LOOKING_FOR`,`PUBLISH_STATUS`,`DATETIME`)
			VALUES ('".$projectName."','".$category."','".$location."','".$country."','".$shortBlurb."', '".$funding."', '".$benefit."', '".$video."', '".$description."', '".$risksAndChallenges."','".$lookingFor."','".$publishStatus."',  NOW()) ";
	
	$projectResult = mysql_query($projectQuery,$connection);
	if (!$projectResult) { 
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $projectQuery; 
	    die($message);
	}

///////////////////////////////////////////////////////////////////////////////////////////
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

///////////////////////////////////////////////////////////////////////////////////////////
	$file =$_FILES['file'];
	$filename = $_FILES['file']['name'];

	if ($filename[0] !== ""){
		    // Read the file
		$img_name = $file['name'][0];
		
		$tmp = $file['tmp_name'][0];
		$fp = fopen($tmp, 'r');
		$data = fread($fp, filesize($tmp));
		$data = addslashes($data);
		fclose($fp);

		$datedImage = microtime(true).$img_name;
		$datedImage = preg_replace('/\s+/', '', $datedImage);

		move_uploaded_file($tmp,"uploads/" . $datedImage);

		$addImageQuery = "UPDATE `PROJECT` SET `IMAGE` = '$datedImage' WHERE `ID` = '".$id."' ";
			$addImageResult = mysql_query($addImageQuery,$connection);
			if (!$addImageResult) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $addImageQuery;
		    die($message);
		}
		
	} else {
		$addImageQuery = "UPDATE `PROJECT` SET `IMAGE` = '$image' WHERE `ID` = '".$id."' ";
			$addImageResult = mysql_query($addImageQuery,$connection);
			if (!$addImageResult) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $addImageQuery;
		    die($message);
			}
	}


?>
<?php 	mysql_close($connection); ?>