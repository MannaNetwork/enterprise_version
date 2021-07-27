<!-- ==============================================
//  Created by PHP Dev Zone           			 ||
//	http://php-dev-zone.com                      ||
//  Contact for any Web Development Stuff        ||
//  Email: ketan32.patel@gmail.com     			 ||
//=============================================-->

<?php 
$state=intval($_POST['state']);
include($_SERVER['DOCUMENT_ROOT']."/classes/ajax_regions_class.php");
$AJAXinfo = new ajax_info;
$city_arrays_children = $AJAXinfo->getChildrenByParentsId($state);
//returns multidim array including each child and each child's id, name
$city_id = $city_arrays_children[0];//array of children id nums
$city_name = $city_arrays_children[1];//array of children names
?>

<select name="city" onchange="deleteStateURL(this.value),getCityURL(this.value)">

<option>Select City</option>
<?php foreach($city_name as $key=>$value){ ?>
	<option value="<?php echo $city_id[$key]?>"><?php echo $city_name[$key]?></option>
	<?php } ?>
</select>
