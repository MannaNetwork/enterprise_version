<?php
//grab the last entry from log and return hash of timestamp
//echo '<br> dirname( __FILE__, 3 ) = ', dirname( __FILE__, 3 );
if(!defined('READER_AGENTS')){ 
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/agent_config.php");
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");

$region_hash_key_asking = $_POST['region_hash_key'];  

$sql = "SELECT * FROM categories_regional2 ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
while($row = mysqli_fetch_array($result)){
$this_last_region_id = $row['id'];
}
$region_hash_key = rtrim($this_last_region_id, "/ \t\n\r");
$region_hash_key = str_replace(' ', '', $region_hash_key);
$region_hash_key = preg_replace('/\s/', '', $region_hash_key);
$conacat = $region_hash_key.$exchange_pw;

$region_hash_key = hash('sha512', $conacat);

//echo  '<br> in ORG $region_hash_key = ', $region_hash_key;
//echo ' ....   should match $region_hash_key_asking = ', $_POST['region_hash_key'];  

if($region_hash_key_asking == $region_hash_key){

echo  $region_hash_key;
}
else
{
require_once(dirname( __FILE__, 2 )."/members/libraries/PHPMailer.php");
require_once(dirname( __FILE__, 2 )."/members/config/config.php");


//PHPMailer Object
$mail = new PHPMailer(true); //Argument true in constructor enables exceptions

//From email address and name
if($_SERVER['HTTP_HOST']){
$mail->From = "noreply@".$_SERVER['HTTP_HOST'];
}
elseif($_SERVER['SERVER_NAME'] ){
$mail->From = "noreply@".$_SERVER['SERVER_NAME'];
}
$mail->FromName = "Cron region_hash_key Sync Error";

//To address and name
$mail->addAddress("robert.r.lefebvre@gmail.com", "Robert (from yourself)");

//Address to which recipient will reply
if($_SERVER['HTTP_HOST']){
$mail->addReplyTo("noreply@".$_SERVER['HTTP_HOST'], "No Reply");
}
elseif($_SERVER['SERVER_NAME'] ){
$mail->addReplyTo("noreply@".$_SERVER['SERVER_NAME'], "No Reply");
}
//CC and BCC
$agent_email = EMAIL_SMTP_USERNAME;
$mail->addCC($agent_email);

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = "Cron Region Sync Error";
$mail->Body = '<h1 style="color:red;">Auth was denied. The last id in '.$_SERVER['HTTP_HOST'].' categories_regional2\'s table doesn\'t match the one recorded in Manna Network\'s agent_conn_credentials table</h1>
<h3>$this_last_region_id in agent site categories table  = '. $this_last_region_id. '</h3><h3>$region_hash_key_asking  = '. $region_hash_key_asking . '</h3><h3> $region_hash_key produced by agent\'s site = '. $region_hash_key.' </h3><br><h3>Login to your Manna Network cpanel and change the last id in the agent_conn_credentials table to match the one displayed here (or the passwords don\'t match)';
$mail->AltBody = "This is the plain text version of the email content";

try {
    $mail->send();
    echo "Message has been sent successfully|$this_last_region_id";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}


}

?>
