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
}//close if isset B1
else
{

if($db_categorytn[1] == 10033 OR $db_categoryp[1] == 10033 OR $db_categorytn[1] == 10033  ){
$_SESSION['is_affil']="true";
//policy should be = don't give any 10333 cats  a link to add web sites or web directory
include($_SERVER['DOCUMENT_ROOT'].'/members/user_cpanel_submenu_aff.php');//don't give affs a link to add web sites or web directory
}
else
{
include($_SERVER['DOCUMENT_ROOT'].'/members/user_cpanel_submenu.php');
}



echo '<h1>Reports Manager</h1>
<h3 style="text-align:center";>Under Construction</h3>
<h3  style="text-align:center";>Get Various Reports For Commissions And Related Statistics</h3>
<br><hr><br>
<FORM action="samplereport.php" method="GET">';
//'. $_SERVER['PHP_SELF'].'
echo '
<table><tr><td><h1>Scope Selectors</h1></td><td><h1>Record Period Selectors</h1></td></tr>
<tr><td>

<input type="hidden" name="link_selected" value="'.$_GET['link_selected'].'">
<select name="scope_selector">
<option value="SELECT" selected="selected"></option>
<option value="all_regs">All My Registrants</option>
<option value="all_regs_w_links">All My Registrants w/ Links</option>
<option value="all_paid_links">All Registered Paid Links</option>
<option value="all_demo_paid_links">All Registered Demo-Paid Links</option>
<option value="all_free_links">All Registered Free Links</option>
<option value="all_sales">All My Sales & Commissions</option>
<option value="all_demo_sales">All My Demo-Sales & Commissions</option>
<option value="all_overrides">All My Over-Ride Sales & Commissions</option>
<option value="all_demo_overrides">All My Demo-Over-Ride Sales & Commissions</option>
<option value="my_regs_widgets">My Registrants w/Directories</option>
<option value="my_regs_widgets_links">My Registrants Links w/Directories</option>
<option value="my_subscript_cancels">Buyer Cancellations</option>
</select>
</td><td>
<select name="time_span">
<option value="SELECT" selected="selected"></option>
<option value="today">Today</option>
<option value="yesterday">Yesterday</option>
<option value="db4yesterday">Day Before Yesterday</option>
<option value="threedaysago">Three Days Ago</option>
<option value="fourdaysago">Four Days Ago</option>
<option value="fivedaysago">Five Days Ago</option>
<option value="thisweek">This Week</option>
<option value="lastweek">Last Week</option>
<option value="thismonth">This Month</option>
<option value="lastmonth">Last Month</option>
<option value="thisyear">This Year (since Jan 1)</option>
<option value="lastyear">Last Year (Jan 1 - Dec 31)</option>
</select>
</td></tr></table>
<p>Use left drop down above to select the type of report you want.
<br>
AND
<p>OPTIONALLY select from the right dropdown to filter results to the selected time period.
<p>
<INPUT type="submit" name="B1" value="Submit">
</FORM>';
}

//include($_SERVER['DOCUMENT_ROOT']."/members/960bottom.php');
include('../../960bottom.php');


} else {
    // the user is not logged in...

    include("../views/not_logged_in.php");
}




