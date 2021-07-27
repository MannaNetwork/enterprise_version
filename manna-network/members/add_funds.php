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
<h1 style="font-size:350%;">Manage Your Demo Coins</h1>

<a href="transfer_demo.php?user_id=<?echo $user_id;?>">
<div  class="grid_3 alpha"> &nbsp;
<!--<h1>Alt Coins</h1>
<h3>Pre-Load Your Bungeebones Account With Alt Coins Use The Account To Purchase The Best Advertising Positions</h3>
<h1>Add Advertising Credits Now!</h1> -->
</div>
<div  class="grid_6" style="background-color:yellow; width:50%; height:700px; border: 2px solid; border-radius: 25px;">
<h1>Transfer NON-Redeemable Demo Credits To Members & Customers</h1>

<ul style="font-size:154%;">
<h3>Enable Your Downline & Customers To:</h3>
<li> Test/Learn Bidding System</li>
<li> Test/Learn Commission System</li>
<li> Test/Learn Selling/Buying System</li>
<li>Owners can use them to move their link ahead of FREE links</li>
<li>NOT Backed NOR REDEEMABLE For Bitcoin Nor Bitcoin Cash>
<li>DO NOT CHARGE FOR NON-REDEEMABLE Demo Coins</li>
<li>Or Use Contact Form To Acquire Free NON-REDEEMABLE Demo Coins From Admin</li>
</ul>
<h1>Transfer Demo Credits Now!</h1>

</div></a>
<div  class="grid_3 omega"> &nbsp;
<!--<h1>Alt Coins</h1>
<h3>Pre-Load Your Bungeebones Account With Alt Coins Use The Account To Purchase The Best Advertising Positions</h3>
<h1>Add Advertising Credits Now!</h1> -->
</div>
</td></tr> </table>
<table id="member"><tr valign="top"><td>
<h1 style="font-size:350%;">Pre-load Your Bitcoin Cash-Backed Advertising Funds</h1>
<a href="Examples/example_bcash.php?user_id=<?echo $user_id;?>">
<div  class="grid_6 alpha"  style="background-color:yellow;width:46%; height:600px; border: 2px solid; border-radius: 25px;  padding:10px;">
<h1>Bitcoin Cash</h1>
<h3>Pre-Load Your Bungeebones Account And Use The Account To Purchase The Best Advertising Positions</h3>
<h1>Add Bitcoin Cash Now!</h1>
</div> </a>
<!--<a href="Examples/example_dash.php?user_id=<?echo $user_id;?>">
$bitcoin_marketprice_usd
Added new page to explain alt coin system - Frome this new page, link to the dash page above and make new alt coins for each. 
-->
<a href="alt_coins.php?user_id=<?echo $user_id;?>">
<div  class="grid_6 omega" style="background-color:yellow; width:46%; height:600px; border: 2px solid; border-radius: 25px; padding:10px;">
<h1>Alt Coins</h1>
<h3>Pre-Load Your Bungeebones Account's AD Credit Balance Using Alt Coins</h3>
<h1 style='text-align:left;'>Ad Credits are pegged and redeemable to the Bitcoin Cash price. If you use alt coins, realize that the "ad credits" you purchase with the alt coins will still all be backed 100% with Bitcoin Cash and you will be receiving as many ad credits as what your alt coin is worth at purchase. If/when you redeem earnings from your account they will only be available in Bitcoin Cash!</h1>
</div></a>
</td></tr> </table>

<table id="member"><tr valign="top"><td>
<h1 style="font-size:350%;">Manage Bitcoin-Backed Funds</h1>
<a href="Examples/example_basic.php?user_id=<?echo $user_id;?>">
<div  class="grid_3 alpha"> &nbsp;
<!--<h1>Alt Coins</h1>
<h3>Pre-Load Your Bungeebones Account With Alt Coins Use The Account To Purchase The Best Advertising Positions</h3>
<h1>Add Advertising Credits Now!</h1> -->
</div> </a>
<a href="transfer_real_credits.php?user_id=<?echo $user_id;?>">
<div  class="grid_6 omega" style="background-color:yellow; width:48%; height:600px; border: 2px solid; border-radius: 25px;">
<h1>Transfer REDEEMABLE Credits To Members & Customers</h1>

<ul style="font-size:154%;">
<h3>Enable Your Downline To:</h3>
<li>Get Bitcoin Cash Backed Ad Credits For Bidding In The System</li>
<li>Move Their Link Ahead Of FREE And DEMO links</li>
<li>These ARE Backed AND REDEEMABLE For Bitcoin Cash</li>
<li>Perfect For Face-To-Face Transfers</li>
<li>Suggested CHARGE FOR REDEEMABLE Ad Credits Is Current Bitcoin Cash Price</li>
</ul>
<h1>Transfer Advertising Credits Now!</h1>
</div></a>
<div  class="grid_3 omega">  &nbsp;
<!--<h1>Alt Coins</h1>
<h3>Pre-Load Your Bungeebones Account With Alt Coins Use The Account To Purchase The Best Advertising Positions</h3>
<h1>Add Advertising Credits Now!</h1> -->
</div> 


</td></tr> </table>
<table id="member"><tr valign="top"><td>
<a href="adcredit_exchange/index_seller.php?user_id=<?echo $user_id;?>">
<div  class="grid_4 alpha" style="background-color:yellow; width:48%; height:550px; border: 2px solid; border-radius: 25px;">
<h1>Sell Redeemable Ad Credits* To Members & Customers</h1>

<ul style="font-size:154%;">
<h3>Enable Members To:</h3>
<li> Buy Advertising Credits From You</li>
<li>Move their link ahead of FREE AND DEMO links</li>
<li>Backed and REDEEMABLE For Bitcoin Cash</li>
<li>Sell Directly (Person-To-Person)</li>
<li>Sell For Cash Deposited To Your Bank</li>
<li>Sell For Alt Coin</li>
</ul>
<h1>Sell Advertising Credits Now!</h1>
</div></a>




<a href="adcredit_exchange/index_buyer.php?user_id=<?echo $user_id;?>">

<div  class="grid_4 omega" style="background-color:yellow; width:48%; height:550px; border: 2px solid; border-radius: 25px;">
<h1>Purchase Redeemable Ad Credits* From Members</h1>
<ul style="font-size:154%;">
<li>Safe</li>
<li>Secure</li>
<li>Backed and REDEEMABLE For Bitcoin Cash</li>
<li>Buy Directly (Person-To-Person)</li>
<li>Buy With Cash Deposit To Their Bank</li>
<li>Buy With Alt Coin</li>
</ul>
<h1>Get Ad Credits Now!</h1>

</div> </a>
</td></tr> </table>
<h1>* Redeemable Ad Credits are redeemable for Bitcoin Cash at a one for one exchange rate</h1>

<p class='smallerFont' > There is no minimum funding level so you can use and/or test the system with as little as a day's advertising fee. You eventually will want to deposit enough to conveniently cover the per-diem charges for as long a period as you consider convenient (there is no automated subscription method).  


<?
include("../960bottom.php");


} else {
    // the user is not logged in...
    include("views/not_logged_in.php");
}
