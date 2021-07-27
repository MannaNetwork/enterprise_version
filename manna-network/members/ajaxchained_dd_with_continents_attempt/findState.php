<!-- ==============================================
//  Created by PHP Dev Zone           			 ||
//	http://php-dev-zone.com                      ||
//  Contact for any Web Development Stuff        ||
//  Email: ketan32.patel@gmail.com     			 ||
//=============================================-->


<?php $country=intval($_GET['country']);
echo 'in findState.php $country intval = ', $country;
include($_SERVER['DOCUMENT_ROOT']."/classes/ajax_dd_class.php");
$AJAXinfo = new ajax_info;
$region_array_single = $AJAXinfo->getRegionById($country);
print_r($region_array_single);
$state_arrays_children = $AJAXinfo->getChildrenByParentsId($region_array_single[0], 0, 0);
//returns multidim array including each child and each child's id, name
$state_id = $state_arrays_children[0];//array of children id nums
$state_name = $state_arrays_children[1];//array of children names

?>
<select name="state" onchange="getCity(<?php echo $country?>,this.value)">
<option>Select State</option>
<?php foreach($state_name as $key=>$value){ ?>
<option value="<?php echo $state_id[$key]?>"><?php echo $state_name[$key]?></option> 
<?php } ?>
</select>
