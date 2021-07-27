<?
   // / First we define the class
class edit_category
{
var $cat_id;
var $cat_name;
var $cat_pop;
var $lftrgt;
function listCategories($url_cat){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

			$query = 'SELECT * FROM `categories` WHERE id= "'.$url_cat.'" ORDER BY name ASC   ';
echo $query;
$result = mysqli_query($connect, $query);
									
	$result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_array($result)){
		$id[] = $row['id'];
		$name[] = $row['name'];
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
$name[$i]  = stripslashes($name[$i]); //added on 10/9/2011 because names such as Men's had a slash added
		$cats .= '<li><font id="u'.$id[$i].'" ><strong><a href="/'.$file_name.'/'.$affiliate_num.'/'.$id[$i].'/">'.$name[$i].'/</a></strong></font><i><small> (<font id="c'.$id[$i].'">'.$npopulation[14].'</font>)</small></i>';
		$cats .= '</li>';
	}//close for each num rows?
	$cats .= '</ul></td></tr></table>';
}//close if result


else
{
$cats = "false";
}
return $cats;
}

}
