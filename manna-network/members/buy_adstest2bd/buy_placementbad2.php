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
$type = $_GET['type'];
//$default_price = "0.00";//this is what charge is applied to any not having a price set in the database
//$default_adj = "1";

if(isset($_POST['C1'])){
$selected_link_id = $_POST['selected_link_id'];
$price_slot_selected = $_POST['price_slot_selected'];
$cat_id = $_POST['cat_id'];
$wdgts_lnk_num = $_POST['wdgts_lnk_num'];
$wdgts_ID = $_POST['wdgts_ID'];
$subscribe = $_POST['subscribe'];
$buyr_type = $_POST['buyr_type'];
$currency = $_POST['currency'];
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
	$price_slot_info = new price_slot_info;
	$LINKinfo = new link_info;
	$paid_link_display = $LINKinfo->getUserByLinkId($selected_link_id);
	 $db_idp= $paid_link_display[1]; 
	   $db_categoryp =$paid_link_display[2]; 
            $db_urlp = $paid_link_display[3];  
             $db_descriptionp = $paid_link_display[4];   
              $db_namef = $paid_link_display[5]; 
               $db_start_clone_datep = $paid_link_display[6];  
                $db_approvedp = $paid_link_display[7]; $price_slot_info = new price_slot_info;
	//$wdgts_lnk_num = $price_slot_info->getWdgtsLnkNum($user_id);
	$text_email .= "";
		$message .=  '<h1>Thank you! 
The transaction details for the affected link is below. Your fee reflects the per-diem (daily) with regular automatic billing occurring daily from this point forward until cancelled by you or until there is insufficient funds in your account.</h1>';
  // foreach($_POST as $key=>$value){
	   // $array_id = substr($key, 4);

	   if($_POST['buyr_type']=="free"){ //definitely a purchasing order
		$message_array = $price_slot_info->markPriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $db_idp,  $db_categoryp, $price_slot_selected, "1", $message, $currency);
		$message .= '<p style="color:red;">'.$message_array[0];
		$text_email .= $message_array[1];
		$price_slot_info->markFreebies($db_idp, "1");
//add an escrow payment here						  
$price_slot_info->credit_daily_commiss();
		}
		if($_POST['buyr_type']=="paid") {//could be either a cancelling order or a slot change
		   //echo 'Or -- the real link number in paid list ', $db_idp[$array_id];
		   //nee a funct to check if this link's selection amount is the same as wht they had. if so, it is a cancel. if not it is a modify.
		     
		       
		       $to_do = $price_slot_info->getThisUsersEqualPriceSlot($db_categoryp, $db_idp, $price_slot_selected);
		       //returns either array("cancel", $price_slot_amnt); or array("modify", $price_slot_amnt);

if($to_do[0]=="cancel"){//this user has an active slot for that amount - they selected one they own - means cancel close it
			 $message_array = $price_slot_info->markPriceSlotsCancel($user_id, $db_idp,  $db_categoryp, $to_do[1], 0, $currency);//1st give them pro-rated credit
			  $message .= '<p style="color:red;">'.$message_array[0];
			   $text_email .= $message_array[1];
		 $price_slot_info->updatePriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $db_idp, $db_categoryp, $to_do[1], 0);//then deactivate the subscription
			 $price_slot_info->markFreebies($db_idp, 0);//last mark as freebie again in links table
			}
			else
			{
			//$message .=  '<h3>You are refunded the remaining portion of your previous payment and then charged a new prerated amount for the new price slot you selected.</h3>';
			//close one order one - slot
			 $message_array = $price_slot_info->markPriceSlotsCancel($user_id, $db_idp,  $db_categoryp, $to_do[1], 0, $currency);//1st give them pro-rated credit
			  $message .= '<p style="color:red;">'.$message_array[0];
			   $text_email .= $message_array[1];
			 $UsersTopBoughtSpot =   $price_slot_info->getUsersTopBoughtSpot($db_categoryp, $user_id);
			  //returns array($id, $price_slot_amnt, $link_id);
		// $price_slot_info->updatePriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $db_idp, $db_categoryp, $to_do[1],0);
			     //open another in same cat and same link
			    $message_array = $price_slot_info->markPriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $db_idp,  $db_categoryp, $price_slot_selected, "1",$message, $currency);
			   $message .= '<p style="color:red;">'.$message_array[0];
			  $text_email .= $message_array[1];

			}
		   }
	//don't need foreach    }
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
      header( "Location: http://bungeebones.com/members/success.php" ) ;
 }//close if isset c1

if(isset($_POST['B1'])){
//just create the $message as a report of the transaction ready for approval.  all in B1 use separate functions from functions that do updates idenifiable by "B1" at the start of their name
$selected_link_id = $_POST['selected_link_id'];
$buyr_type  = $_POST['buyr_type'];
$price_slot_selected = $_POST['price_slot_selected'];
 $LINKinfo = new link_info;
    $CATinfo = new category_info;
       $price_slot_info = new price_slot_info;
	 $paid_link_display = $LINKinfo->getUserByLinkId($selected_link_id);

       //$send_array = array($links_user_id,  $db_idf, $db_categoryf, $db_urlf, $db_descriptionf, $db_namef, $db_start_datef, $db_approvedf);
    	  $db_idp= $paid_link_display[1]; 
	   $db_categoryp =$paid_link_display[2]; 
            $db_urlp = $paid_link_display[3];  
             $db_descriptionp = $paid_link_display[4];   
              $db_namef = $paid_link_display[5]; 
               $db_start_clone_datep = $paid_link_display[6];  
                $db_approvedp = $paid_link_display[7]; 

  
	  $price_slot_info = new price_slot_info;
	   $wdgts_info_array = $price_slot_info->getWdgtsLnkNum($user_id);
               //array($wdgts_ID,$wdgts_lnk_num)

$wdgts_ID = $wdgts_info_array[0];
$wdgts_lnk_num = $wdgts_info_array[1];
	     $message ="";
		$text_email = "";
		  $forward_post="";
		
	foreach($_POST as $key=>$value){
if($key==="buyr_type"){
				
				 
					     if($buyr_type=="free")
						{ //a purchasing order
						  $approval_req_msg = $price_slot_info->B1markPriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $db_idp,  $db_categoryp, $price_slot_selected, "1", $currency);
 $message .= $approval_req_msg[0];
						   $text_email .= $approval_req_msg[1];
						  $buy="true";
						}
					     if($buyr_type=="paid") {//a cancelling order or a slot change
				
       $to_do = $price_slot_info->getThisUsersEqualPriceSlot($db_categoryp, $db_idp, $price_slot_selected);
//either returns array("cancel", $price_slot_amnt); or array("modify", $price_slot_amnt);
							if($to_do[0]=="cancel"){//this user has an active slot for that amount - they selected one they own - means cancel close it
							   $approval_req_msg = $price_slot_info->B1markPriceSlotsCancel($user_id,$db_idp,  $db_categoryp, $to_do[1], 0, $currency);//1st give them pro-rated credit
							     $message .= $approval_req_msg[0];
							    $text_email .= $approval_req_msg[1];
							  $cancel="true";
							}
							else
							{
							//close one order one - slot
							   $approval_req_msg = $price_slot_info->B1markPriceSlotsCancel($user_id,$db_idp,  $db_categoryp, $to_do[1], 0, $currency);//1st give them pro-rated credit
							     $message .= $approval_req_msg[0];
							       $text_email .= $approval_req_msg[1];
							       //open another in same cat and same link
	
							       $approval_req_msg2 = $price_slot_info->B1markPriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $db_idp,  $db_categoryp, $price_slot_selected, "1", $currency);
							   
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

 echo '<h1>Please review the transaction details below.</h1> <p style="color: red;">Important to note; Instant Refunds can be gotten for a period of up to one hour after a purchase by going through the cancellation process (i.e. select the same price slot radio button as what you are purchasing now). Any time after the one hour period expires you can still cancel but you will not be refunded the per-diem for the current day.  </p>';
			if($buy=="true"){
			 echo "<p style='text-align: left;'>Remember, your purchase is for a position in a price slot NOT A POSITION ON A PAGE. For more information about bidding and price slots see <a target-'_blank' href='http://bungeebones.com/members/modal/general_instructions.php?link_id=2311'>the General Bidding Information page</a>		  
";
			  echo '<p style="text-align: left;">The cancelation of a previous purchase can be done easily by selecting the radio for the SAME AMOUNT as the price slot slot you are purchasing now (the price slot price that you are purchasing now will be listed in red just above the radio buttons on your user control panel when you return). ';
			 echo '<p style="text-align: left;">Your link will be displayed in its new position instantly across the BungeeBones system. To verify this you can visit your category on any of the Distributed Web Directory installations and see your link in its new position.';
			}
			if($exchange=="true"){
			echo '<p style="text-align: left;">The cancelation of a previous purchase or the switching of a link from one price slot to another are handled as two transactions, but reported together. One cancels the previously held price slot while the next purchases the new price slot. <B> IMPORTANT FOR PLACEMENT - Seniority starts over with any price slot move or purchase and your link will be displayed behind any already in the price slot. </b>'; 
			}
			if($cancel=="true"){
			echo '<p style="text-align: left;">The cancelation of a previous purchase can be done easily by selecting the radio for the SAME AMOUNT that you purchased it for (listed in red just above the radio buttons). ';
			}
			echo '<p style="text-align: left;">Review the transaction details below and submit the form if correct. You will have 60 minutes to cancel any subscription if you decide to and your account will receive credit immediately. You can cancel at anytime but after the 60 minute limit your account will not be reimbursed for this day\'s daily fee. See the General Bidding Information button at the tops of both free and page sections of your User Control Panel<p style="text-align: left;">';
			echo $message;
			echo '<p style="text-align: left;"><FORM name="F3" action="'.$_SERVER['PHP_SELF'].'" method="POST">';


$forward_post .='<input type="hidden" name="selected_link_id" value="'.$db_idp.'">';
$forward_post .='<input type="hidden" name="cat_id" value="'.$db_categoryp.'">';
$forward_post .='<input type="hidden" name="price_slot_selected" value="'.$price_slot_selected.'">';
$forward_post .='<input type="hidden" name="wdgts_lnk_num" value="'.$wdgts_lnk_num.'">';
$forward_post .='<input type="hidden" name="wdgts_ID" value="'.$wdgts_ID.'">';
$forward_post .='<input type="hidden" name="subscribe" value="1">';
$forward_post .='<input type="hidden" name="buyr_type" value="'.$buyr_type.'">';
$forward_post .='<input type="hidden" name="currency" value="BTC">';


echo $forward_post.'<INPUT type="submit" name="C1" value="Accept"></form>';
	}	
}//close if B1
if(isset($_POST['A1']))
{
$selected_link_id = $_POST['link_id'];
$buyr_type = $_POST['type'];
if($_GET['type'] == "bitcoin"){
include('get_buy_placement_bitcoin.php');
}
elseif($_GET['type'] == "testcoin")
{
include('get_buy_placement_testcoin.php');
}
else
{
echo '<p style="text-align: left;"><FORM name="F3" action="'.$_SERVER['PHP_SELF'].'" method="POST">';
echo '
<input type="hidden" name="link_id" value="'.$_GET['link_id'].'">
<input type="hidden" name="buyr_type" value="'.$_GET['type'].'">';
echo "
<h1>You have a balance in both your Bitcoin account (".$_GET['balance_bitcoin'].") and in your TestCoin account (".$_GET['balance_testcoin']."). Which do you want to use for this purchase? </h1>
<input type='radio' name='type' value='bitcoin'> Bitcoin&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <input type='radio' name='type' value='testcoin'>Testcoin<br>
<INPUT type='submit' name='A1' value='Proceed'></form>";
}

	} else {
    // the user is not logged in...

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
?>	
