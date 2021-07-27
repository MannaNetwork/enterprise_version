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

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
			include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql = "SELECT * FROM `temp_download_b4_wdgt_insert` WHERE `BB_user_ID` = " . $user_id ;

		$result = mysqli_query($connect, $sql)or die("<p align='left'>Bold query1 - line 97"); 
                       $row_cnt = mysqli_num_rows($result);

if($row_cnt == 0){
echo '<h1>You must have registered in order to download the plugin</h1>';
exit();
}
elseif($row_cnt > 0){
 while ($row = mysqli_fetch_array($result)) 
                          {
                 		    $referer_id = $row['referer_id'];
$referer_lnk_num = $row['referer_lnk_num'];
$referer_wdgt_id = $row['referer_wdgt_id'];
$referer_affiliate_num = $row['referer_affiliate_num'];
$wp_user_login_registrant = $row['wp_user_login_registrant'];
$wp_user_email_registrant = $row['wp_user_email_registrant'];
$BB_user_ID = $row['BB_user_ID'];
$url = $row['url'];
$title = $row['title'];
$description = $row['description'];
		          }

}
elseif($row_cnt > 1){
// while ($row = mysqli_fetch_array($result)) 
//                          {
        //         		$link_id[] = $row['id'];
	//	          }
echo '<h1>Line 57 of plugin_download.php - user has multiple sites and need a selection form or error handler to identify which to associate with this download and which affiliate number to give them for configuration.</h1>';
print_r($BB_user_id);
exit();
}


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


$moniker="<h5>Congratulations On Getting Your Plugin And Your Opportunity To Start Earning Bitcoin!</h5>";
$body_width="wide";

include('../960top.php');
include('user_cpanel_submenu.php');
$get_info = new price_slot_info;

$user_balance_array = $get_info->getUsersBungeeBankBalance($user_id);
//array($id, $user_id, $bungee_cash_balance, $frn_cash_balance)
$mdpartsum1 = $user_balance_array[0];

$mdpartsum1 .= $user_balance_array[1];
$mdpartsum1 .= $user_balance_array[2];
$mdpartsum1 .= $user_balance_array[3];
$key = md5($mdpartsum1);
$key = $user_id."||".$key;

?>


<table id="member"><tr valign="top"><td>
<!--<br><br><a href=\"adcredit_exchange/index_buyer.php\"><img src=\"/images/load_with_adcoin.gif\"></a>
<br><br><a href=\"bitcoin.php?user_id=".$user_id."\"><img src=\"/images/load_with_bitcoin.gif\"></a>-->
<h1 style="font-size:350%;">Download BungeeBones Blog4Bitcoin Plugin</h1>


<a href="/plugins/bungeebones_plugin_version.zip"><div  class="grid_12"  style="background-color:yellow; width:100%; height:520px; border: 2px solid; border-radius: 25px;">
<h1>Click To Download Your Plugin</h1>

<ul style="font-size:154%;">
<li>It Is Free!</li>
<li>It Will Earn Bitcoin For Ad Sales Your Site Generates</li>
<li>ALL Registrants Can Advertise In Network For Free Or Paid</li>
<li>ALL Free Advertisers Can Begin Paying And Earning You Bitcoin At Any Time</li>
<li>ALL Advertisers Can Add A Plugin, Get A MultiSite Blog or Add The PHP Version and Earn You More!</li>
<li>You Earn 50% Of What Your Advertisers Pay</li>
<li>You Earn 50% Of What Your Recruits Earn</li>
<li>All Ad Fees, All Commissions In Bitcoin Only</li>
</ul>
<h1>Download And Install Your Plugin Now!</h1>
</div> </a>


</td></tr> </table>
<?
include("../960bottom.php");


} else {
    // the user is not logged in...
    include("views/plugin_not_logged_in.php");
}
