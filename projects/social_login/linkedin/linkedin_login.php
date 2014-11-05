<?php
session_start();
require ('../../includes/Bluehost_connect.php');

require 'linkedin.php';
require 'linkedin_config.php';


$config = array('api_key' => $api_key, 'api_secret' => $api_secret, 'callback_url' => $callback_url);

$connection1 = new LinkedIn($config);
// print_r($connection1);

// echo "hi";

if (isset($_REQUEST['code'])) {
  $code = $_REQUEST['code'];
  $access_token = $connection1->getAccessToken($code);
  $connection1->setAccessToken($access_token);
  $user = $connection1->get("people/~:(id,first-name,last-name,email-address,headline,picture-url)");
  $user_id = $user['id']; 
  $first_name = $user['firstName']; 
  $last_name = $user['lastName'];
  $name = $first_name . ' ' . $last_name;
  $email = $user['emailAddress']; 
  $headline = $user['headline']; 
  $picture_url = $user['pictureUrl']; 
  
  $checkUser = mysql_query("SELECT * FROM `USER_INFO` WHERE EMAIL='".$email."'");
  $check = mysql_fetch_array($checkUser);
  if(!$check){
    $linkedinQuery = "INSERT INTO `USER_INFO`(`SOCIAL_ID`,`SOCIAL_MEDIA_TYPE`,`NAME`,`BIO`,`PROFILE_PIC`,`EMAIL`) VALUES ('".$user_id."','LinkedIn','".$name."','".$headline."','".$picture_url."','".$email."')";
    $linkedinResult = mysql_query($linkedinQuery,$connection);
    if(!$linkedinResult){
      $message  = 'Invalid query: ' . mysql_error() . "\n";
      $message .= 'Whole query: ' . $linkedinQuery;
      die($message);
      print_r($message);
    }
     $linkedinFetchUID = "SELECT `ID` FROM `USER_INFO` WHERE `EMAIL`='".$email."'";
    $linkedinFetchUIDresult = mysql_query($linkedinFetchUID,$connection);
    if(!$linkedinFetchUIDresult){
      $message  = 'Invalid query: ' . mysql_error() . "\n";
      $message .= 'Whole query: ' . $linkedinFetchUID;
      die($message);
      echo $message;
    }else{
      if($subject = mysql_fetch_assoc($linkedinFetchUIDresult)){
        $guid = $subject['ID'];
        $_SESSION['uid'] = $guid; 
        header('Location: ./../../../index.php');
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
      }
    }


  } else {
    $linkedinFetchUID = "SELECT * FROM `USER_INFO` WHERE `EMAIL`='".$email."'";
    $linkedinFetchUIDresult = mysql_query($linkedinFetchUID,$connection);
    if(!$linkedinFetchUIDresult){
      $message  = 'Invalid query: ' . mysql_error() . "\n";
      $message .= 'Whole query: ' . $linkedinFetchUID;
      die($message);
      echo $message;
    }else{
      if($subject = mysql_fetch_assoc($linkedinFetchUIDresult)){
        $_SESSION['uid'] = $subject['ID'];
        $_SESSION['name'] = $subject['NAME'];
        $_SESSION['email'] = $subject['EMAIL'];
        header('Location: ./../../../index.php');
    
      }
    }
  }

} else {
  // print_r("reaching here");
  if (isset($_REQUEST['error'])) {
    header('Location: ./index.php?error_code=1');
  } else {
    $authUrl = $connection1->getLoginUrl($scope);
    header("Location: $authUrl");
  }
}

?>