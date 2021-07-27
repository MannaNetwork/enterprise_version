<?php


// load php-login components
// load php-login components 


require_once("wp_php-login.php");

// create the registration object. when this object is created, it will do all registration stuff automatically
// so this single line handles the entire registration process.
//$registration = new Registration($wdgts_lnk_num);
$registration = new Registration();
// showing the register view (with the registration form, and messages/errors)
?>


<?php
include("views/wp_register.php");
?>
</div><!-- this div closes the one started in the "gray div" started at each message on en.php
