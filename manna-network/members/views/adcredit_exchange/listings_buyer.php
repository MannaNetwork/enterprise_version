<?

//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
get_header();
//include('bootstrap_header.php');
//include($_SERVER['DOCUMENT_ROOT']."/manna-network/members/classes/member_page_class.php");//load order 1
include(dirname(__DIR__, 3)."/manna-network/members/classes/member_page_class.php");//load order 1
include(dirname(__DIR__, 3)."/manna-configs/db_cfg/agent_config.php");//load order 1

$linkInfo = new member_info();



    
// load the login class

// load php-login components
include(dirname(__DIR__, 3)."/manna-network/members/php-login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

 
    
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...

$user_id = $_SESSION['user_id'];

$moniker="<h5>All Your AdCoin Advertisements</h5>";
$body_width="wide";

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

if($value[timestampBuyerin] >0){
if($value[buyerid] == $user_id){
echo '<table id="member" width="100%"><tr><td><table><tr><td><h1>You already have bought these credits.To verify this visit your pending reports list (look for Offer ID '.$listing_id.')</h1>';
echo '</td></tr></table></td></tr></table>';
echo '<a href="buyerreport.php"> <h3><u>Go To The Reporting Page</h3></a>';
echo '<a href="listings_buyer.php"> <h3><u>Return To For Sale List </h3></a>';
echo '<a href="index_buyer.php"> <h3><u>Return To Advertising Credit Exchange Main Menu</u></h3></a>';
echo '<a href="../index.php"> <h3><u>Return To User Control Panel</u></h3></a>';


include("../../960bottom.php");

exit();

}
else
{
echo '<table id="member" width="100%"><tr><td><table><tr><td><h1>Sorry, but it appears that those advertising Credits are no longer available. it could be that the owner has withdrawn them from the market or someone else bought them ahead of you. To verify this you should no longer see them listed for sale in the list (look for Offer ID '.$listing_id;
echo ").</h1></td></tr></table></td></tr></table>";
echo '<a href="listings_buyer.php"> <h2><u>Return To For Sale List </a>';
echo '<a href="index_buyer.php"> <h2><u>Return To Advertising Credit Exchange Main Menu</u></h2></a>';
echo '<a href="../index_buyer.php"> <h2><u>Return To User Control Panel</u></h2></a>';


include("../../960bottom.php");
exit();
}
}
if($value[status] != "offered"){
echo '<br>status should be offered - if not exit', $value[status];
echo '<a href="index_buyer.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
echo '<a href="../index_buyer.php"> <h2><u>Return To User Control Panel</u></h2></a>';

include("../../960bottom.php");

exit();
}
}

$adCreditExchange->buy_listing($user_id, $listing_id);//adds the buyer's user id time and status change to listings
$depofo_info=$adCreditExchange->view_depofo($value[bank_depofo]);
$key = 'Google';
$iv = mcrypt_create_iv(
    mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC),
    MCRYPT_DEV_URANDOM
);


//To Decrypt:

$data = base64_decode($depofo_info[0]['number']);
$data2 = base64_decode($depofo_info[0]['name']);
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
echo '<table id="member" width="100%"><tr><td><table><tr><td>
<h1>SUCCESS!</h1>
<p class="smallerFont">Your first step in purchasing the advertising credits has been successful. You now have '.$value[buyertimelimit].' minutes to BOTH deposit the amount agreed upon AND to report back to BungeeBones.com that the deposit was successful!
<p class="smallerFont">You will need the following information to deposit the funds:
<br>The bank name is : '.$value[bank_name].'.
<br>The Account Number to Deposit The Money Is: '.$decrypted.' 
<br>The Name of the account holder is :'.$decrypted2;
echo '<p class="smallerFont">When Referring To This Transaction With BungeeBones.com Use The Listing ID Number '.$listing_id;
echo "</p></td></tr></table></td></tr></table>";

echo '<p class="smallerFont">You can make the report of the successful deposit here ...<a href="buyerreport.php">Go To The Reporting Page</a> (bookmark the link or write the location down TO SAVE TIME). It is also available from your BungeeBones User Control Panel (after you login) under the "Buy AdCoin" button at the top of left column. REMEMBER! TIME IS OF THE ESSENCE THAT YOU REPORT A SUCCESSFUL DEPOSIT HAS BEEN MADE WITHIN THE ALLOCATED TIME!';

}
elseif(isset($_POST['A1'])){
echo '<table id="member" width="100%"><tr><td><table><tr><td> <p class="smallerFont">REVIEW THE TERMS OF THE CONTRACT CAREFULLY, ESPECIALLY THE AMOUNT OF TIME YOU HAVE TO MAKE THE DEPOSIT. <p class="smallerFont">REMEMBER! TIME IS OF THE ESSENCE THAT YOU REPORT A SUCCESSFUL DEPOSIT HAS BEEN MADE WITHIN THE ALLOCATED TIME! NOT PERFORMING THE OBLIGATIONS WITHIN THE TIME PERIOD SPECIFIED COULD AFFECT YOUR PAYMENT AND/OR FUTURE PARTICIPATION. <p class="smallerFont">REVIEW THE "BEST PRACTICE" ** AT THE BOTTOM OF THE PAGE TO SHORTEN THE TIME IT WILL TAKE TO MAKE THE DEPOSIT!</p>';
$listing_id = $_POST['listing_id'];
include($_SERVER['DOCUMENT_ROOT']."/classes/ad_credit_exchange_class.php");
$adCreditExchange = new adCreditExchange;



$listing_info = $adCreditExchange->viewbylisting($listing_id);

if(count($listing_info)==0)
{
echo '<br>&nbsp;<br><br>&nbsp;<br><h1>Sorry! There were no results found.</h1>';
echo '<a href="index_buyer.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';


include("../../960bottom.php");
exit();
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
//assign to $depofo[bank_acctno] and $depofo[bank_acctname]<style>@import url("blinkfile.css")</style>
}

$msg .=  '

<style>@import url("blinkfile.css")</style>


<table id="member" width="75%">
<table border="2" width="100%" cellpadding="5" >
<tr><td>Offer ID</td>	<td>'.$value[id].'</td><td rowspan="5">

<form method="post" action="'. htmlentities($_SERVER['PHP_SELF']).'" style="width:80">
    <input type="hidden" name ="listing_id" value="'.$value[id].'">
        <input type="hidden" name ="B1" value="1">      
           <input type="image" width="60" height="50" src="../../../images/buynow.jpg" alt="Submit">
</form>
</td>
<tr><td>Date/Time Posted</td><td>'.$value[timestampInit].'</td>	
<tr><td>Quantity Offered</td><td>'.$value[quantity].'</td>	
<tr><td>Asking Price</td><td>'.$value[price].'</td>';

	if($value['currency'] == "tes"){
$msg .=  '<tr><td>Currency Unit</td><td style="color:red" >NON Negotiable TestCoin</td>';
}
else
{
$msg .=  '<tr><td>Currency Unit</td><td>'.$value['currency'].'</td>';
}
$msg .=  '<tr><td  style="background-color:yellow;">Total Amount Due</td><td style="background-color:yellow;">'.$total.'</td>	
<tr><td>Bank Name</td><td>'.$value[bank_name].'</td><td rowspan="5">

<form method="post" action=\"'. htmlentities($_SERVER['PHP_SELF']).'" style="width:80">
<input type="hidden" name ="B1" value="1">
     <input type="hidden" name ="listing_id" value="'.$value[id].'">
 </form>
</td>	}
<tr><td><blink>You Will Have This Much Time To Make Your Deposit* (Minutes)</blink></td><td>'.$value[buyertimelimit].'</td>
<tr><td>Seller\'s Response Transfer Time Limit (Hours)</td><td>'.$value[sellertimelimit].'</td>
<tr><td>Current Status</td><td>'.$value[status].'</td>
<tr><td>Comments</td><td>'.$value[textarea].'</td></tr>
<tr><td colspan="3"><p class="smallerFont">*The timer starts when you click the "Buy Now" button. If the time limit is too short for you then <blink>do not do that</blink>. </td></tr></table>

<tr><td><p class="smallerFont">**The <u>recommended best practice</u> is to use a Smart Phone or laptop: 1) First go as near to the bank branch where you will make the deposit as you can (and still be able to access the Internet -[ideas - Starbucks, MacDonalds etc]) 2) From there (near or at the bank), using the phone or laptop, return to BungeeBones.com (to this same page) and click the "Buy Now" button. 3) You will be just minutes away from completing the deposit 4) Upon completion of the deposit repeat the above procedure to access the Internet and return to BungfeeBones.com to report the successful deposit. THAT WILL PERMANENTLY FREEZE THE CREDITS FOR YOU!</td></tr>

</table>';
}
}//close else count > 0




$msg .= "



</td></tr></table>
";







echo $msg;
}
else
{
$msg="<h3>The following BungeeBones users are offering their Advertising Credits for sale</h3>

<h3>BungeeBones provides the following:

<ul><li> Provides a secure, step by step procedure for transferring credits from seller to buyer</li><Li>Certifies that the sellers have the Advertising Credits available to transfer and freezes them while they are in the sales transaction</li><li>Provides a communication channel to notify the seller that the buyer has made payment (BungeeBones DOES NOT RECEIVE THE PAYMENT FOR THE BUYER) </li><li> The software script functions like an automatic escrow service between buyer and seller for the delivery of the advertising credits</li><li> Can help disputing parties agree on an arbitrator </li></ul>
<h3  style = 'text-align:center;'><a href='../modal/buyer_details.php' title='General Instructions' rel='gb_page_center[640, 480]'><div style=\" margin: 0 auto; width:145px; background-image: url('images960/1x1tran.gif'); background-repeat: repeat-x; background-color: navy; color:white; font-size:100%;-moz-border-radius: 15px;
		border-radius: 15px;text-align: center;\">&nbsp;(MORE INFO)&nbsp;</div></a></h3>";
include($_SERVER['DOCUMENT_ROOT']."/members/classes/ad_credit_exchange_class.php");
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


$status = 'offered';
/*if($scope == "users_listings"){
$ad_list = $adCreditExchange->viewbyseller($user_id, $status);
}
else
{*/
$ad_list = $adCreditExchange->viewbystatus($status);
//}

if(count($ad_list)==0)
{
echo '<br>&nbsp;<br><br>&nbsp;<br><h1>Sorry! There were no results found.</h1>';
echo '<a href="index_buyer.php"> <h2><u>Return To Advertising Credit Exchange Buyer Menu</u></h2></a>';
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Main Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';


include("../../960bottom.php");
exit();
}
else
{
    /*** convert the array to object ***/
 //   $array =$adCreditExchange->objectToArray($ad_list);

    /*** show the array ***/


foreach($ad_list as $key => $value)
{
    if (!is_array($value))
    {
        echo $key ." => ". $value ."\r\n" ;

    }
    else
    {
      foreach ($value as $key2 => $value2)
       {

   

       }
$msg .=  '<hr>
<table border="2" cellpadding="5" >
<tr><td>Offer ID</td>	<td>'.$value['id'].'</td><td rowspan="5">
<form method="post" action="'. htmlentities($_SERVER['PHP_SELF']).'" style="width:80">
     <input type="hidden" name ="listing_id" value="'.$value['id'].'">
<input type="hidden" name ="A1" value="1">
                  <input type="image" width="60" height="50" src="../../../images/buynow.jpg" alt="Submit">
 </form> </td>
<tr><td>Date/Time Posted</td><td>'.$value['timestampInit'].'</td>	
<tr><td>Quantity Of Advertising Credits Offered</td><td>'.$value['quantity'].'</td>	
<tr><td>Asking Price (per Advertising Credit)</td><td>'.$value['price'].'</td>';
	if($value['currency'] == "tes"){
$msg .=  '<tr><td>Currency Unit</td><td style="color:red" >NON Negotiable TestCoin</td>';
}
else
{
$msg .=  '<tr><td>Currency Unit</td><td>'.$value['currency'].'</td>';
}
$msg .=  '	
<tr><td>Bank Name</td><td>'.$value['bank_name'].'</td>
<tr><td>Your Deposit Time Limit (Minutes)</td><td>'.$value['buyertimelimit'].'</td>
<tr><td>Seller\'s Response Transfer Time Limit (Hours)</td><td>'.$value['sellertimelimit'].'</td>
<tr><td>Current Status</td><td>'.$value['status'].'</td>
<tr><td>Comments</td><td width="50%">'.$value['textarea'].'</td></tr></table><hr>';
    }
}

}//close else count > 0




//$msg = '<table id="member"><tr><td>'.$msg;



//$msg .= "</td></tr></table>
//";





echo $msg;

//echo $msg;

}//close else isset A1
echo '<a href="index_buyer.php"> <h2><u>Return To Advertising Credit Exchange Buyer Menu</u></h2></a>';
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Main Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';


include("../../960bottom.php");

} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

