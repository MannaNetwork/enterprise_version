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
$user_email = $_SESSION['user_email'];

$moniker="<h5>Offer Your AdCoin Credits For Sale</h5>";
$body_width="wide";
include("../../960top.php");
include('user_cpanel_submenu.php');

$msg="";
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


$num_credits_4sale = $_POST['num_credits_4sale']; 
$price_credits_4sale = $_POST['price_credits_4sale']; 
$market_ordertoserver = $_POST['market_ordertoserver']; 
$currency = "testcoin";//$_POST['currency']; 
$time_period_buyer = $_POST['time_period_buyer'];
$time_period_seller = $_POST['time_period_seller']; 
$bank_name = "Mock TestNet Bank";//$_POST['bank_name']; 
$bank_acct_num = "18005551212";//$_POST['bank_acct_num'];
$bank_acct_name = $_POST['bank_acct_name'];
$user_ip = $_POST['user_ip'];
$textarea = $_POST['textarea'];

if (isset($_POST['B1'])) {
//$username = $_GET['username'];

if($bank_acct_num != ""){
$key = 'Google';
$string = $bank_acct_num; 
$string2 = $bank_acct_name;
$iv = mcrypt_create_iv(
    mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC),
    MCRYPT_DEV_URANDOM
);

//To Encrypt:

$encrypted = base64_encode(
    $iv .
    mcrypt_encrypt(
        MCRYPT_RIJNDAEL_256,
        hash('sha256', $key, true),
        $string,
        MCRYPT_MODE_CBC,
        $iv
    )
);

$encrypted2 = base64_encode(
    $iv .
    mcrypt_encrypt(
        MCRYPT_RIJNDAEL_256,
        hash('sha256', $key, true),
        $string2,
        MCRYPT_MODE_CBC,
        $iv
    )
);
//To Decrypt:

$data = base64_decode($encrypted);
$data2 = base64_decode($encrypted2);
$iv = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC));
$iv2 = substr($data2, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC));

$decrypted = rtrim(
    mcrypt_decrypt(
        MCRYPT_RIJNDAEL_256,
        hash('sha256', $key, true),
        substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)),
        MCRYPT_MODE_CBC,
        $iv
    ),
    "\0"
);
$decrypted2 = rtrim(
    mcrypt_decrypt(
        MCRYPT_RIJNDAEL_256,
        hash('sha256', $key, true),
        substr($data2, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)),
        MCRYPT_MODE_CBC,
        $iv2
    ),
    "\0"
);
/*
//Demo at IDEOne.com:

echo 'Encrypted:' . "\n";
var_dump($encrypted); // "ey7zu5zBqJB0rGtIn5UB1xG03efyCp+KSNR4/GAv14w="

echo "\n";

echo 'Decrypted:' . "\n";
var_dump($decrypted); // " string to be encrypted "



echo 'Encrypted2:' . "\n";
var_dump($encrypted2); // "ey7zu5zBqJB0rGtIn5UB1xG03efyCp+KSNR4/GAv14w="

echo "\n";

echo 'Decrypted2:' . "\n";
var_dump($decrypted2); // " string to be encrypted "

*/
//name of new table depofo
}
include($_SERVER['DOCUMENT_ROOT']."/classes/ad_credit_exchange_class.php");
$adCreditExchange = new adCreditExchange;
if($bank_acct_num != ""){
$depofo = $adCreditExchange->add_depofo($encrypted, $encrypted2);
}
else
{
$depofo = 0;
}
$adCreditExchange->add_listing($num_credits_4sale, $price_credits_4sale, $market_ordertoserver, $currency, $time_period_buyer, $time_period_seller, "offered", $textarea, $bank_name, $depofo, $_SESSION['user_id'], $user_ip);
echo '<br>&nbsp;<br><h1 style="color:red">The posting of your listing has been successful. It should now be displayed in the <a href="listings_buyer.php">Market Bulletin Page</a></h1><br>&nbsp;<br>';
unset($submit, $num_credits_4sale, $price_credits_4sale,  $market_ordertoserver, $currency, $time_period_buyer, $time_period_seller, $bank_name, $bank_acct_num, $user_ip);
$time_period_buyer = "Choose";
$time_period_seller = "Choose";

echo '<a href="index_seller.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';


exit();
}
elseif (isset($_POST['A1'])) {
unset($ERR);
unset($ERR2);
 if (empty($num_credits_4sale)) {
    $num_credits_4saleErr = "<font color='red'> <br>number of credits 4sale is required";
$ERR = 'true';
  } else {
    $num_credits_4sale = test_input($num_credits_4sale);
  }
//check if the seller has enough credits to sell what they posted
include($_SERVER['DOCUMENT_ROOT']."/classes/ad_credit_exchange_class.php");
$adCreditExchange = new adCreditExchange;

$balance_array = $adCreditExchange->getUsersPriceSlotBalance($user_id);
foreach($balance_array as $key=>$value){
$balance = $value['tn_balance'];
}
$balance = number_format($balance, 8, '.', '');

$status = 'offered';
$get_frozen_offered = $adCreditExchange->check_balance($user_id, $status);

$status = 'accepted';
$get_frozen_accepted = $adCreditExchange->check_balance($user_id, $status);

$msg .= '<div><h1 align="center">Selling Your Advertising Credits For Cash</h1> <br><table style = "margin-left:auto; 
    margin-right:auto;" bgcolor="gray" width="75%"><tr><td><p style="text-align:left; font-size: 125%;"> ';
$testall = $balance - $get_frozen_accepted - $get_frozen_offered -$num_credits_4sale;

if($balance - $get_frozen_accepted-$num_credits_4sale < 0 AND $get_frozen_offered == ""){
$grand_tot = $balance - $get_frozen_accepted;
echo "<div><h1>Sorry! You Do Not Have Enough Advertising Credits Left To Sell That Many.</h1>
Your beginning balance was  $balance but
<p class='smallerFont' >you have $get_frozen_accepted Advertising Credits That A Buyer Is Purchasing And Are About To Be Transferred.
<p class='smallerFont' >You would be able to sell $grand_tot credits";
echo '<a href="index_seller.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';

echo "</div>";

exit();
}
elseif($balance - $get_frozen_offered-$num_credits_4sale < 0 AND $get_frozen_accepted == ""){
$grand_tot = $balance - $get_frozen_offered;
echo"<div><h1>Sorry! You Do Not Have Enough Additional Advertising Credits Left To Sell That Many.</h1>
Your beginning balance was  $balance but
<p class='smallerFont' >You have $get_frozen_offered Advertising Credits That Are Currently Offered For Sale.
<p class='smallerFont' >You could offer an additional $grand_tot credits or you could cancel the existing listings and make a consolidated offer of $balance credits.";
echo '<a href="index_seller.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';

echo "</div>";
exit();
}
elseif($balance - $get_frozen_accepted - $get_frozen_offered -$num_credits_4sale< 0 ){
echo "<div><h1>Sorry! You Do Not Have Enough Advertising Credits Left To Sell That Many (You Have Sold Some, The Rest Are Already Listed For Sale).</h1>";
$grand_tot = $balance-$get_frozen_accepted-$get_frozen_offered;
echo "<p class='smallerFont' >You had a balance of $balance;
<p class='smallerFont' >$get_frozen_accepted of those are in the process of being purchased and are about to be transferred
<p class='smallerFont' >$get_frozen_offered are being offered for sale.
<p class='smallerFont' > That means you would have an additional $grand_tot available to sell.";
echo '<a href="index_seller.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';

echo "</div>";
exit();
}




if($market_ordertoserver != "on" AND !empty($price_credits_4sale)) {
}
	if ( $market_ordertoserver != "on" AND empty($price_credits_4sale)) 
	{
	    $price_credits_4saleErr = "<font color='red'> <br>Either Set A Price";
	$ERR = 'true';
	  } 
	elseif ( $market_ordertoserver == "on" AND !empty($price_credits_4sale))
	{
	$ERR2 = 'true';
$market_ordertoserver = "on";
	  } 
else
	{//one, or the other are checked
			if($market_ordertoserver != "on" AND !empty($price_credits_4sale))
 {
//must have a correctly entered price
  $price_credits_4sale = test_input($price_credits_4sale);
			$market_ordertoserver = "0";
			  }
			elseif ( $market_ordertoserver == "on" AND !empty($price_credits_4sale)) //they have BOTH amount and have market order checked
			{
			$ERR2 = 'true';
			}
			else //must be a correctly entered market order (price is empty, check box is checked and only check box is checked
			{
			$market_ordertoserver = "1";

			}

	}

if (empty($currency) ) {

    $currencyErr = "<font color='red'> <br>Enter the three charcter \"NAME\" of your currency (example USD)";
$ERR = 'true';
  } else {
    $currency = test_input($currency);
  }

if (empty($bank_name) ) {

    $bank_nameErr = "<font color='red'> <br>Enter the \"NAME\" of your bank (example Bank Of America, Chase, etc.) so that a buyer can determine if there is a branch near them.";
$ERR = 'true';
  } else {
    $bank_name = test_input($bank_name);
  }
if (empty($bank_acct_num) ) {

    $bank_acct_numErr = "<font color='red'> <br>Enter your bank account \"NUMBER\". This is on the bottom of every check and is already publicly distributed by you. We only make it available to a buyer after they have agreed to purchase the advertising credits.";
$ERR = 'true';
  } else {
    $$bank_acct_num = test_input($bank_acct_num);
  }



 if ($time_period_buyer == "Choose") {
    $time_period_buyerErr = "<font color='red'> <br>Setting a time limit for buyer deposit & response is required";
$ERR = 'true';
  } else {
    $time_period_buyer = test_input($time_period_buyer);
  }

if ($time_period_seller == "Choose") {
    $time_period_sellerErr = "<font color='red'> <br>Setting a time limit for your transfer of credits after the buyer's response is required";
$ERR = 'true';
  } else {
    $time_period_seller = test_input($time_period_seller);
  }

/*if (empty($bank_name)) {
    $bank_nameErr = "<font color='red'> <br>A bank_name is required";
$ERR = 'true';
  } else {
    $bank_name = test_input($bank_name);
  }
echo '<br>just before post ERR = ', $ERR;
echo ' and $ERR2 = ', $ERR2;
*/

if(!isset($ERR) AND !isset($ERR2)){

//need to add a confirmation form here.
//name it B1
//up above all the error controls put an if isset B! and move the actual submit and report in this section there



//place form named B1 here
$msgB1 = "<table id='member' ><tr><td><h2>Review Your Offer To Sell Your Ad Credits</h2></td></tr>
<form name=\"test\" action=\"". htmlentities($_SERVER['PHP_SELF'])."\" method=\"post\">
";
$msgB1 .= "<input type='hidden' name = 'num_credits_4sale' value ='".$num_credits_4sale."'>
<tr><td><p class='smallerFont'>You want to offer <b>";
$msgB1 .= $num_credits_4sale;
$msgB1 .= ' Advertising Credits </b>for sale at <b>a price of ';
 
$msgB1 .= "<input type='hidden' name = 'price_credits_4sale' value ='".$price_credits_4sale."'>"; 
$msgB1 .= $price_credits_4sale;
if($price_credits_4sale !=""){
$total = $num_credits_4sale * $price_credits_4sale;
$currency = $currency;
$msgB1 .= " per each Advertising Credit</b> for <b>a total due by the buyer of $total $currency</b></p></td></tr>";
}
else
{
$msgB1 .= " <b>at whatever the market price is</b> at the time the buyer purchases (based on the Bitstamp price average at that time).</p></td></tr>";
}
$msgB1 .= "<input type='hidden' name = 'market_ordertoserver' value ='".$market_ordertoserver."'>"; 
$msgB1 .= "<input type='hidden' name = 'currency' value ='".$currency."'>";
$msgB1 .= "<tr><td><p class='smallerFont'>You require that the money be deposited to <b>your bank \"";

$msgB1 .= $bank_name;
 $msgB1 .= "\" as cash and in " .$currency."</b>. The buyer will use that information to locate a branch near them. Hopefully they will do so before they commit to buying your Advertising Credits but you acknowledge <b>their acceptance will remove them from the market for the ".$time_period_buyer." minute time period you designated.</b> Note: if they default in notifying BungeeBones of making the deposit within the designated time period then the credits will be returned to their \"for sale status\" immediately at its expiration</p>"; 
$msgB1 .= "<input type='hidden' name = 'bank_acct_num' value ='".$bank_acct_num."'>"; 
$msgB1 .= "<input type='hidden' name = 'bank_acct_name' value ='".$bank_acct_name."'>"; 
if($bank_acct_num !=""){
$msgB1 .= "<tr><td><p class='smallerFont'>You have supplied <b>your bank account number - ". $bank_acct_num;
if($bank_acct_name !=""){
$msgB1 .= "<br> and the name associated with the account - ". $bank_acct_name;
}
else
{
$msgB1 .= "<br><br> but NOT the name associated with the account. This increases the chance of ERROR. TRIPLE CHECK the account number and you accept the responsibilty of a deposit error because of a \"typo\". Plus, it may cause problems with the bank teller and possibly prevent a deposit being made.";
}
$msgB1 .= "</b></td></tr>  <tr><td><p class='smallerFont'> By doing so you agree:
<ul><li>To authorize BungeeBones.com to release said account number and/or name to a perspective buyer when they commit to buying your advertising credits</li>
<li>To hold Bungeebones harmless for any results or damages you suffer by doing so.</li>
</ul>";
}
else
{
$msgB1 .= "<tr><td><p class='smallerFont' style='color:red;'>You have NOT supplied your bank account number and/or name. Your offer cannot be processed because the buyer would NOT be able to make a deposit. Use the browser's \"Back\" Button to return and correct the entry.";
echo $msgB1;

echo '<a href="index_seller.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
echo '<a href="/members/index.php"> <h2><u>Return To User Control Panel</u></h2></a></div>';

include("../../960bottom.php");
exit();

}

$msgB1 .= "<input type='hidden' name = 'time_period_buyer' value ='".$time_period_buyer."'>";
$msgB1 .= "<p class='smallerFont'><b>You have given the buyer ".$time_period_buyer." minutes </b>from the time they select your offer and agree to purchase it to the time they actually make the cash deposit to your bank and for them to also report back to BungeeBones (with said report being forwarded immediately to your email address on record at BungeeBones) or the transaction will be automatically terminated and your credits will immediately be returned to your control in their previous \"for sale\" status. ";

$msgB1 .= "<p class='smallerFont'>That timer starts immediately when they make their acceptance from the BungeeBones.com website. They will receive your bank account deposit instructions AT THAT TIME (i.e. the account number and the name associated with it if supplied). The buyer will have the amount of time you specify here to 1) make the cash deposit to your bank account and 2) log back in to the BungeeBones.com website and confirm the that the deposit has been made. Note that with a Smart Phone the buyer could conceivably accept your offer using the Internet from the bank lobby (or drive thru), deposit the money and confirm the deposit all within five minutes so it is recommended not to leave the buyer too long a window to complete their deposit since your funds are frozen and essentially \"off the market\" while waiting for the buyer's deposit (which may or may not occur and is outside our control). <br><br>";



$msgB1 .= "<p class='smallerFont' style=' color:red;'>By accepting these terms you acknowledge that if/when a buyer accepts your offer then those advertising credits will be 'frozen' and you will not have access to edit the transaction nor be able to cancel the transaction AT LEAST for that 1st time period you designated (to allow the buyer time to make the deposit). 
<p class='smallerFont' style=' color:red;'><b>You also affirm that the following email address: <u>$user_email </u>

is a working and functional address that you have access to</b> and that it will be sole means by which you will be notified of the buyer's purported successful deposit to your account. It will be your sole means of receiving notice that the 2nd time period provided for you has commenced. You acknowledge that you are solely and 100% responsible to check your email for the notice and for checking that the deposit has, indeed, been made.




<p class='smallerFont' style=' color:red;'>You also acknowledge you have given yourself enough time after the buyer sends you notice of the deposit (i.e. the 2nd time period you designate) to verify that they did, indeed, make such a deposit. By submitting this offer to sell your advertising credits you also acknowledge that you have read the complete terms of service and understand your responsibility to confirm the deposit yourself (otherwise the funds will be transferred automatically and irreversibly)</p>.";
$msgB1 .= "<input type='hidden' name = 'time_period_seller' value ='".$time_period_seller."'>"; 
$msgB1 .= "<p class='smallerFont'><b>You have given yourself ".$time_period_seller." hours to confirm that the deposit to your bank account has been made </b>and that, after said time, the credits will be automatically and irreversibly transferred to the buyer. It is <b>your</b> responsibility during this time to verify that a buyer's reported deposit has indeed been made. It will be your last chance to detect and file for arbitration and to stop it. Once you confirm the deposit has been made, however, you can release the ad credits to the buyer early, yourself, with one easy click. 


";
$msgB1 .= "<p class='smallerFont'><b>You have entered ". $bank_name." as your bank name.</b> ";
if($textarea != ""){
$msgB1 .= "<p class='smallerFont'>You added the following notes to the ad ...</h1><p class='smallerFont' ><i>".$textarea."</i></p>";
$msgB1 .= "<input type='hidden' name = 'textarea' value ='".$textarea."'>";

}
$msgB1 .= "<input type='hidden' name = 'bank_name' value ='".$bank_name."'>"; 

$msgB1 .= "<input type='hidden' name = 'user_ip' value ='".$user_ip."'>";
$msgB1 .= "<tr><td><h3>If ALL the above is correct READ the TERMS Of SERVICE and select the \"Submit\" button. Otherwise return to the previous form and correct the entries. <br><a href='../modal/termsofservice.php' title='General Instructions' rel='gb_page_center[640, 480]'><div style=\"background-image: url('images960/1x1tran.gif'); background-repeat: repeat-x; background-color: white; color:black; font-size:100%;-moz-border-radius: 15px;
		border-radius: 15px;text-align: center;\">&nbsp;(TERMS OF SERVICE)&nbsp;</div></a></h3>
</td></tr>";

$msgB1 .= "<tr><td align=\"center\"><input type=\"submit\" name=\"B1\" value=\"Submit Form\"><br>
</form>

</td></tr></table>";

echo $msgB1;
echo '<a href="index_seller.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';



exit();
}
else
{
if(isset($ERR)){
echo '<h1 style="color:red">You Have An Error Or Omission In Your Form</h1><br>&nbsp;<br>';
}


if(isset($ERR2)){
echo '<h1 style="color:red">You Had BOTH An Asking Price And Market Order Selected ... You Must Choose One Or The Other.</h1><br>&nbsp;<br>';
}
}
}

$msg .= '<h1 style = "text-align:center;">Selling Your Advertising Credits For Cash</h1> <br>
<table id="member"><tr><td><p style="text-align:left; font-size: 125%;"> ';

$msg .=   "<h3  style = 'text-align:center;'>Overview Of The BungeeBones Peer To Peer Advertising Credit/Pseudo Bitcoin Exchange</h3>
<table id='member'><tr><td><p style=\"font-size:110%; text-align:left;\" >You are about to offer all or part of your advertising credits For Sale to other BungeeBones members. Remember, each advertising credit is redeemable for 1 Bitcoin from BungeeBones but, in addition, this system enables you to instead get cash payments deposited to your own bank account by the buyer. Each section below lets you set the terms that must be met for the transaction to complete. Afterward, you will be presented a confirmation page and once approved by you then those advertising credits will become \"frozen\" and you will not be able to use them for your own advertising nor be able to redeem them for Bitcoin. If, however, you decide to remove them from the market any time <b>before anyone has accepted your offer</b> then you can easily do so and they will be \"unfrozen\" and available again to you.
<h3  style = 'text-align:center; font-size:smaller;'><a href='../modal/get_balance_tn.php' title='Get Your Current TestCoin Balance' rel='gb_page_center[640, 480]'><div style=\" margin: 0 auto; width:185px; background-image: url('images960/1x1tran.gif'); background-repeat: repeat-x; background-color: navy; color:white; font-size:100%;-moz-border-radius: 15px;
		border-radius: 15px;text-align: center;\">&nbsp; Get TestCoin Balance &nbsp;</div></a></h3>
</td></tr></table>
<table style = \"margin-left:auto; 
    margin-right:auto;\" bgcolor=\"white\" width=\"95%\">
<form name=\"test\" action=\"". htmlentities($_SERVER['PHP_SELF'])."\" method=\"post\">

<tr><td>
<p class='smallerFont' >Enter The Number Of Credits You Wish To GIVE AWAY</p></td><td><input type='text' name='num_credits_4sale' value='".$num_credits_4sale."' size='5'>

<span class='error'> ". $num_credits_4saleErr."</span></td></tr>
<tr><td><p class='smallerFont' >Enter The Price You Wish To Receive* ";

require "../modal/btc_price/tickers/ticker_usd_btc_bitstamp.php";

if(!isset($price_credits_4sale  )){
$price_credits_4sale = $bitcoin_marketprice_usd;
$msg .=   "(This is a DEMO and the credits will be given away! The Default Price Entered Is The Only Allowed Price)";
}
else
{
$msg .=   "(The Current Bitstamp Price Is".$bitcoin_marketprice_usd.")";
}

$msg .=   "</td><td><input type='text' name='price_credits_4sale' size='5' value='";
if($market_ordertoserver !="on"){
$msg .= "0.0000";
}

$msg .=   " ' readonly >
<span class='error'> ". $price_credits_4saleErr."</span>
</td></tr>

<tr><td><p class='smallerFont'";

 if(!isset($price_credits_4sale)){

$msg .=   "style = 'color:red'";
}
$msg .=   ">OR Check Here If You Wish To Post It At The Market Price ** </td><td><input type='checkbox' name='market_ordertoserver'";

if(market_ordertoserver =="on"){
$msg .=" checked ";
}

$msg .="></p></td></tr>

<tr><td colspan='2'>
<p class='smallerFont' > * If you select \"Market Price\" your offer will be posted with the then current price at each page refresh. 
<hr>
</td></tr>
<tr><td>
<p class='smallerFont' >Enter The Three Character \"NAME\" Of The Currency You Want To Get Paid In (examples USD, EUR, JPY etc) </td><td><input type='text' name='currency' size='3' value='".$currency."' readonly>
<span class='error'> ". $currencyErr."</span>
</td></tr>
<tr><td>
<p class='smallerFont' >Enter The Name Of Your Bank*</td><td><input type='text' name='bank_name' value='".$bank_name."'readonly size='5'>
<span class='error'> ". $bank_nameErr."</span>
</td></tr>

<tr><td colspan='2'><p class='smallerFont' > * This will be publicly displayed to all potential buyers so that they can determine if there is a branch of your bank near them.



<hr>

</td></tr>
<tr><td>
<p class='smallerFont' ><br>Enter Your Bank Account Number*</td><td><input type='text' name='bank_acct_num' size = '30' value='".$bank_acct_num."' readonly >
<span class='error'> ". $bank_acct_numErr."</span>
</td></tr>

<tr><td colspan='2'><p class='smallerFont' >*This is required in order for the buyer to be able to deposit cash to your account. The account number is on the bottom of your checks but will NOT be displayed publicly except to a buyer who has accepted your offer.
<hr>

</td></tr>
<tr><td>
<p class='smallerFont' >Enter The Name OF The Person Associated With The Bank Account Number (optional, but strongly suggested)*</td><td><input type='text' name='bank_acct_name' size = '30' value='".$bank_acct_name."'>
</td></tr>

<tr><td colspan='2'><p class='smallerFont' >*Giving the buyer the name associated with the account is recommended in case your bank asks for it during the deposit and because it also acts as a safety check to make certain the money gets deposited to the correct account. A seller is responsible for losses if due to them providing a wrong account number.
<hr>
</td></tr>
<tr><td>
<p class='smallerFont' ><br>Other Terms/Instructions/Requirements.
</td><td><textarea name='textarea' rows='4' cols='50'></textarea>

";
$msg .="

</td></tr><tr><td colspan='2'><h1>In BOTH Of These Following Time Settings <a href='http://legal-dictionary.thefreedictionary.com/Time+is+of+the+Essence' target='_blank' ><b><u>TIME IS OF THE ESSENCE</u></b></a></h1></td></tr>
<tr><td><h3>Select how long of a time period (<i>after a buyer accepts your offer</i>) that they will have to make a cash deposit to your bank account. 
</td><td>
<span class='error'> ". $time_period_buyerErr."</span>
<select name='time_period_buyer'>
<option value='15'";

if ($time_period_buyer == "15")
{
$msgtripper = '1';
$msg .=" selected ";
}
$msg .=">15 Min.</option>
<option value='30'";
if ($time_period_buyer == "30")
{
$msgtripper = '1';
$msg .=" selected ";
}
$msg .=">30 Min.</option>
<option value='45'";
if ($time_period_buyer == "45")
{
$msgtripper = '1';
$msg .=" selected ";
}
$msg .=">45 Min.</option>
<option value='60'";
if ($time_period_buyer == "60")
{
$msgtripper = '1';
$msg .=" selected ";
}
$msg .=">60 Min.</option>
<option value='120'";
if ($time_period_buyer == "120")
{
$msgtripper = '1';
$msg .=" selected ";
}
$msg .=">120 Min.</option>
<option value='Choose'";
if ($msgtripper != 1)
{
$msg .=" selected ";

}
$msg .=">Please Select</option>

</select>
<hr>
</td></tr>
<tr><td>
";

$msg .="

</td></tr>
<tr><td><h3>Select how long of a time period (<i>after a buyer reports their successful deposit to your account</i>) that YOU WILL HAVE to transfer the advertising credits to their account.
</td><td>
<span class='error'> ". $time_period_sellerErr."</span>";
$msg .="<select name='time_period_seller'><option value='.5'";
if ($time_period_seller == ".5")
{
$msgtripper = '1';
$msg .=" selected ";
}

$msg .=">30 Min.</option>
<option value='1'";
if ($time_period_seller == "1")
{
$msgtripper = '1';
$msg .=" selected ";
}

$msg .=">One Hour</option>
<option value='6'";
if ($time_period_seller == "6")
{
$msgtripper = '1';
$msg .=" selected ";
}

$msg .=">Six Hours</option>
<option value='12'";
if ($time_period_seller == "12")
{
$msgtripper = '1';
$msg .=" selected ";
}

$msg .=">Twelve Hours</option>
<option value='18'";
if ($time_period_seller == "18")
{
$msgtripper = '1';
$msg .=" selected ";
}

$msg .=">Eighteen Hours</option>
<option value='24'";
if ($time_period_seller == "24")
{
$msgtripper = '1';
$msg .=" selected ";
}

$msg .=">Twenty Four Hours</option>
<option value='Choose'";
if ($msgtripper != 1)
{

$msg .=" selected ";
}

$msg .=">Please select..</option> 
</select>
</td></tr>
<tr><td>
";
$msg .="




</td></tr>


<tr><td colspan='2'>



<input type=\"submit\" name=\"A1\" value=\"Submit Form\"><br>
</form>
</td></tr></table>
";

echo $msg;
echo '<a href="index_seller.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
echo '<a href="/members/index.php"> <h2><u>Return To User Control Panel</u></h2></a></div>';

include("../../960bottom.php");

} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

