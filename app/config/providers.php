<?php
$app->register(new \Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => $app['view_path'],
    'twig.options' => array(
        'cache' => $app['cache_path'] . '/twig',
        'strict_variables' => false,
        'debug' => $app['debug']
    )
));

$app->register(new \Silex\Provider\ServiceControllerServiceProvider());

$app->register(new \Silex\Provider\UrlGeneratorServiceProvider());

$app->register(new \Silex\Provider\ValidatorServiceProvider());

if ($app['debug']) {
    $app->register(new \Silex\Provider\MonologServiceProvider(), array(
        'monolog.logfile' => $app['cache_path'] . '/logs/debug.log',
    ));

    $app->register(new \Silex\Provider\WebProfilerServiceProvider(), array(
        'profiler.cache_dir' => $app['cache_path'] . '/profiler',
        'profiler.mount_prefix' => $app['config.main']['debug_path'], // this is the default
    ));
}