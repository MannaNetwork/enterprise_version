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


$moniker="<h5>Reporting Your Successful Deposit</h5>";
$body_width="wide";
include("../../960top.php");
include('user_cpanel_submenu.php');
include('exchange_buyer_submenu.php');


if(isset($_POST['B1'])){


include($_SERVER['DOCUMENT_ROOT']."/classes/ad_credit_exchange_class.php");
$adCreditExchange = new adCreditExchange;
$listing_id = $_POST['listing_id'];
// check the listing to be sure it is not sold/still available/ not withdrawn
$checkthis = $adCreditExchange->viewbylisting($listing_id);
 foreach($checkthis as $key=>$value){
foreach($value as $key=>$value2){
//look up depofo for each 
//display $depofo[bank_acctno] and $depofo[bank_acctname] to buyer
}
$depofo_info = $adCreditExchange->get_depofo_numbers($user_id, $listing_id );
if($value[timestampBuyerin] >0){
if($value[buyerid] == $user_id){
echo '<table id="member"><tr><td><p class="smallerFont"><h1 style ="color:red">Attention - This is a report of demo sale of Testnet Coin that you listed on the BungeeBones website. Everything is reported to you as if it was a sale of real Advertising Credits (redeemabale for Bitcoin) instead of just Testcoins (with no monetary value).</h1>
<p class="smallerFont">Hello from BungeeBones Admin.<h1 style="text-align:left;">Your REPORT of a deposit has been received. The seller has been notified. The email that was sent to the seller is listed below for your reference. The seller has '.$value[sellertimelimit].' hours to confirm the deposit or it will be transferred automatically at that time (barring an arbitration freeze initiated by the seller). Use the listing # '.$listing_id .' whenever you refer to this transaction.';
$status = 'reported';
$adCreditExchange->update_listing_status($listing_id, $status);
$user_email = $adCreditExchange->getUsersEmail($value[sellerid]);


include('report_email_online_display.php');//this is a made for internet copy - the actual email sent is at report_email.php
//edit them both when making changes
echo '</h1></td></tr></table></td></tr></table>';

echo '<a href="index_buyer.php"> <h2><u>Return To Advertising Credit Exchange Buyer Menu</u></h2></a>';
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Main Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';


include("../../960bottom.php");

exit();

}
else
{
echo '<table style = "margin-left:auto; 
    margin-right:auto;" bgcolor="white" width="75%"><tr><td><table><tr><td><h1>Sorry, but it appears that those advertising Credits are no longer available. It could be that the owner has withdrawn them from the market or someone else bought them ahead of you. To verify this you should no longer see them listed for sale in the list (look for Offer ID '.$listing_id;
echo ").</h1></td></tr></table></td></tr></table>";

echo '<a href="index_buyer.php"> <h2><u>Return To Advertising Credit Exchange Buyer Menu</u></h2></a>';
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Main Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';


include("../../960bottom.php");

exit();
}
}
if($value[status] != "offered"){
//echo '<br>status should be offered - if not exit', $value[status];
//need to check timer here. The status would not have been changed simply because the time has expired

echo '<a href="index_buyer.php"> <h2><u>Return To Advertising Credit Exchange Buyer Menu</u></h2></a>';
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Main Menu</u></h2></a>';

echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';


include("../../960bottom.php");

exit();
}
}

$adCreditExchange->buy_listing($user_id, $listing_id);//adds the buyer's user id time and status change to listings
echo '<table id="member"><tr><td><table><tr><td>
<p class=\'smallerFont\'>Your first step in purchasing the advertising credits has been successful. You now have'.$value[buyertimelimit].' minutes to BOTH deposit the amount agreed upon AND to report back that the deposit was successful!
<p class=\'smallerFont\'>You will need the following information to deposit the funds:
<br>The bank name is : '.$value[bank_name].'.
<br>The Account Number to Deposit The Money Is :
<br>The Name of the account holder is :';

echo "</h1></td></tr></table></td></tr></table>";

echo '<a href="buyerreport.php">Go To The Reporting Page</a>';

}
elseif(isset($_POST['A1'])){
echo '<h1>CONFIRM THAT YOU HAVE MADE THE DEPOSIT TO THE SELLERS BANK ACCOUNT IN THE AMOUNT POSTED BELOW AND THAT BOTH THE DEPOSIT AND THE FILING OF THIS REPORT WERE BEFORE THE EXPIRATION OF THE TIME LIMIT ';
$listing_id = $_POST['listing_id'];
include($_SERVER['DOCUMENT_ROOT']."/classes/ad_credit_exchange_class.php");
$adCreditExchange = new adCreditExchange;



$listing_info = $adCreditExchange->viewbylisting($listing_id);

if(count($listing_info)==0)
{
echo '<br>&nbsp;<br><br>&nbsp;<br><h1>Sorry! There were no results found.</h1>';
}
else
{
    /*** convert the array to object ***/
 //   $array =$adCreditExchange->objectToArray($ad_list);

    /*** show the array ***/
   foreach($listing_info as $key=>$value){
foreach($value as $key=>$value2){
$total = $value[quantity] * $value[price];
//look up depofo for each 
//assign to $depofo[bank_acctno] and $depofo[bank_acctname]
}

$msg .=  '

<style>@import url("blinkfile.css")</style>


<table style = \"margin-left:auto; 
    margin-right:auto;\" bgcolor=\"white\" width=\"75%\">
<table border="2" cellpadding="5" >
<tr><td>Offer ID</td>	<td>'.$value[id].'</td><td rowspan="11">

<form method="post" action="'. htmlentities($_SERVER['PHP_SELF']).'" style="width:80">
    <input type="hidden" name ="listing_id" value="'.$value[id].'">
        <input type="hidden" name ="B1" value="1">      
           <input type="image" width="60" height="50" src="/images/reportnow.jpg" alt="Submit">
</form>
</td>
<tr><td>Date/Time Posted</td><td>'.$value[timestampInit].'</td>	
<tr><td>Quantity Offered</td><td>'.$value[quantity].'</td>	
<tr><td>Asking Price</td><td>'.$value[price].'</td>
<tr><td>Currency</td><td>'.$value[currency].'</td>
<tr><td  style="background-color:yellow;">Total Amount Due</td><td style="background-color:yellow;">'.$total.'</td>	
<tr><td>Bank Name</td><td>'.$value[bank_name].'</td>
<tr><td>The Time Of Your Purchase</td><td>'.$value[timestampBuyerin].'</td>
<tr><td><blink>You Have This Long From The Time Of Purchase To Make Your Deposit* (Minutes). Time is of the essence!</blink></td><td>'.$value[buyertimelimit].'</td>
<tr><td>Seller\'s Response Transfer Time Limit (Hours)</td><td>'.$value[sellertimelimit].'</td>
<tr><td>Current Status</td><td>'.$value[status].'</td>
<tr><td>Comments</td><td>'.$value[textarea].'</td></tr>
<tr><td colspan="3">

<p class="smallerFont">*The timer starts when you click the "Buy Now" button. If the time limit is too short for you then <blink>do not do that</blink>. Make a counter offer to request more time from the seller instead (FYI you can counter offer any of the terms of the transaction). 
<p class=\'smallerFont\'>But the <u>recommended best practice</u> is to use a Smart Phone or laptop: 1) First go as near to the bank branch where you will make the deposit as you can (and still be able to access the Internet -[sic. Starbucks, MacDonalds etc]) 2) From there (near or at the bank), using the phone or laptop, return to BungeeBones.com (to this same page) and click the "Buy Now" button. 3) You will be just minutes away from completing the deposit 4) Upon completion of the deposit repeat the above procedure to access the Internet and return to BungfeeBones.com to report the successful deposit. THAT WILL PERMANENTLY FREEZE THE CREDITS FOR YOU! Time is of the essence! Reporting late and/or after the expiration is not possible (even though you made a deposit) and jeopardizes your purchase.</td></tr>

';
}
}//close else count > 0




$msg .= "



</td></tr></table>
";







echo $msg;
}
else
{
$msg="<table id='member'><tr><td><h3>You have agreed to purchase the Advertising Credits listed below from their owners (other BungeeBones members).</h3>

<h3>BungeeBones does not own them and only provides the following:

<ul><Li>Guarantees that the sellers have the Advertising Credits and freezes them while we await notice of your deposit</li><li> Provides a secure, step by step procedure for transferring credits to you from the buyer</li><li> Can function as an arbitrator </li></ul>

<h1 style = 'color:red;'>You need to make the deposit AND THEN FILE THIS REPORT by the time posted in the blinking area below.</h1>


<p class='smallerFont'>If you fail, the record of your default is publicly available and associated with your website.

<p class='smallerFont'>If the seller fails to transfer the credits (after your payment) then they will be transeferred to you automatically within 15 minutes of the expiration of the Seller's Response Transfer Time Limit. The seller is encouraged to transfer the credits to you manually (a very simple process) after confirming your deposit but they are not obligated to. BungeeBones will transfer the credits within fifteen minutes of the specified time UNLESS the seller files an arbitration request because the funds were not deposited

<p class='smallerFont'>Repeated failures to comply with the agreements you make can get you barred from the feature, your website on a public display and possible removal of your link from the system.";
$msg .= "<h1>Be sure to get the following information from the seller's bank when you make the deposit:
<ul>
<li>The Deposit Receipt (it is your sole proof of making the deposit and making it ON TIME)</li>
<li>The Branch or ATM Location</li>
<li>The Teller's Name Or ID if you can get it.</li>
</ul>

<p class='smallerFont'>Immediately when you file this report the seller will be notified and they will have the amount of time posted to either confirm your deposit and/or in the event of you filing a false report or some other error they can file an arbitration request. If that happens you will be expected to provide all of the above information. There are penalties applied to the seller if they file false arbitration requests. They should be an extremely rare occurence.</td></tr></table>";

include($_SERVER['DOCUMENT_ROOT']."/classes/ad_credit_exchange_class.php");
$adCreditExchange = new adCreditExchange;

$test_array = array(
'list of statuses',
'withdrawn',
'arbitration',
'executed',
'expired',
'reported',
'accepted',
'cntroffered',
'offered');

$status = $_POST['status'];
$scope = $_POST['scope'];
$status = 'offered';
/*if($scope == "users_listings"){
$ad_list = $adCreditExchange->viewbyseller($user_id, $status);
}
else
{*/
$status="accepted";
$ad_list = $adCreditExchange->viewbybuyer($user_id, $status);
//}
if(count($ad_list)==0)
{
echo '<br>&nbsp;<br><br>&nbsp;<br><h1>Sorry! You have no transactions awaiting you making a deposit and/or notifying the seller of that. Either the time limit ran out (if so the transaction would be in your expired listings) or you didn\'t properly begin the process to buy them.</h1>';
echo '<a href="index_buyer.php"> <h2><u>Return To Advertising Credit Exchange Buyer Menu</u></h2></a>';
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Main Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a></div>';


include("../../960bottom.php");
exit();
}
else
{
    /*** convert the array to object ***/
 //   $array =$adCreditExchange->objectToArray($ad_list);

    /*** show the array ***/
   foreach($ad_list as $key=>$value){
foreach($value as $key=>$value2){

//look up depofo for each 
//assign to $depofo[bank_acctno] and $depofo[bank_acctname]
}
$listing_id = $value[id];
$total = $value[quantity] * $value[price];
$pieces = explode(" ", $value[timestampBuyerin] );
$pieces2 = explode(":", $pieces[1] );
//print_r($pieces2);
//Array ( [0] => 14 [1] => 10 [2] => 35 ) 
if($value[buyertimelimit] == 60){
$pieces2[0] = $pieces2[0]+1;
}elseif($value[buyertimelimit] == 120){
$pieces2[0] = $pieces2[0]+2;
}
else
{
$pieces2[1] = $pieces2[1]+$value[buyertimelimit];

}
if($pieces2[1] > 60){
$pieces2[0] = $pieces2[0]+ 1;
$pieces2[1] = $pieces2[1] - 60;
$deadline = $pieces2[0].":".$pieces2[1].":".$pieces2[2];
}
else
{
$deadline = $pieces2[0].":".$pieces2[1].":".$pieces2[2];
} 
date_default_timezone_set('America/New_York');
$time = date('H:i:s');


if($time > $deadline){
$missed_deadline_by = $time-$deadline;
echo 'missed by = ', $missed_by;
$deadline="expired";
}
//echo 'line 267 deadline - ', $deadline;
$msg .=  '

<style>@import url("blinkfile.css")</style>
<table id="member">
<table border="2" cellpadding="5" >
<tr><td>Offer ID</td>	<td>'.$value[id].'</td><td rowspan="13"><h1 style= "color:red;">';



if($deadline=="expired"){
//1) move this expired transaction to the expired table for a record
//2) update the listings table to remove the buyers timestamp and id and change its status back to offered
//$ad_list = $adCreditExchange->viewbybuyer($user_id, $status);
$reason = "expired";
$agent = "From buyerreport.php  - buyer logged in late";
$adCreditExchange->move_buyer($user_id, $listing_id, $reason, $agent);
$adCreditExchange->cancel_buy_listing($user_id, $listing_id);
$msg .=  '<table id="member"<tr><td>IF YOU HAVE ALREADY DEPOSITED THE MONEY TO THE SELLER\'S BANK ACCOUNT THEN WE HAVE A SERIOUS PROBLEM!
<p class="smallerFont" >BungeeBones does not have access to that account and cannot issue a refund nor transfer the credits to you (they have returned to the seller automatically because you failed to report back within the time required). 

<p class="smallerFont" >You can possibly try returning to the Market Bulletin page to see if this listing (ID # '.$listing_id.' is still listed for sale. If so, aggre to purchase it again. Be aware that the price this time may be different. If the amount you agree to pay is lower than what you deposited is lower the seller may file arbitration. In that case BungeeBones mayadjust the amount of the credits you receive according to the previously higher price.
<p class="smallerFont" >If the seller has removed the credits from the market or sold them to someone else then you can use the contact form to contact BungeeBones Administration and we can forward a request on your behalf to the seller to verify the deposit and transfer the credits to you manually themselves. We are sorry that BungeeBones cannot provide arbitration in this matter beyond that as your failure to comply within the time limits has placed the funds outside our control.</td></tr></table>';
}
else
{
$msg .=  'Click the button below ONLY IF YOU HAVE THE RECEIPT IN YOUR HAND!';
}


$msg .=  '</h1><br>
<form method="post" action="'. htmlentities($_SERVER['PHP_SELF']).'" style="width:80">
     <input type="hidden" name ="listing_id" value="'.$value[id].'">
<input type="hidden" name ="A1" value="1">
                  ';
if($deadline =="expired"){
$msg .= '<img src = "/images/reportnowexp.jpg" alt="expired">';
}
else
{
$msg .= '<input type="image" width="60" height="50" src="/images/reportnow.jpg" alt="Submit">';
}
$msg .= '
          
</form> </td>
<tr><td>Date/Time Posted</td><td>'.$value[timestampInit].'</td>	
<tr><td>Quantity Of Advertising Credits Offered</td><td>'.$value[quantity].'</td>	
<tr><td>Asking Price (per Advertising Credit)</td><td>'.$value[price].'</td>
	
<tr><td>Currency Unit</td><td>'.$value[currency].'</td>	
<tr><td style="background-color:yellow;">Total Amount Due</td><td style="background-color:yellow;">'.$total.'</td>
<tr><td>Bank Name</td><td>'.$value[bank_name].'</td>
<tr><td>The Time Of Your Purchase</td><td>'.$value[timestampBuyerin].'</td>
<tr><td>Your Deposit Time Limit (Minutes)</td><td>'.$value[buyertimelimit].'</td>';
if($deadline == "expired"){
$msg .=  '<tr><td><blink style="color:red">Your Deadline (Time Purchased Plus Time Limit)</blink></td><td><blink style="color:red">'.$deadline.'</blink></td>';
}
else
{
$msg .= '<tr><td><blink>Your Deadline (Time Purchased Plus Time Limit)</blink></td><td><blink>'.$deadline.'</blink></td>';
}
$msg .= '<tr><td>Seller\'s Response Transfer Time Limit (Hours)</td><td>'.$value[sellertimelimit].'</td>
<tr><td>Current Status</td><td>'.$value[status].'</td>
<tr><td>Comments</td><td>'.$value[textarea].'</td></tr></table>';
}
}//close else count > 0




$msg .= "



</td></tr></table>
";







echo $msg;

}//close else isset A1
echo '<a href="index_buyer.php"> <h2><u>Return To Advertising Credit Exchange Buyer Menu</u></h2></a>';
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Main Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a></div>';


include("../../960bottom.php");

} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

