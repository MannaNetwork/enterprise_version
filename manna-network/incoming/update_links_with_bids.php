<?php
//grab the last entry from log and return hash of timestamp

//echo '<br><h1>post = ';
//print_r($_POST);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/agent_config.php");
if(!defined('WRITER_AGENTS')){ 
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".WRITER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
$searchString = ',';
 if( strpos($_POST['id'], $searchString) !== false ) {
     $results_are_arrays = 1;
 }
else
{
$results_are_arrays = 0;
}

//get the last inserted local link

$sql = "SELECT * FROM links ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
while($row = mysqli_fetch_array($result)){
$this_last_url = $row['url'];
}

$link_hash_url = rtrim($this_last_url, "/ \t\n\r");
$conacat = $link_hash_url.$exchange_pw;
//echo '<br>in btc conacat = ', $conacat;
$link_hash_key = hash('sha512', $conacat);
//echo '<br>linksstrink1 = ';
//print_r($_POST['linkString']);
//$linkString = json_decode($_POST['linkString']);
$bidString = json_decode($_POST['bidString'], True);
//returns bridge_id	price_slot_amnt	coin_type	start_date	id 	
echo '<br>linksstrink2 = ';
print_r($bidString);
echo '<br>';

//echo '<br>line 40 $link_hash_key = ', $link_hash_key;


if($_POST['link_hash_key'] == $link_hash_key){
	   
	foreach($bidString as $key=>$value){

$query = "update `links` SET `price_slot` = '". $value['price_slot_amnt']."',
`coin_type`  = '". $value['coin_type']."',
`price_slot_prchs_date`  = '". $value['start_date']."' where `id` ='".$value['id']."' AND `bridge_id` ='".$value['bridge_id']."' "; 


echo $query;

$result = mysqli_query($mysqli, $query);
	} 

//echo 'H3>Now we have to update the conn credtials with last url = '.$last_url_inserted.' and last id = '.$last_link_id_inserted;
}
else
{
echo '<h3 style="color:red;">$_POST[link_hash_key] NOT== $link_hash_key){</h3>';

}


