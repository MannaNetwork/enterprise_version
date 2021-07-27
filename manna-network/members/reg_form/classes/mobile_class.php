<?php   class mobile 
   {
//dev nots - I did my first joins throughout this class but this class can be called from who knows where. Won't be able to test untill see regional related errors that we can trace back to here.
//If Any occur, then look fior the same or similar error in rest of class too

   var $link_id;
   var $BB_user_IDe;
   var $cat_id;
   var $displayBlockPaid;
   var $displayBlockFree;
   var $send_array;
   var $db_idf;
   var $db_categoryf;
   var $db_freebief;
   var $db_urlf;
   var $db_descriptionf;
   var $db_start_clone_datef;
   var $db_approvedf;
   var $db_namef;
var $folder_name;
var $file_name;
var $affiliate_num;
var $time_period;
var $alphamenu;

function updateCatPopsText($cat_id, $time_period, $regional_num, $regional_level){


$cat_group = $this->getCatGroup($cat_id,  "8");
if(is_array($cat_group)){
}
if(count($cat_group)>0 AND $cat_group!=false){;
$cat_group_string = implode(",", $cat_group);
$cat_group_pops = $this->getCatGroupPops($cat_id, $val, "continent");
$cat_group_pops_string = implode(",", $cat_group_pops);
$cat_sub_group_pops = $this->getCatSubGroupPops($cat_id, $val, "continent");
$cat_sub_group_pops_string = implode(",", $cat_sub_group_pops);
$cat_group_array = array($cat_group, $cat_group_pops, $cat_group_sub_pops);
return $cat_group_array;
}
else
{
return false;
}
}

function getCatGroup($parent_id, $time_period){
	
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$parent_id = mysqli_real_escape_string($connect, $parent_id);
 $query = "SELECT * FROM `categories` WHERE `parent`= '".$parent_id."'  ORDER BY `name` ASC   ";
$num_rows=mysqli_num_rows;
if($num_rows>0){	
$result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_array($result)){
	$cat_group[] = $row['id'];
	           }
return $cat_group;
}
else
{
return false;
}
}


function getCatGroupPops($cat_id, $regional_num, $regional_level){
//incomplete function - regional number only selects from continents

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");


if($regional_level == "continent"){
$search_reg_col = "continent";
}elseif($regional_level == "country"   ){
$search_reg_col = "country";
}elseif($regional_level == "state"   ){
$search_reg_col = "state";
}elseif($regional_level == "city"   ){
$search_reg_col = "city";
}elseif($regional_level == "district1"   ){
$search_reg_col = "district1";
}elseif($regional_level == "district2"   ){
$search_reg_col = "district2";
}
$cat_id = mysqli_real_escape_string($connect, $cat_id);
$query = "SELECT * FROM `categories` WHERE `parent`= '".$cat_id."'  ORDER BY `name` ASC  ";
$result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_array($result)){
	if($regional_num >1){ 
		$query2 = "SELECT * FROM regional_sign_ups
LEFT JOIN links ON links.id = regional_sign_ups.link_id
WHERE links.category = ".$row['id']." AND ".$search_reg_col."`= ". $regional_num;	  
}
else
{
 $query2 = "SELECT * FROM `links` WHERE `category` = ".$row['id'];
}

$result2 = mysqli_query($connect, $query2);
if($result2){
$num_rows=mysqli_num_rows($result2); 

$cat_group_pops[] = $num_rows;
  }
else
{
$cat_group_pops[] = 0;

}  

}
return $cat_group_pops;
}

function getCatSubGroupPops($parent_id, $regional_num, $regional_level){
//incomplete function - regional number only selects from continents

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

if($regional_level == "continent"){
$search_reg_col = "continent";
}elseif($regional_level == "country"   ){
$search_reg_col = "country";
}elseif($regional_level == "state"   ){
$search_reg_col = "state";
}elseif($regional_level == "district1"   ){
$search_reg_col = "district1";
}elseif($regional_level == "district2"   ){
$search_reg_col = "district2";
}elseif($regional_level == "city"   ){
$search_reg_col = "city";
}
$parent_id =  mysqli_real_escape_string($connect, $parent_id);
$query = "SELECT `id`, `name`, `lft`,`rgt`  FROM `categories` WHERE `parent`= '".$parent_id."'  ORDER BY `name` ASC   ";

$result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_array($result)){
	//echo '<br>id = ', $row['id'];
if(!isset($cat_sub_group_pops[$row['id']])){

$cat_sub_group_pops[$row['id']]="0";//makes sure categories with no subcategories still get counted and a spaceholder in the array

}
$query2 = 'SELECT `id`,`lft`,`rgt` FROM `categories` WHERE `lft` >'.$row['lft'].' AND `rgt` < '.$row['rgt'];

$result2 = mysqli_query($connect, $query2);
	
while($row2 = mysqli_fetch_array($result2)){



if($regional_num >1){ 
	  
$query3 = "SELECT * FROM `links` WHERE `category` = ".$row2['id'] . " AND `".$search_reg_col."`= ".  $regional_num;

}
else
{
 $query3 = "SELECT * FROM `links` WHERE `category` = ".$row2['id'];
}

$result3 = mysqli_query($connect, $query3);
if($result3){
$num_rows=mysqli_num_rows($result3); 

$cat_sub_group_pops[$row['id']] = $cat_sub_group_pops[$row['id']] + $num_rows;
  }

}  

}//close first while

return $cat_sub_group_pops;
}//close function



function getSameCatName($cat_name){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
              	$query = "SELECT `id` FROM `categories` WHERE `name` = '$cat_name' ";
           //   echo 'query = ', $query;
              $result = mysqli_query($connect, $query);
                if($result){
								 while($row = mysqli_fetch_array($result))
								 {
              	$id[] = $row['id'];
              			}
              	return $id;
								}
								else
								{
								return false;
              }
		}   

function getRegionName($region_id){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
              	$query = "SELECT `name` FROM `categories_regional2` WHERE `id` = '$region_id' ";

   $result = mysqli_query($connect, $query);
                if($result){
								 while($row = mysqli_fetch_array($result))
								 {
              	
              	
$name = $row['name'] . '</span>';		}
              	return $name;
								}
								else
								{
								return false;
              }
		}   
function regionPath($catid, $regional_number){
	global $settings, $cat_page_num,$cat_page_id,$cat_record_num,$link_page_id, $link_page_num, $link_record_num;

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$folder_name="members/reg_form";
$file_name="index.php";
$affiliate_num = '2338';
	$path = '';
$regional_number = mysqli_real_escape_string($connect, $regional_number);
	$query = "SELECT `lft`,`rgt` FROM `categories_regional2` WHERE `id`='".$regional_number."'";
//echo $query;	
$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);
	$lft = $row['lft'];
	$rgt = $row['rgt'];
	$query = 'SELECT `name`,`id` FROM `categories_regional2` WHERE `lft` <= '.$lft.' AND `rgt` >= '.$rgt.' ORDER BY `lft` ASC;';
//echo '<br>', $query;	
$result = mysqli_query($connect,$query);
	while($row = @mysqli_fetch_array($result)){
//echo '<br> $rowid = ', $row['id'];
//echo '<br> $rowname = ', $row['name'];
		if($row['id'] != '1')
//$path .= $settings['nav_separator'].'<a href="/'.$folder_name.'/'.$file_name.'/'.$row['id'].'/'.$regional_number.'/'.$cat_page_id.'/&nbsp;/'.$cat_record_num.'">'.$row['name'].'</a>';
$path[]=$row['name'];	
}
	return $path;
}

function regionPathnums($regional_number){
	global $settings, $cat_page_num,$cat_page_id,$cat_record_num,$link_page_id, $link_page_num, $link_record_num;

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$folder_name="members/reg_form";
$file_name="index.php";
$affiliate_num = '2338';
	$path = '';

//echo '$regional_number in mobile class 254 = ', $regional_number;
$regional_number = mysqli_real_escape_string($connect, $regional_number);
	$query = "SELECT `lft`,`rgt` FROM `categories_regional2` WHERE `id`='".$regional_number."'";
//echo $query;	
$result = mysqli_query($connect,$query);
	$row = mysqli_fetch_array($result);
	$lft = $row['lft'];
	$rgt = $row['rgt'];
	$query = 'SELECT `id` FROM `categories_regional2` WHERE `lft` <= '.$lft.' AND `rgt` >= '.$rgt.' ORDER BY `lft` ASC;';
//echo '<br>', $query;	
$result = mysqli_query($connect, $query);
	while($row = @mysqli_fetch_array($result)){
//echo '<br> $rowid = ', $row['id'];
//echo '<br> $rowname = ', $row['name'];
		if($row['id'] != '1')
//$path .= $settings['nav_separator'].'<a href="/'.$folder_name.'/'.$file_name.'/'.$row['id'].'/'.$regional_number.'/'.$cat_page_id.'/&nbsp;/'.$cat_record_num.'">'.$row['name'].'</a>';
$path[]=$row['id'];	
}
	return $path;
}
function getCatName($id){

	global $settings;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$id = mysqli_real_escape_string($connect, $id);
	$query = "SELECT `name` FROM `categories` WHERE `id`='".$id."'";

	$result = mysqli_query($connect, $query);

	$row = mysqli_fetch_row($result);

	return $row[0];

}


function categoryPathDisplay($catid){
	global $settings, $cat_page_num,$cat_page_id,$cat_record_num,$link_page_id, $link_page_num, $link_record_num;

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$folder_name="members/reg_form";
$file_name="index.php";
$affiliate_num = '2338';
	$path = '';
$catid = mysqli_real_escape_string($connect, $catid);
	$query = "SELECT `lft`,`rgt` FROM `categories` WHERE `id`='".$catid."'";

$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);
	$lft = $row['lft'];
	$rgt = $row['rgt'];
	$query = 'SELECT `name`,`id` FROM `categories` WHERE `lft` <= '.$lft.' AND `rgt` >= '.$rgt.' ORDER BY `lft` ASC;';
	
$result = mysqli_query($connect, $query);
	while($row = @mysqli_fetch_array($result)){
		if($row['id'] != '1')
$path .= $row['name'].'->';
	}
	return $path;
}


function categoryPath($catid, $regional_number){
	global $settings, $cat_page_num,$cat_page_id,$cat_record_num,$link_page_id, $link_page_num, $link_record_num;

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$folder_name="members/reg_form";
$file_name="index.php";
$affiliate_num = '2338';
	$path = '';
$catid = mysqli_real_escape_string($connect, $catid);
	$query = "SELECT `lft`,`rgt` FROM `categories` WHERE `id`='".$catid."'";

$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);
	$lft = $row['lft'];
	$rgt = $row['rgt'];
	$query = 'SELECT `name`,`id` FROM `categories` WHERE `lft` < '.$lft.' AND `rgt` > '.$rgt.' ORDER BY `lft` ASC;';
	
$result = mysqli_query($connect, $query);
	while($row = @mysqli_fetch_array($result)){
		if($row['id'] != '1')
$path .= $settings['nav_separator'].'<a href="/'.$folder_name.'/'.$file_name.'/'.$row['id'].'/'.$regional_number.'/'.$cat_page_id.'/&nbsp;/'.$cat_record_num.'">'.$row['name'].'</a>';
	}
	return $path;
}

function categoryPathforNav($catid, $regional_number){
	global $settings, $cat_page_num,$cat_page_id,$cat_record_num,$link_page_id, $link_page_num, $link_record_num;

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$folder_name="members/reg_form";
$file_name="index.php";
$affiliate_num = '2338';
	$path = '';
$catid = mysqli_real_escape_string($connect, $catid);
	$query = "SELECT `lft`,`rgt` FROM `categories` WHERE `id`='".$catid."'";

$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);
	$lft = $row['lft'];
	$rgt = $row['rgt'];
	$query = 'SELECT `name`,`id` FROM `categories` WHERE `lft` < '.$lft.' AND `rgt` > '.$rgt.' ORDER BY `lft` ASC;';
	
$result = mysqli_query($connect, $query);
	while($row = @mysqli_fetch_array($result)){
		if($row['id'] != '1'){
if($regional_number !=""){
$path .= $settings['nav_separator'].'<a href="/'.$folder_name.'/'.$file_name.'/'.$row['id'].'/'.$regional_number.'">'.$row['name'].'</a>';
}
else
{
$path .= $settings['nav_separator'].'<a href="/'.$folder_name.'/'.$file_name.'/'.$row['id'].'">'.$row['name'].'</a>';

}

	}
}
	return $path;
}
function categoryPathfordisplay($catid, $regional_number){
	global $settings, $cat_page_num,$cat_page_id,$cat_record_num,$link_page_id, $link_page_num, $link_record_num;

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$folder_name="members/reg_form";
$file_name="index.php";
$affiliate_num = '2338';
	$path = '';
$catid = mysqli_real_escape_string($connect, $catid);
	$query = "SELECT `lft`,`rgt` FROM `categories` WHERE `id`='".$catid."'";
	
$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);
	$lft = $row['lft'];
	$rgt = $row['rgt'];
	$query = 'SELECT `name`,`id` FROM `categories` WHERE `lft` <= '.$lft.' AND `rgt` >= '.$rgt.' ORDER BY `lft` ASC;';
	
$result = mysqli_query($connect, $query);
	while($row = @mysqli_fetch_array($result)){
		if($row['id'] != '1')
$path .= $settings['nav_separator'].'<a href="/'.$folder_name.'/'.$file_name.'/'.$row['id'].'/'.$regional_number.'/'.$cat_page_id.'/&nbsp;/'.$cat_record_num.'">'.$row['name'].'</a>';
	}
	return $path;
}
function alphamenu($catid){
	global $settings, $cat_page_num,$cat_page_id,$cat_record_num,$link_page_id, $link_page_num, $link_record_num;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$alphamenu = '';

$folder_name ="members/reg_form";
$file_name = "index.php";
$affiliate_num =  '2353';
$time_period = '8';
$amm = $settings['amm'];
$page_counter = '0';
$contr=0;
$catid = mysqli_real_escape_string($connect, $catid);
	$query = "SELECT `id`,`name`,`lft`,`rgt` FROM `categories` WHERE `parent`='".$catid."' ORDER BY `name` ASC ";
		$result = mysqli_query($connect, $query);
while ($row = mysqli_fetch_array($result)) 
{
      if(isset($contr))
      {
      $test_contr = $contr/($amm);
               if(is_int($test_contr))
            {
			 $page_counter = $page_counter + 1;
			 $contr = 0;
             }
      }
$id = $row['id'];
$name = $row['name'];
$sublnth = $settings['substrlength'];//gets length to strip string to from config
$name = substr($name, 0, $sublnth);//strip string to length
 $lft = $row['lft'];
 $rgt = $row['rgt'];

 $params = 0;
 $menupage[$page_counter][$contr][$params] = $id;
$menupage[$page_counter][$contr][$params + 1] = $name;
$menupage[$page_counter][$contr][$params + 2] = $lft;
$menupage[$page_counter][$contr][$params + 3] = $rgt;
//$munuarray[]= $menupage[$page_counter][$contr];
$nxt1_id_num=$menupage[$page_counter][$contr][0];//0 gets the ID num for entry in link url
$nxt1idnum[$contr]= $nxt1_id_num;//enters each id num in array for its page
$comma_values = array_values($nxt1idnum);
$comma_separated[$page_counter] = implode(",", $comma_values);
$contr = $contr + 1 ;
$total_counter = $total_counter + 1;
}
$alphamenu = $menupage;
	return $alphamenu;
}

function totalCatpages($cat_id){ 
global $settings; 
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
 $catid = mysqli_real_escape_string($connect, $cat_id);
$query = "SELECT * FROM `categories` WHERE `parent`='".$cat_id."'"; 

$result = mysqli_query($connect, $query); 
$totalrows_cats= mysqli_num_rows($result); 
$cat_page_total= ceil($totalrows_cats/$settings['amm']);
return $cat_page_total;
}


function listCategories($url_cat,$regional_number){
	global $settings, $folder_name, $file_name, $affiliate_num, $cat_page_num,$cat_page_id,$cat_record_num,$link_page_id, $link_page_num, $link_record_num, $time_period;
 
	 	 
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$folder_name ="members/reg_form";
$file_name = "index.php";
$affiliate_num = '2338';
$time_period =  '8';
//nned to find, if array(i.e. if continet) 
//and then explode into pieces if is


//add these eventueally, perhaps put them all in an array called "alpha_pager_vars and clean up the link
//$cat_page_num,$cat_page_id,$cat_record_num,$link_page_id, $link_page_num, $link_record_num
	





If($cat_record_num == 'true'){
	$select_id = $cat_record_num; 
	}
	else
	{
	$select_id = $url_cat;
	}

$catData = new mobile;

$totalCatpages = $catData->totalCatpages($url_cat);	


		//$totalCatpages=totalCatpages($url_cat);
		
			 if($totalCatpages>1 && $url_cat != 1){
						If($cat_page_id > 1)
							{
									//$cat_page_id = the cuurent page - if the current page is greater
									//than one, place a limit in the query to get the right page
$select_id = mysqli_real_escape_string($connect, $select_id);
$limit = mysqli_real_escape_string($connect, ($cat_page_id - 1)* $settings['amm'] );	
$amm = mysqli_real_escape_string($connect, $settings['amm']);						

 $query = 'SELECT * FROM `categories` WHERE `parent`= "'.$select_id.'  "ORDER BY `name` ASC LIMIT '.$limit.','.$amm.'   ';
								$result = mysqli_query($connect, $query);
							include('alpha_pager.php');
							}
							else//place a limit in the query to get the first page
							{
	$select_id = mysqli_real_escape_string($connect, $select_id);	
$amm = mysqli_real_escape_string($connect, $settings['amm']);										$query = "SELECT * FROM `categories` WHERE `parent`= '".$select_id."'  ORDER BY `name` ASC LIMIT 0,'".$amm."'   ";
							$result = mysqli_query($connect, $query);
							include('alpha_pager.php');
					}//ends 2nd if
			}
			else//means there is only one page worth of cats
			//do a query that retrieves all the records in that cat with no limit
			{ 
			$select_id = mysqli_real_escape_string($connect, $select_id);
			$query = "SELECT * FROM `categories` WHERE `parent` = '".$select_id."'  ORDER BY `name` ASC   ";
			$result = mysqli_query($connect, $query);
			}						
		while($row = mysqli_fetch_array($result)){
		$id[] = $row['id'];
		$name[] = $row['name'];
		$population[] = $row['population'];
		//$sub_population[] = $row['sub_population'];
		$pop_cont[] = $row['pop_cont'];
		$pop_country[] = $row['pop_country'];
		$pop_state[] = $row['pop_state'];
		$pop_city[] = $row['pop_city'];
		}
	//build the category display
	$num_rows = mysqli_num_rows($result);
	if($num_rows > 0){//build cat_info var for display
		$cats = "<table  align='center' width='100%' border='0'><tr align='center'><td align='left' width='50%' valign='top'>	<ul>";
	if($num_rows % 2){
		$divnum = $num_rows+1;
	} else {
		$divnum = $num_rows;
	}

	for($i=0; $i < $num_rows; $i++){
		if($i == $divnum/2){
			$cats .= '</ul></td><td width="50%" align="left" valign="top"><ul>';








}

if(is_numeric($regional_number)){	
//means there is no pipe separated val and thus is a continent	
$sql="SELECT `link_id`
FROM regional_sign_ups
LEFT JOIN links ON links.id = regional_sign_ups.link_id
WHERE links.category = $id[$i] AND regional_sign_ups.continent = ".$regional_number_val[0];
}
elseif(!$regional_number=="")
{
$regional_number_val = explode("|", $regional_number);
		if($regional_number_val[1]=="city"){
		$sql="SELECT `link_id`
FROM regional_sign_ups
LEFT JOIN links ON links.id = regional_sign_ups.link_id
WHERE links.category = $id[$i] AND regional_sign_ups.city = ".$regional_number_val[0];
	}elseif($regional_number_val[1]=="district1"){
		//$sql="SELECT `id` from `links`where `category` = ".$id[$i]." AND `districts` = ".$regional_number_val[0];
		$sql="SELECT `link_id`
FROM regional_sign_ups
LEFT JOIN links ON links.id = regional_sign_ups.link_id
WHERE links.category = $id[$i] AND regional_sign_ups.district1 = ".$regional_number_val[0];
		}
elseif($regional_number_val[1]=="district2"){
		//$sql="SELECT `id` from `links`where `category` = ".$id[$i]." AND `districts` = ".$regional_number_val[0];
		$sql="SELECT `link_id`
FROM regional_sign_ups
LEFT JOIN links ON links.id = regional_sign_ups.link_id
WHERE links.category = $id[$i] AND regional_sign_ups.district2 = ".$regional_number_val[0];
		}



elseif($regional_number_val[1]=="state"){
		//$sql="SELECT `id` from `links`where `category` = ".$id[$i]." AND `states` = ".$regional_number_val[0];
		$sql="SELECT `link_id`
FROM regional_sign_ups
LEFT JOIN links ON links.id = regional_sign_ups.link_id
WHERE links.category = $id[$i] AND regional_sign_ups.state = ".$regional_number_val[0];
		}elseif($regional_number_val[1]=="country"){
		//$sql="SELECT `id` from `links`where `category` = ".$id[$i]." AND `countries` = ".$regional_number_val[0];
		$sql="SELECT `link_id`
FROM regional_sign_ups
LEFT JOIN links ON links.id = regional_sign_ups.link_id
WHERE links.category = $id[$i] AND regional_sign_ups.country = ".$regional_number_val[0];
		}
}
else{//try this because it is not regional
$sql="SELECT `id` from `links`where `category` = ".$id[$i];
}

 $result = mysqli_query($connect, $sql);
if($result){
$num_rows2 = mysqli_num_rows($result);
}

		//this is where the AJAX population action needs to occur
		$npopulation= explode(",",$population[$i]);
		//$nsub_population= explode(",",$sub_population[$i]);
		$time_period_adjust = ($time_period - 1) * 2;

if(!$regional_number==""){
$cats .= '<li><font size="2"><strong><a href="/'.$folder_name.'/'.$file_name.'/'.$id[$i].'/'.$regional_number.'/'.$cat_page_id.'/&nbsp;/'.$cat_record_num.'">'.$name[$i].'</a></strong></font><i><small>(<font id="c'.$id[$i].'">'.$num_rows2.'</font>)</small></i>';
}
else{
$cats .= '<li><font size="2"><strong><a href="/'.$folder_name.'/'.$file_name.'/'.$id[$i].'">'.$name[$i].'</a></strong></font><i><small>(<font id="c'.$id[$i].'">'.$num_rows2.'</font>)</small></i>';
}
$test_second_pop = $npopulation[$time_period_adjust+1] ;


If($test_second_pop > 0){
		$cats .= '<i><small>(<font id="sc'.$id[$i].'">'.$test_second_pop.'</font>)</small></i>';
		}
		$cats .= '</li>';
//change id[] to name[] to get name into directory category list urls
	}
	$cats .= '</ul></td></tr></table>';
}//close if result
else
{
$cats = "false";
}
return $cats;
}



   function getLinks($cat_id, $regional_number){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
if(is_numeric($regional_number)){
  $query = "SELECT *
FROM regional_sign_ups
LEFT JOIN links ON links.id = regional_sign_ups.link_id
WHERE links.category = $cat_id AND regional_sign_ups.continent = $regional_number";
}
elseif($regional_number!=""){
$regional_array = explode("|", $regional_number);
	if($regional_array[1]=="city")
	{
 $query = "SELECT *
FROM regional_sign_ups
LEFT JOIN links ON links.id = regional_sign_ups.link_id
WHERE links.category = $cat_id AND regional_sign_ups.city = $regional_array[0]";
	}
	elseif($regional_array[1]=="district1")
	{
	 $query = "SELECT *
FROM regional_sign_ups
LEFT JOIN links ON links.id = regional_sign_ups.link_id
WHERE links.category = $cat_id AND regional_sign_ups.district1 = $regional_array[0]";

	}
elseif($regional_array[1]=="district2")
	{
	 $query = "SELECT *
FROM regional_sign_ups
LEFT JOIN links ON links.id = regional_sign_ups.link_id
WHERE links.category = $cat_id AND regional_sign_ups.district2 = $regional_array[0]";

	}
	elseif($regional_array[1]=="state")
	{
	 $query = "SELECT *
FROM regional_sign_ups
LEFT JOIN links ON links.id = regional_sign_ups.link_id
WHERE links.category = $cat_id AND regional_sign_ups.state = $regional_array[0]";
	}
	elseif($regional_array[1]=="country")
	{
 $query = "SELECT *
FROM regional_sign_ups
LEFT JOIN links ON links.id = regional_sign_ups.link_id
WHERE links.category = $cat_id AND regional_sign_ups.country = $regional_array[0]";
	}
}else
{
//is not regional
 $query = "SELECT * FROM `links` WHERE `category`= ".$cat_id." AND `approved`='true'";
}
//echo '<br>line 729 mobile class regform/classes ', $query;
  $result = @mysqli_query($connect, $query) or die("<h1><font color='red'>Couldn't execute query-  mobile class get regional Links<br> ". $query);
   while ($row = mysqli_fetch_array($result)){
$orig_id[] = $row['id'];//0
$orig_BB_user_ID[] = $row['BB_user_ID'];//1
$orig_category[] = $row['category'];//2
$orig_url[] = $row['url'];//3
$orig_name[] = $row['name'];//4
$orig_description[] = $row['description'];//5
$orig_start_date[] = $row['start_date'];//17
 }
   //$send_array = array( $link_id,  $link_url,  $link_description,  $link_name);
 $send_array = array( $orig_id, $orig_BB_user_ID, $orig_category,$orig_url,$orig_name,$orig_description,$orig_start_date);
 return $send_array;
   }
}//close class
?>
