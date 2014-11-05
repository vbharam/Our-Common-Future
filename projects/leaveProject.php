<?php include 'includes/Bluehost_connect.php'; ?>

<?php 	

	$email = $_POST['email'];
	$projectId = $_POST['projectId'];
	$password = $_POST['password'];
	$action = $_POST['action'];


	if( $email != "" && $projectId != "" && $action=="leave") {		
		$query = "DELETE FROM `PROJECT_CREATOR` WHERE `CREATOR_EMAIL` LIKE '$email' AND `PROJECT_ID` = '".$projectId."' ";
	} else if ( $email != "" && $projectId != "" && $action=="delete") {	
		$query1 = "DELETE FROM `PROJECT` WHERE `ID` = '".$projectId."' ";
		$query2 = "DELETE FROM `PROJECT_CREATOR` WHERE `PROJECT_ID` = '".$projectId."' ";
		$query3 = "DELETE FROM `PROJECT_FOLLOWER` WHERE `PROJECT_ID` = '".$projectId."' ";
		$query4 = "DELETE FROM `PROJECT_REPLY` WHERE `PROJECT_ID` = '".$projectId."' ";
		$query5 = "DELETE FROM `PROJECT_SUPPORTER` WHERE `PROJECT_ID` = '".$projectId."' ";
		$query6 = "DELETE FROM `PROJECT_UPDATES` WHERE `PROJECT_ID` = '".$projectId."' ";
		$queryArray = array( $query1, $query2, $query3, $query4, $query5, $query6);

		for ($i=0; $i <=5 ; $i++) { 	
			$query = $queryArray[$i];				
			$result = mysql_query($query,$connection);
			if (!$result) { 
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $query;
			    die($message);
			}
		} 	
	} else if ( $email != "" && $password != "" && $action=="confirm") {	
		$userInfoQuery  = "SELECT * FROM `USER_INFO` WHERE `EMAIL`= '$email' ";
	  $userInfoResult = mysql_query($userInfoQuery, $connection);
	  if (!$userInfoResult) {
	    $message = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $userInfoQuery;
	    die($message);
	  } 
	  if ($subject=mysql_fetch_assoc($userInfoResult)){
	  	$hashPassword = $subject['HASH_PASSWORD'];
	  	if (md5($password) == $hashPassword){
	  		echo(json_encode(1));
	  	} else {
	  		echo(json_encode(0));
	  	}
	  }

	}

	mysql_close($connection);

?>