<?
if (isset($_GET['action']) && $_GET['action'] == "log_out") {
	//$test_page_protect->log_out(); // the method to log off
session_start();
session_destroy();
}
// include the configs
require_once($_SERVER['DOCUMENT_ROOT']."/members/config/config.php");
// load the login class
// load php-login components
require_once($_SERVER['DOCUMENT_ROOT']."/members/php-login.php");
// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...
$user_id = $_SESSION['user_id'];


include($_SERVER['DOCUMENT_ROOT']."/classes/link_class.php");//load order 1
include($_SERVER['DOCUMENT_ROOT']."/classes/categories_class.php");//load order 2
include($_SERVER['DOCUMENT_ROOT']."/classes/free_categories.php");//load order 3
include($_SERVER['DOCUMENT_ROOT']."/classes/price_slot_class.php");//load order 5
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 

//$default_price = "0.00";//this is what charge is applied to any not having a price set in the database
//$default_adj = "1";

if(isset($_POST['C1'])){

$selected_link_id = $_POST['selected_link_id'];
$price_slot_selected = $_POST['price_slot_selected'];
$cat_id = $_POST['cat_id'];
$wdgts_lnk_num = $_POST['wdgts_lnk_num'];
$wdgts_ID = $_POST['wdgts_ID'];
$subscribe = $_POST['subscribe'];
$fut_buyr_type = $_POST['fut_buyr_type'];


//The message var acts as a switch when sent to the functions calling them to make the transaction instead of reporting it. It then have all the functions on this page make a $message var instead of echos and then forward it in the header url for printing on the success page as a record
 $today = date('F j, Y, g:i a');
  $messaget = "<h2>BungeeBones Transaction Record</h2>
   <p>Date: $today"; 
    $message="";
     $text_email = "BungeeBones Transaction Record";
      $today = date("d");
       $month = date("m");
        $year = date("Y");
         $get_info = new price_slot_info;

         $Last_day_of_month = $get_info->lastday($month, $year);
	$numdays_in_month = substr($Last_day_of_month, -2, 2); 
	$numdays_remaining_in_month = $numdays_in_month-$today + 1;//note- this was done on 
		$LINKinfo = new link_info;
	$link_display = $LINKinfo->getUserByLinkId($selected_link_id);
	 $db_id= $link_display[1]; 
	   $db_category =$link_display[2]; 
            $db_url = $link_display[3];  
             $db_description = $link_display[4];   
              $db_name = $link_display[5]; 
               $db_start_date = $link_display[6];  
                $db_approved = $link_display[7]; 
$price_slot_info = new price_slot_info;
	//$wdgts_lnk_num = $price_slot_info->getWdgtsLnkNum($user_id);
	$text_email .= "";
		$message .=  '<h1>
The transaction details for the affected link is below. Your fee reflects the per-diem (daily) with regular automatic billing occurring daily from this point forward until cancelled by you or until there is insufficient funds in your account.</h1>';

	//	if($_POST['fut_buyr_type']=="testcoin" || $_POST['fut_buyr_type']=="bitcoin" ) {

//could be either a cancelling order or a slot change
		   //echo 'Or -- the real link number in paid list ', $db_id[$array_id];
		   //nee a funct to check if this link's selection amount is the same as wht they had. if so, it is a cancel. if not it is a modify.

  $to_do = $price_slot_info->getThisUsersEqualPriceSlot($db_category, $db_id, $price_slot_selected);
		       //returns either array("new", $price_slot_amnt); or array("cancel", $price_slot_amnt); or array("modify", $price_slot_amnt);
$coin_type = $_POST['fut_buyr_type'];
if($_POST['fut_buyr_type']=="bitcoin"){
$setFreebie = 2;
}
else
{
$setFreebie = 1;
}

if($to_do[0]=="new"){
	
				 //a purchasing order
						  //definitely a purchasing order
		$message_array = $price_slot_info->markPriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $db_id,  $db_category, $price_slot_selected, $setFreebie, $message, $coin_type, $to_do[0]);
		$message .= '<p style="color:red;">'.$message_array[0];
		$text_email .= $message_array[1];
		$price_slot_info->markFreebies($db_id, $coin_type);
//add an escrow payment here						  
//$price_slot_info->credit_daily_commiss();			



                                                        }elseif($to_do[0]=="cancel"){//this user has an active slot for that amount - they selected one they own - means cancel close it
								

	 $message_array = $price_slot_info->markPriceSlotsCancel($user_id, $db_id,  $db_category, $to_do[1], 0, $coin_type);//1st give them pro-rated credit
									  $message .= '<p style="color:red;">'.$message_array[0];
									   $text_email .= $message_array[1];
								 $price_slot_info->updatePriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $db_id, $db_category, $to_do[1], 0, $coin_type);//then deactivate the subscription
									 $price_slot_info->markFreebies($db_id, 'free');//last mark as freebie again in links table
									}
									elseif($to_do[0]=="modify")
									{
									//$message .=  '<h3>You are refunded the remaining portion of your previous payment and then charged a new prerated amount for the new price slot you selected.</h3>';
									//close one order one - slot
									 $message_array = $price_slot_info->markPriceSlotsCancel($user_id, $db_id,  $db_category, $to_do[1], 0, $coin_type);//1st give them pro-rated credit
									  $message .= '<p style="color:red;">'.$message_array[0];
									   $text_email .= $message_array[1];
									 $UsersTopBoughtSpot =   $price_slot_info->getUsersTopBoughtSpot($db_category, $user_id);
									  //returns array($id, $price_slot_amnt, $link_id);
								// $price_slot_info->updatePriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $db_id, $db_category, $to_do[1],0);
									     //open another in same cat and same link

$price_slot_info->updatePriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $db_id, $db_category, $price_slot_selected, $setFreebie, $coin_type);//then deactivate the subscription
              //  updatePriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $link_id, $cat_id, $purchased_slot_amount, $subscribe, $coin_type)
									   $message_array = $price_slot_info->markPriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $db_id,  $db_category, $price_slot_selected, $setFreebie,$message, $coin_type, $to_do[0]);
									   $message .= '<p style="color:red;">'.$message_array[0];
									  $text_email .= $message_array[1];

									}

             //need to detect here if the "message" comes from insufficient funds - send to insufficient funds page?
             //put a redirect to success page here to prevent resubmission through a page refresh - send along the var $message that has the entire transation
		include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2accusersconfig.php");
		include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
              $sql="select `user_email` from `users` where `user_id` = $user_id";
             $result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit134 11b Account' queryb");
$email = $row['user_email'];
	    $to = "robert.r.lefebvre@gmail.com";
	   $message2 = $text_email;
	  $subject = "BungeeBones Transaction";
	 $from = "info@BungeeBones.com";
	$headers = "From: $from";

       mail($to,$subject,$message2,$headers);
$message .="<h3>Please be sure to refresh the page when you close this modal window and return to your user control panel</h3>";
session_start();
$_SESSION['message']   = $message;

   header( "Location: http://bungeebones.com/members/success.php" ) ;
 }//close if isset c1

if(isset($_POST['B1'])){

//just create the $message as a report of the transaction ready for approval.  all in B1 use separate functions from functions that do updates idenifiable by "B1" at the start of their name
$selected_link_id = $_POST['selected_link_id'];

$fut_buyr_type  = $_POST['fut_buyr_type'];

$price_slot_selected = $_POST['price_slot_selected'];

 $LINKinfo = new link_info;
    $CATinfo = new category_info;
       $price_slot_info = new price_slot_info;
	 $link_display = $LINKinfo->getUserByLinkId($selected_link_id);

       //$send_array = array($links_user_id,  $db_idf, $db_categoryf, $db_urlf, $db_descriptionf, $db_name, $db_start_datef, $db_approvedf);
    	  $db_id= $link_display[1]; 
	   $db_category =$link_display[2]; 
            $db_url = $link_display[3];  
             $db_description = $link_display[4];   
              $db_name = $link_display[5]; 
               $db_start_date = $link_display[6];  
                $db_approved = $link_display[7]; 

  
	  $price_slot_info = new price_slot_info;
	   $wdgts_info_array = $price_slot_info->getWdgtsLnkNum($user_id);
               //array($wdgts_ID,$wdgts_lnk_num)

$wdgts_ID = $wdgts_info_array[0];
$wdgts_lnk_num = $wdgts_info_array[1];
	     $message ="";
		$text_email = "";
		  $forward_post="";
		
	 foreach($_POST as $key=>$value){
if($key==="fut_buyr_type"){
				
				 
					    if($fut_buyr_type=="free")
						{ //a purchasing order
						  $approval_req_msg = $price_slot_info->B1markPriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $db_id,  $db_category, $price_slot_selected, "1", $fut_buyr_type);
 $message .= $approval_req_msg[0];
						   $text_email .= $approval_req_msg[1];
						  $buy="true";
						}
					     if($fut_buyr_type=="testcoin" OR $fut_buyr_type=="bitcoin") {//a cancelling order or a slot change
				
       $to_do = $price_slot_info->getThisUsersEqualPriceSlot($db_category, $db_id, $price_slot_selected);
//either returns array("cancel", $price_slot_amnt); or array("modify", $price_slot_amnt);
							if($to_do[0]=="cancel"){//this user has an active slot for that amount - they selected one they own - means cancel close it
  $approval_req_msg = $price_slot_info->B1markPriceSlotsCancel($user_id,$db_id,  $db_category, $to_do[1], 0, $fut_buyr_type);//1st give them pro-rated credit
                                      //B1markPriceSlotsCancel($user_id, $link_id, $cat_id, $purchased_slot_amount,$subscribe, $coin_type)
							     $message .= $approval_req_msg[0];
							    $text_email .= $approval_req_msg[1];
							  $cancel="true";
							}
							else
							{
							//close one order one - slot
 $approval_req_msg = $price_slot_info->B1markPriceSlotsCancel($user_id,$db_id,  $db_category, $to_do[1], 0, $fut_buyr_type);//1st give them pro-rated credit
		                  //B1markPriceSlotsCancel($user_id, $link_id, $cat_id, $purchased_slot_amount,$subscribe, $coin_type)
					 $message .= $approval_req_msg[0];
							       $text_email .= $approval_req_msg[1];
							       //open another in same cat and same link
	
$approval_req_msg2 = $price_slot_info->B1markPriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $db_id,  $db_category, $price_slot_selected, "1", $fut_buyr_type);
                                     //B1markPriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $link_id, $cat_id, $purchased_slot_amount,$subscribe, $coin_type)						   
//and add another escrow payment here
$price_slot_info->credit_daily_commiss();
  $message .= $approval_req_msg2[0];
							  $text_email .= $approval_req_msg2[1];
							$exchange="true";
							}
					      }
			 }

		}

		If($approval_req_msg=="insufficient"){
		include('insufficient.php');
		}
		else
		{

 echo '<h1>Please review the transaction details below.</h1> ';
//echo 'line 238', $fut_buyr_type;
//echo '<br> $to_do[0] = ', $to_do[0];
			if($buy=="true"){
			 echo "<p style='color: red;'>Important to note; Instant Refunds can be gotten for a period of up to one hour after a purchase by going through the cancellation process (i.e. select the same price slot radio button as what you are purchasing now). Any time after the one hour period expires you can still cancel but you will not be refunded the per-diem for the current day.  </p>
<p>&nbsp;</p>
<p style='text-align: left;'>Remember, your purchase is for a position in a price slot NOT A POSITION ON A PAGE. For more information about bidding and price slots see <a target-'_blank' href='http://bungeebones.com/members/modal/general_instructions.php?link_id=2311'>the General Bidding Information page</a>		  
";
			  echo '<p>&nbsp;</p><p style="text-align: left;">The cancelation of a previous purchase can be done easily by selecting the radio for the SAME AMOUNT as the price slot slot you are purchasing now (the price slot price that you are purchasing now will be listed in red just above the radio buttons on your user control panel when you return). ';

echo '<p style="text-align: left;">Review the transaction details below and submit the form if correct. You will have 60 minutes to cancel any subscription if you decide to and your account will receive credit immediately. You can cancel at anytime but after the 60 minute limit your account will not be reimbursed for this day\'s daily fee. See the General Bidding Information button at the tops of both free and page sections of your User Control Panel<p style="text-align: left;">';
			 echo '<p>&nbsp;</p><p style="text-align: left;">Your link will be displayed in its new position instantly across the BungeeBones system. To verify this you can visit your category on any of the Distributed Web Directory installations and see your link in its new position.';
			}
			elseif(($fut_buyr_type=="bitcoin" OR $fut_buyr_type=="testcoin") AND $to_do[0]=="modify"){
			echo '<p>&nbsp;</p><p style="text-align: left;">The cancelation of a previous purchase or the switching of a link from one price slot to another are handled as two transactions, but reported together. One cancels the previously held price slot while the next purchases the new price slot. <B> IMPORTANT FOR PLACEMENT - Seniority starts over with any price slot move or purchase and your link will be displayed behind any already in the price slot. </b>'; 
			}
			elseif($fut_buyr_type=="paid" AND $to_do[0]=="cancel"){
			echo '<p>&nbsp;</p><p style="text-align: left;">You are about to cancel a previous purchase because you selected the green radio button representing the SAME AMOUNT that you purchased it for (listed in red just above the radio buttons). ';
			}
			
			echo $message;
			echo '<p style="text-align: left;"><FORM name="F3" action="'.$_SERVER['PHP_SELF'].'" method="POST">';


$forward_post .='<input type="hidden" name="selected_link_id" value="'.$db_id.'">';
$forward_post .='<input type="hidden" name="cat_id" value="'.$db_category.'">';
$forward_post .='<input type="hidden" name="price_slot_selected" value="'.$price_slot_selected.'">';
$forward_post .='<input type="hidden" name="wdgts_lnk_num" value="'.$wdgts_lnk_num.'">';
$forward_post .='<input type="hidden" name="wdgts_ID" value="'.$wdgts_ID.'">';
$forward_post .='<input type="hidden" name="subscribe" value="1">';
$forward_post .='<input type="hidden" name="fut_buyr_type" value="'.$fut_buyr_type.'">';
$forward_post .='<table><tr><td><br>Link Id Affected: '.$db_id.'</td></tr>';
$forward_post .='<tr><td><br>Category Of Link: '.$db_category.'</td></tr>';
$forward_post .='<tr><td><br>Price Slot Selected: '.$price_slot_selected.'</td></tr>';
$forward_post .='<tr><td><br>Coin Type Used: '.$fut_buyr_type.'</td></tr></table>';


echo $forward_post.'<INPUT type="submit" name="C1" value="Accept"></form>';
	}	
}//close if B1
elseif(isset($_POST['A1']))
{
//coming in from the form, if it is either a testnet or a bitcoin or free, so get the include accordingly

$selected_link_id = $_POST['link_id'];
if(isset($_POST['fut_buyr_type'])){
$fut_buyr_type=$_POST['fut_buyr_type'];
}
else
{
$fut_buyr_type="free";
}
include('get_buy_placement_'.$fut_buyr_type.'_ps.php');


}//close else A1
else
{
$price_slot_info = new price_slot_info;
$balance = $price_slot_info->getBuyersBalanceTN($user_id);

$balance_bitcoin = number_format($balance[0], 8, '.', '');
$balance_testcoin = number_format($balance[1], 8, '.', '');
echo '<p style="text-align: left;"><FORM name="F3" action="'.$_SERVER['PHP_SELF'].'" method="POST">';
echo '
<input type="hidden" name="link_id" value="'.$_GET['link_id'].'">';
if($balance_bitcoin > 0 AND $balance_testcoin > 0){
echo "
<h1>You have a balance in both your Bitcoin account (".$balance_bitcoin.") and in your TestCoin account (".$balance_testcoin."). Which do you want to use for this purchase? </h1>
<input type='radio' name='fut_buyr_type' value='bitcoin'> Bitcoin&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <input type='radio' name='fut_buyr_type' value='testcoin'>Testcoin<br>
<h3>To add more Testcoin to your account go to <a href='../testcoin_deposit'>the Testcoin Deposit page</a> to get an address and follow the instructioons to go the testnet net faucet.</h3>
<h3>To add more Bitcoin to your account go to <a href='../bitcoin_deposit'>the Bitcoin Deposit page</a> to get an address and follow the instructioons to go the testnet net faucet.</h3>


";
}
elseif($balance_bitcoin > 0){
echo "
<input type='hidden' name='fut_buyr_type' value='bitcoin'>
<h1>You have a balance available in your Bitcoin account (".$balance_bitcoin."). Proceed if you wish to purchase better placement with Bitcoin. If you wish to add Testcoin (free) and use it instead go to <a href='../testnet_deposit.php'> the Testnet Deposit Form</a>
<h3>To add more Bitcoin to your account go to <a href='../bitcoin_deposit'>the Bitcoin Deposit page</a> to get an address and follow the instructioons to go the testnet net faucet.</h3>";

}
elseif($balance_testcoin >0){
echo "
<input type='hidden' name='fut_buyr_type' value='testcoin'>
<h1>You have a balance available in your Testcoin account (".$balance_testcoin."). Proceed if you wish to purchase better placement with Testcoin (understand that you can be outbid by even the tiniest amount of Bitcoin). </h1>
<h3>If you wish to add Bitcoin and use it instead go to <a href='../bitcoin_deposit.php'> the Bitcoin Deposit Form</a>  to get an address and the instructions.
<h3>To add more Testcoin to your account go to <a href='../testcoin_deposit'>the Testcoin Deposit page</a> to get an address and the instructions to go the testnet net faucet.</h3>

";
}
else//is free
{
echo '<input type="hidden" name="fut_buyr_type" value="free">';
echo '<h3>We have not detected a balance in your account. Would you like to fund it now with Free testnet coin? They act just like Bitcoin but have no cash value (they are mostly used by Bitcoin developers to test their software but we use it to provide our users a demo of our system and to let them see what Bitcoin is like).</h3>';
echo '<h3>To fund your account with Testcoins go to <a href="../testcoin_deposit">the Testcoin page</a> to get an address and follow the instructioons to go the testnet net faucet.</h3>';
echo '<h3>To add Bitcoin to your account go to <a href="../bitcoin_deposit">the Bitcoin Deposit page</a> to get an address and follow the instructioons to go the testnet net faucet.</h3>';
}

echo "
<h3>To return to the User Control Panel close this modal window (top right).</h3><br>
<INPUT type='submit' name='A1' value='Proceed'></form>";
}

	} else {
    // the user is not logged in...

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
?>	
