<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Core\Application();
$app['debug'] = true;

$app->run();