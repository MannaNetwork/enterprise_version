<?
$phpself = basename(__FILE__);
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
require_once("../config/config.php");
require_once("../php-login.php");
$login = new Login();
if ($login->isUserLoggedIn() == true) {    
$user_id = $_SESSION['user_id'];
$moniker="<h5>The AdCoin/Advertising Credit Exchange & Market Bulletin</h5>";
$body_width="wide";
include('../../960top.php');
include('user_cpanel_submenu.php');
?>
<div id="smallerFont">
<p class="smallerFont" >

<?
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
<p class='smallerFont'>The links and processes listed below enable BungeeBones users that have Advertising Credits in their account to offer them for sale and for other members of BungeeBones.com to buy them. It is an automated system provided free of charge by BungeeBones.com to BungeeBones' users. BungeeBones is NOT a broker, NOR an escrow service, NOR an arbitration service. The process is designed to be completely initiated and operated by users on each side of the transaction themselves (i.e. by BungeeBones' sellers and buyers). The BungeeBones.com website software is merely a aid for the parties to follow but they set their own terms and conditions. 
<ul><li>Seller establishes quantity for sale</li>
<li>Seller sets the price (either fixed price/ask price or market order)</li>
<li>Seller sets two time limits for the performance of various steps (and time is of the essence)</li>
<li>Buyer accepts the seller's terms (which places an automatic but temporary freeze on the offered credits and starts the timer for the buyer to make a payment to the seller (cash deposit to seller's bank is recommended)</li>
<li>Buyer makes deposit and reports same to seller and BungeeBones (causes the automatic extension of the freeze and starts of second timer against the seller providing them time to verify the deposit)</li></ul>
<li>At the expiration of the second timer the ad credits are automatically transferred to the BUYER'S Bungeebones account</li>
<h2> The SELLER'S actions (or inaction) causes one of the following 3 events to occur</h2>
<ol style='font-size:16px'>
<li>Seller verifies that the cash deposit was made and transfers the credits to the buyer themself OR </li>
<li>Seller checks for the deposit, finds none has been made, and reports false deposit to BungeeBones** OR</li>
<li>Seller's inactivity causes Software/BungeeBones to automatically transfers credits to buyer at expiration of second time limit period</li>
</ol>
<h2>The Services BungeeBones Offers</h2>
<ol  style='font-size:16px'>
<li> Provides sellers an alternate way to liquidate their Advertising Credits for cash to users that want them to purchase advertising </li>
<li>Provides sellers a location (called the \"Market Bulletin\") for them to list their advertising credits \"for sale\".</li>
<li>Provides an automated software service that guarantees (to the buyer) that the seller 1) owns the Advertising Credits they are offering for sale and 2) provides timed, automatic \"freezes\" on the credits to help insure that they will receive them (after paying the seller)</li>
<li>Can function as a \"tie breaker\" vote for a third-party arbitrator (if needed)</li></ol>
<p class=\"smallerFont\" >
**  A false deposit report by the SELLER extends the freeze indefinitely pending the buyer and seller mutually agreeing to the release of the funds or until a third party arbitrator provides a decision.
</p>
<form name=\"test\" action=\"". htmlentities($_SERVER['PHP_SELF'])."\" method=\"post\">
<input type=\"hidden\" name=\"link_selected\" value=\"".$link_selected."\">
</td></tr>
<tr><td><h1>BUY/SELL ADVERTISING CREDITS LINKS</h1>";



$msg .="
<H2>SELLERS</h2>
<ul>
<li><a href='../adcredit_exchange_instructions.php?action=seller'>View Instructions </a></li>
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


$msg .="<H2>BUYERS</h2><ul>
<li><a href='instructions.php?action=buyer'>View Instructions - Buyer</a></li>
<li><a href='termsofservice.php?action=buyer'>View Terms Of Service - Buyer</a></li>
<li><a href='listings_buyer.php'>View/Buy Advertising Credits \"For Sale\"</a>
<ul>
<li><a href='rud_buyer.php'>View/Cancel/Report Payment/</a></li>
</ul>

</li>
<li><a href='buyerreport.php'>Report Your Deposit To The Buyer</a></li>
<li><a href='arbitration_buyer.php?action=buyer'>Respond To A False Deposit Report/Arbitration</a></li>
</ul></td></tr>";

$msg .=" </td></tr><tr><td>&nbsp;</td></tr><tr><td></form></td></tr></table>";
echo $msg;
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a></div>';
include("../../960bottom.php");
} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}
