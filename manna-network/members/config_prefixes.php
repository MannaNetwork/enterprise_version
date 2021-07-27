<?
if (isset($_GET['action']) && $_GET['action'] == "log_out") {
//$test_page_protect->log_out(); // the method to log off
session_start();
session_destroy();
}
// include the configs
require_once("config/config.php");
// load the login class
// load php-login components
require_once("php-login.php");
// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...
$user_id = $_SESSION['user_id'];
$link_id=$_GET['link_id'];
$coin_type=$_GET['coin_type'];

if(isset($_POST['B1'])){
$link_id=$_POST['link_id'];
$user_id = $_SESSION['user_id'];
$coin_type = $_POST['coin_type'];

/* Functions we used */
function check_input($data, $problem='')
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0)
    {
        show_error($problem);
    }
    return $data;
}

function show_error($myError)
{
?>
    <html>
    <body>

    <b>Please correct the following error:</b><br />
    <?php echo $myError; ?>

    </body>
    </html>
<?php
exit();
}

/* Check all form inputs using check_input function */

$prefix   = check_input($_POST['prefix']);
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$display_mode = $_POST['display_mode'];

$query = "SELECT *
FROM `user_control_panel_config`
WHERE `user_ID` = '".$user_id."' AND `link_id`='".$link_id."' AND `coin_type` = '".$coin_type."'";
;
$result = @mysqli_query($connect, $query) or die ("Error in query: $query " . mysql_error());
$row = mysqli_fetch_array($result);
$num_results = mysqli_num_rows($result);
if ($num_results > 0){
$query = "update `user_control_panel_config` set `prefix` = '$prefix' where `user_ID` = '$user_id'";
echo 'config prefixes.php ', $query;
$result = @mysqli_query($connect, $query) or die ("Error in query: $query " . mysql_error());
header('Location: config_prefixes_thanks.php');

exit();
}else{

$query = "INSERT into `user_control_panel_config`
(`user_ID`, `prefix`) values ('$user_id',  '$prefix')";
$result = @mysqli_query($connect, $query);
}
/* Redirect visitor to the thank you page */
header('Location: config_prefixes_thanks.php');
exit();


}
else
{
 

echo '<h1>Select Your Display & Prefixes for the BungeeBones Price Units</h1>';
if($type=="testcoin"){
echo '<h2>NOTE: You are operating in TestCoin Mode so all references to BTC, Bitcoin, bitcoin etc refer to the equivalent testcoin name</h2>';
}
echo '<h3><span class="mw-headline" id="Prefixes">Prefixes</span></h3>
<div class="rellink relarticle mainarticle">WikiPedia article: <a "target="_blank" href="http://wikipedia.org/wiki/Metric_prefix" title="Metric prefix">Metric prefix</a></div>
<p><a target="_blank" href="http://wikipedia.org/wiki/Metric_prefix" title="Metric prefix">Prefixes</a> are added to price unit names to produce sub-multiples of the original Bitcoin unit. All multiples are integer powers of ten, and below a hundredth all are integer powers of a thousand. For example, <i>milli-</i> denotes a multiple of a thousandth; hence there are one thousand milliBitcoin to the Bitcoin</p>

<p align="left">Bitcoin has undergone rapid rises in its value which has caused merchants to have to constantly lower their prices (as expressed in Bitcoin).
But Bitcoins value growth has been large which means merchants have had to add ever more decimal places to maintain the same price for their products. 
<p align="left">Having to count the number of zeroes everytime is tiresome, confusing and can lead to errors. To prevent that I used the naming convention of what is known as the "metric system". Within the Bitcoin community there has never been any "official" naming convention adopted but it seems the metric system will lend itself well to naming fractions of a whole Bitcoin. 

As a way to help users of BungeeBones avoid having to deal with all that I have built the following form that enables them change the display prices (in BTC) from among the various metric system prefixes. Just select the prefix you want the Bitcoin price to be displayed in. ';

echo '
<form action="'.$_SERVER['PHP_SELF'].'" method="post">
<input type="hidden" name="link_id" value="'.$link_id.'"  /> 
<table class="wikitable" style="margin:1em auto 1em auto;line-height:1.4">
<caption><a "target="_blank" href="http://wikipedia.org/wiki/SI_prefix#List_of_prefixes" title="SI prefix" class="mw-redirect">Select Your Display and prefixes for the BungeeBones price units</a></caption>

<tr style="font-size:2px">
<th colspan="12">&#160;</th>
</tr>
<tr style="font-size:90%">
<th rowspan="5">Fractions<br>Of A<br>Whole<br>Bitcoin</th>
<th>Name</th>

<th>Bitcoin</th>
<th align="left">deci-Bitcoin</th>
<th align="left">centi-Bitcoin</th>
<th align="left">milli-Bitcoin</th>
<th align="left">micro-Bitcoin</th>
<th align="left">satoshi-Bitcoin</th>
</tr>
<tr style="font-size:90%">
<th>Prefix</th>
<td>BTC</td>
<td>dBTC</td>
<td>cBTC</td>
<td>mBTC</td>
<td>MBTC</td>
<td>sBTC</td>

</tr>
<tr style="font-size:90%">
<th>Factor</th>
<td>10<sup>0</sup></td>
<td>10<sup>-1</sup></td>
<td>10<sup>-2</sup></td>
<td>10<sup>-3</sup></td>
<td>10<sup>-6</sup></td>
<td>10<sup>-8</sup></td>

</tr>
<tr style="font-size:90%">
<th>Current <br>Price<br>In Dollars</th>
<td>$750</td>
<td>$75</td>
<td>$7.50</td>
<td>$0.750</td>
<td>$0.00075</td>
<td>$0.0000075</td>

</tr>
<tr style="font-size:150%">
<th>Select</th>

<td><input type="radio" name="prefix" value="bitcoin" checked="checked" />  (BTC)</td>
<td><input type="radio" name="prefix" value="decibitcoin" /> (dBTC)</td>
<td><input type="radio" name="prefix" value="centibitcoin" />  (cBTC)</td>
<td><input type="radio" name="prefix" value="millibitcoin" />  (mBTC)</td>
<td><input type="radio" name="prefix" value="microbitcoin" />  (MBTC)</td>
<td><input type="radio" name="prefix" value="satoshibitcoin" />  (sBTC)</td>
</tr>
</table>

<p><input type="submit" value="Send it!" name="B1"></p>

</form>

</body>
</html>';

 
 


}
}//close if login true
else {
    // the user is not logged in...
    include("views/not_logged_in.php");
}
?>
