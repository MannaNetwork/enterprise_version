<?

//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 


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




$moniker="<h5>The TestCoin/Advertising Credit Exchange & Market Bulletin</h5>";
$body_width="wide";
include('../../960top.php');
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
<p class=\"smallerFont\" >The links and processes listed below enable BungeeBones users that have Advertising Credits (acquired and held as TestCoin) in their account to offer them for FREE to other BungeeBones users. In other words this is a demo of how to use the BungeeBones.com software services as if they were selling REAL advertising credits (worth REAL BITCOIN) to users. The process is designed to be completely initiated and operated by users on each side of the transaction (i.e. by BungeeBones' sellers and buyers). In this Testnet based demo everything is the same as in the real version except the buyer won't be making a deposit or payment. Follow the instructions below as if the Testnet Coins were real will help you understand and practice the procedure.

<h2>The services BungeeBones offers</h2>
<ol>
<li> Provides sellers an alternate way to liquidate their Advertising Credits* to users that need them </li>
<li>Provides sellers a location (called the \"Market Bulletin\") for them to list their advertising credits as \"for sale\".</li>

<li>Provides an escrow service that guarantees (to the buyer) that the sellers 1) own the Advertising Credits* they are offering for sale and 2) they will receive them (after paying the seller)</li>

<li>Functions like an escrow service between buyer and seller and can function as an arbitrator if needed
<ol><li>Seller establishes quantity for sale</li>
<li>Seller sets the price (either fixed price/ask price or market order)</li>
<li>Seller sets two time limits for the performance of various steps</li>
<li>Buyer accepts the seller's terms (causes temporary freeze on offered credits and initiates first time limit for buyer to make cash deposit to seller's bank)</li>
<li>Buyer makes deposit and reports same to seller and BungeeBones (signaling their performance of sales contract terms and initiates second time limit for seller to verify deposit and to transfer credits to the buyer)</li>
<li><u><b>The SELLER'S actions (or inaction) causes one of the following 3 events to occur</b></u>
<ol>
<li>Seller verifies cash deposit and transfers credits to buyer themself OR </li>
<li>Seller checks for deposit, finds none has been made and reports false deposit report to BungeeBones** OR</li>
<li>Seller inactivity causes Software/BungeeBones to automatically transfers credits to buyer at expiration of second time limit period</li>
</ol>
</li>
</ol>
</li>
</ol>



<p style='text-align:left;' >
* BungeeBones will also redeem them for Bitcoin
<br>
**  The false deposit report initiates arbitration causing automatic continuation of the freeze on credits (i.e. sale is still pending/buyer hasn't received advertising credits/Bitcoin yet). A 10% arbitration fee will be applied to the seller if it is found that the buyers have, indeed, paid them.
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
<li><a href='offer_tn.php'>Offer Advertising Credits \"For Sale\"</a>

<ul>
<li><a href='rud_seller.php'>View/Edit/Cancel/Transfer Current Offers</a></li>
</ul>



</li>
<!--<li><a href='counteroffer_tn.php?action=seller'>Respond To A Counter Offer Made By A Buyer</a></li>-->
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
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a></div>';


include("../../960bottom.php");


} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

