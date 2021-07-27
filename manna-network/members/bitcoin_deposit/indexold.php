<?
if (isset($_GET['action']) && $_GET['action'] == "log_out") {
//$test_page_protect->log_out(); // the method to log off
session_start();
session_destroy();
}
// include the configs
require_once("../config/config.php");
// load the login class
// load php-login components
require_once("../php-login.php");
// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...
$user_id = $_SESSION['user_id'];
$moniker="<h5>Home</h5>";
$body_width="wide";
include('../../960top.php');
$engross = "146aa8fc";
$test_user_id = 18;
$file="https://".$engross.".ngrok.com/save_rpc_calls.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
curl_setopt($ch, CURLOPT_POSTFIELDS, array('user_id' => $test_user_id  ));
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
echo($data);
////////////////////////////////////////////////////				
	
include('../../960bottom.php');

} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}
?>
