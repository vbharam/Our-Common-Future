<?php
session_start();
require 'fb_config.php';
include '../../includes/Bluehost_connect.php'; 

// if (isset($_REQUEST['error'])) {
//   header('Location: ./index.php?error_code=1');
// }
// if (!isset($_SESSION['uid'])) {
    $code = $_REQUEST["code"]; 
    $url = $_SERVER['REQUEST_URI'];
   // auth user
   if(empty($code)) {
      $dialog_url = 'https://www.facebook.com/dialog/oauth?client_id=' 
      . $app_id . '&redirect_uri=' . urlencode($app_url).'&scope=email' ;
      echo("<script>top.location.href='" . $dialog_url . "'</script>");
    }
    else{
  

    // get user access_token
    $token_url = 'https://graph.facebook.com/oauth/access_token?client_id='
      . $app_id . '&redirect_uri=' . urlencode($app_url) 
      . '&client_secret=' . $app_secret 
      . '&code=' . $code; 

    // response is of the format "access_token=AAAC..."
    $access_token = substr(file_get_contents($token_url), 13);

    // Exchanging temporary short lived access token with long lived access toke so it can be used later
    // response is of the format "access_token=AAAC...&expires=XXX"
    $long_lived_token_url = "https://graph.facebook.com/oauth/access_token?client_id=$app_id&client_secret=$app_secret&grant_type=fb_exchange_token&fb_exchange_token=$access_token"; 
    $long_lived_token = substr(file_get_contents($long_lived_token_url), 13);

    $start_pos = strrpos($long_lived_token, "&expires");
    $str_len = strlen($long_lived_token);
    $long_lived_token = substr($long_lived_token, -$str_len, $start_pos-$str_len);
    
    // Call Facebook Graph API to get user data
    $fql_query_url = 'https://graph.facebook.com/v2.0/me?fields=picture,id,name,email'
      . '&access_token=' . $access_token;
    $fql_query_result = file_get_contents($fql_query_url);
    $fql_query_obj = json_decode($fql_query_result, true);

   
    $user_id = $fql_query_obj['id'];
    $name = $fql_query_obj['name'];
    $email = $fql_query_obj['email'];
    $profile_pi_url =  $fql_query_obj['picture']['data']['url'];
    $access_token = $long_lived_token;



    // Checks DB and inserts the user if he is not already registered
    
    $checkUser = mysql_query("SELECT * FROM `USER_INFO` WHERE `EMAIL` ='".$email."'");
    $check = mysql_fetch_array($checkUser);
    if(!$check){
     $facebookQuery = "INSERT INTO `USER_INFO`(`SOCIAL_ID`,`SOCIAL_MEDIA_TYPE`,`ACCESS_TOKEN`,`NAME`,`PROFILE_PIC`,`EMAIL`) VALUES ('".$user_id."','FACEBOOK','".$access_token."','".$name."','".$profile_pi_url."','".$email."')";
     $facebookResult = mysql_query($facebookQuery,$connection);
     if(!$facebookResult){
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $facebookQuery;
        die($message);
        print_r($message);
     }

    
    $facebookFetchUID = "SELECT `ID` FROM `USER_INFO` WHERE `EMAIL`='".$email."'";
    $facebookFetchUIDresult = mysql_query($facebookFetchUID,$connection);
    if(!$facebookFetchUIDresult){
      $message  = 'Invalid query: ' . mysql_error() . "\n";
      $message .= 'Whole query: ' . $facebookFetchUID;
      die($message);
      echo $message;
    }else{
      if($subject = mysql_fetch_assoc($facebookFetchUIDresult)){
        $fuid = $subject['ID'];
        $_SESSION['uid'] = $fuid; 
        $_SESSION['name'] = $fql_query_obj['name'];
        $_SESSION['email'] = $fql_query_obj['email'];
        header('Location: ./../../../index.php');
      }
    }

    }else{
      $facebookFetchUID = "SELECT * FROM `USER_INFO` WHERE `EMAIL`='".$email."'";
      $facebookFetchUIDresult = mysql_query($facebookFetchUID,$connection);
      if(!$facebookFetchUIDresult){
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $facebookFetchUID;
        die($message);
        echo $message;
      }else{
        if($subject = mysql_fetch_assoc($facebookFetchUIDresult)){
          $_SESSION['uid'] = $subject['ID'];
          $_SESSION['name'] = $subject['NAME'];
          $_SESSION['email'] = $subject['EMAIL'];
          header('Location: ./../../../index.php');
        }
      }
    }
}
// }else{
//   echo "not";
 // header('Location: ./index.php');
// }
?>
