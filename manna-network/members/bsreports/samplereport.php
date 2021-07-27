<?
// include the configs
require_once("../config/config.php");

    
// load the login class

// load php-login components
require_once("../php-login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

 
    
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...


$user_id = $_SESSION['user_id'];

//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 


// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.

include($_SERVER['DOCUMENT_ROOT']."/classes/commission_reports_class.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connect.php");

$comm_mng = new commission_reports;
$B1 = $_GET['B1'];
$lastmonth= date('Y-');
$lastmonth .= date('m')-2;
$lastmonth .= date('-d');
$lastmonth .= date(' 00:00:00');
$moniker="<h5>Add A Link</h5>";
$body_width="wide";
include('../../960top.php');
if(isset($B1)){
if($_SESSION['is_affil']="true" ){
//policy should be = don't give any 10333 cats  a link to add web sites or web directory
include($_SERVER['DOCUMENT_ROOT'].'/members/user_cpanel_submenu_aff.php');//don't give affs a link to add web sites or web directory
}
else
{
include($_SERVER['DOCUMENT_ROOT'].'/members/user_cpanel_submenu.php');
}
$yestOrTod = $_GET['time_span'];
//line below hard coded for the cron to work at 1:01 a.m.
//comment out to use the form for other than yesterday
//$time_span = "yesterday";

$scope_selector = $_GET['scope_selector'];

//options all_regs, all_regs_w_links, all_paid_links, all_free_links, all_sales, all_overrides, my_regs_widgets, my_regs_widgets_links
//labels All My Registrants, All My Registrants w/ Links, All My Paid Links, All My Free Links, All My Sales Commissions, All My Over-Ride Commissions, My Registrants w/Directories, My Registrants Links w/Directories

$time_span_begin = $_GET['time_span_begin'];

$time_span_end = $_GET['time_span_end'];

$getBeginEndTime = $comm_mng->timeSpan($yestOrTod, $time_span_begin, $time_span_end);
//returns array($greater_than_time, $less_than_time)

$all_subscripts = $comm_mng->users_and_links_array_to_credit_daily_commiss($yestOrTod, $getBeginEndTime[0], $getBeginEndTime[1], $scope_selector, $user_id);
}
if($db_categorytn[1] == 10033 OR $db_categoryp[1] == 10033 OR $db_categorytn[1] == 10033  ){
$_SESSION['is_affil']="true";
//policy should be = don't give any 10333 cats  a link to add web sites or web directory
include($_SERVER['DOCUMENT_ROOT'].'/members/user_cpanel_submenu_aff.php');//don't give affs a link to add web sites or web directory
}
else
{
include($_SERVER['DOCUMENT_ROOT'].'/members/user_cpanel_submenu.php');
}

?>
<!--
<!DOCTYPE html>
<html>
<head>
<title>My Report</title>
    <meta charset="utf-8">
<? include "addbslocal.php" ?>
</head>
<body>  -->
<?

$report_type = $_GET['report_type'];
if($report_type == 'link_details'){
$sql = "SELECT id,BB_user_ID,category,url,name,description,approved,street,zip,phone,freebie,start_date,price_slot_amnt,ps_seniority_date,nofollow  from `links` WHERE `BB_user_ID` = $BB_user_ID";
}


	include_once("phpBSReports.php");
	$rpt = new phpReport();
  $rpt->width = "95%";
	$rpt->header_color = "#4477ff";
	$rpt->header_textcolor="#ffffff";
  $rpt->header_alignment="center";
	$rpt->body_alignment = "left";
	$rpt->body_color = "#ffeeee";
	$rpt->body_textcolor = "#991199";
  $rpt->covered_color="#449999";
	$rpt->covered = '1';
  $rpt->striped='1';
  $rpt->bordered='1';
  $rpt->hover='1';
  $rpt->responsive='0';
  $rpt->inverse='1';
  $rpt->condensed='1';
	$rpt->title = "SMS Groups";
  $rpt->footer="Generated on :".date("d-M-Y");

//$con = mysqli_connect("localhost","my_user","my_password","my_db");
//use above code with your database details or include connection file db2.php 
//change its values to match your database
//harcoded test userid
$BB_user_ID = 2;
//include "db2.php"; //code which makes mysqli connection
/*
$sql = "SELECT id,BB_user_ID,category,url,name,description,approved,street,zip,phone,freebie,start_date,price_slot_amnt,ps_seniority_date,nofollow from `links` WHERE `BB_user_ID` = $BB_user_ID";
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Get temp Account' query");
$num_rows = mysqli_num_rows(mysqli_query($connect, $sql)); //add this to array if count needed $num_rows_free,
return $num_rows;*/
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

include "addjqlocal.php";
echo '<div class="firstdiv" align="center">';
$sql = "SELECT id,BB_user_ID,category,url,name,description,approved,street,zip,phone,freebie,start_date,price_slot_amnt,ps_seniority_date,nofollow  from `links` WHERE `BB_user_ID` = $BB_user_ID";
echo $sql;
	$res = mysqli_query($connect, $sql);
	$rpt->mysqli_res = $res;
	$rpt->showReport();
	
include('../../960bottom.php');


} else {
    // the user is not logged in...

    include("../views/not_logged_in.php");
}
