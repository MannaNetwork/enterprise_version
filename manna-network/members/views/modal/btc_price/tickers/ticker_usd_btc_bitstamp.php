<?php

//header('Content-type: application/json');
$homepage = file_get_contents('https://www.bitstamp.net/api/ticker/');
//echo $homepage;
$pieces= explode(",", $homepage);
foreach($pieces as $key=>$val){
if($key==1){
$current_price=explode(":", $val);
$bitcoin_marketprice_usd = str_replace('"', '', $current_price[1]); 
}
}

?>
