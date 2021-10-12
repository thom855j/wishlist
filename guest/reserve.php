<?php

include '../app/includes/functions.php';

$cookie_name = $app['cookie_name'];

if(isset($_GET['delete']) && isset($_COOKIE[$cookie_name])) {

    $list_id = $_GET['list'];
    $gift_id = $_GET['gift'];

    $user_hash = $_COOKIE[$cookie_name];
    $session = $app['db']->Select("SELECT * from wish_sessions where session_hash = '$user_hash'")[0];
    
    $session_gifts = json_decode($session['session_gifts'], true);
    $qty = $session_gifts[$gift_id];

    unset($session_gifts[$gift_id]);

    $session_gifts = json_encode($session_gifts);

    $app['db']->Update('wish_sessions', [
        'session_gifts' =>  $session_gifts
    ], ['session_hash' => $user_hash]);

    $gift = $app['db']->Select("SELECT * from wish_gifts where gift_id = '$gift_id' AND gift_list = '$list_id' ")[0];

    $app['db']->Update('wish_gifts', [
        'gift_reservations' => $gift['gift_reservations'] - $qty
    ], ['gift_id' => $gift_id]);

}


if(!empty($_POST)) {

    $list_id = $_POST['list'];
  
  	$list = $app['db']->Select("SELECT * FROM wish_lists WHERE list_id = '$list_id'")[0];

    $gift_id = $_POST['gift'];
    $qty =  $_POST['qty'];

    $gift = $app['db']->Select("SELECT * FROM wish_gifts WHERE gift_id = '$gift_id' AND gift_list = '$list_id' ")[0];

    $app['db']->Update('wish_gifts', [
        'gift_reservations' => $gift['gift_reservations'] + $qty
    ], ['gift_id' => $gift_id]);

    $gifts = json_encode([$gift_id => $qty]);

    if(isset($_COOKIE[$cookie_name])) {

        $user_hash = $_COOKIE[$cookie_name];
        $session = $app['db']->Select("SELECT * FROM wish_sessions WHERE session_hash = '$user_hash' AND session_list = $list_id");
    
        if(!empty($session)) {

            $session_gifts = json_decode($session[0]['session_gifts'], true);
            $session_gifts[$gift_id] = $qty;
    
            $session_gifts = json_encode($session_gifts);
    
            $app['db']->Update('wish_sessions', [
                'session_gifts' => $session_gifts
            ], ['session_hash' => $user_hash]);

        } else {
            
            $app['db']->Insert('wish_sessions', [
                'session_list' => $list_id,
                'session_gifts' => $gifts,
                'session_hash' => $user_hash
            ]);
        }

    } else {

        $session_id = $app['db']->Insert('wish_sessions', [
            'session_list' => $list_id,
            'session_gifts' => $gifts
        ]);

        $hash = md5($session_id);

        $app['db']->Update('wish_sessions', [
            'session_hash' => $hash
        ], ['session_id' => $session_id]);
    
        setcookie($cookie_name, $hash, strtotime($list['list_date']), "/");
    }

}

redirect('/' . $list_id);