<?php
/**
 * Created by dongww.
 * User: dongww
 * Date: 14-1-28
 * Time: 下午8:02
 */

namespace SilexBase\Core;

use SilexBase\Exception\Exception;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Config\ConfigCache;
use Symfony\Component\Config\Resource\FileResource;

/**
 * 配置文件类，负责从配置文件读取配置
 *
 * Class Config
 * @package Core
 */
class Config
{
    /**
     * 配置文件路径
     *
     * @var string
     */
    protected $configPath;
    protected $app;

    /**
     * @param $configPath
     * @param Application $app
     */
    public function __construct($configPath, Application $app)
    {
        $this->configPath = $configPath;
        $this->app = $app;
    }

    /**
     * 从配置文件读取配置，返回数组
     *
     * @param string $name 配置文件的文件名，不包括后缀，可包含路径，
     * 例如：main、admin/main
     *
     * @return array
     * @throws \SilexBase\Exception\Exception
     */
    public function getConfig($name)
    {
        $filePath = sprintf('%s/%s.yml', $this->configPath, $name);

        if (!file_exists($filePath)) {
            throw new Exception('配置文件不存在：' . $filePath);
        }

        $cachePath = sprintf('%s/config/%s.php', $this->app['cache_path'], $name);
        $cache = new ConfigCache($cachePath, $this->app['debug']);
        $data = null;

        if (!$cache->isFresh()) {
            $resources = array();
            $resources[] = new FileResource($filePath);
            $cache->write(\serialize(Yaml::parse($filePath)), $resources);
        }

        return \unserialize(file_get_contents($cachePath));
    }
}