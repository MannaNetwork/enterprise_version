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
print_r($_POST['listing_id']);


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

$msg .= "<p>The following BungeeBones users are offering the listed Advertising Credits for sale. BungeeBones 1) Guarantees that they have the Advertising Credits 2) Provides this market bulletin to them as an alternate way to liquidate their Advertising Credits to users that need them 3) will also redeem them in Bitcoin 4) Provides a secure, step by step procedure for transferring credits from one user to another 5) Functions like an escrow service between buyer and seller 6) Can function as an arbitrator 



<table style = \"margin-left:auto; 
    margin-right:auto;\" bgcolor:white; width:75%;\">

<tr><td><h1>Advertising Credits Are For Sale By Owners And Not BungeeBones.com</h1>";




$msg .="
 </td></tr>
<tr><td>&nbsp;
</td></tr>
<tr><td>
";

include('../../classes/ad_credit_exchange_class.php');
$adCreditExchange = new adCreditExchange;
$listing_id = $_GET['listing_id'];//works for incoming to page
if($listing_id==""){
$listing_id = $_POST['listing_id'];//works for incoming to page
}

echo ' $listing_id = ', $listing_id;
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

//look up depofo for each 
//assign to $depofo[bank_acctno] and $depofo[bank_acctname]
}

$msg .=  '

<style>@import url("blinkfile.css")</style>


<table style = \"margin-left:auto; 
    margin-right:auto;\" bgcolor=\"white\" width=\"75%\">
<table border="2" cellpadding="5" >
<tr><td>ID</td>	<td>'.$value[id].'</td><td rowspan="5"><!--<a href="buy.php?listing_id ='.$value[id].'"><img src="../../images/buynow.jpg"></a> -->

<form method="post" action="'. htmlentities($_SERVER['PHP_SELF']).'" style="width:40">
    <input type="hidden" name ="listing_id" value="'.$value[id].'">
              
           <input type="image" src="../../images/buynow.jpg" alt="Submit">
</form>
</td>
<tr><td>Time Init</td><td>'.$value[timestampInit].'</td>	
<tr><td>Quantity Offered</td><td>'.$value[quantity].'</td>	
<tr><td>Asking Price</td><td>'.$value[price].'</td>	
<tr><td>Currency</td><td>'.$value[currency].'</td>	
<tr><td>Bank Name</td><td>'.$value[bank_name].'</td><td rowspan="5"><!--<a href="counteroffer.php?listing_id ='.$value[id].'"><img src="../../images/counteroffer.jpg"></a>-->

<form method="post" action=\"'. htmlentities($_SERVER['PHP_SELF']).'" style="width:40">
     <input type="hidden" name ="listing_id" value="'.$value[id].'">
                  <input type="image" src="../../images/buynow.jpg" alt="Submit">
          
</form>
</td>	
<tr><td style="color:red"><blink>You Will Have This Much Time To Make Your Deposit* (Minutes)</blink></td><td>'.$value[buyertimelimit].'</td>
<tr><td>Seller\'s Response Transfer Time Limit (Hours)</td><td>'.$value[sellertimelimit].'</td>
<tr><td>Current Status</td><td>'.$value[status].'</td>
<tr><td>Comments</td><td>'.$value[textarea].'</td></tr>
<tr><td colspan="3">*The timer starts when you click the "Buy Now" button. If the time limit is too short for you then <blink>do not do that</blink>. Go back and make a counter offer to request more time from the seller (FYI you can counter offer any term of the transaction). <p>But the <u>recommended best practice</u> is to use a Smart Phone or laptop: 1) First go as near to the bank branch where you will make the deposit as you can (and still be able to access the Internet -[sic. Starbucks, MacDonalds etc]) 2) From there (near or at the bank), using the phone or laptop, return to BungeeBones.com (to this same page) and click the "Buy Now" button. 3) You will be just minutes away from completing the deposit 4) Upon completion of the deposit repeat the above procedure to access the Internet and return to BungfeeBones.com to report the successful deposit. THAT WILL PERMANENTLY FREEZE THE CREDITS FOR YOU!</td></tr>

</table>';
}
}//close else count > 0




$msg .= "



</td></tr></table>
";







echo $msg;
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';

include($_SERVER['DOCUMENT_ROOT']."/members/templatebottomnsb.php");


} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

