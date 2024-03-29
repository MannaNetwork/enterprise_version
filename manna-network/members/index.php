<?php 

if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once('libraries/password_compatibility_library.php');
}
// include the config
require_once('config/config.php');

// include the to-be-used language, english by default. feel free to translate your project and include something else
require_once('translations/en.php');

// include the PHPMailer library
require_once('libraries/PHPMailer.php');

// load the login class

require_once('classes/Login.php');
$login = new Login();
// ... ask if we are logged in here:

if ($login->isUserLoggedIn() == true) {    
 echo '  You are logged in...';
$user_id = $_SESSION['user_id'];
$user_email = $_SESSION['user_email'];

$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 

include(dirname(__DIR__, 2)."/manna-network/members/views/index.php");

} else {
    // the user is not logged in...
    if (array_key_exists('register', $_GET))
    {
   $register =$_GET['register'];
   $agent_ID =$_GET['agent_id'];
    $lnk_num =$_GET['lnk_num'];
    ;
/*echo '<br>    $register =', $register;
 echo '<br>      $agent_ID =',$agent_ID;
 echo '<br>       $lnk_num =',$lnk_num;  */
   
    include("views/register.php");
    }
    else
    {
    include("views/not_logged_in.php");
    }
}
?>
