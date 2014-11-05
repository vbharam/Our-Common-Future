<div id="loginModal" class="modal fade" data-backdrop:>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:black">
        <button class="close" data-dismiss="modal"> &times; </button>
        <a href="index.php"><img alt="" src="/ocf_logo.png" style="width:85px; height:40px;"></a>
      </div> <!-- end modal-header -->
      <div class="modal-body">
        <div class="row-fluid" style="padding:15px">
          <div class="span12">
<!--
            <div class="span5" style="margin-top:10px; text-align:center">
              <div style="padding-top:5px">
                <a href="social_login/googlePlus/oauth2callback.php" class="btn btn-google" type="submit">
                  <i class="icon-googleplus"></i> Connect with Google
                </a>
              </div>
              <div style="padding-top:5px">
                <a href="social_login/linkedin/linkedin_login.php" class="btn btn-linkedin" type="submit">
                  <i class="icon-linkedin"></i> Connect with Linkedin
                </a>
              </div>
              <div style="padding-top:5px">
                <a href="social_login/facebook/facebook_login.php" class="btn btn-facebook" type="submit">
                  <i class="icon-facebook"></i> Connect with Facebook
                </a>
              </div>
            </div>   
-->
<!--              end span6 -->
            <div class="span6">
              <form id="loginForm" class="form-horizontal" role="form" onSubmit="login(this)">
                <div class="form-group">
                  <ul style="margin-left:15px">
                    <li style="list-style-type:none; margin-bottom:10px">
                      <div>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email" style="margin-top:10px" autofocus>
                      </div>
                    </li>
                    <li style="list-style-type:none">
                      <div>
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                      </div>
                    </li>
                  </ul>
                </div> <!-- end form-group
                <div class="alert alert-danger" style="display:none" id="incorrect" style="padding:8px 5px 8px 12px; width:70%; margin:0 0 0 14px">Incorrect Email or Password!</div> <!-- end alert-danger -->
                <div id="error_msg"></div>
                <ul style="list-style-type:none" id="bigCallout">
                  <li>
                    <a href="#" onClick="window.open('forgot.php', '_blank')" class="btn btn-link" id="alertMe">Forgot your password? Click here!</a>
                  </li>
                </ul> <!-- end bigCallout -->
              </form> <!-- end form-horizontal -->
            </div> <!-- end span6 -->
          </div> <!-- end span12 -->
        </div> <!-- end row-fluid -->
      </div> <!-- end modal-body -->
      <div class="modal-footer" style="margin-top:0">
        <div class="pull-left">
        <button class="btn btn-primary" data-toggle="modal" data-dismiss="modal" data-target="#signUpModal" type="button">Sign Up</button>
        </div>
        <div class="pull-right">
        <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
        <button id="loginButton" class="btn btn-primary" type="submit" onclick="$('#loginForm').submit()"> LOG IN </button>
        </div>
      </div> <!-- end modal-footer -->
    </div> <!-- end modal-content -->
  </div> <!-- end modal-dialog -->
</div> <!-- end loginModal -->


<div class="modal fade" id="signUpModal" style="display:none" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:black;">
        <button class="close" data-dismiss="modal"> &times; </button>
        <a href="index.php"><img alt="" src="/ocf_logo.png" style="width:85px; height:40px;"></a>
      </div> <!-- end modal-header -->
      <div class="modal-body" style="overflow:hidden">
        <div class="span6">
<!--
          <div class="span2" style="margin-top:10px;">
            <div style="padding-top:5px">
              <a href="social_login/googlePlus/oauth2callback.php" class="btn btn-google" type="submit">
                <i class="icon-googleplus"></i> Sign Up with Google
              </a>
            </div>
            <div style="padding-top:5px">
              <a href="social_login/linkedin/linkedin_login.php" class="btn btn-linkedin" type="submit">
                <i class="icon-linkedin"></i> Sign Up with Linkedin
              </a>
            </div>
            <div style="padding-top:5px">
              <a href="social_login/facebook/facebook_login.php" class="btn btn-facebook" type="submit">
                <i class="icon-facebook"></i> Sign Up with Facebook
              </a>
            </div>
          </div>  
-->
            <!-- end span6 -->
          <div class="span3 form-group" style="text-align:center">
            <form id="signUpForm" style="margin:20px 0 0 0">
            <ul id="signUpForm">
              <li style="list-style-type:none; margin-bottom:1px">
                <div>
                  <input class="form-control" id="signup_username" placeholder="Name" type="text" autofocus>
                  <span class="name_error" style="display:block"></span>
                </div>
              </li>
              <li style="list-style-type:none; margin-bottom:1px">
                <div>
                  <input class="form-control" id="signup_email" placeholder="Email" type="email">
                  <span class="email_error" style="display:block"></span>
                </div>
              </li>
              <li style="list-style-type:none; margin-bottom:1px">
                <div>
                  <input type="password" class="form-control" id="signup_password" placeholder="Password">
                  <span class="pass_error" style="display:block"></span>
                </div>
              </li>
              <li style="list-style-type:none">
                <div>
                  <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" onkeyup="checkPass()">
                  <span id="confirmMessage" class="confirmMessage" style="display:block"></span>
                </div>
              </li>
            </ul>          
          </form> <!-- end signUpForm -->
        </div> <!-- end form-group -->

        </div>
          
        <div id="thirdPartySignUp"></div>
      </div> <!-- end modal-body -->
      <div class="modal-footer" style="margin-top:0">
        <div class="pull-left">
          <button class="btn btn-primary" data-toggle="modal" data-dismiss="modal" data-target="#loginModal" type="button">Log In</button>
        </div>
        <div class="pull-right">
          <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
          <button id="signUpButton" class="btn btn-primary" type="button" onClick="signup(this)"> Sign Up </button>
        </div>
      </div> <!-- end modal-footer -->
    </div> <!-- end modal-content -->
  </div> <!-- end modal-dialog -->
</div> <!-- end signUpModal -->


<div class="modal fade" id="videoModal" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div id = "videoContent"><h5 style="text-align:center; padding-top: 50px; padding-bottom: 50px; ">Sorry! Can not load the Video. :( </h5></div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" onclick="homeReturn()" type="button">Close</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript"> 
	window.uid = <?php echo json_encode($_SESSION['uid']);?>;
	window.userEmail = <?php echo json_encode($_SESSION["email"]);?>;

  function checkPass() {
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('signup_password');
    var pass2 = document.getElementById('confirmPassword');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(signup_password.value == confirmPassword.value) {
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match!"
    } else {
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        confirmPassword.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!"
    }
  }

  $("input").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $("form").submit();
    }
  });
</script>
