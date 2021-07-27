<!-- ==============================================
//  Created by PHP Dev Zone           			 ||
//	http://php-dev-zone.com                      ||
//  Contact for any Web Development Stuff        ||
//  Email: ketan32.patel@gmail.com     			 ||
//=============================================-->

<?php 
$thirdlevel=intval($_POST['thirdlevel']);
include($_SERVER['DOCUMENT_ROOT']."/classes/ajax_cat_class.php");
$AJAXinfo = new ajax_info;
$fourthlevel_arrays_children = $AJAXinfo->getChildrenByParentsId($thirdlevel);
//returns multidim array including each child and each child's id, name
$fourthlevel_id = $fourthlevel_arrays_children[0];//array of children id nums
$fourthlevel_name = $fourthlevel_arrays_children[1];//array of children names
?>


<select name="fourthlevel" onchange="get4thLevelURL(this.value),  delete1stLevelURL(this.value),  delete2ndLevelURL(this.value),  delete3rdLevelURL(this.value)">

<option>Select 4th Level</option>
<?php foreach($fourthlevel_name as $key=>$value){ ?>
	<option value="<?php echo $fourthlevel_id[$key]?>"><?php echo $fourthlevel_name[$key]?></option>
	<?php } ?>
</select>
