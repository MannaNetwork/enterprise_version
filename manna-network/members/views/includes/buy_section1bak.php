<?php 
//add sanitizing - check if numeric
echo '<br> in includes/buy section1 php';
print_r($_GET);
$link_id = $_GET['link_id'];
$agent_ID = $_GET['agent_ID'];
$url = $_GET['url'];
$category_id = $_GET['category_id'];
$installer_id = $_GET['installer_id'];
$location_id = $_GET['location_id'];
echo '<br>location id = ', $location_id;
echo '<br>';
print_r($location_id);
echo '<br>';
$display_block .= '<div id="index_content" class="index_content" name="index_content"><div class="grid-container">';
$LINKinfo = new member_info();

//Storing some useful code here - This could be used to calculate the entire price slots list
//currently doesn't work - decimals of Satoshi messing it up

function factorial( $n ) {

  // Base case
  if ( $n == 0 ) {
    echo "Base case: $n = 0. Returning 1...<br>";
    return 1;
  }

  // Recursion
$increase = 1.5;
$satoshi = .00000001;
  echo "$n = $n: Computing $satoshi*$increase * factorial( " . ($n-1) . " )...<br>";
  $result = ( $satoshi*$increase * factorial( $n-1 ) );
  echo "Result of $satoshi*$increase * factorial( " . ($n-1) . " ) = $result. Returning $result...<br>";
  return $result;
}



//just some useful code am storing here
//echo "The factorial of 6 is: " . factorial( 6 );
//include("css/members_menu.css");
print_r($_GET);
if(0 == count($_GET)){ 
//don't display if no GET vars
$display_block .= '  <div class="item1"><h2 style="color:red;">Your Site Info Is Empty!</h2><h3>This happens when you visit the page directly rather than from your Users Link Management Panel. </h3>
<p>Please <a  style = "color:blue; font-decoration:underline;" href="index.php">CLICK HERE AND CLICK THE DESIRED BUTTON TO LOAD THE PAGE WITH PROPER CONFIGURATIONS</a></p></div>';

} 
else
{
$thisLinksRegionalInfo = $LINKinfo->getThisLinksRegionalInfo($link_id, $agent_ID, $location_id);

echo '<br> $thisLinksRegionalInfo = ';
print_r($thisLinksRegionalInfo);
$users_balances_string = $LINKinfo->getUserBalanceFromCentral ($user_id, $agent_ID);
//returns  array( $bitcoin_cash_balance|$democoin_balance );
$users_balances = explode("|",$users_balances_string);

$display_block .= '  <div class="item1"><h2>Your Site Info </h2><h3>(IF the info isn\'t displaying click "Home" button and then to return to this page)</h3> <h4>Your Landing Page -> '. $url.'</h4>
<h4>Link ID -> '. $link_id.'</h4>
  <h4>Category ID -> '. $category_id.'</h4>
 <h4>Site You Registered At -> '. $installer_id.'</h4>
 <h4>Your Agent\'s ID -> '. $agent_ID.'</h4>
<h4>Your Agent\'s URL -> <a target="_blank" href="https://'. AGENT_URL.'">'.AGENT_URL.'</a></h4>
<h4>Your Dashboard -> <a target="_blank" href="https://'. AGENT_URL.'">'.AGENT_URL.'</a></h4>';
if(is_array($thisLinksRegionalInfo)){
$display_block .= ' <h4>Region INFO -> </h4>';
foreach($thisLinksRegionalInfo as $key=>$value){
if($key !==0 AND $key !==7){
//getRegionalName($regionalnum);
if($key==1 AND $value > 0){
$getName= $LINKinfo->getRegionalName($value);
$display_block .= '-> '.$getName;
}
if($key==2 AND $value > 0){
$getName= $LINKinfo->getRegionalName($value);
$display_block .= '-> '.$getName;
}
if($key==3 AND $value > 0){
$getName= $LINKinfo->getRegionalName($value);
$display_block .= '-> '.$getName;
}
if($key==4 AND $value > 0){
$getName= $LINKinfo->getRegionalName($value);
$display_block .= '-> '.$getName;
}
if($key==5 AND $value > 0){
$getName= $LINKinfo->getRegionalName($value);
$display_block .= '-> '.$getName;
}
if($key==6 AND $value > 0){
$getName= $LINKinfo->getRegionalName($value);
$display_block .= '-> '.$getName;
}
}
}

}

$display_block .= '
</div>  
  <div class="item4">
<h5>Buy Better Position With BitcoinSV</h5>
<!--round for the display, send entire result so we can search db for match -->

<form name="test" action="'. htmlentities($_SERVER['PHP_SELF']).'" method="post">
<input type="hidden" name="url" value="'.$_GET['url'].'"> 
<input type="hidden" name="link_id" value="'.$_GET['link_id'].'"> 
<input type="hidden" name="cat_id" value="'.$_GET['category_id'].'"> 
<input type="hidden" name="installer_id" value="'.$_GET['installer_id'].'"> 
<input type="hidden" name="agent_ID" value="'.AGENT_ID.'"> 
<input type="hidden" name="coin_type" value="BSV"> ';
if(ltrim($users_balances[0], '0') > 0){
 $display_block .= '<h5>Your BSV Balance * -> '. ltrim($users_balances[0], '0').'</h5>
<input type="submit" class="submit" name="B1" value="Buy BSV Price Slot" style="
    border:0;
    background-color:transparent;
    color: blue;
    text-decoration:underline;
font-size: 16px;
font-weight: bold;
background-color: #4CAF50;
border-radius: 15px;

"/>';
}
else
{
$display_block .= '<h5>Your BSV Balance * -> 0</h5><input type="submit" class="submit" name="B1" value="Load Your Account With BSV " style="
    border:0;
    background-color:transparent;
    color: blue;
    text-decoration:underline;
font-size: 16px;
font-weight: bold;
background-color: #4CAF50;
border-radius: 15px;

"/>';

}

 $display_block .= '</form>

</div>

<div class="item5">
<h5>Buy Better Position With Demo Coin (DMC)</h5>

<form name="test" action="'. htmlentities($_SERVER['PHP_SELF']).'" method="post">
<input type="hidden" name="url" value="'.$_GET['url'].'"> 
<input type="hidden" name="link_id" value="'.$_GET['link_id'].'"> 
<input type="hidden" name="cat_id" value="'.$_GET['category_id'].'"> 
<input type="hidden" name="installer_id" value="'.$_GET['installer_id'].'">
<input type="hidden" name="location_id" value="'.$_GET['location_id'].'">
<input type="hidden" name="coin_type" value="DMC"> 
<input type="hidden" name="agent_ID" value="'.AGENT_ID.'"> 
<input type="hidden" name="users_balances_string" value="'.$users_balances_string.'">
<h5>Your Demo Coin Balance ** -> '. ltrim($users_balances[1], '0').'</h5>
In buy_section1.php line 161 and we need a curl query to mn and then an "if" regional numberdisplay levels to offer list<br>
<br>location_id = '. $location_id.'<br>place regional menu here';
include('link_specific_regional_menu.php');
$file="http://exchange.manna-network.com/incoming/checkThisLinksRegionalInfo.php";
		$args = array(
		'agent_id' => AGENT_ID,
		'remote_link_id' => $link_id
		
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $file);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, array('locus_array' => $locus_array,'link_record_num' => $link_record_num,'link_page_total' => $link_page_total, 'link_page_id' => $link_page_id, 'pagem_url_cat' => $pagem_url_cat,'link_page_num' => $link_page_num, 'cat_page_num' => $cat_page_num, 'url_cat' => $url_cat, 'affiliate_num' => $affiliate_num  ));
		curl_setopt($ch, CURLOPT_POSTFIELDS,$args);

		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
    		    $curl_errno = curl_errno($ch);
		    $curl_error = curl_error($ch);
		    if ($curl_errno > 0) {
			    echo "cURL Error line 575 ($curl_errno): $curl_error\n";
		    } else {    
//echo '<h1> the info shou;ld be from tempuser</h1>';
		curl_close($ch);
		

		echo($data);

}

$thisLinksRegionalInfo = $LINKinfo->getThisLinksRegionalInfo($link_id, $agent_ID);

echo '<br>$thisLinksRegionalInfo line 156 buy_section1.php = ';
echo '<br> $thisLinksRegionalInfo = ', $thisLinksRegionalInfo;




$display_block .= '<input type="submit" class="submit" name="B1" value="Buy DMC Price Slot" style="
    border:0;
    background-color:transparent;
    color: blue;
    text-decoration:underline;
font-size: 16px;
font-weight: bold;
background-color: #4CAF50;
border-radius: 15px;

"/></form>
</div>';



$display_block .= ' <div class="item8"><span>* Pre-load your BSV account to buy with BitcoinSV </span><br><span>** Contact admin or your upline if you need more Demo Coin</span></div>
</div></div>';
}
?>
