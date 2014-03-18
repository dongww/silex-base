<?php
$silexBasePath = __DIR__ . '/../SilexBase';
$rootPath = __DIR__ . '/..';

$loader = require_once $silexBasePath . '/vendor/autoload.php';
$loader->add('', $rootPath . '/app/src');

$timer = new SilexBase\Core\Timer();
$timer->start();

$app = new SilexBase\Core\Application(array(
    'root_path' => $rootPath,
    'debug' => true,
    'locale' => 'zh',
));

$app->run();

$timer->stop();
$timer->output();