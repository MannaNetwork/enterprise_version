<?php
//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 
$default_price = "0.00";//this is what charge is applied to any not having a price set in the database
$default_adj = "1";


require_once("../config/config.php");

    
// load the login class

// load php-login components
require_once("../php-login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

 
    
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...

$user_id = $_SESSION['user_id'];





if (isset($_GET['link_selected'])){
$link_selected=$_GET['link_selected'];
}
elseif (isset($_POST['link_selected'])){

$link_selected=htmlspecialchars($_POST['link_selected']);
}
$link_selected = rtrim($link_selected,"/");



include($_SERVER['DOCUMENT_ROOT']."/members/template_topy.php");
echo'
<table style = "margin-left:auto; 
    margin-right:auto;" width="50%" bgcolor="gray"><TR><TD>
<h1>Tutorial - How To Make A Web Page Template Of Your Website</h1>
<h2 style="color: black;">Prefer a video tutorial? See the list <a target="_blank" href="../../articles/bungeebones_news.php">here</a></h2>
<p style="text-align:left; font-size: 150%">A typical website will have a header image and perhaps a horizontal menu under that. It will often have a sidebar on the left side and often a menu there. Sometimes there is a sidebar on the right side but not always. And, lastly, there is usually a footer section at the bottom of the page. </p>
<p style="text-align:left; font-size: 150%">This tutorial will demonstrate how to grab all the code that creates all that and show where to install the source code of the BungeeBones web directory in it so that the web directory will display inside your website page\'s header, sidebars and footer.
<p style="text-align:left; font-size: 150%">The first step is to find one of your own web site\'s simplest and most basic pages you can. By "simplest and most basic" I mean one that doesn\'t have a lot of blocks or sections in the central, main part of the page. After you have located the page you want to use as your template right click on the page and look for the "view source" selection (in FireFox) or, in Internet Explorer click on the "View" menu in the top menubar and click on "Source". This will open a text window (usually Notepad) with the HTML source of the page you\'re looking at.
<p style="text-align:left; font-size: 150%">After you have copied the source code paste it to a new page using a text editor such as notepad. If your web host provides you a file manager and control panel with an editor then that most probably would be the easiest way for just this one page. Create a new page and paste the code you just copied. Save the page in the location you want the web directory to be. Check the page to make sure the page is displaying properly. 

<p style="text-align:left; font-size: 150%">Once you have the code of your page saved, use a copy of it as we start to replace parts of it with the BungeeBones code. Start by locating the code you need to replace. Use the picture below to locate the tags to replace. Move tags around within the head section if you have to in order to keep your important javascripts or css code. Fortunately, the tags we need to replace are usually all at the beginning of the page\'s code.
Once you know what to remove and what to keep, copy the first block of the BungeeBones source code available from the installations page Step 3 and replace the designated code in your template page in the head section.

</td></tr>
<tr><TD colspan="2">
<p style="text-align:left; font-size: 150%">Copy the first block of the barebones code in the head section. You will replacing the Doctype, opening html and head tags, the meta title, keywords, description tags.
YOU WON\"T be replacing the closing head tag, your css styling information. You probably won\'t be replacing or removing javascript.
<tr><TD colspan="2"><img src="images/template2.jpg"></TD></TR>
</td></tr>
<tr><TD colspan="2">



<p style="text-align:left; font-size: 150%">Then, with the second block of code OF the BareBones Version, paste it into the <body> part of the page. It may take a couple tries before you find the right location of where to paste the code SO DON\'T USE YOUR ORIGINAL TEMPLATE, USE A COPY. 

</TD></TR>



<tr><TD colspan="2"><img src="images/template.jpg"></TD></TR><tr><TD colspan="2">
<p style="text-align:left; font-size: 150%">Tip: pick out an easy to find "landmark" on the page in the vacinity of the AA and ZZ (in the image). Look for a rare word or phrase. Then search for those words in the source code and you will locate the beginning and end of the central block of the page.
<a target="_top" href="widget_index_custom.php?link_selected='.$link_selected.'"> <h2><u>Return To Installation Management Index</u></h2></a>
<a target="_top" href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>

</TD></tr></table>
';
include($_SERVER['DOCUMENT_ROOT']."/members/templatebottomnsb.php");


} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

