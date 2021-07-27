<?php class modify
{
function categoryPathforNav($catid, $regional_number, $cat_id_orig,$website_id){
	global $settings, $cat_page_num,$cat_page_id,$cat_record_num,$link_page_id, $link_page_num, $link_record_num;

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connect.php");

$folder_name="members/reg_form";
$file_name="index_edit.php";
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
		if($row['id'] != '1'){
if($regional_number !=""){
$path .= $settings['nav_separator'].'<a href="/'.$folder_name.'/'.$file_name.'/'.$row['id'].'/'.$regional_number.'/'.$cat_id_orig.'/'.$website_id.'">'.$row['name'].'</a>';
}
else
{
$path .= $settings['nav_separator'].'<a href="/'.$folder_name.'/'.$file_name.'/'.$row['id'].'/'.$regional_number.'/'.$cat_id_orig.'/'.$website_id.'">'.$row['name'].'</a>';

}

	}
}
	return $path;
}
function getLinkInfo ($website_id, $cat_id){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connect.php");
$sql = "select * from `links` where `id` = '$website_id' and `category` ='$cat_id'";
echo '<h3>in func = ', $sql;
echo '</h3>';
$result = mysql_query($sql, $connect);
	while($row = @mysql_fetch_array($result)){
$title = $row['name'];
$url = $row['url'];
$description = $row['description'];
$street = $row['street'];
$postal_code = $row['zip'];
$phone_number = $row['phone'];
}
$sendarray = array($title ,$url ,$description,$street,$postal_code,$phone_number);
return $sendarray; 
}

function categoryPathDisplay($catid){
	global $settings, $cat_page_num,$cat_page_id,$cat_record_num,$link_page_id, $link_page_num, $link_record_num;

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connect.php");

$folder_name="members/reg_form";
$file_name="index_edit.php";
//$affiliate_num = '2338';
	$path = '';
	$query = 'SELECT `lft`,`rgt` FROM `categories` WHERE `id`="'.mysql_escape_string($catid).'"';
$result = mysql_query($query, $connect);
	$row = mysql_fetch_array($result);
	$lft = $row['lft'];
	$rgt = $row['rgt'];
	$query = 'SELECT `name`,`id` FROM `categories` WHERE `lft` <= '.$lft.' AND `rgt` >= '.$rgt.' ORDER BY `lft` ASC;';

$result = mysql_query($query, $connect);
	while($row = @mysql_fetch_array($result)){
		if($row['id'] != '1')
$path .= $row['name'].'->';
	}
	return $path;
}



function listCategories($url_cat,  $cat_id_orig, $website_id){
//this list categories function is ONLY for use on the MODIFY A LINK registration form. It has two extra params in the url (website id and cat_id)orig that replace other items usually transferred by this function. DO NOT USE ANYWHERE ELSE WITHOUT CAREFUL SCRUTINY 
	//global $settings, $folder_name, $file_name, $affiliate_num, $cat_page_num,$cat_page_id,$cat_record_num,$link_page_id, $link_page_num, $link_record_num, $time_period;
 include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connect.php");
$folder_name ="members/reg_form";
$file_name = "index_edit.php";
$time_period =  '8';
If($cat_record_num == 'true'){
	$select_id = $cat_record_num; 
	}
	else
	{
	$select_id = $url_cat;
	}

$catData = new mobile;
$totalCatpages = $catData->totalCatpages($url_cat);	
    if($totalCatpages>1 && $url_cat != 1){
						If($cat_page_id > 1)
							{
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
			else
			{ 
			$query = 'SELECT * FROM `categories` WHERE `parent` = "'.mysql_escape_string($select_id).'  "ORDER BY `name` ASC   ';
			$result = mysql_query($query, $connect);
			}						
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
	//build the category display
	$num_rows = mysql_num_rows($result);
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
//$sql="SELECT `id` from  `links`where `category` = ".$id[$i]." AND `continents` = ".$regional_number;
		$sql="SELECT `link_id`
FROM regional_sign_ups
LEFT JOIN links ON links.id = regional_sign_ups.link_id
WHERE links.category = $id[$i] AND regional_sign_ups.continents = ".$regional_number_val[0];
}
elseif(!$regional_number=="")
{
$regional_number_val = explode("|", $regional_number);
//echo '0 = ', $regional_number_val[0];
//echo '1 = ', $regional_number_val[1];
		if($regional_number_val[1]=="cit"){
		$sql="SELECT `link_id`
FROM regional_sign_ups
LEFT JOIN links ON links.id = regional_sign_ups.link_id
WHERE links.category = $id[$i] AND regional_sign_ups.cities = ".$regional_number_val[0];
	}elseif($regional_number_val[1]=="dis"){
		//$sql="SELECT `id` from `links`where `category` = ".$id[$i]." AND `districts` = ".$regional_number_val[0];
		$sql="SELECT `link_id`
FROM regional_sign_ups
LEFT JOIN links ON links.id = regional_sign_ups.link_id
WHERE links.category = $id[$i] AND regional_sign_ups.districts = ".$regional_number_val[0];
		}elseif($regional_number_val[1]=="sta"){
		//$sql="SELECT `id` from `links`where `category` = ".$id[$i]." AND `states` = ".$regional_number_val[0];
		$sql="SELECT `link_id`
FROM regional_sign_ups
LEFT JOIN links ON links.id = regional_sign_ups.link_id
WHERE links.category = $id[$i] AND regional_sign_ups.states = ".$regional_number_val[0];
		}elseif($regional_number_val[1]=="cou"){
		//$sql="SELECT `id` from `links`where `category` = ".$id[$i]." AND `countries` = ".$regional_number_val[0];
		$sql="SELECT `link_id`
FROM regional_sign_ups
LEFT JOIN links ON links.id = regional_sign_ups.link_id
WHERE links.category = $id[$i] AND regional_sign_ups.countries = ".$regional_number_val[0];
		}
}
else{//try this because it is not regional
$sql="SELECT `id` from `links`where `category` = ".$id[$i];
}
 $result = mysql_query($sql, $connect);
if($result){
$num_rows2 = mysql_numrows($result);
}
$npopulation= explode(",",$population[$i]);
$time_period_adjust = ($time_period - 1) * 2;

if(!$regional_number==""){

$cats .= '<li><font size="2"><strong><a href="/'.$folder_name.'/'.$file_name.'/'.$id[$i].'/'.$regional_number.'/'.$cat_id_orig.'/'.$website_id.'">'.$name[$i].'</a></strong></font><i><small>(<font id="c'.$id[$i].'">'.$num_rows2.'</font>)</small></i>';
}
else{
$cats .= '<li><font size="2"><strong><a href="/'.$folder_name.'/'.$file_name.'/'.$id[$i].'/'.$cat_id_orig.'/'.$website_id.'">'.$name[$i].'</a></strong></font><i><small>(<font id="c'.$id[$i].'">'.$num_rows2.'</font>)</small></i>';
//$cats .= '<li><font size="2"><strong><a href="/'.$folder_name.'/'.$file_name.'/'.$id[$i].'/'.$regional_number.'/'.$cat_id_orig.'/'.$website_id.'">'.$name[$i].'</a></strong></font><i><small>(<font id="c'.$id[$i].'">'.$num_rows2.'</font>)</small></i>';
}
$test_second_pop = $npopulation[$time_period_adjust+1] ;


If($test_second_pop > 0){

		$cats .= '<i><small>(<font id="sc'.$id[$i].'">'.$test_second_pop.'</font>)</small></i>';
		}
		$cats .= '</li>';
//change id[] to name[] to get name into directory category list urls
	}
	$cats .= '</ul></td></tr></table>';
	
	$cats .= "$nav_barf ";
	
	
}//close if result
else
{
$cats = "false";
}
return $cats;
}


}//close class
