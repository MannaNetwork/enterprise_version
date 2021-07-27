<!-- ==============================================
//  Created by PHP Dev Zone           			 ||
//	http://php-dev-zone.com                      ||
//  Contact for any Web Development Stuff        ||
//  Email: ketan32.patel@gmail.com     			 ||
//=============================================-->


<?php $continent=intval($_POST['continent']);
include($_SERVER['DOCUMENT_ROOT']."/classes/ajax_regions_class.php");
$AJAXinfo = new ajax_info;
$country_arrays_children = $AJAXinfo->getChildrenByParentsId($continent);
//returns multidim array including each child and each child's id, name
$country_id = $country_arrays_children[0];//array of children id nums
$country_name = $country_arrays_children[1];//array of children names

?>
<!-- try delete url w/o a value? 
<select name="country" onchange="getState(this.value),  deleteContinentURL(this.value),getCountryURL(this.value)"> -->
<select name="country" onchange="getState(this.value),  deleteContinentURL(this.value), getCountryURL(this.value)">
<option>Select Country</option>
<?php foreach($country_name as $key=>$value){ ?>
	<option value="<?php echo $country_id[$key]?>"><?php echo $country_name[$key]?></option>
	<?php } ?>
</select>
