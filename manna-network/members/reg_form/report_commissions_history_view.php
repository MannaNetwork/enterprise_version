<?php


$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 

if (isset($_GET['action']) && $_GET['action'] == "log_out") {
	//$test_page_protect->log_out(); // the method to log off
echo '<h1>in Logout - Session Destroy</h1>';
session_start();
session_destroy();
}
// include the configs
require_once($_SERVER['DOCUMENT_ROOT']."/members/config/config.php");

    
// load the login class

// load php-login components
require_once($_SERVER['DOCUMENT_ROOT']."/members/php-login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

 
    
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...


$user_id = $_SESSION['user_id'];


include($_SERVER['DOCUMENT_ROOT']."/classes/commission_reports_class.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");


$B1 = $_GET['B1'];

if(isset($B1)){

}//close if isset B1
else
{
$link_selected = $_GET['link_selected'];
$commissions = new commissions;

$WdgtsLnkNumandUserID =  $commissions->getWdgtsLnkNumandUserID($link_selected);

$WdgtsUsers =  $commissions->getWdgtsUsers($link_selected); //First, get all users that signed up at this widget. 
$number_users_acqrd = count($WdgtsUsers);
$WdgtsLinks =  $commissions->getWdgtsLnks($WdgtsUsers);//Then, search links
//for all links entered by that user. Send the user _id of the owner of the links along so if they want an expanded report with urls


// the data is sent for an easier query (select from links where BBUserID = the sent user id
$widgetInfo = $commissions->getWidgetID($WdgtsLnkNumandUserID);
//returns array($id, $parent, $lft, $rgt, $link_id)
$widgetUplineTree = $commissions->getWidgetUpline($widgetInfo[2],$widgetInfo[3]);
//returns return array($id, $parent, $lft, $rgt, $link_id)
$id =  $widgetUplineTree[0];
$parent =  $widgetUplineTree[1]; 
$lft =  $widgetUplineTree[2]; 
$rgt =  $widgetUplineTree[3]; 
$link_id =  $widgetUplineTree[4];


include($_SERVER['DOCUMENT_ROOT']."/articles/include_topy.txt");


define("TDSTART", '<td width = 20% style="text-align:center">');
$block =  '<Div style= "width: 90% ;
  margin-left: auto ;
  margin-right: auto ;"><table width = 100% border="1">
<tr>'.TDSTART.'Your Web<br>Upline</td>'.TDSTART.'Number of<br>Links<br>Acquired</td>'.TDSTART.'Number Of<br>Paid Links<br>Sold</td>'.TDSTART.'Number of <br>Downlines<br>Acquired</td>'.TDSTART.'Total<br>Earnings<br>To Date</td></tr>
';
$block .= '<tr>'.TDSTART.$WdgtsLnkNumandUserID[0].'</td>'.TDSTART.$number_lnks_acqrd.'</td>'.TDSTART.'Coming<br>Soon</td>'.TDSTART.'Coming<br>Soon</td>'.TDSTART.'Coming<br>Soon</td></tr>';


foreach($lft as $key=>$value){
echo '<br>Key = ', $key;
echo '       value = ', $value;
}

$block .= '</table></div>';









echo $block;

include($_SERVER['DOCUMENT_ROOT']."/includesorig/templatebottomnsb.php");
}

} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
