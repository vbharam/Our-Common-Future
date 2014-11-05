<?php
session_start();
require_once 'Google/Client.php';
require_once 'Google/Service/Oauth2.php';
require_once 'google_config.php';
require_once ('../../includes/Bluehost_connect.php');

$client = new Google_Client();
$client->setScopes(array(
  "https://www.googleapis.com/auth/plus.me",
  "https://www.googleapis.com/auth/userinfo.email"
));
$google_oauthV2 = new Google_Service_Oauth2($client);

$client->setRedirectUri("https://www.ocf.co/projects/social_login/googlePlus/oauth2callback.php");
$client->setClientId("338782983474-pkooj5rtomqba1o4l9p55f3di737sa07.apps.googleusercontent.com");
$client->setClientSecret("unFW1l-2z4jMGxsa2s--DlEK");
if (isset($_REQUEST['code'])) {
	$authCode = $_REQUEST['code'];
	$client->authenticate($authCode);
	$user = $google_oauthV2->userinfo->get();
	

// print_r($authUrl);
	$checkUser = mysql_query("SELECT * FROM `USER_INFO` WHERE `EMAIL` = '".$user->email."'");
  $check = mysql_fetch_array($checkUser);
  if(!$check) {
  	$googleQuery = "INSERT INTO `USER_INFO`(`SOCIAL_ID`,`SOCIAL_MEDIA_TYPE`,`NAME`,`PROFILE_PIC`,`EMAIL`) VALUES ('".$user->id."','GMAIL','".$user->name."','".$user->picture."','".$user->email."')";
  	$googleResult = mysql_query($googleQuery,$connection);
  	if(!$googleResult){
      $message  = 'Invalid query: ' . mysql_error() . "\n";
      $message .= 'Whole query: ' . $googleQuery;
      die($message);
      echo $message;
    }



    $googleFetchUID = "SELECT `ID` FROM `USER_INFO` WHERE `EMAIL`='".$user->email."'";
    $googleFetchUIDresult = mysql_query($googleFetchUID,$connection);
    if(!$googleFetchUIDresult){
      $message  = 'Invalid query: ' . mysql_error() . "\n";
      $message .= 'Whole query: ' . $googleFetchUID;
      die($message);
      echo $message;
    }else{
      if($subject = mysql_fetch_assoc($googleFetchUIDresult)){
        $guid = $subject['ID'];
        $_SESSION['uid'] = $guid; 
        header('Location: ./../../../index.php');
        $_SESSION['name'] = $user->name;
        $_SESSION['email'] = $user->email;
        $_SESSION['profile_pic_url'] = $user->picture;
      }
    }

    

  } else {
      $googleFetchUID = "SELECT * FROM `USER_INFO` WHERE `EMAIL`='".$user->email."'";
    $googleFetchUIDresult = mysql_query($googleFetchUID,$connection);
    if(!$googleFetchUIDresult){
      $message  = 'Invalid query: ' . mysql_error() . "\n";
      $message .= 'Whole query: ' . $googleFetchUID;
      die($message);
      echo $message;
    }else{
      if($subject = mysql_fetch_assoc($googleFetchUIDresult)){
        $_SESSION['uid'] = $subject['ID'];
        $_SESSION['name'] = $subject['NAME'];
        $_SESSION['email'] = $subject['EMAIL'];
        header('Location: ./../../../index.php');
    
      }
    }

    

    }
} else {
		if (isset($_REQUEST['error'])) {
			header('Location: ./index.php?error_code=1');
		}	else {
			$authUrl = $client->createAuthUrl();
			header("Location: $authUrl");
		}
}

?>