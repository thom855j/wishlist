<?php

include 'config.php';

function app($key, $echo = true) {
    global $app;

    if($app[$key] && $echo) {
        echo $app[$key];
    } else {
        return $app[$key];
    }
}

function url($path = '') {
    global $app;
    echo $app['url'] . $path;
}

function list_login($list_id) {
    global $app;
    $name = app('list_name', false);
    return $_SESSION[$name] = $list_id;
}

function login($user_id) {
    global $app;
    $name = app('session_name', false);
    if(!isset($_SESSION[$name])) {
       return $_SESSION[$name] = $user_id;
    }
    return false;
}

function session_logout() {
    global $app;
    $name = app('session_name', false);
    if(isset($_SESSION[$name])) {
        unset($_SESSION[$name]);
        return true;
    }
    return false;
}

function cookie_logout() {
    global $app;
    $name = app('session_name', false);
    if(isset($_COOKIE[$name])) {
        unset($_COOKIE[$name]); 
        setcookie($name, null, -1, '/'); 
        return true;
    }
    return false;
}

function list_auth($list_id) {
    global $app;
    $name = app('list_name', false);
    if(isset($_SESSION[$name]) && $_SESSION[$name] == $list_id) {
        return true;
    }
    return false;
}

function auth() {
    global $app;
    $name = app('session_name', false);
    if(isset($_SESSION[$name])) {
        return true;
    }
    return false;
}

function is_auth() {
    global $app;
    $name = app('session_name', false);
    if(isset($_SESSION[$name])) {
        return true;
    }
    return redirect('/auth/login');
}


function user() {
    global $app;
    $name = app('session_name', false);
    if(isset($_SESSION[$name])) {
        return $_SESSION[$name];
    }
    return false;
}


function redirect($url) {
    global $app;
    return header('Location: ' . $app['url'] . $url);
}

/**
 * Create a web friendly URL slug from a string.
 * 
 * Although supported, transliteration is discouraged because
 *     1) most web browsers support UTF-8 characters in URLs
 *     2) transliteration causes a loss of information
 *
 * @author Sean Murphy <sean@iamseanmurphy.com>
 * @copyright Copyright 2012 Sean Murphy. All rights reserved.
 * @license http://creativecommons.org/publicdomain/zero/1.0/
 *
 * @param string $str
 * @param array $options
 * @return string
 */
function url_slug($str, $options = array()) {
	// Make sure string is in UTF-8 and strip invalid UTF-8 characters
	$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
	
	$defaults = array(
		'delimiter' => '-',
		'limit' => null,
		'lowercase' => true,
		'replacements' => array(),
		'transliterate' => false,
	);
	
	// Merge options
	$options = array_merge($defaults, $options);
	
	$char_map = array(
		// Latin
		'??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'AE', '??' => 'C', 
		'??' => 'E', '??' => 'E', '??' => 'E', '??' => 'E', '??' => 'I', '??' => 'I', '??' => 'I', '??' => 'I', 
		'??' => 'D', '??' => 'N', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'O', 
		'??' => 'O', '??' => 'U', '??' => 'U', '??' => 'U', '??' => 'U', '??' => 'U', '??' => 'Y', '??' => 'TH', 
		'??' => 'ss', 
		'??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'ae', '??' => 'c', 
		'??' => 'e', '??' => 'e', '??' => 'e', '??' => 'e', '??' => 'i', '??' => 'i', '??' => 'i', '??' => 'i', 
		'??' => 'd', '??' => 'n', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'o', 
		'??' => 'o', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'y', '??' => 'th', 
		'??' => 'y',

		// Latin symbols
		'??' => '(c)',

		// Greek
		'??' => 'A', '??' => 'B', '??' => 'G', '??' => 'D', '??' => 'E', '??' => 'Z', '??' => 'H', '??' => '8',
		'??' => 'I', '??' => 'K', '??' => 'L', '??' => 'M', '??' => 'N', '??' => '3', '??' => 'O', '??' => 'P',
		'??' => 'R', '??' => 'S', '??' => 'T', '??' => 'Y', '??' => 'F', '??' => 'X', '??' => 'PS', '??' => 'W',
		'??' => 'A', '??' => 'E', '??' => 'I', '??' => 'O', '??' => 'Y', '??' => 'H', '??' => 'W', '??' => 'I',
		'??' => 'Y',
		'??' => 'a', '??' => 'b', '??' => 'g', '??' => 'd', '??' => 'e', '??' => 'z', '??' => 'h', '??' => '8',
		'??' => 'i', '??' => 'k', '??' => 'l', '??' => 'm', '??' => 'n', '??' => '3', '??' => 'o', '??' => 'p',
		'??' => 'r', '??' => 's', '??' => 't', '??' => 'y', '??' => 'f', '??' => 'x', '??' => 'ps', '??' => 'w',
		'??' => 'a', '??' => 'e', '??' => 'i', '??' => 'o', '??' => 'y', '??' => 'h', '??' => 'w', '??' => 's',
		'??' => 'i', '??' => 'y', '??' => 'y', '??' => 'i',

		// Turkish
		'??' => 'S', '??' => 'I', '??' => 'C', '??' => 'U', '??' => 'O', '??' => 'G',
		'??' => 's', '??' => 'i', '??' => 'c', '??' => 'u', '??' => 'o', '??' => 'g', 

		// Russian
		'??' => 'A', '??' => 'B', '??' => 'V', '??' => 'G', '??' => 'D', '??' => 'E', '??' => 'Yo', '??' => 'Zh',
		'??' => 'Z', '??' => 'I', '??' => 'J', '??' => 'K', '??' => 'L', '??' => 'M', '??' => 'N', '??' => 'O',
		'??' => 'P', '??' => 'R', '??' => 'S', '??' => 'T', '??' => 'U', '??' => 'F', '??' => 'H', '??' => 'C',
		'??' => 'Ch', '??' => 'Sh', '??' => 'Sh', '??' => '', '??' => 'Y', '??' => '', '??' => 'E', '??' => 'Yu',
		'??' => 'Ya',
		'??' => 'a', '??' => 'b', '??' => 'v', '??' => 'g', '??' => 'd', '??' => 'e', '??' => 'yo', '??' => 'zh',
		'??' => 'z', '??' => 'i', '??' => 'j', '??' => 'k', '??' => 'l', '??' => 'm', '??' => 'n', '??' => 'o',
		'??' => 'p', '??' => 'r', '??' => 's', '??' => 't', '??' => 'u', '??' => 'f', '??' => 'h', '??' => 'c',
		'??' => 'ch', '??' => 'sh', '??' => 'sh', '??' => '', '??' => 'y', '??' => '', '??' => 'e', '??' => 'yu',
		'??' => 'ya',

		// Ukrainian
		'??' => 'Ye', '??' => 'I', '??' => 'Yi', '??' => 'G',
		'??' => 'ye', '??' => 'i', '??' => 'yi', '??' => 'g',

		// Czech
		'??' => 'C', '??' => 'D', '??' => 'E', '??' => 'N', '??' => 'R', '??' => 'S', '??' => 'T', '??' => 'U', 
		'??' => 'Z', 
		'??' => 'c', '??' => 'd', '??' => 'e', '??' => 'n', '??' => 'r', '??' => 's', '??' => 't', '??' => 'u',
		'??' => 'z', 

		// Polish
		'??' => 'A', '??' => 'C', '??' => 'e', '??' => 'L', '??' => 'N', '??' => 'o', '??' => 'S', '??' => 'Z', 
		'??' => 'Z', 
		'??' => 'a', '??' => 'c', '??' => 'e', '??' => 'l', '??' => 'n', '??' => 'o', '??' => 's', '??' => 'z',
		'??' => 'z',

		// Latvian
		'??' => 'A', '??' => 'C', '??' => 'E', '??' => 'G', '??' => 'i', '??' => 'k', '??' => 'L', '??' => 'N', 
		'??' => 'S', '??' => 'u', '??' => 'Z',
		'??' => 'a', '??' => 'c', '??' => 'e', '??' => 'g', '??' => 'i', '??' => 'k', '??' => 'l', '??' => 'n',
		'??' => 's', '??' => 'u', '??' => 'z'
	);
	
	// Make custom replacements
	$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
	
	// Transliterate characters to ASCII
	if ($options['transliterate']) {
		$str = str_replace(array_keys($char_map), $char_map, $str);
	}
	
	// Replace non-alphanumeric characters with our delimiter
	$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
	
	// Remove duplicate delimiters
	$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
	
	// Truncate slug to max. characters
	$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
	
	// Remove delimiter from ends
	$str = trim($str, $options['delimiter']);
	
	return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}

function list_file_upload($file, $list_id, $size = 5) {

$target_dir = "../public/uploads/$list_id/";
$file_name = htmlspecialchars( basename( $_FILES[$file]["name"]));
$target_file = $target_dir . $file_name;
$uploadOk = 1;
$ext = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(!empty($_POST)) {
  $check = getimagesize($_FILES[$file]["tmp_name"]);
  if($check !== false) {
    // "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    // "File is not an image.";
    $uploadOk = 0;
    return false;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  // "Sorry, file already exists.";
  $uploadOk = 0;
  return false;
}

// Check file size
if ($_FILES[$file]["size"] > $size*MB) {
  // "Sorry, your file is too large.";
  $uploadOk = 0;
  return false;
}

// Allow certain file formats
if($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif" ) {
  //"Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
  return false;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  // "Sorry, your file was not uploaded.";
  return false;
// if everything is ok, try to upload file
} else {
  if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
  }
  $upload_file = md5($file_name) . ".$ext";
  if (move_uploaded_file($_FILES[$file]["tmp_name"], $target_dir . $upload_file)) {
    // "The file ". $file_name . " has been uploaded.";
    return md5($file_name) . ".$ext";
  } else {
    // "Sorry, there was an error uploading your file.";
    return false;
  }
}
}