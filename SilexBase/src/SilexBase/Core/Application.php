<?php
/**
 * User: dongww
 * Date: 14-1-28
 * Time: 下午3:46
 */

namespace SilexBase\Core;

use Silex\Application as baseApp;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use SilexBase\Core\Config;

class Application extends baseApp
{
    public function __construct(array $values = array())
    {
        parent::__construct($values);
        $this['app_path'] = realpath($this['root_path'] . '/app');
        $this['data_path'] = $this['app_path'] . '/data';
        $this['config_path'] = $this['app_path'] . '/config';
        $this['view_path'] = $this['app_path'] . '/views';
        $this['cache_path'] = $this['data_path'] . '/cache';

        $this->initConfig();
        $this->initRoutes();

        if ($this['debug']) {
            error_reporting(E_ALL ^ E_NOTICE);
        } else {
            error_reporting(0);
        }

        $this->initProviders();

        if (!$this['debug']) {
            $this->error(function (\Exception $e, $code) {
                switch ($code) {
                    case 404: //路径不存在
                        $errorView = '_404.twig';
                        break;
                    case 403: //无访问权限
                        $errorView = '_403.twig';
                        break;
                    default:
                        //其他错误
                        $errorView = '_error.twig';
                }

                return new Response($this['twig']->render('Error/' . $errorView));
            });
        }
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