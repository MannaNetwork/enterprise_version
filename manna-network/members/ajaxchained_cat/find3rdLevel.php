<!-- ==============================================
//  Created by PHP Dev Zone           			 ||
//	http://php-dev-zone.com                      ||
//  Contact for any Web Development Stuff        ||
//  Email: ketan32.patel@gmail.com     			 ||
//=============================================-->


<?php $secondlevel=intval($_POST['secondlevel']);
include($_SERVER['DOCUMENT_ROOT']."/classes/ajax_cat_class.php");
$AJAXinfo = new ajax_info;
$thirdlevel_arrays_children = $AJAXinfo->getChildrenByParentsId($secondlevel);
//returns multidim array including each child and each child's id, name
$thirdlevel_id = $thirdlevel_arrays_children[0];//array of children id nums
$thirdlevel_name = $thirdlevel_arrays_children[1];//array of children names
?>
<select name="thirdlevel" onchange="get4thLevel(this.value), get3rdLevelURL(this.value), delete1stLevelURL(this.value), delete2ndLevelURL(this.value), delete4thLevelURL(this.value)">

<option>Select 3rd Level</option>
<?php foreach($thirdlevel_name as $key=>$value){ ?>
	<option value="<?php echo $thirdlevel_id[$key]?>"><?php echo $thirdlevel_name[$key]?></option>
	<?php } ?>
</select>
