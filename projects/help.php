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
	<link rel="stylesheet" href="css/accordionStyle.css" type="text/css" media="screen">
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
	<script src="js/prefixfree.min.js"></script>
	<script src="js/accordion.js"></script>
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
		  		<div class="col-sm-12">
						<div class="accordion">
					    <dl>
					      <dt><a class="accordionTitle" href="#">What is Our Common Future?</a></dt>
					      <dd class="accordionItem accordionItemCollapsed">
					        <p>Our Common Future is a student initiative designed to help students and alumni make changes around the world. Use this page to post your grand ideas for helping those in need. With the ability to post different projects and receive help from anybody interested, causing change and helping others has never been easier. Just make an account to get started!</p>
					      </dd>
					      <dt><a href="#" class="accordionTitle">How do I Make a Project?</a></dt>
					      <dd class="accordionItem accordionItemCollapsed">
					        <p>An account is needed to make a project. Once you sign up and are logged in, a tab will appear at the top called <strong><i>Create Initiative</i></strong>. Use that to get started. Just remember to use the same email in your project as you do when making your account.</p>
					      </dd>
					      <dt><a href="#" class="accordionTitle">How can I Help Other Projects?</a></dt>
					      <dd class="accordionItem accordionItemCollapsed">
					        <p>There are many ways to help a project. The most direct ways would be to donate money to aid their cause, or to go out and help yourself if it's an 'in the field' type project. But you can also offer moral support by staying in touch with the members and giving advice to help them out. Any contribution, no matter how big or small is always appreciated.
					          <ul>
					            <li>Open the <strong><i>Help a Project</i></strong> tab</li>
					            <li>Use the <strong><i>Action</i></strong> dropdown list or click on <strong><i>View Details</i></strong></li>
					            <li>Choose how you can best aid:
					              <ol>
					                <li>Donate</li>
					                <li>Contact</li>
					                <li>Follow</li>
					              </ol>
					            </li>
					          </ul>
					        </p>
					      </dd>
					      <dt><a href="#" class="accordionTitle">How do I View the Projects I'm Involved in?</a></dt>
					      <dd class="accordionItem accordionItemCollapsed">
					        <p>Use the <strong><i>My Projects</i></strong> tab to keep up to date on all the projects you're involved in. Whether you're currently working on them, already finished, or are just following the progress, find all of them in one convenient location.</p>
					      </dd>
					      <dt><a href="#" class="accordionTitle">How do I Edit my Project?</a></dt>
					      <dd class="accordionItem accordionItemCollapsed">
					        <p>Go to the <strong><i>My Projects</i></strong> tab and use the <strong><i>Action</i></strong> dropdown list or click on <strong><i>View Details</i></strong>. Select the <strong><i>Leave</i></strong> option.</p>
					      </dd>
					      <dt><a href="#" class="accordionTitle">How do I Leave my Project?</a></dt>
					      <dd class="accordionItem accordionItemCollapsed">
					        <p>Go to the <strong><i>My Projects</i></strong> tab and use the <strong><i>Action</i></strong> dropdown list or click on <strong><i>View Details</i></strong>. Select the <strong><i>Leave</i></strong> option.</p>
					      </dd>
					    </dl>
					  </div> <!-- end accordion -->
					</div> <!-- end col-sm-12 -->
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