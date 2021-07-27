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
$coin_type = $_GET['fut_buyr_type'];

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

$price_slot_range   = check_input($_POST['price_slot_range']);
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$query = "SELECT *
FROM `user_control_panel_config`
WHERE `user_ID` = '".$user_id."' AND `link_id`='".$link_id."' AND `coin_type`='".$coin_type."'";
$result = @mysqli_query($connect, $query) or die ("Error in query: $query " . mysql_error());
$row = mysqli_fetch_array($result);
$num_results = mysqli_num_rows($result);
if ($num_results > 0){
$query = "update `user_control_panel_config` set `price_slot_range` = '$price_slot_range' where `user_ID` = '$user_id' AND `link_id`='$link_id' AND `coin_type`='".$coin_type."'";
$result = @mysqli_query($connect, $query) or die ("Error in query: $query " . mysql_error());
//echo 'config price slots.php line 67 ', $query;
header('Location: config_price_slots_thanks.php');


exit();
}else{

$query = "INSERT into `user_control_panel_config`
(`user_ID`, `link_id`, `price_slot_range`, `coin_type`) values ('$user_id', '$link_id', '$price_slot_range', '$coin_type')";
$result = @mysqli_query($connect, $query);
}
/* Redirect visitor to the thank you page */
header('Location: config_price_slots_thanks.php');
exit();


}
else
{
 

echo '<h1>Select Your Menu Length for the BungeeBones Price Units</h1>
<h3><span class="mw-headline" id="Prefixes">How Many Price Slots You Want To View?</span></h3>

<p align="left">"Price Slots" are the basic organizational unit for how the paid links are displayed. They cover a large range of prices in order to handle the pricing dynamics of the large number of categories and regions (i.e. prices vary considerably according to category and considerably depending on the regional scope the website wishes to advertise in). 
<p align="left">The default is to have ALL the price slots displayed. You may prefer to have it list only a certain price range.  




<form action="'.$_SERVER['PHP_SELF'].'" method="post">
<input type="hidden" name="link_id" value="'.$link_id.'"  /> 
<input type="hidden" name="coin_type" value="'.$coin_type.'"  /> 
<table class="wikitable" style="margin:1em auto 1em auto;line-height:1.4">
<caption><a "target="_blank" href="http://wikipedia.org/wiki/SI_prefix#List_of_prefixes" title="SI prefix" class="mw-redirect">Select The Price Range(s) You Want Displayed</a></caption>

<tr style="font-size:2px">
<th colspan="12">&#160;</th>
</tr>


<tr style="font-size:150%">
<th>Select</th>

<td><input type="radio" name="price_slot_range" value="high"  />  Highest Prices</td>
<td><input type="radio" name="price_slot_range" value="mid" /> Midrange Prices</td>
<td><input type="radio" name="price_slot_range" value="low" /> Lowest Prices</td>
<td><input type="radio" name="price_slot_range" value="all" checked="checked"/> All Prices</td>
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
