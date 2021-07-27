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
include($_SERVER['DOCUMENT_ROOT']."/classes/access_user/access_user_class.php"); 
$page_protect = new Access_user;
$page_protect->access_page(); // only set this this method to protect your page
$page_protect->get_user_info();
$user_id=$page_protect->id;
$access_level=$page_protect->user_access_level;
$hello_name = ($page_protect->user_full_name != "") ? $page_protect->user_full_name : $page_protect->user;
$listing_type = ($page_protect->user_info != "") ? $page_protect->user_info : $page_protect->user;
$test_access_level = new Access_user;
$test_access_level->access_page($_SERVER['PHP_SELF'], "",1); // change this value to test differnet access levels (default: 1 = low and 10 high)

if (isset($_GET['action']) && $_GET['action'] == "log_out"){
	$test_access_level->log_out(); // the method to log off
}
if (isset($_GET['action']) && $_GET['action'] == "log_out"){
	$page_protect->log_out(); // the method to log off
}

if (isset($_POST['Final_Delete'])){
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");
$widget_record_num = $_POST['link_to_be_deleted'];
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `BB_user_ID` from `links` where `id` = '$widget_record_num'";
$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows >0){
$row = mysqli_fetch_array($result);
$BB_user_ID = $row['BB_user_ID'];
}

if($BB_user_ID != $user_id){
echo 'header(you are not authorized)';
exit();
}
$widget_record_num = htmlspecialchars($widget_record_num);
if (!preg_match("/^\d+$/", $link_selected)) die("You have error. Please contact the administrator."); 


$sql="select `lft`, `rgt` from `widgets` where `link_id` = '$widget_record_num'";
$result = @mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result);
$lft = $row['lft'];
$rgt = $row['rgt'];
$sql = "select `id` from  `widgets` where `lft` > $lft AND  `rgt` < $rgt";
$result = @mysqli_query($connect, $sql);
$num_rows_of_widgets = mysqli_num_rows($result);
$sql = "Select `id` from `users` where `upline_num`=$widget_record_num";
$result = @mysqli_query($connect, $sql);
$num_rows_of_users = mysqli_num_rows($result);
	If($num_rows_of_widgets >0){
	//record cannot be deleted becasue is part of tree for lower widgets
	$Unixtoday = mktime(date(H),date(m), date(s), date(m), date(d), date(Y));
	$sql="update `widgets` set `start_clone_date`=0, `end_clone_date`=$Unixtoday WHERE `link_id` = '$widget_record_num'";
	}
	else
	{
		If($num_rows_of_users >0){
		$sql="update `widgets` set `start_clone_date`=0, `end_clone_date`=$Unixtoday WHERE `link_id` = '$widget_record_num'";
		}
		else
		{
		$sql="DELETE FROM `widgets` WHERE `link_id` = '$widget_record_num'";
		}
	}
$result = @mysqli_query($connect, $sql);
echo'<h1>The web directory functionality has been canceled</h1>';
echo "<a href='http://BungeeBones.com/bungee_jumpers/'><h3>Return To User Control Panel</h3><a>";
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");
exit();
}

if (isset($_GET['link_selected'])){
$link_selected= htmlspecialchars($_GET['link_selected']);
if (!preg_match('/^\d+$/', $link_selected)) die("You have an improper link Id. Please return to your <a href='../index.php'>user Control panel</a> ."); 

}



include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");
?>
<h2>Widget Registration Form</h2>

<?PHP
require_once "formvalidator.php";
$show_form=true;

class MyValidator extends CustomValidator
{
	function DoValidate(&$formars,&$error_hash)
	{
      /*  if(!stristr($formars['file_name'],'.php'))
        {
            $error_hash['file_name']="please end your file name with \".php\"";
            return false;
        }



if(stristr($formars['file_name'],'/'))
        {
            $error_hash['file_name']="please remove slashes from file name";
            return false;
        }

deprecated this check to  allow joomla folders in subfolders to be added. might be needed in wordpress cases too
if(stristr($formars['folder_name'],'/'))
      {
            $error_hash['folder_name']="please remove slashes from folder name";
            return false;
        }*/
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
$file_name= $_POST['file_name'];
$folder_name=$_POST['folder_name'];
$sql="UPDATE `widgets` set `file_name`='$file_name', `folder_name`= '$folder_name' WHERE `link_id` = '$link_selected'";

$result = @mysqli_query($connect, $sql);
  echo "<h2>Edit Success!</h2>";
echo "Your web directory settings are now configured to work at $folder_name/$file_name";
echo'<h2><a href="widget_index.php?link_selected='.$link_selected.'"> <u>Return To Directory Management Index</u></a>
<a href="../index.php"> <h2><u>Return To User Control Panel</u></a></h2>';
        $show_form=false;
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
//if the choice form has been submitted skip this form and go to the next
if(!isset($_POST['Choose'])){
 $error_hash="Do you wish to edit the location?<br> or delete or deactivate the web directory listing?<br> for the web directory at $folder_name/$file_name? <p>Deleting the \"widget\" (i.e. the directory) does not affect your link listing. It just means it will no longer function, will no longer be eligible to earn income, will no longer be listed in our list of hosting sites etc.
<p>You can easily relocate your directory to a differently named folder and/or file if you like. This ability also can be useful with certain CMS type software such as Wordpress that sometime take multiple tries to locate the proper folder and file names because of the scripts aliasing system.
";
echo "<p style='text-align:left; text-size: 125%;'>",$error_hash;
echo"</p>";
?>
<form name ='choose' method='POST' action='' accept-charset='UTF-8'>
<?echo $file_name;?>

<input type="hidden" name="folder_name" value="<?echo $folder_name;?>" >
<input type="hidden" name="file_name" value="<?echo $file_name;?>" >
<table cellspacing='0' cellpadding='10' border='0' bordercolor='#000000'>
   <tr>
      <td>
         <table cellspacing='2' cellpadding='2' border='0'>
         <tr><TD colspan='2' align='left'><p style="text-align: left; font-size:125%">
<tr>
               <td colspan='2' align='left' valign='bottom' class='normal_field' style="text-align: left; font-size:125%">Delete</td>
            </tr>
 <tr>
               <td width="5">&nbsp;
               </td>
               <td  class='element_label'>
<!--<textarea name='Comments' cols='50' rows='8'></textarea>-->
<input type="radio" name="choice" value="delete" >
               </td>
            </tr>


<tr>
               <td colspan='2' align='left' valign='bottom' class='normal_field' style="text-align: left; font-size:125%">Edit</td>
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
<input type="radio" name="choice" value="edit" checked>
               </td>
            </tr>
            <tr>
               <td colspan='2' align='center'>
                  <input type='submit' name='Choose' value='Submit'>
               </td>
            </tr>
         </table>
      </td>
   </tr>
</table>
</form>
<a href="widget_index.php?link_selected=<?echo $link_selected;?>"> <h2><u>Return To Directory Management Index</u></h2></a>
<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>

<?
//the above form displays if form = "true (its  not submitted?
//after it submits it should go by it to this form below


}
else
{
//we need to check for any downline widgets to this widget and also for registered users
//if it has either don't delete the widget - just deactivate it by entering exit date in end_clone_date column 
//need to keep old widgets for tree hierarchy to distribute commissions
//if they leave users, and they later add widgets, this leaving user has forfeited their rights
$sql = "select `lft`, `rgt` from `widgets` where `link_id` = '$link_selected'";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11c Account' query");
 while($row = mysqli_fetch_array($result)){
$lft = $row['lft'];
$rgt = $row['rgt'];
}
//check if it has a downline
$sql = "select * from `widgets` where `lft`> $lft AND  `rgt` < $rgt";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11c Account' query");

$num_rows = mysqli_num_rows($result);

if($num_rows > 0){
echo 'We have detected that there are widgets and/or users that have registered under this widget. That means there may be commissions earned in the future so we will "deactivate" your widget instead of deleting it completely. Your widget will no longer be active but your downline will still remain intact for you. If you decide to reactivate a web directory for this link in the future this one will be reactivated.';
}

echo '<h1>Clicking this button will remove the installed web directory\'s functionality';

if($_POST['choice'] == 'delete'){
?>
<script language="javascript" type="text/javascript">
alert('This action cannot be undone! If you continue the widget will no longer function. If that is your desire, close this alert and click "Delete" or click "Return To User Control Panel". ');
</script>

<form method="POST" name="final_delete"  action='' accept-charset='UTF-8'>
<input type="hidden" name="link_to_be_deleted" value="<?echo $link_selected;?>">
  <input type='submit' name='Final_Delete' value='Final Delete'>

<a href="widget_index.php"> <h2><u>Return To Directory Management Index</u></h2></a>
<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>
<?
}
else
{
?>

<form name='test' method='POST' action='' accept-charset='UTF-8'>
<table cellspacing='0' cellpadding='10' border='0' bordercolor='#000000'>
   <tr>
      <td>
         <table cellspacing='2' cellpadding='2' border='0'>
         <tr><TD colspan='2' align='left'><p style="text-align: left; font-size:125%; color:red;">Caution - submitting this form will change the location on your website where your web directory script will work properly from.  </p><p style="text-align: left; font-size:125%">After you submit the form you will need to move your web directory page and script to that location in order for it to function.</p></TD></tr>
<tr>
               <td colspan='2' align='left' valign='bottom' class='normal_field' style="text-align: left; font-size:125%">Folder Name</td>
            </tr>
 <tr>
               <td width="5">&nbsp;
               </td>
               <td  class='element_label'>
<!--<textarea name='Comments' cols='50' rows='8'></textarea>-->
<input type="text" name="folder_name" size="20" value="<? echo $_POST['folder_name']; ?>">

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
<input type="text" name="file_name" size="20" value="<? echo $_POST['file_name']; ?>">
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
<a href="widget_index.php"> <h2><u>Return To Directory Management Index</u></h2></a>
<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>

<?PHP

}//close else is not delete (must be edit)
}//true == $show_form
}//close if choice selected
}//close if widget exists
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");
