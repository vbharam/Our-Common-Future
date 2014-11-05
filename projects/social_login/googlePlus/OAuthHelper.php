<?php
include_once 'bootstrap.php';
require_once 'Google/Client.php';

$client = new Google_Client();
$client->setScopes(array(
  "https://www.googleapis.com/auth/plus.me",
));

$client->setRedirectUri($RedirectUri);
$client->setClientId($ClientId);
$client->setClientSecret($ClientSecret);

$authUrl = $client->createAuthUrl();
header("Location: $authUrl");
?>
