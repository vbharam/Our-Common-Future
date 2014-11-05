
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
    <div id="content"><div class="ic"></div>
	    <div class="row-1">
	    	<div class="container">
	      	<div class="row">
	      	<div class="span12">
<div class="block-404">  
      <img class="img-404" src="img/404.jpg" alt="">       
    	<div class="box-404">
        	<h2>Oopss!</h2>
<h3>404 page not found</h3>        	
           
           

		</div>
     </div>
   </div>

      		</div>
		    </div>
		  </div>
</div>
</div>

<!-- footer -->
<?php include 'includes/footer.php'; ?> 

	<script type="text/javascript" src="uwcnext.js"></script> <!-- Link to javscript file -->
	<script type="text/javascript" src="script.js"></script> <!-- Link to javscript file -->
</body>

</html>