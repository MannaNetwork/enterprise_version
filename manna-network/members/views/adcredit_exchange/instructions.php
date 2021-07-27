<?php
 require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
get_header();
//include('bootstrap_header.php');
//include($_SERVER['DOCUMENT_ROOT']."/manna-network/members/classes/member_page_class.php");//load order 1
echo '<br> dirname(__DIR__, 4 = ', dirname(__DIR__, 4);
include(dirname(__DIR__, 4)."/manna-configs/db_cfg/agent_config.php");//load order 1
//include(dirname(__DIR__, 3)."/manna-network/members/classes/member_page_class.php");//load order 1

//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 

$bs_action = $_GET['action'];

//include($_SERVER['DOCUMENT_ROOT']."/members/template_topy.php");
if($bs_action=="seller"){
$moniker="<h5>Safely Sell Your Advertising Credits For Cash</h5>";
}
else
{
$moniker="<h5>Buy Advertising Credits Direct From Members For Cash</h5>";
}


$body_width="wide";

if($bs_action=="seller"){

include('exchange_seller_submenu.php');
}
else
{
include('exchange_buyer_submenu.php');
}


$msg="<h1>Instructions</h1><table style = \"margin-left:auto; 
    margin-right:auto;\" bgcolor=\"white\" width=\"75%\"><tr><td>";




if($bs_action=="seller"){
$msg .= "<ul><li>Read the Terms Of Service - Seller</li>
<li>Click the \"Offer Advertising Credits [For Sale]\" Link</li>
<li>There in the form you will find the following sections:
<ol><li>Overview Of The Manna Network Peer To Peer Advertising Credit/AdCoin/Pseudo Bitcoin Exchange</li>
<li>Enter how many advertising credits you want to sell and for how much. </li>
<li>Enter the price you are selling them for (this is a firm price and there is no method for buyers to make counteroffers) or you can select the 'Market Price' option which keeps the price current until a buyer commits to purchase. </li> 
<li>The name of your bank. Unlike your account number and name (which are stored encrypted and not given out publicly except to those that have committed to buy) your bank name is published so potential buyers can know if there is a branch near them where they can make the deposit.</li>
<li>Enter your bank account number (Note: This is the same number that is on the bottom of each of your checks that is public information once you issue a check. The buyer needs it in order to deposit cash into your account).</li>
<li>Enter the name on the account (note: this is optional but double checking the account number with the name on the account prevents deposits into the wrong accounts.</li>
<li>Select how long of a time period (after a buyer accepts your offer) that they will have to make a cash deposit to your bank account. </li>
<li>Select how long of a time period (after a buyer reports their successful deposit to your account) that YOU WILL HAVE to transfer the advertising credits to their account. </li>

</ol>
</li>
<li>Each Section has its own \"Read Me\" for instruction specific to each section</li>
</ul> ";
}
else//action == buyer
{
$msg .= "<ol><li>Read the Terms Of Service - Buyer</li>
<li>Click the \"View Advertising Credits [For Sale]\" Link</li>
<li>Choose to accept from among the offered deals from sellers (Sorry, there is no way to \"Counter Offer\" at the present time).</li>
<li>Each Section has its own \"Read Me\" for instruction specific to each section</li>

</ol>


";
}

$msg .="</td></tr></table>";





echo $msg;
if($bs_action=="seller"){
echo '<a href="adcredit_exchange_index_seller.php"> <h2><u>Return To Advertising Credit Exchange Seller Menu</u></h2></a>';
}
else
{
echo '<a href="adcredit_exchange_index_buyer.php"> <h2><u>Return To Advertising Credit Exchange Buyer Menu</u></h2></a>';
}
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';

get_footer();
?>
