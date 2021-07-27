<?
//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 
$default_price = "0.00";//this is what charge is applied to any not having a price set in the database
$default_adj = "1";
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

$link_selected =$_GET['link_selected'];
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2accusersconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `user_id` FROM `links` where `BB_user_ID` = '$user_id'";
echo $sql;
$result = @mysqli_query($connect, $sql);

while($row = mysqli_fetch_array($result)){
$id[] = $row['user_id'];
}
echo 'this user has ', count($id);
echo ' links';

foreach ($id as $key=> $value){
$sql = "select * from `users` where `wdgts_lnk_num` = '$value'";
$result = @mysqli_query($connect, $sql);

while($row = mysqli_fetch_array($result)){
$id2[] = $row['user_id'];
}

echo 'User id = ', $value;
echo 'brought in ', count($id2);
}
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");
?>
<h2>Widget Installation & Registration Form</h2>
<?



} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
