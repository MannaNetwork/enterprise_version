<?php

// include the configs
require_once("config/config.php");

    
// load the login class

// load php-login components
require_once("php-login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

 
    
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...


$user_id = $_SESSION['user_id'];



$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 
include($_SERVER['DOCUMENT_ROOT']."/classes/link_class.php");//load order 1
//include($_SERVER['DOCUMENT_ROOT']."/classes/paginate_buy_class.php");//load order 4
//commented out because most funcs in it from old auc times
//if creates errors, move needed funcs to other classes
include($_SERVER['DOCUMENT_ROOT']."/classes/categories_class.php");//load order 2
include($_SERVER['DOCUMENT_ROOT']."/classes/free_categories.php");//load order 3
include($_SERVER['DOCUMENT_ROOT']."/classes/price_slot_class.php");//load order 3
include($_SERVER['DOCUMENT_ROOT']."/classes/ad_credit_exchange_class.php");//load order 3


$moniker="<h5>Add A Web Directory In 3 Easy Steps</h5>";
$body_width="wide";

include('../960top.php');

$get_info = new price_slot_info;

$user_balance_array = $get_info->getUsersBungeeBankBalance($user_id);
//array($id, $user_id, $bungee_cash_balance, $frn_cash_balance)
$mdpartsum1 = $user_balance_array[0];

$mdpartsum1 .= $user_balance_array[1];
$mdpartsum1 .= $user_balance_array[2];
$mdpartsum1 .= $user_balance_array[3];
$key = md5($mdpartsum1);
$key = $user_id."||".$key;

include('user_cpanel_submenu.php');
?>

<!--
	<div style="text-align: center;">
		<a href="index.php"class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;
		<a href="overview.php" class="cssbutton sample a"><span>Overview</span></a>&nbsp;
		<a href="reg_form" class="cssbutton sample a"><span>Add Link</span></a>&nbsp;
		<a href="" class="cssbutton sample a"><span>Add/Manage Funds</span></a>&nbsp;
<a href="http://bungeebones.com/feedback.php?BB_user_id=<? echo $user_id; ?>" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="termsofservice.php" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="http://bungeebones.com/members/index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
		</div> -->
<table id="member"><tr valign="top"><td>
<h1 style="font-size:350%;">Add A Complete & Managed Web Directory To Your Website In 3 Easy Steps</h1>


<a href="bungeebones_news-MAKE_TEMPLATE_TUT.php"><div  class="grid_4 alpha"  style="background-color:yellow; width:31%; height:470px; border: 2px solid; border-radius: 25px;">
<h1>Make A Web Page Template</h1>
<ul style="font-size:154%;">
<li>Start With A Page From Your Own Website</li>
<li>Your Theme, Your Header, Your Footer</li>
<li>Clear A Place For The Web Directory</li>
</ul>
<h1>Click For Video Tutorial!</h1>
</div> </a>
<a  title='General Instructions' rel='gb_page_center[640, 480]'><div style=\"background-image: url('images960/1x1tran.gif'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:white; font-size:100%;-moz-border-radius: 15px;
		border-radius: 15px;text-align: center;\"></div>

<div  class="grid_4"  style="background-color:yellow;width:31%; height:470px; border: 2px solid; border-radius: 25px;">
<h1>Insert Two Blocks Of PHP Code</h1>
<ul style="font-size:154%;">
<li>Copy Them, Complete, From Your BungeeBones Account</li>
<li>Paste One Block Into Your Template Page "Head" Section</li>
<li>Paste The Other In The Body Section</li>
</ul>
<h1>Maintenance Free!</h1>

</div> </a>
<a ><div  class="grid_4 omega" style="background-color:yellow; width:31%; height:470px; border: 2px solid; border-radius: 25px;">
<h1>Promote It And Earn Bitcoin!</h1>
<ul style="font-size:154%;">
<li>Add A Link To It From Your Menus</li>
<li>Offer Advertising To Your Associates, Your Customers & Your Website Visitors</li>
<li>Use It As A Fund Raisers</li>
</ul>
<h1>It's Like Mining Bitcoin With Web Traffic!</h1>

</div> </a>
<h2>Start Earning Bitcoin Today By Returning To Your Main User Control Panel Page And Click The Button To The Link's Right!</h2>
</td></tr> </table>
<?
include("../960bottom.php");


} else {
    // the user is not logged in...
    include("views/not_logged_in.php");
}
