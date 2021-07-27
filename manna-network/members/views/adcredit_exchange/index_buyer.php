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




$moniker="<h5>Advertising Credit Buyer Guide</h5>";
$body_width="wide";
include('../../960top.php');
include('user_cpanel_submenu.php');
include('exchange_buyer_submenu.php');

?>
<!-- #################   Add page content here   ####################   -->   
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
<p class=\"smallerFont\" >The processes and links listed below enable BungeeBones users to safely and securely buy Advertising Credits directly from BungeeBones' Members. The process is designed to be completely initiated and operated by users on each side of the transaction (i.e. by BungeeBones' sellers and buyers) using the BungeeBones.com website.

<h2>The Process</h2>
<ol style = \"font-size: larger;\">
<li> Provides sellers an alternate way to liquidate their Advertising Credits* to users that need them </li>
<li>Provides sellers a location (called the \"Market Bulletin\") for them to list their advertising credits as \"for sale\".</li>

<li>Provides an automatic software service that helps insure the buyer that the seller 1) owns the Advertising Credits* they are offering for sale and 2) they will receive them (after paying the seller)</li>

<li>Functions like an automatic software escrow service between buyer and seller
<ol><li>Seller establishes quantity for sale</li>
<li>Seller sets the price (either fixed price/ask price or market order)</li>
<li>Seller sets two time limits for the performance of various steps</li>
<li>Buyer accepts the seller's terms (causes temporary freeze on offered credits and initiates first timer for buyer to make cash deposit to seller's bank)</li>
<li>Buyer makes deposit and reports it to seller and BungeeBones (which initiates second timer for seller to verify deposit and to transfer credits to the buyer)</li>
<li><u><b>The SELLER'S actions (or inaction) causes one of the following 3 events to occur</b></u>
<ol>
<li>Seller verifies cash deposit and transfers credits to buyer themself OR </li>
<li>Seller inactivity causes Software/BungeeBones to automatically transfers credits to buyer at expiration of second time limit period  OR</li>
<li>Seller checks for deposit, finds none has been made and reports false deposit report to BungeeBones**</li>
</ol>
</li>
</ol>
</li>
</ol>



<p class=\"smallerFont\" >
* BungeeBones will also redeem them for Bitcoin
<br>
**  The false deposit report initiates an automatic continuation of the freeze on the credits in question (i.e. sale is still pending/buyer hasn't received advertising credits yet). Since the default action is to transfer the credits automatically to a buyer upon the seller's inaction it is usually the seller who is the initiator of an arbitration process along with a claim the deposit was never received. See the Arbitration link in the top menu for more information.
</p>

<form name=\"test\" action=\"". htmlentities($_SERVER['PHP_SELF'])."\" method=\"post\">
<input type=\"hidden\" name=\"link_selected\" value=\"".$link_selected."\">
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
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Main Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a></div>';


include("../../960bottom.php");


} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

