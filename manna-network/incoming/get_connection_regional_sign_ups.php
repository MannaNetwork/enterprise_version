<?php
//grab the last entry from log and return hash of timestamp
if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/agent_cfg.php");
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/exchange_creds.php");
echo '<h1>Incoming from open_conn.php</h1>';
print_r($_POST);

$tables_array = array("links", "categories", "categories_regional2", "balance", "price_slots_subscripts", "regional_sign_ups");
//those are all the tables that might be updated by central
//we select a column from each from the last row, concatenate the pw to it and hash it. Then compare that to the pw sent by central. If a match, receive that table\'s data and update
//links table get url column
//"categories  table get lft column
//"categories_regional2  table get lft column
//"balance   table get t_timestamp column 
//"price_slots_subscripts    table get t_timestamp column 
//"regional_sign_ups    table get id column 
//$exchange_pw = "j3h5&3ja;x.(+2kjshfh2FFGscav//cnputydsvs6498ndmcxvljgehsnsmi";


include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/mysqli_connect.php");
$sql = "SELECT `id`, `url` FROM links ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
 while($row = mysqli_fetch_assoc($result)){
$url = $row['url'];
}
$link_hash_url = rtrim($url, "/ \t\n\r");
$conacat = $link_hash_url.$exchange_pw;
$link_hash_key = hash('sha512', $conacat);
//////////////////////////////////////////////////////////////////
$sql = "SELECT `lft` FROM categories ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
 while($row = mysqli_fetch_assoc($result)){
$lft = $row['lft'];
}
//| 3379 
$cat_hash_lft = rtrim($lft, "/ \t\n\r");
$conacat = $cat_hash_lft.$exchange_pw;
$cat_hash_key = hash('sha512', $conacat);
//////////////////////////////////////////////////////////////////////
$sql = "SELECT `lft` FROM categories_regional2 ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
 while($row = mysqli_fetch_assoc($result)){
$lft2 = $row['lft'];
}
//16623
$catreg2_hash_lft = rtrim($lft2, "/ \t\n\r");
$conacat2 = $catreg2_hash_lft.$exchange_pw;
$catreg2_hash_key = hash('sha512', $conacat2);
//////////////////////////////////////////////////////////////////////////
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/mysqli_connect.php");
$sql = "SELECT `t_timestamp` FROM balance ORDER BY `id` DESC LIMIT 1";
//change ythis to select where agent_id = $agent_ID because local agent only needs balances of their downline
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
 while($row = mysqli_fetch_assoc($result)){
$t_timestamp = $row['t_timestamp'];
}
//2015-08-10 08:12:04
$balance_hash_url = rtrim($t_timestamp, "/ \t\n\r");
$conacat = $balance_hash_url.$exchange_pw;
$balance_hash_key = hash('sha512', $conacat);
//////////////////////////////////////////////////////////////////
$sql = "SELECT `t_timestamp` FROM price_slots_subscripts ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
 while($row = mysqli_fetch_assoc($result)){
$t_timestamp = $row['t_timestamp'];
}
//2018-09-21 01:36:22
$price_slots_subscripts_hash_url = rtrim($t_timestamp, "/ \t\n\r");
$conacat = $price_slots_subscripts_hash_url.$exchange_pw;
$price_slots_subscripts_hash_key = hash('sha512', $conacat);
//////////////////////////////////////////////////////////////////
$sql = "SELECT `id` FROM regional_sign_ups ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
 while($row = mysqli_fetch_assoc($result)){
$id = $row['id'];
}
//4538
$regional_sign_ups_hash_url = rtrim($id, "/ \t\n\r");
$conacat = $regional_sign_ups_hash_url.$exchange_pw;
$regional_sign_ups_hash_key = hash('sha512', $conacat);




$url="http://manna-network.cash/admin/broadcast/collect_links_data.php";
//rehash the hash key uppon return ... admin will rehash the key sent with the orig pw to verify receipt
//$hash_key = hash('sha512', $hash_key.$exchange_pw);
$postData = array(
"sendarrayLinks" => $link_hash_key,
"sendarrayCategories" => $cat_hash_key,
"sendarrayRegionalCategories2" => $catreg2_hash_key,
"sendarrayCustomerBalance"  => $balance_hash_key,
"sendarraypriceSlotsSubscripts" => $price_slots_subscripts_hash_key,
"sendarrayRegionalSignUps"  => $regional_sign_ups_hash_key, 
'agent_ID'=>$agent_ID);

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




