<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../web/path.php';

use Symfony\Component\Console\Application;
use Dongww\Db\Dbal\Command;

$app = new \App\Application([
    'root_path' => $rootPath
]);

$config = new \Doctrine\DBAL\Configuration();
$conn   = \Doctrine\DBAL\DriverManager::getConnection($app['db.options'], $config);

$consoleApp = new Application('silex-base');
$consoleApp->add(new Command\UpdateCommand($conn));
$consoleApp->add(new App\Command\DbUpdateCommand());

$consoleApp->run();