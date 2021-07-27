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
$status = "offered";

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

if(isset($_POST['B1'])){

$listing_id = $_POST['listing_id'];
$quantity = $_POST['quantity']; 
$price = $_POST['price']; 
$market_ordertoserver = $_POST['market_ordertoserver']; 
$currency = $_POST['currency']; 
$buyertimelimit = $_POST['buyertimelimit'];
$sellertimelimit = $_POST['sellertimelimit']; 
$bank_name = $_POST['bank_name']; 
$bank_acct_number = $_POST['bank_acct_number'];
$bank_acct_name = $_POST['bank_acct_name'];
$textarea = $_POST['textarea'];
$depofo = $_POST['depofo'];
include('../../classes/ad_credit_exchange_class.php');
$adCreditExchange = new adCreditExchange;
//need to run a check if they have a sufficient balance
//update_listing($listing_id, $quantity, $price, $market_ordertoserver, $currency, $buyertimelimit, $sellertimelimit, $bank_name,  $textarea, $user_id)

include('mcrypt.php');

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
        $bank_acct_number,
        MCRYPT_MODE_CBC,
        $iv
    )
);

$encrypted2 = base64_encode(
    $iv .
    mcrypt_encrypt(
        MCRYPT_RIJNDAEL_256,
        hash('sha256', $key, true),
        $bank_acct_name,
        MCRYPT_MODE_CBC,
        $iv
    )
 );



$adCreditExchange->update_depofo($depofo, $encrypted, $encrypted2); 
echo '<table style="background-color:grey"><tr><td><h1>Your changes were saved</h1></td></tr></table>';
}
elseif(isset($_POST['A1']) ){
$listing_id = $_POST['listing_id'];
$quantity = $_POST['quantity']; 
$orig_quantity = $_POST['orig_quantity'];
$price = $_POST['price']; 
$market_ordertoserver = $_POST['market_ordertoserver']; 
$currency = $_POST['currency']; 
$buyertimelimit = $_POST['buyertimelimit'];
$sellertimelimit = $_POST['sellertimelimit']; 
$bank_name = $_POST['bank_name']; 
$bank_acct_number = $_POST['bank_acct_number'];
$bank_acct_name = $_POST['bank_acct_name'];
$depofo = $_POST['depofo'];
$textarea = $_POST['textarea'];
echo '<br>$orig_quantity =  ', $orig_quantity;

echo '<br>$quantity =  ', $quantity;
if($orig_quantity < $quantity){
include('../../classes/ad_credit_exchange_class.php');
$adCreditExchange = new adCreditExchange;

$balance_array = $adCreditExchange->getBuyersBalance($user_id);
foreach($balance_array as $key=>$value){
$balance = $value['balance'];
}
$balance = number_format($balance, 8, '.', '');

$status = 'offered';
$get_frozen_offered = $adCreditExchange->check_balance($user_id, $status);

$status = 'accepted';
$get_frozen_accepted = $adCreditExchange->check_balance($user_id, $status);

$msg .= '<div><h1 align="center">Selling Your Advertising Credits For Cash</h1> <br><table style = "margin-left:auto; 
    margin-right:auto;" bgcolor="gray" width="75%"><tr><td><p style="text-align:left; font-size: 125%;"> ';
$testall = $balance - $get_frozen_accepted - $get_frozen_offered -$quantity;

if($balance - $get_frozen_accepted-$quantity < 0 AND $get_frozen_offered == ""){
$grand_tot = $balance - $get_frozen_accepted;
echo "<div><h1>Sorry! You Do Not Have Enough Advertising Credits Left To Sell That Many.</h1>
Your beginning balance was  $balance but
<p>you have $get_frozen_accepted Advertising Credits That A Buyer Is Purchasing And Are About To Be Transferred.
<p>You would be able to sell $grand_tot credits";
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';

echo "</div>";

exit();
}
elseif($balance - $get_frozen_offered-$quantity < 0 AND $get_frozen_accepted == ""){
$grand_tot = $balance - $get_frozen_offered;
echo"<div><h1>Sorry! You Do Not Have Enough Additional Advertising Credits Left To Sell That Many.</h1>
Your beginning balance was  $balance but
<p>You have $get_frozen_offered Advertising Credits That Are Currently Offered For Sale.
<p>You could offer an additional $grand_tot credits or you could cancel the existing listings and make a consolidated offer of $balance credits.";
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';

echo "</div>";
exit();
}
elseif($balance - $get_frozen_accepted - $get_frozen_offered -$quantity< 0 ){
echo "<div><h1>Sorry! You Do Not Have Enough Advertising Credits Left To Sell That Many (You Have Sold Some, The Rest Are Already Listed For Sale).</h1>";
$grand_tot = $balance-$get_frozen_accepted-$get_frozen_offered;
echo "<p>You had a balance of $balance;
<p>$get_frozen_accepted of those are in the process of being purchased and are about to be transferred
<p>$get_frozen_offered are being offered for sale.
<p> That means you would have an additional $grand_tot available to sell.";
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';

echo "</div>";
exit();
}

}//close if new greater than orig

$msg = '<table style = "margin-left:auto; 


    margin-right:auto;" bgcolor="white" width="75%">

<form method="post" action="'. htmlentities($_SERVER['PHP_SELF']).'" style="width:80">
     <input type="hidden" name ="listing_id" value="'.$listing_id.'">
<input type="hidden" name ="depofo" value="'.$depofo.'">
<tr><td colspan ="2">You want to change the listing to the following:</td></tr>

<tr><td>Quantity Of Advertising Credits Offered</td><td><input type="text" name="quantity" value="'.$quantity.'" readonly></input></td>	</tr>
<tr><td>Asking Price (per Advertising Credit)</td><td><input type="text" name="price" value="'.$price.'" readonly></input></td></tr>
	
<tr><td>Currency Unit</td><td><input type="text" name="currency" value="'.$currency.'" readonly></input></td></tr>	

<tr><td>Bank Name</td><td><input type="text" name="bank_name" value="'.$bank_name.'" readonly></input></td></tr>
<tr><td>Bank Account Number</td><td><input type="text" name="bank_acct_number" value="'.$bank_acct_number.'" readonly></input></td></tr>
<tr><td>Name On Bank Account</td><td><input type="text" name="bank_acct_name" value="'.$bank_acct_name.'" readonly></input></td></tr>

<tr><td>Buyer\'s Deposit Time Limit (Minutes)</td><td><input type="text" name="buyertimelimit" value="'.$buyertimelimit.'" readonly></input></td></tr>
<tr><td>Your Response Transfer Time Limit (Hours)</td><td><input type="text" name="sellertimelimit" value="'.$sellertimelimit.'" readonly></input></td></tr>
<tr><td>Current Status</td><td>'.$status.'</td></tr>
<tr><td>Comments</td><td><textarea name="textarea"  rows="4" cols="50" readonly>'.$textarea.'</textarea></td></tr>
<tr><td colspan="2"><input type="submit" name="B1" value="SEND CHANGES"></td></tr>
</form></td></tr>	

</table>';

}
else
{
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


$status = 'offered';
/*if($scope == "users_listings"){
$ad_list = $adCreditExchange->viewbyseller($user_id, $status);
}
else
{*/
$ad_list = $adCreditExchange->viewbyseller("", $status);
//}
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

//look up depofo for each 
//assign to $depofo[bank_acctno] and $depofo[bank_acctname]
}
$total = $value[quantity] * $value[price];
if($value[id] == $_GET['listing_id']){
$bank_info = $adCreditExchange->view_depofo($value[bank_depofo]);
foreach($bank_info as $key=>$value3){
foreach($value3 as $key=>$value4){

}
}

include('mcrypt.php');
$data = base64_decode($value3[number]);
$data2 = base64_decode($value3[name]);
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
$msg .=  '

<h2>Make any changes you wish to make and submit the form. </h2>
<table style = "margin-left:auto; 
    margin-right:auto;" bgcolor="white" width="75%">

<tr><td>Offer ID</td>	<td>'.$value[id].'</td><td rowspan="13"></td></tr>
<form method="post" action="'. htmlentities($_SERVER['PHP_SELF']).'" style="width:80">
     <input type="hidden" name ="listing_id" value="'.$value[id].'">
 <input type="hidden" name="depofo" value="'.$value3[id].'">
  <input type="hidden" name ="orig_quantity" value="'.$value[quantity].'">               
          

<tr><td>Date/Time Posted</td><td>'.$value[timestampInit].'</td>	
<tr><td>Quantity Of Advertising Credits Offered</td><td><input type="text" name="quantity" value="'.$value[quantity].'"></input></td></tr>	
<tr><td>Asking Price (per Advertising Credit)</td><td><input type="text" name="price" value="'.$value[price].'"></input></td></tr>
	
<tr><td>Currency Unit</td><td><input type="text" name="currency" value="'.$value[currency].'"></input></td></tr>	

<tr><td>Bank Name</td><td><input type="text" name="bank_name" value="'.$value[bank_name].'"></input></td></tr>
<tr><td>Bank Account Number</td><td><input type="text" name="bank_acct_number" value="'.$decrypted.'"></input></td></tr>
<tr><td>Name On Bank Account</td><td><input type="text" name="bank_acct_name" value="'.$decrypted2.'"></input></td></tr>
<tr><td>Buyer\'s Deposit Time Limit (Minutes)</td><td><input type="text" name="buyertimelimit" value="'.$value[buyertimelimit].'"></input></td></tr>
<tr><td>Your Response Transfer Time Limit (Hours)</td><td><input type="text" name="sellertimelimit" value="'.$value[sellertimelimit].'"></input></td></tr>
<tr><td>Current Status</td><td>'.$value[status].'</td></tr>
<tr><td>Comments</td><td><textarea name="textarea"  rows="4" cols="50">'.$value[textarea].'</textarea></td></tr>
<tr><td colspan="2"><input type="submit" name="A1" value="SEND CHANGES"></td></tr></form>
</table><hr style="height:2em;color:#333;background-color:#333;>';

}//if($value[id] == $_GET['listing_id']){
}//close foreach
}//close else count > 0




$msg .= "



</td></tr></table>
";
}//close if/else isset A1
echo $msg;
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';

include($_SERVER['DOCUMENT_ROOT']."/members/templatebottomnsb.php");


} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

