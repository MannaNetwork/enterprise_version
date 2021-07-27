<?php
/**
 * Google_TTS (Google's Text-to-Speech System) Class example
 *
 * @author Mahmut Namli <mahmudnamli@gmail.com>
 */

header('Content-Type: text/html; charset=UTF-8');
ini_set('error_reporting', -1);

/* Firstly, I need to integrate the class file for example.. */
require_once 'google.tts.php';

/* Instantiate the class */
//retrieve the sentences created by a form

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$query = "select * from `text_to_voice` where `page_num` = 1 ORDER BY `id`";
$result = mysqli_query($connect, $query);
while($row = mysqli_fetch_array($result)){
  $ID[] = $row['id'];
  $sentence[] = $row['sentence'];
 }






//$message_array = array("Welcome to Josh Simons class on personal money management and Bitcoin.","In this class you will create your own Bitcoin wallet to store your Bitcoin in.",
//"Having a Bitcoin Wallet is just like having your own bank account. You can send Bitcoin to any one",
//"with their own Bitcoin wallet and they can send you Bitcoin too!");
//echo 'count message array = ', count($message_array);
//var_dump($message_array);
//$count_message_array = count($message_array);

//echo '$count message array = ', $count_message_array;
//foreach ($array as $key => $value)
foreach($sentence as $key => $value){
//echo 'value = ',  $value;

$ttsObj = new Google_TTS();

/* Make a decision for spoofing IP address for CURL REMOTE_ADDR and HTTP_X_FORWARDED_FOR
 * default is 'random'
 */
$ttsObj->headerIP("random");

/* object needs the text's language and the text's self which will be converted to mp3 files as speech
 * 
 * Note 1: as of this is a free service, you're limited to 100 characters of the text hence using $_GET
 * Note 2: Languages generally 2 chars of localcodes, you can find them in the $ttsObj->languages variable.
 */

//ho '<br> $message_array = ', $message_array;
$ttsObj->text("en", "$value");
                   //1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890
/* let's output as audio on browser directly */
$ttsObj->speakIt('direct');
}

/* of course if I need a file of soundData, just telling the where to saving it: */
$ttsObj->speakIt('spoken_sentences/test.mp3');


