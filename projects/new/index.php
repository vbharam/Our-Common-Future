<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Uwcnext</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="fonts/ptsans/stylesheet.css" type="text/css" charset="utf-8" />
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/theme.css" rel="stylesheet">
    <link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.css" /> 
    


    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

   <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img src="images/logo.png"></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="#about"><i class="fa fa-folder-open"></i> Create Project</a></li>
            <li><a href="#contact"><i class="fa fa-thumbs-o-up"></i> Help a Project</a></li>
            <li><a href="#contact"><i class="fa fa-star"></i> Get Inspired</a></li>
            <?php /*?><li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li><?php */?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><button data-toggle="modal" href="#loginModal" style="margin:7px 10px 0 0;" class="btn btn-primary pull-left">
											<span class="glyphicon glyphicon-user"></span>
											Login
										</button></li>
            <li><button data-toggle="modal" href="#signUpModal" style="margin:7px 10px 0 0;" class="btn btn-default pull-right">
											<span class="glyphicon glyphicon-plus-sign"></span> 
											Sign Up 
										</button></li>
            <li style="display:inline" class="nav navbar-nav pull-right">
								<form class="navbar-form pull-right" id="searchForm">
									<input type="text" placeholder="Search this site..." id="searchInput" class="form-control">
									<button onclick="searchSubmit(event)" class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
								</form>	<!-- end navbar-form -->
							</li>
          </ul>
          
        </div><!--/.nav-collapse -->
      </div>
    </div>

	<div class="container">
    
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img data-src="holder.js/900x500/auto/#777:#7a7a7a/text:First slide" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Example headline.</h1>
              <p>Note: If you're viewing this page via a <code>file://</code> URL, the "next" and "previous" Glyphicon buttons on the left and right might not load/display properly due to web browser security rules.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img data-src="holder.js/900x500/auto/#666:#6a6a6a/text:Second slide" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Another example headline.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img data-src="holder.js/900x500/auto/#555:#5a5a5a/text:Third slide" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>One more for good measure.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>
    
    </div>

	<div id="footer">
      <div class="container">
				<div class="row">
					<div class="col-sm-3">
						Copyright &copy; <?php echo date('Y');?> CodeCOOP
					</div>
					
					
					
					
				</div>
			</div>
    </div>
    
  </body>
</html>
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/holder.js"></script>