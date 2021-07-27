<?php

$settings['categories_table'] = 'categories'; //the name of the categories table
$settings['multi_level_table'] = 'multi_level'; //the name of the multi_level table
$settings['links_table_favs'] = 'social_network'; //the name of the categories table
$settings['links_table'] = 'links'; //the name of the links table
$settings['amm']=300;// sets the number of categories displayed per page
// the setting below MUST be an ODD NUMBER ONLY
$settings['num_max_links'] = 7;//sets the max number of links (to pages) displayed in the alpha menu
// when the number of pages 
$table_width = $settings['num_max_links'] * 125;//table width = how many pixels wide per displayed link in the menu
// it can be adjusted - the default would make each link 125 pixels wide 
$settings['substrlength'] = 2;//sets the number of letters in the alpha-pagination menu creator. The larger the number of records in the directory the larger the number needs to be
/*note: num_max_links and substrlength antagonize each other. You need either a high
num_max_links AND low substrlength, or low num_max_links AND high substrlength, or
a different combination of the two. As you increase the number of letters in a alph link the more room it takes
up. A good guide is that you don't want the display to be over 900 pixels wide for internet use*/
//LINK Pagination Settings
$settings['link_amm']=4;// sets the number of links displayed per page
/* other settings */
$settings['jump_links'] = false; // set to true if you want links to go through another script, this allows the program to track clicks
	$settings['nav_separator'] = ' &gt; '; //html character used to separate links in the navbar, default is a  ">" (&gt;)
	$settings['se_separator'] = ' _ '; //html character used to separate links in the navbar, default is a  ">" (&gt;)
	$settings['max_url_length'] = 70; // maximum URL length (must be under 255)
	$settings['max_title_length'] = 50; //maximum length for a link title (must be under 64)
	$settings['max_description_length'] = 255; //maximum length for a description
	$settings['index_file'] = 'http://bungeebones.com/link_exchange'; // the name of your index file. if you do not change the name, it is yald.php
	$settings['display_admin_link'] = false ; //set true or false to display an admin link on all pages
	$settings['home_link'] = 'http://bungeebones.com/'; //url to your site's home page
	$settings['use_captcha'] = false; //set to true of false. this will require users to enter text from an image before submitting a link. this will prevent robot submissions, but requires GD on your server
	$settings['list_type'] = '4'; // list by peer ranking in descneding order
?>
