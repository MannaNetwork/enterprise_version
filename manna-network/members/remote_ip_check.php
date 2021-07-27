<?php

/**
 * A central IP banner
 *
 * ADVANCED VERSION
 * (check the website /Bungeebones/ database if current WP registrant attempt has been banned at BB
 *
 */
$attempters_ip = $_POST['attempters_ip'];

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql = "SELECT `full_ip` from `banned_ips` where `full_ip` = '$attempters_ip'";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit line 128 Account' query");
$row_cnt = mysqli_num_rows($result);
if($row_cnt > 0){
echo $row_cnt;
}


