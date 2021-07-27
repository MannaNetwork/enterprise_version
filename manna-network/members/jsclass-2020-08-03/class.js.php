<?php
class js {

	// JS CLASS
	// --------
	// Pierre FAUQUE, pierre@fauque.net
	// Role : Production of Javascript for forms verification
	// Version 0.1 July 17, 2020 (coded in july from 12 to 15, 2020)
	// Encoding : ANSI

	// <WARNING>
	// This Class is only available from :
	// - my website (http://www.fauque.fr/downloads.php)
	// - PHP Classes (http://www.phpclasses.org) (prefered site)
	// If you have downloaded it from another website, probably
	// you do not have the lastest version. To avoid using any
	// obsolete version, please refer to the original repositories.
	// You aren't authorized to delete this warning from this script.
	// </WARNING> 

	private $tocopy = 1;  // 1: To Copy/Paste the javascript produced, 0: to include class in the page
	private $debug  = 0;  // 1: For debugging, displays the different arrays, 0: to produce the javascript

	private $TXT    = array(
			'IEAF'  => "Incorrect email address format !",
			'LONG'  => "Too long input:\\nMax : ",
			'SHORT' => "Too short input:\\nMin : ",
			'MISSD' => "Missing data !",
			'FORB'  => "Forbidden characters !",
			'INCD'  => "Incorrect day !",
			'INCM'  => "Incorrect month !",
			'INCY'  => "Incorrect year !",
			'INCH'  => "Incorrect hours !",
			'INCN'  => "Incorrect minutes !",
			'INCS'  => "Incorrect seconds !",
			'MAX24' => "Max is 24h !",
			'NCHK'  => "Not checked !",
			'IDF'   => "Incorrect date format !",
			'IHF'   => "Incorrect hour format !",
			'ALOC'  => "At least one choice !",
			'VALID' => "You must validate to continue !"
			);
	private $sign    = "(c) Pierre FAUQUE : js script (feb 2006), php class (jul 2020)";
	private $form    = "";      // Name of the form (to read the form.ini file)
	private $ini     = array(); // Content of INI file
	private $types   = array(); // Types of fields (according to the class, not HTML)
	private $prefix  = "ac";    // Prefix for variables holdting (a)uthorized (c)haracters
	private $nbf     = 0;       // Number of form fields
	private $ascii   = "abcdefghijklmnopqrstuvwxyz";
	private $letters = "abcdefghijklmnopqrstuvwxyzàâäéèêëîïùûüÿçñ";
	private $digits  = "0123456789";


	// ========= CONSTRUCTOR ======================================

	public function __construct($form,$copy=1) {
		$this->form = $form;
		$this->tocopy = $copy;
		$inifile = "$form.ini";
		$hf = fopen("$inifile","r");
		$this->readIni($hf);
		fclose($hf);
		if($this->debug) { $this->tocopy = 1; } // When debugging, write in text/plain
		$this->writeAllJavascript();
	}

	// ========= READ THE FORM.INI FILE ===========================

	// --- blank lines or lines beginning by ; or # are comments
	private function isComment($line) {
		if(strlen($line) == 0) { return true; }
		if($line[0] == ";") { return true; }
		if($line[0] == "#") { return true; }
		return false;
	}

	// --- Read the form.ini file
	private function readIni($hf) {
		while(!feof($hf)) {
			$line=trim(fgets($hf,1024));
			if(!$this->isComment($line)) {
				if(preg_match("/^\[.+\]$/",$line)) {
					$item = strtolower(substr($line,1,-1)); }
				else {
					if($item == "fields") {
						$this->ini["fields"][] = $line; }
					else {
						$pos = strpos($line,"=");
						$var = substr($line,0,$pos);
						$val = substr($line,$pos+1,strlen($line));
						$this->ini[$item][$var] = $val;
					}
				}
			}
		}
		$this->lookfortypes();  // What functions have to be written
		$this->lookforhour();   // To prepare functions about verification of hour according to the type (4 or 6 digits)
		$this->lookfordate();   // To prepare functions about verification of date according to the format of the country
		if($this->tocopy) { header("content-type: text/plain"); }
		if($this->debug)  { $this->debug(); } // When debugging, show and die.
	}

	// ========= PREPARE TO WRITE THE JAVASCRIPT ==================

	// --- Store the different types of field according to the class
	private function lookfortypes() {
		foreach($this->ini["fields"] as $key => $value) {
			$tabval = explode(",", $value);
			$this->types[] = $tabval[2];
		}
	}

	// --- Format and RegExp according to hour with 4 or 6 digits
	private function lookforhour() {
		$nbdigits = $this->ini["general"]["hour"];
		switch($nbdigits) {
			case 4:
				$this->ini["general"]["fmthour"] = "HH:MN";
				$this->ini["general"]["regexph"] = "^[0-9]{2}[:]{1}[0-9]{2}$";
				break;
			case 6:
				$this->ini["general"]["fmthour"] = "HH:MN:SS";
				$this->ini["general"]["regexph"] = "^[0-9]{2}[:]{1}[0-9]{2}[:]{1}[0-9]{2}$";
				break;
		}
	}

	// --- format, separator, RegExp and ID for date according to the indicated country
	private function lookfordate() {
		$tld[] = 'al,ar,au,at,be,bo,br,bg,ca,cl,co,hr,es,ee,ec,fr,gr,gy,hk,in,ie,il,it,lv,mo,ma,mx,nz,py,nl,pl,pt,pe,ro,gb,ru,do,cz,sg,sk,si,th,tr,uy,ve';
		$tld[] = 'ch,ua';
		$tld[] = 'dk,no,se';
		$tld[] = 'usa';
		$tld[] = 'za,sa,am,az,bh,cn,cy,kr,dj,ae,er,hk,iq,ir,il,jp,jo,kw,lb,ly,lt,om,qa,sy,tw,ye,mysql';
		$tld[] = 'hu';
		$tld[] = 'de,fi,eu';
		$tld[] = 'iso';
		$n = 0;
		while (strpos($tld[$n],$this->ini["general"]["ctrydate"]) === false) { $n++; }
		switch($n) {
			case 0:
				$this->ini["general"]["sepdate"] = "/";
				$this->ini["general"]["typdate"] = 0;
				$this->ini["general"]["fmtdate"] = "DD/MM/YYYY";
				$this->ini["general"]["regexpd"] = "^[0-9]{2}[/]{1}[0-9]{2}[/]{1}[0-9]{4}\$";
				break;
			case 1:
				$this->ini["general"]["sepdate"] = ".";
				$this->ini["general"]["typdate"] = 1;
				$this->ini["general"]["fmtdate"] = "DD.MM.YYYY";
				$this->ini["general"]["regexpd"] = "^[0-9]{2}[.]{1}[0-9]{2}[.]{1}[0-9]{4}\$";
				break;
			case 2:
				$this->ini["general"]["sepdate"] = "/-";
				$this->ini["general"]["typdate"] = 2;
				$this->ini["general"]["fmtdate"] = "DD/MM-YY";
				$this->ini["general"]["regexpd"] = "^[0-9]{2}[/]{1}[0-9]{2}[-]{1}[0-9]{2}\$";
				break;
			case 3:
				$this->ini["general"]["sepdate"] = "-";
				$this->ini["general"]["typdate"] = 3;
				$this->ini["general"]["fmtdate"] = "MM-DD-YY";
				$this->ini["general"]["regexpd"] = "^[0-9]{2}[-]{1}[0-9]{2}[-]{1}[0-9]{2}\$";
				break;
			case 4:
				$this->ini["general"]["sepdate"] = "-";
				$this->ini["general"]["typdate"] = 4;
				$this->ini["general"]["fmtdate"] = "YYYY-MM-DD";
				$this->ini["general"]["regexpd"] = "^[0-9]{4}[-]{1}[0-9]{2}[-]{1}[0-9]{2}\$";
				break;
			case 5:
				$this->ini["general"]["sepdate"] = ".";
				$this->ini["general"]["typdate"] = 5;
				$this->ini["general"]["fmtdate"] = "YYYY.MM.DD";
				$this->ini["general"]["regexpd"] = "^[0-9]{4}[.]{1}[0-9]{2}[.]{1}[0-9]{2}\$";
				break;

			case 6:
				$this->ini["general"]["sepdate"] = ".";
				$this->ini["general"]["typdate"] = 6;
				$this->ini["general"]["fmtdate"] = "D.M.YYYY";
				$this->ini["general"]["regexpd"] = "^[0-9]{1,2}[.]{1}[0-9]{1,2}[.]{1}[0-9]{4}\$";
				break;
			case 7:
				$this->ini["general"]["sepdate"] = "";
				$this->ini["general"]["typdate"] = 7;
				$this->ini["general"]["fmtdate"] = "YYYYMMDD";
				$this->ini["general"]["regexpd"] = "^[0-9]{8}\$";
				break;
		}
	}

	// ========= WRITE THE JAVASCRIPT =============================

	// --- Write the javascript : basic functions, authorized characters, verif function 
	private function writeAllJavascript() {
		echo "<script language=\"javascript\" type=\"text/javascript\">\n";
		echo "\n// $this->sign\n";
		echo "// The fonctions is...() return TRUE or FALSE\n";
		echo "// The functions isValid...() return \"OK\" or an \"Error message\"\n";
		$this->writeBasicFn();
		$this->writeAuthorizedChars();
		$this->writeVerif();
		echo "</script>\n";
	}

	// --- Among the basic functions available, which we need ? Write basic variables.
	private function writeBasicFn() {

		$fn["ischarinlist"] = 0;
		$fn["isstringinlist"] = 0;
		$fn["istld"] = 0;
		$fn["isemail"] = 0;
		$fn["isdate"] = 0;
		$fn["ishour"] = 0;
		$fn["isvaliddate"] = 0;
		$fn["isvalidhour"] = 0;
		$fn["isvalidtext"] = 0;
		$nbf = count($this->types);

		for($n=0; $n<$nbf; $n++) {
			switch($this->types[$n]) {
				case 'text':
				case 'num':
					$fn["ischarinlist"] = 1;
					$fn["isstringinlist"] = 1;
					$fn["isvalidtext"] = 1;
					break;
				case 'date':
					$fn["isdate"] = 1;
					$fn["isvaliddate"] = 1;
					break;
				case 'hour':
					$fn["ishour"] = 1;
					$fn["isvalidhour"] = 1;
				case 'mail':
					$fn["ischarinlist"] = 1;
					$fn["isstringinlist"] = 1;
					$fn["istld"] = 1;
					$fn["isemail"] = 1;
					$fn["isvalidtext"] = 1;
					break;
				// case 'list':      in writeTestsFields()
				// case 'radio':     in writeTestsFields()
				// case 'checkbox':  in writeTestsFields()
				// case 'valid':     in writeTestsFields()
			}
		}

		if($fn["ischarinlist"])   { $this->js_ischarinlist(); }
		if($fn["isstringinlist"]) { $this->js_isstringinlist(); }
		if($fn["istld"])          { $this->js_istld(); }
		if($fn["isemail"])        { $this->js_isemail(); }
		if($fn["isdate"])         { $this->js_isdate(); }
		if($fn["ishour"])         { $this->js_ishour(); }
		if($fn["isvaliddate"])    { $this->js_isvaliddate(); }
		if($fn["isvalidhour"])    { $this->js_isvalidhour(); }
		if($fn["isvalidtext"])    { $this->js_isvalidtext(); }

		echo "\n//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		echo "// Definition of basic characters\n";
		echo "var ascii   = \"$this->ascii\";\n";
		echo "var letters = \"$this->letters\";\n";
		echo "var digits  = \"$this->digits\";\n";
	}

	// --- Write the authorized characters
	private function writeAuthorizedChars() {
		echo "\n// Authorized Characters\n";
		foreach($this->ini["chars"] as $key => $value) {
			echo "var ".$this->prefix."_$key = $value;\n";
		}
	}

	// --- Write the verif function
	private function writeVerif() {
		echo "\n\nfunction verif() {\n";
		$this->writeJSvars();
		$this->writeTestsFields();
		echo "\n\treturn true;\n\n";
		echo "}\n";
	}

	// --- Write the value of the javascript variable in the verif function
	private function writeJSvars() {
		$nbf = count($this->ini["fields"]);
		echo "\n\t// Fields value ($nbf fields)\n";
		$this->nbf = $nbf;
		$formname = $this->ini["form"]["name"];
		for($n=0; $n<$nbf; $n++) {
			$tabf = explode(",", $this->ini["fields"][$n]);
			if(isset($tabf[0])) { $field = $tabf[0]; } else { $field = ""; }
			if(isset($tabf[2])) { $type  = $tabf[2]; } else { $type  = ""; }
			switch($tabf[2]) {
				case 'num':
				case 'text':
				case 'date':
				case 'hour':
				case 'mail':
					echo "\tvar $field = document.$formname.$field.value;\n";
					break;
				case 'list':
					echo "\tvar $field = document.$formname.$field.options[document.$formname.$field.options.selectedIndex].value;\n";
					break;
			}
		}
	}

	// --- Write the various tests of fields in the verif function
	private function writeTestsFields() {
		// ;fieldname,labelname,fieldtype,mandatory(1) or not(0),lgmin,lgmax
		// lname;Last name,text,1,2,25
		$formname = $this->ini["form"]["name"];
		$fields = $this->ini["fields"];
		for($n=0; $n<$this->nbf; $n++) {

			$tab  = "";
			$tabf = explode(",", $fields[$n]);
			if(isset($tabf[0])) { $field  = $tabf[0]; } else { $field = ""; }
			if(isset($tabf[1])) { $label  = $tabf[1]; } else { $label = ""; }
			if(isset($tabf[2])) { $type   = $tabf[2]; } else { $type = ""; }
			if(isset($tabf[3])) { $need   = $tabf[3]; } else { $need = 0; }
			if(isset($tabf[4])) { $lgmin  = $tabf[4]; } else { $lgmin = 0; }
			if(isset($tabf[5])) { $lgmax  = $tabf[5]; } else { $lgmax = 0; }
			if(isset($tabf[6])) { $valmin = $tabf[6]; } else { $valmin = 0; }
			if(isset($tabf[7])) { $valmax = $tabf[7]; } else { $valmax = 0; }

			switch($type) {
				case 'text':
					if(!$need) { $comment = ". Optional"; }  else { $comment = ". Required"; }
					echo "\n\t// ----- $label, text$comment\n";
					if($need) {
						echo "\tif(!$field) {\n";
						echo "\t\talert(\"$label : ".$this->TXT['MISSD']."\");\n";
						echo "\t\tdocument.$formname.$field.focus();\n";
						echo "\t\treturn false;\n";
						echo "\t}\n"; }
					else {
						$tab = "\t";
						echo "\tif($field) {\n";
					}
					echo "\t$tab"."msg = isValidText($field,".$this->prefix."_$field,$lgmin,$lgmax);\n";
					echo "\t$tab"."if(msg != \"OK\") {\n";
					echo "\t\t$tab"."alert(\"$label : \"+msg);\n";
					echo "\t\t$tab"."document.$formname.$field.focus();\n";
					echo "\t\t$tab"."return false;\n";
					echo "\t$tab}\n";
					if(!$need) { echo "\t}\n"; }
					break;

				case 'num':
					if(!$need) { $comment = ". Optional"; }  else { $comment = ". Required"; }
					echo "\n\t// ----- $label, text/num$comment\n";
					if($need) {
						echo "\tif(!$field) {\n";
						echo "\t\talert(\"$label : ".$this->TXT['MISSD']."\");\n";
						echo "\t\tdocument.$formname.$field.focus();\n";
						echo "\t\treturn false;\n";
						echo "\t}\n"; }
					else {
						$tab = "\t";
						echo "\tif($field) {\n";
					}
					echo "\t$tab"."msg = isValidText($field,".$this->prefix."_$field,$lgmin,$lgmax);\n";
					echo "\t$tab"."if(msg != \"OK\") {\n";
					echo "\t\t$tab"."alert(\"$label : \"+msg);\n";
					echo "\t\t$tab"."document.$formname.$field.focus();\n";
					echo "\t\t$tab"."return false;\n";
					echo "\t$tab}\n";
					echo "\t$tab"."if($valmax > $valmin) {\n";
					echo "\t\t$tab"."if($field*1 <= $valmin || $field*1 >= $valmax) {\n";
					echo "\t\t\t$tab"."alert(\"$label : Out of limits\");\n";
					echo "\t\t\t$tab"."document.$formname.$field.focus();\n";
					echo "\t\t\t$tab"."return false;\n";
					echo "\t\t$tab}\n";
					echo "\t$tab}\n";
					if(!$need) { echo "\t}\n"; }
					break;

				case 'date':
					if(!$need) { $comment = ". Optional"; }  else { $comment = ". Required"; }
					echo "\n\t// ----- $label, text/date$comment\n";
					if($need) {
						echo "\tif(!$field) {\n";
						echo "\t\talert(\"$label : ".$this->TXT['MISSD']."\");\n";
						echo "\t\tdocument.$formname.$field.focus();\n";
						echo "\t\treturn false;\n";
						echo "\t}\n"; }
					else {
						$tab = "\t";
						echo "\tif($field) {\n";
					}
					echo "\t$tab"."msg = isValidDate($field);\n";
					echo "\t$tab"."if(msg != \"OK\") {\n";
					echo "\t\t$tab"."alert(\"$label : \"+msg);\n";
					echo "\t\t$tab"."document.$formname.$field.focus();\n";
					echo "\t\t$tab"."return false;\n";
					echo "\t$tab}\n";
					if(!$need) { echo "\t}\n"; }
					break;

				case 'hour':
					if(!$need) { $comment = ". Optional"; }  else { $comment = ". Required"; }
					echo "\n\t// ----- $label, text/hour$comment\n";
					if($need) {
						echo "\tif(!$field) {\n";
						echo "\t\talert(\"$label : ".$this->TXT['MISSD']."\");\n";
						echo "\t\tdocument.$formname.$field.focus();\n";
						echo "\t\treturn false;\n";
						echo "\t}\n"; }
					else {
						$tab = "\t";
						echo "\tif($field) {\n";
					}
					echo "\t$tab"."msg = isValidHour($field);\n";
					echo "\t$tab"."if(msg != \"OK\") {\n";
					echo "\t\t$tab"."alert(\"$label : \"+msg);\n";
					echo "\t\t$tab"."document.$formname.$field.focus();\n";
					echo "\t\t$tab"."return false;\n";
					echo "\t$tab}\n";
					if(!$need) { echo "\t}\n"; }
					break;

				case 'list':
					if(!$need) { $comment = ". Optional"; }  else { $comment = ". Required"; }
					echo "\n\t// ----- $label, list$comment\n";
					if($need) {
						echo "\tif($field == \"null\") {\n";
						echo "\t\talert(\"$label : ".$this->TXT['MISSD']."\");\n";
						echo "\t\tdocument.$formname.$field.focus();\n";
						echo "\t\treturn false;\n";
						echo "\t}\n";
					}
					break;

				case 'mail':
					if(!$need) { $comment = ". Optional"; }  else { $comment = ". Required"; }
					echo "\n\t// ----- $label, text/mail$comment\n";
					if($need) {
							echo "\tif(!$field) {\n";
							echo "\t\talert(\"$label : missing\");\n";
							echo "\t\tdocument.$formname.$field.focus();\n";
							echo "\t\treturn false;\n";
							echo "\t}\n"; }
					else {
							$tab = "\t";
							echo "\tif($field) {\n";
					}
					echo "\t$tab"."msg = isValidText($field,".$this->prefix."_$field,$lgmin,$lgmax);\n";
					echo "\t$tab"."if(msg != \"OK\") {\n";
					echo "\t\t$tab"."alert(\"$label : \"+msg);\n";
					echo "\t\t$tab"."document.$formname.$field.focus();\n";
					echo "\t\t$tab"."return false;\n";
					echo "\t$tab}\n";
					echo "\t$tab"."if(!isEmail($field)) {\n";
					echo "\t\t$tab"."msg = \"".$this->TXT['IEAF']."\";\n";
					echo "\t\t$tab"."alert(\"$label : \"+msg);\n";
					echo "\t\t$tab"."document.$formname.$field.focus();\n";
					echo "\t\t$tab"."return false;\n";
					echo "\t$tab"."}\n";
					if(!$need) { echo "\t}\n"; }
					break;

				case 'radio':
					if(!$need) { $comment = ". Optional"; }  else { $comment = ". Required"; }
					echo "\n\t// ----- $label, radio$comment\n";
					if($need) {
						echo "\tcheck=0;\n";
						echo "\tfor(i=0; i<document.$formname.$field.length; i++) {\n";
						echo "\t\tif(document.$formname.$field".chr(91).'i'.chr(93).".checked) {\n";
						echo "\t\t\t$field = document.$formname.$field".chr(91).'i'.chr(93).".value;\n";
						echo "\t\t\tcheck = 1;\n";
						echo "\t\t}\n";
						echo "\t}\n";
						echo "\tif(check === 0) {\n";
						echo "\t\talert(\"$label : ".$this->TXT['NCHK']."\");\n";
						echo "\t\treturn false;\n";
						echo "\t}\n";
					}
					break;

				case 'checkbox':
					if(!$need) { $comment = ". Optional"; }  else { $comment = ". Required"; }
					echo "\n\t// ----- $label, checkbox$comment\n";
					if($need) {
						echo "\tnb = 0;\n";
						$boxes = explode(";",$field);
						$nbboxes = count($boxes);
						for($i=0; $i<$nbboxes; $i++) {
							echo "\tif(document.$formname.".$boxes[$i].".checked) { nb++; }\n";
						}
						echo "\tif(!nb) {\n";
						echo "\t\talert(\"$label : ".$this->TXT['ALOC']."\");\n";
						echo "\t\treturn false;\n";
						echo "\t}\n";
					}
					break;

				case 'valid':
					if(!$need) { $comment = ". Optional"; }  else { $comment = ". Required"; }
					echo "\n\t// ----- $label, checkbox/valid $comment\n";
					if($need) {
						echo "\tnb = 0;\n";
						echo "\tif(document.$formname.$field.checked) { nb++; }\n";
						echo "\tif(!nb) {\n";
						echo "\t\talert(\"$label : ".$this->TXT['VALID']."\");\n";
						echo "\t\treturn false;\n";
						echo "\t}\n";
					}
					break;
			}
		}		
	}

	// ========= LIBRARY OF BASIC FUNCTIONS =======================

	private function js_ischarinlist() {
		echo "\n//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		echo "// Return TRUE if the given character (c) is in the authorized list (list) and FALSE if not\n";
		echo "function isCharInList(c,list) {\n";
		echo "\tvar c,list;\n";
		echo "\tif (list.indexOf(c.toLowerCase()) < 0) { return false; } else { return true; }\n";
		echo "}\n";
	}

	private function js_isstringinlist() {
		echo "\n//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		echo "// Return TRUE if all characters of the (str)ing are in the authorized (list), FALSE if not\n";
		echo "function isStringInList(str,list) {\n";
		echo "\tvar str,list,n;\n";
		echo "\tfor (n=0; n<str.length; n++) {\n";
		echo "\t\tif (!isCharInList(str.substring(n,n+1),list)) { return false; }\n";
		echo "\t}\n";
		echo "\treturn true;\n";
		echo "}\n";
	}

	private function js_istld() {
		echo "\n//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		echo "// Return TRUE if the given characters correspond to a valid TLD, FALSE if not\n";
		echo "function isTLD(tld) {\n";
		echo "\tvar tld,domains;\n";
		echo "\tdomains = \"com|net|int|org|edu|mil|gov|af|al|dz|as|ad|ao|ai|aq|ag|ar|am|aw|ac|au|at|\"\n";
		echo "\t        + \"az|bh|bd|bb|by|be|bz|bj|bm|bt|bo|ba|bw|bv|br|io|bn|bg|bf|bi|gg|je|kh|cm|ca|\"\n";
		echo "\t        + \"cv|ky|td|cl|cn|cx|cc|co|km|cg|ck|cr|ci|hr|cf|cu|cy|cz|dk|dj|dm|do|tp|ec|eg|\"\n";
		echo "\t        + \"sv|gq|er|ee|et|fk|fo|fj|fi|gf|pf|tf|fr|fx|ga|gm|ge|de|gh|gi|gr|gl|gd|gp|gu|\"\n";
		echo "\t        + \"gt|gn|gw|gy|ht|hm|hn|hk|hu|is|in|id|ir|iq|ie|im|il|it|jm|jp|jo|kz|ke|ki|kp|\"\n";
		echo "\t        + \"kr|kw|kg|la|lv|lb|ls|lr|ly|li|lt|lu|mo|mk|mg|mw|my|mv|ml|mt|mh|mq|mr|mu|yt|\"\n";
		echo "\t        + \"mx|fm|md|mc|mn|ms|ma|mz|mm|mp|na|nr|np|an|nl|nc|nz|ni|ne|ng|nu|nf|no|om|pk|\"\n";
		echo "\t        + \"pw|pa|pg|py|pe|ph|pn|pl|pt|pr|qa|re|ro|ru|rw|gs|lc|ws|sm|st|sa|sn|sc|sl|sg|\"\n";
		echo "\t        + \"sk|si|sb|so|za|es|lk|sh|kn|pm|vc|sd|sr|sj|sz|se|ch|sy|tw|tj|tz|th|bs|tg|tk|\"\n";
		echo "\t        + \"to|tt|tn|tr|tm|tc|tv|um|ug|ua|uk|us|uy|ae|uz|vu|va|ve|vn|vg|vi|wf|eh|ye|yu|\"\n";
		echo "\t        + \"zr|zm|zw|eu|\"\n";
		echo "\t        + \"biz|info|aero\";\n";
		echo "\tif (domains.indexOf(tld.toLowerCase()) < 0) { return false; } else { return true; }\n";
		echo "}\n";
	}

	private function js_isemail() {
		echo "\n//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		echo "// Return TRUE if the format of the email address is correct, FALSE if not\n";
		echo "// Login not null, must contain \"@\", a dot in the domain (not null) and a valid TLD\n";
		echo "function isEmail(address) {\n";
		echo "\tvar address,parts,domains;\n";
		echo "\tif (address.indexOf(\"@\") <= 0)         { return false; }\n";
		echo "\tparts = address.split(\"@\");\n";
		echo "\tif (parts[0].length == 0)              { return false; }\n";
		echo "\tif (parts[1].indexOf(\".\") <= 0)        { return false; }\n";
		echo "\tdomains = parts[1].split(\".\");\n";
		echo "\tif (!isTLD(domains[domains.length-1])) { return false; }\n";
		echo "\treturn true;\n";
		echo "}\n";
	}

	private function js_isdate() {
		$format = $this->ini["general"]["ctrydate"].": ".$this->ini["general"]["fmtdate"];
		echo "\n//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		echo "// Return TRUE if the date format is correct ($format), FALSE if not\n";
		echo "function isDate(date) {\n";
		// echo "\tvar date, reg = new RegExp(\"^[0-9]{2}[/]{1}[0-9]{2}[/]{1}[0-9]{4}$\",\"g\");\n";
		echo "\tvar date, reg = new RegExp(\"".$this->ini["general"]["regexpd"]."\",\"g\");\n";
		echo "\tif(reg.test(date)) { return true; } else { return false; }\n";
		echo "}\n";
	}

	private function js_ishour() {
		$format = $this->ini["general"]["fmthour"];
		echo "\n//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		echo "// Return TRUE if the hour format is correct ($format), FALSE if not\n";
		echo "function isHour(hour) {\n";
		echo "\tvar hour, reg = new RegExp(\"".$this->ini["general"]["regexph"]."\",\"g\");\n";
		echo "\tif(reg.test(hour)) { return true; } else { return false; }\n";
		echo "}\n";
	}

	private function js_isvaliddate() {
		// d = 1..31, D = 01-31 ; m = 1..12, M = 01.12 ; y = 19, Y = 2019
		$format = $this->ini["general"]["ctrydate"].": ".$this->ini["general"]["fmtdate"];
		echo "\n//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		echo "// Return \"OK\" if the date has a good format ($format)or an \"Error message\"\n";
		echo "function isValidDate(date) {\n";
		$typdate = $this->ini["general"]["typdate"];
		if($typdate != 2 && $typdate !=7) { echo "\tvar date,tab;\n"; } else { echo "\tvar date,d,m,y;\n"; }
		echo "\tif(isDate(date)) {\n";
		if($typdate != 2 && $typdate !=7) { 	echo "\t\ttab=date.split('".$this->ini["general"]["sepdate"]."');\n"; }
		switch($typdate) {
			case 0; // D/M/Y
			case 1: // D.M.Y
			case 6: // d.m.Y
				echo "\t\tif((tab[0]*1)<1 || (tab[0]*1)>31) { return \"".$this->TXT['INCD']."\"; }\n";
				echo "\t\tif((tab[1]*1)<1 || (tab[1]*1)>12) { return \"".$this->TXT['INCM']."\"; }\n";
				echo "\t\tif((tab[2]*1)<1) { return \"".$this->TXT['INCY']."\"; }\n";
				break;
			case 2: // D/M-y
				echo "\t\td = date.substr(0,2);\n";
				echo "\t\tm = date.substr(3,2);\n";
				echo "\t\ty = date.substr(6,2);\n";
				echo "\t\tif((d*1)<1 || (d*1)>31) { return \"".$this->TXT['INCD']."\"; }\n";
				echo "\t\tif((m*1)<1 || (m*1)>12) { return \"".$this->TXT['INCM']."\"; }\n";
				echo "\t\tif((y*1)<1) { return \"".$this->TXT['INCY']."\"; }\n";
				break;
			case 3: // M-D-Y
				echo "\t\tif((tab[0]*1)<1 || (tab[0]*1)>12) { return \"".$this->TXT['INCM']."\"; }\n";
				echo "\t\tif((tab[1]*1)<1 || (tab[1]*1)>31) { return \"".$this->TXT['INCD']."\"; }\n";
				echo "\t\tif((tab[2]*1)<1) { return \"".$this->TXT['INCY']."\"; }\n";
				break;
			case 4: // Y-M-D
			case 5: // Y.M.D
				echo "\t\tif((tab[0]*1)<1) { return \"".$this->TXT['INCY']."\"; }\n";
				echo "\t\tif((tab[1]*1)<1 || (tab[1]*1)>12) { return \"".$this->TXT['INCM']."\"; }\n";
				echo "\t\tif((tab[2]*1)<1 || (tab[2]*1)>31) { return \"".$this->TXT['INCD']."\"; }\n";
				break;
			case 7: // YMD
				echo "\t\ty = date.substr(0,4);\n";
				echo "\t\tm = date.substr(4,2);\n";
				echo "\t\td = date.substr(6,2);\n";
				echo "\t\tif((y*1)<1) { return \"".$this->TXT['INCY']."\"; }\n";
				echo "\t\tif((m*1)<1 || (m*1)>12) { return \"".$this->TXT['INCM']."\"; }\n";
				echo "\t\tif((d*1)<1 || (d*1)>31) { return \"".$this->TXT['INCD']."\"; }\n";
				break;
		}
		echo "\t\treturn \"OK\";\n";
		echo "\t}\n";
		echo "\treturn \"".$this->TXT['IDF']."\";\n";
		echo "}\n";

	}

	private function js_isvalidhour() {
		$nbdigits = $this->ini["general"]["hour"];
		$format = $this->ini["general"]["fmthour"];
		echo "\n//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		echo "// Return \"OK\" if the hour has a good format ($format) or an \"Error message\"\n";
		echo "function isValidHour(hour) {\n";
		echo "\tvar hour, tab;\n";
		echo "\tif(isHour(hour)) {\n";
		echo "\t\ttab=hour.split(':');\n";
		switch($nbdigits) {
			case 4:
				echo "\t\tif((tab[0]*1)<0   || (tab[0]*1)>24) { return \"".$this->TXT['INCH']."\"; }\n";
				echo "\t\tif((tab[1]*1)<0   || (tab[1]*1)>60) { return \"".$this->TXT['INCN']."\"; }\n";
				echo "\t\tif((tab[0]*1)==24 && (tab[1]*1)!=0) { return \"".$this->TXT['MAX24']."\"; }\n";
				break;
			case 6:
				echo "\t\tif((tab[0]*1)<0   || (tab[0]*1)>24) { return \"".$this->TXT['INCH']."\"; }\n";
				echo "\t\tif((tab[1]*1)<0   || (tab[1]*1)>60) { return \"".$this->TXT['INCN']."\"; }\n";
				echo "\t\tif((tab[2]*1)<0   || (tab[2]*1)>60) { return \"".$this->TXT['INCS']."\"; }\n";
				echo "\t\tif((tab[0]*1)==24 && ((tab[1]*1)!=0 || (tab[2]*1)!=0)) { return \"".$this->TXT['MAX24']."\"; }\n";
				break;
		}
		echo "\t\treturn \"OK\";\n";
		echo "\t}\n";
		echo "\treturn \"".$this->TXT['IHF']."\";\n";
		echo "}\n";
	}

	private function js_isvalidtext() {
		echo "\n//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		echo "// Tests the validity of a text (length and authorized characters). \"OK\" or \"Error message\"\n";
		echo "function isValidText(field,chars,li,ls) {\n";
		echo "\tvar field,chars,li,ls,lg,msg;\n";
		echo "\tlg = field.length;\n";
		echo "\tif(li || ls) {\n";
		echo "\t\tif(lg < li) { msg = \"".$this->TXT['SHORT']."\"+li; return msg; }\n";
		echo "\t\tif(lg > ls) { msg = \"".$this->TXT['LONG']."\"+ls; return msg; }\n";
		echo "\t}\n";
		echo "\tif(!isStringInList(field,chars)) { msg = \"".$this->TXT['FORB']."\"; return msg; }\n";
		echo "\treturn \"OK\";\n";
		echo "}\n";
	}

	// ========= TOOLS ============================================

	// Show Arrays and die.
	public function debug() {
		print_r($this->ini);
		print_r($this->types);
		print_r($this->TXT);
		die();
	}

	// Write the date format
	public function fmtdate() {
		echo $this->ini["general"]["fmtdate"];
	}

	// Write the hour format
	public function fmthour() {
		echo $this->ini["general"]["fmthour"];
	}
}
/*
// --- Constructor
public function __construct($form,$copy=1)

// --- Read the form.ini file
private function isComment($line)
private function readIni($hf)

// --- Prepare to write the javascript
private function lookfortypes()
private function lookforhour()
private function lookfordate()

// --- Write the javascript
private function writeAllJavascript()
private function writeBasicFn()
private function writeAuthorizedChars()
private function writeVerif()
private function writeJSvars()
private function writeTestsFields()

// --- Library of basic functions
private function js_ischarinlist()
private function js_isstringinlist()
private function js_istld()
private function js_isemail()
private function js_isdate()
private function js_ishour()
private function js_isvaliddate()
private function js_isvalidhour()
private function js_isvalidtext()

// --- Tools
public function debug()
public function fmtdate()
public function fmthour()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Version history :
17-jul-2020 : v0.1   First (and public) version
*/
?>
