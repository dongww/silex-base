<?php
/**
 * 产品模式下的入口文件
 */

require_once 'path.php';
require_once $silexBasePath . '/vendor/autoload.php';

$app = new App\Application(array(
    'root_path' => $rootPath,
    'locale'    => 'zh_CN',
));
$app['http_cache']->run();