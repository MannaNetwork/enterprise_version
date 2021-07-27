<?php
/*
** File    : gen_script.php
** Version : 0.1 of 2020-07-17
** Author  : pierre FAUQUE, pierre@fauque.net
** Role    : Generates the necessary javascript to check the form describe in the ini file below
*/

// Indicate the name of the form to be checked
// and described in the formname.ini
$formname = "subscription"; // subscription.ini must exists

// Don't modify below....
require("class.js.php");
$script = new js("$formname");
?>