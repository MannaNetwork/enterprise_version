<?
$cat_id = $_GET['cat_id'] ;//for testing only

include($_SERVER['DOCUMENT_ROOT']."/classes/auction_class_rma.php");
  $today = date("Y-m-d");
include($_SERVER['DOCUMENT_ROOT']."/includes/connect.php");
//include($_SERVER['DOCUMENT_ROOT']."/'config.php");
$AUCinfo = new rma_auction_info;
?>

<script type="text/javascript">
  function setTitle(){
	var myindex = document.forms.dropdownlist.selectone.value;

	document.getElementById("ddlist").innerHTML = myindex;
  }
 function setTitle2(){
	var myindex = document.forms.dropdownlist.selectone.value;
	document.getElementById("ddlist2").innerHTML = myindex;
  }

  </script>



<? 										

$total_clicks = $AUCinfo->get_click_tallies($cat_id, 3); 
$pieces_clicks = explode(',',$total_clicks);
//$minimum_bid_factor =  $AUCinfo->getMinimumBidFactor($cat_id);
$click_array =  $AUCinfo->get_click_tallies_for_dropdown($cat_id);
$pieces =  explode(',',$click_array);
$widget_array = $AUCinfo->get_new_widgets_by_date();
$pieces2 =  explode(',',$widget_array);
//print_r($pieces2);
//$widget_id = $AUCinfo->howManyWidgets();
//foreach ($widget_id as $key => $value) {
   
//$eachHas = $AUCinfo->howManyQueries($value);
//echo '<br>Each has ', $eachHas;
 //echo " .....  Key: $key; Value: $value<br />\n";
//}
?>	
<TABLE cellspacing="4" border="1" cellpadding="4" align="center">
  <tr><td>
	<h1>Stats At A Glance</h1>

<p style="text-align: left">There has been a combined total of 
 
<b id="ddlist"><?echo $pieces_clicks[0];?></b> queries 

for the <? echo $AUCinfo->switchNameforNum($cat_id); ?> category. 
<p style="text-align: left">Select a different time period for most recents stats.

  <form name="dropdownlist" id="dropdownlist">
   <select name="selectone" onchange="setTitle(),setTitle2()">
	<option value="<?echo $pieces[0]?>">in the last 24 hours</option>
	<option value="<?echo $pieces[1]?>">in the last 7 days</option>
	<option value="<?echo $pieces[2]?>">in the last 30 days</option>
<option value="<?echo $pieces[3]?>"  selected="selected">since June 26, 2014</option>
	
   </select>
  </form>

 from the <a target="_blank" href="../subscription_sites"> <?echo $pieces2[3]?> distributed web directories currently installed .</a>.!</p> 
<!--<a>For information about determining the economic value of those queries as compared to such things as Pay Per Click for instance <a _target="_blank" href="keyword_price_tables.pdf"> visit our tables page showing some market prices.</a></p>-->
</td></tr>
</TABLE>
