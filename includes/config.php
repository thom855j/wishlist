<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'classes/db.class.php';
require 'classes/simple.db.class.php';


//$app['db'] = new DB('localhost', 'root', '', 'dev');

$app['db'] = new SimpleDB(['host' => 'localhost', 'user' => 'root','pass' => '','database' => 'dev']);

$app['url'] = 'http://localhost/whishlist';

$app['asset'] = $app['url'] . '/public/assets';

$app['name'] = 'Ønskeliste';

$app['title'] = 'Min Ønskeliste - Ønskelister til alle begivenheder';