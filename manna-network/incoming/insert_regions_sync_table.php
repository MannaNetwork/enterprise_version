<?php
//grab the last entry from log and return hash of timestamp

include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/agent_config.php");
if(!defined('WRITER_AGENTS')){ 
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".WRITER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
$sent_array = $_POST;
$regions_list = $sent_array['regionString'];
$regions_list_decoded = json_decode($regions_list, TRUE);
$regions_hash_key_from_MN = $regions_list_decoded['region_hash_key'];
$sql = "SELECT * FROM categories_regional2 ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
while($row = mysqli_fetch_array($result)){
$this_last_id = $row['id'];
}

$regions_hash_id = rtrim($this_last_id, "/ \t\n\r");
$conacat = $regions_hash_id.$exchange_pw;
$regions_hash_key = hash('sha512', $conacat);
if($regions_hash_key_from_MN == $regions_hash_key){
$count = count($regions_list_decoded[0]);
	for($key=0;$key<=$count;$key++){
$id = $regions_list_decoded[0][$key]; 
$name = $regions_list_decoded[1][$key];
 $parent = $regions_list_decoded[2][$key];
 $lft = $regions_list_decoded[3][$key];
 $rgt = $regions_list_decoded[4][$key];
 
if(!empty($id)){
$query = "INSERT INTO `categories_regional2` (`id`,`name`,`parent`,`lft`,`rgt`) VALUES ('$id', '$name', '$parent', '$lft', '$rgt')"; 

$last_region_id_inserted = $id;

$result = mysqli_query($mysqli, $query);
	} 
	}
	$sql = "SELECT * FROM categories_regional2 ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
while($row = mysqli_fetch_array($result)){
$last_region_id_inserted_by_mysqli = $row['id'];
} 
if($last_region_id_inserted_by_mysqli == $last_region_id_inserted){
echo $last_region_id_inserted_by_mysqli;
}
else
{
echo '<h3 style="color:red;">Mysql last insert id not equal to php last insert id</h3>';
}
}
else
{
echo '<h3 style="color:red;">$regions_hash_key_from_MN NOT== $regions_hash_key){</h3>';
}
?>
