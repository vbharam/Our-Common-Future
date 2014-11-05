<?php
ob_start();
session_start();
include("../configuration/connect.php");
	$errmsg="";
	$headermess='Please Login In';
	
	if(isset($_POST['login']))
	{
		$name=mysql_real_escape_string($_POST['username']);
		$apwd=mysql_real_escape_string($_POST['password']);
		$admres=mysql_query("select id,username from admin where `username`='$name' and `password`='$apwd'");
		if(mysql_num_rows($admres)>0)
		{
		$adm=mysql_fetch_row($admres);
			$loc="account.php";
			$_SESSION['aid']=$adm[0];
			$_SESSION["username"]=$adm[1];
			header("location:$loc");
		}
		else
		{
			$msg="Login Fail ! Please try again!";
		}
	}	
?>
<!DOCTYPE html>
<html lang="en" class="no-js">


<!-- Mirrored from demo.thedevelovers.com/dashboard/kingboard/page-login.html by HTTrack Website Copier/3.x [XR&CO'2013], Tue, 04 Mar 2014 10:57:10 GMT -->
<head>
    <title>Login | Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Kingboard - Bootstrap Admin Dashboard Theme">
    <meta name="author" content="The Develovers">

    <!-- CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/main.min.css" rel="stylesheet" type="text/css">

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/kingboard-favicon144x144.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/kingboard-favicon114x114.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/kingboard-favicon72x72.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="assets/ico/kingboard-favicon57x57.png">
    <link rel="shortcut icon" href="assets/ico/favicon.png">
	<link rel="stylesheet" href="assets/fonts/ptsans/stylesheet.css" type="text/css" charset="utf-8" />
</head>

<body>
    <div class="full-page-wrapper page-login text-center">

        <div class="inner-page">

            <div class="logo">
                <h2>Admin Panel</h2>
            </div>
          

            <div class="login-box center-block">
                <form id="form1" name="form1" method="post" action="">
                 <p class="err"><?php echo @$msg ?></p>
                    <div class="input-group">
                        <input type="text" placeholder="username" name="username" class="form-control">
                        <span class="input-group-addon"><i class="fa fa-user"></i>
                        </span>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" placeholder="password" class="form-control">
                        <span class="input-group-addon"><i class="fa fa-lock"></i>
                        </span>
                    </div>
                    
                    <button class="btn btn-custom-primary btn-lg btn-block btn-login" name="login"><i class="fa fa-arrow-circle-o-right"></i> Login</button>
                </form>

                <div class="links">
                    <p><a href="forgot_password.php">Forgot Username or Password?</a>
                    </p>
                    
                </div>
            </div>
        </div>

        <?php include "footer.php";?>

    </div>

    <!-- Javascript -->
    <script type="text/javascript" src="assets/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/modernizr.js"></script>

</body>


<!-- Mirrored from demo.thedevelovers.com/dashboard/kingboard/page-login.html by HTTrack Website Copier/3.x [XR&CO'2013], Tue, 04 Mar 2014 10:57:10 GMT -->
</html>