<?php
ob_start();
session_start();
include 'includes/Bluehost_connect.php';
?>

<?php

$URI_QUERY     = parse_str(urldecode($_SERVER['QUERY_STRING']));
$projectId     = $PROJECT / 79.99;
$descriptionId = $ID / 89.99;

$data      = mysql_fetch_object(mysql_query("SELECT COUNT(id) AS num_rows FROM  `PROJECT` WHERE `ID`='" . $projectId . "' "));
$totalRows = $data->num_rows;

if (($projectId !== "") && ($totalRows != 0) && ($descriptionId == 10 || $descriptionId == 11 || $descriptionId == 12)) {
  $query = "SELECT  * FROM  `PROJECT` WHERE `ID`='" . $projectId . "' LIMIT 1 ";
} else {
  header("Location: 404.php");  /* Redirect browser */
}
$result = mysql_query($query, $connection);
if (!$result) {
  $message = 'Invalid query: ' . mysql_error() . "\n";
  $message .= 'Whole query: ' . $query;
  die($message);
}
while ($subject = mysql_fetch_assoc($result)) {
  $projectName  = ($subject['NAME']);
  $projectBlurb = ($subject['SHORT_BLURB']);
  $category     = ($subject['CATEGORY']);
  $image        = ($subject['IMAGE']);
  $location     = ($subject['LOCATION']);
  $country      = ($subject['COUNTRY']);
  $budget       = ($subject['FUNDING']);
  $description  = ($subject['DESCRIPTION']);
  $benefit      = ($subject['BENEFIT']);
  $challenges   = ($subject['RISKS_CHALLENGES']);
  $videoLink    = ($subject['VIDEO']);
  $dummyVideo = ($descriptionId==11? 'img/uploadVideo.jpg' : 'img/sorryVideo.jpg');
  if ($videoLink != "" || $videoLink != null && $descriptionId ==10) {
    if (strpos($videoLink, "youtube") !== false) {
      $videoLink = str_replace('watch?v=', 'embed/', $videoLink);
    } else if (strpos($videoLink, "vimeo") !== false) {
      $newstring = preg_replace("/[^0-9]/", '', $videoLink);
      $videoLink = "//player.vimeo.com/video/" . $newstring . "?portrait=0&amp;badge=0";
    } else {
      $videoLink = $dummyVideo;
    }
  } else {
    $videoLink = $dummyVideo;
  }

  $lookingFor         = ($subject['LOOKING_FOR']);
  $lookingForArray    = (explode(",", $lookingFor));
  $progressPercentage = ($subject['PROGRESS_PERCENTAGE']);
  $timeStamp          = new DateTime($subject['DATETIME']);
  $date               = $timeStamp->format('m/d/Y');
}


// ///////////////////////////////////////////////////////////////////////////////////////////

$getCreatorQuery  = "SELECT  * FROM  `PROJECT_CREATOR` WHERE `PROJECT_ID`='$projectId' ORDER BY `ID` ASC";
$getCreatorResult = mysql_query($getCreatorQuery, $connection);
if (!$getCreatorResult) {
  $message = 'Invalid query: ' . mysql_error() . "\n";
  $message .= 'Whole query: ' . $getCreatorQuery;
  die($message);
}
$userNameArray    = array();
$userEmailArray   = array();
$userPhoneArray   = array();
$userCountryArray = array();
$userUWCArray     = array();
$userUWCYearArray = array();
$userImageArray   = array();
$teamRoleArray    = array();

while ($subject = mysql_fetch_assoc($getCreatorResult)) {
  $projectIdForCreators = ($subject['PROJECT_ID']);
  $creatorName          = ($subject['CREATOR_NAME']);
  $creatorEmail         = ($subject['CREATOR_EMAIL']);
  $creatorRole          = ($subject['CREATOR_ROLE']);
  if ($projectId == $projectIdForCreators) {
    array_push($userNameArray, $creatorName);
    array_push($userEmailArray, $creatorEmail);
    array_push($teamRoleArray, $creatorRole);
  }
}

for ($i = 0; $i < sizeof($userEmailArray); $i++) {
  // Get info asociated with the user 
  $userInfoQuery  = "SELECT * FROM `USER_INFO` WHERE `EMAIL`= '$userEmailArray[$i]' ";
  $userInfoResult = mysql_query($userInfoQuery, $connection);
  if (!$userInfoResult) {
    $message = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $userInfoQuery;
    die($message);
  }
  while ($subject = mysql_fetch_assoc($userInfoResult)) {
    $name        = ($subject['NAME']);
    $Usercountry = ($subject['COUNTRY']);
    $UWC         = ($subject['UWC']);
    $UWCYear     = ($subject['UWC_YEAR']);
    $phone       = ($subject['PHONE']);
    $profilePic  = ($subject['PROFILE_PIC']);
    array_push($userCountryArray, $Usercountry);
    array_push($userUWCArray, $UWC);
    array_push($userUWCYearArray, $UWCYear);
    array_push($userPhoneArray, $phone);
    array_push($userImageArray, $profilePic);
  }
}
?>

<?php mysql_close($connection);?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>
    <?php echo $projectName; ?>
  </title>
  <meta charset="utf-8">
  <meta name="description" content="<?php echo $projectBlurb; ?>">
  <meta name="image" content="https://ocf.co/projects/uploads/<?php echo $image; ?>">
  <meta name="keywords" content="Our Common Future, Online UWC, United World Colleges, Alumni, Crowdfunding, Social Innovation, Social Entrepreneur, Community, Startups, Initiatives, Projects, Fund Raising ">
  <!-- Twitter Card data --> 
  <meta name="twitter:title" content="<?php echo $projectName; ?>"> 
  <meta name="twitter:description" content="<?php echo $projectBlurb; ?>"> 
  <meta name="twitter:image" content="https://ocf.co/projects/uploads/<?php echo $image; ?>">
  <!-- Open Graph data --> 
  <!-- Twitter Card data --> 

  <!-- Open Graph data --> 
  <meta property="og:title" content="<?php echo $projectName; ?>" /> 
  <meta property="og:type" content="article" /> 
  <meta property="og:image" content="https://ocf.co/projects/uploads/<?php echo $image; ?>" />
  <meta property="og:description" content="<?php echo $projectBlurb; ?>" />

  <meta name="author" content="Our Common Future ">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen">
  <link rel="stylesheet" href="css/responsive.css" type="text/css" media="screen">
  <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
  <link rel="stylesheet" href="css/details.css" type="text/css" media="screen">
  <link rel="stylesheet" href="css/touchTouch.css" type="text/css" media="screen">
  <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/tm_docs.css" type="text/css" media="screen">
  <link href="css/jquery.notifyBar.css" rel="stylesheet" media="screen">

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/superfish.js"></script>
  <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
  <script type="text/javascript" src="js/jquery.cookie.js"></script>
  <script src="js/forms.js"></script>
  <script type="text/javascript" src="js/touchTouch.jquery.js"></script>
  <script type="text/javascript" src="js/jquery.notifyBar.js"></script>
  <script type="text/javascript">
  if ($(window).width() > 1024) {
    document.write("<" + "script src='js/jquery.preloader.js'></" + "script>");
  }
  </script>
  <script>
  jQuery(window).load(function () {
    $x = $(window).width();
    if ($x > 1024) {
      jQuery("#content .row").preloader();
    }

    jQuery(".list-blog li:last-child").addClass("last");
    jQuery(".list li:last-child").addClass("last");
    jQuery('.spinner').animate({
      'opacity': 0
    }, 1000, 'easeOutCubic', function () {
      jQuery(this).css('display', 'none')
    });
    jQuery('.magnifier').touchTouch();
  });
  </script>

  <!-- PHP files -->
  <?php include 'modal.php'; ?>
  <!-- Includes all modal (login, signup, contact, feedback) -->


  <!--[if lt IE 8]>
      <div style='text-align:center'><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://www.theie6countdown.com/img/upgrade.jpg"border="0"alt=""/></a></div>  
  <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!-->
  <!--<![endif]-->
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link rel="stylesheet" href="css/docs.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400' rel='stylesheet' type='text/css'>
  <![endif]-->

  <!--Google analytics code-->
  <script type="text/javascript">
  //         var _gaq = _gaq || [];
  //        _gaq.push(['_setAccount', 'UA-29231762-1']);
  //        _gaq.push(['_setDomainName', 'dzyngiri.com']);
  //        _gaq.push(['_trackPageview']);

  //        (function() {
  //          var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  //          ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  //          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  //        })();
  //
  </script>
</head>

<body>
  <div class="spinner"></div>
  <header>
    <?php include 'includes/header.php'; ?>
  </header>

  <div class="bg-content">
    <!--  content  -->
    <div id="content">
      <div class="ic"></div>
      <div class="row-1">
        <div class="container">
          <div class="row">
            <article class="span12">
              <div class="inner-1">
                <h3 style="text-align:center;"><?php echo $projectName; ?></h3>
                <h6 style="text-align:center; padding-bottom:20px; "><a href="#" ><i class="icon-globe "></i> <?php echo $location; ?>, <?php echo $country; ?></a> </h6>
                <div style="width:auto; margin:auto;">
                  <hr>
                  <div id="authorDiv" class="name-author"><i class="icon-home"></i>  <a href="#story-tab" data-toggle="tab">Story</a></div>
                  <div class="i-update"><i class="icon-bullhorn"></i>  <a href="#updates_tab" data-toggle="tab" onclick="showUpdates()">Bulletin Board</a></div>
                  <div class="i-update"><i class="icon-star-empty"></i>  <a href="#funders_tab" data-toggle="tab" onClick="showSupporters()">Supporters</a></div>
                  <div class="i-update"><i class="icon-film"></i>  <a href="#gallery_tab" data-toggle="tab" onclick="loadGallery()">Gallery</a></div>
                  <div class="i-update"><i class="icon-user"></i>  <a href="#team_tab" data-toggle="tab" onclick="meetOurCrew()">Team</a></div>
                  <div class="i-comm"><i class="icon-comment"></i>  <a href="#comments_tab" data-toggle="tab" onclick="showComments()">Community</a></div>
                  <div class="clear"></div>
                  <hr>
                </div>
                <article class="span8">
                  <div class="row">
                    <div class="tab-content" style="overflow:none">
                      <div class="tab-pane active" id="story-tab">
                        
                        <div id ="video_upload_div" class="vidDiv" style="text-align:center; padding:16px;">
                        <?php if ($videoLink=="img/uploadVideo.jpg" || $videoLink=="img/sorryVideo.jpg"){?>
                          <img src="<?php echo $videoLink; ?>" style="overflow:none;">
                        <?php } else {?>
                          <iframe width="700" height="513" style="overflow:none;"src="<?php echo $videoLink; ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> 
                        <?php } ?>

                        </div>
                         <!-- <h4 id="noVideo" style="font-size:20px;color:#008B8B;text-align:center;">Video Coming Soon...</h4>  -->
                        <div class="links" style="padding-top:10px; ">
                          <!-- Go to www.addthis.com/dashboard to customize your tools -->
                          <span class='st_facebook_hcount' displayText='Facebook'></span>
                          <span class='st_twitter_hcount' displayText='Tweet'></span>
                          <span class='st_linkedin_hcount' displayText='LinkedIn'></span>
                          <span class='st_digg_hcount' displayText='Digg'></span>
                          <span class='st_email_hcount' displayText='Email'></span> 
                        </div>

                        <?php if ($_SESSION[ "uid"] !="" || $_SESSION[ "uid"] !=null){ if ($descriptionId==10) {?>
                          <div class="followDetails"><span><a onclick="actionForm('<?php echo $projectId; ?>', 0)" class="btn btn-warning tm_style_4 pull-right" style="font-weight:bold;">Follow</a></span></div>
                        <?php } else if ($descriptionId==11) {?>
                          <span><a onclick="actionForm('<?php echo $projectId; ?>', 3)" class="btn btn-warning tm_style_4 pull-right" style="font-weight:bold;;"><i class="icon-edit" style ="margin-right:5px"></i>Edit</a></span> 
                        <?php } else if ($descriptionId==12) {?>
                          <span><a onclick="actionForm('<?php echo $projectId; ?>', 5)" class="btn btn-warning tm_style_4 pull-right" style="font-weight:bold;"><i class="icon-minus-sign" style ="margin-right:5px"></i>Unfollow</a></span>
                        <?php } }else { ?>
                          <span><a href="../login_page.php" class="btn btn-warning tm_style_4 pull-right" style="font-weight:bold;"><i class="icon-plus-sign" style ="margin-right:5px"></i>Follow</a></span> 
                        <?php } ?>

                        <div class="full-info" style="margin-top:40px;">
                          <div class="proj_blurb">
                            <h5>Pitch</h5>
                            <p>
                              <?php echo $projectBlurb; ?>
                            </p>
                          </div>
                          <div class="proj_desc">
                            <h5>Description</h5>
                            <p>
                              <?php echo $description; ?>
                            </p>
                          </div>
                          <div class="proj_benefits">
                            <h5>Benefits</h5>
                            <p>
                              <?php echo $benefit; ?>
                            </p>
                          </div>
                          <div class="risk">
                            <h5>Risks and Challenges</h5>
                            <p>
                              <?php echo $challenges; ?>
                            </p>
                          </div>
                          <div class="looking_for" >
                            <h5 style="margin-bottom:-10px">Looking For</h5>
                            <p><?php for ($i = 0; $i < sizeof($lookingForArray); $i++){echo ("<li><p style='padding-bottom:5px'>".$lookingForArray[$i]."</p></li>");}; ?></p>
                          </div>
                          <div class="faq" >
                            <h4>Questions?</h4>
                            <p>Have question/thoughts/concerns? Feel free to drop the initiative creator a line. Thanks!</p>
                            <a id="sendEmailToCreator" class="btn btn-info tm_style_3 pull-left" style="font-weight:bold; font-size:20px; margin-bottom:50px">To Initiator</a>
                            <!-- <a id="sendEmailToTeam" class="btn btn-primary pull-left" style="font-weight:bold; font-size:20px;">To Team</a> -->

                            <article style="margin-top:45px; display:none" id="contactInitiatorForm" class="span5">
                              <div class="inner-1">
                                <div class="col-md-6">
                                  <form class="form-horizontal" role="form" id="contactForm" method="POST">
                                    <div class="form-group">
                                      <input class="form-control" id="visitorName" name="visitorName" placeholder="Your name" style="width:435px" value="<?php echo $_SESSION['name']; ?>">
                                    </div>
                                    <div class="form-group">
                                      <input class="form-control" id="visitorEmail" name="visitorEmail" placeholder="Your email address" style="width:435px" value="<?php echo $_SESSION['email']; ?>">
                                    </div>
                                    <div class="form-group">
                                      <input class="form-control" id= "subject" name="subject" placeholder="E-mail Subject" style="width:435px">
                                    </div>
                                    <div class="form-group">
                                      <textarea class="ckeditor" id="initiatorMessage" name="initiatorMessage" cols="80" rows="12">       
                                      </textarea>
                                    </div>
                                    <div >
                                      <button class="btn btn-success pull-right"  onclick="contactInitiator()"> SEND</button>
                                    </div>
                                  </form>  
                                </div>
                                <div class="success" style="display:none;">Your message has been sent succesfully!<strong> We will be in touch soon.</strong> </div>

                               <!--  <form id="contact-form">
                                  <div class="success">Your message has been sent succesfully!<strong> We will be in touch soon.</strong> </div>
                                  <fieldset>
                                    <div>
                                      <label class="name">
                                        <input id="initiatorName" type="text" value="Your name">
                                        <br>
                                        <span class="error">*This is not a valid name.</span>  <span class="empty">*Name is required.</span> 
                                      </label>
                                    </div> -->
                                    <!-- <div>
                                      <label class="phone">
                                        <input type="tel" value="Telephone">
                                        <br>
                                        <span class="error">*This is not a valid phone number.</span> 
                                      </label>
                                    </div> -->
                                    <!-- <div>
                                      <label class="email">
                                        <input id="initiatorEmail"  type="email" value="Email">
                                        <br>
                                        <span class="error">*This is not a valid email address.</span>  <span class="empty">*Valid email is required.</span> 
                                      </label>
                                    </div>
                                    <div>
                                      <label class="message">
                                        <textarea>Message</textarea>
                                        <br>
                                        <span class="error">*The message is too short.</span>  <span class="empty">*Valid message text is required.</span> 
                                      </label>
                                    </div>
                                    <div class="buttons-wrapper"> <a class="btn btn-1" data-type="reset">Clear</a>  <a class="btn btn-1" data-type="submit" >Send</a> -->
                                    <!-- </div>
                                  </fieldset>
                                </form>
 -->                                <div  style="display:none">
                                  <input id="owner_email" name="owner_email" type="email" value="<?php echo $userEmailArray[0]; ?>">
                                </div>
                              </div>
                            </article>
                          </div>
                        </div>
                      </div>
                      <div id="noUpdates" style="margin-top:-10px;display:none;"><h5 style="font-size:15px;">There are currently no updates.</h5> 
                      </div> 

                      <div class="tab-pane" id="updates_tab">
                      <h5 id ="headingUpdates"></h5> 
                        <div id="updates"></div>
                        <!-- DC Divider Start -->
                        <div class="tsc_divider4"></div>
                        <div class="tsc_divider4_black"></div>
                        <!-- DC Divider End -->
                        <!-- <div class="pagination">
                          <ul class="tsc_pagination tsc_paginationB tsc_paginationB04">
                            <li><a href="#" class="first">First</a>
                            </li>
                            <li><a href="#" class="previous">Previous</a>
                            </li>
                            <li><a href="#">1</a>
                            </li>
                            <li><a href="#">2</a>
                            </li>
                            <li><a href="#" class="current">3</a>
                            </li>
                            <li><a href="#" class="next">Next</a>
                            </li>
                            <li><a href="#" class="last">Last</a>
                            </li>
                          </ul>
                        </div> -->
                      </div>

                      <div class="tab-pane" id="funders_tab" style="margin-left:20px;">
                         <!--  <h3>Coming Soon... </h3>
                          <img alt="" title="" style="padding-top:40px; max-height:50%;" src="img/uc.png"> -->
                          <h4 style="text-align:center;">Want to support this Initiative?</h4>
                          <div style="text-align:center;">
                          <div class="supporter_form col-md-5">
                            <form id="supporterForm" class="form-horizontal">
                              <fieldset>
                                <!-- Form Name -->
                                <!-- <legend>What would you like to Pledge for?</legend> -->
                                <!-- Text input-->
                                <div class="form-group ">
                                  <label class="col-md-4 control-label" for="fullName">Your Full Name</label>
                                  <div class="col-md-5">
                                    <input id="fullName" name="fullName" type="text" value="<?php echo $_SESSION['name']; ?>" class="form-control input-md" required="">
                                  </div>
                                </div>
                                <br>
                                <!-- Text input-->
                                <div class="form-group">
                                  <label class="col-md-4 control-label" for="emailId">Your Email Address</label>
                                  <div class="col-md-4">
                                    <input id="emailId" name="emailId" type="text" value="<?php echo $_SESSION['email']; ?>" class="form-control input-md" required="">
                                  </div>
                                </div>
                                <br>
                                <!-- Text input-->
                                <!-- <div class="form-group">
                                  <label class="col-md-4 control-label" for="pledge">What would you like to Pledge for: </label>
                                  <div class="col-md-5">
                                    <select id="selectPledge" name="selectPledge" class="form-control">
                                    <option value="">Select</option>
                                      <option value="Resources">Resources (Furnitures, Volunteers, etc)</option>
                                      <option value="Financial">Financial</option>
                                      <option value="Other">Other</option>
                                      
                                    </select>
                                    
                                  </div>
                                </div>
                                <br> -->
                                <!-- Textarea -->
                                <div class="form-group">
                                  <label class="col-md-6 control-label" for="message">Please explain your Pledge briefly</label>
                                  <div class="col-md-6">
                                    <textarea class="form-control"  style="width:300px; height:90px;"id="pledgeMessage" name="pledgeMessage" placeholder="here..."></textarea>
                                  </div>
                                </div>
                                <br>

                                <!-- Button -->
                                <div class="form-group">
                                  <label class="col-md-4 control-label" for="supportbutton"></label>
                                  <div class="col-md-4">
                                    <button id="supportbutton" name="supportbutton"style="font-size:20px;" class="btn btn-info tm_style_3">Done!</button>
                                  </div>
                                </div>
                              </fieldset>
                            </form>
                          </div>
                          <hr>
                          <h4 id="pledgeHeading"style="text-align:center;font-size:20px;"></h4>                         </div>
                         <div id="supporters"></div>
                      </div>


                      <div class="tab-pane" id="gallery_tab">
                        <h4 id ="galleryHeading" style ="font-size:20px;">There are no images/videos.Please check later.</h4>                        <br>
                        <div class="media">
                          <ul id="gallery" class="portfolio clearfix">
                            <!-- <li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/work/1.jpg"></a></li> -->
                          </ul>
                        </div>
                      </div>

                      <div class="tab-pane" id="team_tab">
                        <div class="table_team">
                          <h4>Meet our Crew</h4>
                          <div id="content">
                            <div class="ic"></div>
                            <article class="span8">
                              <div class="clear"></div>
                              <ul id="projectCrew" class="portfolio ">
                              </ul>
                            </article>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane" id="comments_tab">
                        <div class="comments_div">
                          <h4 id ="feedbackHeading" style="font-size:20px;"></h4> 
                           <br>
                          <div id="comments" class="comments_div" style="margin-bottom:50px;">
                          </div>

                          <!-- <div class="pagination" style="margin-bottom:90px; ">
                            <ul class="tsc_pagination tsc_paginationB tsc_paginationB04">
                              <li><a href="#" class="first">First</a>
                              </li>
                              <li><a href="#" class="previous">Previous</a>
                              </li>
                              <li><a href="#">1</a>
                              </li>
                              <li><a href="#">2</a>
                              </li>
                              <li><a href="#" class="current">3</a>
                              </li>
                              <li><a href="#" class="next">Next</a>
                              </li>
                              <li><a href="#" class="last">Last</a>
                              </li>
                            </ul>
                          </div> -->


                          <div class="comment_form">
                            <form id="feedbackForm" lass="form-horizontal">
                              <fieldset>
                                <!-- Form Name -->
                                <legend>We would love to hear your comments/thoughts/feedback</legend>
                                <!-- Text input-->
                                <div class="form-group">
                                  <label class="col-md-4 control-label" for="fullName">Your Full Name</label>
                                  <div class="col-md-5">
                                    <input id="fullName" name="fullName" type="text" placeholder="full Name" class="form-control input-md" required="" value="<?php echo $_SESSION['name']; ?>">
                                  </div>
                                </div>
                                <br>
                                <!-- Text input-->
                                <div class="form-group">
                                  <label class="col-md-4 control-label" for="emailId">Your Email Address</label>
                                  <div class="col-md-4">
                                    <input id="emailId" name="emailId" type="text" placeholder="e-mail " class="form-control input-md" required="" value="<?php echo $_SESSION['email']; ?>">
                                  </div>
                                </div>
                                <br>
                                <!-- Textarea -->
                                <div class="form-group">
                                  <label class="col-md-4 control-label" for="message">Comment/Feedback/Thoughts</label>
                                  <div class="col-md-4">
                                    <textarea class="form-control" id="message" name="message" placeholder="drop us a line..."></textarea>
                                  </div>
                                </div>
                                <br>

                                <!-- Button -->
                                <div class="form-group">
                                  <label class="col-md-4 control-label" for="singlebutton"></label>
                                  <div class="col-md-4">
                                    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Submit</button>
                                  </div>
                                </div>
                              </fieldset>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </article>

                <article class="span3 " style="margin-top:20px;">
                  <div class="tm_raised">
                    <div class="tm_text-shadow">
                      <div class="top-right-box">
                        <h5 style="text-align:center;">Project Progress</h5>
                        <hr>
                        <div class="m-container">
                          <!-- <div class="m-raised">
                            <h4>$000</h4>
                            <em> Raised</em>
                          </div> -->
                          <!-- <div class="m-goal">
                            <h4>$<?php /*echo $budget; */?></h4>
                            <em> Goal</em>
                          </div> -->
                        </div>
                        <div class="prog">
                          <!-- <h5>Progress</h5> -->
                          <?php echo $progressPercentage.'%'; ?> <span class="pull-right"></span>
                          <div class="progress progress-striped active">
                            <div class="bar" style="width: <?php echo $progressPercentage; ?>%;"></div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <!-- <h5 style="text-align:center;">We also need</h5>
                          <hr>
                          <div class="thingsNeeded" style="text-align:center; padding-bottom:15px; padding-top:20px;"> -->
                            <!-- <ul> -->
                            <?php 

                            /*for ($i = 0; $i < sizeof($lookingForArray); $i++){
                              echo ("<li><p>".$lookingForArray[$i]."</p></li>");}; 
                              */
                              ?>
                            <!-- </ul> -->
                          <!-- </div> -->
                          <div style="padding-bottom:10px;">
                            <!-- <h5 style="text-align:center;">want to help?</h5> -->
                          </div>
                          <div class="pitchIn">
                          <?php if ($_SESSION[ "uid"] !="" || $_SESSION[ "uid"] !=null){ if ($descriptionId==10) {?>
                            <a href="#funders_tab" data-toggle="tab" id="pi" class="btn btn-info tm_style_3 " style="font-size:20px;">I want to help!</a>                            
                          <?php } }else { ?>
                            <a href="../login_page.php" id="pi" class="btn btn-info tm_style_3 " style="font-size:20px;">I want to help!</a>                            
                          <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tm_raised">
                    <div class="tm_text-shadow">
                      <div class="mid-right-box">
                        <h5>Meet the Creator</h5>
                        <br>
                        <?php if ($userImageArray[0] !="" ) {?>
                        <div class="col-sm-6 col-md-4">
                          <img style="cursor:pointer" onclick="showUserProfile('<?php echo $userEmailArray[0]; ?>')" src="<?php echo uploads . '/' . $userImageArray[0]; ?>" alt="" class="img-circle" />
                        </div>
                        <?php } else { ?>
                        <div class="col-sm-6 col-md-4">
                          <img src="uploads/member.png" alt="" class="img-circle" />
                        </div>
                        <?php } ?>
                        <div class="col-sm-6 col-md-8">
                          <br>
                          <h5 style="margin-bottom:0px" onclick="showUserProfile('<?php echo $userEmailArray[0]; ?>')"><?php echo $userNameArray[0]; ?></h5> 
                          <br>
                          <cite title="San Francisco, USA"><?php echo $userCountryArray[0]; ?> </cite>
                          <br>
                          <div class="uwc_name">
                            <cite title="San Francisco, USA"><?php echo $userUWCArray[0]; ?> <?php echo $userUWCYearArray[0]; ?> </cite>
                          </div>                        
                          <br>
                          <div class="btn-group">
                            <button type="button" style="margin-bottom:8px" class="btn btn-info tm_style_3">
                              <span class="sr-only" onclick="showUserProfile('<?php echo $userEmailArray[0]; ?>')">Full Profile</span>
                            </button>
                          </div>

                          <div id="showMembers" style="margin-top:60px;">
                            <h5>Members</h5>
                            <br>
                            <div class="memberInfo">
                              <ul id="userIcons" class="portfolio">
                              </ul>
                            </div>
                            <div class="image-clear"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </article>
              </div>
            </article>
          </div>
        </div>
      </div>
      <!-- ABOUT US -->
      <?php include 'includes/aboutUs.php'; ?>
    </div>
  </div>

  <!-- footer -->
  <?php include 'includes/footer.php'; ?>


  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="uwcnext.js"></script>
  <script type="text/javascript" src="script.js"></script>
  <script type="text/javascript" src="ckeditor/ckeditor.js"></script>

  <script type="text/javascript">
  var switchTo5x = true;
  </script>
  <script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
  <script type="text/javascript">
  stLight.options({
    publisher: "f3aed800-c243-4ca2-9542-fed414ae2458",
    doNotHash: false,
    doNotCopy: false,
    hashAddressBar: false
  });
  </script>
  <script type="text/javascript">
  window.uid = <?php echo json_encode($_SESSION['uid']); ?> ;
  window.userName = <?php echo json_encode($_SESSION["name"]); ?> ;
  window.userEmail = <?php echo json_encode($_SESSION["email"]); ?> ;
  window.projectId = <?php echo json_encode($projectId); ?> ;
  window.projectName = <?php echo json_encode($projectName); ?> ;
  var userNameArray = <?php echo json_encode($userNameArray); ?> ;
  var userEmailArray = <?php echo json_encode($userEmailArray); ?> ;
  var userUWCArray = <?php echo json_encode($userUWCArray); ?> ;
  var userUWCYearArray = <?php echo json_encode($userUWCYearArray); ?> ;
  var userImageArray = <?php echo json_encode($userImageArray); ?> ;
  var teamRoleArray = <?php echo json_encode($teamRoleArray); ?> ;

  $(document).ready(function () {
    $("#createProjectButton").click(function () {
      if (uid == "" || uid == null) {
        $("#loginModal").modal("show");
      }
    });
    $("#sendEmailToCreator").click(function () {
      $('input[name=owner_email]').val(userEmailArray[0]);
      if ($("#contactInitiatorForm").is(":visible")){ $("#contactInitiatorForm").hide('slow'); }
      if ($("#contactInitiatorForm").is(":hidden")){$("#contactInitiatorForm").slideDown('slow');}
    });

  });

  $("#userIcons").html();
  if (userNameArray.length == 1) {
    $("#showMembers").html("");
  }
  for (var i = 1; i < userNameArray.length; i++) {
    var profilePic = userImageArray[i];
    var userName = userNameArray[i];
    var userEmail = userEmailArray[i];
    if (profilePic == "" || profilePic == undefined) {
      profilePic = "member.png";
    }
    $("#userIcons").append('<li class="span1" style="margin-bottom:15px;"><div ><img style="width:70px; height:70px" src="uploads/' + profilePic + '" class="img-circle"></div><br><a style="cursor:pointer" href="profile.php?USEREMAIL=' + userEmail + '"><b>' + userName + '</b></a><li>');
  }

  function meetOurCrew() {
    $("#projectCrew").html("");
    for (var i = 0; i < userNameArray.length; i++) {
      var userName = userNameArray[i];
      var role = teamRoleArray[i];
      var uwc = userUWCArray[i];
      var uwcYear = userUWCYearArray[i];
      var userEmail = userEmailArray[i];
      if (uwc == "" || uwc == undefined) {
        uwc = "";
      }
      var profilePic = userImageArray[i];
      if (profilePic == "" || profilePic == undefined) {
        profilePic = "member.png";
      }
      $("#projectCrew").append('<li class="span3" style="margin-bottom:25px; "><div class="mid-right-box" style="height:310px;"><div class="col-sm-6 col-md-4"><a href="profile.php?USEREMAIL=' + userEmail + '"><img src="uploads/' + profilePic + '" alt="" style="margin-bottom:30px;max-width:125px; max-height:130px;" class="img-circle img-responsive"/></a></div><div class="col-sm-6 col-md-8" style="margin:auto"><a style="" href="profile.php?USEREMAIL=' + userEmail + '"><h5>' + userName + '</h5></a> <b><cite>' + role + '</cite></b><br><b><cite>' + uwc + '</cite><cite style="margin-left:5px">' + uwcYear + '</cite></b><div style="margin-top:10px;" class="btn-group"> <a href="profile.php?USEREMAIL=' + userEmail + '" class="btn btn-primary dropdown-toggle" ><span class="sr-only">  Full Profile</span></a></div</div></li>');
    }
  }

  function showUpdates() {
    $("#updates").html("");
    $.ajax({
      type: "POST",
      url: "updatesProject.php",
      data: {
        id: projectId,
        action: "get"
      },
    }).done(function (response) {
      response = JSON.parse(response);
      console.log(response);
      if(response.length>0){
        $("#headingUpdates").html("Recent Updates");
      for (var i = 0; i < response.length; i++) {
        var name = (response[i].USER_NAME == undefined) ? "" : response[i].USER_NAME;
        var email = (response[i].USER_EMAIL == undefined) ? "" : response[i].USER_EMAIL;
        var updates = (response[i].UPDATES == undefined) ? "" : response[i].UPDATES;
        var datetime = (response[i].DATETIME == undefined) ? "" : response[i].DATETIME;
        $("#updates").append('<div class="update_number"> <hr><time datetime="2012-11-09" class="date-1"><i class="icon-calendar"></i> ' + datetime + '</time><div class="post-author"><i class="icon-user"></i> <a href="#">Author: ' + name + '</a></div><br><hr><div class="update_post"><p>' + updates + '</p></div></div><BR>');
      }
    } else{
      $("#headingUpdates").html("There are currently no updates.");
    }
    });
  }

  function loadGallery() {
    $("#gallery").html("");
    $.ajax({
      type: "POST",
      url: "loadGallery.php",
      data: {
        pId: projectId
      },
    }).done(function (response) {
      json = JSON.parse(response);
      imageData = json.imageData;
      videoData = json.videoData;
      // console.log(imageData);
      // console.log(videoData);
      if((imageData.length >0)||(videoData.length >0)){
        $("#galleryHeading").html("Gallery/Media");
      for (var i = 0; i < imageData.length; i++) {
        var image = imageData[i];
        if (image == "") {
          continue;
        }
        $("#gallery").append('<li class="box span4"><a href="uploads/' + image + '"><img style="margin-bottom:10px" alt="" src="uploads/' + image + '"></a></li>');
      }

      for (var i = 0; i < videoData.length; i++) {
        var videoLink = videoData[i];
        if (videoLink != "") {
          if (videoLink.match(/youtube.com\/embed/)) {
            var content = videoLink;
          } else if (videoLink.match(/watch\?v=([a-zA-Z0-9\-_]+)/)) {
            var youtube_id = videoLink.split("v=")[1].substring(0, 11);
            var content = "https://www.youtube.com/embed/" + youtube_id;
          } else {
            var vimeo_Reg = /https?:\/\/(?:www\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|)(\d+)(?:$|\/|\?)/;
            var match = videoLink.match(vimeo_Reg);
            if (match) {
              var content = '//player.vimeo.com/video/' + match[3] + '?portrait=0&amp;badge=0';
            } else {
              console.log('Can not detect the Vimeos ID');
            }
          }
        } else {
          continue;
        }
        $("#gallery").append('<li class="box span4"><iframe style="width:100%; height:246px" alt="" src="' + content + '" frameborder="0" allowfullscreen></iframe></li>');
      }
    }
    });
  }

  function showSupporters(){
    $("#supporters").html("");
    $.ajax({
      type: "POST",
      url: "supporter.php",
      data: {        
        id: projectId,
        action: "receive",        
      },
    }).done(function (response) {
      response = JSON.parse(response);
      if(response.length >0){
        $("#pledgeHeading").html("Supporters");
      for (var i = 0; i < response.length; i++) {
        var name = (response[i].SUPPORTER_NAME == undefined) ? "" : response[i].SUPPORTER_NAME;
        var email = (response[i].SUPPORTER_EMAIL == undefined) ? "" : response[i].SUPPORTER_EMAIL;
        var pledge = (response[i].PLEDGE == undefined) ? "" : response[i].PLEDGE;
        var datetime = (response[i].DATETIME == undefined) ? "" : response[i].DATETIME;
        $("#supporters").append('<blockquote><p>' + pledge + '</p> <small>' + name + ' <cite> ( '+ email +' - ' + datetime + ') </cite></small></blockquote><hr>');
      }
    }else {
      $("#pledgeHeading").html("There are no supporters yet. Please pledge to support this great project !");
    }
    });

  }

  $("#supporterForm").submit(function (event) {
    var feedback = new FormData($("#supporterForm")[0]);
    feedback.append("id", projectId); feedback.append("project", projectName);
    feedback.append("creatorName", userNameArray[0]); feedback.append("creatorEmail", userEmailArray[0]);
    feedback.append("action", "submit");
    $('#supportbutton').attr("disabled", true);
    $.ajax({
      type: "POST",
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      url: "supporter.php",
      data: feedback,
    }).done(function (response) {});
    event.preventDefault();
    homeReturn();
  })



  function showComments() {
    $("#comments").html("");
    $.ajax({
      type: "POST",
      url: "feedback.php",
      data: {
        id: projectId,
        action: "receive",
      },
    }).done(function (response) {
      response = JSON.parse(response);
      if(response.length >0){ 
        $("#feedbackHeading").html("Comments/Thoughts/Feedback"); 
      for (var i = 0; i < response.length; i++) {
        var name = (response[i].NAME == undefined) ? "" : response[i].NAME;
        var email = (response[i].EMAIL == undefined) ? "" : response[i].EMAIL;
        var comment = (response[i].COMMENT == undefined) ? "" : response[i].COMMENT;
        var datetime = (response[i].DATETIME == undefined) ? "" : response[i].DATETIME;
        $("#comments").append('<blockquote><p>' + comment + '</p> <small>' + name + ' <cite> (' + email + ' - ' + datetime + ') </cite></small></blockquote><hr>');
      }
      } else{ 
      $("#feedbackHeading").html("There are no Comments/Thoughts/Feedback."); 
     } 
    });
  }

  $("#feedbackForm").submit(function (event) {
    var feedback = new FormData($("#feedbackForm")[0]);
    feedback.append("id", projectId);
    feedback.append("action", "submit");
    $('#singlebutton').attr("disabled", true);
    $.ajax({
      type: "POST",
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      url: "feedback.php",
      data: feedback,
    }).done(function (response) {});
    event.preventDefault();
    homeReturn();
  })

  function contactInitiator(){
    for ( instance in CKEDITOR.instances )
     CKEDITOR.instances[instance].updateElement();
    var owner_email = $("#owner_email").val();
    var contactForm = new FormData($("#contactForm")[0]); contactForm.append("to_email", owner_email);   
    $.ajax({
      type: "POST",
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      url: "sendmail.php",
      data: contactForm,
    }).done(function (response) {
      ($("#contactForm")[0]).reset();
      $(".success").fadeIn();
      $.notifyBar({
        cssClass: "success",
        delay: 3500,
        html: "Your message has been sent succesfully!<strong> We will be in touch soon."
      });
      setInterval(homeReturn(),4000);
    })
    event.preventDefault();
  }
</script>

</body>
</html>