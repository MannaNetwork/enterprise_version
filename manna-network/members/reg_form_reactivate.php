<?
// include the configs
require_once("config/config.php");

    
// load the login class

// load php-login components
require_once("php-login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

 
    
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...


$user_id = $_SESSION['user_id'];


include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$link_id = $_GET['website_id'];

$website_id = mysqli_real_escape_string($connect, $link_id);
$category = $_GET['category'];
$category = mysqli_real_escape_string($connect, $category);
$sql = "SELECT * FROM `links` WHERE id ='".$website_id."'";
$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 34 Account' query");
 do
{
$url = $row['url'];
$name = $row['name']; 
$description = $row['description']; 
$approved = $row['approved']; 
$regional_number = $row['regional_number']; 
$submit_name = $row['submit_name']; 	
$submit_email = $row['submit_email'];
$owners_email = $row['owners_email'];
 }while ($row = mysqli_fetch_array($result));

$B1=$_GET['B1'];
//////////////////////////////////////////
IF(isset ($B1)){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
 include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
 
//make sure the mdifier of the link is the owner of the link
$sql = "SELECT * FROM `links` WHERE id ='$website_id'";
$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 55 Account' query");
  do
   {
$BB_user_ID = $row['BB_user_ID']; 
 }while ($row = mysqli_fetch_array($result));
if($BB_user_ID!==$user_id)
{
echo 'Server error - your process was halted. Please contact the administrator for assisatance.';
exit();
}
$main_cats = $_GET['main_cats'];	
$cat_pieces = explode("," , $main_cats);
$member = $_GET['member'];	
$current_cat = $_GET['current_cat'];
$cat_id = $_GET['cat_id'];
$BB_user_ID = mysqli_real_escape_string($connect, $BB_user_ID);
$category = mysqli_real_escape_string($connect, $category);
$BB_user_ID = htmlentities($BB_user_ID);
$category = htmlentities($category);

$query="update `links` set `approved` = 'false', `is_a_modified`='1'  WHERE `id` ='$website_id' LIMIT 1 ";
$result = mysqli_query($connect, $query) or die("<p align='left'>There was a problem submitting your link. Usually this is the result of attempting to submit a duplicate entry. If such is the case, return to your admin control panel and use the 'Modify' link to check for and/or change a previous duplicate entry. If such is not the case please use the 'Contact' form in the main menu to contact the qdministrator with the details of the problem. Thank you and sorry for any inconvenience this may have caused you. "); 
$this_links_affiliate_num = mysqli_insert_id($connect);


$moniker="<h5>Reactivate Your Link</h5>";
$body_width="wide";

include('../960top.php');

	echo '<h1>Thank You! Your link (link# ';
echo $website_id;
echo ') has successfully been re-activated and has been submitted for review. It will now have a yellow "pending" button while it is awaiting review. After approval it will return to the normal green color.</font></p>';

echo '<h1><a href="/members/index.php">RETURN To Control Panel</a></h1>';



include('../960bottom.php');

}
else// begin form
{

$moniker="<h5>Reactivate Your Link</h5>";
$body_width="wide";

include('../960top.php');

 ?>
  <table width="900px" id="member">
   <tr ><td>
<form style="width:90%" action="<?= $_SERVER['PHP_SELF']?>" method="get" >
<input type="hidden" name="freebie" value="<?echo $freebie;?>">
<input type="hidden" name="website_id" value="<?echo $website_id;?>">
<input type="hidden" name="current_cat" value="<?echo $category ;?>">
  <h2 align="center">BungeeBones Link Re-Activation Form</h2>

    <table  width="100%" id="member">
		  <tr border="0">
        <td  width="80%" align="center" bgcolor="#F7EFEF">
	<?
	include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
	include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
 	require('../link_exchange/incl_yald_func.php');
		
//$cat_id = stripslashes($_GET['category']);
$newcat_id = $cat_id;
//find out if at end of category tree
IF(isset ($cat_id)){
$query = " SELECT `lft` , `rgt` 
FROM `categories` 
WHERE `id` =$cat_id LIMIT 0 , 30 ";
 $result = mysqli_query($connect, $query); 
 $row = mysqli_fetch_array($result);
$lft=$row['lft'];
 $rgt=$row['rgt'];
$cat_total = $rgt-$lft;
 }
   ?>       <h2>RE-Activate Your Link Information?</h2>
        <p align="left">If you submit this form your link will be re-activated and will be displayed again on BungeeBones.com and the other distributed web directories.</p>
<h2>Welcome Back!</h2>
<p align="left">The "Deactivated" button will no appear on your user control panel. It will be listed as a free link and from there you can subscribe as a paid link using the normal process.</p>	<h1 align="center">ARE YOU SURE?</h1>
</span></td>      </tr>
		  <tr>
<?
                     IF(isset ($cat_id)){
                      $query = "SELECT * FROM `categories` where `parent` = '$cat_id' && `is_approved` = '1' OR `parent` = '$cat_id' && `BB_user_ID` = '$user_id'ORDER BY name ASC ";
                      $t = $_GET['t'];
                      $u = $_GET['u'];
                      $current_cat=$cat_id;
                      }
                      else
                      {
                      	$query = "SELECT * FROM `categories` where `parent` = '1' ORDER BY name ASC ";
                      	}

	$nav .= cookie_Trail($cat_id);
		$categoryname = categoryName($url_cat);
		$page_title = $categoryname;
		$nav .= $settings['-->'].$categoryname;
		echo  $nav;?><BR><?
$result = mysqli_query($connect, $query);
$num_rows = mysqli_num_rows($result);

$cat_name=array("");
$cat_id=array("");
$cat_population=array("");
$cat_price=array("");
$cat_lft=array("");
$is_approved=array("");
$cat_rgt=array("");
                          	while($row = mysqli_fetch_array($result)){
                          array_push($cat_name, ($row['name']));
                          array_push($cat_id, ($row['id']));
                          array_push($is_approved, ($row['is_approved']));
                          $pieces = $row['population'];
                          $population = explode(",",$pieces);
                          $population2=$population[7];
                          array_push($cat_population, $population2);
                          array_push($cat_price, ($row['price']));
                          array_push($cat_lft, ($row['lft']));
                          array_push($cat_rgt, ($row['rgt']));
                          	}//end while

?>

  
    <table  id="member">
     <tr>
		
      <td width="14%" align="right"><b><font size="2">Homepage URL</font></b></td>
      <td ><b><font size="2">
     <input disabled TYPE="text" name="u" value="<?echo $url;?>" size="46"></font></b></td>
	</tr>
    <tr>
      <td width="14%" align="right"><font size="2"><b>TITLE </b></font></td>
      <td><b><font size="2">
  <input disabled type="text" name="t" value="<?echo $name;?>" size="46"></font></b></td>
	</tr>
	<tr>
      <td width="14%" align="left"><font size="2"><b>DESCRIPTION </b></font></td>
      <td>
 <textarea disabled rows="4" name="description" cols="40"><?echo $description;?></textarea></font></b></td>
</td></tr><tr><td colspan="2">
<p align="center">
<input type="submit" value="RE-ACTIVATE?" name="B1"><input type="reset" value="Cancel" name="B2"></p>
</p></td></tr></table>
    </table>
 <br>
</form>
<h3 align="center"><a href="/members/index.php">Return To Your User Control Panel</a></h3>
</TD></TR></TABLE>
<?

include('../960bottom.php');

// include($_SERVER['DOCUMENT_ROOT']."/members/templatebottomnsb.php");
}//closes main else
} else {
    // the user is not logged in...

    include("views/not_logged_in.php");
}

?>	
