<?	if($db_folder_nametn != "" || $db_file_nametn  != "" AND $end_clone_datetn=="0000-00-00 00:00:00"){
										 $display_blocktn .= '<td colspan="4" style="text-align: center"> <!--<a   href="reg_form/widget_index_custom.php?link_selected=' .$db_idtn[$key].'&type=manage" class="cssbutton sample b"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px;
										   border-radius: 15px;text-align: center;">&nbsp; Manage &nbsp;<br>&nbsp;Web<br>&nbsp;Directory&nbsp;</div></a>-->
<!-- affiliate temporarily deactivated - point to a multisite based program in the future<br><a   href="reg_form/create_new_affiliate.php?link_selected=' .$db_idtn[$key].'&user_id='.$user_id.'" class="cssbutton sample b"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px;
										   border-radius: 15px;text-align: center;">Add<br>&nbsp;Affiliate&nbsp;<br>&nbsp;Portal &nbsp;</div></a>-->

<br><a   href="reports/user_cp_commissions_reports.php?link_selected=' .$db_idtn[$key].'&type=stats" class="cssbutton sample b"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px;
										   border-radius: 15px;text-align: center;">Web<br>&nbsp;Directory&nbsp;<br>&nbsp;Stats &nbsp;</div></a>';
										      }
										     elseif($db_folder_nametn != "" || $db_file_nametn  != "" AND $end_clone_datetn !="0000-00-00 00:00:00"){
											$display_blocktn .= '<td colspan="4" style="text-align: center"><!-- <a   href="reg_form/widget_index_custom.php?link_selected=' .$db_idtn[$key].'&type=start_up" class="cssbutton sample b" ><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: yellow; color:black; font-size:100%;-moz-border-radius: 15px;
											 border-radius: 15px;text-align: center;">&nbsp;Web<br>&nbsp;Directory&nbsp;<br>&nbsp;Start Up Mode &nbsp;</div></a> -->

<br><a   href="reg_form/create_new_partner.php?link_selected=' .$db_idtn[$key].'&user_id='.$user_id.'" class="cssbutton sample b"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px;
										   border-radius: 15px;text-align: center;">Add<br>&nbsp;Affiliate&nbsp;<br>&nbsp;Portal &nbsp;</div></a>


<br><a   href="reports/user_cp_commissions_reports.php?link_selected=' .$db_idtn[$key].'&type=stats" class="cssbutton sample b"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px;
										   border-radius: 15px;text-align: center;">Web<br>&nbsp;Directory&nbsp;<br>&nbsp;Stats &nbsp;</div></a>';
											   }
											    elseif($db_categorytn[$key] != '10033')
											     {
											  $display_blocktn .= '<td colspan="4" style="text-align: center"><!-- <a  href="reg_form/widget_index_custom.php?link_selected='.$db_idtn[$key].'&type=new" link class="cssbutton sample a" ><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px;
											border-radius: 15px;text-align: center;">&nbsp;Add A <br>Web<br>&nbsp;Directory&nbsp;</div></a>  -->
<br><a   href="reg_form/create_new_partner.php?link_selected=' .$db_idtn[$key].'&user_id='.$user_id.'" class="cssbutton sample b"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px;
										   border-radius: 15px;text-align: center;">Add<br>&nbsp;Affiliate&nbsp;<br>&nbsp;Portal &nbsp;</div></a>';
										    // $display_blocktn .= "</td>";
$display_blocktn .= '<br><a href="reg_form/index_edit.php/'.$db_categorytn[$key]."/".$db_idtn[$key].'" class="cssbutton sample a"><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px;
										border-radius: 15px;text-align: center;">&nbsp;EDIT&nbsp;</div></a>&nbsp;';	 
										}
else
{
 $display_blocktn .= '<td colspan="4" style="text-align: center"><a  href="reg_form/widget_index_custom.php?link_selected='.$db_idtn[$key].'&type=new" link class="cssbutton sample a" ><div style="width:150px; background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px;
											border-radius: 15px;text-align: center;">&nbsp;Add A <br>Web<br>&nbsp;Directory&nbsp;</div></a><br>';
 $display_blocktn .= '<td colspan="4" style="text-align: center"><br><a   href="reg_form/create_new_partner.php?link_selected=' .$db_idf[$key].'&user_id='.$user_id.'" class="cssbutton sample b"><div style="background-image: url(\'images960/1x1tran.gif\'); background-repeat: repeat-x; background-color: DarkSlateBlue; color:#ffffff; font-size:100%;-moz-border-radius: 15px;
										   border-radius: 15px;text-align: center;">Add<br>&nbsp;Affiliate&nbsp;<br>&nbsp;Portal &nbsp;</div></a>';
}
										
										//need func here to check if this link is widget and, if so, has either widgets as downline or users registered
									if($db_folder_nametn != "" || $db_file_nametn  != ""){
											if($db_approvedtn[$key] == "deactivated_by_user" AND $end_clone_datetn=="0000-00-00 00:00:00"){
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

?>

