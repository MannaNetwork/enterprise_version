<?php
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/agent_config.php");
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");


require('../functions/functions.php');


echo ' 
<h3 style="color:red;">Congratulations on getting your new web directory script!</h3>
<h3 style="color:red;">This web directory page will enable you to earn Bitcoin SV. To get this web directory to operate, get credited AND display properly you need to configure the Affiliate Number settings</h3>';

if (array_key_exists('http_host', $_POST)) {
$url = $_POST['http_host'];
}
if (array_key_exists('script-type', $_POST)) {
 $script_type = $_POST['script-type'] ;
}
		$sql="select * from `links` where `url` like '%$url%'";
echo '<br>Searching agent\'s database for your url ... '.$url.' <br>';
			  $result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit members index 558");
		$num_results_in_temp = mysqli_num_rows($result);
				if( $num_results_in_temp >0) 
			{
				//lets get the data, especially the download_type and then just redirect to the appropraite download page
				while ($row = mysqli_fetch_array($result)){
				$new_user_affiliate_num = $row['id'];
                                 // $progress = $row['progress'];
				}
print_r($_POST); 
echo '<h2 style="color:red;">FOUND IT!</h2>';
echo '
<h2> YOUR Manna Network AFFILIATE NUMBER IS ... ';
echo $new_user_affiliate_num;
echo'</h2>
<h4> To configure your web directory, open the ';
if(isset($script_type)){

echo '"member_config.php"';
}
else
{
echo '"manna-configs/db_cfg/agent_config.php"';
}
echo ' file of your installation and change the line $lnk_num = \'change_me\'; to read $lnk_num = \''.$new_user_affiliate_num.'\';';
}
else
{
echo '<h3 style="color:red;">We have not detected that you have registered this site as an advertiser yet in the Manna Network. Please register your web site to receive free advertising across the whole network. Then you will receive an affiliate number/link id number that you use to configure this plugin.
</h3>';
echo '
<iframe src="https://'.$_SERVER['SERVER_NAME']."/".AGENT_FOLDERNAME.'/members/register.php?referer_lnk_num='.$_GET['lnk_num'].'&remote_server='.$server_url.'" width="100%" height="950"]
		</iframe>';

}

?>
