<?php
/**
 * Check PHP prerequisites and load common variables, libraries, classes 
 * and functions necessary for php-login script to work properly.
 */
 
// checking for minimum PHP version
//if (version_compare(PHP_VERSION, '5.3.7', '<')) {
 //   exit('Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !');
//} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
//echo '$_SERVER[DOCUMENT_ROOT] = ', $_SERVER['DOCUMENT_ROOT'];
//$count_folders_gross = explode("/", $_SERVER['DOCUMENT_ROOT']);
//$count_folders = count($count_folders_gross);
//echo 'in 1stbtc/members/php-login.php - dirname( __FILE__, 1 ) = ', dirname( __FILE__, 1 );

require_once(__DIR__."/libraries/password_compatibility_library.php");

require_once(dirname( __FILE__, 3 ) . "/manna-configs/db_cfg/auth_constants.php");
require_once(dirname( __FILE__, 3 )."/manna-configs/db_cfg/agent_config.php");
require_once(dirname( __FILE__, 1 )."/config/config.php");
//include(__DIR__) . "../../config/config.php";
// include the to-be-used language, english by default. feel free to translate your project and include something else
require_once(dirname( __FILE__, 1 )."/translations/en.php");

// include the PHPMailer library
require_once(dirname( __FILE__, 1 )."/libraries/PHPMailer.php");

// load the registration class
require_once(dirname( __FILE__, 1 )."/classes/Login.php");
require_once(dirname( __FILE__, 1 )."/classes/AddURL.php");
require_once(dirname( __FILE__, 1 )."/css/members_menu.css");
//echo '<br>in phplogin.php';
