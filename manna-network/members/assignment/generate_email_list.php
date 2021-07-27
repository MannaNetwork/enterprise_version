<?php
/* list of widgets table column names
id, link_id, wp_domain, is_parked, comm_junction, parent, lft, rgt, time_period, version, start_clone_date, last_update, end_clone_date, is_recip, is_niche, wp_permalink_name, folder_name, file_name, bitcoin_wallet, brand, display_freebies, plugin, custom_title1, custom_title2, meta_descrip, keywords, name, click_tally, donate, leaving_page, cust_add_a_link, cust_add_a_link_mo, cust_add_a_link_ret, fontsize, titlecolor, linktextcolor, catcolor, new_button_color, button_font_color, button_font_size, modal_message */
echo 'post = ', $_POST['selection_filter'];

if($_POST['formSubmit'] == "Submit")
{

	$errorMessage = "";
if(empty($_POST['selection_filter']))
	{
		$errorMessage .= "<li>You forgot to enter a selection_filter!</li>";
	} 


$selection_filter = $_POST['selection_filter']; 



	if(empty($errorMessage)) 
	{
			include($_SERVER['DOCUMENT_ROOT']."/classes/assignment_class.php");
//	id, sellers_link_id, sellers_widget_id, buyers_link_id, buyers_widget_id, trans_date, sellers_user_id, buyers_user_id

$assign_mng = new assignment;
$new_assign = $assign_mng->generate_email_list($selection_filter);
echo 'new assign ';
print_r($new_assign);
		exit;
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
	<title>Generate WTM User Info Form</title>
</head>

<body>
<h1>Commission Assignment Form</h1>
<p style="text-align: left;">Use this form to assign both the income derived from the current subscribers of a site, the subscribers of its DOWNLINE and also any FUTURE sales or recruits of itself or its downline.
	<?php
		if(!empty($errorMessage)) 
		{
			echo("<p>There was an error with your form:</p>\n");
			echo("<ul>" . $errorMessage . "</ul>\n");
		} 
	?>
	<form action="generate_email_list.php" method="post">
		
<div align="center">
<select name="selection_filter">
<option value="active">Active WTMs</option>
<option value="deactive">De-Activated WTMs</option>
<option value="Bread">Hot Bread</option>
</select>
</div>
		
		<input type="submit" name="formSubmit" value="Submit" />
	</form>
</body>
</html>

