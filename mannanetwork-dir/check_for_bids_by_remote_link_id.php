  <?php
/*
catid="+catid+"&pageid="+pageid+"&mn_agent_url="+mn_agent_url+"&mn_agent_folder="+ mn_agent_folder

*/
echo '<br>in page '.dirname( __DIR__, 2 );
echo '<br>in page '.dirname( __DIR__, 2 ). "/manna-configs/db_cfg/agent_config.php";
print_r($_POST);
if (!defined('READER_AGENTS')) {
require_once(dirname( __FILE__, 2 )."/manna-configs/db_cfg/agent_config.php");
}
 
$args3 = array(
'link_id' => $_POST['link_id'], 
'agent_ID' => $_POST['agent_ID']
);

echo 'args3                                  = ';
print_r($args3);
//reminder - don't need the $mn_agent_url or $mn_agent_folder variables to be sent -they are only used in the url

//$url3 = "https://".AGENT_URL."/".AGENT_FOLDERNAME."/mannanetwork-dir/get_links_json_ajax_reg.php";
$url3 = "https://exchange.manna-network.com/incoming/check_for_bids_for_cancel_link.php";
echo '<br>url3 = ', $url3;
     $ch = curl_init();    // initialize curl handle
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_URL, $url3); 
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);          
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 50); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $args3); 
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
//  curl_setopt($ch, CURLOPT_PORT, $port);          

  // $links_list_2 = curl_exec($ch);
    $curl_errno = curl_errno($ch);
    $curl_error = curl_error($ch);
    if ($curl_errno > 0) {
            echo "cURL Error ($curl_errno): $curl_error\n";
    } else {
//returns $send_array = array($url, $name, $description, $website_street, $website_district)
/*$url_array = $linksList2[0];
$name_array = $linksList2[1];
$description_array = $linksList2[2];
$website_street_array = $linksList2[3];
$website_district_array = $linksList2[4];
*/

//echo $links_list_2;
}
?>
