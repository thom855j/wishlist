<?php

include '../app/includes/functions.php'; 

$gift_id = $app['db']->CleanDBData($_GET['id']);
$list_id = $app['db']->CleanDBData($_GET['list']);

$gift = $app['db']->Select('SELECT * FROM wish_gifts WHERE gift_id = ' . $gift_id);

if(!empty($gift[0]['gift_image'])) {

    $gift_img = $gift[0]['gift_image'];
    
    $file = "../public/uploads/$list_id/$gift_img";

    if(file_exists($file)) {
    unlink($file);
    }

}

$list = $app['db']->Delete('wish_gifts', [
    'gift_id' => $gift_id,
    'gift_list' => $list_id
]);

redirect('/gift/read?list=' . $list_id);