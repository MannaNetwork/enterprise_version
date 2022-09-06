<?php
echo '<style>
span.dropt {border-bottom: thin dotted; background: #ffeedd;}
span.dropt:hover {text-decoration: none; background: #ffffff; z-index: 6; }
span.dropt span {position: absolute; left: -9999px;
  margin: 20px 0 0 0px; padding: 3px 3px 3px 3px;
  border-style:solid; border-color:black; border-width:1px; z-index: 6;}
span.dropt:hover span {left: 2%; background: #ffffff;} 
span.dropt span {position: absolute; left: -9999px;
  margin: 4px 0 0 0px; padding: 3px 3px 3px 3px; 
  border-style:solid; border-color:black; border-width:1px;}
span.dropt:hover span {margin: 20px 0 0 170px; background: #ffffff; z-index:6;} 
</style>';
$display_blockmp.= '<h3 align="center" style="padding:5px 10px;">'.REG_FORM_WELCOME_TITLE.'</h3>';
echo'
<div style="padding:20px 30px;">'.ADDALINK_FORM_WELCOME_BODY.'   
<div text-align="left"><form style="padding:20px 30px;" class = "reg_form" method="POST" action="" name="registerform" >';
 
if (array_key_exists ( "script_type" , $_GET ) AND isset($_GET['script_type'])) {
$display_blockmp .= '
<input type = "hidden" id="script_type" name="script_type" value="'. $_GET['script_type'].'">
<h3>In order for the'. $_GET['script_type'].' to function properly it is necessary for you to register at the ad server.</h3>
<h4>You will need to:<br>
<ul> 
<li>Register with a valid email address</li>
<li>Verify the email address</li>
<li>Login at the ad server</>
<li>Add website info (a title, description and URL)</li>
</ul>
</h3>
<h3>Doing that will also advertise your website across the entire ad network (for free!).</h3>
<h3>Please fill in the form below to get started.</h3>'; 
}

if(array_key_exists("flag", $_GET) OR isset($_GET['flag'])){
$display_blockmp .= '<input type="hidden" name="flag" value="'.$_GET['flag'].'">';
}



$display_blockmp .= '  <label for="website_title">'. WORDING_REGISTRATION_TITLE.'</label><span class="dropt" style="font-size: large;" title="'.REG_BLOKT_TITLE_MOUSEOVER.'"><img height="21" width="21" src="images/info_icon.png">
  <span style="width:500px;">'.REG_BLOKT_TITLE_MESSAGE.'</span></span>
   <br>   <input id="website_title" type="text"  name="website_title" style="width: 20em;" required />
    <br>   <label for="website_description">'. WORDING_REGISTRATION_DESCRIPTION.'</label><span class="dropt" style="font-size: large;" title="'.REG_BLOKT_DESCRIPTION_MOUSEOVER.'"><img height="21" width="21" src="images/info_icon.png">
  <span style="width:500px;">'.REG_BLOKT_DESCRIPTION_MESSAGE.'</span></span>
     <br>   <textarea  id="website_description" type="text-area"  name="website_description" required  rows="5" cols="40"></textarea>
    <br>   <label for="protocol_title">'. WORDING_PROTOCOL_TITLE.'</label><span class="dropt" style="font-size: large;" title="'.PROT_BLOKT_TITLE_MOUSEOVER.'"><img height="21" width="21" src="images/info_icon.png"><br>
  <span style="width:500px;">'.PROT_BLOKT_TITLE_MESSAGE.'</span></span><br>
            <input type="radio" name="protocol" id="protocol" value="https://" checked="checked" />
            <label for="protocol">https://</label>
        </br>
        <br>
            <input type="radio" name="protocol" id="protocol" value="http://" />
            <label for="protocol">http://</label>
        </br>
      <br>   <label for="website_url">'. WORDING_REGISTRATION_URL.'</label><span class="dropt" style="font-size: large;" title="'.REG_BLOKT_URL_MOUSEOVER.'"><img height="21" width="21" src="images/info_icon.png">  <span style="width:500px;">'.REG_BLOKT_URL_MESSAGE.'</span></span>
      <br>    <input size="50" onfocus="this.value=\'\'" id="website_url" type="text"  name="website_url" value="'.REG_BLOKT_URL_INPUT_MESSAGE.'" required />
      </br>
  <br>   <label for="page_name">'. WORDING_REGISTRATION_PAGE_NAME.'</label><span class="dropt" style="font-size: large;" title="'.REG_BLOKT_PAGE_MOUSEOVER.'"><img height="21" width="21" src="images/info_icon.png">  <span style="width:500px;">'.REG_BLOKT_PAGE_MESSAGE.'</span></span>
      <br>    <input size="50" onfocus="this.value=\'\'" id="page_name" type="text"  name="page_name" value="'.REG_BLOKT_PAGE_INPUT_MESSAGE.'"  /> </br>
<hr>';
/*echo '<br>line 62 in _form.php is q, gocat or selected cat id set? GET = ';
print_r($_GET); */

if( array_key_exists('gocat', $_GET) AND ISSET($_GET['gocat'])){
//NOTE category id comes in from main menu
$selected_cat_id = 1;
}

elseif( array_key_exists('q', $_GET) AND ISSET($_GET['q'])){
//NOTE category id comes in from main menu
$selected_cat_id = $_GET['q'];
}
elseif( array_key_exists('selected_cat_id', $_GET) AND ISSET($_GET['selected_cat_id'])){
//NOTE THIS CATEGORY ID COMES IN FROM THE PAGINATOR MENU
$selected_cat_id = $_GET['selected_cat_id'];
}
elseif(array_key_exists('selected_cat_id', $_POST) && ISSET($_POST['selected_cat_id'])){

//NOTE q comes in from dropdown 
$selected_cat_id = $_POST['selected_cat_id'];
}
else
{
$selected_cat_id = 1;

}

if( array_key_exists('selected_region_id', $_GET) AND ISSET($_GET['selected_region_id'])){
$selected_region_id = $_GET['selected_region_id'];
}
else
{
$selected_region_id = 0;

}

//echo '<br>line 124 ($selected_cat_id = ', $selected_cat_id;
$category_list = json_decode(getCategoryChildren($selected_cat_id),true);
/*echo '<br>cat list = ';
print_r( $category_list); */
$display_blockmp .= '

<script>
var original_cat_id = "'. $selected_cat_id  . '"
</script>';
		
$display_blockmp .= '<span id="mn_subcat_container"> 
 <table id="mn_subcat_table">
<tr><td><h2>'.REGISTRATION_CATEGORY_HEADING.'</h2>
<select name="submenu" onchange="showSubMenu(this.value,\'1\',\'' .  $selected_region_id  . '\',\'categories\')"><option value="">' .  WORDING_AJAX_MENU1  . '</option> ';
		
		foreach ( $category_list as $key => $value ) {
			if ( $category_list[ $key ]['lft'] + 1 < $category_list[ $key ]['rgt'] ) {
				$display_blockmp .= "<option value='y:" .  $category_list[ $key ]['id']  . ':' .  $category_list[ $key ]['name']  . "'>" . $category_list[ $key ]['name'] . '</option>';
			} else {
				$display_blockmp .= "<option value='n:" .  $category_list[ $key ]['id']  . ':' .  $category_list[ $key ]['name']  . "'>" . $category_list[ $key ]['name']  . '</option>';
			}
		}
		$display_blockmp .= '</select>&nbsp;&nbsp;&nbsp;&nbsp;<span class="dropt" style="font-size: large;" title="'.REG_BLOKT_CATEGORY_MOUSEOVER.'"><img height="21" width="21" src="images/info_icon.png">  <span style="width:500px;">'.REG_BLOKT_CATEGORY_MESSAGE.'</span></span>
		      <div class="catHint1" id="catHint1" name="catHint1"><b>' .  WORDING_AJAX_1  . '</b></div>
		      <input type="hidden" id="selected_cat_name" name="selected_cat_name" class ="selected_cat_name" value="">
<input type="hidden" id="selected_cat_id" name="selected_cat_id" class ="selected_cat_id" value="">
<div width: 250px;style="font-size: larger; font-weight:stronger;">Your Current Selection *: 
<input style="font-size: larger; font-weight:stronger;width: 250px;" type="text" id="selected_cat_menu_name"  class="selected_cat_menu_name" name="selected_cat_menu_name" value=""></td></tr></table><br>   <label for="catkeys">'. WORDING_CATKEY_DESCRIPTION.'</label><span class="dropt" style="font-size: large;" title="'.REG_BLOKT_CATKEY_MOUSEOVER.'"><img height="21" width="21" src="images/info_icon.png">
  <span style="width:500px;">'.REG_BLOKT_CATKEY_MESSAGE.'</span></span>
     <br>   <textarea  id="catkeys" type="text-area"  name="catkeys" rows="5" cols="40"></textarea>';
	//}

$display_blockmp .= '<span id="mn_location_container"> 
<table id="mn_location_table">
<tr><td><h2>'.REGISTRATION_REGIONAL_HEADING_SEL.'</h2><select name="regional" id="regional" onchange="
showSubMenu(this.value,\'1\',\'' . $selected_cat_id  . '\',\'regions\')"><option value="">'.WORDING_AJAX_REGIONAL_REG1.'</option>';
			$display_blockmp .= "
		<option value='y:2566:Africa'>Africa</option>
		<option value='y:2567:America - Central'>America - Central</option>
		<option value='y:2568:America - North'>America - North</option>
		<option value='y:2569:America - South'>America - South</option>
		<option value='y:2572:Asia'>Asia</option>
		<option value='y:2573:Australia/Oceania'>Australia\/Oceania</option>
		<option value='y:2756:Caribbean'>Caribbean</option>
		<option value='y:2575:Europe'>Europe</option>
		<option value='y:2740:Middle East'>Middle East</option>";
	
		$display_blockmp .= '</select>&nbsp;&nbsp;&nbsp;&nbsp;<span class="dropt" style="font-size: large;" title="'.REG_BLOKT_REGIONAL_MOUSEOVER.'"><img height="21" width="21" src="images/info_icon.png"><span style="width:500px;">'.REG_BLOKT_REGIONAL_MESSAGE.'</span></span><br>
		      <div id="locHint1" name="locHint1"><b>Smaller Regions Available After Selection.</b></div>
					  <div id="locHint2" name="locHint2"><b></b></div>
					   <div id="locHint3" name="locHint3"><b></b></div>
					    <div id="locHint4" name="locHint4"><b></b></div>
		<div id="locHint5" name="locHint5"><b></b></div>
		<div id="locHint6" name="locHint6"><b></b></div>
		<p id="selectedregion" name="selectedregion"><b></b></p>
<input type="hidden" id="selected_region_id" name="selected_region_id" class ="selected_region_id" value="">
<input type="hidden" id="selected_region_name" name="selected_region_name" class ="selected_region_name" value="">	
<div width: 250px;style="font-size: larger; font-weight:stronger;">Your Current Selection *: 
<input style="font-size: larger; font-weight:stronger;width: 250px;" type="text" id="selected_region_menu_name"  class="selected_region_menu_name" name="selected_region_menu_name" value="">
<br>   <label for="lockey">'. WORDING_LOCKEY_DESCRIPTION.'</label><span class="dropt" style="font-size: large;" title="'.REG_BLOKT_LOCKEY_MOUSEOVER.'"><img height="21" width="21" src="images/info_icon.png">
  <span style="width:500px;">'.REG_BLOKT_LOCKEY_MESSAGE.'</span></span>
     <br>   <textarea  id="lockeys" type="text-area"  name="lockeys" rows="5" cols="40"></textarea>

		</td><td></table></span><div id="city_street_address" name="city_street_address" class="city_street_address"><b></b></div>
		';
//$display_blockmp .= '<span class="dropt" style="font-size: large;" title="'.$mouseover.'">'.$link_title.'<img height="21" width="21" src="images/info_icon.png">  <span style="width:500px;">'.$blockt_message.'</span></span>';
		//}
	if( array_key_exists('regional_num', $_GET) AND ISSET($_GET['regional_num'])){
	//NOTE category id comes in from main menu
	$regional_num = $_GET['regional_num'];
	unset($_GET['regional_num']);
	unset($_POST['regional_num']);
	}
//END Location AJAX
if(!array_key_exists("flag", $_GET) OR !isset($_GET['flag']) OR $_GET['flag'] !== "1"  ){
$display_blockmp .= ' <h1>'.WORDING_REGISTRATION_RECIPROCAL_HEADER.
WORDING_REGISTRATION_RECIPROCAL.' </div>';
}

////$plugin_name = basename( plugin_dir_path(  dirname( __FILE__ , 2 ) ) );
//$display_blockmp .= wp_nonce_field(); //this will ADD a nonce field to the form which will then need to be detected on exch of the showsubcat and showsubloc pages
/*The installer_id var (below) is a complicated and a bit confusing name. The id number comes from the widgets table (in manna) and represents the parent id (sic widget id number) of the parent of THIS website (i.e. orlandoreferralgroup in this case) which is 1stbitcoinbank.com (where org is registered). In the plugin, that number is stored in the WP plugin's options but here we need to retriev it. This form retrieves that setting and forwards it as a hidden var (via POST) to itself, which then gets used by the add_a_link.php (where this form is included).

Since this form is used by all advertisers (whether they are a widg or not), we need to retrieve the installer id from the exchange.manna-network.com (this "add_a_link" site could be in either the remote_mn_id_bridge or tempusers table). We need a CURL page to 
*/
/* Now retrieving installer id returned from array of links this user has (they all have the same installer id)
echo '<br>retrieving installer id from dirname(__DIR__, 3)."/manna-network/members/check_if_registered" ...'.dirname(__DIR__, 3)."/manna-network/members/check_if_registered.php";

include(dirname(__DIR__, 3)."/manna-network/members/check_if_registered.php");
echo '<br>print r decoded = ';
print_r($decoded);
$installer_id= $decoded[0]['installer_id']; */
/*echo '<br>installer_id line 180 = ', $_GET['installer_id'];
echo '<br>AGENT_ID constant = ', AGENT_ID; */
$display_blockmp .= '<input type="hidden" name="installer_id" value="'.$_GET['installer_id'].'">
<input type="hidden" name="agent_ID" value="'.AGENT_ID.'">
        <input type="submit" name="register" value="'.WORDING_REGISTER.'" />
 </div>  </form>';  
   
   echo  $display_blockmp;
