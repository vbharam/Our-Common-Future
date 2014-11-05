<?php
include_once('global.php');
$connhandle=mysql_connect($Global['host'],$Global['username'],$Global['password'])or die('can\'t establish connection with mysql');
$dbSelect=mysql_select_db($Global['database'],$connhandle) or die('could not connect to the database');
?>
