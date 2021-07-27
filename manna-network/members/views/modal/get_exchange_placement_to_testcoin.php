<? 

$balance_bitcoin = $_POST['balance_bitcoin'];
$balance_testcoin = $_POST['balance_testcoin'];

//getUserByLinkId
$LINKinfo = new link_info;
      $CATinfo = new category_info;
       $price_slot_info = new price_slot_info;
$price_slot_range = $LINKinfo->getDisplayConfigPrice($user_id, $selected_link_id,  'testcoin'); 
  $satoshi_display = $LINKinfo->getDisplayConfigPrefix($user_id, $selected_link_id,  'testcoin'); 
 //let's get the current Bitcoin market price
require "./btc_price/tickers/ticker_usd_btc_bitstamp.php";
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
$price_slot_label = "All Price Slot Prices Are Displayed";
}

//hard code $high = 21;$low = 1; to display all vertically
$high = 12;
$low = 1;

switch ($satoshi_display) {
    case 'decibitcoin':
     $satoshi = 10;
$display = 19;
$prefix="d";
$decimal_label = " Deci-Bitcoin (dBTC) - moved 1 decimal place";
        break;
    case 'centibitcoin':
$satoshi = 100;
$display = 18;
$prefix="c";
$decimal_label = " Centi-Bitcoin (cBTC) - moved 2 decimal places";
        break;
  case 'millibitcoin':
      $satoshi = 1000;
$display = 17;
$prefix="m";
$decimal_label = " Milli-Bitcoin (mBTC) - moved 3 decimal places";
        break;
  case 'microbitcoin':
      $satoshi = 1000000;
$display = 14;
$prefix="M";
$decimal_label = " Micro-Bitcoin (MBTC) - moved 6 decimal places";
        break;
 case 'satoshibitcoin':
      $satoshi = 100000000;
$display = 12;
$prefix="s";
$decimal_label = " Satoshi (sBTC) - moved 8 decimal places";
        break;
   default:
$satoshi = 1;
$display = 20;
$prefix="";
$decimal_label = " Whole Bitcoin (BTC)";
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
					$num_pages_array = $price_slot_info->howManyRadiosPaid($db_category, $db_id, "testcoin");

						//returns both num of pages and count of how many links in top slot array($top_buyer_num_of_pages, $this_users_num_of_pages, = $num_pages_array[1];);
						$top_buyer_num_of_pages = $num_pages_array[0];
						$this_users_num_of_pages = $num_pages_array[1];
						$count_of_top_links = $num_pages_array[2];
						$top_buyer_link_id = $num_pages_array[3];//shouldn't link id be 4th?
 $num_of_pagesp = $top_buyer_num_of_pages + 1;//this used to be an if/else user was tied for first - just add a new top slot
$num_of_pagesp = 21;
		
$user_purchase_info = $price_slot_info->getUsersTopPaidSlot($db_category, $db_id);
//if the coin type returned by that is bitcoin display this
$previous_coin_type = $user_purchase_info[4];
//the switch messages are counter intuitive - if the previous coin type is the opposite of this page's coin type then they got here by selecting the opposite
//they are going to buy the opposite and cancel their previous
echo '<h2>You are about to cancel your Bitcoin Price Slot and select a Testcoin Price Slot (That could be a big loss in position). If that is not what you intended close this modal window (top right).</h2>';



//else this is a swith from testnet to bitcoin - make a var named $swith and make it "true"



		// above replaces $user_purchase_info = $price_slot_info->getThisUsersLastBoughtPriceSlot($db_categoryt, $db_idt);
//which used to return $bid_info = array($id, $price_slot_amnt, $link_id); 
//but now - NOTICE link id is sent in rather than retrieved and used? line 166
//returns $bid_info = array($id, $user_id, $price_slot_amnt, $coin_type); (as a 1 for testnet 2 for bitcoin);

			//returns array($id, $user_id, $price_slot_amnt)			
	$user_top_active_bid = $price_slot_info->getUsersTopBoughtSpot($db_category, $user_id);
if($selected_link_id == $db_id){
//the above was added to make the old system only display the selected link instead of the array of all paid links
//this entire block of code should be refactored to eliminante the functions creating the arrays and such as only need info on each link
$display_block .= '<p><a href="../config_prefixes.php?link_id='.$selected_link_id.'&fut_buyr_type=testcoin">Configure Your Display (Move the Decimal Point)</a></p>';
$display_block .= '<FORM name="F2" action="'.$_SERVER['PHP_SELF'].'" method="POST">';
$display_block .= "<input type='hidden' name='selected_link_id' value='$selected_link_id'>"; 
$display_block .= "<input type='hidden' name='fut_buyr_type' value='$fut_buyr_type'>";
$display_block .= "<input type='hidden' name='previous_coin_type' value='bitcoin'>";
if($satoshi!=1){
$moved_decimal = $user_purchase_info[2] * $satoshi;// if the selected is not bitcoin but is deci price	then get the price slot amount as expressed as a deci							
}
$display_block .= "<div STYLE='font-size: 85%; text-align:center;'><h4 style='color:red;'>";

//$display_block .= rtrim(rtrim($moved_decimal, "0"),".")." ".$prefix."BTC";;
$display_block .= "<br><b>Your Current Bitcoin Price Decimal Setting Has </b>";
$display_block .= $decimal_label;
//$display_block .= "<br><b>Your Current Selected Range Is </b>".$price_slot_label;

if($satoshi!=1){
 $display_block .= "</hr><h4 style='color:red;'>Your Previous Purchased Price Slot Was (". (float)$moved_decimal." " .$prefix."BTC) and will be cancelled.";
}
if($balance_bitcoin > 0){
$display_blocktn .= "<br><b><p> You have ";
$display_blocktn .=  $balance_bitcoin;
$display_blocktn .= "<br><b> in Bitcoin based advertising credits available";
}
if($balance_testcoin > 0){
$display_blocktn .= "<br><b><p> You have ";
$display_blocktn .=  $balance_testcoin;
$display_blocktn .= "<br><b> in Testcoin based advertising credits available";
}
$display_block .= "</h4></div>";
								$display_block .='<hr color="navy"><table>';
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
					$num_links_in_slot = $price_slot_info->getNumLinksInSlot($db_category, $incr_slot_price, "testcoin");
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
																		
							$display_block1 .= '<tr><td STYLE="font-size: 100%;background-color:'.$bgcolor.'""><input type="radio" id="buyp'.$key.'" name="price_slot_selected"  value="'.$incr_slot_price.'" onClick="TotalCheckedValuesP()"></td>';
								//}
                                                                $incr_slot_price_usd = number_format($incr_slot_price_usd, 2, '.', '');

									$display_block1 .= "<td STYLE='font-size: 100%;'><h4>".$satoshi * $incr_slot_price." ".$prefix."BTC/mo</h4></td><td><h4>  $".$incr_slot_price_usd." USD/mo </td>";

                                                    		//add a condition making sure Be top only displays for top link
									//finish making sure subscribe is turned to zero after quiting.
									if($num_links_in_slot == 0){
							$display_block1 .= "<td STYLE='font-size: 100%;'>No Links</td></tr>";
									}
									 else{
			 $display_block1 .= "<td STYLE='font-size: 100%;'>".$num_links_in_slot." testcoin link";
									    if($num_links_in_slot == 1){
										$display_block1 .=" in slot</td></tr>";
										}
										else
										{
										$display_block1 .="s in slot</td></tr>";
										}
									       }
//this might be where to end price slot range for/if loop
}//close if line 189
 }//closes line 171





								           //$display_blocktn .= $display_blocktn1.'</tr>';

$display_block .= $display_block1.'<tr><td colspan="4" ><INPUT type="submit" name="B1" value="Process Now">
							           ';
							$display_block .='<hr color="navy">';
							
						   $display_block .= '</td>';

 $display_block .= "</tr>

<tr><td colspan='4'><p><font color='red'>The above chart and order form is a \"live\" demo that uses free (but valueless) Testcoin to provide real purchasing type functionality for demonstration purposes. Using Testcoin will still move your link ahead of all free listings however (a small reward for participating).</font></p> <p>The first column obviously posts the monthly price in Testcoin. The second column represents a <b>real time market price (Bitstamp)</b> of what <b>Bitcoin's</b> value in USD <b>(but NOT Testcoin's)</b>. The current Bitcoin price just used to make the conversion is \$$bitcoin_marketprice_usd. That Bitcoin value in dollars will change with market conditions but your price (in Testcoin) remains the same amount of Testcoin unless you modify and change its price slot. Again, the Bitcoin price is what is used for the price_slot tag/label and what your account will be charged (in Testcoin).</font>
<p>The third column reports the number of paying links (\"paying\" in Testcoin)- in that particular price slot. All paid links are displayed according to what price slot they are in with the highest being displayed first. Users can elect to pay the same amount as others(thus multiple links in a price slot). Listings within the same price slot are ordered according to their purchase dates. 
<p>By paying even the minimum (a few Satoshis) you do get to move your listing ahead of all the free links and if no one else has purchased another price slot in that category then your link will actually be displayed first. That is, until such time as someone does pay the fee of a higher price slot.

";
		  $display_blockb = '</table></FORM>';//closes opening form line 361
}//close if selected link id matches link id line 150
		
	
          echo $display_blocktnop, $display_block,$display_blockb;
?>
