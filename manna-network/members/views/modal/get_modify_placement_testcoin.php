<? 
$balance_bitcoin = $_POST['balance_bitcoin'];
$balance_testcoin = $_POST['balance_testcoin'];

//getUserByLinkId
$LINKinfo = new link_info;
      $CATinfo = new category_info;
       $price_slot_info = new price_slot_info;
$price_slot_range = $LINKinfo->getDisplayConfigPrice($user_id, $selected_link_id, 'testcoin'); 
  $satoshi_display = $LINKinfo->getDisplayConfigPrefix($user_id, $selected_link_id, 'testcoin' ); 
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
$decimal_label = " Deci-Testcoin/Bitcoin (dTTC) - moved 1 decimal place";
        break;
    case 'centibitcoin':
$satoshi = 100;
$display = 18;
$prefix="c";
$decimal_label = " Centi-Testcoin/Bitcoin (cTTC) - moved 2 decimal places";
        break;
  case 'millibitcoin':
      $satoshi = 1000;
$display = 17;
$prefix="m";
$decimal_label = " Milli-Testcoin/Bitcoin (mTTC) - moved 3 decimal places";
        break;
  case 'microbitcoin':
      $satoshi = 1000000;
$display = 14;
$prefix="M";
$decimal_label = " Micro-Testcoin/Bitcoin (MTTC) - moved 6 decimal places";
        break;
 case 'satoshibitcoin':
      $satoshi = 100000000;
$display = 12;
$prefix="s";
$decimal_label = " Satoshi (sTTC) - moved 8 decimal places";
        break;
   default:
$satoshi = 1;
$display = 20;
$prefix="";
$decimal_label = " Whole Bitcoin (TTC)";
}
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
					$num_pages_array = $price_slot_info->howManyRadiosPaid($db_categoryt, $db_idt, "testcoin");
						//returns both num of pages and count of how many links in top slot array($top_buyer_num_of_pages, $this_users_num_of_pages, = $num_pages_array[1];);
						$top_buyer_num_of_pages = $num_pages_array[0];
						$this_users_num_of_pages = $num_pages_array[1];
						$count_of_top_links = $num_pages_array[2];
						$top_buyer_link_id = $num_pages_array[3];//shouldn't link id be 4th?
 $num_of_pagest = $top_buyer_num_of_pages + 1;//this used to be an if/else user was tied for first - just add a new top slot
$num_of_pagest = 21;

$user_purchase_info = $price_slot_info->getUsersTopPaidSlot($db_categoryt, $db_idt);
//the switch messages are counter intuitive - if the previous coin type is the opposite of this page's coin type then they got here by selecting the opposite
//they are going to buy the opposite and cancel their previous
//returns $bid_info = array($id, $user_id, $price_slot_amnt, $coin_type); (as a 1 for testnet 2 for bitcoin);
$previous_coin_type = $user_purchase_info[4];


echo '<h2>Move Or Cancel Your Link Position</h2>';
echo '<p>To cancel your paid (Testcoin) listing just scroll down to the row of your current price slot (it will be highlighted in green) and select it. 
<p>To move your link up or down in the listings choose another higher or lower price slot. 
<p>Then click the "Process Now" button to submit the form.
 ';

			//returns array($id, $user_id, $price_slot_amnt)			
	$user_top_active_bid = $price_slot_info->getUsersTopBoughtSpot($db_categoryt, $user_id);
if($selected_link_id == $db_idt){
//the above was added to make the old system only display the selected link instead of the array of all paid links
//this entire block of code should be refactored to eliminante the functions creating the arrays and such as only need info on each link
$display_blocktn .= '<FORM name="F2" action="'.$_SERVER['PHP_SELF'].'" method="POST">';
$display_blocktn .= "<input type='hidden' name='selected_link_id' value='$selected_link_id'>"; 
$display_blocktn .= "<input type='hidden' name='fut_buyr_type' value='$fut_buyr_type'>";
$display_blocktn .= "<input type='hidden' name='previous_coin_type' value='$fut_buyr_type'>";
if($satoshi!=1){
$moved_decimal = $user_purchase_info[2] * $satoshi;// if the selected is not bitcoin but is deci price	then get the price slot amount as expressed as a deci							
}
$display_blocktn .= "<div STYLE='font-size: 85%; text-align:center;'><h4 style='color:red;'>";

//$display_blocktn .= rtrim(rtrim($moved_decimal, "0"),".")." ".$prefix."BTC";;
$display_blocktn .= "<br><b>Your Current Decimal Setting Is As </b>";
$display_blocktn .= $decimal_label;
$display_blocktn .= '</hr><p><a href="../config_prefixes.php?link_id='.$selected_link_id.'&coin_type=testcoin">Configure Your Display (Move the Decimal Point)</a></p>';
if($satoshi!=1){
$display_blocktn .= "<h4 style='color:green;'>Your Current Purchased Price Slot Is (". (float)$moved_decimal." ".$prefix."TTC)";
}
$checkRefundTime = $price_slot_info->checkRefundTimer($selected_link_id);
if($checkRefundTime != "expired"){

$display_blocktn .= "<br>and is eligible for full refund for the next ". $checkRefundTime. ' minutes.';
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

$display_blocktn .= "</h4></div>";
								$display_blocktn .='<hr color="navy"><table>';
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
				$num_links_in_slot = $price_slot_info->getNumLinksInSlot($db_categoryt, $incr_slot_price, "testcoin");
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
									$display_blocktn1 .= '<input type="hidden" name="fut_buyr_type" value="'.$fut_buyr_type.'"><tr><td STYLE="font-size: 100%;background-color:green"><input type="radio" id="buyp'.$key.'" name="price_slot_selected"  value="'.$temp_incr_slot_price.'" onClick="TotalCheckedValuesP()"></td>';
									$this_slot_is_users = 1;
									}
									else
									{	
							$display_blocktn1 .= '<tr><td STYLE="font-size: 100%;background-color:'.$bgcolor.'""><input type="radio" id="buyp'.$key.'" name="price_slot_selected"  value="'.$incr_slot_price.'" onClick="TotalCheckedValuesP()"></td>';
								}
                                                                $incr_slot_price_usd = number_format($incr_slot_price_usd, 2, '.', '');

									$display_blocktn1 .= "<td STYLE='font-size: 100%;'><h4>".$satoshi * $incr_slot_price." ".$prefix."TTC/mo</h4></td><td><h4>  $".$incr_slot_price_usd." USD/mo </td>";

                                                    		//add a condition making sure Be top only displays for top link
									//finish making sure subscribe is turned to zero after quiting.
									if($num_links_in_slot == 0){
							$display_blocktn1 .= "<td STYLE='font-size: 100%;'>No Links</td></tr>";
									}
									elseif($incr_slot_price == $user_purchase_info[2]){
				 $display_blocktn1 .= "<td STYLE='font-size: 100%; color: green;'>".$num_links_in_slot."link";
									    if($num_links_in_slot == 1){
										$display_blocktn1 .=" in slot</td></tr>";
										}
										else
										{
										$display_blocktn1 .="s in slot</td></tr>";
										}
									       }
                                                                         else{
			 $display_blocktn1 .= "<td STYLE='font-size: 100%;'>".$num_links_in_slot." link";
									    if($num_links_in_slot == 1){
										$display_blocktn1 .=" in slot</td></tr>";
										}
										else
										{
										$display_blocktn1 .="s in slot</td></tr>";
										}
									       }
//this might be where to end price slot range for/if loop
}//close if line 189
 }//closes line 171





								           //$display_blocktn .= $display_blocktn1.'</tr>';

$display_blocktn .= $display_blocktn1.'<tr><td colspan="4" ><INPUT type="submit" name="B1" value="Process Now">
							           ';
							$display_blocktn .='<hr color="navy">';
							
						   $display_blocktn .= '</td>';

 $display_blocktn .= "</tr>

<tr><td colspan='4'><p>The first column obviously posts the monthly price in Bitcoin. <font color='red'>The second column represents a <b>real time market price (Bitstamp)</b> of that Bitcoin's value in USD. The current Bitcoin price just used to make the conversion is \$$bitcoin_marketprice_usd. That Bitcoin value in dollars will change with market conditions but your price (in Bitcoin) remains the same amount of Bitcoin unless you modify and change its price slot. Again, the Bitcoin price is what is used for the price_slot tag/label and what your account will be charged.</font>
<p>The third column reports the number of paying links - in that particular price slot. All paid links are displayed according to what price slot they are in with the highest being displayed on the page first. 
<p>By paying the even the minimum (a few Satoshis) you do get to move your listing ahead of all the free links and if no one else has purchased another price slot in that category then your link will actually be displayed first. That is, until such time as someone does pay the fee of a higher price slot.

";
		  $display_blockb = '</table></FORM>';//closes opening form line 361
}//close if selected link id matches link id line 150
		
	
          echo $display_blocktnop, $display_blocktn,$display_blockb;
?>
