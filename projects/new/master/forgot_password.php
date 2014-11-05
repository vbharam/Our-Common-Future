<?php
ob_start();
session_start();
include("../configuration/connect.php");
	$errmsg="";
	
	if(isset($_POST['forgot_password']))
	{
		$email=mysql_real_escape_string($_POST['email']);
		$admres=mysql_query("select * from admin where `email`='$email' and id='1'");
		if(mysql_num_rows($admres)>0)
		{
		$adm=mysql_fetch_array($admres);
			$loc="forgot_password.php";
			
			$admin=mysql_fetch_array(mysql_query("select * from admin where id='1'"));

			
			$to = $_POST["email"];
			$subject = "Password Recovery";
			$headers = "From:" .$admin["email"]. "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
			$message ='
	<table style="font-family: Verdana; font-size: 12px;" cellpadding="10" width="100%" cellspacing="0">
							<tr>	
								<td style="font-family: Verdana; font-size: 12px;">
									<b>Dear '.$adm["username"].',</b><br><br>
									
									<b><u>Password Recovery Details:</u></b><br>
									<br>
									<b>Password</b>: '.$adm["password"].'
									<br><br><br>
									
									<b>Regards,<br>
									Team.</b>
								</td>
							</tr>';
							
							
	$message .='</table>';
						
		mail($to, $subject, $message, $headers);
	
			
		//	header("location:$loc");
		$msg="You password send to your mail";
		}
		else
		{
			$msg="Email id not exists";
		}
	}	
?>
<!DOCTYPE html>
<html lang="en" class="no-js">



<head>
    <title>Forgot Password | Admin</title>
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
                        <input type="text" placeholder="email" name="email" class="form-control">
                        <span class="input-group-addon"><i class="fa fa-user"></i>
                        </span>
                    </div>
                    
                    
                    <button class="btn btn-custom-primary btn-lg btn-block btn-login" name="forgot_password"><i class="fa fa-arrow-circle-o-right"></i> Forgot Password</button>
                </form>

                
            </div>
        </div>

        <?php include "footer.php";?>

    </div>

    <!-- Javascript -->
    <script type="text/javascript" src="assets/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/modernizr.js"></script>

</body>



</html>