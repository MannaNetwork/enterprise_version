<?php echo '<br>in update links tables';

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

echo '<br> end url of url array in agents3.com udpte links table ', end($url);
 echo '<br> $last_local_url = ', $last_local_url;

foreach($id as $key=>$value){
echo '<br>key = ', $key;
echo '       value = ', $value;

$query = "INSERT INTO `links` (`MN_user_id`,`url`,`name`,`description`,`start_date`,`nofollow`,`location_id`,`category`,`website_street`) VALUES (    '$MN_user_id[$key]' ,  '$url[$key]', '$name[$key]', '$description[$key]' , '$start_date[$key]' , '$nofollow[$key]','$location_id[$key]',  '$category[$key]', '$website_street[$key]')  "; 
 echo '<br>query = ', $query;
$result = mysqli_query($mysqli, $query);
$last_insert_url =  $url[$key];
echo '<h1>$last_insert_url =  ', $last_insert_url ;
echo '</h1>';
echo '<h1>$last_insert_id =  ' ;
printf ("New Record has id %d.\n", mysqli_insert_id($mysqli));
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
if($MN_user_id !=""){
$query = "INSERT INTO `links` (`MN_user_id`,`url`,`name`,`description`,`start_date`,`nofollow`,`location_id`,`category`,`website_street`,`website_district`) VALUES ( '$MN_user_id' , '$category' ,'$url' , '$name' , '$description' , '$location_id' ,  '$website_street' , '$start_date' ,  '$nofollow' )  "; 
 echo '<br>query = ', $query;
$result = mysqli_query($mysqli, $query);
$last_insert_url =  $url[$key];
echo '<h1>$last_insert_url =  ', $last_insert_url ;
echo '</h1>';
echo '<h1>$last_insert_id =  ' ;
printf ("New Record has id %d.\n", mysqli_insert_id($mysqli));
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

$url="http://manna-network.cash/admin/broadcast/confirm_links_data.php";
//rehash the hash key uppon return ... admin will rehash the key sent with the orig pw to verify receipt
//$hash_key = hash('sha512', $hash_key.$exchange_pw);
$postData = array(
"last_insert_url" => $last_insert_url,
"agent_ID" => $agent_ID,
"original_post_ids" => $_POST['id']);

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


 
 
