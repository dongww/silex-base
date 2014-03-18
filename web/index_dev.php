<?php
$silexBasePath = __DIR__ . '/../SilexBase/vendor/autoload.php';
$rootPath = __DIR__ . '/..';

$loader = require_once $silexBasePath;
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
echo "页面执行时间: " . $timer->spent() . " 毫秒";