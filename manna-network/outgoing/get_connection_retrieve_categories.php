<?php
//grab the last entry from log and return hash of timestamp
if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/agent_cfg.php");
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/exchange_creds.php");

include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/mysqli_connect.php");
$pw_hash_key = hash('sha512', $exchange_pw);
if($_POST['pw_hash_key'] == $pw_hash_key){
$sql = "SELECT * FROM categories ORDER BY `id`";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
while($row = mysqli_fetch_array($result)){
$id[] = $row['id'];
$name[] = $row['name'];
$parent[] = $row['parent'];
$lft[] = $row['lft'];
$rgt[] = $row['rgt'];
}


echo implode(",", $id);
echo "|";
echo implode(",", $name);
}
