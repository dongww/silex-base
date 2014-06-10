<?php
/***********************
 * 邮件设置选项
 **********************/
if ($config['mail']) {
    $app['swiftmailer.options'] = [
        'host'       => 'localhost',
        'port'       => 25,
        'username'   => null,
        'password'   => null,
        'encryption' => null,
        'auth_mode'  => null,
    ];
}

/***********************
 * 数据库参数 设置
 **********************/
//if ($config['doctrine']) {
$app['db.options'] = [
    'driver'   => 'pdo_mysql',
//        'driver'   => 'pdo_sqlite',
//        'path'     => $app['data_path'] . '/db/app.db',
    'dbname'   => 'dbal_wrap',
    'host'     => 'localhost',
    'user'     => 'root',
    'password' => '',
    'charset'  => 'utf8',
    'port'     => '',
];
//}

/***********************
 * 安全设置选项
 **********************/

$app['security.firewalls'] = [
    'admin'     => array(
        'pattern'     => '^/admin',
        'form'        => array(
            'login_path' => '/login',
            'check_path' => '/admin/login_check'
        ),
        'logout'      => array(
            'logout_path' => '/admin/logout'
        ),
//        'http' => true,
        'remember_me' => array(
            'key'                => 'asfd',
            'always_remember_me' => false,
            /* Other options */
        ),
        'users'       => array(
            // 密码为 foo
            'admin' => array(
                'ROLE_ADMIN', '5FZ2Z8QIkA7UTZ4BYkoC+GsReLf569mSKDsfods6LYQ8t+a8EW9oaircfMpmaLbPBh4FOBiiFyLfuZmTSUwzZg=='
            ),
        ),
    ),
    'unsecured' => array(
        'anonymous' => true,
        'pattern'   => '^/',
    ),
];

$app['security.role_hierarchy'] = [
    'ROLE_ADMIN' => array('ROLE_USER', 'ROLE_ALLOWED_TO_SWITCH'),
];

$app['security.access_rules'] = [
    array('^/admin/general', 'ROLE_USER'),
    array('^/admin', 'ROLE_ADMIN'),
];