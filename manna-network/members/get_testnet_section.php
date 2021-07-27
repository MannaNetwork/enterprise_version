<?
	 $display_blocktn_top = '<table  width="890" id="cpanel" style="background-color: ffffff; text-align: left">';
	  $display_blocktn = '<tr><td colspan="4" style="text-align: center">';
	   $display_blocktn .= '<H1>Your Sites Getting Higher Placement Using Free Democoin!</h1>';
            $display_blocktn .= '</td></tr>';

foreach ($db_idtn as $key => $value)
		{
                  //  $count_links=0;
		 if($db_categorytn[$key]>0)  //found this commented out and was getting errors from a query being made to PSC that had no category number
		//changed it to skipping if category is empty from skipping if key was 0

  {
			$contract_info = explode("-",$db_contract_lengthtn[$key])	;			
		         $catPop_arrtn = $CATinfo->getCatPop($db_categorytn[$key]);
		          $num_queries =  $price_slot_info->get_click_tallies_for_link_list_from_gen($db_categorytn[$key]);
                          $user_purchase_info = $price_slot_info->getThisUsersLastBoughtPriceSlot($db_categorytn[$key], $db_idtn[$key]);
	                     //returns array($id, $user_id, $price_slot_amnt)	
                              $getThisLinksPaidRank =  $price_slot_info->getThisLinksPaidRank($db_categorytn[$key], $db_idtn[$key]);	
	                    $catPoptna = $catPop_arrtn[0];
				  $catPoptn = explode(",",$catPoptna);
					$price_slot_info_array = $price_slot_info->getPriceSlotGen($db_categorytn[$key]);
					$price_adj_factor= $price_slot_info_array[2];
					$cat_price = $price_slot_info_array[3];
					$cat_price = number_format($cat_price, 20, '.', '');
					$cat_name= $catPop_arrtn[2];  
$coin_type = "testcoin";
					$num_pages_array = $price_slot_info->howManyRadiosPaid($db_categorytn[$key], $db_idtn[$key], $coin_type);

						//returns both num of pages and count of how many links in top slot array($top_buyer_num_of_pages, $this_users_num_of_pages, = $num_pages_array[1];);
						$top_buyer_num_of_pages = $num_pages_array[0];
						$this_users_num_of_pages = $num_pages_array[1];
						$count_of_top_links = $num_pages_array[2];
						$top_buyer_link_id = $num_pages_array[3];//shouldn't link id be 4th?
								if($count_of_top_links>1)
							 	 {
								  //this user is at least tied for top bid so add a radio to let them break the tie
								  $num_of_pagestn = $top_buyer_num_of_pages + 1;
								   }
								   else
								   {//they must be the sole occupant AND the top bidder of this slot so no need to let them try to outbid themselve -- uh oh unless they have more than one link themselves in the category - they may want to have one as senior, and, not displaying higher empties keep them from catapaulting ahead. Add one to the else also for testing
								  $num_of_pagestn = $top_buyer_num_of_pages + 1;
								 }
						     $display_blocktn .= '<tr';
								if($catPoptn[14] > 20){
								$display_blocktn .= ' style="color:red;"';
								}
				$display_blocktn1 ="";
		$display_blocktn2="";
	$display_blocktn3="";
$display_blocktn .= '><td><div style="text-align:left; font-size: 75%;" border="1"> LINK ID# -'.$db_idtn[$key].'<br>Category Name - '.$cat_name.'<br>Category Link Population = '.$catPoptn[14].'<br>Your Link\'s Current Price Slot: '.(float)$user_purchase_info[2].'<br>Your Link\'s Current Position <br>is # '. $getThisLinksPaidRank.'<br><span STYLE="font-size: 140%; text-align:center;">Category gets '.$num_queries . ' queries/mo.';
							$display_blocktn .= "<br><a href='../members/modal/modify_placement.php?link_id=$db_idtn[$key]&fut_buyr_type=testcoin' title='Better Placement Control Panel' rel='gb_page_center[840, 480]'><div style=\"width:100px; background-image: url('images960/1x1tran.gif'); background-repeat: repeat-x; background-color: orange; color:white; font-size:100%;-moz-border-radius: 15px;
								         border-radius: 15px;text-align: center;\">Modify Or Cancel<br>Your Paid Position</div></a>";
							$user_top_active_bid = $price_slot_info->getUsersTopBoughtSpot($db_categorytn[$key], $user_id);
							$cat_price2 = $cat_price;
						   $display_blocktn .= '</td>';
						  //  $display_blocktn .= '<td><a href="'. $db_urltn[$key] . '">' . $db_nametn[$key] . "</a></td>";
$display_blocktn .= '<td><a href="'. $db_urltn[$key] . '">' . $db_urltn[$key] . "</a></td>";
						     $display_blocktn .= "<td>";
						      $display_blocktn .=  $db_descriptiontn[$key];
						       $display_blocktn .= "</td>";
							$folder_nametn_pair = $LINKinfo->getFolderName($db_idtn[$key]);
							  $db_folder_nametn = $folder_nametn_pair[0];
							    $db_file_nametn = $folder_nametn_pair[1];
							     $start_clone_datetn = $folder_nametn_pair[2];
							      $end_clone_datetn = $folder_nametn_pair[3];

$isAWidget = $LINKinfo->isAWidget($db_idtn[$key]);
//include('rgt_mngmt_menu.php');


				if($isAWidget == 1 AND $end_clone_datetn=="0000-00-00 00:00:00"){
										 $display_blocktn .= '<td colspan="4" style="text-align: center"> <a   href="reg_form/widget_index_custom.php?link_selected=' .$db_idtn[$key].'&type=manage" class="cssbutton sample b"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px;
										   border-radius: 15px;text-align: center;">&nbsp;Web<br>&nbsp;Directory&nbsp;Admin&nbsp;</div></a>';
										      }
										     elseif($isAWidget == 1 AND $end_clone_datetn !="0000-00-00 00:00:00"){
											$display_blocktn .= '<td colspan="4" style="text-align: center"><a   href="reg_form/widget_index_custom.php?link_selected=' .$db_idtn[$key].'&type=start_up" class="cssbutton sample b"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px;
										   border-radius: 15px;text-align: center;">&nbsp;Web<br>&nbsp;Directory&nbsp;Admin&nbsp;</div></a>';
											   }
											    else
{
 $display_blocktn .= '<td colspan="4" style="text-align: center"><a  href="reg_form/widget_index_custom.php?link_selected='.$db_idtn[$key].'&type=new" link class="cssbutton sample a" ><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px;
											border-radius: 15px;text-align: center;">&nbsp;Add A <br>Web<br>&nbsp;Directory&nbsp;</div></a>';

}

/*if($db_categorytn[$key] == 10033  ){
										$display_blocktn .= '<br><a href="reg_form/index_edit_ms_blogs.php/'.$db_categorytn[$key]."/".$db_idtn[$key].'" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px;
										border-radius: 15px;text-align: center;">&nbsp;EDIT&nbsp;Link&nbsp;Info&nbsp;</div></a>&nbsp;';
}
else
{*/
//$display_blocktn .= '<br><a href="reg_form/index_edit.php/'.$db_categorytn[$key]."/".$db_idtn[$key].'" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px; border-radius: 15px;text-align: center;">&nbsp;EDIT&nbsp;Link&nbsp;Info&nbsp;</div></a>&nbsp;';
$display_blocktn .= '<br><a href="change_link_index.php/'.$db_categorytn[$key]."/".$db_idtn[$key].'" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px; border-radius: 15px;text-align: center;">&nbsp;EDIT&nbsp;Link&nbsp;Info&nbsp;</div></a>&nbsp;';

//change_link_index.php
//}
										
										//need func here to check if this link is widget and, if so, has either widgets as downline or users registered
									if($isAWidget == 1){
											if($db_approvedtn[$key] == "deactivated_dead" AND $end_clone_datetn=="0000-00-00 00:00:00"){
											$display_blocktn .= '<br>&nbsp;<a href="reg_form_reactivate.php?link_id='.$db_idtn[$key]."&cat_id=".$db_categorytn[$key].'" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: red; color:#ffffff; font-size:70%;-moz-border-radius: 15px;
											border-radius: 15px;text-align: center;">&nbsp; Dead Link Deactivated &nbsp;</div></a>';
											}elseif($db_approvedtn[$key] == "deactivated_by_user" AND $end_clone_datetn=="0000-00-00 00:00:00"){
											$display_blocktn .= '<br>&nbsp;<a href="reg_form_reactivate.php?link_id='.$db_idtn[$key]."&cat_id=".$db_categorytn[$key].'" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: red; color:#ffffff; font-size:70%;-moz-border-radius: 15px;
											border-radius: 15px;text-align: center;">&nbsp; Deactivated &nbsp;</div></a>';
											}
											elseif($db_approvedtn[$key] == "deactivated_by_user" AND $end_clone_datetn !="0000-00-00 00:00:00"){
											$display_blocktn .= '<br>&nbsp;<a href="reg_form_reactivate.php?link_id='.$db_idtn[$key]."&cat_id=".$db_categorytn[$key].'" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: yellow; color:black; font-size:70%;-moz-border-radius: 15px;
											border-radius: 15px;text-align: center;"> Start Up Mode &nbsp;</div></a>';
											}
											else
											{
											$display_blocktn .= '<br>&nbsp;<a href="reg_form_deactivate.php?link_id='.$db_idtn[$key]."&cat_id=".$db_categorytn[$key].'&link_type=testnet" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: green; color:#ffffff; font-size:70%;-moz-border-radius: 15px;
											border-radius: 15px;text-align: center;">Active</div></a>';
											}
									}
									else
									{
									$display_blocktn .= '<br>&nbsp;<a href="reg_form_delete.php?link_id='.$db_idtn[$key]."&cat_id=".$db_categorytn[$key].'&link_type=testnet" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: gray; color:#ffffff; font-size:70%;-moz-border-radius: 15px;
									border-radius: 15px;text-align: center;">&nbsp; Cancel &nbsp;</div></a>';
									}
	    	     $display_blocktn .= "</td></tr><td colspan='4'> &nbsp;</td></tr><tr><td colspan='4'> <hr style=' height: 4px; color: black;  background-color: black;' ></td></tr><tr>";

		}//close if
	    }//close foreach line 304
$display_blocktn .= "<tr><td height='50' colspan = '4'><p align='center'>End - Sites Advanced By DemoCoin Payments</p><hr style=' height: 4px; color: black;  background-color: black;' ></td></tr>";
		  $display_blocktn_bottom = '</table>';//closes opening form line 361
          echo $display_blocktn_top, $display_blocktn,$display_blocktn_bottom;


