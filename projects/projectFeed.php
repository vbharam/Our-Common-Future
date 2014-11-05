<?php
include 'includes/Bluehost_connect.php';
?>


<?php
// Storing the received information
$email            = $_POST['email'];
$sortByIndex      = $_POST['sortByIndex'];
$sortDate         = $_POST['date'];
$sortBudget       = $_POST['budget'];
$sortCategory     = $_POST['category'];
$searchPageNumber = $_POST['page'];
$tag              = $_POST['tag'];
$totalRowsResult  = mysql_query("SELECT `id` FROM `PROJECT` WHERE `PUBLISH_STATUS`='now' ", $connection);
$totalRows        = mysql_num_rows($totalRowsResult);
$startPage        = $totalRows - ($searchPageNumber) * 12;
$count            = 12;
if ($startPage < 0) {
  $count     = $startPage + 12;
  $startPage = 0;
}
if (($sortByIndex == "" || $sortByIndex == null) && $searchPageNumber != "") {
  $query = "SELECT  * FROM  `PROJECT` WHERE `PUBLISH_STATUS`='now' ORDER BY `ID` ASC LIMIT " . $startPage . ", " . $count . " ";
} else {
  if ($sortByIndex == 0) {
    if ($sortDate == "newest") {
      $query = "SELECT  * FROM  `PROJECT` WHERE `PUBLISH_STATUS`='now' ORDER BY `DATETIME` ASC LIMIT " . $startPage . ", " . $count . " ";
    } else
      $query = "SELECT  * FROM  `PROJECT` WHERE `PUBLISH_STATUS`='now' ORDER BY `DATETIME` DESC LIMIT " . $startPage . ", " . $count . " ";
  } else if ($sortByIndex == 1) {
    if ($sortBudget == "high-to-low") {
      $query = "SELECT  * FROM  `PROJECT` WHERE `PUBLISH_STATUS`='now' ORDER BY `FUNDING` ASC LIMIT " . $startPage . ", " . $count . " ";
    } else
      $query = "SELECT  * FROM  `PROJECT` WHERE `PUBLISH_STATUS`='now' ORDER BY `FUNDING` DESC LIMIT " . $startPage . ", " . $count . " ";
  } else if ($sortByIndex == 2) {
    $totalRowsResult = mysql_query("SELECT  * FROM  `PROJECT` WHERE `CATEGORY` LIKE '%$sortCategory%' OR '$sortCategory' LIKE '%CATEGORY%' ORDER BY `ID` ASC ", $connection);
    $totalRows       = mysql_num_rows($totalRowsResult);
    $startPage        = $totalRows - ($searchPageNumber) * 12;
    $count            = 12;
    if ($startPage < 0) {
      $count     = $startPage + 12;
      $startPage = 0;
    }
    $query = "SELECT  * FROM  `PROJECT` WHERE `CATEGORY` LIKE '%$sortCategory%' OR '$sortCategory' LIKE '%CATEGORY%' ORDER BY `ID` ASC LIMIT " . $startPage . ", " . $count . "";
  }
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
$projectData  = array_reverse($projectData);
$id_array     = array_reverse($id_array);
$id_array     = join(',', $id_array);
$creatorData  = array();
$followerData = array();

if (sizeof($projectData) != 0) {
  
  ///////////////////////////////////////////////////////////////////////////////////////////
  
  $getCreatorQuery  = "SELECT  * FROM  `PROJECT_CREATOR` WHERE `PROJECT_ID` IN ($id_array) ORDER BY `PROJECT_ID` DESC, `ID` ASC";
  $getCreatorResult = mysql_query($getCreatorQuery, $connection);
  if (!$getCreatorResult) {
    $message = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $getCreatorQuery;
    die($message);
  }
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
  while ($subject = mysql_fetch_assoc($getFollowerResult)) {
    $followerData[] = $subject;
  }
}

///////////////////////////////////////////////////////////////////////////////////////////	

$data = array(
  "projectData"  => $projectData,
  "creatorData"  => $creatorData,
  "followerData" => $followerData,
  "totalRows"    => $totalRows
);

echo (json_encode($data));

// Release the returned projectData 
mysql_free_result($result . $getCreatorResult . $getFollowerResult);
?>

<?php
mysql_close($connection);
?>
