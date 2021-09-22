<?php

include '../app/functions.php'; 

$gift_id = $app['db']->CleanDBData($_GET['id']);
$list_id = $app['db']->CleanDBData($_GET['list']);

$list = $app['db']->Delete('whish_gifts', [
    'gift_id' => $gift_id,
    'gift_list' => $list_id
]);

redirect('/gift/read?list=' . $list_id);