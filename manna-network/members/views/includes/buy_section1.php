<?php
//add sanitizing - check if numeric
if($debug=="2"){
echo '<br> in includes/buy section1 php line 4 - ';
print_r($_GET);
}
$link_id = $_GET['link_id'];
$agent_ID = $_GET['agent_ID'];
$url = $_GET['url'];
$category_id = $_GET['category_id'];
$installer_id = $_GET['installer_id'];
//echo '<br>echo $_GET[\'location_id\'] = ', $_GET['location_id'];
$location_id = $_GET['location_id'];
if(array_key_exists('coin_type',$_GET)){
$coin_type = $_GET['coin_type'];
}
$minimum_priceslot = $_GET['minimum_priceslot'];
if($debug=="2"){
echo '<br>location id = ', $location_id;
echo '<br>';
//print_r($location_id);
echo '<br>';
}
$display_block = '<div id="index_content" class="index_content" name="index_content"><div class="grid-container">';
$display_block .="<style>
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
</style>";
$LINKinfo = new member_page_info();

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

if(0 == count($_GET)){
//don't display if no GET vars
$display_block .= '  <div class="item1"><h2 style="color:red;">Your Site Info Is Empty!</h2><h3>This happens when you visit the page directly rather than from your Users Link Management Panel. </h3>
<p>Please <a  style = "color:blue; font-decoration:underline;" href="index.php">CLICK HERE AND CLICK THE DESIRED BUTTON TO LOAD THE PAGE WITH PROPER CONFIGURATIONS</a></p></div>';
}
else
{
$thisLinksRegionalInfo = $LINKinfo->getThisLinksRegionalInfo($link_id, $agent_ID, $location_id);
if($debug=="2"){
echo '<br> in buy section1.php $thisLinksRegionalInfo = ';
print_r($thisLinksRegionalInfo);
}
$users_balances_string = $LINKinfo->getUserBalanceFromCentral ($user_id, $agent_ID);
//returns  array( $bitcoinsv_balance|$democoin_balance );
$users_balances = explode("|",$users_balances_string);

/* Moving settings display to index.php with link in each listing

$display_block .= '  <div class="item1"><h2>Your Site Info </h2><h3>(IF the info isn\'t displaying click "Home" button and then to return to this page)</h3> <h4>Your Landing Page -> '. $url.'</h4>
<h4>Link ID -> '. $link_id.'</h4>
  <h4>Category ID -> '. $category_id.'</h4>
 <h4>Site You Registered At -> '. $installer_id.'</h4>
 <h4>Your Agent\'s ID -> '. $agent_ID.'</h4>
<h4>Your Agent\'s URL -> <a target="_blank" href="https://'. AGENT_URL.'">'.AGENT_URL.'</a></h4>
'; */
if(is_array($thisLinksRegionalInfo)){
print_r('$thisLinksRegionalInfo = '.$thisLinksRegionalInfo);
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
else
{

$display_block = '
  <div class="item4">';
 // if(balnce less than $minimum_priceslot create a title. Then turn the two possible coin types into a title and display one of the three
 if(isset($coin_type) && $coin_type=="BSV"){ 
$display_block .= '<h5>Modify Your Position (Bought With BitcoinSV)</h5>';
}
elseif(empty($coin_type)){
if(ltrim($users_balances[0], '0') > $minimum_priceslot){
$display_block .= '<h5>Buy Better Position With BitcoinSV</h5>';
}
else
{
//means they had a bid but their balance has fallen below minimum price slot
$display_block .= '<h5>Your BitcoinSV Balance Is Below The Minimum Price Slot</h5>';
}
}
else
{
$display_block .= '<h5>Switch From Demo Coin To BSV</h5>';
}
$display_block .= '
<!--round for the display, send entire result so we can search db for match -->

<form name="test" action="'. htmlentities($_SERVER['PHP_SELF']).'" method="post">
<input type="hidden" name="url" value="'.$_GET['url'].'">
<input type="hidden" name="link_id" value="'.$_GET['link_id'].'">
<input type="hidden" name="cat_id" value="'.$_GET['category_id'].'">
<input type="hidden" name="installer_id" value="'.$_GET['installer_id'].'">
<input type="hidden" name="agent_ID" value="'.AGENT_ID.'">
<input type="hidden" name="coin_type" value="BSV">
<input type="hidden" name="location_id" value="'.$_GET['location_id'].'">
<input type="hidden" name="users_balances_string" value="'.$users_balances_string.'">
';
if(ltrim($users_balances[0], '0') > $minimum_priceslot){
 $display_block .= '
<span><input type="submit" class="submit" name="B1" value="Buy BSV Price Slot" style="
    border:0;
    background-color:transparent;
    color: blue;
    text-decoration:underline;
font-size: 16px;
font-weight: bold;
background-color: #4CAF50;
border-radius: 15px;

"/> Your BSV Balance * -> '. ltrim($users_balances[0], '0').'</span>';
}
else
{
/* temp deactivate while testing alternate button below that uses dropt $display_block .= '<span><input type="submit" class="submit" name="B1" value="Load Your Account With BSV " style="
    border:0;
    background-color:transparent;
    color: blue;
    text-decoration:underline;
font-size: 16px;
font-weight: bold;
background-color: #4CAF50;
border-radius: 15px;

"/> Your BSV Balance * -> '. ltrim($users_balances[0], '0').'</span>';
*/
//////////////
$display_block .= '<span class="dropt" style="font-size: large;" title="'.BLOKT_GETTING_BSV_MOUSEOVER.'"><input type="submit" class="submit" name="B1" value="Load Your Account With BSV " style="
    border:0;
    background-color:transparent;
    color: blue;
    text-decoration:underline;
font-size: 16px;
font-weight: bold;
background-color: #4CAF50;
border-radius: 15px;

"/> Your BSV Balance * -> '. ltrim($users_balances[0], '0').'
  <span style="width:500px;">'.BLOKT_GETTING_BSV.'</span></span>';

//////////////

}

 $display_block .= '</form>

</div>

<div class="item5">';
  
 if(isset($coin_type) && $coin_type=="DMC"){ 
 if(ltrim($users_balances[1], '0') > $minimum_priceslot){
$display_block .= '<h5>Modify Your Position (Bought With Your Demo Coin)</h5>';
}
else
{
//means they had a bid but their balance has fallen below minimum price slot
$display_block .= '<h5>Your Demo Coin Balance Has Fallen Below The Minimum Price Slot</h5>';
}
}
elseif(empty($coin_type)){
if(ltrim($users_balances[1], '0') > $minimum_priceslot){
$display_block .= '<h5>Buy Better Position With Your Demo Coin</h5>';
}
else
{
//means they never had a bid or cancelled their bid and their balance has also fallen below minimum price slot (perhaps it went higher after they canceled)
$display_block .= '<h5>Your Demo Coin Balance Is Below The Minimum Price Slot</h5>';
}
}
else
{
$display_block .= '<h5>Switch From BSV To Demo Coin</h5>';
}
$display_block .= '<form name="test" action="'. htmlentities($_SERVER['PHP_SELF']).'" method="post">
<input type="hidden" name="url" value="'.$_GET['url'].'">
<input type="hidden" name="link_id" value="'.$_GET['link_id'].'">
<input type="hidden" name="cat_id" value="'.$_GET['category_id'].'">
<input type="hidden" name="installer_id" value="'.$_GET['installer_id'].'">
<input type="hidden" name="location_id" value="'.$_GET['location_id'].'">
<input type="hidden" name="coin_type" value="DMC">
<input type="hidden" name="agent_ID" value="'.AGENT_ID.'">
<input type="hidden" name="users_balances_string" value="'.$users_balances_string.'">
';
if(ltrim($users_balances[1], '0') > $minimum_priceslot){
$display_block .= '<span><input type="submit" class="submit" name="B1" value="Buy DMC Price Slot" style="
    border:0;
    background-color:transparent;
    color: blue;
    text-decoration:underline;
font-size: 16px;
font-weight: bold;
background-color: #4CAF50;
border-radius: 15px;

"/></form> Your Demo Coin Balance ** -> '. ltrim($users_balances[1], '0').'</span>';}
else
{
/*
$display_block .= '<span><input type="submit" class="submit" name="B1" value="Load Your Account With DMC" style="
    border:0;
    background-color:transparent;
    color: blue;
    text-decoration:underline;
font-size: 16px;
font-weight: bold;
background-color: #4CAF50;
border-radius: 15px;

"/></form> Your Demo Coin Balance ** -> '. ltrim($users_balances[1], '0').'</span>';
*/
//////
$display_block .= '<span class="dropt" style="font-size: large;" title="'.BLOKT_GETTING_DMC_MOUSEOVER.'"><input type="submit" class="submit" name="B1" value="Load Your Account With DMC " style="
    border:0;
    background-color:transparent;
    color: blue;
    text-decoration:underline;
font-size: 16px;
font-weight: bold;
background-color: #4CAF50;
border-radius: 15px;

"/> Your DMC Balance * -> '. ltrim($users_balances[1], '0').'
  <span style="width:500px;">'.BLOKT_GETTING_DMC.'</span></span>';
//////
}



$display_block .= ' <div class="item8"><span>* Pre-load your BSV account to buy with BitcoinSV </span><br><span>** Contact admin or your upline if you need more Demo Coin</span></div>
</div></div>';
} //close new else (alt from if no region
}
?>
