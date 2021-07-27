<?php

// We will be using this class to define each selectbox

class SelectBox{
	public $items = array();
	public $defaultText = '';
	public $title = '';
	
	public function __construct($title, $default){
		$this->defaultText = $default;
		$this->title = $title;
	}
	
	public function addItem($name, $connection = NULL){
		$this->items[$name] = $connection;
		return $this; 
	}
	
	public function toJSON(){
		return json_encode($this);
	}
}


/* Configuring the selectboxes */

// Product selectbox

$productSelect = new SelectBox('What would you like to purchase?','Choose a product category');
$productSelect->addItem('Phones','phoneSelect')
			  ->addItem('Notebooks','notebookSelect')
			  ->addItem('Tablets','tabletSelect');

// Phone types

$phoneSelect = new SelectBox('What kind of phone are you interested in?', 'Pick a phone type');
$phoneSelect->addItem('Smartphones','smartphoneSelect')
			->addItem('Feature phones','featurephoneSelect');

// Smartphones

$smartphoneSelect = new SelectBox('Which is your desired smartphone?','Choose a smartphone model');
$smartphoneSelect->addItem('Samsung Galaxy Nexus')
				 ->addItem('iPhone 4S','iphoneSelect')
				 ->addItem('Samsung Galaxy S2')
				 ->addItem('HTC Sensation');

// Feature phones

$featurephoneSelect = new SelectBox('Which is your desired featurephone?','Choose a feature phone');
$featurephoneSelect->addItem('Nokia N34')
				   ->addItem('Sony Ericsson 334')
				   ->addItem('Motorola');

// iPhone colors

$iphoneSelect = new SelectBox('What color would you like?','Choose a color');
$iphoneSelect->addItem('White')->addItem('Black');

// Notebook select

$notebookSelect = new SelectBox('Which notebook would you like to buy?', 'Choose a notebook model');
$notebookSelect->addItem('Asus Zenbook','caseSelect')
			   ->addItem('Macbook Air','caseSelect')
			   ->addItem('Acer Aspire','caseSelect')
			   ->addItem('Lenovo Thinkpad','caseSelect')
			   ->addItem('Dell Inspiron','caseSelect');

// Tablet select

$tabletSelect = new SelectBox('Which tablet would you like to buy?', 'Pick a tablet');
$tabletSelect->addItem('Asus Transformer','caseSelect')
			 ->addItem('Samsung Galaxy Tab','caseSelect')
			 ->addItem('iPad 16GB','caseSelect')
			 ->addItem('iPad 32GB','caseSelect')
			 ->addItem('Acer Iconia Tab','caseSelect');

// Case select

$caseSelect = new SelectBox('Buy protective casing?','');
$caseSelect->addItem('Yes')->addItem('No');


// Register all the select items in an array

$selects = array(
	'productSelect'			=> $productSelect,
	'phoneSelect'			=> $phoneSelect,
	'smartphoneSelect'		=> $smartphoneSelect,
	'featurephoneSelect'	=> $featurephoneSelect,
	'iphoneSelect'			=> $iphoneSelect,
	'notebookSelect'		=> $notebookSelect,
	'tabletSelect'			=> $tabletSelect,
	'caseSelect'			=> $caseSelect
);

// We look up this array and return a select object depending
// on the $_GET['key'] parameter passed by jQuery

// You can modify it to select results from a database instead

if(array_key_exists($_GET['key'],$selects)){
	header('Content-type: application/json');
	echo $selects[$_GET['key']]->toJSON();
}
else{
	header("HTTP/1.0 404 Not Found");
	header('Status: 404 Not Found');
}

?>