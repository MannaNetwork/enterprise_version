<?php
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {

$count_folders_gross = explode("/", $_SERVER['DOCUMENT_ROOT']);
$count_folders = count($count_folders_gross);
require_once($_SERVER['DOCUMENT_ROOT']."/members/libraries/password_compatibility_library.php");
require_once($_SERVER['DOCUMENT_ROOT']."/members/config/config.php");
require_once($_SERVER['DOCUMENT_ROOT']."/members/libraries/PHPMailer.php");
}
$user_lang = 'en';
define('PHPLOGIN_LANG', $user_lang);

include($_SERVER['DOCUMENT_ROOT'].'/members/lang/' . PHPLOGIN_LANG . '.php');

require_once($_SERVER['DOCUMENT_ROOT']."/members/classes/Login.php");
require_once($_SERVER['DOCUMENT_ROOT']."/members/classes/WP_Registration.php");

