<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;

$app = new Core\Application();
$app['debug'] = true;

$app->run();