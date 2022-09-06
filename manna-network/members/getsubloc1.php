<?php
$root = dirname(dirname(dirname(dirname( __FILE__, 2 ))));
 //root = /home/stbitcoi
if (file_exists($root.'/public_html/manna_network/manna-configs/db_cfg/agent_config.php')) {
//echo '<br>getting configs';
require_once($root.'/public_html/manna_network/manna-configs/db_cfg/agent_config.php');
}
//echo '<br>dirname( __FILE__, 2 ) = ', dirname( __FILE__, 2 );
//echo '<br>root = ', $root;
require_once($root."/public_html/manna_network/mannanetwork-dir/functions/functions.php");
///public_html/manna_network/mannanetwork-dir/functions
///home/stbitcoi/manna_network/mannanetwork-dir/functions/functions.php
///public_html/manna_network/manna-network/members/functions/sanitize.php
//echo '<br>GET = ';
////print_r($_GET);
/* need to replace all wp function
require_once '../../../wp-load.php';
 if(is_multisite()){
  $blog_id = get_blog_option($blog_id,'siteurl');
   $blog_details = get_blog_details(1);
  define("MNPREFX","mn_".$blog_details->blog_id);
  }else{
//handle regular WP
define("MNPREFX","mn_");
}

$mn_agent_confgs = get_option('mn_agent_confgs');
$ex = explode(",", $mn_agent_confgs);
$mn_agent_url = $ex[0];
$mn_agent_folder = $ex[1];
$mn_agent_id = $ex[2];
$mn_plgn_confgs = get_option(MNPREFX.'plgn_confgs');
$ex2 = explode(",", $mn_plgn_confgs);
$mn_remote_link_id = $ex2[0];
$mn_local_lnk_num = $ex2[0];
$mn_pgn8tr_menu_items = $ex2[1];
$mn_installer_id = $ex2[2];
$mn_widg_id = $ex2[3];
$plugin_is_registered = $ex2[4];
*/
$regional_num = '';
//echo '<br>in getsubloc1.php - __DIR__ . \'/functions/sanitize.php\' = <br>', __DIR__ . '/functions/sanitize.php';
//link to script - https://www.phptutorial.net/php-tutorial/php-sanitize-input/
require  __DIR__ . '/functions/sanitize.php';


   if ( isset( $_GET['tregional_num'] ) ) {
   $regional_num = $_GET['tregional_num'] ;
//'regional_num' => $_GET['tregional_num'] ,
}
else
{
 $regional_num = 0 ;
}
if ( isset( $_GET['q'] ) && is_numeric( $_GET['q'] ) ) {
$selected_cat_id =  $_GET['q'] ;
//'selected_cat_id' =>  $_GET['q'] , 
}
else
{
$selected_cat_id =  0 ;
}
if ( isset( $_GET['type'] ) ) {
//'type' => $_GET['type'] 
	$type = $_GET['type'] ; 
	}
	else
	{
	$type = "";
	}
	$inputs = [
	'regional_num' => $regional_num ,
	'selected_cat_id' => $selected_cat_id ,
	'type' => $type
    ];

$fields = [
    
   // 'email' => 'email',
    'regional_num' => 'int',
    'selected_cat_id' => 'int',
    'type' => 'string',
    //'weight' => 'float',
    //'github' => 'url',
    //'hobbies' => 'string[]'
];

$data = sanitize($inputs,$fields);

//var_dump($data);

/*if ( isset( $_GET['tregional_num'] ) ) {
	$regional_num = sanitize_text_field( wp_unslash( $_GET['tregional_num'] ) );}
else
{$regional_num = 0;
}
if ( isset( $_GET['q'] ) && is_numeric( $_GET['q'] ) ) {
$selected_cat_id = sanitize_text_field( wp_unslash( $_GET['q'] ) ); 
}
else
{
$selected_cat_id = 0;
}
	$http_host = str_replace( 'https://', '', get_site_url() );
*/
if ( isset( $_GET['type'] ) ) {
	//$type = sanitize_text_field( wp_unslash( $_GET['type'] ) );}
	$file     = 'https://' . AGENT_URL . '/' . AGENT_FOLDERNAME . '/mannanetwork-dir/';
if($type=="regions"){
$file     .= 'get_regions_json.php';
$category_list = getRegions($regional_num);
}
else
{
$category_list = getCategoryChildren($selected_cat_id);
$file     .= 'get_category_json.php';
}

//We may need to first include the functions file
//$category_list = getCategoryChildren($selected_cat_id);
echo $category_list;

/*$response = wp_remote_post(
	$file,
	array(
		'method'      => 'POST',
		'timeout'     => 45,
		'redirection' => 5,
		'httpversion' => '1.0',
		'blocking'    => true,
		'headers'     => array(),
		'body'        => array(
			'http_host'       => $http_host,
			'tregional_num'    => $regional_num,
'selected_cat_id'    => $selected_cat_id,
'type'     => $type,			
		),
		'cookies'     => array(),
	)
);

if ( is_wp_error( $response ) ) {
	$error_message = esc_attr( $response->get_error_message() );
	echo 'Something went wrong: (' . esc_attr( $error_message ) . ' )';
} else {
	require_once 'translations/en.php';
echo $response['body'];
} */
}
?>
