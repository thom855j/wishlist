<?php

include '../app/config.php';

$id = $app['db']->CleanDBData($_GET['id']);

$app['db']->Delete('whish_lists', ['list_id' => $id]);

header('Location: ' . $app['url'] . '/list/read');