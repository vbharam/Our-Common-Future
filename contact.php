<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>Our Common Future - Contact</title>
<!-- Style -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<!-- Responsive -->
<link href="css/responsive.css" rel="stylesheet">
<!-- Choose Layout -->
<link href="css/layout-wide.css" rel="stylesheet">
<!-- Choose Skin -->
<link href="css/skin-green.css" rel="stylesheet">
<!-- Demo -->
<!-- <link rel="stylesheet" id="main-color" href="css/skin-green.css" media="screen"/>
 --><!-- Favicon -->
<link rel="shortcut icon" href="favicon.ico">
<!-- IE -->
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>	   
    <![endif]-->
<!--[if lte IE 8]>
	<link href="css/ie8.css" rel="stylesheet">
	 <![endif]-->
</head>
<body class="off">
<!-- /.wrapbox start-->
<div class="wrapbox">
	<!-- TOP AREA
================================================== -->
	
	<!-- /.toparea end-->
	<!-- NAV
================================================== -->
	<?php include 'includes/navbar.php';?>

	<!-- /nav end-->
	<!-- PAGE TITLE
================================================== -->
	<section class="pageheader-default text-center">
	<div class="semitransparentbg" style="
    margin-bottom: 65px;">
		
		
	</div>
	</section>
	<div class="wrapsemibox">
		<div class="semiboxshadow text-center">
			<img src="img/shp.png" class="img-responsive" alt="">
		</div>
		<!-- CONTACT
================================================== -->
		

		<iframe class="gmap" style="width:100%;height:370px;border: 0;margin-top:-40px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9956.260077035211!2d-3.533254!3d51.40186!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x1844aed273d89eff!2sUnited+World+College+of+the+Atlantic!5e0!3m2!1sen!2sus!4v1412779395500" width="800" height="600" frameborder="0" style="border:0"></iframe>

		<section class="container">
		<div class="row">
			
			<div class="col-md-4 animated fadeInRight notransition">
				<h1 class="smalltitle">
				<span>Contacts</span>
				</h1>
				<p>
					 If you have any thoughts or concerns. Please feel free to drop us a line. Thanks! 
				</p>
				<h1 class="smalltitle">
				<span>The Office</span>
				</h1>
				<ul class="unstyled">
					<li><span style="margin-right:5px;"><i class="icon-map-marker"></i></span> ocf.co</li>
<!-- 					<li><span style="margin-right:3px;"><i class="icon-phone"></i></span> Phone: (123) 456-7890</li>
 -->					<li><span style="margin-right:2px;"><i class="icon-envelope"></i></span> <a href="mailto:ourcommonfuture@googlegroups.com">ourcommonfuture@googlegroups.com</a></li>
				</ul>
				
			</div>
			<div class="col-md-8 animated fadeInLeft notransition">
				<h1 class="smalltitle">
				<span>Get in Touch</span>
				</h1>
				<div class="done">
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">×</button>
						Your message has been sent. Thank you!
					</div>
				</div>
				<form method="post" style="margin-top:30px;"action="contactUs.php" id="contactform" >
					<div class="form" style="padding-bottom:30px;">
						<input id="contact_name"class="col-md-6" type="text" name="name" placeholder="Name">
						<input id="contact_email" class="col-md-6" type="text" name="email" placeholder="E-mail">
						<textarea id="contact_text" class="col-md-12" name="comment" rows="10" placeholder="Message"></textarea>
						<input type="submit" id="submit" style="color:white; background:rgb(87, 168, 62);"  class="btn" value="S U B M I T">
					</div>
				</form>
			</div>
		</div>
		</section>
		<!--CALL TO ACTION PANEL
================================================== -->

		<!-- /. end call to action-->
	</div>
	<!-- /.wrapsemibox end-->
	<!-- BEGIN FOOTER
================================================== -->
		<?php include 'includes/footer.php'; ?>

	<!-- /footer section end-->
</div>
<!-- /.wrapbox ends-->
<!-- SCRIPTS, placed at the end of the document so the pages load faster
================================================== -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/plugins.js"></script>
<script src="js/common.js"></script>
<!--BEGIN DEMO PANEL
================================================== -->
<link rel="stylesheet" href="demo/css/style-switcher.css" media="screen"/>
<link rel="stylesheet" href="demo/css/colorpicker.css" media="screen"/>
<script type="text/javascript" src="demo/js/jquery.cookie.js"></script>
<script type="text/javascript" src="demo/js/styleswitch.js"></script>
<script type="text/javascript" src="demo/js/colorpicker.js"></script>
<script type="text/javascript" src="demo/js/switcher.js"></script>

<!--END DEMO PANEL
================================================== -->
</body>
</html>