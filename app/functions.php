<?php

include 'config.php';


function auth($user_id = 'user') {
    if(isset($_SESSION[$user_id])) {
        return true;
    }
    return false;
}

function user($user_id = 'user') {
    if(isset($_SESSION[$user_id])) {
        return $_SESSION[$user_id];
    }
    return false;
}