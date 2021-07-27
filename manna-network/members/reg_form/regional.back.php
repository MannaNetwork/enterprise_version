<?
include($_SERVER['DOCUMENT_ROOT']."/members/reg_form/config.php"); //old yald, don't use db connects but use settings
include($_SERVER['DOCUMENT_ROOT']."/members/reg_form/classes/mobile_class.php"); 
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$catData = new mobile;
$data=$_GET['data'];
$val=$_GET['val'];
$cat_id=$_GET['cat_id'];
$affiliate_num=$_GET['affiliate_num'];

 if($data=="countries"){$_SESSION['continents'] = $val; }
elseif($data=="states"){$_SESSION['countries'] = $val;	}
elseif($data=="cities"){$_SESSION['states'] = $val;}
elseif($data=="district1"){$_SESSION['cities'] = $val;}
elseif($data=="district2"){$_SESSION['district1'] = $val;}
elseif($data=="final"){$_SESSION['district2'] = $val;}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

 if ($data=='continents') {  // first dropdown
 $next_data_name="Continent";
 echo '<input type="hidden" name="continents_data" value="<?echo $val;?>">';
   echo "<select name='continents' onChange=\"dochange('countries', this.value)\">\n";
  echo "<option value='0'>Continent</option>\n";
$query = "SELECT * FROM `categories_regional2` WHERE `parent` = 1 order by`name`";
  $result = mysqli_query($connect, $query);
   while(list($id, $name)=mysqli_fetch_array($result)){
    if($id==$cat_id){
      echo "<option selected value=\"$id\" >$name</option> \n" ;
	}else{
		 echo "<option value=\"$id\" >$name</option> \n" ;
	    }		
	  }
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

elseif ($data=='countries') {  // second dropdown
$prev_data="Continents";
$next_data_name="Country";
$prev_val = $val;
$regional_val = $val;
echo '<input type="hidden" name="continents_data" value="<?echo $val;?>">';
 $catData->updateCatPopsText($cat_id, $time_period, $regional_num, $regional_level);
$cat_group = $catData->getCatGroup($cat_id,  "8");
if($cat_group ==""||$cat_group ==false){
echo '<font color="red">Click Commit Link (below) or --continue --></font>';
}else{
$cat_group_string = implode(",", $cat_group);
$cat_group_pops = $catData->getCatGroupPops($cat_id, $val, "continent");
$cat_group_pops_string = implode(",", $cat_group_pops);
$cat_sub_group_pops = $catData->getCatSubGroupPops($cat_id, $val, "continent");
$cat_sub_group_pops_string = implode(",", $cat_sub_group_pops);
}
 echo "<select name='countries'     onChange=\"dochange('states', this.value)\"   onmouseover=\" changeText2(".$cat_group_string.",".$cat_group_pops_string.",".$cat_sub_group_pops_string.")\" >\n";
  echo "<option value='0'>Choose Country</option>\n";
$query = "SELECT * FROM `categories_regional2` WHERE `parent`=$val ORDER BY `name` ASC";
      	$result = mysqli_query($connect, $query);
  while(list($id, $name)=mysqli_fetch_array($result)){
       echo "<option value=\"$id\" >$name</option> \n" ;
  }
} 

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

else if ($data=='states') { // third dropdown
$prev_data="Countries";
$next_data_name="State";
$regional_val = $val."|country";
$prev_val = $val;
$catData = new mobile;
$cat_group = $catData->getCatGroup($cat_id,  "8");
if($cat_group ==""||$cat_group ==false){echo '<font color="red">No Competition <br>Click Commit Link (below) or --continue --></font>';}
else
{
$cat_group_string = implode(",", $cat_group);
$cat_group_pops = $catData->getCatGroupPops($cat_id, $val , "country");

$cat_group_pops_string = implode(",", $cat_group_pops);
$cat_sub_group_pops = $catData->getCatSubGroupPops($cat_id, $val, "country");

$cat_sub_group_pops_string = implode(",", $cat_sub_group_pops);
}
	 echo "<select name='states'     onChange=\"dochange('cities', this.value)\"   onmouseover=\" changeText2(".$cat_group_string.",".$cat_group_pops_string.",".$cat_sub_group_pops_string.")\" >\n";
 	echo "<option value='0'>Choose State</option>\n";                   
	$query = "SELECT * FROM `categories_regional2` WHERE `parent`=$val ORDER BY `name` ASC";
  		        	$result = mysqli_query($connect, $query);
	while(list($id, $name)=mysqli_fetch_array($result)){
       echo "<option value=\"$id\" >$name</option> \n" ;
        }//close while
  }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

 else if ($data=='cities') { // fourth dropdown
 // echo "<select name='cities' >\n";
$next_data_name="City";
$prev_data="States";
$regional_val = $val."|state";
$prev_val = $val;
$catData = new mobile;
$cat_group = $catData->getCatGroup($cat_id,  "8");
if($cat_group ==""||$cat_group ==false){echo '<font color="red">No Competition <br>Click Commit Link (below) or --continue --></font>';}
else
{
$cat_group_string = implode(",", $cat_group);
$cat_group_pops = $catData->getCatGroupPops($cat_id, $val , "state");
$cat_group_pops_string = implode(",", $cat_group_pops);
$cat_sub_group_pops = $catData->getCatSubGroupPops($cat_id, $val, "state");
$cat_sub_group_pops_string = implode(",", $cat_sub_group_pops);
}
 echo "<select name='cities'   onChange=\"dochange('district1', this.value)\"   onmouseover=\" changeText2(".$cat_group_string.",".$cat_group_pops_string.",".$cat_sub_group_pops_string.")\"   >\n";
  echo "<option value='0'>Choose City</option>\n";  
	$query = "SELECT * FROM `categories_regional2` WHERE `parent`=$val ORDER BY `name` ASC";
		        	$result = mysqli_query($connect, $query);
	while(list($id, $name)=mysqli_fetch_array($result)){
       echo "<option value=\"$id\" >$name</option> \n" ;
  }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


else if ($data=='district1') { // third dropdown
     $prev_data="Cities";
$next_data_name="District1";
$regional_val = $val."|city";
$prev_val = $val;
$catData = new mobile;
$cat_group = $catData->getCatGroup($cat_id,  "8");
if($cat_group ==""||$cat_group ==false){echo '<font color="red">No Competition <br>Click Commit Link (below) or --continue --></font>';}
else
{
$cat_group_string = implode(",", $cat_group);
$cat_group_pops = $catData->getCatGroupPops($cat_id, $val , "district1");
$cat_group_pops_string = implode(",", $cat_group_pops);
$cat_sub_group_pops = $catData->getCatSubGroupPops($cat_id, $val, "district1");
$cat_sub_group_pops_string = implode(",", $cat_sub_group_pops);
}
 echo "<select name='district1'      onChange=\"dochange('district2', this.value)\" onmouseover=\" changeText2(".$cat_group_string.",".$cat_group_pops_string.",".$cat_sub_group_pops_string.")\" >\n";
      echo "<option value='0'>Choose District</option>\n";
  	$query = "SELECT * FROM `categories_regional2` WHERE `parent`=$val ORDER BY `name` ASC";
 		        	$result = mysqli_query($connect, $query);
	while(list($id, $name)=mysqli_fetch_array($result)){
       echo "<option value=\"$id\" >$name</option> \n" ;
  }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

else if ($data=='district2') { // fifth dropdown
     $prev_data="District1";
$next_data_name="Final";
$regional_val = $val."|district1";
$prev_val = $val;
$catData = new mobile;
$cat_group = $catData->getCatGroup($cat_id,  "8");
if($cat_group ==""||$cat_group ==false){echo '<font color="red">No Competition <br>Click Commit Link (below) or --continue --></font>';}
else
{
$cat_group_string = implode(",", $cat_group);
$cat_group_pops = $catData->getCatGroupPops($cat_id, $val , "city");

$cat_group_pops_string = implode(",", $cat_group_pops);
$cat_sub_group_pops = $catData->getCatSubGroupPops($cat_id, $val, "city");

$cat_sub_group_pops_string = implode(",", $cat_sub_group_pops);
}
 echo "<select name='district2'      onChange=\"dochange('final', this.value)\" onmouseover=\" changeText2(".$cat_group_string.",".$cat_group_pops_string.",".$cat_sub_group_pops_string.")\" >\n";
 
     echo "<option value='0'>Choose District</option>\n";
   
 	$query = "SELECT * FROM `categories_regional2` WHERE `parent`=$val ORDER BY `name` ASC";
 
		        	$result = mysqli_query($connect, $query);

	while(list($id, $name)=mysqli_fetch_array($result)){
       echo "<option value=\"$id\" >$name</option> \n" ;
  }


}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


else if ($data=='final') { // display link
  echo "&nbsp;";
$next_data_name="<br><font color='red'>Or Any Of The Above <br>Or Your Link Will Not <br>Be Listed In A Region</font>";

$prev_data="Cities";
$regional_val = $val."|city";	   
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
//echo '<br><a href="http://bungeebones.com/bungee_jumpers/reg_form/index.php/'.$cat_id.'/'.$regional_val. '"><font size="1">Click To Enter Your Link In '.$region_name.'</font></a>';
//echo "<br><a href='http://bungeebones.com/link_exchange/admin/cp_demo/link_cat_changer.php?cat_id=".$val."&link_id=10000'><font size='1'>Load All Links In ".$link_data->getCatName($val) . "</font></a>";
if($data=='final'){
//add regional number here to pull all links from a region
echo '<div style="text-decoration:none"><br><table border="1" cellpadding="4"><tr><td><a href="http://bungeebones.com/members/reg_form/index.php/'.$cat_id.'/'.$regional_val.'/'.$cat_id_orig.'/'.$website_id. '"><font size="1">Click To Commit Your Link In  '.$region_name.'<br>'.$next_data_name.' </font></a></td></tr></table></div>';
//echo "<br><a href='http://bungeebones.com/link_exchange/admin/cp_demo/link_cat_changer.php?cat_id=".$val."&link_id=10000'><font size='1'>Load All Links In ".$link_data->getCatName($val) . "</font></a>";
}
else
{
echo '<div style="text-decoration: none"><br><table border="1" cellpadding="4"><tr><td><a href="http://bungeebones.com/members/reg_form/index.php/'.$cat_id.'/'.$regional_val.'/'.$cat_id_orig.'/'.$website_id.  '"><font size="1">Click To Commit Your Link In  '.$region_name.'</a><p>Or Select From '.$next_data_name.' Dropdown Above</font></td></tr></table></div>';
}
}
?>
