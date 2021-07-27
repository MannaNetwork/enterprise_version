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
$sql="select `BB_user_ID` from `links` where `id` = '$link_selected'  ";
$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows >0){
$row = mysqli_fetch_array($result);
$BB_user_ID = $row['BB_user_ID'];
}

if($BB_user_ID != $user_id){
echo 'header(you are not authorized)';
exit();
}
$block = "";
foreach($BB_user_ID_from_users as $key=>$value){

$sql="select * from `links` where `BB_user_ID` = '$value'";
$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);
do{
$id = $row['id'];
$BB_user_ID = $row['BB_user_ID'];
$is_bulk = $row['is_bulk'];
$is_parked = $row['is_parked'];
$category = $row['category'];
$temp = $row['temp'];
$url = $row['url'];
$name = $row['name'];
$description = $row['description'];
$approved = $row['approved'];
$is_a_modified = $row['is_a_modified'];
$street = $row['street'];
$zip = $row['zip'];
$phone = $row['phone'];
$freebie = $row['freebie'];
$multiple = $row['multiple'];
$start_date = $row['start_date'];
$peer_rating = $row['peer_rating'];
$peer_vote_count = $row['peer_vote_count'];
$public_rating = $row['public_rating'];
$public_vote_count = $row['public_vote_count'];
$price_slot_amnt = $row['price_slot_amnt'];
$ps_seniority_date = $row['ps_seniority_date'];
$nofollow = $row['nofollow'];
$counter = $counter++;
$newstart = date('Y-m-d', $start_date);

if($freebie == '1'){
$block .= "<TR><TD width='15'>$newstart</td><td width='50'>$url</td><td width='50'>$name</td><td>$description</td>";
}


}while ($row = mysqli_fetch_array($result));

}
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_topy.php");
echo '<table border="1">'.$block;
echo '</table>';
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/templatebottomnsb.php");
} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
?>
