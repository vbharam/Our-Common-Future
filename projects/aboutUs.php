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
			$uwcYear = ($subject['UWC_YEAR']);
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
	<link rel="icon" href="img/favicon.png" type="image/x-icon">
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

  <div class="bg-content" style="border-bottom:1px solid; "> <!-- content -->
  	<div id="content" style="padding-bottom:0">
  		<div class="row-1">
  			<div class="container">
		  		<div class="col-sm-12">
						<div class="span12">
							<div class="span12">
								<div class="span12">
									<h4>About Us</h4>
								</div>
								
			  				<div class="span10" style="margin-left:20px">
			  					<h5 style="color:black; margin-bottom:20px">UWCNext delivers three fundamental values to alumni and students:</h5>
			  					<div style="margin-left:30px">
			  						<p><strong>Connect</strong> with alumni across UWCs on a platform designed for starting initiatives and creating impact.</p>
										<p><strong>Crowdsource</strong> among people who understand and value your initiatives - who went to school with you!</p>
										<p><strong>Co-create</strong> with UWC alumni to support initiatives.</p>
			  					</div>
			  					</div> <!-- end span7 -->
			  			</div> <!-- end span12 -->
						</div> <!-- end span12 -->
						<div class="span11" style="margin:20px 0 0 60px">
							<p style="padding-bottom:10px">UWCNext is the next step to carry on the UWC mission and values.</p>
							<p>It is worth noting that UWCNext is not only a platform for UWC alumni, but for all members of the UWC community who have benefitted from the movement in one way or another (ie UWC short programs).</p>
						</div> <!-- end span12 -->
						<div class="span12">
							<div class="span7">
								<img src="img/aboutUs.jpg">
							</div> <!-- end span6 -->
							<div class="span4">
								<p style="padding-bottom:10px"> We are alumni working together, bringing different experiences and collaborating as a team to make UWCNext possible. The members include:</p>
								<p style="padding-bottom:10px"><strong>Boyd Waters</strong> <i>UWC-USA '87</i></p>
								<p style="padding-bottom:10px"><strong>Vishal Bharam</strong> <i>UWC-USA '10</i></p>
								<p style="padding-bottom:10px"><strong>Rahul Patle</strong> <i>MUWCI '10</i></p>
								<p style="padding-bottom:10px"><strong>Siphamandla Simelane</strong> <i>UWC-WK '10</i></p>
								<p style="padding-bottom:10px"><strong>Dichha Rai</strong> <i>MUWCI '12</i></p>
								<p style="padding-bottom:10px"><strong>Ahmad Shabaneh</strong> <i>UWC-USA '13</i></p>
								<p style="padding-bottom:10px"><strong>Shayan Shokrgozar</strong> <i>UWC-USA '13</i></p>
								<p style="padding-bottom:10px"><strong>Farid Noori</strong> <i>UWC-USA '14</i></p>
								<p style="padding-bottom:10px"><strong>Jia Chern Teoh</strong> <i>UWC-USA '15</i></p>
								<p style="padding-bottom:10px"><strong>Patrick Bouke O'Donell</strong> <i>UWC-USA '15</i></p>
								<p style="padding-bottom:10px"><strong>Michael-Patrick Azar</strong> <i>UWC-USA '15</i></p>
							</div> <!-- end span4 -->
						</div> <!-- end span10 -->
					</div> <!-- end col-sm-12 -->
		  	</div> <!-- end container -->
  		</div> <!-- end row-1 -->
  	</div> <!-- end content -->
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