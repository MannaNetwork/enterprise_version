<?php 
require(dirname( __FILE__, 1 ). "/functions/functions.php");


if (array_key_exists("category_id",$_POST))
  {

$category_id  = $_POST['category_id'];
  }


//$linksList = getLinks($category_id);  original
$linksList = getLinksAsJSON($category_id);

if($linksList =="Sorry, No Links Found."){
echo "Sorry, No Links Found.";
}
else
{
	print_r($linksList);
/*
if (!function_exists('utf8ize')) {
function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}
}
$json_encode_linksList = json_encode(utf8ize($linksList));
echo $json_encode_linksList;
}
*/
}
?>
