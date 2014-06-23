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