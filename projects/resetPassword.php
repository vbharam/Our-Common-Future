<?php 

$new_password=$_POST['new_password'];
$confirm_password = $_POST['confirm_password'];
$email = $_POST['email'];
$hash = md5($password);
if($_POST['submit']=='Save changes') {
    include 'includes/Bluehost_connect.php'; 

    if ($new_password !="" && $confirm_password !="" && $email != ""){
        if ($new_password == $confirm_password ){       
            $fetchId = "SELECT `EMAIL` FROM  `USER_INFO` WHERE `EMAIL`= '$passwordResetEmail' ORDER BY `ID` DESC LIMIT 1";
            $fetchIdresult = mysql_query($fetchId,$connection);
            if (!$fetchIdresult) { 
                $message  = 'Invalid query: ' . mysql_error() . "\n";
                $message .= 'Whole query: ' . $fetchId;
                die($message);
        }
        if(mysql_num_rows( $fetchIdresult)){ 
            $addCodeQuery = "UPDATE `USER_INFO` SET `HASH_PASSWORD` = '{$hash}' AND `PASSWORD`='{$new_password}' WHERE `EMAIL`= '$passwordResetEmail' ";
            $addCodeResult = mysql_query($addCodeQuery,$connection);
                if (!$addCodeResult) { 
                $message  = 'Invalid query: ' . mysql_error() . "\n";
                $message .= 'Whole query: ' . $addCodeQuery;
                die($message);
              }
                $message="You activation link is: http://codecoop.net/vishal/reserPassword.php";
                mail($passwordResetEmail, "Link to reset the password of UWCNEXT", $message);
                echo "Email sent";                
            
        } else {
            echo ("Incorrect email, password combination");
        } 
    } else {
        echo("Password doesn't match !");
    }
    }
}
    mysql_free_result($fetchIdresult);
?>

<?php   mysql_close($connection); ?>





   
<div class="modal" id="password_modal">
    <div class="modal-header">
        <h3>Change Password <span class="extra-title muted"></span></h3>
    </div>
    <div class="modal-body form-horizontal">
        <div class="control-group">
            <label for="email" class="control-label">Email</label>
            <div class="controls">
                <input type="email" name="eamil">
            </div>
        </div>
        <div class="control-group">
            <label for="new_password" class="control-label">New Password</label>
            <div class="controls">
                <input type="password" name="new_password">
            </div>
        </div>
        <div class="control-group">
            <label for="confirm_password" class="control-label">Confirm Password</label>
            <div class="controls">
                <input type="password" name="confirm_password">
            </div>
        </div>      
    </div>
    <div class="modal-footer">
        <button href="#" class="close" data-dismiss="modal" aria-hidden="true">Close</button>
        <input type="submit" href="#" class="btn btn-primary" id="password_modal_save" value="Save changes">
    </div>
</div>
        
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
        



