<?php
/**
 * 调试模式下的入口文件
 */

if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', 'fe80::1', '::1'))
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check ' . basename(__FILE__) . ' for more information.');
}

date_default_timezone_set('Asia/Shanghai');

/**
 * 若要移动 SilexBase 目录的位置，只需修改 $silexBasePath
 */
$silexBasePath = __DIR__ . '/../SilexBase';
$rootPath = __DIR__ . '/..';

$loader = require_once $silexBasePath . '/vendor/autoload.php';
$loader->add('', $rootPath . '/app/src');

$app = new SilexBase\Core\Application(array(
    'root_path' => $rootPath,
    'debug' => true,
    'locale' => 'zh',
));

$app->run();