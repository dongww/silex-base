<?php
/***********************
 * Whoops 错误捕获
 **********************/
if ($app['debug']) {
    $app->register(new Whoops\Provider\Silex\WhoopsServiceProvider);
}

/***********************
 * Twig
 **********************/
$app->register(new \Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => $app['view_path'],
    'twig.options' => array(
        'cache' => $app['cache_path'] . '/twig',
        'strict_variables' => false,
        'debug' => $app['debug']
    )
));

/***********************
 * ServiceController
 **********************/
//$app->register(new \Silex\Provider\ServiceControllerServiceProvider());

/***********************
 * Url 生成
 **********************/
$app->register(new \Silex\Provider\UrlGeneratorServiceProvider());

/***********************
 * Session
 **********************/
$app->register(new Silex\Provider\SessionServiceProvider());

/***********************
 * Doctrine 数据库
 **********************/
//$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
//    'db.options' => array(
//        'driver' => 'pdo_sqlite',
//        'path' => $app['data_path'] . '/db/app.db',
//    ),
//));

/***********************
 * 验证
 **********************/
$app->register(new \Silex\Provider\ValidatorServiceProvider());

/***********************
 * 表单
 **********************/
$app->register(new Silex\Provider\FormServiceProvider());

/***********************
 * 多语言
 **********************/
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.messages' => array(),
    'translator.domains' => array(),
));

/***********************
 * http 缓存
 **********************/
$app->register(new Silex\Provider\HttpCacheServiceProvider(), array(
    'http_cache.cache_dir' => $app['cache_path'] . '/http',
));

/***********************
 * HttpFragment
 **********************/
//$app->register(new Silex\Provider\HttpFragmentServiceProvider());

/***********************
 * 序列化
 **********************/
//$app->register(new Silex\Provider\SerializerServiceProvider());

/***********************
 * 邮件
 **********************/
//$app['swiftmailer.options'] = array(
//    'host' => $app['config.main']['mail']['mail_host'],
//    'port' => $app['config.main']['mail']['mail_port'],
//    'username' => $app['config.main']['mail']['mail_username'],
//    'password' => $app['config.main']['mail']['mail_password'],
//    'encryption' => $app['config.main']['mail']['mail_encryption'],
//    'auth_mode' => $app['config.main']['mail']['mail_auth_mode']
//);

/***********************
 * web 分析器
 **********************/
if ($app['config.main']['debug']['web_profiler']) {
    /***********************
     * 日志
     **********************/
    $app->register(new \Silex\Provider\MonologServiceProvider(), array(
        'monolog.logfile' => $app['cache_path'] . '/logs/debug.log',
    ));

    /***********************
     * 分析器 信息条
     **********************/
    $app->register(new \Silex\Provider\WebProfilerServiceProvider(), array(
        'profiler.cache_dir' => $app['cache_path'] . '/profiler',
        'profiler.mount_prefix' => $app['config.main']['debug']['profiler_path'], // this is the default
    ));
}
