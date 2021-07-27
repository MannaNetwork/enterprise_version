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


include($_SERVER['DOCUMENT_ROOT']."/members/incl_auc_func.php");
include($_SERVER['DOCUMENT_ROOT']."/classes/link_class.php");
include($_SERVER['DOCUMENT_ROOT']."/classes/auction_class.php");
include($_SERVER['DOCUMENT_ROOT']."/classes/categories_class.php");
include($_SERVER['DOCUMENT_ROOT']."/classes/regional_filters_class.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/incl_yald_func.php");
$today = date("Y-m-d");

$website_id=$_GET['website_id'];
$cat_id_orig=$_GET['cat_id_orig'];
$cat_id_new_selected=$_GET['cat_id_new_selected'];

$B1=$_GET['B1'];
$C1=$_POST['C1'];
//////////////////////////////////////////

$moniker="<h5>Modify Link Info</h5>";
$body_width="wide";

include('../960top.php');

IF(isset ($B1))
{//cl
$BB_user_ID = $row['BB_user_ID']; 
$website_id=$_GET['website_id'];
$cat_id_orig = $_GET['cat_id_orig'];
$cat_cat_id_new_selected = $_GET['cat_id_new_selected'];
$url=$_GET['url'];
$name=$_GET['name'];
$description=$_GET['description'];
$main_cats = $_GET['main_cats'];	
$cat_pieces = explode("," , $main_cats);
// include($_SERVER['DOCUMENT_ROOT']."/members/templatebottomnsb.php");


//the following is intended to try and make sure we are unsderstanding the user's intent corrctly

if(!isset($main_cats)|| $main_cats==""){


							//$cat_pieces[1] comes only from a radio button - should it be assigned the default value of the
							// current category (unless the current category is empty or category 1)?
							//find out if empty cat selection is in a sub cat
							// and if so, do they want to use the parent as their cat?
							
							echo '<h2>Did you forget to enter a new category???</h2>
								<p STYLE="font-size: .9em;  text-align: left;">Because you did not select using the radio button we need to confirm that you want to post your link in the ';
									$CatInfo=new category_info;	
										if(isset($cat_id_new_selected)){

										echo '<b><u>' . $CatInfo->getCatname($cat_id_new_selected) . '</u></b>';
										echo ' category which you navigated to and which you are now in.  </p>';
										$update_cat_to = $cat_id_new_selected;
										}
										else
										{
										echo 'the original category that you are now in, the <b><u>';
										echo $CatInfo->getCatname($cat_id_orig);
										$update_cat_to = $cat_id_orig;
										echo ' </u></b>category.</p> ';
										}
										echo'<p STYLE="font-size: .9em;  text-align: left;"> If this is not what you intended please use the "Go Back" button to correct your selection. If it is, then use the "Submit Changes" button to finish</p>';
								
		}					
	

echo'
								<form action="'.$_SERVER['PHP_SELF'].'" id="searchform" method="post">
									
									<input type="hidden" name="update_cat_to" value = "'. $update_cat_to.'">
										<input type="hidden" name="update_phone_to" value = "'. $_GET['phone'].'">
										<input type="hidden" name="update_zip_to" value = "'.  $_GET['zip'].'">
										<input type="hidden" name="update_street_to" value = "'. stripslashes($_GET['street']).'">
										<input type="hidden" name="url" value = "'.  $_GET['url'].'">
										<input type="hidden" name="update_name_to" value = "'.  stripslashes($_GET['name']).'">
										<input type="hidden" name="update_description_to" value = "'.  stripslashes($_GET['description']).'">
										<input type="hidden" name="update_continents_to" value = "'.  $_SESSION['continents'].'">
										<input type="hidden" name="update_countries_to" value = "'.  $_SESSION['countries'].'">
										<input type="hidden" name="update_states_to" value = "'.  $_SESSION['states'].'">
										<input type="hidden" name="update_cities_to" value = "'.  $_SESSION['cities'].'">
										<input type="hidden" name="website_id" value = "'.  $website_id.'">
										<p STYLE="font-size: .9em;  text-align: left;">The following data for your link will be recorded</p>
									<p STYLE="font-size: small;  text-align: left;">'.$_GET['url'].' </p>
									<p STYLE="font-size: small;  text-align: left;">'.$_GET['name'].' </p>
								<p STYLE="font-size: small;  text-align: left;"> '.stripslashes($_GET['description'].' </p>');

If($_GET['street'] != ""){									
echo'<p STYLE="font-size: .95em;  text-align: left;">Street Address: '.$_GET['street'].' </p>';
}
if($_GET['zip']!= ""){
echo '<p STYLE="font-size: small;  text-align: left;">Postal Code: '.$_GET['zip'].' </p>';
}
if($_GET['phone'] != ""){
echo '<p STYLE="font-size: small;  text-align: left;">Business Telephone Number: '.$_GET['phone'].' </p>';
}

//begin regional confirm display 
$RegInfo=new regional_filters;	

 
			
if($_SESSION['continents']){
echo '<p STYLE="font-size: small;  text-align: left;">Continent: '.$RegInfo->getRegCatName($_SESSION['continents']).' </p>';
}

if($_SESSION['countries']){
echo '<p STYLE="font-size: small;  text-align: left;">Country: '.$RegInfo->getRegCatName($_SESSION['countries']).' </p>';
}

if($_SESSION['states']){
echo '<p STYLE="font-size: small;  text-align: left;">State: '.$RegInfo->getRegCatName($_SESSION['states']).' </p>';
}

if($_SESSION['cities']){
echo '<p STYLE="font-size: small;  text-align: left;">City: '.$RegInfo->getRegCatName($_SESSION['cities']).' </p>';
}



	echo'<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><INPUT TYPE="button" VALUE="Go Back" onClick="history.back()">';
	echo'<input type="submit" value="Submit Changes" name="C1"></FORM>';
 //include($_SERVER['DOCUMENT_ROOT']."/members/templatebottomnsb.php");
exit();
	




}
elseIF(isset ($C1))
{//cl
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$update_cat_to =  stripslashes($_POST['update_cat_to']);
$update_phone_to =  stripslashes($_POST['update_phone_to']);
$update_zip_to =   stripslashes($_POST['update_zip_to']);
$update_street_to = stripslashes($_POST['update_street_to']);
$url =  $_POST['url'];
$update_name_to =   stripslashes($_POST['name']);
$update_description_to =   stripslashes($_POST['update_description_to']);

$update_continents_to =   $_POST['update_continents_to'];
$update_countries_to =   $_POST['update_countries_to'];
$update_states_to =   $_POST['update_states_to'];
$update_cities_to =   $_POST['update_cities_to'];

$website_id=$_POST['website_id'];


//$update_continents_to =   $_SESSION['continents'];
//$update_countries_to =   $_SESSION['countries'];
//$update_states_to =   $_SESSION['states'];
//$update_cities_to =   $_SESSION['cities'];
//$website_id =   stripslashes($_POST['website_id']);


$sql = "SELECT `BB_user_ID` FROM `links` WHERE id ='$website_id'";

$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 177 Account' query");
do
{
$BB_user_ID = $row['BB_user_ID']; 
}while ($row = mysqli_fetch_array($result));

//make sure the mdifier of the link is the owner of the link
//include($_SERVER['DOCUMENT_ROOT']."/members/templatebottomnsb.php");
if($BB_user_ID!==$user_id)
{
echo 'Server error - your process was halted. Please contact the administrator for assisatance.';
exit();
}
if(isset($_SESSION['continents']))
{
$continents = $_SESSION['continents'];
}
if(isset($_SESSION['countries']))
{
$countries= $_SESSION['countries'];
}
if(isset($_SESSION['states']))
{
$states= $_SESSION['states'];
}
if(isset($_SESSION['cities']))
{
$cities =  $_SESSION['cities'];
}

$query = "update `links` set ";
$query2 = "update `regional_sign_ups` set ";
if($update_phone_to !==""){
$query .= "`phone` = '$update_phone_to',";
}
$query .= "`is_a_modified`=1,";
if($update_zip_to !==""){
$query .= "`zip` = '$update_zip_to',";
}
if($update_street_to !==""){
$query .= "`street`='$update_street_to',";
}

if($update_cat_to !==""){
$query .= "`category`='$update_cat_to',";
}
if($update_name_to !==""){

$query .= "`name`='$update_name_to',";
}
if($update_description_to !== ""){
$query .= "`description`='$update_description_to',";
}

if(isset($_SESSION['continents']))
{
$query2 .= " `continents`=". $_SESSION['continents'];
}
if(isset($_SESSION['countries']))
{
$query2 .= ", `countries`=" . $_SESSION['countries'];
}
if(isset($_SESSION['states']))
{
$query2 .= ", `states`=" . $_SESSION['states'];
}
if(isset($_SESSION['districts']))
{
$query2 .= ", `districts`=" . $_SESSION['districts'];
}
if(isset($_SESSION['cities']))
{
$query2 .= ", `cities`=" . $_SESSION['cities'];
}





//continents 	countries 	states 	districts 	cities 	link_id



$query .= "`approved` = 'false'  ";
$query .= " WHERE `id` = $website_id ";
$query2 .= " WHERE `link_id` = $website_id ";
	
							
$result = mysqli_query($connect, $query) or die("<p align='left'>There was a problem submitting your link. Usually this is the result of attempting to submit a duplicate entry. If such is the case, return to your admin control panel and use the 'Modify' link to check for and/or change a previous duplicate entry. If such is not the case please use the 'Contact' form in the main menu to contact the qdministrator with the details of the problem. Thank you and sorry for any inconvenience this may have caused you. "); 

$query3 = "select * from `regional_sign_ups` where `link_id` = $website_id ";
$result3 = mysqli_query($connect, $query3) or die("<p align='left'>There was a problem submitting your regional information. Please use the 'Contact' form in the main menu to contact the administrator with the details of the problem. Thank you and sorry for any inconvenience this may have caused you. "); 
$num_rows = mysqli_num_rows($result3);
//$num_rows = 0;//manually change this in order to enable multiple entries of the same link into different regions
//probably should add a checkbox offering to update or replace current region ... could do it once but then multiple entries would be impossible to editw ithout major coding
if($num_rows < 1 && $continents != ""){

$query2 = "INSERT into `regional_sign_ups` (`continents`,`countries`, `states`,`districts`,`cities`, `link_id`) values ('$continents','$countries','$states','$districts', '$cities', '$website_id')";

$result = mysqli_query($connect, $query2) or die("<p align='left'>There was a problem submitting your regional information. Please use the 'Contact' form in the main menu to contact the qdministrator with the details of the problem. Thank you and sorry for any inconvenience this may have caused you. "); 

}
elseif($continents != "")
{
$query2 = "UPDATE `regional_sign_ups` SET `continents` = '$continents',`countries` = '$countries', `states` = '$states',`districts`= '$districts',`cities` = '$cities' WHERE `link_id` = $website_id";

$result = mysqli_query($connect, $query2) or die("<p align='left'>There was a problem submitting your regional information. Please use the 'Contact' form in the main menu to contact the qdministrator with the details of the problem. Thank you and sorry for any inconvenience this may have caused you. "); 
}										
										echo '
										<p align="left"><font size="5" color="#000080">Your link (link#';
										echo $website_id;
										echo '
										) was modified successfully, is now awaiting review, and should be &quot;back live&quot; very quickly.Thank you for keeping your link information accurate and up-to-date!</font></p>';
								
								// can the dot connect method be used to construc a varibale back construct which counts the level it is on? Or can a function be built to check?
								
								echo '<br><a href="members/index.php">Go To Control Panel</a><p>&nbsp;</p><p>&nbsp;</p>';
								



 //include($_SERVER['DOCUMENT_ROOT']."/members/templatebottomnsb.php");
exit();

}
else// begin form
{
$website_id=$_GET['website_id'];
$cat_id_orig = $_GET['cat_id_orig'];
 //include($_SERVER['DOCUMENT_ROOT']."/members/templatebottomnsb.php");
?>      
								
<div style="text-align: center;">
<a href="http://bungeebones.com/members/index.php" class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;<a href="http://bungeebones.com/members/reg_form.php" class="cssbutton sample a"><span>Add Link</span></a>&nbsp;<a href="http://bungeebones.com/members/insert_directory_instr.php" class="cssbutton sample a"><span> Get A Widget </span></a>&nbsp;<a href="http://bungeebones.com/members/update_user.php" class="cssbutton sample a"><span> Your Profile </span></a>&nbsp;<a href="http://bungeebones.com/feedback.php" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="http://bungeebones.com/articles/terms_of_service.php/" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="http://bungeebones.com/members/index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
</div>
<table id="member" WIDTH="80%" bORDER="1" ALIGN="CENTER"  summary=""><tr><td>
<? if(isset($_SESSION['continents'])){unset($_SESSION['continents']);}
if(isset($_SESSION['countries'])){unset($_SESSION['countries']);}
if(isset($_SESSION['states'])){unset($_SESSION['states']);}
if(isset($_SESSION['cities'])){unset($_SESSION['cities']);}	?>								
<form action="<?= $_SERVER['PHP_SELF']?>" id="searchform" method="GET">
<?
if(isset($cat_id_new_selected)){
//cat_id_new_selected is the cat id of the now currecnt display cat resulting from clicking the + sign.
//the script logic will know it cat came from a new selected cat. It will also see if a radio was selected and, 
//if not, asumes the person wants the link in the new selected category
echo '<input type="hidden" name="cat_id_new_selected" value="'. $cat_id_new_selected.'">';
}
?>
<input type="hidden" name="website_id" value="<?echo $website_id;?>">
<input type="hidden" name="cat_id_orig" value="<?echo $cat_id_orig;?>">
<h2 align="center">BungeeBones Link Info Modification Form</h2>

<table border="1" cellpadding="5" cellspacing="5"  bordercolor="#F7EFEF" width="80%" id="member">

<?

//include('reg_form_form_head.php'); 

$cat_name=array("");
$cat_id_array=array("");
$cat_population=array("");
$cat_price=array("");
$cat_lft=array("");
$is_approved=array("");
$cat_rgt=array("");
if(isset($cat_id_new_selected)){	
$query = "SELECT * FROM `categories` where `parent` = '$cat_id_new_selected' ORDER BY name ASC";
}
else{	//must be cat _id_orig			
$query = "SELECT * FROM `categories` where `parent` = '$cat_id_orig' ORDER BY name ASC ";
}
		$result = mysqli_query($connect, $query);
		$num_rows = mysqli_num_rows($result);
		
		while($row = mysqli_fetch_array($result)){
		array_push($cat_name, ($row['name']));
		array_push($cat_id_array, ($row['id']));
		array_push($is_approved, ($row['is_approved']));
		$pieces = $row['population'];
		
		$population = explode(",",$pieces);
		$population2=$population[14];
		
		array_push($cat_population, $population2);
		array_push($cat_price, ($row['price']));
		array_push($cat_lft, ($row['lft']));
		array_push($cat_rgt, ($row['rgt']));
		}//end while
		//begin duilding form display block
		$display_block = "";
		For($i = 1; $i <= $num_rows; $i+= 2)
		{
		$display_block .= "<tr><td width='16%' align='left'>";
		$test_cat = isCatActiveAuction($cat_id_array[$i], $today);
		//note there is a simialr funtion in inc yald fund that is used to test if category is "freebie"
		//in that one if it is freebie, it will have a value of true (1)
		//but if it is a free it will also not be an auction
		//so that function will return a 1 if it is NOT an auction
		//will return a zero if is an auction (zero means it is not a freebie)	
		//this one is the opposite - it will return a one if is an auction (and not a freebie)  
								If($test_cat > 0)
								{
								$display_block .= "<b><font color='#006600'>";
								$display_block .= $cat_name[$i];
								$display_block .= '</font><font color="#FF0000">*</font></b>';
								}
								else
								{
								if($is_approved[$i]==0){
								$display_block .= '<font color="#0000FF"><u>';
										}
										else
										{
										$is_approved_trip="on";
										}
										
										if($is_approved[$i]==0){
										$is_approved_trip="on";
										$display_block .= $cat_name[$i];
										}
										else
										{
										$display_block .= $cat_name[$i];
										}
										$display_block .= '</u></font>';
								
								}//endelse
								$display_block .= "</font></td><td align='center'>";
							$temp_cat_lft=$cat_lft[$i]+1;
							If($temp_cat_lft!=$cat_rgt[$i]){
							$display_block .= '<font size="4"><b><a href="members/reg_form_modify.php?cat_id_new_selected=';
										$display_block .= $cat_id_array[$i];
										$display_block .= '&BB_User_ID='.$user_id.'&cat_id_orig='.$cat_id_orig.'&website_id='.$website_id;
										$display_block .= '">+</a></B></font>' ;
							}
							$display_block .= "</td><td align='center'>";
							////TRANSFORM TO RIGHT HALF                    
							
							
							
							If($test_cat > 0)
							{
							$display_block .= "<font color='#006600'><b>";
									$display_block .= $cat_population[$i];
									$display_block .= "</b></font>";
							}
							else
							{
							$display_block .= $cat_population[$i];
							}
							$display_block .= "</td>";
						
						
						
						If($test_cat > 0)
						{
						$display_block .= "<td colspan='2'><p align='center'><font size='1' color='green'><b>Auction*</b></font></td>";
							$freebie[$i] = 0;
							$issue_freebie_warning = 'true';
							}
							else
							{
							$display_block .= "<td><p align='center'>&nbsp;<font size='1' color='#CC6600'><b>Free</b></font>";
									$freebie[$i] = 1;
									
									//start the if to see whether paid (auction) or not
									//if is don't display option button
									
									if($cat_id_array[$i]."/" == $category){
									$display_block .= "</td><td align='center'><input type='radio' checked name='main_cats' value='";
										}
										else
										{
										$display_block .= "</td><td  align='center'><input type='radio'  name='main_cats' value='";
										}
										
										$display_block .=     	  $cat_name[$i] . "," . $cat_id_array[$i] . "," . $freebie[$i] . "'></td>";
										
										//	$display_block .= "</td>";
									}
									
									unset($test_cat);// there is another test cat to unset below to alter too if necessary 
									
									////////////////////////////////////////////////////////////////////////
									/////////////////////////////////////////////////////////////
									//BEGIN RIGHT HALF OF DISPLAY 
									//first make sure it isn't the end and its empty  
									if($cat_name[$i+1]==""){
									$display_block .="<td colspan='6'>&nbsp;</td>";
									}				
									else
									{													
									$test_cat = isCatActiveAuction($cat_id_array[$i+1], $today);
									If($test_cat > 0)
									{
									$display_block .= "<td bgcolor='#c0c0c0' width='20'>&nbsp;</td><td><b><font color='#006600'>";
										$display_block .= $cat_name[$i+1];
										$display_block .= '</font><font color="#FF0000">*</font></b>';
								}
								else
								{
								$display_block .= "</td><td bgcolor='#c0c0c0' width='20'>&nbsp;</td><td>";
								if($is_approved[$i+1]==0)
								{
								$is_approved_trip="on";
								$display_block .= '<font color="#FF0000">';
									}
									
									$display_block .= $cat_name[$i+1];;
									if($is_approved[$i+1]==0)
									{
									$display_block .= '*</font>';
								}
								}//end else
								$display_block .= '</font>' ;
							$display_block .= "</td><td align='center'>";
							$temp2_cat_lft=$cat_lft[$i+1]+1;
							If($temp2_cat_lft!=$cat_rgt[$i+1])
							{
							$display_block .= '<font size="4"><b><a href="members/reg_form_modify.php?website_id='.$website_id.'&cat_id_new_selected=';
										$display_block .= $cat_id_array[$i+1];
										$display_block .= '&BB_User_ID='.$BB_User_ID.'&u='.$u.'&t='.$t.'&category='.$main_cats;
										$display_block .= '">+</a></B></font>';
							}
							$display_block .= "</td><td align='center'>";
							If($test_cat > 0)
							{
							$display_block .= "<font color='#006600'><b>";
									$display_block .= $cat_population[$i+1];
									$display_block .= "</b></font>";
							}
							else
							{
							$display_block .= $cat_population[$i+1];
							}
							$display_block .= "</td>";
						If($test_cat > 0)
						{
						$display_block .= "<td colspan='2'><p align='center'><font size='1' color='green'><b>Auction*</b></font>";
								$freebie[$i+1] = 0;
								$issue_freebie_warning = 'true';
								}
								else
								{
								$display_block .= "<td><p align='center'>&nbsp;<font size='1' color='#CC6600'><b>Free</b></font>";
										$freebie[$i+1] = 1;
										}
										//start the if to see whether paid (auction) or not
										//if is don't display option button
										If($test_cat > 0)
										{
										$display_block .= "&nbsp;</td>";
									}
									else
									{
									if($cat_id_array[$i+1]."/" == $category)
									{
									$display_block .= "</td><td align='center'><input type='radio' checked name='main_cats' value='";
										}
										else
										{
										$display_block .= "</td><td  align='center'><input type='radio'  name='main_cats' value='";
										}
										
										$display_block .= $cat_name[$i+1] . "," . $cat_id_array[$i+1] . "," . $freebie[$i+1];
										
										$display_block .= "'></td>";
										}
										$display_block .= "</tr>";
									unset($test_cat);
									
									}//end for line 324
									//if($issue_freebie_warning == 'true')
									//{
									//$display_block .= "<tr align='center'><td  colspan='11' > <b>*Auction categories are Paid Categories.<b> To get your link entered into an auction category first click the plus mark (+). Then select a free sub-category and enter your link there. refresh your User Control Panel now  and you will find a \"Bid\" button there near your link to bid and participate in the auction from. </td>";
									//	$display_block .= "</tr>";
									//}
									}//close check if empty
									echo $display_block;
									//now work the lin info
									
									$website_id = mysqli_real_escape_string($connect, $website_id);
									
									$sql = "SELECT * FROM `links` WHERE id ='$website_id'";
									
									$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 561 Account' query");
									do
									{
									$url = $row['url'];
									
									$name = $row['name']; 
									$url = $row['url']; 
									
									$description = $row['description']; 
									$approved = $row['approved']; 
									//2bd see dev notes $regional_number = $row['regional_number']; 
									$street = $row['street'];
									$zip = $row['zip'];
									$phone = $row['phone'];
									}while ($row = mysqli_fetch_array($result));
//did a quick seems like correction to pull this data from regional signups instead of links
$sql = "SELECT * FROM `regional_sign_ups` WHERE link_id ='$website_id'";
									
									$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 579 Account' query");
									do
									{									
									$continents = $row['continents'];
									$countries = $row['countries'];
									$states = $row['states'];
									$districts = $row['districts'];
									$cities = $row['cities'];
								}while ($row = mysqli_fetch_array($result));
									?>
								</tr>
								<table border="1" cellpadding="4" cellspacing="4" style="border-collapse: collapse" bordercolor="#FFFFFF"  id="member">
									<tr>
										<td width="14%" align="right"><b><font size="2">Homepage URL</font></b></td>
										<td>&nbsp;<b><font size="2">
										<input style="width: 300px" type="text" name="url" value="<?echo $url;?>" ></font></b>
								</td>			  
							</tr>
							<tr>
								<td width="14%" align="right"><font size="2"><b>TITLE </b></font></td>
								<td ><b><font size="2">
										<input style="width: 300px" type="text" name="name" value="<?echo $name;?>" ></font></b></td>
								<tr>
									<td width="14%" align="right"><font size="2"><b>DESCRIPTION </b></font></td>
									<td><b><font size="2">&nbsp;&nbsp;Descriptions limited to max 255 characters.
										<textarea rows="4" style="width: 300px" name="description" cols="40"><?echo $description;?></textarea></font></b>
							</td></tr>
						<tr><td  align="right" colspan="2">
<?
if($cat_id_orig != ""){
$get_parent_of_cat = $cat_id_orig;}
elseif($cat_id_new_selected != ""){
$get_parent_of_cat = $cat_id_new_selected;}
$query = "SELECT `parent`FROM `categories`WHERE `id` = '$get_parent_of_cat'  ";
$result = mysqli_query($connect, $query);
while($row = mysqli_fetch_array($result)){									
$current_cat_parent= $row['parent'];}
if($current_cat_parent ==""){
$current_cat_parent = 1;}
?>
	<p><h4><a href="Http://Bungeebones.com/members/reg_form_modify.php?website_id=<?echo $website_id;?>&cat_id_new_selected=<? echo $current_cat_parent;?>">To Get Selections From The Next Higher Category Click Here</a></a></h4></p>
	</td></tr></table>
<tr><td colspan="11" width="80%" align="center" bgcolor="#A4C8E4">
	<h2><font color="#FF0000">OPTIONAL REGIONAL FILTER SELECTION</font></h2>
	Select Regional Filters <u>ONLY</u> if they make sense for your product or service. Otherwise, please skip this option.
	<br />If you do use this feature please be sure to choose from each dropdown.
	</td></tr>

<? 
if(!$continents=="" || !$countries==""|| !$states=="" || !$cities=="" )	{
?>
<tr><td colspan="11" width="80%" align="center" bgcolor="#A4C8E4" style="color:red;">
You have already made the following regional selections. <br />Selecting from the dropdowns will edit/change your listed location(s).<br />
<table id="member" width="70%"><tr>
<?
$RegCatInfo= new regional_filters;
if(isset($continents)){$continent_name = $RegCatInfo->getRegCatName($continents);
echo'<td style="text-align: center;" width= "20%">'. $continent_name . '</td>';}
else{echo'<td width="20%">&nbsp;</td>';}if(isset($countries)){$country_name = $RegCatInfo->getRegCatName($countries);									
echo'<td style="text-align: center;" width= "20%">' . $country_name . '</td>';}																	
else{echo'<td width="20%">&nbsp;</td>';}
if(isset($states)){$state_name = $RegCatInfo->getRegCatName($states);							
echo'<td style="text-align: center;" width= "20%">' . $state_name . '</td>';}
else{echo'<td width="20%">&nbsp;</td>';}																								
if(isset($cities)){$city_name = $RegCatInfo->getRegCatName($cities);
echo'<td style="text-align: center;" width= "20%">' . $city_name . '</td>';}
else{echo'<td width="20%">&nbsp;</td>';}		
echo"</tr></table>";
?>
</td></tr>
<?	  }
?>

<tr> <td colspan="11" width="80%" align="center" bgcolor="#A4C8E4">
<?
 //2bd see dev notes $file2="http://Bungeebones.com/members/continent_drop_down_for_reg_form.php/$website_id/$url_cat/$cat_record_num/$cat_page_total/$cat_page_id/$link_page_id/$link_page_total/$link_record_num/$regional_number";
$file2="http://Bungeebones.com/members/continent_drop_down_for_reg_form.php/$website_id/$url_cat/$cat_record_num/$cat_page_total/$cat_page_id/$link_page_id/$link_page_total/$link_record_num";
		
$ch2 = curl_init();
	curl_setopt($ch2, CURLOPT_URL, $file2);
	curl_setopt($ch2, CURLOPT_HEADER, 0);
	curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
	$data4 = curl_exec($ch2);
	curl_close($ch2);
	echo($data4);
	//$_SESSION['views'] = 1; // store session data
unset($_SESSION['views']); 


?>
	</td></tr><tr><td>
			<h2>Add More Company Info</h2>
			<p align="left">Attention: If you fail to select from all four dropdowns (continent, country, state, city) then your business address and phone number will not be displayed.
			<p align="left">Once you have selected from each drop down the address and telephone number are still optional.
			<p align="left">Add Your Company Street Address <input style="width: 200px" type="text" class="box" name="street" value="<?echo $street;?>" >
			<p align="left">Add Your Company Postal Code <input type="text"style="width: 100px" class="box" name="zip" value="<?echo $zip;?>" >
			<p align="left">Add Your Company Phone Number<input type="text" style="width: 100px" class="box" name="phone" value="<?echo $phone;?>" >
			</td></tr></table><br />
<input type="submit" value="Save" name="B1"><input type="reset" value="Cancel" name="B2"></p>
</form><p>&nbsp;</p><p>&nbsp;</p>
<h3><a href="index.php">Return To Your User Control Panel</a></h3><p>&nbsp;</p><p>&nbsp;</p>
	<?
// include($_SERVER['DOCUMENT_ROOT']."/members/templatebottomnsb.php");


include('../960bottom.php');


}//closes main else
	
} else {
    // the user is not logged in...

    include("views/not_logged_in.php");
}

?>	
