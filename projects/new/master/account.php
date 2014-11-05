<?php
ob_start();
session_start();
$headermess='Admin Account Setting';
include("../configuration/connect.php");

if($_SESSION['aid']=='')
	{
		header("location:index.php");
	}
if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Account Setting inserted Successfully !!';
		$class='successmsg';
	break;
	
	case 'inf':
		$msg='Account Setting not inserted Successfully !!';
		$class='errormsg';
	break;
	case 'ups':
		$msg='Account Setting updated Successfully !!';
		$class='successmsg';
	break;
	
	case 'upf':
		$msg='Account Setting not updated Successfully !!';
		$class='errormsg';
	break;
	case 'ais':
		$msg='Account Setting information updated Successfully !!';
		$class='successmsg';
	break;
	
	case 'aif':
		$msg='Account Setting information not updated Successfully !!';
		$class='errormsg';
	break;
	
	case 'default' :
		$msg='';
		break;
	
	}
	
	
	
}
if(isset($_POST['update_admin']))
{
	$pass=$_POST['pass'];
	$cpass=$_POST['cpass'];
	$email=$_POST['email1'];
	$username=$_POST['username'];	
	$phone=$_POST['phone'];	
	
	$sql="update admin set  `password`='$pass',`username`='$username' ,`email`='$email' where id='$_SESSION[aid]'";
		if(@mysql_query($sql))
		{
			header("location:account.php?msg=ais");
		}
		else
		{
			header("location:account.php?msg=aif");
		}
	
}

if(isset($_POST["social_save"]))
{
$sql="update admin set  `facebook`='$_POST[flink]',`twitter`='$_POST[tlink]',`blogger`='$_POST[blink]',google_plus='$_POST[google_plus]' where id='$_SESSION[aid]'";
		if(@mysql_query($sql))
		{
			header("location:account.php?msg=ais");
		}
		else
		{
			header("location:account.php?msg=aif");
		}
}

if(isset($_POST["google_anayls"]))
{
	$sql="update admin set  google_analytics='$_POST[google_analytics]' where id='$_SESSION[aid]'";
		if(@mysql_query($sql))
		{
			header("location:account.php?msg=ais");
		}
		else
		{
			header("location:account.php?msg=aif");
		}
}

?>
<!DOCTYPE html>
<html lang="en" class="no-js">


<!-- Mirrored from demo.thedevelovers.com/dashboard/kingboard/ by HTTrack Website Copier/3.x [XR&CO'2013], Tue, 04 Mar 2014 10:55:12 GMT -->
<head>
    <title><?php echo $headermess;?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="description" content="Kingboard - Bootstrap Admin Dashboard Theme">
    <meta name="author" content="The Develovers">

    <!-- CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/main.min.css" rel="stylesheet" type="text/css">

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/kingboard-favicon144x144.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/kingboard-favicon114x114.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/kingboard-favicon72x72.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="assets/ico/kingboard-favicon57x57.png">
    <link rel="shortcut icon" href="assets/ico/favicon.png">
<link rel="stylesheet" href="assets/fonts/ptsans/stylesheet.css" type="text/css" charset="utf-8" />
</head>

<body class="dashboard">
    <!-- WRAPPER -->
    <div class="wrapper">

        

        <?php include "header.php";?>


        <!-- BOTTOM: LEFT NAV AND RIGHT MAIN CONTENT -->
        <div class="bottom">
            <div class="container">
                <div class="row">
                    <?php include "sidebar-left.php";?>

                    <!-- content-wrapper -->
                    <div class="col-md-10 content-wrapper">
                        <div class="row">
                            <div class="col-md-4">
                                <ul class="breadcrumb">
                                    <li><i class="fa fa-home"></i> Dashboard
                                    </li>
                                   
                                </ul>
                            </div>
                            <div class="col-md-8">
                                <?php /*?><div class="top-content">

                                    <ul class="list-inline mini-stat">
                                        <li>
                                            <h5>LIKES
                                                <span class="stat-value stat-color-orange"><i class="fa fa-plus-circle"></i> 81,450</span>
                                            </h5>
                                            <span id="mini-bar-chart1" class="mini-bar-chart"></span>
                                        </li>
                                        <li>
                                            <h5>SUBSCRIBERS
                                                <span class="stat-value stat-color-blue"><i class="fa fa-plus-circle"></i> 150,743</span>
                                            </h5>
                                            <span id="mini-bar-chart2" class="mini-bar-chart"></span>
                                        </li>
                                        <li>
                                            <h5>CUSTOMERS
                                                <span class="stat-value stat-color-seagreen"><i class="fa fa-plus-circle"></i> 43,748</span>
                                            </h5>
                                            <span id="mini-bar-chart3" class="mini-bar-chart"></span>
                                        </li>
                                    </ul>
                                </div><?php */?>
                            </div>
                        </div>


                        <!-- main -->
                        <div class="content">
                           

                            <div class="main-content">
                               <?php /*?> <div class="row">
                                    <div class="col-md-9">
                                        <!-- WIDGET NO HEADER -->
                                        <div class="widget widget-hide-header">
                                            <div class="widget-header hide">
                                                <h3>Summary Info</h3>
                                            </div>
                                            <div class="widget-content">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="easy-pie-chart green" data-percent="70">
                                                            <span class="percent">70</span>
                                                        </div>
                                                        <p class="text-center">Task Completion</p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="easy-pie-chart red" data-percent="22">
                                                            <span class="percent">22</span>
                                                        </div>
                                                        <p class="text-center">Overall Project Completion</p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="easy-pie-chart yellow" data-percent="65">
                                                            <span class="percent">65</span>
                                                        </div>
                                                        <p class="text-center">Disk Space Used</p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="easy-pie-chart red" data-percent="87">
                                                            <span class="percent">87</span>
                                                        </div>
                                                        <p class="text-center">Bandwidth Used</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- WIDGET NO HEADER -->
                                    </div>
                                    <div class="col-md-3">
                                        <!-- WIDGET REMINDER -->
                                        <div class="widget widget-hide-header widget-reminder">
                                            <div class="widget-header hide">
                                                <h3>Today's Reminder</h3>
                                            </div>
                                            <div class="widget-content">
                                                <div class="today-reminder">
                                                    <h4 class="reminder-title">Project Meeting</h4>
                                                    <p class="reminder-time"><i class="fa fa-clock-o"></i> 9:00 AM</p>
                                                    <p class="reminder-place">War Room</p>
                                                    <em class="reminder-notes">Bring weekly report summary</em>
                                                    <i class="fa fa-bell"></i>
                                                    <div class="btn-group btn-group-xs">
                                                        <button type="button" class="btn btn-warning"><i class="fa fa-cloud-upload"></i> Sync</button>
                                                        <div class="btn-group  btn-group-xs">
                                                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Remind Me
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu pull-right">
                                                                <li><a href="#">15 minutes later</a>
                                                                </li>
                                                                <li><a href="#">30 minutes later</a>
                                                                </li>
                                                                <li><a href="#">1 hour later</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END WIDGET REMINDER -->
                                    </div>
                                </div>

                                <!-- WIDGET MAIN CHART WITH TABBED CONTENT -->
                                <div class="widget">
                                    <div class="widget-header">
                                        <h3><i class="fa fa-bar-chart-o"></i> Sales Stat</h3>
                                        <em>- Visits, Sales and Traffic Source</em>
                                        <button type="button" class="btn btn-link btn-help"><i class="fa fa-question-circle"></i>
                                        </button>
                                        <div class="btn-group widget-header-toolbar">
                                            <a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
                                            <a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
                                            <a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
                                        </div>
                                    </div>
                                    <div class="widget-content">
                                        <!-- chart tab nav -->
                                        <div class="chart-nav">
                                            <strong>Select period:</strong>
                                            <ul id="sales-stat-tab">
                                                <li class="active"><a href="#week">Weekly</a>
                                                </li>
                                                <li><a href="#month">Monthly</a>
                                                </li>
                                                <li><a href="#year">Annually</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- end chart tab nav -->

                                        <!-- chart placeholder-->
                                        <div class="chart-content">
                                            <div class="demo-flot-chart sales-chart"></div>
                                        </div>
                                        <!-- end chart placeholder-->

                                        <hr class="separator">

                                        <!-- secondary stat -->
                                        <div class="secondary-stat">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div id="secondary-stat-item1" class="secondary-stat-item big-number-stat clearfix">
                                                        <div class="data">
                                                            <span class="col-left big-number">260</span>
                                                            <span class="col-right">
                                                                <em>New Orders</em>
                                                                <em>3% <i class="fa fa-caret-down"></i>
                                                                </em>
                                                            </span>
                                                        </div>
                                                        <div id="spark-stat1" class="inlinesparkline">Loading...</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div id="secondary-stat-item2" class="secondary-stat-item big-number-stat clearfix">
                                                        <p class="data">
                                                            <span class="col-left big-number">$23,000</span>
                                                            <span class="col-right">
                                                                <em>Revenue</em>
                                                                <em>5% <i class="fa fa-caret-up"></i>
                                                                </em>
                                                            </span>
                                                        </p>
                                                        <div id="spark-stat2" class="inlinesparkline">Loading...</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div id="secondary-stat-item3" class="secondary-stat-item big-number-stat clearfix">
                                                        <p class="data">
                                                            <span class="col-left big-number">$47,000</span>
                                                            <span class="col-right">
                                                                <em>Total Sales</em>
                                                                <em>7% <i class="fa fa-caret-up"></i>
                                                                </em>
                                                            </span>
                                                        </p>
                                                        <div id="spark-stat3" class="inlinesparkline">Loading...</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end secondary stat -->
                                    </div>
                                </div>
                                <!-- END WIDGET MAIN CHART WITH TABBED CONTENT -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- WIDGET TABLE -->
                                        <div class="widget widget-table">
                                            <div class="widget-header">
                                                <h3><i class="fa fa-desktop"></i> Browser &amp; OS</h3>
                                                <div class="btn-group widget-header-toolbar">
                                                    <a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
                                                    <a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
                                                    <a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
                                                </div>
                                                <div class="btn-group widget-header-toolbar">
                                                    <div class="control-inline toolbar-item-group">
                                                        <span class="control-title">New Visits:</span>
                                                        <div class="label label-success"><i class="fa fa-caret-up"></i> 3.5%</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content">
                                                <table id="visit-stat-table" class="table table-sorting table-striped table-hover datatable" cellpadding="0" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Browser</th>
                                                            <th>Operating System</th>
                                                            <th>Visits</th>
                                                            <th>New Visits</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Chrome</td>
                                                            <td>Macintosh</td>
                                                            <td>360</td>
                                                            <td>82.78%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Chrome</td>
                                                            <td>Windows</td>
                                                            <td>582</td>
                                                            <td>87.24%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Chrome</td>
                                                            <td>Linux</td>
                                                            <td>172</td>
                                                            <td>45.21%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Chrome</td>
                                                            <td>iOS</td>
                                                            <td>86</td>
                                                            <td>35.23%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Firefox</td>
                                                            <td>Windows</td>
                                                            <td>280</td>
                                                            <td>63.12%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Firefox</td>
                                                            <td>Android</td>
                                                            <td>236</td>
                                                            <td>58.02%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Internet Explorer</td>
                                                            <td>Windows</td>
                                                            <td>145</td>
                                                            <td>45.23%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Safari</td>
                                                            <td>Macintosh</td>
                                                            <td>103</td>
                                                            <td>22.12%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Safari</td>
                                                            <td>iOS</td>
                                                            <td>302</td>
                                                            <td>56.98%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Opera</td>
                                                            <td>Windows</td>
                                                            <td>328</td>
                                                            <td>67.12%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Opera</td>
                                                            <td>Macintosh</td>
                                                            <td>22</td>
                                                            <td>87.21%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Chrome</td>
                                                            <td>iOS</td>
                                                            <td>45</td>
                                                            <td>23.21%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Firefox</td>
                                                            <td>Windows</td>
                                                            <td>67</td>
                                                            <td>27.11%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- END WIDGET TABLE -->

                                        <!-- WIDGET DONUT AND PIE CHART -->
                                        <div class="widget">
                                            <div class="widget-header">
                                                <h3><i class="fa fa-truck"></i> Traffic Source</h3>
                                                <em>- Visits based on source of traffic</em>
                                                <div class="btn-group widget-header-toolbar">
                                                    <a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
                                                    <a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
                                                    <a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
                                                </div>
                                            </div>
                                            <div class="widget-content">
                                                <div class="demo-flot-chart" id="demo-donut-chart"></div>
                                                <div class="panel panel-default panel-pie-chart">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title">Last Week Visits</h3>
                                                    </div>
                                                    <div class="panel-body">
                                                        <ul class="list-inline">
                                                            <li>
                                                                <span id="mini-pie-chart1" class="mini-pie-chart"></span>
                                                                <div>Mon</div>
                                                            </li>
                                                            <li>
                                                                <span id="mini-pie-chart2" class="mini-pie-chart"></span>
                                                                <div>Tue</div>
                                                            </li>
                                                            <li>
                                                                <span id="mini-pie-chart3" class="mini-pie-chart"></span>
                                                                <div>Wed</div>
                                                            </li>
                                                            <li>
                                                                <span id="mini-pie-chart4" class="mini-pie-chart"></span>
                                                                <div>Thu</div>
                                                            </li>
                                                            <li>
                                                                <span id="mini-pie-chart5" class="mini-pie-chart"></span>
                                                                <div>Fri</div>
                                                            </li>
                                                            <li>
                                                                <span id="mini-pie-chart6" class="mini-pie-chart"></span>
                                                                <div>Sat</div>
                                                            </li>
                                                            <li>
                                                                <span id="mini-pie-chart7" class="mini-pie-chart"></span>
                                                                <div>Sun</div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END WIDGET DONUT AND PIE CHART -->

                                    </div>
                                    <div class="col-md-6">
                                        <!-- WIDGET SALES MAP -->
                                        <div class="widget">
                                            <div class="widget-header">
                                                <h3><i class="fa fa-globe"></i> US Sales Map</h3>
                                                <em>- US map with plottable latitude and longitude</em>
                                                <div class="btn-group widget-header-toolbar">
                                                    <a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
                                                    <a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
                                                    <a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
                                                </div>
                                            </div>
                                            <div class="widget-content">
                                                <div class="map-custom-width data-us-map">
                                                    <div class="map"></div>
                                                    <div class="plotLegend"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END WIDGET SALES MAP -->

                                        <!-- WIDGET INLINE SPARKLINE -->
                                        <div class="widget widget-sparkline">
                                            <div class="widget-header">
                                                <h3><i class="fa fa-bar-chart-o"></i> Visits Stat</h3>
                                                <em>- Sparkline Charts With Random Data</em>
                                                <div class="btn-group widget-header-toolbar">
                                                    <a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
                                                    <a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
                                                    <a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
                                                </div>
                                            </div>
                                            <div class="widget-content">
                                                <div class="row first">
                                                    <div class="col-md-6">
                                                        <div class="sparkline-stat-item">
                                                            <div class="info">
                                                                <span>Visits</span>
                                                                <strong>1,363</strong>
                                                            </div>
                                                            <span id="sparkline1" class="inlinesparkline">Loading...</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="sparkline-stat-item">
                                                            <div class="info">
                                                                <span>Unique Visitors</span>
                                                                <strong>1,221</strong>
                                                            </div>
                                                            <span id="sparkline2" class="inlinesparkline">Loading...</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="sparkline-stat-item last">
                                                            <div class="info">
                                                                <span>Page Views</span>
                                                                <strong>2,300</strong>
                                                            </div>
                                                            <span id="sparkline3" class="inlinesparkline">Loading...</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="sparkline-stat-item">
                                                            <div class="info">
                                                                <span>Pages/Visit</span>
                                                                <strong>1.19</strong>
                                                            </div>
                                                            <span id="sparkline4" class="inlinesparkline">Loading...</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="sparkline-stat-item">
                                                            <div class="info">
                                                                <span>Avg. Visit Duration</span>
                                                                <strong>00:00:30</strong>
                                                            </div>
                                                            <span id="sparkline5" class="inlinesparkline">Loading...</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="sparkline-stat-item last">
                                                            <div class="info">
                                                                <span>% New Visits</span>
                                                                <strong>28.35%</strong>
                                                            </div>
                                                            <span id="sparkline6" class="inlinesparkline">Loading...</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END WIDGET INLINE SPARKLINE -->
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- WIDGET TASKS -->
                                        <div class="widget">
                                            <div class="widget-header">
                                                <h3><i class="fa fa-tasks"></i> My Tasks</h3>
                                                <em>- Summary of Tasks</em>
                                                <div class="btn-group widget-header-toolbar">
                                                    <a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
                                                    <a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
                                                    <a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
                                                </div>
                                            </div>
                                            <div class="widget-content">
                                                <ul class="task-list">
                                                    <li>
                                                        <p>Updating Users Settings
                                                            <span class="label label-danger">23%</span>
                                                        </p>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width:23%">
                                                                <span class="sr-only">23% Complete</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <p>Load &amp; Stress Test
                                                            <span class="label label-success">80%</span>
                                                        </p>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                                <span class="sr-only">80% Complete</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <p>Data Duplication Check
                                                            <span class="label label-success">100%</span>
                                                        </p>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                                <span class="sr-only">Success</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <p>Server Check
                                                            <span class="label label-warning">45%</span>
                                                        </p>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                                                <span class="sr-only">45% Complete</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <p>Mobile App Development
                                                            <span class="label label-danger">10%</span>
                                                        </p>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%">
                                                                <span class="sr-only">10% Complete</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- END WIDGET TASKS -->
                                    </div>
                                    <div class="col-md-8">
                                        <!-- WIDGET REAL-TIME CHART -->
                                        <div class="widget real-time-chart">
                                            <div class="widget-header">
                                                <h3><i class="fa fa-cogs"></i> CPU Load</h3>
                                                <em>- Realtime chart</em>
                                                <div class="btn-group widget-header-toolbar">
                                                    <a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
                                                    <a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
                                                    <a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
                                                </div>
                                            </div>
                                            <div class="widget-content">
                                                <div class="demo-flot-chart" id="demo-real-time-chart"></div>
                                            </div>
                                        </div>
                                        <!-- END WIDGET REAL-TIME CHART -->
                                    </div>
                                </div>

                                <!-- WIDGET TICKET TABLE -->
                                <div class="widget widget-table">
                                    <div class="widget-header">
                                        <h3><i class="fa fa-group"></i> Support Tickets</h3>
                                        <em>- List of Support Tickets</em>
                                        <div class="btn-group widget-header-toolbar">
                                            <a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
                                            <a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
                                            <a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>	
                                        </div>
                                        <div class="btn-group widget-header-toolbar">
                                            <div class="label label-danger"><i class="fa fa-warning"></i> 2 Critical Messages</div>
                                        </div>
                                    </div>
                                    <div class="widget-content">
                                        <table id="ticket-table" class="table table-sorting">
                                            <thead>
                                                <tr>
                                                    <th>Number</th>
                                                    <th>Date</th>
                                                    <th>Category</th>
                                                    <th>Name</th>
                                                    <th>Title</th>
                                                    <th>Priority</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><a href="#">[#18765]</a>
                                                    </td>
                                                    <td>Nov 21, 2013 15:45</td>
                                                    <td>Front-End Site</td>
                                                    <td>Smith</td>
                                                    <td><a href="#">Product Review Problem</a>
                                                    </td>
                                                    <td>
                                                        <span class="label label-high">#4 - High</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><a href="#">[#18766]</a>
                                                    </td>
                                                    <td>Nov 21, 2013 16:12</td>
                                                    <td>Technical Support</td>
                                                    <td>Sean</td>
                                                    <td><a href="#">Can't Download the Guide Doc</a>
                                                    </td>
                                                    <td>
                                                        <span class="label label-medium">#5 - Medium</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><a href="#">[#18767]</a>
                                                    </td>
                                                    <td>Nov 21, 2013 16:43</td>
                                                    <td>General Info</td>
                                                    <td>Jane Doe</td>
                                                    <td><a href="#">Regarding Customer Support</a>
                                                    </td>
                                                    <td>
                                                        <span class="label label-medium">#5 - Medium</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><a href="#">[#18768]</a>
                                                    </td>
                                                    <td>Nov 22, 2013 08:24</td>
                                                    <td>General Info</td>
                                                    <td>Smith</td>
                                                    <td><a href="#">Can't Change My Address</a>
                                                    </td>
                                                    <td>
                                                        <span class="label label-urgent">#3 - Urgent</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><a href="#">[#18769]</a>
                                                    </td>
                                                    <td>Nov 22, 2013 08:30</td>
                                                    <td>Sales</td>
                                                    <td>Smith</td>
                                                    <td><a href="#">Review Tab Malfunction</a>
                                                    </td>
                                                    <td>
                                                        <span class="label label-low">#6 - Low</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><a href="#">[#18770]</a>
                                                    </td>
                                                    <td>Nov 22, 2013 08:47</td>
                                                    <td>Front-End Site</td>
                                                    <td>John Doe</td>
                                                    <td><a href="#">Broken Link</a>
                                                    </td>
                                                    <td>
                                                        <span class="label label-emergency">#2 - Emergency</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><a href="#">[#18771]</a>
                                                    </td>
                                                    <td>Nov 23, 2013 14:08</td>
                                                    <td>Sales</td>
                                                    <td>Jack</td>
                                                    <td><a href="#">Need Info About My Order Status</a>
                                                    </td>
                                                    <td>
                                                        <span class="label label-critical">#1 - Critical</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><a href="#">[#18772]</a>
                                                    </td>
                                                    <td>Nov 23, 2013 17:45</td>
                                                    <td>Techincal Support</td>
                                                    <td>Darren</td>
                                                    <td><a href="#">Bouncing Email</a>
                                                    </td>
                                                    <td>
                                                        <span class="label label-critical">#1 - Critical</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><?php */?>
                                <!-- END WIDGET TICKET TABLE -->

                            </div>
                            <!-- /main-content -->
                        </div>
                        <!-- /main -->
                    </div>
                    <!-- /content-wrapper -->
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- END BOTTOM: LEFT NAV AND RIGHT MAIN CONTENT -->

        <?php include "footer.php";?>

    </div>
    <!-- /wrapper -->

    <!-- Javascript -->
    <script type="text/javascript" src="assets/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/modernizr.js"></script>
    <script type="text/javascript" src="assets/js/king-common.min.js"></script>
    <script type="text/javascript" src="assets/js/stat/jquery.easypiechart.min.js"></script>
    <script type="text/javascript" src="assets/js/raphael-2.1.0.min.js"></script>
    <script type="text/javascript" src="assets/js/stat/flot/jquery.flot.min.js"></script>
    <script type="text/javascript" src="assets/js/stat/flot/jquery.flot.resize.min.js"></script>
    <script type="text/javascript" src="assets/js/stat/flot/jquery.flot.time.min.js"></script>
    <script type="text/javascript" src="assets/js/stat/flot/jquery.flot.pie.min.js"></script>
    <script type="text/javascript" src="assets/js/stat/flot/jquery.flot.tooltip.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="assets/js/datatable/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/js/datatable/jquery.dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/jquery.mapael.js"></script>
    <script type="text/javascript" src="assets/js/maps/usa_states.js"></script>
    <script type="text/javascript" src="assets/js/king-chart-stat.min.js"></script>
    <script type="text/javascript" src="assets/js/king-table.min.js"></script>
    <script type="text/javascript" src="assets/js/king-components.min.js"></script>

</body>


<!-- Mirrored from demo.thedevelovers.com/dashboard/kingboard/ by HTTrack Website Copier/3.x [XR&CO'2013], Tue, 04 Mar 2014 10:56:16 GMT -->
</html>