<?php

include '../app/config.php';

$list_id = $app['db']->CleanDBData($_GET['id']);

$app['db']->Delete('whish_lists', ['list_id' => $list_id]);
$app['db']->Delete('whish_gifts', ['gift_list' => $list_id]);

header('Location: ' . $app['url'] . '/list/read');