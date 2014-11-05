
<?php
	$server = "localhost";
	$username="codecoop_UWCnext";
	$password="UWCnext2013";
	$database="AWS_UWCnext";

	// 1. Create a database connection
	$connection= mysql_connect($server,$username,$password,$database)or die( "didnt make a connection");

	// 2. Select a database to use
	@mysql_select_db($database) or die( "Unable to select database");
?>
