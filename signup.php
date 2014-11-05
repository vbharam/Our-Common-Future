<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>Our Common Future</title>
<!-- Style -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/landing_style.css" rel="stylesheet">

<!-- Responsive -->
<link href="css/responsive.css" rel="stylesheet">
<!-- Choose Layout -->
<link href="css/layout-wide.css" rel="stylesheet">
<!-- Choose Skin -->
<link href="css/skin-green.css" rel="stylesheet">
<link rel="shortcut icon" href="favicon.ico">
<!-- Demo -->
<link rel="stylesheet" id="main-color" href="css/skin-green.css" media="screen"/>
<link href='//fonts.googleapis.com/css?family=Asap:400,500,600,700,400italic,700italic' rel='stylesheet' type='text/css'>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css" rel="stylesheet">

<!-- Favicon -->
<!-- <link rel="shortcut icon" href="img/favicon.ico"> -->
<!-- IE -->
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>	   
    <![endif]-->
<!--[if lte IE 8]>
	<link href="css/ie8.css" rel="stylesheet">
	 <![endif]-->
</head>
<style type="text/css">
body { padding-top:30px; }
.form-control { margin-bottom: 10px; }
</style>
<body>
<div class="container">
    <div class="row">
    	<div class="col-md-2"></div>
    	<div class="col-md-8">
    	    <div class="col-xs-12 col-sm-12 col-md-4 well well-sm">
            <legend><a href="http://www.jquery2dotnet.com"><i class="glyphicon glyphicon-globe"></i></a> Sign up!</legend>
            <form action="#" method="post" class="form" role="form">
            <div class="row">
                <div class="col-xs-6 col-md-6">
                    <input class="form-control" name="firstname" placeholder="First Name" type="text"
                        required autofocus />
                </div>
                <div class="col-xs-6 col-md-6">
                    <input class="form-control" name="lastname" placeholder="Last Name" type="text" required />
                </div>
            </div>
            <input class="form-control" name="youremail" placeholder="Your Email" type="email" />
            <input class="form-control" name="reenteremail" placeholder="Re-enter Email" type="email" />
            <input class="form-control" name="password" placeholder="New Password" type="password" />
            <label for="">
                Birth Date</label>
            <div class="row">
                <div class="col-xs-4 col-md-4">
                    <select class="form-control">
                        <option value="Month">Month</option>
                    </select>
                </div>
                <div class="col-xs-4 col-md-4">
                    <select class="form-control">
                        <option value="Day">Day</option>
                    </select>
                </div>
                <div class="col-xs-4 col-md-4">
                    <select class="form-control">
                        <option value="Year">Year</option>
                    </select>
                </div>
            </div>
            <label class="radio-inline">
                <input type="radio" name="sex" id="inlineCheckbox1" value="male" />
                Male
            </label>
            <label class="radio-inline">
                <input type="radio" name="sex" id="inlineCheckbox2" value="female" />
                Female
            </label>
            <br />
            <br />
            <button class="btn btn-lg btn-primary btn-block" type="submit">
                Sign up</button>
            </form>
        </div>
    </div>
    <div class="col-md-8"></div>
</div>
</div>
</body>
