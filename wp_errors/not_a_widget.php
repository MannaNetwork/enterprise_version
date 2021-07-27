<?php

if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 2 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 2 ). "/manna-configs/db_cfg/agent_config.php");
include(dirname( __FILE__, 2 ). "/manna-configs/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 2 ). "/manna-configs/db_cfg/mysqli_connect.php");
$url = $_POST['http_host'];
		$sql="select * from `customer_links` where `url` like '%$url%'";
		echo $sql;
			  $result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit members index 558");
		              $num_results_in_custs = mysqli_num_rows($result);

	if( $num_results_in_custs >0) 
	  {
	//lets get the data, especially the download_type and then just redirect to the appropraite download page
		while ($row = mysqli_fetch_array($result)){
		$new_user_affiliate_num = $row['id'];
		 // $progress = $row['progress'];
		}
	echo '<h3 style="color:red;">This web directory page will enable you to earn Bitcoin but to get it to display properly you need to login to <a target="_blank"  href="http://'.$url.'/wp-admin"><u>your WP DASHBOARD </u></a>and configure the Affiliate Number settings for this web directory to operate properly AND for you to get credited properly! The configurations to insert were reported to you when you registered at your agent\'s website!.</h3>
	<h2> YOUR Manna Network AFFILIATE NUMBER IS ... ';
	echo $new_user_affiliate_num;
	echo'</h2>
	<h2>The agent_url is '.AGENT_URL.'</h2>
	<h2>sgent_ID is '.AGENT_ID.'</h2>
	<h2>AGENT_FOLDERNAME = '.AGENT_FOLDERNAME.'</h2>
	<h4> To configure it, click the "Manna Network" button in the left menu of your Dashboard and add it to the form as the screenshot indicates.</h4>
	<img width="90%"src="hscreenshot.png">
	<h3>For more information, login with your blog user credentials at the server site <a target=_blank" href="http://mnna-network.csh/members/index.php">manna-Network.cash</a> </h3>';
	

	else
	{
	echo '<h3 style="color:red;">We have not detected that your website is registered at the website you configured as the agent url in the Dashboard (under the Manna Network button). </h3><h3>You configured your agent url to be '.AGENT_URL;



	echo '</h3><h3 style="color:red;">If you haven\'t registered yet then please either <a target="_blank" href="'.AGENT_REGISTRATION_PAGE.'">visit that agent\'s registration page</a> or select one of the other agents in the list at <a target=_blank" href="http://manna-network.cash/agents_list.php">agent\'s list</a></h3>';
	echo '<h3 style="color:red;">If you did, indeed, register at the above website then <a target="_blank" href="'.AGENT_TECH_SUPPORT_CONTACT_PAGE.'">please contact the tech support of your agent</a> with as many details of your registration process as possible so that we can track down the issue.</h3>';

	}


?>
