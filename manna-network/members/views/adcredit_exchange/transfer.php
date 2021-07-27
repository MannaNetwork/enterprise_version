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
if (!isset($_POST['A1'])) {
$listing_id = $_GET['listing_id'];
}
else
{
echo '$_POSTlisting_id = ', $_POST[listing_id];
$listing_id = $_POST['listing_id'];
}
$moniker="<h5>Transfer Your Ad Credits</h5>";
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


if (isset($_POST['A1'])) {
$msg="";

include($_SERVER['DOCUMENT_ROOT']."/classes/ad_credit_exchange_class.php");
$adCreditExchange = new adCreditExchange;
$ad_list = $adCreditExchange->viewbylisting($listing_id);
//id, timestampInit, timestampBuyerin, timestampBuyerReport, timestampArb, timestampTrans, transAgent, quantity, price, market_order, currency, bank_name, bank_depofo, buyertimelimit, sellertimelimit, textarea, status, sellerid, buyerid, sellersIP


if(count($ad_list)==0)
{
echo 'There was a problem processing the transfer. Contact Bungeebones administration immediately! (Use the contact form in the right menu of the webpage).';
exit();
}


   foreach($ad_list as $key=>$value){
     foreach($value as $key=>$value2){

                 }

if($value[status] == "reported" AND $value[sellerid] == $user_id ){
//process transfer
echo '<h1>Process Transfer</h1>';
$sellers_price_slot_balance = $adCreditExchange->getUsersPriceSlotBalance($user_id);
 foreach($sellers_price_slot_balance as $key=>$values){
     foreach($values as $key=>$values2){
                 }
$sellers_price_slot_balance = $values[balance];
echo '<br>$sellers_price_slot_balance =  ', $sellers_price_slot_balance ;
$sellerid = $value[sellerid]; 
$buyerid = $value[buyerid]; 
$BBbank_transfer_id; 
$quantity = $value[quantity];
echo '<br>$sellerid =  ', $sellerid ;

echo '<br>$buyerid =  ', $buyerid ;
echo '<br>$quantity =  ', $quantity ;

//now we have all the information needed to make the transfer
include($_SERVER['DOCUMENT_ROOT']."/classes/price_slot_class.php");
$price_slot_work = new price_slot_info;

$ad_list = $price_slot_work->credit_transfers ($sellerid, $buyerid, $BBbank_transfer_id, $quantity);
}
}
else
{
echo '<p class="smallerFont" > There was a problem processing the transfer. Contact Bungeebones administration immediately! (Use the contact form in the right menu of the webpage).';
exit();
}
}//close outer foreeach
}
else
{

include($_SERVER['DOCUMENT_ROOT']."/classes/ad_credit_exchange_class.php");
$adCreditExchange = new adCreditExchange;
$ad_list = $adCreditExchange->viewbylisting($listing_id);

if(count($ad_list)==0)
{
echo '<br>&nbsp;<br><br>&nbsp;<br><h1>Sorry! There were no results found.</h1>';
exit();
}


   foreach($ad_list as $key=>$value){
     foreach($value as $key=>$value2){

                 }

if($value[status] == "reported" AND $value[sellerid] == $user_id ){
//process transfer
echo '<h1>Process Transfer</h1>';



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

//do I need to check if seelers time limit expired? If so, process the transfer, put the agent down aS "auto" and display message that the time limit has already elapsed and the transfer had already been completed automatically.

//$is_expired = $adCreditExchange->is_listing_expired($value[timestampBuyerin], $value[buyertimelimit]);

$msg .= "


</td></tr></table>
<table style = \"margin-left:auto; 
    margin-right:auto;\" bgcolor=\"white\" width=\"75%\">
<form method=\"post\" action=\"". htmlentities($_SERVER['PHP_SELF'])."\" style=\"width:80\">

<input type=\"hidden\" name =\"A1\" value=\"1\">
     <input type=\"hidden\" name ='listing_id' value='$value[id]'>

<tr><td><p class='smallerFont' style=\"color:red;\">Warning: You are about to irretrievably transfer your advertising credits to the buyer!</p><h1>Transaction Details</h1>";


$msg .="
<p class='smallerFont' >By submitting this form you are about to irreversably transfer $value[quantity] advertising credits to the buyer.</p>
<p class='smallerFont' >Are you sure you verified that the buyer made the deposit to your bank account?</p>
<p class='smallerFont' >Are you sure the deposit was for the proper amount?</p>
<p class='smallerFont' >If, not, you need to CHECK YOUR BANK BALANCE NOW! This is an irreversable transfer! 
<p class='smallerFont' >If there is not a deposit on record at your bank (or for the wrong amount) and you have time to check with them before the expiration of your timer, then do check with them to verify they have not made an error.

<p class='smallerFont'style=\"color:red;\" >If you have done all that and you think you may have fallen victim to a fraudulent  and false buyer report then do not hesitate and <u>FILE AN ARBITRATION REQUEST</u> with the BungeeBones.com administration<a href=\"arbitration.php\"> CLICK THIS LINK NOW </a>to block what will soon be the automatic transfer of these credits to the buyer. There is NO FEE if the buyer has committed fraud and filed a false report but you will be charged a 10% fee if the buyer has proof of their deposit. 



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



              <div style = 'margin-left:auto; 
    margin-right:auto;' bgcolor='white' width='25%'>    <input type=\"image\" width=\"60\" height=\"50\" src=\"/images/transfer.jpg\" alt=\"Submit\"></div>
          
</form>
</td></tr></table>
";

}

else
{
echo 'you are not authorized';
exit();
}
}
}




echo $msg;
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';


include($_SERVER['DOCUMENT_ROOT']."/new_site/960bottom.php");

} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

