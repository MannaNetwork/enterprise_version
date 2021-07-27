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
$test_access_level->access_page($_SERVER['PHP_SELF'], "", 10); // change this value to test differnet access levels (default: 1 = low and 10 high)
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

//include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_top1.php");
 include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4reg.php");

echo'inside where all the b1 code was deleted';


include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");

exit();
}//close ifisset$B1

$C1 = $_GET['C1'];

If(isset($C1)){
echo 'inside where all the C! code was deleted';
								
										
										}//closes if C1
										else// begin form
										{



////////////////////////////////////////////////////

//include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_top1.php");
//  include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4reg.php");
include($_SERVER['DOCUMENT_ROOT']."/articles/include_topy.txt");
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
//get a list of all BB users (each user listed just once)
 $uniqueBB_user_list = $get_reports ->getAllUsers();
foreach( $uniqueBB_user_list as $key => $value){
//get each users links and store the link number in array tied to their link id number
$this_userslist_of_links[$key] = $get_reports ->getAllLinks($uniqueBB_user_list[$key]);
//get the number of links each user has enterd by getting the count of that array
// and id it by using the user id
$count_of_links[$uniqueBB_user_list[$key]]=count($this_userslist_of_links[$key]);
//while here, get a bunch of info about each user to display along with their totals

}
  
 
//echo '<br> $this_userslist_of_links[$key] = <br>';
//print_r($this_userslist_of_link);

//sort the list by users who have added the most links(desc order)
$this_userslist_of_linkssortedadescending = arsort($count_of_links);
//print out report

foreach( $count_of_links as $key => $value){
//set limits to report
if($count_of_links[$key] >3){

$users_info = $get_reports ->getUsersInfo($key);
$id = $users_info[0];		
   $real_name = $users_info[1];	
   $upline_num= $users_info[2];	
   $extra_info = $users_info[3];	
   $email = $users_info[4];
$tab_bod .= '<tr><td class="leftcontent">'.$key.'</td><td>'.$real_name.'</td><td>'.$count_of_links[$key]   .'</td><td class = "centerleftcontent">'.$upline_num.'</td><td class="centerrightcontent"> '.$extra_info.'</td><td class="rightcontent">'.$email.'</td><td><a href="/bungee_jumpers/reports/users_link_list.php?link_submitters_id='.$key.'">View User\'s Links</a></tr>';





}
}
$tab_hd .= '<tr class="toprow"><td class="leftcol"> User ID </td><td> Real Name</td><td class = "centerleftcontent">  # Of Links<br>Entered</td><td class = "centerleftcontent">   Upline Number</td><td class="centerrightcontent">  Extra Info</td><td class="rightcontent">   Email</td><td>View Link Info(s)</td></tr>';

echo '<table id="sample" cellspacing="2">'. $tab_hd .$tab_bod . '</table>';
$new_this_userslist_of_links  = asort($count_of_links);
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
//include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_bottom1.php");
// include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");
include($_SERVER['DOCUMENT_ROOT']."/includesorig/templatebottomnsb.php");
}//close ifisset B1
