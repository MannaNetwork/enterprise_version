<?php 
if (isset($_GET['action']) && $_GET['action'] == "log_out") {
session_start();
session_destroy();
}
// include the configs
require_once($_SERVER['DOCUMENT_ROOT']."/members/config/config.php");

// load php-login components
require_once($_SERVER['DOCUMENT_ROOT']."/members/php-login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();
    
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...

$user_id = $_SESSION['user_id'];

//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 

$link_selected =$_GET['link_selected'];

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2accusersconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
//get all the users that registered at this wigdget. They will have their wdgts_lnk_num the same as this link's id
$sql="select `user_id` from `users` where `wdgts_lnk_num` = '$link_selected'";

echo $sql;
$result = @mysqli_query($connect, $sql);
while($row = @mysqli_fetch_array($result)){
$BB_user_ID_from_users[] = $row['user_id'];
}


include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_topy.php");
echo '<table>'.$block;
echo '</table>';
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/templatebottomnsb.php");

} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
