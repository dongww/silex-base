<?php
/***********************
 * 安全设置选项
 **********************/

$app['security.firewalls'] = [
    'admin'     => [
        'pattern'     => '^/admin',
        'form'        => [
            'login_path' => '/login',
            'check_path' => '/admin/login_check'
        ],
        'logout'      => [
            'logout_path' => '/admin/logout'
        ],
//        'http' => true,
        'remember_me' => [
            'key'                => 'asfd',
            'always_remember_me' => false,
            /* Other options */
        ],
        'users'       => [
            // 密码为 foo
            'admin' => [
                'ROLE_ADMIN', '5FZ2Z8QIkA7UTZ4BYkoC+GsReLf569mSKDsfods6LYQ8t+a8EW9oaircfMpmaLbPBh4FOBiiFyLfuZmTSUwzZg=='
            ],
        ],
    ],
    'unsecured' => [
        'anonymous' => true,
        'pattern'   => '^/',
    ],
];

$app['security.role_hierarchy'] = [
    'ROLE_ADMIN' => ['ROLE_USER', 'ROLE_ALLOWED_TO_SWITCH'],
];

$app['security.access_rules'] = [
    ['^/admin/general', 'ROLE_USER'],
    ['^/admin', 'ROLE_ADMIN'],
];
