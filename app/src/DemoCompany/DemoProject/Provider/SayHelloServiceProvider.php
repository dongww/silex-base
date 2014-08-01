<?php
/**
 * User: dongww
 * Date: 14-4-4
 * Time: 下午3:00
 */

namespace DemoCompany\DemoProject\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;

class SayHelloServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['hello'] = $app->protect(function ($name) use ($app) {
            $default = 'SilexBase';
            $name    = $name ? $name : $default;

            return 'Hello ' . $app->escape($name);
        });
    }

    public function boot(Application $app)
    {
    }
}
