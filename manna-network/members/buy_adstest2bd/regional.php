<?
include($_SERVER['DOCUMENT_ROOT']."/mobile/config.php"); //old yald, don't use db connects but use settings
include($_SERVER['DOCUMENT_ROOT']."/mobile/classes/mobile_class.php"); 
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$data=$_GET['data'];
$val=$_GET['val'];
$cat_id=$_GET['cat_id'];
$affiliate_num=$_GET['affiliate_num'];

 if ($data=='continents') {  // first dropdown
   echo '<input type="hidden" name="continents_data" value="<?echo $val;?>">';
   echo "<select name='continents' onChange=\"dochange('countries', this.value)\">\n";
  echo "<option value='0'>- GEO -</option>\n";
$query = "SELECT * FROM `categories_regional2` WHERE `parent` = 1 order by`name`";
$result = mysqli_query($connect, $query);
 while(list($id, $name)=mysqli_fetch_array($result)){
    if($id==$cat_id){
   echo "<option selected value=\"$id\" >$name</option> \n" ;
	}
else
{
 echo "<option value=\"$id\" >$name</option> \n" ;
}		
  }
   }
//add states
elseif ($data=='countries') {  // second dropdown
//added the con cou sta var to continent and countries in the two pop functs - need to finish rest
//but need to add category parent var to the query, it is hardcoded as 1 (main level) now.
//need to sort through the session variables to figure out which category id to us as the parent
//scratch pad :  the new category will ALWAYS have to come through the url, because the only categories displayed were done oon page load
// populations of each category in the drop down menus could be done as a separate feature.
//so, if I click the Real Estate category and load Real estate sub categories it will load with the pops for that category 
//and at that region  If I then use the regional drop down to change region, it should update the [populations of the 
//categories displayedwhich would all have the loaded categories as the parent.
// How is the cat # of the category to be loaded sent?
//and how can I get that value to the regional.php page?
//I think a session variable named "current_cat" might work. Every time a new page load is performed, reload that session variable to reflect the current category.

 $catData = new mobile;
$prev_data="Continents";
$prev_val = $val;
$regional_val = $val;
echo '<input type="hidden" name="continents_data" value="<?echo $val;?>">';
$cat_group = $catData->getCatGroup($cat_id,  "8");
$cat_group_string = implode(",", $cat_group);
$cat_group_pops = $catData->getCatGroupPops($cat_id, $val, "con");
$cat_group_pops_string = implode(",", $cat_group_pops);
$cat_sub_group_pops = $catData->getCatSubGroupPops($cat_id, $val, "con");
$cat_sub_group_pops_string = implode(",", $cat_sub_group_pops);
 echo "<select name='countries'   onmouseover=\" changeText2(".$cat_group_string.",".$cat_group_pops_string.",".$cat_sub_group_pops_string.")\"    onChange=\"dochange('states', this.value)\">\n";
 echo "<option value='0'>Choose Country</option>\n";
$query = "SELECT * FROM `categories_regional2` WHERE `parent`=$val ORDER BY `name` ASC";
  $result = mysqli_query($connect, $query);
 while(list($id, $name)=mysqli_fetch_array($result)){
       echo "<option value=\"$id\" >$name</option> \n" ;
  }
} else if ($data=='states') { // third dropdown
$prev_data="Countries";
$regional_val = $val."|cou";
$prev_val = $val;
$catData = new mobile;
$cat_group = $catData->getCatGroup($cat_id,  "8");
$cat_group_string = implode(",", $cat_group);
$cat_group_pops = $catData->getCatGroupPops($cat_id, $val , "cou");
$cat_group_pops_string = implode(",", $cat_group_pops);
$cat_sub_group_pops = $catData->getCatSubGroupPops($cat_id, $val, "cou");
$cat_sub_group_pops_string = implode(",", $cat_sub_group_pops);
     if($val==2714){
 echo "<select name='states'   onmouseover=\" changeText2(".$cat_group_string.",".$cat_group_pops_string.",".$cat_sub_group_pops_string.")\"    onChange=\"dochange('filler', this.value)\">\n";
 echo "<option value='0'>Choose Country</option>\n";
      $query = "SELECT * FROM `categories_regional2` WHERE `parent`=$val ORDER BY `name` ASC";
	$result = mysqli_query($connect, $query);
	while(list($id, $name)=mysqli_fetch_array($result)){
       echo "<option value=\"$id\" >$name</option> \n" ;
	}//close while
	}//close if val
	else
	{
	 echo "<select name='states'   onmouseover=\" changeText2(".$cat_group_string.",".$cat_group_pops_string.",".$cat_sub_group_pops_string.")\"    onChange=\"dochange('cities', this.value)\">\n";
 	echo "<option value='0'>Choose State</option>\n";                   
          $query = "SELECT * FROM `categories_regional2` WHERE `parent`=$val ORDER BY `name` ASC";
            $result = mysqli_query($connect, $query);
         while(list($id, $name)=mysqli_fetch_array($result)){
       echo "<option value=\"$id\" >$name</option> \n" ;
        }//close while
  }//close if val else
}
else if ($data=='filler') { // third dropdown
     $prev_data="District";
$regional_val = $val."|sta";
$prev_val = $val;
$catData = new mobile;
$cat_group = $catData->getCatGroup($cat_id,  "8");
$cat_group_string = implode(",", $cat_group);
$cat_group_pops = $catData->getCatGroupPops($cat_id, $val , "cou");
$cat_group_pops_string = implode(",", $cat_group_pops);
$cat_sub_group_pops = $catData->getCatSubGroupPops($cat_id, $val, "cou");
$cat_sub_group_pops_string = implode(",", $cat_sub_group_pops);
 echo "<select name='filler'   onmouseover=\" changeText2(".$cat_group_string.",".$cat_group_pops_string.",".$cat_sub_group_pops_string.")\"    onChange=\"dochange('cities', this.value)\">\n";
      echo "<option value='0'>Choose District</option>\n";
 	$query = "SELECT * FROM `categories_regional2` WHERE `parent`=$val ORDER BY `name` ASC";
       	$result = mysqli_query($connect, $query);
	while(list($id, $name)=mysqli_fetch_array($result)){
       echo "<option value=\"$id\" >$name</option> \n" ;
  }
}
 else if ($data=='cities') { // fourth dropdown
 // echo "<select name='cities' >\n";
$prev_data="States";
$regional_val = $val."|sta";
$prev_val = $val;
$catData = new mobile;
$cat_group = $catData->getCatGroup($cat_id,  "8");
$cat_group_string = implode(",", $cat_group);
$cat_group_pops = $catData->getCatGroupPops($cat_id, $val , "cou");
$cat_group_pops_string = implode(",", $cat_group_pops);
$cat_sub_group_pops = $catData->getCatSubGroupPops($cat_id, $val, "cou");
$cat_sub_group_pops_string = implode(",", $cat_sub_group_pops);
 echo "<select name='cities'   onmouseover=\" changeText2(".$cat_group_string.",".$cat_group_pops_string.",".$cat_sub_group_pops_string.")\"    onChange=\"dochange('final', this.value)\">\n";
   echo "<option value='0'>Choose City</option>\n";  
	$query = "SELECT * FROM `categories_regional2` WHERE `parent`=$val ORDER BY `name` ASC";
		        	$result = mysqli_query($connect, $query);
	while(list($id, $name)=mysqli_fetch_array($result)){
       echo "<option value=\"$id\" >$name</option> \n" ;
  }
}else if ($data=='final') { // display link
  echo "&nbsp;";
$prev_data="Cities";
$regional_val = $val."|cit";	   
$prev_val = $val;	
$query = "SELECT * FROM `categories_regional2` WHERE parent=$val ORDER BY `name` ASC";
 $result = mysqli_query($connect, $query);
while(list($id, $name)=mysqli_fetch_array($result)){
       //echo "<option value=\"$id\" >$name</option> \n" ;
  }
	}
echo "</select>\n";

  If($val>0){
$regionName = new mobile;
$region_name = $regionName->getRegionName($prev_val);
//add regional number here to pull all links from a region
echo '<br><a href="http://bungeebones.com/modal/index.php/'.$cat_id.'/'.$regional_val. '"><font size="1">Get '.$region_name.'</font></a>';
//echo "<br><a href='http://bungeebones.com/link_exchange/admin/cp_demo/link_cat_changer.php?cat_id=".$val."&link_id=10000'><font size='1'>Load All Links In ".$link_data->getCatName($val) . "</font></a>";
}elseif($data=="final"){
echo'make link do its stuff';
}
?>
