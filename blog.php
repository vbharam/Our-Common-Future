<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>Our Common Future - Blog</title>
<!-- Style -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<!-- Responsive -->
<link href="css/responsive.css" rel="stylesheet">
<!-- Choose Layout -->
<link href="css/layout-wide.css" rel="stylesheet">
<!-- Choose Skin -->
<link href="css/skin-green.css" rel="stylesheet">
<link rel="shortcut icon" href="favicon.ico">
<!-- Demo -->
<link rel="stylesheet" id="main-color" href="css/skin-green.css" media="screen"/>
<link href='http://fonts.googleapis.com/css?family=Asap:400,500,600,700,400italic,700italic' rel='stylesheet' type='text/css'>
<!-- Favicon -->
<!-- <link rel="shortcut icon" href="img/favicon.ico"> -->
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
	<!-- NAV
================================================== -->
	<?php include 'includes/navbar.php';?>
<!-- /nav end-->

	<!-- CAROUSEL
================================================== -->
	
	<!-- /.carousel end-->
	
	<!-- /.wrapsemibox start-->
	<div class="wrapsemibox">
		<div class="semiboxshadow text-center">
			<img src="img/shp.png" class="img-responsive" alt="">
		</div>
		<!-- INTRO NOTE
================================================== -->
		
		<section class="intro-note topspace30">
		<div class="container">
			<div class="row">
				<div id="how"class="col-md-12 text-center">
					
				</div>
			</div>
		</div>
		</section>
		<!-- /.intro-note end-->
		<!-- SERVICE BOXES
================================================== -->
		<section class="service-box topspace30">
		<iframe class="gmap" style="width:100%;height:700px;border: 0;margin-top:-40px;" src="https://onlineuwc.wordpress.com/" width="800" height="100" frameborder="0" style="border:0">
		</iframe>
		</section>


		
		<!-- /.home-features end-->


		<!-- /.recent-projects-home end-->
		<!-- BEGIN CALL TO ACTION PANEL
================================================== -->
		<!-- <section class="container animated fadeInDownNow notransition topspace40">
			<div class="row">
				<div class="col-md-12"> -->
					<!-- <div class="text-center">
						<p class="bigtext">
							 Praesent <span class="fontpacifico colortext">WowThemes</span> sapien, a vulputate enim auctor vitae
						</p>
						<p>
							 Duis non lorem porta, adipiscing eros sit amet, tempor sem. Donec nunc arcu, semper a tempus et, consequat
						</p>
					</div> -->
					<!-- <div class="text-center topspace20">
						<a href="#" class="buttonblack"><i class="icon-shopping-cart"></i>&nbsp; get theme</a>
						<a href="#" class="buttoncolor"><i class="icon-link"></i>&nbsp; learn more</a>
					</div>
				</div>
			</div>
		</section> -->
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
<script>
	/* ---------------------------------------------------------------------- */
	/*	Carousel
	/* ---------------------------------------------------------------------- */
	$(window).load(function(){			
		$('#carousel-projects').carouFredSel({
		responsive: true,
		items       : {
        width       : 200,
        height      : 295,
        visible     : {
            min         : 1,
            max         : 4
        }
    },
		width: '200px',
		height: '295px',
		auto: true,
		circular	: true,
		infinite	: false,
		prev : {
			button		: "#car_prev",
			key			: "left",
				},
		next : {
			button		: "#car_next",
			key			: "right",
					},
		swipe: {
			onMouse: true,
			onTouch: true
			},
		scroll: {
        easing: "",
        duration: 200
    }
	});
		});
</script>
<script>
	//CALL TESTIMONIAL ROTATOR
	$( function() {
		/*
		- how to call the plugin:
		$( selector ).cbpQTRotator( [options] );
		- options:
		{
			// default transition speed (ms)
			speed : 700,
			// default transition easing
			easing : 'ease',
			// rotator interval (ms)
			interval : 8000
		}
		- destroy:
		$( selector ).cbpQTRotator( 'destroy' );
		*/
		$( '#cbp-qtrotator' ).cbpQTRotator();
	} );
</script>
<script>
	//CALL PRETTY PHOTO
	$(document).ready(function(){
		$("a[data-gal^='prettyPhoto']").prettyPhoto({social_tools:'', animation_speed: 'normal' , theme: 'dark_rounded'});
	});
</script>
<script>
	//MASONRY
	$(document).ready(function(){
	var $container = $('#content');
	  $container.imagesLoaded( function(){
		$container.isotope({
		filter: '*',	
		animationOptions: {
		 duration: 750,
		 easing: 'linear',
		 queue: false,	 
	   }
	});
	});
	$('#filter a').click(function (event) {
		$('a.selected').removeClass('selected');
		var $this = $(this);
		$this.addClass('selected');
		var selector = $this.attr('data-filter');
		$container.isotope({
			 filter: selector
		});
		return false;
	});
	});
</script>
<script>
//ROLL ON HOVER
	$(function() {
	$(".roll").css("opacity","0");
	$(".roll").hover(function () {
	$(this).stop().animate({
	opacity: .8
	}, "slow");
	},
	function () {
	$(this).stop().animate({
	opacity: 0
	}, "slow");
	});
	});
</script>
<!--BEGIN DEMO PANEL
================================================== -->


<!--END DEMO PANEL
================================================== -->
</body>
</html>