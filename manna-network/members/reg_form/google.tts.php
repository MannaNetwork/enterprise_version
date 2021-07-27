<?php
/**
 * +------------------------------------------------------------------------+
 * | google.text_to_speech.php                                              |
 * +------------------------------------------------------------------------+
 * | Copyright (c) Mahmut Namli 2006-2014. All rights reserved.             |
 * | Version       0.10                                                     |
 * | Last modified 10/01/2014                                               |
 * | Email         mahmudnamli@gmail.com                                    |
 * | Web           http://whiteeffect.com                                   |
 * +------------------------------------------------------------------------+
 * | This program is free software; you can redistribute it and/or modify   |
 * | it under the terms of the GNU General Public License version 2 as      |
 * | published by the Free Software Foundation.                             |
 * |                                                                        |
 * | This program is distributed in the hope that it will be useful,        |
 * | but WITHOUT ANY WARRANTY; without even the implied warranty of         |
 * | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the          |
 * | GNU General Public License for more details.                           |
 * |                                                                        |
 * | You should have received a copy of the GNU General Public License      |
 * | along with this program; if not, write to the                          |
 * |   Free Software Foundation, Inc., 59 Temple Place, Suite 330,          |
 * |   Boston, MA 02111-1307 USA                                            |
 * |                                                                        |
 * | Please give credit on sites that use google.tts and submit changes     |
 * | of the script so other people can use them as well.                    |
 * | This script is free to use, don't abuse.                               |
 * +------------------------------------------------------------------------+
 * 
 * This class can show you a text's speech using Google Translate.
 * 
 * But bear in mind that as of this is a free service, you're limited to 100 characters of the text
 * hence using $_GET method.
 * 
 * @version     0.10
 * @author      Mahmut Namli <mahmudnamli@gmail.com>
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright   Mahmut Namli
 * @package     any MVC or FW structure
 * @subpackage  external
 *
 */
class Google_TTS {
	
    /**
     * URL for google translate
     * 
     * @var string
     * @access public
     */
     public $googleTranslateURL = 'http://translate.google.com/translate_tts?ie=utf-8&tl=%s&q=%s';
	
    /**
     * This is for spoofing the header, but it's not effective yet.. It's experimental for this version of class..
     * 
     * @var array
     * @access public
     */
    public $ipForHeader = array();
    
    /**
     * Handles the value of returned MP3 encoded data.
     * 
     * @var binarydata
     * @access public
     */
    public $soundData;
	
    public function __construct() { }
	
    /**
     * Selects IP for spoofing the header
     * 
     * @param string $ipOrType - default rand
     * @return Google_TTS
     * @see http://dev.whiteeffect.com/metadata_informer/
     * @access public
     */
    public function headerIP($ipOrType = "random") {
    	if ($ipOrType == 'rand' || $ipOrType == 'random') {
    		/* This IP's has taken from http://dev.whiteeffect.com/metadata_informer/ for google.com.. */
    		$ipForHeader = array(
    			'173.194.43.38',
    			'173.194.44.46',
    			'173.194.70.100',
    			'74.125.229.160',
    			'74.125.229.174'
    		);
    		$chooseRand = rand(0, count($ipForHeader) - 1);
    		$this->ipForHeader = $ipForHeader[$chooseRand];
    	}
    	return $this;
    }
    
    /**
     * Google Translate available languages
     *
     * @var array
     * @access public
     */
    public $languages = array(
	'ar'    =>'arabic',
    	'bg'    =>'bulgarian',
    	'ca'    =>'catalan',
    	'zh'    =>'chinese',
    	'zh-CN' =>'chinese_simplified',
    	'zh-TW' =>'chinese_traditional',
    	'hr'    =>'croatian',
    	'cs'    =>'czech',
    	'da'    =>'danish',
    	'nl'    =>'dutch',
    	'en'    =>'english',
    	'fi'    =>'finnish',
    	'fr'    =>'french',
    	'de'    =>'german',
    	'el'    =>'greek',
    	'iw'    =>'hebrew',
    	'hi'    =>'hindi',
    	'id'    =>'indonesian',
    	'it'    =>'italian',
    	'ja'    =>'japanese',
    	'ko'    =>'korean',
    	'lv'    =>'latvian',
    	'lt'    =>'lithuanian',
    	'no'    =>'norwegian',
    	'pl'    =>'polish',
    	'pt-PT' =>'portuguese',
    	'ro'    =>'romanian',
    	'ru'    =>'russian',
    	'sr'    =>'serbian',
    	'sk'    =>'slovak',
    	'sl'    =>'slovenian',
    	'es'    =>'spanish',
    	'sv'    =>'swedish',
    	'uk'    =>'ukrainian',
    	'vi'    =>'vietnamese'
    );
    
    /**
     * Text for speaking
     * 
     * @param string $lang - Language to be translate
     * @param string $text - text to be spoken
     * @return Google_TTS
     * @access public
     */
    public function text($lang, $text) {
    	$textToSpeak = urlencode($text);
    	$this->googleTranslateURL = sprintf($this->googleTranslateURL, $lang, $textToSpeak);
    	
    	return $this;
    }
    
    /**
     * Handles the CURL execution
     *
     * @return Google_TTS
     * @access private
     */
    private function curlRequest() {
    	$curl = curl_init();
    	
    	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		"REMOTE_ADDR: $this->ipForHeader",
    		"HTTP_X_FORWARDED_FOR: $this->ipForHeader"
    	));
    	curl_setopt($curl, CURLOPT_URL, $this->googleTranslateURL);
    	curl_setopt($curl, CURLOPT_ENCODING, "");
    	curl_setopt($curl, CURLOPT_USERAGENT, 'Googlebot/2.1 (+http://www.google.com/bot.html)');
    	curl_setopt($curl, CURLOPT_REFERER, 'http://translate.google.com');
    	curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($curl, CURLOPT_TIMEOUT, 60);
    	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
    	
    	$this->soundData = curl_exec($curl);
    	curl_close($curl);
    	
    	return $this;
    }
    
    /**
     * Outputs the $this->soundData
     * 
     * @param string $outputType - default direct
     * @return Google_TTS
     * @access public
     */
    public function speakIt($outputType = 'direct') {
    	$this->curlRequest();
    	
    	if ($outputType == 'direct') {
    		header("Content-Type: audio/mpeg");
    		echo $this->soundData;
    	} else {
    		try {
			$fileHandle = fopen($outputType, "w");
    			fwrite($fileHandle, $this->soundData);
    			fclose($fileHandle);
    		} catch (Exception $e) {
    			print_r($e->getMessage());
    		}
    	}
    	return $this;
    }
    
}

