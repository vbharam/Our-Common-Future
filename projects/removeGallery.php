<?php include 'includes/Bluehost_connect.php'; ?>

<?php 	
	// Storing the received information from INITIATIVE-DESCRIPTION


	$projectId = $_POST['projectId'];
	$media = $_POST['media'];
	$tag = $_POST['tag'];
	if ($tag==1){
		$media = preg_replace("\\", "", $media);
	}
	

	if ($projectId !== "") {
		$removeGallery = "DELETE FROM `GALLERY` WHERE `IMAGE_NAME` = '$media' OR `VIDEO_LINK` = '$media' ";
		$removeGalleryResult = mysql_query($removeGallery, $connection);
		if (!$removeGalleryResult) {
		  $message  = 'Invalid query: ' . mysql_error() . "\n";
		  $message .= 'Whole query: ' . $removeGallery;
		  die($message);
		}
		mysql_free_result($removeGalleryResult);
	}

	unlink('uploads/'. $media);

	echo (json_encode($media.$tag));


?>

<?php mysql_close($connection); ?>