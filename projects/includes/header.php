<div class="container">
	<div class="row">
    <div class="span12">
      <div class="navbar navbar_">
        <div class="container">
          <h1 class="brand brand_"><a href="index.php"><img alt="" src="../ocf_logo.png" style="width:85px; height:40px;" > </a></h1>
          <a class="btn btn-navbar btn-navbar_" data-toggle="collapse" data-target=".nav-collapse_">Menu <span class="icon-bar"></span> </a>
          <div class="nav-collapse nav-collapse_  collapse">
            <ul class="nav sf-menu">                             
              <?php if($_SESSION["uid"]==""){?>                  
              <li class="sub-menu">
                <a href="../login_page.php" ><i class="icon-user" style="margin-right:5px;"></i>Login</a>      
              </li>
              <?php } else {?>
              <li ><a href="#" ><i class="icon-user"></i> <span style="color:#DB420E; padding-top:10px; font-size:11px; font-weight:bold"><?php echo ($_SESSION["name"]);?></span></a>
                <ul>
									<li>
										<a href = "editProfile.php"><i class="icon-refresh" style="margin-right:5px;"></i> Edit Profile </a>
									</li>									 
									<!-- <li>
										<a href="#"><i class="icon-briefcase" style="margin-right:5px;"></i> Billing </a>
									</li> -->
									<li class="divider"></li>
									<li>
										<a href="logout.php"><i class="icon-off" style="margin-right:5px;"></i> Logout </a>
									</li>
                </ul>
              </li>
							<?php } ?>	   
                                         
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
