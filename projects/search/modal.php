	<head>
	<title>UWC NEXT</title>
	<meta charset="utf-8">
	<link rel="icon" href="http://dzyngiri.com/favicon.png" type="image/x-icon">
  <link rel="shortcut icon" href="http://dzyngiri.com/favicon.png" type="image/x-icon" />
  <meta name="description" content="Codester is a free responsive Bootstrap template by Dzyngiri">
  <meta name="keywords" content="free, template, bootstrap, responsive">
  <meta name="author" content="Inbetwin Networks">  
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/modal.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/responsive.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/touchTouch.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/kwicks-slider.css" type="text/css" media="screen">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:205,300' rel='stylesheet' type='text/css'>
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css" rel="stylesheet">

  <script id="metamorph-1-start" type="text/x-placeholder"></script><script id="metamorph-21-start" type="text/x-placeholder"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/superfish.js"></script>
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
	<script type="text/javascript" src="js/jquery.kwicks-1.5.1.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/jquery.cookie.js"></script>    
	<script type="text/javascript" src="js/touchTouch.jquery.js"></script>
	<script type="text/javascript">if($(window).width()>1024){document.write("<"+"script src='js/jquery.preloader.js'></"+"script>");}	</script>

	<!-- PHP files -->
		<?php include 'modal.php'; ?> <!-- Includes all modal (login, signup, contact, feedback) -->
		<?php include 'updateProfile.php'; ?>  <!-- Update user profile -->



	<script>		
		jQuery(window).load(function() {	
			$x = $(window).width();		
			if($x > 1024)
			{ jQuery("#content .row").preloader();    }	
				 
		  jQuery('.magnifier').touchTouch();			
		  jQuery('.spinner').animate({'opacity':0},1000,'easeOutCubic',function (){jQuery(this).css('display','none')});	
  	}); 				
	</script>
</head>


<div class="modal fade" id="loginModal" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal"> &times; </button>
        <h1 class="brand brand_"><a href="index.php"><img alt="" src="img/UWCnext-1420x280.gif" style="width:200px; height:40px;" > </a></h1>
      </div>
      <div class="modal-body">
        <h4 style="margin: 0 0 20px 50%">Login</h4>
        <form id="loginForm" class="form-horizontal" role="form">
          <div class="form-group">
            <label type="email" for="inputEmail" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputEmail" placeholder="Email">
            </div>
          </div>
          <br>
          <div class="form-group">
          <!-- <p id="passwordWarning" style="margin:0 0 0 115px;" style="display:none;"><small class="text-muted">Password must be at least 8 characters and contain UPPERCASE and numbers.</small></p> -->
            <label for="inputPassword" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="inputPassword" placeholder="Password">
            </div>
          </div>
          <div class="alert alert-danger" style="display:none; margin-left:95px" id="incorrect">Incorrect email and password combination!</div>
          
          <div id="error_msg"></div>
          
          <?php /*?><div class="form-group" style="margin-bottom: auto">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label><input type="checkbox"> Remember me</label>
              </div>
             </div>
          </div><?php */?>
          <div style="text-align: center;" id="bigCallout">
              <!-- <div class="alert alert-warning alert-block fade in" id="emailAlert">
                <button type="button" class="close" data-dismiss="alert"> x </button>
                <h4 style="text-align:center">Enter Email</h4>
                <hr>
                <form id="passwordReset" class="form-horizontal" role="form" method="post" role="form">
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                    <input  type="submit" id="passwordResetSubmit" class="btn btn-warning"  value="Request Password Reset" onclick="passwordReset(this)">
                  </div>
                </form>

            </div>  end alert -->
            <a href="#" onClick="window.open('http://www.codecoop.net/vishal/UWC-NEXT/forgot.php', '_blank')" class="btn btn-link" id="alertMe" style="margin-left: -10px">Forgot your password? Click here!</a>
          </div> <!-- end bigCallout -->
        </form>
      </div>
      <div id="signinButton" style="margin-left:50px;">
        <span
          class="g-signin"
          data-callback="signinCallback"
          data-clientid="462719874774-r5k0hsf8ihp7p2vsh68hgmuhcbvg88ei.apps.googleusercontent.com"
          data-cookiepolicy="single_host_origin"
          data-requestvisibleactions="http://schemas.google.com/AddActivity"
          data-scope="https://www.googleapis.com/auth/plus.login">
        </span>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
        <button id="loginButton" class="btn btn-primary" type="button" onClick="login(this)"> LOG IN </button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="signUpModal" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal"> &times; </button>
        <h1 class="brand brand_"><a href="index.php"><img alt="" src="img/UWCnext-1420x280.gif" style="width:200px; height:40px;" > </a></h1>
      </div>
      <div class="modal-body">
        <h4 style="margin: 0 0 20px 50%">Sign Up</h4>
        <form id="signUpForm" class="form-horizontal" role="form">
          <div id="signUpDiv" class="form-group" >
            <label for="signup_username" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <input type="name" class="form-control" id="signup_username" placeholder="Name">
                  <span class="name_error"></span>
            </div>
          </div>
          <div class="form-group">
            <label type="email" for="signup_email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="signup_email" placeholder="Email">
              <span class="email_error"></span>
             </div>
          </div>
          <div class="form-group">
            <p id="passwordWarning" style="margin:0 0 0 115px;" style="display:none;"><small class="text-muted" ><?php /*?>Password must be at least 8 characters and contain UPPERCASE and numbers.<?php */?></small></p>
            <label for="signup_password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="signup_password" placeholder="Password">
              <span class="pass_error"></span>
            </div>
          </div>
        </form>
      </div>

      <div id="thirdPartySignUp"></div>

      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
        <button id="signUpButton" class="btn btn-primary" type="button" onClick="signup(this)"> Sign Up </button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript"> 
  	window.uid = <?php echo json_encode($_SESSION['uid']);?>;
  	window.userEmail = <?php echo json_encode($_SESSION["email"]);?>;
</script>
