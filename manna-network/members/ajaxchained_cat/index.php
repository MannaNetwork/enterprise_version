<?php 

if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
require_once('../libraries/password_compatibility_library.php');
}
require_once('../config/config.php');
require_once('../lang/en.php');
require_once('../libraries/PHPMailer.php');
require_once('../classes/Login.php');
$login = new Login();

if ($login->isUserLoggedIn() == true) {    
$user_id = $_SESSION['user_id'];
$phpself = basename(__FILE__);
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;

include($_SERVER['DOCUMENT_ROOT']."/classes/ajax_cat_class.php");
$AJAXinfo = new ajax_info;


if(isset($_POST['C1'])){
//The message var acts as a switch when sent to the functions calling them to make the transaction instead of reporting it. It then have all the functions on this page make a $message var instead of echos and then forward it in the header url for printing on the success page as a record
//echo '<br> in index, echoing POST and looking for buyer type';
//print_r($_POST);
 $today = date('F j, Y, g:i a');
echo 'Today in C1 = ', $today;
}
elseif(isset($_POST['B1'])){
//The message var acts as a switch when sent to the functions calling them to make the transaction instead of reporting it. It then have all the functions on this page make a $message var instead of echos and then forward it in the header url for printing on the success page as a record
//echo '<br> in index, echoing POST and looking for buyer type';
//print_r($_POST);
 $today = date('F j, Y, g:i a');
echo 'Today in B1 = ', $today;
}
else
{

?>
<html>
<head>
<title>Category Dropdown Using Ajax</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/css/reset.css" />
<link rel="stylesheet" href="/css/text.css" />
<link rel="stylesheet" href="/css/960.css" />
<link rel="stylesheet" href="/css/demo.css" />
<link rel="stylesheet" type="text/css" href="/css/ddcolortabs.css" />
<link rel="stylesheet" type="text/css" href="/css/custom.css" />
<link rel="stylesheet" type="text/css" href="/customize_btn.css" />
<!--<link rel="stylesheet" href="css/responsive.css">--> 
	<link rel='stylesheet' href="/css/camera.css">
 <!--[if lt IE 9]>
		<script src="/js/html5.js"></script>
		<script src="/js/css3-mediaqueries.js"></script>
	<![endif]-->
<script type="text/javascript" src="/js/dropdowntabs.js">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="jquery.chained.min.js"></script>
<script language="javascript" type="text/javascript">
function getXMLHTTP() { //function to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
function get2ndLevel(firstLevelId) {		
		
		var strURL="find2ndLevelWithCurl.php?firstLevel="+firstLevelId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('secondleveldiv').innerHTML=req.responseText;
						document.getElementById('thirdleveldiv').innerHTML='<select name="thirdlevel">'+
						'<option>Select 3rd Level</option>'+
				        '</select>';						
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
function submitform()
{
    document.forms["ajax_dd_form"].submit();
}	
function get1stLevelURL(firstLevelId) {		
		
		var strURL="find2ndLevelURL.php?firstlevel="+firstLevelId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
					/*	document.getElementById('countrydivURL').innerHTML=req.responseText;*/
		document.getElementById('firstleveldivURL').innerHTML= '<td width="45"><a href="javascript: submitform()">Submit</a></td>';

					
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
function delete1stLevelURL(firstLevelId) {		
		
		var strURL="find2ndLevelURL.php?firstlevel="+firstLevelId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
					/*	document.getElementById('countrydivURL').innerHTML=req.responseText;*/
		document.getElementById('firstleveldivURL').innerHTML= '<td width="45">&nbsp;</td>';

					
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}

function get2ndLevelURL(firstLevelId) {		
		
		var strURL="find2ndLevelURL.php?firstlevel="+firstLevelId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
					document.getElementById('secondleveldivURL').innerHTML= '<td width="45"><a href="javascript: submitform()">Submit</a></td>';				
                                    
					 } else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
function delete2ndLevelURL(firstLevelId) {		
		
		var strURL="find2ndLevelURL.php?firstlevel="+firstLevelId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
		document.getElementById('secondleveldivURL').innerHTML= '<td width="45">&nbsp;</td>';

					
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}

function get3rdLevel(secondLevelId) {		
		
		var strURL="find3rdLevelWithCurl.php?secondLevel="+secondLevelId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('thirdleveldiv').innerHTML=req.responseText;
						document.getElementById('fourthleveldiv').innerHTML='<select name="fourthlevel">'+
						'<option>Select 4th Level</option>'+
				        '</select>';						
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
function get3rdLevelURL(firstLevelId) {		
		
		var strURL="find2ndLevelURL.php?firstlevel="+firstLevelId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
					document.getElementById('thirdleveldivURL').innerHTML= '<td width="45"><a href="javascript: submitform()">Submit</a></td>';				
                                    
					 } else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
function delete3rdLevelURL(firstLevelId) {		
		
		var strURL="find2ndLevelURL.php?firstlevel="+firstLevelId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
					/*	document.getElementById('countrydivURL').innerHTML=req.responseText;*/
		document.getElementById('thirdleveldivURL').innerHTML= '<td width="45">&nbsp;</td>';

					
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	function get4thLevel(thirdLevelId) {		
		var strURL="find4thLevelWithCurl.php?thirdLevel="+thirdLevelId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('fourthleveldiv').innerHTML=req.responseText;						
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}

function get4thLevelURL(firstLevelId) {		
		
		var strURL="find2ndLevelURL.php?firstlevel="+firstLevelId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
					document.getElementById('fourthleveldivURL').innerHTML= '<td width="45"><a href="javascript: submitform()">Submit</a></td>';				
                                    
					 } else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
function delete4thLevelURL(firstLevelId) {		
		
		var strURL="find2ndLevelURL.php?firstlevel="+firstLevelId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
					/*	document.getElementById('countrydivURL').innerHTML=req.responseText;*/
		document.getElementById('fourthleveldivURL').innerHTML= '<td width="45">&nbsp;</td>';

					
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
</script>

<style type="text/css">
body {font-family: Arial, "Trebuchet MS";font-size: 17px;color: #52B6EB; }
a{font-weight: bold;letter-spacing: -1px;color: #52B6EB;text-decoration:none;}
a:hover{color: #99A607;text-decoration:underline;}
#top{width:43%;margin-top: 25px; height:60px; border:1px solid #BBBBBB; padding:10px;}
#tutorialHead{width:43%;margin-top: 12px; height:30px; border:1px solid #BBBBBB; padding:11px;}
.tutorialTitle{width:95%;float:left;color:#99A607}
.tutorialTitle  a{float:right;margin-left:20px;}
.tutorialLink{float:right;}
table
{
margin-top:70px;
border: 1px solid #BBBBBB;
padding:25px;
height: 35px;
}
</style>

<!-- this next tag is supposed to make this load into the parent even as an iframe-->
<base target="_parent" /> 
</head>
<body onload="ajax_dd_form.reset()";>
<?
include($_SERVER['DOCUMENT_ROOT']."/960top_regform.php");
?>
<form id= "ajax_dd_form" method="post" action="https://bungeebones.com/members/ajaxchained_cat/form.php" name="ajax_dd_form">

<input type="hidden" name = "link_id" value="<?echo $_GET[link_id];?>">
<center>

    <div id='tutorialHead'>
         <div class="tutorialTitle"><b>Category Listing SEO Enhancement</b>
<p>Select the most appropriate category for your website. </p>
  </div>
</div>
<?php

$toplevel_arrays_children = $AJAXinfo->getChildrenByParentsId("1");
//returns multidim array including each child and each child's id, name
$toplevel_id = $toplevel_arrays_children[0];//array of children id nums
$toplevel_name = $toplevel_arrays_children[1];//array of children names
?>
<table width="65%"  cellspacing="0" cellpadding="0">
  <tr>
    <td width="65">Top Level</td>
     <td width="5">:</td>

    <td  width="150"><select name="toplevel" onChange="get2ndLevel(this.value), get1stLevelURL(this.value), delete3rdLevelURL(this.value), delete2ndLevelURL(this.value), delete4thLevelURL(this.value)">
	<option value="" selected>Select Top Level</option>
	<?php foreach($toplevel_name as $key=>$value){ ?>
	<option value="<?php echo $toplevel_id[$key]?>"><?php echo $toplevel_name[$key]?></option>
	<?php } ?>
	</select></td><td id="firstleveldivURL" width="45">&nbsp;</td>
  </tr>
 <tr style="">
    <td>2nd Level</td>
    <td width="5">:</td>
    <td ><div id="secondleveldiv"><select name="secondlevel" >
	<option>Select 2nd Level (optional)</option>
        </select></div></td><td id="secondleveldivURL" width="45">&nbsp;</td>
  </tr>
  <tr style="">
    <td>3rd Level</td>
    <td width="5">:</td>
    <td ><div id="thirdleveldiv"><select name="thirdlevel" >
	<option>Select 3rd Level (optional)</option>
        </select></div></td><td id="thirdleveldivURL" width="45">&nbsp;</td>
  </tr>
  <tr style="">
    <td>4th Level</td>
    <td width="5">:</td>
    <td ><div id="fourthleveldiv"><select name="fourthlevel">
	<option>Select 4th Level (optional)</option>
        </select></div></td><td id="fourthleveldivURL" width="45">&nbsp;</td>
  </tr>
  
</table>
</center>
</form>

<?
include($_SERVER['DOCUMENT_ROOT']."/960bottom.php");
}//close B1
} else {
    // the user is not logged in...
    include("views/not_logged_in.php");
}
?>
