<?php echo '<br>in delete links tables<br>Got these values in from the collect_links_delete_data.php<br>';
print_r($_POST);
//grab the last entry from log and return hash of timestamp
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/agent_cfg.php");
if(!defined('WRITER_AGENTS')){ 
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/".WRITER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/mysqli_connect.php");
$searchString = ',';

 if( strpos($_POST['id'], $searchString) !== false ) {
     $results_are_arrays = 1;


 }
else
{
$results_are_arrays = 0;
}
echo '<br>$results_are_arrays = ', $results_are_arrays;

//get the last inserted local link
$sql = "SELECT `id`, `url` FROM links ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
 while($row = mysqli_fetch_assoc($result)){
$last_local_url = $row['url'];
$last_local_link_id = $row['id'];
}

if($results_are_arrays == 1) 
{
$id = explode(",",$_POST['id']);
$MN_user_id = explode(",",$_POST['MN_user_id']); 
$category = explode(",",$_POST['category']); 
$url = explode(",",$_POST['url']); 
$name = explode(",",$_POST['name']); 
$description = explode(",",$_POST['description']);
$location_id = explode(",",$_POST['location_id']); 
$website_street = explode(",",$_POST['website_street']); 
$start_date = explode(",",$_POST['start_date']); 
$nofollow = explode(",",$_POST['nofollow']); 
$paid_rank = explode(",",$_POST['paid_rank']);

echo "<br>_POST['link_id_to_be_deleted'] as a string should be ", $_POST['link_id_to_be_deleted'];



$link_id_to_be_deleted = explode(",",$_POST['link_id_to_be_deleted']);
echo '<br>Now $link_id_to_be_deleted should be an array', $link_id_to_be_deleted;

echo '<br>Now print_r($link_id_to_be_deleted) should display an array', print_r($link_id_to_be_deleted);


echo '<br> end url of url array in agents3.com udpte links table ', end($url);
 echo '<br> $last_local_url = ', $last_local_url;

foreach($id as $key=>$value){
echo '<br>key = ', $key;
echo '       value = ', $value;

$query = "DELETE FROM `links` WHERE `id` = $link_id_to_be_deleted[$key]"; 
 echo '<br>query = ', $query;
$result = mysqli_query($mysqli, $query);

echo '<h1>DELETED ID #  ', $link_id_to_be_deleted[$key] ;
echo '</h1>';
}

} 
else
{
$id = $_POST['id'];
$MN_user_id = $_POST['MN_user_id']; 
$category = $_POST['category']; 
$url = $_POST['url']; 
$name = $_POST['name']; 
$description = $_POST['description'];
$location_id = $_POST['location_id']; 
$website_street = $_POST['website_street']; 
$start_date = $_POST['start_date']; 
$nofollow = $_POST['nofollow']; 
$paid_rank = $_POST['paid_rank']; 
$link_id_to_be_deleted = $_POST['link_id_to_be_deleted'];
if($MN_user_id !=""){
$query = "DELETE FROM `links`  WHERE `id` = $link_id_to_be_deleted"; 
 echo '<br>query = ', $query;
$result = mysqli_query($mysqli, $query);
echo '<h1>DELETED ID #  ', $id ;
echo '</h1>';
}
}







$append = " -- Link table updated";
$filename4 = "log/log.txt";
$content = file_get_contents($filename4);
$content .= PHP_EOL . date(DATE_RFC2822) . $append;
file_put_contents($filename4, $content);
echo '<h1>New Links have been broadcast to </h1>';

echo '<H1>Sendng confirmation </h1>';
echo '<p>But don\'t forget the point that IF the link was deleted from somwhere in the middle of the link stack (most probably) then we don\'t have to update the agent_conn_credentials tale (because the last link in the network remained the same after a deletion) ut IF the last link was deleted we need to update that last link url column in each agent\'s row to stay in sync';

echo '<p>We need to detect whether or not to update the agent-conn_credentials now (before sending a curl request to trigger the update) because the ONLY thing the confirm page does is update the agent-conn_credentials table'; 

if($last_local_link_id == $link_id_to_be_deleted)
{
//we get the new "last url" to use to replace the value in agent_cron_credentials
//get the last inserted local link
$sql = "SELECT `id`, `url` FROM links ORDER BY `id` DESC LIMIT 1";
echo $sql;
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
 while($row = mysqli_fetch_assoc($result)){
$last_local_url = $row['url'];
$last_local_link_id = $row['id'];
} 








$url="http://manna-network.cash/admin/broadcast/confirm_links_data.php";
//rehash the hash key uppon return ... admin will rehash the key sent with the orig pw to verify receipt
//$hash_key = hash('sha512', $hash_key.$exchange_pw);
$postData = array(
"last_insert_url" => $last_insert_url,
"agent_ID" => $agent_ID);

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
 //temporarily deactivate this curl to prevent constant deletion of data for testing - reinstate when debugged
$data = curl_exec($handle);
 
curl_close($handle);
 
echo $data;

}
 
 
