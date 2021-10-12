<?php

include '../app/includes/functions.php';

$list_id = $app['db']->CleanDBData($_GET['id']);

$app['db']->Delete('wish_lists', ['list_id' => $list_id]);

$gifts = $app['db']->Select('SELECT * FROM wish_gifts WHERE gift_list = ' . $list_id);

if(!empty($gifts)) {
    foreach($gifts as $gift) {
        if(!empty($gift['gift_image'])) {
    
            $gift_img = $gift['gift_image'];
            
            $file = "../public/uploads/$list_id/$gift_img";
        
            if(file_exists($file)) {
            unlink($file);
            }
        
        }
    }

    $app['db']->Delete('wish_gifts', ['gift_list' => $list_id]);
}

$app['db']->Delete('wish_sessions', ['session_list' => $list_id]);

header('Location: ' . $app['url'] . '/list/read');