<h1 style="text-align:left;  color: white;">Trouble Shooting</h1>
<h2>Trouble With The Web Directory Installation</h2>

<p style="text-align:left; ">There are basically just three things that can go wrong with your installation
<ol><li>Your web directory and page location and/or name(s) are wrong in the configuration</li>
<li>Your web hosting company has settings that are preventing the web directory from communicating with the BungeeBones server</li>
<li>You accidentally erased or added extraneous code when you created your own template or when you added the blocks of BungeeBones code to it</li></ol>
<h3 style="text-align:left; ">1) Wrong Directory/Page Names or Configurations</h3>
<p style="text-align:left; ">This is the easiest problem to fix. Just check that the directory name and the page name AND EXTENSION are correct in stage one. You can go and edit them and make sure of spelling and especially that the page name uses the .php extension (ie. its name is something like "index.php").
<h3>2) Is php installed on your server? </h3>
<h3 style="text-align:left; " >3) Messed Up Code</h3>
<p style="text-align:left; ">Making sure that your own web page template functions properly before adding any BungeeBones code is crucial. So, assuming the template was working properly we then have to look for some error made when posting the code to the page. This can be a little bit trickier to track down. Sometimes the simplest things such as an extra or ommitted comma, parenthesis, quotes etc can be right in front of us and we keep missing it.

<h2 style="text-align:left; " >If Your Template Functions Properly W/O Bungeebones In It</h2>
<p style="text-align:left; ">The first thing I would do would be to <a href="#WDC">install the demo version</a>. It is very easy to do that. Rename the template page you just installed in to something OTHER than what you named it (make it a backup). Download, then upload and unzip the <a href="http://bungeebones.com/ftp/demo.zip">demo package</a> to quickly install the demo on your website. Open the folder and then the demo.php page in your browser. It should work. In other words you will see it work by visiting www.YOURSITE.com/demo/demo.php.

<h2 id="WDC">Did you originally install the files in the same location on your site as you told us you would in the first form? </h2>
<p style="text-align:left; ">If your demo is working properly in the demo folder rename the demo folder the same as what you configured in the first config form.  The demo should work right out of the box except for the one configuration change so  <a href="modal_test_srvr.php?link_id=<?php echo $_GET['link_id']; ?>">If you followed the directions for installing the demo</a> and you don't see a formatted web directory of categories but instead just a page full of strange looking text and characters then your server may not be properly set up for PHP. Test your server for compatability by going to (using your web browser) http:://YOUR_SITE.COM/demo/phpinfo.php (the phpinfo file was included in the zip and can be deleted after the test is complete if you wish). It should produce for you an information packed page that tells you all about the php settings on your hosting account. If you can read the page then your PHP is working.
<p style="text-align:left; ">Next, look in the PHPInfo page and check if cURL is installed. BungeeBones uses this third party software project called <a target="_blank" href="curl.haxx.se">CURL</a> which provides a library and command-line tool for securely transferring data between your server and our server. If your hosting company does not have CURL installed or activated in your account then BungeeBones will not work. 
<p style="text-align:left; ">To verify cURL is working look on the phpinfo.php page you just opened, scroll down through it or do a page search for a section about CURL. If it is installed you can't miss it. If it is not installed there will be no mention of it. If it isn't installed I suggest you contact your host and ask them to install it. It is quite easy to install but if for some reason they can't or won't then you have a problem. 
<p style="text-align:left; ">If your PHP and CURL are all installed and functioning correctly then check you renamed the demo.php <b>page</b> in the upload to exactly what you entered as the <b>page</b> name during the configuration in step one. Be sure it has the .php extension. 

<a href="#top">back to top</a>
