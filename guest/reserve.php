<?php

include '../app/functions.php';

$cookie_name = $app['cookie_name'];

if(isset($_GET['delete']) && isset($_COOKIE[$cookie_name])) {

    $list_id = $_GET['list'];
    $gift_id = $_GET['gift'];

    $visitor = $_COOKIE[$cookie_name];
    $session = $app['db']->Select("SELECT * from whish_sessions where session_hash = '$visitor'")[0];
    
    $session_gifts = json_decode($session['session_gifts'], true);
    $qty = $session_gifts[$gift_id];

    unset($session_gifts[$gift_id]);

    $session_gifts = json_encode($session_gifts);

    $app['db']->Update('whish_sessions', [
        'session_gifts' =>  $session_gifts
    ], ['session_hash' => $visitor]);

    $gift = $app['db']->Select("SELECT * from whish_gifts where gift_id = '$gift_id' AND gift_list = '$list_id' ")[0];

    $app['db']->Update('whish_gifts', [
        'gift_reservations' => $gift['gift_reservations'] - $qty
    ], ['gift_id' => $gift_id]);

}


if(!empty($_POST)) {

    $list_id = $_POST['list'];

    $gift_id = $_POST['gift'];
    $qty =  $_POST['qty'];

    $gift = $app['db']->Select("SELECT * from whish_gifts where gift_id = '$gift_id' AND gift_list = '$list_id' ")[0];

    $app['db']->Update('whish_gifts', [
        'gift_reservations' => $gift['gift_reservations'] + $qty
    ], ['gift_id' => $gift_id]);

    if(isset($_COOKIE[$cookie_name])) {

        $visitor = $_COOKIE[$cookie_name];
        $session = $app['db']->Select("SELECT * from whish_sessions where session_hash = '$visitor' AND session_list = $list_id");
    

        if(!empty($session)) {

            $session_gifts = json_decode($session[0]['session_gifts'], true);
            $session_gifts[$gift_id] = $qty;
    
            $session_gifts = json_encode($session_gifts);
    
            $app['db']->Update('whish_sessions', [
                'session_gifts' => $session_gifts
            ], ['session_hash' => $visitor]);

        } 

    } else {

        $list = $app['db']->Select("SELECT * from whish_lists where list_id = '$list_id' ")[0];
        
        $gifts = json_encode([$gift_id => $qty]);

        $session_id = $app['db']->Insert('whish_sessions', [
            'session_list' => $list_id,
            'session_gifts' => $gifts
        ]);

        $hash = md5($session_id);

        $app['db']->Update('whish_sessions', [
            'session_hash' => $hash
        ], ['session_id' => $session_id]);
    
        setcookie($cookie_name, $hash, strtotime($list['list_date']), "/");
    }

}

redirect('/' . $list_id);