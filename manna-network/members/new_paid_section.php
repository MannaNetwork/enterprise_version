<?php

//this code will produce one link display section for the member/index page
//PRE_TTLSEC delivers everything before displaying $title var
define("PRE_TTLSEC", '<div class="bb_lnk_dspl_hdr"><h5 class="bb_lnk_dspl_hdr-heading"><table><tr><td rowspan="3" width=" 30%">');
define("PRE_LNKID", '<br><h6 style="background-color:white; width: 60%;color: black; border: .5px solid; border-radius: 5px; padding:1px 2.5px .5px; margin-left: auto ;  margin-right: auto ;"> Your Link/Affiliate Number Is');

//PRE_CATNAME delivers everything between previous and before displaying category name var
define("PRE_CATNAME", '</h6></td><td width = "30%" > &nbsp;</td><td width = "40%"> Category Name - ');

define("PRE_CATPOP", '</td></tr><tr><td width = "30%" > &nbsp;</td><td width = "40%"> Cat. Link Population ');

define("PRE_LNKPOS", '</td></tr><tr><td width = " 30%" > &nbsp;</td><td width = "40%"> Your Link\'s Position In The Category Is #');
define("PRE_WDGT_SWTCH", '</td></tr></table></h5></div><div class="bb_lnk_content"><div class="bb_lnk_container"><div class="col1"><h5>Buy/Sell Web Traffic</h5><div style="background-color:lightgrey;border: 2px solid; border-radius: 25px; padding:10px 25px 5px; margin-left: auto ;  margin-right: auto ;"><!-- If the incoming type from db or post? is "Manage" change the title tag of next link to "Web Directory Admin"--><h6><a class="btn" href=\'reg_form/widget_index_custom.php?link_selected=');
define("PRE_BUYAD", "&type=manage'>Web Directory Admin & Stats</a></h6><h6><a class='btn' href='../members/modal/buy_placement.php?link_id=");
define("PRE_LNKDESC", '\'>Purchase Better Placement Now!</a></h6></div></div><div class="col2"><h5>Your Current Link Description</h5><hr><p>');
define("PRE_EDITBTN", '</p><hr></div><div class="col3"><h5>Link Management</h5><div style="background-color:lightgrey;border: 2px solid; border-radius: 25px; padding:10px 25px 5px; margin-left: auto ;  margin-right: auto ;"><h6><a class="btnlnkedit" href="reg_form/index_edit.php/');
define("PRE_DELETEBTN", '">Edit &nbsp;Link&nbsp;Info&nbsp;</a></h6><h6 class="btnlnkedit"><a class="btnlnkedit" id="deactivate" href="reg_form_deactivate.php?link_id=');
define("BLOCK_END", '&link_type=free" >Deactivate</a></h6></div></div></div></div>');
$paid_link_block = "";
$paid_link_block .= PRE_TTLSEC.$db_namep[$key].PRE_LNKID.$db_idp[$key].PRE_CATNAME.$cat_namep.PRE_CATPOP.$catPop1[14].PRE_LNKPOS.$getThisLinksFreeRank.PRE_WDGT_SWTCH.$db_idp[$key].PRE_BUYAD.$db_idp[$key].PRE_LNKDESC.$db_descriptionp[$key].PRE_EDITBTN.$db_categoryp[$key]."/".$db_idp[$key].PRE_DELETEBTN."&cat_id=".$db_categoryp[$key].BLOCK_END; 

echo '$paid_link_block = ', $paid_link_block;

