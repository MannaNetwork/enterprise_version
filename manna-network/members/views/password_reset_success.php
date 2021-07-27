  <?php 
//if Wordpress
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
get_header(); 

//else include your theme header

// the user just came to our page by the URL provided in the password-reset-mail
// and all data is valid, so we show the type-your-new-password form



?>   
<h1 style="color: red;">Your request has been processed. Please check your email.</h1>         

<a href="index.php"><?php echo $phplogin_lang['Back to login']; ?></a>

<?php
// include html footer
//include('../960bottom.php');
get_footer();
?>
