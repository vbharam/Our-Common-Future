<?php
include 'includes/Bluehost_connect.php';
?>


<?php
// Storing the received information
$searchPageNumber = $_POST['page'];
$tag              = $_POST['tag'];

if ($tag == 'finished') {
  $data      = mysql_fetch_object(mysql_query("SELECT COUNT(id) AS num_rows FROM `PROJECT` WHERE `PROGRESS_PERCENTAGE` >= 100"));
  $totalRows = $data->num_rows;
  $startPage = $totalRows - ($searchPageNumber) * 12;
  $count     = 12;
  if ($startPage < 0) {
    $count     = $startPage + 12;
    $startPage = 0;
  }
  $query = "SELECT  * FROM  `PROJECT`  WHERE `PROGRESS_PERCENTAGE` >= 100 ORDER BY `ID` ASC LIMIT " . $startPage . ", " . $count . " ";
} else {
  $data      = mysql_fetch_object(mysql_query("SELECT COUNT(id) AS num_rows FROM `PROJECT` WHERE `PROGRESS_PERCENTAGE` < 100"));
  $totalRows = $data->num_rows;
  $startPage = $totalRows - ($searchPageNumber) * 12;
  $count     = 12;
  if ($startPage < 0) {
    $count     = $startPage + 12;
    $startPage = 0;
  }
  $query = "SELECT  * FROM  `PROJECT`  WHERE `PROGRESS_PERCENTAGE` < 100 ORDER BY `ID` ASC LIMIT " . $startPage . ", " . $count . " ";
}

$result = mysql_query($query, $connection);
if (!$result) {
  $message = 'Invalid query: ' . mysql_error() . "\n";
  $message .= 'Whole query: ' . $query;
  die($message);
}

$projectData = array();
$id_array    = array();
while ($subject = mysql_fetch_assoc($result)) {
  $projectData[] = $subject;
  array_push($id_array, $subject['ID']);
}
$projectData = array_reverse($projectData);
$id_array    = array_reverse($id_array);
$id_array    = join(',', $id_array);



///////////////////////////////////////////////////////////////////////////////////////////

$getCreatorQuery  = "SELECT  * FROM  `PROJECT_CREATOR` WHERE `PROJECT_ID` IN ($id_array) ORDER BY `PROJECT_ID` DESC";
$getCreatorResult = mysql_query($getCreatorQuery, $connection);
if (!$getCreatorResult) {
  $message = 'Invalid query: ' . mysql_error() . "\n";
  $message .= 'Whole query: ' . $getCreatorQuery;
  die($message);
}
$creatorData = array();
while ($subject = mysql_fetch_assoc($getCreatorResult)) {
  $creatorData[] = $subject;
}

///////////////////////////////////////////////////////////////////////////////////////////

$getFollowerQuery  = "SELECT  * FROM  `PROJECT_FOLLOWER` WHERE `PROJECT_ID` IN ($id_array) ORDER BY `PROJECT_ID` DESC, `ID` ASC";
$getFollowerResult = mysql_query($getFollowerQuery, $connection);
if (!$getFollowerResult) {
  $message = 'Invalid query: ' . mysql_error() . "\n";
  $message .= 'Whole query: ' . $getFollowerQuery;
  die($message);
}
$followerData = array();
while ($subject = mysql_fetch_assoc($getFollowerResult)) {
  $followerData[] = $subject;
}

///////////////////////////////////////////////////////////////////////////////////////////	

$data = array(
  "projectData" => $projectData,
  "creatorData" => $creatorData,
  "followerData" => $followerData,
  "totalRows" => $totalRows
);

echo (json_encode($data));

// Release the returned projectData 
mysql_free_result($result . $getCreatorResult . $getAdvisorResult);
?>

<?php
mysql_close($connection);
?>
