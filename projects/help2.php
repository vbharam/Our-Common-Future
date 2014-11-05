<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Uwcnext</title>
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
    <script type="text/javascript">if($(window).width()>1024){document.write("<"+"script src='js/jquery.preloader.js'></"+"script>");}  </script>

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
    <header>
      <div class="container clearfix">
        <div class="row">
          <div class="span12">
            <div class="navbar navbar_">
              <div class="container">
                <h1 class="brand brand_"><a href="index.php"><img alt="" src="img/UWCnext-1420x280.gif" style="width:200px; height:40px;" > </a></h1>
                <a class="btn btn-navbar btn-navbar_" data-toggle="collapse" data-target=".nav-collapse_">Menu <span class="icon-bar"></span> </a>
                <div class="nav-collapse nav-collapse_  collapse">
                  <ul class="nav sf-menu">                  
                    <li class="sub-menu"><a href="#">Initiatives</a>
                      <ul>
                        <li><a href="#tab2" data-toggle="tab"  onclick='sortInitiative("current", 1);'><i class="icon-new-window" style="margin-right:5px;"></i>Current</a></li>
                        <li><a href="#tab3" data-toggle="tab" onclick='sortInitiative("finished", 1);'><i class="icon-check" style="margin-right:5px;"></i>Finished</a></li>
                        <li id="createProjectButton"><a href="#tab4" data-toggle="tab"><i class="icon-folder-open" style="margin-right:5px;"></i>Create New</a></li>
                      </ul>
                    </li>
                    <li class="sub-menu" style=" <?php if($_SESSION["uid"]==""){?>display:none;<?php }else{?>display:inline;<?php }?>"><a href="#tab6" data-toggle="tab" onclick='myProjects(1, "current", "currentProjectFeed", "currentProject")'><i class="glyphicon glyphicon-info-sign"></i> My Initiatives</a></li>                               
                    <?php if($_SESSION["uid"]==""){?>                  
                    <li class="sub-menu"><a href="">Members</a>
                      <ul>
                        <li><a href="#" data-toggle="modal" data-target="#loginModal"><i class="icon-user" style="margin-right:5px;"></i>Login</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#signUpModal"><i class="icon-plus-sign" style="margin-right:5px;"></i>Signup</a></li>
                      </ul>
                    </li>
                    <?php } else {?>
                    <li ><a href="#" ><i class="icon-user"></i> <span style="color:#00CDCD; padding-top:10px; font-size:11px;"><?php echo ($_SESSION["name"]);?></span><strong class="caret"></strong></a>
                      <ul>
                        <li>
                          <a href="editProfile.php"><i class="icon-refresh" style="margin-right:5px;"></i> Edit Profile </a>
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

    <div class="bg-content"> <!-- content -->      
      <div id="content"><div class="ic"></div>
        <div class="row-1">
          <div class="panel-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    Collapsible Group Item #1
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                    Collapsible Group Item #2
                  </a>
                </h4>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                    Collapsible Group Item #3
                  </a>
                </h4>
              </div>
              <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="container">
          <div class="row">
            <article class="span8">
              <h4>Shortly about us</h4>
              <div class="wrapper">
              <figure class="img-indent"><img src="img/15.jpg" alt="" /></figure>
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
  </body>
</html>