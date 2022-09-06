<?php
session_start();
print_r($_SESSION);
if ((isset($_SESSION["user"])) && (isset($_SESSION["logged_in"]))) {        
    echo ('You shall pass:'.$_SESSION["user"]);        
    //stuff.php logic can start
} else {        
    header('HTTP/1.0 401 Unauthorized');
    exit;        
} 


?>
