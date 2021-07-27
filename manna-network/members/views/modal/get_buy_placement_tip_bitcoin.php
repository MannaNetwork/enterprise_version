<? 

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
$price_slot_range = $LINKinfo->getDisplayConfigPrice($user_id, $selected_link_id,  'bitcoin'); 
  $satoshi_display = $LINKinfo->getDisplayConfigPrefix($user_id, $selected_link_id,  'bitcoin'); 
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
		
$user_purchase_info = $price_slot_info->getUsersTopPaidSlot($db_category, $db_id);
		// above replaces $user_purchase_info = $price_slot_info->getThisUsersLastBoughtPriceSlot($db_categoryt, $db_idt);
//which used to return $bid_info = array($id, $price_slot_amnt, $link_id); 
//but now - NOTICE link id is sent in rather than retrieved and used? line 166
//returns $bid_info = array($id, $user_id, $price_slot_amnt, $coin_type); (as a 1 for testnet 2 for bitcoin);

			//returns array($id, $user_id, $price_slot_amnt)			
	$user_top_active_bid = $price_slot_info->getUsersTopBoughtSpot($db_category, $user_id);
if($selected_link_id == $db_id){
//the above was added to make the old system only display the selected link instead of the array of all paid links
//this entire block of code should be refactored to eliminante the functions creating the arrays and such as only need info on each link
$display_block .= '<p><a href="../config_prefixes.php?link_id='.$selected_link_id.'&fut_buyr_type=bitcoin">Configure Your Display (Move the Decimal Point)</a>&nbsp;&nbsp;&nbsp;<a href="../config_price_slots.php?link_id='.$selected_link_id.'">Configure Your Display (Price Slot Range)</a></p>';
$display_block .= '<FORM name="F2" action="'.$_SERVER['PHP_SELF'].'" method="POST">';
$display_block .= "<input type='hidden' name='selected_link_id' value='$selected_link_id'>"; 
$display_block .= "<input type='hidden' name='fut_buyr_type' value='$fut_buyr_type'>";
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
$display_block1 .= '<input type="hidden" name="fut_buyr_type" value="'.$fut_buyr_type.'"><td STYLE="font-size: 65%;background-color:green"><input type="radio" id="buyp'.$key.'" name="price_slot_selected"  value="'.$temp_incr_slot_price.'" onClick="TotalCheckedValuesP()"></td>';
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
 $display_block .= "</tr><tr><td><p>The first row obviously posts the monthly price in Bitcoin. <font color='red'>The second row represents an <b>approximation</b> of that Bitcoin's value in USD. The current Bitcoin price used to make the conversion is \$$bitcoin_marketprice_usd . The Bitcoin price is what is used for the price_slot tag/label and what your account will be charged.</font><p>The third line reports the number of paying links - in this category and in that particicular price slot. All paid links are displayed acording to what price slot they are in with the highest being displayed on the page first. 
<p>By paying the minimum (a Satoshi) you do get to jump ahead of all the free links and if no one else has purchased another price slot in that category your link will actually be displayed first. That is, until such time as someone does pay to join a higher price slot (i.e. 1.5 Satoshi).";
$display_blockb = '</table>';//closes opening form line 361
}//close if selected link id matches link id
          echo $display_blockt, $display_block,$display_blockb;
?>
