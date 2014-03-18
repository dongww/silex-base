<?php
/**
 * User: dongww
 * Date: 14-3-17
 * Time: 下午3:06
 */

namespace SilexBase\Core;


class Timer
{
    private $startTime = 0;
    private $stopTime = 0;

    public function getMicroTime()
    {
        list($usec, $sec) = explode(' ', microtime());
        return ((float)$usec + (float)$sec);
    }

    public function start()
    {
        $this->startTime = $this->getMicroTime();
    }

    public function stop()
    {
        $this->stopTime = $this->getMicroTime();
    }

    public function spent()
    {
        return round(($this->stopTime - $this->startTime) * 1000, 1);
    }

    public function output()
    {
        echo '<div style="display: block;position: fixed;right: 0;bottom: 0;background-color: #ccc">执行时间：', $this->spent(), '秒</div>';
    }
}
 