//returns to main/home page...

function login(event) {
  var $email = $( "#inputEmail" ).val();
  var $password = $( "#inputPassword" ).val();
 
 	$url='doaction.php?email='+$email+'&password='+$password+'&doaction=login';
	$.get($url,function(data){
				
		if(data==0)
		{
			$(".alert-danger").show();
		}
		else if(data==1)
		{
			window.location.reload(true);
		}
		
	});
	event.preventDefault();
}


function signup(event) {
 	var $name = $( "#signup_username" ).val();
  var $email = $( "#signup_email" ).val();
  var $password = $( "#signup_password" ).val();
	
	if($name=="")
	{
			$('.name_error').html('*Enter your name!');
	}
	else
	{
			$('.name_error').html('');
	}
	
	if($email=="")
	{
			$('.email_error').html('<b style="font-color:red">*Enter your email!</b>');
	}
	else
	{
			$('.email_error').html('');
	}
	
	if($password=="")
	{
			$('.pass_error').html('!Enter your password*');
	}
	else
	{
			$('.pass_error').html('');
	}
 
 
 	if($name!="" && $password!="" && $email!="")
 		{
			$url='doaction.php?email='+$email+'&doaction=signup_chk';
			$.get($url,function(data){
				if(data==0)
				{
					$url='doaction.php?email='+$email+'&name='+$name+'&password='+$password+'&doaction=signup';
					$.get($url,function(response){						
						$('#signUpForm')[0].reset();
						$('#userSuccess').show();	
						sleep(3000);
						$url='doaction.php?email='+$email+'&password='+$password+'&doaction=login';
						$.get($url,function(data){									
							if(data==1)
							{
								window.location.reload(true);
							}							
						});
					});
				}
				else if (data==1)
				{
					$("#alredyExist").show();
				}
		});
		event.preventDefault();
	}	
}

function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}