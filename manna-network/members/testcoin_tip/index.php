<?php
$user_id = $_GET['user_id'];
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y)
$moniker="<h5>Tip A Website With TestCoin</h5>";
$body_width="wide";
include("../../960top.php");

$test_user_id = $user_id;

$file="http://192.64.115.222/process_testnet.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
curl_setopt($ch, CURLOPT_POSTFIELDS, array('user_id' => $test_user_id, 'isTestCoin'=> 1  ));
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
//echo($data);
  ?>

<table id="member"><tr><td>
 <?echo $data;
?>

</td></tr></table>

#To repeat the above offer using real Bitcoin I just need to create a duplicate Bitcoin qt, use the existing coding and use a different 
# ngrok address to link to it. Each ngrok would then offer either the testnet coin or the real bitcoin. 
# Someone paying a Satoshi of real bitcoin would pass all the test coin.
# In the User CP, duplicate the existing software to run test mode or real mode. They wouldn't be able to see real bids unless they switch 
# mode but they would see the highest bid was a Satoshi and they would have the experience to bid YES!!!!!!!


<?
include("../../960bottom.php");


