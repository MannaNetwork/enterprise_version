<?php class edit
{
function widgetHasRecruits($website_id){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$website_id = mysqli_real_escape_string($connect, $website_id);

$sql = "select * from `widgets` where `link_id` = '$website_id'";
$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Get link info' query");
$row_cnt = mysqli_num_rows($result);
if($row_cnt > 0){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2accusersconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql = "select * from `users` where `wdgts_lnk_num` = '$website_id'";
$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Get wdgt info' query");
$row_cnt2 = mysqli_num_rows($result);
	if($row_cnt2 > 0){
	$has_recruits = "has_recruits";
	}
	else
	{
	$has_recruits = "no_recruits";
	}
}
else
{
$has_recruits = "no_recruits";
}
return $has_recruits;
}


function updateCategorySelection($post_array){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
//$link_id = mysqli_real_escape_string($connect, $link_id);

foreach($post_array as $key=>$value){
// find the lowestlevel with a selected category
	if($key == "link_id"){
	$link_id = htmlspecialchars($value );
        $link_id = mysqli_real_escape_string($connect, $link_id);
	}
	else
	{
		if(is_numeric($value)){
		$new_category = htmlspecialchars($value );
                 $new_category = mysqli_real_escape_string($connect, $new_category);
		}
	}
}

$sql = "UPDATE `links` SET `category` = ". $new_category." WHERE `id` = ".$link_id;

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit Update Account' query");

$affected_rows = mysqli_affected_rows($connect);
if($affected_rows > 0){
return "<h1>Update successful</h1>";
}
elseif($affected_rows == 0){
return "<h1>No changes were made (you selected the same category it was already in)</h1>";
}
else
{
return "<h1>There was an error making your changes. Please contact the administrator for assistance</h1>";
}
}

function updateRegionalSEOEnhance($link_id, $continent, $country, $state, $city){
//INSERT INTO `regional_sign_ups`(`id`, `continent`, `country`, `state`, `district1`, `city`, `district2`, `link_id`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8])
// [link_id] => 7250 [continent] => 2568 [country] => 2732 [state] => Select State [city] => Select City ) 
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$link_id = htmlspecialchars($link_id);
$continent = htmlspecialchars($continent);
$country = htmlspecialchars($country);
$state = htmlspecialchars($state);
$city = htmlspecialchars($city);

$link_id = mysqli_real_escape_string($connect, $link_id);
echo '<br>link id = ', $link_id;

$continent = mysqli_real_escape_string($connect, $continent);
echo '<br>continent = ', $continent;
if(is_numeric($continent)){
$update_stack = "`continent` = ".$continent;
$insert_stack_a = "`continent`";
$insert_stack_b = '"'.$continent.'"';
}
$country = mysqli_real_escape_string($connect, $country);
echo '<br>country = ', $country;
if(is_numeric($country)){
$update_stack .=  ", `country` = ". $country;
$insert_stack_a .= ", `country`";
$insert_stack_b .= ', "'.$country.'"';
}
$state = mysqli_real_escape_string($connect, $state);
echo '<br>state = ', $state;
if(is_numeric($state)){
$update_stack .= ", `state` = ". $state;
$insert_stack_a .= ", `state`";
$insert_stack_b .= ', "'.$state.'"';
}
$city = mysqli_real_escape_string($connect, $city);
echo '<br>city = ', $city;
if(is_numeric($city)){
$update_stack .= ", `city` = ". $city;
$insert_stack_a .= ", `city`";
$insert_stack_b .= ', "'.$city.'"';
}
$update_stack = "UPDATE `regional_sign_ups` SET ". $update_stack;
$update_stack .= " WHERE `link_id` = ".$link_id;
$insert_stack = "INSERT INTO `regional_sign_ups`(".$insert_stack_a.",`link_id`)values(".$insert_stack_b.", '".$link_id."')";

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql = 'SELECT * from `regional_sign_ups` WHERE `link_id` = '.$link_id;
echo 'members/reg-form/edit_link class line 121', $sql;
$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 3 Account' query");
$row_cnt = mysqli_num_rows($result);
	if($row_cnt > 0){
	echo 'update stack - ',$update_stack;
	$result = @mysqli_query($connect, $update_stack) or die("Couldn't execute 'Edit 3 Account' query");
	}
	else
	{
	echo 'insert stack - ',$insert_stack;
	$result = @mysqli_query($connect, $insert_stack) or die("Couldn't execute 'Edit 3 Account' query");
	}
}

function suspend_deleteLinkInfo($link_id, $status){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$link_id = htmlspecialchars($link_id);
$status = htmlspecialchars($status);
$link_id = mysqli_real_escape_string($connect, $link_id);
$status = mysqli_real_escape_string($connect, $status);
unset($affected_rows);
if($status == "suspend"){
$sql = 'UPDATE `links` set `approved`="deactivated_by_user" where `id`= '.$link_id;
$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit suspend Account' query");
$affected_rows = mysqli_affected_rows($connect);
	if($affected_rows < 0){
	echo '<h1  style = "text-align:left;">Your link information remained unchanged. If that is not what you expected please try again</h1>';
	}
	elseif(isset($affected_rows) AND $affected_rows >= 0){
	echo '<h1  style = "text-align:left;">Your link has been suspended. If that is not what you expected you can redo the process. Your link has NOT been removed and can be returned to "active" status if/when you wish. </h1>';
	}
}
else
{
$sql = 'DELETE `links` set `approved`="deactivated_by_user" where `id`='.$link_id;
$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 3 delete Account' query");
$affected_rows = mysqli_affected_rows($connect);
	if($affected_rows < 0){
	echo '<h1>Your link information has been permanently deleted. </h1>';
	}
	elseif($affected_rows >= 0){
	echo '<h1  style = "text-align:left;">There may have been an error and your link information was NOT deleted. If that is not what you expected you can try to redo the process. Contact the administrators if you need further assistance. </h1>';
	
}
}
}

function updateLinkInfo ($link_id, $title,$url,$description){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$link_id = htmlspecialchars($link_id);
$title = htmlspecialchars($title);
$url = htmlspecialchars($url);
$description =  htmlspecialchars($description);

$link_id = mysqli_real_escape_string($connect, $link_id);
$title = mysqli_real_escape_string($connect, $title);
$url = mysqli_real_escape_string($connect, $url);
$description = mysqli_real_escape_string($connect, $description);

$sql = 'UPDATE `links` set `name`="'.$title.'",`url`="'.$url.'",`description`="'.$description.'" ,`approved`="false" where `id`='.$link_id;
$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 3 Account' query");
$affected_rows = mysqli_affected_rows($connect);
if($affected_rows < 0){
echo '<h1  style = "text-align:left;">Your link information remained unchanged. If that is not what you expected please try again</h1>';
}
elseif($affected_rows >= 0){
echo '<h1 style = "text-align:left;">Your link information was updated. If that is not what you expected you can redo the process. Your link has been moved to the "Pending Approval" queue and will be returned to "active" status as soon as possible. </h1>';
}
else
{
echo '<h1>There was an error and no changes were made</h1>';
}
}

function getLinkInfo ($website_id){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$website_id = mysqli_real_escape_string($connect, $website_id);

$sql = "select * from `links` where `id` = '$website_id'";
$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Get link info' query");
while ($row = mysqli_fetch_array($result)){
$title = $row['name'];
$url = $row['url'];
$description = $row['description'];
}
$sendarray = array($title ,$url ,$description);
return $sendarray; 
}


}//close class
