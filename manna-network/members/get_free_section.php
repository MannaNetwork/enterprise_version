<?
	$table_top = '<table  id="member" width="890" id="cpanel"  style="background-color: Linen ; text-align: left">';
		 $table_body = '<tr><td colspan="4" style="text-align: center">';
		$table_body .= '<h1>Your Sites Listed For Free*</h1>';
		$table_body .= '<p align="left" style="color:red">Note: links in categories with populations of greater than twenty links are displayed in red as a reminder that your link may be being displayed at lower pages (they are ordered by seniority). <b>You can easily jump ahead of them. You can even try out our "paid system" FOR FREE by using our "demo coins" which you can request from the administrator (use the contact form). </b>. <br>'; 
		$table_body .= '</td></tr>';

	foreach($db_idf as $key=>$value){
			$catPop_arrf = $CATinfo->getCatPop($db_categoryf[$key]);
			$catPop = $catPop_arrf[0];
			$cat_namef= $catPop_arrf[2];
			$num_queries =  $price_slot_info->get_click_tallies_for_link_list_from_gen($db_categoryf[$key]);
			$count_links=0;
	 //  if(isset($value))
//found this commented out and was getting errors from a query being made to PSC that had no category number (but corrected in testnet section first)
		//changed it to skipping if category is empty from skipping if key was 0
//even though was not getting errors in this section
if($db_categoryf[$key]>0)
  {

		$catPop1 = explode(",",$catPop);
		$price_slot_info_array = $price_slot_info->getPriceSlotGen($db_categoryf[$key]);
              $getThisLinksFreeRank =  $price_slot_info->getThisLinksFreeRank($db_categoryf[$key], $db_idf[$key]);
              $base_price = $price_slot_info->getBasePrice();
                     //array($id, 	$is_active, 	$base_price, 	$adj_factor, 	$total_slots, 	$t_timestamp)
		$cat_price = $price_slot_info_array[3];
		$cat_price = rtrim(rtrim($cat_price, "0"),".");
		$price_adj_factor= $price_slot_info_array[2];
$coin_type = "free";
		$num_pages_arrayf = $price_slot_info->howManyRadiosPaid($db_categoryf[$key], $db_idf[$key], $coin_type);
		$num_of_pagesf1 = $num_pages_arrayf[0];//this is the top buyers number
		 $num_of_pagesf1 = $num_of_pagesf1 +1;//the func only checks for the highest bidder in a //catageory - if none it returns zero
	 	$num_paid_subscripts_in_cat = $price_slot_info->getNumofSubscriptsinCat($db_categoryf[$key]);
                 
                       $table_body .= '</td>';
		             $table_body .= "<td>";
				if($catPop1[14] > 20){
				 $table_body .= '<div style="text-align:left; font-size: 75%; color: red;"  border="1">LINK ID# -'.$db_idf[$key].'<br>Category Name - '.$cat_namef.'<br>Category Link Population = '.$catPop1[14].'<br>'.$num_queries . ' queries/mo.';
				}
				else
				{
				 $table_body .= '<div style="text-align:left; font-size: 75%; " border="1">LINK ID# -'.$db_idf[$key].'<br>Category Name<br>'.$cat_namef.'<br>Cat. Link Population<br>'.$catPop1[14].'<br>';
//Queries/mo. #<br>'.$num_queries . '<br>';
				}
      $getThisLinksFreeRank =  $price_slot_info->getThisLinksFreeRank($db_categoryf[$key], $db_idf[$key]);	
	                  		  
$table_body .= '<br>Your Link\'s <br> Position <br>In The Category Is #'.$getThisLinksFreeRank;
   $table_body .= "<br>&nbsp;<br><hr>Get Placed Ahead <br>Of <u>All</u> Other <br>Free Links <br>For Less Than <br>A Penny A Month!<br>Click The Button Below <br>For More Info.<a href='../members/modal/buy_placement.php?link_id=$db_idf[$key]";
/*if($balance_bitcoin > 0){
$table_body .= " & balance_bitcoin=$balance_bitcoin";
}
if($balance_testcoin > 0){
$table_body .= " & balance_testcoin=$balance_testcoin";
}
*/


 $table_body .= "' title='Better Placement Control Panel' rel='gb_page_center[840, 480]'><div style=\"width:100px; background-image: url('images960/1x1tran.gif'); background-repeat: repeat-x; background-color: orange; color:white; font-size:100%;-moz-border-radius: 15px;
								         border-radius: 15px;text-align: center;\">Purchase Better Placement</div></a>
";

//temp work around to get a name into MultiUser display
//give it the same name as the url
if($db_namef[$key] == "Blogs Link Name"){
$db_namef[$key] = $db_urlf[$key];
}
if($db_descriptionf[$key] == "Blogs Link Description"){
$pieces = explode(".",$db_urlf[$key]);
$db_descriptionf[$key] ="This is your WordPress MultiUser Blog at the ".$pieces[1]. " website!";
}
	$table_body .= '<td><a STYLE="text-decoration: none " href="' .	$db_urlf[$key] . '">' .	$db_namef[$key];


		$table_body .= '</a></td>';
		$table_body .= '<td>' .	$db_descriptionf[$key];
		$table_body .= '</td>';
		$folder_namef_pair = $LINKinfo->getFolderName($db_idf[$key]);
		$db_folder_namef = $folder_namef_pair[0];
		$db_file_namef = $folder_namef_pair[1];
		$start_clone_datef = $folder_namef_pair[2];
		$end_clone_datef = $folder_namef_pair[3];
$isAWidget = $LINKinfo->isAWidget($db_idf[$key]);
//echo 'line 68 of get free section isawidget  = ', $isAWidget;
//include('rgt_mngmt_menu.php');


			if($isAWidget == 1 AND $end_clone_datef=="0000-00-00 00:00:00"){
			  $table_body .= '<td colspan="4" style="text-align: center"> <a  href="reg_form/widget_index_custom.php?link_selected=' .$db_idf[$key].'&type=manage"  class="cssbutton sample b"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px;
			    border-radius: 15px;text-align: center;">&nbsp;<br>Web<br>&nbsp;Directory&nbsp;Admin&nbsp;</div></a>

';
			      }
			     elseif($isAWidget == 1 AND $end_clone_datef !="0000-00-00 00:00:00"){
		     	       $table_body .= '<td colspan="4" style="text-align: center"> <a   href="reg_form/widget_index_custom.php?link_selected=' .$db_idf[$key].'&type=startup" class="cssbutton sample b"><div style="width:150px;background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: yellow; color:black; font-size:100%;-moz-border-radius: 15px;
				border-radius: 15px;text-align: center;">Web<br>&nbsp;Directory&nbsp;<br>&nbsp;Admin&nbsp;</div></a>';
				    }
				     else
					{
					$table_body .= '<td  colspan="4" style="text-align: center"> <a  href="reg_form/widget_index_custom.php?link_selected=' .$db_idf[$key].'" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px;
					border-radius: 15px;text-align: center;">&nbsp;Earn&nbsp;<br>&nbsp;Income&nbsp;</div></a>
';
					}

/* is generating errors so try without category
if((array_key_exists($key, $db_categoryf) 
AND $db_categoryf[$key] == 10033) 
OR (array_key_exists($key, $db_categoryp) 
AND $db_categoryp[$key] == 10033) 
OR (array_key_exists($key, $db_categorytn) 
AND $db_categorytn[$key] == 10033)  
)
if(array_key_exists($key, $db_categoryf) 
//AND $db_categoryf[$key] == 10033) 
OR array_key_exists($key, $db_categoryp) 
//AND $db_categoryp[$key] == 10033) 
OR array_key_exists($key, $db_categorytn) 
//AND $db_categorytn[$key] == 10033)  
)
*/

//if($db_categoryf[$key] == 10033)
//{
                                                                            
			$table_body .= '<br><a href="change_link_index.php/'.$db_categoryf[$key]."/".$db_idf[$key].'" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px;
			border-radius: 15px;text-align: center;">EDIT &nbsp;Link&nbsp;Info&nbsp;</div></a>';
/*}
else
{
$table_body .= '<br><a href="reg_form/index_edit.php/'.$db_categoryf[$key]."/".$db_idf[$key].'" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px;
			border-radius: 15px;text-align: center;">EDIT &nbsp;Link&nbsp;Info&nbsp;</div></a>';
}
*/						//need func here to check if this link is widget and, if so, has either widgets as downline or users registered
			if($isAWidget == 1){
				if($db_approvedf[$key]=="deactivated_dead"){
				  $table_body .= '<br><a href="reg_form_reactivate.php?website_id='.$db_idf[$key]."&category=".$db_categoryf[$key].'" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: red; color:#ffffff; font-size:70%;-moz-border-radius: 15px;
				    border-radius: 15px;text-align: center;">Dead Link Deactivated</div></a>';
				   	}elseif($db_approvedf[$key]=="deactivated_by_user"){
				  $table_body .= '<br><a href="reg_form_reactivate.php?website_id='.$db_idf[$key]."&category=".$db_categoryf[$key].'" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: red; color:#ffffff; font-size:70%;-moz-border-radius: 15px;
				    border-radius: 15px;text-align: center;">Deactivated</div></a>';
				   	}elseif($db_approvedf[$key]=="false"){
					  $table_body .= '<br><a href="reg_form_deactivate.php?link_id='.$db_idf[$key]."&cat_id=".$db_categoryf[$key].'&link_type=free" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: yellow; color:black; font-size:70%;-moz-border-radius: 15px;
					   border-radius: 15px;text-align: center;">Pending</div></a>';
					        }
						elseif($db_approvedf[$key]=="rejected"){
						   $table_body .= '<br><a href="reg_form_reactivate.php?website_id='.$db_idf[$key]."&category=".$db_categoryf[$key].'" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: black; color:#ffffff; font-size:70%;-moz-border-radius: 15px;
						    border-radius: 15px;text-align: center;">Rejected</div></a>';
						       }
							else
							{
							  $table_body .= '<br><a href="reg_form_deactivate.php?link_id='.$db_idf[$key]."&cat_id=".$db_categoryf[$key].'&link_type=free" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: green; color:#ffffff; font-size:70%;-moz-border-radius: 15px;
							    border-radius: 15px;text-align: center;">Active</div></a>';
							}
		        }	
			else
			{
			$table_body .= '<br><a href="reg_form_delete.php?link_id='.$db_idf[$key]."&cat_id=".$db_categoryf[$key].'&link_type=free" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: gray; color:#ffffff; font-size:70%;-moz-border-radius: 15px;
			border-radius: 15px;text-align: center;">&nbsp;Cancel &nbsp;</div></a>';
			}
     		 $table_body .= '</td></tr><td colspan="4"> &nbsp;</td></tr><tr><td colspan="4"><hr style=" height: 4px; color: black;  background-color: black;" ></td></tr>';
	
	}//closes if
}//closes foreach
$table_body .= "<tr><td height='50' colspan = '4'><p align='center'>End - Sites Listed For Free</p><hr style=' height: 4px; color: black;  background-color: black;' ></td></tr>";
		  
$table_end = "</table>";
echo $table_top . $table_body . $table_end;
?><br>
<!--<INPUT type="submit" name="B1" value="Process Selections To Buy Now">-->
<?//}?>
</FORM>

</p>

<p>You'll be amazed at our prices!  <P STYLE="margin-bottom: 0in"><BR>
</P>   

