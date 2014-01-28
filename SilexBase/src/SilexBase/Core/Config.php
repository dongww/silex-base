<?php
/**
 * Created by dongww.
 * User: dongww
 * Date: 14-1-28
 * Time: 下午8:02
 */

namespace SilexBase\Core;


use Symfony\Component\Yaml\Yaml;

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

    public function __construct($configPath)
    {
        $this->configPath = $configPath;
    }

    /**
     * @param $name
     * @return array
     */
    public function getConfig($name)
    {
        return Yaml::parse($this->configPath . '/' . $name . '.yml');
    }
} 