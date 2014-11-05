<?php include 'includes/Bluehost_connect.php'; ?>

<?php 	
	$name = $_POST['name'];
    $email = $_POST['email'];
    $password = htmlspecialchars($_POST['password']);

	// Hash the password with the salt
	$hash = md5($password);

	// Value:
	// $2a$10$eImiTXuWVxfM37uY4JANjOL.oTxqp7WylW7FCzx2Lc7VLmdJIddZq

	if($name!=="") {
		$loginQuery = "INSERT INTO `USER_INFO`(`ID`,`NAME`, `EMAIL`, `PASSWORD`, `HASH_PASSWORD`)
			VALUES('".$id."','".$name."','".$email."','".$password."', '".$hash."')";
		
		$loginResult = mysql_query($loginQuery,$connection);
		if (!$loginResult) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $loginQuery;
		    die($message);
		}
		echo(json_encode(2));
	} else if($name=="") {
		$fetchId = "SELECT `HASH_PASSWORD` FROM  `USER_INFO` WHERE `EMAIL`= '$email' ORDER BY `ID` DESC LIMIT 1";
		$fetchIdresult = mysql_query($fetchId,$connection);
		if (!$fetchIdresult) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $fetchId;
		    die($message);
		}
		while ($subject = mysql_fetch_assoc( $fetchIdresult)){ 
			$HASH_PASSWORD = $subject['HASH_PASSWORD'];
			$EMAIL = $subject['EMAIL'];
		}
		if($hash==$HASH_PASSWORD) {
			session_start();
			$_SESSION['login'] = "1";
			header ("Location: index.php");
			echo(json_encode(1));
		} else {
			$errorMessage = "Invalid Login";
			session_start();
			$_SESSION['login'] = '';
			echo(json_encode(0));
		}
	}
	
	mysql_free_result($loginResult);
	
?>

<?php 	mysql_close($connection); ?>