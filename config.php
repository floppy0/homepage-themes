<?php
define('BLUDIT', true);
define('DS', DIRECTORY_SEPARATOR);
define('PATH_ROOT', __DIR__.DS);
define('CHARSET', 'UTF-8');
define('DOMAIN', 'https://themes.bludit.com');
define('CDN', 'https://df6m0u2ovo2fu.cloudfront.net');
define('FILES', PATH_ROOT.'files'.DS);

// TOP Bar links
$topbar = array(
	'download'=>'https://www.bludit.com#download',
	'demo'=>'https://www.bludit.com#demo',
	'docs'=>'https://docs.bludit.com',
	'themes'=>'https://themes.bludit.com',
	'plugins'=>'https://plugins.bludit.com',
	'donations'=>'https://www.bludit.com#donations',
	'pro'=>'https://pro.bludit.com',
	'website'=>DOMAIN
);

// Language
$defaultLanguage = 'en';
$acceptedLanguages = array('en', 'de', 'es');
if (isset($_GET['l'])) {
	if (in_array($_GET['l'], $acceptedLanguages)) {
		$defaultLanguage = $_GET['l'];
	}
}

$jsonData = file_get_contents(PATH_ROOT.'languages'.DS.$defaultLanguage.'.json');
$languageArray = json_decode($jsonData, true);

function l($key, $print=true) {
	global $languageArray;
	$key = mb_strtolower($key, CHARSET);
	$key = str_replace(' ','-',$key);
	if (isset($languageArray[$key])) {
		if ($print) {
			echo $languageArray[$key];
		} else {
			return $languageArray[$key];
		}
	}
}

// Locale
$defaultLocale = 'en_US';
if ($defaultLanguage == "es") {
	$defaultLocale = 'es_ES';
	$topbar = array(
		'download'=>'https://www.bludit.com/es/#download',
		'demo'=>'https://www.bludit.com/es/#demo',
		'docs'=>'https://docs.bludit.com/es/',
		'themes'=>'https://themes.bludit.com/es/',
		'plugins'=>'https://plugins.bludit.com/es/',
		'donations'=>'https://www.bludit.com/es/#donations',
		'pro'=>'https://pro.bludit.com/es/',
		'website'=>DOMAIN.'/es/'
	);
} elseif ($defaultLanguage == "de") {
	$defaultLocale = 'de_DE';
	$topbar = array(
		'download'=>'https://www.bludit.com/de/#download',
		'demo'=>'https://www.bludit.com/de/#demo',
		'docs'=>'https://docs.bludit.com/de/',
		'themes'=>'https://themes.bludit.com/de/',
		'plugins'=>'https://plugins.bludit.com/de/',
		'donations'=>'https://www.bludit.com/de/#donations',
		'pro'=>'https://pro.bludit.com/de/',
		'website'=>DOMAIN.'/de/'
	);
}

//
function listDirectories($path, $regex='*', $sortByDate=false) {
        $directories = glob($path.$regex, GLOB_ONLYDIR);
        if(empty($directories)) {
                return array();
        }
        if($sortByDate) {
                usort($directories, create_function('$a,$b', 'return filemtime($b) - filemtime($a);'));
        }
        return $directories;
}