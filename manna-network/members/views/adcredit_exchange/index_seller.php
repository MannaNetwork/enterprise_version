<?php
 require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
get_header();
//include('bootstrap_header.php');
//include($_SERVER['DOCUMENT_ROOT']."/manna-network/members/classes/member_page_class.php");//load order 1
echo '<br> dirname(__DIR__, 4 = ', dirname(__DIR__, 4);
include(dirname(__DIR__, 4)."/manna-configs/db_cfg/agent_config.php");//load order 1

//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 





$moniker="<h5>The AdCoin/Advertising Credit Exchange & Market Bulletin</h5>";
$body_width="wide";

include('user_cpanel_submenu.php');
$msg="";
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 if (empty($_POST["num_credits_4sale"])) {
    $num_credits_4saleErr = "<font color='red'> <br>number of credits 4sale is required";
$ERR = 'true';
  } else {
    $num_credits_4sale = test_input($_POST["num_credits_4sale"]);
  }


if (empty($_POST["price_credits_4sale"])  and empty($_POST["market_order"])) {

    $price_credits_4saleErr = "<font color='red'> <br>Either Set A Price Or select Market Order";
$ERR = 'true';
  } else {
    $price_credits_4sale = test_input($_POST["price_credits_4sale"]);
  }

 if ($_POST["time_period_buyer"] == "Choose") {
    $time_period_buyerErr = "<font color='red'> <br>Setting a time limit for buyer deposit & response is required";
$ERR = 'true';
  } else {
    $time_period_buyer = test_input($_POST["time_period_buyer"]);
  }

if ($_POST["time_period_seller"] == "Choose") {
    $time_period_sellerErr = "<font color='red'> <br>Setting a time limit for your transfer of credits after the buyer's response is required";
$ERR = 'true';
  } else {
    $time_period_seller = test_input($_POST["time_period_seller"]);
  }


}

$msg .= "<table id=\"member\" ><tr><td>
<p class=\"smallerFont\" >The links and processes listed below enable Manna-Network users that have Advertising Credits in their account to offer them for sale using Manna-Network.com as an escrow service and, if necessary, an arbitration service. The process is designed to be completely initiated and operated by users on each side of the transaction (i.e. by Manna-Network' sellers and buyers).

<h2>The services Manna-Network offers</h2>
<ol>
<li> Provides sellers an alternate way to liquidate their Advertising Credits* to users that need them </li>
<li>Provides sellers a location (called the \"Market Bulletin\") for them to list their advertising credits as \"for sale\".</li>

<li>Provides guarantees (to the buyer) that the sellers 1) own the Advertising Credits* they are offering for sale and 2) they will receive them (after paying the seller)</li>

<li>Provides a \"Smart Contract\" between buyer and seller 
<ol><li>Seller establishes contractual quantity for sale</li>
<li>Seller sets the contractual price </li>
<li>Seller sets two contractual time limits for the performance of various steps</li>
<li>Buyer accepts the seller's terms (which causes automatic, temporary freeze on offered credits and initiates first contractual time limit for buyer to make cash deposit to seller's bank)</li>
<li>Buyer makes deposit on time and reports same to seller and Manna-Network (signaling their performance of sales contract terms) and initiates second contractual time limit allowing time for the seller to verify deposit (usually through the seller's own online bank access)</li>
<li><u><b>The SELLER'S actions (or inaction) at this point causes one of the following 3 events to occur</b></u>
<ol>
<li>Seller verifies cash deposit and can (optionally) transfer credits to buyer themself (before the automatic transfer occurs) OR </li>
<li>Seller checks for deposit, finds none has been made and reports false deposit report to Manna-Network** OR</li>
<li>Seller inactivity causes Software/Manna-Network to automatically transfers credits to buyer at expiration of second contractual time limit period</li>
</ol>
</li>
</ol>
</li>
</ol>



<p style='text-align:left;' >
* Manna-Network will also redeem them for Bitcoin
<br>
**  The false deposit report initiates arbitration causing automatic continuation of the freeze on credits (i.e. sale is still pending/buyer hasn't received advertising credits/Bitcoin yet). An arbitration fee may be applied depending upon which arbitration service the users agree to. In the event the buyer and seller cannot agree on an arbitrator then Manna-Network can appoint one.
</p>

<form name=\"test\" action=\"". htmlentities($_SERVER['PHP_SELF'])."\" method=\"post\">
<input type=\"hidden\" name=\"link_selected\" value=\"".$link_selected."\">
</td></tr>
<tr><td><h1>BUY/SELL ADVERTISING CREDITS FORMS</h1>";



$msg .="
<H2>SELLERS</h2>
<ul>
<li><a href='instructions.php?action=seller'>View Instructions </a></li>
<li><a href='termsofservice.php?action=seller'>View Terms Of Service </a></li>
<li><a href='offer.php'>Offer Advertising Credits \"For Sale\"</a>

<ul>
<li><a href='rud_seller.php'>View/Edit/Cancel/Transfer Current Offers</a></li>
</ul>



</li>
<!--<li><a href='counteroffer.php?action=seller'>Respond To A Counter Offer Made By A Buyer</a></li>-->
<li><a href='arbitration.php?action=seller'>Report A False Deposit Report On The Buyer/Force Arbitration</a></li>
</ul>



</td></tr>
<tr><td>&nbsp;
</td></tr>
<tr><td>
";
$msg .="
 </td></tr>
<tr><td>&nbsp;
</td></tr>
<tr><td>



</form>
</td></tr></table>

";







echo $msg;
echo '<a href="../members/index.php"> <h2><u>Return To User Control Panel</u></h2></a>';
echo '<a href="'.dirname(__DIR__, 4).'/index.php"> <h2><u>Return To User Control Panel</u></h2></a></div>';




