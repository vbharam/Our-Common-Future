<?php 
ob_start();
session_start();
include 'includes/Bluehost_connect.php'; 
?>

<?php   
  
  $projectId = $_GET['PROJECT'];
  $descriptionId = $_GET['ID'];

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
      $country = ($subject['COUNTRY']);
      $budget = ($subject['FUNDING']);
      $description = ($subject['DESCRIPTION']);
      $benefit = ($subject['BENEFIT']);
      $challenges = ($subject['RISKS_CHALLENGES']);
      $videoLink = ($subject['VIDEO']);
      $progressStatus = ($subject['PROGRESS_STATUS']);
      $progressPercentage = ($subject['PROGRESS_PERCENTAGE']);
      $timeStamp = new DateTime($subject['DATETIME']);
      $date = $timeStamp->format('m/d/Y');

  }


  // ///////////////////////////////////////////////////////////////////////////////////////////

  $getCreatorQuery = "SELECT  * FROM  `PROJECT_CREATOR` WHERE `PROJECT_ID`='$projectId' ORDER BY `ID` ASC";
  $getCreatorResult = mysql_query($getCreatorQuery,$connection);
  if (!$getCreatorResult) { 
      $message  = 'Invalid query: ' . mysql_error() . "\n";
      $message .= 'Whole query: ' . $getCreatorQuery;
      die($message);
  }
  $userNameArray =  array();  
  $userEmailArray =  array();
  $userPhoneArray =  array();
  $userCountryArray =  array();
  $userUWCArray =  array();
  $userImageArray = array();

  while ($subject = mysql_fetch_assoc( $getCreatorResult)){ 
    $projectIdForCreators = ($subject['PROJECT_ID']);
      $creatorName = ($subject['CREATOR_NAME']);
      $creatorEmail = ($subject['CREATOR_EMAIL']);
      if ($projectId==$projectIdForCreators){     
        array_push($userNameArray, $creatorName);
        array_push($userEmailArray, $creatorEmail);
      }
  }
  
  for($i=0; $i<sizeof($userEmailArray); $i++) { 
  // Get info asociated with the user 
  $userInfoQuery = "SELECT * FROM `USER_INFO` WHERE `EMAIL`= '$userEmailArray[$i]' ";
  $userInfoResult = mysql_query($userInfoQuery,$connection);
    if (!$userInfoResult) { 
      $message  = 'Invalid query: ' . mysql_error() . "\n";
      $message .= 'Whole query: ' . $userInfoQuery;
      die($message);
  }
  while ($subject = mysql_fetch_assoc( $userInfoResult)){ 
    $name = ($subject['NAME']);
    $country = ($subject['COUNTRY']);
    $UWC = ($subject['UWC']);
    $phone = ($subject['PHONE']);
    $profilePic = ($subject['PROFILE_PIC']);
    array_push($userCountryArray, $country);
    array_push($userUWCArray, $UWC);
    array_push($userPhoneArray, $phone);
    array_push($userImageArray, $profilePic);
  }
}

  // ///////////////////////////////////////////////////////////////////////////////////////////

  $getAdvisorQuery = "SELECT  * FROM  `PROJECT_ADVISOR` WHERE `PROJECT_ID`='".$projectId."' ";
  $getAdvisorResult = mysql_query($getAdvisorQuery,$connection);
  if (!$getAdvisorResult) { 
      $message  = 'Invalid query: ' . mysql_error() . "\n";
      $message .= 'Whole query: ' . $getAdvisorQuery;
      die($message);
  }
  $advisorNameArray =  array();
  $advisorEmailArray =  array();
  while ($subject = mysql_fetch_assoc( $getAdvisorResult)){ 
    $projectIdForAdvisors = ($subject['PROJECT_ID']);
    $advisorName = ($subject['ADVISOR_NAME']);
    $advisorEmail = ($subject['ADVISOR_EMAIL']);
    if ($projectId==$projectIdForAdvisors){
      array_push($advisorNameArray, $advisorName);
      array_push($advisorEmailArray, $advisorEmail);
    }
  }
?>

<?php   mysql_close($connection); ?>


<!DOCTYPE html>
<html lang="en">
  <head>
  <title>UWC-NEXT | Initiative Description</title>
  <meta charset="utf-8">
  <meta name="description" content="Codester is a free responsive Bootstrap template by Dzyngiri">
  <meta name="keywords" content="UWC, Alumni, crowdfunding">
  <meta name="author" content="Inbetwin Networks">  
  <link rel="stylesheet" href="css/bootstrap1.css" type="text/css" media="screen">
  <link rel="stylesheet" href="css/responsive.css" type="text/css" media="screen">
  <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
  <link rel="stylesheet" href="css/details.css" type="text/css" media="screen">
  <link rel="stylesheet" href="css/touchTouch.css" type="text/css" media="screen">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/superfish.js"></script>
  <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
  <script type="text/javascript" src="js/jquery.cookie.js"></script>   
  <script type="text/javascript" src="js/touchTouch.jquery.js"></script> 

    
  <script type="text/javascript">if($(window).width()>1024){document.write("<"+"script src='js/jquery.preloader.js'></"+"script>");}  </script>
  <script>    
     jQuery(window).load(function() { 
     $x = $(window).width();    
  if($x > 1024)
  {     
  jQuery("#content .row").preloader();} 
  
  jQuery(".list-blog li:last-child").addClass("last"); 
  jQuery(".list li:last-child").addClass("last"); 

  
    jQuery('.spinner').animate({'opacity':0},1000,'easeOutCubic',function (){jQuery(this).css('display','none')});  

   jQuery('.magnifier').touchTouch();


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
   //    </script>
  </head>

  <body>
<div class="spinner"></div>
<!--  header  -->
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
                      <li><a href="#" data-toggle="modal" data-target="#loginModal"><i class="icon-user" style="margin-right:5px;"></i>Login</a></li>
                      <li><a href="#" data-toggle="modal" data-target="#signUpModal"><i class="icon-plus-sign" style="margin-right:5px;"></i>Signup</a></li>
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
                    </form> <!-- end navbar-form -->
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
  <!--  content  -->      
  <div id="content"><div class="ic"></div>
    <div class="row-1">
      <div class="container">
        <div class="row">
          <article class="span12">
            <div class="inner-1">        
          
            
            <h3 style="text-align:center;"><?php echo $projectName; ?></h3> 
            <hr>    
            <div class="name-author"><i class="icon-calendar"></i> <a href="#story-tab" data-toggle="tab"><?php echo $date; ?></a></div>
            <div class="i-update"><i class="icon-bullhorn"></i> <a href="#updates_tab" data-toggle="tab">Updates</a></div>
            <div class="i-update"><i class="icon-star-empty"></i> <a href="#funders_tab" data-toggle="tab">Funders</a></div>
            <div class="i-update"><i class="icon-film"></i> <a href="#gallery_tab" data-toggle="tab">Gallery</a></div>
            <div class="i-update"><i class="icon-user"></i> <a href="#team_tab" data-toggle="tab" onclick="meetOurCrew()">Team</a></div>
            <div class="icomm"><i class="icon-comment "></i> <a href="#comments_tab" data-toggle="tab" onclick="showComments()">Comments</a></div>
            <div><a href="#" class="icomm"><i class="icon-globe "></i> <?php echo $location; ?>, <?php echo $country; ?></a> </div>
            <div class="clear"></div>      
            <hr>   
            <article class="span8">
            <div class="row">

            <div class="tab-content" style="overflow:none">
              <div class="tab-pane active" id="story-tab" >
                <img alt="" src="<?php echo uploads . '/' . $image; ?>" style="padding-bottom:20px; width:600px; height:413px">
                <div class="links"><!-- Go to www.addthis.com/dashboard to customize your tools -->
                  <span class='st_facebook_hcount' displayText='Facebook'></span>
                  <span class='st_twitter_hcount' displayText='Tweet'></span>
                  <span class='st_linkedin_hcount' displayText='LinkedIn'></span>
                  <span class='st_digg_hcount' displayText='Digg'></span>
                  <span class='st_email_hcount' displayText='Email'></span>
                  <div class="full-info" style="margin-top:40px;">
                    <div class="proj_blurb">
                      <h5>Project Blurb</h5>
                      <p><?php echo $projectBlurb; ?></p>                      
                    </div>
                    <div class="proj_desc">
                      <h5>Project Description</h5>
                      <p><?php echo $description; ?></p>                      
                    </div>
                    <div class="proj_benefits">
                      <h5>Benefits</h5>
                      <p><?php echo $benefit; ?></p>                      
                    </div>
                    <div class="risk">
                      <h5>Risks and Challenges</h5>
                      <p><?php echo $challenges; ?></p>                      
                    </div>
                    <!-- <div class="faq">
                      <h4>FAQ</h4>
                      <p> Have question/thoughts/concerns? Feel free to drop the project creator a line. Thanks! </p>
                      <a href="#" class="btn btn-primary  " style="font-weight:bold; font-size:20px;">To Creator</a>                                
                    </div> -->
                  </div>
                </div>
              </div> 


              <div class="tab-pane" id="updates_tab" >                
                  <div class="update_number"> <h5 href="#">Update #1</h5>
                    <br>
                    <time datetime="2012-11-09" class="date-1"><i class="icon-calendar"></i> 9.11.2012</time>
                    <div class="post-author"><i class="icon-user"></i> <a href="#">Author Name</a></div>
                    <br>
                    <hr>
                      <div class="update_post">
                        <p>Morbi ullamcorper, leo eget varius elementum, orci leo feugiat lectus, vitae lobortis mauris velit tempor erat. Etiam eget orci at massa pretium fringilla ac non tortor. Fusce sed velit risus, vitae vehicula quam. Cras at turpis urna, eget volutpat neque. Nullam porttitor, est interdum placerat pharetra, erat sapien aliquet urna, at commodo risus tellus eu nunc.</p>
                        <p>Morbi ullamcorper, leo eget varius elementum, orci leo feugiat lectus, vitae lobortis mauris velit tempor erat. Etiam eget orci at massa pretium fringilla ac non tortor. Fusce sed velit risus, vitae vehicula quam. Cras at turpis urna, eget volutpat neque. Nullam porttitor, est interdum placerat pharetra, erat sapien aliquet urna, at commodo risus tellus eu nunc.</p>
                      </div>
                  </div>
                  <BR>
                  <HR>
                  <div class="update_number"><h5 href="#">Update #2</h5>
                    <br>
                    <time datetime="2012-11-09" class="date-1"><i class="icon-calendar"></i> 9.11.2012</time>
                    <div class="post-author"><i class="icon-user"></i> <a href="#">Author Name</a></div>
                      <br>
                      <hr>
                        <div class="update_post">
                          <p>Morbi ullamcorper, leo eget varius elementum, orci leo feugiat lectus, vitae lobortis mauris velit tempor erat. Etiam eget orci at massa pretium fringilla ac non tortor. Fusce sed velit risus, vitae vehicula quam. Cras at turpis urna, eget volutpat neque. Nullam porttitor, est interdum placerat pharetra, erat sapien aliquet urna, at commodo risus tellus eu nunc.</p>
                          <iframe width="640" height="360" src="//www.youtube.com/embed/hQP8cRe5g64" frameborder="0" allowfullscreen></iframe>
                           <br>
                           <p>Morbi ullamcorper, leo eget varius elementum, orci leo feugiat lectus, vitae lobortis mauris velit tempor erat. Etiam eget orci at massa pretium fringilla ac non tortor. Fusce sed velit risus, vitae vehicula quam. Cras at turpis urna, eget volutpat neque. Nullam porttitor, est interdum placerat pharetra, erat sapien aliquet urna, at commodo risus tellus eu nunc.</p>
                        </div>
                  </div>
                  <BR>
                  <HR>
                  <div class="update_number"> <h5 href="#">Update #3</h5>
                    <br>
                    <time datetime="2012-11-09" class="date-1"><i class="icon-calendar"></i> 9.11.2012</time>
                    <div class="post-author"><i class="icon-user"></i> <a href="#">Author Name</a></div>
                      <br>
                      <hr>
                        <div class="update_post">
                          <p>Morbi ullamcorper, leo eget varius elementum, orci leo feugiat lectus, vitae lobortis mauris velit tempor erat. Etiam eget orci at massa pretium fringilla ac non tortor. Fusce sed velit risus, vitae vehicula quam. Cras at turpis urna, eget volutpat neque. Nullam porttitor, est interdum placerat pharetra, erat sapien aliquet urna, at commodo risus tellus eu nunc.</p>
                          <img alt="" src="img/blog-1.jpg" style="padding-bottom:20px; ">
                          <p>Morbi ullamcorper, leo eget varius elementum, orci leo feugiat lectus, vitae lobortis mauris velit tempor erat. Etiam eget orci at massa pretium fringilla ac non tortor. Fusce sed velit risus, vitae vehicula quam. Cras at turpis urna, eget volutpat neque. Nullam porttitor, est interdum placerat pharetra, erat sapien aliquet urna, at commodo risus tellus eu nunc.</p>
                        </div>
                  </div>
                   <!-- DC Divider Start -->
                  <div class="tsc_divider4"></div>
                  <div class="tsc_divider4_black"></div>
                  <hr>
                  <!-- DC Divider End -->
                  <div class="pagination">
                    <ul class="tsc_pagination tsc_paginationB tsc_paginationB04">
                      <li><a href="#" class="first">First</a></li>
                      <li><a href="#" class="previous">Previous</a></li>
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#" class="current">3</a></li>
                      <li><a href="#" class="next">Next</a></li>
                      <li><a href="#" class="last">Last</a></li>
                    </ul>                    
                  </div>
                </div>

                <div class="tab-pane" id="funders_tab" >
                  <div class="update_post" style="text-align: center; ">          
                    <h3>Coming Soon... </h3>
                    <img alt="" title="" style="padding-top:40px; max-height:50%;" src="img/uc.png">
                  </div>        
                </div>


                <div class="tab-pane" id="gallery_tab" style="margin: 0 0 0 70px; ">
                <h4> Gallery/Media </h4><br> 
                <div class="media">
                  <ul class="portfolio clearfix">           
                     <li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/work/1.jpg"></a></li> 
                     <li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/work/2.jpg"></a></li> 
                     <li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/work/3.jpg"></a></li> 
                     <li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/work/4.jpg"></a></li> 
                     <li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/work/5.jpg"></a></li> 
                     <li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/work/6.jpg"></a></li> 
                     <li class="box"><a href="img/image-blank.png" class="magnifier" ><iframe width="270" height="192" src="//www.youtube.com/embed/hQP8cRe5g64" frameborder="0" allowfullscreen></iframe></a></li> 
                     <li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/work/8.jpg"></a></li>
                     <div class="clear"></div>
                     <li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/work/9.jpg"></a></li> 
                     <li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/work/10.jpg"></a></li> 
                     <li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/work/11.jpg"></a></li> 
                     <li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/work/12.jpg"></a></li> 
                     <li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/work/13.jpg"></a></li> 
                     <li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/work/14.jpg"></a></li> 
                     <li class="box"><a href="img/work/8.jpg" class="magnifier" ><iframe width="270" height="192" src="//www.youtube.com/embed/hQP8cRe5g64" frameborder="0" allowfullscreen></iframe></a></li> 
                     <li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/work/16.jpg"></a></li>                  
                  </ul> 
                </div>

                </div>

                <div class="tab-pane" id="team_tab" >
                  <div class="table_team">
                  <h4>Meet our Crew</h4>
                    <div id="content"><div class="ic"></div>
                      <article class="span8">
                      <div class="clear"></div>
                       <ul id="projectCrew" class="portfolio clearfix">                     
                      </ul>
                      </article>
                    </div>
                    <div id="projectCrew" class="CSSTableGenerator" ></div>
            
                    
                  </div>
                  </div>

                <div class="tab-pane" id="comments_tab">
                <div class="comments_div">
                <h4>Comments / Feedback / Thoughts</h4>
                <br>
                <div id="comments" class="comments_div">


                   <!--  <blockquote>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                      </p> <small>Someone famous <cite>Source Title</cite></small>
                    </blockquote>
                                      <hr>

                    <blockquote>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                      </p> <small>Someone famous <cite>Source Title</cite></small>
                    </blockquote>
                                      <hr>

                    <blockquote>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                      </p> <small>Someone famous <cite>Source Title</cite></small>
                    </blockquote>
                                      <hr>

                    <blockquote>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                      </p> <small>Someone famous <cite>Source Title</cite></small>
                    </blockquote>
                                      <hr>

                    <blockquote>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                      </p> <small>Someone famous <cite>Source Title</cite></small>
                    </blockquote>
                                      <hr>

                    <blockquote>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                      </p> <small>Someone famous <cite>Source Title</cite></small>
                    </blockquote>
                                      <hr>

                    <blockquote>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                      </p> <small>Someone famous <cite>Source Title</cite></small>
                    </blockquote> 
                                      <hr> -->
                </div>

                     <div class="pagination" style="margin-bottom:90px; ">
                    <ul class="tsc_pagination tsc_paginationB tsc_paginationB04">
                      <li><a href="#" class="first">First</a></li>
                      <li><a href="#" class="previous">Previous</a></li>
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#" class="current">3</a></li>
                      <li><a href="#" class="next">Next</a></li>
                      <li><a href="#" class="last">Last</a></li>
                    </ul>    

                  </div>


                  <div class="comment_form">
                   <form id="feedbackForm" lass="form-horizontal">
                      <fieldset>

                      <!-- Form Name -->
                      <legend>We would love to hear your comments/thoughts/feedback</legend>
                      <!-- Text input-->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="full_name">Your Full Name</label>  
                        <div class="col-md-5">
                        <input id="full_name" name="full_name" type="text" placeholder="full name" class="form-control input-md" required="">                          
                        </div>
                      </div>
                      <br>
                      <!-- Text input-->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="email_id">Your Email Address</label>  
                        <div class="col-md-4">
                        <input id="email_id" name="email_id" type="text" placeholder="e-mail " class="form-control input-md" required="">                          
                        </div>
                      </div>
                      <br>
                      <!-- Text input-->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="uwc_name">Your UWC</label>  
                        <div class="col-md-5">
                        <input id="uwc_name" name="uwc_name" type="text" placeholder="UWC-Mahindra 10'" class="form-control input-md" required="">
                        <span class="help-block">please also add your graduation year</span>  
                        </div>
                      </div>
                      <br>
                      <!-- Textarea -->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="message">Comment/Feedback/Thoughts</label>
                        <div class="col-md-4">                     
                          <textarea class="form-control" id="message" name="message">drop us a line...</textarea>
                        </div>
                      </div>
                      <br>

                      <!-- Button -->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="singlebutton"></label>
                        <div class="col-md-4">
                          <button id="singlebutton" name="singlebutton" onclick="submitFeedback()" class="btn btn-primary">Submit</button>
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

             <article class="span3">
             <div class="top-right-box">
             <h5 style="text-align:center;">Funds</h5>
              <hr>

              <div class="m-container">
               <div class="m-raised">

                <h4>$50,000</h4>
                <em> Raised</em>
               </div>
               <div class="m-goal">
                <h4>$100,000</h4>
                <em> Goal</em>
               </div>
               </div>  

               <div class="prog">
               <h5>Progress</h5>
                36%  <span class="pull-right">help us reach here...</span>
                <div class="progress progress-striped active">
                    <div class="bar" style="width: 36%;"></div>
                </div>
                </div>

                <div class="col-md-3">
                   <a href="#" class="btn btn-success btn-lg btn-block btn-huge" style="font-weight:bold; font-size:28px;">Pitch In</a>
               </div>
              
              </div>


              <div class="mid-right-box">
             
              <h5>Meet the Creator</h5>
              <hr>
                <?php if ($userImageArray[0] != "") {?>
                <div class="col-sm-6 col-md-4">
                    <img src="<?php echo uploads . '/' . $userImageArray[0]; ?>" alt="" class="img-circle"/>
                </div>
                <?php } else { ?>
                <div class="col-sm-6 col-md-4">
                    <img src="uploads/member.png" alt="" class="img-circle"/>
                </div>
                <?php } ?>
                <div class="col-sm-6 col-md-8">
                    <h4><?php echo $userNameArray[0]; ?></h4>
                    <b><cite title="San Francisco, USA"><?php echo $userCountryArray[0]; ?> <i class="glyphicon glyphicon-map-marker">
                    </i></cite></b><br>
                    <b><cite title="San Francisco, USA"><?php echo $userUWCArray[0]; ?> <i class="glyphicon glyphicon-map-marker">
                    </i></cite></b>
                   <small><?php echo $userEmailArray[0]; ?></p>
                       
                    <!-- Split button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            <span class="sr-only">Full Profile</span>
                        </button>
                    </div>
                    
                    <div "showMembers" style="margin-top:60px;">
                    <h5>Members</h5>
                    <hr>
                    <ul id="userIcons" class="portfolio clearfix">                     
                      </ul>
                    <div class="image-clear"></div>                          
                    </div>    
                </div>
          




              </div>

              <div class="bottom-right-box">
                <h5>Updates/Feeds/Comments</h5>
                <hr>
                <q>Build a future where people live in harmony with nature.</q>
                  We hope they succeed.</p>
                <br>
                <q>Build a future where people live in harmony with nature.</q>
                  We hope they succeed.</p>
                  <br>
                  <q>Build a future where people live in harmony with nature.</q>
                  We hope they succeed.</p>
                   <br>
                  <q>Build a future where people live in harmony with nature.</q>
                  We hope they succeed.</p>
                   <br>
                  <q>Build a future where people live in harmony with nature.</q>
                  We hope they succeed.</p>
                   <br>
                  <q>Build a future where people live in harmony with nature.</q>
                  We hope they succeed.</p>
                   <br>
                  <q>Build a future where people live in harmony with nature.</q>
                  We hope they succeed.</p>
                   <br>
                  <q>Build a future where people live in harmony with nature.</q>
                  We hope they succeed.</p>


              </div>


             </article>
                        
           
                          
          
          </div>  
        </article>


      </div>
     </div>
    </div>

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
<script type="text/javascript" src = "uwcnext.js"></script> 
<script type="text/javascript" src = "script.js"></script> 
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "f3aed800-c243-4ca2-9542-fed414ae2458", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<script type="text/javascript">
  window.uid = <?php echo json_encode($_SESSION['uid']);?>;
  window.userEmail = <?php echo json_encode($_SESSION["email"]);?>;
  window.projectId =   <?php echo json_encode($projectId);?>;
  var userNameArray = <?php echo json_encode($userNameArray); ?>;
  var userEmailArray = <?php echo json_encode($userNameArray); ?>;
  var userUWCArray = <?php echo json_encode($userUWCArray); ?>;
  var userImageArray = <?php echo json_encode($userImageArray); ?>;
  var advisorNameArray = <?php echo json_encode($advisorNameArray); ?>;

  $("#userIcons").html();
  if (userNameArray.length <=0) {
    $("#showMembers").hide();
  }  
  for (var i=1; i<userNameArray.length; i++){
    var profilePic = userImageArray[i];
    var userName = userNameArray[i];
    if (profilePic =="" || profilePic == undefined){
      profilePic = "member.png";
    }
    $("#userIcons").append('<li class="span1" style="margin-bottom:15px;"><div ><img src="uploads/'+ profilePic +'" class="img-circle img-responsive"></div><br><a style="" href=""><b>'+userName+'</b></a><li>')
  }

function meetOurCrew(){
  $("#projectCrew").html("");
  for (var i=0; i<userNameArray.length; i++){
    var userName = userNameArray[i];
    var uwc = userUWCArray[i];
    if (uwc =="" || uwc == undefined){
      uwc = "";
    }
    var profilePic = userImageArray[i];
    if (profilePic =="" || profilePic == undefined){
      profilePic = "member.png";
    }

    // $("#projectCrew").append('<li class="box"><img style="margin-bottom:40px; width:140px; height:218px;"src="uploads/'+ profilePic +'" alt="" class="img-circle img-responsive" /><div style="margin:auto"><a style="" href=""><b>'+userName+'</b><br></a> <em>'+uwc+'</em><div style="" class="btn-group"><button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="sr-only">Full Profile</span></button></div</div></li>');    

    $("#projectCrew").append('<li class="span3" style="margin-bottom:25px;"><div class="mid-right-box"><div class="col-sm-6 col-md-4"><img src="uploads/'+ profilePic +'" alt="" style="margin-bottom:30px;max-width:220px; max-height:215px;" class="img-circle img-responsive"/></div><div class="col-sm-6 col-md-8" style="margin:auto"><a style="" href=""><h5>'+userName+'</h5></a> <b><cite>'+uwc+'</cite></b><div style="margin-top:10px;" class="btn-group"><button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="sr-only">Full Profile</span></button></div</div></li>');  
    }
  }

function showComments(){
  $("#comments").html("");
  $.ajax({
    type: "POST",
    url: "feedback.php",
    data: { id: projectId, action: "receive" },
    }). done(function(response){
      response = JSON.parse(response);
      alert(response);   

      for (var i=0; i<response.length; i++){
        var name = (response[i].NAME);
        var email =  (response[i].SHORT_BLURB);
        var uwc = (response[i].UWC);
        var comment = (response[i].COMMENT);
        var datetime = (response[i].DATETIME);
        $("#comments").append('<blockquote><p>'+comment+'</p> <small>'+name+' <cite> ('+uwc+': '+email+') </cite></small></blockquote><hr>');
      }
    });  
}


/*

  if (userNameArrayLength==1) {
    $("#firstCreator").show();
  } else if (userNameArrayLength==2) {
    $("#firstCreator").show();
    $("#secondCreator").show();
  } else if (userNameArrayLength==3) {
    $("#firstCreator").show();
    $("#secondCreator").show();
    $("#thirdCreator").show();
  } else if (userNameArrayLength==4) {
    $("#firstCreator").show();
    $("#secondCreator").show();
    $("#thirdCreator").show();
    $("#fourthCreator").show();
  }

  if (advisorNameArrayLength==1) {
    $("#firstAdvisor").show();
  } else if (advisorNameArrayLength==2) {
    $("#firstAdvisor").show();
    $("#secondAdvisor").show();
  } else if (advisorNameArrayLength==3) {
    $("#firstAdvisor").show();
    $("#secondAdvisor").show();
    $("#thirdAdvisor").show();
  } else if (advisorNameArrayLength==4) {
    $("#firstAdvisor").show();
    $("#secondAdvisor").show();
    $("#thirdAdvisor").show();
    $("#fourthAdvisor").show();
  }

  var descriptionId = <?php echo json_encode($descriptionId); ?>;
  if(descriptionId == 10){
    $("#actionListForDetailedProject").show();
  } else if(descriptionId == 11){
    $("#actionListForMyProject").show();
  } else if(descriptionId == 12){
    $("#actionListForDetailedProject").show();
    $("#changeFollowToUnfollow").html('<a  href="#pill1" data-toggle="pill" onclick="actionForm(<?php echo $projectId; ?>, 5)"><span class="glyphicon glyphicon-thumbs-down"></span> Unollow</a>');
  }
*/
  // Creates table with three-columns with the id provided...
// funtioon CreateTable() is used to show the result of searched-item and myShareBOT
</script>

</body>
</html>