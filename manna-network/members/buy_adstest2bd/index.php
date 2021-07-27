<?php


include($_SERVER['DOCUMENT_ROOT']."/classes/link_class.php");//load order 1
include($_SERVER['DOCUMENT_ROOT']."/classes/categories_class.php");//load order 2
include($_SERVER['DOCUMENT_ROOT']."/classes/free_categories.php");//load order 3
include($_SERVER['DOCUMENT_ROOT']."/classes/price_slot_class.php");//load order 5

$price_slot_info = new price_slot_info;
   $free_link_display = $price_slot_info->getFreeLinks($user_id);
       $paid_link_display = $price_slot_info->displayBlockPaid($user_id);
         
	  $num_rows_paid = $paid_link_display[0]; $db_idp= $paid_link_display[1]; 
	    $db_categoryp =$paid_link_display[2]; $db_freebiep = $paid_link_display[3]; $db_urlp = $paid_link_display[4];  $db_descriptionp = $paid_link_display[5];   $db_start_clone_datep = $paid_link_display[6];  $db_approvedp = $paid_link_display[7]; $db_namep = $paid_link_display[8]; $db_contract_lengthp= $paid_link_display[9];
	     $num_rows_free = $free_link_display[0];
	      $db_idf = $free_link_display[1];
	       $db_categoryf = $free_link_display[2];

		$db_urlf = $free_link_display[3];
		 $db_descriptionf = $free_link_display[4];
		  $db_namef = $free_link_display[5];
		   $db_contract_lengthf = $free_link_display[6];
		    $db_approvedf = $free_link_display[7];

foreach ($db_idp as $key => $value)
		{
echo '<br>line 239 key = ', $key;
                    $count_links=0;
		   if($key>0)
		   {
			$contract_info = explode("-",$db_contract_lengthp[$key])	;			
		         $catPop_arrp = $CATinfo->getCatPop($db_categoryp[$key]);
		          $num_queries =  $price_slot_info->get_click_tallies_for_link_list_from_gen($db_categoryp[$key]);
				$catPoppa = $catPop_arrp[0];
				  $catPopp = explode(",",$catPoppa);
//
					//$price_slot_info_array = $price_slot_info->getPriceSlotGen($db_categoryp[$key]);
					$price_adj_factor= $price_slot_info_array[2];
					$cat_price = $price_slot_info_array[3];
					$cat_price = number_format($cat_price, 8, '.', '');
					$cat_name= $catPop_arrp[2];  
					$num_pages_array = $price_slot_info->howManyRadiosPaid($db_categoryp[$key], $db_idp[$key]);
						//returns both num of pages and count of how many links in top slot array($top_buyer_num_of_pages, $this_users_num_of_pages, = $num_pages_array[1];);
						$top_buyer_num_of_pages = $num_pages_array[0];
						$this_users_num_of_pages = $num_pages_array[1];
						$count_of_top_links = $num_pages_array[2];
						$top_buyer_link_id = $num_pages_array[3];//shouldn't link id be 4th?


 $num_of_pagesp = $top_buyer_num_of_pages + 1;//this used to be an if/else user was tied for first - just add a new top slot
		$user_purchase_info = $price_slot_info->getThisUsersLastBoughtPriceSlot($db_categoryp[$key], $db_idp[$key]);
							$user_top_active_bid = $price_slot_info->getUsersTopBoughtSpot($db_categoryp[$key], $user_id);
							$cat_price2 = $cat_price;
								if($num_of_pagesp<2)
								{
								 $display_blockmp .= "<div STYLE='font-size: 85%; text-align:center;'>Current Subscription <br>Info<br>Your current Price Slot Is <br>";
								 $display_blockmp .= $cat_price2."/mo.<br> To be the top listing in this category select current bid price's checkbox and submit";
								  $display_blockmp .= "</div>";
								   //increment the base price and display from the highest price to the lowest(the base)
								   //this should be if count is greater than 1
								    $display_blockmp .= '<div><input type="checkbox" id="buyp'.$key.'" name="buyp'.$key.'" value="'.$cat_price.'" onClick="TotalCheckedValuesP()" ><br>$';
								     $display_blockmp .= $cat_price2.'/mo.
								     <table><tr><td style="text-align:center"; colspan="'.$num_of_pagesp.'" ><INPUT type="submit" name="B1" value="Process Now">
								      </FORM></td></tr></table></div>';
								}//close if less than 2
								else//make them radio buttons
								{
								$display_blockmp .= "<div STYLE='font-size: 85%; text-align:center;'><h4 style='color:red;'>";
								$display_blockmp .= rtrim(rtrim($user_purchase_info[2], "0"),".");
								$display_blockmp .= "<br>Your Current Slot Price <br>Is Indicated Above</h4>Select higher (or lower) amount below to modify your bid or select current price slot price to cancel.";
								$display_blockmp .= "</div>";
								$display_blockmp .='<table><tr>';
								for($i=1;$i <= $num_of_pagesp; $i++){
								  unset($incr_cat_price);
								    $incr_cat_price = 0;
								     for($t=0;$t<=$num_of_pagesp-$i;$t++){
									 if($incr_cat_price>0){
									   $incr_cat_price = $incr_cat_price+($incr_cat_price * $price_adj_factor);
									     }else{
									   $incr_cat_price = $cat_price;
										}//close else
									}//close for loop
								
									$incr_cat_price = rtrim(rtrim($incr_cat_price, "0"),".");
									$num_links_in_slot = $price_slot_info->getNumLinksInSlot($db_categoryp[$key], $incr_cat_price);
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
									if($incr_cat_price == $user_purchase_info[2]){
									$temp_incr_cat_price = $incr_cat_price;
									$display_blockmp1 .= '<td STYLE="font-size: 65%;background-color:'.$bgcolor.'""><input type="radio" id="buyp'.$key.'" name="buyp'.$key.'"  value="'.$temp_incr_cat_price.'" onClick="TotalCheckedValuesP()"></td>';
									}
									else
									{	
									$display_blockmp1 .= '<td STYLE="font-size: 65%;background-color:'.$bgcolor.'""><input type="radio" id="buyp'.$key.'" name="buyp'.$key.'"  value="'.$incr_cat_price.'" onClick="TotalCheckedValuesP()"></td>';
									}
									$display_blockmp2 .= "<td STYLE='font-size: 65%;'><h4>".$incr_cat_price." BTC/mo</h4></td>";
									//add a condition making sure Be top only displays for top link
									//finish making sure subscribe is turned to zero after quiting.
										if($num_links_in_slot == 0){
										   if($i == $num_of_pagesp - 1){
										      $display_blockmp3 .= "<td STYLE='font-size: 65%;'>Be<br>Top<br>Link</td>";
											}
											else
											{
											$display_blockmp3 .= "<td STYLE='font-size: 65%;'>No Links</td>";
											}
										     }
										    else{
										       $display_blockmp3 .= "<td STYLE='font-size: 65%;'>". $num_links_in_slot."<br>link";
											    if($num_links_in_slot == 1){
												$display_blockmp3 .="<br>in<br>slot</td>";
												}
												else
												{
												$display_blockmp3 .="s<br>in<br>slot</td>";
												}
										       }
									     }
								           $display_blockmp .= $display_blockmp1.'</tr><tr>'.$display_blockmp2.'</tr><tr>'.$display_blockmp3.'</tr>';
								          $display_blockmp .="<tr height='10px'><td colspan='$num_of_pagesp' STYLE='font-size: 65%;'> <a href='../members/modal/how_to_bid.php?link_id=$db_idp[$key]' title='Better Placement Control Panel' rel='gb_page_center[640, 480]'><div style=\"background-image: url('images960/1x1tran.gif'); background-repeat: repeat-x; background-color: navy; color:white; font-size:100%;-moz-border-radius: 15px;
								         border-radius: 15px;text-align: center;\">How To Bid</div></a></td></tr>";
								       $display_blockmp .= '<tr><td colspan="'.$num_of_pagesp.'" ><INPUT type="submit" name="B1" value="Process Now">
							           </FORM></td></tr>';
							$display_blockmp .='</table>';
							}//close else make them radios
						   $display_blockmp .= '</td>';

 $display_blockmp .= "</tr>";
		  $display_blockb = '</table>';//closes opening form line 361
		}//close if
	    }//close foreach line 357
          echo $display_blockt, $display_blockmp,$display_blockb;


?>	
