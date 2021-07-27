<?

$street=$_GET['street'];

	$zip=$_GET['zip'];
	$phone=$_GET['phone'];
	//$brand=$_GET['brand'];
$plugin=$_GET['plugin'];
	$cat_id=$_GET['cat_id'];
	$url=$_GET['url'];
	$title=$_GET['title'];
	$link_description=$_GET['link_description'];
	$multiple=$_GET['multiple'];
$start_date = time();//entered in insert query - tells when link was added
	
if(isset($_GET['folder_name'])){
	$is_niche=$_GET['is_niche'];
$folder_name= $_GET['folder_name'];
$file_name= $_GET['file_name'];
$custom_title1= $_GET['custom_title1'];
$custom_title2= $_GET['custom_title2'];
$display_freebies= $_GET['display_freebies'];
$time_period= $_GET['time_period'];
}



$return_to = "http://bungeebones.com/bungee_jumpers/reg_form/index.php?cat_id=".$cat_id."&url=".$url."&title=".$title."&link_description=".$link_description."&start_date=".time();

if(isset($street)){
$return_to .= "&amp;street=".$_GET['street'];}

if(isset($zip)){
$return_to .= "&amp;zip=".$_GET['zip'];}
if(isset($phone)){
$return_to .= "&amp;phone=".$_GET['phone'];}
	
if(isset($plugin)){
$return_to .= "&amp;plugin=".$_GET['plugin'];}
	
	if(isset($multiple)){
$return_to .= "&amp;multiple=".$_GET['multiple'];}
	
if(isset($_GET['folder_name'])){
$return_to .= "&amp;is_niche=".$_GET['is_niche'];
$return_to .= "&amp;folder_name= ".$_GET['folder_name'];
$return_to .= "&amp;file_name=". $_GET['file_name'];
$return_to .= "&amp;custom_title1= ".$_GET['custom_title1'];
$return_to .= "&amp;custom_title2= ".$_GET['custom_title2'];
$return_to .= "&amp;display_freebies= ".$_GET['display_freebies'];
$return_to .= "&amp;time_period= ".$_GET['time_period'];
}








echo $return_to;
?>

<html><head><TITLE></TITLE></head><body>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="DD2SZTMF7SC7L">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

<h1>Be sure to return to the link submittal form and finish the submission of your link after you make your payment!</h1>

</body></html>

