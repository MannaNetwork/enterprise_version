<!-- ==============================================
//  Created by PHP Dev Zone           			 ||
//	http://php-dev-zone.com                      ||
//  Contact for any Web Development Stuff        ||
//  Email: ketan32.patel@gmail.com     			 ||
//=============================================-->


<?php $continent=intval($_GET['continent']);
include($_SERVER['DOCUMENT_ROOT']."/classes/ajax_dd_class.php");
$AJAXinfo = new ajax_info;
$country_arrays_children = $AJAXinfo->getChildrenByParentsId($continent, 0, 0);
//returns multidim array including each child and each child's id, name
$country_id = $country_arrays_children[0];//array of children id nums
$country_name = $country_arrays_children[1];//array of children names

?>
<select name="country" onchange="getState(this.value)">
<option>Select Country</option>
<?php foreach($country_name as $key=>$value){ ?>
	<option value="<?php echo $country_id[$key]?>"><?php echo $country_name[$key]?></option>
	<?php } ?>
</select>
