<script>
function showSubLoc1(str) {
var myarr = str.split(":");

 if (str=="") {
    document.getElementById("locHint1").innerHTML="";
    return;
  }

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {

    if (this.readyState==4 && this.status==200) {
      document.getElementById("locHint1").innerHTML=this.responseText;
 document.getElementById("locHint2").innerHTML=still_more_locs_cont;

    }
  }
document.getElementById("tregional_num").value = myarr[1];
document.getElementById("regional_name").value = myarr[2];
  xmlhttp.open("GET","/wp-content/plugins/manna-network/getsubloc1.php?tregional_num="+myarr[1],true);
  xmlhttp.send();
}



function showSubLoc2(str) {

var myarr = str.split(":");
 if (str=="") {
    document.getElementById("locHint2").innerHTML="";
    return;
  }

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari

    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {

    if (this.readyState==4 && this.status==200) {
      document.getElementById("locHint2").innerHTML=this.responseText;
 document.getElementById("locHint3").innerHTML=still_more_locs_coun;
    }
  }
document.getElementById("tregional_num").value = myarr[1];
document.getElementById("regional_name").value = myarr[2];
  xmlhttp.open("GET","/wp-content/plugins/manna-network/getsubloc2.php?tregional_num="+myarr[1],true);
  xmlhttp.send();
}


function showSubLoc3(str) {
var myarr = str.split(":");
 if (str=="") {
    document.getElementById("locHint3").innerHTML="";
    return;
  }

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari

    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {

    if (this.readyState==4 && this.status==200) {
      document.getElementById("locHint3").innerHTML=this.responseText;
 document.getElementById("locHint4").innerHTML=still_more_locs_stat;
    }
  }
document.getElementById("tregional_num").value = myarr[1];
document.getElementById("regional_name").value = myarr[2];

  xmlhttp.open("GET","/wp-content/plugins/manna-network/getsubloc3.php?tregional_num="+myarr[1],true);
  xmlhttp.send();
}

function showSubLoc4(str) {
var myarr = str.split(":");

  if (str=="") {
    document.getElementById("locHint4").innerHTML="";
   return;
  }

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {

    }
  }

 document.getElementById("locHint4").innerHTML=still_more_locs_city;
  document.getElementById("tregional_num").value = myarr[1];
document.getElementById("regional_name").value = myarr[2];
}

function deleteAllLevels(form_num) {		

document.getElementById('locHint1').innerHTML= '';
document.getElementById('locHint2').innerHTML= '';
document.getElementById('locHint3').innerHTML= '';
document.getElementById('locHint4').innerHTML= '';
document.getElementById('goLink').innerHTML= '';
 return;
		
}
//
function updategoButton ( current_hidden_var_str, submitted_regional_num){
//window.alert(' hidden_vars = ' + hidden_vars);

var currenturl = document.getElementById("goLink").innerHTML;

if(currenturl.indexOf("?") == -1 ){
	//script handles the very first onchange event and creates a insert URL (for the getelementbyID) for the GO button
	//is either sent a category arg or a regional num arg (along with the category id of their current cat location)
	//window.alert('submitted_regional_num = '+ submitted_regional_num);
		var current_hidden_var_string = current_hidden_var_str.split(":");
var myregarr = submitted_regional_num.split(":");
var inserturl = '<a href="?link_id=' + current_hidden_var_string[1]+ '&price=' + current_hidden_var_string[3]+ '&cat_id=' + current_hidden_var_string[5]+ '&coin_type=' + current_hidden_var_string[7]+ '&agent_ID=' + current_hidden_var_string[9]+ '&users_balances_string=' +  current_hidden_var_string[11]+ '&this_links_status_on_Central=' + current_hidden_var_string[13] + '&this_links_bid=' + current_hidden_var_string[15] + '&tregional_num=' + myregarr[1] +'&B1=\'1\'"><h1>GO</h1></a>';

		
}
else
{ 
// it has a ? in the current url meaning there are two arguments in the GET of the url
//we need to determine those args by looking for the arg names in the url (we are having the problems with the detection because the & gets replaced sometimes with &amp; in the javascript)

	
		// Note there is always only one side of the existing link that needs to be updated
//We need to update either q=#### or tregional_num=#####
//https://1stbitcoinbank.com/advertise/?q=485&tregional_num=####
//currenturl = '<a href="?q=485&tregional_num=####"><h1>GO</h1></a>';


var currenturlpieces = currenturl.split('"><h1>'); //leaves <a href="?q=485&tregional_num=#### at currenturlpieces[0])
//window.alert('submitted_category.indexOf(":") = ' + submitted_category.indexOf(":"));

//window.alert('submitted_regional_num.indexOf(":") = ' + submitted_regional_num.indexOf(":"));
//window.alert('currenturlpieces = '+ currenturlpieces[0]);

var twoarguments = currenturlpieces[0].split('?'); //leaves q=485&tregional_num=####
//window.alert('twoarguments 0 = '+ twoarguments[0]);
//window.alert('twoarguments  1 = '+ twoarguments[1]);

var twoargumentssplit = twoarguments[1].split('&amp;'); //leaves q=485 in 0 and tregional_num=#### 
//window.alert('twoargumentssplit 0 = '+ twoargumentssplit[0]);
//window.alert('twoargumentssplit  1 = '+ twoargumentssplit[1]);

//window.alert('before if current_hidden_var_str= '+ submitted_category);
//window.alert('before if submitted_regional_num = '+ submitted_regional_num);

/*	if(submitted_regional_num !== 'false'){
//window.alert('in if ');
				//IF so, we need to find, copy and save the existing argument 
				// the needed value will be twoargumentssplit[1]
	var mycatarr = submitted_category.split(":");
//window.alert('in submitted_category.indexOf(":") >= 0  and mycatarr 0 = '+ mycatarr[0]);
//window.alert('mycatarr 1 = '+ mycatarr[1]);
			
	var inserturl = '<a href="?q=' + mycatarr[1] + '&' + twoargumentssplit[1] + '"><h1>GO</h1></a>';
	}
	else */

if(submitted_regional_num.indexOf(":") > 0){
//window.alert('in if ');

	//IF so, we need to find, copy and save the existing argument 
	// the needed value will be var twoargumentssplit[0];
	var myregarr = submitted_regional_num.split(":");
//window.alert('myregarr  0 = '+ myregarr[0]);
//window.alert('myregarr  1 = '+ myregarr[1]);

	var inserturl = '<a href="?' + twoargumentssplit[0] + '&tregional_num=' + myregarr[1] + '"><h1>GO</h1></a>';
	}
else
{
//window.alert('in else ');
var current_hidden_var_string = current_hidden_var_str.split(":");
var myregarr  = submitted_regional_num.split(":");
var inserturl = '<a href="? link_id=' + current_hidden_var_string[1]+ '&price=' + current_hidden_var_string[3]+ '&cat_id=' + $current_hidden_var_string[5]+ '&coin_type=' + current_hidden_var_string[7]+ '&agent_ID=' + current_hidden_var_string[9]+ '&users_balances_string=' +  current_hidden_var_string[11]+ '&this_links_status_on_Central=' +$this_links_status_on_Central+ '&this_links_bid=' +$this_links_bid + '&tregional_num=' + myregarr[1] +'"><h1>GO</h1></a>';
}
	
	}
  document.getElementById("goLink").innerHTML=inserturl; 
}

</script>
