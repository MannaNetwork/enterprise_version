<?php 

//hard code these values instead of calling getBasePrice() func
//current active is 1741 	1 	0.00401477891880035400 	0.50000000 	15 	2015-02-19 20:24:13

$base_price = 0.00401477891880035400;
$adj_factor = .5;
$total_slots = 15;
//$t_timestamp = $row['t_timestamp'];
//
$top_buyer_price_amnt = 0.00401477891880035360000000000;//from database cat 8 bitcoin
$top_buyer_num_of_pages = (log10(intval($top_buyer_price_amnt))-log10($base_price))/log10(1+$adj_factor);
//$this_users_price_amnt = .000031566366;


echo '<br> $this_users_num_of_pages = ', $top_buyer_num_of_pages;

//$this_users_num_of_pages -log10(.000031566366);


//$this_users_num_of_pages = $this_users_num_of_pages -log10(.000031566366))/log10(1.5);

//echo '<br> $this_users_num_of_pages = ', $this_users_num_of_pages;

$balance_bitcoin = $_POST['balance_bitcoin'];
$balance_testcoin = $_POST['balance_testcoin'];


echo '<h2>Purchase Any Price Slot With Bitcoin And Move Your Link Position Ahead Of All Lower Paying, DemoCoin And Free Advertising!</h2>';

//getUserByLinkId
/*
$LINKinfo = new link_info;
      $CATinfo = new category_info;
       $price_slot_info = new price_slot_info;
$price_slot_range = $LINKinfo->getDisplayConfigPrice($user_id, $selected_link_id,  'bitcoin'); 
 $satoshi_display = $LINKinfo->getDisplayConfigPrefix($user_id, $selected_link_id,  'bitcoin'); 
*/
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
     $send_array = array($links_user_id,  $db_id, $db_category, $db_url, $db_description, $db_name, $db_start_date, $db_approved);
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
					$num_pages_array = $price_slot_info->howManyRadiosPaid($db_category, $db_id, "bitcoin");
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
$display_block .= '<p><a href="../config_prefixes.php?link_id='.$selected_link_id.'&fut_buyr_type=bitcoin">Configure Your Display (Move the Decimal Point)</a></p>';
$display_block .= '<FORM name="F2" action="'.$_SERVER['PHP_SELF'].'" method="POST">';
$display_block .= "<input type='hidden' name='selected_link_id' value='$selected_link_id'>"; 
$display_block .= "<input type='hidden' name='fut_buyr_type' value='$fut_buyr_type'>";
if($satoshi!=1){
$moved_decimal = $user_purchase_info[2] * $satoshi;// if the selected is not bitcoin but is deci price	then get the price slot amount as expressed as a deci							
}
$display_block .= "<div STYLE='font-size: 85%; text-align:center;'><h4 style='color:red;'>";

//$display_block .= rtrim(rtrim($moved_decimal, "0"),".")." ".$prefix."BTC";;
$display_block .= "<br><b>Your Price Display Setting Is As </b>";
$display_block .= $decimal_label;
//$display_block .= "<br><b>Your Current Selected Range Is </b>".$price_slot_label;
//if($satoshi!=1){
if($user_purchase_info[2] != 0){
 $display_block .= "</hr><h4 style='color:green;'>Your Current Purchased Price Slot Is (". (float)$moved_decimal." ".$prefix."BTC)";
}

if($balance_bitcoin > 0){
$display_block .= "<br><b><p> You have ";
$display_block .=  $balance_bitcoin;
$display_block .= "<br><b> in Bitcoin Based Advertising Credits (BBAC) available to use to buy a better position below";
}
if($balance_testcoin > 0){
$display_block .= "<br><b><p> You have ";
$display_block .=  $balance_testcoin;
$display_block .= "<br><b> in DemoCoin Based Advertising Credits (DBAC) available to use to buy a better position (NOT spendable from this page)</b>";
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
					$num_links_in_slot = $price_slot_info->getNumLinksInSlot($db_category, $incr_slot_price, "bitcoin");
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
									$display_block1 .= '<input type="hidden" name="fut_buyr_type" value="'.$fut_buyr_type.'"><tr><td STYLE="font-size: 100%;background-color:green"><input type="radio" id="buyp'.$key.'" name="price_slot_selected"  value="'.$temp_incr_slot_price.'" onClick="TotalCheckedValuesP()"></td>';
									$this_slot_is_users = 1;
									}
									else
									{	
							$display_block1 .= '<tr><td STYLE="font-size: 100%;background-color:'.$bgcolor.'""><input type="radio" id="buyp'.$key.'" name="price_slot_selected"  value="'.$incr_slot_price.'" onClick="TotalCheckedValuesP()"></td>';
								}
                                                                $incr_slot_price_usd = number_format($incr_slot_price_usd, 2, '.', '');

									$display_block1 .= "<td STYLE='font-size: 100%;'><h4>".$satoshi * $incr_slot_price." ".$prefix."BTC/mo</h4></td><td><h4>  $".$incr_slot_price_usd." USD/mo </td>";

                                                    		//add a condition making sure Be top only displays for top link
									//finish making sure subscribe is turned to zero after quiting.
									if($num_links_in_slot == 0){
							$display_block1 .= "<td STYLE='font-size: 100%;'>No Links</td></tr>";
									}
									elseif($incr_slot_price == $user_purchase_info[2]){
				 $display_block1 .= "<td STYLE='font-size: 100%; color: green;'>".$num_links_in_slot."link";
									    if($num_links_in_slot == 1){
										$display_block1 .=" in slot</td></tr>";
										}
										else
										{
										$display_block1 .="s in slot</td></tr>";
										}
									       }
                                                                         else{
			 $display_block1 .= "<td STYLE='font-size: 100%;'>".$num_links_in_slot." link";
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

<tr><td colspan='4'><p>The first column lists (for reference) the monthly price in Advertising Credits (1 advertising credit = 1 BBAC). Each BBAC is redeemable for 1 Bitcoin (DBAC ARE NOT REDEEMABLE). Your account will be charged one day's worth of that amount each day.
<p><font color='red'>The second column represents a <b>real time market price (Bitstamp)</b> of Bitcoin in USD. The current Bitcoin price just used to make the conversion is \$$bitcoin_marketprice_usd. That Bitcoin value in dollars will change with market conditions but your price (in Advertising Credits) remains the same. You can change the amount that your BBAC account will be charged (and its position) and/or cancel at any time by returning to this form. </font>
<p>The third column reports the number of paying links - in that particular price slot. Links within the same price slot (all paying the same price) are displayed according to date they purchased the position. 
<p>Your account will be charged the amount you select and you will retain the better ad position as long as there is sufficient funds in your account. If/when there is an insufficient balance your link will return to its previous \"free link\" position and status.  
<p>By purchasing even the minimum price slot (a few Satoshis in BBAC) you move your listing ahead of all the DBAC links and all Free links.

";
		  $display_blockb = '</table></FORM>';//closes opening form line 361
}//close if selected link id matches link id line 150
		
	
          echo $display_blocktnop, $display_block,$display_blockb;
?>
