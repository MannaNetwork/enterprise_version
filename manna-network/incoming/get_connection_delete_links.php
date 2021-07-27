<?php
//grab the last entry from log and return hash of timestamp
if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/agent_cfg.php");
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/exchange_creds.php");
//those are all the tables that might be updated by central
//we select a column from each from the last row, concatenate the pw to it and hash it. Then compare that to the pw sent by central. If a match, receive that table\'s data and update
//links table get url column

include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/mysqli_connect.php");
$sql = "SELECT  `url` FROM links ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
 while($row = mysqli_fetch_assoc($result)){
$this_last_url = $row['url'];
}

echo '<br>In get DELETE connection links page<br> The last $link_hash_url stored on this site is = ', $this_last_url;


$link_hash_url = rtrim($this_last_url, "/ \t\n\r");
$conacat = $link_hash_url.$exchange_pw;
$link_hash_key = hash('sha512', $conacat);
//because 
if (array_key_exists('link_hash_key', $_POST) AND array_key_exists('linkString', $_POST) AND $_POST['link_hash_key']== $link_hash_key){ 
echo '<h1>Deleting !</h1>';
print_r($_POST['linkString']);
$delete_link_list = explode(",", $_POST['linkString']);

include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/".WRITER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/mysqli_connect.php");

	foreach($delete_link_list as $key => $value){
	$sql2 = 'DELETE FROM `links` where `id` = '.$value; 
	$result = mysqli_query($mysqli, $sql2);
	}
$sql = "SELECT  `url` FROM links ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
 while($row = mysqli_fetch_assoc($result)){
$new_last_url = $row['url'];
}
echo '<h1>We need to return the new $this_last_url to central because this one was just deleted!<br>Line 46 of get connections delete links .php  '.$new_last_url.'</h1>'; 
	
	$url="http://manna-network.cash/admin/broadcast/agent_link_sync.php";
$postData = array(
"sendarrayLinks" => $link_hash_key, 'agent_ID'=>$agent_ID, 'new_last_url'=> $new_last_url);
	
//rehash the hash key uppon return ... admin will rehash the key sent with the orig pw to verify receipt
//$hash_key = hash('sha512', $hash_key.$exchange_pw);

$handle = curl_init();

 
curl_setopt_array($handle,
  array(
     CURLOPT_URL => $url,
     // Enable the post response.
    CURLOPT_POST       => true,
    // The data to transfer with the response.
    CURLOPT_POSTFIELDS => $postData,
    CURLOPT_RETURNTRANSFER     => true,
  )
);
 
$data = curl_exec($handle);
 
curl_close($handle);
 
echo $data;


}
else //this is the first run, the "handshake"
{
	if (array_key_exists('callback', $_POST)){
	$url="http://manna-network.cash/admin/broadcast/agent_link_sync.php";
$postData = array(
"sendarrayLinks" => $link_hash_key, 'agent_ID'=>$agent_ID);
	}
	else 
	{
$url="http://manna-network.cash/admin/broadcast/collect_links_delete_data.php";
$postData = array(
"sendarrayLinks" => $link_hash_key, 'agent_ID'=>$agent_ID);
}
//rehash the hash key uppon return ... admin will rehash the key sent with the orig pw to verify receipt
//$hash_key = hash('sha512', $hash_key.$exchange_pw);

$handle = curl_init();

 
curl_setopt_array($handle,
  array(
     CURLOPT_URL => $url,
     // Enable the post response.
    CURLOPT_POST       => true,
    // The data to transfer with the response.
    CURLOPT_POSTFIELDS => $postData,
    CURLOPT_RETURNTRANSFER     => true,
  )
);
 
$data = curl_exec($handle);
 
curl_close($handle);
 
echo $data;
}




