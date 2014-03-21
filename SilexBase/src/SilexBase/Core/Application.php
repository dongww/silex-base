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
use DebugBar\StandardDebugBar;
use Whoops\Provider\Silex\WhoopsServiceProvider;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Config\ConfigCache;
use Symfony\Component\Config\Resource\FileResource;

/**
 * 继承于 Silex Application，
 * 负责程序的初始化和运行相关的主要操作
 *
 * Class Application
 * @package SilexBase\Core
 */
class Application extends baseApp
{
    const VERSION = '0.1.0';

    /**
     * 构造函数，在 Silex 基础上，增加了一些常用路径的设置、
     * 更友好的错误和异常处理（包括错误页面的处理）、
     * 路由配置采用 yml 文件、
     * 初始化 Provider （在 app/config/providers.php 中进行配置）、
     *
     *
     * @param array $values 附加的 key=>value 参数，若已存在则覆盖
     */
    public function __construct(array $values = array())
    {
        parent::__construct($values);

        if ($this['debug']) {
            $this->register(new WhoopsServiceProvider);
        }

        $this['app_path'] = realpath($this['root_path'] . '/app');
        $this['data_path'] = $this['app_path'] . '/data';
        $this['config_path'] = $this['app_path'] . '/config';
        $this['view_path'] = $this['app_path'] . '/views';
        $this['cache_path'] = $this['data_path'] . '/cache';

        if ($this['debug']) {
            error_reporting(E_ALL ^ E_NOTICE);

            $this['debug_bar'] = new StandardDebugBar();
            $this['debugbar_renderer'] = $this['debug_bar']->getJavascriptRenderer();
        } else {
            error_reporting(0);

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

        $this->initConfig();
        $this->initRoutes();
        $this->initProviders();
    }

    /**
     * 初始化路由配置，路由配置文件为 yml 格式，
     * 放在 app/config/routes 目录下面。
     * 在此目录下可自由组织文件夹和文件名，
     */
    protected function initRoutes()
    {
        $cachePath = $this['cache_path'] . '/config/routes.php';
        $routesCache = new ConfigCache($cachePath, $this['debug']);

        if (!$routesCache->isFresh()) {
            $locator = new FileLocator($this['config_path']);
            $loader = new YamlFileLoader($locator);

            $finder = new Finder();
            $finder->files()->in($this['config_path'] . '/routes');

            $resources = array();

            foreach ($finder as $file) {
                $resources[] = new FileResource($file->getRealpath());
                $this['routes']->addCollection($loader->load($file->getRealpath()));
            }

            $routesCache->write(\serialize($this['routes']), $resources);
        } else {
            $this['routes']->addCollection(\unserialize(file_get_contents($cachePath)));
        }
    }

    /**
     * 读取主配置文件
     */
    protected function initConfig()
    {
        $app = $this;
        $this['configurator'] = $this->share(function () use ($app) {
            return new Config($app['config_path'], $app);
        });

        $this['config.main'] = $this['configurator']->getConfig('main');
    }

    /**
     * 初始化 Providers
     */
    protected function initProviders()
    {
        $app = $this;
        require_once $this['config_path'] . '/providers.php';
    }

    /**
     * 增加调试信息
     *
     * @param array|string|number|object $data 任何数据
     */
    public function d($data)
    {
        if (!$this['debug']) {
            return;
        }

        $this['debug_bar']['messages']->addMessage($data);
    }

    /**
     * 输出 debug bar
     */
    public function debugBar()
    {
        if (!$this['debug']) {
            return null;
        }

        echo $this['debugbar_renderer']->renderHead();
        echo $this['debugbar_renderer']->render();
    }
} 