<?php

$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 

if (isset($_GET['action']) && $_GET['action'] == "log_out") {
	//$test_page_protect->log_out(); // the method to log off
echo '<h1>in Logout - Session Destroy</h1>';
session_start();
session_destroy();
}
// include the configs
require_once($_SERVER['DOCUMENT_ROOT']."/members/config/config.php");

    
// load the login class

// load php-login components
require_once($_SERVER['DOCUMENT_ROOT']."/members/php-login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

 
    
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...


$user_id = $_SESSION['user_id'];

$link_selected =$_GET['link_selected'];

include($_SERVER['DOCUMENT_ROOT']."/classes/link_class.php");

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2accusersconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `user_id` from `users` where `wdgts_lnk_num` = '$link_selected'";
$result = @mysqli_query($connect, $sql);
while($row = @mysqli_fetch_array($result)){
$BB_user_ID_from_users[] = $row['user_id'];
}
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `BB_user_ID` from `links` where `id` = '$link_selected'";
$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows >0){
$row = mysqli_fetch_array($result);
$BB_user_ID = $row['BB_user_ID'];
}
date_default_timezone_set('America/New_York');
if($BB_user_ID != $user_id){
echo 'header(you are not authorized)';
exit();
}
$link_info = new link_info;
$block = "";
$this_links_recruited_users = $link_info->getUserIDByLinkId($link_selected);
$counterp="0";
//then, for each user id use this function getLinkByUserId($user_id) -- should bring back an array of all their links count
foreach($this_links_recruited_users as $key=>$value){
$this_links_recruited_users_freelinks = $link_info->getLinkByUserIdFree($value);
//returns array($num_links_this_user, $db_idf, $db_categoryf, $db_urlf, $db_descriptionf, $db_namef, $db_start_datef, $db_approvedf);

$num_links_this_user = $this_links_recruited_users_freelinks[0];
$db_idf = $this_links_recruited_users_freelinks[1]; 
$db_categoryf = $this_links_recruited_users_freelinks[2];
$db_urlf = $this_links_recruited_users_freelinks[3]; 
$db_descriptionf = $this_links_recruited_users_freelinks[4];
$db_namef = $this_links_recruited_users_freelinks[5];
$db_start_datef = $this_links_recruited_users_freelinks[6];
$db_approvedf = $this_links_recruited_users_freelinks[7];
if($db_idf[$key]>0){
foreach($db_idf as $key2=>$value2){
//if($num_links_this_user > 0 ){
$counterf = $counterf++;
$newstart = date('Y-m-d', $db_start_datef[$key2]);
if($db_idf[$key2]>0){
	$block .= "<tr><td width = '100%'><table width='100%' border = '1'><TR><TD width='30'>$db_idf[$key2]</td><TD width='30'>$newstart</td><td width='50'>$db_namef[$key2]</td></tr>
	<tr><td>$counterp</td><td colspan = '2'><a target=";

$block .= '"_blank" href="';
$block .= $db_urlf[$key2];
$block .= '">';
$block .= $db_namef[$key2];
$block .= "</a></td></tr>	<tr><td colspan = '3' >$db_descriptionf[$key2]</td></tr></table></td></tr>";
//}
}
}
}
}

include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_topy.php");
if(count($db_idf)>0){
echo '<table width="100%"><tr><td colspan=3><h1>The Following Free Links Have Registered From Your Site And Are One Step From Earning You Commissions</h1></td></tr>';

echo $block;
echo '</table>';
}
else
{
echo '<table width="100%"><tr><td colspan=3><h1>Sorry, You Have No Free Links Registered</h1></td></tr>'.$block3;
echo '</table>';
}


include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/templatebottomnsb.php");
} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
?>
