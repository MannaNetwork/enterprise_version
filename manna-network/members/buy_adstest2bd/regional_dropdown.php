 <?  
$affiliate_num='2311';
echo "<div><span>";
		  echo "<font id=continents><select>\n";
     echo "<option value='0'>Global</option> \n" ;
     echo "</select></font>\n";
		echo " </span></div>";
    echo "<div><span>";
     echo "<font id=countries><select>\n";
     echo "<option value='0'>&nbsp;</option> \n" ;
     echo "</select></font>\n";
    echo " </span>";
		 echo "<span>";
     echo "<font id=states><select>\n";
     echo "<option value='0'>&nbsp;</option> \n" ;
     echo "</select></font>\n";
		echo "</span>";
echo "<span>";
		 echo "<font id=filler><select>\n";
    echo "<option value='0'>&nbsp;</option> \n" ;
     echo "</select></font>\n";
	 echo "</span>";

		echo "<span>";
		 echo "<font id=cities><select>\n";
     echo "<option value='0'>&nbsp;</option> \n" ;
     echo "</select></font>\n";
	 echo "</span>";
	 echo "<span>";
		 echo "<font id=final>\n";
     echo " \n" ;
     echo "</font>\n";
	 echo "</span></div>";
	



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



req.open("GET", "http://Bungeebones.com/modal/regional.php?data="+src+"&val="+val+"&affiliate_num="+<? echo $affiliate_num; ?>+"&cat_id="+<? echo $url_cat; ?> ); //make connection

req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=iso-8859-1"); // set Header
req.send(null); //send value


}

window.onLoad=dochange('continents', -1,-1,-1);         // value in first dropdown
</script>