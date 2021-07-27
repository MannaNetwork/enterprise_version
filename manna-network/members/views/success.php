<?php 
$root = dirname(dirname(dirname(dirname( __FILE__, 2 ))));
echo $root;
if (file_exists($root.'/wp-load.php')) {
// WP 2.6
require_once($root.'/wp-load.php');
} else {
// Before 2.6
require_once($root.'/wp-config.php');
}
require_once(dirname( __FILE__, 2 )."/translations/en.js");
require_once(dirname( __FILE__, 2 )."/css/styles.css");
include('styles.css');
include(dirname( __FILE__, 2 ).'/css/members_menu.css');


get_header();
include('views/_menu.php');

echo '<h1> Thank you! <br>Your order was processed successfully.</h1>';
echo '<ul class="navmenu"><li><a href="/members/index.php">RETURN To Control Panel</a></li></ul>';
get_footer();
?>

