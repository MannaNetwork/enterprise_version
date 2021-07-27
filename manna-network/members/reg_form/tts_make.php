<?
//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 

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

include($_SERVER['DOCUMENT_ROOT']."/members/template_topy.php");
//unset($_POST);
print_r($_POST);
?>

<table width="500"><TR><TD>
<h2>Widget Customization Form</h2>

<?

if(isset($_POST['Delete']))
{
foreach($_POST as $key=>$value){
$pieces = explode('results', $key);
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$chars = $_POST['chars'];
$char_var = explode('|', $chars);
$query = "DELETE from `text_to_voice` WHERE `id`= $pieces[1] ";
if(is_numeric($pieces[1] )){
$result = mysqli_query($connect, $query) or die("<p align='left'>There was a problem submitting your link. Usually this is the result of ");
}//closes if is numeric
}
}//close if submit isset
elseif(isset($_POST['Edit']))
{

foreach($_POST as $key=>$value){
$pieces = explode('results', $key);
if(is_numeric($pieces[1] )){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$query = "select * from `text_to_voice` where `ID` = $pieces[1]";
$result = mysqli_query($connect, $query);
while($row = mysqli_fetch_array($result)){
  $ID = $row['id'];
$page_num = $row['page_num'];
  $sentence = $row['sentence'];
 }

}
}

?>
<form name='results' method='POST' action='<?php echo htmlentities($_SERVER['PHP_SELF']); ?>' accept-charset='UTF-8'>
<!--<table cellspacing='0' cellpadding='10' border='0' bordercolor='#000000'>
   <tr>
      <td>-->
         <table width ="700px" cellspacing='2' cellpadding='2' border='0'>

<? 
if(count($_POST) > 2){
echo '<tr><td colspan="3"><h1>You selected more than one sentence to edit but you are only allowed to edit one at a time. The last one you selected is available now to edit. For the other(s) return to previous page and select again. </h1></td></tr>';
}
echo "<input type='hidden' name='edit$ID'>";
echo "<tr><td>$ID</td><td width='5px'>$page_num</td><td width='100%'><input maxlength='101' size='61' type='text' name ='sentence' value ='$sentence'></td></tr>";
?>
            <tr>
               <td align='center'>
                 &nbsp;
               </td>
           <td align='center'>
                  <input type='submit' name='EditInput' value='Edit'>
               </td>

 </tr>
         </table>
      </td>
   </tr>
</table>
</form>

<?

}//close if submit isset
elseif(isset($_POST['EditInput']))
{
print_r($_POST);
foreach($_POST as $key=>$value){
$pieces = explode('edit', $key);
echo '<br>pieces = ', $pieces[1];
if(is_numeric($pieces[1] )){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sentence = $_POST['sentence'];
$query = "UPDATE  `text_to_voice` set `sentence` = '$sentence' where `id` = $pieces[1]";
echo $query;
$result = mysqli_query($connect, $query);


}
}

echo "<h1><a href='".htmlentities($_SERVER['PHP_SELF'])."'>Return To Main TTS page</a></h1>";


}//close if submit isset
elseif(isset($_POST['Submit']))
{



foreach($_POST as $key=>$value){
$pieces = explode('results', $key);
}
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$chars = $_POST['chars'];
$char_var = explode('|', $chars);
$query = "insert into `text_to_voice` (`page_num`, `sentence`) values ";
foreach($char_var as $key=>$value){
$valuesArr[] = "('1', '$value')";
}
if($value != ""){
 $query .= implode(',', $valuesArr);
}
$result = mysqli_query($connect, $query) or die("<p align='left'>There was a problem submitting your link. Usually this is the result of ");


}//close if submit isset
else
{


include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$query = "select * from `text_to_voice` where `page_num` = 1 ORDER BY `id`";
$result = mysqli_query($connect, $query);
while($row = mysqli_fetch_array($result)){
  $ID[] = $row['id'];
  $sentence[] = $row['sentence'];
 }
$table = "";
foreach($ID as $key=>$value){
$table .= "<tr><td><input type='checkbox' name='results$ID[$key]'></td><td>$ID[$key]</td><td>$sentence[$key]</td></tr>";
}


?>
<form name='results' method='POST' action='<?php echo htmlentities($_SERVER['PHP_SELF']); ?>' accept-charset='UTF-8'>
<table cellspacing='0' cellpadding='10' border='0' bordercolor='#000000'>
   <tr>
      <td>
         <table cellspacing='2' cellpadding='2' border='0'>

<? echo $table;
?>
            <tr>
               <td align='center'>
                 &nbsp;
               </td>
           <td align='center'>
                  <input type='submit' name='Edit' value='Edit'>
               </td><td align='center'>
                  <input type='submit' name='Delete' value='Delete'>
               </td>

 </tr>
         </table>
      </td>
   </tr>
</table>
</form>





<form name='load' method='POST' action='<?php echo htmlentities($_SERVER['PHP_SELF']); ?>' accept-charset='UTF-8'>
<table cellspacing='0' cellpadding='10' border='0' bordercolor='#000000'>
   <tr>
      <td>
         <table cellspacing='2' cellpadding='2' border='0'>

<tr><td>
                                                                          
<p><h3>Enter 100 Chars max - add pipe after each line</h3>
<textarea name="chars" rows="10" cols="99">
The cat was playing in the garden.
</textarea>
<p>&nbsp;</p>





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
<?
} ////close if $login->isUserLoggedIn() == true
}
else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}

	 
