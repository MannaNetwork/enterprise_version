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
$BB_user_ID  = $_SESSION['user_id'];
//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 


// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.

//include($_SERVER['DOCUMENT_ROOT']."/classes/commission_reports_class.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connect.php");

//$comm_mng = new commission_reports;
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

//$getBeginEndTime = $comm_mng->timeSpan($yestOrTod, $time_span_begin, $time_span_end);
//returns array($greater_than_time, $less_than_time)
 
//$all_subscripts = $comm_mng->users_and_links_array_to_credit_daily_commiss($yestOrTod, $getBeginEndTime[0], $getBeginEndTime[1], $scope_selector, $user_id);
}

/*
if($db_categorytn[1] == 10033 OR $db_categoryp[1] == 10033 OR $db_categorytn[1] == 10033  ){
$_SESSION['is_affil']="true";
//policy should be = don't give any 10333 cats  a link to add web sites or web directory
include($_SERVER['DOCUMENT_ROOT'].'/members/user_cpanel_submenu_aff.php');//don't give affs a link to add web sites or web directory
}
else
{
include($_SERVER['DOCUMENT_ROOT'].'/members/user_cpanel_submenu.php');
}
*/

$scope_selector = $_GET['scope_selector'];

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

include "addjqlocal.php";
echo '<div class="firstdiv" align="center">';
 
switch ($scope_selector) {
//scope_selector options - all_regs, all_regs_w_links, all_paid_links, all_free_links, all_sales, all_overrides, my_regs_widgets, my_regs_widgets_links
    case "all_regs":
$type = 'all_regs';
//we need to look in users table for registrants in any of this users widgets - we can either get all their widgets or all their links by user id. Since there is no user ID in widgets table, get the links where user id is
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$query = "SELECT * FROM `links`WHERE `BB_user_ID` ='".$user_id."'";
$result = @mysqli_query($connect, $query) or die("Couldn't execute 'trans time' query");
$num_rows = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result)){
	If($num_rows>0){
	$link_id_array[]	= $row['id'];
	}
	else
	{
	$link_id = $row['id'];
	}
}  
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2accusersconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
echo '<h3>Below is the list of all users that registered at any/all your web directory installation(s). If the "user_active" column is "0" then they have not verified their email and will eventually be deleted</h3>'; 
$sql = "Select `user_name`, `user_email`, `user_id`, `user_active` from `users` where `wdgts_lnk_num` IN (" . implode(",", $link_id_array) . ')';
$res = mysqli_query($connect, $sql) or die("<p align='left'>Bold query145 "); 
	$rpt->mysqli_res = $res;
	$rpt->showReport();
        break;
case "all_regs_w_links";
$type = 'w_links';
 echo "<h3> The list below shows links that have registered at your website. They may currently be either a paying link or a free one. They may or may not have installed the web directory to become a member </h3>";
  //we need to look in users table for registrants in any of this users widgets - we can either get all their widgets or all their links by user id. Since there is no user ID in widgets table, get the links where user id is
//we need to look in users table for registrants in any of this users widgets - we can either get all their widgets or all their links by user id. Since there is no user ID in widgets table, get the links where user id is
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$query = "SELECT * FROM `links`WHERE `BB_user_ID` ='".$user_id."'";
$result = @mysqli_query($connect, $query) or die("Couldn't execute 'trans time' query");
$num_rows = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result)){
	If($num_rows>0){
	$link_id_array[]	= $row['id'];
	}
	else
	{
	$link_id = $row['id'];
	}
}  
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2accusersconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql = "Select `user_id` from `users` where `wdgts_lnk_num` IN (" . implode(",", $link_id_array) . ')';
while($row = mysqli_fetch_array($result)){
	If($num_rows>0){
	$user_id_array[]	= $row['id'];
	}
	else
	{
	$user_id = $row['id'];
	}
} 
//now look at links table for these users 
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$query = "SELECT id,BB_user_ID,category,url,name,description,approved,freebie,start_date,price_slot_amnt,ps_seniority_date
 FROM `links`WHERE `BB_user_ID` ='".$user_id."'";
$res = mysqli_query($connect, $query) or die("<p align='left'>Bold query183 "); 
	$rpt->mysqli_res = $res;
	$rpt->showReport();
     break;
    case "all_paid_links":
$type = 'all_paid_links';
 echo "<h3> The list below shows links that have registered at your website and are paying Bitcoin for better positions. They may or may not have installed the web directory to become a member </h3>";
 include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$query = "SELECT * FROM `links`WHERE `BB_user_ID` ='".$user_id."'";
$result = @mysqli_query($connect, $query) or die("Couldn't execute 'trans time' query");
$num_rows = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result)){
	If($num_rows>0){
	$link_id_array[]	= $row['id'];
	}
	else
	{
	$link_id = $row['id'];
	}
}  
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2accusersconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql = "Select `user_id` from `users` where `wdgts_lnk_num` IN (" . implode(",", $link_id_array) . ')';
while($row = mysqli_fetch_array($result)){
	If($num_rows>0){
	$user_id_array[]	= $row['id'];
	}
	else
	{
	$user_id = $row['id'];
	}
} 
//now look at links table for these users 
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$query = "SELECT id,BB_user_ID,category,url,name,description,approved,freebie,start_date,price_slot_amnt,ps_seniority_date
 FROM `links`WHERE `BB_user_ID` ='".$user_id."' AND `freebie` = 2";
$res = mysqli_query($connect, $query) or die("<p align='left'>Bold query183 "); 
	$rpt->mysqli_res = $res;
	$rpt->showReport();
        break;
    case "all_demo_paid_links":
$type = 'all_demo_paid_links';
 echo "<h3> The list below shows links that have registered at your website and are paying Bitcoin for better positions. They may or may not have installed the web directory to become a member </h3>";
 include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$query = "SELECT * FROM `links`WHERE `BB_user_ID` ='".$user_id."'";
$result = @mysqli_query($connect, $query) or die("Couldn't execute 'trans time' query");
$num_rows = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result)){
	If($num_rows>0){
	$link_id_array[]	= $row['id'];
	}
	else
	{
	$link_id = $row['id'];
	}
}  
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2accusersconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql = "Select `user_id` from `users` where `wdgts_lnk_num` IN (" . implode(",", $link_id_array) . ')';
while($row = mysqli_fetch_array($result)){
	If($num_rows>0){
	$user_id_array[]	= $row['id'];
	}
	else
	{
	$user_id = $row['id'];
	}
} 
//now look at links table for these users 
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$query = "SELECT id,BB_user_ID,category,url,name,description,approved,freebie,start_date,price_slot_amnt,ps_seniority_date
 FROM `links`WHERE `BB_user_ID` ='".$user_id."' AND `freebie` = 1";
$res = mysqli_query($connect, $query) or die("<p align='left'>Bold query258 "); 
	$rpt->mysqli_res = $res;
	$rpt->showReport();
        break;
case "all_free_links":
$type = 'all_free_links';
 echo "<h3> The list below shows links that have registered at your website and are paying Bitcoin for better positions. They may or may not have installed the web directory to become a member </h3>";
 include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$query = "SELECT * FROM `links`WHERE `BB_user_ID` ='".$user_id."'";
$result = @mysqli_query($connect, $query) or die("Couldn't execute 'trans time' query");
$num_rows = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result)){
	If($num_rows>0){
	$link_id_array[]	= $row['id'];
	}
	else
	{
	$link_id = $row['id'];
	}
}  
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2accusersconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql = "Select `user_id` from `users` where `wdgts_lnk_num` IN (" . implode(",", $link_id_array) . ')';
while($row = mysqli_fetch_array($result)){
	If($num_rows>0){
	$user_id_array[]	= $row['id'];
	}
	else
	{
	$user_id = $row['id'];
	}
} 
//now look at links table for these users 
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$query = "SELECT id,BB_user_ID,category,url,name,description,approved,freebie,start_date,price_slot_amnt,ps_seniority_date
 FROM `links`WHERE `BB_user_ID` ='".$user_id."' AND `freebie` = 0";
$res = mysqli_query($connect, $query) or die("<p align='left'>Bold query258 "); 
	$rpt->mysqli_res = $res;
	$rpt->showReport();
          break;
  
  case "all_sales":
$type = 'all_sales';
/* to get sales 
I need to find all paying links (there could be many per user but does user id matter?) 
I need to find paying links of THIS user so need to go through selection series to get same list of paying links in an array
and then query the price_slot_day_ledger where deposit > 0 and trans_type = btc and link_id in array */
 echo "<h3> The list below shows the total purchases by links that have registered at your website, are paying Bitcoin for better positions and during the time period you specified. They may or may not have installed the web directory to become a member </h3>";
 include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$query = "SELECT * FROM `links`WHERE `BB_user_ID` ='".$user_id."'";
$result = @mysqli_query($connect, $query) or die("Couldn't execute 'trans time' query");
$num_rows = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result)){
	If($num_rows>0){
	$link_id_array[]	= $row['id'];
	}
	else
	{
	$link_id = $row['id'];
	}
}  
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2accusersconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql = "Select `user_id` from `users` where `wdgts_lnk_num` IN (" . implode(",", $link_id_array) . ')';
while($row = mysqli_fetch_array($result)){
	If($num_rows>0){
	$user_id_array[]	= $row['id'];
	}
	else
	{
	$user_id = $row['id'];
	}
} 
//now look at links table for these users 
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$query = "SELECT `id` FROM `links`WHERE `BB_user_ID` ='".$user_id."' AND `freebie` = 1";
while($row = mysqli_fetch_array($result)){
	If($num_rows>0){
	$user_id_array[]	= $row['id'];
         }
	else
	{
	$user_id = $row['id'];
	}
} 

$query = "SELECT `id`, SUM(deposit) as sum, `balance` FROM `price_slot_day_ledger`WHERE `trans_type` like 'btc_com' AND `link_id` IN (" . implode(",", $link_id_array) . ')';

//$sum_query_res  = mysqli_query($connect, $query);
//$row = mysqli_fetch_row($sum_query_res);
//echo $row['sum'];

$res = mysqli_query($connect, $query) or die("<p align='left'>Bold query353 "); 
	$rpt->mysqli_res = $res;
	$rpt->showReport();    

 $query = "SELECT `id`, `link_id`, `deposit`, `balance`, `trans_time`, `trans_type` FROM `price_slot_day_ledger`WHERE `trans_type` like 'btc_com' AND `link_id` IN (" . implode(",", $link_id_array) . ')';

$res = mysqli_query($connect, $query) or die("<p align='left'>Bold query353 "); 
	$rpt->mysqli_res = $res;
	$rpt->showReport();
 break;
  case "all_demo_sales":
$type = 'all_demo_sales';
/* to get sales 
I need to find all paying links (there could be many per user but does user id matter?) 
I need to find paying links of THIS user so need to go through selection series to get same list of paying links in an array
and then query the price_slot_day_ledger where deposit > 0 and trans_type = btc and link_id in array */
 echo "<h3> The list below shows the total "purchases" using "demo coin" by links that have registered at your website, are paying with free Democoin for better positions and during the time period you specified. They may or may not have installed the web directory to become a member </h3>";
 include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$query = "SELECT * FROM `links`WHERE `BB_user_ID` ='".$user_id."'";
$result = @mysqli_query($connect, $query) or die("Couldn't execute 'trans time' query");
$num_rows = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result)){
	If($num_rows>0){
	$link_id_array[]	= $row['id'];
	}
	else
	{
	$link_id = $row['id'];
	}
}  
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2accusersconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql = "Select `user_id` from `users` where `wdgts_lnk_num` IN (" . implode(",", $link_id_array) . ')';
while($row = mysqli_fetch_array($result)){
	If($num_rows>0){
	$user_id_array[]	= $row['id'];
	}
	else
	{
	$user_id = $row['id'];
	}
} 
//now look at links table for these users 
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$query = "SELECT `id` FROM `links`WHERE `BB_user_ID` ='".$user_id."' AND `freebie` = 1";
while($row = mysqli_fetch_array($result)){
	If($num_rows>0){
	$user_id_array[]	= $row['id'];
         }
	else
	{
	$user_id = $row['id'];
	}
} 

$query = "SELECT SUM(deposit) as Total_Deposits_To_This_User FROM `price_slot_day_ledger`WHERE `trans_type` like 'ttc_com' AND `link_id` IN (" . implode(",", $link_id_array) . ') ';

//$sum_query_res  = mysqli_query($connect, $query);
//$row = mysqli_fetch_row($sum_query_res);
//echo $row['sum'];

$res = mysqli_query($connect, $query) or die("<p align='left'>Bold query353 "); 
	$rpt->mysqli_res = $res;
	$rpt->showReport();    

 $query = "SELECT `id`, `link_id`, `deposit`, `tn_balance` as Running_User_Balance, `trans_time`, `trans_type` FROM `price_slot_day_ledger`WHERE `trans_type` like 'ttc_com' AND `link_id` IN (" . implode(",", $link_id_array) . ')';
$res = mysqli_query($connect, $query) or die("<p align='left'>Bold query433 "); 
	$rpt->mysqli_res = $res;
	$rpt->showReport();echo '<h1>Coming Soon!<br>In commissions reports class</h1>';
echo "<br>All Your Sales Commissions<br> -  The users, and their links above are those that have registered at your website. They are listed along with the commissions on their purchases that you have earned for each purchase.<br>";
        break;
  
    case "all_overrides":
$type = 'all_overrides';
        echo "<br>All Your Over-Ride Commissions<br>The links above are earnings from over-ride commissions generated by sales by your downline only (i.e. they don't include your own sales figures)<br>";
        break;

    case "all_demo_overrides":
$type = 'all_demo_overrides';
        echo "<br>All Your Over-Ride Commissions<br>The links above are earnings from over-ride commissions generated by sales by your downline only (i.e. they don't include your own sales figures)<br>";
        break;

case "my_regs_widgets":
        echo "<br>Your Registrants w/Directories<br>select * from widgets where BB user ID is in My List of Registrants<br>";
        break;
    case "my_regs_widgets_links":
 echo "<br>Your Registrants Links w/Directories<br><br>select * from widgets where BB user ID is in My List of Registrants LINKS<br>";
        break;
case "my_subscript_cancels":
$type = 'my_subscript_cancels';
  break;
}
	
include('../../960bottom.php');


} else {
    // the user is not logged in...

    include("../views/not_logged_in.php");
}
