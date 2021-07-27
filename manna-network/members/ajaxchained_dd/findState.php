<!-- ==============================================
//  Created by PHP Dev Zone           			 ||
//	http://php-dev-zone.com                      ||
//  Contact for any Web Development Stuff        ||
//  Email: ketan32.patel@gmail.com     			 ||
//=============================================-->


<?php $country=intval($_POST['country']);
include($_SERVER['DOCUMENT_ROOT']."/classes/ajax_dd_class.php");
$AJAXinfo = new ajax_info;
$state_arrays_children = $AJAXinfo->getChildrenByParentsId($country);
//returns multidim array including each child and each child's id, name
$state_id = $state_arrays_children[0];//array of children id nums
$state_name = $state_arrays_children[1];//array of children names
?>
<!--<select name="state" onchange="getCity(this.value),  deleteCountryURL(this.value),getStateURL(this.value)">-->
<select name="state" onchange="getCity(this.value), getStateURL(this.value),deleteContinentURL(this.value), deleteCountryURL(this.value),deleteCityURL(this.value)">

<option>Select State</option>
<?php foreach($state_name as $key=>$value){ ?>
	<option value="<?php echo $state_id[$key]?>"><?php echo $state_name[$key]?></option>
	<?php } ?>
</select>
