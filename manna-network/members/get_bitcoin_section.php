<?
	$display_blockt = '<table  id="member" width="890" id="cpanel"  style="background-color: Linen ; text-align: left">';
		 $display_blockmp = '<tr><td colspan="4" style="text-align: center">';
		$display_blockmp .= '<h1>Your Sites Listed More Prominently And Paid With Bitcoin Cash</h1>';
		
		$display_blockmp .= '</td></tr>';			
foreach ($db_idp as $key => $value)
		{
                  //  $count_links=0;
		  // if($key>0)
		  // {

			$contract_info = explode("-",$db_contract_lengthp[$key])	;			
		         $catPop_arrp = $CATinfo->getCatPop($db_categoryp[$key]);
		          $num_queries =  $price_slot_info->get_click_tallies_for_link_list_from_gen($db_categoryp[$key]);
                          $user_purchase_info = $price_slot_info->getThisUsersLastBoughtPriceSlot($db_categoryp[$key], $db_idp[$key]);
	                     //returns array($id, $user_id, $price_slot_amnt)	
                              $getThisLinksPaidRank =  $price_slot_info->getThisLinksPaidRank($db_categoryp[$key], $db_idp[$key]);	
	                    $catPoppa = $catPop_arrp[0];
				  $catPopp = explode(",",$catPoppa);
					$price_slot_info_array = $price_slot_info->getPriceSlotGen($db_categoryp[$key]);
					$price_adj_factor= $price_slot_info_array[2];
					$cat_price = $price_slot_info_array[3];
					$cat_price = number_format($cat_price, 20, '.', '');
					$cat_name= $catPop_arrp[2];  
$coin_type = "bitcoin";
					$num_pages_array = $price_slot_info->howManyRadiosPaid($db_categoryp[$key], $db_idp[$key], $coin_type);
						//returns both num of pages and count of how many links in top slot array($top_buyer_num_of_pages, $this_users_num_of_pages, = $num_pages_array[1];);
						$top_buyer_num_of_pages = $num_pages_array[0];
						$this_users_num_of_pages = $num_pages_array[1];
						$count_of_top_links = $num_pages_array[2];
						$top_buyer_link_id = $num_pages_array[3];//shouldn't link id be 4th?
								if($count_of_top_links>1)
							 	 {
								  //this user is at least tied for top bid so add a radio to let them break the tie
								  $num_of_pagesp = $top_buyer_num_of_pages + 1;
								   }
								   else
								   {//they must be the sole occupant AND the top bidder of this slot so no need to let them try to outbid themselve -- uh oh unless they have more than one link themselves in the category - they may want to have one as senior, and, not displaying higher empties keep them from catapaulting ahead. Add one to the else also for testing
								  $num_of_pagesp = $top_buyer_num_of_pages + 1;
								 }
						     $display_blockmp .= '<tr';
								if($catPopp[14] > 20){
								$display_blockmp .= ' style="color:red;"';
								}
				$display_blockmp1 ="";
		$display_blockmp2="";
	$display_blockmp3="";
$display_blockmp .= '><td><div style="text-align:left; font-size: 75%;" border="1"> LINK ID# -'.$db_idp[$key].'<br>Category Name - '.$cat_name.'<br>Category Link Population = '.$catPopp[14].'<br>Your Link\'s Current Price Slot: '.(float)$user_purchase_info[2].'<br>Your Link\'s Current Position <br>is # '. $getThisLinksPaidRank.'<br><span STYLE="font-size: 140%; text-align:center;">Category gets '.$num_queries . ' queries/mo.';
							$display_blockmp .= "<br><a href='../members/modal/modify_placement.php?link_id=$db_idp[$key]&fut_buyr_type=bitcoin' title='Better Placement Control Panel' rel='gb_page_center[840, 480]'><div style=\"width:100px; background-image: url('images960/1x1tran.gif'); background-repeat: repeat-x; background-color: orange; color:white; font-size:100%;-moz-border-radius: 15px;
								         border-radius: 15px;text-align: center;\">Modify Or Cancel<br>Your Paid Position</div></a>";
							$user_top_active_bid = $price_slot_info->getUsersTopBoughtSpot($db_categoryp[$key], $user_id);
							$cat_price2 = $cat_price;
						   $display_blockmp .= '</td>';
						    $display_blockmp .= '<td><a href="'. $db_urlp[$key] . '">' . $db_namep[$key] . "</a></td>";
						     $display_blockmp .= "<td>";
						      $display_blockmp .=  $db_descriptionp[$key];
						       $display_blockmp .= "</td>";
							$folder_namep_pair = $LINKinfo->getFolderName($db_idp[$key]);
							  $db_folder_namep = $folder_namep_pair[0];
							    $db_file_namep = $folder_namep_pair[1];
							     $start_clone_datep = $folder_namep_pair[2];
							      $end_clone_datep = $folder_namep_pair[3];

if($num_rows_testnet >0){
$isAWidget = $LINKinfo->isAWidget($db_idtn[$key]);
}
else
{
$isAWidget = "";
//was getting errors in error log saying $db_idtn was "uninitialized" I think.
//So added if condition which caused error that isAWidget was undefined.
//so the only reason for the "else" is to define it.
}
//include('rgt_mngmt_menu.php');


				if($isAWidget == 1  AND $end_clone_datep=="0000-00-00 00:00:00"){
										 $display_blockmp .= '<td colspan="4" style="text-align: center"><a   href="reg_form/widget_index_custom.php?link_selected=' .$db_idp[$key].'&type=manage" class="cssbutton sample b"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px;
										   border-radius: 15px;text-align: center;">Web<br>&nbsp;Directory&nbsp;<br>&nbsp;Admin &nbsp;</div></a>';
										      }
										     elseif($isAWidget == 1 AND $end_clone_datep !="0000-00-00 00:00:00"){
											$display_blockmp .= '<td colspan="4" style="text-align: center"><a   href="reg_form/widget_index_custom.php?link_selected=' .$db_idp[$key].'&type=start_up" class="cssbutton sample b"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px;
										   border-radius: 15px;text-align: center;">Web<br>&nbsp;Directory&nbsp;<br>&nbsp;Admin &nbsp;</div></a>';
											   }
											    else
											     {
											  $display_blockmp .= '<td colspan="4" style="text-align: center"><a  href="reg_form/widget_index_custom.php?link_selected='.$db_idp[$key].'&type=new" link class="cssbutton sample a" ><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px;
											border-radius: 15px;text-align: center;">&nbsp;Web<br>&nbsp;Directory&nbsp;Admin</div></a>
';

								}
//if($db_categorytn[$key] == 10033 OR $db_categoryp[$key] == 10033 OR $db_categorytn[$key] == 10033  ){
//$display_blockmp .= '<br><a href="change_cat.php/'.$db_categoryp[$key]."/".$db_idp[$key].'" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px;border-radius: 15px;text-align: center;">&nbsp;EDIT&nbsp;<br>&nbsp;Plugin/PHP&nbsp;Script&nbsp;<br>&nbsp;Config&nbsp;</div></a>&nbsp;';
//}
//else
//{
//						$display_blockmp .= '<br><a href="reg_form/index_edit.php/'.$db_categoryp[$key]."/".$db_idp[$key].'" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px; border-radius: 15px;text-align: center;">&nbsp;EDIT&nbsp;Link&nbsp;Info&nbsp;</div></a>&nbsp;';
				$display_blockmp .= '<br><a href="change_link_index.php/'.$db_categoryp[$key]."/".$db_idp[$key].'" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px; border-radius: 15px;text-align: center;">&nbsp;EDIT&nbsp;Link&nbsp;Info&nbsp;</div></a>&nbsp;';

//change_link_index.php
//}
										//need func here to check if this link is widget and, if so, has either widgets as downline or users registered
									if($isAWidget == 1){
											if($db_approvedp[$key] == "deactivated_dead" AND $end_clone_datep=="0000-00-00 00:00:00"){
											$display_blockmp .= '<br>&nbsp;<a href="reg_form_reactivate.php?link_id='.$db_idp[$key]."&cat_id=".$db_categoryp[$key].'" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: red; color:#ffffff; font-size:70%;-moz-border-radius: 15px;
											border-radius: 15px;text-align: center;">&nbsp;Dead Link Deactivated &nbsp;</div></a>';
											}
											elseif($db_approvedp[$key] == "deactivated_by_user" AND $end_clone_datep=="0000-00-00 00:00:00"){
											$display_blockmp .= '<br>&nbsp;<a href="reg_form_reactivate.php?link_id='.$db_idp[$key]."&cat_id=".$db_categoryp[$key].'" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: red; color:#ffffff; font-size:70%;-moz-border-radius: 15px;
											border-radius: 15px;text-align: center;">&nbsp; Deactivated &nbsp;</div></a>';
											}
											elseif($db_approvedp[$key] == "deactivated_by_user" AND $end_clone_datep !="0000-00-00 00:00:00"){
											$display_blockmp .= '<br>&nbsp;<a href="reg_form_reactivate.php?link_id='.$db_idp[$key]."&cat_id=".$db_categoryp[$key].'" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: yellow; color:black; font-size:70%;-moz-border-radius: 15px;
											border-radius: 15px;text-align: center;"> Start Up Mode &nbsp;</div></a>';
											}
											else
											{
											$display_blockmp .= '<br>&nbsp;<a href="reg_form_deactivate.php?link_id='.$db_idp[$key]."&cat_id=".$db_categoryp[$key].'&link_type=paid" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: green; color:#ffffff; font-size:70%;-moz-border-radius: 15px;
											border-radius: 15px;text-align: center;">Active</div></a>';
											}
									}
									else
									{
									$display_blockmp .= '<br>&nbsp;<a href="reg_form_delete.php?link_id='.$db_idp[$key]."&cat_id=".$db_categoryp[$key].'&link_type=paid" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: gray; color:#ffffff; font-size:70%;-moz-border-radius: 15px;
									border-radius: 15px;text-align: center;">&nbsp; Cancel &nbsp;</div></a>';
									}
	    	     $display_blockmp .= "</td></tr><td colspan='4'> &nbsp;</td></tr><tr><td colspan='4'> <hr style=' height: 4px; color: black;  background-color: black;' ></td></tr><tr>";

		//}//close if
	    }//close foreach line 304
$display_blockmp .= "<tr><td height='50' colspan = '4'><p align='center'>End - Advanced Placement Sites </p><hr style=' height: 4px; color: black;  background-color: black;' ></td></tr>";
		  $display_blockb = '</table>';//closes opening form line 361
          echo $display_blockt, $display_blockmp,$display_blockb;


