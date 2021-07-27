<?
 include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/access_user_class.php"); 
  $page_protect = new Access_user;
  $page_protect->access_page(); // only set this this method to protect your page
$page_protect->get_user_info();
$user_id=$page_protect->id;
$access_level=$page_protect->user_access_level;

$hello_name = ($page_protect->user_full_name != "") ? $page_protect->user_full_name : $page_protect->user;
$listing_type = ($page_protect->user_info != "") ? $page_protect->user_info : $page_protect->user;
$test_access_level = new Access_user;
$test_access_level->access_page($_SERVER['PHP_SELF'], "", 1); // change this value to test differnet access levels (default: 1 = low and 10 high)
$id=$page_protect->id;
$user_id=$page_protect->id;

if (isset($_GET['action']) && $_GET['action'] == "log_out"){
$test_access_level->log_out(); // the method to log off
}
if (isset($_GET['action']) && $_GET['action'] == "log_out"){
$page_protect->log_out(); // the method to log off
}

include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/reg_form/config.php"); //old yald, don't use db connects but use settings
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/classes/reports_class.php");  
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/connect.php");
include($_SERVER['DOCUMENT_ROOT']."/classes/security_class.php");  

//note the above security class was created new, first time for this reports page. If it works well then it
//should be added to all forms submitted by users. the three functions should be run on all data being submitted to database
//htmlspecialchars should be run on all data coming from data base displayed to users
//see  http://www.acunetix.com/websitesecurity/php-security-1.htm
//the sqlprotection uses some type of magicqutoes sdetection (looks like) verify during datasubmission with this form whether it correctly escapes quotes and single quotes
 $check_security = new security;
$link_selected =   $check_security ->sql_inj_protection($link_selected);
$code_type = $check_security ->sql_inj_protection($code_type);
//for now run _INPUT on each var individually to strip tags from get and post vars but eventually, make an array of all 
//get  and/or post vars (separate lists if mixed post and get vars present) and send them all en masse to the func

$link_selected = $check_security ->_INPUT($link_selected);
$code_type = $check_security ->_INPUT($code_type);
$link_selected = $check_security ->_ESCAPESHELL($link_selected);
$code_type = $check_security ->_ESCAPESHELL($code_type);

$B1 = $_GET['B1']; //this B1 has not had tags stripped but next one does
if(isset($B1)){
/////////////////////////////////////////////////
$B1 = $check_security ->_INPUT($B1);//now B1 has had tags stripped

include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_top1.php");


echo'inside where all the b1 code was deleted';


include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_bottom1.php");

exit();
}//close ifisset$B1

$C1 = $_GET['C1'];

If(isset($C1)){
echo 'inside where all the C! code was deleted';
								
										
										}//closes if C1
										else// begin form
										{



////////////////////////////////////////////////////

include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_top1.php");
 
?>

<div id="doc2">					
	<div style="text-align: center; id=hd">
	<div style="text-align: center">
	
<div style="text-align: center;">
   				<a href="http://bungeebones.com/bungee_jumpers/" class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/reg_form" class="cssbutton sample a"><span>Add Link</span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/update_user.php" class="cssbutton sample a"><span> Your Profile </span></a>&nbsp;<a href="http://bungeebones.com/feedback.php" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="http://bungeebones.com/articles/terms_of_service.php/" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
					</div>
<div id="bd">
<?
$get_reports = new reports;
$this_userslist_of_links_and_info = $get_reports ->getSubmittersLinks($user_id);
$this_userslist_of_links = $get_reports ->getAllThisUsersLinks($user_id);
$count_of_links_this_user_list=count($this_userslist_of_links);
echo '$count_of_links_this_user_list = ', $count_of_links_this_user_list;
$this_userslist_of_linkssortedadescending = arsort($this_userslist_of_links);


foreach( $this_userslist_of_links_and_info as $key => $value){
$orig_id = $this_userslist_of_links[0];//0
$orig_BB_user_ID = $this_userslist_of_links[1];//1
$orig_category = $this_userslist_of_links[2];//2
$orig_url = $this_userslist_of_links[3];//3
$orig_name = $this_userslist_of_links[4];//4
$orig_description = $this_userslist_of_links[5];//5
$orig_continents = $this_userslist_of_links[6];//6

$orig_countries = $this_userslist_of_links[7];//7
$orig_states = $this_userslist_of_links[8];//8
$orig_cities = $this_userslist_of_links[9];//9
$orig_street = $this_userslist_of_links[10];//10
$orig_zip = $this_userslist_of_links[11];//11
$orig_phone = $this_userslist_of_links[12];//12
$orig_invoice_sent = $this_userslist_of_links[13];//13
$orig_invoice_paid = $this_userslist_of_links[14];//14
$orig_freebie = $this_userslist_of_links[15];//15
$orig_display_freebies = $this_userslist_of_links[16];//16
$orig_start_date = $this_userslist_of_links[17];//17
$orig_time_period= $this_userslist_of_links[18];//18
$orig_peer_rating = $this_userslist_of_links[19];//19
$orig_peer_vote_count = $this_userslist_of_links[20];//20
$orig_public_rating = $this_userslist_of_links[21];//21
$orig_public_vote_count = $this_userslist_of_links[22];//22
$orig_start_clone_date = $this_userslist_of_links[23];//23
$orig_folder_name = $this_userslist_of_links[24];//24
$orig_file_name = $this_userslist_of_links[25];//25
$orig_approved_build = $this_userslist_of_links[26];//26
$orig_custom_title1 = $this_userslist_of_links[27];//27
$orig_custom_title2 = $this_userslist_of_links[28];//28
$orig_click_tally = $this_userslist_of_links[29];//29
}



//print out report

foreach( $this_userslist_of_links as $key => $value){
$widgets_in_downline = "";
$this_users_link_info = $get_reports ->getThisLinksInfo($value);
$orig_id = $this_users_link_info[0];//0
$orig_BB_user_ID = $this_users_link_info[1];//1
$orig_category = $this_users_link_info[2];//2
$orig_url = $this_users_link_info[3];//3
$orig_name = $this_users_link_info[4];//4
$orig_description = $this_users_link_info[5];//5
$orig_start_date = $this_users_link_info[17];//17
$orig_time_period= $this_users_link_info[18];//18
$orig_folder_name = $this_users_link_info[24];//24
$orig_file_name = $this_users_link_info[25];//25
$orig_approved_build = $this_users_link_info[26];//26
$orig_custom_title1 = $this_users_link_info[27];//27
$orig_custom_title2 = $this_users_link_info[28];//28
$orig_click_tally = $this_users_link_info[29];//29
$tab_bod .= '<tr><td class="leftcontent">'.$value.'</td><td>'.$orig_name.'</td>';


$downline_list = $get_reports ->getDownline($orig_BB_user_ID);
foreach($downline_list as $key => $value){
$this_downlinelist_link_info = $get_reports ->getThisLinksInfo($value);
$orig_start_clone_date = $this_downlinelist_link_info[23];//23
$widgets_in_downline = $widgets_in_downline++;
}

$tab_bod .= '<td class="rightcontent">'.count($downline_list).'</td>';


$downline_widget_totals = $get_reports ->getWidgetCount($downline_list[$key]);
$tab_bod .= '<td>'.$widgets_in_downline.'</td>';




$tab_bod .= '<td><a href="/bungee_jumpers/reports/users_link_list.php?link_submitters_id='.$value.'">View User\'s Links</a></tr>';





}
$tab_hd .= '<tr class="toprow"><td class="leftcol">Site ID </td><td>Site Name</td><td class="rightcontent"># of Users</td><td># of Widgets</td></tr>';

echo '<table id="sample" cellspacing="2">'. $tab_hd .$tab_bod . '</table>';
//$new_this_userslist_of_links  = asort($count_of_links);
//print_r($new_this_userslist_of_links);

 $widgets_list = $get_reports ->getAllwidgets();
$downline_list = $get_reports ->getDownline($link_selected);
$this_users_total_links = $get_reports ->getNumLinks($user_id);
$this_userslist_of_links = $get_reports ->getAllLinks($user_id);
foreach($widgets_list as $key => $value){
//echo "<br>widget list $key Link ID = ", $widgets_list[$key];
$downline_list = $get_reports ->getDownline($widgets_list[$key]);
if(count($downline_list)>0){
foreach($downline_list as $key2 => $value2){
$this_users_total_links = $get_reports ->getNumLinks($downline_list[$key2]);
//echo '<br>&nbsp;&nbsp;&nbsp; Signed up User # ', $downline_list[$key2]. 'who has entered '. $this_users_total_links . ' links ';

}
}//end if count
}
?>
  <h3><a href="/bungee_jumpers/index.php">Return To Your User Control Panel</a></h3>
			   

</div>
	<div id="ft">
	<div style="text-align: center"><a href="http://BungeeBones.com">HOME</a>  <a href="http://BungeeBones.com/articles">ARTICLES</a>  <a href="http://BungeeBones.com">FAQ </a>	 <a href="http://BungeeBones.com/feedback.php"> CONTACT US </a>  <a href="http://BungeeBones.com/bungee_jumpers/reg_form">REGISTER</a>  <a href="http://BungeeBones.com/bungee_jumpers/login.php">LOGIN</a></div>
                                                                                                                                                                                                                                                                                                                

<div style="text-align: center"><a href="http://BungeeBones.com/bungee_bones">OUR LINK EXCHANGE/DIRECTORY</a> <a href="http://BungeeBones.com/subscription_sites">EXAMPLE SITES</a> </div><a target="_blank" href="http://twitter.com/Bungeebones">BB TWITTER </a>

  
</div>

</div>
</div>

<?
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_bottom1.php");

}//close ifisset B1