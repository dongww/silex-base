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

require_once 'path.php';
require_once $silexBasePath . '/vendor/autoload.php';

$app = new App\Application(array(
    'root_path' => $rootPath,
    'debug' => true,
    'locale' => 'zh_CN',
));

$app->run();