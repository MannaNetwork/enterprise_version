<?
//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 
$default_price = "0.00";//this is what charge is applied to any not having a price set in the database
$default_adj = "1";
if (isset($_GET['action']) && $_GET['action'] == "log_out") {
session_start();
session_destroy();
}
// include the configs
require_once($_SERVER['DOCUMENT_ROOT']."/members/config/config.php");

// load php-login components
require_once($_SERVER['DOCUMENT_ROOT']."/members/php-login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();
    
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...

$user_id = $_SESSION['user_id'];

if (isset($_GET['link_selected'])){
$link_selected=htmlspecialchars($_GET['link_selected']);

}

include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");
?>
<h2>Widget Installation & Registration Form</h2>

<?PHP
require_once "formvalidator.php";
$show_form=true;

class MyValidator extends CustomValidator
{
	function DoValidate(&$formars,&$error_hash)
	{
        if(!stristr($formars['file_name'],'.php'))
        {
            $error_hash['file_name']="please end your file name with \".php\"";
            return false;
        }



if(stristr($formars['file_name'],'/'))
        {
            $error_hash['file_name']="please remove slashes from file name";
            return false;
        }
if(stristr($formars['folder_name'],'/'))
        {
            $error_hash['folder_name']="please remove slashes from folder name";
            return false;
        }
		return true;
	}
}

if(isset($_POST['Submit']))
{
    $validator = new FormValidator();
 $validator->addValidation("folder_name","req","Please fill in folder name");
  $validator->addValidation("file_name","req","Please fill in file name");
    
 //$validator->addValidation("Email","email","The input for Email should be a valid email value");
  //  $validator->addValidation("Email","req","Please fill in Email");
    $custom_validator = new MyValidator();
    $validator->AddCustomValidator($custom_validator);

    if($validator->ValidateForm())
    {
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `file_name`, `folder_name`, `end_clone_date` from `widgets` where `link_id` = '$link_selected'";
$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows >0){
$row = mysqli_fetch_array($result);
$end_clone_date = $row['end_clone_date'];
if($end_clone_date > '0000-00-00 00:00:00'){
echo 'That link is no longer eligible to host a web directory';

}
else
{
echo'<h1>OOPS! That web directory has already been entered!</h1>';
echo "<a href='http://BungeeBones.com/bungee_jumpers/'><h3>Return To User Control Panel</h3><a>";
}
exit();
}
        echo "<h2>Widget Registration Success!</h2>";
echo"<p>You will now have widget configuration and management buttons in the right columns of this link's row on you CP admin page.<p>Use the management section to locate the web directory templates to install in the location you just submitted.";
echo "<a href='http://BungeeBones.com/bungee_jumpers/'><h3>Return To User Control Panel</h3><a>";
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2accusersconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="SELECT `wdgts_lnk_num`from `users` where `user_id` = '$user_id'";
//SELECT `wdgts_lnk_num`from `users` where `id` = '3693'

$result = @mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result);
$wdgts_lnk_num = $row['wdgts_lnk_num'];
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="Select `id` from `widgets` where `link_id` = $wdgts_lnk_num";

$result = @mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result);
$parent = $row['id'];
 $file_name=$_POST['file_name'];
$folder_name = $_POST['folder_name'];
$sql="INSERT INTO `widgets` (`file_name`, `folder_name`, `link_id`, `time_period`, `parent`)values('$file_name', '$folder_name','$link_selected','8', '$parent')";

$result = @mysqli_query($connect, $sql);
        $show_form=false;
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/widget_mgr/widget_tree_mgmt_class.php"); 

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

//uncomment the below to rebuild widget tree manually
$widg_mng = new widget_tree_mgmt;
$widg_mng->rebuildTree('1',1);
    }
    else
    {
        echo "<B>Validation Errors:</B>";

        $error_hash = $validator->GetErrors();
        foreach($error_hash as $inpname => $inp_err)
        {
            echo "<p>$inpname : $inp_err</p>\n";
        }        
    }
}

if(true == $show_form)
{
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `file_name`, `folder_name` from `widgets` where `link_id` = '$link_selected'";
$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows >0){
$row = mysqli_fetch_array($result);
$folder_name = $row['folder_name'];
$file_name = $row['file_name'];
 $error_hash="You already have a widget established at $folder_name/$file_name";
echo "<h1>",$error_hash;
echo"</h1>";
}
else
{






?>

<form name='test' method='POST' action='' accept-charset='UTF-8'>
<table cellspacing='0' cellpadding='10' border='0' bordercolor='#000000'>
   <tr>
      <td>
         <table cellspacing='2' cellpadding='2' border='0'>
         <tr><TD colspan='2' align='left'><p style="text-align: left; font-size:125%">To receive your free, fully managed, fully populated (with categories and the quality links of our webmaster community) web directory script and web income producing opportunity start by telling us where you will be installing the file on your website.  </p><p style="text-align: left; font-size:125%">You will be given 3 styles of fully functional working example directories to help you get the web directory installed on your site. The examples should work just by a simple copy and paste (no configuration necessary). </p></TD></tr>
<tr>
               <td colspan='2' align='left' valign='bottom' class='normal_field' style="text-align: left; font-size:125%">Folder Name</td>
            </tr>
 <tr>
               <td width="5">&nbsp;
               </td>
               <td  class='element_label'>
<!--<textarea name='Comments' cols='50' rows='8'></textarea>-->
<input type="text" name="folder_name" size="20">
               </td>
            </tr>


<tr>
               <td colspan='2' align='left' valign='bottom' class='normal_field' style="text-align: left; font-size:125%">File Name</td>
            </tr>
       <!--     <tr>
               <td>
               </td>
               <td class='element_label'>
<textarea name='Comments' cols='50' rows='8'></textarea>
               </td>
            </tr>-->

 <tr>
               <td width="5">&nbsp;
               </td>
               <td class='element_label'>
<!--<textarea name='Comments' cols='50' rows='8'></textarea>-->
<input type="text" name="file_name" size="20">
               </td>
            </tr>
            <tr>
               <td colspan='2' align='center'>
                  <input type='submit' name='Submit' value='Submit'>
               </td>
            </tr>
         </table>
      </td>
   </tr>
</table>
</form>
<?PHP
}//true == $show_form
}//close if widget exists
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");

} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
