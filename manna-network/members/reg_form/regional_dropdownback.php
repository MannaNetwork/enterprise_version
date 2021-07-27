 <?  
//$affiliate_num='2338';



		 
if(($regional_number!="")){

echo "<div style='background-color: #d8f6d1; font-size: 130%; color: red;'><div><span>";

echo "<h2 style='color:black'>(Completed) Regional Info</h2> ";

echo '<p>Your link will now contain the following regional information:<p style="font-size: 170%">';
$catData = new mobile;
$regional_path = $catData->regionPath($cat_id, $regional_number);
if($regional_path !==""){
foreach ($regional_path as $value) {
#
echo $value."->";
#
} 
}
echo '</p><p>Click the reset to remove regional information from your listing.<p>Select again to edit.
'; 

echo'</div>';
} 
else
{
echo "<div style='background-color: #ebebeb; font-size: 130%; '><div><span>";

 echo "<h2 style='color: red'>STEP 2 - Add Regional Info (Optional)</h2> ";

echo '<p align="left">If regional info (such as the continent, country, "state", or city location) about your company/business/website etc  would be a benefit to your website visitors then select them below.
';
echo"
<a href='/members/reg_form/regional_seo_considerations.php' title='BungeeBones For Local SEO'  rel='gb_page_center[640, 480]'><div style=\"background-image: url('images960/1x1tran.gif'); background-repeat: repeat-x; background-color: white; 
	color:green; font-size:150%;-moz-border-radius: 15px;
	border-radius: 15px;text-align: center;\">Click here to get more info about regional settings, pricing and local SEO considerations.</div></a>";


echo'
<p align="left">
  To add regional information to your listing requires a selection sub-process. First, select from the first dropdown below (continent) and the next drop down in the series will populate automatically with the countries of that continent. Continue your selection until you have selected to the "lowest" regional level you want. After each selection a link appears corresponding to the level. <strong><u>ONLY</u> Click the link if you want the regional selections you made to be added to your listing. If you do not select a link then your selections are not recorded and your link is displayed globally.</strong>.

';
echo'</div>';
}   


echo "<div style='background-color: #ECF9FF'><div>&nbsp;</div><div><span>";
		  echo "<font id=continents><select> \n";
     echo "<option value='0'>Continent</option> \n" ;
     echo "</select></font>\n";
		echo " </span>";
    echo "<span>";
     echo "<font id=countries><select>\n";
     echo "<option value='0'>Country</option> \n" ;
     echo "</select></font>\n";
    echo " </span>";
		 echo "<span>";
     echo "<font id=states><select>\n";
     echo "<option value='0'>State</option> \n" ;
     echo "</select></font>\n";
		echo "</span>";


		echo "<span>";
		 echo "<font id=cities><select>\n";
     echo "<option value='0'>City</option> \n" ;
     echo "</select></font>\n";
	 echo "</span>";
echo "<span>";
		 echo "<font id=district1><select>\n";
    echo "<option value='0'>District1</option> \n" ;
     echo "</select></font>\n";
	 echo "</span>";

echo "<span>";
		 echo "<font id=district2><select>\n";
    echo "<option value='0'>District2</option> \n" ;
     echo "</select></font>\n";
	 echo "</span>";

	 echo "<span>";
		 echo "<font id=final>\n";
     echo " \n" ;
     echo "</font>\n";
	 echo "</span></div><br><span style='font-size: smaller'> <a href='http://BungeeBones.com/members/reg_form/index.php/". $url_cat."'>Reset Region Filters To Global Level</a></span></div>";
	



	?>

<script language="JavaScript" type="text/javascript"> 
var affiliate_num = <? echo $affiliate_num; ?> ;
var cat_id= <? echo $url_cat; ?> ;
 


function Inint_AJAX() {
try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
alert("XMLHttpRequest not supported");
return null;
};


function dochange(src, val, affiliate_num, cat_id) {

var req = Inint_AJAX();
req.onreadystatechange = function () {
 if (req.readyState==4) {
      if (req.status==200) {
           document.getElementById(src).innerHTML=req.responseText; //retuen value
      }
 }
};



req.open("GET", "http://Bungeebones.com/members/reg_form/regional.php?data="+src+"&val="+val+"&affiliate_num="+<? echo $affiliate_num; ?>+"&cat_id="+<? echo $url_cat; ?>  ); //make connection

req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=iso-8859-1"); // set Header
req.send(null); //send value


}

window.onLoad=dochange('continents', -1,-1,-1);         // value in first dropdown
</script>
