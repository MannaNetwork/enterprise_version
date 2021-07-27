<?
 include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/access_user_class.php"); 
  $page_protect = new Access_user;
  $page_protect->access_page(); // only set this this method to protect your page
$page_protect->get_user_info();
$user_id=$page_protect->id;
$access_level=$page_protect->user_access_level;
$hello_name = ($page_protect->user_full_name != "") ? $page_protect->user_full_name : $page_protect->user;
$listing_type = ($page_protect->user_info != "") ? $page_protect->user_info : $page_protect->user;
$test_access_level = new Access_user;
$test_access_level->access_page($_SERVER['PHP_SELF'], "", 5); // change this value to test differnet access levels (default: 1 = low and 10 high)
$id=$page_protect->id;
$user_id=$page_protect->id;

if (isset($_GET['action']) && $_GET['action'] == "log_out"){
$test_access_level->log_out(); // the method to log off
}
if (isset($_GET['action']) && $_GET['action'] == "log_out"){
$page_protect->log_out(); // the method to log off
}

include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/reg_form/config.php"); //old yald, don't use db connects but use settings
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/reg_form/classes/mobile_class.php");  
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/connect.php");
$link_selected = $_GET['link_selected'];
//include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_top1.php");
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_topy.php");
?>
<div style="text-align: center;">
   				<a href="http://bungeebones.com/bungee_jumpers/" class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/reg_form" class="cssbutton sample a"><span>Add Link</span></a>&nbsp;<a  class="cssbutton sample a"><span> Reports </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/update_user.php" class="cssbutton sample a"><span> Your Profile </span></a>&nbsp;<a href="http://bungeebones.com/feedback.php" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="http://bungeebones.com/articles/terms_of_service.php/" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
					</div>
<?
if($link_selected != ""){
echo '<h1>Reports For Link ID# '.$link_selected;


echo'

<p><a href="email_over_pops.php"> email_over_pops.php </a></p>

<p><a href="links_entered_per_user_admin.php"> links_entered_per_user_admin.php </a></p>

<p><a href="links_entered_per_user_user.php"> links_entered_per_user_user.php </a></p>

<p><a href="registered_users.php"> registered_users.php </a></p>

<p><a href="users_link_list.php"> users_link_list.php </a></p>
<p><a href="email_over_pops.php"> email_over_pops.php </a></p>

<p><a href="links_entered_per_user_admin.php"> links_entered_per_user_admin.php </a></p>

<p><a href="links_entered_per_user_user.php"> links_entered_per_user_user.php </a></p>

<p><a href="registered_users.php"> registered_users.php </a></p>

<p><a href="users_link_list.php"> users_link_list.php </a></p>





<p>This page will soon display reports about the performance of BungeeBones across each of your websites whether you have one with the web directory installed on it or a hundred websites.

We will be able to do such things as report number of queries submitted to it, the number of registrations from it, conversion factors on such things as how many converted to paid advertising.  and how many installed a web directory themselves. <p>

<p>This is still in development right now as much of the data needed to generate reports from is depneding on you and our other users to install web directories and add links.</p>';

echo'<table width="70%" border="1" cellpadding="4" cellspacing="5"><tr><tdcolspan=2">Management Pages</td></tr>
<tr><td width="25%">Name</td><td>Description</td></tr>
<tr><td width="25%"><a href="http://bungeebones.com/bungee_jumpers/insert_directory_instr.php?link_selected='.$link_selected.'&code_type=template">Get New Code<br>Template</a></td><td>Did you make a change? A move? Want to try a new design? Here is the code to install BungeeBones again. This code is for generating the code for a complete web page template with a top header, two side bars, and a footer. You insert your own graphics and text to match your current site.</td></tr>
<tr><td width="25%"><a href="http://bungeebones.com/bungee_jumpers/insert_directory_instr.php?link_selected='.$link_selected.'&code_type=barebones">Get New Code<br>Bare Bones</a></td><td>Same as above except this form delivers just two snippets of code that you then insert into your own template. One goes in the "head" section and the other in the body. If you don\'t know what the "head" section is then the other one might be easier but you can install them bot on your site for models while putting your directory together..</td></tr>
';
if($access_level == 10){
echo'<tr><td width="25%"><a href="http://bungeebones.com/bungee_jumpers/reports/links_entered_per_user_admin.php?link_selected='.$link_selected.'&code_type=admin_overview">Admin Overview</a></td><td>Admin view of link submissions totlaled by unique user id</td></tr>';
//<tr><td width="25%"><a href="http://bungeebones.com/link_exchange/admin/email_invoice.php?link_selected='.$link_selected.'&code_type=email_over_pops">Email Overpops</a></td><td>See and email all users in a category based on populations.  by unique user id</td></tr>



}
else
{
echo'<tr><td width="25%"><a href="http://bungeebones.com/bungee_jumpers/reports/links_entered_per_user_user.php?link_selected='.$link_selected.'&code_type=user_overview">My Account - Overview</a></td><td>View of link submissions of those who signed up from your site, totaled by their user id</td></tr>
';

}
echo'
</table>
';

}
else
{
echo '<h1>Global Reports '.$link_selected;



echo'
<p>This page will soon display reports about the performance of BungeeBones across all your websites whether you have one with the web directory installed on it or a hundred websites.

We will be able to do such things as report number of queries submitted through each of your sites, the number of registrations from them, conversion factors on such things as how many converted to paid advertising.  and how many installed a web directory themselves. <p>

<p>This is still in development right now as much of the data needed to generate reports from is depneding on you and our other users to install web directories and add links.</p>

';
}
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/templatebottomnsb.php");
//include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_bottom1.php");

?>
