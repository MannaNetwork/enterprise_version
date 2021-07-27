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

include('../../classes/ad_credit_exchange_class.php');
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

$msg="";

$msg .= '<div><h1 align="center">Transferring Your Advertising Credits For Free</h1> <br><table style = "margin-left:auto; 
    margin-right:auto;" bgcolor="gray" width="75%"><tr><td><p style="text-align:left; font-size: 125%;"> ';

if($balance - $get_frozen_accepted < 0 AND $get_frozen_offered == ""){
$msg .= "<div><h1>Sorry! You Do Not Have Any Advertising Credits Left To Sell.</h1>
<p>You have $get_frozen_accepted Advertising Credits That A Buyer Is Purchasing And Are About To Be Transferred.

</div>";

}
elseif($balance - $get_frozen_offered < 0 AND $get_frozen_accepted == ""){
$msg .= "<div><h1>Sorry! You Do Not Have Any Additional Advertising Credits Left To Sell (They Are All Already Listed For Sale).</h1>
<p>You have $get_frozen_offered Advertising Credits That Are Currently Offered For Sale.

</div>";

}
elseif($balance - $get_frozen_accepted - $get_frozen_offered < 0 ){
$msg .= "<div><h1>Sorry! You Do Not Have Any Additional Advertising Credits Left To Sell (You Have Sold Some The Rest Are Already Listed For Sale).</h1>
<p>You had a balance of $balance 
<p>$get_frozen_accepted of those are in the process of being purchased and are about to be transferred
<p>$get_frozen_offered are being offered for sale.

</div>";

}
else
{
$balance = $balance - $get_frozen_accepted - $get_frozen_offered;
$msg .=   "<div><h1>Your available balance of Advertising Credits that you could offer as available as Free TestNet Coin is $balance</h1></div>";
}



$msg .=   "
</td></tr></table></div>
<div>
<p><h1 style='color:red'>ATTENTION! BEFORE YOU PLACE YOUR CREDITS UP FOR SALE</H1>
<UL>
<LI>KNOW THAT YOUR CREDITS WILL BE FROZEN AFTER YOU PLACE THEM UP FOR SALE. YOU WILL NOT BE ABLE TO SPEND THEM FOR ADVERTISING NOR CAN YOU REDEEM THEM FOR BITCOIN FROM BUNGEEBONES WHILE THEY ARE OFFERED FOR SALE</LI>
<LI>YOU CAN EDIT AND/OR CANCEL THE LISTING ANYTIME BEFORE A BUYER ACCEPTS YOUR OFFER.</LI>
<LI>IF YOU CANCEL THEY WILL AUTOMATICALLY AND IMMEDIATELY BE UNFROZEN AND FULLY AVAILABLE AGAIN IN YOUR BUNGEEBONES ACCOUNT</LI>
<LI>IF/WHEN A BUYER ACCEPTS YOUR OFFER YOU WILL USE A FORM (AT BUNGEEBONES) TO PROVIDE YOUR ACTUAL BANK ACCOUNT NUMBER TO THE BUYER SO THEY CAN MAKE A DEPOSIT TO YOUR ACCOUNT</LI>
<LI>ONLY AFTER YOU SEND YOUR ACCOUNT DETAILS WILL YOUR CREDITS BECOME \"HARD\" FROZEN AND IT WILL NOT BE POSSIBLE TO CANCEL OR RETRIEVE THEM FOR THE DURATION OF THE <B>1ST</B> TIME PERIOD YOU SPECIFIED <U>WHEN YOU POSTED THE OFFER</U> </LI>
<LI>NOT RESPONDING TO THE BUYER'S NOTICE CAUSES NO CHANGE TO THE STATUS OF YOUR CREDITS - YOUR CREDITS ARE STILL OFFERED FOR SALE AND STILL IN THE FROZEN STATE (I.E. ABLE TO BE EDITED OR TAKEN OFF THE MARKET)</LI>
<LI>ONLY AFTER A BUYER RECEIVES THE DEPOSIT INFORMATION CAN THEY CONTINUE THE SALES PROCESS BY MAKING A CASH DEPOSIT TO YOUR BANK AND REPORTING BACK THEIR SUCCESS (THROUGH BUNGEEBONES) WITHIN THAT ALLOTED TIME</LI>
<LI>HARD FREEZING THE CREDITS PROTECTS AND SECURES THEM FOR THE BUYER (FROM DOUBLE SPENDING FOR EXAMPLE) DURING THE TIME WHEN THE BUYER MAY BE DEPOSITING CASH INTO A SELLER'S BANK</LI>
<LI>AFTER THEY REPORT BACK OF THEIR SUCCESSFUL DEPOSIT (WITHIN THE ALLOTED TIME OR, OTHERWISE, THE HARD FREEZE IS CANCELED ) IT WILL BE YOUR ONLY AND FINAL OPPORTUNITY TO HALT THE TRANSACTION AND ONLY IF THE BUYER HAS NOT ACTUALLY MADE THE DEPOSIT AS THEY REPORTED OR MADE A DEPOSIT OF A LESSER AMOUNT THAN STATED - FRAUDULENT DEPOSIT DETECTION IS ENTIRELY THE RESPONSIBILITY OF THE SELLERS THEMSELVES,</LI>
<LI>AFTER YOU CONFIRM THAT THE DEPOSIT HAS, INDEED, BEEN CORRECTLY MADE YOU CAN IMMEDIATELY TRANSFER THE CREDITS TO THE BUYER YOURSELF (FROM YOUR AD EXCHANGE CONTROL PANEL) OR IT WILL BE DONE FOR YOU AUTOMATICALLY AT THE END OF THE <B>2ND</B> TIME PERIOD YOU SPECIFIED <U>WHEN YOU LISTED THE OFFER</U>  </LI>
<LI>IF YOU DISCOVER THAT THE BUYER FALSELY REPORTED A DEPOSIT THEN YOU WOULD NEED TO RETURN TO THE AD EXCHANGE CONTROL PANEL AND SUBMIT THE MATTER FOR ARBITRATION TO BUNGEEBONES - DOING SO WILL CONTINUE THE HARD FREEZE AND CANCEL THE AUTOMATIC TRANSFER.</LI>
<LI>BUNGEEBONES WILL CONTACT THE BUYER WITH A REQUEST FOR PROOF OF THE DEPOSIT (I.E. A COPY OF THE DEPOSIT SLIP) </LI>
<LI>LACK OF A TIMELY RESPONSE FROM THE BUYER SIGNIFIES DEFAULT AND THE CREDITS WILL BE REMOVED FROM DEEP FREEZE AND RETURNED TO THE SELLER</LI>
<LI>RECEIPT OF A DEPOSIT SLIP CONFIRMING THE AGREED UPON AMOUNT WILL RESULT IN A REQUEST TO THE SELLER TO PROVIDE A COPY OF THEIR BANK DEPOSIT RECORDS</LI>
<LI>LACK OF A TIMELY RESPONSE FROM THE SELLER SIGNIFIES DEFAULT AND IN THE CREDITS BEING TRANSFERRED BY BUNGEEBONES ADMINISTRATION TO THE BUYER'S ACCOUNT</LI>
<LI>BANK RECORDS CONFIRMING THE BUYER'S DEPOSIT WILL, LIKEWISE, CAUSE THE CREDITS BEING TRANSFERRED BY BUNGEEBONES ADMINISTRATION TO THE BUYER'S ACCOUNT</LI>
<LI>IF THE SELLER IS RESPONSIBLE FOR EITHER OF THOSE DELAYS IN TRANSFER TO THE BUYER A FEE OF 10% OF THE TRANSACTION SHALL BE CHARGED TO THE SELLER AND SPLIT EQUALLY BETWEEN BUNGEEBONES AND THE BUYER FOR DAMAGES</LI>
<LI>PARTIAL PAYMENTS MAY BE RESOLVED IN VARIOUS WAYS AT THE DISCRETION OF THE BUNGEEBONES ADMINISTRATION</LI>
<LI>IF THE DOCUMENTATION SUPPLIED BY THE BUYER AND SELLER DO NOT MATCH THERE THERE ARE ONLY A COUPLE OF POSSIBILITIES 1) BANK ERROR 2) FRAUD ON THE PART OF EITHER THE BUYER OR THE SELLER BY PHOTO EDITING THE DOCUMENTS. <B>IN SUCH INSTANCES BUNGEEBONES RESERVES THE RIGHT TO USE AN INDEFINTE TIME TO RESOLVE THE MATTER AND THE CREDITS WILL CONTINUE TO BE DEEP FROZEN (I.E. NOT DISBURSED TO EITHER PARTY) FOR AN INDEFINITE TIME UNTIL THE ISSUE IS RESOLVED</LI>
<LI>ALL DECISIONS BY BUNGEEBONES ADMINISTRATION ARE FINAL</LI>
</div>

";





echo $msg;
echo '<h2><u>Close This Modal Page To Return To Advertising Credit Exchange Menu</u></h2></a>';
} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

