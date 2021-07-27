<?php
/**
 *  YOUR MYSQL DATABASE DETAILS
 */

 define("DB_HOST", 	"localhost");				// hostname
 define("DB_USER", 	"bungeebo_cryptoa");		// database username
 define("DB_PASSWORD", 	"Y1e2s3h4u5a6(((@@@");		// database password
 define("DB_NAME", 	"bungeebo_cryptoapi");	// database name



 
/**
 *  ARRAY OF ALL YOUR CRYPTOBOX PRIVATE KEYS
 *  Place values from your gourl.io signup page
 *  array("your_privatekey_for_box1", "your_privatekey_for_box2 (otional), etc...");
 */ 
 
 $cryptobox_private_keys = array('2425AAfrq0TBitcoin77BTCPRVZFB8r5INw5mk1ulYUDk1d3iY'^'9169AAeDrOKDash77DASHPRV7bq8Bx4GwMWVO3q6QOoxIvN3ZJ'^'21462AA5VIjZLitecoin77LTCPRVgh2qffqBATqDdTXGyyQYHT');
 



 define("CRYPTOBOX_PRIVATE_KEYS", implode("^", $cryptobox_private_keys));
 unset($cryptobox_private_keys);

?>
