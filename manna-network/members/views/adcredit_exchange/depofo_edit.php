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
$status = 'accepted';

$getUserID= $_GET['user_id'];
$getdepofo_num= $_GET['depofo_num'];
unset($depofo_list);
if(isset($_POST[cancel])){

header('location: slr_admin_profile.php');
exit();

}

if(!isset($_POST[A1])){
if($getUserID != $user_id)
{
unset($getUserID);
exit("Your user is not authorized to perform this action");
}

}



$msg="";

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

$status = "accepted";



if(isset($_POST[A1])){
$newname = $_POST['newname'];

$newnumber = $_POST['newnumber'];

$depofonumber = $_POST['depofonumber'];

if($depofonumber != "" AND $newnumber != "" AND $newname != ""){

include('mcrypt.php');

$iv = mcrypt_create_iv(
    mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC),
    MCRYPT_DEV_URANDOM
);


$encrypted = base64_encode(
    $iv .
    mcrypt_encrypt(
        MCRYPT_RIJNDAEL_256,
        hash('sha256', $key, true),
        $newname,
        MCRYPT_MODE_CBC,
        $iv
    )
);

$encrypted2 = base64_encode(
    $iv .
    mcrypt_encrypt(
        MCRYPT_RIJNDAEL_256,
        hash('sha256', $key, true),
        $newnumber,
        MCRYPT_MODE_CBC,
        $iv
    )
);

$adCreditExchange = new adCreditExchange;
$adCreditExchange->update_depofo($depofonumber, $encrypted, $encrypted2);


header( "refresh:5;url=slr_admin_profile.php" );
echo '<h1 style="color:red;">Your settings have been updated. This page will refresh to your profile page to see the changes in five seconds.</h1>';
exit();
}
else
{
echo '<h1 style="color:red;">You cannot leave the bank account number field or the account holder\s name empty</h1>';
exit();
}
}

//NOTE this first section of data retrieval will be obsolete if the form has been submitted changing the save value
$depofo_list = $adCreditExchange->get_depofo_numbers($user_id, "");//get depofo number from listings table

foreach($depofo_list as $key=>$value){
foreach($value as $key=>$value2){
$depofo_numbers[] = $value2;
}
}

// check to make sure the account they are editing is theirs
if (!in_array($getdepofo_num, $depofo_numbers)) {
   echo "You are not authorized to perform this action on that account";
unset($getdepofo_num);
unset($depofo_numbers);
exit();
}


// now for each depofo number get the acct number and name on the account
$bank_list = $adCreditExchange->view_depofo($getdepofo_num);

foreach($bank_list as $key=>$value3){
foreach($value3 as $key=>$value4){
}

//now for each value decrypt
include('mcrypt.php');
$data = base64_decode($value3[number]);
$data2 = base64_decode($value3[name]);
$is_saved[] = $value3[save];
$iv = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC));
$iv2 = substr($data2, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC));

$decrypted[] = rtrim(
    mcrypt_decrypt(
        MCRYPT_RIJNDAEL_256,
        hash('sha256', $key, true),
        substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)),
        MCRYPT_MODE_CBC,
        $iv
    ),
    "\0"
);
$decrypted2[] = rtrim(
    mcrypt_decrypt(
        MCRYPT_RIJNDAEL_256,
        hash('sha256', $key, true),
        substr($data2, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)),
        MCRYPT_MODE_CBC,
        $iv2
    ),
    "\0"
);

}
//} outer foreach no longer needed - only doing one record

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

if(count($bank_list)==0)
{
echo '<br>&nbsp;<br><br>&nbsp;<br><h1>Sorry! There were no results found.</h1>';
}
else
{

$msg .=  '<style>@import url("blinkfile.css")</style>
<table style = \"margin-left:auto; 
    margin-right:auto;\" bgcolor=\"white\" width=\"75%\">
<table border="2" cellpadding="5" width="100%" >
<tr><td>Previous<br>Account Number</td><td>Previous<br>Name On<br> Account</td><td>New Number*</td><td>New Name*</td></tr>';
$msg .='<form method="post" action="'. htmlentities($_SERVER['PHP_SELF']).'" style="width:80"> 
<input type="hidden" name = "depofonumber" value="'.$getdepofo_num.'">';

   foreach($decrypted as $key=>$value){
if($value != ""){

$msg .= '<tr><td>'.$value.'</td><td>'.$decrypted2[$key].'</td><td><input type="text" name="newnumber" size="12"></td><td><input type="text" name="newname" size="12">';

//$msg .= $depofo_msg[$key] ;
$msg .= '</td></tr>';
}
}//closes outer foreach
$msg .= '<tr><td colspan="4">* Cannot be empty</td></tr>

<tr><td colspan="2"><input type="submit" name="A1" value="SAVE NEW SETTINGS"></td><td colspan = "2"><input type="submit" name="cancel" value="Cancel"></td></tr></form></table>';
}//closes if count

echo $msg;
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';

include($_SERVER['DOCUMENT_ROOT']."/members/templatebottomnsb.php");


} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

