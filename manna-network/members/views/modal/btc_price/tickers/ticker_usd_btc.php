<?php
//require_once ( dirname(__FILE__) . "/../lib/cacheticker.php");
include ( dirname(__FILE__) . "/../lib/cacheticker.php");

$typeticker = "php_array";
$geo = "line";
if ( isset( $_GET ) )
 if ( isset ( $_GET['type'] ) )
  if ( $_GET['type'] == "html" or $_GET['type'] == "text"or $_GET['type'] == "php_array" )
   $typeticker = $_GET['type'];

$btc_price_array = cachegetBitcoinPrice( $typeticker, "line", "USD" );

?>
