<?

//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 


require_once("../config/config.php");

    
// load the login class

// load php-login components
require_once("../php-login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

 
    
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...

$user_id = $_SESSION['user_id'];


include($_SERVER['DOCUMENT_ROOT']."/members/template_topy.php");
?>
<div style="text-align: center;">
		<a href="http://bungeebones.com/members/index.php?BB_user_id=<? echo $user_id; ?>" class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;
		<a href="http://bungeebones.com/members/overview.php?BB_user_id=<? echo $user_id; ?>" class="cssbutton sample a"><span>Overview</span></a>&nbsp;
		<a href="http://bungeebones.com/members/reg_form" class="cssbutton sample a"><span>Add Link</span></a>&nbsp;
		<a href="http://bungeebones.com/members/bitcoin.php?BB_user_id=<? echo $user_id; ?>" class="cssbutton sample a"><span>Add Funds</span></a>&nbsp;
	     <a href="http://bungeebones.com/members/update_user.php" class="cssbutton sample a"><span> Your Profile </span></a>&nbsp;<a href="http://bungeebones.com/feedback.php" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="http://www.bungeebones.com/index.php?option=com_content&view=article&id=5:bungeebones-terms-of-service&catid=25:the-project&Itemid=2" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="http://bungeebones.com/members/index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
		</div>
<div>&nbsp;</div>



<?
$msg="";
if (isset($_POST['A1'])) {
include('../../classes/ad_credit_exchange_class.php');
$adCreditExchange = new adCreditExchange;

$test_array = array(
'list of statuses',
'withdrawn',
'arbitration',
'executed',
'expired',
'accepted',
'cntroffered',
'offered');

$status = $_POST['status'];
$scope = $_POST['scope'];

if($scope == "users_listings"){
$ad_list = $adCreditExchange->viewbyseller($user_id, $status);
}
else
{
$ad_list = $adCreditExchange->viewbyseller("", $status);
}
if(count($ad_list)==0)
{
echo '<br>&nbsp;<br><br>&nbsp;<br><h1>Sorry! There were no results found.</h1>';
}
else
{
    /*** convert the array to object ***/
 //   $array =$adCreditExchange->objectToArray($ad_list);

    /*** show the array ***/
   foreach($ad_list as $key=>$value){
foreach($value as $key=>$value2){
echo '<br> key = ', $key;
echo ' ....... value2 = ', $value2;
}
}
}//close else count > 0

$count_list_by_user = $adCreditExchange->countbyseller($user_id);
echo '<br>$count_list_by_user = ', $count_list_by_user;
}
