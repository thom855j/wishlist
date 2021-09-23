<?php

include '../app/includes/functions.php';

$list_id = $app['db']->CleanDBData($_GET['id']);

$app['db']->Delete('wish_lists', ['list_id' => $list_id]);
$app['db']->Delete('wish_gifts', ['gift_list' => $list_id]);
$app['db']->Delete('wish_sessions', ['session_list' => $list_id]);

header('Location: ' . $app['url'] . '/list/read');