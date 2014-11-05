<?php include 'includes/Bluehost_connect.php'; ?>


<?php
	// Getting search information from the database
	
	$search_input = $_POST['searchInput'];
	
	if (!isset($search_input)){
		header("Location: index.php");
	}

	if ($search_input != ''){

		$data = mysql_fetch_object(mysql_query("SELECT  COUNT(id) AS num_rows FROM  `PROJECT` WHERE `NAME` LIKE '%$search_input%' OR `LOCATION` LIKE '%$search_input%'
				OR `CATEGORY` LIKE '%$search_input%' OR `COUNTRY` LIKE '%$search_input%'"));
		$totalRows = $data->num_rows;
		$projectData = array();
		$creatorData = array();
		$advisorData = array();

		if ($totalRows > 0) {
			// $startPage = $totalRows - ($searchPageNumber)*12;
			// $count = 12;
			// if ($startPage <0){
			// 	$count = $startPage + 12;
			// 	$startPage = 0;
			// }
			$query = "SELECT  * FROM  `PROJECT` WHERE `NAME` LIKE '%$search_input%' OR `LOCATION` LIKE '%$search_input%'
				OR `CATEGORY` LIKE '%$search_input%' OR `COUNTRY` LIKE '%$search_input%' ORDER BY `ID` DESC";
				 // UNION ALL SELECT  * FROM  `PROJECT_CREATOR` WHERE `CREATOR_NAME` LIKE '%$search_input%'
		 
			$result = mysql_query($query,$connection);
			if (!$result) { 
				$message  = 'Invalid query: ' . mysql_error() . "\n";
				$message .= 'Whole query: ' . $query;
				die($message);
			}
			
			$id_array = array();
			while ($subject = mysql_fetch_assoc( $result)){ 
			$projectData[] = $subject;
			array_push($id_array, $subject['ID']); 
			}
			$id_array = join(',',$id_array); 


		
			$creatorData = array();
			$followerData = array();

			if (!empty($projectData)) {
  
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
	}
}

		///////////////////////////////////////////////////////////////////////////////////////////	
			$data= array(
			"projectData"=> $projectData,
			"creatorData"=> $creatorData,
			"followerData"=> $followerData,
			"totalRows" => $totalRows,
			);

			echo(json_encode($data));
			
?>

<?php 	mysql_close($connection); ?>