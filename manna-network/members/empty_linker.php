<?
               include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
		include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
		$sql="select * from `temp_download_b4_wdgt_insert` where`wp_user_email_registrant` = '$user_email'";

		  $result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit members index 292");
		$num_results_in_temp = mysqli_num_rows($result);
				if( $num_results_in_temp >0) 
			{
				//lets get the data, especially the download_type and then just redirect to the appropraite download page
					while ($row = mysqli_fetch_array($result)){
					$download_type = $row['download_type'];
					$new_blog_url= $row['url'];
	 				$new_blog_title=   $row['title'];
					$referer_lnk_num =   $row['referer_lnk_num'];
					}
			if($download_type == "plugin" OR $download_type == "wp_plugin"){
				//header( "refresh:5;url=http://bungeebones.com/plugins/bungeebones_plugin_version.zip" );
				$moniker="<h5>Plugin Download Page</h5>";

				$empty_linker = '<h3 style="	padding-left: 3cm;padding-right: 3cm;">Check your download folder for your WordPress Plugin (enabling you to participate in the BungeeBones Monetizing CoOperative). If you did not receive it, click  <a href="http://bungeebones.com/plugins/bungeebones_plugin_version.zip">here</a>.</h3>';
                                $empty_linker .=  '<h3 style="padding-left: 3cm;padding-right: 3cm;">Install the plugin in your Wordpress site as usual. Create a page and insert the shortag [bungeebones] in it. Open the page and the script will walk you through the configuration.</h3>';
 
				$empty_linker .=  '<div  style="width: 50%;   margin: 0 auto;"><img width=85% src= "http://bungeebones.com/images/trafficaheadminiBTC.jpg"></div>';
				$empty_linker .=  '<h3 style="	padding-left: 3cm;padding-right: 3cm;">The Plugin is designed to be installed in your own WordPress website. It will produce a fully populated (with categories and links) and managed web directory on one of your Wordpress pages (that you create). You need to make sure that you configure it with your LINK ID in order for you to earn Bitcoin from any sales the site makes.</h3>';
                                $empty_linker .=  '<h3 style="	padding-left: 3cm;padding-right: 3cm;">If you have the potential of getting a lot of people interested in blogging (schools, churches, charities, sports leagues, political candidates, sales teams etc.) <a href="/feedback.php">let us know</a> and we\'ll send you info about getting your own WordPress Multi-User setup!</h3>';
				}
				elseif($download_type == "script" OR $download_type == "php_script"){
				//header( "refresh:5;url=http://bungeebones.com/phpblock/bungeebones_php_version.zip" );
				$moniker="<h5>PHP SCRIPT DOWNLOAD PAGE</h5>";
				$empty_linker =  '<h1>Redirect To Download PHP Script</h1>';
				$empty_linker .=  '<h3 style="	padding-left: 3cm;padding-right: 3cm;">The link to download your PHP script (enabling you to participate in the BungeeBones Monetizing CoOperative) should should download now. If not, click <a href="http://bungeebones.com/phpblock/bungeebones_php_version.zip">here</a>.</h3>'; 
				$empty_linker .=  '<div  style="width: 50%;   margin: 0 auto;"><img width=85% src= "http://bungeebones.com/images/trafficaheadminiBTC.jpg"></div>';
				$empty_linker .=  '<h3 style="	padding-left: 3cm;padding-right: 3cm;">The PHP script is designed to be included between the <body> tags in one of your own web page templates (i.e. a page with your header, sidebars, footer and menus). It will produce a fully populated (with categories and links) and managed web directory. You need to make sure that you configure it with your LINK ID in order for you to earn Bitcoin from any sales the site makes.</h3>';
				}
				elseif($download_type == "wpmu_wanter")
				{ //Is this is deprecated? It may only be used at plugin sites when their users want WPMU blogs
echo '<h1>You need to register at one of the following blog sites<ol><li>Make sure to register to get a blog there (and not just to advertise)</li><li>Make sure to use the same email address as you used to register here</li></ol></h1>';
				$moniker="<h5>Ready To Get A Free Personal Blog?!!!!</h5>";
				$body_width="wide";
				
				$empty_linker =  '<div  class="grid_6 omega"  style="background-color:yellow; width:46%; height:550px; border: 2px solid; border-radius: 25px;padding:10px 10px 10px;">
				<h1>YOU HAVE JOINED UP TO GET YOUR FREE BLOG SITE<br>and your BungeeBones account has been successfully setup</h1>
				<h4>You can now select from the list below and finalize the registration at that particular site too. BE SURE TO USE THE SAME EMAIL ADDRESS!</h4>
				<p style ="text-align: left;">Each blog site operates in conjunction with BungeeBones. Bloggers use this Bungeebones User Control Panel to review their commissions, their recruits, sales, etc.. You also may get a blog at more than one site also. Register and login at any/each of the Wordpress blogs you want. Then add/list them here at BungeeBones to receive your affiliate number for the income program (click the "Web Directory" link on your blog for more instructions).  </p> ';
include('current_wpmu_list.php');				
$empty_linker .=  '</div>';
				}
                                 elseif($download_type != "script_local" AND $download_type != "plugin_local")
				{
				$moniker="<h5 style='color:red;'>ERROR</h5>";
				$body_width="wide";
				include($_SERVER['DOCUMENT_ROOT']."/960top.php"); 
				echo '<h3 style="color:red;">Error - L100 Contact site administrator</h3>';
				//the only way to end up here is if the user id is in the temp table and there is not a "plugin" or "script" value in  download type
				//see this query from above as the source
				//$sql="select `download_type` from `temp_download_b4_wdgt_insert` where `BB_user_ID` = $user_id";
				include($_SERVER['DOCUMENT_ROOT']."/960bottom.php"); 				
				exit();
				}
			elseif($download_type == "add_url")
				{
				$moniker="<h5>Advertise You WebSite - Get More Traffic!</h5>";
				 
				$empty_linker =  '<h1 style="font-size:350%;">Welcome
To The BungeeBones Advertising Network ...</h1>
<h3 style="text-align:center;">and your first visit! </h3>
<p style="text-align:center">Click the banner below to continue.</p>';
				}

echo $empty_linker ;
echo '</div> </a></div>';


}
?>	