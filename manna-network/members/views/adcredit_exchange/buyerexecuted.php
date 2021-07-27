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
$status = "executed";
$moniker="<h5>All Your AdCoin Purchases</h5>";
$body_width="wide";
include("../../960top.php");
include('user_cpanel_submenu.php');

$msg="";

include($_SERVER['DOCUMENT_ROOT']."/classes/ad_credit_exchange_class.php");
$adCreditExchange = new adCreditExchange;


$ad_list = $adCreditExchange->viewbybuyer($user_id, $status);
//}
if(count($ad_list)==0)
{
echo '<br>&nbsp;<br><br>&nbsp;<br><h1>Sorry! There were no results found.</h1>';
}
else
{

   foreach($ad_list as $key=>$value){
foreach($value as $key=>$value2){

//look up depofo for each 
//assign to $depofo[bank_acctno] and $depofo[bank_acctname]
}
unset($statuspics1);
unset($statuspics2);
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


if($value[status] === "offered"){
$statuspics1 =    '<a href="slr_admin_edit.php?listing_id='.$value[id].'"><img src="../../../images/editnow.jpg" width="60" height="50"></a> <br><br>';
$statuspics2 =     '<a href="slr_admin_canceled.php?listing_id='.$value[id].'"><img src="../../../images/cancelnow.jpg" width="60" height="50"></a>';
$rowspan = '13';
}
elseif($value[status] === "accepted"){
$statuspics1 =    '<img src="../../../images/editreadonly.jpg" width="60" height="50"> <br><br>';
//$statuspics2 =     '<img src="../../../images/cancelreadonly.jpg" width="60" height="50">';
$rowspan = '15';
}
elseif($value[status] === "reported"){
$statuspics1 =     '<a target="_blank" href="transfer.php?listing_id='.$value[id].'"><img src="../../../images/transfer.jpg" width="60" height="50"> </a><br><br>';
//$statuspics2 =     '<a href="arbitration.php?listing_id='.$value[id].'"><img src="../../../images/arbitrate.jpg" width="60" height="50">';
$rowspan = '16';
//15, 30, 45, 60, 120  buyer
//.5, 1, 6, 12, 18, 24 seller
$pieces = explode(" ", $value[timestampBuyerReport] );
$piecesday = explode("-", $pieces[0] );
$pieces2 = explode(":", $pieces[1] );
//print_r($pieces);
//Array ( [0] => 14 [1] => 10 [2] => 35 ) 
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

if( $hour_total >= 24){
$hour_total = $hour_total - 24;
$piecesday[2] = $piecesday[2]+1;
}
$sellers_deadline = $piecesday[0]."-".$piecesday[1]."-".$piecesday[2]." ".$hour_total.":".$pieces2[1].":".$pieces2[2]; 
}
$time = date('Y-m-d H:i:s');



if($time > $sellers_deadline AND $value[timestampTrans] == ""){
//forcibly transfer credits
$sellers_deadline="expired";
$updatestatus = 'executed';
$trans_agent = 'auto';
$adCreditExchange->update_listing_transfer($value[id], $updatestatus, $trans_agent);
$adCreditExchange->move_buyer($user_id, $value[id], "sold","auto");
}
}
elseif($value[status] === "executed"){
$statuspics1 =     '<img src="../../../images/transfercheck.jpg" width="60" height="50"></a> <br><br>';
//$statuspics2 =     '<img src="../../../images/arbitratex.jpg" width="60" height="50"></a>';
$rowspan = '16';


}
elseif($value[status] === "arbitration"){
$statuspics1 =     '<img src="../../../images/transferhold.jpg" width="60" height="50"></a> <br><br>';
//$statuspics2 =     '<img src="../../../images/arbitratex.jpg" width="60" height="50"></a>';
$rowspan = '16';


}

$msg .=  '

<style>@import url("blinkfile.css")</style>
<table id="member"  style = "margin-left:auto; ,
    margin-right:auto; , width:75%">
<table border="2"  width="75%"';

$msg .=  'style ="margin-left:auto; ,
    margin-right:auto; , width:75%" "background-color:red;"';






$msg .=  '
>
<tr><td>Offer ID</td>	<td>'.$value[id].'</td><td rowspan="'.$rowspan.'">


'.$statuspics1     .'
'.$statuspics2     .'</td>


<tr><td>Date/Time Posted</td><td>'.$value[timestampInit].'</td>	
<tr><td>Quantity Of Advertising Credits Offered&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>'.$value[quantity].'</td>	
<tr><td>Asking Price (per Advertising Credit)</td><td>'.$value[price].'</td>
	
<tr><td>Currency Unit</td><td>'.$value[currency].'</td>	
<tr><td>Total Amount Due</td><td>'.$total.'</td>
<tr><td>Bank Name</td><td>'.$value[bank_name].'</td>
<tr><td>Bank Account Number</td><td>######################</td>
<tr><td>Name On Bank Account</td><td>########## ############</td>';

$msg .=  '<tr><td>The Time Of Your Acceptance</td><td>'.$value[timestampBuyerin].'</td>';

$msg .=  '<tr><td>Your Deposit Time Limit (Minutes)</td><td>'.$value[buyertimelimit].'</td>';

$msg .=  '<tr><td>The Time Of Your Reported Deposit</td><td>'.$value[timestampBuyerReport].'</td>';



$msg .=  '<tr><td>Seller\'s Response Time Limit (Hours)</td><td>'.$value[sellertimelimit].'</td>';

$msg .=  '<tr><td>The Time When Your Credits Were Transfered To You</td><td>'.$value[timestampTrans].'</td>';


$msg .=  '<tr><td>Current Status</td><td>'.$value[status].'</td>';

$msg .=  '<tr><td>Comments</td><td width="50%">'.$value[textarea].'</td></tr></table><hr style="height:2em;color:#333;background-color:#333;">';
}
}//close else count > 0




$msg .= "



</td></tr></table>
";

echo $msg;
echo '<a href="index_buyer.php"> <h2><u>Return To Advertising Credit Exchange Buyer Menu</u></h2></a>';
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Main Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';

include("../../960bottom.php");


} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

