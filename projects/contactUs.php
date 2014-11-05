<?php 
ob_start();
session_start();
include 'includes/Bluehost_connect.php'; 
?>

<?php
	// Get info asociated with the user	
	$uid = $_SESSION["uid"];
	if ($uid !="" || $uid !=null) {
		$userQuery = "SELECT * FROM `USER_INFO` WHERE `ID` = '".$_SESSION["uid"]."'";
		$userInfoResult = mysql_query($userQuery,$connection);
		if (!$userInfoResult) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $userQuery;
	    die($message);
		}
		while ($subject = mysql_fetch_assoc($userInfoResult)) { 
			$name = ($subject['NAME']);
			$country = ($subject['COUNTRY']);
			$uwc = ($subject['UWC']);
			$uwcYear=($subject['UWC_YEAR']);
			$languages = ($subject['LANGUAGES']);
			$skills = ($subject['SKILLS']);
			$bio = ($subject['BIO']);
			$phone = ($subject['PHONE']);
			$email = ($subject['EMAIL']);
	  }
	}
mysql_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen">
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

	<script>
		jQuery(window).load(function() {
			$x = $(window).width();
			if($x > 1024)
			{jQuery("#content .row").preloader();}
		  jQuery('.magnifier').touchTouch();
		  jQuery('.spinner').animate({'opacity':0},1000,'easeOutCubic',function (){jQuery(this).css('display','none')});
  	});
	</script>
</head>

<body>
	<div class="spinner"></div>
	<header>
	  <?php include 'includes/header.php'; ?> 
	</header>

  <div class="bg-content"> <!-- content -->
  	<div id="content">
  		<div class="row-1">
  			<div class="container">
		  		<div class="span8" style="margin-top:30px">
						<div id="feedback-dialog" class="feedPara" align="center">
						<iframe src="https://docs.google.com/forms/d/1gNJupd8TxVl9CWcCGsjvL573SfYiuRSPw1DDUqqIZsI/viewform?embedded=true" width="760" height="520" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>
						</div>
					</div>
		  	</div> <!-- end container -->
  		</div> <!-- end row-1 -->
  		
  	</div> <!-- end content -->
  	
  	
		<!-- ABOUT US -->
		<?php include 'includes/aboutUs.php'; ?>
	</div>

	<!-- footer -->
	<?php include 'includes/footer.php'; ?>

	<script type="text/javascript" src="uwcnext.js"></script> <!-- Link to javscript file -->
	<script type="text/javascript" src="script.js"></script> <!-- Link to javscript file -->
	<script type="text/javascript"> 
  	window.uid = <?php echo json_encode($_SESSION['uid']);?>;
  	window.userEmail = <?php echo json_encode($_SESSION["email"]);?>;
  	$(document).ready(function(){
  		var UWC = <?php echo json_encode($uwc);?>;
  		var uwcYear = <?php echo json_encode($uwcYear);?>;
  		var country = <?php echo json_encode($country);?>;		
			$("#selectUWC").val(UWC);	
			$("#selectYear").val(uwcYear);	
			$("#country").val(country);	
  	})
  </script>
</body>

</html>