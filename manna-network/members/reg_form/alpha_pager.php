<?

$alphaData = new mobile;

$menupage =  $alphaData->alphamenu($url_cat);	

$pages_total = count($menupage);
if($cat_page_id <= 1){
$current_page = 1;
}
else
{
$current_page = $cat_page_id;
}

$amm = $settings['amm'];
$num_max_links = $settings['num_max_links'];
$page_offset = ($num_max_links-1)/2;
$istpage = "/$folder_name/$file_name/$url_cat/$regional_number/1/$cat_page_total/$cat_page_id/$link_page_id/$link_page_total/$link_record_num";

$temp_last_page=$menupage[$pages_total][0][0];
$last_page = "/$folder_name/$file_name/$url_cat/$regional_number/$pages_total/$cat_page_total/$cat_page_id/$link_page_id/$link_page_total/$link_record_num";
   
 if($pages_total  - 1 > $num_max_links){

      If($current_page == 1 )
      {
		       $nav_barf = " 	<div align='center'>					
<table align='center' border='0' cellpadding='3' cellspacing='3'   width='$table_width' id='AutoNumber1'>
  <tr><td  rowspan='2' align='center'><font size = '1'>More Sub-categories</td>
	<td align='center'><font color='#FF6600' size ='1'>Alphabetical</font>
</td>
";
  for ($i = 2; $i <= $num_max_links + 1; $i ++)
              {  
							$temp_menupage=$menupage[$i][0][0];
				$temp_cat_page_id = $i;
			$link_page_out = array("$temp_menupage" , "$link_page_id" , "$link_page_total" , "$link_record_num");
	$link_page_out = implode(" ", $link_page_out);
						            $nxt = "/$folder_name/$file_name/$url_cat/$regional_number/$temp_cat_page_id/$cat_page_total/$link_page_out";
    $nav_barf = $nav_barf ."     
    <td align='center'>
    <font style='font-size:70%' ><a href = '$nxt'>$i</a></font></td>";
            }
     $nav_barf = $nav_barf . " 
  </tr>
  <tr>";
            for ($i = 2; $i <= $num_max_links +1; $i ++)
            {
$temp_menupage=$menupage[$i][0][0];
 $temp_cat_page_id = $i;
 
		$link_page_out = array("$temp_menupage" , "$link_page_id" , "$link_page_total" , "$link_record_num");
				      $link_page_out = implode(" ", $link_page_out);    
										  $nxt = "/$folder_name/$file_name/$url_cat/$regional_number/$temp_cat_page_id/$cat_page_total/$link_page_out";
    $nxt_txt = $menupage[$i][0][1];
 $nxt_txt_end = $menupage[$i][$amm-1][1];
 $nav_barf = $nav_barf . "<td align='center'>
    <a href = '$nxt'>$nxt_txt to $nxt_txt_end</a></td>";
            }//end for
       $nav_barf = $nav_barf ."<td rowspan='2' align='center'><a href = '$last_page'><font color='#0000EE'>| LAST - $pages_total |</font></a> <font size = '1'> Pagination</td>
  </tr></table> </div>";
	//echo $nav_barf;
}//end if
      elseIf($current_page > 1 && $current_page <= $page_offset+1 )
     {
		$page_offset_is_walking=2;// menu walk middle 
		$nav_barf = " 						
<table align='center' border='0' cellpadding='3' cellspacing='3'   width='$table_width' id='AutoNumber1'>
  <tr height='12'><td rowspan='2' align='center'><a href = '$istpage'>|1st|</a>
</td>
";
  for ($i = 2; $i <= $num_max_links +1; $i ++)
              {  
							$temp_menupage=$menupage[$i][0][0];
				$temp_cat_page_id = $i;
					$link_page_out = array("$temp_menupage" , "$link_page_id" , "$link_page_total" , "$link_record_num");
	         $link_page_out = implode(" ", $link_page_out);
									    $nxt = "/$folder_name/$file_name/$url_cat/$regional_number/$temp_cat_page_id/$cat_page_total/$link_page_out";
    if($i == $current_page)
                  {  $nav_barf = $nav_barf ."     
              <td align='center'>
    <font  style='font-size:70%' ><font color='#FF6600' >$i</font></font></td>";
          }
					else
					{$nav_barf = $nav_barf ."     
              <td align='center'>
    <font style='font-size:70%' ><a href = '$nxt'>$i</a></font></td>";
       	} 
		 }
   $nav_barf = $nav_barf . " 
  </tr>
  <tr height='12'>";
           for ($i = 2; $i <= $num_max_links+1; $i ++) {
                  if($i == $current_page)
                  {  $nxt_txt = $menupage[$i][0][1];
                  $nxt_txt_end = $menupage[$i][$amm-1][1];
                  $nav_barf = $nav_barf . "<td align='center'>
    <font color='#FF6600'>|$nxt_txt to $nxt_txt_end|</font></td>";
                   }//end elseif
                  else
                  {
									 $temp_menupage=$menupage[$i][0][0];
	$temp_cat_page_id = $i;
					       $link_page_out = array("$temp_menupage" , "$link_page_id" , "$link_page_total" , "$link_record_num");
	   $link_page_out = implode(" ", $link_page_out);
										  $nxt = "/$folder_name/$file_name/$url_cat/$regional_number/$temp_cat_page_id/$cat_page_total/$link_page_out";
  $nxt_txt = $menupage[$i][0][1];
                  $nxt_txt_end = $menupage[$i][$amm-1][1];
                  $nav_barf = $nav_barf . "
                  <td align='center'><a href = '$nxt'>$nxt_txt to $nxt_txt_end</a></td>";
             }//end else
									}//end for
              $nav_barf = $nav_barf ."<td rowspan='2' align='center'><a href = '$last_page'><font color='#0000EE'>| LAST - $pages_total |</font></a></td>
  </tr></table> ";
	//echo $nav_barf;
      }//end elseif
        elseIf($current_page > $page_offset && $current_page < $pages_total - $page_offset)
        {
		$page_offset_is_walking=3;// menu walk middle 
		 $nav_barf = " 						
<table align='center' border='0' cellpadding='3' cellspacing='3'   width='$table_width' id='AutoNumber1'>
  <tr><td rowspan='2' align='center'><a href = '$istpage'>|1st|</a>
</td>
";
  $po_left = $current_page - $page_offset ;
        $po_right = $current_page + $page_offset;
              for ($i = $po_left; $i <= $po_right; $i ++) {
           	$temp_menupage=$menupage[$i][0][0];
			$temp_cat_page_id = $i;
						    $link_page_out = array("$temp_menupage" , "$link_page_id" , "$link_page_total" , "$link_record_num");
	      $link_page_out = implode(" ", $link_page_out);
										  $nxt = "/$folder_name/$file_name/$url_cat/$regional_number/$temp_cat_page_id/$cat_page_total/$link_page_out";
       if($i == $current_page)
                  {  $nav_barf = $nav_barf ."     
              <td align='center'>
    <font  style='font-size:70%' ><font color='#FF6600' >$i</font></font></td>";
          }
					else
					{$nav_barf = $nav_barf ."     
              <td align='center'>
    <font style='font-size:70%' ><a href = '$nxt'>$i</a></font></td>";
       	}             }
   $nav_barf = $nav_barf . " 
  </tr>
  <tr>";
  $po_left = $current_page - $page_offset ;
        $po_right = $current_page + $page_offset;
              for ($i = $po_left; $i <= $po_right; $i ++) {
                    If($i < $current_page)
                            {
      											$temp_menupage=$menupage[$i][0][0];
			$temp_cat_page_id = $i;
						$link_page_out = array("$temp_menupage" , "$link_page_id" , "$link_page_total" , "$link_record_num");
	        $link_page_out = implode(" ", $link_page_out);
									    $nxt = "/$folder_name/$file_name/$url_cat/$regional_number/$temp_cat_page_id/$cat_page_total/$link_page_out";
     $nxt_txt = $menupage[$i][0][1];
                   $nxt_txt_end = $menupage[$i][$amm-1][1];
                             $nav_barf = $nav_barf ."     
              <td align='center'>
    
                            <a href = '$nxt'>$nxt_txt to $nxt_txt_end</a></td>";
                            }//end if
                      elseif($i == $current_page)
                            {
														$nxt_txt = $menupage[$i][0][1];
                            $nxt_txt_end = $menupage[$i][$amm-1][1];
                   $nav_barf = $nav_barf . "<td align='center'>
    <font color='#FF6600'>**$nxt_txt to $nxt_txt_end**</font></td>
                            ";
                            }//end elseif
                      else
                            {//$i is greater that current page
                            $temp_menupage=$menupage[$i][0][0];
		$temp_cat_page_id = $i;
						  $link_page_out = array("$temp_menupage" , "$link_page_id" , "$link_page_total" , "$link_record_num");
	        $link_page_out = implode(" ", $link_page_out);
										 $nxt = "/$folder_name/$file_name/$url_cat/$regional_number/$temp_cat_page_id/$cat_page_total/$link_page_out";
     $nxt_txt = $menupage[$i][0][1];
                   $nxt_txt_end = $menupage[$i][$amm-1][1];
                            $nav_barf = $nav_barf . "<td align='center'>
    
                            <a href = '$nxt'>$nxt_txt to $nxt_txt_end</a></td>
                            ";
                            }//end else
											}//end for			
                  $nav_barf = $nav_barf ."<td rowspan='2' align='center'><a href = '$last_page'><font color='#0000EE'>| LAST - $pages_total |</font></a></td>
  </tr></table> ";
	//echo $nav_barf;
	   }//end elseif
     elseIf($current_page < $pages_total && $current_page + $page_offset >= $pages_total)
    	{
  $page_offset_is_walking=4;// menu walk end 
	$nav_barf = " 						
<table align='center' border='0' cellpadding='3' cellspacing='3'   width='$table_width' id='AutoNumber1'>
 
  <tr><td rowspan='2' align='center'><a href = '$istpage'>|1st|</a>
</td>
";
 for ($i = $pages_total-$num_max_links ; $i <= $pages_total-1 ; $i ++)
              {  
									$temp_menupage=$menupage[$i][0][0];
				  $temp_cat_page_id = $i;
					$link_page_out = array("$temp_menupage" , "$link_page_id" , "$link_page_total" , "$link_record_num");
		        $link_page_out = implode(" ", $link_page_out);
									    $nxt = "/$folder_name/$file_name/$url_cat/$regional_number/$temp_cat_page_id/$cat_page_total/$link_page_out";
    if($i == $current_page)
                  {  $nav_barf = $nav_barf ."     
              <td align='center'>
    <font  style='font-size:70%' ><font color='#FF6600' >$i</font></font></td>";
          }
					else
					{$nav_barf = $nav_barf ."     
              <td align='center'>
    <font style='font-size:70%' ><a href = '$nxt'>$i</a></font></td>";
       	} 
   }
    $nav_barf = $nav_barf . " 
  </tr>
  <tr>";
  for ($i = $pages_total-$num_max_links ; $i <= $pages_total - 1; $i ++) 
              {
							      If($i < $current_page)
                            {
      											$temp_menupage=$menupage[$i][0][0];
		$temp_cat_page_id = $i;
						       $link_page_out = array("$temp_menupage" , "$link_page_id" , "$link_page_total" , "$link_record_num");
	    $link_page_out = implode(" ", $link_page_out);
										$nxt = "/$folder_name/$file_name/$url_cat/$regional_number/$temp_cat_page_id/$cat_page_total/$link_page_out";
     $nxt_txt = $menupage[$i][0][1];
                   $nxt_txt_end = $menupage[$i][$amm-1][1];
                             $nav_barf = $nav_barf ."     
              <td align='center'>
    
                            <a href = '$nxt'>$nxt_txt to $nxt_txt_end</a></td>";
                            }//end if
                      elseif($i == $current_page)
                            {
													$nxt_txt = $menupage[$i][0][1];
                            $nxt_txt_end = $menupage[$i][$amm-1][1];
                     $nav_barf = $nav_barf . "<td align='center'>
    <font color='#FF6600'>|$nxt_txt to $nxt_txt_end|</font></td>
                            ";
                            }//end elseif
                      else
                            {//$i is greater that current page
                            $temp_menupage=$menupage[$i][0][0];
			$temp_cat_page_id = $i;
						       $link_page_out = array("$temp_menupage" , "$link_page_id" , "$link_page_total" , "$link_record_num");
	    $link_page_out = implode(" ", $link_page_out);
										 $nxt = "/$folder_name/$file_name/$url_cat/$regional_number/$temp_cat_page_id/$cat_page_total/$link_page_out";
    $nxt_txt = $menupage[$i][0][1];
                   $nxt_txt_end = $menupage[$i][$amm-1][1];
                            $nav_barf = $nav_barf . "<td align='center'>
    
                            <a href = '$nxt'>$nxt_txt to $nxt_txt_end</a></td>
                            ";
		                          }//end else
											}//end for			
                   $nav_barf = $nav_barf ."<td rowspan='2' align='center'><a href = '$last_page'><font color='#0000EE'>|LAST - $pages_total|</font></a></td>
  </tr></table> ";
	//echo $nav_barf;
  }//end elseif
   elseif($current_page == $pages_total){
 	$nav_barf = " 						
<table align='center' border='0' cellpadding='3' cellspacing='3'   width='$table_width' id='AutoNumber1'>
  <tr><td rowspan='2' align='center'><a href = '$istpage'>|1st|</a>
</td>
";
  for ($i = $pages_total-$num_max_links; $i <= $pages_total-1; $i ++)
              {  
							$temp_menupage=$menupage[$i][0][0];
							    $temp_cat_page_id = $i;
			$temp_cat_page_id = $i;
					     $link_page_out = array("$temp_menupage" , "$link_page_id" , "$link_page_total" , "$link_record_num");
	      $link_page_out = implode(" ", $link_page_out);
										$nxt = "/$folder_name/$file_name/$url_cat/$regional_number/$temp_cat_page_id/$cat_page_total/$link_page_out";
     $nav_barf = $nav_barf ."     
              <td align='center'>
   <font style='font-size:70%' ><a href = '$nxt'>$i</a></font></td>";
            }
     $nav_barf = $nav_barf . " 
  </tr>
  <tr>";
   for ($i = $pages_total-$num_max_links; $i <= $pages_total-1; $i ++)
              {  
               $temp_menupage=$menupage[$i][0][0];
						$temp_cat_page_id = $i;
						       $temp_cat_page_id = $i;
						 $link_page_out = array("$temp_menupage" , "$link_page_id" , "$link_page_total" , "$link_record_num");
	
	      $link_page_out = implode(" ", $link_page_out);
										 $nxt = "/$folder_name/$file_name/$url_cat/$regional_number/$temp_cat_page_id/$cat_page_total/$link_page_out";
  
					
					  $nxt_txt = $menupage[$i][0][1];
									   $nxt_txt_end = $menupage[$i][$amm-1][1];
				 $nav_barf = $nav_barf ."     
              <td align='center'>
    <a href = '$nxt'>$nxt_txt to $nxt_txt_end</a></td>";
            }
$nav_barf = $nav_barf ."<td rowspan='2' align='center'><font color='#FF6600'>|LAST - $pages_total|</font></td>
  </tr></table> ";
	//echo $nav_barf;
        }//end elseif
}//end main if
else
{
   $nav_barf = " 						
<table align='center' border='0' cellpadding='3' cellspacing='3'   width='$table_width' id='AutoNumber1'>
  <tr><td  rowspan='2' align='center'><font size = '1'>More Sub-categories</td></tr>
	
	
  <tr><td align='center'><font size = '1'>Alphabetical  </font></td>";
            for ($i = 1; $i <= $pages_total; $i ++)
            {
$temp_menupage=$menupage[$i][0][0];
$temp_cat_page_id = $i;
					          $link_page_out = array("$temp_menupage" , "$link_page_id" , "$link_page_total" , "$link_record_num");
	 $link_page_out = implode(" ", $link_page_out);
										 $nxt = "/$folder_name/$file_name/$url_cat/$regional_number/$temp_cat_page_id/$cat_page_total/$link_page_out";
   $nxt_txt = $menupage[$i][0][1];
                    	If($i==$pages_total)
                    	{
                    	$nxt_txt_end = "End";
                    	}
                    	else
                    	{
                    	$nxt_txt_end = $menupage[$i][$amm-1][1];
                    	}
                    	if($i == $current_page){
                    $nav_barf = $nav_barf . "<td align='center'>
                        <font color='#FF6600'>$i - $nxt_txt to $nxt_txt_end|</font>";
                    		}
                    		else
                    		{
                    		$nav_barf = $nav_barf . "<td align='center'>
                        <a href = '$nxt'>$i - $nxt_txt to $nxt_txt_end</a>";
                    		}
		           }//end for
       $nav_barf = $nav_barf ."<font size='1'><br />Pagination </font></td></tr></table>";
			// echo $nav_barf;
}			
?>
