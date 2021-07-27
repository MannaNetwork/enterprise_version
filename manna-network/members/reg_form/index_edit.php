<?
require_once("../config/config.php");
require_once("../php-login.php");
$login = new Login();
if ($login->isUserLoggedIn() == true) {    
$user_id = $_SESSION['user_id'];
if(isset($_POST['submit'])) 
{ 
$cat_id = $_POST['cat_id']  ;
$link_id = $_POST['link_id']  ;
}
else
{
$var = explode("/", $_SERVER['PATH_INFO']);
$cat_id = $var[1] ;
$link_id = $var[2] ;
}
$phpself = basename(__FILE__);
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;


include($_SERVER['DOCUMENT_ROOT']."/members/reg_form/classes/edit_link_class.php");  

$moniker="<h5>Edit</h5>";
$body_width="wide";
include($_SERVER['DOCUMENT_ROOT']."/960top.php");
$link_info = new edit;

$get_link_info = $link_info->getLinkInfo ($link_id, $cat_id);
//gets $title ,$url ,$category,$description,$street,$postal_code,$phone_number
$title  = $get_link_info[0];
$url  = $get_link_info[1];
$category = $get_link_info[2];
$description = $get_link_info[3];
$street = $get_link_info[4];
$postal_code = $get_link_info[5];
$phone_number = $get_link_info[6];
echo '<p>&nbsp;</p><h3 style="color: red;">Edit Link Info</h3>';
echo"<h3 style='color: red;'>Your Current Category Of Your Link Is In The ". $cat_name_orig . " Category</h3>
<p style='text-align: left;'>If you want to move your link into another category you can do so here.</P>
<p style='text-align: left;'>If you move your link into a different category you lose link seniority (only affects free links).</p>";
print_r($get_link_info);
if(isset($_POST['B1'])) 
{ 
echo 'in B1';
$update_link_info = $link_info->updateLinkInfo ($link_id, $cat_id,$title,$url,$category,$description,$street,$postal_code,$phone_number);
}
elseif(isset($_POST['submit'])) 
{ 
 if(!isset($_POST['title'])){
$title  = $get_link_info[0];
}
else
{
$title  = $_POST['title'];
}
 if(!isset($_POST['url'])){
 $url = $get_link_info[1];}
else
{
$url = $_POST['url'];
}
 if(!isset($_POST['category'])){
$category  = $get_link_info[2];
}
else
{
$category = $_POST['category'];
}
 if($_POST['description']==""){
echo 'in not isset description';
$description  = $get_link_info[3];
}
else
{
echo 'in else is isset description';
$description = $_POST['description'];
}
 if(!isset($_POST['street'])){
$street   = $get_link_info[4];
}
else
{
$street = $_POST['street'];
}
 if(!isset($_POST['postal_code'])){
$postal_code  = $get_link_info[5];
}
else
{
$postal_code = $_POST['postal_code'];
}
 if(!isset($_POST['phone_number'])){
$phone_number  = $get_link_info[6];
 }
else
{ 
$phone_number = $_POST['phone_number'];
}
?>    
<form name="test" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
<input type="hidden" name="title" value = "<?echo $title;?>">
<input type="hidden" name="url" value = "<?echo $url;?>">
<input type="hidden" name="category" value = "<?echo $category;?>">
<input type="hidden" name="description" value = "<?echo $description;?>">
<input type="hidden" name="street" value = "<?echo $street;?>">
<input type="hidden" name="postal_code" value = "<?echo $postal_code;?>">
<input type="hidden" name="phone_number" value = "<?echo $phone_number;?>">
<?
echo "You have submitted the form and entered this title : <b> $title </b><br>";
echo "You have submitted the form and entered this url : <b> $url </b><br>";
echo "You have submitted the form and entered this description : <b> $description </b><br>";
echo "You have submitted the form and entered this street : <b> $street </b><br>";
echo "You have submitted the form and entered this postal code : <b> $postal_code </b><br>";
echo "You have submitted the form and entered this phone_number : <b> $phone_number </b><br>";
    echo "<br>If those are correct submit the form again to enter the new values else use the browser's \"back\" button to make your changes.."; 
echo '  <input type="submit" name="B1" value="Submit Form"><br>
</form>';

}
else
{
?>
<form name="test" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
<input type="hidden" name="cat_id" value = "<?echo $cat_id;?>"> 
<input type="hidden" name="link_id" value = "<?echo $link_id;?>">
<table><tr><td>
Title: </td><td><input type="text" name="$title" placeholder = "<?echo $title;?>"></td></tr>
<tr><td>URL:  </td><td><input type="text" name="$url" placeholder = "<?echo $url;?>"></td></tr>
<!--<tr><td>Category Number:  </td><td><input type="text" name="$category" placeholder = "<?echo $category;?>"></td></tr>-->
<tr><td>Description:  </td><td><textarea name="description" rows="5" cols="40" id="description" placeholder="<?echo $description;?>"></textarea></td></tr>
                            
<tr><td>Street:  </td><td><input type="text" name="$street" placeholder = "<?echo $street;?>"></td></tr>
<tr><td>Postal Code:  </td><td><input type="text" name="$postal_code" placeholder = "<?echo $postal_code;?>"></td></tr>
<tr><td>Phone Number:  </td><td><input type="text" name="$phone_number" placeholder = "<?echo $phone_number;?>"></td></tr></table>
   <input type="submit" name="submit" value="Submit Form"><br>
</form>
<? 
}
include($_SERVER['DOCUMENT_ROOT']."/960bottom.php");



} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}
 ?>
