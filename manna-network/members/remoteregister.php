<?php

/**
 * A simple, clean and secure PHP Login Script
 *
 * ADVANCED VERSION
 * (check the website / GitHub / facebook for other versions)
 *
 * A simple PHP Login Script.
 * Uses PHP SESSIONS, modern password-hashing and salting
 * and gives the basic functions a proper login system needs.
 *
 * @package php-login
 * @author Panique
 * @link https://github.com/panique/php-login/
 * @license http://opensource.org/licenses/MIT MIT License
 */

// load php-login components

require_once("php-login.php");

// create the registration object. when this object is created, it will do all registration stuff automatically
// so this single line handles the entire registration process.
$wdgts_lnk_num = "";
$registration = new Registration($wdgts_lnk_num);

// showing the register view (with the registration form, and messages/errors)
?>
<img width="100%"src="/members/images/bb_logo_remote.png">
<?php
include("views/remoteregister.php");
