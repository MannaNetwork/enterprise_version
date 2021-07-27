<?php
include($_SERVER['DOCUMENT_ROOT']."/classes/access_user/access_user_class.php"); 
$test_page_protect = new Access_user;
$test_page_protect->login_page = "login.php"; // change this only if your login is on another page
$test_page_protect->access_page($_SERVER['PHP_SELF'], $_SERVER['QUERY_STRING']); // set this  method, including the server vars to protect your page and get redirected to here after login
$hello_name = ($test_page_protect->user_full_name != "") ? $test_page_protect->user_full_name : $test_page_protect->user;
$test_page_protect->get_user_info();
$user_id=$test_page_protect->id;
$access_level =$test_page_protect->get_access_level();
if (isset($_GET['action']) && $_GET['action'] == "log_out") {
	$test_page_protect->log_out(); // the method to log off
}
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 
include($_SERVER['DOCUMENT_ROOT']."/classes/commission_reports_class.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connect.php");
/*
include('/home/bungeebo/public_html/classes/commissions_class_paths.php');
include('/home/bungeebo/public_html/db_cfg/db2bbconfig.php');
include('/home/bungeebo/public_html/db_cfg/connect.php');
*/
$comm_mng = new commission_reports;
$B1 = $_GET['B1'];
$lastmonth= date('Y-');
$lastmonth .= date('m')-2;
$lastmonth .= date('-d');
$lastmonth .= date(' 00:00:00');

if(isset($B1)){
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

//$all_subscripts = $comm_mng->users_and_links_array_to_credit_daily_commiss($yestOrTod, $getBeginEndTime[0], $getBeginEndTime[1], $scope_selector, $user_id);

}//close if isset B1
else
{

echo '<h1>Reports Manager</h1>
<h3>Get Various Commission Reports For A Single User</h3>
<p><a href="index.php">Commissions Manager Index</a></p>
<p><a href="../index.php">Main Admin Menu</a></p>
<FORM action="'. $_SERVER['PHP_SELF'].'" method="GET">
<table><tr><td>


<select name="scope_selector">
<option value="SELECT" selected="selected"></option>
<option value="all_regs">All My Registrants</option>
<option value="all_regs_w_links">All My Registrants w/ Links</option>
<option value="all_paid_links">All My Paid Links</option>
<option value="all_free_links">All My Free Links</option>
<option value="all_sales">All My Sales Commissions</option>
<option value="all_overrides">All My Over-Ride Commissions</option>
<option value="my_regs_widgets">My Registrants w/Directories</option>
<option value="my_subscript_cancels">my_subscipt_cancels</option>
<option value="my_regs_widgets_links">My Registrants Links w/Directories</option>
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
<p>Use drop down above IF You Want yesteday or today 
<br>
OR
<p>enter input box into text box  IN THIS FORMAT:   "2012-06-19 00:00:00" EXACTLY to enter search dates for a larger range</p>
<input type="text" name="time_span_begin" value = "enter begin date and time  2012-06-01 00:00:00"</input>
<input type="text" name="time_span_end" value = "enter end date and time  2012-06-30 00:00:00"</input>
  <INPUT type="submit" name="B1" value="Process Commissions">
Search By Site -Link ID <INPUT type="text" name="by_link_ID" size="6"><br>
Search By Site - URL Address <INPUT type="text" name="by_link_URL" size="32"><br>
Search By Widget ID <INPUT type="text" name="by_widget_ID" size="6"><br>
Get All User\'s Widgets <INPUT type="checkbox" name="get_all" ><br>

<INPUT type="submit" name="B1" value="Submit">
</FORM>';
}

