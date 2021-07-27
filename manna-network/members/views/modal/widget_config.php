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
if (isset($_GET['link_id'])){
$link_selected=$_GET['link_id'];
}
if (isset($_GET['type'])){
$type=$_GET['type'];
}
if($_SESSION['link_selected']){

$link_selected=$_SESSION['link_selected'];
}

//include($_SERVER['DOCUMENT_ROOT']."/members/template_topy.php");
?>

<table width="500"><TR><TD>
<h2>Widget Customization Form</h2>

<?

if(isset($_POST['Submit']))
{
if (!preg_match("/^Submit$/", $_POST['Submit'])) die("Bad submit, please re-enter.");

$custom_title1= htmlspecialchars($_POST['custom_title1']);
$custom_title2= htmlspecialchars($_POST['custom_title2']);



$time_period= htmlspecialchars($_POST['time_period']);
$donate= htmlspecialchars($_POST['donate']);
$leaving_page= htmlspecialchars($_POST['leaving_page']);
$new_button_color= htmlspecialchars($_POST['new_button_color']);
$button_font_color= htmlspecialchars($_POST['button_font_color']);
$button_font_size= htmlspecialchars($_POST['button_font_size']);
$is_niche= $_POST['is_niche'];
$no_follow_act= $_POST['no_follow_act'];

if($time_period !== "0"){ //if $time_period !== "0" it means they selected indefinitely or another time period 
//- means they want to display freebies and freebies = true
$display_freebies= '1';
}
else
{
$display_freebies= '0';
}
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `id`, `file_name`, `folder_name` from `widgets` where `link_id` = '$link_selected'";
$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);



if($num_rows >0){
$sql="update `widgets` set `custom_title1` = '$custom_title1',
`custom_title2`= '$custom_title2',
`display_freebies`= '$display_freebies',

`donate`= '$donate',
`leaving_page`= '$leaving_page',
`new_button_color` = '$new_button_color',
`button_font_color`= '$button_font_color',
`button_font_size`= '$button_font_size',
`is_niche`= '$is_niche',
`time_period` = '$time_period'
WHERE `link_id` = '$link_selected'";

//`time_period` = '$time_period',
$result = @mysqli_query($connect, $sql);
$sql="update `links` set `nofollow` = '$no_follow_act'
WHERE `id` = '$link_selected';
";

$result = @mysqli_query($connect, $sql);

echo '<h1>Your configuration settings have been updated.</h1>

<a target="_top" href="widget_index_custom.php?link_selected='.$link_selected.'"> <h2><u>Return To Directory Management Index</u></h2></a>
<a target="_top" href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';
exit();
}
}
else
{
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");


$sql="select `id`, `custom_title1`,`custom_title2`,`display_freebies`,`time_period`,`donate`,`leaving_page`,`is_niche`,`file_name`, `folder_name`, `new_button_color`, `button_font_color`, `button_font_size` from `widgets` where `link_id` = '$link_selected'";

$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows>0){
$row = mysqli_fetch_array($result);
$id = $row['id'];
$custom_title1 = $row['custom_title1'];
$custom_title2 = $row['custom_title2'];
$display_freebies = $row['display_freebies'];
$time_period = $row['time_period'];
$donate = $row['donate'];
$leaving_page = $row['leaving_page'];
$is_niche = $row['is_niche'];
$folder_name = $row['folder_name'];
$file_name = $row['file_name'];
$new_button_color = $row['new_button_color'];
$button_font_color = $row['button_font_color'];
$button_font_size = $row['button_font_size'];
}

$sql="select `nofollow` from `links` where `id` = '$link_selected'";
$result = @mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result);
$nofollow = $row['nofollow'];
?>
 <p align="left"><b>Though none of the configurations below are "critical" to the operation of your web directory, setting these make the web directory unique and dynamic by inserting unique content into the pages' titles, keywords, and description. These settings are part of the BungeeBones Dynamic Header System which places category information into each results page's keyword and description. What that means is that every results page is unique for both the category it is displaying as well as for your website.</p> 
<p align="left">
Please make sure that your installation is working properly before you adjust these settings.
<form name='test' method='POST' action='' accept-charset='UTF-8'>
<table cellspacing='0' cellpadding='10' border='0' bordercolor='#000000'>
   <tr>
      <td>
         <table cellspacing='2' cellpadding='2' border='0'>

<ul><li>

 <p align="left"><b>Create Custom Titles Unique To Your Website And To Every Results Page</b>
	<p align="left">Part of the code you installed is in the head section of the page and it produces dynamic titles for you. It does that by sandwiching the category name between two words or phrases that you choose and enter below. They can be anything you like. Some examples are the word "Best" for the first half and "Links" for the second. The final product then would be titles such as "Best Real Estate Links" or "Best Computer Links". You might say "Recommended" or "Human Reviewed" for other examples.
	<p><b>Custom Title: First half</b>

<br><input type="hidden" name = "link_selected" value="<?echo $link_selected;?>" >
    <input id="custom_title1" size="40" type="text" name="custom_title1" value="<?echo $custom_title1;?>"></p>
         
<p>&nbsp;</p>
<p><b>Custom Title: Second half </b>
<br><input id="custom_title2" size="40" type="text" name="custom_title2"   value="<?echo $custom_title2;?>">
        <span style="font-size:70%;">eg. Links, Info, Websites etc</span>
      
	</li>	    
   <p>&nbsp;</p>
     <li><b>Do You Want To Display &quot;Free&quot; Sites?</b>
<p align="left">Part of the tradition of the web is that so much of it is free. When was the last time you paid to use a Search Engine? or email? Along with that tradition BungeeBones makes the commitment FOR IT'S OWN DOMAIN AND WEBSITE that it will always have free advertising available. But something we don't do is to promise YOUR website as a place for free advertising. So we offer you a configuration enabling you to select whether or not to display free links on your web directory and, if so, then even for how long.
<p align="left">BungeeBones strongly recommends that our "partners" with the directory installed also provide free links - especially during this critical startup time. But we also anticipate that later, as more directories are added and the traffic increases, then it will even be advantageous for some to refrain from offering them. Missing out on some traffic is just an added incentive for them to become a paying link.
<p align="left"><b>Select the time you wish to display them on your site for (after their registration) or select "Never - do not display free links</b>
      <p align="left"><select size="1" name="time_period">

      <option value="0"<? if ($time_period==0){ echo " selected ";}?>> Never - do not display free links</option>
      <option value="1"<? if ($time_period==1){ echo " selected ";}?>>1_month</option>
      <option value="2"<? if ($time_period==2){ echo " selected ";}?>>2_month</option>
      <option value="3"<? if ($time_period==3){ echo " selected ";}?>>3_month</option>
      <option value="4"<? if ($time_period==4){ echo " selected ";}?>>4_month</option>
      <option value="5"<? if ($time_period==5){ echo " selected ";}?>>5_month</option>
      <option value="6"<? if ($time_period==6){ echo " selected ";}?>>6_month</option>
      <option value="7"<? if ($time_period==7){ echo " selected ";}?>>1_year</option>
      <option value="8"<? if ($time_period==8){ echo " selected ";}?>>Indefinitely</option>
      </select>
 
	
<br /><br />
<br>
</li>
<!--<li><p align="left"><b>Donate Your Web Traffic To Your Favorite Charity!</b></p></li>

<p align="left">If you wish to donate what basically amounts to "found money" (i.e. the proceeds of your directory) to a charity of your choice then enter your instructions for donating to them here. Provide all the info we will need in order to complete the payment. 
<p><textarea name="donate" cols="60" rows="3"><? echo $donate;?></textarea><br>
<p>&nbsp;</p>-->
<!--<li><b>Customize Your "Leaving Our Site" Message</b></p>
<p align="left">Whenever a user (i.e one with a website) visits one of our distributed web directory sites and sees the "Add A Link" button they  are, generally, interested in the program. But in order to prepare them for the pending redirect to the BungeeBones website for registration we provide a transition page telling the users what is happening. We provide a message to them that you can customize (you can read it <a target="_blank" href="http://bungeebones.com/articles/leaving_website2.php/3112//">HERE</a>).

<p>If you desire to, you can provide your own message instead of default one. The "leaving page" prepares users for the redirection to our website and we encourage our installers to use this custom page as an opportunity to endorse and recommend the BungeeBones system as well. Doing so increases the chances that they, too, will become an installer and earn you additional income</p>
<p align="left">To use your own transition page create it and save it in the same folder/web directory where the installation on your site is located. Then enter the url below and we will direct them to that page instead of the default. <B>Your Custom Page must have the link to the BungeeBones registration page on it of course</B> but we are open to innovation and different approaches to expressing what BungeeBones is and what it hopes to become (a webmaster social network? a new web advertising paradigm? The best fundraising tool ever?)</p>
<p align="left">Create and then post your transition page's url here. You can <a href="ftp://anonymous%40bungeebones.com:anonymous%40bungeebones.com@ftp.bungeebones.com/leaving_website2.php.tar.gz">DownLoad Our Leaving Page</a> to use as a template, if you wish, or you can create your very own. We will inspect it and reserve the right to have you edit it's content or not display it, however. </p>
                                                                          
<p><input type="text" name="leaving_page" size="50" value="<? echo $leaving_page;?>"></p>


-->

<li><b>Customize Your "Leaving Our Site" Message. Now, New! A "Leaving Our Website" Alert in A Modal Display</b></p>

<p align="left">The "Leaving Our Site" message is for when your visitor wishes to add a link to your/our web directory. Since they need to do so at our server (so that we can distribute their information to the other installations and also in order to pay you for whatever purchases they make) we need to let them know. If they were to suddenly find themselves on our site rather than yours they might get upset so we provide this transition page or "leaving" page where we prepare them for the move. The page opens when they click the "Add A Link" button on your website'. 

<p align="left">The page is now included in the installation files. It is easy to edit the page and customize it any way and manner you like and we encourage our users to do so. It provides you, our users, the opportunity to give BungeeBones your own personal recommendation and endorsement. If users from your site don't go beyond just adding a free link then neither of us earn anything. On the other hand, if you provide some marketing help it may prove to be just the encouragement the new user needed to enter in the buying mood.
<p align="left"><b>If this is a new install then the file is located in <b>your installation folder/modal/leaving_website.php</b>. You can open it with an editor and change/modify/replace as you wish.</b>
<p align="left">If you installed your web directory before Dec. 20, 2013 then <a href="/downloads/modal.zip">download this file</a>, then upload it to the same folder you installed your directory to, then unzip it.
<p>&nbsp;</p>


<li><b>Change The "Add A Link" Button/Image</b></li>


<p align="left">The default "Add A Link" images are located in the /modal directory and are named and function like this: addalinkbb1.gif loads on page load, addalinkbb2.gif is the mouseover image and addalinkbb3.gif is what it returns to on mouseout.
You can easily customise them to match your own website with any image editing software such as <a target="_blank" href="http://http://www.gimp.org/downloads/">GIMP</a> or upload new ones to replace them and give the new ones the same names.
</p>
<!--
<p align="left">
<select size="1" name="new_button_color">
<option value="aqua" <? if ($new_button_color == "aqua"){ echo " selected ";}?>>Aqua</option>
<option value="black" <? if ($new_button_color == "black"){ echo " selected ";}?>>Black</option>
<option value="blue" <? if ($new_button_color == "blue"){ echo " selected ";}?>>Blue</option>
<option value="fuchsia" <? if ($new_button_color == "fuchsia"){ echo " selected ";}?>>Fuschia</option>
<option value="gray" <? if ($new_button_color == "gray"){ echo " selected ";}?>>Gray</option>
<option value="green" <? if ($new_button_color == "green"){ echo " selected ";}?>>Green</option>
<option value="lime" <? if ($new_button_color == "lime"){ echo " selected ";}?>>Lime</option>
<option value="maroon" <? if ($new_button_color == "maroon"){ echo " selected ";}?>>Maroon</option>
<option value="navy" <? if ($new_button_color == "navy"){ echo " selected ";}?>>Navy</option>
<option value="olive" <? if ($new_button_color == "olive"){ echo " selected ";}?>>Olive</option>
<option value="orange" <? if ($new_button_color == "orange"){ echo " selected ";}?>>Orange</option>
<option value="purple" <? if ($new_button_color == "purple"){ echo " selected ";}?>>Purple</option>
<option value="red" <? if ($new_button_color == "red"){ echo " selected ";}?>>Red</option>
<option value="silver" <? if ($new_button_color == "silver"){ echo " selected ";}?>>Silver</option>
<option value="teal" <? if ($new_button_color == "teal"){ echo " selected ";}?>>Teal</option>
<option value="white" <? if ($new_button_color == "white"){ echo " selected ";}?>>White</option>
<option value="yellow" <? if ($new_button_color == "yellow"){ echo " selected ";}?>>Yellow</option>

</select></p><p align="left">If the default button style is ok but the color is wrong you can select a different color here that best matches your site.
</p>


 

<p align="left">
<select size="1" name="button_font_color">
<option value="aqua" <? if ($button_font_color == "aqua"){ echo " selected ";}?>>Aqua</option>
<option value="black"<? if ($button_font_color == "black"){ echo " selected ";}?> >Black</option>
<option value="blue" <? if ($button_font_color == "blue"){ echo " selected ";}?>>Blue</option>
<option value="fuchsia" <? if ($button_font_color == "fuchsia"){ echo " selected ";}?>>Fuschia</option>
<option value="gray" <? if ($button_font_color == "gray"){ echo " selected ";}?>>Gray</option>
<option value="green" <? if ($button_font_color == "green"){ echo " selected ";}?>>Green</option>
<option value="lime" <? if ($button_font_color == "lime"){ echo " selected ";}?>>Lime</option>
<option value="maroon" <? if ($button_font_color == "maroon"){ echo " selected ";}?> >Maroon</option>
<option value="navy" <? if ($button_font_color == "navy"){ echo " selected ";}?>>Navy</option>
<option value="olive" <? if ($button_font_color == "olive"){ echo " selected ";}?>>Olive</option>
<option value="orange" <? if ($button_font_color == "orange"){ echo " selected ";}?>>Orange</option>
<option value="purple" <? if ($button_font_color == "purple"){ echo " selected ";}?>>Purple</option>
<option value="red" <? if ($button_font_color == "red"){ echo " selected ";}?>>Red</option>
<option value="silver" <? if ($button_font_color == "silver"){ echo " selected ";}?>>Silver</option>
<option value="teal" <? if ($button_font_color == "teal"){ echo " selected ";}?>>Teal</option>
<option value="white" <? if ($button_font_color == "white"){ echo " selected ";}?>>White</option>
<option value="yellow" <? if ($button_font_color == "yellow"){ echo " selected ";}?>>Yellow</option>


</select></p><p align="left">Now repeat the process for the button's font color
</p>

 

<p align="left">
<select size="1" name="button_font_size">
<option value="80" <? if ($button_font_size == "80"){ echo " selected ";}?>>Smaller</option>
<option value="120" <? if ($button_font_size == "120"){ echo " selected ";}?>>Larger</option>
<option value="140" <? if ($button_font_size == "140"){ echo " selected ";}?>>Larger+</option>
<option value="180" <? if ($button_font_size == "180"){ echo " selected ";}?>>Larger++</option>
<option value="220" <? if ($button_font_size == "220"){ echo " selected ";}?>>Largest</option>

  </select></p><p align="left">Now repeat the process for the button's TEXT size</p>
-->


<li><b>Operate BungeeBones As A "Niche" Directory</b>
<p align="left">The distributed web directory can be operated as a "niche" directory by only showing the sub-categories and links of one, selected main category. For example, you can operate it as a "Real Estate" Directory or a "Computer" Directory.</p>

<p>
Selecting One Of These Will Cause Your Directory To Only Display That Category</p>
<select size="1" name="is_niche">
<option value="0" <?if ($is_niche==0){ echo " selected ";}?>>Niche Option</option>
<option value="60" <?if ($is_niche==60){ echo " selected ";}?>>Accessories</option>
<option value="65" <?if ($is_niche==65){ echo " selected ";}?>>Art/Photo/Music</option>
<option value="69" <?if ($is_niche==69){ echo " selected ";}?>>Automotive</option>
<option value="102" <?if ($is_niche==10023){ echo " selected ";}?>>Bitcoin</option>
<option value="102" <?if ($is_niche==102){ echo " selected ";}?>>Books/Media</option>
<option value="111" <?if ($is_niche==111){ echo " selected ";}?>>Business</option>
<option value="125" <?if ($is_niche==125){ echo " selected ";}?>>Careers</option>
<option value="126" <?if ($is_niche==126){ echo " selected ";}?>>Clothing/Apparel</option>
<option value="134" <?if ($is_niche==134){ echo " selected ";}?>>Commerce</option>
<option value="9" <?if ($is_niche==9){ echo " selected ";}?>>Computers</option>
<option value="148" <?if ($is_niche==148){ echo " selected ";}?>>Education</option>
<option value="147" <?if ($is_niche==147){ echo " selected ";}?>>Electronics</option>
<option value="2198" <?if ($is_niche==2198){ echo " selected ";}?>>Environment</option>
<option value="2702" <?if ($is_niche==2702){ echo " selected ";}?>>Finance</option>
<option value="1307" <?if ($is_niche==1307){ echo " selected ";}?>>Games</option>
 <option value="1330" <?if ($is_niche==1330){ echo " selected ";}?>>Health/Medical</option>
<option value="1375" <?if ($is_niche==1375){ echo " selected ";}?> >Home</option>
<option value="1401" <?if ($is_niche==1401){ echo " selected ";}?>>Kids &amp; Teens</option>
<option value="1415" <?if ($is_niche==1415){ echo " selected ";}?>>News</option>
<option value="2822" <?if ($is_niche==2822){ echo " selected ";}?>>Professional</option>
<option value="3" <?if ($is_niche==3){ echo " selected ";}?>>Real Estate</option>
<option value="1275" <?if ($is_niche==1275){ echo " selected ";}?>>Recreation</option>
<option value="1438" <?if ($is_niche==1438){ echo " selected ";}?>>Reference</option>
<option value="8" <?if ($is_niche==8){ echo " selected ";}?>>Religion</option>
<option value="2799" <?if ($is_niche==2799){ echo " selected ";}?>>Services</option>
<option value="2027" <?if ($is_niche==2027){ echo " selected ";}?>>Shopping</option>
<option value="2068" <?if ($is_niche==2068){ echo " selected ";}?>>Society</option>
<option value="2098" <?if ($is_niche==2098){ echo " selected ";}?>>Sports</option>
<option value="124" <?if ($is_niche==124){ echo " selected ";}?>>Travel</option>
 </select>
</li>
</ul>
</td></tr></table>
<br>
<p>
<h1>Make Your Listing "NOFOLLOW" To Search Engines</h1>
<p>If you desire to, you can make your link listing in the web directory have "nofollow" instructions for search engine bots. The Google search engine bot has already been given the "nofollow/noindex" instructions. Adding the tag directly to your own link will keep all bots from indexing your site from our directories. The idea of the distributed web directory has always been to get traffic from the sites it is installed on and trying to get "link juice" by getting your link on a lot of sites is not the purpose or intent of BungeeBones.</p>
                                                                          
<p><h3>Check box to make your link "no follow"</h3><input type="checkbox" name="no_follow_act" <? if($nofollow=='on'){echo 'checked="yes"';}?> value="on" ></p>
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
<h2>Add your config and click "Submit".</h2>
<p>
<a target="_top" href="widget_index_custom.php?link_selected=<?echo $link_selected;?>"> <h2><u>Return To Install Management Index</u></h2></a>
<a target="_top" href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>
</TD></TR><tr><TD></TD><td></td></tr></table>
<?PHP
}//true == 


//include($_SERVER['DOCUMENT_ROOT']."/members/templatebottomnsb.php");
} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
