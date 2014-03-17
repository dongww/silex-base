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

    function getMicroTime()
    {
        list($usec, $sec) = explode(' ', microtime());
        return ((float)$usec + (float)$sec);
    }

    function start()
    {
        $this->startTime = $this->getMicroTime();
    }

    function stop()
    {
        $this->stopTime = $this->getMicroTime();
    }

    function spent()
    {
        return round(($this->stopTime - $this->startTime) * 1000, 1);
    }
}
 