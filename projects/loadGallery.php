<?php include 'includes/Bluehost_connect.php'; ?>

<?php 	
	// Storing the received information from INITIATIVE-DESCRIPTION


	$userId = $_POST['uid'];
	$projectId = $_POST['projectId'];
	$file =$_FILES['file'];
	$filename = $_FILES['file']['name'];
	$video_link = $_POST['video_link'];
	$pId = $_POST['pId'];

	if ($pId !== "") {
		$retrieveGallery = "SELECT * FROM `GALLERY` WHERE `PROJECT_ID` = '".$pId."'";
		$retrieveGalleryResult = mysql_query($retrieveGallery, $connection);
		if (!$retrieveGalleryResult) {
		  $message  = 'Invalid query: ' . mysql_error() . "\n";
		  $message .= 'Whole query: ' . $retrieveGallery;
		  die($message);
		}

		$imageData = array();
		$videoData = array();

		while ($subject = mysql_fetch_assoc($retrieveGalleryResult)) {
			$imageData[] = $subject['IMAGE_NAME'];
			$videoData[] = $subject['VIDEO_LINK'];
		}

		$data = array(
			"imageData" => $imageData,
			"videoData" => $videoData,
			);

		echo(json_encode($data));

		mysql_free_result($retrieveGalleryResult);
	}


	// echo json_encode($pId);


?>

<?php mysql_close($connection); ?>