<?php 
ob_start();
session_start();
include 'projects/includes/Bluehost_connect.php'; 
?>


<nav class="navbar navbar-fixed-top wowmenu" role="navigation">
	<div class="container">

		<div class="navbar-header">
			<!-- <a class="navbar-brand logo-nav" href="index.html"><img src="img/logo.png" alt="logo"></a> -->
			<a class="navbar-brand logo-nav" href="index.php"><img src="ocf_logo.png" style="width:77px;"></a>
		</div>
		<ul id="nav" class="nav navbar-nav pull-right">
			<li class="" href="#"><a href="index.php">HOME</a></li>
			<li class="" href="#"><a href="about.php">ABOUT</a></li>

			<li class="dropdown">
			<a href="classes.php" class="" >CLASSES</a>
			<!-- <ul class="dropdown-menu">
				<li><a href="home2.html">Home Alt</a></li>
				<li><a href="about.html">About Us</a></li>
				<li><a href="services.html">Services</a></li>
				<li><a href="timeline.html">Timeline</a></li>
				<li><a href="landingpage.html">Landing Page</a></li>
				<li><a href="testimonials.html">Testimonials</a></li>
				<li><a href="faq.html">F.A.Q.</a></li>
				<li><a href="404.html">404 Not Found</a></li>
			</ul> -->
			</li>
			<li class="dropdown">
			<a href="../projects/" target="_blank" class="">PROJECTS</a>
			<!-- <ul class="dropdown-menu">
				<li><a href="portfolio3.html">Three Columns</a></li>
				<li><a href="portfolio2.html">Two Columns</a></li>
				<li><a href="portfolio4.html">Four Columns</a></li>
				<li><a href="projectdetail.html">Single Project</a></li>
			</ul> -->
			</li>
			<li class="">
			<a href="blog.php">BLOG</a>
			<ul class="#">
				<!-- <li><a href="blogindex.html">Home Blog</a></li>
				<li><a href="blogsinglepost.html">Single Post</a></li> -->
			</ul>
			</li>
			<li class="">
				<a href="impact.php" class="#">YOUR IMPACT</a>
			</li> 
			<li><a href="contact.php">CONTACT</a></li>

			<?php if($_SESSION["uid"]==""){?>                  
	            <li><a href="/login_page.php">LOGIN</a></li>
            <?php } else {?>
	            <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span style="color:#DB420E; padding-top:10px; font-size:11px; font-weight:bold"><?php echo ($_SESSION["name"]);?></span> <i class="icon-angle-down"></i></a>
					<ul class="dropdown-menu">
	              <!-- <a ><i class="icon-user"></i> </a> -->
	                <li>
	                  <a href = "projects/editProfile.php"><i class="icon-refresh" style="margin-right:5px;"></i> Edit Profile </a>
	                </li>
	                <li>
	                  <a href="logout.php"><i class="icon-off" style="margin-right:5px;"></i> Logout </a>
	                </li>
	              </ul>
	            </li>
            <?php }?>      
			
			<div id="facebookLike" class="pull-right" style="margin-left: 13px;
    margin-top: 5px;">
			<div class="fb-like" data-href="https://www.facebook.com/ocfuture" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
		</div>

		
		</ul>		
	</div>	
	</nav>
	<!-- /nav end-->