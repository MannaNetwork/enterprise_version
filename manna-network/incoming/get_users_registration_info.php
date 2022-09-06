<?php
require_once(dirname( __FILE__, 4 )."/manna_network/manna-network/members/classes/member_page_class.php");
$object = new member_page_info();
//we need the row info for this user's selected region (use it to build the last form after iterating)
echo '<br>in agent site, send POST user_id to member page class - POST = ';
print_r($_POST);
$users_info_array = $object->getUsersRegistrationInfo($_POST['user_id']);

echo $users_info_array;

