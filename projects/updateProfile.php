<?php 
ob_start();
session_start();
include 'includes/Bluehost_connect.php'; 
?>

<?php 	
	$email = $_GET['USEREMAIL'];
	if( $email != "") {	
	// Get Current and Past projects asociated with the user	
		$query = "SELECT  * FROM  `PROJECT_CREATOR` WHERE `CREATOR_EMAIL` = '".$email."' ORDER BY `ID` ASC";
		$result = mysql_query($query,$connection);
		if (!$result) { 
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    die($message);
	}

	$idArray = array();
	while ($subject = mysql_fetch_assoc( $result)){ 
		array_push($idArray, $subject['PROJECT_ID']);
	}
	$idArray =  array_unique($idArray);
	$idArray = join(',',$idArray);

	$getProjectQuery = "SELECT * FROM `PROJECT` WHERE `ID` IN ($idArray) ORDER BY `ID` DESC";
	$getProjectResult = mysql_query($getProjectQuery,$connection);
	if (!$getProjectResult) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $getProjectQuery;
    die($message);
	}
	$currentProject = array();
	$currentProjectId = array();
	$pastProject = array();
	$pastProjectId = array();
	while ($subject = mysql_fetch_assoc($getProjectResult)){ 
		$projectId = ($subject['ID']);
		$projectName = ($subject['NAME']);
	    $progressPercentage = ($subject['PROGRESS_PERCENTAGE']);
    if ($progressPercentage<100) {
    	array_push($currentProject, $projectName);
    	array_push($currentProjectId, $projectId);
    } else if ($progressPercentage==100) {
    	array_push($pastProject, $projectName);
    	array_push($pastProjectId, $projectId);
    }
	}
}

if( $email != "") {	
	// Get Followed projects asociated with the user	
	$followedProjectQuery = "SELECT * FROM `PROJECT_FOLLOWER` WHERE `FOLLOWER_EMAIL` = '".$email."'  ORDER BY `ID` ASC";
	$followedProjectResult = mysql_query($followedProjectQuery,$connection);
		if (!$followedProjectResult) { 
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $followedProjectQuery;
	    die($message);
	}
	$followedProjectIdArray = array();
	while ($subject = mysql_fetch_assoc( $followedProjectResult)){ 
		array_push($followedProjectIdArray, $subject['PROJECT_ID']);
	}	
	$followedProjectIdArrayLength = sizeof($followedProjectIdArray);

	if ($followedProjectIdArrayLength > 0){
		$followedProjectIdArray =  array_unique($followedProjectIdArray);
		$followedProjectIdArray = join(',',$followedProjectIdArray);
		$getFollowedProjectQuery = "SELECT * FROM `PROJECT` WHERE `ID` IN ($followedProjectIdArray) ORDER BY `ID` DESC";
		$getFollowedProjectResult = mysql_query($getFollowedProjectQuery,$connection);
		if (!$getFollowedProjectResult) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $getFollowedProjectQuery;
	    die($message);
		}

	  $followedProject = array();
		$followedProjectId = array();
		while ($subject = mysql_fetch_assoc($getFollowedProjectResult)){ 
			$projectId = ($subject['ID']);
			$projectName = ($subject['NAME']);
	  	array_push($followedProject, $projectName);
	  	array_push($followedProjectId, $projectId);
	  }
	}
}

if( $email != "") {	
	// Get info asociated with the user	
	$userQuery = "SELECT * FROM `USER_INFO` WHERE `EMAIL` = '$email'";
	$userInfoResult = mysql_query($userQuery,$connection);
		if (!$userInfoResult) { 
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $userQuery;
	    die($message);
	}
	while ($subject = mysql_fetch_assoc( $userInfoResult)){ 
		$name = ($subject['NAME']);
		$country = ($subject['COUNTRY']);
		$uwc = ($subject['UWC']);
		$languages = ($subject['LANGUAGES']);
		$skills = ($subject['SKILLS']);
		$bio = ($subject['BIO']);
		$phone = ($subject['PHONE']);
		$profilePic = ($subject['PROFILE_PIC']);
		if ($profilePic == "" || $profilePic == null || $profilePic ==undefinded){
			$profilePic = 'user.jpg';
		}
  }
}


mysql_close($connection);

?>

<!DOCTYPE html>
	<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Uwcnext</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="new/fonts/ptsans/stylesheet.css" type="text/css" charset="utf-8" />
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/theme.css" rel="stylesheet">
    <link rel="css/stylesheet" href="fonts/font-awesome/css/font-awesome.css" /> 
    <link href="includes/css/bootstrap-glyphicons.css" rel="stylesheet">

		<!-- Custom CSS -->
		<link href="includes/css/styles.css" rel="stylesheet">
		<link href="includes/css/uwcnext.css" rel="stylesheet">
		<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/responsive.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/touchTouch.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/kwicks-slider.css" type="text/css" media="screen">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:205,300' rel='stylesheet' type='text/css'>
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css" rel="stylesheet">
			
		<!-- Include Modernizr in the head, before any other Javascript -->
		<script src="includes/js/modernizr-2.6.2.min.js"></script>
		<style type="text/css">@media print { .gm-style .gmnoprint, .gmnoprint { display:none }}@media screen {  .gm-style .gmnoscreen, .gmnoscreen { display:none }}</style>

		<!-- PHP files -->
		<?php include 'modal.php'; ?> <!-- Includes all modal (login, signup, contact, feedback) -->
		<?php //include 'updateProfile.php'; ?>  <!-- Update user profile -->
	</head>

	<body>
	<div class="spinner"></div>
	<header>
    <div class="container clearfix">
    	<div class="row">
	      <div class="span12">
	        <div class="navbar navbar_">
            <div class="container">
	            <h1 class="brand brand_"><a href="" onclick="homeReturn()"><img alt="" src="img/UWCnext-1420x280.gif" style="width:200px; height:40px;" > </a></h1>
	            <a class="btn btn-navbar btn-navbar_" data-toggle="collapse" data-target=".nav-collapse_">Menu <span class="icon-bar"></span> </a>
	            <div class="nav-collapse nav-collapse_  collapse">
	              <ul class="nav sf-menu">	              	
	                <li class="sub-menu"><a href="" onclick="helpInitiative(1)">Initiatives</a>
	                  <ul>
	                    <li><a href="#tab2" data-toggle="tab"  onclick='sortInitiative("current", 1);'><i class="icon-new-window" style="margin-right:5px;"></i>Current</a></li>
	                    <li><a href="#tab3" data-toggle="tab" onclick='sortInitiative("finished", 1);'><i class="icon-check" style="margin-right:5px;"></i>Finished</a></li>
	                    <li id="createProjectButton"><a href="#tab4" data-toggle="tab"><i class="icon-folder-open" style="margin-right:5px;"></i>Create New</a></li>
	                  </ul>
	                </li>
	                <li class="sub-menu" data-toggle="tab" style=" <?php if($_SESSION["uid"]==""){?>display:none;<?php }else{?>padding:0px; <?php }?>" ><a data-toggle="tab"  href="#tab6"  onclick='myProjects(1, "current")'> My Initiatives</a>
	                </li>                               
	                <?php if($_SESSION["uid"]==""){?>                  
	                <li class="sub-menu"><a href="">Members</a>
	                  <ul>
		                  <li><a href="#loginModal" data-toggle="modal" data-target=""><i class="icon-user" style="margin-right:5px;"></i>Login</a></li>
		                  <li><a href="#signUpModal" data-toggle="modal" data-target=""><i class="icon-plus-sign" style="margin-right:5px;"></i>Signup</a></li>
		                </ul>
	                </li>
	                <?php } else {?>
	                <li ><a href="#" ><i class="icon-user"></i> <span style="color:white; padding-top:10px; font-size:11px;"><?php echo ($_SESSION["name"]);?></span><strong class="caret"></strong></a>
	                  <ul>
											<li>
												<a href = "#updateModal"  data-toggle="modal"><i class="icon-refresh" style="margin-right:5px;"></i> Update Profile </a>
											</li>
											<li>
												<a href="#"><i class="icon-briefcase" style="margin-right:5px;"></i> Billing </a>
											</li>
											<li class="divider"></li>
											<li>
												<a href="logout.php"><i class="icon-off" style="margin-right:5px;"></i> Logout </a>
											</li>
		                </ul>
	                </li>
									<?php } ?>	                
	                <li class="sub-menu" style="padding-top: 10px;">
										<form id="searchForm" class="navbar-form pull-right">
											<input type="text" class="form-control" id="searchInput" placeholder ="Search this site...">
											<a href="#tab5" data-toggle="tab" onClick="searchSubmit(event)"><button type="submit" class= "btn btn-default"><i class="icon-search" ></i></button></a>
											<!-- <button type="submit" class= "btn btn-default" > <a href="#tab5" data-toggle="tab" onClick="searchSubmit(event)"></a><i class="icon-search" ></i></button> -->
										</form>	<!-- end navbar-form -->
									</li>
	              </ul>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>
  	</div>
  </header>

  <div class="bg-content">     
      <!-- content -->      
    <div id="content" class="content-extra">
    <div class="row-1">
    	<div class="container">
      		<div class="row">
				<div id="profile" class="span12">
					<div class="row-fluid" style="margin-top:75px">
			    		<div class="span8">
			    			<div style="width:100%">
					      		<img class="media-object pull-left" style="height:180px; width:150px; margin: 0 20px 20px 0" src="<?php echo uploads . '/' . $profilePic; ?>"/>
								<p style="line-height:1.5">Name : <b><?php echo $name; ?></b></p>
								<p style="line-height:1.5">Country : <b><?php echo $country; ?></b></p>
								<p style="line-height:1.5">UWC and Year : <b><?php echo $uwc; ?></b></p>
								<p style="line-height:1.5">Email : <b><?php echo  $email; ?></b></p>
								<p style="line-height:1.5">Phone : <b><?php echo $phone; ?></b></p>
				    		</div>
		    				<div style="clear:both">
    							<dl class="dl-horizontal">
									<dt>
										<p style="font-weight: normal; font-size:16px">Languages</p>
									</dt>
									<dd> 
										<b><?php echo $languages; ?></b>
									</dd>
								</dl>
								<dl class="dl-horizontal"  >
									<dt>
										<p style="font-weight:normal; font-size:16px">Skills</p>
									</dt>
									<dd> 
										<b><?php echo $skills; ?></b>
									</dd>
								</dl>
								<dl class="dl-horizontal">
									<dt>
										<p style="font-weight:normal; font-size:16px">Biography</p>
									</dt>
									<dd>
										<b><?php echo $bio; ?></b>
									</dd>
								</dl>
      						</div>
						</div>
						
							<div class="span4 pull-right">
								<div>
									<h4 id="currentProjectsLabel" style="text-align: center; font-weight: bold; display:none;">Current Projects</h4>
									<table id = "currentProject" class="table table-hover"></table>
								</div>
								<div>
									<h4 id="pastProjectsLabel" style="text-align: center; font-weight: bold; display:none;">Past Projects</h4>
									<table id = "pastProject" class="table table-hover"></table>
								</div>
								<div>
									<h4 id="followedProjectsLabel" style="text-align: center; font-weight: bold; display:none;">Followed Projects</h4>
									<table id = "followedProject" class="table table-hover"></table>
								</div>

							</div>
						
					</div>
				</div>
			</div>
		</div>
	</div> <!-- end container -->

		<!-- All Javascript at the bottom of the page for faster page loading -->		
		<!-- First try for the online version of jQuery-->
		<script src="http://code.jquery.com/jquery.js"></script>
		<!-- If no online access, fallback to our hardcoded version of jQuery -->
		<script> window.jQuery || document.write('<script src="includes/js/jquery-1.8.2.min.js"><\/script>')</script>
		<!-- Bootstrap JS -->
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<!-- Custom JS -->
		<script src="includes/js/script.js"></script>
		<script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
		<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src = "uwcnext.js"></script> <!-- Link to javscript file -->
		<script type="text/javascript" src = "script.js"></script> <!-- Link to javscript file -->
		<script type="text/javascript">

		var currentProjectLength = <?php echo json_encode(sizeof($currentProject)); ?>;
		if (currentProjectLength>0){
			$("#currentProjectsLabel").show();
			for (var i = 0; i < currentProjectLength; i++) {
				var projectIndex = currentProjectLength-i;
				var projectName = <?php echo json_encode($currentProject); ?>[i];
				var projectId = <?php echo json_encode($currentProjectId); ?>[i];
				var left_col = ('<div class=style="padding: 10px; "></div>');
        var middle_col = ('<div id="middle_col" style="" ><a class = "anchor"; style="cursor:pointer;"><b class="list-group-item-heading" style="color:#3B0B0B" onclick="showDescription('+projectId+',11)"> '+projectName+' </b></a></div>');
        var right_col = ('<button type="button" class="btn btn-link pull-center" onclick="showDescription('+projectId+',11)" style="font-weight:bold;">View Details</button>');
        CreateTable("currentProject", left_col, middle_col, right_col, 1);
			};
		}

		var pastProjectLength = <?php echo json_encode(sizeof($pastProject)); ?>;
		if (pastProjectLength>0){
			$("#pastProjectsLabel").show();
			for (var i = 0; i < pastProjectLength; i++) {
				var projectIndex = pastProjectLength-i;
				var projectName = <?php echo json_encode($pastProject); ?>[i];
				var projectId = <?php echo json_encode($pastProjectId); ?>[i];
				var left_col = ('<div class=style="padding: 10px; "></div>');
        var middle_col = ('<div id="middle_col" style="" ><a class = "anchor"; style="cursor:pointer;"><b class="list-group-item-heading" style="color:#3B0B0B" onclick="showDescription('+projectId+',11)"> '+projectName+' </b></a></div>');
        var right_col = ('<button type="button" class="btn btn-link pull-center" onclick="showDescription('+projectId+',11)" style="font-weight:bold;">View Details</button>');
        CreateTable("pastProject", left_col, middle_col, right_col, 1);
			};
		}

		var followedProjectLength = <?php echo json_encode(sizeof($followedProject)); ?>;
		if (followedProjectLength>0){
			$("#followedProjectsLabel").show();
			for (var i = 0; i < followedProjectLength; i++) {
				var projectIndex = followedProjectLength-i;
				var projectName = <?php echo json_encode($followedProject); ?>[i];
				var projectId = <?php echo json_encode($followedProjectId); ?>[i];
				var left_col = ('<div class=style="padding: 10px; "></div>');
        var middle_col = ('<div id="middle_col" style="" ><a class = "anchor"; style="cursor:pointer;"><b class="list-group-item-heading" style="color:#3B0B0B" onclick="showDescription('+projectId+',11)"> '+projectName+' </b></a></div>');
        var right_col = ('<button type="button" class="btn btn-link pull-center" onclick="showDescription('+projectId+',11)" style="font-weight:bold;">View Details</button>');
        CreateTable("followedProject", left_col, middle_col, right_col, 1);
			};
		}
		</script>




		<!--start new footer-->
	
	<div class="container">
      <div class="row">
      	<article class="span8">
          <h4>Shortly about us</h4>
          <div class="wrapper">
          <figure class="img-indent"><img src="img/15.jpg " alt="" /></figure>
          <div class="inner-1 overflow extra">
            <div class="txt-1">UWCNEXT is a student initiative designed to help students and alumni make changes around the world. Use this page to post your grand ideas for helping those in need. With the ability to post different projects and receive help from anybody interested, causing change and helping others has never been easier. Just make an account to get started! 
            </div>
        	</div>
        </article>
        <article class="span1"></article>
      	<article class="span3">
          <h4>Some quick links</h4>
          <div class="wrapper">
            <ul class="list list-pad">
              <li><a href="#">Home</a></li>
              <li><a href="#">Help</a></li>
              <li><a href="#">Contact Us</a></li>
              <li><a href="#">Privacy Policy</a></li>
            </ul>
          </div>
        </article>
    	</div>
    </div>
	</div>
</div>
<!-- footer -->
<footer>
  <div class="container clearfix">
    <ul class="list-social pull-right">
      <li><a class="icon-1" href="#"></a></li>
      <li><a class="icon-2" href="#"></a></li>
      <li><a class="icon-3" href="#"></a></li>
      <li><a class="icon-4" href="#"></a></li>
    </ul>
	  <div class="privacy pull-left">&copy; <?php echo date('Y');?> | UWC-Next</div>
  </div>
</footer>

	<script type="text/javascript" src="js/bootstrap.js"></script>	
	<!-- Custom JS -->
	<script type="text/javascript" src = "uwcnext.js"></script> 
	<script type="text/javascript" src = "script.js"></script> 
  
  <script type="text/javascript"> 
  	window.uid = <?php echo json_encode($_SESSION['uid']);?>;
  	window.userEmail = <?php echo json_encode($_SESSION["email"]);?>;
		$( document ).ready(function(){
		  $("#createProjectButton").click(function(){         
		    if (uid=="" || uid==null){
		      $("#loginModal").modal("show");
		    }
		  });
		});
  </script>
	</body>
</html>