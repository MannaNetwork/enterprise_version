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

$bs_action = $_GET['action'];

$moniker="<h5>Notice Of Arbitration</h5>";
$body_width="wide";

include("../../960top.php");
include('user_cpanel_submenu.php');
include('exchange_buyer_submenu.php');
if(isset($_POST['B1'])){
//verify that this user owns this listing before they change the status
//verify that the status is "reported"
include($_SERVER['DOCUMENT_ROOT']."/classes/ad_credit_exchange_class.php");
$adCreditExchange = new adCreditExchange;
$this_transaction = $adCreditExchange->viewbylisting($_POST['link_selected']);

  foreach($this_transaction as $key=>$value){
foreach($value as $key=>$value2){

//look up depofo for each 
//assign to $depofo[bank_acctno] and $depofo[bank_acctname]
}
$test_array = array(
'list of statuses',
'withdrawn',
'arbitration',
'executed',
'expired',
'accepted',
'reported',
'cntroffered',
'offered');
if($value[sellerid] == $user_id AND $value[status] == "reported"){
// this kept me from reissuing the arbitration request somehow? There is no reason to prevent a seller from resubmitting this form as many times as they want?
// And the column	timestampArb needs a timestamp when this form is submitted
// And the column transAgent needs to be updated to 'seller' from the transfer.php page when it is done manually
$adCreditExchange->update_listing_status($_POST['link_selected'], "arbitration");

// for extra saftey verify before posting the success message
$this_safetycheck = $adCreditExchange->viewbylisting($_POST['link_selected']);
foreach($this_transaction as $key=>$value){
foreach($value as $key=>$value2){

//look up depofo for each 
//assign to $depofo[bank_acctno] and $depofo[bank_acctname]
}
$total = $value[quantity] * $value[price];
$test_array = array(
'list of statuses',
'withdrawn',
'arbitration',
'executed',
'expired',
'accepted',
'reported',
'cntroffered',
'offered');

echo '<table id="member"><tr><td><p class="smallerFont" >You have successfully filed for arbitration and the transaction has been stopped. The advertising credits WILL NOT be transferred to the buyer pending arbitration of the issue by BungeeBoones administration. An email containing the information you posted has been sent to the buyer along with a request for the buyer to submit verification of their deposit. If the buyer fails to reply within a reasonable amount of time your credits will be returned to you and unfrozen without charge or penalty.</td></tr>';
//getUsersEmail($user_id)// get the email of the seller
$user_email = $adCreditExchange->getUsersEmail($value[sellerid]);

echo '<tr><td><table border="1"><tr><td><h1>The Buyer was sent the following email</h1><br><br>';
include('arbitration_email.php');
echo '</h1></td></tr></table></td></tr></table>';
echo '<a href="listings_buyer.php"> <h2><u>Return To For Sale List </a>';
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Main Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';

include("../../960bottom.php");

exit();
}
}
else
{
echo '<html>
<head>
  <title>The Sale Of Your Advertising Credits Needs Your Immediate Attention</title>
</head>
<body>


<hr width="600">
<table align="center" width="600" >

<tr><TD align="center" width="600">
<h1>You are not authorized';
echo '</h1></td></tr></table>';
echo '<a href="index_seller.php"> <h2><u>Return To Advertising Credit Exchange Seller Menu</u></h2></a>';
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Main Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';


include("../../960bottom.php");
exit();
}
}//close outer foreach
}
elseif(isset($_POST['A1'])){
$sellers_deadline = $_POST['sellers_deadline'];
if($sellers_deadline=="expired"){
$updatestatus = 'executed';
$trans_agent = 'auto';
$msg2 = '<h1>You CANNOT Request Arbitation! The time period for you to do so has expired!</h1>';
echo $msg2;
include("../../960bottom.php");
exit();
}
else
{
$msg2 = "<table id='member'><tr><td><h1>You Are About To Request Arbitation!</h1>
<p class='smallerFont' style='color:red;' >You should NOT be making this request if the buyer has deposited the amount you agreed upon into your bank account.

<p class='smallerFont' style='color:red;' >This form is for reporting a buyer who did not, in fact, make a deposit or made a deposit of a lesser amount than agreed upon.

<p class='smallerFont' style='color:red;' >If neither of those are true then STOP. Do NOT FILE THIS or you will charged 5% of the transaction amount uneccessarily for your willful filing of an unsubstantiated arbitration request.

<p class='smallerFont' style='color:red;' >By filing this form you will freeze and prevent the automatic transfer of the advertising credits to the buyer pending arbitration. They will not be returned to your control, however, unless you prevail in the arbitration case.</td></tr>


";

$msg2 .=  "<tr><td><form name=\"test\" action=\"". htmlentities($_SERVER['PHP_SELF'])."\" method=\"post\">
<input type=\"hidden\" name=\"link_selected\" value=\"".$_POST[link_selected]."\">
<input type=\"hidden\" name=\"B1\" value=\"Submit\">
<input type=\"hidden\" name=\"msg\" value=\"$ad_list\">
<table><tr><td> &nbsp;
</textarea> </td></tr>

<tr><td><input type=\"image\" width=\"60\" height=\"50\" src=\"/images/arbitrate.jpg\" alt=\"Submit\"></td></tr>
</table>
</form>
";

echo $msg2;
}
}
else
{
include($_SERVER['DOCUMENT_ROOT']."/classes/ad_credit_exchange_class.php");
$adCreditExchange = new adCreditExchange;

$status = "arbitration";
$ad_list = $adCreditExchange->viewbyseller($user_id, $status);
if(count($ad_list)<1){
$msg="<h1>Arbitration</h1>";
$msg .= "<table id = 'member'><tr><td>";
$msg .= "<p class='smallerFont' >If you did not receive advertising credits from a seller that is a BungeeBones member as you were supposed to and have failed to resolve the issue with the seller you can bring the matter before an arbitrator. Bungeebones does not arbitrate matters itself but, rather, refers all arbitration matters to others. The agrieved party must initiate the arbitration process and the other party must accept the arbitrator within a reasonable time. If the two parties cannot agree on an arbitrator then the BungeeBones administration can mediate by casting a tie breaker vote for an arbitrator.
";
$msg .= "<p class='smallerFont' >Since this is a Bitcoin based and related issue we recommend an arbitrator familiar with Bitcoin and willing to accept it for any related fees. Without any endorsement as to suitable or qualifications of the arbitrators BungeeBones provides <a target='_blank' href='https://www.bitrated.com/u'>this link to Bitrated</a> which provides a sizable list of arbitrators from which to choose.
</p>";
 $msg .= "<p class='smallerFont' >The agrieved party needs to contact an arbitrator to get the process started. Have them contact BungeeBones.com through the web site's contact form and we will provude them all relevant details of the transaction involved (including the other party's contact information).
";

 $msg .= "<p class='smallerFont' >Upon a decision by a properly selected arbitrator Bungeebones Administration will transfer the disputed advertising credits as directed by the arbitrator";





 $msg .=  '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
 $msg .= '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';
 $msg .= "</td></tr></table>";

echo $msg;
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Main Menu</u></h2></a>';
echo '<a href="index_seller.php"> <h2><u>Return To Advertising Credit Exchange Seller Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';
include("../../960bottom.php");
exit();
}
$counter = 0;
  foreach($ad_list as $key=>$value){
foreach($value as $key=>$value2){

//look up depofo for each 
//assign to $depofo[bank_acctno] and $depofo[bank_acctname]
}
$counter++;

$is_expired = $adCreditExchange->is_listing_expired($value[timestampBuyerin], $value[buyertimelimit]);

if($is_expired[0] == 'yes' AND $value[timestampBuyerReport] == ""){
//this all copied from slr_admin_all - might only need the is expired value
/*$value[status] = 'expired';
$renew_status = "offered";
$adCreditExchange->update_listing_status($value[id], $renew_status);
$adCreditExchange->move_buyer($user_id, $value[id], "expired","");
$adCreditExchange->cancel_buy_listing($value[buyerid], $value[id]);
*/
}

//15, 30, 45, 60, 120  buyer
//.5, 1, 6, 12, 18, 24 seller
$pieces = explode(" ", $value[timestampBuyerReport] );
$piecesday = explode("-", $pieces[0] );
$pieces2 = explode(":", $pieces[1] );

if($value[sellertimelimit] < 1){
$minute_total = $pieces2[1] + 30;
if($minute_total > 60)
{
$minute_total = $minute_total - 60;

$minute_total = sprintf("%02s", $minute_total);
$pieces2[0] = $pieces2[0] + 1;
}
$sellers_deadline = $piecesday[0]."-".$piecesday[1]."-".$piecesday[2]." ".$pieces2[0].":".$minute_total.":".$pieces2[2]; 
}
else
{
$hour_total = $pieces2[0] + $value[sellertimelimit];

if( $hour_total > 24){
$hour_total = $hour_total - 24;
$piecesday[2] = $piecesday[2]+1;
}
$sellers_deadline = $piecesday[0]."-".$piecesday[1]."-".$piecesday[2]." ".$hour_total.":".$pieces2[1].":".$pieces2[2]; 
}
$time = date('Y-m-d H:i:s');



if($counter==1){
$msg .= "<p class='smallerFont' style='color:red;' >Any transactions where the seller has reported that they have not received a deposit that you claimed to have made and have filed an arbitration request with BungeeBones.com administration will be listed below. Review the transaction information and send the evidence you have that you, indeed, made the deposit or provide any other details or supporting arguments as to why BungeeBones.com should release the seller's frozen advertising credits to you.
<p class='smallerFont'>When you reply:
<ul><li>BungeeBones Administration will review your information and will forward them to the seller</li>
<li>The advertising credits in question will be frozen until BungeeBones administration makes a decision in the matter</li>

<li>BungeeBones will request that the seller submit supporting documention</li>
<li>If they respond then BungeeBones Administration may request supporting documentation from you again.</li>
<li>BungeeBones Administration will make its decision based upon the information provided</li>
<li>There is no time limit for BungeeBones to arrive at a decision but when they do the advertising credits will be transferred to one of the parties or, at BungeeBone's sole discretion, may split the amount in various oparts to the parties.</li>
<li>All decisions are final</li>
</ul>";


$msg .= "
<table style = \"margin-left:auto; 
    margin-right:auto;\" bgcolor=\"white\" width=\"75%\">

<tr><td><h1>Transfers Of Your Credits That Are On Hold Pending Arbitration</h1>";
}


$msg .=  '

<style>@import url("blinkfile.css")</style>
<table style = \"margin-left:auto; 
    margin-right:auto;\" bgcolor=\"white\" width=\"75%\">
<table border="2" cellpadding="5" >
<tr><td>Offer ID</td>	<td>'.$value[id].'</td></tr>


<tr><td>Date/Time Posted</td><td>'.$value[timestampInit].'</td>	</tr>
<tr><td>Quantity Of Advertising Credits Offered&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>'.$value[quantity].'</td>	</tr>
<tr><td>Asking Price (per Advertising Credit)</td><td>'.$value[price].'</td></tr>
	
<tr><td>Currency Unit</td><td>'.$value[currency].'</td>	</tr>
<tr><td>Total Amount Due</td><td>'.$total.'</td></tr>
<tr><td>Bank Name</td><td>'.$value[bank_name].'</td></tr>
<tr><td>Bank Account Number</td><td>######################</td></tr>
<tr><td>Name On Bank Account</td><td>########## ############</td></tr>';

$msg .=  '<tr><td>The Time Of The Buyer\'s Acceptance</td><td>'.$value[timestampBuyerin].'</td></tr>';

$msg .=  '<tr><td>Buyer\'s Deposit Time Limit (Minutes)</td><td>'.$value[buyertimelimit].'</td></tr>';

$msg .=  '<tr><td>The Time Of The Buyer\'s Deadline</td><td>'.$is_expired[1].'</td></tr>';


$msg .=  '<tr><td>The Time Of The Buyer\'s Reported Deposit</td><td>'.$value[timestampBuyerReport].'</td></tr>';



$msg .=  '<tr><td>Your Response Time Limit (Hours)</td><td>'.$value[sellertimelimit].'</td></tr>';

$msg .=  '<tr><td>Comments</td><td width="50%">'.$value[textarea].'</td></tr>';




$msg .=  "

<tr><td><p class='smallerFont' style='color:red;'>Attention: Failure to reply will result in the credits being returned to the seller and your possible ban from using this program.
<p class='smallerFont' style='color:red;'>Email your documentation verifying your deposit to: robert@bungeebones.com
<p class='smallerFont' style='color:red;'>Required documentation: The deposit receipt from the seller's bank
<p class='smallerFont' style='color:red;'>Suggested Information: The business card of the teller, the branch location/number
</td></tr>

<hr style='height:2em;color:#333;background-color:#333;'>
";


$msg .= "



</td></tr></table>
";

}//close outer foreach



echo $msg;

echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Main Menu</u></h2></a>';
echo '<a href="index_buyer.php"> <h2><u>Return To Advertising Credit Exchange Buyer Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';


include("../../960bottom.php");
}
} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

