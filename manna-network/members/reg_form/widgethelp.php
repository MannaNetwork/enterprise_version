<?
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/reg_form/template_explo_top_mini.php");
echo '
<h1>All of the instructions for the WordPress version of the BungeeBones remotely hosted web directory below are also available from the BungeeBones User Control Panel. That area is accessible after you have registered and entered your link for advertising in the Bungeebones Network - all free and required for the plugin to work.</h1>
<hr>
<table bgcolor="gray"><TR><TD>
<h2>Installation Process Overview</h2>
<p style="text-align:left; font-size: 150%">The BungeeBones Web Directory is installed on your website using a Wordpress plugin and the WordPress Plugin Installation process. The categories and links displayed in the web directory are sent to your website, live, in-realtime for each request that your site visitor makes from the BungeeBones server. The links that have been registered and inspected by BungeeBones.com enable your new web directory to be effortless from your perspective. </p>
<p style="text-align:left; font-size: 150%">There are a few things we need to do to establish the communication channel between BungeeBones and your website. 
<ul><LI>You have to have a link registered in BungeeBones 


</LI><li>You have to install the BungeeBones plugin to your WordPress from the Wordpress repository through your WP admin</li><li>You need to create A WordPress page to house the published web directory and put \'[bungeebones_directory]\' (without the quotes) somewhere on the page.</li><li>Make some changes to the config.php page included in the files of the Wordpress plugin so it uniquely identifies itself to BungeeBones</li><li>Configure at the BungeeBones end to tell us where your web directory is installed</li><li>Then there are extras - configure these to customise your web directory</li></ul>
<p style="text-align:left; font-size: 150%">We have organized the instructions so that they have screenshots to help you locate and insert the information it needs to function. If you have a problem, there is the contact form where you can let us know. We are glad to help with the installs.
<hr>
<table bgcolor="gray"><tr><td><h2  style="color: #E1D7D7;">How To Install A WordPress Plugin</h2>
<p style="text-align: left; font-size: 125%;">Just use regular WordPress installation procedures as I have outlined below. There are many tutorials and videos online that outline the WordPress plugin installation process also.</p>
From your WP admin panel 

 <p style="text-align: left; font-size: 125%;"><a  style="color: white;" href="plugins_link.php?link_selected='. $link_selected.'" title="Plugin Link" rel="gb_pageset[search_sites]">1) Go to -> Plugins -> Add New</a><BR>

 <p style="text-align: left; font-size: 125%;"><a  style="color: white;" href="plugins_get.php?link_selected='. $link_selected.'" title="Get Plugin" rel="gb_pageset[search_sites]">2) Enter the plugin\'s name "BungeeBones" in the search input (but without the quotes)</a><BR>
 
<p style="text-align: left; font-size: 125%;"><a  style="color: white;" href="plugins_install_wp_admin.php?link_selected='. $link_selected.'" title="Install With WP Admin" rel="gb_pageset[search_sites]">3) Click -> "Install" link </a><BR>

 <p style="text-align: left; font-size: 125%;"><a  style="color: white;" href="plugins_activate.php?link_selected='. $link_selected.'"  title="Activate" rel="gb_pageset[search_sites]">4) Click -> "Activate"</a><BR>
 
<p style="text-align: left; font-size: 125%;"><a  style="color: white;" href="plugins_make_page.php?link_selected='. $link_selected.'"  title="Make The WordPress Page" rel="gb_pageset[search_sites]">5) Make The Wordpress Page</a><BR>
<hr>
<table bgcolor="gray"><tr><td><h2  style="color: #E1D7D7;">Config The WordPress Side</h1>
<p style="text-align: left; font-size: 125%;">There is one configuration setting for sure and possibly a second one depending on what level your WordPress is installed. You will do all the editing and configuration from your WP admin panel 


 <p style="text-align: left; font-size: 125%; "><h1 style="color: red;">Your link ID number is <u>'. $link_selected.'</u>. You will need that to configure the WordPress plugin.</h1>
<pstyle="text-align: left; font-size: 150%; ">Click the toplink to begin this installation section. </p>
 <p style="text-align: left; font-size: 125%;"><a  style="color: white;" href="plugins_config_wp.php?link_selected='. $link_selected.'"  title="Config On WP" rel="gb_pageset[search_sites]">1) Click To Open The WordPress File Editor
 <p style="text-align: left; font-size: 125%;"><a  style="color: white;" href="plugins_config_wp2.php?link_selected='. $link_selected.'"  title="Config On WP" rel="gb_pageset[search_sites]">2) Locate the Config File

 <p style="text-align: left; font-size: 125%;"><a  style="color: white;" href="plugins_config_wp3.php?link_selected='. $link_selected.'"  title="Config On WP" rel="gb_pageset[search_sites]">3) Make One Or Two Changes
</td></tr></table>
<hr>
<table bgcolor="gray"><tr><td><h2  style="color: #E1D7D7;">Config The BungeeBones Side</h1>
<p style="text-align: left; font-size: 125%;">There are only a few of required configuration settings.'; 
echo'
 
 <p style="text-align: left; font-size: 125%;"><a  style="color: white;" href="widget_install_wp.php?link_selected='. $link_selected.'"  title="What Level Is WordPress Installed?" rel="gb_pageset[search_sites]">1) BungeeBones needs to know what level your WordPress script is on at your site. 
 
<p style="text-align: left; font-size: 125%;"><a  style="color: white;" href="widget_install_wp2.php?link_selected='. $link_selected.'"  title="What is its page post id?" rel="gb_pageset[search_sites]">2) BungeeBones needs to know the post id of the page on your site where it is installed</a>. 
</td></tr></table>
<hr>
<table bgcolor="gray"><tr><td><h2  style="color: #E1D7D7;">Customize Your Web Directory</h2>
<p style="text-align: left; font-size: 125%;">There are a number of optional settings and uploads you can make... 

 
 <p style="text-align: left; font-size: 125%;"><a  style="color: white;" href="custom_buttons.php?link_selected='. $link_selected.'"  title="Use Your Own &quot;Add A Link&quot; Buttons" rel="gb_pageset[search_sites]">1) Use Your Own &quot;Add A Link&quot; Buttons 
 <p style="text-align: left; font-size: 125%;"><a  style="color: white;" href="custom_exit.php?link_selected='. $link_selected.'"  title="Custom Exit Page" rel="gb_pageset[search_sites]">2) Create A Custom Exit Page</a> 
<p style="text-align: left; font-size: 125%;"><a  style="color: white;" href="custom_charity_des.php?link_selected='. $link_selected.'"  title="Designate A Charity To Receive Your Commissions" rel="gb_pageset[search_sites]">3) Designate A Charity To Receive Your Commissions</a>. 
<p style="text-align: left; font-size: 125%;"><a  style="color: white;" href="custom_niche.php?link_selected='. $link_selected.'"  title="Be A Niche Directory" rel="gb_pageset[search_sites]">4) Be A Niche Directory</a>.

<p style="text-align: left; font-size: 125%;"><a  style="color: white;" href="custom_no_free.php?link_selected='. $link_selected.'"  title="Limit Your Display To Paying Links" rel="gb_pageset[search_sites]">5) Limit Your Display To Paying Links</a>.

<p style="text-align: left; font-size: 125%;"><a  style="color: white;" href="custom_headers.php?link_selected='. $link_selected.'"  title="Display Your Own Custom Headers" rel="gb_pageset[search_sites]">6) Display Your Own Custom Headers</a>.

</td></tr></table>

<hr>
 <p align="left"><b>Though none of the configurations below are "critical" to the operation of your web directory, setting these make the web directory unique and dynamic by inserting unique content into the pages\' titles, keywords, and description. These settings are part of the BungeeBones Dynamic Header System which places category information into each results page\'s keyword and description. What that means is that every results page is unique for both the category it is displaying as well as for your website.</p> 
<p align="left">
Please make sure that your installation is working properly before you adjust these settings.';
Echo "
<form name='test' method='POST' action='' accept-charset='UTF-8'>
<table cellspacing='0' cellpadding='10' border='0' bordercolor='#000000'>
   <tr>
      <td>
         <table cellspacing='2' cellpadding='2' border='0'>";
echo'

<ul><LI>

 <p align="left"><b>Create Custom Titles Unique To Your Website And To Every Results Page</b></LI>
	<p align="left">Part of the code you installed is in the head section of the page and it produces dynamic titles for you. It does that by sandwiching the category name between two words or phrases that you choose and enter below. They can be anything you like. Some examples are the word "Best" for the first half and "Links" for the second. The final product then would be titles such as "Best Real Estate Links" or "Best Computer Links". You might say "Recommended" or "Human Reviewed" for other examples.
	<p align="left">Custom Title: First half</p>	
<input type="hidden" name = "link_selected" value="'.$link_selected.'" >
     <p align="left"><input id="custom_title1" size="40" type="text" name="custom_title1" value="'. $custom_title1.'">
            <p align="left">  <p align="left"><b><p align="left">Custom Title: Second half</p> </b>
        <p align="left"><input id="custom_title2" size="40" type="text" name="custom_title2"   value="'. $custom_title2.'">
         <br> <span style="font-size:70%;">eg. Links, Info, Websites etc</span>
      
		    
   
     <li> <p align="left"><b>Do You Want To Display &quot;Free&quot; Sites?</b></p></li>
<p align="left">Part of the tradition of the web is that so much of it is free. When was the last time you paid to use a Search Engine? or email? Along with that tradition BungeeBones makes the commitment FOR IT\'S OWN DOMAIN AND WEBSITE that it will always have free advertising available. But something we can\'t presume on is to promise YOUR website as a place for free advertising. So we offer you a configuration enabling you to select whether or not to display free links and, if so then even for how long you will do so.
<p align="left">BungeeBones strongly recommends, however, that our "partners" with the directory installed also provide free links - especially during this critical startup time. But we also anticipate that later, as more directories are added and the traffic increases, then it will even be an advantage for some to refrain from offering them. Missing out on some traffic is just an added incentive for them to become a paying link.
      <p align="left">Yes <input type="radio" value="display_freebies" ';
if ($display_freebies=="display_freebies"||$display_freebies==""){ 
echo "checked";
}
echo ' name="display_freebies">&nbsp; 
      No <input type="radio" name="display_freebies" value="no_display_free" ';

if ($display_freebies=="no_display_freebies")
{ echo "checked";
}
echo '></p>';

      if ($display_freebies=="display_freebies"||$display_freebies==""){ 
?>

<p align="left"><b>6) If yes, for how long do you wish to display them on your 
      site for?</b>
      <p align="left"><select size="1" name="time_period">
      <option value="0"<?if ($time_period==0){ echo " selected ";}?> >DO Not Display</option>
      <option value="1"<?if ($time_period==1){ echo " selected ";}?>>1_month</option>
      <option value="2"<?if ($time_period==2){ echo " selected ";}?>>2_month</option>
      <option value="3"<?if ($time_period==3){ echo " selected ";}?>>3_month</option>
      <option value="4"<?if ($time_period==4){ echo " selected ";}?>>4_month</option>
      <option value="5"<?if ($time_period==5){ echo " selected ";}?>>5_month</option>
      <option value="6"<?if ($time_period==6){ echo " selected ";}?>>6_month</option>
      <option value="7"<?if ($time_period==7){ echo " selected ";}?>>1_year</option>
      <option value=8<?if ($time_period==8){ echo " selected ";}?>>Indefinitely</option>
      </select>

<? 
}

echo '	
<br /><br />
<br>
<li><p align="left"><b>Donate Your Web Traffic To Your Favorite Charity!</b></p></li>

<p align="left">If you wish to donate what basically amounts to "found money" (i.e. the proceeds of your directory) to a charity of your choice then enter your instructions for donating to them here. Provide all the info we will need in order to complete the payment. 
<p><textarea name="donate" cols="60" rows="3"><? echo $donate;?></textarea><br>
<p>&nbsp;</p>
<li><p align="left"><b>Customize Your "Add A Link" Message</b></p></li>
<p align="left">Whenever a user (i.e one with a website) visits one of our distributed web directory sites and sees the "Add A Link" button they  are, generally, interested in the program. To prepare them for the pending redirect to the BungeeBones website for registration we provide a transition page telling the users what is happening. We provide a message to them that you can read by clicking <a target="_blank" href="http://bungeebones.com/articles/leaving_website2.php/3112//">HERE</a>.

<p><b>BUT</b> if you desire to you can provide your own message instead. In addition to preparing users for the redirection to our website we hope our installers use this custom page to endorse and recommend the BungeeBones system as well.</p>
<p align="left">To use your own transition page create it and save it in the same folder/web directory where the installation on your site is located. Then enter the url here and we will direct them to that page instead of the default. <B>Your Custom Page must have the link to the BungeeBones registration page on it of course</B> but we are open to innovation and different approaches to expressing what BungeeBones is and what it hopes to become (a webmaster social network? a new web advertising paradigm? The best fundraising tool ever?)</p>
<p align="left">Create and then post your transition page\'s url here. We will inspect it and notify you of the results. </p>
<p><input type="text" name="leaving_page" size="50" value="<? echo $leaving_page;?>"></p>
<p>&nbsp;</p>
<li><p align="left"><b>Upload Your Own "Add A Link" Image</b></p></li>
<p align="left">We have done a lot to enable you to brand the web directory to your own website and one more item that can help you do that is to install your own custom "Add A Link" image to the directory. We place the image at the top and bottom of a web results page. Use the link below to upload the image you want to use.
</p>
<p><a target="_blank" href="../multiple_uploader/multiple.upload.form.php"><h1>Use This Link To Upload Custom Image</h1></a></p>

<li><p align="left"><b>Operate BungeeBones As A "Niche" Directory</b></p></li>
<p align="left">The distributed web directory can be operated as a "niche" directory by only showing the sub-categories and links of one, selected main category. For example, you can operate it as a "Real Estate" Directory or a "Computer" Directory.</p>

<p>
Selecting One Of These Will Cause Your Directory To Only Display That Category</p>
';

?>

<select size="1" name="is_niche">
<option value="0" <?if ($is_niche==0){ echo " selected ";}?>>Niche Option</option>
<option value="60" <?if ($is_niche==60){ echo " selected ";}?>>Accessories</option>
<option value="65" <?if ($is_niche==65){ echo " selected ";}?>>Art/Photo/Music</option>
<option value="69" <?if ($is_niche==69){ echo " selected ";}?>>Automotive</option>
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
</td></tr></table>-->
<?

echo '</ul>






            <tr>
               <td colspan="2" align="center">
                 
               </td>
            </tr>
         </table>
      </td>
   </tr>
</table>
</form>
</TD></TR><tr><TD></TD><td></td></tr></table>';



include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");



