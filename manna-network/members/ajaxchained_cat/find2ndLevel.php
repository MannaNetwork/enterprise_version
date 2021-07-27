<!-- ==============================================
//  Created by PHP Dev Zone           			 ||
//	http://php-dev-zone.com                      ||
//  Contact for any Web Development Stuff        ||
//  Email: ketan32.patel@gmail.com     			 ||
//=============================================-->


<?php $firstlevel=intval($_POST['firstlevel']);

include($_SERVER['DOCUMENT_ROOT']."/classes/ajax_cat_class.php");
$AJAXinfo = new ajax_info;
$secondLevel_arrays_children = $AJAXinfo->getChildrenByParentsId($firstlevel);
//returns multidim array including each child and each child's id, name
$secondLevel_id = $secondLevel_arrays_children[0];//array of children id nums
$secondLevel_name = $secondLevel_arrays_children[1];//array of children names

?>
<select name="secondlevel" onchange="get3rdLevel(this.value), get2ndLevelURL(this.value),  delete1stLevelURL(this.value),  delete3rdLevelURL(this.value),  delete4thLevelURL(this.value)">
<option>Select 2nd Level</option>
<?php foreach($secondLevel_name as $key=>$value){ ?>
	<option value="<?php echo $secondLevel_id[$key]?>"><?php echo $secondLevel_name[$key]?></option>
	<?php } ?>
</select>
