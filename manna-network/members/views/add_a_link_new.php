//the only input not null is protocol
if(array_key_exists('user_id', $_POST['user_id'])){
if(array_key_exists('user_registration_datetime', $_POST['user_registration_datetime'])){
$user_registration_datetime = 
}
else
{
$user_registration_datetime = 
}
if(array_key_exists('website_title', $_POST['website_title'])){
$website_title = 
}
else
{
$website_title = 
}
if(array_key_exists('website_description', $_POST['website_description'])){
$website_description = 
}
else
{
$website_description = 
}
if(array_key_exists('protocol', $_POST['protocol'])){
$protocol = 
}
else
{
$protocol = 
}
if(array_key_exists('website_url', $_POST['website_url'])){
$website_url = 
}
else
{
$website_url = 
}
if(array_key_exists('page_name', $_POST['page_name'])){
$page_name = 
}
else
{
$page_name = 
}
if(array_key_exists('category_id', $_POST['category_id'])){ 
$category_id = 
}
else
{
$category_id = 
} 
if(array_key_exists('location_id', $_POST['location_id'])){
$location_id = 
}
else
{
$location_id = 
}
if(array_key_exists('website_street', $_POST['website_street'])){
$website_street = 
}
else
{
$website_street = 
}
if(array_key_exists('map_link', $_POST['map_link'])){
$map_link = 
}
else
{
$map_link = 
}
if(array_key_exists('installer_id', $_POST['installer_id'])){
$installer_id = 
}
else
{
$installer_id = 
}
if(array_key_exists('catkeys', $_POST['catkeys'])){
$catkeys = 
}
else
{
$catkeys = 
}
if(array_key_exists('lockeys', $_POST['lockeys'])){
$lockeys = 
}
else
{
$lockeys = 
}



if($value == ""){
echo '&nbsp;&nbsp;<h4 style="color:red;">&nbsp;&nbsp;'.$key.'&nbsp;&nbsp;'.REGISTRATION_GENERAL_ERROR1.REGISTRATION_LNK_NUM1.REGISTRATION_GENERAL_ERROR2.$value.'</h4>';
$error_test = 'failed';
echo '<H1  style="color:red;"> recruiter link number is empty = '.$key."</H1>";
}
if(!is_numeric($value)){
echo '&nbsp;&nbsp;<h4 style="color:red;">&nbsp;&nbsp;'.$key.'&nbsp;&nbsp;'.REGISTRATION_GENERAL_ERROR1.REGISTRATION_LNK_NUM2.REGISTRATION_GENERAL_ERROR2.$value.'</h4>';
$error_test = 'failed';
} 


if(empty($_POST['website_title']))
{
echo "<h3 style='color:red;'>You must supply a title for your ad listing</h3>";
$error_test = 'failed';
}
$website_title_subject = $value;
$website_title_pattern = '/^[a-zA-Z0-9 ]*/';

preg_match($website_title_pattern, $website_title_subject, $website_title_matches);

if(!$website_title_matches[0]){
echo "<h3 style='color:red;'>Only alphabet characters, numbers and white space allowed</h3>";
$error_test = 'failed';
}

if(empty($_POST['website_description']))
{
echo "<h3 style='color:red;'>You must supply a description for you ad listing</h3>";
$error_test = 'failed';
}
$website_description_subject = $value;
$website_description_pattern = '/^[a-zA-Z0-9 ]*/';

preg_match($website_description_pattern, $website_description_subject, $website_description_matches);
if(!$website_description_matches[0]){
echo "<h3 style='color:red;'>Only alphabets, numbers and white space allowed</h3>";
$error_test = 'failed';
}

if(empty($_POST['selected_cat_id']))
{
echo "<h3 style='color:red;'>You must select a category for your  ad listing</h3>";
$error_test = 'failed';
}
else
{
echo '<input type="hidden" name="selected_cat_id" value="'.$_POST['selected_cat_id'].'">';

}

if(!empty($_POST['selected_region_id']))
{
echo '<input type="hidden" name="selected_region_id" value="'.$_POST['selected_region_id'].'">';
}


