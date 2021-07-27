<?
echo '<h2>in new affil = ', $num_rows_affil;
	 $affil_blockt = '<table id="member" width="890" id="cpanel" style="background-color: #a0a0a0; text-align: left">';
  $affil_blockmaf .= '<tr><td colspan="4" style="text-align: center">';
	    $affil_blockmaf .= '<H1>Your Affiliate Program Admin Panel</h1>';
            $affil_blockmaf .= '</td></tr>';

$affil_blockmaf .= '<tr><td colspan="4">Go To Affiliate Site</td></tr>';

$affil_blockmaf .= '<p align="left" style="color:red">Note: links in the Personal Blog category are ordered by seniority but you can easily jump ahead of them FOR FREE by using our "demo coins" which you have received or that you can request from the administrator (use the contact form). </b>. <br>'; 
		$affil_blockmaf .=  '</td></tr>';
		
foreach ($db_idaf as $key => $value)
		{
                    $count_links=0;
		//   if($key>0)
		//   {

			//$contract_info = explode("-",$db_contract_lengthaf[$key])	;not used antwhere?			
		         $catPop_arraf = $CATinfo->getCatPop($db_categoryaf[$key]);
		          $num_queries =  $price_slot_info->get_click_tallies_for_link_list_from_gen($db_categoryaf[$key]);
                          $user_purchase_info = $price_slot_info->getThisUsersLastBoughtPriceSlot($db_categoryaf[$key], $db_idaf[$key]);
  $getThisLinksPaidRank =  $price_slot_info->getThisLinksPaidRank(10033, $db_idaf[$key]);	
	                  
	                     //returns array($id, $user_id, $price_slot_amnt)	
                             // $getThisLinksPaidRank =  $price_slot_info->getThisLinksPaidRank($db_categoryaf[$key], $db_idaf[$key]);	
	                    $catPopafa = $catPop_arraf[0];
				  $catPopaf = explode(",",$catPopafa);
				
								if($count_of_top_links>1)
							 	 {
								  //this user is at least tied for top bid so add a radio to let them break the tie
								 $num_of_pagesaf = $top_buyer_num_of_pages + 1;
								   }
								  else
								   {//they must be the sole occupant AND the top bidder of this slot so no need to let them try to outbid themselve -- uh oh unless they have more than one link themselves in the category - they may want to have one as senior, and, not displaying higher empties keep them from catapaulting ahead. Add one to the else also for testing
								  $num_of_pagesaf = $top_buyer_num_of_pages + 1;
								 }
						    $affil_blockmaf .= '<tr';
								if($catPopaf[14] > 20){
								$affil_blockmaf .= ' style="color:red;"';
								}
			$affil_blockmaf1 ="";
		$affil_blockmaf2="";
	$affil_blockmaf3="";

$affil_blockmaf .= '><td colspan="2"><div style="text-align:left; font-size: 75%;" border="1"> ';
$affil_blockmaf .= "<br><a target='_blank' href='$db_urlaf[$key]' title='Go To Blog Site' ><div style=\"width:100px; background-image: url('images960/1x1tran.gif'); background-repeat: repeat-x; background-color: orange; color:white; font-size:100%;-moz-border-radius: 15px;
 border-radius: 15px;text-align: center;\">Go To Affiliate Page</div></a>";
if($getThisLinksPaidRank > 0){

$affil_blockmaf .= '<p class="smallerFont">Your Link\'s <br> Position <br>Is #'.$getThisLinksPaidRank;
$affil_blockmaf .= "<p class='smallerFont'>Click The Button Below <br>To Modify Or Cancel.</p>";
}
else
{

   $affil_blockmaf .= "<p style='text-align:left; font-size:small;'>Get Placed Ahead <br>Of <u>All</u> Other <br>Free Links <br>For Less Than <br>A Penny A Month!</p><p  style='text-align:left; font-size:small;'>Click The Button Below <br>For More Info.</p>";

}


 $affil_blockmaf .= "<a href='../members/modal/buy_placement.php?link_id=$db_idaf[$key]";


$affil_blockmaf .= "' title='Better Placement Control Panel' rel='gb_page_center[840, 480]'><div style=\"width:100px; background-image: url('images960/1x1tran.gif'); background-repeat: repeat-x; background-color: orange; color:white; font-size:100%;-moz-border-radius: 15px;
								         border-radius: 15px;text-align: center;\">Purchase Better Placement</div></a>
";






$affil_blockmaf .= "<br>LINK ID = $db_idaf[$key]";
							
					   $affil_blockmaf .= '</td>';
						    $affil_blockmaf .= '<td colspan="2"><a href="'. $db_urlaf[$key] . '">' . $db_urlaf[$key] . "</a></td>";
						     $affil_blockmaf .= "<td colspan='4'>Desc  ";
						      $affil_blockmaf .=  $db_descriptionaf[$key];
						       $affil_blockmaf .= "</td>";
							$folder_nameaf_pair = $LINKinfo->getFolderName($db_idaf[$key]);
							  $db_folder_nameaf = $folder_nameaf_pair[0];
							    $db_file_nameaf = $folder_nameaf_pair[1];
							     $start_clone_dateaf = $folder_nameaf_pair[2];
							      $end_clone_dateaf = $folder_nameaf_pair[3];



										if($db_folder_nameaf != "" || $db_file_nameaf  != "" AND $end_clone_dateaf=="0000-00-00 00:00:00"){
										 $affil_blockmaf .= '<td colspan="2" style="text-align: center"> 

<a   href="reports/user_cp_commissions_reports.php?link_selected=' .$db_idaf[$key].'&type=stats" class="cssbutton sample b"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: navy; color:#ffffff; font-size:100%;-moz-border-radius: 15px;
										   border-radius: 15px;text-align: center;">Affiliate<br>&nbsp;Site&nbsp;<br>&nbsp;Stats &nbsp;</div></a>';
										      }
										     elseif($db_folder_nameaf != "" || $db_file_nameaf  != "" AND $end_clone_dateaf !="0000-00-00 00:00:00"){
											$affil_blockmaf .= '<td colspan="2" style="text-align: center"> 

<a   href="reports/user_cp_commissions_reports.php?link_selected=' .$db_idaf[$key].'&type=stats" class="cssbutton sample b"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: navy; color:#ffffff; font-size:100%;-moz-border-radius: 15px;
										   border-radius: 15px;text-align: center;">Web<br>&nbsp;Directory&nbsp;<br>&nbsp;Stats &nbsp;</div></a>';
											   }
											
									//	$affil_blockmaf .= '<br><a href="reg_form/index_edit.php/'.$db_categoryaf[$key]."/".$db_idaf[$key].'" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: navy; color:#ffffff; font-size:100%;-moz-border-radius: 15px;										border-radius: 15px;text-align: center;">&nbsp;EDIT&nbsp;</div></a>&nbsp;';
										//need func here to check if this link is widget and, if so, has either widgets as downline or users registered
									if($db_folder_nameaf != "" || $db_file_nameaf  != ""){
											if($db_approvedaf[$key] == "deactivated_by_user" AND $end_clone_dateaf=="0000-00-00 00:00:00"){
											$affil_blockmaf .= '<br>&nbsp;<a href="reg_form_reactivate.php?link_id='.$db_idaf[$key]."&cat_id=".$db_categoryaf[$key].'" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: red; color:#ffffff; font-size:70%;-moz-border-radius: 15px;
											border-radius: 15px;text-align: center;">&nbsp; Deactivated &nbsp;</div></a>';
											}
											elseif($db_approvedaf[$key] == "deactivated_by_user" AND $end_clone_dateaf !="0000-00-00 00:00:00"){
											$affil_blockmaf .= '<br>&nbsp;<a href="reg_form_reactivate.php?link_id='.$db_idaf[$key]."&cat_id=".$db_categoryaf[$key].'" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: yellow; color:black; font-size:70%;-moz-border-radius: 15px;
											border-radius: 15px;text-align: center;"> Start Up Mode &nbsp;</div></a>';
											}
											else
											{
											$affil_blockmaf .= '<br>&nbsp;<a href="reg_form_deactivate.php?link_id='.$db_idaf[$key]."&cat_id=".$db_categoryaf[$key].'&link_type=paid" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: green; color:#ffffff; font-size:70%;-moz-border-radius: 15px;
											border-radius: 15px;text-align: center;">Active</div></a>';
											}
									}
									else
									{
									$affil_blockmaf .= '<br>&nbsp;<a href="reg_form_delete.php?link_id='.$db_idaf[$key]."&cat_id=".$db_categoryaf[$key].'&link_type=paid" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: gray; color:#ffffff; font-size:70%;-moz-border-radius: 15px;
									border-radius: 15px;text-align: center;">&nbsp; Cancel &nbsp;</div></a>';
									}
	    	     $affil_blockmaf .= "</td></tr><td colspan='4'> &nbsp;</td></tr><tr><td colspan='9'> <hr style=' height: 4px; color: black;  background-color: black;' ></td></tr><tr>";

		//}//close if
	    }//close foreach line 304
$affil_blockmaf .= "<tr><td height='50' colspan = '4'><p align='center'>End Your Affiliate Sites Admin Panel</p></td></tr>";
		  $affil_blockb = '</table>';//closes opening form line 361
          echo $affil_blockt, $affil_blockmaf,$affil_blockb;

?>
