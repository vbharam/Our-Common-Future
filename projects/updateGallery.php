<?php include 'includes/Bluehost_connect.php'; ?>

<?php 	
	// Storing the received information from INITIATIVE-DESCRIPTION


$userId = $_POST['uid'];
$projectId = $_POST['projectId'];
$file =$_FILES['file'];

$filename = $_FILES['file']['name'];
$video_link = $_POST['video_link'];

	if ($filename[0] !== ""){
		    // Read the file

		$img_array = array();
		$tmp_array = array();
	for ($x = 0; $x < count($file['name']); $x++){

		$img_name = $file['name'][$x];
		
		$tmp = $file['tmp_name'][$x];
		$fp = fopen($tmp, 'r');
		$data = fread($fp, filesize($tmp));
		$data = addslashes($data);
		fclose($fp);

		$datedImage = microtime(true).$img_name;
			array_push($img_array, $datedImage);
			array_push($tmp_array,$tmp);


			move_uploaded_file($tmp_array[$x],"uploads/" . $img_array[$x]);

			    $addGalleryImage = "INSERT INTO `GALLERY`(`PROJECT_ID`, `UID`, `IMAGE_NAME`, `DATETIME`) VALUES ('".$projectId."','".$userId."','".$img_array[$x]."',NOW())";
			    $addGalleryImageResult = mysql_query($addGalleryImage,$connection);
				if (!$addGalleryImageResult) { 
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $addGalleryImage;
			    die($message);
				}
				
			} 
	}

if ($video_link !== ""){
	  $addGalleryImage = "INSERT INTO `GALLERY`(`PROJECT_ID`, `UID`, `VIDEO_LINK`, `DATETIME`) VALUES ('".$projectId."','".$userId."','".$video_link."',NOW())";
			    $addGalleryImageResult = mysql_query($addGalleryImage,$connection);
				if (!$addGalleryImageResult) { 
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $addGalleryImage;
			    die($message);
				}

}


		


	

echo json_encode($filename.'-'.$video_link.'-'.$userId.'-'.$projectId);


?>
<?php 	mysql_close($connection); ?>