<?php

class editalink{
function getCategoryName($catid){
if (!defined('READER_AGENTS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_AGENTS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
$query = "SELECT * FROM categories WHERE id='".$catid."'"  ;
echo $query;
$result = @mysqli_query($mysqli, $query) or die("Couldn't execute 'Edit 3 Account' query");
$num_rows = mysqli_num_rows($result);
if($num_rows > 0){
while ($row = mysqli_fetch_array($result)){
$catname = $row['name'];


}
return $catname;
}
}
 function getLinkByLinkId($link_id){

if (!defined('READER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");

if($link_id >0){
//SELECT `id`, `user_id`, `recruiter_lnk_num`, `website_title`, `website_description`, `website_url`, `category_id`, `newcatsuggestion`, `location_id`, `website_street`, `website_district`, `bridge_id`, `user_registration_datetime`, `installer_id` FROM `customer_links` WHERE 1
$query = "SELECT * FROM customer_links WHERE id='$link_id'  ORDER BY `user_registration_datetime` ASC";
echo $query;
$result = @mysqli_query($mysqli, $query) or die("Couldn't execute 'Edit 3 Account' query");
$num_rows = mysqli_num_rows($result);
if($num_rows > 1){
while ($row = mysqli_fetch_array($result)){
$id[] = $row['id'];
$user_id2[] = $row['user_id'];
$recruiter_lnk_num[] = $row['recruiter_lnk_num'];
$website_title[] = $row['website_title'];
$website_description[] = $row['website_description'];
$website_url[] = $row['website_url'];
$category_id[] = $row['category_id'];
$location_id[] = $row['location_id'];
$website_street[] = $row['website_street'];
$bridge_id[] = $row['bridge_id'];
$user_registration_datetime[] = $row['user_registration_datetime'];
$installer_id[] = $row['installer_id'];
}
$num_links_this_user = count($id);
}
elseif($num_rows > 0){

while ($row = mysqli_fetch_array($result)){
$id = $row['id'];
$user_id2 = $row['user_id'];
$recruiter_lnk_num = $row['recruiter_lnk_num'];
$website_title = $row['website_title'];
$website_description = $row['website_description'];
$website_url = $row['website_url'];
$category_id = $row['category_id'];
$location_id = $row['location_id'];
$website_street = $row['website_street'];
$bridge_id = $row['bridge_id'];
$user_registration_datetime = $row['user_registration_datetime'];
$installer_id = $row['installer_id'];

}
$num_links_this_user = 1;
}


$send_array = array($num_links_this_user, $id, $user_id2, $recruiter_lnk_num, $website_title, $website_description, $website_url, $category_id,  $location_id, $website_street,  $bridge_id, $user_registration_datetime, $installer_id);

return $send_array;
}

}
   function editLink($captcha, $recruiter_lnk_num, $website_title, $website_description, $website_url, $category_id,  $location_id, $website_street,  $installer_id, $user_id, $link_status)
    {
//echo '<br>in func';
if (!defined('WRITER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".WRITER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");

     if (strtolower($captcha) != strtolower($_SESSION['captcha'])) {
            $this->errors[] = 'MESSAGE_CAPTCHA_WRONG';
        }  

/*

 $stmt = $this->mysqli->prepare("UPDATE datadump SET content=? WHERE id=?");
        $id = 1;
                               
        $stmt->bind_param('is', $id, $content);
        
        $content = isset($_POST['content']) ? $this->mysqli->real_escape_string($_POST['content']) : '';

       
        $stmt->execute();
        printf("%d Row inserted.\n", $stmt->affected_rows);

*/

if (!($stmt = $mysqli->prepare("UPDATE customer_links SET user_id = ?, recruiter_lnk_num  = ?,  user_registration_datetime = ?, website_title = ?, website_description = ?, website_url = ?, category_id = ?,  location_id = ?, website_street = ?,  installer_id = ?"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
$user_registration_datetime = time();
if (!$stmt->bind_param('iiisssiisi',$user_id, $recruiter_lnk_num, $user_registration_datetime, $website_title, $website_description, $website_url, $category_id, $location_id, $website_street, $installer_id)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}
if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}
$new_links_id = $stmt->insert_id;
$stmt->close();
if($new_links_id > 0){
echo '<h1 style="text-align:center;">Your addition of another website to the Manna Network has been successful. It is now awaiting approval. But in the mean time you can still purchase better placement for it (with the free Demo coin you received) and/or install a FREE Manna Network "Classifieds Section" API on your site and become a member! Your new link ID is '. $new_links_id . "and it (along with other configurations you will need to install the API) are available when you open the \"Get Better Placement\" link</h1>";
    return $new_links_id;
}
}

function getThisLinksRegionalInfo($link_id){
echo '<br>in func dirname( __FILE__, 4 ) = ', dirname( __FILE__, 4 );
echo '<br>'.dirname( __FILE__, 4 ). "/manna-configs/db_cfg/auth_constants.php";
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 4 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 4 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 4 ). "/manna-configs/db_cfg/mysqli_connect.php");
        $query = "SELECT * FROM `regional_sign_ups` WHERE link_id = ".$link_id;
echo $query;
	$query= mysqli_query($mysqli, $query);
if(mysqli_num_rows($query) > 0){
        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $send_array[] = $row ;
        }
	return $send_array;
}
else
{
return "Sorry, No Regional Signup For This Link."; 

}

}

function getRegions($regional_num){
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 4 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 4 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 4 ). "/manna-configs/db_cfg/mysqli_connect.php");
        $query = "SELECT * FROM categories_regional2 WHERE id = '".$regional_num."'";
echo $query;
	$query= mysqli_query($mysqli, $query);
if(mysqli_num_rows($query) > 0){
        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $send_array[] = $row ;
        }
	return $send_array;
}
else
{
return "Sorry, No Regional Entries Found."; 

}
}
}
