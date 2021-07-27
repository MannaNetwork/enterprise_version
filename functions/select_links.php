<?php
function get_new_widgets_by_date(){ //this function mostly used to say how many widgets are installed. Probably needs to be changed to prevent counting affiliates in the number
//there is an almost identical func named get_widgets_by_date that this
//replaces, The old one tries to find widget info in links table that was moved to widgets table

include(__DIR__) . "../../../db_cfg/auth_constants.php";
include(__DIR__) . "../../../db_cfg/".READER_CUSTOMERS;
include(__DIR__) . "../../../db_cfg/mysqli_connect.php";

$now= mktime();


       $timespan= $now-(60*60*24);//1 day
$query = "Select * from `widgets` where `start_clone_date` < $timespan"; 

$result = mysql_query($query, $connect)or die("<p align='left'>Bold query7 "); 
$num_rows = mysql_num_rows($result);

$widgets_array = $num_rows;

   $timespan=  $now-(60*60*24*7);//7 day3
$query = "Select * from `widgets` where  `start_clone_date` < $timespan"; 

$result = mysql_query($query, $connect)or die("<p align='left'>Bold query8 "); 
$num_rows = mysql_num_rows($result);

$widgets_array .= ','.$num_rows;
      

 $timespan = $now-(60*60*24*30);//30 day3
$query = "Select * from `widgets` where  `start_clone_date` < $timespan"; 

$result = mysql_query($query, $connect)or die("<p align='left'>Bold query1 "); 
$num_rows = mysql_num_rows($result);

$widgets_array .= ','.$num_rows;
 
      
$query = "Select * from `widgets` where  `start_clone_date` > 1206377558"; 

$result = mysql_query($query, $connect)or die("<p align='left'>Bold query8 "); 
$num_rows = mysql_num_rows($result);

$widgets_array .= ','.$num_rows;
 

return $widgets_array;
}







function get_click_tallies($cat_id, $span_wanted){


include(__DIR__) . "../../../db_cfg/auth_constants.php";
include(__DIR__) . "../../../db_cfg/".READER_CUSTOMERS;
include(__DIR__) . "../../../db_cfg/mysqli_connect.php";

$now= mktime();

switch ($span_wanted) {
    case 0:
       $timespan= (60*60*24);//1 day
$query = "Select * from `click_tally` where `cat_click`='$cat_id' AND `enter_time` > $now-$timespan"; 

        break;
    case 1:
       $timespan= (60*60*24*7);//7 day3
$query = "Select * from `click_tally` where `cat_click`='$cat_id' AND `enter_time` > $now-$timespan"; 

        break;
    case 2:
       $timespan= (60*60*24*30);//30 day3
$query = "Select * from `click_tally` where `cat_click`='$cat_id' AND `enter_time` > $now-$timespan"; 


        break;
 case 3:
       $timespan= (60*60*24*30);//30 day3
$query = "Select * from `click_tally` where `cat_click`='$cat_id' AND `enter_time` > 1241295286"; 
//echo $query;

        break;

}


//echo $query;
$result = mysql_query($query, $connect)or die("<p align='left'>Bold query2 "); 
$num_rows = mysql_num_rows($result);
//echo 'num rows = ', $num_rows;
return $num_rows;
 }

function get_click_tallies_for_dropdown($cat_id){


include(__DIR__) . "../../../db_cfg/auth_constants.php";
include(__DIR__) . "../../../db_cfg/".READER_CUSTOMERS;
include(__DIR__) . "../../../db_cfg/mysqli_connect.php";

$now= mktime();


       $timespan= (60*60*24);//1 day
$query = "Select * from `click_tally` where `cat_click`='$cat_id' AND `enter_time` > $now-$timespan"; 
//echo $query;
$result = mysql_query($query, $connect)or die("<p align='left'>Bold query3 "); 
$num_rows = mysql_num_rows($result);

$click_array = $num_rows;

   $timespan= (60*60*24*7);//7 day3
$query = "Select * from `click_tally` where `cat_click`='$cat_id' AND `enter_time` > $now-$timespan"; 
$result = mysql_query($query, $connect)or die("<p align='left'>Bold query4 "); 
$num_rows = mysql_num_rows($result);

$click_array .= ','.$num_rows;
      

 $timespan= (60*60*24*30);//30 day3
$query = "Select * from `click_tally` where `cat_click`='$cat_id' AND `enter_time` > $now-$timespan"; 
$result = mysql_query($query, $connect)or die("<p align='left'>Bold query5 "); 
$num_rows = mysql_num_rows($result);

$click_array .= ','.$num_rows;
 
      
$query = "Select * from `click_tally` where `cat_click`='$cat_id' AND `enter_time` > 1241295286"; 
$result = mysql_query($query, $connect)or die("<p align='left'>Bold query6 "); 
$num_rows = mysql_num_rows($result);

$click_array .= ','.$num_rows;
 

return $click_array;
 }

function category_affiliateTally($cat_id, $link_id){
include(__DIR__) . "../../../db_cfg/auth_constants.php";
include(__DIR__) . "../../../db_cfg/".READER_CUSTOMERS;
include(__DIR__) . "../../../db_cfg/mysqli_connect.php";

$enter_time = time();
$query = 'UPDATE categories SET  `click_tally`=`click_tally`+1 WHERE `id`= "'.mysql_escape_string($cat_id).'  "   ';
$result = mysql_query($query, $connect);

$query2 = "INSERT INTO `click_tally` (enter_time,cat_click,link_click) values($enter_time,$cat_id,$link_id)";
//echo $query2;
$result = mysql_query($query2, $connect);
}




function getCJAdvertisers($cat_id, $num_banners){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2cjconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");


$query = "Select * from `advertisers` where `BB_cat_ID` = $cat_id LIMIT 0, ".$num_banners; 

$result = mysqli_query($connect, $query); 
	while($row = mysqli_fetch_array($result)){
		$adv_image[] = $row['adv_image'];
		$textlink[] = $row['textlink'];
    }
$send_array = array($textlink, $adv_image);
return $send_array;
}


function commission_junction_banners($location, $num_banners, $affiliate_num, $affiliate__cj_ID, $cat_id){
/*echo '<br>in func';
echo '    location = ', $location;
echo '    num banners = ', $num_banners;
echo '    aff num = ', $affiliate_num;
echo '     cat num = ', $cat_num;
*/
$advtsrs_link_array = getCJAdvertisers($cat_id, $num_banners);
// gets array($adv_image, $textlink);
$textlink = $advtsrs_link_array[0];
$adv_image = $advtsrs_link_array[1];
$banner_ad_top = "";
// the code to place commission junction banners is roughed in
// it will place banners either on side or on bottom based on link pop
//the if condition needs an array of widget link ids so banners are only displayed by participants
//needs a cpanel so they can choose this option, can register at cj.com, and can provide me their login info
$num_banners = $num_banners - 1;//for some reason the for loop is adding an extra banner so compensate
if($location === "top" || $location === "bottom" ){
$banner_ad_topt .='<table><tr>';
$banner_ad_topb .='</tr></table>';
}
elseif($location === "side"){
$banner_ad_topt .='<td  valign="top">';
$banner_ad_topb .='</td>';
}

if($advtsrs_link_array[0]){
foreach($textlink as $key=>$value){


$banner_ad_top .="<td>";
$banner_ad_top .= $textlink[$key];
$banner_ad_top .= $adv_image[$key];
$banner_ad_top .='</td>';
}
$banner_ad_total = $banner_ad_topt.$banner_ad_top.$banner_ad_topb;
}
return $banner_ad_total;
}



function  make_form($nxt){
$var = explode("/", $nxt);

$post_form = "
<FORM METHOD='POST' NAME='cat_link_request'>

<INPUT TYPE='HIDDEN' NAME='url_cat' = $var[2] ;// was cat id so everything in link exchange that is cat id needs to be changed to url cat
<INPUT TYPE='HIDDEN' NAME='cat_page_num' = $var[3] ;//used to be cat page id and 3
<INPUT TYPE='HIDDEN' NAME='link_page_num' = $var[4] ;
<INPUT TYPE='HIDDEN' NAME='pagem_url_cat' = $var[5] ;// was 5
<INPUT TYPE='HIDDEN' NAME='link_page_id' = $var[6] ;//used to be 4
<INPUT TYPE='HIDDEN' NAME='link_page_total' = $var[7] ;
<INPUT TYPE='HIDDEN' NAME='link_record_num' = $var[8] ;//used to be 6
<INPUT TYPE='HIDDEN' NAME='regional_number' = $var[9] ;//
</FORM>";
return $post_form;
}  
function listCategorieswp($url_cat,$cat_page_num, $regional_number, $time_period){
		global $settings, $folder_name, $file_name, $affiliate_num, $cat_page_num,$link_page_id, $link_page_num, $link_record_num;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
	
//what the hay was cat recrd num? it looks like string true or boolean?
//whewe is the result(select id) used and how would cat record num affect its operation?
//it is only used in the select query so, again, whwere does it come from?
//iS from global, which is not good...
//list where occurs here ... 
//not on index page
//in params of alphmenu call on alphapager page ut not in script -- removed from it and alphamenu



//try the same with cat pag num
//but if no page then it selects for the cat num?
If($cat_page_num == 'true'){
	$select_id = $cat_page_num; 
	}
	else
	{
	$select_id = $url_cat;
	}

		$totalCatpages=totalCatpages($url_cat);
		
			 if($totalCatpages>1 && $url_cat != 1){ 
						If($cat_page_num > 1)
							{
									//$cat_page_id = the cuurent page - if the current page is greater
									//than one, place a limit in the query to get the right page

$preamm = mysqli_real_escape_string(($cat_page_num - 1)* $settings['amm'] );
$amm = mysqli_real_escape_string($connect, $settings['amm']);
$categories_table = mysqli_real_escape_string($connect, $settings['categories_table']);
							 $query = 'SELECT * FROM '.$categories_table.' WHERE parent= "'.$select_id.'" AND `is_approved`="1" ORDER BY name ASC LIMIT '.$preamm.','.$amm.'   ';
								$result = mysqli_query($connect, $query);
							include('alpha_pager_wp.php');//wp has different version of pager that omits affiliate num from url
					
							}
							else//place a limit in the query to get the first page
							{
									
							 $query = 'SELECT * FROM '.$settings['categories_table'].' WHERE parent= "'.mysqli_escape_string($connect, $select_id).'" AND `is_approved`="1" ORDER BY name ASC LIMIT 0,'.mysqli_escape_string($connect, $settings['amm']).'   ';
							$result = mysqli_query($connect, $query);
							include('alpha_pager_wp.php');
					
								}//ends 2nd if
			}
			else//means there is only one page worth of cats
			//do a query that retrieves all the records in that cat with no limit
			{ 
			$query = 'SELECT * FROM '.$settings['categories_table'].' WHERE parent= "'.$select_id.'" AND `is_approved`="1" ORDER BY name ASC   ';
			$result = mysqli_query($connect, $query);
			}						
	$result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_array($result)){
		$id[] = $row['id'];
		$name[] = $row['name'];
    
		$population[] = $row['population'];
		//$sub_population[] = $row['sub_population'];
		$pop_cont[] = $row['pop_cont'];
		//$subpop_cont[] = $row['subpop_cont'];
		$pop_country[] = $row['pop_country'];
		//$subpop_country[] = $row['subpop_country'];
		$pop_state[] = $row['pop_state'];
		//$subpop_state[] = $row['subpop_state'];
		$pop_city[] = $row['pop_city'];
		//$subpop_city[] = $row['subpop_city'];
		//maybe change the multiple cats for regionals one  in an array
	}
	///////////////////////
///////////////////
	//build the category display
	$num_rows = mysqli_num_rows($result);
	if($num_rows > 0){//build cat_info var for display
		$cats = "<table class='bb_cats_table' align='center' width='100%' border='0'><tr align='center'><td align='left' width='50%' valign='top'>	<ul>";
	if($num_rows % 2){
		$divnum = $num_rows+1;
	} else {
		$divnum = $num_rows;
	}





	for($i=0; $i < $num_rows; $i++){
		if($i == $divnum/2){
			$cats .= '</ul></td><td width="50%" align="left" valign="top"><ul>';
		}

	
////new insert from mobile class

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
elseif($regional_number_val[1]=="con"){
		$sql="SELECT `id` from `links`where `category` = ".$id[$i]." AND `continents` = ".$regional_number_val[0];
		}
}
else{//try this because it is not regional
$sql="SELECT `id` from `links`where `category` = ".$id[$i];
}
$result = mysqli_query($connect, $sql);

if($result){
$num_rows2 = mysqli_num_rows($result);
//echo '$num_rows2 =    ', $num_rows2;
}





///////////////////////////////end new inser

	//this is where the AJAX population action needs to occur
		$npopulation= explode(",",$population[$i]);
		//$nsub_population= explode(",",$sub_population[$i]);
//what is npopulation 14? is it the total pop where the timeperiod is 8?
//but it certainly isn't the pop when the region number is the us or canad or france!
//the next if else is for regional nums
//is is accurate??

		$time_period_adjust = ($time_period - 1) * 2;
//echo '<br>id I == ', $id[$i];
$name[$i]  = stripslashes($name[$i]); //added on 10/9/2011 because names such as Men's had a slash added
if($regional_number!=""){//if there is a regional number
//to get npopulation you have to run a query for that cat and that region
//how many links in the real estate cat in france
//so this following url does not do that
	if($folder_name=="root")//is a install at root
	{
	$cats .= '<li><font   id="u'.$id[$i].'" ><a class="bb_cats" href="/'.$file_name.'/'.$id[$i].'///////'.$regional_number.'/">'.$name[$i].'/</a></font><i><small> (<font id="c'.$id[$i].'">'.$npopulation[14].'</font>)</small></i>';
	
	}
	else
	{
	$cats .= '<li><font  id="u'.$id[$i].'" ><a class="bb_cats" href="/'.$folder_name.'/'.$file_name.'/'.$id[$i].'///////'.$regional_number.'/">'.$name[$i].'/</a></font><i><small> (<font id="c'.$id[$i].'">'.$npopulation[14].'</font>)</small></i>';
	}
}
else
{//echo 'oncl yald func in else not regional';
	if($folder_name=="root")//is a install at root
		{
		$cats .= '<li ><font id="u'.$id[$i].'" ><a class="bb_cats" href="/'.$file_name.'/'.$id[$i].'/">'.$name[$i].'/</a></font><i><small> (<font id="c'.$id[$i].'">'.$npopulation[14].'</font>)</small></i>';
	
		}
		else
		{
		$cats .= '<li ><font  id="u'.$id[$i].'" ><a class="bb_cats" href="/'.$folder_name.'/'.$file_name.'/'.$id[$i].'/">'.$name[$i].'/</a></font><i><small> (<font id="c'.$id[$i].'">'.$npopulation[14].'</font>)</small></i>';
	
		}
}
If($npopulation[$time_period_adjust+1] > 0){

		$cats .= '<i><small>(<font id="sc'.$id[$i].'">'.$npopulation[15].'</font>)</small></i>';
}
		$cats .= '</li>';

//change id[] to name[] to get name into directory category list urls
	}//close for each num rows?
	$cats .= '</ul></td></tr></table>';
	
	$cats .= "$nav_barf ";
////have one too many } between here and end of query list	
	
}//close if result


else
{
$cats = "false";
}
return $cats;
}










function getWidgetConfigs($link_id){

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$query="Select * from `widgets` where `link_id` = '$link_id'";

$result = mysqli_query($connect, $query)or die("<p align='left'>Bold query8 "); 
//$num_rows = mysqli_num_rows($result);
//$widgets_array .= ','.$num_rows;
$row = mysqli_fetch_array($result);
/*folder_name 	
file_name 	
brand 	
display_freebies 	
plugin 	
custom_title1 	
custom_title2 	
meta_descrip 	
keywords 	
name 	
click_tally 	
donate 	
leaving_page 	
cust_add_a_link 	
cust_add_a_link_mo 	
cust_add_a_link_ret */	
$fontsize = $row['fontsize'];	
$titlecolor = $row['titlecolor'];	
$linktextcolor = $row['linktextcolor'];	
$catcolor = $row['catcolor'];

$sendarray = array($fontsize, $titlecolor, $linktextcolor, $catcolor);

return($sendarray);

}
  function makeCrumbTrail($url_cat, $folder_name, $file_name, $affiliate_num, $is_niche, $regional_number){
global $settings;
$nav = '<div align="center">';
$nav .= '<a href="/';
if($folder_name != "root"){
$nav .= $folder_name;
$nav .='/';
 }
$nav .=$file_name;
if($is_niche !="0"){

$nav .='/'.$is_niche;
}
			if($regional_number != ""){
			$nav_region_reset = $nav;//make a duplicate of the path so far for use as a reset
			$nav .='/0/0/0/0/0/0/0/0/'.$regional_number;
			$nav_region_reset .='"><font size="3">Global Level</font></a>';	
			$nav_region_reset .= regionPath($url_cat, $regional_number);
			$regionname = regionName($regional_number);
//region name must came back from regionName as a string and not as an array as it was sent
			$nav_region_reset .= $settings['nav_separator'].$regionname;		
			$nav_region_reset .= "</div>";
			//link reads this way now http://bungeebones.com/bungee_bones/index.php/0/////////2821|sta
			}
                //continue building category/non regional crumb trail
$nichename = categoryName($is_niche);
$categoryname = categoryName($url_cat);
if($is_niche !=""){	
	$nav .='"><font size="4">'.$nichename.' Directory</font></a>';
}
else
{
$nav .='"><font size="4">Top Level</font></a>';


}
               $nav .= categoryPath($url_cat, $regional_number);
 
		$search_nav =  searchPath($url_cat);
        
		
		$page_title = $categoryname;
               
		$nav .= $settings['nav_separator'].$categoryname;		
		$nav .= "</div>";
return $nav;
}

function isGenie($link_id){
	global $settings;
	include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

	$query = 'SELECT * FROM `isGenie` WHERE `link_id`='.$link_id;
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_row($result);
if($result){
	return $row;
}
else
{
return false;
}
}

function regionName($regional_number){

	global $settings;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$regional_number_pieces = explode("|",$regional_number);
$region_number_integer = mysqli_real_escape_string($connect, $regional_number_pieces[0]);	
	$query = 'SELECT name FROM `categories_regional2` WHERE id="'.$region_number_integer.'"';

	$result = mysqli_query($connect, $query);

	$row = mysqli_fetch_row($result);

	return $row[0];

}

function regionPath($catid, $regional_number){
	global $settings,$affiliate_num,$folder_name,$file_name;
$regional_number_pieces = explode("|", $regional_number);
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$region_number_integer  = mysqli_real_escape_string($connect, $regional_number_pieces[0]);
	$path = '';
	$query = 'SELECT lft,rgt FROM `categories_regional2` WHERE id="'.$region_number_integer .'"';

	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);
	$lft = $row['lft'];
	$rgt = $row['rgt'];
	$query = 'SELECT name,id FROM `categories_regional2` WHERE lft < '.$lft.' AND rgt > '.$rgt.' ORDER BY lft ASC;';
	//echo 'yald func 504  = ', $query;
$result = mysqli_query($connect, $query);
$num_rows = mysqli_num_rows($result);
$counter = $num_rows;
while($row = @mysqli_fetch_array($result)){
if($row['id'] != '1'){
$counter = $counter-1;
$id[]=$row['id'];

if(count($id)==1){$marker="con";}
elseif(count($id)==2){$marker="cou";}
elseif(count($id)==3){$marker="sta";}
elseif(count($id)==4){$marker="cit";}
$new_regional_number = $row['id']."|".$marker;
if($folder_name == "root"){
$path .= $settings['nav_separator'].'<a href="/'.$file_name.'/'. $affiliate_num.'/'.$catid.'/0/0/0/0/0/0/'.$new_regional_number.'">'.$row['name'].'</a>';

}
else
{
$path .= $settings['nav_separator'].'<a href="/'.$folder_name.'/'.$file_name.'/'. $affiliate_num.'/'.$catid.'/0/0/0/0/0/0/'.$new_regional_number.'">'.$row['name'].'</a>';
}
}	
}

	return $path;
}

function total_num_pages($catid, $time_period){//this should be called totalFREE pages?
global $settings;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

if($time_period = 8){
$catid=mysqli_real_escape_string($connect, $catid);
	$query = 'SELECT * FROM `'.$settings['links_table'].'` WHERE `category`="'.$catid.'" AND `freebie` = '. 0;
	}
$result = mysqli_query($connect, $query);
$num_rows = mysqli_num_rows($result);
$total_num_pages =  ceil($num_rows/$settings['lr_amm']);
return $total_num_pages;
}



function links_numeric_menuwp($catid,  $cat_page_num, $link_page_num, $time_period, $link_page_id, $pagem_url_cat){

global $settings, $affiliate_num;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$query = 'SELECT * FROM `widgets`  WHERE `link_id`="'.$affiliate_num.'"';
//$query = 'SELECT * FROM `'.$settings['links_table'].'` WHERE `id`="'.$affiliate_num.'"';
$result = mysqli_query($connect, $query);
while($row = mysqli_fetch_array($result)){
$folder_name = htmlentities(stripslashes($row['folder_name']));
$file_name = htmlentities(stripslashes($row['file_name']));
}
	

$alphamenu = '';
$amm = $settings['lr_amm'];
//this looks like a short cut was taken by hardcoding the 8 in
//also - what if it is not 8? It will crash!
//but it may be a deprecated function?function links_numeric_menu(
if($time_period = 8){
$catid=mysqli_real_escape_string($connect, $catid);
	$query = 'SELECT * FROM `'.$settings['links_table'].'` WHERE `category`="'.$catid.'"';

}
$result = mysqli_query($connect, $query);
$num_rows = mysqli_num_rows($result);
$total_num_pages =  ceil($num_rows/$settings['lr_amm']);

$link_array  = "";
for($i=1;$i <= $total_num_pages; $i++){

$link_page_num=$i;//link page num is before being slected . link page id is after it has been selected(i.e. goes through url)
if($cat_page_num ==""){
$cat_page_num=0;
}
If($link_page_num==""){
$link_page_num = 0;
}
if($pagem_url_cat ==""){
$pagem_url_cat = 0;
}
$link_array .= '<a href="';

if($total_num_pages!=""){
	if($folder_name=="root"){
	$link_array .= "/$file_name/$catid/$cat_page_num/$link_page_num/$pagem_url_cat";
	}else
	{
	$link_array .= "/$folder_name/$file_name/$catid/$cat_page_num/$link_page_num/$pagem_url_cat";
	}
}
elseif($page_num!=""){
		if($folder_name=="root"){
			$link_array .= "/$file_name/$catid/$cat_page_num/$link_page_num";
		}
		else
		{
			$link_array .= "/$folder_name/$file_name/$catid/$cat_page_num/$link_page_num";
		}
}


$link_array .= '">'.$link_page_num.'</a> | ';


}//close for 
return $link_array;
}//close function



function links_numeric_menu($catid,  $cat_page_num, $link_page_num, $time_period, $link_page_id, $pagem_url_cat){

global $settings, $affiliate_num;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$query = 'SELECT * FROM `widgets`  WHERE `link_id`="'.$affiliate_num.'"';
//$query = 'SELECT * FROM `'.$settings['links_table'].'` WHERE `id`="'.$affiliate_num.'"';
$result = mysqli_query($connect, $query);
while($row = mysqli_fetch_array($result)){
$folder_name = htmlentities(stripslashes($row['folder_name']));
$file_name = htmlentities(stripslashes($row['file_name']));
}
	

$alphamenu = '';
$amm = $settings['lr_amm'];
//this looks like a short cut was taken by hardcoding the 8 in
//also - what if it is not 8? It will crash!
//but it may be a deprecated function?function links_numeric_menu(
$catid=mysqli_real_escape_string($connect, $catid);
if($time_period = 8){
	$query = 'SELECT * FROM `'.$settings['links_table'].'` WHERE `category`="'.$catid.'"';

}
$result = mysqli_query($connect, $query);
$num_rows = mysqli_num_rows($result);
$total_num_pages =  ceil($num_rows/$settings['lr_amm']);

$link_array  = "";
for($i=1;$i <= $total_num_pages; $i++){

$link_page_num=$i;//link page num is before being slected . link page id is after it has been selected(i.e. goes through url)
if($cat_page_num ==""){
$cat_page_num=0;
}
If($link_page_num==""){
$link_page_num = 0;
}
if($pagem_url_cat ==""){
$pagem_url_cat = 0;
}
$link_array .= '<a href="';

if($total_num_pages!=""){
	if($folder_name=="root"){
	$link_array .= "/$file_name/$affiliate_num/$catid/$cat_page_num/$link_page_num/$pagem_url_cat";
	}else
	{
	$link_array .= "/$folder_name/$file_name/$affiliate_num/$catid/$cat_page_num/$link_page_num/$pagem_url_cat";
	}
}
elseif($page_num!=""){
		if($folder_name=="root"){
			$link_array .= "/$file_name/$affiliate_num/$catid/$cat_page_num/$link_page_num";
		}
		else
		{
			$link_array .= "/$folder_name/$file_name/$affiliate_num/$catid/$cat_page_num/$link_page_num";
		}
}


$link_array .= '">'.$link_page_num.'</a> | ';


}//close for 
return $link_array;
}//close function

function listLinksPaid( $url_cat ){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

// id 	user_id link_id wdgts_lnk_num 	price_slot_amnt subscribe cat_id t_timestamp 	start_date 
$sql="Select * from `price_slot_subscipts` where `subscribe` = 1 and `category` = $url_cat ORDER by `price_slot_amnt` DESC, `start_date` ASC ";
$result = mysqli_query($connect, $sql);
while($row = mysqli_fetch_array($result)){
$id[] = $row['id'];
$user_id[] = $row['user_id'];
$link_id[] = $row['link_id'];
$wdgts_lnk_num[] = $row['wdgts_lnk_num'];
$price_slot_amnt[] = $row['price_slot_amnt'];
$subscribe[] = $row['subscribe'];
$cat_id[] = $row['cat_id'];
$t_timestamp[] = $row['t_timestamp'];
$start_date[] = $row['start_date'];
}

foreach($link_id as $key => $value){
while($row = mysqli_fetch_array($result)){
$url = htmlentities(stripslashes($row['url']));
preg_match('@^(?:http://)?([^/]+)@i',"$url", $matches);
$host = $matches[1];
// get last two segments of host name
preg_match('/[^.]+\.[^.]+$/', $host, $matches);
$strpurl = $matches[0];
$id=$row['id'];
$name = htmlentities(stripslashes($row['name']));
$description = htmlentities(stripslashes($row['description']));
$peer_rating = htmlentities(stripslashes($row['peer_rating']));
$peer_vote_count = htmlentities(stripslashes($row['peer_vote_count']));
$avg_public_rating = htmlentities(stripslashes($row['public_rating']));
$public_vote_count = htmlentities(stripslashes($row['public_vote_count']));
$street = htmlentities(stripslashes($row['street']));	
$zip = htmlentities(stripslashes($row['zip']));
$phone = htmlentities(stripslashes($row['phone']));
$nofollow = htmlentities(stripslashes($row['nofollow']));
if($street !=""){
$query_reg = "SELECT * from `regional_sign_ups` WHERE `link_id` = $id";
$result2 = mysqli_query($connect, $query_reg);
while($row = mysqli_fetch_array($result2)){
$continents = htmlentities(stripslashes($row['continents']));	
$continents = regionName($continents);
$countries = htmlentities(stripslashes($row[' countries']));
$countries = regionName($countries);	
$states = htmlentities(stripslashes($row['states']));
$states = regionName($states);
$districts = htmlentities(stripslashes($row['districts']));
$districts = regionName($districts);	
$cities  = htmlentities(stripslashes($row['cities']));
$cities = regionName($cities);
}
}
}
}
$send_array = array($user_id,$link_id,$wdgts_lnk_num);
return $send_array;
}

function getPaidLinks($url_cat){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$query = "SELECT * from `price_slots_subscripts` WHERE `cat_id` = $url_cat AND `subscribe` = 1";
$result2 = mysqli_query($connect, $query);
//if($result2){
while($row = mysqli_fetch_array($result2)){
$cat_id[] = htmlentities(stripslashes($row['cat_id']));
$subscribe[] = htmlentities(stripslashes($row['subscribe']));
}
$this_count = count($cat_id);
return $this_count;
}


//new listLinks with defines has been tested at timeperiod 8 and a little at timeperiod 7. tp 7 thru 1 are 
//all the same system so they should work. tp 0 however is different and needs to be checked if/when used

//lisnk_page_num and link_page_id very similar but in different positions in links. num is at  pos 4 and id at pos6
//added num to this list on jan 4. may have removed defunc predecessor cat page total prviously

function listLinks($affiliate_num, $url_cat, $cat_page_num, $link_page_num, $pagem_url_cat, $link_page_id, $regional_number, $display_freebies, $time_period,  $nofollow )
{global $settings;
//check if there are any paid links in this category
$limit_by_offset = getPaidLinks($url_cat);//this is the count of paid active links in this cat, with this info we can reduce the limit by in the regular query by this number
//looks like link page id totally removed from list links func and list numeric function
$widget_configs = getWidgetConfigs($affiliate_num);
//print_r($widget_configs);
$fontsize = $widget_configs[0];	
$titlecolor = $widget_configs[1];	
$linktextcolor = $widget_configs[2];	
$catcolor = $widget_configs[3];

/*
the 3 party join below works but is a model
parts of it are used to construct a query if/when there are 
paid links (anything with a 1) in the price_slot_subscripts "subscribe" column
if(getPaidLinks($url_cat) > 0){there is at least 1 paid link in this cat
SELECT links.id, links.url, links.category, t2.link_id, t2.start_date, t2.price_slot_amnt, t2.subscribe, t2.cat_id, t3.link_id, t3.continents
FROM  `links` 
JOIN  `price_slots_subscripts` t2 ON links.id = t2.link_id
JOIN  `regional_sign_ups` t3 ON links.id = t3.link_id
WHERE links.category =2098
AND t2.subscribe =1
ORDER by 
t2.price_slot_amnt DESC, t2.start_date ASC
}
*/
category_affiliateTally($url_cat,$affiliate_num);
//category_affiliateTally($url_cat,$affiliate_num, $regional_number, $fb_user_ID);
$new_reg = explode("|", $regional_number);

define( 'QUERY1', 'SELECT 
links.id AS linksid,
links.url AS linksurl, 
links.name AS linksname,
links.description AS linksdescription,
links.street AS linksstreet,	
links.zip AS linkszip,
links.phone AS linksphone,
links.freebie AS linksfreebie,
links.nofollow AS linksnofollow,
links.peer_rating AS peer_rating,
links.peer_vote_count AS peer_vote_count,
links.public_vote_count AS public_vote_count
 FROM links
LEFT JOIN price_slots_subscripts ON price_slots_subscripts.link_id = links.id
JOIN  `regional_sign_ups` t3 ON links.id = t3.link_id AND price_slots_subscripts.subscribe >0
WHERE links.category = "'.mysql_escape_string($url_cat).'" and  links.approved="true"');
define( 'QUERY2', '
select links.id AS linksid,
links.url AS linksurl, 
links.name AS linksname,
links.description AS linksdescription,
links.street AS linksstreet,	
links.zip AS linkszip,
links.phone AS linksphone,
links.freebie AS linksfreebie,
links.nofollow AS linksnofollow,
links.peer_rating AS peer_rating,
links.peer_vote_count AS peer_vote_count,
links.public_vote_count AS public_vote_count
FROM links
LEFT JOIN price_slots_subscripts p ON p.link_id = links.id
AND p.subscribe >0
WHERE links.category="'.mysql_escape_string($url_cat).'" and  links.approved="true" ');
define( 'QUERY3', '
SELECT 
links.id AS linksid,
links.url AS linksurl, 
links.name AS linksname,
links.description AS linksdescription,
links.street AS linksstreet,	
links.zip AS linkszip,
links.phone AS linksphone,
links.freebie AS linksfreebie,
links.nofollow AS linksnofollow,
links.peer_rating AS peer_rating,
links.peer_vote_count AS peer_vote_count,
links.public_vote_count AS public_vote_count

 FROM links
LEFT JOIN price_slots_subscripts p ON p.link_id = links.id
AND p.subscribe >0 
WHERE links.category="'.mysql_escape_string($url_cat).'" and links.approved="true" ');//only adds a space at end, don't remember why
//make query4middle part of query for the regional links		
if($new_reg[1]=="con"){define( 'REGION_TEXT', 'continents =  "' . $new_reg[0] );
define( 'QUERY4mid', 'continents AS continents');
}
elseif($new_reg[1]=="cou"){define( 'REGION_TEXT', 'countries = "' . $new_reg[0] );
define( 'QUERY4mid', 'countries AS countries');
}
elseif($new_reg[1]=="sta"){define( 'REGION_TEXT', 'states = "' . $new_reg[0] );
define( 'QUERY4mid', 'states AS states');
}
elseif($new_reg[1]=="dis"){define( 'REGION_TEXT', 'districts = "' . $new_reg[0] );
define( 'QUERY4mid', 'districts AS districts');
}
elseif($new_reg[1]=="cit"){define( 'REGION_TEXT', 'cities = "' . $new_reg[0] );
define( 'QUERY4mid', 'cities AS cities');
}

if(isset($new_reg[1])) {

define( 'QUERY4start', 'SELECT r.link_id AS regional_link_id, r.');
define( 'QUERY4end', ', links.category AS category, links.id AS linksid, links.url AS linksurl, links.name AS linksname, links.description AS linksdescription, links.street AS linksstreet, links.zip AS linkszip, links.phone AS linksphone, links.freebie AS linksfreebie, links.nofollow AS linksnofollow, links.peer_rating AS peer_rating, links.peer_vote_count AS peer_vote_count, links.public_vote_count AS public_vote_count, p.link_id AS price_slot_linkid, p.price_slot_amnt AS price_slot_amt, p.start_date AS start_date
FROM regional_sign_ups r
LEFT JOIN links ON r.link_id = links.id
LEFT JOIN price_slots_subscripts p ON p.link_id = links.id
WHERE links.category = "'.mysql_escape_string($url_cat).'" 
AND `approved`="true" AND r.link_id = links.id AND r.');
define( 'QUERY4', QUERY4start . QUERY4mid . QUERY4end);
}
if($time_period ==8){
	if($new_reg[0] !=""){
		if(count($new_reg) ==1)//url has only the continent number without con. Indicates it came from the web page
		{
			$query = QUERY1 ." AND t3.continents = ". $new_reg[0];}
		elseif(defined('REGION_TEXT')) {
			$query = QUERY4 . REGION_TEXT. '"';//hard code anything - it is looking for time stamp greater thatn-- don't know why???
		
 }
	}//close if new reg is not null			  
	else //not regional		
	{$query = QUERY3; } 
} 
elseif($time_period ==7){ 
	if(defined('REGION_TEXT')){$query = QUERY4 . REGION_TEXT . '" and ( `freebie` > 0 OR (`freebie` = 0 AND  `start_date` > '. mktime(0, 0, 0, date("m"),   date("d"),   date("Y")-1).'))';	}
else //not regional	
  {$query = QUERY3 . ' and ( `freebie` > 0 OR (`freebie` = 0 AND  `start_date` > ' . mktime(0, 0, 0, date("m"),   date("d"),   date("Y")-1).'))';	 } 
} elseif($time_period <=6 || $time_period >0){ 			 
        if(defined('REGION_TEXT')){$query = QUERY4 . REGION_TEXT . '" and ( `freebie` > 0 OR (`freebie` = 0 AND  `start_date` > '. mktime(0, 0, 0, date("m")-$time_period,   date("d"),   date("Y")).'))';}
	else //not regional
{$query = QUERY2 . ' and ( `freebie` > 0 OR (`freebie` = 0 AND  `start_date` > ' . mktime(0, 0, 0, date("m")-$time_period,   date("d"),   date("Y")).'))'; } 

} 
else
{
//DON//'//T SELECT ANY FREEBIES which is same as time period 0	
//changed from freebie==0 to freebie < 0 during reversal of a freebie being 0 with price slots being higher
	if($new_reg[1]=="con"){$query = QUERY4 . ' freebie > 0 and `continents` =  ' . $new_reg[1]; }
	elseif($new_reg[1]=="cou"){$query = QUERY4 . ' freebie > 0 and `countries`=  ' . $new_reg[1];	 }
	elseif($new_reg[1]=="sta"){ $query = QUERY4 . ' freebie >0 and `states`=  ' . $new_reg[1]; }
	elseif($new_reg[1]=="cit"){$query = QUERY4 . ' freebie >0 and `cities`=  ' . $new_reg[1];  }		
	else
	  {$query = QUERY4 . ' freebie >0 ';	 }// NOT BE REGIONAL and not free 
}	
	
//echo 'line 747 incl yald fun css  ', $query;
//the query at this point has no order by so it can find number of pages
$query_w_pagntr == $query;
//THE PAGINATOR - gets the page number and sets the limits mathematically from it
//echo 'line 909 incl yald func ', $query;
$result = mysql_query($query);
$num_rows = mysql_num_rows($result);

$total_num_pages = ceil($num_rows/$settings['lr_amm']);

//$total_num_pages retireves the total number of pages so that it can be used later, even after 
//the query has been changed to inlucde limits. The total num of pages is used to determeine the display of a munu or not


if($link_page_num == 1 || $link_page_num==""|| $link_page_num=="0"){// added || $link_page_num=="0" on 7/6/2012 fixing regional select bug
	// because 0 is added as var colector vals iwhen the regioanal number is added 
	//sudden
define('ORDER_BY2', ' ORDER BY links.freebie DESC , p.price_slot_amnt DESC , p.start_date ASC      LIMIT 0, 20');
}
elseif($link_page_num > 1)//do some math to fet the limits)
{
$lower_limit = 20* ($link_page_num - 1);
$upper_limit = 20 * $link_page_num;
define('ORDER_BY2', ' ORDER BY links.freebie DESC , p.price_slot_amnt DESC , p.start_date ASC   LIMIT ' . $lower_limit.','.$upper_limit );
}
$query .= ORDER_BY2;
//this query has order by with limit so will always return 20 as num rows
//echo 'line 999 incl yal func ', $query;
$result = mysql_query($query);

if($result){

if($total_num_pages<2){
$links = '<div  id="doc3">';
}
else
{

$links = '<div class="bungeebones" style ="text-align: left;">LINKS PAGE '.links_numeric_menu($url_cat, $cat_page_num,  $link_page_num, $time_period, $link_page_id, $pagem_url_cat).'</div><div class="bungeebones" id="doc3" style ="text-align: left;">';
//added text align left to fix Joomla component centering link display when paginating
}

while($row = mysql_fetch_array($result)){
$url = htmlentities(stripslashes($row['url']));
preg_match('@^(?:http://)?([^/]+)@i',"$url", $matches);
$host = $matches[1];
// get last two segments of host name
preg_match('/[^.]+\.[^.]+$/', $host, $matches);
$strpurl = $matches[0];

$id = htmlentities(stripslashes($row['linksid']));
$category = htmlentities(stripslashes($row['category']));
$url = htmlentities(stripslashes($row['linksurl']));
$name = htmlentities(stripslashes($row['linksname']));
$description = htmlentities(stripslashes($row['linksdescription']));
$description = substr($description, 0, 255);
$street = htmlentities(stripslashes($row['linksstreet']));	
$zip = htmlentities(stripslashes($row['linkszip']));
$phone = htmlentities(stripslashes($row['linksphone']));
$nofollow = htmlentities(stripslashes($row['linksnofollow']));
$peer_rating = htmlentities(stripslashes($row['linkspeer_rating']));
$peer_vote_count = htmlentities(stripslashes($row['linkspeer_vote_count']));
$public_vote_count = htmlentities(stripslashes($row['linkspublic_vote_count']));
$price_slot_amnt = htmlentities(stripslashes($row['price_slot_amnt']));
$price_slot_start_date = htmlentities(stripslashes($row['start_date']));

if($street !=""){
$query_reg = "SELECT * from `regional_sign_ups` WHERE `link_id` = $id";
$result2 = mysql_query($query_reg);
while($row = mysql_fetch_array($result2)){
$continents = htmlentities(stripslashes($row['continents']));	
$continents = regionName($continents);
$countries = htmlentities(stripslashes($row['countries']));
$countries = regionName($countries);	
$states = htmlentities(stripslashes($row['states']));
$states = regionName($states);
$districts = htmlentities(stripslashes($row['districts']));
$districts = regionName($districts);	
$cities  = htmlentities(stripslashes($row['cities']));
$cities = regionName($cities);

}

}


//include('insert_ratings_pic.php');
//rel="nofollow"
if($nofollow =="on"){
if($street !="" && $cities!=""){
//$links .= "<hr><div class='linksdisplay'><a  href=\"{$url}\" target=\"_blank\" />{$name}</a></div><div class='linksdesc'>{$description}</div><div>$street, $cities, $states, $countries -- $phone</div><div class='linksurl'>URL: $strpurl </div><div class='linkspeer'>Peer Rating -  $PeerOverallpic Votes: $PeerOverallvotecount </div><div class='linkspeer'>Public Rating  $PublicOverallpic Votes: $PublicOverallvotecount</div><div  class='linksrate'>Rate {$row['name']} </style> <a class='linksdisplaysmall' target=\"_blank\" href=\"http://bungeebones.com/link_exchange/public_review_form.php?anum=$affiliate_num&&selected_record=$id&&cat_id=$catid\">Click Here - Vote</a></div>" ;
//removed peer and public ranking 7/24/10 afterRandy Farmer video
$links .= "<hr><div class='linksdisplay'><a  href=\"{$url}\" target=\"_blank\" rel=\"nofollow\"/>{$name}</a></div>";
$links .= "<div class='linksdesc'>{$description}</div><div>$street, $cities, $states, $countries -- $phone</div>" ;

}
else
{

$links .= "<hr><div class='linksdisplay'><a  href=\"{$url}\" target=\"_blank\" rel=\"nofollow\"/>{$name}</a></div>";
$links .= "<div class='linksdesc'>{$description}</div>" ;
}

}//close if nofollow
else
{

 if($street !="" && $cities!=""){
//$links .= "<hr><div class='linksdisplay'><a  href=\"{$url}\" target=\"_blank\" />{$name}</a></div><div class='linksdesc'>{$description}</div><div>$street, $cities, $states, $countries -- $phone</div><div class='linksurl'>URL: $strpurl </div><div class='linkspeer'>Peer Rating -  $PeerOverallpic Votes: $PeerOverallvotecount </div><div class='linkspeer'>Public Rating  $PublicOverallpic Votes: $PublicOverallvotecount</div><div  class='linksrate'>Rate {$row['name']} </style> <a class='linksdisplaysmall' target=\"_blank\" href=\"http://bungeebones.com/link_exchange/public_review_form.php?anum=$affiliate_num&&selected_record=$id&&cat_id=$catid\">Click Here - Vote</a></div>" ;
//removed peer and public ranking 7/24/10 afterRandy Farmer video
$links .= "<hr><div class='linksdisplay'><a  href=\"{$url}\" target=\"_blank\" />{$name}</a></div>";
$links .= "<div class='linksdesc'>{$description}</div><div>$street, $cities, $states, $countries -- $phone</div>" ;

}
else
{

$links .= "<hr><div class='linksdisplay'><a  href=\"{$url}\" target=\"_blank\" />{$name}</a></div>";
$links .= "<div class='linksdesc'>{$description}</div>" ;
}

}//closes if else no follow
}//close while
$links .= '</div>';
}//close if results
//echo 'in yald func links list  =', $links;

//$send_this[0] =$num_rows;
//$send_this[0] = $links;
return $links;
//return $send_this;
}

function test_array(){
$send_this[0] = "test1";
$send_this[1] = "test2";
return $send_this;

}

/*function listLinks($affiliate_num, $url_cat, $cat_page_num, $link_page_num, $pagem_url_cat, $link_page_id, $regional_number, $display_freebies, $time_period, $fb_user_ID, $nofollow )
{global $settings;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$url_cat = mysqli_real_escape_string($connect, $url_cat);
//check if there are any paid links in this category
$limit_by_offset = getPaidLinks($url_cat);//this is the count of paid active links in this cat, with this info we can reduce the limit by in the regular query by this number
//looks like link page id totally removed from list links func and list numeric function
$widget_configs = getWidgetConfigs($affiliate_num);
//print_r($widget_configs);
$fontsize = $widget_configs[0];	
$titlecolor = $widget_configs[1];	
$linktextcolor = $widget_configs[2];	
$catcolor = $widget_configs[3];

//category_affiliateTally($url_cat,$affiliate_num, $regional_number, $fb_user_ID);
$new_reg = explode("|", $regional_number);

define( 'QUERY1', 'SELECT 
links.id AS linksid,
links.url AS linksurl, 
links.name AS linksname,
links.description AS linksdescription,
links.street AS linksstreet,	
links.zip AS linkszip,
links.phone AS linksphone,
links.nofollow AS linksnofollow,
links.peer_rating AS peer_rating,
links.peer_vote_count AS peer_vote_count,
links.public_vote_count AS public_vote_count
 FROM links
LEFT JOIN price_slots_subscripts ON price_slots_subscripts.link_id = links.id
JOIN  `regional_sign_ups` t3 ON links.id = t3.link_id AND price_slots_subscripts.subscribe >0
WHERE links.category = "'.$url_cat.'" and  links.approved="true"');
define( 'QUERY2', '
select links.id AS linksid,
links.url AS linksurl, 
links.name AS linksname,
links.description AS linksdescription,
links.street AS linksstreet,	
links.zip AS linkszip,
links.phone AS linksphone,
links.nofollow AS linksnofollow,
links.peer_rating AS peer_rating,
links.peer_vote_count AS peer_vote_count,
links.public_vote_count AS public_vote_count
FROM links
LEFT JOIN price_slots_subscripts p ON p.link_id = links.id
AND p.subscribe >0
WHERE links.category="'.$url_cat.'" and  links.approved="true" ');
define( 'QUERY3', '
SELECT 
links.id AS linksid,
links.url AS linksurl, 
links.name AS linksname,
links.description AS linksdescription,
links.street AS linksstreet,	
links.zip AS linkszip,
links.phone AS linksphone,
links.nofollow AS linksnofollow,
links.peer_rating AS peer_rating,
links.peer_vote_count AS peer_vote_count,
links.public_vote_count AS public_vote_count

 FROM links
LEFT JOIN price_slots_subscripts p ON p.link_id = links.id
AND p.subscribe >0 
WHERE links.category="'.$url_cat.'" and links.approved="true" ');//only adds a space at end, don't remember why
//make query4middle part of query for the regional links		
if($new_reg[1]=="con"){define( 'REGION_TEXT', 'continents =  "' . $new_reg[0] );
define( 'QUERY4mid', 'continents AS continents');
}
elseif($new_reg[1]=="cou"){define( 'REGION_TEXT', 'countries = "' . $new_reg[0] );
define( 'QUERY4mid', 'countries AS countries');
}
elseif($new_reg[1]=="sta"){define( 'REGION_TEXT', 'states = "' . $new_reg[0] );
define( 'QUERY4mid', 'states AS states');
}
elseif($new_reg[1]=="dis"){define( 'REGION_TEXT', 'districts = "' . $new_reg[0] );
define( 'QUERY4mid', 'districts AS districts');
}
elseif($new_reg[1]=="cit"){define( 'REGION_TEXT', 'cities = "' . $new_reg[0] );
define( 'QUERY4mid', 'cities AS cities');
}

if(isset($new_reg[1])) {

define( 'QUERY4start', 'SELECT r.link_id AS regional_link_id, r.');
define( 'QUERY4end', ', links.category AS category, links.id AS linksid, links.url AS linksurl, links.name AS linksname, links.description AS linksdescription, links.street AS linksstreet, links.zip AS linkszip, links.phone AS linksphone, links.nofollow AS linksnofollow, links.peer_rating AS peer_rating, links.peer_vote_count AS peer_vote_count, links.public_vote_count AS public_vote_count, p.link_id AS price_slot_linkid, p.price_slot_amnt AS price_slot_amt, p.start_date AS start_date
FROM regional_sign_ups r
LEFT JOIN links ON r.link_id = links.id
LEFT JOIN price_slots_subscripts p ON p.link_id = links.id
WHERE links.category = "'.$url_cat.'" 
AND `approved`="true" AND r.link_id = links.id AND r.');
define( 'QUERY4', QUERY4start . QUERY4mid . QUERY4end);
}
if($time_period ==8){
	if($new_reg[0] !=""){
		if(count($new_reg) ==1)//url has only the continent number without con. Indicates it came from the web page
		{
			$query = QUERY1 ." AND t3.continents = ". $new_reg[0];}
		elseif(defined('REGION_TEXT')) {
			$query = QUERY4 . REGION_TEXT. '"';//hard code anything - it is looking for time stamp greater thatn-- don't know why???
		
 }
	}//close if new reg is not null			  
	else //not regional		
	{$query = QUERY3; } 
} 
elseif($time_period ==7){ 
	if(defined('REGION_TEXT')){$query = QUERY4 . REGION_TEXT . '" and ( `freebie` > 0 OR (`freebie` = 0 AND  `start_date` > '. mktime(0, 0, 0, date("m"),   date("d"),   date("Y")-1).'))';	}
else //not regional	
  {$query = QUERY3 . ' and ( `freebie` > 0 OR (`freebie` = 0 AND  `start_date` > ' . mktime(0, 0, 0, date("m"),   date("d"),   date("Y")-1).'))';	 } 
} elseif($time_period <=6 || $time_period >0){ 			 
        if(defined('REGION_TEXT')){$query = QUERY4 . REGION_TEXT . '" and ( `freebie` > 0 OR (`freebie` = 0 AND  `start_date` > '. mktime(0, 0, 0, date("m")-$time_period,   date("d"),   date("Y")).'))';}
	else //not regional
{$query = QUERY2 . ' and ( `freebie` > 0 OR (`freebie` = 0 AND  `start_date` > ' . mktime(0, 0, 0, date("m")-$time_period,   date("d"),   date("Y")).'))'; } 

} 
else
{
//DON//'//T SELECT ANY FREEBIES which is same as time period 0	
//changed from freebie==0 to freebie < 0 during reversal of a freebie being 0 with price slots being higher
	if($new_reg[1]=="con"){$query = QUERY4 . ' freebie > 0 and `continents` =  ' . $new_reg[1]; }
	elseif($new_reg[1]=="cou"){$query = QUERY4 . ' freebie > 0 and `countries`=  ' . $new_reg[1];	 }
	elseif($new_reg[1]=="sta"){ $query = QUERY4 . ' freebie >0 and `states`=  ' . $new_reg[1]; }
	elseif($new_reg[1]=="cit"){$query = QUERY4 . ' freebie >0 and `cities`=  ' . $new_reg[1];  }		
	else
	  {$query = QUERY4 . ' freebie >0 ';	 }// NOT BE REGIONAL and not free 
}	
	
//the query at this point has no order by so it can find number of pages
$query_w_pagntr == $query;
//THE PAGINATOR - gets the page number and sets the limits mathematically from it
//echo 'line 909 incl yald func ', $query;
$result = mysqli_query($connect, $query);
$num_rows = mysqli_num_rows($result);

$total_num_pages = ceil($num_rows/$settings['lr_amm']);

//$total_num_pages retireves the total number of pages so that it can be used later, even after 
//the query has been changed to inlucde limits. The total num of pages is used to determeine the display of a munu or not


if($link_page_num == 1 || $link_page_num==""|| $link_page_num=="0"){// added || $link_page_num=="0" on 7/6/2012 fixing regional select bug
	// because 0 is added as var colector vals iwhen the regioanal number is added 
	//sudden
define('ORDER_BY2', '  ORDER BY p.price_slot_amnt DESC , p.start_date ASC, links.id ASC      LIMIT 0, 20');
}
elseif($link_page_num > 1)//do some math to fet the limits)
{
$lower_limit = 20* ($link_page_num - 1);
$upper_limit = 20 * $link_page_num;
define('ORDER_BY2', '  ORDER BY p.price_slot_amnt DESC , p.start_date ASC  , links.id ASC  LIMIT ' . $lower_limit.','.$upper_limit );
}
$query .= ORDER_BY2;
//this query has order by with limit so will always return 20 as num rows
//echo 'line 859 incl yal func ', $query;
$result = mysqli_query($connect, $query);

if($result){

if($total_num_pages<2){
$links = '<div  id="doc3">';
}
else
{
$links = '<div class="bungeebones" style ="text-align: left;">LINKS PAGE '.links_numeric_menu($url_cat, $cat_page_num,  $link_page_num, $time_period, $link_page_id, $pagem_url_cat).'</div><div class="bungeebones" id="doc3" style ="text-align: left;">';
//added text align left to fix Joomla component centering link display when paginating
}

while($row = mysqli_fetch_array($result)){
$url = htmlentities(stripslashes($row['url']));
preg_match('@^(?:http://)?([^/]+)@i',"$url", $matches);
$host = $matches[1];
// get last two segments of host name
preg_match('/[^.]+\.[^.]+$/', $host, $matches);
$strpurl = $matches[0];

$id = htmlentities(stripslashes($row['linksid']));
$category = htmlentities(stripslashes($row['category']));
$url = htmlentities(stripslashes($row['linksurl']));
$name = htmlentities(stripslashes($row['linksname']));
$description = htmlentities(stripslashes($row['linksdescription']));
$street = htmlentities(stripslashes($row['linksstreet']));	
$zip = htmlentities(stripslashes($row['linkszip']));
$phone = htmlentities(stripslashes($row['linksphone']));
$nofollow = htmlentities(stripslashes($row['linksnofollow']));
$peer_rating = htmlentities(stripslashes($row['linkspeer_rating']));
$peer_vote_count = htmlentities(stripslashes($row['linkspeer_vote_count']));
$public_vote_count = htmlentities(stripslashes($row['linkspublic_vote_count']));
$price_slot_amnt = htmlentities(stripslashes($row['price_slot_amnt']));
$price_slot_start_date = htmlentities(stripslashes($row['start_date']));

if($street !=""){
$query_reg = "SELECT * from `regional_sign_ups` WHERE `link_id` = $id";
$result2 = mysqli_query($connect, $query_reg);
while($row = mysqli_fetch_array($result2)){
$continents = htmlentities(stripslashes($row['continents']));	
$continents = regionName($continents);
$countries = htmlentities(stripslashes($row['countries']));
$countries = regionName($countries);	
$states = htmlentities(stripslashes($row['states']));
$states = regionName($states);
$districts = htmlentities(stripslashes($row['districts']));
$districts = regionName($districts);	
$cities  = htmlentities(stripslashes($row['cities']));
$cities = regionName($cities);

}

}


//include('insert_ratings_pic.php');
//rel="nofollow"
if($nofollow =="on"){
if($street !="" && $cities!=""){
//$links .= "<hr><div class='linksdisplay'><a  href=\"{$url}\" target=\"_blank\" />{$name}</a></div><div class='linksdesc'>{$description}</div><div>$street, $cities, $states, $countries -- $phone</div><div class='linksurl'>URL: $strpurl </div><div class='linkspeer'>Peer Rating -  $PeerOverallpic Votes: $PeerOverallvotecount </div><div class='linkspeer'>Public Rating  $PublicOverallpic Votes: $PublicOverallvotecount</div><div  class='linksrate'>Rate {$row['name']} </style> <a class='linksdisplaysmall' target=\"_blank\" href=\"http://bungeebones.com/link_exchange/public_review_form.php?anum=$affiliate_num&&selected_record=$id&&cat_id=$catid\">Click Here - Vote</a></div>" ;
//removed peer and public ranking 7/24/10 afterRandy Farmer video
$links .= "<hr><div class='linksdisplay'><a  href=\"{$url}\" target=\"_blank\" rel=\"nofollow\"/>{$name}</a></div>";
$links .= "<div class='linksdesc'>{$description}</div><div>$street, $cities, $states, $countries -- $phone</div>" ;

}
else
{

$links .= "<hr><div class='linksdisplay'><a  href=\"{$url}\" target=\"_blank\" rel=\"nofollow\"/>{$name}</a></div>";
$links .= "<div class='linksdesc'>{$description}</div>" ;
}

}//close if nofollow
else
{

 if($street !="" && $cities!=""){
//$links .= "<hr><div class='linksdisplay'><a  href=\"{$url}\" target=\"_blank\" />{$name}</a></div><div class='linksdesc'>{$description}</div><div>$street, $cities, $states, $countries -- $phone</div><div class='linksurl'>URL: $strpurl </div><div class='linkspeer'>Peer Rating -  $PeerOverallpic Votes: $PeerOverallvotecount </div><div class='linkspeer'>Public Rating  $PublicOverallpic Votes: $PublicOverallvotecount</div><div  class='linksrate'>Rate {$row['name']} </style> <a class='linksdisplaysmall' target=\"_blank\" href=\"http://bungeebones.com/link_exchange/public_review_form.php?anum=$affiliate_num&&selected_record=$id&&cat_id=$catid\">Click Here - Vote</a></div>" ;
//removed peer and public ranking 7/24/10 afterRandy Farmer video
$links .= "<hr><div class='linksdisplay'><a  href=\"{$url}\" target=\"_blank\" />{$name}</a></div>";
$links .= "<div class='linksdesc'>{$description}</div><div>$street, $cities, $states, $countries -- $phone</div>" ;

}
else
{

$links .= "<hr><div class='linksdisplay'><a  href=\"{$url}\" target=\"_blank\" />{$name}</a></div>";
$links .= "<div class='linksdesc'>{$description}</div>" ;
}

}//closes if else no follow
}//close while
$links .= '</div>';
}//close if results

return $links;
}*/

function maxBid($bid_amount, $link_id, $auc_id, $open_slot){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$query = "
SELECT max( `bid_amount`) 
AS current_high_bid_amount, auc_id, bid_time, link_id  
FROM `bid_receiver` 
WHERE `auc_id` = (

SELECT max(`auc_id`) AS auc_id
FROM `bid_receiver` 
WHERE `cat_id` =3 )GROUP BY auc_id";
//echo '<br>get max bid query = ', $query;
$result = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_array($result)) 
    {
    	$auc_id = $row['auc_id'];
	$link_id = $row['link_id'];
	$bid_time = $row['bid_time'];
	$current_high_bid_amount = $row['current_high_bid_amount'];
    $cat_id=$row['cat_id'];
		}//close while
		//echo '<br>$current_high_bid_amount = ', $current_high_bid_amount ;
		//echo '<br>new bid amount = ', $bid_amount;








if($current_high_bid_amount > $bid_amount){


$query = "
update `links` set `bungee_cash_balance` = bungee_cash_balance - $bid_amount WHERE `id` =
	(SELECT max( `bid_amount`) AS current_high_bid 
FROM `bid_receiver` 
WHERE `auc_id` = ( 



SELECT max( `auc_id` ) AS auc_id
FROM `bid_receiver` 
WHERE `cat_id` =3 )) 
"; 
//echo '<br>in get max bid query greater than current = ', $query;
$result = mysqli_query($connect, $query) or die("<p align='left'>There was a problem submitting your link. Usually this is the result of attempting to submit a duplicate entry. If such is the case, return to your admin control panel and use the 'Modify' link to check for and/or change a previous duplicate entry. If such is not the case please use the 'Contact' form in the main menu to contact the qdministrator with the details of the problem. Thank you and sorry for any inconvenience this may have caused you. "); 

}//close if greater than





else
{
echo '<br>the bid was not high enough';
exit();
}

}


function submitLinkBids($bid_amount, $link_id, $auc_id, $open_slot){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

//insert every bid made into bid_receiver
$query = "INSERT INTO `bid_receiver` (`auc_id`, `link_id`, `bid_amount` ,`bid_time`, `cat_id` ) values ('$auc_id', '$website_id', '$place_bid','$timestamp', '$cat_id' )";
$result = mysqli_query($connect, $query) or die("<p align='left'>There was a problem submitting your link. Usually this is the result of attempting to submit a duplicate entry. If such is the case, return to your admin control panel and use the 'Modify' link to check for and/or change a previous duplicate entry. If such is not the case please use the 'Contact' form in the main menu to contact the qdministrator with the details of the problem. Thank you and sorry for any inconvenience this may have caused you. "); 
// deduct amount from available balance in links

//echo '<br>in submitlinkBid query = ', $query;
}

function repayLastRankLinkBids($bid_amount, $link_id, $open_slot){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

//find where the current bid ranks
			if($open_slot=9999){
			//is an IPO so $limit is 20
			$limit_num=20;
			}
			else
			{
			$limit_num==$open_slot;
			}
$link_id ="";
$bid_amount = "";
$query = "
	SELECT * 
FROM `bid_receiver` 
WHERE `auc_id` = ( 
SELECT max( `auc_id` ) AS auc_id
FROM `bid_receiver` 
WHERE `cat_id` = $cat_id ) 
ORDER BY `bid_amount` DESC 
LIMIT 0 , $limit_num "; 
	//echo '<br>repayLastRankLinkBids = ',$query;
	$result = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_array($result)) 
    {
    	$auc_id[] = $row['auc_id'];
	$link_id[] = $row['link_id'];
	$bid_time[] = $row['bid_time'];
	$bid_amount[] = $row['bid_amount'];
    $cat_id[]=$row['cat_id'];
		}//close while
		//echo '$bid_amount[19] = ', $bid_amount[19];
$query = "update `links` set `bungee_cash_balance` = bungee_cash_balance + $bid_amount[19] WHERE `id` = $link_id[19]";
//echo '<br>in repaylastlinkBid query = ',  $query;
$result = mysqli_query($connect, $query) or die("<p align='left'>There was a problem submitting your link. Usually this is the result of attempting to submit a duplicate entry. If such is the case, return to your admin control panel and use the 'Modify' link to check for and/or change a previous duplicate entry. If such is not the case please use the 'Contact' form in the main menu to contact the qdministrator with the details of the problem. Thank you and sorry for any inconvenience this may have caused you. "); 

	 
}


function rankLinkBids($bid_amount, $link_id, $open_slot){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

//find where the current bid ranks
			if($open_slot=9999){
			//is an IPO so $limit is 20
			$limit_num=20;
			}
			else
			{
			$limit_num==$open_slot;
			}
$link_id ="";
$bid_amount = "";
$query = "
	SELECT * 
FROM `bid_receiver` 
WHERE `auc_id` = ( 
SELECT max( `auc_id` ) AS auc_id
FROM `bid_receiver` 
WHERE `cat_id` =3 ) 
ORDER BY `bid_amount` DESC 
LIMIT 0 , $limit_num "; 
	//echo $query;
	$result = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_array($result)) 
    {
    	$auc_id[] = $row['auc_id'];
	$link_id[] = $row['link_id'];
	$bid_time[] = $row['bid_time'];
	$bid_amount[] = $row['bid_amount'];
    $cat_id[]=$row['cat_id'];
		}//close while
		
	//	foreach ($link_id as $value) {
  //  echo "Value: $value<br />\n";
//}

}

function getRegionalLabel($new_reg_to_function){

                     if($new_reg_to_function=="con"){
					$regional_label = "continents";	 }
					 elseif($new_reg_to_function=="cou"){
					$regional_label = "countries";	
					}
					 elseif($new_reg_to_function=="sta")
					 {
					 $regional_label = "states";	 
					  }
					  elseif($new_reg_to_function=="cit")
					  {
					 $regional_label = "cities";	
					 }
				 
return $regional_label;
}


function howManyWidgets(){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$query = 'SELECT distinct `widget_id` FROM `warehouse_click_tally`';

$result = mysqli_query($connect, $query);
$num_rows = mysqli_num_rows($result);
while($row = @mysqli_fetch_array($result)){
$widget_id[] = htmlentities(stripslashes($row['widget_id']));
}
return $widget_id ;
}

function howManyQueries($widget_id){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$query = 'SELECT *  FROM `warehouse_click_tally` where `widget_id`= '.$widget_id. '; ';


$result = mysqli_query($connect, $query);
$num_rows = mysqli_num_rows($result);
return $num_rows;
}

function switchNameforNum($cat_num){
global $settings,$affiliate_num,$folder_name,$file_name;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$path == "";

$query = 'SELECT name FROM `'.$settings['categories_table'].'` WHERE id = '.$cat_num. ' ;';
$result = mysqli_query($connect, $query);
while($row = @mysqli_fetch_array($result)){
$cat_name = htmlentities(stripslashes($row['name']));
}
	$path .= '<a href="/'.$folder_name.'/'.$file_name.'/'. $affiliate_num.'">'.$cat_name.'</a>';
	
	//}
	return $cat_name;
//return $is_niche;
}

function switchNumforName($cat_name){
global $settings,$affiliate_num,$folder_name,$file_name;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$path == "";

$query = 'SELECT id FROM `'.$settings['categories_table'].'` WHERE name = '.$cat_name. ' ;';
$result = mysqli_query($connect, $query);
while($row = @mysqli_fetch_array($result)){
$cat_id = htmlentities(stripslashes($row['id']));
}
	$path .= '<a href="/'.$folder_name.'/'.$file_name.'/'. $affiliate_num.'/">'.$cat_name.'</a>';
	
	//}
	return $cat_id;
//return $is_niche;
}




function makeNicheMaiinPage($is_niche){
global $settings,$affiliate_num,$folder_name,$file_name;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$path == "";

$query = 'SELECT name FROM `'.$settings['categories_table'].'` WHERE id = '.$is_niche. ' ;';
$result = mysqli_query($connect, $query);
while($row = @mysqli_fetch_array($result)){
$cat_name = htmlentities(stripslashes($row['name']));
}
//echo 'cat_name = ', $cat_name;
//while($row = @mysqli_fetch_array($result)){
//if($row['id'] != '1'){
//echo 'name = ', $name;
//$path .= '<a href="/'.$folder_name.'/'.$file_name.'/'. $affiliate_num.'/'.$row['id'].'">'.$cat_name.'</a>';
	$path .= '<a href="/'.$folder_name.'/'.$file_name.'/'. $affiliate_num.'/">'.$cat_name.'</a>';
	
	//}
	return $path;
//return $is_niche;
}
function getFolderFile($affiliate_num){
global $settings, $affiliate_num;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

require('../includes/connect.php');
//see change log in admin
//$query = 'SELECT * FROM `links` WHERE `id`= '.$affiliate_num;
$query = 'SELECT * FROM `widgets` WHERE `link_id`= '.$affiliate_num;	
	$result = mysqli_query($connect, $query);
	$num_rows = mysqli_num_rows($result);
	if($num_rows > 0){
		while($row = mysqli_fetch_array($result)){
	$folder_name = htmlentities(stripslashes($row['folder_name']));
			$file_name = htmlentities(stripslashes($row['file_name']));
		$folder_file = array($folder_name,$file_name);
	$folder_file =	implode(" ",$folder_file);
}
}
return $folder_file;
}

function webmaster_favorites($category){
$webmaster_favs = '<div align="center"><table border="0" cellpadding="0"><tr align="center"><td align="center">';
$webmaster_favs .= '<b><font size="5">Our Webmasters\' Favorite '.categoryNameFavs($category).' LINKS:</font></b><br />';
$webmaster_favs .= listLinksFavs($category);
$webmaster_favs .="</td></tr></table></div>";	
	return $webmaster_favs;
}

function no_links($cat_name){
$empty_links = include('nav_page_for empty.htm');
return $empty_links;
}

function urlExists($url){
	if (@fopen($url,"r")) {
		return true;
	} else {
		return false;
	}
}


function categoryExists($id){
	global $settings;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$id=mysqli_real_escape_string($connect, $id);
	$query = 'SELECT * FROM '.$settings['categories_table'].' WHERE id="'.$id.'"';
	$result = mysqli_query($connect, $query);
	if(mysqli_num_rows($result)==0){
		return false;
	} else {
		return true;
	}
}

function linkUrlExists($url){
	global $settings;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$url=mysqli_real_escape_string($connect, $url);
	$query = 'SELECT * FROM `'.$settings['links_table'].'` WHERE url="'.$url.'"';
	$result = mysqli_query($connect, $query);
	if(mysqli_num_rows($result)==0){
		return false;
	} else {
		return true;
	}
}


function linkUrl($id){
	global $settings;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$id=mysqli_real_escape_string($connect, $id);
	$query = 'SELECT url FROM '.$settings['links_table'].' WHERE id="'.$id.'"';
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_row($result);
	return $row[0];
}

function cookie_Trail($catid){
	global $settings,$affiliae_num;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

	$path = '';
$catid=mysqli_real_escape_string($connect, $catid);
	$query = 'SELECT lft,rgt FROM `'.$settings['categories_table'].'` WHERE id="'.$catid.'"';
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);
	$lft = $row['lft'];
	$rgt = $row['rgt'];
	$query = 'SELECT name,id FROM `'.$settings['categories_table'].'` WHERE lft < '.$lft.' AND rgt > '.$rgt.' ORDER BY lft ASC;';
	$result = mysqli_query($connect, $query);
	while($row = @mysqli_fetch_array($result)){
		if($row['id'] != '1')
	$path .= '-->'.'<a href="/members/reg_form.php?cat_id=1'. '">'.$row['name'].'</a>';
	}
	return $path;
}

function searchPath($catid){
	global $settings,$affiliae_num;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

	$path = '';
$catid=mysqli_real_escape_string($connect, $catid);
	$query = 'SELECT lft,rgt FROM `'.$settings['categories_table'].'` WHERE id="'.$catid.'"';
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);
	$lft = $row['lft'];
	$rgt = $row['rgt'];
	$query = 'SELECT name,id FROM `'.$settings['categories_table'].'` WHERE lft < '.$lft.' AND rgt > '.$rgt.' ORDER BY lft ASC;';
	$result = mysqli_query($connect, $query);
	while($row = @mysqli_fetch_array($result)){
		if($row['id'] != '1')
$path .= '+'.$row['name'];
	}
	return $path;
}

function categoryPath($catid, $regional_number){
	global $settings,$affiliate_num,$folder_name,$file_name;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");


	$path = '';
$catid=mysqli_real_escape_string($connect, $catid);
$categories_table=mysqli_real_escape_string($connect, $settings['categories_table']);
	$query = 'SELECT lft,rgt FROM `'.$categories_table.'` WHERE id="'.$catid.'"';
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);
	$lft = $row['lft'];
	$rgt = $row['rgt'];
	$query = 'SELECT name,id FROM `'.$settings['categories_table'].'` WHERE lft < '.$lft.' AND rgt > '.$rgt.' ORDER BY lft ASC;';
	$result = mysqli_query($connect, $query);
	while($row = @mysqli_fetch_array($result)){
		if($row['id'] != '1')
if($regional_number != ""){
if($folder_name == "root"){
$path .= $settings['nav_separator'].'<a href="/'.$file_name.'/'. $affiliate_num.'/'.$row['id'].'///////'.$regional_number.'">'.$row['name'].'</a>';

}
else
{

$path .= $settings['nav_separator'].'<a href="/'.$folder_name.'/'.$file_name.'/'. $affiliate_num.'/'.$row['id'].'///////'.$regional_number.'">'.$row['name'].'</a>';
}


}
else
{
if($folder_name == "root"){
$path .= $settings['nav_separator'].'<a href="/'.$file_name.'/'. $affiliate_num.'/'.$row['id'].'">'.$row['name'].'</a>';

}
else
{

$path .= $settings['nav_separator'].'<a href="/'.$folder_name.'/'.$file_name.'/'. $affiliate_num.'/'.$row['id'].'">'.$row['name'].'</a>';
}
}
	}



	return $path;
}


function categoryParent($catid){
	global $nav, $settings;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$catid=mysqli_real_escape_string($connect, $catid);
$categories_table=mysqli_real_escape_string($connect, $settings['categories_table']);
	$query = 'SELECT parent FROM '.$categories_table.' WHERE id="'.$catid.'"';
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_row($result);
	return $row[0];
}


function linkCategory($id){
	global $nav, $settings;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$id=mysqli_real_escape_string($connect, $id);
$links_table=mysqli_real_escape_string($connect, $settings['links_table']);
	$query = 'SELECT category FROM '.$links_table.' WHERE id="'.$id.'"';
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_row($result);
	return $row[0];
}

function linkRemove($id){
	global $nav, $settings;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$id=mysqli_real_escape_string($connect, $id);
$links_table=mysqli_real_escape_string($connect, $settings['links_table']);
	$query = 'DELETE FROM '.$links_table.' WHERE id="'.$id.'"';
	mysqli_query($connect, $query);
}

function stripslashes_array($value){
	$value = is_array($value) ?
	array_map('stripslashes_array', $value) :
	stripslashes($value);
	return $value;
}


function subCat($parent){

	global $settings;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$parent=mysqli_real_escape_string($connect, $parent);
$categories_table=mysqli_real_escape_string($connect, $settings['categories_table']);
	$query = 'SELECT id FROM '.$categories_table.' WHERE parent="'.$parent.'"';

	$result = mysqli_query($connect, $query);

	if(mysqli_num_rows($result)==0){

		return false;

	} else {

		return true;

	}

}
function subCatFavs($parent){

	global $settings;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$parent=mysqli_real_escape_string($connect, $parent);
$categories_table=mysqli_real_escape_string($connect, $settings['categories_table']);
	$query = 'SELECT id FROM '.$categories_table.' WHERE parent="'.$parent.'"';

	$result = mysqli_query($connect, $query);

	if(mysqli_num_rows($result)==0){

		return false;

	} else {

		return true;

	}

}


function hasLinks($catid,$time_period,$regional_number){
	if(categoryLinks($catid,$time_period,$regional_number)){
 return true;
	} else {
		return false;
	}
}

function hasLinksRegional($catid,$time_period,$regional_number){
	if(categoryLinksRegional($catid,$time_period,$regional_number)==0){
		return false;
	} else {
		return true;
	}
}

function hasLinksFavs($catid){

	if(categoryLinksFavs($catid)==0){

		return false;

	} else {

		return true;

	}

}

function categoryName($id){

	global $settings;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$id = mysqli_real_escape_string($connect, $id);
	$categories_table=mysqli_real_escape_string($connect, $settings['categories_table']);
	$query = 'SELECT name FROM '.$categories_table.' WHERE id="'.$id.'"';

	$result = mysqli_query($connect, $query);

	$row = mysqli_fetch_row($result);

	return $row[0];

}


function categoryNameFavs($id){

	global $settings;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$id = mysqli_real_escape_string($connect, $id);
	$categories_table=mysqli_real_escape_string($connect, $settings['categories_table']);
	$query = 'SELECT `name` FROM '.$categories_table.' WHERE id="'.$id.'"';
//echo '867 = ', $query;
	$result = mysqli_query($connect, $query);

	$row = mysqli_fetch_row($result);

	return $row[0];

}

// # of links in a category

function categoryLinks($catid,$time_period,$regional_number){
	global $settings;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$catid = mysqli_real_escape_string($connect, $catid);
	$new_reg = explode("|", $regional_number);
	$ajax_or_webpage = count($new_reg);

if($ajax_or_webpage>1){
$new_reg_to_function = $new_reg[1];// I may have changed the order in the array for the number so switched this to 0
// if it works don't need the if else condition as both are [0]
}
else
{
$new_reg_to_function = $new_reg[0];//if there is only one item in the array, it is the regional numberr
}

$reg_label = getRegionalLabel($new_reg_to_function ) ;
if($time_period ==8)
	{
	if($reg_label != ""){
 $query="SELECT `link_id`
FROM regional_sign_ups
LEFT JOIN links ON links.id = regional_sign_ups.link_id
WHERE links.category = ".$catid." AND regional_sign_ups.".$reg_label." = ".$new_reg[0]." and `approved`='true' ORDER BY links.freebie DESC, links.id ASC";
 }
		 else //not regional
		 {
		$query = 'SELECT * FROM `'.$settings['links_table'].'` WHERE `category`="'.$catid.'" and `approved`="true"  ORDER BY `freebie` DESC, `id` ASC';
 } 

} 
elseif($time_period =="7")
{ 
 if($reg_label != ""){
$query="SELECT `link_id`
FROM regional_sign_ups
LEFT JOIN links ON links.id = regional_sign_ups.link_id
WHERE links.category = ".$catid." AND regional_sign_ups.".$reg_label." = ".$new_reg[0]." AND links.approved='true' 
and ( links.freebie > 0 OR (links.freebie = 0 AND `start_date` > " . mktime(0, 0, 0, date("m"),   date("d"),   date("Y")-1) . "))
ORDER BY links.freebie DESC, links.price_slot_amnt DESC, links.ps_seniority_date ASC, links.id ASC";

		}
                   else //not regional
					 {
					$query = 'SELECT * FROM `'.$settings['links_table'].'` WHERE `category`="'.$catid.'" and `approved`="true"  and  `start_date` > ' . mktime(0, 0, 0, date("m"),   date("d"),   date("Y")-1) . ' ORDER BY `freebie` DESC, `price_slot_amnt` DESC, `ps_seniority_date` ASC, links.id ASC';
					 } 
} 
elseif($time_period =="0")// time period can equal 6,5,4,3,2,1,0
{//check if is time period = 0
		  //DON'T SELECT ANY FREEBIES

		   if($reg_label != ""){
$query="SELECT `link_id`
FROM regional_sign_ups
LEFT JOIN links ON links.id = regional_sign_ups.link_id
WHERE links.freebie > 0 AND links.category = ".$catid." AND regional_sign_ups.".$reg_label." = ".$new_reg[0]." and `approved`='true' ORDER BY links.freebie DESC, links.price_slot_amnt DESC, links.ps_seniority_date ASC";
					 
					}
                   else //not regional
					 {
					$query = 'SELECT * FROM `'.$settings['links_table'].'` WHERE `category`="'.$catid.'" and `approved`="true" and `freebie`> 0  ORDER BY `freebie` DESC, `price_slot_amnt` DESC, `ps_seniority_date` ASC';
					 } 
		  
 }
else// time period can equal 6,5,4,3,2,1,
{ 
  	 if($reg_label != ""){

date_default_timezone_set('America/New_York');

$query="SELECT `link_id`
FROM regional_sign_ups
LEFT JOIN links ON links.id = regional_sign_ups.link_id
WHERE links.category = ".$catid." AND regional_sign_ups.".$reg_label." = ".$new_reg[0]." AND links.approved='true' 
and ( links.freebie > 0 OR (links.freebie = 0 AND `start_date` > " . mktime(0, 0, 0, date("m"),   date("d"),   date("Y")-1) . "))
ORDER BY links.freebie DESC, links.price_slot_amnt DESC, links.ps_seniority_date ASC, links.id ASC";
					}
					  else //not regional
					 {
date_default_timezone_set('America/New_York');
					$query = 'SELECT * FROM `'.$settings['links_table'].'` WHERE `category`="'.$catid.'" and `approved`="true"  and `start_date` < '. mktime(0, 0, 0, date("m")  , date("d"), date("Y")) . ' and ( links.freebie > 0 OR (links.freebie = 0 AND  `start_date` > ' . mktime(0, 0, 0, date("m")-$time_period,   date("d"),   date("Y")) . ')) ORDER BY freebie DESC, price_slot_amnt DESC, ps_seniority_date ASC, id ASC';
					 } 
}
	
	if($result = mysqli_query($connect, $query)){
$num_rows = mysqli_num_rows($result);
}
	return $num_rows ;
}

function categoryLinksFavs($id){
	global $settings;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
	$query = "SELECT * FROM `social_network` WHERE category_number=";
$id = mysqli_real_escape_string($connect, $id);
	$query .= '"'.$id.'" and pubpri="0" and `approved`="true"';
	$result = mysqli_query($connect, $query);
	return mysqli_num_rows($result);
}


function totalCategoryLinks($id){
//mark for deprecation -returns a variable name not anywhere in function
	global $settings;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
	$links = categoryLinks($id);
$catid = mysqli_real_escape_string($connect, $catid);
$categories_table=mysqli_real_escape_string($connect, $settings['categories_table']);
	$query = 'SELECT lft,rgt FROM `'.$categories_table.'` WHERE id="'.$catid.'"';
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);
	$lft = $row['lft'];
	$rgt = $row['rgt'];
	$query = 'SELECT id FROM `'.$categories_table.'` WHERE lft < '.$lft.' AND rgt > '.$rgt.' ORDER BY lft ASC;';
	$result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_array($result)){
		$links = $links + categoryLinks($row['id']);
	}

	return $path;

}


function totalCategoryLinksFavs($id){
 //mark for deprecation -returns a variable name not anywhere in function       
	global $settings;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");



	$links = categoryLinksFavs($id);

$catid = mysqli_real_escape_string($connect, $catid);
$categories_table=mysqli_real_escape_string($connect, $settings['categories_table']);

	$query = 'SELECT lft,rgt FROM `'.$categories_table.'` WHERE id="'.$catid.'"';

	$result = mysqli_query($connect, $query);

	$row = mysqli_fetch_array($result);

	$lft = $row['lft'];

	$rgt = $row['rgt'];



	$query = 'SELECT id FROM `'.$categories_table.'` WHERE lft < '.$lft.' AND rgt > '.$rgt.' ORDER BY lft ASC;';

	$result = mysqli_query($connect, $query);

	while($row = mysqli_fetch_array($result)){

		$links = $links + categoryLinksFavs($row['id']);

	}

	return $path;

}


function printError($error){

	global $settings;

	include($settings['template_header']);

	print $error;

	include($settings['template_footer']);

	exit;

}


function subcategoryLinks($id){

	global $settings;
	//this func same as categoryLinks()
$id = mysqli_real_escape_string($connect, $id);
$links_table=mysqli_real_escape_string($connect, $settings['links_table']);
	$query = 'SELECT id FROM '.$links_table.' WHERE `category`="'.$id.'" and `approved`="true"';

	$result = mysqli_query($connect, $query);

	return mysqli_num_rows($result);

}


function subcategoryLinksFavs($id){

	global $settings;
	//this func same as categoryLinks()
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$id = mysqli_real_escape_string($connect, $id);

	$query = 'SELECT id FROM `social_network` WHERE category_number="'.$id.'" ';

	$result = mysqli_query($connect, $query);

	return mysqli_num_rows($result);

}
function totalsubCategoryLinks($id){
        
	global $settings;
	//same function as totalCategoryLink() above
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$id = mysqli_real_escape_string($connect, $id);
$categories_table=mysqli_real_escape_string($connect, $settings['categories_table']);
	$links = subcategoryLinks($id);
	$query = 'SELECT lft,rgt FROM `'.$categories_table.'` WHERE id="'.$id.'"';
	$result = mysqli_query($connect, $query);

	$row = mysqli_fetch_array($result);

	$lft = $row['lft'];

	$rgt = $row['rgt'];
	$links="";
	$query = 'SELECT id FROM `'.$categories_table.'` WHERE lft > '.$lft.' AND rgt < '.$rgt.' ORDER BY lft ASC;';
	$result = mysqli_query($connect, $query);

	while($row = mysqli_fetch_array($result)){

		$links = $links + categoryLinks($row['id']);
			}

	//return $path;
return $links;
}


function totalsubCategoryLinksFavs($id){
        
	global $settings;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

	//same function as totalCategoryLink() above
	$links = subcategoryLinksFavs($id);
$id = mysqli_real_escape_string($connect, $id);
$categories_table=mysqli_real_escape_string($connect, $settings['categories_table']);
	$query = 'SELECT lft,rgt FROM `'.$categories_table.'` WHERE id="'. $id.'"';
	$result = mysqli_query($connect, $query);

	$row = mysqli_fetch_array($result);

	$lft = $row['lft'];

	$rgt = $row['rgt'];
	$links="";
	$query = 'SELECT id FROM `'.$categories_table.'` WHERE lft > '.$lft.' AND rgt < '.$rgt.' ORDER BY lft ASC;';
	$result = mysqli_query($connect, $query);

	while($row = mysqli_fetch_array($result)){

		$links = $links + categoryLinksFavs($row['id']);
			}

	//return $path;
return $links;
}



function listCategories($url_cat,$cat_page_num, $regional_number, $time_period){
global $settings, $folder_name, $file_name, $affiliate_num, $cat_page_num,$link_page_id, $link_page_num, $link_record_num;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$preamm = mysqli_real_escape_string($connect, ($cat_page_num - 1)* $settings['amm'] );
$amm = mysqli_real_escape_string($connect, $settings['amm']);
$categories_table= mysqli_real_escape_string($connect, $settings['categories_table']);
	
//what the hay was cat recrd num? it looks like string true or boolean?
//whewe is the result(select id) used and how would cat record num affect its operation?
//it is only used in the select query so, again, whwere does it come from?
//iS from global, which is not good...
//list where occurs here ... 
//not on index page
//in params of alphmenu call on alphapager page ut not in script -- removed from it and alphamenu
$widget_configs = getWidgetConfigs($affiliate_num);
//print_r($widget_configs);
$fontsize = $widget_configs[0];	
$titlecolor = $widget_configs[1];	
$linktextcolor = $widget_configs[2];	
$catcolor = $widget_configs[3];	


//try the same with cat pag num
//but if no page then it selects for the cat num?
If($cat_page_num == 'true'){
	$select_id = $cat_page_num; 
	}
	else
	{
	$select_id = $url_cat;
	}

		$totalCatpages=totalCatpages($url_cat);
		
			 if($totalCatpages>1 && $url_cat != 1){ 

						If($cat_page_num > 1)
							{
									//$cat_page_id = the cuurent page - if the current page is greater
									//than one, place a limit in the query to get the right page
							 $query = 'SELECT * FROM '.$categories_table.' WHERE parent= "'. $select_id.'" AND `is_approved`="1" ORDER BY name ASC LIMIT '.$preamm.','.$amm.'   ';
								$result = mysqli_query($connect, $query);
							include('alpha_pager.php');
					
							}
							else//place a limit in the query to get the first page
							{
									
							 $query = 'SELECT * FROM '.$categories_table.' WHERE parent= "'.$select_id.'" AND `is_approved`="1" ORDER BY name ASC LIMIT 0,'.$amm.'   ';
$result = mysqli_query($connect, $query);
							include('alpha_pager.php');
					
								}//ends 2nd if
			}
			else//means there is only one page worth of cats
			//do a query that retrieves all the records in that cat with no limit
			{ 
			$query = 'SELECT * FROM '.$settings['categories_table'].' WHERE parent= "'.$select_id.'" AND `is_approved`="1" ORDER BY name ASC   ';
$result = mysqli_query($connect, $query);
			}						
	$result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_array($result)){
		$id[] = $row['id'];
		$name[] = $row['name'];
		$population[] = $row['population'];
		//$sub_population[] = $row['sub_population'];
		$pop_cont[] = $row['pop_cont'];
		//$subpop_cont[] = $row['subpop_cont'];
		$pop_country[] = $row['pop_country'];
		//$subpop_country[] = $row['subpop_country'];
		$pop_state[] = $row['pop_state'];
		//$subpop_state[] = $row['subpop_state'];
		$pop_city[] = $row['pop_city'];
		//$subpop_city[] = $row['subpop_city'];
		//maybe change the multiple cats for regionals one  in an array
	}
	///////////////////////
///////////////////
	//build the category display
	$num_rows = mysqli_num_rows($result);
	if($num_rows > 0){//build cat_info var for display
		$cats = "<table  align='center' cellspacing='5' cellpadding='5' width='100%' border='0' style='color: $catcolor; font-size: larger;'><tr align='center'><td align='left' width='50%' valign='top'>	<ul>";
	if($num_rows % 2){
		$divnum = $num_rows+1;
	} else {
		$divnum = $num_rows;
	}





	for($i=0; $i < $num_rows; $i++){
		if($i == $divnum/2){
			$cats .= '</ul></td><td width="50%" align="left" valign="top"><ul>';
		}

	
////new insert from mobile class

if(is_numeric($regional_number)){
//means there is no pipe separated val and thus is a continent	
$sql="SELECT `id` from  `links`where `category` = ".$id[$i]." AND `continents` = ".$regional_number;
}
elseif(!$regional_number=="")
{
//echo '<br> line 2221 link ex incl yald func css is regional number  is empty ';
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
elseif($regional_number_val[1]=="con"){
		$sql="SELECT `id` from `links`where `category` = ".$id[$i]." AND `continents` = ".$regional_number_val[0];
		}
}
else{//try this because it is not regional
$sql="SELECT `id` from `links`where `category` = ".$id[$i];
}
$result = mysqli_query($connect, $sql);

if($result){
$num_rows2 = mysqli_num_rows($result);
//echo '$num_rows2 =    ', $num_rows2;
}





///////////////////////////////end new inser

	//this is where the AJAX population action needs to occur
		$npopulation= explode(",",$population[$i]);
		//$nsub_population= explode(",",$sub_population[$i]);
//what is npopulation 14? is it the total pop where the timeperiod is 8?
//but it certainly isn't the pop when the region number is the us or canad or france!
//the next if else is for regional nums
//is is accurate??

		$time_period_adjust = ($time_period - 1) * 2;
//echo '<br>id I == ', $id[$i];
$name[$i]  = stripslashes($name[$i]); //added on 10/9/2011 because names such as Men's had a slash added
if($regional_number!=""){//if there is a regional number
//to get npopulation you have to run a query for that cat and that region
//how many links in the real estate cat in france
//so this following url does not do that
	if($folder_name=="root")//is a install at root
	{
	$cats .= '<li><font id="u'.$id[$i].'" ><strong><a href="/'.$file_name.'/'.$affiliate_num.'/'.$id[$i].'/0/0/0/0/0/0/'.$regional_number.'/">'.$name[$i].'/</a></strong></font><i><small> (<font id="c'.$id[$i].'">'.$npopulation[14].'</font>)</small></i>';
	
	}
	else
	{
	$cats .= '<li><font id="u'.$id[$i].'" ><strong><a href="/'.$folder_name.'/'.$file_name.'/'.$affiliate_num.'/'.$id[$i].'/0/0/0/0/0/0/'.$regional_number.'/">'.$name[$i].'/</a></strong></font><i><small> (<font id="c'.$id[$i].'">'.$npopulation[14].'</font>)</small></i>';
	}
}
else
{//echo 'oncl yald func in else not regional';
	if($folder_name=="root")//is a install at root
		{
		$cats .= '<li><font id="u'.$id[$i].'" ><strong><a href="/'.$file_name.'/'.$affiliate_num.'/'.$id[$i].'/">'.$name[$i].'/</a></strong></font><i><small> (<font id="c'.$id[$i].'">'.$npopulation[14].'</font>)</small></i>';
	
		}
		else
		{

		$cats .= '<li><font id="u'.$id[$i].'" ><strong><a href="/'.$folder_name.'/'.$file_name.'/'.$affiliate_num.'/'.$id[$i].'/">'.$name[$i].'/</a></strong></font><i><small> (<font id="c'.$id[$i].'">'.$npopulation[14].'</font>)</small></i>';
	
		}
}
If($npopulation[$time_period_adjust+1] > 0){

		$cats .= '<i><small>(<font id="sc'.$id[$i].'">'.$npopulation[15].'</font>)</small></i>';
}
		$cats .= '</li>';

//change id[] to name[] to get name into directory category list urls
	}//close for each num rows?
	$cats .= '</ul></td></tr></table>';
	
	$cats .= "$nav_barf ";
////have one too many } between here and end of query list	
	
}//close if result


else
{
$cats = "false";
}
return $cats;
}

function listCategoriesNoTally($url_cat,$cat_page_num,$regional_number, $time_period){
		global $settings, $folder_name, $file_name, $affiliate_num, $cat_page_num,$cat_page_id,$link_page_id, $link_page_num, $link_record_num;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$preamm = mysqli_real_escape_string($connect, ($cat_page_id - 1)* $settings['amm'] );
$amm = mysqli_real_escape_string($connect, $settings['amm']);
$categories_table= mysqli_real_escape_string($connect, $settings['categories_table']);

//coverted to cat page num on jan fourth - is a stab in the dark while refactoring getting rid of cat record num
If($cat_page_num == 'true'){
	$select_id = $cat_page_num; 
	}
	else
	{
	$select_id = $url_cat;
	}

		$totalCatpages=totalCatpages($url_cat);
			 if($totalCatpages>1 && $url_cat != 1){
						If($cat_page_id > 1)
							{
									//$cat_page_id = the cuurent page - if the current page is greater
									//than one, place a limit in the query to get the right page
							 $query = 'SELECT * FROM '.$categories_table.' WHERE parent= "'.$select_id.'  "ORDER BY name ASC LIMIT '.$preamm.','.$amm.'   ';
								$result = mysqli_query($connect, $query);
							include('alpha_pager.php');
					
							}
							else//place a limit in the query to get the first page
							{
									
							 $query = 'SELECT * FROM '.$categories_table.' WHERE parent= "'.$select_id.'  "ORDER BY name ASC LIMIT 0,'.$amm.'   ';
							$result = mysqli_query($connect, $query);
							include('alpha_pager.php');
					
								}//ends 2nd if
			}
			else//means there is only one page worth of cats
			//do a query that retrieves all the records in that cat with no limit
			{ 


			$query = 'SELECT * FROM '.$categories_table.' WHERE parent= "'.$select_id.'  "ORDER BY name ASC   ';
			$result = mysqli_query($connect, $query);
			}						
	$result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_array($result)){
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
	$num_rows = mysqli_num_rows($result);
	///////////////////////
	//build the category display
	
	
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
		//this is where the AJAX population action needs to occur
		$npopulation= explode(",",$population[$i]);
		//$nsub_population= explode(",",$sub_population[$i]);
		$time_period_adjust = ($time_period - 1) * 2;


//replaced this with copy from main listCategories function but this one uses timeperiod var as parameter while 
//the replacements have hard coded 14 number. Hunch is that the time period one is more correct.
//$cats .= '<li><font size="2"><strong><a href="/'.$folder_name.'/'.$file_name.'/'.$affiliate_num.'/'.$id[$i].'///////'.$regional_number.'">'.$name[$i].'</a></strong></font><i><small>('.$npopulation[$time_period_adjust].')</small></i>';
//also, this addition was after the trailing slash was added to url to accomodat dyn link changer aand regional filter dropdown

if($regional_number!=""){

$cats .= '<li><font id="u'.$id[$i].'" size="'.$fontsize.'"><strong><a href="/'.$folder_name.'/'.$file_name.'/'.$affiliate_num.'/'.$id[$i].'///////'.$regional_number.'/">'.$name[$i].'/</a></strong></font><i><small>(<font id="c'.$id[$i].'">'.$npopulation[14].'</font>)</small></i>';
}
else
{
$cats .= '<li><font id="u'.$id[$i].'" size="'.$fontsize.'"><strong><a href="/'.$folder_name.'/'.$file_name.'/'.$affiliate_num.'/'.$id[$i].'/">'.$name[$i].'/</a></strong></font><i><small>(<font id="c'.$id[$i].'">'.$npopulation[14].'</font>)</small></i>';

}






If($npopulation[$time_period_adjust+1] > 0){

		$cats .= '<i><small>('.$npopulation[$time_period_adjust+1].')</small></i>';
		}
$cats .= "</li>";
//change id[] to name[] to get name into directory category list urls
	}
	$cats .= '</ul></td></tr></table>';
	
	
	$cats .= "$nav_barf ";
	
	return $cats;
}


function alphamenu($catid, $cat_page_num, $link_page_num, $link_page_id, $link_page_total, $link_record_num){
//mark for future deprectaion - NONE of these ($link_page_num, $link_page_id, $link_page_total, $link_record_num) are used in this function and it does not call any other functions. They can be removed
	global $settings, $affiliate_num,$cat_page_num,$cat_page_id,$link_page_id, $link_page_num, $link_record_num;
	$alphamenu = '';
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$amm = $settings['amm'];
$page_counter = 0;
$contr=0;
$cat_id = mysqli_real_escape_string($connect, $catid);
	$query = 'SELECT id,name,lft,rgt FROM `'.$settings['categories_table'].'` WHERE parent="'.$catid.'" ORDER BY name ASC ';
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
//mark for deprecation this step seems unneeded .. strip the cat names to proper length once, when loading into table
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
function totalCatpages($id){ 
global $settings; 

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$id=mysqli_real_escape_string($connect, $id);
$query = 'SELECT * FROM '.$settings['categories_table'].' WHERE parent="'.$id.'"'; 
$result = mysqli_query($connect, $query); 
$totalrows_cats= mysqli_num_rows($result); 
$cat_page_total= ceil($totalrows_cats/$settings['amm']);
return $cat_page_total;
}
function totalsocialCatpages($id){ 
global $settings; 
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$id=mysqli_real_escape_string($connect, $id);

 
$query = 'SELECT * FROM '.$settings['social_network_table'].' WHERE parent="'.$id.'"'; 
$result = mysqli_query($connect, $query); 
$totalrows_cats= mysqli_num_rows($result); 
$cat_page_total= ceil($totalrows_cats/$settings['amm']);
return $cat_page_total;
}
function affiliateName($affiliate_num){ 
global $affiliate_num; 
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$affiliate_num=mysqli_real_escape_string($connect, $affiliate_num);

$query = 'SELECT `homepage_title` FROM `review_directory` WHERE `ID`="'.$affiliate_num.'"'; 
$result = mysqli_query($connect, $query); 
$row = mysqli_fetch_row($result); 
return $row[0]; }



?>
