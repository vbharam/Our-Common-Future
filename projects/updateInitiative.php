<?php
include 'includes/Bluehost_connect.php';
?>

<?php
$projectId          = addslashes($_POST['id']);
$projectName        = addslashes($_POST['projectName']);
$category           = implode(",", $_POST['category']);
$location           = addslashes($_POST['location']);
$country            = addslashes($_POST['countryName']);
$shortBlurb         = addslashes($_POST['shortBlurb']);
$funding            = addslashes($_POST['funding']);
$benefit            = addslashes($_POST['benefit']);
$video              = addslashes($_POST['video']);
$description        = addslashes($_POST['description']);
$risksAndChallenges = addslashes($_POST['risksAndChallenges']);
$lookingFor         = addslashes($_POST['lookingFor']);
$progressPercentage = addslashes($_POST['progressPercentage']);
$publishStatus      = addslashes($_POST['radioValue']); 
$image              = "Helping-Hands.jpg";

$updateProject = "UPDATE `PROJECT` 
					  SET `NAME` = '{$projectName}',`CATEGORY` = '{$category}',`LOCATION` = '{$location }',`COUNTRY` = '{$country}',`SHORT_BLURB` = '{$shortBlurb }',`FUNDING` = '{$funding}',`BENEFIT` = '{$benefit}',`VIDEO` = '{$video}',`DESCRIPTION` = '{$description}',`RISKS_CHALLENGES` = '{$risksAndChallenges}', `LOOKING_FOR` = '{$lookingFor}',`PUBLISH_STATUS` = '{$publishStatus}',`PROGRESS_PERCENTAGE` = '{$progressPercentage}', `STATUS_UPDATE_DATE`=NOW() WHERE `ID` = '{$projectId}' ";
$ProjectResult = mysql_query($updateProject, $connection);
if (!$ProjectResult) {
  $message = 'Invalid query: ' . mysql_error() . "\n";
  die($message);
}



$file     = $_FILES['file'];
$filename = $_FILES['file']['name'];

if ($filename[0] !== "") {	
  $projectImageResult = mysql_query("SELECT `IMAGE` FROM `PROJECT` WHERE `ID`='$projectId'", $connection);
  if (!$projectImageResult) {
    $message = 'Invalid query: ' . mysql_error() . "\n";
    die($message);
  }
  while ($subject = mysql_fetch_assoc($projectImageResult)) {
    $projectImageName = $subject['IMAGE'];
    unlink('uploads/' . $projectImageName);
  }
  // Read the file
  $img_name = $file['name'][0];  
  $tmp  = $file['tmp_name'][0];
  $fp   = fopen($tmp, 'r');
  $data = fread($fp, filesize($tmp));
  $data = addslashes($data);
  fclose($fp);
  $datedImage = microtime(true) . $img_name;  
  move_uploaded_file($tmp, "uploads/" . $datedImage);  
  $addImageQuery  = "UPDATE `PROJECT` SET `IMAGE` = '$datedImage' WHERE `ID` = '" . $projectId . "' ";
  $addImageResult = mysql_query($addImageQuery, $connection);
  if (!$addImageResult) {
    $message = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $addImageQuery;
    die($message);
  }  
}

echo (json_encode($projectImageName));
?>

<?php
mysql_close($connection);
?>