<?php
/*
 * Take the user when they return from Twitter. Get access tokens.
 * Verify credentials and redirect to based on response from Twitter.
 */

/* Start session and load lib */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('twitter_config.php');
require_once('../../includes/Bluehost_connect.php'); 


/* If the oauth_token is old redirect to the connect page. */
if (isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) {
  $_SESSION['oauth_status'] = 'oldtoken';
  header('Location: ./clearsessions.php');
}

/* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
$twitter_connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

/* Request access tokens from twitter */
$access_token = $twitter_connection->getAccessToken($_REQUEST['oauth_verifier']);

$oauth_token = $access_token['oauth_token'];
$oauth_token_secret = $access_token['oauth_token_secret'];

/* Create a TwitterOauth object with consumer/user tokens. */
$twitter_connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);

/* If method is set change API call made. Test is called by default. */
$user_data = $twitter_connection->get('account/verify_credentials');

$user_id = $_SESSION['uid'] = $user_data['id_str'];
$user_name = $_SESSION['name'] = $user_data['name'];
$user_pic_url = $_SESSION['user_pic_url'] = $user_data['profile_image_url'];

// print_r($user_data);
// $twitter_users=mysqli_query($connection,"SELECT * FROM twitter_users WHERE id=".$user_data['id_str']);
// if(mysqli_num_rows($twitter_users) == 0)
// {
// 	mysqli_query($connection,"INSERT into twitter_users VALUES ($user_id,'$user_name','$oauth_token','$oauth_token_secret','$user_pic_url');");
// }

$checkUser = mysql_query("SELECT * FROM `USER_INFO` WHERE `SOCIAL_ID`='".$user_id."'");
    $check = mysql_fetch_array($checkUser);
    if(!$check){
     $twitterQuery = "INSERT INTO `USER_INFO`(`SOCIAL_ID`,`NAME`,`PROFILE_PIC`) VALUES ('".$user_id."','".$user_name."','".$user_pic_url."')";
     $twitterResult = mysql_query($twitterQuery,$connection);
     if(!$twitterResult){
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $twitterQuery;
        die($message);
     }
         print_r($message);

    }else{
        header('Location: ./../../index.php');
        // print_r($user_id." user--exists");
    }

/* If HTTP response is 200 continue otherwise send to connect page to retry */
if (200 == $twitter_connection->http_code) {
  /* The user has been verified and the access tokens can be saved for future use */
  header('Location: ./../../index.php');
} else {
  echo "Error signing in";
}
