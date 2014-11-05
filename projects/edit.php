<?php 
ob_start();
session_start();
include 'includes/Bluehost_connect.php'; 
?>

<?php 	
	
	$projectId = $_GET['PROJECT'];

	if( $projectId !="") {		
		$query = "SELECT  * FROM  `PROJECT` WHERE `ID`='".$projectId."' LIMIT 1 ";
	} 
	$result = mysql_query($query,$connection);
	if (!$result) { 
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    die($message);
	}
	while ($subject = mysql_fetch_assoc( $result)){  
		$projectName = ($subject['NAME']);
    $projectBlurb =  ($subject['SHORT_BLURB']);
    $category = ($subject['CATEGORY']); 
    $image = ($subject['IMAGE']); 
    $location = ($subject['LOCATION']);
    $budget = ($subject['FUNDING']);
    $description = ($subject['DESCRIPTION']);
    $benefit = ($subject['BENEFIT']);
    $challenges = ($subject['RISKS_CHALLENGES']);
    $videoLink = ($subject['VIDEO']);
    $progressStatus = ($subject['PROGRESS_STATUS']);
    $progressPercentage = ($subject['PROGRESS_PERCENTAGE']);
	}


	// ///////////////////////////////////////////////////////////////////////////////////////////

	$getCreatorQuery = "SELECT  * FROM  `PROJECT_CREATOR` WHERE `PROJECT_ID`='".$projectId."'";
	$getCreatorResult = mysql_query($getCreatorQuery,$connection);
	if (!$getCreatorResult) { 
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $getCreatorQuery;
	    die($message);
	}
	$userIdArray = array();
	$userNameArray =  array();
	$userCountryArray =  array();
	$userUWCArray =  array();
	$userEmailArray =  array();
	$userPhoneArray =  array();
	$userImagearray =  array();
	$userBioArray =  array();

	while ($subject = mysql_fetch_assoc( $getCreatorResult)){ 
		$projectCreatorId = ($subject['ID']);
		$projectIdForCreators = ($subject['PROJECT_ID']);
    $creatorName = ($subject['CREATOR_NAME']);
    $creatorCountry = ($subject['CREATOR_COUNTRY']);
    $creatorUWC = ($subject['CREATOR_UWC']);
    $creatorEmail = ($subject['CREATOR_EMAIL']);
    $creatorPhone = ($subject['CREATOR_PHONE']);
    $creatorImage = ($subject['CREATOR_IMAGE']);
    $creatorBio = ($subject['CREATOR_BIO']); 

    if ($projectId==$projectIdForCreators){    	
  	  array_push($userIdArray, $projectCreatorId);
      array_push($userNameArray, $creatorName);
      array_push($userCountryArray, $creatorCountry);
      array_push($userUWCArray, $creatorUWC);
      array_push($userEmailArray, $creatorEmail);
      array_push($userPhoneArray, $creatorPhone);
      array_push($userImageArray, $creatorImage);
      array_push($userBioArray, $creatorBio);
    }
	}
	$userIdArray = json_encode($userIdArray);

	// ///////////////////////////////////////////////////////////////////////////////////////////

	$getAdvisorQuery = "SELECT  * FROM  `PROJECT_ADVISOR` WHERE `PROJECT_ID`='".$projectId."' ";
	$getAdvisorResult = mysql_query($getAdvisorQuery,$connection);
	if (!$getAdvisorResult) { 
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $getAdvisorQuery;
	    die($message);
	}
	$advisorIdArray = array();
	$advisorNameArray =  array();
  $advisorEmailArray =  array();
	while ($subject = mysql_fetch_assoc( $getAdvisorResult)){ 
		$projectAdvisorId = ($subject['ID']);
		$projectIdForAdvisors = ($subject['PROJECT_ID']);
    $advisorName = ($subject['ADVISOR_NAME']);
    $advisorEmail = ($subject['ADVISOR_EMAIL']);
    if ($projectId==$projectIdForAdvisors){
    	array_push($advisorIdArray, $projectAdvisorId);
      array_push($advisorNameArray, $advisorName);
      array_push($advisorEmailArray, $advisorEmail);
    }
	}
	$advisorIdArray = json_encode($advisorIdArray);
?>

<?php 	mysql_close($connection); ?>



<html>
	<head>
		<!-- Website Title & Description for Search Engine purposes -->
		<title></title>
		<meta name="description" content="">
		<!-- Mobile viewport optimized -->
		<meta name="viewport" content="width=device-width, initial-scale=0.8, maximum-scale=1.0, user-scalable=no">
		<!-- Bootstrap CSS -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="includes/css/bootstrap-glyphicons.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="includes/css/styles.css" rel="stylesheet">
		<link href="includes/css/uwcnext.css" rel="stylesheet">
		<!-- Include Modernizr in the head, before any other Javascript -->
		<script src="includes/js/modernizr-2.6.2.min.js"></script>
		<style type="text/css">@media print {  .gm-style .gmnoprint, .gmnoprint {    display:none  }}@media screen {  .gm-style .gmnoscreen, .gmnoscreen {    display:none  }}</style>0
		<!-- PHP files -->
		<?php include 'modal.php'; ?> <!-- Includes all modal (login, signup, contact, feedback) -->
		<?php include 'updateProfile.php'; ?>  <!-- Update user profile -->
	</head>

	<body>
		<div class="container" id="main" >
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
    <link href="new/css/bootstrap.css" rel="stylesheet">
		<link href="new/css/theme.css" rel="stylesheet">
    <link rel="/new/stylesheet" href="fonts/font-awesome/css/font-awesome.css" /> 
    <link href="includes/css/bootstrap-glyphicons.css" rel="stylesheet">

		<!-- Custom CSS -->
		<link href="includes/css/styles.css" rel="stylesheet">
		<link href="includes/css/uwcnext.css" rel="stylesheet">
			
		<!-- Include Modernizr in the head, before any other Javascript -->
		<script src="includes/js/modernizr-2.6.2.min.js"></script>
		<style type="text/css">@media print { .gm-style .gmnoprint, .gmnoprint { display:none }}@media screen {  .gm-style .gmnoscreen, .gmnoscreen { display:none }}</style>

		<!-- PHP files -->
		<?php include 'modal.php'; ?>		<!-- Includes all modal (login, signup, contact, feedback) -->
	</head>

	<body>
		<div class="container" id="main">
			<div class="navbar navbar-default navbar-fixed-top" style="font-color:#610B0B"role="navigation">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" onclick="homeReturn()"><img style="margin-top:-8px;" src="images/logo.png"></a>
	        </div>
	        <div class="navbar-collapse collapse">
	          <ul class ="nav navbar-nav pull-right" >
								<?php if($_SESSION["uid"]==""){?>
									<li id="loginNavTabs" class="nav navbar-nav pull-left" style="display:inline">
										<ul class="nav navbar-nav" >
											<li style="display:inline">
												<button class="btn btn-primary pull-left"  style="margin:7px 10px 0 0;" href = "#loginModal"  data-toggle="modal">
													<span class="glyphicon glyphicon-user"></span>
													Login
												</button>
											</li>
											<li style="display:inline">
												<button class="btn btn-default pull-right"  style="margin:7px 10px 0 0;" href = "#signUpModal"  data-toggle="modal">
													<span class="glyphicon glyphicon-plus-sign"></span> 
													Sign Up 
												</button>
											</li>
										</ul>
									</li>
	              <?php }?>
								<li id="myAccountNavTabs" class="nav navbar-nav pull-left" style=" <?php if($_SESSION["uid"]==""){?>display:none;<?php }else{?>display:inline;<?php }?>" >
									<ul class="nav navbar-nav pull-left" >
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> My Account<strong class="caret"></strong></a>
											<ul class="dropdown-menu">
												<li>
													<a href="#"><span class="glyphicon glyphicon-wrench"></span> Settings </a>
												</li>
												<li>
													<a href="#"><span class="glyphicon glyphicon-refresh"></span> Update Profile </a>
												</li>
												<li>
													<a href="#"><span class="glyphicon glyphicon-briefcase"></span> Billing </a>
												</li>
												<li class="divider"></li>
												<li>
													<a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout </a>
												</li>
											</ul>
										</li>
									</ul><!--end navbar pull right -->
								</li>								
							</ul>          
	        </div><!--/.nav-collapse -->
	      </div>
	    </div>


			<div id="projectForm" enctype="multipart/form-data" style="font-size:90%;" >
				<h3 style="margin:75px 0 0 0px; text-align:center; font-weight:bold;">EDIT <?php echo $projectName?> </h3>
				<div  id="projectDescriptionForm" style=" width:1000px; height:auto;" ><br>
				  <label style="font-size:18px;"> Project Description </label><br><br>
			    <form  role = "form" id = "projectDescription" method="POST"  style="margin-left:60px;">
			    	<div class="form-group">
			        <table>
			          <tr>
			            <td>
			              <label >Project Title</label>
			              <input class="form-control" type="text"  name= "projectName"  id="projectName" placeholder = "" value="<?php echo $projectName; ?>" required>
			            </td>
			         		<td>
			            	<p style="margin:20px 0 0 15px;"><small class="text-muted">Your project title should be simple, specific, and yet memorable. Avoid words such as "help", "support", "sponsor" or "fund"</small> </p>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              <label > Category </label>
			              <input class="form-control" type="text" name= "category"  id="category" placeholder = ""  value="<?php echo $category; ?>">
			            </td>
			            <td>
			              <p style="margin:20px 0 0 15px;"><small class="text-muted">  Use multiple tags as needed: art, service, wilderness, campus life ,social enterprise, sustainability, ... </small> </p>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              <label > Location </label>
			              <input class="form-control" type="text" name= "location"  id="location" placeholder = ""  value="<?php echo $location; ?>" required>
			            </td>
			            <td>
			              <p style="margin:20px 0 0 15px;"><small class="text-muted">  Proposed location of the project </small> </p>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              <label > Short Blurb </label>
			              <textarea class="form-control" type="text"  name= "shortBlurb"  id="shortBlurb" placeholder = ""   style= " width: 400px; height:100px; resize:none;" required><?php echo $projectBlurb; ?></textarea>
			            </td>
			            <td>
			              <p style="margin:20px 0 0 15px;"><small class="text-muted">  About 150 characters: if you had to describe your project in a tweet ... </small> </p>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              <label > Funding Goal</label>
			              <input class="form-control" type="text" name= "funding"  id="funding" placeholder = "US $0.00" value="<?php echo $budget; ?>">
			            </td>
			            <td>
			              <p style="margin:20px 0 0 15px;"><small class="text-muted">  Funding goals are typically within US $500 - $1,000 </small> </p>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              <label > Benefits </label>
			              <textarea class="form-control"  name= "benefit"  id="benefit" placeholder = ""   style= " width: 400px; height:100px; resize:none;"><?php echo $benefit; ?></textarea>
			            </td>
			            <td>
			              <p style="margin:20px 0 0 15px;"><small class="text-muted">  Who, what, when, how does it enhance the UWC experience? Why should your project be sponsered? </small> </p>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              <label > Project Image  </label>
			              <input id="img_file" type="file" name="file[]" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png"> </label>
			            </td>
			            <td>
			              <p style="margin:20px 0 0 15px;"><small class="text-muted">  Attach relavant image if possible </small> </p>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              <br><label > Project Video  </label>
			              <textarea class="form-control"  name= "video"  id="video" placeholder = ""    style= " width: 400px; height:100px; resize:none;"><?php echo $videoLink; ?></textarea>
			            </td>
			            <td>
			              <p style="margin:20px 0 0 15px;"><small class="text-muted">  Projects with a video have a much higher chance of success. It doesn't need to be an Oscar contender, just be yourself and explain what you want to do.  Check out kickstarter.com for helpful tips and healthy dose of inspiration. Upload your video to youtube.com or vimeo.com and paste the link  </small> </p>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              <label > Project Description </label>
			              <textarea class="form-control"  name= "description"  id="description" placeholder = ""   style= " width: 400px; height:100px; resize:none;"><?php echo $description; ?></textarea>
			            </td>
			            <td>
			              <p style="margin:20px 0 0 15px;"><small class="text-muted">  Use your project description to share more about what you're raising funds to do and how you plan to pull it off. It's up to you to make the case for your Project. </small> </p>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              <label > Risks and Challenges  </label>
			              <textarea class="form-control"  name= "risksAndChallenges"  id="risksAndChallenges"  placeholder = ""  style= " width: 400px; height:100px; resize:none;"><?php echo $challenges; ?></textarea>
			            </td>
			            <td>
			              <p style="margin:20px 0 0 15px;"><small class="text-muted">  What are the risks and challenges that come with completing your project and how are you qualified to overcome them? Sharing potential challenges - and your plans and qualifications for tackling them - is an important part of building a community around your project. Think about all the various steps to completing your Project and which ones pose challenges. Every initiave has risks and challenges, just be open and honest about yours.  </small> </p>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              <label > Project Progress Status </label>
			              <textarea class="form-control"  name= "progressStatus"  id="progressStatus" placeholder = ""   style= " width: 400px; height:100px; resize:none;"><?php echo $progressStatus; ?></textarea>
			            </td>
			            <td>
			              <p style="margin:20px 0 0 15px;"><small class="text-muted">  Update the current status of the project. </small> </p>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              <label >Project Progress Percentage</label>
			              <input class="form-control" type="text" name= "progressPercentage"  id="progressPercentage" placeholder = "0" value="<?php echo $progressPercentage; ?>">
			            </td>
			            <td>
			              <p style="margin:20px 0 0 15px;"><small class="text-muted">  Update the completion of the project percentage-wise </small> </p>
			            </td>
			          </tr>
			        </table>
			      </div>
			    </form>
			    <button class="btn btn-primary pull-right" type="button" name= "submitProjectDescription" id="submitProjectDescription" onclick="submitProjectDescription()" > Next </button>
			  </div>

			  <div  id="projectCreatorForm" style=" width:1000px; height:auto; display:none" ><br>
			    <label style="font-size:18px;"> Project Creator </label><br><br>
			    <form  id = "initiativeCreator" method="POST"   style="margin-left:60px;">
			      <table>
			        <tr>
			          <td>
			            <label > Full Name (main contact) </label>
			            <input class="form-control" type="text" name= "creator1Name" aria-required="true" id="creator1Name" placeholder = "" value="<?php echo $userNameArray[0]; ?>" required>
			          </td>
			          <td>
			            <label > Full Name (optional co-creator) </label>
			            <input class="form-control" type="text" name= "creator2Name" aria-required="true" id="creator2Name" placeholder = "" value="<?php echo $userNameArray[1]; ?>"  >
			          </td>
			        </tr>
			        <tr>
			          <td>
			            <label > Your Country </label>
			            <input class="form-control" type="text" name= "creator1Country"  id="creator1Country" placeholder = "" value="<?php echo $userCountryArray[0]; ?>">
			          </td>
			          <td>
			            <label > Your Country </label>
			            <input class="form-control" type="text" name= "creator2Country"  id="creator2Country" placeholder = "" value="<?php echo $userCountryArray[1]; ?>">
			          </td>
			        </tr>
			        <tr>
			          <td>
			            <label > Graduating UWC and Year </label>
			            <input class="form-control" type="text" name= "creator1UWC"  id="creator1UWC" placeholder = "" value="<?php echo $userUWCArray[0]; ?>">
			          </td>
			          <td>
			            <label > Graduating UWC and Year </label>
			            <input class="form-control" type="text" name= "creator2UWC"  id="creator2UWC" placeholder = "" value="<?php echo $userUWCArray[1]; ?>">
			          </td>
			        </tr>
			        <tr>
			          <td>
			            <label >Email<small id="emailWarning" class="text-muted" style="color: #B3B3B3; margin-left: 5px"></small></label>
			            <input class="form-control" type="email" name= "creator1Email"  id="creator1Email" value="<?php echo $userEmailArray[0]; ?>"  placeholder = "Please use the email associated with sign-up." required>
			          </td>
			          <td>
			            <label > Email </label>
			            <input class="form-control" type="email" name= "creator2Email"  id="creator2Email" value="<?php echo $userEmailArray[1]; ?>"  placeholder = "Please use the email associated with sign-up."  >
			          </td>
			        </tr>
			        <tr>
			          <td>
			            <label > Phone Number </label>
			            <input class="form-control" type="text" name= "creator1Phone"  id="creator1Phone" placeholder = "" value="<?php echo $userPhoneArray[0]; ?>">
			          </td>
			          <td>
			            <label > Phone Number </label>
			            <input class="form-control" type="text" name= "creator2Phone"  id="creator2Phone" placeholder = "" value="<?php echo $userPhoneArray[1]; ?>" >
			          </td>
			        </tr>
			        <tr>
			          <td>
			            <label > Profile Picture  </label>
			            <input id="creator1Pic" type="file" name="creator1Pic[]" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" style="margin:0 0 4px 0">
			          </td>
			          <td>
			            <label > Profile Picture  </label>
			            <input id="creator2Pic" type="file" name="creator2Pic[]" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" style="margin:0 0 4px 0">
			          </td>
			        </tr>
			        <tr>
			          <td>
			            <label > Mini Biography </label>
			            <textarea class="form-control"  name= "creator1Biography"  id="creator1Biography"  placeholder = "Describe yourself in 150 characters or less"  style= " width: 400px; height:100px; resize:none;"><?php echo $userBioArray[0]; ?></textarea>
			          </td>
			          <td>
			            <label > Mini Biography </label>
			            <textarea class="form-control"  name= "creator2Biography"  id="creator2Biography"  placeholder = "Describe yourself in 150 characters or less"  style= " width: 400px; height:100px; resize:none;"><?php echo $userBioArray[1]; ?></textarea>
			          </td>
			        </tr>
			      </table>
			      <table id="addExtraCreators" style="display:none; margin-top:50px;">
			        <tr>
			          <td>
			            <label > Full Name (optional co-creator) </label>
			            <input class="form-control" type="text" name= "creator3Name"  id="creator3Name" placeholder = "" value="<?php echo $userNameArray[2]; ?>" required>
			          </td>
			          <td>
			            <label > Full Name (optional co-creator) </label>
			            <input class="form-control" type="text" name= "creator4Name"  id="creator4Name" placeholder = "" value="<?php echo $userNameArray[3]; ?>"  >
			          </td>
			        </tr>
			        <tr>
			          <td>
			            <label > Your Country </label>
			            <input class="form-control" type="text" name= "creator3Country"  id="creator3Country" placeholder = ""  value="<?php echo $userCountryArray[2]; ?>">
			          </td>
			          <td>
			            <label > Your Country </label>
			            <input class="form-control" type="text" name= "creator4Country"  id="creator4Country" placeholder = ""  value="<?php echo $userCountryArray[3]; ?>">
			          </td>
			        </tr>
			        <tr>
			          <td>
			            <label > Graduating UWC and Year </label>
			            <input class="form-control" type="text" name= "creator3UWC"  id="creator3UWC" placeholder = ""  value="<?php echo $userUWCArray[2]; ?>">
			          </td>
			          <td>
			            <label > Graduating UWC and Year </label>
			            <input class="form-control" type="text" name= "creator4UWC"  id="creator4UWC" placeholder = ""  value="<?php echo $userUWCArray[3]; ?>">
			          </td>
			        </tr>
			        <tr>
			          <td>
			            <label >Email<small id="emailWarning" class="text-muted" style="color: #B3B3B3; margin-left: 5px"></small></label>
			            <input class="form-control" type="email" name= "creator3Email"  id="creator3Email" value="<?php echo $userEmailArray[2]; ?>" placeholder = "Please use the email associated with sign-up." required>
			          </td>
			          <td>
			            <label > Email </label>
			            <input class="form-control" type="email" name= "creator4Email"  id="creator4Email" value="<?php echo $userEmailArray[3]; ?>"placeholder = "Please use the email associated with sign-up."  >
			          </td>
			        </tr>
			        <tr>
			          <td>
			            <label > Phone Number </label>
			            <input class="form-control" type="text" name= "creator3Phone"  id="creator3Phone" placeholder = "" value="<?php echo $userPhoneArray[2]; ?>">
			          </td>
			          <td>
			            <label > Phone Number </label>
			            <input class="form-control" type="text" name= "creator4Phone"  id="creator4Phone" placeholder = ""  value="<?php echo $userPhoneArray[3]; ?>">
			          </td>
			        </tr>
			        <tr>
			          <td>
			            <label > Profile Picture  </label>
			            <input id="creator3Pic" type="file" name="creator3Pic[]" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" style="margin:0 0 4px 0">
			          </td>
			          <td>
			            <label > Profile Picture  </label>
			            <input id="creator4Pic" type="file" name="creator4Pic[]" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" style="margin:0 0 4px 0">
			          </td>
			        </tr>
			        <tr>
			          <td>
			            <label > Mini Biography </label>
			            <textarea class="form-control"  name= "creator3Biography"  id="creator3Biography"   placeholder = "Describe yourself in 150 characters or less"  style= " width: 400px; height:100px; resize:none;"><?php echo $userBioArray[2]; ?></textarea>
			          </td>
			          <td>
			            <label > Mini Biography </label>
			            <textarea class="form-control"  name= "creator4Biography"  id="creator4Biography"   placeholder = "Describe yourself in 150 characters or less"  style= " width: 400px; height:100px; resize:none;"><?php echo $userBioArray[3]; ?></textarea>
			          </td>
			        </tr>
			      </table>
			    </form>
			    <button class="btn btn-default pull-left" type="button" id="submitAddExtraCreators" onclick="addExtraCreators()" style="margin:20px auto;"> Add Extra Creators </button>
			    <button class="btn btn-primary pull-right" type="button" name="submitProjectCreator" id="submitProjectCreator" onclick="submitProjectCreator()" style="margin:20px 30px 0 0px;" > Next </button>
			    <button class="btn btn-primary pull-right" type="button" onclick="goToProjectDescription()" style="margin:20px 15px 0 0;"> Previous </button>
			  </div>

			  <div  id="projectAdvisorForm" style=" width:1000px; height:auto; display:none" ><br>
			    <label style="font-size:18px;"> Faculty Advisor </label><br><br>
			    <form  id = "initiativeAdvisor" method="POST"   style="margin-left:60px;">
			      <table>
			        <tr>
			          <td>
			            <label > Full Name </label>
			            <input class="form-control" type="text" name= "advisor1Name"  id="advisor1Name" placeholder = "" value="<?php echo $advisorNameArray[0]; ?>" style="width:400px;" required >
			          </td>
			          <td>
			            <label > Full Name (optional co-advisor) </label>
			            <input class="form-control" type="text" name= "advisor2Name"  id="advisor2Name" placeholder = "" value="<?php echo $advisorNameArray[1]; ?>" style="width:400px;" >
			          </td>
			        </tr>
			        <tr>
			          <td>
			            <label > Email </label>
			            <input class="form-control" type="email" name= "advisor1Email"  id="advisor1Email" placeholder = "" value="<?php echo $advisorEmailArray[0]; ?>" style="width:400px;" required>
			          </td>
			          <td>
			            <label > Email </label>
			            <input class="form-control" type="email" name= "advisor2Email"  id="advisor2Email" placeholder = "" value="<?php echo $advisorEmailArray[1]; ?>" style="width:400px;" >
			          </td>
			        </tr>
			      </table>
			      <table id="addExtraAdvisors" style="display:none; margin-top:50px;">
			        <tr>
			          <td>
			            <label > Full Name (optional co-advisor) </label>
			            <input class="form-control" type="text" name= "advisor3Name"  id="advisor3Name" placeholder = "" value="<?php echo $advisorNameArray[2]; ?>" style="width:400px;" required >
			          </td>
			          <td>
			            <label > Full Name (optional co-advisor) </label>
			            <input class="form-control" type="text" name= "advisor4Name"  id="advisor4Name" placeholder = "" value="<?php echo $advisorNameArray[3]; ?>" style="width:400px;" >
			          </td>
			        </tr>
			        <tr>
			          <td>
			            <label > Email </label>
			            <input class="form-control" type="email" name= "advisor3Email"  id="advisor3Email" placeholder = "" value="<?php echo $advisorEmailArray[2]; ?>" value="<?php echo $advisorNameArray[1]; ?>" style="width:400px;" required>
			          </td>
			          <td>
			            <label > Email </label>
			            <input class="form-control" type="email" name= "advisor4Email"  id="advisor4Email" placeholder = "" value="<?php echo $advisorEmailArray[3]; ?>" style="width:400px;" >
			          </td>
			        </tr>
			      </table>
			    </form>
			    <button class="btn btn-default pull-left" type="button" id="submitAddExtraAdvisors" onclick="addExtraAdvisors()" style="margin:20px auto;"> Add Extra Advisors </button>
			    <button class="btn btn-primary pull-right" type="button" onclick="goToProjectCreator()" style="margin:20px 75px 0 0px;"> Previous </button>
			    <button class="btn btn-success" type="button" name= "submitInitiative" id="submitInitiative" onclick='updateInitiative("update", <?php echo $projectId; ?>, <?php echo $userIdArray;?>, <?php echo $advisorIdArray;?> )' style="margin: 50px 0 0 24%; font-size:20px; font-weight:bold;"> Update Project </button>
			  </div>
			  <div id="fillAllRequiredFieldsAlert" class="alert alert-warning" style="display:none; text-align:center; margin-top:40px;">
				  <strong>Warning!</strong> Make sure all of the required fields are filled!
				</div>
			</div>

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
			<script type="text/javascript">
				var userNameArrayLength = <?php echo json_encode(sizeof($userNameArray)); ?>;
				var advisorNameArrayLength = <?php echo json_encode(sizeof($advisorNameArray)); ?>;

				if (userNameArrayLength >2){
					$("#addExtraCreators").show();
					$("#submitAddExtraCreators").hide();
				}
				if (advisorNameArrayLength >2){
					$("#addExtraAdvisors").show();
					$("#submitAddExtraAdvisors").hide();
				  $("#submitInitiative").css("margin-left", "40%");
				}

			</script>
		</div>

		<footer style="position-fixed; margin-top:75px">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<h6>Copyright &copy; 2013 CodeCOOP</h6>
					</div>
					<div class="col-sm-5">
						<h6>About Us</h6>
						<p>UWCNEXT is a student initiative designed to help students and alumni make changes around the world. Use this page to post your grand ideas for helping those in need. With the ability to post different projects and receive help from anybody interested, causing change and helping others has never been easier. Just make an account to get started!</p>
					</div>
					<div class="col-sm-1">
						<h6> Navigation</h6>
						<ul class="unstyled">
							<li><a href="index.php">Home</a></li>
							<li><a href="help.php" target="_blank">Help</a></li>
							<li><a href="contactUs.php" target="_blank">Contact Us</a></li>
						</ul>
					</div>
					<div class="col-sm-2">
						<h6> Follow us</h6>
						<ul class="unstyled">
							<li><a href="#">Twitter</a></li>
							<li><a href="https://www.facebook.com/groups/1418146461731398/" target="_blank">Facebook</a></li>
							<li><a href="#">Google Plus</a></li>
						</ul>
					</div>
					<div class="col-sm-2">
						<h6>Coded with <span class="glyphicon glyphicon-heart"></span> by VB & AS </h6>
					</div>
				</div>
			</div>
		</footer>
	</body>
</html>


