<? 
//$selected_link_id = $_GET['link_id'];

echo 'line 4 of get buy placement tip testcoin $selected_link_id = ', $selected_link_id;
echo '<h2>Purchase Any Price Slot With Coins From A TestNet Faucet And Move Your Link Position Ahead Of All Free Advertising!</h2>';
echo '<p>Paying advertisers\' links are displayed ahead of non-paying links whether paying with Bitcoin or Testcoin and bidding will enable you to move your listing ahead of all the non-paying links.
<p>To start using your Testcoin credits just scroll along the row of potential price slots below and select the position you want (note it reports how many [if any] others are in each price slot so you can choose to be ahead of them or below them). Then click the "Process Now" button to submit the form.
 ';
//getUserByLinkId
$LINKinfo = new link_info;
      $CATinfo = new category_info;
       $price_slot_info = new price_slot_info;
$price_slot_range = $LINKinfo->getDisplayConfigPrice($user_id, $selected_link_id, 'testcoin'); 
  $satoshi_display = $LINKinfo->getDisplayConfigPrefix($user_id, $selected_link_id, 'testcoin' ); 
 //let's get the current Bitcoin market price
require "btc_price/tickers/ticker_usd_btc_bitstamp.php";
$base_price_info = $price_slot_info->getBasePrice();
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
echo '<br>line 77 get buy placement tip.php $selected_link_id = ', $selected_link_id;
    $testnet_link_display = $LINKinfo->getUserByLinkId($selected_link_id);
       //$send_array = array($links_user_id,  $db_idf, $db_categoryf, $db_urlf, $db_descriptionf, $db_namef, $db_start_datef, $db_approvedf);
    	
         $db_idt= $testnet_link_display[1]; 
	   $db_categoryt =$testnet_link_display[2]; 
            $db_urlt = $testnet_link_display[3];  
             $db_descriptiont = $testnet_link_display[4];   
              $db_namet = $testnet_link_display[5]; 
               $db_start_clone_datet = $testnet_link_display[6];  
                $db_approvedt = $testnet_link_display[7]; 
                 $count_links=0;
		     $catPop_arrt = $CATinfo->getCatPop($db_categoryt);
		          $num_queries =  $price_slot_info->get_click_tallies_for_link_list_from_gen($db_categoryt);
				$catPoppa = $catPop_arrt[0];
				  $catPopp = explode(",",$catPoppa);
					$price_slot_info_array = $price_slot_info->getPriceSlotGen($db_categoryt);
					$price_adj_factor= $price_slot_info_array[2];
					$base_price = $base_price_info[2];
					$base_price = number_format($base_price, 20, '.', '');
$cat_name= $catPop_arrt[2];  
					$num_pages_array = $price_slot_info->howManyRadiosPaid($db_categoryt, $db_idt);
						//returns both num of pages and count of how many links in top slot array($top_buyer_num_of_pages, $this_users_num_of_pages, = $num_pages_array[1];);
						$top_buyer_num_of_pages = $num_pages_array[0];
						$this_users_num_of_pages = $num_pages_array[1];
						$count_of_top_links = $num_pages_array[2];
						$top_buyer_link_id = $num_pages_array[3];//shouldn't link id be 4th?
 $num_of_pagest = $top_buyer_num_of_pages + 1;//this used to be an if/else user was tied for first - just add a new top slot
$num_of_pagest = 21;

$user_purchase_info = $price_slot_info->getUsersTopPaidSlot($db_categoryt, $db_idt);
		// above replaces $user_purchase_info = $price_slot_info->getThisUsersLastBoughtPriceSlot($db_categoryt, $db_idt);
//which used to return $bid_info = array($id, $price_slot_amnt, $link_id); 
//but now - NOTICE link id is sent in rather than retrieved and used? line 166
//returns $bid_info = array($id, $user_id, $price_slot_amnt, $coin_type); (as a 1 for testnet 2 for bitcoin);

			//returns array($id, $user_id, $price_slot_amnt)			
	$user_top_active_bid = $price_slot_info->getUsersTopBoughtSpot($db_categoryt, $user_id);
//to use the above we need to get the user ID of the ownwer of that link for that function to work
//BUT we didn't use the real user id so far/
//better redo all the trabsactions so far and really use the real user id 
//maybe call it account ID? That matches the blockchain name and leaves the current user id system (link_#) intact


//but the next function uses the link_# as the user if
$balance = $price_slot_info->getBuyersBalanceTips($user_id);

$balance_bitcoin = number_format($balance[0], 8, '.', '');
$balance_testcoin = number_format($balance[1], 8, '.', '');
if($selected_link_id == $db_idt){
//the above was added to make the old system only display the selected link instead of the array of all paid links
//this entire block of code should be refactored to eliminante the functions creating the arrays and such as only need info on each link
$display_blocktn .= '<p><a href="../config_prefixes.php?link_id='.$selected_link_id.'&fut_buyr_type=testcoin">Configure Your Display (Move the Decimal Point)</a>&nbsp;&nbsp;&nbsp;<a href="../config_price_slots.php?link_id='.$selected_link_id.'&fut_buyr_type=testcoin">Configure Your Display (Price Slot Range)</a></p>';
$display_blocktn .= '<FORM name="F2" action="'.$_SERVER['PHP_SELF'].'" method="POST">';
$display_blocktn .= "<input type='hidden' name='selected_link_id' value='$selected_link_id'>"; 
$display_blocktn .= "<input type='hidden' name='fut_buyr_type' value='$fut_buyr_type'>";
if($satoshi!=1){
$moved_decimal = $user_purchase_info[2] * $satoshi;// if the selected is not bitcoin but is deci price	then get the price slot amount as expressed as a deci							
}
$display_blocktn .= "<h4 style='color:red;'>";

$display_blocktn .= "<br><b>Your Current Bitcoin Price Decimal Setting Has </b>";
$display_blocktn .= $decimal_label;
$display_blocktn .= "<br><b>Your Current Selected Range Is </b>".$price_slot_label;
$display_blocktn .= "<br><b>Your Available Tips In Bitcoin Is </b>".$balance_bitcoin;
$display_blocktn .= "<br><b>Your Available Tips In Testcoin Is </b>".$balance_bitcoin;
if($satoshi!=1){
$display_blocktn .= "</hr></td></tr><tr><td><h4 style='color:green;'>Your Current Purchased Price Slot Is (". (float)$moved_decimal." ".$prefix."BTC)";
}
$display_blocktn .= "</h4></td></tr>";
								$display_blocktn .='<hr color="navy"><table><tr>';
								for($i=1;$i <= $num_of_pagest; $i++){
								  unset($incr_slot_price);
                                                                  unset($incr_slot_price_usd);
								    $incr_slot_price = 0;
								     $incr_slot_price_usd = 0;
                                                                  for($t=0;$t<=$num_of_pagest-$i;$t++){
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
				$num_links_in_slot = $price_slot_info->getNumLinksInSlot($db_categoryt, $incr_slot_price);
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
									$display_blocktn1 .= '<input type="hidden" name="fut_buyr_type" value="'.$fut_buyr_type.'"><td STYLE="font-size: 65%;background-color:green"><input type="radio" id="buyp'.$key.'" name="price_slot_selected"  value="'.$temp_incr_slot_price.'" onClick="TotalCheckedValuesP()"></td>';
									$this_slot_is_users = 1;
									}
									else
									{	
							$display_blocktn1 .= '<td STYLE="font-size: 65%;background-color:'.$bgcolor.'""><input type="radio" id="buyp'.$key.'" name="price_slot_selected"  value="'.$incr_slot_price.'" onClick="TotalCheckedValuesP()"></td>';
								}
                                                                $incr_slot_price_usd = number_format($incr_slot_price_usd, 2, '.', '');
									$display_blocktn2 .= "<td STYLE='font-size: 65%;'><h4>".$satoshi * $incr_slot_price." ".$prefix."BTC/mo</h4><h4>  $".$incr_slot_price_usd." USD/mo </td>";

                                                    		//add a condition making sure Be top only displays for top link
									//finish making sure subscribe is turned to zero after quiting.
									if($num_links_in_slot == 0){
							$display_blocktn3 .= "<td STYLE='font-size: 65%;'>No Links</td>";
									}
									elseif($incr_slot_price == $user_purchase_info[2]){
				 $display_blocktn3 .= "<td STYLE='font-size: 65%; color: green;'>".$num_links_in_slot."<br>link";
									    if($num_links_in_slot == 1){
										$display_blocktn3 .="<br>in<br>slot</td>";
										}
										else
										{
										$display_blocktn3 .="s<br>in<br>slot</td>";
										}
									       }
                                                                         else{
			 $display_blocktn3 .= "<td STYLE='font-size: 65%;'>".$num_links_in_slot."<br>link";
									    if($num_links_in_slot == 1){
										$display_blocktn3 .="<br>in<br>slot</td>";
										}
										else
										{
										$display_blocktn3 .="s<br>in<br>slot</td>";
										}
									       }
//this might be where to end price slot range for/if loop
}//close if line 189
 }//closes line 171





								           $display_blocktn .= $display_blocktn1.'</tr><tr>'.$display_blocktn2.'</tr><tr>'.$display_blocktn3.'</tr>';

$display_blocktn .= '<tr><td colspan="'.$num_of_pagest.'" ><INPUT type="submit" name="B1" value="Process Now">
							           </FORM></td></tr>';
							$display_blocktn .='</table><hr color="navy">';
							
						   $display_blocktn .= '</td>';

 $display_blocktn .= "</tr>

<tr><td><p>The first row posts the monthly price in Bitcoin. <font color='red'>The second row represents an <b>approximation</b> of that Bitcoin's value in USD. The current Bitcoin price used to make the conversion is \$$bitcoin_marketprice_usd . The Bitcoin price is what is used for the price_slot tag/label and what your account will be charged.</font>
<p>The third line reports the number of paying links - in this category and in that particicular price slot. All paid links are displayed acording to what price slot they are in with the highest being displayed on the page first. 
<p>By paying the minimum (a Satoshi) you do get to jump ahead of all the free links and if no one else has purchased another price slot in that category your link will actually be displayed first. That is, until such time as someone does pay to join a higher price slot (i.e. 1.5 Satoshi).

";
		  $display_blockb = '</table>';//closes opening form line 361
}//close if selected link id matches link id line 150
		
	
          echo $display_blocktnop, $display_blocktn,$display_blockb;
?>
