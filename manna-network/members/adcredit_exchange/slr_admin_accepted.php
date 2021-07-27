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
$status = 'accepted';

$moniker="<h5>Seller Main Menu</h5>";
$body_width="wide";
include($_SERVER['DOCUMENT_ROOT']."/960top.php");
include('user_cpanel_submenu.php');

$msg="";

include('../../classes/ad_credit_exchange_class.php');
$adCreditExchange = new adCreditExchange;

$test_array = array(
'list of statuses',
'withdrawn',
'arbitration',
'executed',
'expired',
'accepted',
'cntroffered',
'offered');

$status = "accepted";



$ad_list = $adCreditExchange->viewbyseller("$user_id", $status);

if(count($ad_list)==0)
{
echo '<br>&nbsp;<br><br>&nbsp;<br><h1>Sorry! There were no results found.</h1>';
}
else
{
    /*** convert the array to object ***/
 //   $array =$adCreditExchange->objectToArray($ad_list);

    /*** show the array ***/
   foreach($ad_list as $key=>$value){
foreach($value as $key=>$value2){
}
$total = $value[quantity] * $value[price];
$pieces = explode(" ", $value[timestampBuyerin] );
$pieces2 = explode(":", $pieces[1] );
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
$deadline1 = $pieces2[0].":".$pieces2[1].":".$pieces2[2]; 
$deadline2 .= $pieces[0]." ".$deadline1;
$time = date('Y-m-d H:i:s');

if($time > $deadline2){
$deadline="expired";
}
else
{
$deadline=$deadline1;
}
$msg .=  '

<style>@import url("blinkfile.css")</style>
<table style = \"margin-left:auto; 
    margin-right:auto;\" bgcolor=\"white\" width=\"75%\">
<table border="2" cellpadding="5" >
<tr><td>Offer ID</td>	<td>'.$value[id].'</td><td rowspan="13">

<form method="post" action="'. htmlentities($_SERVER['PHP_SELF']).'" style="width:80">
     <input type="hidden" name ="listing_id" value="'.$value[id].'">
<input type="hidden" name ="A1" value="1">
                  ';
if($deadline =="expired"){
$msg .= '<img src = "../../images/reportnowexp.jpg" alt="expired">';
}
else
{
$msg .= '<input type="image" width="60" height="50" src="../../images/reportnow.jpg" alt="Submit"></form> ';
}

          

if($deadline =="expired"){
$msg .= '
<br><br>
<form method="post" action="'. htmlentities($_SERVER['PHP_SELF']).'" style="width:80">
     <input type="hidden" name ="listing_id" value="'.$value[id].'">
<input type="hidden" name ="A1" value="1"> ';
$msg .= '<input type="image" width="60" height="50" src="../../images/counteroffer.jpg" alt="Submit"></form> ';
}//close if deadline

$msg .= '</td>
<tr><td>Date/Time Posted</td><td>'.$value[timestampInit].'</td>	
<tr><td>Quantity Of Advertising Credits Offered</td><td>'.$value[quantity].'</td>	
<tr><td>Asking Price (per Advertising Credit)</td><td>'.$value[price].'</td>
	
<tr><td>Currency Unit</td><td>'.$value[currency].'</td>	
<tr><td style="background-color:yellow;">Total Amount Due</td><td style="background-color:yellow;">'.$total.'</td>
<tr><td>Bank Name</td><td>'.$value[bank_name].'</td>
<tr><td>The Time Of The Buyer\'s Acceptance</td><td>'.$value[timestampBuyerin].'</td>
<tr><td>Your Deposit Time Limit (Minutes)</td><td>'.$value[buyertimelimit].'</td>';
if($deadline == "expired"){
$msg .=  '<tr><td><blink style="color:red">Buyer\'s Deadline (Time Purchased Plus Time Limit)</blink></td><td><blink style="color:red">'.$deadline.'</blink><br>'.$deadline2.'</td>';

}
else
{
$msg .= '<tr><td><blink>Buyer\'s Deadline (Time Purchased Plus Time Limit)</blink></td><td><blink>'.$deadline.'</blink></td>';
}
if($deadline != "expired"){
$msg .= '<tr><td>Your Response Transfer Time Limit (Hours)</td><td>'.$value[sellertimelimit];
}
else
{
$msg .= '<tr><td>Your Response Transfer Time Limit (Hours)</td><td>NOT APPLICABLE ANYMORE';
}


$msg .= '</td>
<tr><td>Current Status</td><td>';

if($deadline != "expired"){
$msg .= $value[status];
}
else
{
$msg .= 'UPDATED to expired';
}


$msg .='</td>
<tr><td>Comments</td><td>'.$value[textarea].'</td></tr></table>';
if($deadline == "expired"){
$adCreditExchange->move_buyer_expired($user_id, $value[id]);
$adCreditExchange->cancel_buy_listing($value[buyerid], $value[id]);//same function can be used by buyer or seller - just make sure the id  is the buyer id
}
}//closes outer foreach
}//closes if count

echo $msg;
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';

include($_SERVER['DOCUMENT_ROOT']."/960bottom.php");


} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

