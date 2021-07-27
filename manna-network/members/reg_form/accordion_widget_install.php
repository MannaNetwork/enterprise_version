<html><head><TITLE>Accordian</TITLE><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml2/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

<script type="text/javascript" src="ddaccordion.js">

/***********************************************
* Accordion Content script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* Visit http://www.dynamicDrive.com for hundreds of DHTML scripts
* This notice must stay intact for legal use
***********************************************/

</script>


<style type="text/css">

.mypets{ /*header of 1st demo*/
cursor: hand;
cursor: pointer;
padding: 2px 5px;
border: 1px solid gray;
background: #E1E1E1;
}

.openpet{ /*class added to contents of 1st demo when they are open*/
background: yellow;
}

.technology{ /*header of 2nd demo*/
cursor: hand;
cursor: pointer;
font: bold 14px Verdana;
margin: 10px 0;
}


.openlanguage{ /*class added to contents of 2nd demo when they are open*/
color: green;
}

.closedlanguage{ /*class added to contents of 2nd demo when they are closed*/
color: red;
}

</style>

<script type="text/javascript">

//Initialize first demo:
ddaccordion.init({
	headerclass: "mypets", //Shared CSS class name of headers group
	contentclass: "thepet", //Shared CSS class name of contents group
	revealtype: "mouseover", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content.
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", "openpet"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["none", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})

//Initialize 2nd demo:
ddaccordion.init({
	headerclass: "technology", //Shared CSS class name of headers group
	contentclass: "thelanguage", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: false, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc]. [] denotes no content.
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: false, //persist state of opened contents within browser session?
	toggleclass: ["closedlanguage", "openlanguage"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["prefix", "<img src='images/6tpc4td.gif' style='width:13px; height:13px' /> ", "<img src='images/80mxwlz.gif' style='width:13px; height:13px' /> "], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})

</script></head><body>

<a href="#" onClick="ddaccordion.collapseall('technology'); return false">Collapse all</a>  | <a href="#" onClick="ddaccordion.expandall('technology'); return false">Expand all</a> 
<h1>Complete Install Instructions</h1>

<div class="technology">The Basics</div>
<div class="thelanguage">
<div class="acc-section">
			<div class="acc-content">
				<ul class="acc" id="nested">
					
<li>
Can you add webpages to your website?</li>
<li><div class="acc-content">
Does your hosting come with PHP?
<p>Because every system is setup differently, phpinfo() is commonly used to check configuration settings and for available predefined variables  on a given system. 
</p>
<p>Create a blank page on your site (preferrably in a folder named as you entered in the configuration you just performed but not necessarily) and copy and paste the following code into it. Name and save it as anything you like, just being sure to use the .php extension at the end of the file name (eg. phpinfo.php). Then open the page with your browser.</p>
<table width="600" Border="1" bgcolor="cccccc"><tr><td>&lt;?php <br />echo phpinfo();
/&gt;</td></tr></table>
</div></li>

<li><div class="acc-content">
<p>
Does your server support cURL?.
<p>To keep things simple, we supplied you with code to meet the most widely used server settings which includes use of something called "cURL".  We need to verify that cURL is enabled. Having verified you have PHP installed in the previous step, search the PHPInfo page for the following section and verify cURL is enabled. Open the page with your browser. Click "Edit", click "Find" and enter the search term "CURL support" (without the quotes).
.</p>
<table width="600" border ="1" bgcolor="cccccc"><tr><td>
<br />curl
<br />CURL support enabled
<br />CURL Information libcurl/7.10.6 OpenSSL/0.9.7a ipv6 zlib/1.2.0.7
</td></tr></table>
</div>
</li>
<li><div class="acc-content">
<p>
If you don't have php available the script will not work on your website. If cURL is not enabled we suggest you first contact your hosting company to see if they will enable it. Most hosting companies enable it for security reasons anyway. If they don't then contact us and we have different code to accomodate some other settings</li>

<p><a href="#" onClick="ddaccordion.collapseall('technology'); return false">Collapse all</a>  | <a href="#" onClick="ddaccordion.expandall('technology'); return false">Expand all</a> 
</div></li>
</ul>

			</div>
		</div>
</div>
</div>


<div class="technology">Choose Your Code Format</div>
<div class="thelanguage">
<div class="acc-section">
			<div class="acc-content">
				<ul class="acc" id="nested">
					

<li>
 Format One
 <ol>
<li><div class="acc-content">
We provide a complete page, including top, side, and bottom menu areas
</div></li>
<li>
In it it has a fully functioning web directory complete with all our categories and links. It is dynamic, of course, and the links and categories are updated at each page load.
</li>
<li><div class="acc-content">
You add your graphics, menus links etc to the well defined areas to makre the page like your own website
</div></li>
</ol>
</li>
<li>
Format Two
<ol>	
<li><div class="acc-content">
We provide two pieces of code that you insert into one of your own webpage templates
</div></li>
<li><div class="acc-content">
You place our web directory script "in between" your own web page replacing its content with our web directory.
</div>
</li>
<li><div class="acc-content">
It appears as one of your own webpages.
</div></li>
</ol>

<div>	
<a href="#" onClick="ddaccordion.collapseall('technology'); return false">Collapse all</a>  | <a href="#" onClick="ddaccordion.expandall('technology'); return false">Expand all</a> 

</div>
					</li>
				</ul>

			</div>
		</div>
</div>
</div>
<div class="technology">Format One Install Instructions</div>
<div class="thelanguage">
<div class="acc-section">
			<div class="acc-content">
				<ul class="acc" id="nested">
					<li>
Create a blank page, in the folder you designated (i.e located and named like this - <?echo $_GET['url']."/".$_GET['folder_name'] . "/".$_GET['file_name'] ?> . </li>
<li>
Copy the code from the <b>GREY</b> area of the table below named "Format One Generates a Complete Page"</li>
<li>
Paste that code into your blank page, making sure to over write any code that is in the page (some editors add basic html code to new pages even though they appear blank when viewed in a browser.)</li>
<li>
Save the page and view it. The web directory should be functioning. If not, check out the Troubleshooting section below</li>
<li>

<a href="#" onClick="ddaccordion.collapseall('technology'); return false">Collapse all</a>  | <a href="#" onClick="ddaccordion.expandall('technology'); return false">Expand all</a> 
</li>
</div>
					</li>
				</ul>

			</div>
		</div>

</div>





<div class="technology">Format Two Install Instructions</div>
<div class="thelanguage">
<div class="acc-section">
			<div class="acc-content">
				<ul class="acc" id="nested">
					<li>
					Copy and paste or save your template page to the folder you designated (i.e located and named like this - <?echo $_GET['url']."/".$_GET['folder_name'] . "/".$_GET['file_name'] ?> . </li>

							
					</li>
					<li>
					Copy the code from the <b>Light Blue</b> area of the table below named "Part One of Format Two Code"	
						
					</li>
					<li>
					Paste that code into your template page, overwriting all of its code from the closing &lt;head&gt; tag all the way back to the very beginning of the page. Be sure to leave the closing &lt;/head&gt; however.
						
					</li>
					<li>
					In between the code you just pasted and the closing &lt;/head&gt; tag you can insert your own meta tag information such as CSS, author, robot instructs (follow:no follow etc)	DO NOT insert Title, description, or keywords, however, as the script generates these dynamically, inserting the category names and your custom configurations in each page. View the source code once the script is operating to see.
					</li>
<li>
Copy the code from the <b>Light Green</b> area of the table below named "Part Two of Format Two"							
</li>
<li>Paste that code anywhere in between your template page's &lt;body&gt; tags. The only caution is to make sure not to disturb your template page's table structure. Be sure to insert in between the pairs of tags. Google html tables or use our contact form if you have any problems.
<p>
	<a href="#" onClick="ddaccordion.collapseall('technology'); return false">Collapse all</a>  | <a href="#" onClick="ddaccordion.expandall('technology'); return false">Expand all</a> 

						
						
					</li>
				</ul>

			</div>
		</div></div>

	
<div class="technology">Troubleshooting</div>
<div class="thelanguage">
<div class="acc-section">
			<div class="acc-content">
				<ul class="acc" id="nested">
					<li>
						All the code you pasted is visible when viewed in the browser
						<ol><li>Possible cause - You didn't copy all the code from the blocks. PHP is activate when the server finds the &lt;? tag and closes the php when it encounters the ?&gt; tag. If those were left off of what you pasted it would produce symptoms like what is described</li>
<li>Possible cause 2 - Your server doesn't have PHP. Did you perform the second item under "The Basics" heading?</li></ol>

</li>
					<li>
						The directory displays, but the links don't work?
<ol><li>Possible cause - missing affiliate number - check the pages source code. Look for &quot;&#36;affiliate_num =&quot; make sure your affiliate or link number is there and is correct. The number should appear at the top of this page also. If not, please contact the administrator and report the problem. </li>
<li>Possible cause 2 - Mouseover the category names and notice the urls that they have. Do they contain your correct url? If not, then you have to resubmit your website info
</ol>
					</li><a href="#" onClick="ddaccordion.collapseall('technology'); return false">Collapse all</a>  | <a href="#" onClick="ddaccordion.expandall('technology'); return false">Expand all</a> 

						
						
					</li>
				</ul>

			</div>
		</div></div>

	






	





</div>


</body></html>
