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
 //this is key that is from BOXID 2433

//$cryptobox_private_keys = array('2433AA4VYDdBitcoin77BTCPRV314V0dQgLhGUBIoQz4YitBTl');
 //this is key that is from BOXID 2425
$cryptobox_private_keys = array('21427AAAfSSpBitcoincash77BCHPRVi8vfw9w9F5Mdy5PdrJU','9169AAeDrOKDash77DASHPRV7bq8Bx4GwMWVO3q6QOoxIvN3ZJ','21462AA5VIjZLitecoin77LTCPRVgh2qffqBATqDdTXGyyQYHT');
//this is the key from 2421
//$cryptobox_private_keys = array('2421AAb9vwFBitcoin77BTCPRVL6mJZQzrZOnPtL60kiHImpIH');

 define("CRYPTOBOX_PRIVATE_KEYS", implode("^", $cryptobox_private_keys));
 unset($cryptobox_private_keys);

?>
