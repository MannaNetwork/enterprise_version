<?

if (isset($_GET['action']) && $_GET['action'] == "log_out") {
	//$test_page_protect->log_out(); // the method to log off
session_start();
session_destroy();
}
// include the configs
require_once($_SERVER['DOCUMENT_ROOT']."/members/config/config.php");

    
// load the login class

// load php-login components
require_once($_SERVER['DOCUMENT_ROOT']."/members/php-login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

 
    
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...


$user_id = $_SESSION['user_id'];

include($_SERVER['DOCUMENT_ROOT']."/mobile/config.php"); //old yald, don't use db connects but use settings
include($_SERVER['DOCUMENT_ROOT']."/mobile/classes/mobile_class.php");  
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
echo '<html><head><link href="http://bungeebones.com/cssbuttons/skins/sample/sample.css" rel="stylesheet" type="text/css" />
</head><body>';
    $link_data = new mobile;


$var = explode("/", $_SERVER['PATH_INFO']);
$affiliate_num = 2311 ;
$url_cat = $var[1] ;//repnaming header_ID

if(!isset($url_cat)||$url_cat == "")
{

$url_cat = '1'; 
$cat_id = '1';
}
else
{
$cat_id=$url_cat;
}
$regional_number = $var[2] ;//part 3 of link series
$cat_page_id = $var[3] ;//part 2 of cat series
$cat_page_total = $var[4] ;//part 2 of cat series
$cat_record_num = $var[5] ;//part 3 of cat series
$link_page_id = $var[6] ;//part 2 of link series
$link_page_total = $var[7] ;//part 3 of link series
$link_record_num = $var[8] ;//part 3 of link series


/*if((!isset($cat_id)||$cat_id == "")||$url_cat<1){
echo 'in line 32 if';
$cat_id=$url_cat;
}
else
{
$cat_id=1;
}*/
echo'<a href="Http://BungeeBones.com/mobile">HOME</a>';
if($url_cat !==''  && $url_cat !== '1'){
$path_data = new mobile;
		$category = $url_cat;
		$nav = '<div align="center">';
		$nav .= '<a href="/modal/index.php//'.$regional_number.'"><font size="4">Top Level</font></a>';
		$nav .= $path_data->categoryPath($category, $regional_number);
		//$search_nav =  searchPath($category);
		$categoryname = $path_data->getCatName($url_cat);
		$page_title = $categoryname;
		$nav .= $settings['nav_separator'].$categoryname;		
		$nav .= "</div>";
		//$searchQuery .= $path_data->searchengineQuery($category);
		//$categoryname = categoryName($url_cat);
		$page_title = $categoryname;
		$searchQuery .= $settings['se_separator'].$categoryname;
		$search_nav .= "+" . $categoryname;		
		} 
		else 
		{
		$category = '1';
  		 }
	///////////////////////////////
		///////    AJAX AJAX AJAX  /////////
		////////////////////////////////
echo'<table><tr><td>';
		include('regional_dropdown.php');
		
echo'





</td><td width="20%">&nbsp;</td><td>';
		
		
		include('category_dropdown.php');
echo'</td></tr></table>';

?>
<script type="text/javascript">

function changeText2(){
var arrlength = arguments.length/3;
var arrlengthsc = arrlength+arrlength;
var c = "c";	
var sc = "sc";
for( var i = 0; i < arrlength; i++ ) {
		

document.getElementById(c+arguments[i]).innerHTML = arguments[arrlength+i];
if(arguments[arrlengthsc+i]){
document.getElementById(sc+arguments[i]).innerHTML = arguments[arrlengthsc+i];
}
}
}

</script>

<? 
$catData = new mobile;

//$cat_info = $catData->listCategories($cat_id, $regional_number);

//echo 'pop = ';
//$cat_subpop = $catData->sortRegionalifIsArray($regional_number);
//echo 'region number is ', $regional_number;
//echo '<br>cat sub pop is ', $cat_subpop;


	
//echo $cat_info;
//echo $nav;

if($cat_id > 1){	
//$link_info = $link_data->getLinks($cat_id, $regional_number);

$orig_link_id = $link_info[0];
$orig_link_BB_user_ID = $link_info[1];
$orig_link_category = $link_info[2];
$orig_link_url = $link_info[3];
$orig_link_name = $link_info[4];
$orig_link_description = $link_info[5];
$orig_link_continents = $link_info[6];
$orig_link_countries = $link_info[7];
$orig_link_states = $link_info[8];
$orig_link_cities = $link_info[9];
$orig_link_street = $link_info[10];
$orig_link_zip = $link_info[11];
$orig_link_phone = $link_info[12];
$orig_link_invoice_sent = $link_info[13];
$orig_link_invoice_paid = $link_info[14];
$orig_link_freebie = $link_info[15];
$orig_link_display_freebies = $link_info[16];
$orig_link_start_date = $link_info[17];
$orig_link_time_period = $link_info[18];
$orig_link_peer_rating = $link_info[19];
$orig_link_peer_vote_count = $link_info[20];
$orig_link_public_rating = $link_info[21];
$orig_link_public_vote_count = $link_info[22];
$orig_link_start_clone_date = $link_info[23];
$orig_link_folder_name = $link_info[24];
$orig_link_file_name = $link_info[25];
$orig_link_approved_build = $link_info[26];
$orig_link_custom_title1 = $link_info[27];
$orig_link_custom_title2 = $link_info[28];
$orig_link_click_tally = $link_info[29];
$orig_link_districts = $link_info[30];

//$num_links = count($orig_link_id);



echo  '<table width = "1200">';

for($counterp=0; $counterp<$num_links; $counterp++){
$addressinfo = "";
if($orig_link_cities[$counterp]){
$addressinfo .= "  " . $link_data->getRegionName($orig_link_cities[$counterp]);
}
if($orig_link_districts[$counterp]){
$addressinfo .= "  " . $link_data->getRegionName($orig_link_districts[$counterp]);
}
if($orig_link_states[$counterp]){
$addressinfo .= "  " . $link_data->getRegionName($orig_link_states[$counterp]);
}
if($orig_link_countries[$counterp]){
$addressinfo .= "  " .$link_data->getRegionName($orig_link_countries[$counterp]);
}
if($orig_link_continents[$counterp]){
$addressinfo .= "  " .$link_data->getRegionName($orig_link_continents[$counterp]);
}

$street_info = "";
if($orig_link_street[$counterp]){
$addressinfo .= "  " . $orig_link_street[$counterp];
}
if($orig_link_cities[$counterp]){
$addressinfo .= "  " . $orig_link_cities[$counterp];
}
if($orig_link_zip[$counterp]){
$addressinfo .= "  " . $orig_link_zip[$counterp];
}
if($orig_link_phone[$counterp]){
$addressinfo .= "  " . $orig_link_phone[$counterp];
}



			//echo'	<div><span style="color : red;"> <a target=_"blank" href='.$orig_link_url[$counterp].'>' .$orig_link_name[$counterp].'</a></span><span style="color : green;"> &nbsp;&nbsp;   '.$orig_link_description[$counterp]  .'</span><span style="color : red;"><br />Peer Rating  ' .$orig_link_peer_rating[$counterp].'</span><span style="color : red;">&nbsp;&nbsp;   Peer Vote Count  ' .$orig_link_peer_vote_count[$counterp].'</span></div><div><span style="font-size: .75em; color : black;  "> ' . $addressinfo . '</span></div> ';
					}		

	echo  '</table>';
}//close if cat > 1
/////////////////////////////////////////////////
//////////////////////////////////////////////////
//###############################################
//############################################
///############   End of dropdown ###############################

include($_SERVER['DOCUMENT_ROOT']."/classes/link_class.php");//load order 1
include($_SERVER['DOCUMENT_ROOT']."/classes/categories_class.php");//load order 2
include($_SERVER['DOCUMENT_ROOT']."/classes/free_categories.php");//load order 3
include($_SERVER['DOCUMENT_ROOT']."/classes/price_slot_class.php");//load order 5


$LINKinfo = new link_info;
   $free_link_display = $LINKinfo->getFreeLinks($user_id);
     $CATinfo = new category_info;
      $FREECATinfo = new free_cat_info;
       $paid_link_display = $LINKinfo->displayBlockPaid($user_id);
         $price_slot_info = new price_slot_info;
	  $num_rows_paid = $paid_link_display[0]; $db_idp= $paid_link_display[1]; 
	    $db_categoryp =$paid_link_display[2]; $db_freebiep = $paid_link_display[3]; $db_urlp = $paid_link_display[4];  $db_descriptionp = $paid_link_display[5];   $db_start_clone_datep = $paid_link_display[6];  $db_approvedp = $paid_link_display[7]; $db_namep = $paid_link_display[8]; $db_contract_lengthp= $paid_link_display[9];
	     $num_rows_free = $free_link_display[0];
	      $db_idf = $free_link_display[1];
	       $db_categoryf = $free_link_display[2];

		$db_urlf = $free_link_display[3];
		 $db_descriptionf = $free_link_display[4];
		  $db_namef = $free_link_display[5];
		   $db_contract_lengthf = $free_link_display[6];
		    $db_approvedf = $free_link_display[7];


/////////////////////////////////////
///////////////////////////////////////////
/////////////////////////////////////////////
//////////////  atempt to make radio display /////////
////////////////////////////////////////////
/////////////////////////////////////
/////////////////////////


$LINKinfo = new link_info;
   $free_link_display = $LINKinfo->getFreeLinks($user_id);
     $CATinfo = new category_info;
      $FREECATinfo = new free_cat_info;
       $paid_link_display = $LINKinfo->displayBlockPaid($user_id);
         $price_slot_info = new price_slot_info;
	  $num_rows_paid = $paid_link_display[0]; $db_idp= $paid_link_display[1]; 
	    $db_categoryp =$paid_link_display[2]; $db_freebiep = $paid_link_display[3]; $db_urlp = $paid_link_display[4];  $db_descriptionp = $paid_link_display[5];   $db_start_clone_datep = $paid_link_display[6];  $db_approvedp = $paid_link_display[7]; $db_namep = $paid_link_display[8]; $db_contract_lengthp= $paid_link_display[9];
	     $num_rows_free = $free_link_display[0];
	      $db_idf = $free_link_display[1];
	       $db_categoryf = $free_link_display[2];

		$db_urlf = $free_link_display[3];
		 $db_descriptionf = $free_link_display[4];
		  $db_namef = $free_link_display[5];
		   $db_contract_lengthf = $free_link_display[6];
		    $db_approvedf = $free_link_display[7];

foreach ($db_idp as $key => $value)
		{
echo '<br>line 239 key = ', $key;
                    $count_links=0;
		   if($key>0)
		   {
			$contract_info = explode("-",$db_contract_lengthp[$key])	;			
		         $catPop_arrp = $CATinfo->getCatPop($db_categoryp[$key]);
		          $num_queries =  $price_slot_info->get_click_tallies_for_link_list_from_gen($db_categoryp[$key]);
				$catPoppa = $catPop_arrp[0];
				  $catPopp = explode(",",$catPoppa);
					$price_slot_info_array = $price_slot_info->getPriceSlotGen($db_categoryp[$key]);
					$price_adj_factor= $price_slot_info_array[2];
					$cat_price = $price_slot_info_array[3];
					$cat_price = number_format($cat_price, 8, '.', '');
					$cat_name= $catPop_arrp[2];  
					$num_pages_array = $price_slot_info->howManyRadiosPaid($db_categoryp[$key], $db_idp[$key]);
						//returns both num of pages and count of how many links in top slot array($top_buyer_num_of_pages, $this_users_num_of_pages, = $num_pages_array[1];);
						$top_buyer_num_of_pages = $num_pages_array[0];
						$this_users_num_of_pages = $num_pages_array[1];
						$count_of_top_links = $num_pages_array[2];
						$top_buyer_link_id = $num_pages_array[3];//shouldn't link id be 4th?


 $num_of_pagesp = $top_buyer_num_of_pages + 1;//this used to be an if/else user was tied for first - just add a new top slot
		$user_purchase_info = $price_slot_info->getThisUsersLastBoughtPriceSlot($db_categoryp[$key], $db_idp[$key]);
							$user_top_active_bid = $price_slot_info->getUsersTopBoughtSpot($db_categoryp[$key], $user_id);
							$cat_price2 = $cat_price;
								if($num_of_pagesp<2)
								{
								 $display_blockmp .= "<div STYLE='font-size: 85%; text-align:center;'>Current Subscription <br>Info<br>Your current Price Slot Is <br>";
								 $display_blockmp .= $cat_price2."/mo.<br> To be the top listing in this category select current bid price's checkbox and submit";
								  $display_blockmp .= "</div>";
								   //increment the base price and display from the highest price to the lowest(the base)
								   //this should be if count is greater than 1
								    $display_blockmp .= '<div><input type="checkbox" id="buyp'.$key.'" name="buyp'.$key.'" value="'.$cat_price.'" onClick="TotalCheckedValuesP()" ><br>$';
								     $display_blockmp .= $cat_price2.'/mo.
								     <table><tr><td style="text-align:center"; colspan="'.$num_of_pagesp.'" ><INPUT type="submit" name="B1" value="Process Now">
								      </FORM></td></tr></table></div>';
								}//close if less than 2
								else//make them radio buttons
								{
								$display_blockmp .= "<div STYLE='font-size: 85%; text-align:center;'><h4 style='color:red;'>";
								$display_blockmp .= rtrim(rtrim($user_purchase_info[2], "0"),".");
								$display_blockmp .= "<br>Your Current Slot Price <br>Is Indicated Above</h4>Select higher (or lower) amount below to modify your bid or select current price slot price to cancel.";
								$display_blockmp .= "</div>";
								$display_blockmp .='<table><tr>';
								for($i=1;$i <= $num_of_pagesp; $i++){
								  unset($incr_cat_price);
								    $incr_cat_price = 0;
								     for($t=0;$t<=$num_of_pagesp-$i;$t++){
									 if($incr_cat_price>0){
									   $incr_cat_price = $incr_cat_price+($incr_cat_price * $price_adj_factor);
									     }else{
									   $incr_cat_price = $cat_price;
										}//close else
									}//close for loop
								
									$incr_cat_price = rtrim(rtrim($incr_cat_price, "0"),".");
									$num_links_in_slot = $price_slot_info->getNumLinksInSlot($db_categoryp[$key], $incr_cat_price);
									$count_links = $count_links + $num_links_in_slot;
									 if($count_links<21){
									  $bgcolor="#F1AB29";
									   }
									     elseif($count_links>21 AND $count_links<41){
									      $bgcolor="#DFDDDD";
										}
										  elseif($count_links>41 AND $count_links<61){
										   $bgcolor="#FFE4B8";
											}	
									if($incr_cat_price == $user_purchase_info[2]){
									$temp_incr_cat_price = $incr_cat_price;
									$display_blockmp1 .= '<td STYLE="font-size: 65%;background-color:'.$bgcolor.'""><input type="radio" id="buyp'.$key.'" name="buyp'.$key.'"  value="'.$temp_incr_cat_price.'" onClick="TotalCheckedValuesP()"></td>';
									}
									else
									{	
									$display_blockmp1 .= '<td STYLE="font-size: 65%;background-color:'.$bgcolor.'""><input type="radio" id="buyp'.$key.'" name="buyp'.$key.'"  value="'.$incr_cat_price.'" onClick="TotalCheckedValuesP()"></td>';
									}
									$display_blockmp2 .= "<td STYLE='font-size: 65%;'><h4>".$incr_cat_price." BTC/mo</h4></td>";
									//add a condition making sure Be top only displays for top link
									//finish making sure subscribe is turned to zero after quiting.
									if($num_links_in_slot == 0){
									   if($i == $num_of_pagesp - 1){
									      $display_blockmp3 .= "<td STYLE='font-size: 65%;'>Be<br>Top<br>Link</td>";
										}
										else
										{
										$display_blockmp3 .= "<td STYLE='font-size: 65%;'>No Links</td>";
										}
									}
									else{
									  $display_blockmp3 .= "<td STYLE='font-size: 65%;'>".$num_links_in_slot."<br>link";
									    if($num_links_in_slot == 1){
										$display_blockmp3 .="<br>in<br>slot</td>";
										}
										else
										{
										$display_blockmp3 .="s<br>in<br>slot</td>";
										}
									       }
									     }
								           $display_blockmp .= $display_blockmp1.'</tr><tr>'.$display_blockmp2.'</tr><tr>'.$display_blockmp3.'</tr>';
								          $display_blockmp .="<tr height='10px'><td colspan='$num_of_pagesp' STYLE='font-size: 65%;'> <a href='../members/modal/how_to_bid.php?link_id=$db_idp[$key]' title='How To Purchase Placement When Offered \"Price Slots\"' rel='gb_page_center[640, 480]'><div style=\"background-image: url('images960/1x1tran.gif'); background-repeat: repeat-x; background-color: navy; color:white; font-size:100%;-moz-border-radius: 15px;
								         border-radius: 15px;text-align: center;\">How To Bid</div></a></td></tr>";
								       $display_blockmp .= '<tr><td colspan="'.$num_of_pagesp.'" ><INPUT type="submit" name="B1" value="Process Now">
							           </FORM></td></tr>';
							$display_blockmp .='</table>';
							}//close else make them radios
						   $display_blockmp .= '</td>';

 $display_blockmp .= "</tr>";
		  $display_blockb = '</table>';//closes opening form line 361
		}//close if
	    }//close foreach line 357
          echo $display_blockt, $display_blockmp,$display_blockb;

	} else {
    // the user is not logged in...

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}








?>	
