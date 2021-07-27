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
$listing_selected = $_GET['listing_selected'];
$listing_id = $_POST['listing_id'];//from form
include($_SERVER['DOCUMENT_ROOT']."/members/template_topy.php");
?>
<div style="text-align: center;">
		<a href="http://bungeebones.com/members/index.php?BB_user_id=<? echo $user_id; ?>" class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;
		<a href="http://bungeebones.com/members/overview.php?BB_user_id=<? echo $user_id; ?>" class="cssbutton sample a"><span>Overview</span></a>&nbsp;
		<a href="http://bungeebones.com/members/reg_form" class="cssbutton sample a"><span>Add Link</span></a>&nbsp;
		<a href="http://bungeebones.com/members/bitcoin.php?BB_user_id=<? echo $user_id; ?>" class="cssbutton sample a"><span>Add Funds</span></a>&nbsp;
	     <a href="http://bungeebones.com/members/update_user.php" class="cssbutton sample a"><span> Your Profile </span></a>&nbsp;<a href="http://bungeebones.com/feedback.php" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="http://www.bungeebones.com/index.php?option=com_content&view=article&id=5:bungeebones-terms-of-service&catid=25:the-project&Itemid=2" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="http://bungeebones.com/members/index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
		</div>
<div>&nbsp;</div>



<?

$msg="";
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

print_r($_POST);
$quantity = $_POST['num_credits_4sale']; 
$price = $_POST['price_credits_4sale']; 
$currency = $_POST['currency']; 
$buyertimelimit = $_POST['time_period_buyer'];
$sellertimelimit = $_POST['time_period_seller']; 
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
include('../../classes/ad_credit_exchange_class.php');
$adCreditExchange = new adCreditExchange;
if($bank_acct_num != ""){
$depofo = $adCreditExchange->add_depofo($encrypted, $encrypted2);
}
else
{
$depofo = 0;
}
$byr_or_sllr = 'buyer';
date_default_timezone_set('America/New_York');
$time = date('Y-m-d H:i:s');
$adCreditExchange->add_counteroffer($listing_id, $byr_or_sllr, $user_id, $time, $quantity, $price, $buyertimelimit, $sellertimelimit, $user_ip);
echo '<br>&nbsp;<br><h1 style="color:red">The posting of your listing has been successful. It should now be displayed in the <a href="listings_buyer.php">Market Bulletin Page</a></h1><br>&nbsp;<br>';
unset($submit, $listing_id, $byr_or_sllr, $offerers_user_id, $timestampInit, $qauntity, $price, $buyertimelimit, $sellertimelimit, $user_ip);
$time_period_buyer = "Choose";
$time_period_seller = "Choose";

echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
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
include('../../classes/ad_credit_exchange_class.php');
$adCreditExchange = new adCreditExchange;


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
$msgB1 = "<table style = \"margin-left:auto; 
    margin-right:auto;\" bgcolor=\"white\" width=\"75%\">
<form name=\"test\" action=\"". htmlentities($_SERVER['PHP_SELF'])."\" method=\"post\">
";

$msgB1 .= "<input type='hidden' name = 'listing_id' value ='".$_POST['listing_id']."'>";
$msgB1 .= "<input type='hidden' name = 'num_credits_4sale' value ='".$num_credits_4sale."'><h2>You want to purchase ";
$msgB1 .= $num_credits_4sale;
$msgB1 .= ' Advertising Credits</h2>';
 
$msgB1 .= "<input type='hidden' name = 'price_credits_4sale' value ='".$price_credits_4sale."'>Paying "; 
$msgB1 .= $price_credits_4sale;
if($price_credits_4sale !=""){
$total = $num_credits_4sale * $price_credits_4sale;
$currency = $currency;
$msgB1 .= " per each Advertising Credit for a total due of $total $currency</h2>";
}
else
{
$msgB1 .= " at whatever the market price is at the time the buyer purchases (based on the Bitstamp price average at that time).</h2>";
}
$msgB1 .= "<input type='hidden' name = 'market_ordertoserver' value ='".$market_ordertoserver."'>"; 
$msgB1 .= "<input type='hidden' name = 'currency' value ='".$currency."'>";
$msgB1 .= "<h2>You will deposit that amount of <b>cash</b> to the seller's bank \"";

$msgB1 .= $bank_name;
 $msgB1 .= "\" and in " .$currency.". You are responsible to locate a branch near you and you gave yourself enough time to get there, make the deposit, and MAKE THE REPORT of the deposit. If accepted by the seller (and In consideration of your promise to pay) the advertising credits will be removed from the market for the ".$time_period_buyer." minute time period you offered. Note: if you default in notifying BungeeBones of making the deposit within the designated time period then the credits will be returned to their \"for sale status\" immediately at its expiration.</h2>
<h1 style=\"color:red;\">IMPORTANT: If you make a deposit to the seller's bank and/or report after the allowed time then you do so at your own risk. BungeeBones will not re-imburse buyers who make late deposits or reports and will NOT intervene for the buyer with the seller for the honoring of the payment. It will be up to the buyer to contact the seller for restitution. That is why in all of these transactions TIME IS OF THE ESSENCE!"; 
$msgB1 .= "<input type='hidden' name = 'bank_acct_num' value ='".$bank_acct_num."'>"; 
$msgB1 .= "<input type='hidden' name = 'bank_acct_name' value ='".$bank_acct_name."'>"; 

$msgB1 .= "<h2>You will receive the seller's bank account number and the name associated with the account at your email address on record with BungeeBones.com if/when the seller accepts your counteroffer.";





$msgB1 .= "<input type='hidden' name = 'time_period_buyer' value ='".$time_period_buyer."'>";
$msgB1 .= "<h2>You have given yourself<u> ".$time_period_buyer." minutes</u> after the seller accepts your counteroffer to make the cash deposit and file the report of the successful deposit to BungeeBones.com. If you fail to make a report of a successful deposit then the transaction will be automatically terminated and the credits will immediately be returned to their previous \"for sale\" state and under the control of the seller again. ";

$msgB1 .= "That timer starts immediately when they make their acceptance. You will receive the bank account deposit instructions (i.e. the account number and the name associated with it if supplied). You will have that much time to 1) make the cash deposit to the seller's bank account and 2) log in to the BungeeBones site and confirm the deposit. HINT: with a Smart Phone you could deposit the money and confirm the deposit conceivably within just a few minutes from the bank parking lot. With a laptop and a wifi hotspot near the bank it might only be slightly longer.<br><br>";


$msgB1 .= "<font color='red'>By accepting these terms you acknowledge that if the seller accepts your counteroffer then their advertising credits will be 'deep frozen' when you report the successful deposit (i.e. they cannot cancel the sale or transfer the credits). The seller's only recourse for a false deposit report will be to file for arbitration by BungeeBones administration. If that happens you will be asked to provide proof of the deposit. Be sure to retain the bank deposit receipt as it is your only means of proof. You might consider also getting a business card from the teller and/or a picture of yourself entering the bank, etc. You also acknowledge you read the complete terms of service and understand your responsibility to confirm the deposit yourself.</h2>.";
$msgB1 .= "<input type='hidden' name = 'time_period_seller' value ='".$time_period_seller."'>"; 
$msgB1 .= "<h2>You have offered the seller ".$time_period_seller." hours to confirm for themselves that you have made the deposit to their bank account. After that time the credits will be automatically and irreversibly transferred to you. It will be their last chance to detect and report a fraudulent report and to stop it.</h2>";
if($textarea != ""){
$msgB1 .= "<h1>You added the following notes to the ad ...</h1><p><i>".$textarea."</i></p>";
$msgB1 .= "<input type='hidden' name = 'textarea' value ='".$textarea."'>";

}

$msgB1 .= "<input type='hidden' name = 'user_ip' value ='".$user_ip."'>";
$msgB1 .= "<tr><td><h3>Your IP address has been recorded for reference</h3></td></tr>";
$msgB1 .= "<tr><td><h3>If ALL the above is correct READ the TERMS Of SERVICE and select the \"Submit\" button. Otherwise return to the previous form and correct the entries. <br><a href='../modal/termsofservice.php' title='General Instructions' rel='gb_page_center[640, 480]'><div style=\"background-image: url('images960/1x1tran.gif'); background-repeat: repeat-x; background-color: white; color:black; font-size:100%;-moz-border-radius: 15px;
		border-radius: 15px;text-align: center;\">&nbsp;(TERMS OF SERVICE)&nbsp;</div></a></h3>
</td></tr>";

$msgB1 .= "<tr><td align=\"center\"><input type=\"submit\" name=\"B1\" value=\"Submit Form\"><br>
</form>

</td></tr></table>";

echo $msgB1;
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';



exit();
}
else
{
if(isset($ERR)){
echo '<h1 style="color:red">You Have An Error Or Ommission In Your Form</h1><br>&nbsp;<br>';
}


if(isset($ERR2)){
echo '<h1 style="color:red">You Had BOTH An Asking Price And Market Order Selected ... You Must Choose One Or The Other.</h1><br>&nbsp;<br>';
}
}
}

$msg .= '<h1 align="center">Advertising Credits/AdCoins Counteroffer</h1> <br><table style = "margin-left:auto; 
    margin-right:auto;" bgcolor="gray" width="75%"><tr><td><p style="text-align:left; font-size: 125%;"> ';

$msg .=   "<tr><td><h3>Member To Member Advertising Credit (AdCoin) Exchange<a href='../modal/sell_how_many.php?#CA' title='General Instructions' rel='gb_page_center[640, 480]'><div style=\"background-image: url('images960/1x1tran.gif'); background-repeat: repeat-x; background-color: navy; color:white; font-size:100%;-moz-border-radius: 15px;
		border-radius: 15px;text-align: center;\">&nbsp;(READ MORE)&nbsp;</div></a></h3>
<p style=\"font-size:120%\" >You are about to make a counteroffer to all or part of an offer made by a BungeeBones member to sell advertising credits. Remember, each advertising credit is redeemable for 1 Bitcoin from BungeeBones. This exchange system enables users to, instead, get cash payments deposited to their own bank account by the buyer. Each section below walks you through different parts where you set the terms that must be met for the transaction to complete. 
<p style=\"font-size:120%\" >The Seller is under no obligation to accept your counteroffer or even to respond to it. If they do accept it then you (and they) will be considered bound to its terms. Failing to abide by the terms results in a public record of the breech on the BungeeBones.com website. 
 <p style=\"font-size:120%\" >If you decide to cancel the offer you can do so at any time before the seller has accepted your counteroffer. Be sure to read all the accompanying information and understand your rights and obligations.


</td></tr></table>";
include('../../classes/ad_credit_exchange_class.php');
$adCreditExchange = new adCreditExchange;

$list_info = $adCreditExchange->viewbylisting($listing_selected);

  foreach($list_info as $key=>$value){
foreach($value as $key=>$value2){

//look up depofo for each 
//assign to $depofo[bank_acctno] and $depofo[bank_acctname]
}
/*
quantity
price
market_order
currency
bank_name read only
buyertimelimit
sellertimelimit read only
textarea
*/



$msg .="<table style = \"margin-left:auto; 
    margin-right:auto;\" bgcolor=\"white\" width=\"75%\">
<form name=\"test\" action=\"". htmlentities($_SERVER['PHP_SELF'])."\" method=\"post\">
<input type=\"hidden\" name=\"listing_id\" value = \"".$listing_selected."\">
<tr><td><h2>Counter Offer To Listing Number ".$listing_selected."</h2></td></tr>
<tr><td><h3>Posted here are how many advertising credits are for sell and for how much. <br><a href='../modal/sell_how_many.php?#C1' title='General Instructions' rel='gb_page_center[640, 480]'><div style=\"background-image: url('images960/1x1tran.gif'); background-repeat: repeat-x; background-color: white; color:black; font-size:100%;-moz-border-radius: 15px;
		border-radius: 15px;text-align: center;\">&nbsp;(READ MORE)&nbsp;</div></a></h3>
</td></tr><tr><td>
<p>The Number Of Credits You Will Buy <input type='text' name='num_credits_4sale' value='".$value[quantity]."' size='5' ><BR>

<span class='error'> ". $num_credits_4saleErr."</span></td></tr><tr><td><hr><p>If you wish to change the offer price make change here or leave as-is";

require "../modal/btc_price/tickers/ticker_usd_btc_bitstamp.php";

/*if(!isset($value[price]  )){
$price_credits_4sale = $bitcoin_marketprice_usd;
$msg .=   "(The Default Price Entered Is The Current Bitstamp Bitcoin Price)";
}
else
{
$msg .=   "(The Current Bitstamp Price Is".$bitcoin_marketprice_usd.")";
}
*/
$msg .=   "<input type='text' name='price_credits_4sale' size='5' value='";
if($market_ordertoserver !="on"){
$msg .= $value[price] ;
}

$msg .=   "'>
<span class='error'> ". $price_credits_4saleErr."</span>
</td></tr><tr><td><p";

 if(!isset($value[price] )){

$msg .=   "style = 'color:red'";
}
$msg .=   ">OR Check Here If You Wish To Post It At The Market Price ** <input type='checkbox' name='market_ordertoserver'";

if($value[market_order] =="on"){
$msg .=" checked ";
}

$msg .="></p>
<p> * If you select \"Market Price\" your counteroffer will be be presented to the seller with the then current price at each page refresh . 
<p> ** The Market Price posted is only a \"nominal\" reference price for the seller because the price fluctuates. When the seller actually accepts the counteroffer then you and they will get the current and updated final purchase price.
</td></tr>
<tr><td><hr>
<p>The Currency Unit The Seller Selected Can Not Be Changed <input type='text' name='currency' size='3' value='".$value[currency]."'  readonly>
<span class='error'> ". $currencyErr."</span>
</td></tr>
<tr><td>

<h3>The Buyer Needs To Know The Name  <br><a href='../modal/bank_name.php?#C1' title='Bank Name' rel='gb_page_center[640, 480]'><div style=\"background-image: url('images960/1x1tran.gif'); background-repeat: repeat-x; background-color: navy; color:white; font-size:100%;-moz-border-radius: 15px;
		border-radius: 15px;text-align: center;\">&nbsp;(READ MORE)&nbsp;</div></a></h3>
</td></tr><tr><td>
<p>The Seller's Bank For Receiving Your Deposit Can Not Be Changed <input type='text' name='bank_name' value='".$value[bank_name]."' size='5' readonly>
<span class='error'> ". $bank_nameErr."</span>






</td></tr>
<tr><td>

<h3>By knowing the account number the time off the market can be greatly reduced <br><a href='../modal/bank_acct_num.php' title='Bank account Number' rel='gb_page_center[640, 480]'><div style=\"background-image: url('images960/1x1tran.gif'); background-repeat: repeat-x; background-color: navy; color:white; font-size:100%;-moz-border-radius: 15px;
		border-radius: 15px;text-align: center;\">&nbsp;(READ MORE)&nbsp;</div></a></h3>
</td></tr><tr><td>
<p><br>The Seller's Bank Account Number Will Be Provided To You If/When The Seller Accepts Your Counteroffer<input type='text' name='bank_acct_num' size = '30' value='' >
<p><br><br>The Name Associated With The Bank Account Number (optional, but strongly suggested may also be provided<br><input type='text' name='bank_acct_name' size = '30' value=''>
</td></tr>
<tr><td>
<p><br>Other Payment/Offer Instructions/Requirements.
<div align='center'>
<p><textarea name='textarea' rows='4' cols='50'>".$value[textarea]."</textarea>

";
$msg .="

</td></tr><tr><td><h1>In All These Time Settings <a href='http://legal-dictionary.thefreedictionary.com/Time+is+of+the+Essence' target='_blank' >TIME IS OF THE ESSENCE</a></h1></td></tr>
<tr><td><h3>Select how long of a time period (<i>after a the seller accepts the offer</i>) that you will have to make a cash deposit to the seller's bank account. <br><a href='../modal/sell_how_many.php?#C2' title='General Instructions' rel='gb_page_center[640, 480]'><div style=\"background-image: url('images960/1x1tran.gif'); background-repeat: repeat-x; background-color: navy; color:white; font-size:100%;-moz-border-radius: 15px;
		border-radius: 15px;text-align: center;\">&nbsp;(READ MORE)&nbsp;</div></a></h3>
<h2>The Seller Initially gave YOU ".$value[buyertimelimit]." minutes to make the deposit AND FILE THE ONLINE REPORT. You can counteroffer any length of time you wish. Tthe longer the time period the longer the seller's credits are tied up and off of the market (which is a negative for the seller).
<h2>The clock will start its countdown when the seller accepts your counteroffer. You will receive an email at that point. </h2>

</td></tr><tr><td>

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
</td></tr>
<tr><td>
";

$msg .="

</td></tr>
<tr><td><h3>Select how long of a time period (<i>after YOU report the successful cash deposit to the seller's bank account</i>) that THEY WILL HAVE to verify the deposit and possibly block the transfer of the advertising credits to YOUR account through an arbitration request. <br><a href='../modal/sell_how_many.php?#C3' title='General Instructions' rel='gb_page_center[640, 480]'><div style=\"background-image: url('images960/1x1tran.gif'); background-repeat: repeat-x; background-color: navy; color:white; font-size:100%;-moz-border-radius: 15px;
		border-radius: 15px;text-align: center;\">&nbsp;(READ MORE)&nbsp;</div></a></h3> 
</td></tr><tr><td>
<h2>This time period is given for the seller to verify the deposit was, in fact, made and for the proper amount. They can submit the transaction for arbitration and stop it during this time period and the credits will then remain frozen pending arbitration. The shorter the time period the riskier it is for the seller. The credits are frozen during this time and there is no possibility of loss to the buyer at this point (apart from an arbitration freeze).</h2>
<h2><u>The Seller Initially gave themselves ".$value[sellertimelimit]." hours </u>to verify your deposit AND TO FILE an arbitration request if deficient (effectively blocking the automatic transfer of the advertising credits to your BungeeBones account).</h2>



<h2>Select how long of a time period (<i>after YOU report your successful deposit to the seller's bank account</i>) that YOU WANT THE SELLER TO HAVE to complete the transfer the advertising credits to your BungeeBones account. 

<h2>IMPORTANT: If, after you pay and report the deposit, that time period elapses without any response from the seller the advertising credits will be automatically transferred to your BungeeBones account within a few minutes of expiration (but the seller can manually transfer them to you earlier). </h2>
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

<tr><td>";
//echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
//echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';



$msg .="
 </td></tr>
<tr><td>



<input type=\"submit\" name=\"A1\" value=\"Submit Form\"><br>
</form>
</td></tr></table>
";
}//close outer foreach
echo $msg;
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';


include($_SERVER['DOCUMENT_ROOT']."/members/templatebottomnsb.php");


} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

