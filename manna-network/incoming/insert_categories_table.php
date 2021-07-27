<?php 
//grab the last entry from log and return hash of timestamp
if(!defined('READER_AGENTS')){ 
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/agent_cfg.php");
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/mysqli_connect.php");
$searchString = ',';

//get the last inserted local link

$sql = "SELECT * FROM categories ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
while($row = mysqli_fetch_array($result)){
$this_last_lft = $row['lft'];
}

$cat_hash_lft = rtrim($this_last_lft, "/ \t\n\r");
$conacat = $cat_hash_lft.$exchange_pw;
$cat_hash_key = hash('sha512', $conacat);

if($_POST['cat_hash_key'] == $cat_hash_key){
	$id = explode(",",$_POST['id']);
	$name = explode(",",$_POST['name']); 
	$parent = explode(",",$_POST['parent']);
	$lft = explode(",",$_POST['lft']); 
	$rgt = explode(",",$_POST['rgt']); 
}

if(!defined('WRITER_AGENTS')){ 
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/agent_cfg.php");
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/".WRITER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/mysqli_connect.php");
$query = 'DELETE from categories;';

	$result = mysqli_query($mysqli, $query);
	foreach($id as $key=>$value){

if($parent[$key]==""){
$parent[$key] = NULL;
} 
	$query = "INSERT INTO `categories` (`id`,`name`,`parent`,`lft`,`rgt`) VALUES (    '$id[$key]' ,  '$name[$key]', '$parent[$key]' , '$lft[$key]' , '$rgt[$key]')  "; 

	$result = mysqli_query($mysqli, $query);
	$last_insert_lft =  $lft[$key];
	echo  $last_insert_lft ;

	}

$filename4 = "log/log.txt";
$content = file_get_contents($filename4);
$content .= PHP_EOL . date(DATE_RFC2822) . $last_insert_lft;
file_put_contents($filename4, $content);
 
