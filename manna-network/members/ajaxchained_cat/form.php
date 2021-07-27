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


$phpself = basename(__FILE__);
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;

include($_SERVER['DOCUMENT_ROOT']."/960top.php");
include($_SERVER['DOCUMENT_ROOT']."/members/user_cpanel_submenu.php");  
include($_SERVER['DOCUMENT_ROOT']."/members/reg_form/classes/edit_link_class.php");  


$edit = new edit();

echo $edit->updateCategorySelection($_POST);

include($_SERVER['DOCUMENT_ROOT']."/960bottom.php");

} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}
?>
