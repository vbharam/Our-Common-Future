<?php
include 'includes/Bluehost_connect.php';
?>


<?php

$searchPageNumber = $_POST['page'];
$startPage        = ($searchPageNumber - 1) * 10;
$tag              = $_POST['tag'];
$email            = $_POST['email'];


if ($searchPageNumber != "" && $email != "" && $tag != "followed") {
  $query = "SELECT  * FROM  `PROJECT_CREATOR` WHERE `CREATOR_EMAIL` LIKE '%$email%' ORDER BY `ID` ASC LIMIT " . $startPage . ", 12 ";
  $totalRows = mysql_num_rows(mysql_query("SELECT `id` FROM `PROJECT_CREATOR` WHERE `CREATOR_EMAIL` LIKE '%$email%'", $connection));
} else if ($tag == "followed") {
  $query = "SELECT  * FROM  `PROJECT_FOLLOWER` WHERE `FOLLOWER_EMAIL` LIKE '%$email%' ORDER BY `PROJECT_ID` DESC, `ID` ASC LIMIT " . $startPage . ", 12 ";
  $totalRows = mysql_num_rows(mysql_query("SELECT `id` FROM `PROJECT_FOLLOWER` WHERE `FOLLOWER_EMAIL` LIKE '%$email%'", $connection));
}
$result = mysql_query($query, $connection);
if (!$result) {
  $message = 'Invalid query: ' . mysql_error() . "\n";
  $message .= 'Whole query: ' . $query;
  die($message);
}

$followerData = array();
$id_array     = array();
while ($subject = mysql_fetch_assoc($result)) {
  $followerData[] = $subject;
  array_push($id_array, $subject['PROJECT_ID']);
}
$id_array = array_unique($id_array);
$id_array = join(',', $id_array);




///////////////////////////////////////////////////////////////////////////////////////////
if ($tag == 'current') {
  $getProjectQuery = "SELECT  * FROM  `PROJECT` WHERE `ID` IN ($id_array) AND `PROGRESS_PERCENTAGE` < 100 ORDER BY `ID` DESC";
} else if ($tag == 'past') {
  $getProjectQuery = "SELECT  * FROM  `PROJECT` WHERE `ID` IN ($id_array) AND `PROGRESS_PERCENTAGE` >= 100 ORDER BY `ID` DESC";
} else if ($tag == 'followed') {
  $getProjectQuery = "SELECT  * FROM  `PROJECT` WHERE `ID` IN ($id_array) ORDER BY `ID` DESC";
}
$getProjectResult = mysql_query($getProjectQuery, $connection);
if (!$getProjectResult) {
  $message = 'Invalid query: ' . mysql_error() . "\n";
  $message .= 'Whole query: ' . $getProjectQuery;
  die($message);
}
$projectData = array();
while ($subject = mysql_fetch_assoc($getProjectResult)) {
  $projectData[] = $subject;
}

///////////////////////////////////////////////////////////////////////////////////////////

$getCreatorQuery  = "SELECT  * FROM  `PROJECT_CREATOR` WHERE `PROJECT_ID` IN ($id_array) ORDER BY  `ID` ASC";
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
$data = array(
  "projectData"  => $projectData,
  "followerData" => $followerData,
  "creatorData"  => $creatorData,
  "totalRows"    => $totalRows
);

echo (json_encode($data));
?>

<?php mysql_close($connection); ?>
