
<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
//$q = intval($_GET['q']);
$q = $_GET['q'];
if(!defined('READER_AGENTS')){ 
include(dirname(__DIR__, 2)."/manna-configs/db_cfg/auth_constants.php");
}
include(dirname(__DIR__, 2)."/manna-configs/db_cfg/".READER_AGENTS);
include(dirname(__DIR__, 2)."/manna-configs/db_cfg/mysqli_connect.php");
if (!$mysqli) {
    die('Could not connect: ' . mysqli_error($mysqli));
}
//$parsed_q = explode(":",$q);
$sql="SELECT * FROM categories_regional2 WHERE parent = '".$q."'";
$result = mysqli_query($mysqli,$sql);

echo str_replace(array("\n", "\t", "\r"), '', '<form>
<select name="subLoc1" onchange="showSubLoc2(this.value), getRankingLoc(this.value)"> Cannot find such a function anywhere

<!--<select name="subLoc1" onchange="showSubLoc2(this.value)">-->
<option value="">Select a Country:</option> ');

while($row = mysqli_fetch_array($result)) {
   if($row['lft']+1 < $row['rgt']){
	 echo "<option value='y:" . $row['id'] .":".$row['name'] ."'>".$row['name']."</option>";
	}
	else
	{
	 echo "<option value='n:" . $row['id']  .":".$row['name'] . "'>".$row['name']."</option>";
	}
}
echo str_replace(array("\n", "\t", "\r"), '', '</select></form>');
mysqli_close($mysqli);
?>
</body>
</html> 
