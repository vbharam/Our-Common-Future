<?php 
ob_start();
session_start();
include 'projects/includes/Bluehost_connect.php';

if($_GET["doaction"]=="login")
{
	$email=$_GET["email"];
	$password=$_GET["password"];
	
		$login_query=mysql_query("select * from USER_INFO where EMAIL='$email' and PASSWORD='$password' and EMAIL!='' and PASSWORD!=''");
		$login_info=mysql_fetch_array($login_query);
		
		if($login_info["ID"]=="")
		{
			echo '0';
		}
		else
		{
			$_SESSION["uid"]=$login_info["ID"];
			$_SESSION["email"]=$login_info["EMAIL"];
			$_SESSION["name"] = $login_info["NAME"];
			echo '1';
		}	
}

if($_GET["doaction"]=="signup_chk")
{
	$email=$_GET["email"];

		$signup_query=mysql_query("select EMAIL from USER_INFO where EMAIL='$email' and EMAIL!=''");
		$num_rows = mysql_num_rows($signup_query);
		// $signup_info=mysql_fetch_array($signup_query);
		if($num_rows==0)
		{
			echo '0';
		}
		else
		{
			echo '1';
		}	
}

if($_GET["doaction"]=="signup")
{
	$email=$_GET["email"];
	$org_password=$_GET["password"];
	$md5_password=md5($_GET["password"]);
	$name=$_GET["name"];
	
	$signupInsert =  mysql_query("insert into  USER_INFO(NAME,EMAIL,PASSWORD,HASH_PASSWORD) values('$name','$email','$org_password','$md5_password')") or die(mysql_error());

	$login_query=mysql_query("select * from USER_INFO where EMAIL='$email' and PASSWORD='$password' and EMAIL!='' and PASSWORD!=''");
	$login_info=mysql_fetch_array($login_query);
	
	if($login_info["ID"]=="")
	{
		echo '0';
	}
	else
	{
		$_SESSION["uid"]=$login_info["ID"];
		$_SESSION["email"]=$login_info["EMAIL"];
		$_SESSION["name"] = $login_info["NAME"];
		echo '1';
	}
}


?>