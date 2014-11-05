<?php include 'includes/Bluehost_connect.php'; ?>


<?php 	
	// Storing the received information
	$sortByLocation = addslashes( $_POST['sortLocation'] );
	$query = "SELECT  * FROM  `PROJECT` WHERE `LOCATION` LIKE '%$sortByLocation%' OR `COUNTRY` LIKE '%$sortByLocation%' ORDER BY `ID` DESC LIMIT 10";
	$result = mysql_query($query,$connection);
	if (!$result) { 
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    die($message);
	}

	$projectData = array();
	$id_array = array();
	while ($subject = mysql_fetch_assoc( $result)){ 
	$projectData[] = $subject;
	array_push($id_array, $subject['ID']); 
	}
	$id_array = join(',',$id_array); 

	$creatorData = array();
	$followerData = array();

	if (sizeof($projectData) != 0){

	///////////////////////////////////////////////////////////////////////////////////////////

		$getCreatorQuery = "SELECT  * FROM  `PROJECT_CREATOR` WHERE `PROJECT_ID` IN ($id_array) ORDER BY `PROJECT_ID` DESC, `ID` ASC";
		$getCreatorResult = mysql_query($getCreatorQuery,$connection);
		if (!$getCreatorResult) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $getCreatorQuery;
		    die($message);
		}

		while ($subject = mysql_fetch_assoc( $getCreatorResult)){ 
			$creatorData[] = $subject;
		}

		///////////////////////////////////////////////////////////////////////////////////////////

		$getFollowerQuery = "SELECT  * FROM  `PROJECT_FOLLOWER` WHERE `PROJECT_ID` IN ($id_array) ORDER BY `PROJECT_ID` DESC, `ID` ASC";
		$getFollowerResult = mysql_query($getFollowerQuery,$connection);
		if (!$getFollowerResult) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $getFollowerQuery;
		    die($message);
		}
		
		while ($subject = mysql_fetch_assoc( $getFollowerResult)){ 
			$followerData[] = $subject;
		}
	}

	///////////////////////////////////////////////////////////////////////////////////////////	
	$totalRowsResult = mysql_query( "SELECT `id` FROM `PROJECT`", $connection);
	$totalRows = mysql_num_rows( $totalRowsResult) ; 

	$data= array(
	"projectData"=> $projectData,
	"creatorData"=> $creatorData,
	"followerData"=> $followerData,
	"totalRows" => $totalRows,
	);

	echo(json_encode($data));
	
	// Release the returned projectData 
	mysql_free_result($result.$getCreatorResult.$getFollowerResult);
?>

<?php 	mysql_close($connection); ?>