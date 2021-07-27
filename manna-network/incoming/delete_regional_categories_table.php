<?php echo 'in update regional categories tables bbbbb';
print_r($_POST);
var_dump($_POST);

//grab the last entry from log and return hash of timestamp
if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/mysqli_connect.php");


foreach($_POST as $key=>$value){
$filename4 = "log/log.txt";
$content = file_get_contents($filename4);
$content .= PHP_EOL . date(DATE_RFC2822) . $value;
file_put_contents($filename4, $content);
}

