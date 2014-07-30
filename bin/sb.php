<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../web/path.php';

use Symfony\Component\Console\Application;
use Dongww\Db\Doctrine\Dbal\Command;

$app = new \App\Application([
    'root_path' => $rootPath,
    'debug'     => true,
]);
error_reporting(E_ALL);
$config = new \Doctrine\DBAL\Configuration();
$conn   = \Doctrine\DBAL\DriverManager::getConnection($app['db.options'], $config);

$consoleApp = new Application('silex-base');
$consoleApp->add(new Command\UpdateCommand($conn));
$consoleApp->add(new App\Command\DbUpdateCommand());
$consoleApp->add(new App\Command\CacheCleanCommand($app));
$consoleApp->add(new App\Command\AssetCommand($app));

$consoleApp->run();