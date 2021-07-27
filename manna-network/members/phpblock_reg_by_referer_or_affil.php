<?php

/**
 THIS wp_register.php is only to handle the "Add URL" link on each multisite blog.

The new users don't come in with affiliate numbers but rather, the refering blog id number.

That blog's link number/affiliate number can be gleaned from one query to the wp_user_data table

 */


// load php-login components

require_once("php-login_phpblock.php");

// create the registration object. when this object is created, it will do all registration stuff automatically
// so this single line handles the entire registration process.
//$wdgts_lnk_num = "";
//$registration = new Registration($wdgts_lnk_num);
$registration = new Registration();

// showing the register view (with the registration form, and messages/errors)

include("views/phpblock_reg_by_referer_or_affil.php");

