<?php
/**
 * 产品模式下的入口文件
 */

$silexBasePath = __DIR__ . '/..';
$rootPath = __DIR__ . '/..';

require_once $silexBasePath . '/vendor/autoload.php';

$app = new App\Application(array(
    'root_path' => $rootPath,
    'locale' => 'zh',
));
$app['http_cache']->run();