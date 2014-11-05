<?php 
  ob_start();
  session_start();
  include 'includes/Bluehost_connect.php';


  if ($_SESSION["uid"] !="") {
    $email = $_SESSION["email"];
    $userInfoQuery  = "SELECT * FROM `USER_INFO` WHERE `EMAIL`= '$email' ";
    $userInfoResult = mysql_query($userInfoQuery, $connection);
    if (!$userInfoResult) {
      $message = 'Invalid query: ' . mysql_error() . "\n";
      $message .= 'Whole query: ' . $userInfoQuery;
      die($message);
    }
    while ($subject = mysql_fetch_assoc($userInfoResult)) { 
      $name = ($subject['NAME']);
      $country = ($subject['COUNTRY']);
      $uwc = ($subject['UWC']);
      $uwcYear=($subject['UWC_YEAR']);
      $association = ($subject['ASSOCIATION_DESCRIPTION']); 
      $languages = ($subject['LANGUAGES']);
      $skills = ($subject['SKILLS']);
      $bio = ($subject['BIO']);
      $phone = ($subject['PHONE']);
      $email = ($subject['EMAIL']);
      $profilePic = ($subject['PROFILE_PIC']);    
    }
  }
  ?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>Our Common Future</title>
    <meta charset="utf-8">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

<meta name="image" content="https://ocf.co/projects/images/Logo.png">   
<meta name="author" content="Our Common Future">         
<meta property="og:title" content="Our Common Future">
<meta property="og:type" content="website">
<meta property="og:url" content="https://ocf.co/projects/index.php">
<!-- <meta property="og:image" content="https://ocf.co/projects/images/Logo.png"> -->
<meta property="og:site_name" content="Our Common Future">
<meta property="fb:admins" content="USER_ID">
<meta property="fb:app_id" content="APP_ID">
<meta property="og:description" content="OCF is a social enterprise which offers online education to high school students from across the globe. Alongside our class offerings, OCF has created a social community platform which helps empower youth to create their own social enterprise or other pro">




    <link rel="stylesheet" href="css/uwcnext.css" type="text/css" >
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/responsive.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/touchTouch.css" type="text/css" media="screen">
    <link rel="stylesheet" type="text/css" href="css/socialicious.css" media="screen"> 
    <link rel="stylesheet" href="bootstrap-tagsinput/bootstrap-tagsinput.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/kwicks-slider.css" type="text/css" media="screen">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:205,300' rel='stylesheet' type='text/css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css" rel="stylesheet">
    <link href="css/jquery.notifyBar.css" rel="stylesheet" media="screen">
    <link href="css/tm_docs.css" rel="stylesheet">
    <script id="metamorph-1-start" type="text/x-placeholder"></script><script id="metamorph-21-start" type="text/x-placeholder"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="bootstrap-tagsinput/bootstrap-tagsinput.min.js.map"></script>
    <script type="text/javascript" src="bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
     <!-- <script type="text/javascript" src="bootstrap-tagsinput/bootstrap-tagsinput.less"></script>
    // <script type="text/javascript" src="bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    // <script type="text/javascript" src="bootstrap-tagsinput/bootstrap-tagsinput-angular.js"></script> -->


    <script type="text/javascript" src="js/superfish.js"></script>
    <script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
    <script type="text/javascript" src="js/jquery.kwicks-1.5.1.js"></script>
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="js/jquery.cookie.js"></script>    
    <script type="text/javascript" src="js/touchTouch.jquery.js"></script>
    <script type="text/javascript" src="js/jquery.notifyBar.js"></script>
    <script type="text/javascript">if($(window).width()>1024){document.write("<"+"script src='js/jquery.preloader.js'></"+"script>");}	</script>
    <!-- PHP files -->
    <?php include 'modal.php'; ?> <!-- Includes all modal (login, signup, contact, feedback) -->
    <script>		
      jQuery(window).load(function() {	
      	$x = $(window).width();		
      	if($x > 1024)
      	{ jQuery("#content .row").preloader();    }	
      		 
        jQuery('.magnifier').touchTouch();			
        jQuery('.spinner').animate({'opacity':0},1000,'easeOutCubic',function (){jQuery(this).css('display','none')});	
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
      <div class="container ">
        <div class="row">
          <div class="span12">
            <div class="navbar navbar_" style="right:-25px">
              <div class="container">
                <h1 class="brand brand_"><a href="" onclick="homeReturn()"><img alt="" src="/ocf_logo.png" style="width:85px; height:40px;" > </a></h1>
                <a class="btn btn-navbar btn-navbar_" data-toggle="collapse" data-target=".nav-collapse_" style="right:25px"> &#9776; </a>
                <div class="nav-collapse nav-collapse_  collapse pull-right">
                  <ul class="nav sf-menu pull-right" >
                    <!-- <li>
                      <a href = "index.php"><i class="icon-home" style="margin-right:5px;"></i>  </a>
                    </li>    -->                 
                    <li class="sub-menu" id="createProjectButton">
                    <?php if($_SESSION["uid"]==""){?>  
                      <a href="../login_page.php" >Create Initiative</a> 
                    <?php } else { ?>
                      <a href="#tab4" data-toggle="tab">
                        Create Initiative
                      </a>
                    <?php }  ?>
                       
                    </li>
                    <!-- <li class="sub-menu"><a href="" onclick="helpInitiative(1)">Initiatives</a> -->
                    <!-- <ul>
                      <li><a href="#tab2" data-toggle="tab"  onclick='sortInitiative("current", 1);'><i class="icon-new-window" style="margin-right:5px;"></i>Current</a></li>
                      <li><a href="#tab3" data-toggle="tab" onclick='sortInitiative("finished", 1);'><i class="icon-check" style="margin-right:5px;"></i>Finished</a></li>
                      <li id="createProjectButton"><a href="#tab4" data-toggle="tab"><i class="icon-folder-open" style="margin-right:5px;"></i>Create New</a></li>
                      </ul> 
                      </li> -->
                    <li class="sub-menu" data-toggle="tab" style=" <?php if($_SESSION["uid"]==""){?>display:none;<?php }else{?>padding:0px; <?php }?>" ><a data-toggle="tab"  href="#tab6"  onclick='myProjects(1, "current")'> My Initiatives</a>
                    </li>
                    <?php if($_SESSION["uid"]==""){?>                  
                    <li class="sub-menu">
                      <a href="../login_page.php" >Login</a>                      
                      <!-- <ul>
                        <li><a href="#" data-toggle="modal" data-target="#loginModal"><i class="icon-user" style="margin-right:5px;"></i>Login</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#signUpModal"><i class="icon-plus-sign" style="margin-right:5px;"></i>Signup</a></li>
                      </ul> -->
                    </li>
                    <?php } else {?>
                    <li >
                      <a  > <span style="color:#DB420E; padding-top:10px; font-size:11px; font-weight:bold"><?php echo ($_SESSION["name"]);?></span></a>
                      <ul>
                        <li>
                          <a href = "editProfile.php"> Edit Profile </a>
                        </li>
                        <!-- <li>
                          <a href="#"><i class="icon-briefcase" style="margin-right:5px;"></i> Billing </a>
                        </li> -->
                        <li class="divider"></li>
                        <li>
                          <a href="logout.php"> </a>
                        </li>
                      </ul>
                    </li>
                    <?php } /*?>	
                    <li class="sub-menu">
                      <a href="aboutUs.php" >
                        <i class="icon-folder-open" style="margin-right:5px;"></i> About Us
                      </a>
                    </li>  
                    <? */ ?>
                    <!-- <li class="sub-menu">
                    <a href="#tab4" data-toggle="tab">
                        <i class="icon-folder-open" style="margin-right:5px;"></i>Feedback
                      </a> 
                    </li>      -->     
                    <li class="sub-menu" style="padding-top: 10px;">
                      <!-- <div> -->
                      <form id="searchForm" class="navbar-form pull-right" onsubmit="searchSubmit(event)">
                      <input type="text" class="form-control" id="searchInput" placeholder ="Search">
                      <!-- <a href="#tab5" data-toggle="tab" onClick="searchSubmit(event)"><button id="searchButton" type="submit" class= "btn btn-default"><i class="icon-search" ></i></button></a> -->
                      </form>	
                      <!-- </div> -->
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
      <div id="content">
        <div class="ic"></div>
        <div class="row-1">
          <div class="container">
            <div class="row">
              <div class="tab-content" style="min-height:250px; overflow:none">
                <div class="tab-pane active" id="tab1" >
                  <div style="float:left" class="span2">
                    <h4>Categories</h4>
                    <ul style="cursor:pointer;" onClick="sortCategory(event, 1)">
                      <h6 class="category"><a id="artsCulture" >Arts &amp Culture</a></h6>
                      <h6 class="category"><a id="conflictResolution">Conflict Resolution</a></h6>
                      <h6 class="category"><a id="education" >Education</a></h6>
                      <h6 class="category"><a id="environment">Environment</a></h6>
                      <h6 class="category"><a id="healthWelfare">Health &amp Welfare</a></h6>
                      <h6 class="category"><a id="human_rights" >Human Rights</a></h6>
                      <h6 class="category"><a id="media">Media</a></h6>
                      <h6 class="category"><a id="Technology">Technology</a></h6>
                      <h6 class="category"><a id="povertyAlleviation">Poverty Alleviation</a></h6>
                      <h6 class="category"><a id="sustainability" >Sustainability</a></h6>                      
                      <h6 class="category"><a id="wilderness">Wilderness</a></h6>
                      <h6 class="category"><a id="youthWomenEmpowerment">Youth &amp Women Empowerment</a></h6>
                    </ul>
                  </div>
                  <div class="span10">
                    <div class="span10">
                      <div class="span5">
                        <h4 id="title" style="text-align:center;">Initiatives</h4>
                      </div>
                      <div class="span4 pull-right">
                        <h4 id="showFeed"></h4>
                      </div>
                    </div>
                    <div>
                      <div class="clear"></div>
                      <ul id="feed" class="portfolio clearfix"></ul>
                    </div>
                    <div class="pagination ">
                      <ul  id="totalProjectPagination" style="display:inline" class="tsc_pagination tsc_paginationB tsc_paginationB04">                                     
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab5" >
                  <div class="row">
                    <h4 id="showSearchFeed">Search Results</h4>
                    <div>
                      <div class="clear"></div>
                      <ul id="searchProjectFeed" class="portfolio "></ul>
                    </div>
                    <div class="pagination">
                      <ul  id="searchProjectPagination" style="display:inline" class="tsc_pagination tsc_paginationB tsc_paginationB04">                                     
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab6" style = "height:auto; min-height:400px; margin:10px auto;">
                  <div class="tabbable" style="padding-bottom:50px;">
                    <h4 style="text-align:center;">My Initiatives</h4>
                    <div style="">
                      <hr style="margin:">
                      <div id="pills" style="margin-left:35%; font-size: 20px; font-weight:bold;">
                        <ul class="nav nav-pills">
                          <li class="active" style="margin-right:15px;"><a href="#pill1" data-toggle="pill" onclick='myProjects(1, "current")' style=""><i class="icon-folder-open"></i> Active </a></li>
                          <li style="margin-right:15px;"><a href="#pill2" data-toggle="pill" onclick='myProjects(1, "followed")' style=""><i class="icon-plus-sign" ></i> Followed</a></li>
                          <li style="margin-right:15px;"><a href="#pill3" data-toggle="pill" onclick='myProjects(1, "past")' style=""><i class="icon-folder-close" ></i> Completed </a></li>
                        </ul>
                      </div>
                      <hr style="margin-top:-10px;">
                    </div>
                    <div class="row" >
                      <div class="col-sm-2"></div>
                      <div class="col-sm-10" style="margin-top:25px; margin-left:10%;">
                        <div class="pill-content">
                          <div class="pill-pane active" id="pill1">
                            <div>
                              <div class="clear"></div>
                              <ul id="currentProject" class="portfolio "></ul>
                            </div>
                            <div class="pagination">
                              <ul  id="currentProjectPagination" style="display:inline" class="tsc_pagination tsc_paginationB tsc_paginationB04">                                     
                              </ul>
                            </div>
                          </div>
                          <div class="pill-pane" id="pill2">
                            <div>
                              <div class="clear"></div>
                              <ul id="followedProject" class="portfolio "></ul>
                            </div>
                            <div class="pagination">
                              <ul  id="followedProjectPagination" style="display:inline" class="tsc_pagination tsc_paginationB tsc_paginationB04">                                     
                              </ul>
                            </div>
                          </div>
                          <div class="pill-pane" id="pill3">
                            <div>
                              <div class="clear"></div>
                              <ul id="pastProject" class="portfolio "></ul>
                            </div>
                            <div class="pagination">
                              <ul  id="pastProjectPagination" style="display:inline" class="tsc_pagination tsc_paginationB tsc_paginationB04">                                     
                              </ul>
                            </div>
                          </div>                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab4" style="<?php if($_SESSION["uid"]==""){?>display:none;<?php }else{?>font-size:90%;<?php }?>">
                  <div id="projectForm" enctype="multipart/form-data" style="color:black">
                    <div  id="projectDescriptionForm" style="margin:25px 0 0 25px; width:1000px; height:auto;" >
                      <br>
                      <h5 class="category">Initiative Description</h5>
                      <form  role = "form" id = "projectDescription" method="POST"  style="margin-left:20px;">
                        <div class="form-group">
                          <table>
                            <tr>
                              <td>
                                <label>Initiative Title</label>
                                <div class="input-append" data-role="acknowledge-input" >
                                  <input class="form-control" style="width:400px;" type="text" name="projectName" id="projectName" placeholder="required..." maxlength="45"required="required">
                                  <div data-role="acknowledgement"><i></i></div>
                                </div>
                              </td>
                              <td>
                                <p style="margin:20px 0 0 15px">Your initiative title should be simple, specific, and yet memorable. Avoid words such as "help", "support", "sponsor" or "fund"  <b>(Required)</b></p>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <label> Category </label>
                                <select name="category[]"  style="width:415px;" id="category" class="form-control" multiple="multiple">
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
                                  <option>Other</option>
                                </select>
                              </td>
                              <td>
                                <p style="margin:20px 0 0 15px"> Press Control/Command key to select multiple categories for your initiatives.  <b>(Required)</b> </p>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <label> Location </label>
                                <input class="form-control" type="text" name="location" id="location" placeholder="City/Town" style="width:150px;" required>
                                <select name="countryName" id="countryName" class="form-control" style="width:150px;">
                                  <option value="" selected="selected"> Country</option>
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
                                <p style="margin:20px 0 0 15px">  Proposed location of the Initiative  <b>(Required)</b></p>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <label> Initiative Pitch </label>
                                <textarea id="pitch" class="form-control" type="text" name="shortBlurb" id="shortBlurb" placeholder="" required style="width:400px; height:100px; resize:none;" maxlength="150"></textarea>
                                <div style="color:#3B5999; padding-bottom:20px;"id="textarea_feedback"></div>
                              </td>
                              <td>
                                <p style="margin:20px 0 0 15px">  About 150 characters: if you had to describe your initiative in a tweet ...  <b>(Required)</b></p>
                              </td>
                            </tr>
                            <!-- <tr>
                              <td>
                                <label> Funding Goal</label>
                                <input class="form-control" style="width:400px;" type="text" name="funding" id="funding" placeholder="US $0.00">
                              </td>
                              <td>
                                <p style="margin:20px 0 0 15px"> How much funds do you need to complete this initiative?  <b>(Required)</b></p>
                              </td>
                            </tr> -->
                            <tr>
                              <td>
                                <label> Benefits</label>
                                <textarea class="form-control" name="benefit" id="benefit" placeholder="required..." style="width: 400px; height:100px; resize:none"></textarea>
                              </td>
                              <td>
                                <p style="margin:20px 0 0 15px">  Who, what, when, how does it enhance the UWC experience? Why should your initiative be sponsored?  </p>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <label> Initiative Image</label>
                                <input id="img_file" type="file" name="file[]" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png"> 
                              </td>
                              <td>
                                <p style="margin:20px 0 0 15px">Please upload a logo/image for your initiative. </p>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <br><label> Initiative Video (Youtube or Vimeo) </label>
                                <textarea class="form-control" name="video" id="video" placeholder="" style="width: 400px; height:50px; resize:none"></textarea>
                              </td>
                              <td>
                                <p style="margin:20px 0 0 15px">  Initiatives with a video have a much higher chance of success. It doesn't need to be an Oscar contender, just be yourself and explain what you want to do. Upload your video to <b>YOUTUBE.COM </b> or <b>VIMEO.COM</b> and paste the link here. </p>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <label> Initiative Description</label>
                                <textarea class="form-control" name="description" id="description" placeholder="required..." style="width: 400px; height:100px; resize:none"></textarea>
                              </td>
                              <td>
                                <p style="margin:20px 0 0 15px">  Use your initiative's description to share more about what you're raising funds to do and how you plan to pull it off. It's up to you to make the case for your Initiative.  <b>(Required)</b></p>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <label> Risks and Challenges</label>
                                <textarea class="form-control" name="risksAndChallenges" id="risksAndChallenges" placeholder="" style="width: 400px; height:100px; resize:none"></textarea>
                              </td>
                              <td>
                                <p style="margin:20px 0 0 15px;">  What are the risks and challenges that come with completing your initiative and how are you qualified to overcome them? Sharing potential challenges - and your plans and qualifications for tackling them - is an important part of building a community around your initiative. Think about all the various steps to completing your initiative and which ones pose challenges. Every initiave has risks and challenges, just be open and honest about yours.</p>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <label> How can people help you? </label>
                                <input class="form-control"type="text" value="" data-role="tagsinput" name="lookingFor" id ="lookingFor"style="width:400px;" placeholder="Add your needs.."  />
                                <p class="help-block">Press 'Enter' after each entry.</p>
                              </td>
                              <td>
                                <p style="margin:20px 0 0 15px;">  What help do you need in order to complete your initiative? Please list all kind of help you may need. (Funds, Construction material, Volunteers etc.. )</p>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </form>
                      <button class="btn btn-primary pull-right" type="button" name= "submitProjectDescription" id="submitProjectDescription" onClick="submitProjectDescription()" style="margin-bottom:25px;"> Next</button>
                    </div>
                    <div id="submitSuccess" class="alert alert-success" style="display:none; text-align:center; margin-top:40px; height:40px; text-align: center;">
                      <h5><strong>Success!</strong> Your initiative has been successfully added!</h5>
                    </div>
                    <div id="projectCreatorForm" style="margin:25px 0 0 25px; width:1000px; height:auto; display:none">
                      <br>
                      <h5 class="category">Initiative Creator</h5>
                      <br>
                      <form id="initiativeCreator" method="POST" style="margin-left:20px">
                        <table>
                          <tr>
                            <td>
                              <label> Full Name (main contact)</label>
                              <input class="form-control" type="text" name="creator1Name" aria-required="true" id="creator1Name" value="<?php echo ($_SESSION["name"]);?>" placeholder="required..." required>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label>Email<small id="emailWarning" class="text-muted" style="color: #B3B3B3; margin-left: 5px"></small> </label>
                              <input class="form-control" type="email" name="creator1Email" id="creator1Email" value="<?php echo ($_SESSION["email"]);?>" placeholder="(Required) Please use the email associated with sign-up." required>
                            </td>
                          </tr>
                          <tr>
                            <td>

                            <label style="margin-top:10px"> Relation to UWC and Year (Required)</label>
                            <!-- <input style="width:100%" class="form-control" type="text" name="UWC" id="UWC" placeholder="" value="<?php //echo $uwc;  ?>"> -->
                            <select id="selectUWC" name="selectUWC" class="form-control">
                              <option value="" selected="selected">Select UWC Affiliation </option>
                              <optgroup label="------------------------------">
                                <option value="Online UWC">Online UWC</option>
                              </optgroup>
                               <optgroup label="------------------------------">
                                <option value="Waterford Kamhlaba UWC ">Waterford Kamhlaba UWC </option>
                                <option value="Li Po Chun UWC">Li Po Chun UWC</option>
                                <option value="UWC Mahindra College">UWC Mahindra College</option>
                                <option value="UWC South East Asia">UWC South East Asia</option>
                                <option value="UWC Adriatic">UWC Adriatic</option>
                                <option value="UWC Atlantic College">UWC Atlantic College</option>
                                <option value="UWC Dilijan">UWC Dilijan</option>
                                <option value="UWC Maastricht">UWC Maastricht</option>
                                <option value="UWC in Mostar">UWC in Mostar</option>
                                <option value="UWC Red Cross Nordic ">UWC Red Cross Nordic </option>
                                <option value="UWC Robert Bosch College">UWC Robert Bosch College</option>
                                <option value="Pearson College UWC">Pearson College UWC</option>
                                <option value="UWC-USA">UWC-USA</option>
                                <option value="UWC Costa Rica">UWC Costa Rica</option>
                              </optgroup>
                              <optgroup label="------------------------------">
                                <option value="Short Programs">Short Programs</option>
                              </optgroup>
                              <optgroup label="------------------------------">
                                <option value="UWC Associate">UWC Associate</option>
                              </optgroup>
                              <optgroup label="------------------------------">
                                <option value="UWC Faculty">UWC Faculty</option>
                              </optgroup>
                              <optgroup label="------------------------------">
                                <option value="UWC Staff">UWC Staff</option>
                              </optgroup>
                            </select>
                            <select id="selectYear" name="selectYear" style="width:75px;">
                              <option value="" selected="selected">Select Year</option>
                              <option value="2014">2014</option>
                              <option value="2013">2013</option>
                              <option value="2012">2012</option>
                              <option value="2011">2011</option>
                              <option value="2010">2010</option>
                              <option value="2009">2009</option>
                              <option value="2008">2008</option>
                              <option value="2007">2007</option>
                              <option value="2006">2006</option>
                              <option value="2005">2005</option>
                              <option value="2004">2004</option>
                              <option value="2003">2003</option>
                              <option value="2002">2002</option>
                              <option value="2001">2001</option>
                              <option value="2000">2000</option>
                              <option value="1999">1999</option>
                              <option value="1998">1998</option>
                              <option value="1997">1997</option>
                              <option value="1996">1996</option>
                              <option value="1995">1995</option>
                              <option value="1994">1994</option>
                              <option value="1993">1993</option>
                              <option value="1992">1992</option>
                              <option value="1991">1991</option>
                              <option value="1990">1990</option>
                              <option value="1989">1989</option>
                              <option value="1988">1988</option>
                              <option value="1987">1987</option>
                              <option value="1986">1986</option>
                              <option value="1985">1985</option>
                              <option value="1984">1984</option>
                              <option value="1983">1983</option>
                              <option value="1982">1982</option>
                              <option value="1981">1981</option>
                              <option value="1980">1980</option>
                              <option value="1979">1979</option>
                              <option value="1978">1978</option>
                              <option value="1977">1977</option>
                              <option value="1976">1976</option>
                              <option value="1975">1975</option>
                              <option value="1974">1974</option>
                              <option value="1973">1973</option>
                              <option value="1972">1972</option>
                              <option value="1971">1971</option>
                              <option value="1970">1970</option>
                              <option value="1969">1969</option>
                              <option value="1968">1968</option>
                              <option value="1967">1967</option>
                              <option value="1966">1966</option>
                              <option value="1965">1965</option>
                              <option value="1964">1964</option>
                              <option value="1963">1963</option>
                              <option value="1962">1962</option>
                            </select>
                          </td>
                        </tr>                
                        </table>                        
                        <table id="addExtraCreators" style="margin-top:20px;"> </table>
                          <div id="teamquestion" style="display:none; margin-top:50px; margin-left:30px; ">
                            <!-- Select Basic -->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="selectTeam">Total members</label>
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
                            <div >
                              <label class="col-md-4 control-label" for="submitQ"></label>
                              <div class="col-md-4">
                                <button id="submitQ" name="submitQ" onClick ="addExtraCreators()" class="btn btn-primary">Submit</button>
                              </div>
                            </div>
                          </div>
                          <div>
                            <button class="btn btn-default pull-left" type="button" id="submitAddExtraCreators" onClick="addTeamMembers()" style="margin:20px auto;"> Add Team members</button>                  
                            <button class="btn btn-primary pull-right" type="button" onClick="goToProjectDescription()" style="margin:20px 15px 35px 0"> Previous</button>                            
                          </div>
                          <div class="input-group" id="publishRadio" name="publishRadio" style="margin-bottom:5px; clear:both;"> 
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
                      <button class="btn btn-success tm_style_3" type="button" name= "submitInitiative" id="submitInitiative" onClick="submitInitiative('submit',999)" style="margin: 25px 0 0 24%; font-size:20px; font-weight:bold;"> Submit Initiative </button>
                    </div>
                    <div id="fillAllRequiredFieldsAlert" class="alert alert-warning" style="display:none; text-align:center; margin-top:40px;">
                      <strong>Warning!</strong> Make sure all of the required fields are filled!
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
    <script type="text/javascript" src = "uwcnext.js"></script> 
    <script type="text/javascript" src = "script.js"></script> 
    <script type="text/javascript"> 
      window.uid = <?php echo json_encode($_SESSION['uid']);?>;
      window.userName = <?php echo json_encode($_SESSION['name']);?>;
      window.userEmail = <?php echo json_encode($_SESSION["email"]);?>;
      window.myUWC = <?php echo (json_encode($uwc));?>;
      window.myUWCYear = <?php echo (json_encode($uwcYear));?>;
      window.myCountry = <?php echo json_encode($country);?>;    
      window.mySkills = <?php echo json_encode($skills);?>;    
      window.myBio = <?php echo json_encode($bio);?>;    



      $( document ).ready(function(){
        // $("#createProjectButton").click(function(){         
        //   if (uid=="" || uid==null){
        //     $("#loginModal").modal("show");
        //   } else {
        //    	$("tab4").show();
        //   }        
        // });

        if (uid !="" || uid !=null){          
          if (myUWC =="" || mySkills =="" || myBio =="" ){
            $.notifyBar({
              html: '<img class="pull-left" src="/ocf_logo.png" style="width:85px; height:40px; margin:0 -150px 0 90px;" >  Please <a href="editProfile.php">UPDATE</a> your profile.',
              delay: 2000,  
              close: true, 
              closeOnClick: false
            });
          }
        } else {
          $("#selectUWC").val(myUWC);
          $("#selectYear").val(myUWCYear);
        }
      });
    </script>
  </body>
</html>