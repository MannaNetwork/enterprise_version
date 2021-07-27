<?php 

if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
require_once('../libraries/password_compatibility_library.php');
}
require_once('../config/config.php');
require_once('../lang/en.php');
require_once('../libraries/PHPMailer.php');
require_once('../classes/Login.php');
$login = new Login();
if ($login->isUserLoggedIn() == true) {    
$user_id = $_SESSION['user_id'];

include($_SERVER['DOCUMENT_ROOT']."/960top.php");
$link_id = $_POST['link_id']  ;


$phpself = basename(__FILE__);
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;


include($_SERVER['DOCUMENT_ROOT']."/members/reg_form/classes/edit_link_class.php");  
print_r($_POST);
//post vars [link_id] => 7250 [continent] => 2568 [country] => 2732 [state] => Select State [city] => Select City ) 
$link_id = $_POST['link_id'];

$continent = $_POST['continent'];// => 2568 
$country = $_POST['country'];// => 2732 
$state = $_POST['state'];// => Select State 
$city = $_POST['city'];// => Select City )

$edit = new edit();
$edit->updateRegionalSEOEnhance($link_id, $continent, $country, $state, $city);
include($_SERVER['DOCUMENT_ROOT']."/960bottom.php");

} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}
?>
