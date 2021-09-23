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