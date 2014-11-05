<?php
ob_start();
session_start();
include 'includes/Bluehost_connect.php';
?>

<?php

$URI_QUERY = parse_str(urldecode($_SERVER['QUERY_STRING']));
$projectId = $PROJECT / 99.99;

$data      = mysql_fetch_object(mysql_query("SELECT COUNT(id) AS num_rows FROM  `PROJECT` WHERE `ID`='" . $projectId . "' "));
$totalRows = $data->num_rows;

if ($projectId != "" && ($totalRows != 0) ) {
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
  $projectName        = ($subject['NAME']);
  $projectBlurb       = ($subject['SHORT_BLURB']);
  $category           = ($subject['CATEGORY']);
  $image              = ($subject['IMAGE']);
  $location           = ($subject['LOCATION']);
  $country            = ($subject['COUNTRY']);
  $budget             = ($subject['FUNDING']);
  $description        = ($subject['DESCRIPTION']);
  $benefit            = ($subject['BENEFIT']);
  $challenges         = ($subject['RISKS_CHALLENGES']);
  $videoLink          = ($subject['VIDEO']);
  $lookingFor         = ($subject['LOOKING_FOR']);
  $progressPercentage = ($subject['PROGRESS_PERCENTAGE']);
}


// ///////////////////////////////////////////////////////////////////////////////////////////

$getCreatorQuery  = "SELECT  * FROM  `PROJECT_CREATOR` WHERE `PROJECT_ID`='$projectId' ORDER BY `ID` ASC";
$getCreatorResult = mysql_query($getCreatorQuery, $connection);
if (!$getCreatorResult) {
  $message = 'Invalid query: ' . mysql_error() . "\n";
  $message .= 'Whole query: ' . $getCreatorQuery;
  die($message);
}
$userIdArray      = array();
$userNameArray    = array();
$userCountryArray = array();
$userUWCArray     = array();
$userUWCYearArray = array();
$userEmailArray   = array();
$userPhoneArray   = array();
$userImageArray   = array();
$userBioArray     = array();
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
 
if (!in_array($_SESSION["email"], $userEmailArray)){
  header("Location: 404.php");  /* Redirect browser */
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
    array_push($userPhoneArray, $phone);
    array_push($userImageArray, $profilePic);
    array_push($userUWCYearArray, $UWCYear);
  }
}
?>

<?php
mysql_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>EDIT <?php echo $projectName?>
  </title>
  <meta charset="utf-8">
  <link rel="icon" href="img/favicon.png" type="image/x-icon">

  <!-- <link rel="shortcut icon" href="http://dzyngiri.com/favicon.png" type="image/x-icon" /> -->
  <!--   <meta name="description" content="Codester is a free responsive Bootstrap template by Dzyngiri">
 -->
  <!-- <meta name="keywords" content="free, template, bootstrap, responsive"> -->
  <meta name="author" content="CodeCOOP">
  <link rel="stylesheet" href="css/uwcnext.css" type="text/css">
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen">
  <link rel="stylesheet" href="css/responsive.css" type="text/css" media="screen">
  <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
  <link rel="stylesheet" href="css/touchTouch.css" type="text/css" media="screen">
  <link rel="stylesheet" href="css/kwicks-slider.css" type="text/css" media="screen">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:205,300' rel='stylesheet' type='text/css'>
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css" rel="stylesheet">
  <link href="css/jquery.notifyBar.css" rel="stylesheet" media="screen">
  <link href="css/tm_docs.css" rel="stylesheet">
  <link rel="stylesheet" href="bootstrap-tagsinput/bootstrap-tagsinput.css" type="text/css" media="screen">

  <script id="metamorph-1-start" type="text/x-placeholder"></script>
  <script id="metamorph-21-start" type="text/x-placeholder"></script>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/superfish.js"></script>
  <script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
   <script type="text/javascript" src="bootstrap-tagsinput/bootstrap-tagsinput.min.js.map"></script>
   <script type="text/javascript" src="bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
  <!-- //   <script type="text/javascript" src="bootstrap-tagsinput/bootstrap-tagsinput.less"></script> -->
  <!-- //   <script type="text/javascript" src="bootstrap-tagsinput/bootstrap-tagsinput.js"></script> -->
  <!-- //   <script type="text/javascript" src="bootstrap-tagsinput/bootstrap-tagsinput-angular.js"></script> -->
  <script type="text/javascript" src="js/jquery.kwicks-1.5.1.js"></script>
  <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
  <script type="text/javascript" src="js/jquery.cookie.js"></script>
  <script type="text/javascript" src="js/touchTouch.jquery.js"></script>
  <script type="text/javascript" src="js/jquery.notifyBar.js"></script>
  <script type="text/javascript">
    if ($(window).width() > 1024) {
      document.write("<" + "script src='js/jquery.preloader.js'></" + "script>");
    }
  </script>

  <!-- PHP files -->
  <?php include 'modal.php'; ?>
  <!-- Includes all modal (login, signup, contact, feedback) -->


  <script>
    jQuery(window).load(function () {
      $x = $(window).width();
      if ($x > 1024) {
        jQuery("#content .row").preloader();
      }
      jQuery('.magnifier').touchTouch();
      jQuery('.spinner').animate({
        'opacity': 0
      }, 1000, 'easeOutCubic', function () {
        jQuery(this).css('display', 'none')
      });
    });
  </script>


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
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:205' rel='stylesheet' type='text/css'>
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
  </script>
</head>

<body onload="helpInitiative(1)">
  <div class="spinner"></div>
  <header>
    <?php include 'includes/header.php'; ?>
  </header>
  <div class="bg-content">
    <!-- content -->
    <div id="content">
      <div class="ic"></div>
      <div class="row-1">
        <div class="container">
          <div class="row">
            <div class="span12" style="text-align:center;">
              <h3 style="margin:50px 0 35px 0px; text-align:center; font-weight:bold;">EDIT <?php echo $projectName?> </h3>
              <div style="text-align:center;">
                <hr style="margin-top:-10px;">
                <div id="pills" style=" font-size: 20px; font-weight:bold;">
                  <ul class="nav nav-pills">
                    <li><a class="active" href="#tab4" data-toggle="tab"><i class="icon-home" style="padding-right:8px;"></i>Basic</a>
                    </li>
                    <li><a href="#tab10" data-toggle="tab" onclick="editorShowUpdates()"><i class="icon-bullhorn" style="padding-right:8px;"></i>Bulletin Board</a>
                    </li>
                    <li><a href="#tab14" data-toggle="tab" onclick="editorShowSupport()"><i class="icon-star-empty" style="padding-right:8px;"></i>Supporters</a>
                    </li>                    
                    <li><a href="#tab11" data-toggle="tab" onclick="loadGallery()"><i class="icon-film" style="padding-right:8px;"></i>Gallery</a>
                    </li>
                    <li><a href="#tab12" data-toggle="tab" onclick="meetOurCrew()"><i class="icon-user" style="padding-right:8px;"></i>Team</a>
                    </li>
                    <li><a href="#tab13" data-toggle="tab" onclick="showComments()"><i class="icon-comment" style="padding-right:8px;"></i>Community</a>
                    </li>
                  </ul>
                </div>
                <hr>
              </div>
            </div>
            <div class="tab-content" style="min-height:250px; overflow:none">
              <div class="tab-pane" id="tab10">
                <div class="span2"></div>
                <div class="span8">
                  <div class="row">
                    <div class="clear"></div>
                    <div class="updates_div">
                      <h5>Share your updates about the Initiative</h5>
                      <form id="updatesForm" name="updatesForm" method="POST">
                        <textarea style="width:100%; height:70px;" id="myUpdates" name="myUpdates" placeholder="Write updates..."></textarea>
                        <br>
                        <button id="updatesProjectButton" name="updatesProjectButton" type="button" class="btn btn-primary" onclick="updatesProject(); return false;">Post</button>
                      </form>
                      <br>
                      <br>
                      <br>
                      <h5 id ="headingUpdates">Recent Updates</h5>
                      <div class="recent_updates" id="updates">
                      </div>
                      <br>
                      <hr>
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
                  </div>
                </div>
                <div class="span2"></div>
              </div>
              <div class="tab-pane" id="tab14">
                <div class="span2"></div>
                <div class="span8">
                  <div class="row">
                    <div class="clear"></div>
                    <div class="support_div">
                    <h5 id="pledgeHeading" style="font-size:20px;"></h5><br>
                      <div id="pledges_div"></div>
                    </div>
                  </div>
                </div>
                <div class="span2"></div>
              </div>
              <div class="tab-pane" id="tab11">
                <div class="span2"></div>
                <div class="span8">
                  <h5>Upload media (Video/Images) of your Initiative</h5>
                  <form name="myform" id="myform" action="" method="POST">
                    <br>
                    <br>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="">Image (Add multiple images by pressing control/command button.)</label>
                      <span class="btn btn-default btn-file">Browse 
                        <input  multiple type="file" name="file[]" accept="image/gif, image/jpg, image/jpeg, image/x-png">
                      </span>
                      <br>
                      <br>
                      <label class="col-md-6 control-label" for="video_link">Video Link</label>
                      <div class="col-md-6">
                        <input id="video_link" name="video_link" type="text" placeholder="youtube/vimeo/etc.." class="form-control input-md">
                      </div>
                      <br>
                      <button id="submitGalleryButton" name="submitGalleryButton" class="btn btn-primary" onclick="updateGallery('<?php echo $projectId; ?>')">Submit</button>
                    </div>
                  </form>
                  <hr>
                  <div class="added_images">
                   <h4 id ="galleryHeading" style="font-size:20px";>There are currently no images/videos. Please update to keep your audience engaged.</h4>
                    <br>
                    <div class="media">
                      <ul id="gallery" class="portfolio clearfix">
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="span2"></div>
              </div>
              <div class="tab-pane" id="tab12">
                <div class="span2"></div>
                <article class="span10" style="margin-top:30px;">
                  <div class="clear"></div>
                  <ul id="projectCrew" class="portfolio clearfix"></ul>
                  <div id="submitAddExtraCreators" onClick="addTeamMembers()">
                    <button id="addExtraMembersPermission" type="button" class="btn btn-primary pull-right" style="display:none"><span class="sr-only">Add More</span>
                    </button>
                  </div>
                  <div class="span4 pull-right" id="projectCreatorForm" style="margin-top:-90px; display:none">
                    <br>
                    <form id="extraInitiativeCreator" method="POST" style="">
                      <table id="addExtraCreators"></table>
                      <div id="teamquestion" style="display:none;  ">
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="selectTeam">Add members to your team:</label>
                          <div class="col-md-4">
                            <select id="selectTeam" name="selectTeam" class="form-control">
                              <option value="1">One</option>
                              <option value="2">Two</option>
                              <option value="3">Three</option>
                              <option value="4">Four</option>
                              <option value="5">Five</option>
                              <option value="6">Six</option>
                              <option value="7">Seven</option>
                              <option value="8">Eight</option>
                              <option value="9">Nine</option>
                              <option value="10">Ten</option>
                              <option value="11">Eleven</option>
                              <option value="12">Twelve</option>
                            </select>
                          </div>
                        </div>
                        <div>
                          <label class="col-md-4 control-label" for="submitQ"></label>
                          <div class="col-md-4">
                            <button id="submitQ" name="submitQ" onClick="addExtraCreators()" class="btn btn-primary">Submit</button>
                          </div>
                        </div>
                      </div>
                      <button class="btn btn-success" type="button" name="addExtraMembers" id="addExtraMembers" onclick="addExtraTeamMembers()" style="margin: 50px 0 0 24%; font-size:20px; font-weight:bold;">Add Members</button>
                    </form>
                  </div>
                </article>
              </div>
              <div class="tab-pane" id="tab13">
                <div class="span2"></div>
                <div class="span10">
                  <h4 id="feedbackHeading" style="font-size:20px;"> Comments/Thoughts/Feedback</h4> 
                  <br>
                  <div id="comments"></div>
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
                  <div class="span2"></div>
                </div>
              </div>


              <div class="tab-pane active" id="tab4" style="<?php if($_SESSION[" uid "]==" "){?>display:none;<?php }else{?>font-size:90%;<?php }?>">
                <div id="projectForm" enctype="multipart/form-data" style="color:black">
                  <div id="projectDescriptionForm" style=" width:1000px; height:auto;">
                    <br>
                    <br>
                    <label style="font-size:20px; margin-left:60px; margin-top:10px; "> <b>Initiative Description </b>
                    </label>
                    <br>
                    <form role="form" id="projectDescription" method="POST" style="margin-left:60px;">
                      <div class="form-group">
                        <table>
                          <tr>
                            <td>
                              <label>Initiative Title</label>
                              <input class="form-control" type="text" name="projectName" id="projectName" style="width: 400px;" placeholder="" value="<?php echo $projectName; ?>" maxlength="45" required>
                            </td>
                            <td>
                              <p style="margin:20px 0 0 15px;">Your initiative title should be simple, specific, and yet memorable. Avoid words such as "help", "support", "sponsor" or "fund"</p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label>Category</label>
                              <!-- <input class="form-control" type="text"  placeholder="required..."> -->
                              <select name="category[]" style="width:400px;" id="category" class="form-control" multiple="multiple">
                                <option value="" selected="selected">Select Category</option>
                                <option>Arts &amp Culture</option>
                                <option>Conflict Resolution</option>
                                <option>Education</option>
                                <option>Environment</option>
                                <option>Health &amp Welfare</option>
                                <option>Human Rights</option>
                                <option>Media </option>
                                <option>Technology</option>
                                <option>Poverty Alleviation</option>
                                <option>Sustainability</option>
                                <option>Wilderness</option>
                                <option>Youth &amp Women Empowerment</option>

                              </select>
                            </td>
                            <td>
                              <p style="margin:20px 0 0 15px">Press Control/Command key to select multiple categories for your initiatives. <b>(Required)</b>
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label>Location</label>
                              <input class="form-control" type="text" name="location" id="location" placeholder="City/Town" value="<?php echo $location; ?>" style="width:150px;" required>
                              <select name="countryName" id="countryName" class="form-control" style="width:150px;">
                                <option value="" selected="selected"></option>
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antarctica">Antarctica</option>
                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Aruba">Aruba</option>
                                <option value="Australia">Australia</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bermuda">Bermuda</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia">Bolivia</option>
                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Bouvet Island">Bouvet Island</option>
                                <option value="Brazil">Brazil</option>
                                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Cape Verde">Cape Verde</option>
                                <option value="Cayman Islands">Cayman Islands</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Christmas Island">Christmas Island</option>
                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                <option value="Cook Islands">Cook Islands</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Cote D'ivoire">Cote D'ivoire</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                <option value="Faroe Islands">Faroe Islands</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="French Guiana">French Guiana</option>
                                <option value="French Polynesia">French Polynesia</option>
                                <option value="French Southern Territories">French Southern Territories</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Greece">Greece</option>
                                <option value="Greenland">Greenland</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guadeloupe">Guadeloupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea-bissau">Guinea-bissau</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                <option value="Korea, Republic of">Korea, Republic of</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macao">Macao</option>
                                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Martinique">Martinique</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mayotte">Mayotte</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                <option value="Moldova, Republic of">Moldova, Republic of</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="Netherlands Antilles">Netherlands Antilles</option>
                                <option value="New Caledonia">New Caledonia</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Niue">Niue</option>
                                <option value="Norfolk Island">Norfolk Island</option>
                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau">Palau</option>
                                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Pitcairn">Pitcairn</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Reunion">Reunion</option>
                                <option value="Romania">Romania</option>
                                <option value="Russian Federation">Russian Federation</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Saint Helena">Saint Helena</option>
                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                <option value="Saint Lucia">Saint Lucia</option>
                                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                <option value="Samoa">Samoa</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Slovakia">Slovakia</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Solomon Islands">Solomon Islands</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                <option value="Spain">Spain</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                <option value="Swaziland">Swaziland</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Timor-leste">Timor-leste</option>
                                <option value="Togo">Togo</option>
                                <option value="Tokelau">Tokelau</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Viet Nam">Viet Nam</option>
                                <option value="Virgin Islands, British">Virgin Islands, British</option>
                                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                <option value="Wallis and Futuna">Wallis and Futuna</option>
                                <option value="Western Sahara">Western Sahara</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                              </select>

                            </td>
                            <td>
                              <p style="margin:20px 0 0 15px">Proposed location of the project<b>(Required)</b>
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label>Initiative Pitch</label>
                              <textarea class="form-control" type="text" name="shortBlurb" id="shortBlurb" placeholder="" style=" width: 400px; height:100px; resize:none;" required><?php echo trim($projectBlurb); ?></textarea>
                            </td>
                            <td>
                              <p style="margin:20px 0 0 15px;">150 characters: if you had to describe your project in a tweet ...</p>
                            </td>
                          </tr>
                          <!-- <tr>
                            <td>
                              <label>Funding Goal</label>
                              <input class="form-control" style="width:400px;" type="text" name="funding" id="funding" placeholder="US $0.00" value="<?php echo $budget; ?>">
                            </td>
                            <td>
                              <p style="margin:20px 0 0 15px;">How much funds do you need to complete this initiative? <b>(Required)</b> 
                              </p>
                            </td>
                          </tr> -->
                          <tr>
                            <td>
                              <label>Benefits</label>
                              <textarea class="form-control" name="benefit" id="benefit" placeholder="" style=" width: 400px; height:100px; resize:none;"><?php echo trim($benefit); ?></textarea>
                            </td>
                            <td>
                              <p style="margin:20px 0 0 15px;">Who? What? When? and How does it enhance the UWC experience? Why should your initiative be sponsored?</p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label>Initiative Image</label>
                              <input id="img_file" type="file" name="file[]" accept="image/gif, image/jpeg, image/x-png" alt="<?php echo($image); ?>">
                              <div id="initiativePicture"></div>
                              </label>
                            </td>
                            <td>
                              <p style="margin:20px 0 0 15px;">Please upload a logo/image for your initiative. <b>(Required)</b> 
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <br>
                              <label>Initiative Video</label>
                              <textarea class="form-control" name="video" id="video" placeholder="" style=" width: 400px; height:100px; resize:none;"><?php echo trim($videoLink); ?></textarea>
                            </td>
                            <td>
                              <p style="margin:20px 0 0 15px;">Initiatives with a video have a much higher chance of success. It doesn't need to be an Oscar contender, just be yourself and explain what you want to do. Upload your video to <b>YOUTUBE.COM </b> or <b>VIMEO.COM</b> and paste the link here. <b>(Required)</b> 
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label>Initiative Description</label>
                              <textarea class="form-control" name="description" id="description" placeholder="" style=" width: 400px; height:100px; resize:none;"><?php echo trim($description); ?></textarea>
                            </td>
                            <td>
                              <p style="margin:20px 0 0 15px;">Use your initiative's description to share more about what you're raising funds to do and how you plan to pull it off. It's up to you to make the case for your Initiative. <b>(Required)</b>
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label>Risks and Challenges</label>
                              <textarea class="form-control" name="risksAndChallenges" id="risksAndChallenges" placeholder="" style=" width: 400px; height:100px; resize:none;"><?php echo trim($challenges); ?></textarea>
                            </td>
                            <td>
                              <p style="margin:20px 0 0 15px;">What are the risks and challenges that come with completing your initiative and how are you qualified to overcome them? Sharing potential challenges - and your plans and qualifications for tackling them - is an important part of building a community around your project. Think about all the various steps to completing your Initiative and which ones pose challenges. Every initiave has risks and challenges, just be open and honest about yours.</p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label>How can people help you?</label>
                              <input class="form-control" name="lookingFor" id="lookingFor" placeholder="" value="<?php echo $lookingFor; ?>"data-role="tagsinput" style="width: 400px; height:100px; resize:none"><p class="help-block">Press 'Enter' after each entry.</p>
                                
                              </input>
                            </td>
                            <td>
                              <p style="margin:20px 0 0 15px;">What help do you need in order to complete your initiative? Please list all kind of help you may need. (Funds, Construction material, Volunteers etc.. )</p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label> Progress Percentage</label>
                              <input class="form-control" type="text" name="progressPercentage" style="width:400px;" id="progressPercentage" placeholder="0" value="<?php echo $progressPercentage; ?>">
                            </td>
                            <td>
                              <p style="margin:20px 0 0 15px;">Update the completion of the project percentage-wise</p>
                            </td>
                          </tr>
                        </table>
                      </div>
                      <div class="input-group" id="publishRadio" name="publishRadio" style="margin-top:20px"> 
                         <div> 
                           <span class="input-group-addon"><input type="radio" name="publishWhen" value="now" id="publishNow"></span> 
                           <p style="display:inline">My project is complete. Publish Now! <small style="color:gray">(Note: you can still edit your project at any time.)</small></p> 
                         </div> 
                         <div> 
                           <span class="input-group-addon"><input type="radio" name="publishWhen" value="later" id="publishLater"></span> 
                           <p style="display:inline">I still have some things to change. I'll publish later.</p> 
                         </div> 
                       </div> <!-- end input-group --> 
                    </form>
                    <button class="btn btn-success tm_style_3" type="button" name="submitInitiative" id="submitInitiative" onclick='updateInitiative("update", <?php echo $projectId; ?>)' style="margin: 10px 0 30px 24%; font-size:20px; font-weight:bold;">Update Project</button>
                  </div>
                  <div id="fillAllRequiredFieldsAlert" class="alert alert-warning" style="display:none; text-align:center; margin-top:40px;">
                    <strong>Warning!</strong> Make sure all of the required fields are filled!
                  </div>
                  <div id="updateSuccess" class="alert alert-warning" style="display:none; text-align:center; margin-top:40px; height:40px; text-align: center;">
                    <h5><strong>Success!</strong> Your initiative has been successfully Updated!</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
  <!-- Custom JS -->
  <script type="text/javascript" src="uwcnext.js"></script>
  <script type="text/javascript" src="script.js"></script>

  <script type="text/javascript">
    window.uid = <?php echo json_encode($_SESSION['uid']); ?> ;
    window.userEmail = <?php echo json_encode($_SESSION["email"]); ?> ;
    window.userName = <?php echo json_encode($_SESSION['name']); ?> ;
    window.projectId = <?php echo json_encode($projectId); ?> ;
    var userNameArray = <?php echo json_encode($userNameArray); ?> ;
    var userEmailArray = <?php echo json_encode($userEmailArray); ?> ;
    var userUWCArray = <?php echo json_encode($userUWCArray); ?> ;
    var userUWCYearArray = <?php echo json_encode($userUWCYearArray); ?> ;
    var userImageArray = <?php echo json_encode($userImageArray); ?> ;
    var teamRoleArray = <?php echo json_encode($teamRoleArray); ?> ;
    
    $(document).ready(function () {
      var category = <?php echo json_encode($category); ?> ;
      var country = <?php echo json_encode($country); ?> ;
      var image = <?php echo json_encode($image); ?> ; 
      $("#countryName").val(country).trigger('change');
      $("#category").val(category.split(','));
      $("#initiativePicture").html('<img src="uploads/' + image + '" style="margin:-50px 0 0 200px; max-width:200px; max-height:100px;" />');
      $("#img_file").val(image);
    })

  function updateGallery(projectId) {
    var $galleryData = new FormData($("#myform")[0]);
    $galleryData.append("projectId", projectId);
    $galleryData.append("uid", uid);
    $('#gallerySubmitButton').attr("disabled", true);
    $.ajax({
      type: "POST",
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      url: "updateGallery.php",
      data: $galleryData
    }).done(function (response) {
      homeReturn();
    })
  }

function updateInitiative(tag, projectId) {
  var $addProject = $("#projectName").val();
  var $category = $("#category").val();
  var $location = $("#location").val();
  var $description = $("#description").val();
  var $publishNow = $("#publishNow").val(); 
  var $publishLater = $("#publishLater").val(); 
  var radioButtons = document.getElementsByName("publishWhen"); 
   for (var i = 0; i < radioButtons.length; i++) { 
    if (radioButtons[i].checked) { 
      // alert(radioButtons[i].value); 
       var $publishStatus = radioButtons[i].value; 
    } 
   } 
  if (($.trim($addProject)).length !== 0 && ($.trim($category)).length !== 0 && ($.trim($location)).length !== 0 && ($.trim($description)).length !== 0) {
    if (tag == 'submit') {
      var $projectData = new FormData($("#projectDescription")[0]);
      var url1 = "startInitiative.php";
    } else if (tag == 'update') {
      var $projectData = new FormData($("#projectDescription")[0]);
      $projectData.append("id", projectId);
      $projectData.append("radioValue", $publishStatus); 
      var url1 = "updateInitiative.php";
    }

    $('#submitInitiative').attr("disabled", true);

    $.ajax({
      type: "POST",
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      url: url1,
      data: $projectData,
    }).done(function (response) {
      // homeReturn();
      $('#updateSuccess').slideDown();
    });

  } else {
    $("#fillAllRequiredFieldsAlert").slideDown();
    $('#submitInitiative').removeAttr("disabled");
    event.preventDefault();
  }
}



  function updatesProject() {
    var updates = new FormData($("#updatesForm")[0]);
    updates.append("id", projectId);
    updates.append("action", "Post");
    updates.append("emailId", userEmail);
    updates.append("name", userName);
    $('#updatesProjectButton').attr("disabled", true);
    $.ajax({
      type: "POST",
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      url: "updatesProject.php",
      data: updates,
      dataType: 'text'
    }).done(function (response) {
      $.notifyBar({
        cssClass: "success",
        delay: 5000,
        html: "Updates successfully added."
      });
      setInterval($('#updatesProjectButton').attr("disabled", false),$("#updatesForm")[0].reset(),editorShowUpdates(),2000);
    });
    event.preventDefault();
  }

function editorShowUpdates() {
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
    // console.log(response.length);
    if (response.length >0)
    { $("#headingUpdates").html("Recent Updates");
    for (var i = 0; i < response.length; i++) {
      var name = (response[i].USER_NAME == undefined) ? "" : response[i].USER_NAME;
      var email = (response[i].USER_EMAIL == undefined) ? "" : response[i].USER_EMAIL;
      var updateId = (response[i].ID == undefined) ? "" : response[i].ID;
      var updates = (response[i].UPDATES == undefined) ? "" : response[i].UPDATES;
      var datetime = (response[i].DATETIME == undefined) ? "" : response[i].DATETIME;
        $("#updates").append('<div class="update_number"> <hr><time datetime="2012-11-09" class="date-1"><i class="icon-calendar"></i> ' + datetime + '</time><div class="post-author" ><i class="icon-user" style="margin-left:10px;"></i> <a href="#">Author: ' + name + '</a></div><hr><div class="update_post"><p>' + updates + '</p></div></div><button id="update' + updateId + '" onclick="removeUpdates(' + updateId + '); return false;" class="btn btn-primary" style="margin-bottom:10px;">Remove</button>');
      }

      }else {
        $("#headingUpdates").html("There are no updates. Please update to keep your audience engaged.");
      }
    });

  
  }




  function editorShowSupport() {
    $("#pledges_div").html("");
    $.ajax({
      type: "POST",
      url: "supporter.php",
      data: {
        id: projectId,
        action: "receive"
      },
    }).done(function (response) {
      response_p = JSON.parse(response);
      console.log(response_p);
      if(response_p.length >0){ 
      $("#pledgeHeading").html("Manage your pledges");
      for (var i = 0; i < response_p.length; i++) {
        var name = (response_p[i].SUPPORTER_NAME == undefined) ? "" : response_p[i].SUPPORTER_NAME;
        var pledgeId = response_p[i].ID; 
        var pledge = (response_p[i].PLEDGE == undefined) ? "" : response_p[i].PLEDGE;
        var datetime = (response_p[i].DATETIME == undefined) ? "" : response_p[i].DATETIME;
        $("#pledges_div").append('<blockquote><p>' + pledge + '</p> <small>' + name + ' <cite> ( ' + datetime + ') </cite></small><div class="form-group"><label class="col-md-4 control-label" for="respond_button"></label><div class="col-md-8"><button id="remove_button" name="remove_button" class="btn btn-danger" onclick="removePledge(' + pledgeId + ')">Delete</button></div></div></blockquote><hr>');
      }
      }else{ 
     $("#pledgeHeading").html("There are no pledge yet."); 
     } 
    });
  }

  function removePledge(pledgeId) {
    if (confirm("Do you really want to delete the pledge?") == true) {
      $.ajax({
        type: "POST",
        url: "supporter.php",
        data: {
          id: projectId,
          removePledgeId: pledgeId,
          action: "delete"
        },
      }).done(function (response) {
        setInterval(editorShowSupport(),2000);
      })
    }
  }




  function removeUpdates(updateId) {
    if (confirm("Do you really want to remove it?") == true) {
      $.ajax({
        type: "POST",
        url: "updatesProject.php",
        data: {
          id: projectId,
          removeUpdateId: updateId,
          action: "delete"
        },
      }).done(function (response) {
        setInterval(editorShowUpdates(),2000);
      })
    }
  }

  function showComments() {
    $("#comments").html("");
    $.ajax({
      type: "POST",
      url: "feedback.php",
      data: {
        id: projectId,
        action: "receive"
      },
    }).done(function (response) {
      response = JSON.parse(response);
       if(response.length >0){ 
      $("#feedbackHeading").html("Comments/Thoughts/Feedback"); 
      for (var i = 0; i < response.length; i++) {
        var name = (response[i].NAME == undefined) ? "" : response[i].NAME;
        var email = (response[i].EMAIL == undefined) ? "" : response[i].EMAIL;
        var uwc = (response[i].UWC == undefined) ? "" : response[i].UWC;
        var uwcYear = (response[i].UWC_YEAR == undefined) ? "" : response[i].UWC_YEAR;
        var comment = (response[i].COMMENT == undefined) ? "" : response[i].COMMENT;
        var datetime = (response[i].DATETIME == undefined) ? "" : response[i].DATETIME;
        var commentId = (response[i].ID == undefined) ? "" : response[i].ID;
        $("#comments").append('<blockquote><p>' + comment + '</p> <small>' + name + ' <cite>(' + uwc + ',' + uwcYear + ':' + email + ' - ' + datetime + ')</cite></small><div class="form-group"><label class="col-md-4 control-label" for="respond_button"></label><div class="col-md-8"><button id="respond_button" style="display:none;" name="respond_button" class="btn btn-success">Reply</button><button id="remove_button" name="remove_button" class="btn btn-danger" onclick="removeComments(' + commentId + ')">Delete</button></div></div></blockquote><hr>');
      }
       } else{ 
     $("#feedbackHeading").html("There are no Comments/Thoughts/Feedback."); 
   } 
    });
  }

  function removeComments(commentId) {
    if (confirm("Do you really want to delete the comment?") == true) {
      $.ajax({
        type: "POST",
        url: "feedback.php",
        data: {
          id: projectId,
          removeCommentId: commentId,
          action: "delete"
        },
      }).done(function (response) {
        alert("Deleted");
      })
      homeReturn();
      $("#tab13").show();
    }
  }

  function meetOurCrew() {
    $("#projectCrew").html("");
    if (userEmail != userEmailArray[0]) {
      for (var i = 0; i < userNameArray.length; i++) {
        var userName = userNameArray[i];
        var uwc = userUWCArray[i];
        var uwcYear = userUWCYearArray[i];
        var role = teamRoleArray[i];
        var memberEmail = userEmailArray[i];
        if (uwc == "" || uwc == undefined) {
          uwc = "";
        }
        var profilePic = userImageArray[i];
        if (profilePic == "" || profilePic == undefined || profilePic == null) {
          profilePic = "member.png";
        }      
          $("#projectCrew").append('<li class="span2" style="margin-bottom:25px; "><div class="mid-right-box" style="height:310px;"><div class="col-sm-6 col-md-4"><a onclick="showUserProfile(\'' + memberEmail + '\')"><img src="uploads/' + profilePic + '" alt="" style="margin-bottom:30px;max-width:125px; max-height:130px;" class="img-circle img-responsive"/></a></div><div class="col-sm-6 col-md-8" style="margin:auto"><h5><a style="cursor:pointer" onclick="showUserProfile(\'' + memberEmail + '\')">' + userName + '</a></h5><b><cite>' + " " + role + '</cite></b><br> <b><cite>' + uwc + '</cite><cite style="margin-left:5px;">' + uwcYear + '</cite></b><div style="margin-top:10px;" class="btn-group"> <a onclick="showUserProfile(\'' + memberEmail + '\')" class="btn btn-primary dropdown-toggle" ><span class="sr-only">Full Profile</span></a></div</div></li>');
      }
    } else {
      $("#addExtraMembersPermission").show();
      for (var i = 0; i < userNameArray.length; i++) {
        var userName = userNameArray[i];
        var uwc = userUWCArray[i];
        var uwcYear = userUWCYearArray[i];
        var role = teamRoleArray[i];
        var memberEmail = userEmailArray[i];
        if (uwc == "" || uwc == undefined) {
          uwc = "";
        }
        var profilePic = userImageArray[i];
        if (profilePic == "" || profilePic == undefined || profilePic == null) {
          profilePic = "member.png";
        }
        $("#projectCrew").append('<li class="span2" style="margin-bottom:25px;"><div class="mid-right-box"><div class="col-sm-6 col-md-4"><a onclick="showUserProfile(\'' + memberEmail + '\')"><img src="uploads/' + profilePic + '" alt="" style="margin-bottom:30px;max-width:125px; max-height:130px;" class="img-circle img-responsive"/></a></div><div class="col-sm-6 col-md-8" style="margin:auto"><h5><a style="cursor:pointer" onclick="showUserProfile(\'' + memberEmail + '\')">' + userName + '</a></h5> <b><cite>' + " " + role + '</cite></b><br> <b><cite>' + uwc + '</cite><cite style="margin-left:5px;">' + uwcYear + '</cite></b><div style="margin-top:10px;" class="btn-group"> <a onclick="removeMember(\'' + memberEmail + '\',\'' + userName + '\')" class="btn btn-primary pull-left" ><span class="sr-only">  Remove </span></a></div</div></li>');
      }
    }
  }
  
  function addExtraTeamMembers() {
    // alert("Work!");
    var $memberData = new FormData($("#extraInitiativeCreator")[0]);
    $memberData.append("id", projectId);
    $memberData.append("tag", "addExtraTeamMembers");
    console.log($memberData);
    var url2 = "creatorInitiative.php";
    $('#addExtraMembers').attr("disabled", true);
    $.ajax({
      type: "POST",
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      url: url2,
      data: $memberData,
    }).done(function (response) {});
  }

  function removeMember(memberEmail, memberName) {
    var confirmleave = confirm("Do you want to remove " + memberName + " from this project?");
    if (confirmleave == true) {
      $.ajax({
        url: 'leaveProject.php',
        type: "POST",
        data: {
          "projectId": projectId,
          "email": memberEmail
        },
      }).done(function (response) {
        alert(memberName + " is no longer part of your team.");
      })
    }
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
      // alert(imageDate.length);
      if((imageData.length >0)||(vidoeData.length >0)){ 
       $("#galleryHeading").html("Gallery/Media"); 
      for (var i = 0; i < imageData.length; i++) {
        var image = imageData[i];
        if (image == "") {
          continue;
        }
        $("#gallery").append('<li class="box span4"><a href="uploads/' + image + '"><img style="margin-bottom:10px" alt="" src="uploads/' + image + '"></a><br><button class="btn btn-primary" onclick="removeGallery(\'' + image + '\', 0); return false;">Remove</button></li>');
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
        $("#gallery").append('<li class="box span4"><a href="' + video + '"><iframe style="width:100%; height:246px" alt="" src="' + content + '" frameborder="0" allowfullscreen></iframe></a><br><button class="btn btn-primary" onclick="removeGallery(\'' + videoLink + '\', 1); return false;">Remove</button></li>');
      }
    } 
    
    });
  }

  function removeGallery(media, tag) {
    if (confirm("Are you sure you want to delete this image?") == true) {
      $.ajax({
        type: "POST",
        url: "removeGallery.php",
        data: {projectId: projectId,media: media,tag: tag},
        dataType: 'text',
      }).done(function (response) {
        homeReturn();
      })
    }
  }
</script>

</body>

</html>
