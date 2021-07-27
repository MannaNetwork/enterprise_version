<?php

if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 2 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 2 ). "/manna-configs/db_cfg/agent_config.php");
include(dirname( __FILE__, 2 ). "/manna-configs/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 2 ). "/manna-configs/db_cfg/mysqli_connect.php");
// SECURITY: This query needs PDO and sanitizing!
// SECURITY: This query needs PDO and sanitizing!

// SECURITY: This query needs PDO and sanitizing!

// SECURITY: This query needs PDO and sanitizing!

$url = $_POST['http_host'];
		$sql="select * from `customer_links` where `website_url` like '%$url%'";
		echo '<br>sql = ', $sql;
			  $result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit members index 558");
		              $num_results_in_custs = mysqli_num_rows($result);

	if( $num_results_in_custs >0) 
	  {
	//lets get the data, especially the download_type and then just redirect to the appropraite download page
		while ($row = mysqli_fetch_array($result)){
		$new_user_affiliate_num = $row['id'];
$installer_id = $row['installer_id'];
		}
//But just because it is registered at the enterprise doesn't mean it has registered at manna network and become or gotten its widget id entry in the widgets table!
//we need to curl to enterprise.manna-network.com to check the widgets table for this url and, if not found, provide a link to the widget registration form and page. 

	echo '<div style="width:100%;"><h1 style="text-align: center;">Configuration/Installation Instructions</h1><p style="color:red; width: 100%;">This web directory page will enable you to earn BitcoinSV but to get it to display properly you need to login to <a target="_blank"  href="http://'.$url.'/wp-admin"><u>your WP DASHBOARD </u></a>and configure the settings for it to operate properly AND for you to get credited properly! The configurations to insert are reported below. You can verify their accuracy by logging in to <a target="_blank" href="https://'.AGENT_URL."/".AGENT_FOLDERNAME.'/manna-network/members">your member control panel</a> and click the "Settings" link associated with the one you are installing the plugin in.</p>
	<h2> YOUR Link ID IS ... ';
	echo $new_user_affiliate_num;
	echo'</h2>
	
	<h2>Agent ID is '.AGENT_ID.'</h2>
<h2>The Agent url is '.AGENT_URL.'</h2>
	<h2>AGENT folder name = '.AGENT_FOLDERNAME.'</h2>
<h2>Installer ID is '.$installer_id.'</h2>
	<h4> To configure it, click the "Manna Network" button in the left menu of your Dashboard and add it to the form as the screenshot indicates.</h4>
	<img width="90%"src="https://'.AGENT_URL."/".AGENT_FOLDERNAME.'/wp_errors/screenshot.png"></div>';
	}

	else
	{
	echo '<h3 style="color:red;">We have not detected that your website is registered. Check that the website you configured as the agent url in the wp-content/plugins/mannanetwork/agent_config.php  page is, indeed, where you actually registered at. </h3><h3>You configured your agent url to be '.AGENT_URL;

echo '<h3>Please do not hesitate to contact us if you have any problems, questions, concerns or suggestions!</h3>';

	echo '</h3><h3 style="color:red;">If you haven\'t registered yet then please either <a target="_blank" href="https://'.AGENT_URL."/".AGENT_FOLDERNAME.'?register=true&lnk_num=1&agent_id=17">visit that agent\'s registration page</a> or select one of the other agents in the list at <a target=_blank" href="https://manna-network.com/register/">agent\'s list</a></h3>';
	echo '<h3 style="color:red;">If you did, indeed, register at the above website then <a target="_blank" href="https://'.AGENT_URL."/".'contact.php">please contact the tech support of your agent</a> with as many details of your registration process as possible so that we can track down the issue.</h3>';

	}


?>
