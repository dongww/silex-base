<?php
/**
 * 产品模式下的入口文件
 */

$silexBasePath = __DIR__ . '/../SilexBase';
$rootPath = __DIR__ . '/..';

$loader = require_once $silexBasePath . '/vendor/autoload.php';
$loader->add('', $rootPath . '/app/src');

$app = new SilexBase\Core\Application(array(
    'root_path' => $rootPath,
    'locale' => 'zh',
));
$app['http_cache']->run();