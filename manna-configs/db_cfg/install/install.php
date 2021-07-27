<?php
function randomPassword() {
 
$password = "";
$charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+1234567890-={}:<>./~|";
 
 for($i = 0; $i < 24; $i++)
 {
     $random_int = mt_rand();
    $password .= $charset[$random_int % strlen($charset)];
 }
 
    return $password; // return the generated password
}

//make a new if isset to check that user's site is registered. probably want to do that i
if(isset($_POST['submit'])){
$file_name_array = array("readage_auth.php","readcus_auth.php", "writage_auth.php","writcus_auth.php");
$user_name_array = array("readage","readcus", "writage","writcus");
$permissions_array = array("READ ONLY FOR THAT USER!", "ALLOW THE ABOVE USER TO SELECT< UPDATE< DELETE AND READ");
for($i=0;$i<=3;$i++){
$fileContent = "";
$display = "";
 $fileContent .= '<?php'.PHP_EOL;
$display .= '<br>&lt;?php';

$fileContent .= '$servername = "localhost";'.PHP_EOL;
$display .=  '<br>$servername = "localhost";';

$fileContent .= '$username = "'.$_POST['users']."_".$user_name_array[$i].'";'.PHP_EOL;
$display .= '<br>$username = "'.$_POST['users']."_".$user_name_array[$i].'";';

$password = randomPassword();
$fileContent .= '$password = "'.$password.'";'.PHP_EOL;
$display .= '<br>$password = "'.$password.'";';
if(isset($_POST['db']) and $_POST['db'] !==""){
if($i==0 or $i==2){
	$fileContent .= '$dbname = "'. $_POST['users'].'_agents";'.PHP_EOL;
$display .= '<br>$dbname = "'. $_POST['users'].'_agents";';
}
else
{
 $fileContent .= '$dbname = "'. $_POST['users'].'_customers";'.PHP_EOL;
$display .= '<br>$dbname = "'. $_POST['users'].'_customers";';
}
}
else
{
if($i==0 or $i==2){
	$fileContent .= '$dbname = "agents";'.PHP_EOL;
$display .= '<br>$dbname = "agents";';
}
else
{
 $fileContent .= '$dbname = "customers";'.PHP_EOL;
$display .= '<br>$dbname = "customers";';
}

}
$fileContent .= '?>';
$display .= '<br>?&gt;';


 echo '<br>File name: '.$file_name_array[$i].'   Password for it: '.$password;

 echo '<br>Writing Mysql install code to temp file:manna_network/manna-configs/db_cfg/temp'.$file_name_array[$i];
echo '<br>This data:'.$display;
if($i<=1){
echo '<h4>Create that user for that database and SET Permissions to '.$permissions_array[0];
echo '</h4><br>';
}
else
{
echo '<h4>Create that user for that database and SET Permissions to '.$permissions_array[1];
echo '</h4><br>';
}
$file = fopen('temp/'.$file_name_array[$i],"wa+");
fwrite($file,$fileContent);
fclose($file);
}

if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
echo '<br>Checking connection of ', READER_AGENTS;
echo '<br> Using '.dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS;
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");

echo '<br>Checking connection of ', WRITER_AGENTS;
echo '<br> Using '.dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".WRITER_AGENTS;
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".WRITER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");

echo '<br>Checking connection of ', READER_CUSTOMERS;
echo '<br> Using '.dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_CUSTOMERS;
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");

echo '<br>Checking connection of ', WRITER_CUSTOMERS;
echo '<br> Using '.dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".WRITER_CUSTOMERS;
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".WRITER_CUSTOMERS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");

echo "<h3>Check your error log in manna_network/manna-configs/db_cfg for connection errors. </h3>";


}
else
{
//echo '<br>dirname(__FILE__); = ', dirname(__FILE__);
/* To be completed - test to see if this attempt to install an enterprise script is a registered member. if not, block access. The $file needs to open a manna-network.com page that checks if this site is registered  */
$url = $_SERVER['SERVER_NAME'];
$args = array('http_host' =>   $_SERVER['HTTP_HOST']);
$file="https://exchange.manna-network.com/incoming/check_if_registered.php";
echo '<br>file = ', $file;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
echo($data);

/* To be completed - test to see if this attempt to install an enterprise script is a widget, if not, block access. The $file needs to open a manna-network.com page that checks if this site is widget. Need to make a new page there. */ 
$url = $_SERVER['SERVER_NAME'];
$args = array('http_host' =>   $_SERVER['HTTP_HOST']);
$file="https://exchange.manna-network.com/incoming/check_if_a_widget.php";
echo '<br>file = ', $file;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
echo($data);

	?>
	<h1>Generate MySQL Code To Create Users
<p>The Manna Network requires two databases (a customer database and an agents database).

<p> It also requires two users for each (one with read-only access and one with access to read, insert, update and delete) which this form will generate the MySql code for you to create

<p>We will generate the four database user names and their random passwords. Note: this script will then write the database access files for each in the install/temp folder. If/when you inspect them, then copy them to your 

<h3>Step 1: Create TWO Databases named: 1) agents and 2) customers</h3>
<p>Mysql code for db1: mysql> CREATE DATABASE agents;
<p>Mysql code for db2: mysql> CREATE DATABASE customers;
<p>NOTE: You can add a prefix to those db names (for example mysql> CREATE DATABASE manna_agents; and enter that prefix to the form below).
<h3>Step 2: Create TWO users for EACH database: 1) will be a \"readonly\" user and 2) the other will have write access</h3>
<p>NOTE: You can also add a prefix that will be added to the default usernames the form below).
	<form name="test" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">

	<br>Enter a prefix name to your your database user's name (optional - leaving blank will use the defaults) <input type="text" name="users"><br>
<br>Enter the prefix name to your database IF the databases are set up with prefixes (some are not)  <input type="text" name="db"><br> -->

	   <input type="submit" name="submit" value="Submit Form"><br>

	</form>
<?php
}
?>
