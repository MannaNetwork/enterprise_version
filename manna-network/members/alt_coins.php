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


$moniker="<h5>Fund Your Account To Buy Advertising</h5>";
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
<h2 style="font-size:350%;">Pre-load Your Bitcoin Cash-Backed Advertising Funds With Alt Coins</h2>
<a href="Examples/example_dash.php?user_id=<?echo $user_id;?>">
<div  class="grid_6 alpha"  style="background-color:yellow;width:46%; height:600px; border: 2px solid; border-radius: 25px;  padding:10px;">
<h1>DASH</h1>
<h3>Pre-Load Your Bungeebones Account With DASH!</h3>
<h1>Add Ad Credits Now!</h1>
</div> </a>

<a href="Examples/example_litecoin.php?user_id=<?echo $user_id;?>">
<div  class="grid_6 omega" style="background-color:yellow; width:46%; height:600px; border: 2px solid; border-radius: 25px; padding:10px;">
<h1>Lite Coin</h1>
<h3>Pre-Load Your Bungeebones Account With Lite Coin!</h3>
<h1>Add Ad Credits Now!</h1>
</div></a>
</td></tr> </table>

<h1>* Redeemable Ad Credits are redeemable for Bitcoin Cash at a one for one exchange rate</h1>

<p class='smallerFont' > There is no minimum funding level so you can use and/or test the system with as little as a day's advertising fee. You eventually will want to deposit enough to conveniently cover the per-diem charges for as long a period as you consider convenient (there is no automated subscription method).  


<?
include("../960bottom.php");


} else {
    // the user is not logged in...
    include("views/not_logged_in.php");
}
