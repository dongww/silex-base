<?php
/**
 * User: dongww
 * Date: 14-1-28
 * Time: 下午3:46
 */

namespace SilexBase\Core;

use Silex\Application as baseApp;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use SilexBase\Core\Config;

class Application extends baseApp
{
    public function __construct($rootPath)
    {
        parent::__construct();
        $this['app_path'] = realpath($rootPath . '/app');
        $this['data_path'] = $this['app_path'] . '/data';
        $this['config_path'] = $this['app_path'] . '/config';
        $this['view_path'] = $this['app_path'] . '/views';
        $this['cache_path'] = $this['data_path'] . '/cache';

        $this->initConfig();
        $this->initRoutes();

        $this['debug'] = $this['config.main']['debug'];

        $this->initProviders();
    }

    protected function initRoutes()
    {
        $locator = new FileLocator($this['config_path']);
        $loader = new YamlFileLoader($locator);
        $this['routes'] = $loader->load('routes.yml');
    }

    protected function initConfig()
    {
        $app = $this;
        $this['config_factory'] = $this->share(function () use ($app) {
            return new Config($app['config_path']);
        });

        $this['config.main'] = $this['config_factory']->getConfig('main');
    }

    protected function initProviders()
    {
        $app = $this;
        require_once $this['config_path'] . '/providers.php';
    }
} 