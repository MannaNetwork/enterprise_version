<?php
//grab the last entry from log and return hash of timestamp
if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/agent_cfg.php");
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/exchange_creds.php");
echo '<h1>In get_connection_links - Incoming from admin/broadcast/index.php</h1>';
print_r($_POST);

//those are all the tables that might be updated by central
//we select a column from each from the last row, concatenate the pw to it and hash it. Then compare that to the pw sent by central. If a match, receive that table\'s data and update
//links table get url column

include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/mysqli_connect.php");
$sql = "SELECT `id`, `url` FROM links ORDER BY `id` DESC LIMIT 1";
echo $sql;
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
 while($row = mysqli_fetch_assoc($result)){
$this_last_url = $row['url'];
}
echo '<h3>><><><><><><><><><><><><><><><><><><><><><><><><><><><><</h3>';
echo '<br>In get connection links page on agent3 $link_hash_url = <br> The last $link_hash_url stored on this site is = ', $this_last_url;


$link_hash_url = rtrim($this_last_url, "/ \t\n\r");
$conacat = $link_hash_url.$exchange_pw;
$link_hash_key = hash('sha512', $conacat);


$url="http://manna-network.cash/admin/broadcast/collect_links_update_data.php";
//rehash the hash key uppon return ... admin will rehash the key sent with the orig pw to verify receipt
//$hash_key = hash('sha512', $hash_key.$exchange_pw);
$postData = array(
"sendarrayLinks" => $link_hash_key, 'agent_ID'=>$agent_ID);
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
echo '<h3>><><><><><><><><><><><><><><><><><><><><><><><><><><><><</h3>';



