<h1>Branding the Web Directory To Your Own Look</h1>

<h2>General Overview</h2>
<a href='widget_barebones_version_code.php?link_selected=<?php echo $_GET['link_id'];?>' title='Get Your Web Directory Source Code' rel='gb_page_center[640, 480]'><div style=\"background-image: url('images960/1x1tran.gif'); background-repeat: repeat-x; background-color: white; color:navy; font-size:100%;-moz-border-radius: 15px;
		border-radius: 15px;text-align: center;\"><b>The BungeeBones Web Directory Source Code</b></a> comes as two blocks of code that need to be inserted into one of your own website page templates. One section of the code needs to be pasted into the "head" section and the other into the "body" section of the page. 
<h3>Resources On How To Make A Template Page From Your Own Website</h3>
<p style="text-align:left; ">If you don't already have a template I prepared <a target="_blank" href="http://bungeebones.com/articles/bungeebones_news-MAKE_TEMPLATE_TUT.php">this video </a>that gives a step by step tutorial about how to make one.</p>
<p><a target="_blank" href="make_template.php?link_selected='. $link_selected.'">Also, see a step-by-step tutorial with screenshots on how to make a website template here.</a> You can also use the contact form to contact us and we would be glad to assist you.</p>
<h1>Outline Of The Template Making Procedure</h1>
<h2>You will:</h2>
<ul><li>Locate the best page of your existing site to copy and adapt to use as the page template. The simpler the page the better.</li>
<li>Identify key locations in that code such as the head and body sections and remove unwanted content and code from the body section</li>
<li>After locating where you will locate the BungeeBones directory in the page remove unwanted content and mark the spot with some memorable, easy to find word or phrase so that you can find it easily again.</li>
<li>Test the page you made to make sure it displays correctly. 
<li><a href='widget_barebones_version_code.php?link_selected=<?php echo $_GET['link_id'];?>' title='Get Your Web Directory Source Code' rel='gb_page_center[640, 480]'><div style=\"background-image: url('images960/1x1tran.gif'); background-repeat: repeat-x; background-color: white; color:navy; font-size:100%;-moz-border-radius: 15px;
		border-radius: 15px;text-align: center;\"><b>Copy and paste the two blocks of code into that page in their respective locations (i.e. the body and head).</b></a></li>
<li>Test and verify the directory is working properly</li></ul>






<h3>Steps To Installing The BungeeBones Source Code</h3>
<ol>

<li>Starting with the source code of your selected template, you will need to "disassemble" some code from the template page before inserting the BungeeBones code. You should have already located the opening "body tag" and removed all the unwanted content marking where the web directory will be. </li>

<li>Save one copy of what you created as a backup, and then save another to the location that matches your settings in the first form. View the new page in the browser to make sure everything is still working correctly. As we proceed make sure you make backups as we progress in case you ever need to start over.</li>

<li>Copy and paste the first block of Bungeebones code into the "&lt;body&gt;" section of the page </li>
<li>Copy and paste the second block of code into the &lt;head&gt; section of the page (see Replacing The "Head Section" Code below</li>
</ol>



<h3 style="text-align:left; ">Replacing The "Head Section" Code</h3>
<p style="text-align:left; ">What you will be doing is replacing the first portion of your existing web page template code with the second block of Bungeebones code. By the "first portion" of the page I mean literally replacing code starting at the very beginning of the code to "a spot yet to be determined" in the head section but, in no case, ever replacing the closing head tag (the closing head tag looks like this - &lt;/head&gt;).
<p style="text-align:left; ">Within that first block of the Bungeebones code pasted on your page, everything from between the opening php tag (&lt;?php) to the second of the closing php tags (?&gt;) is crucial for operation. Beyond that closing php tag and the closing HTML head tag are, however, where you keep your own page's important code such as Java Script and CSS. 
<p style="text-align:left; ">Here is a list of some things that might be critical to the proper operation or display of your page and that you need to keep in the head section code (after the BungeeBones code):
<ul><li>CSS style links, code, urls etc.</li>
<li>Javascript and/or other scripts functions</li>
<li>"Analytics" code</li>
<li>Any other code unique to your template and that is already within the head section</li></ul>

<p style="text-align:left; ">So you should have left untouched all of your own needed head code and closing head tag.
<p style="text-align:left; ">Also worth mentioning is that BungeeBones comes with its own dynamic metatags for the head section. The <b>title, description, and keywords</b> are all dynamically built for each individual page that the web directory script displays. And later on, in step three, you also get to customize those metatags to your indivual website as well. Basically BungeeBones customizes the page to the category of links being displayed while your settings customize them to your website.



<h2 style="color: white;">Final Step - Tweaking Some Custom Configuration</h2>
<p style="text-align:left; "><b>After you have installed the directory, tested it and everything is working properly then you can make a number of customizations and brand it even more to your website by such things as:
<ul><li>Page Titles Custom To Your Website </li>
 <li>Page Titles Custom To The Category And Your Website </li>
<li>Page Header Meta Tags Custom To Your Website And To The Category </li>
<li>Custom "Add A Link" Buttons</li>
<li>Custom "Leaving Page" - notifies users 1) the web directory is 3rd party 2) they are leaving your site 3) you endorse BungeeBones</li>
<li>Select How/When/If Your Directory Displays Free Links</li>
<li>Select If Your Directory Links Are "NoFollow"</li>
<li>And More</li>
</ul>


