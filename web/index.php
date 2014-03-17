<?php
$silexBasePath = __DIR__ . '/../SilexBase/vendor/autoload.php';
$rootPath = __DIR__ . '/..';

$loader = require_once $silexBasePath;
$loader->add('', $rootPath . '/app/src');

$timer = new SilexBase\Core\Timer();
$timer->start();

$app = new SilexBase\Core\Application($rootPath);

$app->run();

$timer->stop();
echo "页面执行时间: " . $timer->spent() . " 毫秒";