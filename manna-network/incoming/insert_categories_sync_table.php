<?php
//grab the last entry from log and return hash of timestamp

include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/agent_config.php");
if(!defined('WRITER_AGENTS')){ 
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".WRITER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
$sent_array = $_POST;
$cat_list = $sent_array['catString'];
$cat_list_decoded = json_decode($cat_list, TRUE);
$cat_hash_key_from_MN = $cat_list_decoded['cat_hash_key'];

$sql = "SELECT * FROM categories ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
while($row = mysqli_fetch_array($result)){
$this_last_id = $row['id'];
}

$cat_hash_id = rtrim($this_last_id, "/ \t\n\r");
$conacat = $cat_hash_id.$exchange_pw;
//echo '<br>in ORG conacat = ', $conacat;
$cat_hash_key = hash('sha512', $conacat);

if($cat_hash_key_from_MN == $cat_hash_key){
$count = count($cat_list_decoded[0]);
	for($key=0;$key<=$count;$key++){
$id = $cat_list_decoded[0][$key]; 
$name = $cat_list_decoded[1][$key];
 $parent = $cat_list_decoded[2][$key];
 $lft = $cat_list_decoded[3][$key];
 $rgt = $cat_list_decoded[4][$key];
 $link_count = $cat_list_decoded[5][$key];
if(empty($link_count)){
$link_count=0;
}
if(!empty($id)){
$query = "INSERT INTO `categories` (`id`,`name`,`parent`,`lft`,`rgt`,`link_count`) VALUES ('$id', '$name', '$parent', '$lft', '$rgt', '$link_count')"; 

$last_category_id_inserted = $id;
$last_category_name_inserted = $name;
$result = mysqli_query($mysqli, $query);
	} 
	}
	$sql = "SELECT * FROM categories ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
while($row = mysqli_fetch_array($result)){
$last_category_id_inserted_by_mysqli = $row['id'];
} 
if($last_category_id_inserted_by_mysqli == $last_category_id_inserted){
echo $last_category_id_inserted_by_mysqli;
}
else
{
echo '<h3 style="color:red;">Mysql last insert id not equal to php last insert id</h3>';
}
}
else
{
echo '<h3 style="color:red;">$_POST[cat_hash_key] NOT== $cat_hash_key){</h3>';
}
?>
