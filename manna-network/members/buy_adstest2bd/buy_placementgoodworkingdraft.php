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
$buyr_type = $_POST['buyr_type'];

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
	$link_display = $LINKinfo->getUserByLinkId($selected_link_id);
	 $db_id= $link_display[1]; 
	   $db_category =$link_display[2]; 
            $db_url = $link_display[3];  
             $db_description = $link_display[4];   
              $db_name = $link_display[5]; 
               $db_start_date = $link_display[6];  
                $db_approved = $link_display[7]; $price_slot_info = new price_slot_info;
	//$wdgts_lnk_num = $price_slot_info->getWdgtsLnkNum($user_id);
	$text_email .= "";
		$message .=  '<h1>Thank you! 
The transaction details for the affected link is below. Your fee reflects the per-diem (daily) with regular automatic billing occurring daily from this point forward until cancelled by you or until there is insufficient funds in your account.</h1>';
  // foreach($_POST as $key=>$value){
	   // $array_id = substr($key, 4);

	   if($_POST['buyr_type']=="free"){ //definitely a purchasing order
		$message_array = $price_slot_info->markPriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $db_id,  $db_category, $price_slot_selected, "1", $message);
		$message .= '<p style="color:red;">'.$message_array[0];
		$text_email .= $message_array[1];
		$price_slot_info->markFreebies($db_id, "1");
//add an escrow payment here						  
$price_slot_info->credit_daily_commiss();
		}
		if($_POST['buyr_type']=="paid") {//could be either a cancelling order or a slot change
		   //echo 'Or -- the real link number in paid list ', $db_id[$array_id];
		   //nee a funct to check if this link's selection amount is the same as wht they had. if so, it is a cancel. if not it is a modify.
		     
		       
		       $to_do = $price_slot_info->getThisUsersEqualPriceSlot($db_category, $db_id, $price_slot_selected);
		       //returns either array("cancel", $price_slot_amnt); or array("modify", $price_slot_amnt);

if($to_do[0]=="cancel"){//this user has an active slot for that amount - they selected one they own - means cancel close it
			 $message_array = $price_slot_info->markPriceSlotsCancel($user_id, $db_id,  $db_category, $to_do[1], 0);//1st give them pro-rated credit
			  $message .= '<p style="color:red;">'.$message_array[0];
			   $text_email .= $message_array[1];
		 $price_slot_info->updatePriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $db_id, $db_category, $to_do[1], 0);//then deactivate the subscription
			 $price_slot_info->markFreebies($db_id, 0);//last mark as freebie again in links table
			}
			else
			{
			//$message .=  '<h3>You are refunded the remaining portion of your previous payment and then charged a new prerated amount for the new price slot you selected.</h3>';
			//close one order one - slot
			 $message_array = $price_slot_info->markPriceSlotsCancel($user_id, $db_id,  $db_category, $to_do[1], 0);//1st give them pro-rated credit
			  $message .= '<p style="color:red;">'.$message_array[0];
			   $text_email .= $message_array[1];
			 $UsersTopBoughtSpot =   $price_slot_info->getUsersTopBoughtSpot($db_category, $user_id);
			  //returns array($id, $price_slot_amnt, $link_id);
		// $price_slot_info->updatePriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $db_id, $db_category, $to_do[1],0);
			     //open another in same cat and same link
			    $message_array = $price_slot_info->markPriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $db_id,  $db_category, $price_slot_selected, "1",$message);
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
if($key==="buyr_type"){
				
				 
					     if($buyr_type=="free")
						{ //a purchasing order
						  $approval_req_msg = $price_slot_info->B1markPriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $db_id,  $db_category, $price_slot_selected, "1");
 $message .= $approval_req_msg[0];
						   $text_email .= $approval_req_msg[1];
						  $buy="true";
						}
					     if($buyr_type=="paid") {//a cancelling order or a slot change
				
       $to_do = $price_slot_info->getThisUsersEqualPriceSlot($db_category, $db_id, $price_slot_selected);
//either returns array("cancel", $price_slot_amnt); or array("modify", $price_slot_amnt);
							if($to_do[0]=="cancel"){//this user has an active slot for that amount - they selected one they own - means cancel close it
							   $approval_req_msg = $price_slot_info->B1markPriceSlotsCancel($user_id,$db_id,  $db_category, $to_do[1], 0);//1st give them pro-rated credit
							     $message .= $approval_req_msg[0];
							    $text_email .= $approval_req_msg[1];
							  $cancel="true";
							}
							else
							{
							//close one order one - slot
							   $approval_req_msg = $price_slot_info->B1markPriceSlotsCancel($user_id,$db_id,  $db_category, $to_do[1], 0);//1st give them pro-rated credit
							     $message .= $approval_req_msg[0];
							       $text_email .= $approval_req_msg[1];
							       //open another in same cat and same link
	
							       $approval_req_msg2 = $price_slot_info->B1markPriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $db_id,  $db_category, $price_slot_selected, "1");
							   
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


$forward_post .='<input type="hidden" name="selected_link_id" value="'.$db_id.'">';
$forward_post .='<input type="hidden" name="cat_id" value="'.$db_category.'">';
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
echo '<h2>Purchase Any Price Slot And Move Your Link Position Ahead Of All Free Advertising!</h2>';
echo '<p>For a limited time, new registrants in BungeeBones are now receiving a small Bitcoin credit which is redeemable for up to three months worth of advertising!.
<p>Paying advertisers\' links are displayed ahead of non-paying links so this credit will enable you to move your listing ahead of all the non-paying links for at least three months.
<p>These are actual Bitcoin credits which will be paid out to webmasters who host the web directory on their websites and who are the backbone of the web traffic in our network . <h3>Add A Free BungeeBones Web Directory Script And Earn Some Bitcoin Yourself!</h3>
<p>To start using your credit just scroll to the right along the row of potential price slots below until the end and select the first radio button. Then click the "Process Now" button to submit the form.
 ';
//getUserByLinkId
$LINKinfo = new link_info;
      $CATinfo = new category_info;
       $price_slot_info = new price_slot_info;
$price_slot_range = $LINKinfo->getDisplayConfigPrice($user_id, $selected_link_id); 
  $satoshi_display = $LINKinfo->getDisplayConfigPrefix($user_id, $selected_link_id); 
 //let's get the current Bitcoin market price
require "./btc_price/tickers/ticker_usd_btc_bitstamp.php";
//$btc_price_array = array($last, $high,$low,$avg,$vol,$bid,$ask)

//$bitcoin_marketprice_usd = $btc_price_array[0];
$base_price_info = $price_slot_info->getBasePrice();


//echo 'line 463 price slot range = ', $price_slot_range;
switch ($price_slot_range) {
    case 'high':
$high = 21;
$low = 14;
$price_slot_label = "Highest Prices";
        break;
case 'mid':
$high = 14;
$low = 7;
$price_slot_label = "Midrange Prices";
        break;
case 'low':
$high = 7;
$low = 1;
$price_slot_label = "Lowest Prices";
        break;
default:
$high = 21;
$low = 1;
$price_slot_label = "All Price Slot Prices Are Displayed (scroll right for lowest)";
       
}

switch ($satoshi_display) {

    case 'decibitcoin':
     $satoshi = 10;
$display = 19;
$prefix="d";
$decimal_label = "Prices displayed as Deci-Bitcoin (dBTC) - moved 1 decimal place";
        break;
    case 'centibitcoin':
     
$satoshi = 100;
$display = 18;
$prefix="c";
$decimal_label = "Prices displayed as Centi-Bitcoin (cBTC) - moved 2 decimal places";
        break;
  case 'millibitcoin':
      $satoshi = 1000;
$display = 17;
$prefix="m";
$decimal_label = "Prices displayed as Milli-Bitcoin (mBTC) - moved 3 decimal places";
        break;
  case 'microbitcoin':
      $satoshi = 1000000;
$display = 14;
$prefix="M";
$decimal_label = "Prices displayed as Micro-Bitcoin (MBTC) - moved 6 decimal places";
        break;
 case 'satoshibitcoin':
      $satoshi = 100000000;
$display = 12;
$prefix="s";
$decimal_label = "Prices displayed as Satoshi (sBTC) - moved 8 decimal places";
        break;
   default:
$satoshi = 1;
$display = 20;
$prefix="";
$decimal_label = "None - Whole Bitcoin (BTC)";
}
     

   $link_display = $LINKinfo->getUserByLinkId($selected_link_id);
       //$send_array = array($links_user_id,  $db_id, $db_category, $db_url, $db_description, $db_name, $db_start_date, $db_approved);
    	  $db_id= $link_display[1]; 
	   $db_category =$link_display[2]; 
            $db_url = $link_display[3];  
             $db_description = $link_display[4];   
              $db_name = $link_display[5]; 
               $db_start_date = $link_display[6];  
                $db_approved = $link_display[7]; 
          


                    $count_links=0;
		  
				
		         $catPop_arrp = $CATinfo->getCatPop($db_category);
		          $num_queries =  $price_slot_info->get_click_tallies_for_link_list_from_gen($db_category);
				$catPoppa = $catPop_arrp[0];
				  $catPopp = explode(",",$catPoppa);
					$price_slot_info_array = $price_slot_info->getPriceSlotGen($db_category);
					$price_adj_factor= $price_slot_info_array[2];
					$base_price = $base_price_info[2];

					$base_price = number_format($base_price, 20, '.', '');
				



$cat_name= $catPop_arrp[2];  
					$num_pages_array = $price_slot_info->howManyRadiosPaid($db_category, $db_id);
						//returns both num of pages and count of how many links in top slot array($top_buyer_num_of_pages, $this_users_num_of_pages, = $num_pages_array[1];);
						$top_buyer_num_of_pages = $num_pages_array[0];
						$this_users_num_of_pages = $num_pages_array[1];
						$count_of_top_links = $num_pages_array[2];
						$top_buyer_link_id = $num_pages_array[3];//shouldn't link id be 4th?


 $num_of_pagesp = $top_buyer_num_of_pages + 1;//this used to be an if/else user was tied for first - just add a new top slot
$num_of_pagesp = 21;
		$user_purchase_info = $price_slot_info->getThisUsersLastBoughtPriceSlot($db_category, $db_id);
			//returns array($id, $user_id, $price_slot_amnt)			
	$user_top_active_bid = $price_slot_info->getUsersTopBoughtSpot($db_category, $user_id);
						
if($selected_link_id == $db_id){
//the above was added to make the old system only display the selected link instead of the array of all paid links
//this entire block of code should be refactored to eliminante the functions creating the arrays and such as only need info on each link
$display_block .= '<p><a href="../config_prefixes.php?link_id='.$selected_link_id.'">Configure Your Display (Move the Decimal Point)</a>&nbsp;&nbsp;&nbsp;<a href="../config_price_slots.php?link_id='.$selected_link_id.'">Configure Your Display (Price Slot Range)</a></p>';
$display_block .= '<FORM name="F2" action="'.$_SERVER['PHP_SELF'].'" method="POST">';
$display_block .= "<input type='hidden' name='selected_link_id' value='$selected_link_id'>"; 
$display_block .= "<input type='hidden' name='buyr_type' value='$buyr_type'>";
if($satoshi!=1){
$moved_decimal = $user_purchase_info[2] * $satoshi;// if the selected is not bitcoin but is deci price	then get the price slot amount as expressed as a deci							
}
$display_block .= "<div STYLE='font-size: 85%; text-align:center;'><h4 style='color:red;'>";

//$display_block .= rtrim(rtrim($moved_decimal, "0"),".")." ".$prefix."BTC";;
$display_block .= "<br><b>Your Current Bitcoin Price Decimal Setting Has </b>";
$display_block .= $decimal_label;
$display_block .= "<br><b>Your Current Selected Range Is </b>".$price_slot_label;
if($satoshi!=1){
 $display_block .= "</hr><h4 style='color:green;'>Your Current Purchased Price Slot Is (". (float)$moved_decimal." ".$prefix."BTC)";
}
$display_block .= "</h4></div>";
								$display_block .='<hr color="navy"><table><tr>';
								for($i=1;$i <= $num_of_pagesp; $i++){
								  unset($incr_slot_price);
                                                                  unset($incr_slot_price_usd);
								    $incr_slot_price = 0;
								     $incr_slot_price_usd = 0;
                                                                  for($t=0;$t<=$num_of_pagesp-$i;$t++){
									 if($incr_slot_price>0){
									   $incr_slot_price = $incr_slot_price+($incr_slot_price * $price_adj_factor);
									    $incr_slot_price_usd = $incr_slot_price_usd+($incr_slot_price_usd * $price_adj_factor);
									   
                                                                          }else{
									   $incr_slot_price = $base_price;
										$incr_slot_price_usd = $base_price * $bitcoin_marketprice_usd;
                                                                          }//close else
									}//close for loop
								
//might be where to begin for/if in range loop

if($t <= $high AND $t >= $low){ 


									$incr_slot_price = rtrim(rtrim($incr_slot_price, "0"),".");
                                                                        $incr_slot_price_usd = rtrim(rtrim($incr_slot_price_usd, "0"),".");
									$num_links_in_slot = $price_slot_info->getNumLinksInSlot($db_category, $incr_slot_price);
									$count_links = $count_links + $num_links_in_slot;
									 if($count_links<21){
									  $bgcolor="#F1AB29";
									   }
									     elseif($count_links>21 AND $count_links<41){
									      $bgcolor="#DFDDDD";
										}
										  elseif($count_links>41 AND $count_links<61){
										   $bgcolor="#FFE4B8";
											}	
									if($incr_slot_price == $user_purchase_info[2]){
									$temp_incr_slot_price = $incr_slot_price;
									$display_block1 .= '<input type="hidden" name="buyr_type" value="'.$buyr_type.'"><td STYLE="font-size: 65%;background-color:green"><input type="radio" id="buyp'.$key.'" name="price_slot_selected"  value="'.$temp_incr_slot_price.'" onClick="TotalCheckedValuesP()"></td>';
									$this_slot_is_users = 1;
									}
									else
									{	
									$display_block1 .= '<td STYLE="font-size: 65%;background-color:'.$bgcolor.'""><input type="radio" id="buyp'.$key.'" name="price_slot_selected"  value="'.$incr_slot_price.'" onClick="TotalCheckedValuesP()"></td>';
}
$incr_slot_price_usd = number_format($incr_slot_price_usd, 2, '.', '');
$display_block2 .= "<td STYLE='font-size: 65%;'><h4>".$satoshi * $incr_slot_price." ".$prefix."BTC/mo</h4><h4>  $".$incr_slot_price_usd." USD/mo </td>";
//add a condition making sure Be top only displays for top link
//finish making sure subscribe is turned to zero after quiting.
if($num_links_in_slot == 0){
$display_block3 .= "<td STYLE='font-size: 65%;'>No Bids</td>";
}
elseif($incr_slot_price == $user_purchase_info[2]){
$display_block3 .= "<td STYLE='font-size: 65%; color: green;'>".$num_links_in_slot."<br>link";
 if($num_links_in_slot == 1){
$display_block3 .="<br>in<br>slot</td>";
}
else
{
$display_block3 .="s<br>in<br>slot</td>";
}
									       }
                                                                         else{
									  $display_block3 .= "<td STYLE='font-size: 65%;'>".$num_links_in_slot."<br>link";
									    if($num_links_in_slot == 1){
										$display_block3 .="<br>in<br>slot</td>";
										}
										else
										{
										$display_block3 .="s<br>in<br>slot</td>";
										}
									       }
									//this might be where to end price slot range for/if loop
									}
									     }
 $display_block .= $display_block1.'</tr><tr>'.$display_block2.'</tr><tr>'.$display_block3.'</tr>';
$display_block .= '<tr><td colspan="'.$num_of_pagesp.'" ><INPUT type="submit" name="B1" value="Process Now">   </FORM></td></tr>';
$display_block .='</table><hr color="navy">';
$display_block .= '</td>';
 $display_block .= "</tr>
<tr><td><p>The first row obviously posts the monthly price in Bitcoin. <font color='red'>The second row represents an <b>approximation</b> of that Bitcoin's value in USD. The current Bitcoin price used to make the conversion is \$$bitcoin_marketprice_usd . The Bitcoin price is what is used for the price_slot tag/label and what your account will be charged.</font>
<p>The third line reports the number of paying links - in this category and in that particicular price slot. All paid links are displayed acording to what price slot they are in with the highest being displayed on the page first. 
<p>By paying the minimum (a Satoshi) you do get to jump ahead of all the free links and if no one else has purchased another price slot in that category your link will actually be displayed first. That is, until such time as someone does pay to join a higher price slot (i.e. 1.5 Satoshi).

";
$display_blockb = '</table>';//closes opening form line 361
}//close if selected link id matches link id
          echo $display_blockt, $display_block,$display_blockb;
}//close else not B1
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
