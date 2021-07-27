<?php   class mobile 
   {

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


function getCatGroup($parent_id, $time_period){
	
include($_SERVER['DOCUMENT_ROOT']."/cp_demo/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/cp_demo/connect.php");
 $query = 'SELECT * FROM `categories` WHERE `parent`= "'.mysql_escape_string($parent_id).'  "ORDER BY `name` ASC   ';
	$result = mysql_query($query, $connect);
	while($row = mysql_fetch_array($result)){
	$cat_group[] = $row['id'];
	           }
return $cat_group;
}


function getCatGroupPops($parent_id, $regional_num, $regional_level){
//incomplete function - regional number only selects from continents

include($_SERVER['DOCUMENT_ROOT']."/cp_demo/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/cp_demo/connect.php");


if($regional_level == "con"){
$search_reg_col = "continents";
}elseif($regional_level == "cou"   ){
$search_reg_col = "countries";
}elseif($regional_level == "sta"   ){
$search_reg_col = "states";
}elseif($regional_level == "dis"   ){
$search_reg_col = "districts";
}elseif($regional_level == "cit"   ){
$search_reg_col = "cities";
}

$query = 'SELECT * FROM `categories` WHERE `parent`= "'.mysql_escape_string($parent_id).'  "ORDER BY `name` ASC   ';
$result = mysql_query($query, $connect);
	while($row = mysql_fetch_array($result)){
	if($regional_num >1){ 
	  
$query2 = "SELECT * FROM `links` WHERE `category` = ".$row['id'] . " AND `".$search_reg_col."`= ". $regional_num;;

}
else
{
 $query2 = "SELECT * FROM `links` WHERE `category` = ".$row['id'];
}

$result2 = mysql_query($query2, $connect);
if($result2){
$num_rows=mysql_num_rows($result2); 

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

include($_SERVER['DOCUMENT_ROOT']."/cp_demo/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/cp_demo/connect.php");

if($regional_level == "con"){
$search_reg_col = "continents";
}elseif($regional_level == "cou"   ){
$search_reg_col = "countries";
}elseif($regional_level == "sta"   ){
$search_reg_col = "states";
}elseif($regional_level == "dis"   ){
$search_reg_col = "districts";
}elseif($regional_level == "cit"   ){
$search_reg_col = "cities";
}
$query = 'SELECT `id`, `name`, `lft`,`rgt`  FROM `categories` WHERE `parent`= '.mysql_escape_string($parent_id).'  ORDER BY `name` ASC   ';

$result = mysql_query($query, $connect);
	while($row = mysql_fetch_array($result)){
	//echo '<br>id = ', $row['id'];
if(!isset($cat_sub_group_pops[$row['id']])){

$cat_sub_group_pops[$row['id']]="0";//makes sure categories with no subcategories still get counted and a spaceholder in the array

}
$query2 = 'SELECT `id`,`lft`,`rgt` FROM `categories` WHERE `lft` >'.$row['lft'].' AND `rgt` < '.$row['rgt'];

$result2 = mysql_query($query2, $connect);
	
while($row2 = mysql_fetch_array($result2)){



if($regional_num >1){ 
	  
$query3 = "SELECT * FROM `links` WHERE `category` = ".$row2['id'] . " AND `".$search_reg_col."`= ".  $regional_num;;

}
else
{
 $query3 = "SELECT * FROM `links` WHERE `category` = ".$row2['id'];
}

$result3 = mysql_query($query3, $connect);
if($result3){
$num_rows=mysql_num_rows($result3); 

$cat_sub_group_pops[$row['id']] = $cat_sub_group_pops[$row['id']] + $num_rows;
  }

}  

}//close first while

return $cat_sub_group_pops;
}//close function



function getSameCatName($cat_name){
include($_SERVER['DOCUMENT_ROOT']."/cp_demo/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/cp_demo/connect.php");
              	$query = "SELECT `id` FROM `categories` WHERE `name` = '$cat_name' ";
           //   echo 'query = ', $query;
              $result = mysql_query($query, $connect);
                if($result){
								 while($row = mysql_fetch_array($result))
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
include($_SERVER['DOCUMENT_ROOT']."/cp_demo/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/cp_demo/connect.php");
              	$query = "SELECT `name` FROM `categories_regional2` WHERE `id` = '$region_id' ";

   $result = mysql_query($query, $connect);
                if($result){
								 while($row = mysql_fetch_array($result))
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

include($_SERVER['DOCUMENT_ROOT']."/cp_demo/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/cp_demo/connect.php");

$folder_name="members/reg_form";
$file_name="index.php";
$affiliate_num = '2338';
	$path = '';
	$query = 'SELECT `lft`,`rgt` FROM `categories_regional2` WHERE `id`="'.mysql_escape_string($regional_number).'"';
//echo $query;	
$result = mysql_query($query, $connect);
	$row = mysql_fetch_array($result);
	$lft = $row['lft'];
	$rgt = $row['rgt'];
	$query = 'SELECT `name`,`id` FROM `categories_regional2` WHERE `lft` <= '.$lft.' AND `rgt` >= '.$rgt.' ORDER BY `lft` ASC;';
//echo '<br>', $query;	
$result = mysql_query($query, $connect);
	while($row = @mysql_fetch_array($result)){
//echo '<br> $rowid = ', $row['id'];
//echo '<br> $rowname = ', $row['name'];
		if($row['id'] != '1')
//$path .= $settings['nav_separator'].'<a href="/'.$folder_name.'/'.$file_name.'/'.$row['id'].'/'.$regional_number.'/'.$cat_page_id.'/&nbsp;/'.$cat_record_num.'">'.$row['name'].'</a>';
$path[]=$row['name'];	
}
	return $path;
}


function getCatName($id){

	global $settings;
	include($_SERVER['DOCUMENT_ROOT']."/cp_demo/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/cp_demo/connect.php");

	$query = 'SELECT `name` FROM `categories` WHERE `id`="'.mysql_escape_string($id).'"';

	$result = mysql_query($query, $connect);

	$row = mysql_fetch_row($result);

	return $row[0];

}



function categoryPath($catid, $regional_number){
	global $settings, $cat_page_num,$cat_page_id,$cat_record_num,$link_page_id, $link_page_num, $link_record_num;

include($_SERVER['DOCUMENT_ROOT']."/cp_demo/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/cp_demo/connect.php");

$folder_name="members/reg_form";
$file_name="index.php";
$affiliate_num = '2338';
	$path = '';
	$query = 'SELECT `lft`,`rgt` FROM `categories` WHERE `id`="'.mysql_escape_string($catid).'"';

$result = mysql_query($query, $connect);
	$row = mysql_fetch_array($result);
	$lft = $row['lft'];
	$rgt = $row['rgt'];
	$query = 'SELECT `name`,`id` FROM `categories` WHERE `lft` < '.$lft.' AND `rgt` > '.$rgt.' ORDER BY `lft` ASC;';
	
$result = mysql_query($query, $connect);
	while($row = @mysql_fetch_array($result)){
		if($row['id'] != '1')
$path .= $settings['nav_separator'].'<a href="/'.$folder_name.'/'.$file_name.'/'.$row['id'].'/'.$regional_number.'/'.$cat_page_id.'/&nbsp;/'.$cat_record_num.'">'.$row['name'].'</a>';
	}
	return $path;
}


function categoryPathfordisplay($catid, $regional_number){
	global $settings, $cat_page_num,$cat_page_id,$cat_record_num,$link_page_id, $link_page_num, $link_record_num;

include($_SERVER['DOCUMENT_ROOT']."/cp_demo/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/cp_demo/connect.php");

$folder_name="members/reg_form";
$file_name="index.php";
$affiliate_num = '2338';
	$path = '';
	$query = 'SELECT `lft`,`rgt` FROM `categories` WHERE `id`="'.mysql_escape_string($catid).'"';
	
echo $query;$result = mysql_query($query, $connect);
	$row = mysql_fetch_array($result);
	$lft = $row['lft'];
	$rgt = $row['rgt'];
	$query = 'SELECT `name`,`id` FROM `categories` WHERE `lft` <= '.$lft.' AND `rgt` >= '.$rgt.' ORDER BY `lft` ASC;';
echo $query;	
$result = mysql_query($query, $connect);
	while($row = @mysql_fetch_array($result)){
		if($row['id'] != '1')
$path .= $settings['nav_separator'].'<a href="/'.$folder_name.'/'.$file_name.'/'.$row['id'].'/'.$regional_number.'/'.$cat_page_id.'/&nbsp;/'.$cat_record_num.'">'.$row['name'].'</a>';
	}
	return $path;
}
function alphamenu($catid){
	global $settings, $cat_page_num,$cat_page_id,$cat_record_num,$link_page_id, $link_page_num, $link_record_num;
include($_SERVER['DOCUMENT_ROOT']."/cp_demo/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/cp_demo/connect.php");

$alphamenu = '';

$folder_name ="members/reg_form";
$file_name = "index.php";
$affiliate_num =  '2338';
$time_period = '8';
$amm = $settings['amm'];
$page_counter = '0';
$contr=0;
	$query = 'SELECT `id`,`name`,`lft`,`rgt` FROM `categories` WHERE `parent`="'.mysql_escape_string($catid).'" ORDER BY `name` ASC ';
		$result = mysql_query($query, $connect);
while ($row = mysql_fetch_array($result)) 
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
include($_SERVER['DOCUMENT_ROOT']."/cp_demo/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/cp_demo/connect.php");
 
$query = 'SELECT * FROM `categories` WHERE `parent`="'.mysql_escape_string($cat_id).'"'; 

$result = mysql_query($query, $connect); 
$totalrows_cats= mysql_num_rows($result); 
$cat_page_total= ceil($totalrows_cats/$settings['amm']);
return $cat_page_total;
}


function listCategories($url_cat,$regional_number){
	global $settings, $folder_name, $file_name, $affiliate_num, $cat_page_num,$cat_page_id,$cat_record_num,$link_page_id, $link_page_num, $link_record_num, $time_period;
 
	 	 
include($_SERVER['DOCUMENT_ROOT']."/cp_demo/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/cp_demo/connect.php");
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
							 $query = 'SELECT * FROM `categories` WHERE `parent`= "'.mysql_escape_string($select_id).'  "ORDER BY `name` ASC LIMIT '.mysql_escape_string(($cat_page_id - 1)* $settings['amm'] ).','.mysql_escape_string($settings['amm']).'   ';
								$result = mysql_query($query, $connect);
							include('alpha_pager.php');
					
							}
							else//place a limit in the query to get the first page
							{
									
							 $query = 'SELECT * FROM `categories` WHERE `parent`= "'.mysql_escape_string($select_id).'  "ORDER BY `name` ASC LIMIT 0,'.mysql_escape_string($settings['amm']).'   ';
							$result = mysql_query($query, $connect);
							include('alpha_pager.php');
					
								}//ends 2nd if
			}
			else//means there is only one page worth of cats
			//do a query that retrieves all the records in that cat with no limit
			{ 
			$query = 'SELECT * FROM `categories` WHERE `parent` = "'.mysql_escape_string($select_id).'  "ORDER BY `name` ASC   ';
			
$result = mysql_query($query, $connect);
			}						
	$result = mysql_query($query, $connect);
	while($row = mysql_fetch_array($result)){
		$id[] = $row['id'];
		$name[] = $row['name'];
		$population[] = $row['population'];
		//$sub_population[] = $row['sub_population'];
		$pop_cont[] = $row['pop_cont'];
		$subpop_cont[] = $row['subpop_cont'];
		$pop_country[] = $row['pop_country'];
		$subpop_country[] = $row['subpop_country'];
		$pop_state[] = $row['pop_state'];
		$subpop_state[] = $row['subpop_state'];
		$pop_city[] = $row['pop_city'];
		$subpop_city[] = $row['subpop_city'];
		//maybe change the multiple cats for regionals one  in an array
	}
	///////////////////////
///////////////////
	//build the category display
	$num_rows = mysql_num_rows($result);
	
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
$sql="SELECT `id` from  `links`where `category` = ".$id[$i]." AND `continents` = ".$regional_number;
}
elseif(!$regional_number=="")
{
$regional_number_val = explode("|", $regional_number);
//echo '0 = ', $regional_number_val[0];
//echo '1 = ', $regional_number_val[1];
		if($regional_number_val[1]=="cit"){
		$sql="SELECT `id` from `links`where `category` = ".$id[$i]." AND `cities` = ".$regional_number_val[0];
		}elseif($regional_number_val[1]=="dis"){
		$sql="SELECT `id` from `links`where `category` = ".$id[$i]." AND `districts` = ".$regional_number_val[0];
		}elseif($regional_number_val[1]=="sta"){
		$sql="SELECT `id` from `links`where `category` = ".$id[$i]." AND `states` = ".$regional_number_val[0];
		}elseif($regional_number_val[1]=="cou"){
		$sql="SELECT `id` from `links`where `category` = ".$id[$i]." AND `countries` = ".$regional_number_val[0];
		}
}
else{//try this because it is not regional
$sql="SELECT `id` from `links`where `category` = ".$id[$i];
}

 $result = mysql_query($sql, $connect);
if($result){
$num_rows2 = mysql_numrows($result);
//echo '$num_rows2 =    ', $num_rows2;
}
//echo $sql;
//echo '<br>need numrows syntax ';



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
If($npopulation[$time_period_adjust+1] > 0){

		$cats .= '<i><small>(<font id="sc'.$id[$i].'">'.$num_rows2.'</font>)</small></i>';
		}
		$cats .= '</li>';
//change id[] to name[] to get name into directory category list urls
	}
	$cats .= '</ul></td></tr></table>';
	
	$cats .= "$nav_barf ";
	
	return $cats;
}



   function getLinks($cat_id, $regional_number){
include($_SERVER['DOCUMENT_ROOT']."/cp_demo/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/cp_demo/connect.php");
// echo '<br>regional number is ', $regional_number;
if(is_numeric($regional_number)){
//echo 'is integer works';
   $query = "SELECT * FROM `links` WHERE `category`= ".$cat_id." AND `continents` = ".$regional_number ;
}
elseif(isset($regional_number)){
//echo 'is array works';
$regional_array = explode("|", $regional_number);
//echo '<br>regional array 0 = ', $regional_array[0];
//echo '<br>regional array 1 = ', $regional_array[1];
	if($regional_array[1]=="cit")
	{
	$query = "SELECT * FROM `links` WHERE `category`= ".$cat_id." AND `cities` = ".$regional_array[0] ;
	}
	elseif($regional_array[1]=="dis")
	{
	$query = "SELECT * FROM `links` WHERE `category`= ".$cat_id." AND `district` = ".$regional_array[0] ;
	}
	elseif($regional_array[1]=="sta")
	{
	$query = "SELECT * FROM `links` WHERE `category`= ".$cat_id." AND `states` = ".$regional_array[0] ;
	}
	elseif($regional_array[1]=="cou")
	{
	$query = "SELECT * FROM `links` WHERE `category`= ".$cat_id." AND `countries` = ".$regional_array[0] ;
	}

}else
{
//is not regional
 $query = "SELECT * FROM `links` WHERE `category`= $cat_id";

}
//echo 'get links regional query ', $query;
 


  $result = @mysql_query($query, $connect) or die("<h1><font color='red'>Couldn't execute query-  mobile class getLinks<br> ". $query);
   while ($row = mysql_fetch_array($result)){
$orig_id[] = $row['id'];//0
$orig_BB_user_ID[] = $row['BB_user_ID'];//1
$orig_category[] = $row['category'];//2
$orig_url[] = $row['url'];//3
$orig_name[] = $row['name'];//4
$orig_description[] = $row['description'];//5
$orig_continents[] = $row['continents'];//6

$orig_countries[] = $row['countries'];//7
$orig_states[] = $row['states'];//8
$orig_cities[] = $row['cities'];//9
$orig_street[] = $row['street'];//10
$orig_zip[] = $row['zip'];//11
$orig_phone[] = $row['phone'];//12
$orig_invoice_sent[] = $row['invoice_sent'];//13
$orig_invoice_paid[] = $row['invoice_paid'];//14
$orig_freebie[] = $row['freebie'];//15
$orig_display_freebies[] = $row['display_freebies'];//16
$orig_start_date[] = $row['start_date'];//17
$orig_time_period[] = $row['time_period'];//18
$orig_peer_rating[] = $row['peer_rating'];//19
$orig_peer_vote_count[] = $row['peer_vote_count'];//20
$orig_public_rating[] = $row['public_rating'];//21
$orig_public_vote_count[] = $row['public_vote_count'];//22
$orig_start_clone_date[] = $row['start_clone_date'];//23
$orig_folder_name[] = $row['folder_name'];//24
$orig_file_name[] = $row['file_name'];//25
$orig_approved_build[] = $row['approved_build'];//26
$orig_custom_title1[] = $row['custom_title1'];//27
$orig_custom_title2[] = $row['custom_title2'];//28
$orig_click_tally[] = $row['click_tally'];//29

 }
   //$send_array = array( $link_id,  $link_url,  $link_description,  $link_name);

 $send_array = array( $orig_id, $orig_BB_user_ID, $orig_category,$orig_url,$orig_name,$orig_description,$orig_continents,$orig_countries,$orig_states,$orig_cities,$orig_street,$orig_zip,$orig_phone,$orig_invoice_sent,$orig_invoice_paid,$orig_freebie,$orig_display_freebies,$orig_start_date,$orig_time_period,$orig_peer_rating,$orig_peer_vote_count,$orig_public_rating,$orig_public_vote_count,$orig_start_clone_date,$orig_folder_name,$orig_file_name,$orig_approved_build,$orig_custom_title1,$orig_custom_title2,$orig_click_tally);
 return $send_array;
   }
}//close class
?>
